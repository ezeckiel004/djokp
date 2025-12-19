@extends('layouts.admin')

@section('title', 'Détails Réservation ' . $locationReservation->reference)

@section('page-actions')
<div class="flex space-x-3">
    <a href="{{ route('admin.location-reservations.edit', $locationReservation) }}" class="btn-primary">
        <i class="fas fa-edit mr-2"></i>Éditer
    </a>
    <a href="{{ route('admin.location-reservations.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Retour
    </a>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 px-6 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Réservation {{ $locationReservation->reference }}</h2>
                    <div class="mt-2 flex items-center space-x-4">
                        <span class="px-3 py-1 text-sm rounded-full bg-white bg-opacity-20 text-white">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $locationReservation->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span class="px-3 py-1 text-sm rounded-full {{ $locationReservation->statut_couleur }}">
                            {{ $locationReservation->statut_fr }}
                        </span>
                        @if($locationReservation->estEnCours())
                        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
                            <i class="fas fa-play mr-1"></i> En cours
                        </span>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-white">{{ $locationReservation->montant_formatted }}</div>
                    <div class="text-gray-300">{{ $locationReservation->duree_jours }} jours</div>
                </div>
            </div>
        </div>

        <!-- Corps -->
        <div class="px-6 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2">
                    <!-- Informations client -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations client</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Coordonnées</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-user text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $locationReservation->nom }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $locationReservation->email }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $locationReservation->telephone }}</span>
                                        </div>
                                    </div>
                                </div>

                                @if($locationReservation->user)
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Compte utilisateur</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-id-card text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $locationReservation->user->name }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-user-tag text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{
                                                $locationReservation->user->getRoleNames()->first() }}</span>
                                        </div>
                                        <a href="{{ route('admin.users.show', $locationReservation->user) }}"
                                            class="inline-flex items-center text-sm text-djok-yellow hover:text-yellow-700">
                                            <i class="fas fa-external-link-alt mr-1"></i> Voir le profil
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Détails location -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Détails de la location</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Période</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Date de début:</span>
                                            <span class="font-medium text-gray-900">{{
                                                $locationReservation->date_debut->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Date de fin:</span>
                                            <span class="font-medium text-gray-900">{{
                                                $locationReservation->date_fin->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Durée totale:</span>
                                            <span class="font-medium text-gray-900">{{ $locationReservation->duree_jours
                                                }} jours</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Jours restants:</span>
                                            <span
                                                class="font-medium {{ $locationReservation->date_fin->isPast() ? 'text-red-600' : 'text-green-600' }}">
                                                @if($locationReservation->date_fin->isPast())
                                                Terminé
                                                @else
                                                {{ max(0, now()->diffInDays($locationReservation->date_fin, false)) }}
                                                jours
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Tarification</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Montant total:</span>
                                            <span class="font-bold text-gray-900">{{
                                                $locationReservation->montant_formatted }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Tarif journalier moyen:</span>
                                            <span class="font-medium text-gray-900">
                                                {{ number_format($locationReservation->montant_total /
                                                $locationReservation->duree_jours, 2, ',', ' ') }} €
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Statut paiement:</span>
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">
                                                À facturer
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    @if($locationReservation->notes)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notes</h3>
                        <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-200">
                            <div class="prose max-w-none">
                                {{ nl2br(e($locationReservation->notes)) }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Véhicule -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Véhicule</h3>
                        <div class="space-y-4">
                            <div class="aspect-w-16 aspect-h-9 bg-gray-200 rounded-lg overflow-hidden">
                                <img src="{{ $locationReservation->vehicle->image_url }}"
                                    alt="{{ $locationReservation->vehicle->full_name }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <div class="space-y-2">
                                <h4 class="font-bold text-gray-900">{{ $locationReservation->vehicle->full_name }}</h4>
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-car text-gray-400 mr-2"></i>
                                        <span>{{ $locationReservation->vehicle->registration }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-tag text-gray-400 mr-2"></i>
                                        <span>{{ $locationReservation->vehicle->category_fr }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-gas-pump text-gray-400 mr-2"></i>
                                        <span>{{ $locationReservation->vehicle->fuel_type_fr }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-users text-gray-400 mr-2"></i>
                                        <span>{{ $locationReservation->vehicle->seats }} places</span>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-200">
                                <a href="{{ route('admin.vehicles.show', $locationReservation->vehicle) }}"
                                    class="inline-flex items-center text-sm text-djok-yellow hover:text-yellow-700">
                                    <i class="fas fa-external-link-alt mr-2"></i> Voir la fiche du véhicule
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Actions rapides -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions rapides</h3>
                        <div class="space-y-3">
                            <form
                                action="{{ route('admin.location-reservations.update-status', $locationReservation) }}"
                                method="POST" class="space-y-3">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Changer le
                                        statut</label>
                                    <select name="statut"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                        <option value="en_attente" {{ $locationReservation->statut == 'en_attente' ?
                                            'selected' : '' }}>En attente</option>
                                        <option value="confirmee" {{ $locationReservation->statut == 'confirmee' ?
                                            'selected' : '' }}>Confirmée</option>
                                        <option value="en_cours" {{ $locationReservation->statut == 'en_cours' ?
                                            'selected' : '' }}>En cours</option>
                                        <option value="terminee" {{ $locationReservation->statut == 'terminee' ?
                                            'selected' : '' }}>Terminée</option>
                                        <option value="annulee" {{ $locationReservation->statut == 'annulee' ?
                                            'selected' : '' }}>Annulée</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes
                                        (optionnel)</label>
                                    <textarea name="notes" rows="2"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                        placeholder="Note pour le changement de statut..."></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                                    Mettre à jour le statut
                                </button>
                            </form>

                            <div class="pt-4 border-t border-gray-200">
                                <a href="mailto:{{ $locationReservation->email }}?subject=Réservation%20{{ $locationReservation->reference }}"
                                    class="block text-center w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-envelope mr-2"></i> Envoyer un email
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Informations système -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations système</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Créée le:</span>
                                <span class="text-gray-900">{{ $locationReservation->created_at->format('d/m/Y H:i')
                                    }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dernière mise à jour:</span>
                                <span class="text-gray-900">{{ $locationReservation->updated_at->format('d/m/Y H:i')
                                    }}</span>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <form action="{{ route('admin.location-reservations.destroy', $locationReservation) }}"
                                    method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <i class="fas fa-trash mr-2"></i> Supprimer cette réservation
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
