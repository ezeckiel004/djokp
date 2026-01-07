<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationStatusUpdated;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index()
    {
        $reservations = Reservation::with(['user', 'vehicleCategory'])
            ->where('is_vtc_booking', true)
            ->orWhere('type', 'vtc_transport')
            ->latest()
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        // Récupérer les catégories de véhicules actives
        $vehicleCategories = VehicleCategory::where('actif', true)->get();

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $vtcServiceTypes = [
            'transfert' => 'Transfert aéroport/gare',
            'professionnel' => 'Déplacement professionnel',
            'evenement' => 'Événement/mariage',
            'mise_disposition' => 'Mise à disposition'
        ];

        return view('admin.reservations.create', compact('vehicleCategories', 'statuses', 'vtcServiceTypes'));
    }

    public function store(Request $request)
    {
        // Validation pour les réservations VTC
        $validated = $request->validate([
            'type_service' => 'required|in:transfert,professionnel,evenement,mise_disposition',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'heure' => 'required|date_format:H:i',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'passagers' => 'required|in:1,2,3,4,5,6,7,8',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instructions' => 'nullable|string|max:1000',
            'total_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        // Vérifier si l'utilisateur existe déjà par email
        $user = User::where('email', $validated['email'])->first();

        // Si pas d'utilisateur, utiliser user_id = null (réservation publique)
        $userId = $user ? $user->id : null;

        // Récupérer la catégorie de véhicule
        $vehicleCategory = VehicleCategory::findOrFail($validated['vehicle_category_id']);

        // Convertir passagers en passengers
        $passengers = (int) $validated['passagers'];

        // Créer la réservation
        $reservation = Reservation::create([
            'user_id' => $userId,
            'vehicle_category_id' => $vehicleCategory->id,
            'type' => 'vtc_transport',
            'start_date' => $validated['date'],
            'end_date' => $validated['date'],
            'pickup_time' => $validated['heure'],
            'pickup_location' => $validated['depart'],
            'dropoff_location' => $validated['arrivee'],
            'passengers' => $passengers,
            'total_amount' => $validated['total_amount'],
            'deposit_amount' => $validated['deposit_amount'] ?? 0,
            'status' => $validated['status'],
            'special_requests' => $validated['instructions'] ?? null,
            // Champs spécifiques VTC
            'type_service' => $validated['type_service'],
            'depart' => $validated['depart'],
            'arrivee' => $validated['arrivee'],
            'date' => $validated['date'],
            'heure' => $validated['heure'],
            'type_vehicule' => $vehicleCategory->display_name,
            'passagers' => $validated['passagers'],
            'nom' => $validated['nom'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'instructions' => $validated['instructions'] ?? null,
            'source' => $userId ? 'client' : 'public',
            'reference' => 'RES' . strtoupper(Str::random(8)),
            'is_vtc_booking' => true,
        ]);

        // Envoyer un email de confirmation si le statut est "confirmed"
        if ($validated['status'] === 'confirmed') {
            $this->sendStatusUpdateEmail($reservation);
        }

        return redirect()->route('admin.reservations.show', $reservation)
            ->with('success', 'Réservation VTC créée avec succès.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'vehicleCategory']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        // Récupérer les catégories de véhicules actives
        $vehicleCategories = VehicleCategory::where('actif', true)->get();

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $vtcServiceTypes = [
            'transfert' => 'Transfert aéroport/gare',
            'professionnel' => 'Déplacement professionnel',
            'evenement' => 'Événement/mariage',
            'mise_disposition' => 'Mise à disposition'
        ];

        return view('admin.reservations.edit', compact(
            'reservation',
            'vehicleCategories',
            'statuses',
            'vtcServiceTypes'
        ));
    }

    public function update(Request $request, Reservation $reservation)
    {
        // Validation pour les réservations VTC
        $validated = $request->validate([
            'type_service' => 'required|in:transfert,professionnel,evenement,mise_disposition',
            'depart' => 'required|string|max:255',
            'arrivee' => 'required|string|max:255',
            'date' => 'required|date',
            'heure' => 'required|date_format:H:i',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'passagers' => 'required|in:1,2,3,4,5,6,7,8',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'instructions' => 'nullable|string|max:1000',
            'total_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
        ]);

        // Vérifier si l'utilisateur existe déjà par email
        $user = User::where('email', $validated['email'])->first();
        $userId = $user ? $user->id : null;

        // Récupérer la catégorie de véhicule
        $vehicleCategory = VehicleCategory::findOrFail($validated['vehicle_category_id']);

        // Convertir passagers en passengers
        $passengers = (int) $validated['passagers'];

        // Sauvegarder l'ancien statut
        $oldStatus = $reservation->status;

        // Mettre à jour la réservation
        $reservation->update([
            'user_id' => $userId,
            'vehicle_category_id' => $vehicleCategory->id,
            'type' => 'vtc_transport',
            'start_date' => $validated['date'],
            'end_date' => $validated['date'],
            'pickup_time' => $validated['heure'],
            'pickup_location' => $validated['depart'],
            'dropoff_location' => $validated['arrivee'],
            'passengers' => $passengers,
            'total_amount' => $validated['total_amount'],
            'deposit_amount' => $validated['deposit_amount'] ?? 0,
            'status' => $validated['status'],
            'special_requests' => $validated['instructions'] ?? null,
            // Champs spécifiques VTC
            'type_service' => $validated['type_service'],
            'depart' => $validated['depart'],
            'arrivee' => $validated['arrivee'],
            'date' => $validated['date'],
            'heure' => $validated['heure'],
            'type_vehicule' => $vehicleCategory->display_name,
            'passagers' => $validated['passagers'],
            'nom' => $validated['nom'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'instructions' => $validated['instructions'] ?? null,
            'source' => $userId ? 'client' : 'public',
        ]);

        // Envoyer un email si le statut a changé
        if ($oldStatus !== $reservation->status) {
            $this->sendStatusUpdateEmail($reservation);
        }

        return redirect()->route('admin.reservations.show', $reservation)
            ->with('success', 'Réservation VTC mise à jour avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }

    /**
     * Envoie un email de mise à jour de statut
     */
    private function sendStatusUpdateEmail(Reservation $reservation)
    {
        try {
            $email = $reservation->user_id ? $reservation->user->email : $reservation->email;

            if ($email) {
                Mail::to($email)->send(new ReservationStatusUpdated($reservation));
            }
        } catch (\Exception $e) {
            \Log::error('Erreur envoi email mise à jour statut: ' . $e->getMessage());
        }
    }

    /**
     * Changement rapide de statut (AJAX)
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled'
        ]);

        $oldStatus = $reservation->status;
        $reservation->update(['status' => $request->status]);

        // Envoyer un email de notification
        if ($oldStatus !== $request->status) {
            $this->sendStatusUpdateEmail($reservation);
        }

        return response()->json([
            'success' => true,
            'message' => 'Statut mis à jour',
            'new_status' => $request->status,
            'status_label' => $this->getStatusLabel($request->status)
        ]);
    }

    /**
     * Retourne le label du statut
     */
    private function getStatusLabel($status)
    {
        $labels = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        return $labels[$status] ?? $status;
    }
}
