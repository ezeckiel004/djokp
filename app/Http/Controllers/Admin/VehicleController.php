<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index()
    {
        $vehicles = Vehicle::with('vehicleCategory')
            ->latest()
            ->paginate(15);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $categories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        return view('admin.vehicles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'registration' => 'required|string|max:50|unique:vehicles,registration',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'fuel_type' => 'required|in:essence,diesel,hybrid,electric',
            'seats' => 'required|integer|min:1|max:20',
            'features' => 'nullable|string',
            'is_available' => 'sometimes|boolean',
            'daily_rate' => 'required|numeric|min:0',
            'weekly_rate' => 'required|numeric|min:0',
            'monthly_rate' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('vehicles', 'public');
            $validated['image'] = $imagePath;
        }

        // Convertir les équipements en tableau JSON si fournis
        if ($request->filled('features')) {
            $featuresLines = array_filter(array_map('trim', explode("\n", $request->features)));
            $validated['features'] = !empty($featuresLines) ? $featuresLines : null;
        }

        // Gérer la disponibilité (checkbox)
        $validated['is_available'] = $request->has('is_available');

        // Créer le véhicule
        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule créé avec succès.');
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load('vehicleCategory');
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        $categories = VehicleCategory::where('actif', true)
            ->orderBy('display_name')
            ->get();

        return view('admin.vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        // Validation des données pour la mise à jour
        $validated = $request->validate([
            'registration' => 'required|string|max:50|unique:vehicles,registration,' . $vehicle->id,
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'color' => 'required|string|max:50',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'fuel_type' => 'required|in:essence,diesel,hybrid,electric',
            'seats' => 'required|integer|min:1|max:20',
            'features' => 'nullable|string',
            'is_available' => 'sometimes|boolean',
            'daily_rate' => 'required|numeric|min:0',
            'weekly_rate' => 'required|numeric|min:0',
            'monthly_rate' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'nullable|string',
        ]);

        // Gérer l'upload de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($vehicle->image && Storage::disk('public')->exists($vehicle->image)) {
                Storage::disk('public')->delete($vehicle->image);
            }

            $imagePath = $request->file('image')->store('vehicles', 'public');
            $validated['image'] = $imagePath;
        } elseif ($request->has('remove_image')) {
            // Supprimer l'image si on a coché "supprimer"
            if ($vehicle->image && Storage::disk('public')->exists($vehicle->image)) {
                Storage::disk('public')->delete($vehicle->image);
            }
            $validated['image'] = null;
        } else {
            // Garder l'image existante
            $validated['image'] = $vehicle->image;
        }

        // Convertir les équipements en tableau JSON si fournis
        if ($request->filled('features')) {
            $featuresLines = array_filter(array_map('trim', explode("\n", $request->features)));
            $validated['features'] = !empty($featuresLines) ? $featuresLines : null;
        } else {
            $validated['features'] = null;
        }

        // Gérer la disponibilité (checkbox)
        $validated['is_available'] = $request->has('is_available');

        // Mettre à jour le véhicule
        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicle $vehicle)
    {
        // Supprimer l'image si elle existe
        if ($vehicle->image && Storage::disk('public')->exists($vehicle->image)) {
            Storage::disk('public')->delete($vehicle->image);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')
            ->with('success', 'Véhicule supprimé avec succès.');
    }
}
