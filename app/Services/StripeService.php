<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Product;
use Stripe\Price;
use Stripe\Checkout\Session;
use App\Models\Formation;
use App\Models\Paiement;
use App\Models\UserFormation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class StripeService
{
    public function __construct()
    {
        Log::info('Initialisation du StripeService avec la clé: ' . config('services.stripe.secret'));
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Créer un produit et un prix dans Stripe pour une formation
     */
    public function createProductForFormation(Formation $formation)
    {
        Log::info('=== DÉBUT createProductForFormation ===');
        Log::info('Formation:', [
            'id' => $formation->id,
            'title' => $formation->title,
            'price' => $formation->price,
        ]);

        try {
            // Créer le produit
            Log::info('Création du produit Stripe...');
            $product = Product::create([
                'name' => $formation->title,
                'description' => substr($formation->description, 0, 500),
                'metadata' => [
                    'formation_id' => $formation->id,
                    'type' => $formation->type_formation,
                ],
            ]);

            Log::info('Produit créé:', ['product_id' => $product->id]);

            // Créer le prix
            Log::info('Création du prix Stripe...');
            $price = Price::create([
                'product' => $product->id,
                'unit_amount' => $formation->price * 100,
                'currency' => 'eur',
            ]);

            Log::info('Prix créé:', ['price_id' => $price->id]);

            // Mettre à jour la formation avec les IDs Stripe
            $formation->update([
                'stripe_product_id' => $product->id,
                'stripe_price_id' => $price->id,
            ]);

            Log::info('Formation mise à jour avec les IDs Stripe');

            Log::info('=== FIN createProductForFormation - Succès ===');
            return true;
        } catch (\Exception $e) {
            Log::error('Erreur création produit Stripe:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Créer une session de checkout
     */
    public function createCheckoutSession(Formation $formation, $userEmail = null, $metadata = [])
    {
        Log::info('=== DÉBUT createCheckoutSession ===');
        Log::info('Formation:', [
            'id' => $formation->id,
            'title' => $formation->title,
            'stripe_price_id' => $formation->stripe_price_id,
        ]);
        Log::info('Email utilisateur:', ['email' => $userEmail]);
        Log::info('Metadata:', $metadata);

        try {
            $sessionData = [
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $formation->stripe_price_id,
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('formation.payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('formation.payment.cancel'),
                'metadata' => array_merge([
                    'formation_id' => $formation->id,
                    'formation_title' => $formation->title,
                ], $metadata),
            ];

            if ($userEmail) {
                $sessionData['customer_email'] = $userEmail;
                Log::info('Email client défini dans la session');
            }

            Log::info('Création de la session Stripe avec les données:', $sessionData);

            $session = Session::create($sessionData);

            Log::info('Session créée:', [
                'session_id' => $session->id,
                'url' => $session->url,
                'payment_intent_id' => $session->payment_intent ?? 'N/A',
            ]);

            Log::info('=== FIN createCheckoutSession - Succès ===');
            return $session;
        } catch (\Exception $e) {
            Log::error('Erreur création session Stripe:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Récupérer une session Stripe
     */
    public function retrieveSession($sessionId)
    {
        Log::info('Récupération de la session Stripe: ' . $sessionId);

        try {
            $session = Session::retrieve($sessionId);

            Log::info('Session récupérée:', [
                'id' => $session->id,
                'payment_status' => $session->payment_status,
                'customer_email' => $session->customer_email ?? 'N/A',
                'amount_total' => $session->amount_total ?? 'N/A',
            ]);

            return $session;
        } catch (\Exception $e) {
            Log::error('Erreur récupération session Stripe:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            throw $e;
        }
    }

    /**
     * Gérer le webhook Stripe
     */
    public function handleWebhook($payload, $sigHeader)
    {
        $endpoint_secret = config('services.stripe.webhook_secret');

        if (!$endpoint_secret) {
            Log::error('Webhook secret non configuré');
            return response('Webhook secret non configuré', 400);
        }

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            Log::error('Invalid payload: ' . $e->getMessage());
            return response('Invalid payload', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Invalid signature: ' . $e->getMessage());
            return response('Invalid signature', 400);
        }

        // Traiter l'événement
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event->data->object);
                break;
            default:
                Log::info('Événement Stripe non traité: ' . $event->type);
        }

        return response('Webhook handled', 200);
    }

    /**
     * Gérer le checkout session completed
     */
    private function handleCheckoutSessionCompleted($session)
    {
        try {
            Log::info('=== DÉBUT handleCheckoutSessionCompleted ===');
            Log::info('Session complétée:', [
                'session_id' => $session->id,
                'customer_email' => $session->customer_email,
                'amount_total' => $session->amount_total,
            ]);

            $formationId = $session->metadata->formation_id ?? null;
            $paiementReference = $session->metadata->paiement_reference ?? uniqid('PAY_');

            if (!$formationId) {
                Log::error('Formation ID manquant dans les métadonnées Stripe');
                return;
            }

            // Trouver ou créer le paiement
            $paiement = Paiement::where('stripe_session_id', $session->id)->first();

            if (!$paiement) {
                $formation = Formation::find($formationId);
                if (!$formation) {
                    Log::error('Formation non trouvée: ' . $formationId);
                    return;
                }

                // Trouver l'utilisateur par email
                $user = \App\Models\User::where('email', $session->customer_email)->first();

                $paiement = Paiement::create([
                    'user_id' => $user ? $user->id : null,
                    'formation_id' => $formationId,
                    'reference' => $paiementReference,
                    'amount' => $session->amount_total / 100,
                    'currency' => $session->currency,
                    'status' => 'paid',
                    'stripe_session_id' => $session->id,
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'stripe_response' => json_decode(json_encode($session), true),
                    'customer_info' => [
                        'email' => $session->customer_email,
                        'name' => $session->customer_details->name ?? null,
                    ],
                    'paid_at' => now(),
                ]);

                Log::info('Paiement créé via webhook:', ['reference' => $paiement->reference]);
            } else {
                $paiement->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);
                Log::info('Paiement mis à jour via webhook:', ['reference' => $paiement->reference]);
            }

            // Accorder l'accès à la formation
            $this->grantFormationAccessFromWebhook($paiement);

            Log::info('=== FIN handleCheckoutSessionCompleted ===');
        } catch (\Exception $e) {
            Log::error('Erreur traitement webhook Stripe: ' . $e->getMessage());
        }
    }

    /**
     * Gérer le payment intent succeeded
     */
    private function handlePaymentIntentSucceeded($paymentIntent)
    {
        Log::info('Payment intent succeeded: ' . $paymentIntent->id);
    }

    /**
     * Accorder l'accès à la formation depuis le webhook
     */
    private function grantFormationAccessFromWebhook(Paiement $paiement)
    {
        Log::info('=== DÉBUT grantFormationAccessFromWebhook ===');

        try {
            $user = $paiement->user;
            if (!$user && $paiement->customer_info['email']) {
                $user = \App\Models\User::where('email', $paiement->customer_info['email'])->first();
                if ($user) {
                    $paiement->update(['user_id' => $user->id]);
                    Log::info('Utilisateur trouvé et associé au paiement: ' . $user->email);
                }
            }

            if ($user) {
                // Vérifier si l'utilisateur a déjà accès à cette formation
                $alreadyHasAccess = UserFormation::where('user_id', $user->id)
                    ->where('formation_id', $paiement->formation_id)
                    ->where('status', 'active')
                    ->exists();

                if (!$alreadyHasAccess) {
                    // Créer l'accès utilisateur
                    UserFormation::create([
                        'user_id' => $user->id,
                        'formation_id' => $paiement->formation_id,
                        'paiement_id' => $paiement->id,
                        'status' => 'active',
                        'access_start' => now(),
                        'access_end' => now()->addYear(),
                        'progress' => 0,
                    ]);

                    Log::info('Accès à la formation créé pour l\'utilisateur: ' . $user->email);

                    // Envoyer un email de confirmation
                    // Mail::to($user->email)
                    //     ->send(new \App\Mail\FormationPurchaseConfirmation($paiement));
                } else {
                    Log::info('L\'utilisateur a déjà accès à cette formation: ' . $user->email);
                }
            } else {
                Log::warning('Aucun utilisateur trouvé pour le paiement: ' . $paiement->reference);
            }
        } catch (\Exception $e) {
            Log::error('Erreur attribution accès formation: ' . $e->getMessage());
        }

        Log::info('=== FIN grantFormationAccessFromWebhook ===');
    }
}
