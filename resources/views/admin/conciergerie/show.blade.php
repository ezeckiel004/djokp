@extends('layouts.admin')

@section('title', 'Détails Demande - ' . $conciergerie->reference)

@section('page-actions')
<div class="flex space-x-3">
    <a href="{{ route('admin.conciergerie-demandes.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>Retour
    </a>
    <button type="button" class="btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
        <i class="fas fa-trash mr-2"></i>Supprimer
    </button>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-blue-800 to-blue-900 px-6 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Demande {{ $conciergerie->reference }}</h2>
                    <div class="mt-2 flex items-center space-x-4">
                        <span class="px-3 py-1 text-sm rounded-full bg-white bg-opacity-20 text-white">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $conciergerie->created_at->format('d/m/Y H:i') }}
                        </span>
                        <span
                            class="px-3 py-1 text-sm rounded-full {{ $conciergerie->statut == 'nouvelle' ? 'bg-yellow-100 text-yellow-800' : ($conciergerie->statut == 'confirme' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ $conciergerie->statut_label }}
                        </span>
                        @if($conciergerie->devis_envoye)
                        <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-file-invoice-dollar mr-1"></i> Devis envoyé
                        </span>
                        @endif
                    </div>
                </div>
                <div class="text-right">
                    @if($conciergerie->montant_devis)
                    <div class="text-3xl font-bold text-white">{{ $conciergerie->montant_formate }}</div>
                    @else
                    <div class="text-xl font-bold text-white">À déterminer</div>
                    @endif
                    <div class="text-gray-300">{{ $conciergerie->duree_sejour }}</div>
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
                                            <span class="text-gray-700">{{ $conciergerie->nom_complet }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-envelope text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $conciergerie->email }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $conciergerie->telephone }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Accompagnement</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <i class="fas fa-user-friends text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $conciergerie->accompagnement_label }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-users text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $conciergerie->nombre_personnes }}
                                                personne{{ $conciergerie->nombre_personnes > 1 ? 's' : '' }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-question-circle text-gray-400 mr-3"></i>
                                            <span class="text-gray-700">{{ $conciergerie->motif_label }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Détails du séjour -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Détails du séjour</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Dates et durée</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Date d'arrivée:</span>
                                            <span class="font-medium text-gray-900">
                                                {{ $conciergerie->date_arrivee->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Durée du séjour:</span>
                                            <span class="font-medium text-gray-900">{{ $conciergerie->duree_sejour
                                                }}</span>
                                        </div>
                                        @if($conciergerie->budget)
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Budget estimé:</span>
                                            <span class="font-medium text-gray-900">{{ $conciergerie->budget }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Statut devis</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Devis envoyé:</span>
                                            <span class="font-medium text-gray-900">
                                                @if($conciergerie->devis_envoye)
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                    Oui
                                                </span>
                                                @else
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                                                    Non
                                                </span>
                                                @endif
                                            </span>
                                        </div>
                                        @if($conciergerie->montant_devis)
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Montant devis:</span>
                                            <span class="font-bold text-gray-900">{{ $conciergerie->montant_formate
                                                }}</span>
                                        </div>
                                        @endif
                                        @if($conciergerie->date_devis)
                                        <div class="flex items-center justify-between">
                                            <span class="text-gray-600">Date devis:</span>
                                            <span class="font-medium text-gray-900">
                                                {{ $conciergerie->date_devis->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services demandés -->
                    @if(!empty($conciergerie->services) && is_array($conciergerie->services) &&
                    count($conciergerie->services) > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Services demandés</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($conciergerie->services as $service)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-check-circle mr-1 text-xs"></i>
                                    {{ $service }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Message du client -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Message du client</h3>
                        <div class="bg-gray-50 rounded-lg p-6 border-l-4 border-blue-500">
                            <div class="prose max-w-none">
                                {{ nl2br(e($conciergerie->message)) }}
                            </div>
                        </div>
                    </div>

                    <!-- Notes administratives -->
                    @if($conciergerie->notes_admin)
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notes administratives</h3>
                        <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-200">
                            <div class="prose max-w-none">
                                {{ nl2br(e($conciergerie->notes_admin)) }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Actions rapides -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Actions</h3>
                        <div class="space-y-3">
                            @if(!$conciergerie->devis_envoye)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#devisModal"
                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <i class="fas fa-file-invoice-dollar mr-2"></i> Envoyer un devis
                            </button>
                            @endif

                            <button type="button" data-bs-toggle="modal" data-bs-target="#notesModal"
                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-sticky-note mr-2"></i> Ajouter des notes
                            </button>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#statutModal"
                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                <i class="fas fa-exchange-alt mr-2"></i> Changer le statut
                            </button>

                            <a href="mailto:{{ $conciergerie->email }}?subject=Réponse%20à%20votre%20demande%20{{ $conciergerie->reference }}"
                                class="block text-center w-full py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-envelope mr-2"></i> Contacter le client
                            </a>
                        </div>
                    </div>

                    <!-- Informations système -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations système</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Créée le:</span>
                                <span class="text-gray-900">{{ $conciergerie->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dernière mise à jour:</span>
                                <span class="text-gray-900">{{ $conciergerie->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if($conciergerie->date_devis)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Devis envoyé le:</span>
                                <span class="text-gray-900">{{ $conciergerie->date_devis->format('d/m/Y H:i') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Services de base -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Services de base</h3>
                        <div class="space-y-2">
                            @php
                            $baseServices = [
                            'Accueil aéroport' => 'fas fa-plane-arrival',
                            'Transfert' => 'fas fa-car',
                            'Hébergement' => 'fas fa-hotel',
                            'Assistance administrative' => 'fas fa-file-contract',
                            'Traduction' => 'fas fa-language',
                            'Conseil' => 'fas fa-comments'
                            ];
                            @endphp

                            @foreach($baseServices as $service => $icon)
                            <div class="flex items-center p-2 hover:bg-white rounded transition-colors">
                                <i class="{{ $icon }} text-gray-400 mr-3 w-5 text-center"></i>
                                <span class="text-gray-700 text-sm">{{ $service }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour envoyer un devis -->
<div class="modal fade" id="devisModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold text-lg">Envoyer un devis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.conciergerie-demandes.envoyer-devis', $conciergerie) }}" method="POST">
                @csrf
                <div class="modal-body space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="montant_devis" class="block text-sm font-medium text-gray-700 mb-1">
                                Montant (€)
                            </label>
                            <input type="number" name="montant_devis" id="montant_devis"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                step="0.01" min="0" required>
                        </div>
                        <div>
                            <label for="devise" class="block text-sm font-medium text-gray-700 mb-1">
                                Devise
                            </label>
                            <select name="devise" id="devise"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                <option value="EUR" selected>EUR (€)</option>
                                <option value="USD">USD ($)</option>
                                <option value="GBP">GBP (£)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="details_devis" class="block text-sm font-medium text-gray-700 mb-1">
                            Détails du devis
                        </label>
                        <textarea name="details_devis" id="details_devis" rows="6"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            required
                            placeholder="Détaillez les services, les conditions, les inclusions/exclusions..."></textarea>
                    </div>

                    <div>
                        <label for="notes_client" class="block text-sm font-medium text-gray-700 mb-1">
                            Notes pour le client
                        </label>
                        <textarea name="notes_client" id="notes_client" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            placeholder="Message personnalisé pour le client..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50 px-6 py-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow"
                        data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Envoyer le devis
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour ajouter des notes -->
<div class="modal fade" id="notesModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold text-lg">Ajouter des notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.conciergerie-demandes.ajouter-notes', $conciergerie) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Notes
                        </label>
                        <textarea name="notes" id="notes" rows="5"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            required placeholder="Ajoutez des notes internes sur cette demande..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50 px-6 py-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow"
                        data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour changer le statut -->
<div class="modal fade" id="statutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold text-lg">Changer le statut</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.conciergerie-demandes.update-statut', $conciergerie) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">
                            Nouveau statut
                        </label>
                        <select name="statut" id="statut"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            required>
                            @foreach(App\Models\ConciergerieDemande::STATUTS as $key => $label)
                            <option value="{{ $key }}" {{ $conciergerie->statut == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50 px-6 py-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow"
                        data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-semibold text-lg">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.conciergerie-demandes.destroy', $conciergerie) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-gray-700">Êtes-vous sûr de vouloir supprimer cette demande ?</p>
                    <p class="text-red-600 font-medium mt-2">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        <strong>Cette action est irréversible.</strong>
                    </p>
                </div>
                <div class="modal-footer bg-gray-50 px-6 py-4">
                    <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow"
                        data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover: bg-gray-700 transition-all duration-300 transform hover:scale-105;
    }

    .btn-danger {
        @apply inline-flex items-center px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover: bg-red-700 transition-all duration-300 transform hover:scale-105;
    }
</style>
@endpush
