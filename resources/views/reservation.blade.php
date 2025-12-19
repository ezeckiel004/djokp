@extends('layouts.main')

@section('title', 'VTC & Transport - DJOK PRESTIGE')

@section('content')
<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)),
            url('https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover no-repeat;
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

    .tariff-card {
        @apply bg-gray-50 rounded-lg p-6 border border-gray-200 transition-all duration-300 hover: border-yellow-400 hover:bg-white;
    }
</style>

<!-- Hero Section -->
<header class="hero-bg relative min-h-screen flex items-center">
    <div class="container mx-auto px-6 py-20">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8 fade-in">
                DJOK PRESTIGE VTC – Le transport haut de gamme à votre service
            </h1>

            <p class="text-xl text-white mb-12 fade-in" style="transition-delay: 0.2s;">
                Offrez-vous une expérience de transport alliant confort, sécurité et ponctualité, que ce soit pour vos
                déplacements personnels, professionnels ou événementiels. Nos chauffeurs expérimentés, discrets et
                formés dans notre propre centre agréé, vous garantissent un service hautement qualitatif, digne des
                standards les plus exigeants.
            </p>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center fade-in" style="transition-delay: 0.4s;">
                <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <a href="#reservation"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                        Réserver un trajet maintenant
                    </a>
                    <a href="#devis-entreprise"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                        Demander un devis entreprise
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#services" class="text-white transition duration-300 hover:text-yellow-400">
            <i class="text-2xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Nos services de transport -->
<section id="services" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos services de transport</h2>
        </div>

        <!-- Transferts aéroports & gares -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-12">
                <div>
                    <h3 class="text-3xl font-semibold text-gray-800 mb-6">Transferts aéroports & gares</h3>
                    <p class="text-gray-600 mb-6">
                        Nous assurons vos transferts vers et depuis tous les aéroports et gares de France (Orly, CDG,
                        Beauvais, Lyon, Marseille, Lille, Bordeaux…).
                    </p>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-600 text-lg mt-1 mr-3"></i>
                            <span>Accueil personnalisé avec pancarte nominative</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-600 text-lg mt-1 mr-3"></i>
                            <span>Suivi en temps réel des vols / trains</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-600 text-lg mt-1 mr-3"></i>
                            <span>Attente gratuite en cas de retard</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-600 text-lg mt-1 mr-3"></i>
                            <span>Véhicules confortables et climatisés</span>
                        </li>
                    </ul>

                    <a href="#reservation-transferts"
                        class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                        Réserver mon transfert
                    </a>
                </div>

                <div class="bg-gray-100 rounded-xl p-8">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Trajets populaires :</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                            <span class="font-medium">Paris → Aéroport CDG</span>
                            <span class="font-bold text-yellow-600">À partir de 60 €</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                            <span class="font-medium">Paris → Aéroport Orly</span>
                            <span class="font-bold text-yellow-600">À partir de 45 €</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-white rounded-lg">
                            <span class="font-medium">Paris → Gare du Nord</span>
                            <span class="font-bold text-yellow-600">À partir de 35 €</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Déplacements professionnels -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-6">Déplacements professionnels</h3>
                    <p class="text-gray-600 mb-6">
                        Déplacez-vous sereinement pour vos rendez-vous, séminaires ou missions. Nos chauffeurs
                        connaissent parfaitement les grands centres d'affaires et garantissent ponctualité et
                        discrétion.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-file-invoice-dollar text-yellow-600 text-xl mr-3"></i>
                            <span>Facturation simplifiée pour entreprises</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day text-yellow-600 text-xl mr-3"></i>
                            <span>Forfaits journaliers disponibles</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-tie text-yellow-600 text-xl mr-3"></i>
                            <span>Services VIP et contrats B2B sur mesure</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-8">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Avantages entreprises :</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-building text-blue-600 mr-3"></i>
                            <span>Facture mensuelle unique</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-users text-blue-600 mr-3"></i>
                            <span>Compte multi-utilisateurs</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                            <span>Rapports d'utilisation mensuels</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Événements privés & mariages -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-semibold text-gray-800 mb-6">Événements privés & mariages</h3>
                    <p class="text-gray-600 mb-6">
                        Faites de vos événements un moment d'exception. Chauffeurs élégants, véhicules de prestige et
                        service personnalisé pour vos invités.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-car text-yellow-600 text-lg mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Transfert invités / navettes mariage</h4>
                                <p class="text-sm text-gray-600">Service de navette pour tous vos invités</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-clock text-yellow-600 text-lg mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Mise à disposition à la journée</h4>
                                <p class="text-sm text-gray-600">Véhicule dédié pour toute la journée</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-gem text-yellow-600 text-lg mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-semibold text-gray-900">Véhicule décoré selon le thème</h4>
                                <p class="text-sm text-gray-600">Personnalisation selon vos couleurs</p>
                            </div>
                        </div>
                    </div>

                    <a href="#devis-mariage"
                        class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                        Demander un devis mariage
                    </a>
                </div>

                <div class="bg-gradient-to-r from-pink-50 to-pink-100 rounded-xl p-8">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Pack Mariage :</h4>
                    <div class="space-y-4">
                        <div class="p-4 bg-white rounded-lg">
                            <h5 class="font-bold text-gray-900 mb-2">Pack Prestige</h5>
                            <p class="text-gray-600 text-sm mb-2">Pour un mariage inoubliable</p>
                            <div class="text-2xl font-bold text-yellow-600">À partir de 490 €</div>
                        </div>
                        <p class="text-sm text-gray-600">
                            Inclut : Véhicule prestige, chauffeur en tenue, décoration personnalisée, bouteille de
                            champagne.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mise à disposition horaire ou journalière -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-6">Mise à disposition horaire ou journalière</h3>
                    <p class="text-gray-600 mb-6">
                        Besoin d'un chauffeur privé pour plusieurs heures ? Nos forfaits flexibles s'adaptent à vos
                        besoins : demi-journée, journée complète ou soirée.
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-bold text-gray-900 mb-2">Demi-journée</h4>
                            <p class="text-gray-600 text-sm">4 heures de service</p>
                            <div class="text-xl font-bold text-yellow-600">À partir de 150 €</div>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-bold text-gray-900 mb-2">Journée complète</h4>
                            <p class="text-gray-600 text-sm">8 heures de service</p>
                            <div class="text-xl font-bold text-yellow-600">À partir de 280 €</div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 bg-gradient-to-r from-green-50 to-green-100 rounded-xl p-8">
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Idéal pour :</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-landmark text-green-600 mr-3"></i>
                            <span>Visites touristiques</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-shopping-bag text-green-600 mr-3"></i>
                            <span>Shopping de luxe</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-briefcase text-green-600 mr-3"></i>
                            <span>Tournées clients</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-road text-green-600 mr-3"></i>
                            <span>Déplacements interurbains</span>
                        </li>
                    </ul>

                    <div class="mt-6">
                        <a href="#devis-horaire"
                            class="inline-flex items-center px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                            Demander un devis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Options et confort à bord -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Options et confort à bord</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Pour rendre chaque trajet plus agréable, nos véhicules sont équipés de :
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach([
            ['Climatisation individuelle', 'fas fa-snowflake'],
            ['Wi-Fi gratuit', 'fas fa-wifi'],
            ['Chargeurs multi-appareils', 'fas fa-charging-station'],
            ['Bouteilles d\'eau & lingettes', 'fas fa-wine-bottle'],
            ['Siège bébé / réhausseur sur demande', 'fas fa-baby'],
            ['Paiement CB ou espèces à bord', 'fas fa-credit-card']
            ] as $option)
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 flex items-center justify-center bg-yellow-100 rounded-full mb-4">
                    <i class="{{ $option[1] }} text-yellow-600 text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-900">{{ $option[0] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tarification transparente -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tarification transparente</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                DJOK PRESTIGE garantit des prix fixes, sans surprise. Nos tarifs sont définis à l'avance selon la
                distance et le type de véhicule choisi.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg shadow-lg">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">Trajet</th>
                        <th class="py-4 px-6 text-center">Éco</th>
                        <th class="py-4 px-6 text-center">Business</th>
                        <th class="py-4 px-6 text-center">Prestige</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Paris → Orly</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">45 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">65 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">90 €</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Paris → CDG</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">60 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">80 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">110 €</td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Paris → La Défense</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">40 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">60 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">85 €</td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Paris → Versailles</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">55 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">75 €</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">100 €</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="tariff-card">
                <h4 class="text-lg font-bold text-gray-900 mb-2">Véhicule Éco</h4>
                <p class="text-sm text-gray-600 mb-4">Toyota Prius, Renault Talisman</p>
                <p class="text-gray-700">Idéal pour les déplacements quotidiens</p>
            </div>
            <div class="tariff-card">
                <h4 class="text-lg font-bold text-gray-900 mb-2">Véhicule Business</h4>
                <p class="text-sm text-gray-600 mb-4">Mercedes Classe C, Audi A4</p>
                <p class="text-gray-700">Parfait pour les rendez-vous professionnels</p>
            </div>
            <div class="tariff-card">
                <h4 class="text-lg font-bold text-gray-900 mb-2">Véhicule Prestige</h4>
                <p class="text-sm text-gray-600 mb-4">Mercedes Classe E, BMW Série 5</p>
                <p class="text-gray-700">Pour les événements spéciaux et VIP</p>
            </div>
        </div>
    </div>
</section>

<!-- Sections réservation et devis -->
<section id="reservation" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Formulaire de réservation -->
                <div id="reservation-transferts" class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Réserver votre trajet</h2>

                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                            <div>
                                <h4 class="font-bold text-green-800">Réservation envoyée</h4>
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
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
                            <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                            <div>
                                <h4 class="font-bold text-red-800">Veuillez corriger les erreurs suivantes :</h4>
                                <ul class="text-red-700 list-disc ml-4">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('reservation.submit') }}" method="POST">
                        @csrf

                        <div class="space-y-6">
                            <!-- Type de service -->
                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">Type de service *</label>
                                <select name="type_service" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <option value="">Sélectionnez un service</option>
                                    <option value="transfert" {{ old('type_service')=='transfert' ? 'selected' : '' }}>
                                        Transfert aéroport/gare</option>
                                    <option value="professionnel" {{ old('type_service')=='professionnel' ? 'selected'
                                        : '' }}>Déplacement professionnel</option>
                                    <option value="evenement" {{ old('type_service')=='evenement' ? 'selected' : '' }}>
                                        Événement/mariage</option>
                                    <option value="mise_disposition" {{ old('type_service')=='mise_disposition'
                                        ? 'selected' : '' }}>Mise à disposition</option>
                                </select>
                            </div>

                            <!-- Informations du trajet -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Lieu de départ *</label>
                                    <input type="text" name="depart" required value="{{ old('depart') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        placeholder="Adresse, aéroport ou gare">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Lieu d'arrivée *</label>
                                    <input type="text" name="arrivee" required value="{{ old('arrivee') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        placeholder="Adresse, aéroport ou gare">
                                </div>
                            </div>

                            <!-- Date et heure -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Date *</label>
                                    <input type="date" name="date" required value="{{ old('date') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        min="{{ date('Y-m-d') }}">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Heure *</label>
                                    <input type="time" name="heure" required value="{{ old('heure') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                </div>
                            </div>

                            <!-- Véhicule et passagers -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Type de véhicule *</label>
                                    <select name="type_vehicule" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                        <option value="">Choisir un véhicule</option>
                                        <option value="eco" {{ old('type_vehicule')=='eco' ? 'selected' : '' }}>Véhicule
                                            Éco</option>
                                        <option value="business" {{ old('type_vehicule')=='business' ? 'selected' : ''
                                            }}>Véhicule Business</option>
                                        <option value="prestige" {{ old('type_vehicule')=='prestige' ? 'selected' : ''
                                            }}>Véhicule Prestige</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Nombre de passagers *</label>
                                    <select name="passagers" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                        <option value="">Nombre de personnes</option>
                                        <option value="1" {{ old('passagers')=='1' ? 'selected' : '' }}>1 personne
                                        </option>
                                        <option value="2" {{ old('passagers')=='2' ? 'selected' : '' }}>2 personnes
                                        </option>
                                        <option value="3" {{ old('passagers')=='3' ? 'selected' : '' }}>3 personnes
                                        </option>
                                        <option value="4" {{ old('passagers')=='4' ? 'selected' : '' }}>4 personnes
                                        </option>
                                        <option value="5+" {{ old('passagers')=='5+' ? 'selected' : '' }}>5+ personnes
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Informations personnelles -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Nom complet *</label>
                                    <input type="text" name="nom" required value="{{ old('nom') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                </div>

                                <div>
                                    <label class="block text-gray-700 mb-2 font-medium">Téléphone *</label>
                                    <input type="tel" name="telephone" required value="{{ old('telephone') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                </div>
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2 font-medium">Instructions supplémentaires</label>
                                <textarea name="instructions" rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    placeholder="Informations spécifiques pour le chauffeur...">{{ old('instructions') }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                                <i class="fas fa-paper-plane mr-3"></i>Envoyer ma réservation
                            </button>

                            <p class="text-sm text-gray-500 text-center mt-4">
                                En cliquant sur "Envoyer ma réservation", vous acceptez nos
                                <a href="{{ route('cgu') }}" class="text-yellow-600 hover:text-yellow-700">Conditions
                                    Générales d'Utilisation</a>
                                et notre
                                <a href="{{ route('rgpd') }}" class="text-yellow-600 hover:text-yellow-700">Politique de
                                    Confidentialité</a>.
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Devis et contact -->
                <div>
                    <!-- Devis entreprise -->
                    <div id="devis-entreprise" class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Devis entreprise</h3>
                        <p class="text-gray-600 mb-6">Vous représentez une entreprise ? Demandez un devis personnalisé
                            pour vos besoins en transport professionnel.</p>
                        <a href="{{ route('contact') }}?type=entreprise"
                            class="inline-flex items-center px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-building mr-3"></i>Demander un devis entreprise
                        </a>
                    </div>

                    <!-- Devis mariage -->
                    <div id="devis-mariage" class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Devis mariage</h3>
                        <p class="text-gray-600 mb-6">Organisez votre mariage ? Demandez un devis pour nos services de
                            transport nuptial.</p>
                        <a href="{{ route('contact') }}?type=mariage"
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-pink-500 to-pink-600 text-white font-semibold rounded-lg hover:from-pink-600 hover:to-pink-700 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-heart mr-3"></i>Demander un devis mariage
                        </a>
                    </div>

                    <!-- Devis horaire -->
                    <div id="devis-horaire" class="bg-white rounded-2xl shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Devis mise à disposition</h3>
                        <p class="text-gray-600 mb-6">Besoin d'un chauffeur pour plusieurs heures ? Demandez un devis
                            personnalisé.</p>
                        <a href="{{ route('contact') }}?type=horaire"
                            class="inline-flex items-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-clock mr-3"></i>Demander un devis horaire
                        </a>
                    </div>

                    <!-- Contact -->
                    <div class="mt-8 bg-gray-900 text-white rounded-2xl p-8">
                        <h3 class="text-2xl font-bold mb-4">Contact rapide</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-phone-alt text-yellow-400 text-xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Téléphone</p>
                                    <a href="tel:0176380017" class="hover:text-yellow-400 transition duration-300">01 76
                                        38 00 17</a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-yellow-400 text-xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Email</p>
                                    <a href="mailto:vtc@djokprestige.com"
                                        class="hover:text-yellow-400 transition duration-300">vtc@djokprestige.com</a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-yellow-400 text-xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Horaires</p>
                                    <p>24h/24 - 7j/7</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-yellow-400 text-xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Zone d'intervention</p>
                                    <p>Paris, Île-de-France & France entière</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-700">
                            <h4 class="font-semibold mb-3">Moyens de paiement acceptés :</h4>
                            <div class="flex items-center space-x-4">
                                <i class="fas fa-credit-card text-gray-300"></i>
                                <i class="fab fa-cc-visa text-gray-300"></i>
                                <i class="fab fa-cc-mastercard text-gray-300"></i>
                                <i class="fas fa-money-bill-wave text-gray-300"></i>
                                <i class="fas fa-university text-gray-300"></i>
                            </div>
                        </div>
                    </div>
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

        // Auto-hide du message d'erreur
        const errorMessage = document.querySelector('.bg-red-50');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 10000);
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

        // Set minimum date for date input (sans valeur par défaut)
        const dateInput = document.querySelector('input[name="date"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
            // Pas de valeur par défaut - l'utilisateur doit choisir
        }

        // Pas de valeur par défaut pour l'heure - l'utilisateur doit choisir

        // Form validation enhancement
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                        field.classList.remove('border-gray-300');
                    } else {
                        field.classList.remove('border-red-500');
                        field.classList.add('border-gray-300');
                    }
                });

                // Validation spécifique pour l'email
                const emailField = form.querySelector('input[name="email"]');
                if (emailField && emailField.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(emailField.value)) {
                        isValid = false;
                        emailField.classList.add('border-red-500');
                        emailField.classList.remove('border-gray-300');
                    }
                }

                // Validation de la date (doit être aujourd'hui ou dans le futur)
                const dateField = form.querySelector('input[name="date"]');
                if (dateField && dateField.value) {
                    const selectedDate = new Date(dateField.value);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (selectedDate < today) {
                        isValid = false;
                        dateField.classList.add('border-red-500');
                        dateField.classList.remove('border-gray-300');
                        alert('La date doit être aujourd\'hui ou une date future.');
                    }
                }

                // Validation de l'heure (format HH:MM)
                const timeField = form.querySelector('input[name="heure"]');
                if (timeField && timeField.value) {
                    const timeRegex = /^([01]\d|2[0-3]):([0-5]\d)$/;
                    if (!timeRegex.test(timeField.value)) {
                        isValid = false;
                        timeField.classList.add('border-red-500');
                        timeField.classList.remove('border-gray-300');
                    }
                }

                if (!isValid) {
                    e.preventDefault();

                    // Scroll to first error
                    const firstError = form.querySelector('.border-red-500');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                }
            });

            // Reset field styles on input
            form.querySelectorAll('input, select, textarea').forEach(field => {
                field.addEventListener('input', function() {
                    this.classList.remove('border-red-500', 'border-yellow-500');
                    this.classList.add('border-gray-300');
                });
            });
        }

        // Auto-format du téléphone (optionnel)
        const phoneInput = document.querySelector('input[name="telephone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length > 0) {
                    if (value.length <= 2) {
                        value = value.replace(/^(\d{0,2})/, '$1');
                    } else if (value.length <= 4) {
                        value = value.replace(/^(\d{2})(\d{0,2})/, '$1 $2');
                    } else if (value.length <= 6) {
                        value = value.replace(/^(\d{2})(\d{2})(\d{0,2})/, '$1 $2 $3');
                    } else if (value.length <= 8) {
                        value = value.replace(/^(\d{2})(\d{2})(\d{2})(\d{0,2})/, '$1 $2 $3 $4');
                    } else {
                        value = value.replace(/^(\d{2})(\d{2})(\d{2})(\d{2})(\d{0,2})/, '$1 $2 $3 $4 $5');
                    }
                }

                e.target.value = value;
            });
        }
    });
</script>
@endsection
