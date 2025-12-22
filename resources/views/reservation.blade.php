@extends('layouts.main')

@section('title', 'VTC & Transport - DJOK PRESTIGE')

@section('content')
<style>
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<!-- Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80"
            alt="VTC Transport" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                DJOK PRESTIGE VTC – Le transport haut de gamme à votre service
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12">
                Offrez-vous une expérience de transport alliant confort, sécurité et ponctualité, que ce soit pour vos
                déplacements personnels, professionnels ou événementiels.
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#reservation"
                    class="w-full sm:w-auto px-6 md:px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    Réserver un trajet maintenant
                </a>
                <a href="#devis-entreprise"
                    class="w-full sm:w-auto px-6 md:px-8 py-3 font-semibold text-center border transition duration-300"
                    style="border-color: var(--gold); color: var(--gold);">
                    Demander un devis entreprise
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#services" class="text-white transition duration-300 hover:text-var(--gold)">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Nos services de transport - Style sobre -->
<section id="services" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Nos services de transport</h2>
        </div>

        <!-- Transferts aéroports & gares -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center mb-12">
                <div>
                    <h3 class="text-2xl md:text-3xl font-semibold mb-6" style="color: white;">Transferts aéroports &
                        gares</h3>
                    <p class="text-gray-400 mb-6">
                        Nous assurons vos transferts vers et depuis tous les aéroports et gares de France (Orly, CDG,
                        Beauvais, Lyon, Marseille, Lille, Bordeaux…).
                    </p>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Accueil personnalisé avec pancarte nominative</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Suivi en temps réel des vols / trains</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Attente gratuite en cas de retard</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Véhicules confortables et climatisés</span>
                        </li>
                    </ul>

                    <a href="#reservation-transferts"
                        class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                        style="background: var(--gold); color: black;">
                        Réserver mon transfert
                    </a>
                </div>

                <div class="p-6 md:p-8" style="background: #111; border: 1px solid #333;">
                    <h4 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Trajets populaires :</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 rounded"
                            style="background: #1a1a1a; color: white;">
                            <span class="font-medium">Paris → Aéroport CDG</span>
                            <span class="font-bold" style="color: var(--gold);">À partir de 60 €</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded"
                            style="background: #1a1a1a; color: white;">
                            <span class="font-medium">Paris → Aéroport Orly</span>
                            <span class="font-bold" style="color: var(--gold);">À partir de 45 €</span>
                        </div>
                        <div class="flex justify-between items-center p-3 rounded"
                            style="background: #1a1a1a; color: white;">
                            <span class="font-medium">Paris → Gare du Nord</span>
                            <span class="font-bold" style="color: var(--gold);">À partir de 35 €</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Déplacements professionnels -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="text-2xl md:text-3xl font-semibold mb-6" style="color: white;">Déplacements
                        professionnels</h3>
                    <p class="text-gray-400 mb-6">
                        Déplacez-vous sereinement pour vos rendez-vous, séminaires ou missions.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-file-invoice-dollar mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Facturation simplifiée pour entreprises</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar-day mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Forfaits journaliers disponibles</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user-tie mr-3" style="color: var(--gold);"></i>
                            <span style="color: white;">Services VIP et contrats B2B sur mesure</span>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 p-6 md:p-8" style="background: #111; border: 1px solid #333;">
                    <h4 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Avantages entreprises :</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-building mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Facture mensuelle unique</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-users mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Compte multi-utilisateurs</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-chart-line mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Rapports d'utilisation mensuels</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Événements privés & mariages -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
                <div>
                    <h3 class="text-2xl md:text-3xl font-semibold mb-6" style="color: white;">Événements privés &
                        mariages</h3>
                    <p class="text-gray-400 mb-6">
                        Faites de vos événements un moment d'exception. Chauffeurs élégants, véhicules de prestige.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <i class="fas fa-car mt-1 mr-3" style="color: var(--gold);"></i>
                            <div>
                                <h4 class="font-semibold" style="color: white;">Transfert invités / navettes mariage
                                </h4>
                                <p class="text-sm text-gray-400">Service de navette pour tous vos invités</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-clock mt-1 mr-3" style="color: var(--gold);"></i>
                            <div>
                                <h4 class="font-semibold" style="color: white;">Mise à disposition à la journée</h4>
                                <p class="text-sm text-gray-400">Véhicule dédié pour toute la journée</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-gem mt-1 mr-3" style="color: var(--gold);"></i>
                            <div>
                                <h4 class="font-semibold" style="color: white;">Véhicule décoré selon le thème</h4>
                                <p class="text-sm text-gray-400">Personnalisation selon vos couleurs</p>
                            </div>
                        </div>
                    </div>

                    <a href="#devis-mariage"
                        class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                        style="background: var(--gold); color: black;">
                        Demander un devis mariage
                    </a>
                </div>

                <div class="p-6 md:p-8" style="background: #111; border: 1px solid #333;">
                    <h4 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Pack Mariage :</h4>
                    <div class="space-y-4">
                        <div class="p-4 rounded" style="background: #1a1a1a; color: white;">
                            <h5 class="font-bold mb-2">Pack Prestige</h5>
                            <p class="text-gray-400 text-sm mb-2">Pour un mariage inoubliable</p>
                            <div class="text-xl font-bold" style="color: var(--gold);">À partir de 490 €</div>
                        </div>
                        <p class="text-sm text-gray-400">
                            Inclut : Véhicule prestige, chauffeur en tenue, décoration personnalisée.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mise à disposition horaire ou journalière -->
        <div class="mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <h3 class="text-2xl md:text-3xl font-semibold mb-6" style="color: white;">Mise à disposition horaire
                        ou journalière</h3>
                    <p class="text-gray-400 mb-6">
                        Besoin d'un chauffeur privé pour plusieurs heures ? Nos forfaits flexibles s'adaptent à vos
                        besoins.
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="p-4 rounded" style="background: #111; border: 1px solid #333; color: white;">
                            <h4 class="font-bold mb-2">Demi-journée</h4>
                            <p class="text-gray-400 text-sm">4 heures de service</p>
                            <div class="text-lg font-bold" style="color: var(--gold);">À partir de 150 €</div>
                        </div>
                        <div class="p-4 rounded" style="background: #111; border: 1px solid #333; color: white;">
                            <h4 class="font-bold mb-2">Journée complète</h4>
                            <p class="text-gray-400 text-sm">8 heures de service</p>
                            <div class="text-lg font-bold" style="color: var(--gold);">À partir de 280 €</div>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 p-6 md:p-8" style="background: #111; border: 1px solid #333;">
                    <h4 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Idéal pour :</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <i class="fas fa-landmark mr-3" style="color: #10b981;"></i>
                            <span style="color: white;">Visites touristiques</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-shopping-bag mr-3" style="color: #10b981;"></i>
                            <span style="color: white;">Shopping de luxe</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-briefcase mr-3" style="color: #10b981;"></i>
                            <span style="color: white;">Tournées clients</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-road mr-3" style="color: #10b981;"></i>
                            <span style="color: white;">Déplacements interurbains</span>
                        </li>
                    </ul>

                    <div class="mt-6">
                        <a href="#devis-horaire"
                            class="inline-flex items-center px-6 py-2 font-semibold transition-all duration-300"
                            style="background: var(--gold); color: black;">
                            Demander un devis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Options et confort à bord - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Options et confort à bord</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
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
                <div class="w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-full mb-3 md:mb-4"
                    style="background: #1a1a1a; border: 1px solid #333;">
                    <i class="{{ $option[1] }}" style="color: var(--gold); font-size: 1.25rem;"></i>
                </div>
                <span class="text-xs md:text-sm font-medium" style="color: white;">{{ $option[0] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tarification transparente - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Tarification transparente</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                DJOK PRESTIGE garantit des prix fixes, sans surprise.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full" style="background: #111; border: 1px solid #333;">
                <thead>
                    <tr style="background: #000;">
                        <th class="py-3 px-4 md:px-6 text-left text-white">Trajet</th>
                        <th class="py-3 px-4 md:px-6 text-center text-white">Éco</th>
                        <th class="py-3 px-4 md:px-6 text-center text-white">Business</th>
                        <th class="py-3 px-4 md:px-6 text-center text-white">Prestige</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b" style="border-color: #333; color: white;">
                        <td class="py-3 px-4 md:px-6 font-semibold">Paris → Orly</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">45 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">65 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">90 €</td>
                    </tr>
                    <tr class="border-b" style="border-color: #333; color: white;">
                        <td class="py-3 px-4 md:px-6 font-semibold">Paris → CDG</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">60 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">80 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">110 €</td>
                    </tr>
                    <tr class="border-b" style="border-color: #333; color: white;">
                        <td class="py-3 px-4 md:px-6 font-semibold">Paris → La Défense</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">40 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">60 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">85 €</td>
                    </tr>
                    <tr style="color: white;">
                        <td class="py-3 px-4 md:px-6 font-semibold">Paris → Versailles</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">55 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">75 €</td>
                        <td class="py-3 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">100 €</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-4 md:p-6 rounded" style="background: #111; border: 1px solid #333;">
                <h4 class="text-lg font-bold mb-2" style="color: white;">Véhicule Éco</h4>
                <p class="text-sm text-gray-400 mb-4">Toyota Prius, Renault Talisman</p>
                <p class="text-gray-300">Idéal pour les déplacements quotidiens</p>
            </div>
            <div class="p-4 md:p-6 rounded" style="background: #111; border: 1px solid #333;">
                <h4 class="text-lg font-bold mb-2" style="color: white;">Véhicule Business</h4>
                <p class="text-sm text-gray-400 mb-4">Mercedes Classe C, Audi A4</p>
                <p class="text-gray-300">Parfait pour les rendez-vous professionnels</p>
            </div>
            <div class="p-4 md:p-6 rounded" style="background: #111; border: 1px solid #333;">
                <h4 class="text-lg font-bold mb-2" style="color: white;">Véhicule Prestige</h4>
                <p class="text-sm text-gray-400 mb-4">Mercedes Classe E, BMW Série 5</p>
                <p class="text-gray-300">Pour les événements spéciaux et VIP</p>
            </div>
        </div>
    </div>
</section>

<!-- Sections réservation et devis - Style sobre -->
<section id="reservation" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
                <!-- Formulaire de réservation -->
                <div id="reservation-transferts" class="p-6 md:p-8"
                    style="background: #1a1a1a; border: 1px solid #333;">
                    <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Réserver votre trajet
                    </h2>

                    @if(session('success'))
                    <div class="p-4 mb-6" style="background: #064e3b; border: 1px solid #047857;">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3" style="color: #a7f3d0;"></i>
                            <div>
                                <h4 class="font-bold text-white">Réservation envoyée</h4>
                                <p class="text-green-100">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3" style="color: #fca5a5;"></i>
                            <div>
                                <h4 class="font-bold text-white">Erreur</h4>
                                <p class="text-red-100">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-3" style="color: #fca5a5;"></i>
                            <div>
                                <h4 class="font-bold text-white">Veuillez corriger les erreurs suivantes :</h4>
                                <ul class="text-red-100 list-disc ml-4">
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
                                <label class="block mb-2 font-medium" style="color: #ddd;">Type de service *</label>
                                <select name="type_service" required class="w-full px-4 py-3 rounded"
                                    style="background: #111; border: 1px solid #444; color: white;">
                                    <option value="" style="color: #666;">Sélectionnez un service</option>
                                    <option value="transfert" {{ old('type_service')=='transfert' ? 'selected' : '' }}
                                        style="color: white;">
                                        Transfert aéroport/gare</option>
                                    <option value="professionnel" {{ old('type_service')=='professionnel' ? 'selected'
                                        : '' }} style="color: white;">
                                        Déplacement professionnel</option>
                                    <option value="evenement" {{ old('type_service')=='evenement' ? 'selected' : '' }}
                                        style="color: white;">
                                        Événement/mariage</option>
                                    <option value="mise_disposition" {{ old('type_service')=='mise_disposition'
                                        ? 'selected' : '' }} style="color: white;">
                                        Mise à disposition</option>
                                </select>
                            </div>

                            <!-- Informations du trajet -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Lieu de départ *</label>
                                    <input type="text" name="depart" required value="{{ old('depart') }}"
                                        class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        placeholder="Adresse, aéroport ou gare">
                                </div>

                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Lieu d'arrivée *</label>
                                    <input type="text" name="arrivee" required value="{{ old('arrivee') }}"
                                        class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        placeholder="Adresse, aéroport ou gare">
                                </div>
                            </div>

                            <!-- Date et heure -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Date *</label>
                                    <input type="date" name="date" required value="{{ old('date') }}"
                                        class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        min="{{ date('Y-m-d') }}">
                                </div>

                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Heure *</label>
                                    <input type="time" name="heure" required value="{{ old('heure') }}"
                                        class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;">
                                </div>
                            </div>

                            <!-- Véhicule et passagers -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Type de véhicule
                                        *</label>
                                    <select name="type_vehicule" required class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;">
                                        <option value="" style="color: #666;">Choisir un véhicule</option>
                                        <option value="eco" {{ old('type_vehicule')=='eco' ? 'selected' : '' }}
                                            style="color: white;">
                                            Véhicule Éco</option>
                                        <option value="business" {{ old('type_vehicule')=='business' ? 'selected' : ''
                                            }} style="color: white;">
                                            Véhicule Business</option>
                                        <option value="prestige" {{ old('type_vehicule')=='prestige' ? 'selected' : ''
                                            }} style="color: white;">
                                            Véhicule Prestige</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Nombre de passagers
                                        *</label>
                                    <select name="passagers" required class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;">
                                        <option value="" style="color: #666;">Nombre de personnes</option>
                                        <option value="1" {{ old('passagers')=='1' ? 'selected' : '' }}
                                            style="color: white;">
                                            1 personne</option>
                                        <option value="2" {{ old('passagers')=='2' ? 'selected' : '' }}
                                            style="color: white;">
                                            2 personnes</option>
                                        <option value="3" {{ old('passagers')=='3' ? 'selected' : '' }}
                                            style="color: white;">
                                            3 personnes</option>
                                        <option value="4" {{ old('passagers')=='4' ? 'selected' : '' }}
                                            style="color: white;">
                                            4 personnes</option>
                                        <option value="5+" {{ old('passagers')=='5+' ? 'selected' : '' }}
                                            style="color: white;">
                                            5+ personnes</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Informations personnelles -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Nom complet *</label>
                                    <input type="text" name="nom" required value="{{ old('nom') }}"
                                        class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;">
                                </div>

                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Téléphone *</label>
                                    <input type="tel" name="telephone" required value="{{ old('telephone') }}"
                                        class="w-full px-4 py-3 rounded"
                                        style="background: #111; border: 1px solid #444; color: white;">
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 font-medium" style="color: #ddd;">Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                    class="w-full px-4 py-3 rounded"
                                    style="background: #111; border: 1px solid #444; color: white;">
                            </div>

                            <div>
                                <label class="block mb-2 font-medium" style="color: #ddd;">Instructions
                                    supplémentaires</label>
                                <textarea name="instructions" rows="3" class="w-full px-4 py-3 rounded"
                                    style="background: #111; border: 1px solid #444; color: white;"
                                    placeholder="Informations spécifiques pour le chauffeur...">{{ old('instructions') }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full inline-flex items-center justify-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                                style="background: var(--gold); color: black;">
                                <i class="fas fa-paper-plane mr-3"></i>Envoyer ma réservation
                            </button>

                            <p class="text-sm text-center mt-4" style="color: #888;">
                                En cliquant sur "Envoyer ma réservation", vous acceptez nos
                                <a href="{{ route('cgu') }}" class="hover:text-gray-300"
                                    style="color: var(--gold);">CGU</a>
                                et notre
                                <a href="{{ route('rgpd') }}" class="hover:text-gray-300"
                                    style="color: var(--gold);">Politique de Confidentialité</a>.
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Devis et contact -->
                <div>
                    <!-- Devis entreprise -->
                    <div id="devis-entreprise" class="p-6 md:p-8 mb-8"
                        style="background: #1a1a1a; border: 1px solid #333;">
                        <h3 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Devis entreprise</h3>
                        <p class="text-gray-400 mb-6">Vous représentez une entreprise ? Demandez un devis personnalisé.
                        </p>
                        <a href="{{ route('contact') }}?type=entreprise"
                            class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                            style="background: #111; color: white; border: 1px solid #333;">
                            <i class="fas fa-building mr-3"></i>Demander un devis entreprise
                        </a>
                    </div>

                    <!-- Devis mariage -->
                    <div id="devis-mariage" class="p-6 md:p-8 mb-8"
                        style="background: #1a1a1a; border: 1px solid #333;">
                        <h3 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Devis mariage</h3>
                        <p class="text-gray-400 mb-6">Organisez votre mariage ? Demandez un devis pour nos services.</p>
                        <a href="{{ route('contact') }}?type=mariage"
                            class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                            style="background: #111; color: white; border: 1px solid #333;">
                            <i class="fas fa-heart mr-3"></i>Demander un devis mariage
                        </a>
                    </div>

                    <!-- Devis horaire -->
                    <div id="devis-horaire" class="p-6 md:p-8 mb-8"
                        style="background: #1a1a1a; border: 1px solid #333;">
                        <h3 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Devis mise à disposition
                        </h3>
                        <p class="text-gray-400 mb-6">Besoin d'un chauffeur pour plusieurs heures ?</p>
                        <a href="{{ route('contact') }}?type=horaire"
                            class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                            style="background: #111; color: white; border: 1px solid #333;">
                            <i class="fas fa-clock mr-3"></i>Demander un devis horaire
                        </a>
                    </div>

                    <!-- Contact -->
                    <div class="p-6 md:p-8" style="background: #000; border: 1px solid #333; color: white;">
                        <h3 class="text-lg md:text-xl font-bold mb-4">Contact rapide</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-phone-alt mr-4" style="color: var(--gold);"></i>
                                <div>
                                    <p class="font-semibold">Téléphone</p>
                                    <a href="tel:0176380017" class="hover:text-yellow-400 transition duration-300">01 76
                                        38 00 17</a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-4" style="color: var(--gold);"></i>
                                <div>
                                    <p class="font-semibold">Email</p>
                                    <a href="mailto:vtc@djokprestige.com"
                                        class="hover:text-yellow-400 transition duration-300">vtc@djokprestige.com</a>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-4" style="color: var(--gold);"></i>
                                <div>
                                    <p class="font-semibold">Horaires</p>
                                    <p>24h/24 - 7j/7</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-4" style="color: var(--gold);"></i>
                                <div>
                                    <p class="font-semibold">Zone d'intervention</p>
                                    <p>Paris, Île-de-France & France entière</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6" style="border-top: 1px solid #333;">
                            <h4 class="font-semibold mb-3">Moyens de paiement acceptés :</h4>
                            <div class="flex items-center space-x-4">
                                <i class="fas fa-credit-card text-gray-300"></i>
                                <i class="fab fa-cc-visa text-gray-300"></i>
                                <i class="fab fa-cc-mastercard text-gray-300"></i>
                                <i class="fas fa-money-bill-wave text-gray-300"></i>
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
        const successMessage = document.querySelector('[class*="bg-green"]');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 8000);
        }

        // Auto-hide du message d'erreur
        const errorMessage = document.querySelector('[class*="bg-red"]');
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

        // Set minimum date for date input
        const dateInput = document.querySelector('input[name="date"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        }

        // Form validation enhancement
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#f87171';
                    } else {
                        field.style.borderColor = '#444';
                    }
                });

                // Validation spécifique pour l'email
                const emailField = form.querySelector('input[name="email"]');
                if (emailField && emailField.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(emailField.value)) {
                        isValid = false;
                        emailField.style.borderColor = '#f87171';
                    }
                }

                // Validation de la date
                const dateField = form.querySelector('input[name="date"]');
                if (dateField && dateField.value) {
                    const selectedDate = new Date(dateField.value);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (selectedDate < today) {
                        isValid = false;
                        dateField.style.borderColor = '#f87171';
                        alert('La date doit être aujourd\'hui ou une date future.');
                    }
                }

                // Validation de l'heure
                const timeField = form.querySelector('input[name="heure"]');
                if (timeField && timeField.value) {
                    const timeRegex = /^([01]\d|2[0-3]):([0-5]\d)$/;
                    if (!timeRegex.test(timeField.value)) {
                        isValid = false;
                        timeField.style.borderColor = '#f87171';
                    }
                }

                if (!isValid) {
                    e.preventDefault();

                    // Scroll to first error
                    const firstError = form.querySelector('[style*="border-color: #f87171"]');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                }
            });

            // Reset field styles on input
            form.querySelectorAll('input, select, textarea').forEach(field => {
                field.addEventListener('input', function() {
                    this.style.borderColor = '#444';
                });
            });
        }

        // Auto-format du téléphone (optionnel)
        const phoneInput = document.querySelector('input[name="telephone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                e.target.value = value;
            });
        }
    });
</script>
@endsection
