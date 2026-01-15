@extends('layouts.main')

@section('title', __('formation-elearning.acheter_elearning.title', ['formation' => $formation->title]))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-600">
                            {{ __('formation-elearning.acheter_elearning.breadcrumb.accueil') }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <a href="{{ route('formation') }}" class="hover:text-yellow-600">
                            {{ __('formation-elearning.acheter_elearning.breadcrumb.formations') }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <span class="text-gray-900 font-medium">{{ $formation->title }}</span>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- En-tête -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-8 py-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $formation->title }}</h1>
                    <div class="flex items-center text-blue-200">
                        <i class="{{ __('formation-elearning.acheter_elearning.header.icon') }} mr-2"></i>
                        <span>{{ __('formation-elearning.acheter_elearning.header.type') }} • {{
                            __('formation-elearning.acheter_elearning.header.access') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-6 md:p-8">
                    <!-- Colonne gauche : Détails -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ __('formation-elearning.acheter_elearning.details.title') }}
                        </h2>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                {{ __('formation-elearning.acheter_elearning.details.description.title') }}
                            </h3>
                            <p class="text-gray-700">{{ $formation->description }}</p>
                        </div>

                        <!-- Programme -->
                        @if($formation->program && count($formation->program) > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                {{ __('formation-elearning.acheter_elearning.details.programme.title') }}
                            </h3>
                            <ul class="space-y-2">
                                @foreach($formation->program as $module)
                                <li class="flex items-start">
                                    <i class="{{ __('formation-elearning.acheter_elearning.details.programme.check_icon') }} text-green-500 mt-1 mr-3"></i>
                                    <span>{{ $module }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Contenu inclus -->
                        @if($formation->included_services && count($formation->included_services) > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                {{ __('formation-elearning.acheter_elearning.details.inclus.title') }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($formation->included_services as $service)
                                <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-100">
                                    <i class="{{ __('formation-elearning.acheter_elearning.details.inclus.check_icon') }} text-green-600 mr-3"></i>
                                    <span class="text-gray-800">{{ $service }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Médias disponibles -->
                        @if($formation->media && $formation->media->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                {{ __('formation-elearning.acheter_elearning.details.multimedia.title') }}
                            </h3>
                            <div class="space-y-4">
                                @foreach($formation->media as $media)
                                @php
                                    $typeConfig = [
                                        'pdf' => [
                                            'icon' => 'fas fa-file-pdf',
                                            'color' => 'red',
                                        ],
                                        'video' => [
                                            'icon' => 'fas fa-video',
                                            'color' => 'blue',
                                        ],
                                    ][$media->type] ?? [
                                        'icon' => 'fas fa-file',
                                        'color' => 'gray'
                                    ];
                                @endphp
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                    <div class="mr-4">
                                        <div class="w-12 h-12 bg-{{ $typeConfig['color'] }}-100 rounded-lg flex items-center justify-center">
                                            <i class="{{ $typeConfig['icon'] }} text-{{ $typeConfig['color'] }}-600 text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $media->title }}</h4>
                                        @if($media->description)
                                        <p class="text-sm text-gray-600">{{ $media->description }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        @if($media->file_size)
                                        <span class="text-sm text-gray-500">{{ $media->file_size }}</span>
                                        @endif
                                        @if($media->duration)
                                        <div class="text-sm text-gray-500">{{ $media->duration }}</div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Colonne droite : Achat -->
                    <div>
                        <div class="bg-gray-50 rounded-xl p-6 sticky top-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">
                                {{ __('formation-elearning.acheter_elearning.achat.title') }}
                            </h2>

                            <!-- Prix -->
                            <div class="text-center mb-8">
                                <div class="text-5xl font-bold text-yellow-600 mb-2">
                                    {{ number_format($formation->price, 0, ',', ' ') }} {{
                                    __('formation-elearning.acheter_elearning.achat.prix.currency') }}
                                </div>
                                <div class="text-gray-600">{{
                                    __('formation-elearning.acheter_elearning.achat.prix.label') }}</div>
                            </div>

                            <!-- Avantages -->
                            <div class="space-y-4 mb-8">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ __('formation-elearning.acheter_elearning.achat.avantages.title') }}
                                </h3>
                                @foreach(__('formation-elearning.acheter_elearning.achat.avantages.items') as $item)
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-{{ __('formation-elearning.acheter_elearning.achat.avantages.icon_color') }}-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="{{ $item['icon'] }} text-{{ __('formation-elearning.acheter_elearning.achat.avantages.icon_color') }}-600"></i>
                                    </div>
                                    <span>{{ $item['text'] }}</span>
                                </div>
                                @endforeach
                            </div>

                            <!-- Formulaire de paiement -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    {{ __('formation-elearning.acheter_elearning.achat.paiement.title') }}
                                </h3>

                                @if(auth()->check())
                                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-circle text-blue-600 text-xl mr-3"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">{{
                                                __('formation-elearning.acheter_elearning.achat.paiement.connecte_comme')
                                                }}</p>
                                            <p class="text-gray-700">{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <form id="payment-form" method="POST">
                                    @csrf

                                    @if(!auth()->check())
                                    <div class="space-y-4 mb-6">
                                        <div>
                                            <label class="block text-gray-700 mb-2">
                                                {{ __('formation-elearning.acheter_elearning.achat.champs.email.label')
                                                }}
                                            </label>
                                            <input type="email" name="email" id="email" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                                placeholder="{{ __('formation-elearning.acheter_elearning.achat.champs.email.placeholder') }}">
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 mb-2">
                                                {{ __('formation-elearning.acheter_elearning.achat.champs.nom.label') }}
                                            </label>
                                            <input type="text" name="nom" id="nom" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                                placeholder="{{ __('formation-elearning.acheter_elearning.achat.champs.nom.placeholder') }}">
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Options de paiement -->
                                    <div class="mb-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="font-medium text-gray-900">
                                                {{ __('formation-elearning.acheter_elearning.achat.paiement.moyen_paiement') }}
                                            </h4>
                                            <div class="flex items-center space-x-2">
                                                <i class="fab fa-cc-visa text-gray-400 text-xl"></i>
                                                <i class="fab fa-cc-mastercard text-gray-400 text-xl"></i>
                                                <i class="fab fa-cc-amex text-gray-400 text-xl"></i>
                                            </div>
                                        </div>

                                        <div class="p-4 bg-gray-100 rounded-lg">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    <i class="{{ __('formation-elearning.acheter_elearning.achat.paiement.carte_bancaire.icon') }} text-gray-600 text-2xl"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="font-medium text-gray-900">
                                                        {{ __('formation-elearning.acheter_elearning.achat.paiement.carte_bancaire.label') }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        {{ __('formation-elearning.acheter_elearning.achat.paiement.carte_bancaire.description') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- CGV -->
                                    <div class="mb-6">
                                        <div class="flex items-start">
                                            <input type="checkbox" id="terms" name="terms" required
                                                class="mt-1 mr-3 h-5 w-5 text-yellow-600 rounded focus:ring-yellow-500">
                                            <label for="terms" class="text-gray-700 text-sm">
                                                {!! str_replace(
                                                    [':cgu', ':rgpd'],
                                                    [
                                                        '<a href="' . route('cgu') . '" class="text-yellow-600 hover:underline">' . __('formation-elearning.acheter_elearning.achat.cgv.cgu') . '</a>',
                                                        '<a href="' . route('rgpd') . '" class="text-yellow-600 hover:underline">' . __('formation-elearning.acheter_elearning.achat.cgv.rgpd') . '</a>'
                                                    ],
                                                    __('formation-elearning.acheter_elearning.achat.cgv.label')
                                                ) !!}
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Bouton de paiement -->
                                    <button type="button" id="submit-btn"
                                        class="w-full py-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100">
                                        <i class="{{ __('formation-elearning.acheter_elearning.achat.bouton_paiement.icon') }} mr-3"></i>
                                        <span>{{ str_replace(':prix', number_format($formation->price, 0, ',', ' '), __('formation-elearning.acheter_elearning.achat.bouton_paiement.text')) }}</span>
                                        <span id="loading-spinner" class="hidden ml-3">
                                            <i class="{{ __('formation-elearning.acheter_elearning.achat.bouton_paiement.loading_icon') }}"></i>
                                        </span>
                                    </button>

                                    <!-- Messages d'erreur -->
                                    <div id="error-message" class="hidden mt-4 p-3 bg-red-50 text-red-700 rounded-lg">
                                    </div>

                                    <!-- Messages de succès -->
                                    <div id="success-message"
                                        class="hidden mt-4 p-3 bg-green-50 text-green-700 rounded-lg">
                                    </div>

                                    <!-- Sécurité -->
                                    <div class="mt-4 text-center">
                                        <div class="flex items-center justify-center text-sm text-gray-600">
                                            <i class="{{ __('formation-elearning.acheter_elearning.achat.securite.icon') }} text-{{ __('formation-elearning.acheter_elearning.achat.securite.color') }}-600 mr-2"></i>
                                            <span>{{ __('formation-elearning.acheter_elearning.achat.securite.text') }}</span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Assistance -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                                    {{ __('formation-elearning.acheter_elearning.assistance.title') }}
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-700">
                                        <i class="{{ __('formation-elearning.acheter_elearning.assistance.telephone.icon') }} text-{{ __('formation-elearning.acheter_elearning.assistance.telephone.color') }}-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">{{
                                                __('formation-elearning.acheter_elearning.assistance.telephone.label')
                                                }}</p>
                                            <p class="text-sm text-gray-600">{{
                                                __('formation-elearning.acheter_elearning.assistance.telephone.horaires')
                                                }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <i class="{{ __('formation-elearning.acheter_elearning.assistance.email.icon') }} text-{{ __('formation-elearning.acheter_elearning.assistance.email.color') }}-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">{{
                                                __('formation-elearning.acheter_elearning.assistance.email.label') }}
                                            </p>
                                            <p class="text-sm text-gray-600">{{
                                                __('formation-elearning.acheter_elearning.assistance.email.delai') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Retour -->
            <div class="mt-8 text-center">
                <a href="{{ route('formation') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300">
                    <i class="{{ __('formation-elearning.acheter_elearning.retour.icon') }} mr-2"></i>
                    {{ __('formation-elearning.acheter_elearning.retour.text') }}
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submit-btn');
        const loadingSpinner = document.getElementById('loading-spinner');
        const errorMessage = document.getElementById('error-message');
        const successMessage = document.getElementById('success-message');
        const termsCheckbox = document.getElementById('terms');
        const paymentUrl = "{{ route('formation.create.payment.session', $formation->id) }}";

        // Messages de traduction
        const messages = {
            requiredFields: "{{ __('formation-elearning.acheter_elearning.validation.required_fields') }}",
            invalidEmail: "{{ __('formation-elearning.acheter_elearning.validation.invalid_email') }}",
            acceptCGV: "{{ __('formation-elearning.acheter_elearning.validation.accept_cgv') }}",
            paymentError: "{{ __('formation-elearning.acheter_elearning.validation.payment_error') }}",
            processing: "{{ __('formation-elearning.acheter_elearning.messages.processing') }}",
            redirecting: "{{ __('formation-elearning.acheter_elearning.messages.redirecting') }}",
        };

        // Gérer le clic sur le bouton de paiement
        submitBtn.addEventListener('click', async function(e) {
            e.preventDefault();

            // Validation des termes
            if (!termsCheckbox.checked) {
                showError(messages.acceptCGV);
                return;
            }

            // Validation de l'email si non connecté
            if (!{{ auth()->check() ? 'true' : 'false' }}) {
                const email = document.getElementById('email').value;
                const nom = document.getElementById('nom').value;

                if (!email || !nom) {
                    showError(messages.requiredFields);
                    return;
                }

                if (!isValidEmail(email)) {
                    showError(messages.invalidEmail);
                    return;
                }
            }

            // Activer le loading
            submitBtn.disabled = true;
            loadingSpinner.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            successMessage.classList.add('hidden');

            // Mettre à jour le texte du bouton
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = `<span>${messages.processing}</span>`;

            try {
                // Préparer les données
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');

                if (!{{ auth()->check() ? 'true' : 'false' }}) {
                    formData.append('email', document.getElementById('email').value);
                    formData.append('nom', document.getElementById('nom').value);
                }

                // Envoyer la requête
                const response = await fetch(paymentUrl, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.url) {
                    // Afficher le message de redirection
                    submitBtn.innerHTML = `<span>${messages.redirecting}</span>`;

                    // Petite pause pour montrer le message
                    setTimeout(() => {
                        // Rediriger vers Stripe Checkout
                        window.location.href = data.url;
                    }, 1000);
                } else {
                    throw new Error(data.error || messages.paymentError);
                }
            } catch (error) {
                console.error('Error:', error);
                showError(error.message || messages.paymentError);

                // Réactiver le bouton
                submitBtn.disabled = false;
                loadingSpinner.classList.add('hidden');
                submitBtn.innerHTML = originalText;
            }
        });

        // Validation des termes
        termsCheckbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });

        // Initialiser l'état du bouton
        submitBtn.disabled = !termsCheckbox.checked;

        // Fonction pour afficher les erreurs
        function showError(message) {
            errorMessage.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i> ${message}`;
            errorMessage.classList.remove('hidden');
            errorMessage.classList.add('flex', 'items-center');

            // Auto-hide après 5 secondes
            setTimeout(() => {
                errorMessage.classList.add('hidden');
            }, 5000);
        }

        // Fonction pour afficher les succès
        function showSuccess(message) {
            successMessage.innerHTML = `<i class="fas fa-check-circle mr-2"></i> ${message}`;
            successMessage.classList.remove('hidden');
            successMessage.classList.add('flex', 'items-center');
        }

        // Fonction de validation d'email
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Animation d'entrée des cartes
        const cards = document.querySelectorAll('.bg-white, .bg-gray-50');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });

        // Animation du prix
        const priceElement = document.querySelector('.text-5xl.text-yellow-600');
        if (priceElement) {
            setTimeout(() => {
                priceElement.classList.add('animate-pulse');
                setTimeout(() => priceElement.classList.remove('animate-pulse'), 2000);
            }, 500);
        }
    });
</script>
@endsection