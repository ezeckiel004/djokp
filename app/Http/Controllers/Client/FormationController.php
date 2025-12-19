<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\UserFormation;
use App\Models\Paiement;
use App\Models\Participant;
use App\Models\FormationMedia;
use App\Services\StripeService;
// Même importation que le contrôleur public
use App\Mail\ElearningPurchaseConfirmation;
use App\Mail\ElearningPurchaseAdminNotification;
use App\Mail\FormationInscriptionConfirmation;
use App\Mail\FormationInscriptionAdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FormationController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Afficher les formations du client
     */
    public function index()
    {
        $user = Auth::user();

        $userFormations = UserFormation::where('user_id', $user->id)
            ->with(['formation' => function ($query) {
                $query->withCount('media');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Statistiques
        $stats = [
            'total' => $userFormations->total(),
            'actives' => UserFormation::where('user_id', $user->id)
                ->where('status', 'active')
                ->count(),
            'en_attente' => UserFormation::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count(),
            'terminees' => UserFormation::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
        ];

        return view('client.formations.index', compact('userFormations', 'stats'));
    }

    /**
     * Catalogue des formations disponibles
     */
    public function catalogue()
    {
        $user = Auth::user();

        // Récupérer toutes les formations actives
        $formations = Formation::where('is_active', true)
            ->with(['media' => function ($query) {
                $query->where('type', 'video')
                    ->orderBy('order')
                    ->limit(1);
            }])
            ->orderBy('created_at', 'desc')
            ->get();

        // Filtrer par type
        $formationsPresentiel = $formations->where('type_formation', 'presentiel');
        $formationsElearning = $formations->where('type_formation', 'e_learning');
        $formationsMixte = $formations->where('type_formation', 'mixte');

        // Vérifier les formations déjà achetées
        $formationsAcheteesIds = UserFormation::where('user_id', $user->id)
            ->pluck('formation_id')
            ->toArray();

        return view('client.formations.catalogue', compact(
            'formationsPresentiel',
            'formationsElearning',
            'formationsMixte',
            'formationsAcheteesIds'
        ));
    }

    /**
     * Détails d'une formation du catalogue
     */
    public function showCatalogueDetails(Formation $formation)
    {
        if (!$formation->is_active) {
            abort(404);
        }

        $user = Auth::user();

        // Vérifier si déjà inscrit
        $dejaInscrit = UserFormation::where('user_id', $user->id)
            ->where('formation_id', $formation->id)
            ->exists();

        // Récupérer les médias
        $formation->load(['media' => function ($query) {
            $query->orderBy('order');
        }]);

        return view('client.formations.catalogue.details', compact('formation', 'dejaInscrit'));
    }

    /**
     * Page d'inscription à une formation
     */
    public function inscrire(Formation $formation)
    {
        $user = Auth::user();

        // Vérifications
        if (!$formation->is_active) {
            return redirect()->route('client.formations.catalogue')
                ->with('error', 'Cette formation n\'est plus disponible.');
        }

        // Vérifier si déjà inscrit
        $dejaInscrit = UserFormation::where('user_id', $user->id)
            ->where('formation_id', $formation->id)
            ->exists();

        if ($dejaInscrit) {
            return redirect()->route('client.formations.index')
                ->with('info', 'Vous êtes déjà inscrit à cette formation.');
        }

        return view('client.formations.inscrire', compact('formation', 'user'));
    }

    /**
     * Traiter l'inscription à une formation
     */
    public function storeInscription(Request $request, Formation $formation)
    {
        $user = Auth::user();

        Log::info('=== DÉBUT INSCRIPTION CLIENT ===', [
            'user_id' => $user->id,
            'formation_id' => $formation->id,
            'type_formation' => $formation->type_formation,
        ]);

        // Validation de base
        $rules = [
            'terms' => 'required|accepted',
        ];

        // Validation spécifique selon le type de formation
        if ($formation->type_formation === 'presentiel' || $formation->type_formation === 'mixte') {
            $rules = array_merge($rules, [
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'telephone' => 'required|string|max:20',
                'adresse' => 'required|string|max:500',
                'ville' => 'required|string|max:100',
                'code_postal' => 'required|string|max:10',
                'date_naissance' => 'required|date|before:-18 years',
                'permis_date' => 'required|date|before:today',
                'financement' => 'required|in:perso,cpf,pole_emploi',
                'message' => 'nullable|string|max:1000',
            ]);
        }

        $validated = $request->validate($rules);

        try {
            // Traitement selon le type de formation
            switch ($formation->type_formation) {
                case 'e_learning':
                    return $this->processElearning($user, $formation, $validated);

                case 'presentiel':
                    return $this->processPresentiel($user, $formation, $validated);

                case 'mixte':
                    return $this->processMixte($user, $formation, $validated);

                default:
                    throw new \Exception('Type de formation non supporté');
            }
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'inscription', [
                'user_id' => $user->id,
                'formation_id' => $formation->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'inscription : ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Traiter l'inscription e-learning
     */
    private function processElearning($user, $formation, $data)
    {
        Log::info('Traitement inscription e-learning', [
            'user_id' => $user->id,
            'formation_id' => $formation->id,
            'price' => $formation->price,
        ]);

        // Vérifier que la formation a un produit Stripe
        if (!$formation->stripe_price_id) {
            Log::info('Création du produit Stripe...');
            $this->stripeService->createProductForFormation($formation);
            $formation->refresh();
        }

        // Créer un paiement en attente
        $paiement = Paiement::create([
            'user_id' => $user->id,
            'formation_id' => $formation->id,
            'reference' => 'PAY_' . Str::upper(Str::random(10)),
            'amount' => $formation->price,
            'currency' => 'eur',
            'status' => 'pending',
            'customer_info' => [
                'email' => $user->email,
                'name' => $user->name,
                'telephone' => $user->telephone ?? '',
            ],
        ]);

        Log::info('Paiement créé', [
            'paiement_id' => $paiement->id,
            'reference' => $paiement->reference,
        ]);

        // Créer un participant en attente (comme dans le contrôleur public)
        Participant::create([
            'formation_id' => $formation->id,
            'user_id' => $user->id,
            'paiement_id' => $paiement->id,
            'nom' => $user->name,
            'prenom' => '',
            'email' => $user->email,
            'type_formation' => 'en_ligne',
            'statut' => 'en_attente',
            'donnees_supplementaires' => [
                'inscription_date' => now()->format('Y-m-d H:i:s'),
                'formation_title' => $formation->title,
                'paiement_reference' => $paiement->reference,
                'type_paiement' => 'e_learning',
                'terms_accepted' => true,
                'source' => 'client_dashboard',
            ],
        ]);

        // Créer la session de paiement Stripe (comme dans le contrôleur public)
        $metadata = [
            'paiement_reference' => $paiement->reference,
            'formation_id' => $formation->id,
            'formation_title' => $formation->title,
            'customer_email' => $user->email,
            'customer_id' => $user->id,
            'source' => 'client_dashboard',
        ];

        $session = $this->stripeService->createCheckoutSession(
            $formation,
            $user->email,
            $metadata
        );

        // Mettre à jour le paiement avec l'ID de session
        $paiement->update([
            'stripe_session_id' => $session->id,
        ]);

        Log::info('Session Stripe créée', [
            'session_id' => $session->id,
            'url' => $session->url,
        ]);

        // Rediriger vers Stripe
        return redirect()->away($session->url);
    }

    /**
     * Traiter l'inscription présentiel (adapté du contrôleur public)
     */
    private function processPresentiel($user, $formation, $data)
    {
        Log::info('Traitement inscription présentiel', [
            'user_id' => $user->id,
            'formation_id' => $formation->id,
        ]);

        // Créer le participant (même structure que contrôleur public)
        $participant = Participant::create([
            'formation_id' => $formation->id,
            'user_id' => $user->id,
            'paiement_id' => null,
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'email' => $user->email,
            'telephone' => $data['telephone'],
            'adresse' => $data['adresse'],
            'ville' => $data['ville'],
            'code_postal' => $data['code_postal'],
            'date_naissance' => $data['date_naissance'],
            'permis_date' => $data['permis_date'],
            'type_formation' => 'presentiel',
            'statut' => 'en_attente',
            'progression' => 0,
            'notes' => $data['message'] ?? null,
            'donnees_supplementaires' => [
                'financement' => $data['financement'],
                'inscription_date' => now()->format('Y-m-d H:i:s'),
                'formation_title' => $formation->title,
                'formation_price' => $formation->price,
                'formation_duree' => $formation->duree,
                'formation_format' => $formation->format_affichage,
                'frais_examen' => $formation->frais_examen,
                'location_vehicule' => $formation->location_vehicule,
                'terms_accepted' => true,
                'source' => 'client_dashboard',
            ],
        ]);

        Log::info('Participant présentiel créé', [
            'participant_id' => $participant->id,
        ]);

        // ENVOI DES EMAILS (identique au contrôleur public)
        try {
            // 1. Email de confirmation à l'intéressé
            Mail::to($user->email)->send(new FormationInscriptionConfirmation($participant, $formation));
            Log::info('Email de confirmation envoyé à: ' . $user->email);

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

        return redirect()->route('client.formations.index')
            ->with('success', 'Votre inscription a été envoyée avec succès. Un email de confirmation vous a été envoyé.');
    }

    /**
     * Traiter l'inscription mixte
     */
    private function processMixte($user, $formation, $data)
    {
        Log::info('Traitement inscription mixte', [
            'user_id' => $user->id,
            'formation_id' => $formation->id,
        ]);

        // Pour le moment, traiter comme du présentiel
        return $this->processPresentiel($user, $formation, $data);
    }

    /**
     * Créer un paiement direct (alternative)
     */
    public function createPayment(Request $request, Formation $formation)
    {
        $user = Auth::user();

        if ($formation->type_formation !== 'e_learning') {
            return response()->json([
                'error' => 'Cette formation ne nécessite pas de paiement en ligne.'
            ], 400);
        }

        try {
            // Vérifier que la formation a un produit Stripe
            if (!$formation->stripe_price_id) {
                $this->stripeService->createProductForFormation($formation);
                $formation->refresh();
            }

            // Créer un paiement en attente
            $paiement = Paiement::create([
                'user_id' => $user->id,
                'formation_id' => $formation->id,
                'reference' => 'PAY_' . Str::upper(Str::random(10)),
                'amount' => $formation->price,
                'currency' => 'eur',
                'status' => 'pending',
                'customer_info' => [
                    'email' => $user->email,
                    'name' => $user->name,
                ],
            ]);

            // Créer la session Stripe
            $metadata = [
                'paiement_reference' => $paiement->reference,
                'formation_id' => $formation->id,
                'formation_title' => $formation->title,
                'customer_email' => $user->email,
                'customer_id' => $user->id,
                'source' => 'client_dashboard_ajax',
            ];

            $session = $this->stripeService->createCheckoutSession(
                $formation,
                $user->email,
                $metadata
            );

            $paiement->update([
                'stripe_session_id' => $session->id,
            ]);

            return response()->json([
                'sessionId' => $session->id,
                'url' => $session->url,
                'success' => true
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur création paiement', [
                'error' => $e->getMessage(),
                'formation_id' => $formation->id,
                'user_id' => $user->id,
            ]);

            return response()->json([
                'error' => 'Erreur lors de la création du paiement: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Succès du paiement (adapté du contrôleur public)
     */
    public function paymentSuccess(Request $request)
    {
        Log::info('=== SUCCÈS PAIEMENT CLIENT ===', $request->all());

        $sessionId = $request->get('session_id');

        if (!$sessionId) {
            return redirect()->route('client.formations.catalogue')
                ->with('error', 'Session de paiement invalide.');
        }

        try {
            // Récupérer la session Stripe
            $session = $this->stripeService->retrieveSession($sessionId);

            // Trouver le paiement
            $paiement = Paiement::where('stripe_session_id', $sessionId)->first();

            if (!$paiement) {
                Log::info('Création d\'un nouveau paiement à partir des données Stripe');

                $formationId = $session->metadata->formation_id ?? null;
                $formation = Formation::find($formationId);

                if (!$formation) {
                    Log::error('Formation non trouvée pour l\'ID: ' . $formationId);
                    return redirect()->route('client.formations.catalogue')
                        ->with('error', 'Formation non trouvée.');
                }

                $paiement = Paiement::create([
                    'reference' => $session->metadata->paiement_reference ?? 'PAY_' . Str::upper(Str::random(10)),
                    'formation_id' => $formation->id,
                    'user_id' => Auth::id(),
                    'amount' => $session->amount_total / 100,
                    'currency' => $session->currency,
                    'status' => 'paid',
                    'stripe_session_id' => $sessionId,
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'stripe_response' => json_decode(json_encode($session), true),
                    'customer_info' => [
                        'email' => Auth::user()->email,
                        'name' => Auth::user()->name,
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

            // Mettre à jour le participant
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

            // Message de succès
            $formationTitle = $paiement->formation->title;
            $successMessage = 'Félicitations ! Votre paiement de ' .
                number_format($paiement->amount, 2, ',', ' ') .
                ' € a été accepté. Vous avez maintenant accès à la formation "' .
                $formationTitle . '". Votre référence de paiement : ' . $paiement->reference;

            return redirect()->route('client.formations.index')
                ->with('success', $successMessage)
                ->with('payment_completed', true);
        } catch (\Exception $e) {
            Log::error('Erreur succès paiement', [
                'error' => $e->getMessage(),
                'session_id' => $sessionId,
            ]);

            return redirect()->route('client.formations.catalogue')
                ->with('error', 'Erreur lors de la validation du paiement.');
        }
    }

    /**
     * Accorder l'accès à la formation et envoyer les emails (adapté du contrôleur public)
     */
    private function grantFormationAccess(Paiement $paiement)
    {
        Log::info('=== DÉBUT grantFormationAccess CLIENT ===');
        Log::info('Paiement:', [
            'reference' => $paiement->reference,
            'formation_id' => $paiement->formation_id,
            'user_id' => $paiement->user_id,
            'customer_email' => $paiement->customer_info['email'] ?? 'N/A',
        ]);

        $user = $paiement->user ?? Auth::user();

        if (!$user) {
            Log::warning('Aucun utilisateur trouvé pour le paiement');
            return;
        }

        $userFormation = null;

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

        // ENVOI DES EMAILS POUR L'E-LEARNING (identique au contrôleur public)
        try {
            $formation = $paiement->formation;
            $emailSent = false;

            // 1. Email de confirmation au client
            $clientEmail = $user->email;

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

        Log::info('=== FIN grantFormationAccess CLIENT ===');
    }

    /**
     * Annulation du paiement
     */
    public function paymentCancel()
    {
        return view('client.formations.payment-cancel');
    }

    /**
     * Télécharger un média
     */
    public function downloadMedia(UserFormation $userFormation, FormationMedia $media)
    {
        $user = Auth::user();

        // Vérifier les permissions
        if ($userFormation->user_id !== $user->id) {
            abort(403, 'Accès non autorisé.');
        }

        if ($userFormation->formation_id !== $media->formation_id) {
            abort(404, 'Média non trouvé pour cette formation.');
        }

        if ($userFormation->status !== 'active') {
            return redirect()->route('client.formations.show', $userFormation->id)
                ->with('error', 'Votre accès à cette formation n\'est pas actif.');
        }

        // Vérifier que le fichier existe
        if (!Storage::disk('public')->exists($media->file_path)) {
            abort(404, 'Fichier non trouvé.');
        }

        // Incrémenter le compteur de téléchargements
        $media->increment('download_count');

        Log::info('Téléchargement média', [
            'user_id' => $user->id,
            'media_id' => $media->id,
            'file_path' => $media->file_path,
        ]);

        // Retourner le fichier
        return Storage::disk('public')->download($media->file_path, $media->file_name);
    }

    /**
     * Afficher les détails d'une formation achetée
     */
    public function show($id)
    {
        $user = Auth::user();

        // Chercher la UserFormation
        $userFormation = UserFormation::with(['formation', 'paiement'])
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Récupérer les statistiques de progression
        $progression = $this->calculateProgression($userFormation);

        return view('client.formations.show', compact('userFormation', 'progression'));
    }

    /**
     * Calculer la progression
     */
    private function calculateProgression($userFormation)
    {
        // Logique de calcul de progression
        // À adapter selon vos besoins
        $totalMedias = $userFormation->formation->media()->count();
        $mediasVus = 0; // À implémenter avec une table de suivi

        if ($totalMedias > 0) {
            $pourcentage = ($mediasVus / $totalMedias) * 100;
        } else {
            $pourcentage = 0;
        }

        return [
            'total' => $totalMedias,
            'vus' => $mediasVus,
            'pourcentage' => round($pourcentage, 1),
        ];
    }

    /**
     * Accéder à une formation achetée
     */
    public function acceder($id)
    {
        $user = Auth::user();

        $userFormation = UserFormation::with('formation')
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Vérifier l'accès
        if ($userFormation->status !== 'active') {
            return redirect()->route('client.formations.show', $userFormation->id)
                ->with('error', 'Cette formation n\'est pas active.');
        }

        if ($userFormation->access_end && $userFormation->access_end < now()) {
            return redirect()->route('client.formations.show', $userFormation->id)
                ->with('error', 'Votre accès a expiré.');
        }

        // Récupérer les médias
        $formation = $userFormation->formation;
        $medias = $formation->media()
            ->orderBy('order')
            ->get();

        return view('client.formations.acceder', compact('userFormation', 'formation', 'medias'));
    }

    /**
     * Afficher le compte rendu
     */
    public function compteRendu($id)
    {
        $user = Auth::user();

        $userFormation = UserFormation::with('formation')
            ->where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Logique pour générer le compte rendu
        // À adapter selon vos besoins

        return view('client.formations.compte-rendu', compact('userFormation'));
    }
}
