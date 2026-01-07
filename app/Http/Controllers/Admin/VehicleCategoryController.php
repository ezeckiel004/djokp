<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index()
    {
        $categories = VehicleCategory::orderBy('categorie')->paginate(20);
        return view('admin.vehicle-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.vehicle-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie' => 'required|string|max:50|unique:vehicle_categories,categorie',
            'display_name' => 'required|string|max:100',
            'prise_en_charge' => 'required|numeric|min:0',
            'prix_au_km' => 'required|numeric|min:0',
            'prix_minimum' => 'required|numeric|min:0',
            'actif' => 'sometimes|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        VehicleCategory::create($validated);

        return redirect()->route('admin.vehicle-categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function show(VehicleCategory $vehicleCategory)
    {
        return view('admin.vehicle-categories.show', compact('vehicleCategory'));
    }

    public function edit(VehicleCategory $vehicleCategory)
    {
        return view('admin.vehicle-categories.edit', compact('vehicleCategory'));
    }

    public function update(Request $request, VehicleCategory $vehicleCategory)
    {
        $validated = $request->validate([
            'categorie' => 'required|string|max:50|unique:vehicle_categories,categorie,' . $vehicleCategory->id,
            'display_name' => 'required|string|max:100',
            'prise_en_charge' => 'required|numeric|min:0',
            'prix_au_km' => 'required|numeric|min:0',
            'prix_minimum' => 'required|numeric|min:0',
            'actif' => 'sometimes|boolean',
        ]);

        $validated['actif'] = $request->has('actif');

        $vehicleCategory->update($validated);

        return redirect()->route('admin.vehicle-categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(VehicleCategory $vehicleCategory)
    {
        // Vérifier si des véhicules utilisent cette catégorie (pour info seulement)
        $vehiclesCount = $vehicleCategory->vehicles()->count();

        $vehicleCategory->delete();

        $message = 'Catégorie supprimée avec succès.';
        if ($vehiclesCount > 0) {
            $message .= " $vehiclesCount véhicule(s) ont également été supprimé(s) automatiquement.";
        }

        return redirect()->route('admin.vehicle-categories.index')
            ->with('success', $message);
    }
}
