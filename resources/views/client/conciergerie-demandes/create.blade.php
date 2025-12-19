{{-- resources/views/client/conciergerie-demandes/create.blade.php --}}
@extends('layouts.client')

@section('title', 'Nouvelle demande de conciergerie')
@section('page-title', 'Nouvelle demande')
@section('page-description', 'Créez une nouvelle demande de services de conciergerie')

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
        <span class="text-gray-500">Nouvelle demande</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-5 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Formulaire de demande</h3>
            <p class="mt-1 text-sm text-gray-500">Remplissez ce formulaire pour créer une nouvelle demande de
                conciergerie</p>
        </div>

        <form action="{{ route('client.conciergerie-demandes.store') }}" method="POST" id="conciergerieForm">
            @csrf

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
                                value="{{ old('nom_complet', $defaultData['nom_complet'] ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                placeholder="Votre nom et prénom">
                            @error('nom_complet')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" required
                                value="{{ old('email', $defaultData['email'] ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                                placeholder="votre@email.com">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="telephone" id="telephone" required
                                value="{{ old('telephone', $defaultData['telephone'] ?? '') }}"
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                                <option value="">Sélectionnez un motif</option>
                                @foreach(App\Models\ConciergerieDemande::MOTIFS as $key => $label)
                                <option value="{{ $key }}" {{ old('motif_voyage')==$key ? 'selected' : '' }}>
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
                                value="{{ old('date_arrivee') }}" min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                            @error('date_arrivee')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Durée du séjour <span class="text-red-500">*</span>
                            </label>
                            <select name="duree_sejour" id="duree_sejour" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                                <option value="">Sélectionnez la durée</option>
                                <option value="1-3 jours" {{ old('duree_sejour')=='1-3 jours' ? 'selected' : '' }}>1-3
                                    jours</option>
                                <option value="4-7 jours" {{ old('duree_sejour')=='4-7 jours' ? 'selected' : '' }}>4-7
                                    jours</option>
                                <option value="1-2 semaines" {{ old('duree_sejour')=='1-2 semaines' ? 'selected' : ''
                                    }}>1-2 semaines</option>
                                <option value="3-4 semaines" {{ old('duree_sejour')=='3-4 semaines' ? 'selected' : ''
                                    }}>3-4 semaines</option>
                                <option value="1-3 mois" {{ old('duree_sejour')=='1-3 mois' ? 'selected' : '' }}>1-3
                                    mois</option>
                                <option value="3-6 mois" {{ old('duree_sejour')=='3-6 mois' ? 'selected' : '' }}>3-6
                                    mois</option>
                                <option value="6+ mois" {{ old('duree_sejour')=='6+ mois' ? 'selected' : '' }}>Plus de 6
                                    mois</option>
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                                <option value="">Sélectionnez</option>
                                <option value="1 personne" {{ old('nombre_personnes')=='1 personne' ? 'selected' : ''
                                    }}>1 personne</option>
                                <option value="2 personnes" {{ old('nombre_personnes')=='2 personnes' ? 'selected' : ''
                                    }}>2 personnes</option>
                                <option value="3-4 personnes" {{ old('nombre_personnes')=='3-4 personnes' ? 'selected'
                                    : '' }}>3-4 personnes</option>
                                <option value="5-6 personnes" {{ old('nombre_personnes')=='5-6 personnes' ? 'selected'
                                    : '' }}>5-6 personnes</option>
                                <option value="7+ personnes" {{ old('nombre_personnes')=='7+ personnes' ? 'selected'
                                    : '' }}>Plus de 6 personnes</option>
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                                <option value="">Sélectionnez une fourchette</option>
                                <option value="500-1000 €" {{ old('budget')=='500-1000 €' ? 'selected' : '' }}>500 - 1
                                    000 €</option>
                                <option value="1000-2000 €" {{ old('budget')=='1000-2000 €' ? 'selected' : '' }}>1 000 -
                                    2 000 €</option>
                                <option value="2000-5000 €" {{ old('budget')=='2000-5000 €' ? 'selected' : '' }}>2 000 -
                                    5 000 €</option>
                                <option value="5000-10000 €" {{ old('budget')=='5000-10000 €' ? 'selected' : '' }}>5 000
                                    - 10 000 €</option>
                                <option value="10000+ €" {{ old('budget')=='10000+ €' ? 'selected' : '' }}>Plus de 10
                                    000 €</option>
                                <option value="Sur devis" {{ old('budget')=='Sur devis' ? 'selected' : '' }}>Sur devis
                                </option>
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                                <option value="">Sélectionnez un type</option>
                                @foreach(App\Models\ConciergerieDemande::ACCOMPAGNEMENTS as $key => $label)
                                <option value="{{ $key }}" {{ old('type_accompagnement')==$key ? 'selected' : '' }}>
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
                        @endphp

                        @foreach($servicesList as $service)
                        <label
                            class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-yellow-50 cursor-pointer transition-colors">
                            <input type="checkbox" name="services[]" value="{{ $service }}" {{ is_array(old('services'))
                                && in_array($service, old('services')) ? 'checked' : '' }}
                                class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300 rounded">
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
                            placeholder="Décrivez en détail vos besoins, attentes particulières, contraintes, préférences...">{{ old('message') }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">
                            Plus votre message est détaillé, plus nous pourrons vous proposer une solution adaptée.
                        </p>
                        @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Informations légales --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-yellow-600 mt-1"></i>
                        </div>
                        <div class="ml-3">
                            <h5 class="text-sm font-medium text-yellow-800">Informations importantes</h5>
                            <div class="mt-2 text-sm text-yellow-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <li>Votre demande sera traitée sous 24h maximum</li>
                                    <li>Vous recevrez une confirmation par email</li>
                                    <li>Un devis personnalisé vous sera envoyé gratuitement</li>
                                    <li>Tous les services sont modifiables avant confirmation</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Actions du formulaire --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <a href="{{ route('client.conciergerie-demandes.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
                <div class="flex space-x-3">
                    <button type="reset"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-redo mr-2"></i> Réinitialiser
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-paper-plane mr-2"></i> Envoyer la demande
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Guide rapide --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h5 class="text-sm font-medium text-blue-900">Traitement rapide</h5>
                    <p class="mt-1 text-sm text-blue-700">Réponse sous 24h ouvrées maximum</p>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-euro-sign text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h5 class="text-sm font-medium text-green-900">Devis gratuit</h5>
                    <p class="mt-1 text-sm text-green-700">Sans engagement, personnalisé</p>
                </div>
            </div>
        </div>

        <div class="bg-purple-50 border border-purple-200 rounded-lg p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-headset text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h5 class="text-sm font-medium text-purple-900">Support dédié</h5>
                    <p class="mt-1 text-sm text-purple-700">Accompagnement personnalisé</p>
                </div>
            </div>
        </div>
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
        document.getElementById('date_arrivee').min = today;

        // Si une date est déjà sélectionnée, s'assurer qu'elle est valide
        const dateArrivee = document.getElementById('date_arrivee');
        if (dateArrivee.value && dateArrivee.value < today) {
            dateArrivee.value = today;
        }

        // Validation du formulaire
        const form = document.getElementById('conciergerieForm');
        form.addEventListener('submit', function(e) {
            // Vérifier qu'au moins un service est sélectionné
            const services = document.querySelectorAll('input[name="services[]"]:checked');
            if (services.length === 0) {
                e.preventDefault();
                alert('Veuillez sélectionner au moins un service.');
                return false;
            }

            // Vérifier la date d'arrivée
            if (dateArrivee.value < today) {
                e.preventDefault();
                alert('La date d\'arrivée doit être aujourd\'hui ou une date future.');
                return false;
            }

            return true;
        });
    });
</script>
@endpush
