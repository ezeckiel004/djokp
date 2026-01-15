<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Refund;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\Formation;
use App\Models\User;
use App\Models\UserFormation;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Créer une session de paiement pour n'importe quel service
     */
    public function createPaymentSession($serviceType, $serviceData, $customerData, $metadata = [])
    {
        try {
            Log::info('=== DÉBUT createPaymentSession ===');
            Log::info('Service Type: ' . $serviceType);
            Log::info('Service Data:', $serviceData);
            Log::info('Customer Data:', $customerData);
            Log::info('Metadata:', $metadata);

            // Générer une référence unique
            $reference = 'PAY_' . strtoupper(Str::random(8));

            // URL de succès et d'annulation
            $successUrl = route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancelUrl = route('payment.cancel') . '?session_id={CHECKOUT_SESSION_ID}';

            // Configurer la session Stripe
            $sessionData = [
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $serviceData['service_name'],
                            'description' => $serviceData['description'] ?? null,
                            'metadata' => [
                                'service_type' => $serviceType,
                                'paiement_reference' => $reference,
                            ],
                        ],
                        'unit_amount' => $serviceData['amount'] * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => $successUrl,
                'cancel_url' => $cancelUrl,
                'metadata' => array_merge([
                    'paiement_reference' => $reference,
                    'service_type' => $serviceType,
                ], $metadata),
            ];

            // Ajouter l'email du client s'il est fourni
            if (isset($customerData['email']) && $customerData['email']) {
                $sessionData['customer_email'] = $customerData['email'];
                Log::info('Email client ajouté à la session: ' . $customerData['email']);
            }

            Log::info('Création de la session Stripe avec les données:', $sessionData);

            // Créer la session Stripe
            $session = Session::create($sessionData);

            Log::info('Session Stripe créée:', [
                'session_id' => $session->id,
                'url' => $session->url,
                'payment_intent_id' => $session->payment_intent ?? 'N/A',
            ]);

            Log::info('=== FIN createPaymentSession - Succès ===');

            return [
                'session_id' => $session->id,
                'url' => $session->url,
                'reference' => $reference,
            ];
        } catch (\Exception $e) {
            Log::error('Erreur création session paiement: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Traiter le succès d'un paiement
     */
    public function handlePaymentSuccess($sessionId)
    {
        Log::info('=== DÉBUT handlePaymentSuccess ===');
        Log::info('Session ID: ' . $sessionId);

        try {
            // Récupérer la session Stripe
            $session = Session::retrieve($sessionId);

            Log::info('Session récupérée:', [
                'id' => $session->id,
                'payment_status' => $session->payment_status,
                'customer_email' => $session->customer_email ?? 'N/A',
                'amount_total' => $session->amount_total ?? 'N/A',
                'metadata' => $session->metadata ? $session->metadata->toArray() : [],
            ]);

            if ($session->payment_status !== 'paid') {
                Log::error('Session non payée, statut: ' . $session->payment_status);
                throw new \Exception('Le paiement n\'a pas été effectué');
            }

            // Trouver le paiement
            $paiement = Paiement::where('stripe_session_id', $sessionId)->first();

            if (!$paiement) {
                Log::info('Paiement non trouvé par session_id, création à partir des données Stripe');
                $paiement = $this->createPaiementFromStripeSession($session);
            } else {
                Log::info('Paiement trouvé:', ['reference' => $paiement->reference]);
            }

            // Mettre à jour le paiement
            $paiement->update([
                'status' => 'paid',
                'stripe_payment_intent_id' => $session->payment_intent,
                'stripe_response' => $session->toArray(),
                'paid_at' => now(),
            ]);

            Log::info('Paiement marqué comme payé:', ['reference' => $paiement->reference]);

            // Traiter le service spécifique
            $this->processService($paiement);

            Log::info('=== FIN handlePaymentSuccess - Succès ===');

            return $paiement;
        } catch (\Exception $e) {
            Log::error('Erreur traitement succès paiement: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    /**
     * Créer un paiement à partir d'une session Stripe
     */
    protected function createPaiementFromStripeSession($session)
    {
        $metadata = $session->metadata ? $session->metadata->toArray() : [];
        $serviceType = $metadata['service_type'] ?? 'unknown';

        $paiementData = [
            'reference' => $metadata['paiement_reference'] ?? 'PAY_' . strtoupper(Str::random(8)),
            'service_type' => $serviceType,
            'amount' => $session->amount_total / 100,
            'currency' => $session->currency,
            'status' => 'paid',
            'stripe_session_id' => $session->id,
            'stripe_payment_intent_id' => $session->payment_intent,
            'stripe_response' => $session->toArray(),
            'customer_info' => [
                'email' => $session->customer_email,
                'name' => $session->customer_details->name ?? null,
            ],
            'paid_at' => now(),
        ];

        // Ajouter l'ID du service spécifique
        switch ($serviceType) {
            case 'formation':
                if (isset($metadata['formation_id'])) {
                    $paiementData['service_id'] = $metadata['formation_id'];
                    // Charger la formation pour récupérer les détails
                    $formation = Formation::find($metadata['formation_id']);
                    if ($formation) {
                        $paiementData['service_details'] = [
                            'service_name' => 'Formation e-learning: ' . $formation->title,
                            'description' => 'Accès 12 mois à la formation "' . $formation->title . '"',
                            'formation_data' => $formation->toArray(),
                        ];
                    }
                }
                break;
            case 'reservation':
                if (isset($metadata['reservation_id'])) {
                    $paiementData['reservation_id'] = $metadata['reservation_id'];
                }
                break;
        }

        // Chercher l'utilisateur par email
        if ($session->customer_email) {
            $user = User::where('email', $session->customer_email)->first();
            if ($user) {
                $paiementData['user_id'] = $user->id;
                Log::info('Utilisateur trouvé par email: ' . $user->email);
            }
        }

        $paiement = Paiement::create($paiementData);

        Log::info('Paiement créé à partir de Stripe:', ['reference' => $paiement->reference]);

        return $paiement;
    }

    /**
     * Traiter le service en fonction du type
     */
    protected function processService(Paiement $paiement)
    {
        Log::info('=== DÉBUT processService ===');
        Log::info('Service Type: ' . $paiement->service_type);
        Log::info('Paiement ID: ' . $paiement->id);

        try {
            switch ($paiement->service_type) {
                case 'formation':
                    $this->processFormationPayment($paiement);
                    break;
                case 'reservation':
                    $this->processReservationPayment($paiement);
                    break;
                case 'location':
                    $this->processLocationPayment($paiement);
                    break;
                case 'conciergerie':
                    $this->processConciergeriePayment($paiement);
                    break;
                case 'formation_internationale':
                    $this->processFormationInternationalePayment($paiement);
                    break;
                default:
                    Log::warning('Type de service non traité: ' . $paiement->service_type);
            }
        } catch (\Exception $e) {
            Log::error('Erreur dans processService: ' . $e->getMessage(), [
                'paiement_id' => $paiement->id,
                'service_type' => $paiement->service_type,
            ]);
            throw $e;
        }

        Log::info('=== FIN processService ===');
    }

    /**
     * Traiter un paiement pour formation
     */
    protected function processFormationPayment(Paiement $paiement)
    {
        Log::info('=== DÉBUT processFormationPayment ===');

        try {
            $formation = Formation::find($paiement->service_id);

            if (!$formation) {
                Log::error('Formation non trouvée: ' . $paiement->service_id);
                throw new \Exception('Formation non trouvée');
            }

            Log::info('Formation trouvée:', [
                'id' => $formation->id,
                'title' => $formation->title,
                'type' => $formation->type_formation,
            ]);

            $user = $paiement->user;

            if (!$user && $paiement->customer_email) {
                $user = User::where('email', $paiement->customer_email)->first();
                if ($user) {
                    $paiement->update(['user_id' => $user->id]);
                    Log::info('Utilisateur trouvé et associé: ' . $user->email);
                }
            }

            if ($user) {
                // Vérifier si l'utilisateur a déjà accès
                $alreadyHasAccess = UserFormation::where('user_id', $user->id)
                    ->where('formation_id', $formation->id)
                    ->where('status', 'active')
                    ->exists();

                if (!$alreadyHasAccess) {
                    $userFormation = UserFormation::create([
                        'user_id' => $user->id,
                        'formation_id' => $formation->id,
                        'paiement_id' => $paiement->id,
                        'status' => 'active',
                        'access_start' => now(),
                        'access_end' => now()->addYear(),
                        'progress' => 0,
                    ]);

                    Log::info('Accès formation créé pour l\'utilisateur: ' . $user->email);
                } else {
                    Log::info('L\'utilisateur a déjà accès à cette formation: ' . $user->email);
                }
            }

            // Créer ou mettre à jour le participant
            $participant = Participant::updateOrCreate(
                [
                    'email' => $paiement->customer_email,
                    'formation_id' => $formation->id,
                ],
                [
                    'user_id' => $user ? $user->id : null,
                    'paiement_id' => $paiement->id,
                    'nom' => $paiement->customer_name,
                    'prenom' => '',
                    'email' => $paiement->customer_email,
                    'type_formation' => 'en_ligne',
                    'statut' => 'confirme',
                    'progression' => 0,
                    'date_debut' => now(),
                    'date_fin' => now()->addYear(),
                    'donnees_supplementaires' => [
                        'paiement_reference' => $paiement->reference,
                        'formation_title' => $formation->title,
                        'access_granted_at' => now()->format('Y-m-d H:i:s'),
                    ],
                ]
            );

            Log::info('Participant créé/mis à jour: ' . $participant->email);

            // ENVOI DES EMAILS DE CONFIRMATION
            $this->sendFormationConfirmationEmails($formation, $paiement, $user);

            Log::info('=== FIN processFormationPayment - Succès ===');
        } catch (\Exception $e) {
            Log::error('Erreur traitement paiement formation: ' . $e->getMessage(), [
                'paiement_id' => $paiement->id,
                'formation_id' => $paiement->service_id,
            ]);
            throw $e;
        }
    }

    /**
     * Envoyer les emails de confirmation pour formation
     */
    protected function sendFormationConfirmationEmails($formation, $paiement, $user)
    {
        try {
            $clientEmail = $user ? $user->email : $paiement->customer_email;

            if (!$clientEmail) {
                Log::warning('Impossible d\'envoyer l\'email: email client non disponible');
                return;
            }

            // Email au client
            Mail::to($clientEmail)->send(new \App\Mail\ElearningPurchaseConfirmation($formation, $paiement, $user));
            Log::info('Email de confirmation e-learning envoyé à: ' . $clientEmail);

            // Notification admin
            $adminEmail = config('mail.admin_email', 'admin@djokprestige.com');
            Mail::to($adminEmail)->send(new \App\Mail\ElearningPurchaseAdminNotification($formation, $paiement, $user));
            Log::info('Email de notification admin envoyé à: ' . $adminEmail);
        } catch (\Exception $e) {
            Log::error('Erreur envoi emails confirmation formation: ' . $e->getMessage());
            // Ne pas relancer l'erreur, on continue le traitement
        }
    }

    /**
     * Traiter un paiement pour réservation VTC
     */
    protected function processReservationPayment(Paiement $paiement)
    {
        try {
            Log::info('Traitement paiement réservation...');

            $reservation = Reservation::find($paiement->reservation_id);

            if (!$reservation) {
                Log::error('Réservation non trouvée: ' . $paiement->reservation_id);
                return;
            }

            // Mettre à jour la réservation
            $reservation->update([
                'status' => 'confirmed',
                'is_paid' => true,
                'paiement_id' => $paiement->id,
                'total_amount' => $paiement->amount,
            ]);

            Log::info('Réservation mise à jour:', [
                'id' => $reservation->id,
                'reference' => $reservation->reference,
                'status' => 'confirmed',
            ]);

            // Envoyer les emails de confirmation
            $this->sendReservationConfirmation($reservation, $paiement);
        } catch (\Exception $e) {
            Log::error('Erreur traitement paiement réservation: ' . $e->getMessage());
        }
    }

    /**
     * Envoyer la confirmation de réservation
     */
    protected function sendReservationConfirmation($reservation, $paiement)
    {
        try {
            // Email au client
            Mail::to($reservation->email)
                ->send(new \App\Mail\ReservationPaidMail($reservation, $paiement));

            Log::info('Email de confirmation envoyé à: ' . $reservation->email);

            // Notification admin
            $adminEmail = config('mail.admin_email', 'vtc@djokprestige.com');
            Mail::to($adminEmail)
                ->send(new \App\Mail\AdminReservationPaidNotification($reservation, $paiement));

            Log::info('Notification admin envoyée à: ' . $adminEmail);
        } catch (\Exception $e) {
            Log::error('Erreur envoi email confirmation: ' . $e->getMessage());
        }
    }

    /**
     * Gérer le webhook Stripe
     */
    public function handleWebhook($payload, $sigHeader)
    {
        Log::info('=== WEBHOOK PAYMENT RECU ===');

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
            case 'charge.refunded':
                $this->handleChargeRefunded($event->data->object);
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
                'payment_status' => $session->payment_status,
                'amount_total' => $session->amount_total,
            ]);

            if ($session->payment_status !== 'paid') {
                Log::warning('Session non payée, statut: ' . $session->payment_status);
                return;
            }

            $this->handlePaymentSuccess($session->id);

            Log::info('=== FIN handleCheckoutSessionCompleted ===');
        } catch (\Exception $e) {
            Log::error('Erreur traitement session complétée: ' . $e->getMessage());
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
     * Gérer le charge refunded
     */
    private function handleChargeRefunded($charge)
    {
        try {
            Log::info('Remboursement détecté: ' . $charge->id);

            // Trouver le paiement par payment_intent
            $paiement = Paiement::where('stripe_payment_intent_id', $charge->payment_intent)->first();

            if ($paiement) {
                $paiement->update([
                    'status' => 'refunded',
                    'refunded_at' => now(),
                    'refund_data' => $charge->toArray(),
                ]);

                Log::info('Paiement marqué comme remboursé: ' . $paiement->reference);

                // Si c'est une formation, révoquer l'accès
                if ($paiement->isFormation()) {
                    $this->revokeFormationAccess($paiement);
                }
            }
        } catch (\Exception $e) {
            Log::error('Erreur traitement remboursement: ' . $e->getMessage());
        }
    }

    /**
     * Révoquer l'accès à une formation
     */
    private function revokeFormationAccess(Paiement $paiement)
    {
        try {
            // Mettre à jour les UserFormation
            UserFormation::where('paiement_id', $paiement->id)
                ->update(['status' => 'refunded']);

            // Mettre à jour les participants
            Participant::where('paiement_id', $paiement->id)
                ->update(['statut' => 'annule']);

            Log::info('Accès formation révoqué pour le paiement: ' . $paiement->reference);
        } catch (\Exception $e) {
            Log::error('Erreur révocation accès formation: ' . $e->getMessage());
        }
    }

    /**
     * Traiter un paiement pour location
     */
    protected function processLocationPayment(Paiement $paiement)
    {
        Log::info('Traitement paiement location (à implémenter)');
    }

    /**
     * Traiter un paiement pour conciergerie
     */
    protected function processConciergeriePayment(Paiement $paiement)
    {
        Log::info('Traitement paiement conciergerie (à implémenter)');
    }

    /**
     * Traiter un paiement pour formation internationale
     */
    protected function processFormationInternationalePayment(Paiement $paiement)
    {
        Log::info('Traitement paiement formation internationale (à implémenter)');
    }
}
