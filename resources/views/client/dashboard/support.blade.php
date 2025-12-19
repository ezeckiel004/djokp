{{-- resources/views/client/dashboard/support.blade.php --}}
@extends('layouts.client')

@section('title', 'Support - DJOK PRESTIGE')
@section('page-title', 'Support')
@section('page-description', 'Contactez notre équipe de support pour toute assistance')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Support</span>
    </div>
</li>
@endsection

@push('styles')
<style>
    /* Animation pour le champ "autre" */
    .other-field {
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .other-field.show {
        opacity: 1;
        max-height: 200px;
    }

    .service-radio:checked+.service-card {
        border-color: #d97706;
        background-color: #fef3c7;
    }

    .service-card {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .service-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    details summary::-webkit-details-marker {
        display: none;
    }

    details summary {
        list-style: none;
        position: relative;
        padding-left: 1.5rem;
    }

    details summary:before {
        content: '▶';
        position: absolute;
        left: 0;
        transition: transform 0.2s ease;
    }

    details[open] summary:before {
        transform: rotate(90deg);
    }
</style>
@endpush

@section('content')
<!-- Message de succès -->
@if(session('success'))
<div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-lg mx-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-500 text-2xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-semibold text-green-800">Message envoyé !</h3>
                <div class="mt-1 text-green-700">
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.fixed.top-4');
        if (alert) alert.remove();
    }, 5000);
</script>
@endif

<!-- Message d'erreur -->
@if(session('error'))
<div class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md">
    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg mx-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-500 text-2xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-semibold text-red-800">Erreur</h3>
                <div class="mt-1 text-red-700">
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.fixed.top-4');
        if (alert) alert.remove();
    }, 5000);
</script>
@endif

<div class="max-w-6xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Support & Assistance</h1>
        <p class="text-gray-600 max-w-3xl mx-auto">
            Notre équipe est à votre disposition pour répondre à toutes vos questions et vous accompagner.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulaire de contact -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Envoyez-nous votre message</h2>

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-bold text-red-800">Veuillez corriger les erreurs suivantes :</h4>
                            <ul class="text-red-700 list-disc list-inside mt-1">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <!-- CORRECTION ICI : Utiliser url() au lieu de route() -->
                <form action="{{ url('/client/support') }}" method="POST" id="support-form">
                    @csrf

                    <!-- Informations pré-remplies (utilisateur connecté) -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Vos informations</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Nom complet *</label>
                                <input type="text" name="nom" required value="{{ Auth::user()->name }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nom') border-red-500 @enderror"
                                    placeholder="Votre nom et prénom">
                                @error('nom')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" required value="{{ Auth::user()->email }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                    placeholder="votre@email.com">
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" name="telephone" value="{{ old('telephone', Auth::user()->phone ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('telephone') border-red-500 @enderror"
                                placeholder="+33 1 23 45 67 89">
                            @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Type de demande -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Type de demande *</h3>

                        @error('service_type')
                        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                        @enderror

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Services du compte client -->
                            <label class="cursor-pointer">
                                <input type="radio" name="service_type" value="formations" class="service-radio hidden"
                                    {{ old('service_type')=='formations' ? 'checked' : '' }}>
                                <div
                                    class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="fas fa-graduation-cap text-lg text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Formations</h4>
                                            <p class="text-sm text-gray-600 mt-1">Question sur vos formations</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="service_type" value="location" class="service-radio hidden" {{
                                    old('service_type')=='location' ? 'checked' : '' }}>
                                <div
                                    class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="fas fa-car text-lg text-green-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Location de voitures</h4>
                                            <p class="text-sm text-gray-600 mt-1">Réservation ou modification</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="service_type" value="vtc" class="service-radio hidden" {{
                                    old('service_type')=='vtc' ? 'checked' : '' }}>
                                <div
                                    class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="fas fa-taxi text-lg text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Service VTC</h4>
                                            <p class="text-sm text-gray-600 mt-1">Transport et déplacements</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="service_type" value="conciergerie"
                                    class="service-radio hidden" {{ old('service_type')=='conciergerie' ? 'checked' : ''
                                    }}>
                                <div
                                    class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="fas fa-concierge-bell text-lg text-red-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Conciergerie</h4>
                                            <p class="text-sm text-gray-600 mt-1">Service sur mesure</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="service_type" value="facturation" class="service-radio hidden"
                                    {{ old('service_type')=='facturation' ? 'checked' : '' }}>
                                <div
                                    class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="fas fa-file-invoice-dollar text-lg text-yellow-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Facturation</h4>
                                            <p class="text-sm text-gray-600 mt-1">Paiements et factures</p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <label class="cursor-pointer">
                                <input type="radio" name="service_type" value="autre" class="service-radio hidden"
                                    id="autre-service" {{ old('service_type')=='autre' ? 'checked' : '' }}>
                                <div
                                    class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 mr-3">
                                            <i class="fas fa-plus-circle text-lg text-gray-400"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">Autre demande</h4>
                                            <p class="text-sm text-gray-600 mt-1">Précisez votre demande</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Champ "Autre" qui apparaît -->
                        <div id="autre-field-container"
                            class="other-field {{ old('service_type') == 'autre' ? 'show' : '' }}">
                            <div class="mt-4">
                                <label class="block text-gray-700 mb-2">Précisez votre demande *</label>
                                <input type="text" name="autre_service" value="{{ old('autre_service') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('autre_service') border-red-500 @enderror"
                                    placeholder="De quelle assistance avez-vous besoin ?">
                                @error('autre_service')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Votre message</h3>
                        <div>
                            <label class="block text-gray-700 mb-2">Message détaillé *</label>
                            <textarea name="message" rows="6" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                placeholder="Décrivez en détail votre problème, votre question ou votre demande d'assistance...">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-2">Minimum 10 caractères</p>
                        </div>
                    </div>

                    <!-- Bouton d'envoi -->
                    <button type="submit" id="submit-btn"
                        class="w-full inline-flex items-center justify-center px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                        <span id="btn-text">
                            <i class="fas fa-paper-plane mr-3"></i>Envoyer ma demande
                        </span>
                        <span id="btn-loading" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-3"></i>Envoi en cours...
                        </span>
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Vos informations sont sécurisées et ne seront pas partagées avec des tiers.
                    </p>
                </form>
            </div>
        </div>

        <!-- Informations de contact + FAQ -->
        <div class="space-y-6">
            <!-- Coordonnées -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Contact rapide</h3>
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center mb-3">
                            <div class="h-10 w-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-phone-alt text-yellow-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Par téléphone</h4>
                            </div>
                        </div>
                        <a href="tel:0176380017" class="text-lg text-gray-700 hover:text-yellow-600 block">01 76 38 00
                            17</a>
                        <p class="text-sm text-gray-600 mt-2">Lun-Ven: 9h-19h | Sam: 9h-13h</p>
                    </div>
                    <div>
                        <div class="flex items-center mb-3">
                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">Par email</h4>
                            </div>
                        </div>
                        <a href="mailto:support@djokprestige.com"
                            class="text-lg text-gray-700 hover:text-yellow-600 block">support@djokprestige.com</a>
                        <p class="text-sm text-gray-600 mt-2">Réponse sous 24h ouvrées</p>
                    </div>
                    <div>
                        <div class="flex items-center mb-3">
                            <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fab fa-whatsapp text-green-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">WhatsApp</h4>
                            </div>
                        </div>
                        <a href="https://wa.me/33176380017" target="_blank"
                            class="text-lg text-gray-700 hover:text-green-600 block">+33 1 76 38 00 17</a>
                        <p class="text-sm text-gray-600 mt-2">Disponible 24h/24 pour les urgences</p>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">FAQ - Questions fréquentes</h3>
                <div class="space-y-4">
                    <details class="border border-gray-200 rounded-lg p-4">
                        <summary class="font-medium text-gray-900 cursor-pointer">
                            Comment accéder à mes formations ?
                        </summary>
                        <p class="mt-3 text-gray-600 text-sm">
                            Rendez-vous dans la section "Mes formations" de votre espace client.
                            Cliquez sur "Accéder" pour lancer une formation active.
                            Pour les formations en présentiel, vous recevrez une confirmation par email.
                        </p>
                    </details>

                    <details class="border border-gray-200 rounded-lg p-4">
                        <summary class="font-medium text-gray-900 cursor-pointer">
                            Comment modifier ou annuler une réservation ?
                        </summary>
                        <p class="mt-3 text-gray-600 text-sm">
                            Vous pouvez modifier vos réservations dans les 24h suivant la création
                            sans frais. Rendez-vous dans "Mes réservations" et cliquez sur "Modifier".
                            Pour les annulations, consultez nos conditions générales.
                        </p>
                    </details>

                    <details class="border border-gray-200 rounded-lg p-4">
                        <summary class="font-medium text-gray-900 cursor-pointer">
                            Comment télécharger une facture ?
                        </summary>
                        <p class="mt-3 text-gray-600 text-sm">
                            Toutes vos factures sont disponibles dans la section "Factures"
                            de votre espace client. Cliquez sur "Télécharger" pour obtenir un PDF.
                        </p>
                    </details>

                    <details class="border border-gray-200 rounded-lg p-4">
                        <summary class="font-medium text-gray-900 cursor-pointer">
                            Quel est le délai de réponse du support ?
                        </summary>
                        <p class="mt-3 text-gray-600 text-sm">
                            • Questions générales : 24 heures ouvrées<br>
                            • Demandes complexes : 48-72 heures<br>
                            Pour une réponse plus rapide, contactez-nous par téléphone.
                        </p>
                    </details>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="font-semibold text-gray-900 mb-3">Mes tickets ouverts</h4>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <i class="fas fa-comments text-gray-400 text-2xl mb-2"></i>
                        <p class="text-sm text-gray-600">Fonctionnalité à venir</p>
                        <p class="text-xs text-gray-500">Bientôt : suivez vos tickets de support ici</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const autreServiceRadio = document.getElementById('autre-service');
        const autreFieldContainer = document.getElementById('autre-field-container');
        const autreFieldInput = document.querySelector('input[name="autre_service"]');

        function toggleOtherField() {
            if (autreServiceRadio && autreServiceRadio.checked) {
                autreFieldContainer.classList.add('show');
                if (autreFieldInput) autreFieldInput.required = true;
            } else {
                autreFieldContainer.classList.remove('show');
                if (autreFieldInput) autreFieldInput.required = false;
            }
        }

        // Gérer les radios de service
        document.querySelectorAll('input[name="service_type"]').forEach(radio => {
            radio.addEventListener('change', toggleOtherField);
        });

        // Initialiser l'état
        toggleOtherField();

        const form = document.getElementById('support-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');

        if (form) {
            // Gérer la soumission du formulaire
            form.addEventListener('submit', function(e) {
                // Validation simple
                const messageField = document.querySelector('textarea[name="message"]');
                if (messageField && messageField.value.length < 10) {
                    e.preventDefault();
                    alert('Veuillez écrire un message d\'au moins 10 caractères.');
                    return;
                }

                // Afficher le loading
                if (submitBtn) submitBtn.disabled = true;
                if (btnText) btnText.classList.add('hidden');
                if (btnLoading) btnLoading.classList.remove('hidden');
            });

            // Si des erreurs sont présentes, réactiver le bouton
            if (document.querySelector('.border-red-500')) {
                if (submitBtn) submitBtn.disabled = false;
                if (btnText) btnText.classList.remove('hidden');
                if (btnLoading) btnLoading.classList.add('hidden');
            }
        }

        // Auto-select service based on referer ou contexte
        const currentPath = window.location.pathname;
        if (currentPath.includes('formations')) {
            const formationRadio = document.querySelector('input[value="formations"]');
            if (formationRadio) {
                formationRadio.checked = true;
                toggleOtherField();
            }
        } else if (currentPath.includes('location')) {
            const locationRadio = document.querySelector('input[value="location"]');
            if (locationRadio) {
                locationRadio.checked = true;
                toggleOtherField();
            }
        } else if (currentPath.includes('reservations')) {
            const vtcRadio = document.querySelector('input[value="vtc"]');
            if (vtcRadio) {
                vtcRadio.checked = true;
                toggleOtherField();
            }
        } else if (currentPath.includes('conciergerie')) {
            const conciergerieRadio = document.querySelector('input[value="conciergerie"]');
            if (conciergerieRadio) {
                conciergerieRadio.checked = true;
                toggleOtherField();
            }
        }
    });
</script>
@endpush
