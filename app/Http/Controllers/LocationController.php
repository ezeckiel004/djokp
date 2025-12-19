<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Récupérer les véhicules par catégorie
        $ecoVehicles = Vehicle::where('category', 'eco')
            ->where('is_available', true)
            ->get();

        $businessVehicles = Vehicle::where('category', 'business')
            ->where('is_available', true)
            ->get();

        $prestigeVehicles = Vehicle::where('category', 'prestige')
            ->where('is_available', true)
            ->get();

        return view('location', compact('ecoVehicles', 'businessVehicles', 'prestigeVehicles'));
    }

    public function showVehicleDetails($id)
    {
        // Récupérer le véhicule avec ses relations
        $vehicle = Vehicle::with(['locationReservations' => function ($query) {
            $query->whereIn('statut', ['en_attente', 'confirmee', 'en_cours']);
        }])->findOrFail($id);

        // Récupérer les véhicules similaires (même catégorie)
        $similarVehicles = Vehicle::available()
            ->byCategory($vehicle->category)
            ->where('id', '!=', $vehicle->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('location.vehicle-details', [
            'vehicle' => $vehicle,
            'similarVehicles' => $similarVehicles,
        ]);
    }
}
