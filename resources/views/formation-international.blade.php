@extends('layouts.main')

@section('title', 'Formation à l’International - DJOK PRESTIGE')

@section('content')
<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)),
            url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .formation-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        padding: 24px;
        transition: all 0.3s ease;
    }

    .formation-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: translateY(-2px);
    }

    .avantage-card {
        background: #f9fafb;
        border-radius: 8px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .avantage-card:hover {
        border-color: #f59e0b;
        background: white;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .success-alert {
        animation: slideDown 0.5s ease-out;
        position: relative;
        z-index: 50;
    }

    .success-alert .close-btn {
        transition: all 0.2s ease;
    }

    .success-alert .close-btn:hover {
        transform: scale(1.1);
    }
</style>

<!-- Message de succès fixe en haut -->
@if(session('success'))
<div id="success-alert" class="success-alert fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-2xl">
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-lg mx-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 flex items-center justify-center bg-green-100 rounded-full">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-semibold text-green-800">Demande envoyée avec succès !</h3>
                    <div class="mt-1 text-green-700">
                        <p>{{ session('success') }}</p>
                        @if(session('email'))
                        <p class="text-sm mt-1">
                            Un email de confirmation a été envoyé à <strong>{{ session('email') }}</strong>
                        </p>
                        @endif
                        <p class="text-sm mt-1">
                            Notre équipe vous contactera dans les plus brefs délais.
                        </p>
                    </div>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('success-alert').remove();"
                class="close-btn text-green-600 hover:text-green-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alert.remove(), 500);
        }
    }, 10000);
</script>
@endif

<!-- Hero Section -->
<header class="hero-bg relative min-h-screen flex items-center">
    <div class="container mx-auto px-6 py-20">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8 fade-in">
                Formation à l'international – Vivez l'expérience DJOK PRESTIGE en France
            </h1>

            <p class="text-xl text-white mb-12 fade-in" style="transition-delay: 0.2s;">
                Vous rêvez de venir en France pour développer vos compétences, obtenir une qualification reconnue et
                découvrir un environnement professionnel d'excellence ? DJOK PRESTIGE, centre de formation certifié
                Qualiopi, vous accueille dans un cadre idéal à Paris et en Île-de-France. Grâce à notre programme
                "Formation à l'international", nous accompagnons les étudiants, entrepreneurs et porteurs de projets
                africains dans toutes les étapes : démarches d'inscription, formation, hébergement, transport,
                intégration.
            </p>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center fade-in" style="transition-delay: 0.4s;">
                <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <a href="#formations"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                        Découvrir les formations
                    </a>
                    <a href="#accompagnement"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                        Accompagnement Visa
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#formations" class="text-white transition duration-300 hover:text-yellow-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </a>
    </div>
</header>

<!-- Domaines de formation -->
<section id="formations" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Domaines de formation disponibles</h2>
        </div>

        <!-- Formations principales -->
        <div class="mb-16">
            <h3 class="text-3xl font-semibold text-center text-gray-800 mb-8">Formations principales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                $formations = App\Models\Formation::where('is_active', true)
                ->whereIn('categorie', ['international', 'vtc_theorique', 'vtc_pratique'])
                ->take(6)
                ->get();
                @endphp

                @if($formations->count() > 0)
                @foreach($formations as $formation)
                <div class="formation-card">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 flex items-center justify-center bg-yellow-100 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $formation->title }}</h4>
                            <p class="text-gray-600">{{ Str::limit($formation->description, 100) }}</p>
                            <div class="mt-2 text-sm text-gray-500">
                                <span class="font-semibold">{{ $formation->duration_hours }}h</span>
                                •
                                <span class="font-semibold">{{ number_format($formation->price, 0, ',', ' ') }} €</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                @foreach([
                ['Formation VTC (chauffeur professionnel)', 'Théorique & pratique'],
                ['Formation Micro-entreprise & gestion', 'Création et gestion d\'entreprise'],
                ['Formation Communication & marketing digital', 'Stratégies digitales et communication'],
                ['Formation Création d\'entreprise & business plan', 'Business plan et développement'],
                ['Formation Bureautique & Excel professionnel', 'Excel avancé et outils bureautique'],
                ['Formation Langue & accueil client', 'Français professionnel et service client']
                ] as $formation)
                <div class="formation-card">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 flex items-center justify-center bg-yellow-100 rounded-lg">
                                <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $formation[0] }}</h4>
                            <p class="text-gray-600">{{ $formation[1] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Modules optionnels -->
        <div>
            <h3 class="text-3xl font-semibold text-center text-gray-800 mb-8">Modules optionnels</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <ul class="space-y-4">
                        @foreach(['Leadership et management', 'Développement personnel', 'Vente et négociation
                        commerciale', 'Finance d\'entreprise et fiscalité'] as $module)
                        <li class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium text-gray-900">{{ $module }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <ul class="space-y-4">
                        @foreach(['Gestion de projet', 'Communication interculturelle', 'Digital transformation',
                        'Stratégie d\'entreprise'] as $module)
                        <li class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <svg class="w-5 h-5 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium text-gray-900">{{ $module }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Public visé -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Public visé</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="avantage-card text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-blue-100 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Étudiants internationaux</h3>
                <p class="text-gray-600">Bénéficiez d'une immersion professionnelle certifiée et reconnue en France.</p>
            </div>

            <div class="avantage-card text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-green-100 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Entrepreneurs & dirigeants africains</h3>
                <p class="text-gray-600">Apprenez les standards européens de gestion, d'organisation et de service à la
                    clientèle.</p>
            </div>

            <div class="avantage-card text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-purple-100 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Institutions et écoles partenaires</h3>
                <p class="text-gray-600">Offrez à vos étudiants et bénéficiaires une formation internationale de qualité
                    avec hébergement inclus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Accompagnement visa -->
<section id="accompagnement" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Accompagnement visa & arrivée</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    DJOK PRESTIGE vous fournit tous les documents nécessaires à votre demande de visa
                </p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-2xl font-bold text-blue-900 mb-6">Documents fournis</h3>
                        <ul class="space-y-4">
                            @foreach([
                            'Lettre d\'inscription et de formation',
                            'Attestation d\'hébergement',
                            'Attestation de paiement (si demandée par le consulat)',
                            'Assistance logistique pour le trajet et la réception à l\'aéroport'
                            ] as $document)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $document }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold text-blue-900 mb-6">Support continu</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Support WhatsApp pour le suivi de votre arrivée</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Accueil à l'aéroport</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Orientation et installation</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Assistance 24/7</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="#contact"
                        class="inline-flex items-center px-12 py-4 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        Je souhaite être accompagné dans ma demande de visa
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi choisir DJOK PRESTIGE -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pourquoi choisir DJOK PRESTIGE ?</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach([
            ['Centre certifié Qualiopi', 'M20 12.5V7.825c0-.665.324-1.285.874-1.664l6-4a1.997 1.997 0 012.252 0l6
            4c.55.379.874.999.874 1.664V12.5a.5.5 0 01-.5.5h-15a.5.5 0 01-.5-.5z'],
            ['Équipe franco-africaine expérimentée', 'M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75
            12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622
            1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0
            00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125
            1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25
            7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112
            3c1.929 0 3.716.607 5.18 1.64'],
            ['Formations adaptées aux réalités du terrain africain', 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21
            12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0
            11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
            ['Hébergement & transport intégrés', 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2
            2v12a2 2 0 002 2z'],
            ['Service conciergerie & accompagnement personnalisé', 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0
            00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
            ['Témoignages vidéos de stagiaires internationaux', 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0
            01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
            ['Réseau de partenaires Afrique–France', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10
            0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002
            5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014
            0z'],
            ['Transport & logistique simplifiés', 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0
            13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 7m0 13V7m0 0L9 4']
            ] as $avantage)
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-yellow-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $avantage[1] }}" />
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-900">{{ $avantage[0] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact et inscription -->
<section id="contact" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-gray-50 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-8">Demander un programme personnalisé
            </h2>

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6" id="error-message">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center bg-red-100 rounded-full mr-3">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-red-800">Erreur</h4>
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center bg-red-100 rounded-full mr-3">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
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

            <form action="{{ route('formation-internationale.store') }}" method="POST" id="formation-form">
                @csrf

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Nom complet *</label>
                            <input type="text" name="nom" required value="{{ old('nom') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nom') border-red-500 @enderror"
                                placeholder="Votre nom et prénom">
                            @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Nationalité *</label>
                            <input type="text" name="nationalite" required value="{{ old('nationalite') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nationalite') border-red-500 @enderror"
                                placeholder="Votre nationalité">
                            @error('nationalite')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Email *</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                placeholder="votre@email.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Téléphone (WhatsApp) *</label>
                            <input type="tel" name="telephone" required value="{{ old('telephone') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('telephone') border-red-500 @enderror"
                                placeholder="+33 1 23 45 67 89">
                            @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">WhatsApp (si différent)</label>
                        <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('whatsapp') border-red-500 @enderror"
                            placeholder="+225 07 00 00 00 00">
                        @error('whatsapp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Type de formation souhaitée *</label>
                        <select name="formation" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('formation') border-red-500 @enderror">
                            <option value="">Sélectionnez une formation</option>
                            <!-- Formations existantes -->
                            @php
                            $formationsList = App\Models\Formation::where('is_active', true)
                            ->whereIn('categorie', ['international', 'vtc_theorique', 'vtc_pratique', 'e_learning',
                            'renouvellement'])
                            ->get();
                            @endphp

                            @if($formationsList->count() > 0)
                            <optgroup label="Formations disponibles">
                                @foreach($formationsList as $formation)
                                <option value="{{ $formation->id }}" {{ old('formation')==$formation->id ? 'selected' :
                                    '' }}>
                                    {{ $formation->title }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endif

                            <optgroup label="Autres formations">
                                <option value="vtc" {{ old('formation')=='vtc' ? 'selected' : '' }}>Formation VTC
                                </option>
                                <option value="micro_entreprise" {{ old('formation')=='micro_entreprise' ? 'selected'
                                    : '' }}>Formation Micro-entreprise & gestion</option>
                                <option value="marketing" {{ old('formation')=='marketing' ? 'selected' : '' }}>
                                    Formation Communication & marketing digital</option>
                                <option value="creation_entreprise" {{ old('formation')=='creation_entreprise'
                                    ? 'selected' : '' }}>Formation Création d'entreprise</option>
                                <option value="bureautique" {{ old('formation')=='bureautique' ? 'selected' : '' }}>
                                    Formation Bureautique & Excel</option>
                                <option value="langue" {{ old('formation')=='langue' ? 'selected' : '' }}>Formation
                                    Langue & accueil client</option>
                                <option value="personnalise" {{ old('formation')=='personnalise' ? 'selected' : '' }}>
                                    Programme personnalisé</option>
                            </optgroup>
                        </select>
                        @error('formation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Services d'accompagnement
                            nécessaires</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @php
                            $oldServices = old('services', []);
                            @endphp
                            @foreach([
                            'Accompagnement visa',
                            'Hébergement',
                            'Transport',
                            'Service conciergerie',
                            'Assurance',
                            'Formation + stage'
                            ] as $service)
                            <label
                                class="flex items-center p-2 bg-white rounded border hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service,
                                    $oldServices) ? 'checked' : '' }}
                                    class="mr-3 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                <span class="text-sm">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Votre projet et besoins spécifiques
                            *</label>
                        <textarea name="message" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('message') border-red-500 @enderror"
                            placeholder="Décrivez votre projet professionnel, vos attentes, et toute information utile...">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Date de début souhaitée</label>
                            <input type="date" name="date_debut" value="{{ old('date_debut') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('date_debut') border-red-500 @enderror">
                            @error('date_debut')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Durée estimée du séjour</label>
                            <select name="duree"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('duree') border-red-500 @enderror">
                                <option value="">Sélectionnez une durée</option>
                                <option value="1-2 semaines" {{ old('duree')=='1-2 semaines' ? 'selected' : '' }}>1-2
                                    semaines</option>
                                <option value="1 mois" {{ old('duree')=='1 mois' ? 'selected' : '' }}>1 mois</option>
                                <option value="3 mois" {{ old('duree')=='3 mois' ? 'selected' : '' }}>3 mois</option>
                                <option value="6 mois" {{ old('duree')=='6 mois' ? 'selected' : '' }}>6 mois</option>
                                <option value="1 an" {{ old('duree')=='1 an' ? 'selected' : '' }}>1 an</option>
                            </select>
                            @error('duree')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bouton de soumission avec état de chargement CORRIGÉ -->
                    <div class="relative">
                        <button type="submit" id="submit-btn"
                            class="w-full px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
                            <span id="btn-text" class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Envoyer ma demande de programme
                            </span>
                            <span id="btn-loading" class="hidden flex items-center justify-center">
                                <svg class="animate-spin mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                </svg>
                                Traitement en cours...
                            </span>
                        </button>
                    </div>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        Vos informations sont sécurisées et ne seront pas partagées avec des tiers.
                    </p>
                </div>
            </form>
        </div>

        <!-- Contact rapide -->
        <div class="mt-12 max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-blue-50 rounded-xl p-6 text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-600 rounded-full mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Téléphone international</h3>
                    <a href="tel:+33176380017" class="text-blue-600 font-semibold hover:text-blue-800">+33 1 76 38 00
                        17</a>
                </div>

                <div class="bg-green-50 rounded-xl p-6 text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-green-600 rounded-full mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">WhatsApp</h3>
                    <p class="text-green-600 font-semibold">Disponible 24h/24</p>
                </div>

                <div class="bg-yellow-50 rounded-xl p-6 text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                    <a href="mailto:international@djokprestige.com"
                        class="text-yellow-600 font-semibold hover:text-yellow-800">international@djokprestige.com</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Auto-hide des messages d'erreur
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 8000);
        }

        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Gestion du formulaire
        const form = document.getElementById('formation-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');

        if (form) {
            form.addEventListener('submit', function() {
                // Désactiver le bouton et montrer le loader
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
            });

            // Si retour avec erreurs, réactiver le bouton
            if (document.querySelector('.border-red-500')) {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        }

        // Scroll vers le formulaire s'il y a des erreurs
        if (document.querySelector('.border-red-500')) {
            setTimeout(() => {
                document.getElementById('contact').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 300);
        }

        // Scroll vers le message de succès s'il existe
        if (document.getElementById('success-alert')) {
            setTimeout(() => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 100);
        }

        // Date minimum pour la date de début
        const dateInput = document.querySelector('input[name="date_debut"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;
        }
    });
</script>
@endsection
