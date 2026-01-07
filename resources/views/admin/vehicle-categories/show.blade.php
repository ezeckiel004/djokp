@extends('layouts.admin')

@section('title', $vehicleCategory->display_name)

@section('page-title', 'Détails de la catégorie')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-800 to-gray-900">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-white">{{ $vehicleCategory->display_name }}</h3>
                    <p class="mt-1 text-sm text-gray-300">Code: {{ $vehicleCategory->categorie }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.vehicle-categories.edit', $vehicleCategory) }}" class="btn-primary">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                    <form action="{{ route('admin.vehicle-categories.destroy', $vehicleCategory) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-secondary bg-red-600 hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-4 py-5 sm:p-6">
            <!-- Informations de base -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations de base</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Code catégorie</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $vehicleCategory->categorie }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Nom d'affichage</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $vehicleCategory->display_name }}</p>
                    </div>
                </div>
            </div>

            <!-- Tarification -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Tarification</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-yellow-50 border border-yellow-100 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Prise en charge</p>
                        <p class="mt-1 text-2xl font-bold text-djok-yellow">{{
                            $vehicleCategory->prise_en_charge_formatted }}</p>
                        <p class="mt-1 text-xs text-gray-500">Montant fixe par course</p>
                    </div>
                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Prix au km</p>
                        <p class="mt-1 text-2xl font-bold text-blue-600">{{ $vehicleCategory->prix_au_km_formatted }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">Prix par kilomètre</p>
                    </div>
                    <div class="p-4 bg-green-50 border border-green-100 rounded-lg">
                        <p class="text-sm font-medium text-gray-500">Prix minimum</p>
                        <p class="mt-1 text-2xl font-bold text-green-600">{{ $vehicleCategory->prix_minimum_formatted }}
                        </p>
                        <p class="mt-1 text-xs text-gray-500">Prix minimum par course</p>
                    </div>
                </div>
            </div>

            <!-- Simulation de prix -->
            <div class="mb-8">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Simulation de prix</h4>
                <div class="p-6 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="distance" class="block text-sm font-medium text-gray-700 mb-2">
                                Distance (km)
                            </label>
                            <input type="range" id="distance" min="1" max="100" value="10"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                            <div class="flex justify-between text-sm text-gray-600 mt-2">
                                <span>1 km</span>
                                <span id="current-distance">10 km</span>
                                <span>100 km</span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center">
                            <p class="text-sm text-gray-500 mb-2">Prix estimé :</p>
                            <p id="estimated-price" class="text-3xl font-bold text-djok-yellow">
                                {{ $vehicleCategory->calculatePriceForDistanceFormatted(10) }}
                            </p>
                            <p class="text-sm text-gray-500 mt-2" id="price-breakdown">
                                Détail : (10 km × {{ $vehicleCategory->prix_au_km }} €) + {{
                                $vehicleCategory->prise_en_charge }} €
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Véhicules associés -->
            <div>
                <h4 class="text-lg font-medium text-gray-900 mb-4">Véhicules associés</h4>
                @if($vehicleCategory->vehicles->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Immatriculation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Marque/Modèle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Année</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Disponibilité</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vehicleCategory->vehicles as $vehicle)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $vehicle->registration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $vehicle->brand }} {{ $vehicle->model }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $vehicle->year }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $vehicle->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $vehicle->availability_fr }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-8">
                    <i class="fas fa-car text-gray-300 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucun véhicule n'est associé à cette catégorie.</p>
                    <a href="{{ route('admin.vehicles.create') }}"
                        class="inline-flex items-center mt-4 text-djok-yellow hover:text-yellow-700">
                        <i class="fas fa-plus mr-2"></i>Ajouter un véhicule
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Simulation de prix
    const distanceSlider = document.getElementById('distance');
    const currentDistance = document.getElementById('current-distance');
    const estimatedPrice = document.getElementById('estimated-price');
    const priceBreakdown = document.getElementById('price-breakdown');

    const priseEnCharge = {{ $vehicleCategory->prise_en_charge }};
    const prixAuKm = {{ $vehicleCategory->prix_au_km }};
    const prixMinimum = {{ $vehicleCategory->prix_minimum }};

    function updatePrice() {
        const distance = parseInt(distanceSlider.value);
        const prixCalcule = (distance * prixAuKm) + priseEnCharge;
        const prixFinal = Math.max(prixCalcule, prixMinimum);

        currentDistance.textContent = distance + ' km';
        estimatedPrice.textContent = prixFinal.toFixed(2) + ' €';

        let breakdown = `Détail : (${distance} km × ${prixAuKm} €) + ${priseEnCharge} €`;
        if (prixFinal > prixCalcule) {
            breakdown += ` = ${prixCalcule.toFixed(2)} € → Prix minimum appliqué : ${prixMinimum} €`;
        }
        priceBreakdown.textContent = breakdown;
    }

    distanceSlider.addEventListener('input', updatePrice);
</script>
@endpush
@endsection
