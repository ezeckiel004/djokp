<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConciergerieDemande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\Conciergerie\EnCoursMail;
use App\Mail\Conciergerie\DevisEnvoyeMail;
use App\Mail\Conciergerie\ConfirmeMail;
use App\Mail\Conciergerie\AnnuleMail;
use App\Mail\Conciergerie\TermineMail;
use App\Mail\Conciergerie\StatutChangeMail;
use Carbon\Carbon;

class ConciergerieController extends Controller
{
    public function index(Request $request)
    {
        $query = ConciergerieDemande::query();

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom_complet', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('reference', 'like', "%{$search}%");
            });
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        // Tri
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $query->orderBy($sort, $order);

        $demandes = $query->paginate(20);

        return view('admin.conciergerie.index', compact('demandes'));
    }

    public function show(ConciergerieDemande $conciergerie)
    {
        return view('admin.conciergerie.show', compact('conciergerie'));
    }

    public function updateStatut(Request $request, ConciergerieDemande $conciergerie)
    {
        $request->validate([
            'statut' => 'required|in:' . implode(',', array_keys(ConciergerieDemande::STATUTS)),
        ]);

        $ancienStatut = $conciergerie->statut;
        $nouveauStatut = $request->statut;

        // Log avant la mise à jour
        Log::info('Changement de statut de la demande de conciergerie', [
            'demande_id' => $conciergerie->id,
            'reference' => $conciergerie->reference,
            'ancien_statut' => $ancienStatut,
            'nouveau_statut' => $nouveauStatut,
            'utilisateur' => auth()->user()->email,
            'ip' => $request->ip(),
        ]);

        // Mettre à jour le statut
        $conciergerie->update(['statut' => $nouveauStatut]);

        // Envoyer l'email selon le nouveau statut
        try {
            $this->envoyerEmailStatut($conciergerie, $ancienStatut, $nouveauStatut);

            Log::info('Email de statut envoyé avec succès', [
                'demande_id' => $conciergerie->id,
                'reference' => $conciergerie->reference,
                'email_destinataire' => $conciergerie->email,
                'statut' => $nouveauStatut,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi de l\'email de statut', [
                'demande_id' => $conciergerie->id,
                'reference' => $conciergerie->reference,
                'erreur' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return back()->with('success', 'Statut mis à jour avec succès et email envoyé au client.');
    }

    private function envoyerEmailStatut($demande, $ancienStatut, $nouveauStatut)
    {
        // Ne pas envoyer d'email si le statut n'a pas changé
        if ($ancienStatut === $nouveauStatut) {
            Log::info('Statut identique, aucun email envoyé', [
                'demande_id' => $demande->id,
                'statut' => $nouveauStatut,
            ]);
            return;
        }

        try {
            // Sélectionner la classe Mail selon le statut
            switch ($nouveauStatut) {
                case 'en_cours':
                    Mail::to($demande->email)
                        ->send(new EnCoursMail($demande, $ancienStatut));
                    break;

                case 'devis_envoye':
                    // Note: Pour devis_envoye, on utilise une autre méthode spécifique
                    // Cette classe est utilisée uniquement pour les changements manuels de statut
                    Mail::to($demande->email)
                        ->send(new StatutChangeMail($demande, $ancienStatut, $nouveauStatut));
                    break;

                case 'confirme':
                    Mail::to($demande->email)
                        ->send(new ConfirmeMail($demande, $ancienStatut));
                    break;

                case 'annule':
                    Mail::to($demande->email)
                        ->send(new AnnuleMail($demande, $ancienStatut, 'Changement manuel de statut'));
                    break;

                case 'termine':
                    Mail::to($demande->email)
                        ->send(new TermineMail($demande, $ancienStatut));
                    break;

                default:
                    // Pour les autres statuts, envoyer un email générique
                    Mail::to($demande->email)
                        ->send(new StatutChangeMail($demande, $ancienStatut, $nouveauStatut));
                    break;
            }
        } catch (\Exception $e) {
            throw $e; // Relancer l'exception pour que le contrôleur principal la gère
        }
    }

    public function envoyerDevis(Request $request, ConciergerieDemande $conciergerie)
    {
        $request->validate([
            'montant_devis' => 'required|numeric|min:0',
            'details_devis' => 'required|string',
            'notes_client' => 'nullable|string',
        ]);

        // Log avant envoi du devis
        Log::info('Envoi de devis pour demande de conciergerie', [
            'demande_id' => $conciergerie->id,
            'reference' => $conciergerie->reference,
            'montant' => $request->montant_devis,
            'utilisateur' => auth()->user()->email,
            'ip' => $request->ip(),
        ]);

        // Sauvegarder les notes du devis séparément
        $detailsDevis = $request->details_devis;
        $notesClient = $request->notes_client ?? '';

        $conciergerie->update([
            'montant_devis' => $request->montant_devis,
            'notes_admin' => $conciergerie->notes_admin ? $conciergerie->notes_admin . "\n\n--- DEVIS ---\n" . $detailsDevis : $detailsDevis,
            'statut' => 'devis_envoye',
            'date_devis' => now(),
        ]);

        try {
            // Envoi du devis par email
            Mail::to($conciergerie->email)
                ->send(new DevisEnvoyeMail($conciergerie, $detailsDevis, $notesClient, $conciergerie->statut));

            Log::info('Devis envoyé avec succès', [
                'demande_id' => $conciergerie->id,
                'reference' => $conciergerie->reference,
                'email_destinataire' => $conciergerie->email,
                'montant' => $request->montant_devis,
            ]);

            return back()->with('success', 'Devis envoyé au client avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du devis', [
                'demande_id' => $conciergerie->id,
                'reference' => $conciergerie->reference,
                'erreur' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Erreur lors de l\'envoi du devis: ' . $e->getMessage());
        }
    }

    public function ajouterNotes(Request $request, ConciergerieDemande $conciergerie)
    {
        $request->validate([
            'notes' => 'required|string',
        ]);

        Log::info('Ajout de notes à une demande de conciergerie', [
            'demande_id' => $conciergerie->id,
            'reference' => $conciergerie->reference,
            'utilisateur' => auth()->user()->email,
            'longueur_notes' => strlen($request->notes),
        ]);

        $notesActuelles = $conciergerie->notes_admin ?? '';
        $nouvellesNotes = $notesActuelles . "\n\n" . date('d/m/Y H:i') . " - " . $request->notes;

        $conciergerie->update(['notes_admin' => trim($nouvellesNotes)]);

        return back()->with('success', 'Notes ajoutées avec succès.');
    }

    public function destroy(ConciergerieDemande $conciergerie)
    {
        Log::warning('Suppression de demande de conciergerie', [
            'demande_id' => $conciergerie->id,
            'reference' => $conciergerie->reference,
            'statut' => $conciergerie->statut,
            'utilisateur' => auth()->user()->email,
            'client' => $conciergerie->email,
        ]);

        $conciergerie->delete();

        return redirect()->route('admin.conciergerie-demandes.index')
            ->with('success', 'Demande supprimée avec succès.');
    }

    public function statistiques()
    {
        try {
            // Statistiques par statut
            $statsParStatut = ConciergerieDemande::selectRaw('statut, COUNT(*) as count')
                ->groupBy('statut')
                ->get()
                ->keyBy('statut');

            // Statistiques par mois (derniers 6 mois pour plus de lisibilité)
            $statsMensuelles = ConciergerieDemande::selectRaw('
                DATE_FORMAT(created_at, "%Y-%m") as mois,
                COUNT(*) as total,
                SUM(CASE WHEN statut = "nouvelle" THEN 1 ELSE 0 END) as nouvelles,
                SUM(CASE WHEN statut = "confirme" THEN 1 ELSE 0 END) as confirmees,
                SUM(CASE WHEN montant_devis IS NOT NULL THEN montant_devis ELSE 0 END) as chiffre_affaires
            ')
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->groupBy('mois')
                ->orderBy('mois')
                ->get();

            // Statistiques par motif
            $statsParMotif = ConciergerieDemande::selectRaw('motif, COUNT(*) as count')
                ->groupBy('motif')
                ->orderByDesc('count')
                ->get();

            // Totaux
            $total = ConciergerieDemande::count();
            $nouvelles = ConciergerieDemande::where('statut', 'nouvelle')->count();
            $confirmees = ConciergerieDemande::where('statut', 'confirme')->count();
            $annulees = ConciergerieDemande::where('statut', 'annule')->count();
            $devisEnvoyes = ConciergerieDemande::where('statut', 'devis_envoye')->count();

            // Chiffre d'affaires total
            $chiffreAffairesTotal = ConciergerieDemande::whereNotNull('montant_devis')->sum('montant_devis') ?: 0;

            // Moyenne du montant des devis
            $moyenneDevis = ConciergerieDemande::whereNotNull('montant_devis')->avg('montant_devis') ?: 0;

            // Services les plus demandés (si le champ services existe)
            $servicesDemandes = collect();
            if (ConciergerieDemande::first() && property_exists(ConciergerieDemande::first(), 'services')) {
                $servicesDemandes = ConciergerieDemande::whereNotNull('services')
                    ->pluck('services')
                    ->flatten()
                    ->countBy()
                    ->sortDesc()
                    ->take(5);
            }

            // Log de consultation des statistiques
            Log::info('Consultation des statistiques de conciergerie', [
                'utilisateur' => auth()->user()->email,
                'total_demandes' => $total,
                'chiffre_affaires' => $chiffreAffairesTotal,
            ]);

            return view('admin.conciergerie.statistiques', compact(
                'statsParStatut',
                'statsMensuelles',
                'statsParMotif',
                'total',
                'nouvelles',
                'confirmees',
                'annulees',
                'devisEnvoyes',
                'chiffreAffairesTotal',
                'moyenneDevis',
                'servicesDemandes'
            ));
        } catch (\Exception $e) {
            // Log de l'erreur
            Log::error('Erreur dans statistiques conciergerie', [
                'erreur' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'utilisateur' => auth()->user()->email ?? 'non authentifié',
            ]);

            // En cas d'erreur, retourner une vue simplifiée
            return view('admin.conciergerie.statistiques', [
                'statsParStatut' => collect(),
                'statsMensuelles' => collect(),
                'statsParMotif' => collect(),
                'total' => 0,
                'nouvelles' => 0,
                'confirmees' => 0,
                'annulees' => 0,
                'devisEnvoyes' => 0,
                'chiffreAffairesTotal' => 0,
                'moyenneDevis' => 0,
                'servicesDemandes' => collect(),
            ]);
        }
    }
}
