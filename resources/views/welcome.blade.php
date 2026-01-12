@extends('layouts.main')

@section('title', 'DJOK PRESTIGE - VTC, Formations & Entrepreneuriat')

@section('content')
<!-- Header avec bannières superposées -->
<header class="relative bg-black">
    <!-- Conteneur des bannières -->
    <div class="relative">
        <!-- Bannière 1 - Formation VTC avec opacité corrigée -->
        <section class="hero">
            <!-- Fond avec opacité ajustée -->
            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&w=1600&q=80"
                    alt="Formation VTC" class="object-cover w-full h-full opacity-50">
                <!-- Overlay doré avec opacité réduite pour correspondre à la bannière 2 -->
                <div class="absolute inset-0" style="background: rgba(182, 146, 70, 0.85); mix-blend-mode: multiply;">
                </div>
                <!-- Overlay noir supplémentaire pour correspondre à l'opacité de la bannière 2 -->
                <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/70 to-black/50"></div>
            </div>

            <div class="relative z-10 hero-left">
                <h1>FORMATION VTC</h1>
                <p class="hero-subtitle">Devenez Chauffeur VTC Professionnel</p>
                <p class="hero-description">
                    Obtenez votre carte VTC avec une formation complète, certifiée Qualiopi,
                    agréée par la préfecture et finançable par le CPF
                </p>
            </div>

            <div class="relative z-10 hero-right">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide slide">
                            <div>
                                <h2>INSCRIPTION À L'EXAMEN VTC & FORMATION VTC</h2>
                                <p>Constituez votre dossier d'inscription :</p>
                                <ul class="document-list">
                                    <li>CNI ou titre de séjour valide</li>
                                    <li>Justificatif de domicile de moins de 3 mois</li>
                                    <li>Permis de conduire de plus de 3 ans</li>
                                    <li>Photo d'identité</li>
                                    <li>Nom, prénom et signature</li>
                                </ul>
                            </div>
                            <div>
                                <a href="{{ route('formation') }}" class="btn">DÉCOUVRIR L'EXAMEN VTC</a>
                                <a href="{{ route('contact') }}" class="btn">DEMANDER PLUS D'INFOS</a>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="swiper-slide slide">
                            <div>
                                <h2>L'EXAMEN VTC THÉORIQUE</h2>
                                <p>
                                    Première épreuve de l'examen VTC, l'épreuve théorique VTC est
                                    en tronc commun avec l'examen Taxi et repose sur 6 matières.
                                </p>
                                <div class="objective">
                                    <strong>Objectif : au moins 10/20</strong>
                                </div>
                                <p class="question">Voir les dates des examens VTC</p>
                            </div>
                            <div>
                                <a href="{{ route('formation') }}" class="btn">LES FORMATIONS THÉORIQUES</a>
                                <a href="{{ route('contact') }}" class="btn">DEMANDER UN DEVIS</a>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="swiper-slide slide">
                            <div>
                                <h2>L'EXAMEN VTC PRATIQUE</h2>
                                <p>
                                    Félicitations, vous êtes admissible à l'examen VTC pratique,
                                    épreuve de conduite professionnelle évaluée par 2
                                    examinateurs, à bord d'un véhicule double commande fourni par
                                    le candidat.
                                </p>
                                <div class="objective">
                                    <strong>Objectif : au moins 12/20</strong>
                                </div>
                                <p class="question">
                                    Voir les résultats des précédents examens
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('formation') }}" class="btn">LES FORMATIONS PRATIQUES</a>
                                <a href="{{ route('location') }}" class="btn">LOUER UN VÉHICULE</a>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="swiper-slide slide">
                            <div>
                                <h2>EXERCER EN TANT QUE CHAUFFEUR VTC</h2>
                                <p>
                                    Vous avez réussi l'examen VTC, Félicitations ! Vous êtes
                                    chauffeur VTC. DJOK PRESTIGE vous accompagne et répond à vos
                                    interrogations…
                                </p>
                                <p class="question">
                                    Comment obtenir la carte professionnelle VTC ?
                                </p>
                                <p class="question">Comment s'inscrire au registre VTC ?</p>
                                <p class="question">Comment créer mon entreprise ?</p>
                                <p class="question">
                                    La formation continue est-elle obligatoire ?
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('formation') }}" class="btn">LA FORMATION CONTINUE</a>
                                <a href="{{ route('formation') }}" class="btn">TOUTES MES DÉMARCHES</a>
                            </div>
                        </div>
                    </div>
                    <!-- BOUTONS DE PAGINATION -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <!-- BOUTON DEVIS -->
            <a href="{{ route('contact') }}" class="devis-btn">Demandez un devis gratuit</a>

            <!-- ICÔNES FLOTTANTES -->
            <div class="floating-icons">
                <a href="https://www.google.com/maps/place//data=!4m3!3m2!1s0x47e613e5ed89e9fb:0xf5ac01ba78653a2b!12e1"
                    class="icon-item">
                    <i class="fa-solid fa-location-dot"></i><span>TROUVER UN CENTRE</span>
                </a>
                <a href="{{ route('formation') }}" class="icon-item">
                    <i class="fa-solid fa-book-open"></i><span>NOS FORMATIONS</span>
                </a>
                <a href="{{ route('contact') }}" class="icon-item">
                    <i class="fa-solid fa-envelope"></i><span>CONTACT</span>
                </a>
                <a href="tel:+33123456789" class="icon-item">
                    <i class="fa-solid fa-phone"></i><span>APPELER</span>
                </a>
            </div>

            <!-- Indicateur de défilement -->
            <div class="absolute z-20 transform -translate-x-1/2 bottom-10 left-1/2 animate-bounce">
                <a href="#banner-2" class="text-white hover:text-var(--gold) transition">
                    <i class="text-3xl fas fa-chevron-down"></i>
                </a>
            </div>
        </section>

        <!-- Bannière 2 - Location VTC -->
        <section id="banner-2"
            class="relative flex items-center justify-center min-h-screen overflow-hidden banner-section">
            <!-- Séparateur décoratif -->
            <div class="absolute top-0 left-0 right-0 h-1">
                <div class="w-48 h-full mx-auto"
                    style="background: linear-gradient(90deg, transparent, #b69246, transparent);"></div>
            </div>

            <div class="absolute inset-0 bg-black">
                <img src="https://images.unsplash.com/photo-1555212697-194d092e3b8f" alt="Location VTC"
                    class="object-cover w-full h-full opacity-50">
                <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/70 to-black/50"></div>
            </div>

            <div class="relative z-10 max-w-6xl px-4 py-20 mx-auto text-center text-white">
                <div class="mb-6">
                    <span
                        class="inline-block px-4 py-2 mb-4 text-sm font-semibold tracking-wider uppercase rounded-full"
                        style="background: rgba(182, 146, 70, 0.3); color: #b69246;">
                        Location Véhicules Premium
                    </span>
                </div>

                <h1 class="mb-8 text-4xl font-bold md:text-5xl lg:text-6xl" style="color: #b69246;">
                    Louez votre véhicule VTC<br>haut de gamme
                </h1>

                <p class="max-w-3xl mx-auto mb-16 text-lg leading-relaxed md:text-xl lg:text-2xl">
                    Véhicules récents, prêts à l'emploi avec offres flexibles,
                    tarifs compétitifs et entretien inclus
                </p>

                <!-- Nouvelles cartes avec images -->
                <div class="grid max-w-6xl grid-cols-1 gap-8 mx-auto mb-16 md:grid-cols-3">
                    <!-- Véhicule Électrique -->
                    <div
                        class="relative overflow-hidden transition-all duration-300 border group rounded-xl border-white/10 bg-white/5 backdrop-blur-sm hover:transform hover:scale-105 hover:border-b69246/30">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('v_electrique.webp') }}" alt="Véhicule Électrique VTC"
                                class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                            <!-- Overlay pour rendre le texte lisible -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            </div>
                            <!-- Badge de capacité -->
                            <div class="absolute flex items-center justify-between bottom-4 left-4 right-4">
                                <div class="flex items-center px-3 py-1 space-x-2 rounded-full bg-black/70">
                                    <i class="text-sm fas fa-users" style="color: #b69246;"></i>
                                    <span class="text-sm font-semibold">3 passagers</span>
                                </div>
                                <div class="flex items-center px-3 py-1 space-x-2 rounded-full bg-black/70">
                                    <i class="text-sm fas fa-suitcase" style="color: #b69246;"></i>
                                    <span class="text-sm font-semibold">3 bagages</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-3 text-xl font-bold">Véhicule Électrique</h3>
                            <p class="mb-4 text-sm text-gray-300">
                                Écologique et économique, idéal pour les trajets urbains avec un confort optimal.
                            </p>
                            <div class="flex items-center text-sm">
                                <i class="mr-2 fas fa-bolt" style="color: #b69246;"></i>
                                <span>100% électrique • Autonomie 400km</span>
                            </div>
                        </div>
                    </div>

                    <!-- Véhicule Berline -->
                    <div
                        class="relative overflow-hidden transition-all duration-300 border group rounded-xl border-white/10 bg-white/5 backdrop-blur-sm hover:transform hover:scale-105 hover:border-b69246/30">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('v_berline.webp') }}" alt="Berline VTC Premium"
                                class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                            <!-- Overlay pour rendre le texte lisible -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            </div>
                            <!-- Badge de capacité -->
                            <div class="absolute flex items-center justify-between bottom-4 left-4 right-4">
                                <div class="flex items-center px-3 py-1 space-x-2 rounded-full bg-black/70">
                                    <i class="text-sm fas fa-users" style="color: #b69246;"></i>
                                    <span class="text-sm font-semibold">3 passagers</span>
                                </div>
                                <div class="flex items-center px-3 py-1 space-x-2 rounded-full bg-black/70">
                                    <i class="text-sm fas fa-suitcase" style="color: #b69246;"></i>
                                    <span class="text-sm font-semibold">3 bagages</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-3 text-xl font-bold">Berline Premium</h3>
                            <p class="mb-4 text-sm text-gray-300">
                                Luxe et confort pour vos déplacements professionnels ou événements spéciaux.
                            </p>
                            <div class="flex items-center text-sm">
                                <i class="mr-2 fas fa-star" style="color: #b69246;"></i>
                                <span>Classe affaires • Intérieur cuir</span>
                            </div>
                        </div>
                    </div>

                    <!-- Véhicule VAN -->
                    <div
                        class="relative overflow-hidden transition-all duration-300 border group rounded-xl border-white/10 bg-white/5 backdrop-blur-sm hover:transform hover:scale-105 hover:border-b69246/30">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('v_VAN.webp') }}" alt="VAN VTC 7 places"
                                class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                            <!-- Overlay pour rendre le texte lisible -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                            </div>
                            <!-- Badge de capacité -->
                            <div class="absolute flex items-center justify-between bottom-4 left-4 right-4">
                                <div class="flex items-center px-3 py-1 space-x-2 rounded-full bg-black/70">
                                    <i class="text-sm fas fa-users" style="color: #b69246;"></i>
                                    <span class="text-sm font-semibold">7 passagers</span>
                                </div>
                                <div class="flex items-center px-3 py-1 space-x-2 rounded-full bg-black/70">
                                    <i class="text-sm fas fa-suitcase" style="color: #b69246;"></i>
                                    <span class="text-sm font-semibold">7 bagages</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="mb-3 text-xl font-bold">VAN 7 Places</h3>
                            <p class="mb-4 text-sm text-gray-300">
                                Parfait pour les groupes, familles ou transferts aéroport avec beaucoup de bagages.
                            </p>
                            <div class="flex items-center text-sm">
                                <i class="mr-2 fas fa-shield-alt" style="color: #b69246;"></i>
                                <span>Confort groupe • Espace optimisé</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Avantages additionnels -->
                <div class="grid max-w-3xl grid-cols-2 gap-4 mx-auto mb-12 md:grid-cols-4">
                    <div class="p-4 text-center">
                        <i class="mb-3 text-2xl fas fa-tools" style="color: #b69246;"></i>
                        <p class="text-sm font-semibold">Entretien inclus</p>
                    </div>
                    <div class="p-4 text-center">
                        <i class="mb-3 text-2xl fas fa-euro-sign" style="color: #b69246;"></i>
                        <p class="text-sm font-semibold">Tarifs compétitifs</p>
                    </div>
                    <div class="p-4 text-center">
                        <i class="mb-3 text-2xl fas fa-calendar-alt" style="color: #b69246;"></i>
                        <p class="text-sm font-semibold">Flexibilité totale</p>
                    </div>
                    <div class="p-4 text-center">
                        <i class="mb-3 text-2xl fas fa-shield-alt" style="color: #b69246;"></i>
                        <p class="text-sm font-semibold">Assurance complète</p>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{route('location')}}">
                        <button class="px-8 py-4 text-lg font-semibold transition-all duration-300 rounded-lg"
                            style="background: #b69246; color: white; border: 2px solid #b69246;"
                            onmouseover="this.style.background='transparent'; this.style.color='#b69246';"
                            onmouseout="this.style.background='#b69246'; this.style.color='white';">
                            <i class="mr-2 fas fa-search"></i> Voir les véhicules
                        </button>
                    </a>
                    <a href="{{ route('location') }}">
                        <button class="px-8 py-4 text-lg font-semibold transition-all duration-300 rounded-lg"
                            style="border: 2px solid #b69246; color: #b69246; background: transparent;"
                            onmouseover="this.style.background='#b69246'; this.style.color='white';"
                            onmouseout="this.style.background='transparent'; this.style.color='#b69246';">
                            <i class="mr-2 fas fa-calendar-check"></i> Réserver maintenant
                        </button>
                    </a>
                </div>
            </div>

            <!-- Indicateur de défilement -->
            <div class="absolute z-20 transform -translate-x-1/2 bottom-10 left-1/2 animate-bounce">
                <a href="#banner-3" class="text-white transition hover:text-b69246">
                    <i class="text-3xl fas fa-chevron-down"></i>
                </a>
            </div>
        </section>
    </div>
</header>


<!-- SERVICES SECTION AVEC NOUVEAU DESIGN -->
<section id="services" class="py-20 bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="mb-4 text-4xl font-bold text-center" style="color: var(--gold);">NOS SERVICES</h2>
        <p class="max-w-3xl mx-auto mt-4 text-lg text-center text-gray-300">
            Découvrez notre gamme complète de services conçus pour répondre à tous vos besoins professionnels et
            personnels
        </p>

        <div class="grid grid-cols-1 gap-10 mt-16 md:grid-cols-2 lg:grid-cols-3">
            <!-- Formations -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/3184465/pexels-photo-3184465.jpeg" alt="Formations"
                        class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-grow p-6 text-center">
                    <h3 class="mb-3 text-2xl font-bold">Formations</h3>
                    <p class="mb-6 text-gray-700">
                        Formations professionnelles certifiantes pour développer vos compétences et booster votre
                        carrière.
                    </p>
                    <a href="{{ route('formation') }}">
                        <button class="self-center px-8 py-3 font-semibold transition-all duration-300"
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
                        alt="Formation Internationale" class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-grow p-6 text-center">
                    <h3 class="mb-3 text-2xl font-bold">Formation Internationale</h3>
                    <p class="mb-6 text-gray-700">
                        Formations ouvertes à l' international, combinant expertise mondiale et adaptation aux réalités
                        locales.
                    </p>
                    <a href="{{ route('formation.international') }}">
                        <button class="self-center px-8 py-3 font-semibold transition-all duration-300"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Découvrir
                        </button>
                    </a>
                </div>
            </div>

            <!-- VTC & Location -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/125779/pexels-photo-125779.jpeg" alt="VTC & Location"
                        class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-grow p-6 text-center">
                    <h3 class="mb-3 text-2xl font-bold">Reservation VTC</h3>
                    <p class="mb-6 text-gray-700">
                        Services de véhicules haut de gamme, déplacements professionnels et personnels avec chauffeurs
                        expérimentés.
                    </p>
                    <a href="{{ route('reservation') }}">
                        <button class="self-center px-8 py-3 font-semibold transition-all duration-300"
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
                        class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-grow p-6 text-center">
                    <h3 class="mb-3 text-2xl font-bold">Location</h3>
                    <p class="mb-6 text-gray-700">
                        Location de véhicules de prestige pour vos événements spéciaux, mariages, cérémonies ou
                        besoins professionnels. Parc varié de luxe.
                    </p>
                    <a href="{{ route('location') }}">
                        <button class="self-center px-8 py-3 font-semibold transition-all duration-300"
                            style="background: var(--gold); color: black; border: 2px solid black;"
                            onmouseover="this.style.background='black'; this.style.color='var(--gold)'; this.style.borderColor='var(--gold)'"
                            onmouseout="this.style.background='var(--gold)'; this.style.color='black'; this.style.borderColor='black'">
                            Louer un véhicule
                        </button>
                    </a>
                </div>
            </div>

            <!-- Conciergerie (Nouvelle carte) -->
            <div class="flex flex-col bg-white text-black min-h-[280px] border-2" style="border-color: var(--gold);">
                <div class="h-48">
                    <img src="https://images.pexels.com/photos/5273464/pexels-photo-5273464.jpeg" alt="Conciergerie"
                        class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-grow p-6 text-center">
                    <h3 class="mb-3 text-2xl font-bold">Conciergerie</h3>
                    <p class="mb-6 text-gray-700">
                        Service de conciergerie personnalisé : réservation de restaurants, organisation d'événements,
                        assistance personnelle et bien plus encore.
                    </p>
                    <a href="{{ route('conciergerie') }}">
                        <button class="self-center px-8 py-3 font-semibold transition-all duration-300"
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
                        class="object-cover w-full h-full">
                </div>
                <div class="flex flex-col justify-center flex-grow p-6 text-center">
                    <h3 class="mb-3 text-2xl font-bold">Espace Client</h3>
                    <p class="mb-6 text-gray-700">
                        Connectez-vous à votre espace personnel pour gérer vos réservations, formations et séminaires.
                    </p>
                    <a href="{{ route('espaceclient') }}">
                        <button
                            class="self-center px-8 py-3 font-semibold text-white transition-all duration-300 bg-black border-2 border-black hover:bg-white hover:text-black hover:border-black"
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
        <h2 class="mb-4 text-4xl font-bold text-center" style="color: #b69246;">DJOK PRESTIGE en Chiffres</h2>
        <p class="mt-4 text-center text-gray-300">Notre expertise se reflète dans nos résultats</p>

        <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-2 lg:grid-cols-4">
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: #b69246;">5000+</div>
                <p class="text-gray-300">Clients satisfaits</p>
            </div>
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: #b69246;">500+</div>
                <p class="text-gray-300">Formations dispensées</p>
            </div>
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: #b69246;">50+</div>
                <p class="text-gray-300">Projets accompagnés en Afrique</p>
            </div>
            <div class="text-center">
                <div class="mb-2 text-4xl font-bold" style="color: #b69246;">99%</div>
                <p class="text-gray-300">Taux de satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- NOUVELLE SECTION AVIS CLIENTS AVEC SLIDER -->
<section id="testimonials" class="py-20 bg-black">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex flex-col items-start gap-10 lg:flex-row">
            <!-- Carte entreprise fixe -->
            <div class="lg:w-1/4">
                <div class="flex gap-4 company-card">
                    <div class="flex items-center justify-center w-16 h-16 company-avatar rounded-xl"
                        style="background: #4a6cf7;">
                        <i class="text-2xl text-white fas fa-user"></i>
                    </div>
                    <div class="company-info">
                        <h3 class="mb-2 text-2xl font-bold">Djok Prestige SAS</h3>
                        <div class="mb-1 text-2xl stars" style="color: #b69246;">★★★★★</div>
                        <small class="text-sm text-gray-400">15 avis Google</small>
                        <br>
                        <a href="https://www.google.com/maps/place//data=!4m3!3m2!1s0x47e613e5ed89e9fb:0xf5ac01ba78653a2b!12e1"
                            target="_blank" rel="noopener noreferrer" class="inline-block mt-3">
                            <button
                                class="px-6 py-2 text-white transition-all duration-300 bg-transparent border border-white btn-review hover:bg-white hover:text-black">
                                Écrire un avis
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Zone slider avec avis -->
            <div class="relative lg:w-3/4">
                <!-- Flèches de navigation -->
                <div class="arrow left absolute top-1/2 -left-5 transform -translate-y-1/2 z-10 w-10 h-10 rounded-full border border-var(--gold) bg-black/80 flex items-center justify-center cursor-pointer hover:bg-b69246 hover:text-black transition-all duration-300"
                    style="color: #b69246;" onclick="scrollReviews(-1)">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="arrow right absolute top-1/2 -right-5 transform -translate-y-1/2 z-10 w-10 h-10 rounded-full border border-var(--gold) bg-black/80 flex items-center justify-center cursor-pointer hover:bg-b69246 hover:text-black transition-all duration-300"
                    style="color: #b69246;" onclick="scrollReviews(1)">
                    <i class="fas fa-chevron-right"></i>
                </div>

                <!-- Slider d'avis -->
                <div class="flex gap-6 pb-4 overflow-x-auto reviews-slider scroll-smooth" id="reviewsSlider"
                    style="scrollbar-width: none;">

                    <!-- Avis 1 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #b8b2a8;">
                                <span class="font-bold">L</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Lalla Guindo</h4>
                                <small class="text-sm text-gray-400">il y a 2 ans</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Entreprise au top ! Service impeccable et professionnel.</p>
                    </div>

                    <!-- Avis 2 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #6c7cff;">
                                <span class="font-bold text-white">B</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Bruno Bouet</h4>
                                <small class="text-sm text-gray-400">il y a 2 ans</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Directrice très expérimentée et très compétente. Je recommande !</p>
                    </div>

                    <!-- Avis 3 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #4f6b6f;">
                                <span class="font-bold text-white">A</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Aminta B.</h4>
                                <small class="text-sm text-gray-400">il y a 2 ans</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">J'ai fait appel à Djok Prestige pour une prestation ! Je recommande
                            fortement !!</p>
                    </div>

                    <!-- Avis 4 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #ff6b6b;">
                                <span class="font-bold text-white">M</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Marie Dubois</h4>
                                <small class="text-sm text-gray-400">il y a 1 an</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Service de VTC excellent, ponctuel et très professionnel.</p>
                    </div>

                    <!-- Avis 5 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #5cd85c;">
                                <span class="font-bold text-white">T</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Thomas Martin</h4>
                                <small class="text-sm text-gray-400">il y a 8 mois</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Formation VTC de qualité, équipe pédagogique compétente et à l'écoute.
                        </p>
                    </div>

                    <!-- Avis 6 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #ffa500;">
                                <span class="font-bold text-white">S</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Sophie Laurent</h4>
                                <small class="text-sm text-gray-400">il y a 6 mois</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Location de véhicule sans souci, entretien parfait et tarif compétitif.
                        </p>
                    </div>

                    <!-- Avis 7 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #9b59b6;">
                                <span class="font-bold text-white">K</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Karim S.</h4>
                                <small class="text-sm text-gray-400">il y a 3 mois</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Accompagnement entrepreneurial exceptionnel pour mon projet en Afrique.
                        </p>
                    </div>

                    <!-- Avis 8 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #3498db;">
                                <span class="font-bold text-white">J</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Jean Dupont</h4>
                                <small class="text-sm text-gray-400">il y a 1 mois</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Service conciergerie parfait pour mon arrivée en France. Très
                            professionnel.</p>
                    </div>

                    <!-- Avis 9 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #e74c3c;">
                                <span class="font-bold text-white">A</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Alice R.</h4>
                                <small class="text-sm text-gray-400">il y a 2 semaines</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Chauffeur VTC très courtois, voiture propre et trajet en toute
                            sécurité.</p>
                    </div>

                    <!-- Avis 10 -->
                    <div class="review min-w-[280px] bg-white/5 p-6 rounded-xl border border-white/10">
                        <div class="flex items-center gap-3 mb-3 review-header">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full avatar"
                                style="background: #2ecc71;">
                                <span class="font-bold text-white">P</span>
                            </div>
                            <div>
                                <h4 class="font-bold">Paul G.</h4>
                                <small class="text-sm text-gray-400">il y a 1 semaine</small>
                            </div>
                            <i class="ml-auto fab fa-google" style="color: #4285F4;"></i>
                        </div>
                        <div class="mb-3 review-stars">
                            <span class="text-xl" style="color: #b69246;">★★★★★</span>
                            <i class="ml-1 text-sm fas fa-check-circle" style="color: #4285F4;"></i>
                        </div>
                        <p class="text-gray-300">Excellent rapport qualité-prix, je reviendrai certainement pour mes
                            futurs besoins.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Styles exactement comme le code original avec pagination -->
<style>
    /* HERO SECTION - MODIFIÉ POUR CORRIGER L'OPACITÉ */
    .hero {
        min-height: 100vh;
        position: relative;
        display: flex;
        align-items: center;
        padding: 60px;
        gap: 40px;
        overflow: hidden;
    }

    .hero-left {
        flex: 1;
        color: #fff;
        position: relative;
        z-index: 10;
    }

    .hero-left h1 {
        font-size: 48px;
        font-weight: 700;
        color: #fff;
        margin-bottom: 15px;
    }

    .hero-subtitle {
        font-size: 28px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 10px;
    }

    .hero-description {
        font-size: 18px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        max-width: 500px;
    }

    .devis-btn {
        position: absolute;
        left: -40px;
        bottom: 120px;
        background: #b69246;
        color: #fff;
        text-decoration: none;
        padding: 18px 60px;
        font-size: 15px;
        font-weight: 500;
        border-radius: 0 6px 6px 0;
        z-index: 20;
        transition: 0.3s;
    }

    .devis-btn:hover {
        padding-left: 80px;
        background: #d4af37;
    }

    .hero-right {
        width: 400px;
        margin-right: 120px;
        background: #fff;
        border-radius: 28px;
        padding: 32px 28px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        position: relative;
        z-index: 10;
    }

    /* SWIPER */
    .swiper {
        width: 100%;
        height: 100%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .swiper-wrapper {
        flex: 1;
    }

    .swiper-slide {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 0 8px 12px;
    }

    .slide h2 {
        text-align: center;
        font-size: 20px;
        margin-bottom: 20px;
        line-height: 1.3;
        color: #333;
    }

    .slide p {
        font-size: 14px;
        line-height: 1.7;
        color: #333;
        margin-bottom: 8px;
    }

    .question {
        font-weight: 500;
        margin: 4px 0;
        color: #333;
    }

    .document-list {
        padding-left: 20px;
        margin: 12px 0;
    }

    .document-list li {
        font-size: 14px;
        color: #333;
        line-height: 1.6;
        margin-bottom: 4px;
    }

    .objective {
        background: #f8f4e8;
        padding: 12px;
        border-radius: 8px;
        margin: 12px 0;
        border-left: 4px solid #b69246;
    }

    .objective strong {
        color: #333;
    }

    .slide .btn {
        display: block;
        text-align: center;
        background: #b69246;
        color: #fff;
        text-decoration: none;
        padding: 14px 20px;
        border-radius: 35px;
        font-weight: 600;
        margin: 12px 0 8px;
        transition: 0.3s;
        font-size: 13px;
        text-transform: uppercase;
    }

    .slide .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        background: #d4af37;
    }

    /* BOUTONS DE PAGINATION */
    .swiper-pagination {
        position: relative;
        margin: 12px 0 4px;
        text-align: center;
    }

    .swiper-pagination-bullet {
        background: #ccc;
        opacity: 1;
        width: 9px;
        height: 9px;
        margin: 0 5px !important;
    }

    .swiper-pagination-bullet-active {
        background: #111;
    }

    /* ICONES FLOTTANTES */
    .floating-icons {
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 16px;
        z-index: 20;
        align-items: flex-end;
    }

    .icon-item {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #b69246;
        cursor: pointer;
        overflow: hidden;
        transition: width 0.4s ease, box-shadow 0.4s ease;
        position: relative;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .icon-item i {
        font-size: 20px;
        color: #fff;
        width: 52px;
        min-width: 52px;
        text-align: center;
        line-height: 52px;
        flex-shrink: 0;
        z-index: 2;
        position: relative;
    }

    .icon-item span {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        padding: 0 18px 0 12px;
        opacity: 0;
        transform: translateX(-10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
        white-space: nowrap;
        z-index: 1;
        position: relative;
    }

    .icon-item:hover {
        width: 240px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
        background: #d4af37;
    }

    .icon-item:hover span {
        opacity: 1;
        transform: translateX(0);
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .hero {
            flex-direction: column;
            gap: 40px;
            padding: 40px 20px;
        }

        .hero-right {
            width: 100%;
            max-width: 420px;
            margin-right: 0;
        }

        .floating-icons {
            display: none;
        }

        .devis-btn {
            left: 0;
            bottom: 20px;
            padding: 16px 28px;
            border-radius: 0 8px 8px 0;
        }

        .hero-left h1 {
            font-size: 36px;
            text-align: center;
        }

        .hero-subtitle {
            font-size: 24px;
            text-align: center;
        }

        .hero-description {
            font-size: 16px;
            text-align: center;
            margin: 0 auto;
        }
    }

    @media (max-width: 1200px) {
        .hero-right {
            margin-right: 80px;
        }

        .floating-icons {
            right: 20px;
        }
    }

    /* Styles existants pour le reste de la page */
    .banner-section {
        position: relative;
        scroll-margin-top: 0;
    }

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

    /* Responsive */
    @media (max-width: 768px) {
        .grid-cols-2 {
            grid-template-columns: 1fr !important;
        }

        .grid-cols-5 {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .grid-cols-3 {
            grid-template-columns: 1fr !important;
        }

        .relative.h-48 {
            height: 200px;
        }

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

    .arrow {
        transition: all 0.3s ease;
    }
</style>

<!-- Scripts pour la page -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Initialisation du Swiper
    new Swiper(".swiper", {
        loop: false,
        speed: 600,
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        // PAS de autoplay - défilement manuel seulement avec pagination
    });

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

    // Fonction pour le slider d'avis
    const slider = document.getElementById('reviewsSlider');
    function scrollReviews(dir) {
        const scrollAmount = 320;
        slider.scrollBy({ left: dir * scrollAmount, behavior: 'smooth' });
    }
</script>
@endsection