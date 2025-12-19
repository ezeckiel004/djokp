<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index()
    {
        $reservations = Reservation::with(['user', 'vehicle'])
            ->latest()
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        // Récupérer l'ID du rôle "client"
        $clientRole = Role::where('slug', 'client')
            ->orWhere('name', 'client')
            ->first();

        if (!$clientRole) {
            // Si le rôle client n'existe pas, créer le rôle
            $clientRole = Role::create([
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Utilisateur client',
                'permissions' => []
            ]);
        }

        // Récupérer les utilisateurs avec le rôle client
        $users = User::where('role_id', $clientRole->id)
            ->where('is_active', true)
            ->get(['id', 'name', 'email']);

        // Récupérer les véhicules disponibles
        $vehicles = Vehicle::where('is_available', true)
            ->get(['id', 'brand', 'model', 'registration', 'category']);

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $types = [
            'location' => 'Location de véhicule',
            'vtc_transport' => 'Service VTC/Transport',
            'conciergerie' => 'Service Conciergerie'
        ];

        return view('admin.reservations.create', compact('users', 'vehicles', 'statuses', 'types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'type' => 'required|in:location,vtc_transport,conciergerie',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pickup_time' => 'nullable|date_format:H:i',
            'pickup_location' => 'nullable|string|max:255',
            'dropoff_location' => 'nullable|string|max:255',
            'passengers' => 'nullable|integer|min:1|max:20',
            'total_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'special_requests' => 'nullable|string',
        ]);

        // Validation spécifique selon le type
        if ($validated['type'] === 'location' && empty($validated['vehicle_id'])) {
            return back()->withErrors(['vehicle_id' => 'Le véhicule est obligatoire pour une location.'])->withInput();
        }

        $reservation = Reservation::create($validated);

        // Mettre à jour la disponibilité du véhicule si nécessaire
        if ($reservation->vehicle_id && in_array($reservation->status, ['confirmed', 'in_progress'])) {
            Vehicle::where('id', $reservation->vehicle_id)->update(['is_available' => false]);
        }

        return redirect()->route('admin.reservations.show', $reservation)
            ->with('success', 'Réservation créée avec succès.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'vehicle']);
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        // Récupérer l'ID du rôle "client"
        $clientRole = Role::where('slug', 'client')
            ->orWhere('name', 'client')
            ->first();

        if (!$clientRole) {
            $clientRole = Role::create([
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Utilisateur client',
                'permissions' => []
            ]);
        }

        // Récupérer les utilisateurs avec le rôle client
        $users = User::where('role_id', $clientRole->id)
            ->where('is_active', true)
            ->get(['id', 'name', 'email']);

        // Récupérer les véhicules disponibles OU le véhicule actuel de la réservation
        $vehicles = Vehicle::where('is_available', true)
            ->orWhere('id', $reservation->vehicle_id)
            ->get(['id', 'brand', 'model', 'registration', 'category', 'is_available']);

        $statuses = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        $types = [
            'location' => 'Location de véhicule',
            'vtc_transport' => 'Service VTC/Transport',
            'conciergerie' => 'Service Conciergerie'
        ];

        return view('admin.reservations.edit', compact('reservation', 'users', 'vehicles', 'statuses', 'types'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'type' => 'required|in:location,vtc_transport,conciergerie',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'pickup_time' => 'nullable|date_format:H:i',
            'pickup_location' => 'nullable|string|max:255',
            'dropoff_location' => 'nullable|string|max:255',
            'passengers' => 'nullable|integer|min:1|max:20',
            'total_amount' => 'required|numeric|min:0',
            'deposit_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
            'special_requests' => 'nullable|string',
        ]);

        // Validation spécifique selon le type
        if ($validated['type'] === 'location' && empty($validated['vehicle_id'])) {
            return back()->withErrors(['vehicle_id' => 'Le véhicule est obligatoire pour une location.'])->withInput();
        }

        // Sauvegarder l'ancien statut et véhicule
        $oldStatus = $reservation->status;
        $oldVehicleId = $reservation->vehicle_id;

        // Mettre à jour la réservation
        $reservation->update($validated);

        // Gérer la disponibilité du véhicule
        $this->handleVehicleAvailability($reservation, $oldStatus, $oldVehicleId);

        return redirect()->route('admin.reservations.show', $reservation)
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    public function destroy(Reservation $reservation)
    {
        // Libérer le véhicule si nécessaire
        if ($reservation->vehicle_id && in_array($reservation->status, ['confirmed', 'in_progress'])) {
            Vehicle::where('id', $reservation->vehicle_id)->update(['is_available' => true]);
        }

        $reservation->delete();

        return redirect()->route('admin.reservations.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }

    /**
     * Gère la disponibilité du véhicule lors des mises à jour
     */
    private function handleVehicleAvailability(Reservation $reservation, $oldStatus, $oldVehicleId)
    {
        // Si le véhicule a changé, libérer l'ancien
        if ($oldVehicleId && $oldVehicleId != $reservation->vehicle_id) {
            Vehicle::where('id', $oldVehicleId)->update(['is_available' => true]);
        }

        // Mettre à jour la disponibilité du nouveau véhicule
        if ($reservation->vehicle_id) {
            $isAvailable = true;

            if (in_array($reservation->status, ['confirmed', 'in_progress'])) {
                $isAvailable = false;
            }

            Vehicle::where('id', $reservation->vehicle_id)->update(['is_available' => $isAvailable]);
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

        // Mettre à jour la disponibilité du véhicule si nécessaire
        if ($reservation->vehicle_id) {
            $isAvailable = true;
            if (in_array($request->status, ['confirmed', 'in_progress'])) {
                $isAvailable = false;
            }
            Vehicle::where('id', $reservation->vehicle_id)->update(['is_available' => $isAvailable]);
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
