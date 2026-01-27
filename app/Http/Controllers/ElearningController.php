<?php

namespace App\Http\Controllers;

use App\Models\ElearningForfait;
use App\Models\ElearningAcces;
use App\Models\ElearningCours;
use App\Models\ElearningQcm;
use App\Models\ElearningProgression;
use App\Models\ElearningSession;
use App\Models\Paiement;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ElearningController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Page publique des forfaits e-learning
     */
    public function index()
    {
        $forfaits = ElearningForfait::active()->ordered()->get();

        return view('elearning.index', compact('forfaits'));
    }

    /**
     * Page d'achat d'un forfait
     */
    public function acheter($forfaitSlug)
    {
        Log::info('Accès page achat e-learning', ['slug' => $forfaitSlug]);

        $forfait = ElearningForfait::where('slug', $forfaitSlug)->active()->firstOrFail();

        return view('elearning.acheter', compact('forfait'));
    }

    /**
     * Traitement de l'achat
     */
    public function processPayment(Request $request, $forfaitSlug)
    {
        Log::info('=== DÉBUT processPayment E-learning ===', [
            'forfait_slug' => $forfaitSlug,
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'is_ajax' => $request->ajax(),
            'wants_json' => $request->wantsJson()
        ]);

        $request->validate([
            'email' => 'required|email',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        $forfait = ElearningForfait::where('slug', $forfaitSlug)->active()->firstOrFail();

        Log::info('Forfait trouvé', [
            'forfait_id' => $forfait->id,
            'name' => $forfait->name,
            'price' => $forfait->price,
            'slug' => $forfait->slug
        ]);

        $serviceData = [
            'amount' => $forfait->price,
            'service_name' => 'Forfait E-learning: ' . $forfait->name,
            'description' => $forfait->description ?? 'Accès à la plateforme e-learning DJOK PRESTIGE',
        ];

        $customerData = [
            'email' => $request->email,
            'name' => $request->prenom . ' ' . $request->nom,
            'phone' => $request->telephone,
        ];

        $metadata = [
            'forfait_id' => $forfait->id,
            'forfait_name' => $forfait->name,
            'forfait_slug' => $forfait->slug,
            'duration_days' => $forfait->duration_days,
            'customer_email' => $request->email,
            'customer_nom' => $request->nom,
            'customer_prenom' => $request->prenom,
            'customer_telephone' => $request->telephone,
            'service_type' => 'elearning',
        ];

        try {
            Log::info('Création session de paiement avec PaymentService');

            $paymentSession = $this->paymentService->createPaymentSession(
                'elearning',
                $serviceData,
                $customerData,
                $metadata
            );

            Log::info('Session de paiement créée avec succès', [
                'forfait_id' => $forfait->id,
                'session_id' => $paymentSession['session_id'],
                'reference' => $paymentSession['reference'],
                'url' => $paymentSession['url']
            ]);

            return redirect()->away($paymentSession['url']);
        } catch (\Exception $e) {
            Log::error('Erreur création session paiement e-learning: ' . $e->getMessage(), [
                'forfait_slug' => $forfaitSlug,
                'error' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Erreur lors de la création du paiement: ' . $e->getMessage()]);
        }
    }

    /**
     * Succès du paiement e-learning
     */
    public function paymentSuccess(Request $request)
    {
        Log::info('=== DÉBUT paymentSuccess e-learning ===');

        // Récupérer le session_id depuis la query string
        $sessionId = $request->get('session_id');

        Log::info('Session ID reçu:', ['session_id' => $sessionId]);

        if (!$sessionId) {
            Log::warning('Aucun session_id fourni dans paymentSuccess');
            return redirect()->route('elearning.index')
                ->with('error', 'Session de paiement invalide.');
        }

        try {
            Log::info('Recherche paiement pour session_id', ['session_id' => $sessionId]);

            // Récupérer le paiement déjà traité
            $paiement = Paiement::where('stripe_session_id', $sessionId)->first();

            if (!$paiement) {
                Log::warning('Paiement non trouvé pour session_id', ['session_id' => $sessionId]);
                return redirect()->route('elearning.index')
                    ->with('error', 'Paiement non trouvé.');
            }

            Log::info('Paiement trouvé', [
                'paiement_id' => $paiement->id,
                'reference' => $paiement->reference,
                'service_type' => $paiement->service_type,
                'elearning_forfait_id' => $paiement->elearning_forfait_id,
                'service_details' => $paiement->service_details,
            ]);

            // Vérifier si l'accès existe déjà
            $acces = ElearningAcces::where('paiement_id', $paiement->id)->first();

            if (!$acces) {
                Log::info('Création accès e-learning manquante');

                // Créer l'accès à partir des données du paiement
                $acces = $this->createElearningAccessFromPaiement($paiement);
            } else {
                Log::info('Accès e-learning existe déjà', ['acces_id' => $acces->id]);
            }

            Log::info('Accès e-learning récupéré/créé avec succès', ['acces_id' => $acces->id]);

            return view('elearning.success', compact('paiement', 'acces'))
                ->with('success', 'Votre achat a été confirmé ! Vous recevrez vos codes d\'accès par email.');
        } catch (\Exception $e) {
            Log::error('Erreur traitement paiement e-learning: ' . $e->getMessage(), [
                'session_id' => $sessionId,
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('elearning.index')
                ->with('error', 'Erreur lors du traitement de votre achat.');
        }
    }

    /**
     * Créer un accès e-learning à partir d'un paiement
     */
    private function createElearningAccessFromPaiement(Paiement $paiement)
    {
        Log::info('=== DÉBUT createElearningAccessFromPaiement ===');
        Log::info('Données du paiement:', [
            'paiement_id' => $paiement->id,
            'elearning_forfait_id' => $paiement->elearning_forfait_id,
            'service_type' => $paiement->service_type,
            'service_details' => $paiement->service_details,
        ]);

        // Essayer de récupérer le forfait ID de différentes manières
        $forfaitId = $paiement->elearning_forfait_id;

        if (!$forfaitId) {
            Log::warning('elearning_forfait_id est NULL, recherche dans service_details');

            // Essayer de récupérer depuis service_details
            $serviceDetails = is_array($paiement->service_details)
                ? $paiement->service_details
                : json_decode($paiement->service_details, true);

            $forfaitId = $serviceDetails['forfait_id'] ?? null;

            if ($forfaitId) {
                Log::info('Forfait ID trouvé dans service_details: ' . $forfaitId);
                // Mettre à jour le paiement avec le forfait_id
                $paiement->update(['elearning_forfait_id' => $forfaitId]);
                Log::info('Paiement mis à jour avec elearning_forfait_id: ' . $forfaitId);
            }
        }

        if (!$forfaitId) {
            Log::error('Forfait ID manquant dans le paiement');
            throw new \Exception('Forfait ID manquant dans le paiement');
        }

        Log::info('Forfait ID à chercher: ' . $forfaitId);

        $forfait = ElearningForfait::find($forfaitId);

        if (!$forfait) {
            Log::error('Forfait non trouvé avec ID: ' . $forfaitId);
            throw new \Exception('Forfait non trouvé: ' . $forfaitId);
        }

        Log::info('Forfait trouvé:', [
            'id' => $forfait->id,
            'name' => $forfait->name,
            'duration_days' => $forfait->duration_days,
        ]);

        // Récupérer les informations client
        $customerInfo = is_array($paiement->customer_info)
            ? $paiement->customer_info
            : json_decode($paiement->customer_info, true);

        $serviceDetails = is_array($paiement->service_details)
            ? $paiement->service_details
            : json_decode($paiement->service_details, true);

        Log::info('Customer info:', $customerInfo);
        Log::info('Service details:', $serviceDetails);

        $email = $customerInfo['email'] ?? $serviceDetails['customer_email'] ?? null;
        $nom = $customerInfo['name'] ?? $serviceDetails['customer_nom'] ?? 'Client';
        $prenom = $serviceDetails['customer_prenom'] ?? '';
        $telephone = $serviceDetails['customer_telephone'] ?? null;

        Log::info('Données client extraites:', [
            'email' => $email,
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $telephone,
        ]);

        if (!$email) {
            Log::error('Email client manquant');
            throw new \Exception('Email client manquant');
        }

        // Séparer nom et prénom si nécessaire
        if (empty($prenom) && strpos($nom, ' ') !== false) {
            $parts = explode(' ', $nom, 2);
            $prenom = $parts[0] ?? '';
            $nom = $parts[1] ?? $nom;
            Log::info('Nom séparé:', ['prenom' => $prenom, 'nom' => $nom]);
        }

        // Générer les codes d'accès
        $accessCode = Str::upper(Str::random(10));
        $virtualRoomCode = 'ROOM-' . Str::upper(Str::random(8));

        // Dates d'accès
        $accessStart = now();
        $accessEnd = now()->addDays($forfait->duration_days);

        Log::info('Création accès e-learning avec données:', [
            'forfait_id' => $forfait->id,
            'paiement_id' => $paiement->id,
            'email' => $email,
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $telephone,
            'access_code' => $accessCode,
            'virtual_room_code' => $virtualRoomCode,
            'access_start' => $accessStart->format('Y-m-d H:i:s'),
            'access_end' => $accessEnd->format('Y-m-d H:i:s'),
        ]);

        // Créer l'accès
        $acces = ElearningAcces::create([
            'forfait_id' => $forfait->id,
            'paiement_id' => $paiement->id,
            'email' => $email,
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $telephone,
            'access_code' => $accessCode,
            'virtual_room_code' => $virtualRoomCode,
            'access_start' => $accessStart,
            'access_end' => $accessEnd,
            'total_cours' => ElearningCours::active()->count(),
            'status' => 'active',
        ]);

        Log::info('Accès e-learning créé:', [
            'acces_id' => $acces->id,
            'access_code' => $accessCode,
            'virtual_room_code' => $virtualRoomCode,
            'email' => $email,
        ]);

        // Envoyer l'email avec les codes d'accès
        $this->sendElearningAccessEmail($acces, $forfait);

        Log::info('=== FIN createElearningAccessFromPaiement - Succès ===');

        return $acces;
    }

    /**
     * Envoyer l'email d'accès e-learning
     */
    private function sendElearningAccessEmail(ElearningAcces $acces, ElearningForfait $forfait)
    {
        try {
            Log::info('Envoi email d\'accès à: ' . $acces->email);
            Mail::to($acces->email)->send(new \App\Mail\ElearningAccessMail($acces, $forfait));
            Log::info('Email d\'accès e-learning envoyé à: ' . $acces->email);
        } catch (\Exception $e) {
            Log::error('Erreur envoi email e-learning: ' . $e->getMessage());
        }
    }

    /**
     * Accès à la salle virtuelle (page de login avec code)
     */
    public function salle()
    {
        return view('elearning.salle');
    }

    /**
     * Connexion à la salle virtuelle
     */
    public function login(Request $request)
    {
        Log::info('=== DÉBUT login e-learning ===', [
            'email' => $request->email,
            'has_access_code' => !empty($request->access_code)
        ]);

        $request->validate([
            'access_code' => 'required|string|max:20',
            'email' => 'required|email',
        ]);

        $acces = ElearningAcces::where('access_code', $request->access_code)
            ->where('email', $request->email)
            ->first();

        if (!$acces) {
            Log::warning('Accès non trouvé', [
                'email' => $request->email,
                'access_code' => $request->access_code
            ]);
            return back()->withErrors([
                'error' => 'Code d\'accès ou email incorrect.'
            ]);
        }

        if (!$acces->isActive()) {
            Log::warning('Accès non actif', ['acces_id' => $acces->id, 'status' => $acces->status]);
            return back()->withErrors([
                'error' => 'Votre accès a expiré ou a été suspendu.'
            ]);
        }

        if ($acces->hasActiveSession()) {
            Log::warning('Session déjà active', ['acces_id' => $acces->id]);
            return back()->withErrors([
                'error' => 'Une session est déjà active avec ce compte.'
            ]);
        }

        $sessionToken = Str::random(60);

        $acces->update([
            'current_session_token' => $sessionToken,
            'current_session_start' => now(),
            'current_session_ip' => $request->ip(),
            'current_session_browser' => $request->userAgent(),
            'last_access_at' => now(),
        ]);

        ElearningSession::create([
            'acces_id' => $acces->id,
            'session_token' => $sessionToken,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'login_at' => now(),
            'last_activity_at' => now(),
        ]);

        session([
            'elearning_access_id' => $acces->id,
            'elearning_session_token' => $sessionToken,
            'elearning_virtual_room' => $acces->virtual_room_code,
        ]);

        Log::info('Connexion réussie', [
            'acces_id' => $acces->id,
            'session_token' => $sessionToken,
            'virtual_room_code' => $acces->virtual_room_code
        ]);

        return redirect()->route('elearning.virtual-room');
    }

    /**
     * Mettre à jour l'activité d'une session
     */
    private function updateSessionActivity(ElearningAcces $acces)
    {
        $session = ElearningSession::where('session_token', session('elearning_session_token'))
            ->whereNull('logout_at')
            ->first();

        if ($session) {
            $session->update(['last_activity_at' => now()]);
            Log::debug('Activité session mise à jour', ['session_id' => $session->id]);
        } else {
            Log::warning('Session non trouvée pour mise à jour', [
                'session_token' => session('elearning_session_token'),
                'acces_id' => $acces->id
            ]);
        }
    }

    /**
     * Salle virtuelle principale - VERSION CORRIGÉE
     */
    public function virtualRoom()
    {
        Log::info('=== DÉBUT virtualRoom ===');

        if (!session('elearning_access_id')) {
            Log::warning('Pas d\'ID d\'accès en session');
            return redirect()->route('elearning.salle');
        }

        $acces = ElearningAcces::find(session('elearning_access_id'));

        if (!$acces) {
            Log::error('Accès non trouvé en base', ['access_id' => session('elearning_access_id')]);
            session()->forget([
                'elearning_access_id',
                'elearning_session_token',
                'elearning_virtual_room',
            ]);
            return redirect()->route('elearning.salle');
        }

        if ($acces->current_session_token !== session('elearning_session_token')) {
            Log::warning('Token de session invalide', [
                'session_token' => session('elearning_session_token'),
                'db_token' => $acces->current_session_token
            ]);
            return redirect()->route('elearning.salle');
        }

        // CORRECTION : Mettre à jour l'activité de la session
        $this->updateSessionActivity($acces);

        // Mettre à jour la dernière activité de l'accès
        $acces->update(['last_access_at' => now()]);

        // Récupérer les cours actifs
        $cours = ElearningCours::active()->ordered()->get();

        // Récupérer les progressions de l'utilisateur
        $progressions = ElearningProgression::where('acces_id', $acces->id)->get()->keyBy('cours_id');

        // Récupérer tous les QCM actifs
        $qcms = ElearningQcm::active()->get();

        // Séparer les QCM normaux et examens blancs
        $qcmsNormaux = collect();
        $examensBlancs = collect();

        foreach ($qcms as $qcm) {
            if ($qcm->is_examen_blanc) {
                $examensBlancs->push($qcm);
            } else {
                $qcmsNormaux->push($qcm);
            }
        }

        // Séparer les QCM complétés des QCM disponibles
        $qcmsCompletes = collect();
        $qcmsNormauxDisponibles = collect();
        $examensBlancsDisponibles = collect();

        // Pour les QCM normaux
        foreach ($qcmsNormaux as $qcm) {
            $progression = ElearningProgression::where('acces_id', $acces->id)
                ->where('qcm_id', $qcm->id)
                ->first();

            if ($progression && $progression->qcm_completed) {
                $qcmsCompletes->push($qcm);
            } else {
                $qcmsNormauxDisponibles->push($qcm);
            }
        }

        // Pour les examens blancs
        foreach ($examensBlancs as $examen) {
            $progression = ElearningProgression::where('acces_id', $acces->id)
                ->where('qcm_id', $examen->id)
                ->first();

            if ($progression && $progression->qcm_completed) {
                $qcmsCompletes->push($examen);
            } else {
                $examensBlancsDisponibles->push($examen);
            }
        }

        // Calculer le pourcentage de progression
        if ($acces->total_cours > 0) {
            $progressionPercentage = ($acces->cours_completed / $acces->total_cours) * 100;
        } else {
            $progressionPercentage = 0;
        }

        $acces->progression_percentage = round($progressionPercentage, 1);

        Log::info('Données chargées pour la salle virtuelle', [
            'cours_count' => $cours->count(),
            'qcms_normaux_disponibles' => $qcmsNormauxDisponibles->count(),
            'examens_blancs_disponibles' => $examensBlancsDisponibles->count(),
            'qcms_completes_count' => $qcmsCompletes->count(),
            'progressions_count' => $progressions->count(),
            'progression_percentage' => $acces->progression_percentage
        ]);

        // Passer les variables à la vue (en utilisant les noms exacts de la vue)
        return view('elearning.virtual-room', compact(
            'acces',
            'cours',
            'qcmsNormaux', // Pour la vue (référence à $qcmsNormaux->count())
            'examensBlancs', // Pour la vue (référence à $examensBlancs->count())
            'qcmsCompletes', // Pour la vue
            'progressions'
        ));
    }

    /**
     * Voir un cours spécifique
     */
    public function showCours($coursId)
    {
        Log::info('=== DÉBUT showCours ===', ['cours_id' => $coursId]);

        $acces = $this->getValidAccess();
        if (!$acces) {
            Log::warning('Accès invalide pour showCours');
            return redirect()->route('elearning.salle');
        }

        // CORRECTION : Mettre à jour l'activité de la session
        $this->updateSessionActivity($acces);

        $cours = ElearningCours::findOrFail($coursId);

        Log::info('Cours trouvé', [
            'cours_id' => $cours->id,
            'title' => $cours->title,
            'has_content' => !empty($cours->content)
        ]);

        // Vérifier si une progression existe déjà
        $progression = ElearningProgression::where('acces_id', $acces->id)
            ->where('cours_id', $coursId)
            ->first();

        // Si pas de progression, vérifier s'il existe déjà une progression pour cet accès et cours
        if (!$progression) {
            // Chercher s'il existe déjà une progression pour ce cours (sans QCM spécifique)
            $existingProgression = ElearningProgression::where('acces_id', $acces->id)
                ->where('cours_id', $coursId)
                ->first();

            if ($existingProgression) {
                $progression = $existingProgression;
                Log::info('Progression existante trouvée', ['progression_id' => $progression->id]);
            } else {
                // Créer une nouvelle progression
                $progression = ElearningProgression::create([
                    'acces_id' => $acces->id,
                    'cours_id' => $coursId,
                    'cours_completed' => false,
                ]);
                Log::info('Nouvelle progression créée pour le cours', ['progression_id' => $progression->id]);
            }
        }

        Log::info('Progression récupérée/créée', [
            'progression_id' => $progression->id,
            'cours_completed' => $progression->cours_completed
        ]);

        return view('elearning.cours', compact('acces', 'cours', 'progression'));
    }

    /**
     * Marquer un cours comme terminé
     */
    public function completeCours(Request $request, $coursId)
    {
        Log::info('=== DÉBUT completeCours ===', ['cours_id' => $coursId]);

        $acces = $this->getValidAccess();
        if (!$acces) {
            Log::warning('Accès invalide pour completeCours');
            return response()->json(['error' => 'Accès invalide'], 401);
        }

        // CORRECTION : Mettre à jour l'activité de la session
        $this->updateSessionActivity($acces);

        $progression = ElearningProgression::where('acces_id', $acces->id)
            ->where('cours_id', $coursId)
            ->first();

        if (!$progression) {
            Log::warning('Progression non trouvée pour le cours', [
                'acces_id' => $acces->id,
                'cours_id' => $coursId
            ]);

            // Créer la progression si elle n'existe pas
            $progression = ElearningProgression::create([
                'acces_id' => $acces->id,
                'cours_id' => $coursId,
                'cours_completed' => true,
                'cours_completed_at' => now(),
            ]);
        } else {
            Log::info('Progression avant complétion', [
                'progression_id' => $progression->id,
                'cours_completed' => $progression->cours_completed
            ]);

            $progression->update([
                'cours_completed' => true,
                'cours_completed_at' => now(),
            ]);
        }

        // Mettre à jour le compteur de cours
        $acces->increment('cours_completed');
        $acces->update(['total_cours' => ElearningCours::active()->count()]);

        Log::info('Cours marqué comme terminé', [
            'acces_id' => $acces->id,
            'cours_completed_count' => $acces->cours_completed
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Passer un QCM
     */
    public function showQcm($qcmId)
    {
        Log::info('=== DÉBUT showQcm ===', [
            'qcm_id' => $qcmId,
            'session_has_access' => session()->has('elearning_access_id'),
            'session_access_id' => session('elearning_access_id')
        ]);

        $acces = $this->getValidAccess();
        if (!$acces) {
            Log::error('Accès invalide pour showQcm');
            return redirect()->route('elearning.salle');
        }

        // CORRECTION : Mettre à jour l'activité de la session
        $this->updateSessionActivity($acces);

        Log::info('Accès valide trouvé', [
            'acces_id' => $acces->id,
            'email' => $acces->email,
            'nom' => $acces->nom,
            'prenom' => $acces->prenom
        ]);

        try {
            $qcm = ElearningQcm::findOrFail($qcmId);

            Log::info('QCM trouvé', [
                'qcm_id' => $qcm->id,
                'title' => $qcm->title,
                'questions_count' => $qcm->questions_count,
                'allow_multiple_correct' => $qcm->allow_multiple_correct,
                'is_examen_blanc' => $qcm->is_examen_blanc,
                'has_questions_data' => !empty($qcm->questions_data)
            ]);

            // Vérifier la structure des données de questions
            if (empty($qcm->questions_data)) {
                Log::error('questions_data est vide pour le QCM', ['qcm_id' => $qcm->id]);
                throw new \Exception('Le QCM ne contient pas de questions.');
            }

            $questionsData = $qcm->questions_data;

            Log::info('Structure questions_data', [
                'is_array' => is_array($questionsData),
                'keys' => array_keys($questionsData),
                'has_questions_key' => isset($questionsData['questions']),
                'questions_count' => isset($questionsData['questions']) ? count($questionsData['questions']) : 0
            ]);

            // Préparer les données pour la vue
            $questions = isset($questionsData['questions']) ? $questionsData['questions'] : [];

            // Ajouter les questions à l'objet QCM pour la vue
            $qcm->questions = $questions;

            Log::info('=== FIN showQcm - Prêt à afficher ===');

            return view('elearning.qcm', compact('acces', 'qcm'));
        } catch (\Exception $e) {
            Log::error('Erreur showQcm: ' . $e->getMessage(), [
                'qcm_id' => $qcmId,
                'acces_id' => $acces->id ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('elearning.virtual-room')
                ->with('error', 'Erreur lors du chargement du QCM: ' . $e->getMessage());
        }
    }

    /**
     * Soumettre un QCM - VERSION SIMPLIFIÉE
     */
    public function submitQcm(Request $request, $qcmId)
    {
        Log::info('=== DÉBUT submitQcm ===', [
            'qcm_id' => $qcmId,
            'has_answers' => !empty($request->answers),
            'answers_count' => count($request->input('answers', [])),
            'allow_multiple_correct' => $request->input('allow_multiple_correct', 0)
        ]);

        $acces = $this->getValidAccess();
        if (!$acces) {
            Log::error('Accès invalide pour submitQcm');
            return response()->json(['error' => 'Accès invalide'], 401);
        }

        // CORRECTION : Mettre à jour l'activité de la session
        $this->updateSessionActivity($acces);

        try {
            $qcm = ElearningQcm::findOrFail($qcmId);
            $userAnswers = $request->input('answers', []);

            Log::info('QCM trouvé pour soumission', [
                'qcm_id' => $qcm->id,
                'title' => $qcm->title,
                'questions_count' => $qcm->questions_count,
                'allow_multiple_correct' => $qcm->allow_multiple_correct,
                'user_answers_count' => count($userAnswers)
            ]);

            // Afficher les réponses utilisateur pour débogage
            foreach ($userAnswers as $questionId => $answer) {
                Log::debug('Réponse utilisateur', [
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'answer_type' => gettype($answer)
                ]);
            }

            // Calculer le score
            $scoreResult = $this->calculateQcmScore($qcm, $userAnswers);
            $score = $scoreResult['score'];
            $details = $scoreResult['details'];

            Log::info('Score calculé:', [
                'score' => $score,
                'passing_score' => $qcm->passing_score,
                'passed' => $score >= $qcm->passing_score,
                'details_count' => count($details)
            ]);

            // Gestion des tentatives
            // Chercher s'il existe déjà une progression pour ce QCM
            $progression = ElearningProgression::where('acces_id', $acces->id)
                ->where('qcm_id', $qcmId)
                ->first();

            if ($progression) {
                // Vérifier le nombre de tentatives maximales
                if ($qcm->attempts_allowed > 0 && $progression->qcm_attempts >= $qcm->attempts_allowed) {
                    Log::warning('Nombre maximum de tentatives atteint', [
                        'attempts' => $progression->qcm_attempts,
                        'max_attempts' => $qcm->attempts_allowed
                    ]);

                    return response()->json([
                        'success' => false,
                        'error' => 'Vous avez atteint le nombre maximum de tentatives autorisées pour ce QCM.'
                    ], 403);
                }

                // Incrémenter les tentatives
                $attemptNumber = $progression->qcm_attempts + 1;

                // Mettre à jour la progression existante
                $progression->update([
                    'qcm_completed' => true,
                    'qcm_score' => $score,
                    'qcm_attempts' => $attemptNumber,
                    'qcm_completed_at' => now(),
                ]);

                Log::info('Progression mise à jour', [
                    'progression_id' => $progression->id,
                    'attempt_number' => $attemptNumber
                ]);
            } else {
                // Créer une nouvelle progression
                // D'abord, vérifier s'il existe une progression pour ce cours
                $coursProgression = ElearningProgression::where('acces_id', $acces->id)
                    ->where('cours_id', $qcm->cours_id)
                    ->first();

                if ($coursProgression) {
                    // Si une progression existe pour le cours, utiliser son ID
                    // Mettre à jour avec les infos du QCM
                    $coursProgression->update([
                        'qcm_id' => $qcm->id,
                        'qcm_completed' => true,
                        'qcm_score' => $score,
                        'qcm_attempts' => 1,
                        'qcm_completed_at' => now(),
                    ]);

                    $progression = $coursProgression;
                    Log::info('Progression du cours mise à jour avec QCM', [
                        'progression_id' => $progression->id,
                        'attempt_number' => 1
                    ]);
                } else {
                    // Créer une nouvelle progression
                    $progression = ElearningProgression::create([
                        'acces_id' => $acces->id,
                        'cours_id' => $qcm->cours_id,
                        'qcm_id' => $qcm->id,
                        'qcm_completed' => true,
                        'qcm_score' => $score,
                        'qcm_attempts' => 1,
                        'qcm_completed_at' => now(),
                    ]);

                    Log::info('Nouvelle progression créée', [
                        'progression_id' => $progression->id,
                        'attempt_number' => 1
                    ]);
                }
            }

            // Mettre à jour la moyenne des scores
            $this->updateAverageScore($acces);

            Log::info('=== FIN submitQcm - Succès ===');

            return response()->json([
                'success' => true,
                'score' => round($score, 2),
                'passed' => $score >= $qcm->passing_score,
                'questions_count' => $qcm->questions_count,
                'passing_score' => $qcm->passing_score,
                'attempt_number' => $progression->qcm_attempts,
                'max_attempts' => $qcm->attempts_allowed,
                'details' => $details,
                'is_examen_blanc' => $qcm->is_examen_blanc,
                'allow_multiple_correct' => $qcm->allow_multiple_correct,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur submitQcm: ' . $e->getMessage(), [
                'qcm_id' => $qcmId,
                'acces_id' => $acces->id,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Erreur lors du traitement du QCM: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper: Calculer le score d'un QCM (Version corrigée pour multi-réponses)
     */
    private function calculateQcmScore(ElearningQcm $qcm, array $userAnswers): array
    {
        Log::info('=== DÉBUT calculateQcmScore ===', [
            'qcm_title' => $qcm->title,
            'allow_multiple' => $qcm->allow_multiple_correct,
            'questions_in_qcm' => $qcm->questions_count,
            'user_answers_count' => count($userAnswers)
        ]);

        $questions = $qcm->questions_data['questions'] ?? [];
        $allowMultiple = $qcm->allow_multiple_correct;

        $correctQuestions = 0;
        $details = [];

        Log::info('Structure des questions', [
            'total_questions' => count($questions),
            'has_questions_key' => isset($qcm->questions_data['questions'])
        ]);

        foreach ($questions as $index => $question) {
            $questionId = $question['id'] ?? $index;
            $questionText = $question['text'] ?? 'Question ' . ($index + 1);

            Log::debug('Traitement question', [
                'index' => $index,
                'question_id' => $questionId,
                'question_text' => substr($questionText, 0, 100)
            ]);

            // Récupérer les réponses correctes
            $correctAnswers = [];
            if ($allowMultiple && isset($question['correct_answers'])) {
                $correctAnswers = is_array($question['correct_answers'])
                    ? $question['correct_answers']
                    : [$question['correct_answers']];
            } elseif (isset($question['correct_answer'])) {
                $correctAnswers = [$question['correct_answer']];
            }

            Log::debug('Réponses correctes pour la question', [
                'correct_answers' => $correctAnswers,
                'correct_answers_count' => count($correctAnswers)
            ]);

            // Récupérer les réponses de l'utilisateur
            $userAnswer = $userAnswers[$questionId] ?? null;

            Log::debug('Réponse utilisateur', [
                'question_id' => $questionId,
                'user_answer' => $userAnswer,
                'user_answer_type' => gettype($userAnswer)
            ]);

            // Vérifier si la réponse est correcte
            $isCorrect = false;
            $points = 0;
            $maxPoints = 1;

            if ($allowMultiple) {
                // Mode multi-réponses
                $userSelections = is_array($userAnswer) ? $userAnswer : [$userAnswer];

                // Filtrer les valeurs vides
                $userSelections = array_filter($userSelections, function ($val) {
                    return !is_null($val) && $val !== '';
                });

                $correctSelections = array_filter($correctAnswers, function ($val) {
                    return !is_null($val) && $val !== '';
                });

                Log::debug('Sélections utilisateur filtrées', [
                    'user_selections' => $userSelections,
                    'correct_selections' => $correctSelections,
                    'user_count' => count($userSelections),
                    'correct_count' => count($correctSelections)
                ]);

                if (empty($correctSelections)) {
                    // Pas de réponse correcte définie
                    $isCorrect = false;
                    $points = 0;
                    $maxPoints = 1;
                    Log::warning('Pas de réponse correcte définie pour la question', ['question_id' => $questionId]);
                } else {
                    // Compter les bonnes réponses
                    $correctCount = count(array_intersect($userSelections, $correctSelections));
                    $wrongCount = count(array_diff($userSelections, $correctSelections));

                    // Calcul des points avec pénalité pour les mauvaises réponses
                    $points = max(0, $correctCount - ($wrongCount * 0.5));
                    $maxPoints = count($correctSelections);

                    // La question est considérée comme correcte si l'utilisateur a sélectionné toutes les bonnes réponses
                    // et n'a pas sélectionné de mauvaises réponses
                    $isCorrect = ($correctCount === count($correctSelections) && $wrongCount === 0);

                    Log::debug('Calcul points multi-réponses', [
                        'correct_count' => $correctCount,
                        'wrong_count' => $wrongCount,
                        'points' => $points,
                        'max_points' => $maxPoints,
                        'is_correct' => $isCorrect
                    ]);
                }
            } else {
                // Mode simple réponse
                $correctAnswer = $correctAnswers[0] ?? '';
                $isCorrect = ($userAnswer === $correctAnswer && !empty($userAnswer));
                $points = $isCorrect ? 1 : 0;
                $maxPoints = 1;

                Log::debug('Calcul points réponse simple', [
                    'correct_answer' => $correctAnswer,
                    'user_answer' => $userAnswer,
                    'is_correct' => $isCorrect,
                    'points' => $points
                ]);
            }

            if ($isCorrect) {
                $correctQuestions++;
                Log::debug('Question correcte', ['correct_count' => $correctQuestions]);
            }

            // Ajouter les détails
            $details[] = [
                'question_index' => $index + 1,
                'question' => $questionText,
                'correct' => $isCorrect,
                'user_answer' => $userAnswer,
                'correct_answer' => $allowMultiple ? $correctAnswers : ($correctAnswers[0] ?? ''),
                'points' => $points,
                'max_points' => $maxPoints,
                'explanation' => $question['explanation'] ?? '',
            ];
        }

        // Calcul du score en pourcentage
        $totalQuestions = count($questions);
        $score = $totalQuestions > 0 ? ($correctQuestions / $totalQuestions) * 100 : 0;

        Log::info('Résultat calcul score', [
            'total_questions' => $totalQuestions,
            'correct_questions' => $correctQuestions,
            'score' => $score,
            'details_count' => count($details)
        ]);

        Log::info('=== FIN calculateQcmScore ===');

        return [
            'score' => $score,
            'details' => $details,
        ];
    }

    /**
     * Helper: Mettre à jour la moyenne des scores
     */
    private function updateAverageScore(ElearningAcces $acces)
    {
        $progressions = ElearningProgression::where('acces_id', $acces->id)
            ->whereNotNull('qcm_score')
            ->get();

        Log::debug('Mise à jour moyenne scores', [
            'acces_id' => $acces->id,
            'progressions_count' => $progressions->count()
        ]);

        if ($progressions->count() > 0) {
            $average = $progressions->avg('qcm_score');
            $acces->update(['average_qcm_score' => round($average, 2)]);

            Log::info('Moyenne mise à jour', [
                'old_average' => $acces->average_qcm_score,
                'new_average' => round($average, 2)
            ]);
        }
    }

    /**
     * Déconnexion
     */
    public function logout()
    {
        Log::info('=== DÉBUT logout e-learning ===', [
            'has_session' => session()->has('elearning_access_id'),
            'access_id' => session('elearning_access_id')
        ]);

        if (session('elearning_access_id')) {
            $acces = ElearningAcces::find(session('elearning_access_id'));
            if ($acces) {
                $acces->update([
                    'current_session_token' => null,
                    'current_session_start' => null,
                    'current_session_ip' => null,
                ]);
                Log::info('Accès mis à jour pour déconnexion', ['acces_id' => $acces->id]);
            }

            // Marquer la session comme terminée
            $sessionUpdated = ElearningSession::where('session_token', session('elearning_session_token'))
                ->update(['logout_at' => now()]);

            Log::info('Session terminée', [
                'session_token' => session('elearning_session_token'),
                'rows_updated' => $sessionUpdated
            ]);
        }

        session()->forget([
            'elearning_access_id',
            'elearning_session_token',
            'elearning_virtual_room',
        ]);

        Log::info('Session nettoyée');

        return redirect()->route('elearning.salle')->with('success', 'Déconnexion réussie.');
    }

    /**
     * Helper: Vérifier et récupérer l'accès valide
     */
    /**
     * Helper: Vérifier et récupérer l'accès valide
     */
    private function getValidAccess()
    {
        $accessId = session('elearning_access_id');
        $sessionToken = session('elearning_session_token');

        Log::debug('getValidAccess appelé', [
            'access_id' => $accessId,
            'session_token_exists' => !empty($sessionToken)
        ]);

        if (!$accessId || !$sessionToken) {
            Log::warning('Session incomplète', [
                'has_access_id' => !empty($accessId),
                'has_session_token' => !empty($sessionToken)
            ]);
            return null;
        }

        $acces = ElearningAcces::find($accessId);

        if (!$acces) {
            Log::error('Accès non trouvé en base', ['access_id' => $accessId]);
            return null;
        }

        if ($acces->current_session_token !== $sessionToken) {
            Log::warning('Token de session invalide', [
                'expected' => $acces->current_session_token,
                'actual' => $sessionToken
            ]);
            return null;
        }

        if (!$acces->isActive()) {
            Log::warning('Accès non actif', [
                'acces_id' => $acces->id,
                'status' => $acces->status,
                'access_end' => $acces->access_end
            ]);
            return null;
        }

        // Mettre à jour la dernière activité de l'accès
        $acces->update(['last_access_at' => now()]);

        // CORRECTION AJOUTÉE ICI : Mettre à jour l'activité de la session
        $this->updateSessionActivity($acces);

        Log::debug('Accès valide confirmé', [
            'acces_id' => $acces->id,
            'email' => $acces->email,
            'virtual_room_code' => $acces->virtual_room_code
        ]);

        return $acces;
    }
}
