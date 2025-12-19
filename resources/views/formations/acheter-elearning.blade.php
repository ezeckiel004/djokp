@extends('layouts.main')

@section('title', 'Acheter ' . $formation->title . ' | DJOK PRESTIGE')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-600">Accueil</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <a href="{{ route('formation') }}" class="hover:text-yellow-600">Formations</a>
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
                        <i class="fas fa-graduation-cap mr-2"></i>
                        <span>Formation e-learning • Accès 12 mois</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                    <!-- Colonne gauche : Détails -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Détails de la formation</h2>

                        <!-- Description -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                            <p class="text-gray-700">{{ $formation->description }}</p>
                        </div>

                        <!-- Programme -->
                        @if($formation->program && count($formation->program) > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Programme</h3>
                            <ul class="space-y-2">
                                @foreach($formation->program as $module)
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>{{ $module }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Contenu inclus -->
                        @if($formation->included_services && count($formation->included_services) > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Ce qui est inclus</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($formation->included_services as $service)
                                <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-100">
                                    <i class="fas fa-check-circle text-green-600 mr-3"></i>
                                    <span class="text-gray-800">{{ $service }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Médias disponibles -->
                        @if($formation->media && $formation->media->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Contenu multimédia</h3>
                            <div class="space-y-4">
                                @foreach($formation->media as $media)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                    <div class="mr-4">
                                        @if($media->type == 'pdf')
                                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                                        </div>
                                        @elseif($media->type == 'video')
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-video text-blue-600 text-xl"></i>
                                        </div>
                                        @endif
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
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Procéder à l'achat</h2>

                            <!-- Prix -->
                            <div class="text-center mb-8">
                                <div class="text-5xl font-bold text-yellow-600 mb-2">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </div>
                                <div class="text-gray-600">TTC • Accès immédiat après paiement</div>
                            </div>

                            <!-- Avantages -->
                            <div class="space-y-4 mb-8">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <span>Accès 24h/24, 7j/7</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <span>Support technique inclus</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <span>Certificat de formation</span>
                                </div>
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-check text-green-600"></i>
                                    </div>
                                    <span>Accès illimité pendant 12 mois</span>
                                </div>
                            </div>

                            <!-- Formulaire de paiement -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations de paiement</h3>

                                @if(auth()->check())
                                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-circle text-blue-600 text-xl mr-3"></i>
                                        <div>
                                            <p class="font-medium text-gray-900">Connecté en tant que</p>
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
                                            <label class="block text-gray-700 mb-2">Email *</label>
                                            <input type="email" name="email" id="email" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                                placeholder="votre@email.com">
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 mb-2">Nom complet *</label>
                                            <input type="text" name="nom" id="nom" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                                placeholder="Votre nom">
                                        </div>
                                    </div>
                                    @endif

                                    <!-- Options de paiement -->
                                    <div class="mb-6">
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="font-medium text-gray-900">Moyen de paiement</h4>
                                            <div class="flex items-center space-x-2">
                                                <i class="fab fa-cc-visa text-blue-600 text-xl"></i>
                                                <i class="fab fa-cc-mastercard text-red-600 text-xl"></i>
                                                <i class="fab fa-cc-amex text-blue-800 text-xl"></i>
                                            </div>
                                        </div>

                                        <div class="p-4 bg-gray-100 rounded-lg">
                                            <div class="flex items-center">
                                                <div class="mr-4">
                                                    <i class="fas fa-credit-card text-gray-600 text-2xl"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <p class="font-medium text-gray-900">Carte bancaire</p>
                                                    <p class="text-sm text-gray-600">Paiement sécurisé par Stripe</p>
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
                                                J'accepte les <a href="{{ route('cgu') }}"
                                                    class="text-yellow-600 hover:underline">conditions générales
                                                    d'utilisation</a>
                                                et la <a href="{{ route('rgpd') }}"
                                                    class="text-yellow-600 hover:underline">politique de
                                                    confidentialité</a>.
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Bouton de paiement -->
                                    <button type="button" id="submit-btn"
                                        class="w-full py-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                        <i class="fas fa-lock mr-3"></i>
                                        <span>Payer {{ number_format($formation->price, 0, ',', ' ') }} €</span>
                                        <span id="loading-spinner" class="hidden ml-3">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>

                                    <!-- Messages d'erreur -->
                                    <div id="error-message" class="hidden mt-4 p-3 bg-red-50 text-red-700 rounded-lg">
                                    </div>

                                    <!-- Sécurité -->
                                    <div class="mt-4 text-center">
                                        <div class="flex items-center justify-center text-sm text-gray-600">
                                            <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                                            <span>Paiement 100% sécurisé • SSL crypté</span>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Assistance -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Besoins d'aide ?</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-700">
                                        <i class="fas fa-phone-alt text-yellow-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">01 76 38 00 17</p>
                                            <p class="text-sm text-gray-600">Lun-Ven 9h-19h</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <i class="fas fa-envelope text-yellow-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">support@djokprestige.com</p>
                                            <p class="text-sm text-gray-600">Réponse sous 24h</p>
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
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour aux formations
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
        const termsCheckbox = document.getElementById('terms');
        const paymentUrl = "{{ route('formation.create.payment.session', $formation->id) }}";

        // Gérer le clic sur le bouton de paiement
        submitBtn.addEventListener('click', async function(e) {
            e.preventDefault();

            // Validation des termes
            if (!termsCheckbox.checked) {
                showError('Veuillez accepter les conditions générales.');
                return;
            }

            // Validation de l'email si non connecté
            if (!{{ auth()->check() ? 'true' : 'false' }}) {
                const email = document.getElementById('email').value;
                const nom = document.getElementById('nom').value;

                if (!email || !nom) {
                    showError('Veuillez remplir tous les champs requis.');
                    return;
                }

                if (!isValidEmail(email)) {
                    showError('Veuillez entrer une adresse email valide.');
                    return;
                }
            }

            // Activer le loading
            submitBtn.disabled = true;
            loadingSpinner.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            submitBtn.classList.add('opacity-75');

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
                    // Rediriger vers Stripe Checkout
                    window.location.href = data.url;
                } else {
                    throw new Error(data.error || 'Erreur lors de la création de la session de paiement');
                }
            } catch (error) {
                console.error('Error:', error);
                showError(error.message || 'Une erreur est survenue. Veuillez réessayer.');

                // Réactiver le bouton
                submitBtn.disabled = false;
                loadingSpinner.classList.add('hidden');
                submitBtn.classList.remove('opacity-75');
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
            errorMessage.textContent = message;
            errorMessage.classList.remove('hidden');
            errorMessage.classList.add('flex', 'items-center');

            // Ajouter une icône d'erreur
            errorMessage.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i> ${message}`;
        }

        // Fonction de validation d'email
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    });
</script>
@endsection
