@extends('layouts.main')

@section('title', 'À Propos - DJOK PRESTIGE')

@section('content')
<!-- Header Hero Section -->
<header class="flex flex-col min-h-screen hero-bg">
    @include('layouts.navbar')

    <!-- Hero Content -->
    <div class="flex flex-col items-center justify-center flex-1 px-4 text-center text-white">
        <h1 class="mb-6 text-5xl font-bold md:text-6xl animate-fade-in-up" style="animation-delay: 0.2s;">
            À Propos de DJOK PRESTIGE
        </h1>
        <p class="max-w-3xl mb-8 text-xl md:text-2xl animate-fade-in-up" style="animation-delay: 0.4s;">
            Votre partenaire de confiance depuis 2020 pour VTC, formations et entrepreneuriat en Afrique
        </p>
        <div class="flex flex-col gap-4 sm:flex-row animate-fade-in-up" style="animation-delay: 0.6s;">
            <a href="#mission"
                class="px-8 py-3 text-lg font-semibold text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl">
                Notre Mission
            </a>
            <a href="#histoire"
                class="px-8 py-3 text-lg font-semibold text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105">
                Notre Histoire
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#mission" class="text-white transition duration-300 hover:text-yellow-400">
            <i class="text-2xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Mission Section -->
<section id="mission" class="py-16 bg-white">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-bold text-gray-900 animate-fade-in">Notre Mission</h2>
            <p class="max-w-3xl mx-auto mt-4 text-xl text-gray-600 animate-fade-in" style="animation-delay: 0.2s;">
                DJOK PRESTIGE accompagne les professionnels et entrepreneurs dans leur développement à travers des
                services de transport premium, des formations certifiantes et un accompagnement personnalisé pour les
                projets en Afrique.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-8 text-center text-white transition duration-500 transform bg-gray-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-float"
                style="animation-delay: 0.1s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-medal"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Excellence</h3>
                <p class="text-gray-300">
                    Un service d'exception dans tous nos formats
                </p>
            </div>

            <div class="p-8 text-center text-white transition duration-500 transform bg-blue-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-float"
                style="animation-delay: 0.2s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-blue-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-hands-helping"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Accompagnement</h3>
                <p class="text-gray-300">
                    Un soutien personnalisé pour chaque défi et étape
                </p>
            </div>

            <div class="p-8 text-center text-white transition duration-500 transform bg-yellow-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-float"
                style="animation-delay: 0.3s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-handshake"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Partenariat</h3>
                <p class="text-gray-300">
                    Des relations basées sur la confiance mutuelle
                </p>
            </div>

            <div class="p-8 text-center text-white transition duration-500 transform bg-green-800 service-card rounded-2xl hover:scale-105 hover:shadow-2xl animate-float"
                style="animation-delay: 0.4s;">
                <div
                    class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition duration-300 transform bg-green-600 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-2xl fas fa-leaf"></i>
                </div>
                <h3 class="mb-4 text-2xl font-bold">Durabilité</h3>
                <p class="text-gray-300">
                    Engagement pour un développement responsable
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Histoire Section -->
<section id="histoire" class="py-16 bg-gray-100">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-bold text-gray-900 animate-fade-in">Notre Histoire</h2>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <div
                class="p-8 transition duration-500 transform bg-white rounded-2xl hover:shadow-xl animate-slide-in-left">
                <div class="space-y-6">
                    <div class="flex items-start space-x-4 animate-timeline-item" style="animation-delay: 0.1s;">
                        <div
                            class="flex items-center justify-center w-12 h-12 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                            <span class="font-bold text-white">2020</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">Création de DJOK PRESTIGE</h3>
                            <p class="mt-2 text-gray-600">Lancement avec une flotte de véhicules haut de gamme</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 animate-timeline-item" style="animation-delay: 0.3s;">
                        <div
                            class="flex items-center justify-center w-12 h-12 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                            <span class="font-bold text-white">2021</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">Centre de Formation</h3>
                            <p class="mt-2 text-gray-600">Ouverture du centre avec certification officielle VTC</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 animate-timeline-item" style="animation-delay: 0.5s;">
                        <div
                            class="flex items-center justify-center w-12 h-12 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                            <span class="font-bold text-white">2022</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">Expansion Afrique</h3>
                            <p class="mt-2 text-gray-600">Lancement de l'accompagnement entrepreneurial</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 animate-timeline-item" style="animation-delay: 0.7s;">
                        <div
                            class="flex items-center justify-center w-12 h-12 transition duration-300 transform bg-yellow-600 rounded-full hover:scale-110 hover:rotate-12">
                            <span class="font-bold text-white">2024</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900">Leader du Secteur</h3>
                            <p class="mt-2 text-gray-600">Plus de 500 clients accompagnés avec succès</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="p-8 transition duration-500 transform bg-white rounded-2xl hover:shadow-xl animate-slide-in-right">
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <div
                            class="inline-block p-6 mb-4 transition duration-500 transform bg-yellow-100 rounded-full hover:scale-110 hover:rotate-12">
                            <i class="text-6xl text-yellow-600 fas fa-chart-line"></i>
                        </div>
                        <h3 class="mt-4 text-2xl font-bold text-gray-900 animate-fade-in">Notre Croissance</h3>
                        <p class="mt-2 text-gray-600 animate-fade-in" style="animation-delay: 0.2s;">
                            Une évolution constante marquée par l'innovation et l'excellence du service
                        </p>
                        <div class="mt-6 animate-pulse-slow">
                            <div class="w-16 h-1 mx-auto bg-yellow-600 rounded-full"></div>
                            <div class="w-12 h-1 mx-auto mt-1 bg-yellow-500 rounded-full"></div>
                            <div class="w-8 h-1 mx-auto mt-1 bg-yellow-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Équipe Section -->
<section class="py-16 bg-white">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <h2 class="text-4xl font-bold text-gray-900 animate-fade-in">Notre Équipe</h2>
            <p class="max-w-3xl mx-auto mt-4 text-xl text-gray-600 animate-fade-in" style="animation-delay: 0.2s;">
                Une équipe d'experts passionnés à votre service
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 text-center transition duration-500 transform bg-gray-100 rounded-2xl hover:scale-105 hover:shadow-xl animate-team-card"
                style="animation-delay: 0.1s;">
                <div
                    class="flex items-center justify-center w-24 h-24 mx-auto mb-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-3xl text-gray-600 fas fa-user-tie"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Djibril Kone</h3>
                <p class="mt-2 text-gray-600">Expert transport et services VTC</p>
                <div class="mt-4">
                    <div class="w-12 h-1 mx-auto bg-yellow-600 rounded-full animate-pulse"></div>
                </div>
            </div>

            <div class="p-6 text-center transition duration-500 transform bg-gray-100 rounded-2xl hover:scale-105 hover:shadow-xl animate-team-card"
                style="animation-delay: 0.2s;">
                <div
                    class="flex items-center justify-center w-24 h-24 mx-auto mb-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-3xl text-gray-600 fas fa-user-graduate"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Sarah Martin</h3>
                <p class="mt-2 text-gray-600">Spécialiste formation professionnelle</p>
                <div class="mt-4">
                    <div class="w-12 h-1 mx-auto bg-blue-600 rounded-full animate-pulse" style="animation-delay: 0.1s;">
                    </div>
                </div>
            </div>

            <div class="p-6 text-center transition duration-500 transform bg-gray-100 rounded-2xl hover:scale-105 hover:shadow-xl animate-team-card"
                style="animation-delay: 0.3s;">
                <div
                    class="flex items-center justify-center w-24 h-24 mx-auto mb-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-3xl text-gray-600 fas fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Ahmed Benali</h3>
                <p class="mt-2 text-gray-600">Expert économie africaine</p>
                <div class="mt-4">
                    <div class="w-12 h-1 mx-auto bg-green-600 rounded-full animate-pulse"
                        style="animation-delay: 0.2s;"></div>
                </div>
            </div>

            <div class="p-6 text-center transition duration-500 transform bg-gray-100 rounded-2xl hover:scale-105 hover:shadow-xl animate-team-card"
                style="animation-delay: 0.4s;">
                <div
                    class="flex items-center justify-center w-24 h-24 mx-auto mb-4 transition duration-300 transform bg-gray-300 rounded-full hover:scale-110 hover:rotate-12">
                    <i class="text-3xl text-gray-600 fas fa-cogs"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Marie Dubois</h3>
                <p class="mt-2 text-gray-600">Gestion de flotte & optimisation services</p>
                <div class="mt-4">
                    <div class="w-12 h-1 mx-auto bg-purple-600 rounded-full animate-pulse"
                        style="animation-delay: 0.3s;"></div>
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes pulseSlow {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    @keyframes timelineSlide {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes teamCard {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.9);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
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

    .animate-float {
        animation: float 3s ease-in-out infinite;
        opacity: 1;
    }

    .animate-pulse-slow {
        animation: pulseSlow 2s ease-in-out infinite;
    }

    .animate-timeline-item {
        animation: timelineSlide 0.6s ease-out forwards;
        opacity: 0;
    }

    .animate-team-card {
        animation: teamCard 0.6s ease-out forwards;
        opacity: 0;
    }

    .service-card {
        transition: all 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px) scale(1.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Animation au scroll
        const animatedElements = document.querySelectorAll(
            '.animate-fade-in, .animate-slide-in-left, .animate-slide-in-right, ' +
            '.animate-timeline-item, .animate-team-card'
        );

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

        // Animation flottante au survol des cartes de valeurs
        const valueCards = document.querySelectorAll('.service-card');
        valueCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.animation = 'none';
                setTimeout(() => {
                    card.style.animation = 'float 3s ease-in-out infinite';
                }, 10);
            });
        });
    });
</script>
@endsection
