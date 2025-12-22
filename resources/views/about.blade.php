@extends('layouts.main')

@section('title', 'À Propos - DJOK PRESTIGE')

@section('content')
<!-- Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
            alt="DJOK PRESTIGE About" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <!-- Hero Content -->
    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                À Propos de DJOK PRESTIGE
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-12 max-w-3xl mx-auto">
                Votre partenaire de confiance depuis 2020 pour VTC, formations et entrepreneuriat en Afrique
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#mission"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center transition duration-300 hover:scale-105"
                    style="background: var(--gold); color: black;">
                    Notre Mission
                </a>
                <a href="#histoire"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center border transition duration-300 hover:scale-105"
                    style="border-color: var(--gold); color: var(--gold);">
                    Notre Histoire
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#mission" class="text-white transition duration-300 hover:text-var(--gold)">
            <i class="text-xl fas fa-chevron-down animate-bounce"></i>
        </a>
    </div>
</header>

<!-- Mission Section - Style sobre -->
<section id="mission" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Notre Mission</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    DJOK PRESTIGE accompagne les professionnels et entrepreneurs dans leur développement à travers des
                    services de transport premium, des formations certifiantes et un accompagnement personnalisé pour
                    les
                    projets en Afrique.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach([
                ['Excellence', 'Un service d\'exception dans tous nos formats', 'fas fa-medal'],
                ['Accompagnement', 'Un soutien personnalisé pour chaque défi et étape', 'fas fa-hands-helping'],
                ['Partenariat', 'Des relations basées sur la confiance mutuelle', 'fas fa-handshake'],
                ['Durabilité', 'Engagement pour un développement responsable', 'fas fa-leaf']
                ] as $value)
                <div class="p-8 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg mb-6"
                            style="background: var(--gold);">
                            <i class="{{ $value[2] }} text-black text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4" style="color: white;">{{ $value[0] }}</h3>
                        <p class="text-gray-400">{{ $value[1] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Histoire Section - Style sobre -->
<section id="histoire" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Notre Histoire</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    Découvrez notre parcours et notre croissance depuis nos débuts
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Timeline -->
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="space-y-8">
                        @foreach([
                        ['2020', 'Création de DJOK PRESTIGE', 'Lancement avec une flotte de véhicules haut de gamme'],
                        ['2021', 'Centre de Formation', 'Ouverture du centre avec certification officielle VTC'],
                        ['2022', 'Expansion Afrique', 'Lancement de l\'accompagnement entrepreneurial'],
                        ['2024', 'Leader du Secteur', 'Plus de 500 clients accompagnés avec succès']
                        ] as $item)
                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                    style="background: var(--gold);">
                                    <span class="font-bold text-black text-lg">{{ $item[0] }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                    style="color: white;">{{ $item[1] }}</h3>
                                <p class="text-gray-400">{{ $item[2] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Stats -->
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="flex flex-col items-center justify-center h-full">
                        <div class="w-28 h-28 flex items-center justify-center rounded-full mb-8"
                            style="background: rgba(202, 162, 77, 0.1);">
                            <i class="text-5xl fas fa-chart-line" style="color: var(--gold);"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-center" style="color: white;">Notre Croissance</h3>
                        <p class="text-gray-300 text-center mb-8">
                            Une évolution constante marquée par l'innovation et l'excellence du service
                        </p>

                        <div class="grid grid-cols-2 gap-6 w-full max-w-sm">
                            @foreach([
                            ['5000+', 'Clients satisfaits'],
                            ['500+', 'Formations dispensées'],
                            ['50+', 'Projets en Afrique'],
                            ['99%', 'Taux de satisfaction']
                            ] as $stat)
                            <div class="text-center p-5 transition-all duration-300 hover:scale-105"
                                style="background: #111; border: 1px solid #333;">
                                <div class="text-3xl font-bold mb-2" style="color: var(--gold);">{{ $stat[0] }}</div>
                                <div class="text-sm text-gray-400">{{ $stat[1] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Équipe Section - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Notre Équipe</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    Une équipe d'experts passionnés à votre service
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach([
                ['Djibril Kone', 'Expert transport et services VTC', 'fas fa-user-tie'],
                ['Sarah Martin', 'Spécialiste formation professionnelle', 'fas fa-user-graduate'],
                ['Ahmed Benali', 'Expert économie africaine', 'fas fa-chart-line'],
                ['Marie Dubois', 'Gestion de flotte & optimisation services', 'fas fa-cogs']
                ] as $member)
                <div class="p-8 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="w-24 h-24 flex items-center justify-center rounded-full mx-auto mb-6 transition-all duration-300 hover:scale-110 hover:rotate-12"
                        style="background: var(--gold);">
                        <i class="{{ $member[2] }} text-black text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: white;">{{ $member[0] }}</h3>
                    <p class="text-gray-400 mb-4">{{ $member[1] }}</p>
                    <div class="mt-6">
                        <div class="w-16 h-1 mx-auto" style="background: var(--gold);"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Vision Section - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Notre Vision</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    Nos engagements pour l'avenir
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="flex items-start space-x-6 mb-8 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-eye text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">Innovation Continue</h3>
                            <p class="text-gray-400">
                                Constamment à la recherche de nouvelles solutions pour répondre aux besoins
                                évolutifs de nos clients et partenaires. Nous investissons dans la technologie
                                et l'innovation pour rester à la pointe de notre secteur.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-globe-africa text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">Développement Africain</h3>
                            <p class="text-gray-400">
                                Contribuer activement au développement économique de l'Afrique grâce à des formations
                                adaptées, un accompagnement personnalisé et des partenariats stratégiques qui
                                créent de la valeur sur le continent.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="flex items-start space-x-6 mb-8 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-award text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">Excellence & Qualité</h3>
                            <p class="text-gray-400">
                                Maintenir les plus hauts standards de qualité dans tous nos services.
                                De la formation au transport en passant par l'accompagnement, chaque
                                interaction avec DJOK PRESTIGE doit être une expérience exceptionnelle.
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-handshake text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">Partenariats Durables</h3>
                            <p class="text-gray-400">
                                Construire des relations solides et durables avec nos clients, partenaires
                                et collaborateurs. Nous croyons en la force des collaborations pour créer
                                un impact positif à long terme.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certifications Section - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Nos Certifications</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    Garantie de qualité et de professionnalisme
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                ['Certification Qualiopi', 'Certification qualité des prestataires de formation', 'fas fa-award',
                'Garantie de la qualité de nos formations'],
                ['Agrément Préfectoral', 'Agrément officiel pour la formation VTC', 'fas fa-file-contract',
                'Reconnaissance des autorités publiques'],
                ['DataDock', 'Référencement DataDock pour le financement des formations', 'fas fa-database',
                'Financement facilité pour nos stagiaires']
                ] as $certification)
                <div class="p-8 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="w-20 h-20 flex items-center justify-center rounded-full mx-auto mb-6 transition-all duration-300 hover:scale-110 hover:rotate-12"
                        style="background: var(--gold);">
                        <i class="{{ $certification[2] }} text-black text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4" style="color: white;">{{ $certification[0] }}</h3>
                    <p class="text-gray-400 mb-3">{{ $certification[1] }}</p>
                    <p class="text-sm text-gray-500">{{ $certification[3] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto text-center p-10" style="background: #1a1a1a; border: 1px solid #333;">
            <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Prêt à commencer avec nous ?
            </h2>
            <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
                Que vous ayez besoin de nos services VTC, d'une formation certifiante ou d'un accompagnement
                pour votre projet en Afrique, notre équipe est à votre disposition.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="w-full sm:w-auto px-8 py-4 font-semibold text-center transition-all duration-300 hover:scale-105"
                    style="background: var(--gold); color: black;">
                    Nous Contacter
                </a>
                <a href="{{ route('formation') }}"
                    class="w-full sm:w-auto px-8 py-4 font-semibold text-center border transition-all duration-300 hover:scale-105"
                    style="border-color: var(--gold); color: var(--gold);">
                    Voir nos Formations
                </a>
            </div>
            <p class="text-gray-500 text-sm mt-6">
                <i class="fas fa-phone-alt mr-2"></i>
                Contactez-nous au 06.99.16.44.55
            </p>
        </div>
    </div>
</section>

<style>
    /* Animations d'apparition au scroll */
    .section-animate {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .section-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Styles pour les cartes */
    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: translateY(-5px);
    }

    /* Animation du scroll indicator */
    .animate-bounce {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-10px);
        }

        60% {
            transform: translateY(-5px);
        }
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        section {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .p-8 {
            padding: 1.5rem;
        }

        .grid {
            gap: 1.5rem;
        }
    }

    @media (max-width: 640px) {
        h1 {
            font-size: 2rem !important;
        }

        h2 {
            font-size: 1.75rem !important;
        }

        .text-lg {
            font-size: 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const target = document.querySelector(targetId);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animation d'apparition des sections au scroll
        const sections = document.querySelectorAll('section');

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            section.classList.add('section-animate');
            observer.observe(section);
        });

        // Animation pour les cartes au hover
        const cards = document.querySelectorAll('.p-8, .p-6');
        cards.forEach(card => {
            card.classList.add('hover-scale');
        });
    });
</script>
@endsection
