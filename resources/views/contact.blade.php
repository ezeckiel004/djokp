@extends('layouts.base-black')

@section('title', 'Contact - DJOK PRESTIGE')

@section('content')
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
</style>

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

<div class="container mx-auto px-6 py-12">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Contactez DJOK PRESTIGE</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Vous avez une question, un projet ou besoin d'un service spécifique ? Notre équipe est à votre écoute
                pour vous accompagner.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Formulaire de contact -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
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

                    <form action="{{ route('contact.store') }}" method="POST" id="contact-form">
                        @csrf

                        <!-- Informations personnelles -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Vos informations</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2">Nom complet *</label>
                                    <input type="text" name="nom" required value="{{ old('nom') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nom') border-red-500 @enderror"
                                        placeholder="Votre nom et prénom">
                                    @error('nom')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2">Email *</label>
                                    <input type="email" name="email" required value="{{ old('email') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                        placeholder="votre@email.com">
                                    @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 mb-2">Téléphone</label>
                                <input type="tel" name="telephone" value="{{ old('telephone') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('telephone') border-red-500 @enderror"
                                    placeholder="+33 1 23 45 67 89">
                                @error('telephone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sélection du service -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Type de service concerné *</h3>
                            <p class="text-gray-600 text-sm mb-4">Sélectionnez le service qui correspond à votre demande
                            </p>

                            @error('service_id')
                            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                            @enderror

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                @foreach($services as $service)
                                <label class="cursor-pointer">
                                    <input type="radio" name="service_id" value="{{ $service->id }}"
                                        class="service-radio hidden" {{ old('service_id')==$service->id ? 'checked' : ''
                                    }}>
                                    <div
                                        class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                        <div class="flex items-center">
                                            @if($service->icon)
                                            <div class="flex-shrink-0 mr-3">
                                                <i class="{{ $service->icon }} text-lg"
                                                    style="color: {{ $service->color }}"></i>
                                            </div>
                                            @endif
                                            <div>
                                                <h4 class="font-medium text-gray-900">{{ $service->name }}</h4>
                                                @if($service->price_from)
                                                <p class="text-sm text-gray-600 mt-1">
                                                    À partir de {{ number_format($service->price_from, 0, ',', ' ') }}€
                                                    @if($service->price_unit) /{{ $service->price_unit }} @endif
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                @endforeach

                                <!-- Option "Autre service" -->
                                <label class="cursor-pointer">
                                    <input type="radio" name="service_id" value="autre" class="service-radio hidden"
                                        id="autre-service" {{ old('service_id')=='autre' ? 'checked' : '' }}>
                                    <div
                                        class="service-card bg-white border-2 border-gray-200 rounded-lg p-4 hover:border-yellow-400 transition-all duration-200">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 mr-3">
                                                <i class="fas fa-plus-circle text-lg text-gray-400"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900">Autre service</h4>
                                                <p class="text-sm text-gray-600 mt-1">Précisez votre demande</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Champ "Autre" qui apparaît -->
                            <div id="autre-field-container"
                                class="other-field {{ old('service_id') == 'autre' ? 'show' : '' }}">
                                <div class="mt-4">
                                    <label class="block text-gray-700 mb-2">Précisez votre demande *</label>
                                    <input type="text" name="autre_service" value="{{ old('autre_service') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('autre_service') border-red-500 @enderror"
                                        placeholder="De quel service avez-vous besoin ?">
                                    @error('autre_service')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Votre message</h3>
                            <div>
                                <label class="block text-gray-700 mb-2">Message détaillé *</label>
                                <textarea name="message" rows="6" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                    placeholder="Décrivez en détail votre demande, vos besoins, vos contraintes...">{{ old('message') }}</textarea>
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
                                <i class="fas fa-paper-plane mr-3"></i>Envoyer mon message
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

            <!-- Informations de contact + Services populaires (inchangés) -->
            <div class="space-y-8">
                <!-- Coordonnées -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Nos coordonnées</h3>
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
                            <a href="tel:0176380017" class="text-lg text-gray-700 hover:text-yellow-600 block">01 76 38
                                00 17</a>
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
                            <a href="mailto:contact@djokprestige.com"
                                class="text-lg text-gray-700 hover:text-yellow-600 block">contact@djokprestige.com</a>
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
                        <div>
                            <div class="flex items-center mb-3">
                                <div class="h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-map-marker-alt text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Notre centre</h4>
                                </div>
                            </div>
                            <div class="text-gray-700">
                                <p class="font-medium">DJOK PRESTIGE</p>
                                <p class="text-sm text-gray-600 mt-1">123 Avenue des Champs-Élysées</p>
                                <p class="text-sm text-gray-600">75008 Paris</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services populaires -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Nos services populaires</h3>
                    <div class="space-y-3">
                        @foreach($services->take(4) as $service)
                        <div class="flex items-center p-3 bg-white rounded-lg border border-gray-200">
                            @if($service->icon)
                            <div class="flex-shrink-0 mr-3">
                                <i class="{{ $service->icon }}" style="color: {{ $service->color }}"></i>
                            </div>
                            @endif
                            <div>
                                <h4 class="font-medium text-gray-900 text-sm">{{ $service->name }}</h4>
                                @if($service->description)
                                <p class="text-xs text-gray-600 mt-1">{{ Str::limit($service->description, 40) }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

        document.querySelectorAll('input[name="service_id"]').forEach(radio => {
            radio.addEventListener('change', toggleOtherField);
        });

        toggleOtherField();

        const form = document.getElementById('contact-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');

        if (form) {
            form.addEventListener('submit', function() {
                if (submitBtn) submitBtn.disabled = true;
                if (btnText) btnText.classList.add('hidden');
                if (btnLoading) btnLoading.classList.remove('hidden');
            });

            if (document.querySelector('.border-red-500')) {
                if (submitBtn) submitBtn.disabled = false;
                if (btnText) btnText.classList.remove('hidden');
                if (btnLoading) btnLoading.classList.add('hidden');
            }
        }
    });
</script>
@endsection
