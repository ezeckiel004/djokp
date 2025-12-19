<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\LocationReservation;
use App\Models\Reservation;
use App\Models\ConciergerieDemande;
use App\Models\Paiement;
use App\Models\UserFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Afficher le dashboard client
     */
    public function index()
    {
        $user = Auth::user();

        // Vérification importante : S'assurer que l'utilisateur peut accéder au dashboard client
        // Option 1 : Si vous utilisez spatie/laravel-permission
        if (method_exists($user, 'hasRole')) {
            // Rediriger les non-clients vers leurs dashboards respectifs
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('formateur')) {
                return redirect()->route('formateur.dashboard');
            } elseif ($user->hasRole('chauffeur')) {
                return redirect()->route('chauffeur.dashboard');
            }
        }

        // Option 2 : Vérification par role_id si vous avez un champ role_id
        if (property_exists($user, 'role_id')) {
            // Supposons que role_id 5 = client
            if ($user->role_id != 5) {
                // Rediriger selon le rôle
                if ($user->role_id == 1) { // admin
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role_id == 2) { // formateur
                    return redirect()->route('formateur.dashboard');
                } elseif ($user->role_id == 3) { // chauffeur
                    return redirect()->route('chauffeur.dashboard');
                }
            }
        }

        // Vérifier si l'utilisateur vient de compléter un paiement (message de session)
        $paymentSuccessMessage = null;
        $newFormationAccess = null;

        if (session('success')) {
            $paymentSuccessMessage = session('success');

            // Si le message contient "accès à la formation", extraire le nom de la formation
            if (strpos($paymentSuccessMessage, 'formation') !== false) {
                // Récupérer la dernière formation achetée
                $latestPayment = Paiement::where('user_id', $user->id)
                    ->where('status', 'paid')
                    ->latest()
                    ->first();

                if ($latestPayment) {
                    $newFormationAccess = $latestPayment->formation->title ?? null;
                }
            }
        }

        // Formations actives
        $formationsActives = UserFormation::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('formation')
            ->latest()
            ->limit(5)
            ->get();

        // Formations disponibles (pour recommandations)
        $formationsDisponibles = Formation::where('is_active', true)
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('formation_id')
                    ->from('user_formations')
                    ->where('user_id', $user->id);
            })
            ->limit(3)
            ->get();

        // Réservations location récentes
        $locationReservations = LocationReservation::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->with('vehicle')
            ->latest()
            ->limit(5)
            ->get();

        // Réservations VTC récentes
        $reservations = Reservation::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->latest()
            ->limit(5)
            ->get();

        // Demandes conciergerie récentes
        $conciergerieDemandes = ConciergerieDemande::where('email', $user->email)
            ->latest()
            ->limit(5)
            ->get();

        // Factures récentes
        $factures = Paiement::where('user_id', $user->id)
            ->where('status', 'paid')
            ->latest()
            ->limit(5)
            ->get();

        // Statistiques
        $stats = [
            'formations_actives' => UserFormation::where('user_id', $user->id)
                ->where('status', 'active')
                ->count(),
            'formations_total' => UserFormation::where('user_id', $user->id)->count(),
            'formations_en_attente' => UserFormation::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count(),
            'formations_terminees' => UserFormation::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
            'location_reservations' => LocationReservation::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->count(),
            'reservations_vtc' => Reservation::where('user_id', $user->id)
                ->orWhere('email', $user->email)
                ->count(),
            'conciergerie_demandes' => ConciergerieDemande::where('email', $user->email)->count(),
            'factures' => Paiement::where('user_id', $user->id)
                ->where('status', 'paid')
                ->count(),
            'depenses_total' => Paiement::where('user_id', $user->id)
                ->where('status', 'paid')
                ->sum('amount'),
        ];

        // Formations recommandées (basées sur les catégories déjà achetées)
        $categoriesAchetees = UserFormation::where('user_id', $user->id)
            ->join('formations', 'user_formations.formation_id', '=', 'formations.id')
            ->pluck('formations.categorie')
            ->unique()
            ->toArray();

        if (!empty($categoriesAchetees)) {
            $formationsRecommandees = Formation::where('is_active', true)
                ->whereIn('categorie', $categoriesAchetees)
                ->whereNotIn('id', function ($query) use ($user) {
                    $query->select('formation_id')
                        ->from('user_formations')
                        ->where('user_id', $user->id);
                })
                ->limit(3)
                ->get();
        } else {
            $formationsRecommandees = $formationsDisponibles;
        }

        return view('client.dashboard.index', compact(
            'formationsActives',
            'formationsDisponibles',
            'formationsRecommandees',
            'locationReservations',
            'reservations',
            'conciergerieDemandes',
            'factures',
            'stats',
            'paymentSuccessMessage',
            'newFormationAccess'
        ));
    }

    /**
     * API pour les statistiques en temps réel
     */
    public function getStats(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        $stats = [
            'formations_actives' => UserFormation::where('user_id', $user->id)
                ->where('status', 'active')
                ->count(),
            'formations_total' => UserFormation::where('user_id', $user->id)->count(),
            'formations_en_attente' => UserFormation::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count(),
            'factures_recentes' => Paiement::where('user_id', $user->id)
                ->where('status', 'paid')
                ->where('created_at', '>=', now()->subDays(30))
                ->count(),
            'depenses_mensuelles' => Paiement::where('user_id', $user->id)
                ->where('status', 'paid')
                ->where('created_at', '>=', now()->subDays(30))
                ->sum('amount'),
        ];

        return response()->json($stats);
    }

    /**
     * API pour les formations récentes
     */
    public function getRecentFormations(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        $formations = UserFormation::where('user_id', $user->id)
            ->with(['formation' => function ($query) {
                $query->select('id', 'title', 'type_formation', 'categorie');
            }])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($userFormation) {
                return [
                    'id' => $userFormation->id,
                    'formation_id' => $userFormation->formation_id,
                    'title' => $userFormation->formation->title ?? 'Formation',
                    'type' => $userFormation->formation->type_formation ?? '',
                    'categorie' => $userFormation->formation->categorie ?? '',
                    'status' => $userFormation->status,
                    'progress' => $userFormation->progress ?? 0,
                    'created_at' => $userFormation->created_at->format('d/m/Y'),
                    'access_end' => $userFormation->access_end ? $userFormation->access_end->format('d/m/Y') : null,
                    'show_url' => route('client.formations.show', $userFormation->id),
                    'access_url' => $userFormation->status === 'active' ?
                        route('client.formations.acceder', $userFormation->id) : null,
                ];
            });

        return response()->json($formations);
    }

    /**
     * API pour les formations recommandées
     */
    public function getRecommendedFormations(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        // Récupérer les catégories des formations déjà achetées
        $categoriesAchetees = UserFormation::where('user_id', $user->id)
            ->join('formations', 'user_formations.formation_id', '=', 'formations.id')
            ->pluck('formations.categorie')
            ->unique()
            ->toArray();

        $formations = Formation::where('is_active', true)
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('formation_id')
                    ->from('user_formations')
                    ->where('user_id', $user->id);
            })
            ->when(!empty($categoriesAchetees), function ($query) use ($categoriesAchetees) {
                return $query->whereIn('categorie', $categoriesAchetees);
            })
            ->limit(6)
            ->get()
            ->map(function ($formation) {
                return [
                    'id' => $formation->id,
                    'title' => $formation->title,
                    'type' => $formation->type_formation,
                    'categorie' => $formation->categorie,
                    'price' => $formation->price,
                    'price_formatted' => number_format($formation->price, 0, ',', ' ') . ' €',
                    'duree' => $formation->duree,
                    'format_affichage' => $formation->format_affichage,
                    'description_short' => str_limit(strip_tags($formation->description), 100),
                    'has_media' => $formation->media()->count() > 0,
                    'details_url' => route('client.formations.catalogue.details', $formation->id),
                    'inscription_url' => route('client.formations.inscrire', $formation->id),
                ];
            });

        return response()->json($formations);
    }

    /**
     * API pour les activités récentes
     */
    public function getRecentActivity(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        $activities = collect();

        // Paiements récents
        $paiements = Paiement::where('user_id', $user->id)
            ->with('formation')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($paiement) {
                return [
                    'type' => 'payment',
                    'title' => $paiement->formation->title ?? 'Formation',
                    'description' => 'Paiement de ' . number_format($paiement->amount, 0, ',', ' ') . ' €',
                    'status' => $paiement->status,
                    'date' => $paiement->created_at->format('d/m/Y H:i'),
                    'color' => $paiement->status === 'paid' ? 'green' : ($paiement->status === 'pending' ? 'yellow' : 'red'),
                    'icon' => 'fa-euro-sign',
                ];
            });

        // Inscriptions récentes
        $inscriptions = UserFormation::where('user_id', $user->id)
            ->with('formation')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($userFormation) {
                return [
                    'type' => 'inscription',
                    'title' => $userFormation->formation->title ?? 'Formation',
                    'description' => 'Inscription à la formation',
                    'status' => $userFormation->status,
                    'date' => $userFormation->created_at->format('d/m/Y H:i'),
                    'color' => $userFormation->status === 'active' ? 'green' : ($userFormation->status === 'pending' ? 'yellow' : 'blue'),
                    'icon' => 'fa-user-plus',
                ];
            });

        // Réservations location
        $locations = LocationReservation::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->with('vehicle')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($reservation) {
                return [
                    'type' => 'location',
                    'title' => $reservation->vehicle->brand . ' ' . $reservation->vehicle->model ?? 'Véhicule',
                    'description' => 'Réservation du ' . $reservation->start_date->format('d/m') .
                        ' au ' . $reservation->end_date->format('d/m/Y'),
                    'status' => $reservation->status,
                    'date' => $reservation->created_at->format('d/m/Y H:i'),
                    'color' => $reservation->status === 'confirmed' ? 'green' : ($reservation->status === 'pending' ? 'yellow' : 'red'),
                    'icon' => 'fa-car',
                ];
            });

        // Conciergerie
        $conciergeries = ConciergerieDemande::where('email', $user->email)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($demande) {
                return [
                    'type' => 'conciergerie',
                    'title' => $demande->service,
                    'description' => 'Demande de service',
                    'status' => $demande->statut,
                    'date' => $demande->created_at->format('d/m/Y H:i'),
                    'color' => $demande->statut === 'traitee' ? 'green' : ($demande->statut === 'en_attente' ? 'yellow' : 'blue'),
                    'icon' => 'fa-concierge-bell',
                ];
            });

        // Fusionner et trier par date
        $activities = $activities->merge($paiements)
            ->merge($inscriptions)
            ->merge($locations)
            ->merge($conciergeries)
            ->sortByDesc('date')
            ->values()
            ->take(10);

        return response()->json($activities);
    }

    /**
     * Télécharger le rapport d'activité
     */
    public function downloadActivityReport(Request $request)
    {
        $user = Auth::user();

        // Générer un rapport PDF des activités
        // (À implémenter avec DomPDF ou autre bibliothèque)

        return response()->json([
            'message' => 'Rapport généré avec succès',
            'download_url' => '#'
        ]);
    }
}
