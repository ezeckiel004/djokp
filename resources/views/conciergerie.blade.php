@extends('layouts.main')

@section('title', 'Conciergerie - Arriver & Vivre en France | DJOK PRESTIGE')

@section('content')
<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)),
            url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
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

    .service-card {
        @apply bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover: shadow-xl hover:scale-[1.02];
    }

    .pack-card {
        @apply bg-gray-50 rounded-lg p-6 border border-gray-200 transition-all duration-300 hover: border-yellow-400 hover:bg-white;
    }

    .tariff-row {
        @apply transition-all duration-200 hover: bg-yellow-50;
    }

    .tariff-icon {
        @apply w-10 h-10 rounded-lg flex items-center justify-center mr-4 flex-shrink-0;
    }

    .price-tag {
        @apply inline-block px-3 py-1 bg-yellow-100 text-yellow-800 font-semibold rounded-full text-sm;
    }

    .period-badge {
        @apply inline-block px-3 py-1 bg-gray-100 text-gray-700 font-medium rounded-full text-sm;
    }
</style>

<!-- Hero Section -->
<header class="hero-bg relative min-h-screen flex items-center">
    <div class="container mx-auto px-6 py-20">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8 fade-in">
                Arriver & Vivre en France avec DJOK PRESTIGE
            </h1>

            <p class="text-xl text-white mb-12 fade-in" style="transition-delay: 0.2s;">
                Votre arrivée en France, sans stress. DJOK PRESTIGE s'occupe de tout : transfert aéroport, hébergement,
                véhicule, guide, et assistance administrative légère. Vous vous concentrez sur l'essentiel (formation,
                business, séjour), on gère le reste.
            </p>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center fade-in" style="transition-delay: 0.4s;">
                <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <a href="#devis"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                        Demander un devis conciergerie
                    </a>
                    <a href="#contact"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                        Être rappelé en 10 minutes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#services" class="text-white transition duration-300 hover:text-yellow-400"
            aria-label="Défiler vers le bas">
            <i class="text-2xl fas fa-chevron-down" aria-hidden="true"></i>
        </a>
    </div>
</header>

<!-- Nos services -->
<section id="services" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos services (à la carte)</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Transferts aéroports & gares</h3>
                <p class="text-gray-600 mb-4">Accueil pancarte nominative, suivi vol/train, attente incluse.</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Location de voiture</h3>
                <p class="text-gray-600 mb-4">Économique, business, prestige, électrique – avec ou sans chauffeur.</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Hébergement</h3>
                <p class="text-gray-600 mb-4">Hôtel 3★ à 5★, appart-hôtel, appartements meublés (séjours 1 semaine à 6
                    mois).</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Guide touristique privé</h3>
                <p class="text-gray-600 mb-4">Circuits Paris, Versailles, Mont-Saint-Michel, châteaux de la Loire, Côte
                    d'Azur, Lyon, Bordeaux.</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Conciergerie de vie</h3>
                <p class="text-gray-600 mb-4">Carte SIM, pass transport, ouverture compte en ligne (banques
                    partenaires), assurance voyage, packs "courses à l'arrivée".</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Assistance installation légère</h3>
                <p class="text-gray-600 mb-4">Rendez-vous médical, orientation administrative, accompagnement
                    campus/école (non juridique).</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Business concierge</h3>
                <p class="text-gray-600 mb-4">Salles de réunion, interprète, chauffeur à la journée, visites de sites /
                    salons pro.</p>
            </div>

            <div class="service-card">
                <h3 class="text-xl font-bold text-gray-900 mb-4">VIP & événementiel</h3>
                <p class="text-gray-600 mb-4">Accès lounge, fast-track, photographes, sécurité discrète (sur devis).</p>
            </div>
        </div>
    </div>
</section>

<!-- Packs conciergerie -->
<section id="packs" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Packs Conciergerie</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Des solutions complètes adaptées à chaque type de séjour en France
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Arrivée Essentielle</h3>
                <p class="text-gray-600 mb-4">Séjour court (2–5 jours)</p>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Transfert aéroport</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>2 nuits hôtel 3★</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Carte SIM</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Support WhatsApp</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600 mb-4">À partir de 390 €</div>
                <a href="#devis"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Choisir ce pack
                </a>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Formation Sereine</h3>
                <p class="text-gray-600 mb-4">Stagiaires / étudiants</p>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Transfert</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Appartement meublé 1 mois</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Carte SIM</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Pass transport</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>RDV d'accueil</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600 mb-4">À partir de 1 490 €</div>
                <a href="#devis"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Choisir ce pack
                </a>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Affaires Business</h3>
                <p class="text-gray-600 mb-4">Entrepreneurs / B2B</p>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Chauffeur 1 jour</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Hôtel 4★</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Salle réunion 1/2 jour</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Interprète 2h</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600 mb-4">À partir de 890 €</div>
                <a href="#devis"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Choisir ce pack
                </a>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Famille Confort</h3>
                <p class="text-gray-600 mb-4">Familles 3–6 personnes</p>
                <ul class="space-y-2 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Van + siège bébé</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Appartement 2 chambres</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Panier d'arrivée</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check text-yellow-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Guide 1/2 journée</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600 mb-4">À partir de 1 190 €</div>
                <a href="#devis"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Choisir ce pack
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Tableau des tarifs prévisionnels - Version améliorée -->
<!-- Tableau des tarifs prévisionnels -->
<section class="py-20 bg-gradient-to-b from-white to-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                Tarifs Prévisionnels
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Estimation transparente des coûts pour vous aider à planifier sereinement votre budget
            </p>
            <div class="inline-flex items-center justify-center gap-3 bg-yellow-50 px-6 py-3 rounded-full mt-6">
                <i class="fas fa-info-circle text-yellow-600 text-lg"></i>
                <span class="text-yellow-800 font-medium">Tarifs indicatifs à partir de</span>
            </div>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full bg-white">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">Service</th>
                        <th class="py-4 px-6 text-left">Description</th>
                        <th class="py-4 px-6 text-center">Tarif</th>
                        <th class="py-4 px-6 text-center">Période</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ligne 1: Transfert Aéroport -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Transfert Aéroport</td>
                        <td class="py-4 px-6 text-gray-600">Accueil avec pancarte nominative, suivi vol en temps réel
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">65 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par trajet
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 2: Location Voiture Éco -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Location Voiture Éco</td>
                        <td class="py-4 px-6 text-gray-600">Clio, 208, Citadine - Assurance incluse</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">49 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par jour
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 3: Location Voiture Prestige -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Location Voiture Prestige</td>
                        <td class="py-4 px-6 text-gray-600">Classe E, BMW Série 5, Tesla Model 3</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">149 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par jour
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 4: Chauffeur Privé -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Chauffeur Privé</td>
                        <td class="py-4 px-6 text-gray-600">Service 8h avec véhicule business, professionnel bilingue
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">350 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par journée
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 5: Hôtel 3★ -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Hôtel 3★</td>
                        <td class="py-4 px-6 text-gray-600">Chambre double standard, petit-déjeuner inclus</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">110 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par nuit
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 6: Appartement Studio -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Appartement Studio</td>
                        <td class="py-4 px-6 text-gray-600">Meublé, équipé, wifi fibre, ménage inclus</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">1 250 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par mois
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 7: Guide Paris Essentiel -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Guide Paris Essentiel</td>
                        <td class="py-4 px-6 text-gray-600">Visite 4h des monuments, guide diplômé</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">190 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par visite
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 8: Pack Installation Starter -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Pack Installation Starter</td>
                        <td class="py-4 px-6 text-gray-600">Carte SIM + Pass Navigo + RDV d'accueil personnalisé</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">99 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Forfait unique
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 9: Assistance Administrative -->
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Assistance Administrative</td>
                        <td class="py-4 px-6 text-gray-600">Accompagnement démarches, prise de RDV</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">75 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par heure
                            </span>
                        </td>
                    </tr>

                    <!-- Ligne 10: Interprète -->
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Interprète</td>
                        <td class="py-4 px-6 text-gray-600">Traduction FR/EN/AR/ES, secteur médical ou professionnel
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">45 €</td>
                        <td class="py-4 px-6 text-center">
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                Par heure
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Section d'information et CTA -->
        <div class="mt-12 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="p-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-2">Informations importantes</h4>
                            <p class="text-gray-600">
                                Ces tarifs sont indicatifs et peuvent varier selon la saison, la durée,
                                les options choisies et la disponibilité. Les prix définitifs seront
                                confirmés dans votre devis personnalisé.
                            </p>
                        </div>
                    </div>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-yellow-600 to-yellow-500 text-white font-bold rounded-xl hover:from-yellow-700 hover:to-yellow-600 transition-all duration-300 transform hover:scale-105 hover:shadow-xl whitespace-nowrap">
                        <i class="fas fa-calculator"></i>
                        Obtenir un devis précis
                    </a>
                </div>
            </div>
        </div>

        <!-- Cartes informatives -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl">
                <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-percentage text-blue-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-lg mb-2">Pas de frais cachés</h4>
                <p class="text-gray-600">Tous nos tarifs incluent TVA et frais de service. Aucun supplément surprise.
                </p>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl">
                <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-handshake text-green-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-lg mb-2">Garantie meilleur prix</h4>
                <p class="text-gray-600">Nous garantissons les prix les plus compétitifs pour des services équivalents.
                </p>
            </div>

            <div
                class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl">
                <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center mb-4">
                    <i class="fas fa-clock text-purple-600 text-2xl"></i>
                </div>
                <h4 class="font-bold text-gray-900 text-lg mb-2">Devis sous 24h</h4>
                <p class="text-gray-600">Recevez votre devis personnalisé en moins de 24 heures ouvrées.</p>
            </div>
        </div>
    </div>
</section>

<!-- Location de voiture -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Location de voiture (avec/sans chauffeur)</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Éco</h3>
                <p class="text-gray-600 mb-4">Clio, 208</p>
                <div class="text-2xl font-bold text-yellow-600 mb-6">Dès 49 €/jour</div>
                <a href="{{ route('location') }}"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Réserver
                </a>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Business</h3>
                <p class="text-gray-600 mb-4">Passat, Classe C</p>
                <div class="text-2xl font-bold text-yellow-600 mb-6">Dès 89 €/jour</div>
                <a href="{{ route('location') }}"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Réserver
                </a>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Prestige</h3>
                <p class="text-gray-600 mb-4">Classe E, BMW Série 5, Tesla Model 3</p>
                <div class="text-2xl font-bold text-yellow-600 mb-6">Dès 149 €/jour</div>
                <a href="{{ route('location') }}"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Réserver
                </a>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Van 7 places</h3>
                <p class="text-gray-600 mb-4">Classe V</p>
                <div class="text-2xl font-bold text-yellow-600 mb-6">Dès 179 €/jour</div>
                <a href="{{ route('location') }}"
                    class="inline-flex items-center justify-center w-full px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Réserver
                </a>
            </div>
        </div>

        <div class="mt-12 p-6 bg-gray-50 rounded-xl">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Options disponibles :</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt text-yellow-600 mr-3" aria-hidden="true"></i>
                    <span>GPS</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-baby text-yellow-600 mr-3" aria-hidden="true"></i>
                    <span>Siège bébé</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-user-plus text-yellow-600 mr-3" aria-hidden="true"></i>
                    <span>Conducteur additionnel</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-charging-station text-yellow-600 mr-3" aria-hidden="true"></i>
                    <span>Recharge électrique</span>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('location') }}"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Réserver un véhicule
            </a>
        </div>
    </div>
</section>

<!-- Hébergements -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Hébergements (réseau partenaires)</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Hôtels 3★, 4★, 5★ (Paris, Lyon, Marseille, Bordeaux, Lille, Nice, Cannes). Apparts meublés (court /
                moyen séjour) : cuisine équipée, linge, Wi-Fi, ménage. Appart-hôtels : services hôteliers + kitchenette,
                idéal formation 2–12 semaines.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Hôtel 3★ Paris 15e</h3>
                <p class="text-gray-600 mb-4">Centre ville, accès transports</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 110 €/nuit</div>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Appart meublé Studio Paris</h3>
                <p class="text-gray-600 mb-4">Équipé, wifi, proche métro</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 1 250 €/mois</div>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">2 pièces proche La Défense</h3>
                <p class="text-gray-600 mb-4">Pour professionnels, 2 chambres</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 1 850 €/mois</div>
            </div>
        </div>

        <div class="text-center">
            <a href="#devis"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Trouver un logement
            </a>
        </div>
    </div>
</section>

<!-- Guides & expériences -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Guides & expériences privées</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Guides FR/EN/AR/PT, accès coupe-file selon sites (billets en sus).
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Paris essentiel 4h</h3>
                <p class="text-gray-600 mb-4">Tour Eiffel, Louvre, Opéra, Champs-Élysées</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 190 €</div>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Versailles & jardins</h3>
                <p class="text-gray-600 mb-4">1/2 journée</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 240 €</div>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Châteaux de la Loire</h3>
                <p class="text-gray-600 mb-4">Journée</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 490 €</div>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Bordeaux vins</h3>
                <p class="text-gray-600 mb-4">Journée, dégustations</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 520 €</div>
            </div>

            <div class="pack-card">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Côte d'Azur</h3>
                <p class="text-gray-600 mb-4">Nice–Cannes–Monaco, journée</p>
                <div class="text-2xl font-bold text-yellow-600">Dès 540 €</div>
            </div>
        </div>

        <div class="text-center">
            <a href="#devis"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Choisir une expérience
            </a>
        </div>
    </div>
</section>

<!-- Packs installation -->
<section class="py-16 bg-gradient-to-r from-blue-50 to-blue-100">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Packs "installation douce"</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="pack-card bg-white">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Starter</h3>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-sim-card text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Carte SIM</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-ticket-alt text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Pass Navigo</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-handshake text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>RDV d'accueil</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600">99 €</div>
            </div>

            <div class="pack-card bg-white">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Study</h3>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-sim-card text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Tout le pack Starter +</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-file-contract text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Attestation hébergement</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-heartbeat text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>RDV assurance santé</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600">179 €</div>
            </div>

            <div class="pack-card bg-white">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Pro</h3>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-start">
                        <i class="fas fa-sim-card text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Tout le pack Study +</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-building text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Assistance ouverture compte en ligne</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-users text-blue-600 mt-1 mr-3" aria-hidden="true"></i>
                        <span>Salle réunion 2h</span>
                    </li>
                </ul>
                <div class="text-2xl font-bold text-yellow-600">290 €</div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire devis -->
<section id="devis" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-gray-50 rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-8">Demander un devis conciergerie
                personnalisé</h2>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3" aria-hidden="true"></i>
                    <div>
                        <h4 class="font-bold text-green-800">Demande envoyée</h4>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('conciergerie.store') }}" method="POST" id="conciergerieForm">
                @csrf

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Nom complet *</label>
                            <input type="text" name="nom" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                placeholder="Votre nom et prénom">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                placeholder="votre@email.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Téléphone *</label>
                            <input type="tel" name="telephone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                placeholder="06 12 34 56 78">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Motif du voyage *</label>
                            <select name="motif_voyage" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Sélectionnez un motif</option>
                                <option value="tourisme">Tourisme</option>
                                <option value="affaires">Affaires / Business</option>
                                <option value="formation">Formation / Études</option>
                                <option value="installation">Installation en France</option>
                                <option value="familial">Visite familiale</option>
                                <option value="evenementiel">Événementiel</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Date d'arrivée *</label>
                            <input type="date" name="date_arrivee" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Durée du séjour *</label>
                            <select name="duree_sejour" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Sélectionnez la durée</option>
                                <option value="1-3">1-3 jours</option>
                                <option value="4-7">4-7 jours</option>
                                <option value="1-2">1-2 semaines</option>
                                <option value="3-4">3-4 semaines</option>
                                <option value="1-3">1-3 mois</option>
                                <option value="3-6">3-6 mois</option>
                                <option value="6+">Plus de 6 mois</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Nombre de personnes *</label>
                            <select name="nombre_personnes" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Sélectionnez</option>
                                <option value="1">1 personne</option>
                                <option value="2">2 personnes</option>
                                <option value="3-4">3-4 personnes</option>
                                <option value="5-6">5-6 personnes</option>
                                <option value="7+">Plus de 6 personnes</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 mb-2 font-medium">Budget estimé (en €)</label>
                            <select name="budget"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                <option value="">Sélectionnez une fourchette</option>
                                <option value="500-1000">500 - 1 000 €</option>
                                <option value="1000-2000">1 000 - 2 000 €</option>
                                <option value="2000-5000">2 000 - 5 000 €</option>
                                <option value="5000-10000">5 000 - 10 000 €</option>
                                <option value="10000+">Plus de 10 000 €</option>
                                <option value="sur_devis">Sur devis</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Type d'accompagnement souhaité *</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div
                                class="flex items-center p-4 border border-gray-300 rounded-lg hover:border-yellow-500 cursor-pointer bg-white">
                                <input type="radio" id="accomp_chauffeur" name="type_accompagnement" value="chauffeur"
                                    class="mr-3" onchange="showRedirectionInfo('chauffeur')">
                                <label for="accomp_chauffeur" class="cursor-pointer">
                                    <span class="font-medium">Avec chauffeur</span>
                                    <p class="text-sm text-gray-600 mt-1">Service VTC/Chauffeur privé</p>
                                </label>
                            </div>

                            <div
                                class="flex items-center p-4 border border-gray-300 rounded-lg hover:border-yellow-500 cursor-pointer bg-white">
                                <input type="radio" id="accomp_location" name="type_accompagnement" value="location"
                                    class="mr-3" onchange="showRedirectionInfo('location')">
                                <label for="accomp_location" class="cursor-pointer">
                                    <span class="font-medium">Location de voiture</span>
                                    <p class="text-sm text-gray-600 mt-1">Sans chauffeur</p>
                                </label>
                            </div>

                            <div
                                class="flex items-center p-4 border border-gray-300 rounded-lg hover:border-yellow-500 cursor-pointer bg-white">
                                <input type="radio" id="accomp_mixte" name="type_accompagnement" value="mixte"
                                    class="mr-3" onchange="showRedirectionInfo('mixte')">
                                <label for="accomp_mixte" class="cursor-pointer">
                                    <span class="font-medium">Mixte</span>
                                    <p class="text-sm text-gray-600 mt-1">Chauffeur + location</p>
                                </label>
                            </div>
                        </div>

                        <div id="redirectionInfo"
                            class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg hidden">
                            <p class="text-yellow-800">
                                <i class="fas fa-info-circle mr-2" aria-hidden="true"></i>
                                <span id="redirectionText"></span>
                                <a id="redirectionLink" href="#" class="font-semibold underline ml-1"></a>
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Services souhaités</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach([
                            'Transfert aéroport/gare', 'Location voiture', 'Hébergement',
                            'Guide touristique', 'Assistance administrative', 'Services business',
                            'Installation/logement', 'Courses arrivée', 'Interprète/traduction',
                            'Billets spectacles', 'Réservation restaurants', 'Service ménage'
                            ] as $service)
                            <label class="flex items-center p-2 border border-gray-200 rounded hover:bg-yellow-50">
                                <input type="checkbox" name="services[]" value="{{ $service }}"
                                    class="mr-2 rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                                <span class="text-sm">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2 font-medium">Message / Besoins spécifiques *</label>
                        <textarea name="message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                            placeholder="Décrivez vos besoins en détail, vos attentes particulières, vos contraintes..."></textarea>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-600 mb-6">
                            <i class="fas fa-shield-alt text-yellow-600 mr-2" aria-hidden="true"></i>
                            Votre demande sera traitée sous 24h maximum. Nous vous enverrons un devis personnalisé.
                        </p>

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                            <i class="fas fa-paper-plane mr-3" aria-hidden="true"></i>Envoyer ma demande de devis
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Contact rapide -->
        <div id="contact" class="mt-12 max-w-4xl mx-auto bg-gray-900 text-white rounded-2xl p-8">
            <h3 class="text-2xl font-bold mb-6 text-center">Contact rapide</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                        <i class="fas fa-phone-alt text-white text-xl" aria-hidden="true"></i>
                    </div>
                    <p class="font-semibold">Téléphone</p>
                    <a href="tel:0176380017" class="text-yellow-400 hover:text-yellow-300">01 76 38 00 17</a>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                        <i class="fas fa-whatsapp text-white text-xl" aria-hidden="true"></i>
                    </div>
                    <p class="font-semibold">WhatsApp</p>
                    <p class="text-yellow-400">Disponible 24h/24</p>
                </div>

                <div class="text-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                        <i class="fas fa-envelope text-white text-xl" aria-hidden="true"></i>
                    </div>
                    <p class="font-semibold">Email</p>
                    <a href="mailto:conciergerie@djokprestige.com"
                        class="text-yellow-400 hover:text-yellow-300">conciergerie@djokprestige.com</a>
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

        // Auto-hide du message de succès
        const successMessage = document.querySelector('.bg-green-50');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
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

        // Définir la date minimum pour le champ date d'arrivée (aujourd'hui)
        const today = new Date().toISOString().split('T')[0];
        document.querySelector('input[name="date_arrivee"]').min = today;
    });

    function showRedirectionInfo(type) {
        const infoDiv = document.getElementById('redirectionInfo');
        const textSpan = document.getElementById('redirectionText');
        const link = document.getElementById('redirectionLink');
        
        infoDiv.classList.remove('hidden');
        
        switch(type) {
            case 'chauffeur':
                textSpan.textContent = 'Pour un service avec chauffeur, consultez notre page';
                link.textContent = 'VTC & Transport';
                link.href = "{{ route('vtc-transport') }}";
                break;
            case 'location':
                textSpan.textContent = 'Pour louer un véhicule sans chauffeur, visitez notre page';
                link.textContent = 'Location de voiture';
                link.href = "{{ route('location') }}";
                break;
            case 'mixte':
                textSpan.textContent = 'Pour combiner chauffeur et location, nous vous conseillons de consulter nos deux pages :';
                link.textContent = 'VTC & Location';
                link.href = "#";
                link.onclick = function(e) {
                    e.preventDefault();
                    window.open("{{ route('vtc-transport') }}", '_blank');
                    setTimeout(() => {
                        window.open("{{ route('location') }}", '_blank');
                    }, 500);
                };
                break;
        }
    }

    // Gestion de la soumission du formulaire
    document.getElementById('conciergerieForm').addEventListener('submit', function(e) {
        // Vérification que le type d'accompagnement est sélectionné
        const typeAccompagnement = document.querySelector('input[name="type_accompagnement"]:checked');
        if (!typeAccompagnement) {
            e.preventDefault();
            alert('Veuillez sélectionner un type d\'accompagnement.');
            return false;
        }
        
        // Validation des cases à cocher services
        const services = document.querySelectorAll('input[name="services[]"]:checked');
        if (services.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins un service souhaité.');
            return false;
        }
        
        return true;
    });
</script>
@endsection