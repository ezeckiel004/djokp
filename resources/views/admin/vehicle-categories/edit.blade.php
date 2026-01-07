@extends('layouts.admin')

@section('title', 'Éditer ' . $vehicleCategory->display_name)

@section('page-title', 'Éditer la catégorie de véhicule')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.vehicle-categories.update', $vehicleCategory) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Informations de base -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations de base</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="categorie" class="block text-sm font-medium text-gray-700">
                                    Code catégorie *
                                </label>
                                <input type="text" name="categorie" id="categorie" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('categorie', $vehicleCategory->categorie) }}">
                                @error('categorie')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="display_name" class="block text-sm font-medium text-gray-700">
                                    Nom d'affichage *
                                </label>
                                <input type="text" name="display_name" id="display_name" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('display_name', $vehicleCategory->display_name) }}">
                                @error('display_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Tarification -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tarification (en €)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="prise_en_charge" class="block text-sm font-medium text-gray-700">
                                    Prise en charge *
                                </label>
                                <input type="number" step="0.01" name="prise_en_charge" id="prise_en_charge" required
                                    min="0"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('prise_en_charge', $vehicleCategory->prise_en_charge) }}">
                                @error('prise_en_charge')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="prix_au_km" class="block text-sm font-medium text-gray-700">
                                    Prix au km *
                                </label>
                                <input type="number" step="0.01" name="prix_au_km" id="prix_au_km" required min="0"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('prix_au_km', $vehicleCategory->prix_au_km) }}">
                                @error('prix_au_km')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="prix_minimum" class="block text-sm font-medium text-gray-700">
                                    Prix minimum *
                                </label>
                                <input type="number" step="0.01" name="prix_minimum" id="prix_minimum" required min="0"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('prix_minimum', $vehicleCategory->prix_minimum) }}">
                                @error('prix_minimum')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Aperçu du calcul -->
                        <div class="mt-4 p-4 bg-gray-50 rounded-md">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Aperçu du calcul :</h4>
                            <p class="text-sm text-gray-600">
                                Pour une course de <span id="demo-km">5</span> km :
                                <span class="font-semibold" id="demo-price">{{
                                    $vehicleCategory->calculatePriceForDistanceFormatted(5) }}</span>
                            </p>
                            <div class="mt-2">
                                <input type="range" id="demo-slider" min="1" max="50" value="5"
                                    class="w-full h-2 bg-gray-200 rounded-lg">
                                <div class="flex justify-between text-xs text-gray-500 mt-1">
                                    <span>1 km</span>
                                    <span>Distance : <span id="demo-km-value">5</span> km</span>
                                    <span>50 km</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statut -->
                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" name="actif" id="actif" value="1" {{ old('actif',
                                $vehicleCategory->actif) ? 'checked' : '' }}
                            class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300 rounded">
                            <label for="actif" class="ml-2 block text-sm text-gray-900">
                                Catégorie active
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.vehicle-categories.index') }}" class="btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Calcul dynamique du prix
    function calculatePrice() {
        const priseEnCharge = parseFloat(document.getElementById('prise_en_charge').value) || 0;
        const prixAuKm = parseFloat(document.getElementById('prix_au_km').value) || 0;
        const prixMinimum = parseFloat(document.getElementById('prix_minimum').value) || 0;
        const distance = parseFloat(document.getElementById('demo-slider').value);

        const prixCalcule = (distance * prixAuKm) + priseEnCharge;
        const prixFinal = Math.max(prixCalcule, prixMinimum);

        document.getElementById('demo-km').textContent = distance;
        document.getElementById('demo-km-value').textContent = distance;
        document.getElementById('demo-price').textContent = prixFinal.toFixed(2) + ' €';
    }

    // Écouter les changements
    document.getElementById('prise_en_charge').addEventListener('input', calculatePrice);
    document.getElementById('prix_au_km').addEventListener('input', calculatePrice);
    document.getElementById('prix_minimum').addEventListener('input', calculatePrice);
    document.getElementById('demo-slider').addEventListener('input', calculatePrice);
</script>
@endpush
@endsection
