@extends('layouts.admin')

@section('title', $vehicle->brand . ' ' . $vehicle->model)

@section('page-title', 'Détails du véhicule')

@section('page-actions')
<div class="flex space-x-3">
    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn-primary">
        <i class="fas fa-edit mr-2"></i>Éditer
    </a>
    <a href="{{ route('admin.vehicles.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Retour
    </a>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- En-tête avec image -->
        <div class="relative">
            <div class="h-64 bg-gradient-to-r from-gray-800 to-gray-900">
                @if($vehicle->image_url)
                <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                    class="w-full h-full object-cover opacity-50">
                @endif
                <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/40"></div>
                <div class="absolute inset-0 flex items-center px-6 py-8">
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold text-white">{{ $vehicle->brand }} {{ $vehicle->model }}</h2>
                        <div class="mt-2 flex items-center space-x-4">
                            <span class="px-3 py-1 text-sm rounded-full bg-white bg-opacity-20 text-white">
                                {{ $vehicle->category_fr }}
                            </span>
                            <span class="px-3 py-1 text-sm rounded-full bg-white bg-opacity-20 text-white">
                                {{ $vehicle->year }}
                            </span>
                            <span class="px-3 py-1 text-sm rounded-full bg-white bg-opacity-20 text-white">
                                {{ $vehicle->color }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-white">{{ $vehicle->registration }}</div>
                        <div class="text-gray-300">{{ $vehicle->fuel_type_fr }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Corps -->
        <div class="px-6 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    @if($vehicle->description)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            {{ $vehicle->description }}
                        </div>
                    </div>
                    @endif

                    <!-- Équipements -->
                    @if($vehicle->features && count($vehicle->features) > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Équipements</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach($vehicle->features as $feature)
                            <div class="flex items-center bg-blue-50 p-3 rounded-lg">
                                <i class="fas fa-check text-blue-500 mr-3"></i>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Statut -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Statut</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Disponibilité</span>
                                @if($vehicle->is_available)
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium">
                                    <i class="fas fa-check-circle mr-1"></i> Disponible
                                </span>
                                @else
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-medium">
                                    <i class="fas fa-times-circle mr-1"></i> Indisponible
                                </span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Places</span>
                                <span class="font-medium text-gray-900">{{ $vehicle->seats }} places</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Carburant</span>
                                <span class="font-medium text-gray-900">{{ $vehicle->fuel_type_fr }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Catégorie</span>
                                <span class="font-medium text-gray-900">{{ $vehicle->category_fr }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tarification -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tarification</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-gray-900">Journalier</div>
                                    <div class="text-sm text-gray-500">Par jour</div>
                                </div>
                                <div class="text-xl font-bold text-djok-yellow">
                                    {{ $vehicle->daily_rate_formatted }}
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-gray-900">Hebdomadaire</div>
                                    <div class="text-sm text-gray-500">7 jours</div>
                                </div>
                                <div class="text-xl font-bold text-djok-yellow">
                                    {{ $vehicle->weekly_rate_formatted }}
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-gray-900">Mensuel</div>
                                    <div class="text-sm text-gray-500">30 jours</div>
                                </div>
                                <div class="text-xl font-bold text-djok-yellow">
                                    {{ $vehicle->monthly_rate_formatted }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Réservations totales</span>
                                <span class="font-medium text-gray-900">{{ $vehicle->locationReservations()->count()
                                    }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Ajouté le</span>
                                <span class="text-gray-600">{{ $vehicle->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Dernière mise à jour</span>
                                <span class="text-gray-600">{{ $vehicle->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
