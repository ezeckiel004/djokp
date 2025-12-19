@extends('layouts.main')

@section('title', $vehicle->full_name . ' - DJOK PRESTIGE Location')

@section('content')
<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)),
        url('{{ $vehicle->image_url }}') center/cover no-repeat;
        height: 60vh;
        min-height: 400px;
    }

    .vehicle-gallery {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .vehicle-gallery {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .feature-badge {
        @apply inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mr-2 mb-2;
    }

    .price-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .similar-vehicle-card {
        transition: all 0.3s ease;
    }

    .similar-vehicle-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>

<!-- Hero Section avec image du véhicule -->
<section class="hero-bg relative">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative container mx-auto px-6 h-full flex items-center">
        <div class="max-w-4xl">
            <div class="inline-flex items-center bg-black bg-opacity-70 text-white px-4 py-2 rounded-full mb-4">
                <span class="{{ $vehicle->availabilityColor }} px-2 py-1 rounded-full text-xs font-semibold mr-2">
                    {{ $vehicle->availabilityFr }}
                </span>
                <span class="{{ $vehicle->categoryColor }} px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $vehicle->category_fr }}
                </span>
            </div>

            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                {{ $vehicle->full_name }}
            </h1>

            <p class="text-xl text-gray-200 mb-6">
                {{ $vehicle->brand }} {{ $vehicle->model }} • {{ $vehicle->year }} • {{ $vehicle->color }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#reservation-form"
                    class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Réserver maintenant
                </a>
                <a href="tel:0176380017"
                    class="inline-flex items-center px-8 py-3 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all duration-300">
                    <i class="fas fa-phone mr-2"></i>
                    01 76 38 00 17
                </a>
            </div>
        </div>
    </div>

    <!-- Bouton retour -->
    <div class="absolute top-6 left-6">
        <a href="{{ route('location') }}"
            class="inline-flex items-center px-4 py-2 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 transition-all duration-300 backdrop-blur-sm">
            <i class="fas fa-arrow-left mr-2"></i>
            Retour aux véhicules
        </a>
    </div>
</section>

<!-- Détails du véhicule -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Galerie et caractéristiques -->
            <div>
                <!-- Image principale -->
                <div class="mb-8">
                    <div class="rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                            class="w-full h-64 md:h-96 object-cover">
                    </div>
                </div>

                <!-- Galerie d'images (si disponible) -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Galerie</h3>
                    <div class="vehicle-gallery">
                        <!-- Image 1 -->
                        <div class="rounded-lg overflow-hidden">
                            <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }} - Vue 1"
                                class="w-full h-32 object-cover">
                        </div>
                        <!-- Image 2 (par défaut) -->
                        <div class="rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-car text-gray-400 text-3xl"></i>
                        </div>
                        <!-- Image 3 (par défaut) -->
                        <div class="rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-cogs text-gray-400 text-3xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($vehicle->description)
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Description</h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-600">{{ $vehicle->description }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Informations et tarifs -->
            <div>
                <!-- Fiche technique -->
                <div class="bg-gray-50 rounded-2xl p-6 mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Fiche technique</h3>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Marque</div>
                                <div class="font-semibold">{{ $vehicle->brand }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Modèle</div>
                                <div class="font-semibold">{{ $vehicle->model }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Année</div>
                                <div class="font-semibold">{{ $vehicle->year }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Couleur</div>
                                <div class="font-semibold">{{ $vehicle->color }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Type de carburant</div>
                                <div class="font-semibold">{{ $vehicle->fuel_type_fr }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Nombre de places</div>
                                <div class="font-semibold">{{ $vehicle->seats }} places</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Immatriculation</div>
                                <div class="font-semibold">{{ $vehicle->registration }}</div>
                            </div>
                            <div class="bg-white p-4 rounded-lg">
                                <div class="text-gray-600 text-sm mb-1">Catégorie</div>
                                <div class="font-semibold">{{ $vehicle->category_fr }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Équipements -->
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Équipements & options</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($vehicle->features_list as $feature)
                        <span class="feature-badge bg-yellow-100 text-yellow-800">
                            <i class="fas fa-check text-yellow-600 mr-1"></i>
                            {{ $feature }}
                        </span>
                        @endforeach

                        <!-- Équipements standard -->
                        @if(count($vehicle->features_list) < 5) <span class="feature-badge bg-blue-100 text-blue-800">
                            <i class="fas fa-car mr-1"></i>
                            Climatisation
                            </span>
                            <span class="feature-badge bg-blue-100 text-blue-800">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                GPS
                            </span>
                            <span class="feature-badge bg-blue-100 text-blue-800">
                                <i class="fas fa-bluetooth mr-1"></i>
                                Bluetooth
                            </span>
                            <span class="feature-badge bg-blue-100 text-blue-800">
                                <i class="fas fa-camera mr-1"></i>
                                Caméra de recul
                            </span>
                            @endif
                    </div>
                </div>

                <!-- Tarifs -->
                <div class="price-card rounded-2xl p-6 text-white mb-8">
                    <h3 class="text-2xl font-bold mb-4">Tarifs de location</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-white border-opacity-20">
                            <div>
                                <div class="font-semibold">Location à la journée</div>
                                <div class="text-sm opacity-80">Minimum 1 jour</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold">{{ $vehicle->daily_rate_formatted }}</div>
                                <div class="text-sm opacity-80">TTC / jour</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b border-white border-opacity-20">
                            <div>
                                <div class="font-semibold">Location à la semaine</div>
                                <div class="text-sm opacity-80">Minimum 7 jours</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold">{{ $vehicle->weekly_rate_formatted }}</div>
                                <div class="text-sm opacity-80">TTC / semaine</div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div>
                                <div class="font-semibold">Location au mois</div>
                                <div class="text-sm opacity-80">Minimum 30 jours</div>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold">{{ $vehicle->monthly_rate_formatted }}</div>
                                <div class="text-sm opacity-80">TTC / mois</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 bg-white bg-opacity-10 rounded-lg p-4">
                        <div class="flex items-center">
                            <i class="fas fa-info-circle text-xl mr-3"></i>
                            <div class="text-sm">
                                <strong>Inclus dans tous nos tarifs :</strong> Assurance tous risques, entretien,
                                assistance 24h/24
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bouton de réservation -->
                <div class="text-center">
                    <a href="#reservation-form"
                        class="inline-flex items-center justify-center w-full px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <i class="fas fa-calendar-check mr-3"></i>
                        Réserver ce véhicule
                    </a>
                    <p class="text-gray-600 text-sm mt-3">
                        <i class="fas fa-shield-alt text-green-500 mr-1"></i>
                        Réservation 100% sécurisée • Sans engagement
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de réservation -->
<section id="reservation-form" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Réserver {{ $vehicle->full_name }}</h2>
                <p class="text-gray-600">
                    Remplissez le formulaire ci-dessous pour réserver ce véhicule. Notre équipe vous contactera dans les
                    plus brefs délais.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8">
                @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('location.reservation.store') }}" method="POST" id="vehicleReservationForm">
                    @csrf

                    <!-- Véhicule sélectionné (caché) -->
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                    <div class="space-y-4">
                        <!-- Champ Nom complet -->
                        <div>
                            <label class="block text-gray-700 mb-2">Nom complet *</label>
                            <input type="text" name="nom" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                value="{{ old('nom') }}">
                            @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Email -->
                        <div>
                            <label class="block text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                value="{{ old('email') }}">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Téléphone -->
                        <div>
                            <label class="block text-gray-700 mb-2">Téléphone *</label>
                            <input type="tel" name="telephone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                value="{{ old('telephone') }}">
                            @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Champ Type de véhicule (affiché en lecture seule) -->
                        <div>
                            <label class="block text-gray-700 mb-2">Véhicule sélectionné *</label>
                            <input type="text" readonly required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed"
                                value="{{ $vehicle->full_name }}">
                            <p class="text-sm text-gray-500 mt-1">Vous réservez ce véhicule</p>
                        </div>

                        <!-- CHAMP DATE DE DÉBUT DE LOCATION -->
                        <div>
                            <label class="block text-gray-700 mb-2">Date de début de location *</label>
                            <input type="date" name="date_debut" id="date_debut" required min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                value="{{ old('date_debut') }}">
                            <p class="text-sm text-gray-500 mt-1">La date minimale est aujourd'hui</p>
                            @error('date_debut')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CHAMP DATE DE FIN DE LOCATION -->
                        <div>
                            <label class="block text-gray-700 mb-2">Date de fin de location *</label>
                            <input type="date" name="date_fin" id="date_fin" required
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                value="{{ old('date_fin') }}">
                            <p class="text-sm text-gray-500 mt-1">La date doit être postérieure à la date de début</p>
                            @error('date_fin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Vérification de disponibilité -->
                        <div id="availability_check" class="hidden p-4 bg-gray-50 rounded-lg">
                            <div id="availability_result"></div>
                        </div>

                        <!-- Estimation de prix -->
                        <div id="price_estimation" class="hidden p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <h4 class="font-bold text-yellow-900 mb-2">Estimation de prix :</h4>
                            <div id="price_result"></div>
                        </div>

                        <!-- Message supplémentaire -->
                        <div>
                            <label class="block text-gray-700 mb-2">Message (optionnel)</label>
                            <textarea name="notes" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                placeholder="Informations complémentaires, questions...">{{ old('notes') }}</textarea>
                        </div>

                        <!-- CGV -->
                        <div>
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" id="terms" required
                                    class="mt-1 mr-3 h-5 w-5 text-yellow-600 rounded focus:ring-yellow-500">
                                <label for="terms" class="text-gray-700 text-sm">
                                    J'accepte les <a href="{{ route('cgv') }}"
                                        class="text-yellow-600 hover:underline">conditions générales de location</a>
                                    et j'ai pris connaissance de la <a href="{{ route('rgpd') }}"
                                        class="text-yellow-600 hover:underline">politique de confidentialité</a>.
                                </label>
                            </div>
                            @error('terms')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="text-center mt-6">
                        <button type="submit" id="submit_btn"
                            class="w-full inline-flex items-center justify-center px-6 py-4 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Envoyer ma demande de réservation
                        </button>
                        <p class="text-gray-600 text-sm mt-4">
                            <i class="fas fa-lock text-green-500 mr-1"></i>
                            Vos données sont sécurisées
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Véhicules similaires -->
@if($similarVehicles->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Véhicules similaires</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Découvrez d'autres véhicules de la même catégorie qui pourraient vous intéresser.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($similarVehicles as $similar)
            <div class="similar-vehicle-card bg-white rounded-xl shadow-lg overflow-hidden">
                <a href="{{ route('vehicle.details', $similar->id) }}">
                    <div class="relative">
                        <img src="{{ $similar->image_url }}" alt="{{ $similar->full_name }}"
                            class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span
                                class="{{ $similar->availabilityColor }} px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $similar->availabilityFr }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $similar->full_name }}</h4>
                        <p class="text-gray-600 mb-3">{{ $similar->category_fr }} • {{ $similar->fuel_type_fr }}</p>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-yellow-600">{{ $similar->daily_rate_formatted
                                    }}</span>
                                <span class="text-gray-500">/jour</span>
                            </div>
                            <span class="{{ $similar->categoryColor }} px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $similar->category_fr }}
                            </span>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('vehicle.details', $similar->id) }}"
                                class="block text-center w-full px-4 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300">
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- FAQ -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Questions fréquentes</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Tout ce que vous devez savoir sur la location de ce véhicule.
            </p>
        </div>

        <div class="max-w-3xl mx-auto space-y-6">
            <div class="bg-white rounded-xl shadow p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-2">Quels documents sont nécessaires pour la location ?
                </h4>
                <p class="text-gray-600">
                    Pour louer ce véhicule, vous aurez besoin de : votre pièce d'identité valide, permis de conduire B
                    depuis plus de 3 ans,
                    justificatif de domicile de moins de 3 mois, et pour les locations professionnelles, votre carte
                    VTC.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-2">L'assurance est-elle incluse ?</h4>
                <p class="text-gray-600">
                    Oui, toutes nos locations incluent une assurance tous risques avec franchise réduite.
                    L'assurance conducteur supplémentaire est également disponible en option.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-2">Puis-je modifier ou annuler ma réservation ?</h4>
                <p class="text-gray-600">
                    Vous pouvez modifier votre réservation jusqu'à 48h avant le début de la location.
                    Les annulations sont possibles avec des conditions variables selon le délai.
                </p>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-2">Y a-t-il un kilométrage maximum ?</h4>
                <p class="text-gray-600">
                    Pour les locations courte durée, un forfait kilométrique est inclus.
                    Pour les locations longue durée, le kilométrage est illimité pour les véhicules VTC.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Prêt à réserver {{ $vehicle->full_name }} ?</h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Contactez-nous directement pour toute question ou pour réserver ce véhicule par téléphone.
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="tel:0176380017"
                class="inline-flex items-center px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                <i class="fas fa-phone mr-3"></i>
                01 76 38 00 17
            </a>
            <a href="mailto:location@djokprestige.com"
                class="inline-flex items-center px-8 py-4 bg-gray-700 text-white text-lg font-semibold rounded-lg hover:bg-gray-600 transition-all duration-300">
                <i class="fas fa-envelope mr-3"></i>
                location@djokprestige.com
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const dateDebutInput = document.getElementById('date_debut');
    const dateFinInput = document.getElementById('date_fin');
    const availabilityCheck = document.getElementById('availability_check');
    const availabilityResult = document.getElementById('availability_result');
    const priceEstimation = document.getElementById('price_estimation');
    const priceResult = document.getElementById('price_result');
    const submitBtn = document.getElementById('submit_btn');
    const vehicleId = {{ $vehicle->id }};
    
    if (dateDebutInput && dateFinInput) {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Formater les dates au format YYYY-MM-DD
        const formattedToday = today.toISOString().split('T')[0];
        const formattedTomorrow = tomorrow.toISOString().split('T')[0];

        // Définir les dates minimales
        dateDebutInput.min = formattedToday;
        dateFinInput.min = formattedTomorrow;

        // Mettre à jour la date minimale de fin lorsque la date de début change
        dateDebutInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const nextDay = new Date(selectedDate);
            nextDay.setDate(nextDay.getDate() + 1);

            const formattedNextDay = nextDay.toISOString().split('T')[0];
            dateFinInput.min = formattedNextDay;

            // Si la date de fin est antérieure à la nouvelle date minimale, réinitialiser
            if (dateFinInput.value && dateFinInput.value < formattedNextDay) {
                dateFinInput.value = formattedNextDay;
            }

            checkAvailabilityAndPrice();
        });

        // Validation : date de fin doit être postérieure à date de début
        dateFinInput.addEventListener('change', function() {
            if (dateDebutInput.value && this.value) {
                const dateDebut = new Date(dateDebutInput.value);
                const dateFin = new Date(this.value);

                if (dateFin <= dateDebut) {
                    alert("La date de fin doit être postérieure à la date de début.");
                    const nextDay = new Date(dateDebut);
                    nextDay.setDate(nextDay.getDate() + 1);
                    this.value = nextDay.toISOString().split('T')[0];
                }
            }

            checkAvailabilityAndPrice();
        });

        // Vérifier la disponibilité et calculer le prix
        function checkAvailabilityAndPrice() {
            const dateDebut = dateDebutInput.value;
            const dateFin = dateFinInput.value;

            if (!dateDebut || !dateFin) {
                availabilityCheck.classList.add('hidden');
                priceEstimation.classList.add('hidden');
                return;
            }

            // Vérifier que la date de fin est après la date de début
            if (new Date(dateFin) <= new Date(dateDebut)) {
                return;
            }

            // Afficher le loader
            availabilityResult.innerHTML = `
                <div class="flex items-center">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-yellow-600 mr-2"></div>
                    <span>Vérification en cours...</span>
                </div>
            `;
            availabilityCheck.classList.remove('hidden');

            // Envoyer la requête AJAX
            fetch('{{ route("location.reservation.check.availability") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    vehicle_id: vehicleId,
                    date_debut: dateDebut,
                    date_fin: dateFin
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    availabilityResult.innerHTML = `
                        <div class="text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            ${data.message}
                        </div>
                    `;

                    // Afficher l'estimation de prix
                    priceResult.innerHTML = `
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Durée :</span>
                                <span class="font-semibold">${data.duree_jours} jours</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Type de tarif :</span>
                                <span class="font-semibold">${data.tarif_type}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Montant estimé :</span>
                                <span class="font-bold text-lg text-yellow-700">${parseFloat(data.montant_estime).toFixed(2).replace('.', ',')} €</span>
                            </div>
                            <div class="text-sm text-gray-600 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Prix indicatif TTC
                            </div>
                        </div>
                    `;
                    priceEstimation.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    availabilityResult.innerHTML = `
                        <div class="text-red-600">
                            <i class="fas fa-times-circle mr-2"></i>
                            ${data.message}
                        </div>
                    `;
                    priceEstimation.classList.add('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                availabilityResult.innerHTML = `
                    <div class="text-red-600">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Erreur lors de la vérification. Veuillez réessayer.
                    </div>
                `;
                priceEstimation.classList.add('hidden');
            });
        }

        // Vérifier la disponibilité si les dates sont déjà remplies
        if (dateDebutInput.value && dateFinInput.value) {
            checkAvailabilityAndPrice();
        }
    }
});
</script>
@endsection