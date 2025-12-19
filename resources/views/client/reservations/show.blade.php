{{-- resources/views/client/reservations/show.blade.php --}}

@extends('layouts.client')

@section('title', 'Réservation #' . $reservation->reference)
@section('page-title', 'Réservation #' . $reservation->reference)
@section('page-description', 'Détails de votre réservation VTC')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.reservations.index') }}" class="text-gray-700 hover:text-djok-yellow">
            Réservations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Détails</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Réservation #{{ $reservation->reference }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Créée le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                    </p>
                </div>
                <div>
                    @php
                    $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'confirmed' => 'bg-green-100 text-green-800',
                    'in_progress' => 'bg-blue-100 text-blue-800',
                    'completed' => 'bg-gray-100 text-gray-800',
                    'cancelled' => 'bg-red-100 text-red-800',
                    ];
                    $statusLabels = [
                    'pending' => 'En attente',
                    'confirmed' => 'Confirmée',
                    'in_progress' => 'En cours',
                    'completed' => 'Terminée',
                    'cancelled' => 'Annulée',
                    ];
                    @endphp
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $statusLabels[$reservation->status] ?? $reservation->status }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Service Details -->
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Service Info -->
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Service</h4>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm text-gray-500">Type de service</dt>
                            <dd class="font-medium text-gray-900">
                                @if($reservation->type_service === 'transfert')
                                <i class="fas fa-plane-arrival mr-2 text-djok-yellow"></i>Transfert
                                @elseif($reservation->type_service === 'professionnel')
                                <i class="fas fa-briefcase mr-2 text-blue-600"></i>Professionnel
                                @elseif($reservation->type_service === 'evenement')
                                <i class="fas fa-glass-cheers mr-2 text-purple-600"></i>Événement
                                @else
                                <i class="fas fa-car mr-2 text-green-600"></i>Mise à disposition
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Type de véhicule</dt>
                            <dd class="font-medium text-gray-900">
                                {{ ucfirst($reservation->type_vehicule) }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Nombre de passagers</dt>
                            <dd class="font-medium text-gray-900">{{ $reservation->passagers }} passager(s)</dd>
                        </div>
                        @if($reservation->vehicle)
                        <div>
                            <dt class="text-sm text-gray-500">Véhicule assigné</dt>
                            <dd class="font-medium text-gray-900">
                                {{ $reservation->vehicle->marque }} {{ $reservation->vehicle->modele }}
                                <span class="text-sm text-gray-500">({{ $reservation->vehicle->immatriculation
                                    }})</span>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>

                <!-- Date & Time -->
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Date & Heure</h4>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm text-gray-500">Date</dt>
                            <dd class="font-medium text-gray-900">{{ $reservation->date->format('d/m/Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Heure</dt>
                            <dd class="font-medium text-gray-900">{{ $reservation->heure }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Date de création</dt>
                            <dd class="font-medium text-gray-900">{{ $reservation->created_at->format('d/m/Y H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Trajet -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Trajet</h4>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                            <i class="fas fa-map-marker-alt text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-900">Départ</p>
                            <p class="text-gray-600">{{ $reservation->depart }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-flag-checkered text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium text-gray-900">Arrivée</p>
                            <p class="text-gray-600">{{ $reservation->arrivee }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions -->
            @if($reservation->instructions)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Instructions spéciales</h4>
                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4">
                    <p class="text-gray-700">{{ $reservation->instructions }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Client Info -->
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Vos informations</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Nom complet</p>
                    <p class="font-medium text-gray-900">{{ $reservation->nom }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $reservation->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium text-gray-900">{{ $reservation->telephone }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Référence</p>
                    <p class="font-medium text-gray-900">{{ $reservation->reference }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-between space-x-3">
        <a href="{{ route('client.reservations.index') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux réservations
        </a>
        <div class="flex space-x-3">
            @if($reservation->status === 'pending')
            <a href="{{ route('client.reservations.edit', $reservation->id) }}"
                class="inline-flex items-center px-4 py-2 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-edit mr-2"></i> Modifier
            </a>
            <form action="{{ route('client.reservations.destroy', $reservation->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                    class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i class="fas fa-times mr-2"></i> Annuler
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
