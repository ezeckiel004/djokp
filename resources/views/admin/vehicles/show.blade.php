@extends('layouts.admin')

@section('title', $vehicle->full_name)

@section('page-title', 'Détails du véhicule')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-800 to-gray-900">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-white">{{ $vehicle->full_name }}</h3>
                    <p class="mt-1 text-sm text-gray-300">Immatriculation: {{ $vehicle->registration }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn-primary">
                        <i class="fas fa-edit mr-2"></i>Modifier
                    </a>
                    <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <!-- Image du véhicule -->
                    <div class="mb-6">
                        <div class="bg-gray-100 rounded-lg overflow-hidden border border-gray-300">
                            <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                                class="w-full h-64 object-cover">
                        </div>
                    </div>

                    <!-- Informations détaillées -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Caractéristiques techniques</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Marque/Modèle:</span>
                                    <span class="font-semibold">{{ $vehicle->brand }} {{ $vehicle->model }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Année:</span>
                                    <span class="font-semibold">{{ $vehicle->year }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Couleur:</span>
                                    <span class="font-semibold">{{ $vehicle->color }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Carburant:</span>
                                    <span class="font-semibold">{{ $vehicle->fuel_type_fr }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Nombre de places:</span>
                                    <span class="font-semibold">{{ $vehicle->seats }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Catégorie et tarification -->
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Catégorie & Tarification</h4>
                            <div class="space-y-2">
                                @if($vehicle->vehicleCategory)
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Catégorie:</span>
                                    <span class="font-semibold">{{ $vehicle->vehicleCategory->display_name }}</span>
                                </div>
                                <div class="text-xs text-gray-500 mb-3">
                                    Code: {{ $vehicle->vehicleCategory->categorie }}
                                </div>
                                @else
                                <div class="text-yellow-600 text-sm mb-3">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Aucune catégorie associée
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tarif journalier:</span>
                                    <span class="font-semibold text-djok-yellow">{{ $vehicle->daily_rate_formatted
                                        }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tarif hebdomadaire:</span>
                                    <span class="font-semibold text-djok-yellow">{{ $vehicle->weekly_rate_formatted
                                        }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Tarif mensuel:</span>
                                    <span class="font-semibold text-djok-yellow">{{ $vehicle->monthly_rate_formatted
                                        }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Équipements -->
                    @if($vehicle->features)
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Équipements</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                @foreach($vehicle->features_list as $feature)
                                <div class="flex items-center">
                                    <i class="fas fa-check text-green-500 mr-2"></i>
                                    <span class="text-gray-700">{{ $feature }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Description -->
                    @if($vehicle->description)
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Description</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $vehicle->description }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar - Statistiques et actions -->
                <div>
                    <!-- Statut -->
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Statut</h4>
                        <div
                            class="p-4 {{ $vehicle->is_available ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }} rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <i
                                        class="{{ $vehicle->is_available ? 'fas fa-check-circle text-green-500' : 'fas fa-times-circle text-red-500' }} text-2xl"></i>
                                </div>
                                <div class="ml-3">
                                    <h5
                                        class="text-sm font-medium {{ $vehicle->is_available ? 'text-green-800' : 'text-red-800' }}">
                                        {{ $vehicle->availability_fr }}
                                    </h5>
                                    <p
                                        class="text-sm {{ $vehicle->is_available ? 'text-green-600' : 'text-red-600' }} mt-1">
                                        @if($vehicle->is_available)
                                        Ce véhicule est disponible pour la location
                                        @else
                                        Ce véhicule n'est actuellement pas disponible
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions rapides -->
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Actions rapides</h4>
                        <div class="space-y-2">
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}"
                                class="btn-primary w-full text-center">
                                <i class="fas fa-edit mr-2"></i>Modifier le véhicule
                            </a>
                            @if($vehicle->is_available)
                            <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST"
                                class="inline w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_available" value="0">
                                <button type="submit"
                                    class="btn-secondary w-full text-center bg-yellow-600 hover:bg-yellow-700">
                                    <i class="fas fa-ban mr-2"></i>Rendre indisponible
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST"
                                class="inline w-full">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="is_available" value="1">
                                <button type="submit"
                                    class="btn-secondary w-full text-center bg-green-600 hover:bg-green-700">
                                    <i class="fas fa-check mr-2"></i>Rendre disponible
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <!-- Informations de création -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Informations système</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Créé le:</span>
                                    <span class="font-semibold">{{ $vehicle->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dernière modification:</span>
                                    <span class="font-semibold">{{ $vehicle->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="pt-2 border-t border-gray-200">
                                    <a href="{{ route('admin.location-reservations.index') }}?vehicle_id={{ $vehicle->id }}"
                                        class="text-djok-yellow hover:text-yellow-700 text-sm">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        Voir les réservations de ce véhicule
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
