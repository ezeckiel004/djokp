<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // Récupérer TOUTES les catégories actives
        $allCategories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        // Pour chaque catégorie, récupérer les véhicules disponibles
        $vehiclesByCategory = [];

        foreach ($allCategories as $category) {
            $vehicles = Vehicle::with('category')
                ->where('vehicle_category_id', $category->id)
                ->where('is_available', true)
                ->get();

            // Stocker les données de la catégorie
            $vehiclesByCategory[$category->categorie] = [
                'category' => $category,
                'vehicles' => $vehicles
            ];
        }

        // Pour compatibilité avec l'ancien code
        $ecoVehicles = isset($vehiclesByCategory['eco']) ? $vehiclesByCategory['eco']['vehicles'] : collect();
        $businessVehicles = isset($vehiclesByCategory['business']) ? $vehiclesByCategory['business']['vehicles'] : collect();
        $prestigeVehicles = isset($vehiclesByCategory['prestige']) ? $vehiclesByCategory['prestige']['vehicles'] : collect();

        return view('location', compact(
            'allCategories',
            'vehiclesByCategory',
            'ecoVehicles',
            'businessVehicles',
            'prestigeVehicles'
        ));
    }

    public function showVehicleDetails($id)
    {
        // Récupérer le véhicule avec ses relations
        $vehicle = Vehicle::with(['category', 'locationReservations' => function ($query) {
            $query->whereIn('statut', ['en_attente', 'confirmee', 'en_cours']);
        }])->findOrFail($id);

        // Récupérer les véhicules similaires (même catégorie)
        $similarVehicles = Vehicle::with('category')
            ->where('is_available', true)
            ->where('vehicle_category_id', $vehicle->vehicle_category_id)
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
