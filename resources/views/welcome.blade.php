@extends('layouts.main')

@section('title', 'DJOK PRESTIGE - VTC, Formations & Entrepreneuriat')

@section('content')
<!-- Header Hero Section avec Slider -->
<header class="relative flex flex-col min-h-screen overflow-hidden">
    @include('layouts.navbar')

    <!-- Slider Container -->
    <div class="relative flex-1">
        <!-- Slide 1 - Formation VTC -->
        <div class="absolute inset-0 flex items-center justify-center hero-slide active" data-slide="1">
            <!-- Image de fond avec overlay -->
            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                    alt="Formation VTC" class="object-cover w-full h-full opacity-60">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
            </div>

            <!-- Contenu du slide - Positionné plus bas -->
            <div class="relative z-10 max-w-6xl px-4 mx-auto mt-32 text-center text-white animate-fade-in-up"
                style="animation-delay: 0.2s;">
                <h1 class="mb-8 text-5xl font-bold md:text-7xl animate-fade-in-up" style="animation-delay: 0.4s;">
                    Devenez Chauffeur VTC Professionnel
                </h1>
                <p class="max-w-4xl mx-auto mb-12 text-xl md:text-2xl animate-fade-in-up"
                    style="animation-delay: 0.6s;">
                    Obtenez votre carte VTC avec une formation complète, certifiée Qualiopi,<br>
                    agréée par la préfecture et finançable par le CPF
                </p>

                <!-- Points clés -->
                <div class="grid max-w-3xl grid-cols-1 gap-4 mx-auto mb-16 md:grid-cols-3 animate-fade-in-up"
                    style="animation-delay: 0.8s;">
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Cours pratiques et théoriques</p>
                    </div>
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Suivi personnalisé jusqu'à l'examen</p>
                    </div>
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Accompagnement administratif inclus</p>
                    </div>
                </div>

                <!-- Boutons centrés -->
                <div class="flex flex-col justify-center gap-6 animate-fade-in-up" style="animation-delay: 1s;">
                    <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                        <a href="{{ route('formation') }}"
                            class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                            Découvrir la formation
                        </a>
                        <a href="{{ route('contact') }}"
                            class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                            Demander des informations
                        </a>
                    </div>
                </div>

                <!-- Compteur -->
                <div class="mt-16 animate-fade-in-up" style="animation-delay: 1.2s;">
                    <p class="text-xl font-semibold text-yellow-400">
                        Plusieurs centaines de chauffeurs accompagnés
                    </p>
                </div>
            </div>
        </div>

        <!-- Slide 2 - Location Véhicule -->
        <div class="absolute inset-0 flex items-center justify-center hero-slide" data-slide="2">
            <!-- Image de fond avec overlay -->
            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                    alt="Location VTC haut de gamme" class="object-cover w-full h-full opacity-60">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
            </div>

            <!-- Contenu du slide - Positionné plus bas -->
            <div class="relative z-10 max-w-6xl px-4 mx-auto mt-32 text-center text-white animate-fade-in-up">
                <h1 class="mb-8 text-5xl font-bold md:text-7xl">
                    Louez votre véhicule VTC haut de gamme
                </h1>
                <p class="max-w-3xl mx-auto mb-16 text-xl md:text-2xl">
                    Véhicules récents, prêts à l'emploi avec offres flexibles,<br>
                    tarifs compétitifs et entretien inclus
                </p>

                <!-- Boutons centrés -->
                <div class="flex flex-col items-center gap-6 sm:flex-row sm:justify-center">
                    <a href="{{ route('location') }}"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                        Voir les véhicules
                    </a>
                    <a href="{{ route('reservation') }}"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                        Réserver maintenant
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 3 - Service Conciergerie -->
        <div class="absolute inset-0 flex items-center justify-center hero-slide" data-slide="3">
            <!-- Image de fond avec overlay -->
            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                    alt="Service Conciergerie" class="object-cover w-full h-full opacity-60">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
            </div>

            <!-- Contenu du slide - Positionné plus bas -->
            <div class="relative z-10 max-w-6xl px-4 mx-auto mt-32 text-center text-white animate-fade-in-up">
                <h1 class="mb-8 text-5xl font-bold md:text-7xl">
                    Votre arrivée en France, notre priorité
                </h1>
                <p class="max-w-4xl mx-auto mb-12 text-xl md:text-2xl">
                    Service de conciergerie complet et personnalisé pour votre formation,<br>
                    voyage d'affaires ou projet d'installation
                </p>

                <!-- Services -->
                <div class="grid max-w-4xl grid-cols-2 gap-4 mx-auto mb-16 md:grid-cols-5">
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Accueil VIP à l'aéroport</p>
                    </div>
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Location de véhicule</p>
                    </div>
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Hébergement</p>
                    </div>
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Guide touristique</p>
                    </div>
                    <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl">
                        <p class="font-semibold">Accompagnement administratif</p>
                    </div>
                </div>

                <!-- Bouton centré pour la conciergerie -->
                <div class="flex justify-center">
                    <a href="{{ route('conciergerie') }}"
                        class="px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl">
                        Découvrir nos services de conciergerie
                    </a>
                </div>

                <!-- Texte bas -->
                <p class="max-w-3xl mx-auto mt-12 text-lg md:text-xl">
                    Une expérience fluide, sécurisée et haut de gamme,<br>
                    pensée pour votre confort et votre sérénité
                </p>
            </div>
        </div>

        <!-- Contrôles du slider -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 slider-prev
                      p-3 text-white bg-black/30 rounded-full hover:bg-black/50 transition duration-300">
            <i class="text-2xl fas fa-chevron-left"></i>
        </button>
        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 slider-next
                      p-3 text-white bg-black/30 rounded-full hover:bg-black/50 transition duration-300">
            <i class="text-2xl fas fa-chevron-right"></i>
        </button>

        <!-- Indicateurs de slide -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex gap-3">
            <button class="w-3 h-3 rounded-full bg-white slider-indicator active" data-slide="1"></button>
            <button class="w-3 h-3 rounded-full bg-white/50 slider-indicator" data-slide="2"></button>
            <button class="w-3 h-3 rounded-full bg-white/50 slider-indicator" data-slide="3"></button>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
        <a href="#services" class="text-white transition duration-300 hover:text-yellow-400">
            <i class="text-2xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Services Section -->
<section id="services" class="py-16 bg-white">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-bold text-gray-900 animate-fade-in">Nos Services</h2>
            <p class="max-w-3xl mx-auto mt-4 text-xl text-gray-600 animate-fade-in" style="animation-delay: 0.2s;">
                Découvrez notre gamme complète de services conçus pour répondre à tous vos besoins professionnels et
                personnels
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- VTC & Location -->
            <div class="p-8 text-center text-white transition duration-500 transform bg-gray-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-slide-in-left"
                style="animation-delay: 0.1s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-car"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">VTC & Location</h3>
                <p class="mb-6 text-gray-300">
                    Services de véhicules haut de gamme, déplacements professionnels et personnels avec chauffeurs
                    expérimentés.
                </p>
                <a href="{{ route('vtc-transport') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-lg">
                    Réserver maintenant
                </a>
            </div>

            <!-- Formations -->
            <div class="p-8 text-center text-white transition duration-500 transform bg-blue-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-slide-in-left"
                style="animation-delay: 0.2s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-blue-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-graduation-cap"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Formations</h3>
                <p class="mb-6 text-gray-300">
                    Formations professionnelles certifiantes pour développer vos compétences et booster votre
                    carrière.
                </p>
                <a href="{{ route('formation') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-700 hover:scale-105 hover:shadow-lg">
                    Voir les formations
                </a>
            </div>

            <!-- Entrepreneuriat Afrique -->
            <div class="p-8 text-center text-white transition duration-500 transform bg-yellow-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-slide-in-right"
                style="animation-delay: 0.3s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-globe-africa"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Entrepreneuriat Afrique</h3>
                <p class="mb-6 text-gray-300">
                    Accompagnement entrepreneurial adapté au contexte africain avec des experts locaux.
                </p>
                <a href="{{ route('formation.international') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-lg">
                    Découvrir
                </a>
            </div>

            <!-- Espace Client -->
            <div class="p-8 text-center text-white transition duration-500 transform bg-gray-900 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-slide-in-right"
                style="animation-delay: 0.4s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-gray-700 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-user-shield"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Espace Client</h3>
                <p class="mb-6 text-gray-300">
                    Accédez à votre espace personnel pour gérer vos réservations, formations et séminaires.
                </p>
                @auth
                @php
                $user = auth()->user();
                @endphp
                @if($user->hasRole('admin'))
                <a href="{{ route('admin.dashboard') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-gray-700 rounded-lg hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                    Tableau de bord Admin
                </a>
                @elseif($user->hasRole('client'))
                <a href="{{ route('client.dashboard') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-gray-700 rounded-lg hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                    Mon Espace Client
                </a>
                @elseif($user->hasRole('chauffeur'))
                <a href="{{ route('chauffeur.dashboard') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-gray-700 rounded-lg hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                    Espace Chauffeur
                </a>
                @elseif($user->hasRole('formateur'))
                <a href="{{ route('formateur.dashboard') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-gray-700 rounded-lg hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                    Espace Formateur
                </a>
                @else
                <a href="{{ route('dashboard') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-gray-700 rounded-lg hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                    Mon Tableau de bord
                </a>
                @endif
                @else
                <a href="{{ route('espaceclient') }}"
                    class="inline-block px-6 py-3 text-white transition duration-300 transform bg-gray-700 rounded-lg hover:bg-gray-600 hover:scale-105 hover:shadow-lg">
                    Se connecter
                </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section id="stats" class="py-16 text-white bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-bold animate-fade-in">DJOK PRESTIGE en Chiffres</h2>
            <p class="mt-4 text-xl text-gray-300 animate-fade-in" style="animation-delay: 0.2s;">Notre expertise se
                reflète dans nos résultats</p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="text-center animate-count-up" data-count="5000">
                <div class="mb-2 text-5xl font-bold text-yellow-600 counter">0</div>
                <p class="text-lg text-gray-300">Clients satisfaits</p>
            </div>
            <div class="text-center animate-count-up" data-count="500" style="animation-delay: 0.2s;">
                <div class="mb-2 text-5xl font-bold text-yellow-600 counter">0</div>
                <p class="text-lg text-gray-300">Formations dispensées</p>
            </div>
            <div class="text-center animate-count-up" data-count="50" style="animation-delay: 0.4s;">
                <div class="mb-2 text-5xl font-bold text-yellow-600 counter">0</div>
                <p class="text-lg text-gray-300">Projets accompagnés en Afrique</p>
            </div>
            <div class="text-center animate-count-up" data-count="99" style="animation-delay: 0.6s;">
                <div class="mb-2 text-5xl font-bold text-yellow-600 counter">0</div>
                <p class="text-lg text-gray-300">Taux de satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-16 bg-gray-100">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-bold text-gray-900 animate-fade-in">Ce que disent nos clients</h2>
            <p class="mt-4 text-xl text-gray-600 animate-fade-in" style="animation-delay: 0.2s;">Découvrez les
                témoignages de ceux qui nous font confiance</p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="p-8 transition duration-500 transform bg-white shadow-lg rounded-2xl hover:scale-105 hover:shadow-xl animate-slide-in-up"
                style="animation-delay: 0.1s;">
                <div class="mb-4 text-2xl text-yellow-400">
                    <i class="fas fa-quote-left"></i>
                </div>
                <p class="mb-6 text-lg italic text-gray-700">
                    "Service VTC exceptionnel ! Ponctualité, confort et professionnalisme au rendez-vous. Je
                    recommande vivement DJOK PRESTIGE pour tous mes déplacements professionnels."
                </p>
                <div class="flex items-center">
                    <div
                        class="flex items-center justify-center w-12 h-12 mr-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110">
                        <i class="text-gray-600 fas fa-user"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Marie Dubois</p>
                        <p class="text-sm text-gray-600">Directrice Marketing</p>
                    </div>
                </div>
            </div>

            <div class="p-8 transition duration-500 transform bg-white shadow-lg rounded-2xl hover:scale-105 hover:shadow-xl animate-slide-in-up"
                style="animation-delay: 0.3s;">
                <div class="mb-4 text-2xl text-yellow-400">
                    <i class="fas fa-quote-left"></i>
                </div>
                <p class="mb-6 text-lg italic text-gray-700">
                    "Grâce aux formations DJOK PRESTIGE, j'ai pu développer mon entreprise en Afrique.
                    L'accompagnement personnalisé a fait toute la différence dans mon projet."
                </p>
                <div class="flex items-center">
                    <div
                        class="flex items-center justify-center w-12 h-12 mr-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110">
                        <i class="text-gray-600 fas fa-user"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Ahmed Ben Ali</p>
                        <p class="text-sm text-gray-600">Entrepreneur</p>
                    </div>
                </div>
            </div>

            <div class="p-8 transition duration-500 transform bg-white shadow-lg rounded-2xl hover:scale-105 hover:shadow-xl animate-slide-in-up"
                style="animation-delay: 0.5s;">
                <div class="mb-4 text-2xl text-yellow-400">
                    <i class="fas fa-quote-left"></i>
                </div>
                <p class="mb-6 text-lg italic text-gray-700">
                    "Location de véhicule parfaite pour mes déplacements professionnels. Service client réactif et
                    véhicules toujours impeccables. Un partenariat de confiance !"
                </p>
                <div class="flex items-center">
                    <div
                        class="flex items-center justify-center w-12 h-12 mr-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110">
                        <i class="text-gray-600 fas fa-user"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Sophie Martin</p>
                        <p class="text-sm text-gray-600">Consultante Senior</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Styles et Scripts pour les animations -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideOutLeft {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(-50px);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }

        to {
            opacity: 0;
            transform: translateX(50px);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
        opacity: 0;
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-in-up {
        animation: slideInUp 0.8s ease-out forwards;
        opacity: 0;
    }

    .animate-slide-out-left {
        animation: slideOutLeft 0.8s ease-out forwards;
    }

    .animate-slide-out-right {
        animation: slideOutRight 0.8s ease-out forwards;
    }

    .animate-count-up {
        opacity: 1;
    }

    .service-card {
        transition: all 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
    }

    /* Styles du slider */
    .hero-slide {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease, visibility 0.8s;
    }

    .hero-slide.active {
        opacity: 1;
        visibility: visible;
    }

    .slider-indicator.active {
        background-color: #fbbf24;
        transform: scale(1.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Gestion du slider
        class HeroSlider {
            constructor() {
                this.slides = document.querySelectorAll('.hero-slide');
                this.indicators = document.querySelectorAll('.slider-indicator');
                this.currentSlide = 0;
                this.totalSlides = this.slides.length;
                this.autoSlideInterval = null;
                this.autoSlideDelay = 5000; // 5 secondes

                this.init();
            }

            init() {
                // Activer le premier slide
                this.showSlide(0);

                // Événements pour les boutons
                document.querySelector('.slider-prev').addEventListener('click', () => this.prevSlide());
                document.querySelector('.slider-next').addEventListener('click', () => this.nextSlide());

                // Événements pour les indicateurs
                this.indicators.forEach(indicator => {
                    indicator.addEventListener('click', (e) => {
                        const slideIndex = parseInt(e.target.dataset.slide) - 1;
                        this.goToSlide(slideIndex);
                    });
                });

                // Démarrer le défilement automatique
                this.startAutoSlide();
            }

            showSlide(index) {
                // Masquer tous les slides
                this.slides.forEach(slide => {
                    slide.classList.remove('active');
                });

                // Désactiver tous les indicateurs
                this.indicators.forEach(indicator => {
                    indicator.classList.remove('active');
                    indicator.style.backgroundColor = '';
                });

                // Afficher le slide actuel
                this.slides[index].classList.add('active');
                this.indicators[index].classList.add('active');

                // Réinitialiser les animations
                const animatedElements = this.slides[index].querySelectorAll('.animate-fade-in-up');
                animatedElements.forEach((el, i) => {
                    el.style.animationDelay = `${0.2 + (i * 0.2)}s`;
                    el.style.animation = 'none';
                    setTimeout(() => {
                        el.style.animation = '';
                    }, 10);
                });

                this.currentSlide = index;
            }

            nextSlide() {
                const nextIndex = (this.currentSlide + 1) % this.totalSlides;
                this.showSlide(nextIndex);
                this.resetAutoSlide();
            }

            prevSlide() {
                const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                this.showSlide(prevIndex);
                this.resetAutoSlide();
            }

            goToSlide(index) {
                if (index >= 0 && index < this.totalSlides) {
                    this.showSlide(index);
                    this.resetAutoSlide();
                }
            }

            startAutoSlide() {
                this.autoSlideInterval = setInterval(() => {
                    this.nextSlide();
                }, this.autoSlideDelay);
            }

            resetAutoSlide() {
                clearInterval(this.autoSlideInterval);
                this.startAutoSlide();
            }
        }

        // Initialiser le slider
        const slider = new HeroSlider();

        // Compteurs animés
        const counters = document.querySelectorAll('.animate-count-up');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-count'));
                    const duration = 2000;
                    const step = target / (duration / 16);
                    let current = 0;

                    const timer = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        const display = Math.floor(current);
                        counter.querySelector('.counter').textContent =
                            display + (counter.getAttribute('data-count') === '99' ? '%' : '+');
                    }, 16);

                    counterObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => counterObserver.observe(counter));

        // Animations au scroll
        const animatedElements = document.querySelectorAll('.animate-fade-in, .animate-slide-in-left, .animate-slide-in-right, .animate-slide-in-up');
        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    scrollObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animatedElements.forEach(el => {
            el.style.animationPlayState = 'paused';
            scrollObserver.observe(el);
        });
    });
</script>
@endsection
