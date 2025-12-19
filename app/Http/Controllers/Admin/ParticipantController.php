<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParticipantStatusEmail;

class ParticipantController extends Controller
{
    /**
     * Afficher la liste des participants
     */
    public function index(Request $request)
    {
        // Requête de base
        $query = Participant::with(['formation', 'user', 'paiement'])
            ->orderBy('created_at', 'desc');

        // Filtres
        $this->applyFilters($query, $request);

        // Pagination
        $participants = $query->paginate(20);

        // Données pour les filtres
        $formations = Formation::where('is_active', true)->orderBy('title')->get();
        $statuts = [
            'en_attente' => 'En attente',
            'confirme' => 'Confirmé',
            'annule' => 'Annulé',
            'termine' => 'Terminé',
        ];

        $typesFormation = [
            'presentiel' => 'Présentiel',
            'en_ligne' => 'En ligne',
            'mixte' => 'Mixte',
        ];

        return view('admin.participants.index', compact(
            'participants',
            'formations',
            'statuts',
            'typesFormation'
        ));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $formations = Formation::where('is_active', true)->orderBy('title')->get();
        $users = User::where('is_active', 1)->orderBy('name')->get();

        return view('admin.participants.create', compact('formations', 'users'));
    }

    /**
     * Enregistrer un nouveau participant
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'user_id' => 'nullable|exists:users,id',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'code_postal' => 'nullable|string|max:10',
            'date_naissance' => 'nullable|date',
            'permis_date' => 'nullable|date',
            'type_formation' => 'required|in:presentiel,en_ligne,mixte',
            'statut' => 'required|in:en_attente,confirme,annule,termine',
            'notes' => 'nullable|string',
        ]);

        try {
            $participant = Participant::create($validated);

            // Envoyer un email de confirmation d'inscription
            if ($participant->email) {
                try {
                    Mail::to($participant->email)->send(new ParticipantStatusEmail(
                        $participant,
                        'en_attente', // Statut initial
                        'en_attente', // Nouveau statut (identique au départ)
                        'Inscription confirmée'
                    ));
                } catch (\Exception $mailException) {
                    \Log::error('Erreur envoi email inscription: ' . $mailException->getMessage());
                }
            }

            return redirect()->route('admin.participants.index')
                ->with('success', 'Participant ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'ajout du participant: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Afficher les détails d'un participant
     */
    public function show($id)
    {
        $participant = Participant::with(['formation', 'user', 'paiement'])
            ->findOrFail($id);

        return view('admin.participants.show', compact('participant'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit($id)
    {
        $participant = Participant::findOrFail($id);
        $formations = Formation::where('is_active', true)->orderBy('title')->get();
        $users = User::where('is_active', 1)->orderBy('name')->get();

        return view('admin.participants.edit', compact('participant', 'formations', 'users'));
    }

    /**
     * Mettre à jour un participant
     */
    public function update(Request $request, $id)
    {
        $participant = Participant::findOrFail($id);

        // Sauvegarde de l'ancien statut pour l'email
        $oldStatus = $participant->statut;

        $validated = $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'user_id' => 'nullable|exists:users,id',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:100',
            'code_postal' => 'nullable|string|max:10',
            'date_naissance' => 'nullable|date',
            'permis_date' => 'nullable|date',
            'type_formation' => 'required|in:presentiel,en_ligne,mixte',
            'statut' => 'required|in:en_attente,confirme,annule,termine',
            'progression' => 'nullable|numeric|min:0|max:100',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        try {
            $participant->update($validated);

            // Envoyer un email si le statut a changé
            if ($oldStatus !== $participant->statut && $participant->email) {
                try {
                    $subject = $this->getStatusEmailSubject($participant->statut);
                    Mail::to($participant->email)->send(new ParticipantStatusEmail(
                        $participant,
                        $oldStatus,
                        $participant->statut,
                        $subject
                    ));
                } catch (\Exception $mailException) {
                    \Log::error('Erreur envoi email mise à jour: ' . $mailException->getMessage());
                }
            }

            return redirect()->route('admin.participants.index')
                ->with('success', 'Participant mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Mettre à jour uniquement le statut
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirme,annule,termine',
            'date_debut' => 'nullable|date',
            'date_fin' => 'nullable|date',
        ]);

        $participant = Participant::with(['formation', 'user'])->findOrFail($id);

        // Sauvegarde de l'ancien statut pour l'email
        $oldStatus = $participant->statut;

        $updateData = ['statut' => $request->statut];

        // Si on confirme et qu'il n'y a pas de date de début, on la met à aujourd'hui
        if ($request->statut === 'confirme' && !$participant->date_debut) {
            $updateData['date_debut'] = $request->date_debut ?: now();
        }

        // Si on termine et qu'il n'y a pas de date de fin, on la met à aujourd'hui
        if ($request->statut === 'termine' && !$participant->date_fin) {
            $updateData['date_fin'] = $request->date_fin ?: now();
            $updateData['progression'] = 100;
        }

        // Mise à jour des dates si fournies
        if ($request->filled('date_debut')) {
            $updateData['date_debut'] = $request->date_debut;
        }

        if ($request->filled('date_fin')) {
            $updateData['date_fin'] = $request->date_fin;
        }

        $participant->update($updateData);

        // Envoyer un email si le statut a changé
        if ($oldStatus !== $participant->statut && $participant->email) {
            try {
                $subject = $this->getStatusEmailSubject($participant->statut);
                Mail::to($participant->email)->send(new ParticipantStatusEmail(
                    $participant,
                    $oldStatus,
                    $participant->statut,
                    $subject
                ));
            } catch (\Exception $mailException) {
                \Log::error('Erreur envoi email changement statut: ' . $mailException->getMessage());
                // On continue malgré l'erreur d'email
            }
        }

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }

    /**
     * Supprimer un participant
     */
    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);

        try {
            // Envoyer un email de confirmation de suppression
            if ($participant->email) {
                try {
                    $subject = 'Confirmation de suppression - Formation DJOK Prestige';
                    Mail::to($participant->email)->send(new ParticipantStatusEmail(
                        $participant,
                        $participant->statut,
                        'supprime',
                        $subject
                    ));
                } catch (\Exception $mailException) {
                    \Log::error('Erreur envoi email suppression: ' . $mailException->getMessage());
                    // On continue malgré l'erreur d'email
                }
            }

            $participant->delete();

            return redirect()->route('admin.participants.index')
                ->with('success', 'Participant supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
        }
    }

    /**
     * Exporter les participants
     */
    public function export(Request $request)
    {
        $query = Participant::with(['formation', 'user', 'paiement']);
        $this->applyFilters($query, $request);

        $participants = $query->get();

        return view('admin.participants.export', compact('participants'));
    }

    /**
     * Statistiques
     */
    public function statistics()
    {
        // Total participants
        $totalParticipants = Participant::count();

        // Par statut
        $parStatut = Participant::select('statut', DB::raw('COUNT(*) as count'))
            ->groupBy('statut')
            ->get()
            ->pluck('count', 'statut');

        // Par type de formation
        $parType = Participant::select('type_formation', DB::raw('COUNT(*) as count'))
            ->groupBy('type_formation')
            ->get()
            ->pluck('count', 'type_formation');

        // Par formation
        $parFormation = Participant::with('formation')
            ->select('formation_id', DB::raw('COUNT(*) as count'))
            ->groupBy('formation_id')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Évolution mensuelle
        $evolution = Participant::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mois'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        return view('admin.participants.statistics', compact(
            'totalParticipants',
            'parStatut',
            'parType',
            'parFormation',
            'evolution'
        ));
    }

    /**
     * Appliquer les filtres
     */
    private function applyFilters($query, Request $request): void
    {
        // Filtre par formation
        if ($request->filled('formation_id')) {
            $query->where('formation_id', $request->formation_id);
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par type de formation
        if ($request->filled('type_formation')) {
            $query->where('type_formation', $request->type_formation);
        }

        // Filtre par recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%");
            });
        }

        // Filtre par date
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }
    }

    /**
     * Obtenir le sujet d'email selon le statut
     */
    private function getStatusEmailSubject($status)
    {
        $subjects = [
            'en_attente' => 'Confirmation de votre inscription - Formation DJOK Prestige',
            'confirme' => 'Félicitations ! Votre formation est confirmée',
            'annule' => 'Information concernant votre inscription - Formation DJOK Prestige',
            'termine' => 'Félicitations ! Vous avez terminé votre formation',
            'supprime' => 'Confirmation de suppression - Formation DJOK Prestige',
        ];

        return $subjects[$status] ?? 'Mise à jour de votre statut - Formation DJOK Prestige';
    }
}
