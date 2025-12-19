{{-- resources/views/client/location-reservations/show.blade.php --}}
@extends('layouts.client')

@section('title', 'Détails de la réservation ' . $reservation->reference)
@section('page-title', 'Détails de la réservation')
@section('page-description', 'Consultez les détails de votre réservation de location')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.location-reservations.index') }}"
            class="text-gray-500 hover:text-yellow-600 transition-colors">
            Mes réservations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">{{ $reservation->reference }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Messages --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        {{-- En-tête avec statut et actions --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Réservation {{ $reservation->reference }}</h1>
                    <div class="flex items-center mt-2 space-x-4">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $reservation->statut_couleur }}">
                            {{ $reservation->statut_fr }}
                        </span>
                        <span class="text-sm text-gray-600">
                            Créée le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 md:mt-0 flex space-x-3">
                    @if($reservation->peutEtreAnnulee())
                    <form action="{{ route('client.location-reservations.destroy', $reservation->id) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 border border-red-300 text-red-700 text-sm font-medium rounded-md hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                            <i class="fas fa-times mr-1"></i>Annuler
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('client.location-reservations.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i>Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Informations de la réservation --}}
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Informations de la réservation</h2>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Référence</h3>
                            <p class="mt-1 text-sm text-gray-900 font-mono">{{ $reservation->reference }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Période de location</h3>
                            <p class="mt-1 text-sm text-gray-900">
                                Du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                                au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $reservation->duree_jours }} jour{{ $reservation->duree_jours > 1 ? 's' : '' }}
                                @if($reservation->jours_restants > 0)
                                • {{ $reservation->jours_restants }} jour{{ $reservation->jours_restants > 1 ? 's' : ''
                                }} restant{{ $reservation->jours_restants > 1 ? 's' : '' }}
                                @endif
                            </p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Montant total</h3>
                            <p class="mt-1 text-2xl font-bold text-yellow-600">
                                {{ number_format($reservation->montant_total, 2, ',', ' ') }} €
                            </p>
                            @if($reservation->tarif_journalier_moyen_formatted)
                            <p class="text-xs text-gray-500">
                                Soit {{ $reservation->tarif_journalier_moyen_formatted }} par jour en moyenne
                            </p>
                            @endif
                        </div>

                        @if($reservation->notes)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Notes</h3>
                            <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $reservation->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Informations du véhicule --}}
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Véhicule loué</h2>

                    @if($reservation->vehicle)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        {{-- Image du véhicule --}}
                        <div class="h-48 bg-gray-100 overflow-hidden">
                            @if($reservation->vehicle->image_url)
                            <img src="{{ $reservation->vehicle->image_url }}"
                                alt="{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}"
                                class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-car text-gray-400 text-5xl"></i>
                            </div>
                            @endif
                        </div>

                        {{-- Détails du véhicule --}}
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}
                            </h3>

                            <div class="mt-3 space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-tag mr-2 text-gray-400"></i>
                                    <span class="font-medium mr-2">Catégorie :</span>
                                    {{ $reservation->vehicle->category_fr }}
                                </div>

                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-gas-pump mr-2 text-gray-400"></i>
                                    <span class="font-medium mr-2">Carburant :</span>
                                    {{ $reservation->vehicle->fuel_type_fr }}
                                </div>

                                @if($reservation->vehicle->year)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                    <span class="font-medium mr-2">Année :</span>
                                    {{ $reservation->vehicle->year }}
                                </div>
                                @endif

                                @if($reservation->vehicle->registration)
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-id-card mr-2 text-gray-400"></i>
                                    <span class="font-medium mr-2">Immatriculation :</span>
                                    {{ $reservation->vehicle->registration }}
                                </div>
                                @endif
                            </div>

                            {{-- Équipements --}}
                            @if($reservation->vehicle->features && is_array($reservation->vehicle->features) &&
                            count($reservation->vehicle->features) > 0)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Équipements</h4>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($reservation->vehicle->features as $feature)
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-800">
                                        <i class="fas fa-check text-green-500 mr-1 text-xs"></i>
                                        {{ $feature }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="border border-gray-200 rounded-lg p-6 text-center">
                        <i class="fas fa-exclamation-triangle text-yellow-400 text-3xl mb-3"></i>
                        <p class="text-gray-600">Informations du véhicule non disponibles</p>
                    </div>
                    @endif
                </div>

                {{-- Informations client --}}
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Informations client</h2>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nom complet</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $reservation->nom }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Email</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $reservation->email }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Téléphone</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $reservation->telephone }}</p>
                        </div>
                    </div>
                </div>

                {{-- Progression et actions --}}
                <div>
                    <h2 class="text-lg font-bold text-gray-900 mb-4">Suivi de la réservation</h2>

                    <div class="space-y-6">
                        {{-- Barre de progression --}}
                        @if($reservation->progression !== null)
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Progression</span>
                                <span>{{ $reservation->progression }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-600 h-2 rounded-full"
                                    style="width: {{ $reservation->progression }}%"></div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                @if($reservation->jours_ecoules > 0)
                                {{ $reservation->jours_ecoules }} jour{{ $reservation->jours_ecoules > 1 ? 's' : '' }}
                                écoulé{{ $reservation->jours_ecoules > 1 ? 's' : '' }} sur {{ $reservation->duree_jours
                                }}
                                @endif
                            </p>
                        </div>
                        @endif

                        {{-- Prochaines étapes --}}
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-gray-700 mb-2">Prochaines étapes</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                @if($reservation->statut === 'en_attente')
                                <li class="flex items-center">
                                    <i class="fas fa-clock text-yellow-500 mr-2"></i>
                                    En attente de confirmation
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                    Vous recevrez un email de confirmation
                                </li>
                                @elseif($reservation->statut === 'confirmee')
                                <li class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    Réservation confirmée
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-calendar-check text-blue-500 mr-2"></i>
                                    Récupération du véhicule le {{
                                    \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                                </li>
                                @elseif($reservation->statut === 'en_cours')
                                <li class="flex items-center">
                                    <i class="fas fa-car text-blue-500 mr-2"></i>
                                    Location en cours
                                </li>
                                <li class="flex items-center">
                                    <i class="fas fa-calendar-alt text-gray-500 mr-2"></i>
                                    Retour prévu le {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}
                                </li>
                                @elseif($reservation->statut === 'terminee')
                                <li class="flex items-center">
                                    <i class="fas fa-flag-checkered text-green-500 mr-2"></i>
                                    Location terminée
                                </li>
                                @elseif($reservation->statut === 'annulee')
                                <li class="flex items-center">
                                    <i class="fas fa-ban text-red-500 mr-2"></i>
                                    Réservation annulée
                                </li>
                                @endif
                            </ul>
                        </div>

                        {{-- Actions disponibles --}}
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-yellow-900 mb-2">Actions disponibles</h3>
                            <div class="space-y-2">
                                @if($reservation->peutEtreAnnulee())
                                <form action="{{ route('client.location-reservations.destroy', $reservation->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-left px-3 py-2 text-sm text-red-700 hover:bg-red-100 rounded transition-colors">
                                        <i class="fas fa-times mr-2"></i>Annuler la réservation
                                    </button>
                                </form>
                                @endif

                                @if($reservation->statut === 'confirmee' && $reservation->date_debut->isFuture())
                                <div class="text-sm text-gray-600">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    La modification n'est plus possible pour une réservation confirmée
                                </div>
                                @endif

                                <a href="mailto:location@djokprestige.com?subject=Question sur la réservation {{ $reservation->reference }}"
                                    class="block px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded transition-colors">
                                    <i class="fas fa-envelope mr-2"></i>Contacter le service location
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
