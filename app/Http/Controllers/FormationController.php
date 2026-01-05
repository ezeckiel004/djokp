<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Paiement;
use App\Models\UserFormation;
use App\Models\Participant;
use App\Services\StripeService;
use App\Mail\ElearningPurchaseConfirmation;
use App\Mail\ElearningPurchaseAdminNotification;
use App\Mail\FormationInscriptionConfirmation;
use App\Mail\FormationInscriptionAdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FormationController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Afficher la page formation
     */
    public function index()
    {
        $formations = Formation::with(['media' => function ($query) {
            $query->orderBy('order');
        }])
            ->where('is_active', true)
            ->orderBy('price')
            ->get();

        return view('formation', compact('formations'));
    }

    /**
     * Afficher une formation spécifique
     */
    public function show($slug)
    {
        $formation = Formation::with(['media' => function ($query) {
            $query->orderBy('order');
        }])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Vérifier si l'utilisateur connecté a accès à cette formation
        $hasAccess = false;
        $userFormation = null;

        if (auth()->check()) {
            $userFormation = UserFormation::where('user_id', auth()->id())
                ->where('formation_id', $formation->id)
                ->where('status', 'active')
                ->first();

            $hasAccess = !is_null($userFormation);
        }

        return view('formations.show', compact('formation', 'hasAccess', 'userFormation'));
    }

    /**
     * Page d'inscription pour présentiel
     */
    public function inscrirePresentiel($id)
    {
        $formation = Formation::where('id', $id)
            ->where('type_formation', 'presentiel')
            ->where('is_active', true)
            ->firstOrFail();

        return view('formations.inscrire-presentiel', compact('formation'));
    }

    /**
     * Traiter l'inscription présentiel
     */
    public function storeInscriptionPresentiel(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'code_postal' => 'required|string',
            'date_naissance' => 'required|date',
            'permis_date' => 'required|date',
            'message' => 'nullable|string',
            'financement' => 'required|in:perso,cpf,pole_emploi',
            'terms' => 'required|accepted',
        ]);

        try {
            $user = auth()->user();

            // Créer le participant
            $participant = Participant::create([
                'formation_id' => $formation->id,
                'user_id' => $user ? $user->id : null,
                'paiement_id' => null,
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'adresse' => $validated['adresse'],
                'ville' => $validated['ville'],
                'code_postal' => $validated['code_postal'],
                'date_naissance' => $validated['date_naissance'],
                'permis_date' => $validated['permis_date'],
                'type_formation' => 'presentiel',
                'statut' => 'en_attente',
                'progression' => 0,
                'notes' => $validated['message'] ?? null,
                'donnees_supplementaires' => [
                    'financement' => $validated['financement'],
                    'inscription_date' => now()->format('Y-m-d H:i:s'),
                    'formation_title' => $formation->title,
                    'formation_price' => $formation->price,
                    'formation_duree' => $formation->duree,
                    'formation_format' => $formation->format_affichage,
                    'frais_examen' => $formation->frais_examen,
                ],
            ]);

            Log::info('Nouvelle inscription présentielle', [
                'participant_id' => $participant->id,
                'formation_id' => $formation->id,
                'email' => $validated['email'],
            ]);

            // ENVOI DES EMAILS (sans queues)
            try {
                // 1. Email de confirmation à l'intéressé
                Mail::to($validated['email'])->send(new FormationInscriptionConfirmation($participant, $formation));
                Log::info('Email de confirmation envoyé à: ' . $validated['email']);

                // 2. Email de notification à l'admin
                $adminEmail = config('mail.admin_email', 'formation@djokprestige.com');
                Mail::to($adminEmail)->send(new FormationInscriptionAdminNotification($participant, $formation));
                Log::info('Email de notification envoyé à l\'admin: ' . $adminEmail);
            } catch (\Exception $emailException) {
                Log::error('Erreur lors de l\'envoi des emails', [
                    'error' => $emailException->getMessage(),
                    'participant_id' => $participant->id,
                ]);
                // On ne bloque pas l'inscription si l'email échoue
            }

            return redirect()->route('formation')
                ->with('success', 'Votre inscription a été envoyée avec succès. Un email de confirmation vous a été envoyé.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'inscription présentielle', [
                'error' => $e->getMessage(),
                'formation_id' => $id,
                'email' => $validated['email'] ?? 'N/A',
            ]);

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de votre inscription. Veuillez réessayer ou nous contacter.')
                ->withInput();
        }
    }

    /**
     * Page d'achat pour e-learning
     */
    public function acheterElearning($id)
    {
        $formation = Formation::where('id', $id)
            ->where('type_formation', 'e_learning')
            ->where('is_active', true)
            ->firstOrFail();

        // Vérifier si l'utilisateur a déjà acheté cette formation
        if (auth()->check()) {
            $hasAccess = UserFormation::where('user_id', auth()->id())
                ->where('formation_id', $formation->id)
                ->where('status', 'active')
                ->exists();

            if ($hasAccess) {
                return redirect()->route('dashboard')
                    ->with('info', 'Vous avez déjà accès à cette formation.');
            }
        }

        return view('formations.acheter-elearning', compact('formation'));
    }

    /**
     * Créer une session de paiement Stripe
     */
    public function createPaymentSession(Request $request, $id)
    {
        Log::info('=== DÉBUT createPaymentSession ===');
        Log::info('ID formation: ' . $id);
        Log::info('Utilisateur connecté: ' . (auth()->check() ? auth()->user()->email : 'non connecté'));
        Log::info('Données reçues:', $request->all());

        try {
            $formation = Formation::where('id', $id)
                ->where('type_formation', 'e_learning')
                ->where('is_active', true)
                ->firstOrFail();

            Log::info('Formation trouvée:', [
                'id' => $formation->id,
                'title' => $formation->title,
                'price' => $formation->price,
                'stripe_price_id' => $formation->stripe_price_id,
            ]);

            // S'assurer que la formation a un produit Stripe
            if (!$formation->stripe_price_id) {
                Log::info('Création du produit Stripe pour la formation...');
                $result = $this->stripeService->createProductForFormation($formation);
                Log::info('Résultat création produit:', ['success' => $result]);
                $formation->refresh();
                Log::info('Formation après refresh - stripe_price_id:', ['stripe_price_id' => $formation->stripe_price_id]);
            }

            // Récupérer l'email de l'utilisateur
            $userEmail = null;
            $userName = null;

            if (auth()->check()) {
                $userEmail = auth()->user()->email;
                $userName = auth()->user()->name;
                Log::info('Utilisateur connecté - email: ' . $userEmail . ', nom: ' . $userName);
            } else {
                $userEmail = $request->email;
                $userName = $request->nom;
                Log::info('Utilisateur non connecté - email fourni: ' . $userEmail . ', nom: ' . $userName);
            }

            if (!$userEmail) {
                Log::error('Email non disponible pour la création de la session');
                return response()->json([
                    'error' => 'Email requis pour le paiement'
                ], 400);
            }

            // Créer un paiement en attente
            $paiement = Paiement::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'formation_id' => $formation->id,
                'reference' => 'PAY_' . Str::upper(Str::random(10)),
                'amount' => $formation->price,
                'currency' => 'eur',
                'status' => 'pending',
                'customer_info' => [
                    'email' => $userEmail,
                    'name' => $userName,
                ],
            ]);

            Log::info('Paiement créé:', [
                'reference' => $paiement->reference,
                'amount' => $paiement->amount,
                'status' => $paiement->status,
            ]);

            // Créer un participant en attente pour l'e-learning
            if (auth()->check()) {
                Participant::create([
                    'formation_id' => $formation->id,
                    'user_id' => auth()->id(),
                    'paiement_id' => $paiement->id,
                    'nom' => auth()->user()->name,
                    'prenom' => '',
                    'email' => auth()->user()->email,
                    'type_formation' => 'en_ligne',
                    'statut' => 'en_attente',
                    'donnees_supplementaires' => [
                        'inscription_date' => now()->format('Y-m-d H:i:s'),
                        'formation_title' => $formation->title,
                        'paiement_reference' => $paiement->reference,
                        'type_paiement' => 'e_learning',
                    ],
                ]);
            } else {
                Participant::create([
                    'formation_id' => $formation->id,
                    'user_id' => null,
                    'paiement_id' => $paiement->id,
                    'nom' => $userName,
                    'prenom' => '',
                    'email' => $userEmail,
                    'type_formation' => 'en_ligne',
                    'statut' => 'en_attente',
                    'donnees_supplementaires' => [
                        'inscription_date' => now()->format('Y-m-d H:i:s'),
                        'formation_title' => $formation->title,
                        'paiement_reference' => $paiement->reference,
                        'type_paiement' => 'e_learning',
                    ],
                ]);
            }

            Log::info('Participant créé pour l\'e-learning');

            // Créer la session Stripe
            $metadata = [
                'paiement_reference' => $paiement->reference,
                'formation_id' => $formation->id,
                'formation_title' => $formation->title,
                'customer_email' => $userEmail,
            ];

            Log::info('Création de la session Stripe avec metadata:', $metadata);

            $session = $this->stripeService->createCheckoutSession(
                $formation,
                $userEmail,
                $metadata
            );

            Log::info('Session Stripe créée:', [
                'session_id' => $session->id,
                'url' => $session->url,
                'payment_intent_id' => $session->payment_intent ?? 'N/A',
            ]);

            // Mettre à jour le paiement avec l'ID de session
            $paiement->update([
                'stripe_session_id' => $session->id,
            ]);

            Log::info('=== FIN createPaymentSession - Succès ===');

            return response()->json([
                'sessionId' => $session->id,
                'url' => $session->url,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur dans createPaymentSession:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Une erreur est survenue lors de la création de la session de paiement: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Succès du paiement
     */
    public function paymentSuccess(Request $request)
    {
        Log::info('=== DÉBUT paymentSuccess ===');
        Log::info('Paramètres reçus:', $request->all());

        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            Log::warning('Aucun session_id fourni');
            return redirect()->route('formation')
                ->with('error', 'Session de paiement invalide.');
        }

        try {
            Log::info('Récupération de la session Stripe: ' . $sessionId);

            // Récupérer la session Stripe
            $session = $this->stripeService->retrieveSession($sessionId);

            Log::info('Session Stripe récupérée:', [
                'session_id' => $session->id,
                'payment_status' => $session->payment_status,
                'customer_email' => $session->customer_email ?? 'N/A',
                'amount_total' => $session->amount_total ?? 'N/A',
            ]);

            // Trouver le paiement
            $paiement = Paiement::where('stripe_session_id', $sessionId)->first();

            Log::info('Paiement trouvé dans la base:', [
                'exists' => !is_null($paiement),
                'paiement_reference' => $paiement ? $paiement->reference : 'N/A',
                'status' => $paiement ? $paiement->status : 'N/A',
            ]);

            if (!$paiement) {
                Log::info('Création d\'un nouveau paiement à partir des données Stripe');

                $formationId = $session->metadata->formation_id ?? null;
                $formation = Formation::find($formationId);

                if (!$formation) {
                    Log::error('Formation non trouvée pour l\'ID: ' . $formationId);
                    return redirect()->route('formation')
                        ->with('error', 'Formation non trouvée.');
                }

                $paiement = Paiement::create([
                    'reference' => $session->metadata->paiement_reference ?? 'PAY_' . Str::upper(Str::random(10)),
                    'formation_id' => $formation->id,
                    'amount' => $session->amount_total / 100,
                    'currency' => $session->currency,
                    'status' => 'paid',
                    'stripe_session_id' => $sessionId,
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'stripe_response' => json_decode(json_encode($session), true),
                    'customer_info' => [
                        'email' => $session->customer_email,
                        'name' => $session->customer_details->name ?? null,
                    ],
                    'paid_at' => now(),
                ]);

                Log::info('Nouveau paiement créé:', ['reference' => $paiement->reference]);
            } elseif ($paiement->status !== 'paid') {
                Log::info('Mise à jour du paiement existant vers "paid"');

                $paiement->update([
                    'status' => 'paid',
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'stripe_response' => json_decode(json_encode($session), true),
                    'paid_at' => now(),
                ]);

                Log::info('Paiement mis à jour avec succès');
            } else {
                Log::info('Paiement déjà marqué comme "paid"');
            }

            // Mettre à jour le statut du participant
            $participant = Participant::where('paiement_id', $paiement->id)->first();
            if ($participant) {
                $participant->update([
                    'statut' => 'confirme',
                    'date_debut' => now(),
                    'date_fin' => now()->addYear(),
                ]);
                Log::info('Statut du participant mis à jour:', [
                    'participant_id' => $participant->id,
                    'statut' => 'confirme',
                ]);
            }

            // Accorder l'accès à la formation et envoyer les emails
            Log::info('Tentative d\'accorder l\'accès à la formation...');
            $this->grantFormationAccess($paiement);
            Log::info('Accès à la formation accordé avec succès');

            // Message de succès détaillé
            $formationTitle = $paiement->formation->title;
            $successMessage = 'Félicitations ! Votre paiement de ' . number_format($paiement->amount, 2, ',', ' ') . ' € a été accepté.';
            $successMessage .= ' Vous avez maintenant accès à la formation "' . $formationTitle . '".';
            $successMessage .= ' Votre référence de paiement : ' . $paiement->reference;

            // Stocker les informations pour le dashboard
            session([
                'payment_success' => true,
                'payment_message' => $successMessage,
                'formation_title' => $formationTitle,
                'payment_reference' => $paiement->reference,
                'payment_amount' => $paiement->amount,
            ]);

            Log::info('=== FIN paymentSuccess - Redirection avec succès ===');
            Log::info('Message de succès:', ['message' => $successMessage]);

            // Rediriger vers le dashboard général qui redirigera vers client.dashboard
            return redirect()->route('dashboard')
                ->with('success', $successMessage)
                ->with('payment_completed', true);
        } catch (\Exception $e) {
            Log::error('Erreur paymentSuccess Stripe: ' . $e->getMessage(), [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('formation')
                ->with('error', 'Nous n\'avons pas pu valider votre paiement. Veuillez contacter notre support.');
        }
    }

    /**
     * Accorder l'accès à la formation et envoyer les emails
     */
    private function grantFormationAccess(Paiement $paiement)
    {
        Log::info('=== DÉBUT grantFormationAccess ===');
        Log::info('Paiement:', [
            'reference' => $paiement->reference,
            'formation_id' => $paiement->formation_id,
            'user_id' => $paiement->user_id,
            'customer_email' => $paiement->customer_info['email'] ?? 'N/A',
        ]);

        $user = $paiement->user ?? null;
        $emailSent = false;

        if (!$user && isset($paiement->customer_info['email'])) {
            Log::info('Recherche de l\'utilisateur par email: ' . $paiement->customer_info['email']);

            $user = \App\Models\User::where('email', $paiement->customer_info['email'])->first();

            if ($user) {
                Log::info('Utilisateur trouvé par email, mise à jour du paiement avec user_id: ' . $user->id);
                $paiement->update(['user_id' => $user->id]);
            } else {
                Log::warning('Aucun utilisateur trouvé pour l\'email: ' . $paiement->customer_info['email']);
            }
        }

        $userFormation = null;
        if ($user) {
            Log::info('Vérification si l\'utilisateur a déjà accès à cette formation...');

            $userFormation = UserFormation::where('user_id', $user->id)
                ->where('formation_id', $paiement->formation_id)
                ->where('status', 'active')
                ->first();

            if (!$userFormation) {
                Log::info('Création de l\'accès utilisateur à la formation...');

                $userFormation = UserFormation::create([
                    'user_id' => $user->id,
                    'formation_id' => $paiement->formation_id,
                    'paiement_id' => $paiement->id,
                    'status' => 'active',
                    'access_start' => now(),
                    'access_end' => now()->addYear(),
                    'progress' => 0,
                ]);

                Log::info('Accès utilisateur créé avec succès');
            } else {
                Log::info('L\'utilisateur a déjà accès à cette formation');
            }

            // Mettre à jour le participant avec l'user_id
            $participant = Participant::where('paiement_id', $paiement->id)
                ->orWhere('email', $paiement->customer_info['email'] ?? null)
                ->first();

            if ($participant && !$participant->user_id) {
                $participant->update(['user_id' => $user->id]);
                Log::info('Participant mis à jour avec user_id:', ['participant_id' => $participant->id]);
            }
        }

        // ENVOI DES EMAILS POUR L'E-LEARNING
        try {
            $formation = $paiement->formation;

            // 1. Email de confirmation au client
            $clientEmail = $user ? $user->email : ($paiement->customer_info['email'] ?? null);

            if ($clientEmail) {
                Mail::to($clientEmail)->send(new ElearningPurchaseConfirmation($formation, $paiement, $user));
                Log::info('Email de confirmation e-learning envoyé à: ' . $clientEmail);
                $emailSent = true;
            } else {
                Log::warning('Impossible d\'envoyer l\'email de confirmation: email client non disponible');
            }

            // 2. Email de notification à l'admin
            $adminEmail = config('mail.admin_email', 'admin@djokprestige.com');
            Mail::to($adminEmail)->send(new ElearningPurchaseAdminNotification($formation, $paiement, $user, $userFormation, $emailSent));
            Log::info('Email de notification admin e-learning envoyé à: ' . $adminEmail);
        } catch (\Exception $emailException) {
            Log::error('Erreur lors de l\'envoi des emails e-learning', [
                'error' => $emailException->getMessage(),
                'paiement_id' => $paiement->id,
                'formation_id' => $paiement->formation_id,
            ]);
        }

        Log::info('=== FIN grantFormationAccess ===');
    }

    /**
     * Annulation du paiement
     */
    public function paymentCancel()
    {
        Log::info('Paiement annulé par l\'utilisateur');
        return view('formations.payment-cancel');
    }

    /**
     * Webhook Stripe
     */
    public function webhook(Request $request)
    {
        Log::info('=== WEBHOOK STRIPE RECU ===');
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        Log::info('En-tête Stripe-Signature: ' . $sigHeader);
        Log::info('Payload (premiers 500 caractères): ' . substr($payload, 0, 500));

        return $this->stripeService->handleWebhook($payload, $sigHeader);
    }

    /**
     * Mes formations (pour utilisateur connecté) - SUPPRIMER
     */
    public function mesFormations()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userFormations = UserFormation::where('user_id', auth()->id())
            ->with('formation')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('formations.mes-formations', compact('userFormations'));
    }

    /**
     * Accéder à une formation achetée (version publique - redirige vers client)
     */
    public function accederFormation($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Chercher la UserFormation
        $userFormation = UserFormation::where('user_id', $user->id)
            ->where('formation_id', $id)
            ->where('status', 'active')
            ->first();

        if (!$userFormation) {
            // Peut-être que l'ID est un UserFormation ID
            $userFormation = UserFormation::where('user_id', $user->id)
                ->where('id', $id)
                ->where('status', 'active')
                ->first();

            if (!$userFormation) {
                // Rediriger vers le dashboard client
                return redirect()->route('client.dashboard')
                    ->with('error', 'Vous n\'avez pas accès à cette formation.');
            }
        }

        // Rediriger vers la page d'accès de l'espace client
        return redirect()->route('client.formations.acceder', $userFormation->id);
    }

    /**
     * Corriger le slug d'une formation spécifique (accès public)
     */
    public function fixSlug($id)
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé');
        }

        try {
            $formation = Formation::findOrFail($id);
            $oldSlug = $formation->slug;

            // Générer un nouveau slug unique
            $newSlug = Str::slug($formation->title);
            if ($formation->type_formation === 'presentiel') {
                $newSlug .= '-presentiel';
            } elseif ($formation->type_formation === 'e_learning') {
                $newSlug .= '-en-ligne';
            }

            // Vérifier l'unicité du slug
            $originalSlug = $newSlug;
            $counter = 1;

            while (Formation::where('slug', $newSlug)->where('id', '!=', $formation->id)->exists()) {
                $newSlug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $formation->slug = $newSlug;
            $formation->save();

            Log::info('Slug corrigé', [
                'formation_id' => $formation->id,
                'old_slug' => $oldSlug,
                'new_slug' => $newSlug,
                'title' => $formation->title,
                'type_formation' => $formation->type_formation,
            ]);

            return redirect()->back()
                ->with('success', "Slug corrigé : {$oldSlug} → {$newSlug}");
        } catch (\Exception $e) {
            Log::error('Erreur lors de la correction du slug', [
                'formation_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->with('error', "Erreur lors de la correction du slug : {$e->getMessage()}");
        }
    }

    /**
     * Corriger tous les slugs des formations (accès public)
     */
    public function fixAllSlugs()
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé');
        }

        try {
            $formations = Formation::all();
            $updatedCount = 0;
            $errors = [];

            foreach ($formations as $formation) {
                try {
                    $oldSlug = $formation->slug;
                    $newSlug = Str::slug($formation->title);
                    if ($formation->type_formation === 'presentiel') {
                        $newSlug .= '-presentiel';
                    } elseif ($formation->type_formation === 'e_learning') {
                        $newSlug .= '-en-ligne';
                    }

                    // Vérifier l'unicité du slug
                    $originalSlug = $newSlug;
                    $counter = 1;

                    while (Formation::where('slug', $newSlug)->where('id', '!=', $formation->id)->exists()) {
                        $newSlug = $originalSlug . '-' . $counter;
                        $counter++;
                    }

                    if ($oldSlug !== $newSlug) {
                        $formation->slug = $newSlug;
                        $formation->saveQuietly();

                        Log::info('Slug corrigé', [
                            'formation_id' => $formation->id,
                            'old_slug' => $oldSlug,
                            'new_slug' => $newSlug,
                        ]);

                        $updatedCount++;
                    }
                } catch (\Exception $e) {
                    $errors[] = "Formation {$formation->id} ({$formation->title}) : {$e->getMessage()}";
                    Log::error('Erreur lors de la correction du slug', [
                        'formation_id' => $formation->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $message = "{$updatedCount} slugs ont été corrigés avec succès.";

            if (!empty($errors)) {
                $message .= " Erreurs : " . implode(' | ', $errors);
                return redirect()->back()
                    ->with('warning', $message);
            }

            return redirect()->back()
                ->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la correction de tous les slugs', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->with('error', "Erreur lors de la correction des slugs : {$e->getMessage()}");
        }
    }

    /**
     * Vérifier les doublons de slugs (accès public)
     */
    public function checkSlugDuplicates()
    {
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé');
        }

        try {
            $duplicates = Formation::select('slug')
                ->groupBy('slug')
                ->havingRaw('COUNT(*) > 1')
                ->get();

            if ($duplicates->isEmpty()) {
                return redirect()->back()
                    ->with('info', 'Aucun doublon de slug détecté.');
            }

            $duplicateList = [];
            foreach ($duplicates as $dup) {
                $formations = Formation::where('slug', $dup->slug)->get();
                $duplicateList[] = [
                    'slug' => $dup->slug,
                    'formations' => $formations->map(function ($f) {
                        return "ID: {$f->id}, Titre: {$f->title}, Type: {$f->type_formation}";
                    })->implode(' | ')
                ];
            }

            return redirect()->back()
                ->with('warning', 'Doublons détectés : ' .
                    collect($duplicateList)->map(function ($item) {
                        return "Slug '{$item['slug']}' : {$item['formations']}";
                    })->implode('; '));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la vérification des doublons', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()
                ->with('error', "Erreur lors de la vérification des doublons : {$e->getMessage()}");
        }
    }
}
