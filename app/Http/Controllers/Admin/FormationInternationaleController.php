<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeFormationInternationale;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemandeStatutChangedMail;

class FormationInternationaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DemandeFormationInternationale::with('formation')
            ->orderBy('created_at', 'desc');

        // Filtre par statut
        if ($request->has('statut') && $request->statut != '') {
            $query->where('statut', $request->statut);
        }

        $demandes = $query->paginate(20);

        return view('admin.formation-internationale.index', compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formations = Formation::where('is_active', true)
            ->whereIn('categorie', ['vtc_theorique', 'vtc_pratique', 'e_learning'])
            ->orderBy('title')
            ->get();

        return view('admin.formation-internationale.create', compact('formations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'nationalite' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'formation_id' => 'nullable|exists:formations,id',
            'formation_personnalisee' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
            'services' => 'nullable|array',
            'date_debut' => 'nullable|date',
            'duree' => 'nullable|string|max:50',
            'statut' => 'required|in:nouveau,en_cours,traite,annule',
            'notes_admin' => 'nullable|string'
        ]);

        // Validation : au moins formation_id ou formation_personnalisee doit être rempli
        if (empty($request->formation_id) && empty($request->formation_personnalisee)) {
            return back()
                ->withInput()
                ->withErrors(['formation_id' => 'Veuillez sélectionner une formation ou saisir une formation personnalisée.']);
        }

        DemandeFormationInternationale::create([
            'nom_complet' => $request->nom_complet,
            'nationalite' => $request->nationalite,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'whatsapp' => $request->whatsapp,
            'formation_id' => $request->formation_id,
            'formation_personnalisee' => $request->formation_personnalisee,
            'message' => strip_tags($request->message),
            'services' => $request->services ?? [],
            'date_debut' => $request->date_debut,
            'duree' => $request->duree,
            'statut' => $request->statut,
            'notes_admin' => $request->notes_admin
        ]);

        return redirect()
            ->route('admin.demandes-formation-internationale.index')
            ->with('success', 'Demande créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DemandeFormationInternationale $demande)
    {
        return view('admin.formation-internationale.show', compact('demande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DemandeFormationInternationale $demande)
    {
        $formations = Formation::where('is_active', true)
            ->whereIn('categorie', ['vtc_theorique', 'vtc_pratique', 'e_learning'])
            ->orderBy('title')
            ->get();

        return view('admin.formation-internationale.edit', compact('demande', 'formations'));
    }

    /**
     * Update the specified resource in storage (FORMULAIRE COMPLET d'edit).
     */
    public function update(Request $request, DemandeFormationInternationale $demande)
    {
        // Cette méthode est UNIQUEMENT pour le formulaire COMPLET d'edit.blade.php
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'nationalite' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'formation_id' => 'nullable|exists:formations,id',
            'formation_personnalisee' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
            'services' => 'nullable|array',
            'date_debut' => 'nullable|date',
            'duree' => 'nullable|string|max:50',
            'statut' => 'required|in:nouveau,en_cours,traite,annule',
            'notes_admin' => 'nullable|string'
        ]);

        // Validation : au moins formation_id ou formation_personnalisee doit être rempli
        if (empty($request->formation_id) && empty($request->formation_personnalisee)) {
            return back()
                ->withInput()
                ->withErrors(['formation_id' => 'Veuillez sélectionner une formation ou saisir une formation personnalisée.']);
        }

        // Sauvegarde de l'ancien statut
        $ancienStatut = $demande->statut;

        $demande->update([
            'nom_complet' => $request->nom_complet,
            'nationalite' => $request->nationalite,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'whatsapp' => $request->whatsapp,
            'formation_id' => $request->formation_id,
            'formation_personnalisee' => $request->formation_personnalisee,
            'message' => strip_tags($request->message),
            'services' => $request->services ?? [],
            'date_debut' => $request->date_debut,
            'duree' => $request->duree,
            'statut' => $request->statut,
            'notes_admin' => $request->notes_admin
        ]);

        // Envoyer un email si le statut a changé
        if ($ancienStatut !== $request->statut) {
            try {
                Mail::to($demande->email)->send(new DemandeStatutChangedMail($demande, $ancienStatut));
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email statut: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('admin.demandes-formation-internationale.show', $demande)
            ->with('success', 'Demande mise à jour avec succès.');
    }

    /**
     * Mettre à jour seulement le statut (depuis show.blade.php)
     */
    public function updateStatut(Request $request, DemandeFormationInternationale $demande)
    {
        // Validation uniquement pour le statut et notes
        $request->validate([
            'statut' => 'required|in:nouveau,en_cours,traite,annule',
            'notes_admin' => 'nullable|string'
        ]);

        // Sauvegarde de l'ancien statut
        $ancienStatut = $demande->statut;

        // Mettre à jour seulement le statut et les notes
        $demande->update([
            'statut' => $request->statut,
            'notes_admin' => $request->notes_admin
        ]);

        // Envoyer un email si le statut a changé
        if ($ancienStatut !== $request->statut) {
            try {
                Mail::to($demande->email)->send(new DemandeStatutChangedMail($demande, $ancienStatut));
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email statut: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('admin.demandes-formation-internationale.show', $demande)
            ->with('success', 'Statut mis à jour avec succès.' . ($ancienStatut !== $request->statut ? ' Un email a été envoyé au client.' : ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DemandeFormationInternationale $demande)
    {
        $demande->delete();

        return redirect()
            ->route('admin.demandes-formation-internationale.index')
            ->with('success', 'Demande supprimée avec succès.');
    }

    /**
     * Mettre à jour rapidement le statut (depuis la page index)
     */
    public function updateStatus(Request $request, DemandeFormationInternationale $demande)
    {
        $request->validate([
            'statut' => 'required|in:nouveau,en_cours,traite,annule'
        ]);

        // Sauvegarde de l'ancien statut
        $ancienStatut = $demande->statut;

        $demande->update([
            'statut' => $request->statut
        ]);

        // Envoyer un email si le statut a changé
        if ($ancienStatut !== $request->statut) {
            try {
                Mail::to($demande->email)->send(new DemandeStatutChangedMail($demande, $ancienStatut));
            } catch (\Exception $e) {
                \Log::error('Erreur envoi email statut: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('admin.demandes-formation-internationale.index')
            ->with('success', 'Statut mis à jour avec succès.');
    }

    /**
     * Récupérer les statistiques pour le tableau de bord
     */
    public static function getStatistics()
    {
        return [
            'total' => DemandeFormationInternationale::count(),
            'nouveau' => DemandeFormationInternationale::where('statut', 'nouveau')->count(),
            'en_cours' => DemandeFormationInternationale::where('statut', 'en_cours')->count(),
            'traite' => DemandeFormationInternationale::where('statut', 'traite')->count(),
            'annule' => DemandeFormationInternationale::where('statut', 'annule')->count(),
        ];
    }

    /**
     * Récupérer les demandes récentes (7 derniers jours)
     */
    public static function getRecentDemandes($limit = 5)
    {
        return DemandeFormationInternationale::with('formation')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}
