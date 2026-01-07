@extends('layouts.admin')

@section('title', 'Réservation VTC #' . $reservation->id)

@section('page-title', 'Détails de la réservation VTC')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Réservation VTC #{{ $reservation->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Créée le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    Référence: {{ $reservation->reference }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                @php
                $statusConfig = [
                'pending' => ['class' => 'badge-warning', 'label' => 'En attente'],
                'confirmed' => ['class' => 'badge-info', 'label' => 'Confirmé'],
                'in_progress' => ['class' => 'badge-primary', 'label' => 'En cours'],
                'completed' => ['class' => 'badge-success', 'label' => 'Terminé'],
                'cancelled' => ['class' => 'badge-danger', 'label' => 'Annulé']
                ];
                $config = $statusConfig[$reservation->status] ?? $statusConfig['pending'];
                @endphp

                <span class="badge {{ $config['class'] }}">
                    {{ $config['label'] }}
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
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->nom }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $reservation->telephone }}</p>
                    </div>
                    @if($reservation->user_id)
                    <div class="mt-4 p-3 bg-blue-50 rounded border border-blue-200">
                        <p class="text-sm font-medium text-blue-700">Client enregistré</p>
                        <p class="text-xs text-blue-600">Cette réservation est liée à un compte client</p>
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
                            @php
                            $serviceConfig = [
                            'transfert' => ['class' => 'bg-blue-100 text-blue-800', 'icon' => 'plane', 'label' =>
                            'Transfert aéroport/gare'],
                            'professionnel' => ['class' => 'bg-purple-100 text-purple-800', 'icon' => 'briefcase',
                            'label' => 'Déplacement professionnel'],
                            'evenement' => ['class' => 'bg-green-100 text-green-800', 'icon' => 'heart', 'label' =>
                            'Événement/mariage'],
                            'mise_disposition' => ['class' => 'bg-yellow-100 text-yellow-800', 'icon' => 'clock',
                            'label' => 'Mise à disposition']
                            ];
                            $service = $serviceConfig[$reservation->type_service] ?? ['class' => 'bg-gray-100
                            text-gray-800', 'icon' => 'question', 'label' => $reservation->type_service];
                            @endphp
                            <span class="px-2 py-1 text-xs rounded-full {{ $service['class'] }}">
                                <i class="fas fa-{{ $service['icon'] }} mr-1"></i>{{ $service['label'] }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Période</p>
                        <div class="mt-1 space-y-1">
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                Le {{ $reservation->date ? $reservation->date->format('d/m/Y') :
                                ($reservation->start_date ? $reservation->start_date->format('d/m/Y') : 'Non spécifiée')
                                }}
                            </p>
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                Heure: {{ $reservation->heure ?? ($reservation->pickup_time ?
                                \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') : 'Non spécifiée') }}
                            </p>
                            @php
                            $passagers = $reservation->passagers ?? $reservation->passengers;
                            @endphp
                            @if($passagers > 1)
                            <p class="text-sm text-gray-900">
                                <i class="fas fa-users mr-2 text-gray-400"></i>
                                {{ $passagers }} passagers
                            </p>
                            @endif
                        </div>
                    </div>
                    @if($reservation->vehicleCategory)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Véhicule demandé</p>
                        <div class="mt-1 space-y-1">
                            <p class="text-sm text-gray-900">
                                {{ $reservation->vehicleCategory->display_name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Prise en charge: {{ number_format($reservation->vehicleCategory->prise_en_charge, 2,
                                ',', ' ') }} € |
                                Prix au km: {{ number_format($reservation->vehicleCategory->prix_au_km, 2, ',', ' ') }}
                                €
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations lieux -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Lieux du trajet</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lieu de départ</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                            {{ $reservation->depart }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Lieu d'arrivée</p>
                        <p class="mt-1 text-sm text-gray-900">
                            <i class="fas fa-flag-checkered mr-2 text-gray-400"></i>
                            {{ $reservation->arrivee }}
                        </p>
                    </div>
                </div>
            </div>

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

                    @if($reservation->calculated_price_ttc)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm font-medium text-gray-500 mb-2">Calcul du prix</p>
                        <div class="space-y-1 text-sm">
                            @if($reservation->calculated_prise_charge)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Prise en charge:</span>
                                <span class="text-gray-900">{{ number_format($reservation->calculated_prise_charge, 2)
                                    }} €</span>
                            </div>
                            @endif
                            @if($reservation->calculated_distance_price)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Prix distance:</span>
                                <span class="text-gray-900">{{ number_format($reservation->calculated_distance_price, 2)
                                    }} €</span>
                            </div>
                            @endif
                            @if($reservation->calculated_price_ht)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Total HT:</span>
                                <span class="text-gray-900">{{ number_format($reservation->calculated_price_ht, 2) }}
                                    €</span>
                            </div>
                            @endif
                            @if($reservation->calculated_tva)
                            <div class="flex justify-between">
                                <span class="text-gray-600">TVA (10%):</span>
                                <span class="text-gray-900">{{ number_format($reservation->calculated_tva, 2) }}
                                    €</span>
                            </div>
                            @endif
                            @if($reservation->calculated_price_ttc)
                            <div class="flex justify-between font-medium">
                                <span class="text-gray-800">Total TTC:</span>
                                <span class="text-djok-yellow">{{ number_format($reservation->calculated_price_ttc, 2)
                                    }} €</span>
                            </div>
                            @endif
                            @if($reservation->calculated_distance_km)
                            <div class="flex justify-between mt-2 pt-2 border-t border-gray-200">
                                <span class="text-gray-600">Distance estimée:</span>
                                <span class="text-gray-900">{{ number_format($reservation->calculated_distance_km, 1) }}
                                    km</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Demandes spéciales / Instructions -->
            @if($reservation->instructions || $reservation->special_requests)
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Demandes spéciales / Instructions</h4>
                <div class="bg-white rounded border p-4">
                    @if($reservation->instructions)
                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $reservation->instructions }}</p>
                    @elseif($reservation->special_requests)
                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $reservation->special_requests }}</p>
                    @endif
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
                @if($reservation->status == 'confirmed' || $reservation->status == 'completed')
                <button type="button" onclick="generateInvoice({{ $reservation->id }})"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-invoice mr-2"></i> Générer facture
                </button>
                @endif

                <!-- Bouton Contrat -->
                @if($reservation->status == 'confirmed')
                <button type="button"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-contract mr-2"></i> Contrat de transport
                </button>
                @endif

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

<script>
    function generateInvoice(reservationId) {
        // Rediriger vers une route de génération de facture
        window.open(`/admin/reservations/${reservationId}/invoice`, '_blank');
    }
</script>
@endsection
