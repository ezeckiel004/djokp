@extends('layouts.admin')

@section('title', 'Réservation #' . $reservation->id)

@section('page-title', 'Détails de la réservation')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Réservation #{{ $reservation->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Créée le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <span
                    class="badge {{ $reservation->status == 'pending' ? 'badge-warning' : ($reservation->status == 'confirmed' ? 'badge-info' : ($reservation->status == 'in_progress' ? 'badge-primary' : ($reservation->status == 'completed' ? 'badge-success' : 'badge-danger'))) }}">
                    {{ $reservation->status == 'pending' ? 'En attente' : ($reservation->status == 'confirmed' ?
                    'Confirmé' : ($reservation->status == 'in_progress' ? 'En cours' : ($reservation->status ==
                    'completed' ? 'Terminé' : 'Annulé'))) }}
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.reservations.edit', $reservation) }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informations client -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations client</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom complet</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->user->phone ?? 'Non renseigné' }}</p>
                    </div>
                    @if($reservation->user->cni_number)
                    <div>
                        <p class="text-sm font-medium text-gray-500">CNI</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->user->cni_number }}</p>
                    </div>
                    @endif
                    @if($reservation->user->driver_license)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Permis de conduire</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->user->driver_license }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations réservation -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Détails de la réservation</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Type de service</p>
                        <p class="mt-1 text-sm text-gray-900">
                            @switch($reservation->type)
                            @case('location')
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                <i class="fas fa-car mr-1"></i>Location de véhicule
                            </span>
                            @break
                            @case('vtc_transport')
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                                <i class="fas fa-taxi mr-1"></i>Service VTC/Transport
                            </span>
                            @break
                            @case('conciergerie')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-concierge-bell mr-1"></i>Service Conciergerie
                            </span>
                            @break
                            @endswitch
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Période</p>
                        <div class="mt-1 space-y-1">
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                Du {{ $reservation->start_date->format('d/m/Y') }}
                                au {{ $reservation->end_date->format('d/m/Y') }}
                            </p>
                            @if($reservation->pickup_time)
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                Heure: {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                            </p>
                            @endif
                            @if($reservation->passengers > 1)
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-users mr-2 text-gray-400"></i>
                                {{ $reservation->passengers }} passagers
                            </p>
                            @endif
                        </div>
                    </div>
                    @if($reservation->vehicle)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Véhicule réservé</p>
                        <div class="mt-1 space-y-1">
                            <p class="text-sm text-gray-900">
                                {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}
                            </p>
                            <p class="text-sm text-gray-500">
                                Immatriculation: {{ $reservation->vehicle->registration }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Catégorie: {{ ucfirst($reservation->vehicle->category) }} |
                                Année: {{ $reservation->vehicle->year }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations lieux -->
            @if($reservation->pickup_location || $reservation->dropoff_location)
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Lieux</h4>
                <div class="space-y-4">
                    @if($reservation->pickup_location)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lieu de prise en charge</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                            {{ $reservation->pickup_location }}
                        </p>
                    </div>
                    @endif
                    @if($reservation->dropoff_location)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lieu de restitution/dépose</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-flag-checkered mr-2 text-gray-400"></i>
                            {{ $reservation->dropoff_location }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Informations financières -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations financières</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-gray-500">Montant total</p>
                        <p class="text-lg font-bold text-gray-900">{{ number_format($reservation->total_amount, 2) }} €
                        </p>
                    </div>
                    @if($reservation->deposit_amount > 0)
                    <div class="flex justify-between items-center">
                        <p class="text-sm font-medium text-gray-500">Acompte versé</p>
                        <p class="text-sm font-medium text-green-600">{{ number_format($reservation->deposit_amount, 2)
                            }} €</p>
                    </div>
                    <div class="flex justify-between items-center border-t pt-2">
                        <p class="text-sm font-medium text-gray-500">Reste à payer</p>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($reservation->total_amount -
                            $reservation->deposit_amount, 2) }} €</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Demandes spéciales -->
            @if($reservation->special_requests)
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Demandes spéciales</h4>
                <div class="bg-white rounded border p-4">
                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $reservation->special_requests }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <a href="{{ route('admin.reservations.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <!-- Bouton Facture -->
                <button type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-invoice mr-2"></i> Générer facture
                </button>

                <!-- Bouton Contrat -->
                <button type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-contract mr-2"></i> Contrat de location
                </button>

                <!-- Bouton Supprimer -->
                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action est irréversible.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
