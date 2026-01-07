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
                    <a href="{{ route('formation') }}">
                        <button class="gold-button px-8 py-4 text-lg font-semibold">
                            <i class="mr-2 fas fa-play-circle"></i> Découvrir la formation
                        </button>
                    </a>

                    <a href="{{route('contact')}}">
                        <button
                            class="border-2 border-var(--gold) text-var(--gold) px-8 py-4 text-lg font-semibold rounded-lg hover:bg-var(--gold) hover:text-white transition-all duration-300">
                            <i class="mr-2 fas fa-info-circle"></i> Demander des informations
                        </button>

                    </a>

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

                <!-- Nouvelles cartes avec images - VERSION CORRIGÉE -->
                <div class="grid max-w-6xl grid-cols-1 gap-8 mx-auto mb-16 md:grid-cols-3">
                    <!-- Véhicule Électrique -->
                    <div
                        class="group relative overflow-hidden rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm transition-all duration-300 hover:transform hover:scale-105 hover:border-var(--gold)/30">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('v_electrique.webp') }}" alt="Véhicule Électrique VTC"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <!-- Overlay pour rendre le texte lisible -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            </div>
                            <!-- Badge de capacité -->
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                                <div class="flex items-center space-x-2 bg-black/70 px-3 py-1 rounded-full">
                                    <i class="fas fa-users text-sm" style="color: var(--gold);"></i>
                                    <span class="text-sm font-semibold">3 passagers</span>
                                </div>
                                <div class="flex items-center space-x-2 bg-black/70 px-3 py-1 rounded-full">
                                    <i class="fas fa-suitcase text-sm" style="color: var(--gold);"></i>
                                    <span class="text-sm font-semibold">3 bagages</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-3 text-xl font-bold">Véhicule Électrique</h3>
                            <p class="text-gray-300 mb-4 text-sm">
                                Écologique et économique, idéal pour les trajets urbains avec un confort optimal.
                            </p>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-bolt mr-2" style="color: var(--gold);"></i>
                                <span>100% électrique • Autonomie 400km</span>
                            </div>
                        </div>
                    </div>

                    <!-- Véhicule Berline -->
                    <div
                        class="group relative overflow-hidden rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm transition-all duration-300 hover:transform hover:scale-105 hover:border-var(--gold)/30">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('v_berline.webp') }}" alt="Berline VTC Premium"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <!-- Overlay pour rendre le texte lisible -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            </div>
                            <!-- Badge de capacité -->
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                                <div class="flex items-center space-x-2 bg-black/70 px-3 py-1 rounded-full">
                                    <i class="fas fa-users text-sm" style="color: var(--gold);"></i>
                                    <span class="text-sm font-semibold">3 passagers</span>
                                </div>
                                <div class="flex items-center space-x-2 bg-black/70 px-3 py-1 rounded-full">
                                    <i class="fas fa-suitcase text-sm" style="color: var(--gold);"></i>
                                    <span class="text-sm font-semibold">3 bagages</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-3 text-xl font-bold">Berline Premium</h3>
                            <p class="text-gray-300 mb-4 text-sm">
                                Luxe et confort pour vos déplacements professionnels ou événements spéciaux.
                            </p>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-star mr-2" style="color: var(--gold);"></i>
                                <span>Classe affaires • Intérieur cuir</span>
                            </div>
                        </div>
                    </div>

                    <!-- Véhicule VAN -->
                    <div
                        class="group relative overflow-hidden rounded-xl border border-white/10 bg-white/5 backdrop-blur-sm transition-all duration-300 hover:transform hover:scale-105 hover:border-var(--gold)/30">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('v_VAN.webp') }}" alt="VAN VTC 7 places"
                                class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <!-- Overlay pour rendre le texte lisible -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            </div>
                            <!-- Badge de capacité -->
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-center">
                                <div class="flex items-center space-x-2 bg-black/70 px-3 py-1 rounded-full">
                                    <i class="fas fa-users text-sm" style="color: var(--gold);"></i>
                                    <span class="text-sm font-semibold">7 passagers</span>
                                </div>
                                <div class="flex items-center space-x-2 bg-black/70 px-3 py-1 rounded-full">
                                    <i class="fas fa-suitcase text-sm" style="color: var(--gold);"></i>
                                    <span class="text-sm font-semibold">7 bagages</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-3 text-xl font-bold">VAN 7 Places</h3>
                            <p class="text-gray-300 mb-4 text-sm">
                                Parfait pour les groupes, familles ou transferts aéroport avec beaucoup de bagages.
                            </p>
                            <div class="flex items-center text-sm">
                                <i class="fas fa-shield-alt mr-2" style="color: var(--gold);"></i>
                                <span>Confort groupe • Espace optimisé</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Avantages additionnels -->
                <div class="grid max-w-3xl grid-cols-2 md:grid-cols-4 gap-4 mx-auto mb-12">
                    <div class="text-center p-4">
                        <i class="mb-3 text-2xl fas fa-tools" style="color: var(--gold);"></i>
                        <p class="text-sm font-semibold">Entretien inclus</p>
                    </div>
                    <div class="text-center p-4">
                        <i class="mb-3 text-2xl fas fa-euro-sign" style="color: var(--gold);"></i>
                        <p class="text-sm font-semibold">Tarifs compétitifs</p>
                    </div>
                    <div class="text-center p-4">
                        <i class="mb-3 text-2xl fas fa-calendar-alt" style="color: var(--gold);"></i>
                        <p class="text-sm font-semibold">Flexibilité totale</p>
                    </div>
                    <div class="text-center p-4">
                        <i class="mb-3 text-2xl fas fa-shield-alt" style="color: var(--gold);"></i>
                        <p class="text-sm font-semibold">Assurance complète</p>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{route('location')}}">
                        <button class="gold-button px-8 py-4 text-lg font-semibold">
                            <i class="mr-2 fas fa-search"></i> Voir les véhicules
                        </button>
                    </a>
                    <a href="{{ route('location') }}">
                        <button
                            class="border-2 border-var(--gold) text-var(--gold) px-8 py-4 text-lg font-semibold rounded-lg hover:bg-var(--gold) hover:text-white transition-all duration-300">
                            <i class="mr-2 fas fa-calendar-check"></i> Réserver maintenant
                        </button>
                    </a>

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
        {{-- <section id="banner-3"
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
        </section> --}}
    </div>
</header>

<!-- SERVICES SECTION AVEC NOUVEAU DESIGN -->
<section id="services" class="py-20 bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="text-center text-4xl font-bold mb-4" style="color: var(--gold);">NOS SERVICES</h2>
        <p class="max-w-3xl mx-auto mt-4 text-center text-gray-300 text-lg">
            Découvrez notre gamme complète de services conçus pour répondre à tous vos besoins professionnels et
            personnels
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-16">
            <!-- VTC & Location -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/125779/pexels-photo-125779.jpeg" alt="VTC & Location"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-center text-center flex-grow">
                    <h3 class="text-2xl font-bold mb-3">Reservation VTC</h3>
                    <p class="text-gray-700 mb-6">
                        Services de véhicules haut de gamme, déplacements professionnels et personnels avec chauffeurs
                        expérimentés.
                    </p>
                    <a href="{{ route('reservation') }}">
                        <button class="px-8 py-3 font-semibold transition-all duration-300 self-center"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Réserver maintenant
                        </button>
                    </a>
                </div>
            </div>

            <!-- Location (Nouvelle carte) -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/164634/pexels-photo-164634.jpeg" alt="Location"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-center text-center flex-grow">
                    <h3 class="text-2xl font-bold mb-3">Location</h3>
                    <p class="text-gray-700 mb-6">
                        Location de véhicules de prestige pour vos événements spéciaux, mariages, cérémonies ou
                        besoins professionnels. Parc varié de luxe.
                    </p>
                    <a href="{{ route('location') }}">
                        <button class="px-8 py-3 font-semibold transition-all duration-300 self-center"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Louer un véhicule
                        </button>
                    </a>
                </div>
            </div>

            <!-- Formations -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg" alt="Formations"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-center text-center flex-grow">
                    <h3 class="text-2xl font-bold mb-3">Formations</h3>
                    <p class="text-gray-700 mb-6">
                        Formations professionnelles certifiantes pour développer vos compétences et booster votre
                        carrière.
                    </p>
                    <a href="{{ route('formation') }}">
                        <button class="px-8 py-3 font-semibold transition-all duration-300 self-center"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Voir les formations
                        </button>
                    </a>
                </div>
            </div>

            <!-- Formation Internationale -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/210182/pexels-photo-210182.jpeg"
                        alt="Formation Internationale" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-center text-center flex-grow">
                    <h3 class="text-2xl font-bold mb-3">Formation Internationale</h3>
                    <p class="text-gray-700 mb-6">
                        Formations ouvertes à l' international, combinant expertise mondiale et adaptation aux réalités
                        locales.
                    </p>
                    <a href="{{ route('formation.international') }}">
                        <button class="px-8 py-3 font-semibold transition-all duration-300 self-center"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Découvrir
                        </button>
                    </a>
                </div>
            </div>

            <!-- Conciergerie (Nouvelle carte) -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/5273464/pexels-photo-5273464.jpeg" alt="Conciergerie"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-center text-center flex-grow">
                    <h3 class="text-2xl font-bold mb-3">Conciergerie</h3>
                    <p class="text-gray-700 mb-6">
                        Service de conciergerie personnalisé : réservation de restaurants, organisation d'événements,
                        assistance personnelle et bien plus encore.
                    </p>
                    <a href="{{ route('conciergerie') }}">
                        <button class="px-8 py-3 font-semibold transition-all duration-300 self-center"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Découvrir nos services
                        </button>
                    </a>
                </div>
            </div>

            <!-- Espace Client -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/3768916/pexels-photo-3768916.jpeg" alt="Espace Client"
                        class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col justify-center text-center flex-grow">
                    <h3 class="text-2xl font-bold mb-3">Espace Client</h3>
                    <p class="text-gray-700 mb-6">
                        Connectez-vous à votre espace personnel pour gérer vos réservations, formations et séminaires.
                    </p>
                    <a href="{{ route('espaceclient') }}">
                        <button
                            class="px-8 py-3 font-semibold transition-all duration-300 self-center bg-black text-white border-2 border-black hover:bg-white hover:text-black hover:border-black"
                            onmouseover="this.style.background='white'; this.style.color='black'; this.style.borderColor='black'"
                            onmouseout="this.style.background='black'; this.style.color='white'; this.style.borderColor='black'">
                            Se connecter
                        </button>
                    </a>
                </div>
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

<!-- NOUVELLE SECTION AVIS CLIENTS AVEC SLIDER -->
<section id="testimonials" class="py-20 bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex flex-col lg:flex-row gap-10 items-start">
            <!-- Carte entreprise fixe -->
            <div class="lg:w-1/4">
                <div class="company-card flex gap-4">
                    <div class="company-avatar w-16 h-16 flex items-center justify-center rounded-xl"
                        style="background: #4a6cf7;">
                        <i class="fas fa-user text-2xl text-white"></i>
                    </div>
                    <div class="company-info">
                        <h3 class="text-2xl font-bold mb-2">Djok Prestige SAS</h3>
                        <div class="stars text-2xl mb-1" style="color: var(--gold);">★★★★★</div>
                        <small class="text-gray-400 text-sm">15 avis Google</small>
                        <br>
                        <a href="https://search.google.com/local/writereview?placeid=ChIJ6QjR9E5u5kcR6v5lQv6N7IU"
                            target="_blank" rel="noopener noreferrer" class="inline-block mt-3">
                            <button
                                class="btn-review px-6 py-2 border border-white bg-transparent text-white hover:bg-white hover:text-black transition-all duration-300">
                                Écrire un avis
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Zone slider avec avis -->
            <div class="lg:w-3/4 relative">
                <!-- Flèches de navigation -->
                <div class="arrow left absolute top-1/2 -left-5 transform -translate-y-1/2 z-10 w-10 h-10 rounded-full border border-var(--gold) bg-black/80 flex items-center justify-center cursor-pointer hover:bg-var(--gold) hover:text-black transition-all duration-300"
                    style="color: var(--gold);" onclick="scrollReviews(-1)">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="arrow right absolute top-1/2 -right-5 transform -translate-y-1/2 z-10 w-10 h-10 rounded-full border border-var(--gold) bg-black/80 flex items-center justify-center cursor-pointer hover:bg-var(--gold) hover:text-black transition-all duration-300"
                    style="color: var(--gold);" onclick="scrollReviews(1)">
                    <i class="fas fa-chevron-right"></i>
                </div>

                <!-- Slider d'avis -->
                <div class="reviews-slider flex gap-6 overflow-x-auto scroll-smooth pb-4" id="reviewsSlider"
                    style="scrollbar-width: none;">

                    <!-- Avis 1 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #b8b2a8;">
                                <span class="font-bold">L</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Lalla Guindo</h4>
                                <small class="text-gray-400 text-sm">il y a 2 ans</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Entreprise au top ! Service impeccable et professionnel.</p>
                    </div>

                    <!-- Avis 2 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #6c7cff;">
                                <span class="font-bold text-white">B</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Bruno Bouet</h4>
                                <small class="text-gray-400 text-sm">il y a 2 ans</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Directrice très expérimentée et très compétente. Je recommande !</p>
                    </div>

                    <!-- Avis 3 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #4f6b6f;">
                                <span class="font-bold text-white">A</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Aminta B.</h4>
                                <small class="text-gray-400 text-sm">il y a 2 ans</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">J'ai fait appel à Djok Prestige pour une prestation ! Je recommande
                            fortement !!</p>
                    </div>

                    <!-- Avis 4 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #ff6b6b;">
                                <span class="font-bold text-white">M</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Marie Dubois</h4>
                                <small class="text-gray-400 text-sm">il y a 1 an</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Service de VTC excellent, ponctuel et très professionnel.</p>
                    </div>

                    <!-- Avis 5 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #5cd85c;">
                                <span class="font-bold text-white">T</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Thomas Martin</h4>
                                <small class="text-gray-400 text-sm">il y a 8 mois</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Formation VTC de qualité, équipe pédagogique compétente et à l'écoute.
                        </p>
                    </div>

                    <!-- Avis 6 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #ffa500;">
                                <span class="font-bold text-white">S</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Sophie Laurent</h4>
                                <small class="text-gray-400 text-sm">il y a 6 mois</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Location de véhicule sans souci, entretien parfait et tarif compétitif.
                        </p>
                    </div>

                    <!-- Avis 7 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #9b59b6;">
                                <span class="font-bold text-white">K</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Karim S.</h4>
                                <small class="text-gray-400 text-sm">il y a 3 mois</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Accompagnement entrepreneurial exceptionnel pour mon projet en Afrique.
                        </p>
                    </div>

                    <!-- Avis 8 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #3498db;">
                                <span class="font-bold text-white">J</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Jean Dupont</h4>
                                <small class="text-gray-400 text-sm">il y a 1 mois</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Service conciergerie parfait pour mon arrivée en France. Très
                            professionnel.</p>
                    </div>

                    <!-- Avis 9 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #e74c3c;">
                                <span class="font-bold text-white">A</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Alice R.</h4>
                                <small class="text-gray-400 text-sm">il y a 2 semaines</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Chauffeur VTC très courtois, voiture propre et trajet en toute
                            sécurité.</p>
                    </div>

                    <!-- Avis 10 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="review-header flex gap-3 items-center mb-3">
                            <div class="avatar w-10 h-10 rounded-full flex items-center justify-center"
                                style="background: #2ecc71;">
                                <span class="font-bold text-white">P</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Paul G.</h4>
                                <small class="text-gray-400 text-sm">il y a 1 semaine</small>
                            </div>
                            <i class="fab fa-google ml-auto" style="color: #4285F4;"></i>
                        </div>
                        <div class="review-stars mb-3">
                            <span class="text-xl" style="color: var(--gold);">★★★★★</span>
                            <i class="fas fa-check-circle text-sm ml-1" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Excellent rapport qualité-prix, je reviendrai certainement pour mes
                            futurs besoins.</p>
                    </div>
                </div>
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

    /* Styles pour les nouvelles cartes de service */
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

        /* Ajustements pour les nouvelles cartes */
        .grid-cols-3 {
            grid-template-columns: 1fr !important;
        }

        .relative.h-48 {
            height: 200px;
        }

        /* Ajustements pour les cartes de service */
        .flex-col.md\:flex-row {
            flex-direction: column;
        }

        .md\:w-1\/2 {
            width: 100%;
        }

        .min-h-\[260px\] {
            min-height: auto;
        }

        .h-56 {
            height: 200px;
        }

        /* Ajustements pour la section avis */
        .flex-col.lg\:flex-row {
            flex-direction: column;
        }

        .lg\:w-1\/4,
        .lg\:w-3\/4 {
            width: 100%;
        }

        .arrow.left,
        .arrow.right {
            display: none;
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

    /* Styles pour les nouvelles cartes */
    .relative.h-48 {
        height: 12rem;
    }

    /* Animation pour les cartes de service */
    .flex-col.md\:flex-row {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .flex-col.md\:flex-row:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    }

    /* Styles pour le slider d'avis */
    .reviews-slider {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .reviews-slider::-webkit-scrollbar {
        display: none;
    }

    .review {
        flex: 0 0 auto;
        transition: transform 0.3s ease;
    }

    .review:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    /* Styles pour les flèches */
    .arrow {
        transition: all 0.3s ease;
    }
</style>

<!-- Scripts pour la page -->
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

    // Fonction pour afficher les détails des services
    function showServiceDetails(service) {
        alert("Détails du service : " + service + "\n\nCette fonctionnalité sera bientôt disponible.");
    }

    // Fonction pour le slider d'avis
    const slider = document.getElementById('reviewsSlider');
    function scrollReviews(dir) {
        const scrollAmount = 320; // Largeur d'une carte + gap
        slider.scrollBy({ left: dir * scrollAmount, behavior: 'smooth' });
    }
</script>
@endsection
