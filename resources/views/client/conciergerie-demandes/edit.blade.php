{{-- resources/views/client/conciergerie-demandes/edit.blade.php --}}
@extends('layouts.client')

@section('title', 'Modifier la demande de conciergerie')
@section('page-title', 'Modifier la demande ' . $demande->reference)
@section('page-description', 'Modifiez les informations de votre demande')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.conciergerie-demandes.index') }}" class="text-gray-500 hover:text-djok-yellow">
            Demandes
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.conciergerie-demandes.show', $demande->id) }}"
            class="text-gray-500 hover:text-djok-yellow">
            {{ $demande->reference }}
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Modifier</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Avertissement selon le statut --}}
    @if(!in_array($demande->statut, ['nouvelle', 'en_cours']))
    <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
            </div>
            <div class="ml-3">
                <h4 class="text-sm font-medium text-yellow-800">Modification limitée</h4>
                <p class="text-sm text-yellow-700 mt-1">
                    Cette demande a le statut "{{ $demande->getStatutLabelAttribute() }}".
                    Seules certaines informations peuvent être modifiées.
                    Pour des changements importants, contactez notre service client.
                </p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Modifier la demande</h3>
            <p class="mt-1 text-sm text-gray-500">
                Statut actuel :
                <span class="font-medium">
                    {{ $demande->getStatutLabelAttribute() }}
                </span>
            </p>
        </div>

        <form action="{{ route('client.conciergerie-demandes.update', $demande->id) }}" method="POST"
            id="editConciergerieForm">
            @csrf
            @method('PUT')

            <div class="px-6 py-6 space-y-8">
                {{-- Section Informations personnelles --}}
                <div>
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-user-circle text-djok-yellow mr-2"></i>
                        Informations personnelles
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nom_complet" id="nom_complet" required
                                value="{{ old('nom_complet', $demande->nom_complet) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                placeholder="Votre nom et prénom" @if($demande->statut !== 'nouvelle') disabled @endif>
                            @error('nom_complet')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" required
                                value="{{ old('email', $demande->email) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                placeholder="votre@email.com" @if($demande->statut !== 'nouvelle') disabled @endif>
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="telephone" id="telephone" required
                                value="{{ old('telephone', $demande->telephone) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                placeholder="+221 77 123 45 67">
                            @error('telephone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section Informations du séjour --}}
                <div>
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-plane text-djok-yellow mr-2"></i>
                        Informations du séjour
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Motif du voyage <span class="text-red-500">*</span>
                            </label>
                            <select name="motif_voyage" id="motif_voyage" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                                <option value="">Sélectionnez un motif</option>
                                @foreach(App\Models\ConciergerieDemande::MOTIFS as $key => $label)
                                <option value="{{ $key }}" {{ old('motif_voyage', $demande->motif_voyage) == $key ?
                                    'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            @error('motif_voyage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date d'arrivée <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="date_arrivee" id="date_arrivee" required
                                value="{{ old('date_arrivee', $demande->date_arrivee ? $demande->date_arrivee->format('Y-m-d') : '') }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                            @error('date_arrivee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Durée du séjour <span class="text-red-500">*</span>
                            </label>
                            <select name="duree_sejour" id="duree_sejour" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                                <option value="">Sélectionnez la durée</option>
                                @php
                                $durees = ['1-3 jours', '4-7 jours', '1-2 semaines', '3-4 semaines', '1-3 mois', '3-6
                                mois', '6+ mois'];
                                @endphp
                                @foreach($durees as $duree)
                                <option value="{{ $duree }}" {{ old('duree_sejour', $demande->duree_sejour) == $duree ?
                                    'selected' : '' }}>
                                    {{ $duree }}
                                </option>
                                @endforeach
                            </select>
                            @error('duree_sejour')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre de personnes <span class="text-red-500">*</span>
                            </label>
                            <select name="nombre_personnes" id="nombre_personnes" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                                <option value="">Sélectionnez</option>
                                @php
                                $nombres = ['1 personne', '2 personnes', '3-4 personnes', '5-6 personnes', '7+
                                personnes'];
                                @endphp
                                @foreach($nombres as $nombre)
                                <option value="{{ $nombre }}" {{ old('nombre_personnes', $demande->nombre_personnes) ==
                                    $nombre ? 'selected' : '' }}>
                                    {{ $nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('nombre_personnes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Budget estimé
                            </label>
                            <select name="budget" id="budget"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                                <option value="">Sélectionnez une fourchette</option>
                                @php
                                $budgets = ['500-1000 €', '1000-2000 €', '2000-5000 €', '5000-10000 €', '10000+ €', 'Sur
                                devis'];
                                @endphp
                                @foreach($budgets as $budget)
                                <option value="{{ $budget }}" {{ old('budget', $demande->budget) == $budget ? 'selected'
                                    : '' }}>
                                    {{ $budget }}
                                </option>
                                @endforeach
                            </select>
                            @error('budget')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Type d'accompagnement <span class="text-red-500">*</span>
                            </label>
                            <select name="type_accompagnement" id="type_accompagnement" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                                <option value="">Sélectionnez un type</option>
                                @foreach(App\Models\ConciergerieDemande::ACCOMPAGNEMENTS as $key => $label)
                                <option value="{{ $key }}" {{ old('type_accompagnement', $demande->type_accompagnement)
                                    == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                            @error('type_accompagnement')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Section Services demandés --}}
                <div>
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-list-alt text-djok-yellow mr-2"></i>
                        Services souhaités
                    </h4>
                    <p class="text-sm text-gray-600 mb-4">Sélectionnez les services dont vous avez besoin</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        @php
                        $servicesList = [
                        'Transfert aéroport/gare',
                        'Location voiture',
                        'Hébergement',
                        'Guide touristique',
                        'Assistance administrative',
                        'Services business',
                        'Installation/logement',
                        'Courses arrivée',
                        'Interprète/traduction',
                        'Billets spectacles',
                        'Réservation restaurants',
                        'Service ménage',
                        'Carte SIM/Pass transport',
                        'Ouverture compte bancaire',
                        'Assurance voyage'
                        ];

                        $selectedServices = old('services', $demande->services ?? []);
                        if (!is_array($selectedServices)) {
                        $selectedServices = [];
                        }
                        @endphp

                        @foreach($servicesList as $service)
                        <label
                            class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-yellow-50 cursor-pointer transition-colors
                            @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) opacity-50 cursor-not-allowed @endif">
                            <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service,
                                $selectedServices) ? 'checked' : '' }}
                                class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300 rounded"
                                @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>
                            <span class="ml-3 text-sm text-gray-700">{{ $service }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('services')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Section Message détaillé --}}
                <div>
                    <h4 class="text-md font-medium text-gray-900 mb-4">
                        <i class="fas fa-comment-alt text-djok-yellow mr-2"></i>
                        Détails de votre demande
                    </h4>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Message / Besoins spécifiques <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" id="message" rows="6" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                            placeholder="Décrivez en détail vos besoins, attentes particulières, contraintes, préférences..."
                            @if(!in_array($demande->statut, ['nouvelle', 'en_cours'])) disabled @endif>{{ old('message', $demande->message) }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">
                            Plus votre message est détaillé, plus nous pourrons vous proposer une solution adaptée.
                        </p>
                        @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Informations de modification --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="text-sm font-medium text-blue-800">À propos de la modification</h5>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Les modifications seront notifiées à notre équipe</li>
                                    <li>Un nouveau devis pourra être nécessaire</li>
                                    <li>Les champs grisés ne peuvent pas être modifiés dans l'état actuel</li>
                                    <li>Pour des changements urgents, contactez-nous directement</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions du formulaire --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('client.conciergerie-demandes.show', $demande->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </a>
                    <a href="{{ route('client.conciergerie-demandes.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                    </a>
                </div>
                <div class="flex space-x-3">
                    <button type="reset"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-redo mr-2"></i> Réinitialiser
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Historique des modifications --}}
    @if($demande->notes_admin)
    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <i class="fas fa-history text-djok-yellow mr-2"></i>
            Notes et historique
        </h3>
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="text-sm text-gray-700 whitespace-pre-line">
                {{ $demande->notes_admin }}
            </div>
        </div>
    </div>
    @endif
</div>
</div>
@endsection

@push('styles')
<style>
    .bg-djok-yellow {
        background-color: #F8B400;
    }

    .text-djok-yellow {
        color: #F8B400;
    }

    .hover\:bg-yellow-700:hover {
        background-color: #e69c00;
    }

    .focus\:ring-djok-yellow:focus {
        --tw-ring-color: rgba(248, 180, 0, 0.5);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Définir la date minimum pour aujourd'hui
        const today = new Date().toISOString().split('T')[0];
        const dateArrivee = document.getElementById('date_arrivee');

        if (dateArrivee) {
            dateArrivee.min = today;

            // Si une date est déjà sélectionnée, s'assurer qu'elle est valide
            if (dateArrivee.value && dateArrivee.value < today) {
                dateArrivee.value = today;
            }
        }

        // Validation du formulaire
        const form = document.getElementById('editConciergerieForm');
        form.addEventListener('submit', function(e) {
            // Vérifier qu'au moins un service est sélectionné (si modifiable)
            const services = document.querySelectorAll('input[name="services[]"]:checked:not(:disabled)');
            if (services.length === 0) {
                e.preventDefault();
                alert('Veuillez sélectionner au moins un service.');
                return false;
            }

            // Vérifier la date d'arrivée
            if (dateArrivee && !dateArrivee.disabled && dateArrivee.value < today) {
                e.preventDefault();
                alert('La date d\'arrivée doit être aujourd\'hui ou une date future.');
                return false;
            }

            return true;
        });
    });
</script>
@endpush
