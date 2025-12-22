@extends('layouts.main')

@section('title', 'DJOK PRESTIGE - VTC, Formations & Entrepreneuriat')

@section('content')
<!-- Header avec bannières superposées -->
<header class="relative bg-black">
    <!-- Conteneur des bannières -->
    <div class="relative">
        <!-- Bannière 1 - Formation VTC -->
        <section class="min-h-screen flex items-center justify-center relative overflow-hidden banner-section">
            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0" alt="Formation VTC"
                    class="object-cover w-full h-full opacity-50">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>
            </div>

            <div class="relative z-10 max-w-6xl px-4 mx-auto text-center text-white py-20">
                <div class="mb-6">
                    <span
                        class="inline-block px-4 py-2 mb-4 text-sm font-semibold tracking-wider uppercase rounded-full"
                        style="background: rgba(212, 175, 55, 0.2); color: var(--gold);">
                        Formation Professionnelle
                    </span>
                </div>

                <h1 class="mb-8 text-4xl md:text-5xl lg:text-6xl font-bold" style="color: var(--gold);">
                    Devenez Chauffeur VTC<br>Professionnel
                </h1>

                <p class="max-w-4xl mx-auto mb-12 text-lg md:text-xl lg:text-2xl leading-relaxed">
                    Obtenez votre carte VTC avec une formation complète, certifiée Qualiopi,
                    agréée par la préfecture et finançable par le CPF
                </p>

                <!-- Points clés -->
                <div class="grid max-w-4xl grid-cols-1 gap-4 mx-auto mb-16 md:grid-cols-3">
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-transform duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full"
                            style="background: var(--gold);">
                            <i class="fas fa-book text-black"></i>
                        </div>
                        <p class="font-semibold text-lg">Cours pratiques et théoriques</p>
                    </div>
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-transform duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full"
                            style="background: var(--gold);">
                            <i class="fas fa-user-tie text-black"></i>
                        </div>
                        <p class="font-semibold text-lg">Suivi personnalisé jusqu'à l'examen</p>
                    </div>
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-transform duration-300 hover:transform hover:scale-105">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full"
                            style="background: var(--gold);">
                            <i class="fas fa-file-alt text-black"></i>
                        </div>
                        <p class="font-semibold text-lg">Accompagnement administratif inclus</p>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="gold-button px-8 py-4 text-lg font-semibold">
                        <i class="mr-2 fas fa-play-circle"></i> Découvrir la formation
                    </button>
                    <button
                        class="border-2 border-var(--gold) text-var(--gold) px-8 py-4 text-lg font-semibold rounded-lg hover:bg-var(--gold) hover:text-black transition-all duration-300">
                        <i class="mr-2 fas fa-info-circle"></i> Demander des informations
                    </button>
                </div>
            </div>

            <!-- Indicateur de défilement -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
                <a href="#banner-2" class="text-white hover:text-var(--gold) transition">
                    <i class="text-3xl fas fa-chevron-down"></i>
                </a>
            </div>
        </section>

        <!-- Bannière 2 - Location VTC -->
        <section id="banner-2"
            class="min-h-screen flex items-center justify-center relative overflow-hidden banner-section">
            <!-- Séparateur décoratif -->
            <div class="absolute top-0 left-0 right-0 h-1">
                <div class="h-full w-48 mx-auto"
                    style="background: linear-gradient(90deg, transparent, var(--gold), transparent);"></div>
            </div>

            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1555212697-194d092e3b8f" alt="Location VTC"
                    class="object-cover w-full h-full opacity-50">
                <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/70 to-black/50"></div>
            </div>

            <div class="relative z-10 max-w-6xl px-4 mx-auto text-center text-white py-20">
                <div class="mb-6">
                    <span
                        class="inline-block px-4 py-2 mb-4 text-sm font-semibold tracking-wider uppercase rounded-full"
                        style="background: rgba(212, 175, 55, 0.2); color: var(--gold);">
                        Location Véhicules Premium
                    </span>
                </div>

                <h1 class="mb-8 text-4xl md:text-5xl lg:text-6xl font-bold" style="color: var(--gold);">
                    Louez votre véhicule VTC<br>haut de gamme
                </h1>

                <p class="max-w-3xl mx-auto mb-16 text-lg md:text-xl lg:text-2xl leading-relaxed">
                    Véhicules récents, prêts à l'emploi avec offres flexibles,
                    tarifs compétitifs et entretien inclus
                </p>

                <!-- Avantages -->
                <div class="grid max-w-5xl grid-cols-2 gap-6 mx-auto mb-16 md:grid-cols-4">
                    <div class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                        <i class="mb-4 text-3xl fas fa-car" style="color: var(--gold);"></i>
                        <p class="font-semibold">Véhicules récents</p>
                    </div>
                    <div class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                        <i class="mb-4 text-3xl fas fa-tools" style="color: var(--gold);"></i>
                        <p class="font-semibold">Entretien inclus</p>
                    </div>
                    <div class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                        <i class="mb-4 text-3xl fas fa-euro-sign" style="color: var(--gold);"></i>
                        <p class="font-semibold">Tarifs compétitifs</p>
                    </div>
                    <div class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10">
                        <i class="mb-4 text-3xl fas fa-calendar-alt" style="color: var(--gold);"></i>
                        <p class="font-semibold">Flexibilité totale</p>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="gold-button px-8 py-4 text-lg font-semibold">
                        <i class="mr-2 fas fa-search"></i> Voir les véhicules
                    </button>
                    <button
                        class="border-2 border-var(--gold) text-var(--gold) px-8 py-4 text-lg font-semibold rounded-lg hover:bg-var(--gold) hover:text-black transition-all duration-300">
                        <i class="mr-2 fas fa-calendar-check"></i> Réserver maintenant
                    </button>
                </div>
            </div>

            <!-- Indicateur de défilement -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
                <a href="#banner-3" class="text-white hover:text-var(--gold) transition">
                    <i class="text-3xl fas fa-chevron-down"></i>
                </a>
            </div>
        </section>

        <!-- Bannière 3 - Conciergerie -->
        <section id="banner-3"
            class="min-h-screen flex items-center justify-center relative overflow-hidden banner-section">
            <!-- Séparateur décoratif -->
            <div class="absolute top-0 left-0 right-0 h-1">
                <div class="h-full w-48 mx-auto"
                    style="background: linear-gradient(90deg, transparent, var(--gold), transparent);"></div>
            </div>

            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5" alt="Conciergerie"
                    class="object-cover w-full h-full opacity-50">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/70 to-black/50"></div>
            </div>

            <div class="relative z-10 max-w-6xl px-4 mx-auto text-center text-white py-20">
                <div class="mb-6">
                    <span
                        class="inline-block px-4 py-2 mb-4 text-sm font-semibold tracking-wider uppercase rounded-full"
                        style="background: rgba(212, 175, 55, 0.2); color: var(--gold);">
                        Services Premium
                    </span>
                </div>

                <h1 class="mb-8 text-4xl md:text-5xl lg:text-6xl font-bold" style="color: var(--gold);">
                    Votre arrivée en France,<br>notre priorité
                </h1>

                <p class="max-w-4xl mx-auto mb-12 text-lg md:text-xl lg:text-2xl leading-relaxed">
                    Service de conciergerie complet et personnalisé pour votre formation,
                    voyage d'affaires ou projet d'installation
                </p>

                <!-- Services -->
                <div class="grid max-w-6xl grid-cols-2 gap-4 mx-auto mb-16 md:grid-cols-5">
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-all duration-300 hover:transform hover:scale-105">
                        <i class="mb-3 text-2xl fas fa-plane-arrival" style="color: var(--gold);"></i>
                        <p class="font-semibold text-sm md:text-base">Accueil VIP à l'aéroport</p>
                    </div>
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-all duration-300 hover:transform hover:scale-105">
                        <i class="mb-3 text-2xl fas fa-car-side" style="color: var(--gold);"></i>
                        <p class="font-semibold text-sm md:text-base">Location de véhicule</p>
                    </div>
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-all duration-300 hover:transform hover:scale-105">
                        <i class="mb-3 text-2xl fas fa-hotel" style="color: var(--gold);"></i>
                        <p class="font-semibold text-sm md:text-base">Hébergement</p>
                    </div>
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-all duration-300 hover:transform hover:scale-105">
                        <i class="mb-3 text-2xl fas fa-map-marked-alt" style="color: var(--gold);"></i>
                        <p class="font-semibold text-sm md:text-base">Guide touristique</p>
                    </div>
                    <div
                        class="p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 transition-all duration-300 hover:transform hover:scale-105">
                        <i class="mb-3 text-2xl fas fa-file-contract" style="color: var(--gold);"></i>
                        <p class="font-semibold text-sm md:text-base">Accompagnement administratif</p>
                    </div>
                </div>

                <!-- Bouton -->
                <button class="gold-button px-8 py-4 text-lg font-semibold">
                    <i class="mr-2 fas fa-concierge-bell"></i> Découvrir nos services de conciergerie
                </button>
            </div>

            <!-- Indicateur de défilement vers les services -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce">
                <a href="#services" class="text-white hover:text-var(--gold) transition">
                    <i class="text-3xl fas fa-chevron-down"></i>
                </a>
            </div>
        </section>
    </div>
</header>

<!-- Services Section avec style sobre -->
<section id="services" class="py-20 bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="section-title">Nos Services</h2>
        <p class="max-w-3xl mx-auto mt-4 text-center text-gray-300">
            Découvrez notre gamme complète de services conçus pour répondre à tous vos besoins professionnels et
            personnels
        </p>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4 mt-12">
            <!-- VTC & Location -->
            <div class="service-card p-6 text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6" style="background: var(--gold);">
                    <i class="text-2xl fas fa-car text-black"></i>
                </div>
                <h3 class="mb-4 text-xl font-bold">VTC & Location</h3>
                <p class="mb-6 text-gray-600">
                    Services de véhicules haut de gamme, déplacements professionnels et personnels avec chauffeurs
                    expérimentés.
                </p>
                <button class="gold-button w-full">
                    Réserver maintenant
                </button>
            </div>

            <!-- Formations -->
            <div class="service-card p-6 text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6" style="background: var(--gold);">
                    <i class="text-2xl fas fa-graduation-cap text-black"></i>
                </div>
                <h3 class="mb-4 text-xl font-bold">Formations</h3>
                <p class="mb-6 text-gray-600">
                    Formations professionnelles certifiantes pour développer vos compétences et booster votre carrière.
                </p>
                <button class="gold-button w-full">
                    Voir les formations
                </button>
            </div>

            <!-- Entrepreneuriat Afrique -->
            <div class="service-card p-6 text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6" style="background: var(--gold);">
                    <i class="text-2xl fas fa-globe-africa text-black"></i>
                </div>
                <h3 class="mb-4 text-xl font-bold">Entrepreneuriat Afrique</h3>
                <p class="mb-6 text-gray-600">
                    Accompagnement entrepreneurial adapté au contexte africain avec des experts locaux.
                </p>
                <button class="gold-button w-full">
                    Découvrir
                </button>
            </div>

            <!-- Espace Client -->
            <div class="service-card p-6 text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6" style="background: #333;">
                    <i class="text-2xl fas fa-user-shield text-white"></i>
                </div>
                <h3 class="mb-4 text-xl font-bold">Espace Client</h3>
                <p class="mb-6 text-gray-600">
                    Accédez à votre espace personnel pour gérer vos réservations, formations et séminaires.
                </p>
                <button class="w-full bg-black text-white py-3 font-semibold hover:bg-gray-900 transition">
                    Se connecter
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section id="stats" class="py-20 text-white bg-dark">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="section-title">DJOK PRESTIGE en Chiffres</h2>
        <p class="mt-4 text-center text-gray-300">Notre expertise se reflète dans nos résultats</p>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4 mt-12">
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: var(--gold);">5000+</div>
                <p class="text-gray-300">Clients satisfaits</p>
            </div>
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: var(--gold);">500+</div>
                <p class="text-gray-300">Formations dispensées</p>
            </div>
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: var(--gold);">50+</div>
                <p class="text-gray-300">Projets accompagnés en Afrique</p>
            </div>
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: var(--gold);">99%</div>
                <p class="text-gray-300">Taux de satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-20 bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="section-title">CE QUE PENSENT NOS CLIENTS</h2>

        <div class="flex flex-col md:flex-row justify-center gap-6 mt-12">
            <div class="review-box">
                ⭐⭐⭐⭐⭐<br />
                Service impeccable et chauffeur professionnel.
            </div>
            <div class="review-box">
                ⭐⭐⭐⭐⭐<br />
                Très satisfait de la prestation VTC.
            </div>
            <div class="review-box">
                ⭐⭐⭐⭐⭐<br />
                Entreprise sérieuse et ponctuelle.
            </div>
        </div>
    </div>
</section>

<!-- Style spécifique pour cette page -->
<style>
    .banner-section {
        position: relative;
        scroll-margin-top: 0;
    }

    /* Animation d'entrée douce pour les bannières */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .banner-section .relative.z-10 {
        animation: fadeInUp 0.8s ease-out;
    }

    /* Style pour les boutons flottants */
    .floating-buttons-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .icon-btn {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        background: #333;
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .icon-btn:hover {
        transform: scale(1.1);
    }

    .whatsapp-btn {
        background: #25D366;
    }

    .contact-btn {
        background: var(--gold);
        color: black;
    }

    /* Animation de rebond pour les indicateurs */
    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0) translateX(-50%);
        }

        40% {
            transform: translateY(-10px) translateX(-50%);
        }

        60% {
            transform: translateY(-5px) translateX(-50%);
        }
    }

    .animate-bounce {
        animation: bounce 2s infinite;
    }

    /* Styles responsives */
    @media (max-width: 768px) {
        .floating-buttons-container {
            bottom: 20px;
            right: 20px;
            flex-direction: column;
        }

        .banner-section h1 {
            font-size: 2rem !important;
            line-height: 1.2 !important;
        }

        .banner-section p {
            font-size: 1rem !important;
        }

        .grid-cols-2 {
            grid-template-columns: 1fr !important;
        }

        .grid-cols-5 {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    /* Amélioration du scroll */
    html {
        scroll-behavior: smooth;
    }

    /* Effet de surbrillance sur les badges */
    span[style*="background: rgba(212, 175, 55, 0.2)"] {
        transition: all 0.3s ease;
    }

    span[style*="background: rgba(212, 175, 55, 0.2)"]:hover {
        background: rgba(212, 175, 55, 0.3) !important;
    }
</style>

<!-- Script pour animations au scroll -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'apparition progressive
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observer les éléments des bannières
        document.querySelectorAll('.banner-section .relative.z-10').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(el);
        });
    });
</script>
@endsection
