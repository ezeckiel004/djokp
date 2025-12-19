<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ConciergerieDemande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
// Même importation que le contrôleur public
use App\Mail\ConciergerieDemandeMail;
use App\Mail\ConciergerieConfirmationClientMail;
// Classes pour les annulations
use App\Mail\ConciergerieAnnulationAdminMail;
use App\Mail\ConciergerieAnnulationClientMail;

class ConciergerieController extends Controller
{
    /**
     * Afficher les demandes de conciergerie
     */
    public function index()
    {
        $user = Auth::user();

        $demandes = ConciergerieDemande::where('email', $user->email)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('client.conciergerie-demandes.index', compact('demandes'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $user = Auth::user();

        $defaultData = [
            'nom_complet' => $user->name,
            'email' => $user->email,
            'telephone' => $user->phone ?? '',
        ];

        return view('client.conciergerie-demandes.create', compact('defaultData'));
    }

    /**
     * Enregistrer une nouvelle demande
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validation similaire au contrôleur public
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'motif_voyage' => 'required|string|max:255',
            'date_arrivee' => 'required|date|after_or_equal:today',
            'duree_sejour' => 'required|string|max:50',
            'nombre_personnes' => 'required|string|max:20',
            'budget' => 'nullable|string|max:100',
            'type_accompagnement' => 'required|string|max:100',
            'services' => 'nullable|array',
            'services.*' => 'string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        // Vérifier que l'email correspond à l'utilisateur connecté
        if ($validated['email'] !== $user->email) {
            return back()->with('error', 'L\'email doit correspondre à votre compte.')
                ->withInput();
        }

        try {
            // Création de la demande avec JSON encodé (comme le contrôleur public)
            $demande = ConciergerieDemande::create([
                'nom_complet' => $validated['nom_complet'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'motif_voyage' => $validated['motif_voyage'],
                'date_arrivee' => $validated['date_arrivee'],
                'duree_sejour' => $validated['duree_sejour'],
                'nombre_personnes' => $validated['nombre_personnes'],
                'budget' => $validated['budget'] ?? null,
                'type_accompagnement' => $validated['type_accompagnement'],
                'services' => json_encode($validated['services'] ?? [], JSON_UNESCAPED_UNICODE),
                'message' => $validated['message'],
                'statut' => 'nouvelle',
                'devise' => 'EUR',
            ]);

            Log::info('Demande conciergerie créée par le client', [
                'user_id' => $user->id,
                'demande_id' => $demande->id,
                'reference' => $demande->reference,
                'statut' => $demande->statut,
            ]);

            // ENVOI DES EMAILS (identique au contrôleur public)
            try {
                // Envoi email admin
                Mail::to('conciergerie@djokprestige.com')
                    ->send(new ConciergerieDemandeMail($demande));
                Log::info('Email admin envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur envoi email admin: ' . $e->getMessage());
            }

            // Envoi email client
            try {
                Mail::to($demande->email)
                    ->send(new ConciergerieConfirmationClientMail($demande));
                Log::info('Email client envoyé avec succès');
            } catch (\Exception $e) {
                Log::error('Erreur envoi email client: ' . $e->getMessage());
            }

            return redirect()->route('client.conciergerie-demandes.show', $demande->id)
                ->with([
                    'success' => 'Votre demande a été envoyée avec succès ! Votre référence est : ' . $demande->reference . '. Un email de confirmation vous a été envoyé.',
                    'reference' => $demande->reference,
                ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de demande conciergerie', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Une erreur technique est survenue. Veuillez réessayer ou nous contacter directement.')
                ->withInput();
        }
    }

    /**
     * Afficher les détails d'une demande
     */
    public function show($id)
    {
        $user = Auth::user();

        $demande = ConciergerieDemande::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        // Formater les dates pour l'affichage
        $demande->date_arrivee_formatted = $demande->date_arrivee
            ? Carbon::parse($demande->date_arrivee)->format('d/m/Y')
            : null;

        $demande->date_devis_formatted = $demande->date_devis
            ? Carbon::parse($demande->date_devis)->format('d/m/Y')
            : null;

        return view('client.conciergerie-demandes.show', compact('demande'));
    }

    /**
     * Afficher le formulaire d'édition d'une demande
     */
    public function edit($id)
    {
        $user = Auth::user();

        $demande = ConciergerieDemande::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        // Vérifier si la demande peut être modifiée
        if (!in_array($demande->statut, ['nouvelle', 'en_cours'])) {
            return redirect()->route('client.conciergerie-demandes.show', $demande->id)
                ->with('error', 'Cette demande ne peut plus être modifiée car son traitement est trop avancé.');
        }

        return view('client.conciergerie-demandes.edit', compact('demande'));
    }

    /**
     * Mettre à jour une demande existante
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Récupérer la demande
        $demande = ConciergerieDemande::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        // Vérifier si la demande peut être modifiée
        if (!in_array($demande->statut, ['nouvelle', 'en_cours'])) {
            return redirect()->route('client.conciergerie-demandes.show', $demande->id)
                ->with('error', 'Cette demande ne peut plus être modifiée car son traitement est trop avancé.');
        }

        // Validation similaire au contrôleur public
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'motif_voyage' => 'required|string|max:255',
            'date_arrivee' => 'required|date|after_or_equal:today',
            'duree_sejour' => 'required|string|max:50',
            'nombre_personnes' => 'required|string|max:20',
            'budget' => 'nullable|string|max:100',
            'type_accompagnement' => 'required|string|max:100',
            'services' => 'nullable|array',
            'services.*' => 'string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        // Vérifier que l'email correspond à l'utilisateur connecté
        if ($validated['email'] !== $user->email) {
            return back()->with('error', 'L\'email doit correspondre à votre compte.')
                ->withInput();
        }

        try {
            // Sauvegarder l'ancien état pour le log
            $ancienStatut = $demande->statut;
            $ancienMessage = $demande->message;

            // Mettre à jour la demande avec JSON encodé pour services
            $demande->update([
                'nom_complet' => $validated['nom_complet'],
                'email' => $validated['email'],
                'telephone' => $validated['telephone'],
                'motif_voyage' => $validated['motif_voyage'],
                'date_arrivee' => $validated['date_arrivee'],
                'duree_sejour' => $validated['duree_sejour'],
                'nombre_personnes' => $validated['nombre_personnes'],
                'budget' => $validated['budget'] ?? null,
                'type_accompagnement' => $validated['type_accompagnement'],
                'services' => json_encode($validated['services'] ?? [], JSON_UNESCAPED_UNICODE),
                'message' => $validated['message'],
            ]);

            // Ajouter une note dans les notes admin
            $noteModification = "\n--- MODIFICATION PAR LE CLIENT ---\n";
            $noteModification .= "Date: " . now()->format('d/m/Y H:i') . "\n";
            $noteModification .= "Ancien message: " . substr($ancienMessage, 0, 200) . "...\n";
            $noteModification .= "Nouveau message: " . substr($validated['message'], 0, 200) . "...\n";

            $demande->notes_admin = ($demande->notes_admin ?? '') . $noteModification;
            $demande->save();

            Log::info('Demande conciergerie modifiée par le client', [
                'user_id' => $user->id,
                'demande_id' => $demande->id,
                'reference' => $demande->reference,
                'ancien_statut' => $ancienStatut,
                'nouveau_statut' => $demande->statut,
            ]);

            return redirect()->route('client.conciergerie-demandes.show', $demande->id)
                ->with('success', 'Demande mise à jour avec succès!');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la modification de demande conciergerie', [
                'user_id' => $user->id,
                'demande_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Une erreur est survenue lors de la mise à jour de votre demande.')
                ->withInput();
        }
    }

    /**
     * Annuler une demande (uniquement pour les statuts "nouvelle" et "en_cours")
     */
    public function destroy($id)
    {
        $user = Auth::user();

        try {
            $demande = ConciergerieDemande::where('id', $id)
                ->where('email', $user->email)
                ->firstOrFail();

            // Vérifier si la demande peut être annulée
            $annulableStatuts = ['nouvelle', 'en_cours'];
            if (!in_array($demande->statut, $annulableStatuts)) {
                return redirect()->route('client.conciergerie-demandes.index')
                    ->with('error', 'Cette demande ne peut plus être annulée car son traitement est trop avancé.');
            }

            $reference = $demande->reference;

            // ENVOI DES EMAILS D'ANNULATION
            try {
                // Email de notification à l'admin
                Mail::to('conciergerie@djokprestige.com')
                    ->send(new ConciergerieAnnulationAdminMail($demande, $user->email));
                Log::info('Email admin annulation envoyé pour la demande: ' . $demande->reference);

                // Email de confirmation au client
                Mail::to($user->email)
                    ->send(new ConciergerieAnnulationClientMail($demande, $user->email));
                Log::info('Email client annulation envoyé pour la demande: ' . $demande->reference);
            } catch (\Exception $emailException) {
                Log::error('Erreur lors de l\'envoi des emails d\'annulation', [
                    'error' => $emailException->getMessage(),
                    'demande_id' => $demande->id,
                ]);
                // Continuer même si l'email échoue
            }

            // Supprimer la demande après l'envoi des emails
            $demande->delete();

            Log::info('Demande conciergerie annulée par le client', [
                'user_id' => $user->id,
                'demande_id' => $id,
                'reference' => $reference,
                'statut_avant_suppression' => $demande->statut,
            ]);

            return redirect()->route('client.conciergerie-demandes.index')
                ->with('success', 'La demande ' . $reference . ' a été annulée avec succès. Un email de confirmation vous a été envoyé.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'annulation de demande conciergerie', [
                'user_id' => $user->id,
                'demande_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('client.conciergerie-demandes.index')
                ->with('error', 'Une erreur est survenue lors de l\'annulation de la demande.');
        }
    }

    /**
     * Filtrer les demandes par statut
     */
    public function filtrer(Request $request)
    {
        $user = Auth::user();
        $statut = $request->input('statut');
        $recherche = $request->input('recherche');

        $query = ConciergerieDemande::where('email', $user->email);

        if ($statut && $statut !== 'tous') {
            $query->where('statut', $statut);
        }

        if ($recherche) {
            $query->where(function ($q) use ($recherche) {
                $q->where('reference', 'like', "%{$recherche}%")
                    ->orWhere('nom_complet', 'like', "%{$recherche}%")
                    ->orWhere('message', 'like', "%{$recherche}%");
            });
        }

        $demandes = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('client.conciergerie-demandes.index', compact('demandes', 'statut', 'recherche'));
    }

    /**
     * Demander un nouveau devis pour une demande existante
     */
    public function demanderNouveauDevis(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'message' => 'required|string|min:10|max:1000',
        ]);

        try {
            $demande = ConciergerieDemande::where('id', $id)
                ->where('email', $user->email)
                ->firstOrFail();

            // Vérifier si un nouveau devis peut être demandé
            if (!in_array($demande->statut, ['devis_envoye', 'en_cours'])) {
                return back()->with('error', 'Une nouvelle demande de devis n\'est possible que pour les demandes en cours ou avec devis envoyé.');
            }

            // Mettre à jour les notes admin avec la demande de nouveau devis
            $nouvelleNote = "\n--- DEMANDE NOUVEAU DEVIS ---\n";
            $nouvelleNote .= "Date: " . now()->format('d/m/Y H:i') . "\n";
            $nouvelleNote .= "Message client: " . $request->message . "\n";

            $demande->notes_admin = ($demande->notes_admin ?? '') . $nouvelleNote;
            $demande->statut = 'en_cours';
            $demande->save();

            Log::info('Nouveau devis demandé par le client', [
                'user_id' => $user->id,
                'demande_id' => $demande->id,
                'reference' => $demande->reference,
            ]);

            return back()->with('success', 'Votre demande de nouveau devis a été envoyée. Nous vous contacterons sous 48h.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la demande de nouveau devis', [
                'user_id' => $user->id,
                'demande_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande.');
        }
    }

    /**
     * Confirmer un devis reçu
     */
    public function confirmerDevis($id)
    {
        $user = Auth::user();

        try {
            $demande = ConciergerieDemande::where('id', $id)
                ->where('email', $user->email)
                ->firstOrFail();

            // Vérifier que la demande a un devis envoyé
            if ($demande->statut !== 'devis_envoye') {
                return back()->with('error', 'Seuls les devis envoyés peuvent être confirmés.');
            }

            // Vérifier qu'un montant de devis existe
            if (!$demande->montant_devis) {
                return back()->with('error', 'Aucun devis n\'a été envoyé pour cette demande.');
            }

            $ancienStatut = $demande->statut;
            $demande->statut = 'confirme';
            $demande->save();

            Log::info('Devis confirmé par le client', [
                'user_id' => $user->id,
                'demande_id' => $demande->id,
                'reference' => $demande->reference,
                'ancien_statut' => $ancienStatut,
                'nouveau_statut' => $demande->statut,
                'montant_devis' => $demande->montant_devis,
            ]);

            return back()->with('success', 'Devis confirmé avec succès! Nous vous contacterons pour les étapes suivantes.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la confirmation du devis', [
                'user_id' => $user->id,
                'demande_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Une erreur est survenue lors de la confirmation du devis.');
        }
    }

    /**
     * Statistiques des demandes de l'utilisateur
     */
    public function statistiques()
    {
        $user = Auth::user();

        $statistiques = [
            'total' => ConciergerieDemande::where('email', $user->email)->count(),
            'nouvelles' => ConciergerieDemande::where('email', $user->email)->where('statut', 'nouvelle')->count(),
            'en_cours' => ConciergerieDemande::where('email', $user->email)->where('statut', 'en_cours')->count(),
            'devis_envoyes' => ConciergerieDemande::where('email', $user->email)->where('statut', 'devis_envoye')->count(),
            'confirmees' => ConciergerieDemande::where('email', $user->email)->where('statut', 'confirme')->count(),
            'annulees' => ConciergerieDemande::where('email', $user->email)->where('statut', 'annule')->count(),
            'terminees' => ConciergerieDemande::where('email', $user->email)->where('statut', 'termine')->count(),
        ];

        // Demandes par mois (6 derniers mois)
        $sixMoisAuparavant = Carbon::now()->subMonths(6)->startOfMonth();
        $demandesParMois = ConciergerieDemande::where('email', $user->email)
            ->where('created_at', '>=', $sixMoisAuparavant)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as mois, COUNT(*) as total')
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->keyBy('mois');

        // Demandes par motif
        $demandesParMotif = ConciergerieDemande::where('email', $user->email)
            ->selectRaw('motif_voyage, COUNT(*) as total')
            ->groupBy('motif_voyage')
            ->orderByDesc('total')
            ->get()
            ->keyBy('motif_voyage');

        return view('client.conciergerie-demandes.statistiques', compact('statistiques', 'demandesParMois', 'demandesParMotif'));
    }

    /**
     * Exporter une demande en PDF (Version corrigée)
     */
    public function exportPdf($id)
    {
        $user = Auth::user();

        $demande = ConciergerieDemande::where('id', $id)
            ->where('email', $user->email)
            ->firstOrFail();

        // Formater les données pour la vue PDF
        $data = [
            'demande' => $demande,
            'date_export' => now()->format('d/m/Y H:i'),
            'user' => $user,
        ];

        // OPTION 1: Si vous avez DomPDF installé (RECOMMANDÉ)
        // Décommentez les lignes ci-dessous si vous avez installé DomPDF

        /*
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('client.conciergerie-demandes.pdf', $data)
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'defaultFont' => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        // Télécharger le PDF
        return $pdf->download('demande-conciergerie-' . $demande->reference . '.pdf');
        */

        // OPTION 2: Solution temporaire - Forcer le téléchargement avec headers
        $html = view('client.conciergerie-demandes.pdf', $data)->render();

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="demande-conciergerie-' . $demande->reference . '.pdf"',
            'Cache-Control' => 'public, must-revalidate, max-age=0',
            'Pragma' => 'public',
            'Expires' => '0',
        ];

        // Créer une réponse avec le HTML et forcer le téléchargement comme PDF
        // Note: Ce n'est pas un vrai PDF, c'est du HTML renommé en PDF
        return response($html, 200, $headers);
    }

    /**
     * Suivi public d'une demande via référence (accessible sans login)
     */
    public function suivi($reference)
    {
        $demande = ConciergerieDemande::where('reference', $reference)->firstOrFail();

        return view('conciergerie.suivi', compact('demande'));
    }
}
