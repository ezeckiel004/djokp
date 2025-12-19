@extends('layouts.main')

@section('title', 'Location de Véhicules VTC - DJOK PRESTIGE')

@section('content')
<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)),
            url('https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat;
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

    .vehicle-card {
        @apply bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover: shadow-xl hover:scale-[1.02];
    }

    .offer-card {
        @apply bg-gray-50 rounded-lg p-6 border border-gray-200 transition-all duration-300 hover: border-yellow-400 hover:bg-white;
    }

    .default-car-image {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        width: 100%;
        height: 12rem;
        /* h-48 = 12rem */
        position: relative;
    }

    .default-car-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Modal styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-overlay.active {
        display: flex;
        animation: fadeIn 0.3s ease-out;
    }

    .modal-container {
        background: white;
        border-radius: 16px;
        width: 100%;
        max-width: 900px;
        max-height: 90vh;
        overflow-y: auto;
        transform: translateY(20px);
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    .modal-overlay.active .modal-container {
        transform: translateY(0);
        opacity: 1;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .vehicle-detail-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
    }
</style>

<!-- Hero Section -->
<header class="hero-bg relative min-h-screen flex items-center">
    <div class="container mx-auto px-6 py-20">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8 fade-in">
                Louez votre véhicule VTC haut de gamme avec DJOK PRESTIGE
            </h1>

            <p class="text-xl text-white mb-12 fade-in" style="transition-delay: 0.2s;">
                Vous cherchez un véhicule pour travailler, voyager ou simplement profiter du confort d'une voiture
                premium ? DJOK PRESTIGE met à votre disposition une flotte de véhicules récents, entretenus et assurés,
                disponibles à la journée, à la semaine ou au mois, avec ou sans chauffeur. Que vous soyez chauffeur VTC,
                entrepreneur, ou particulier exigeant, nous avons la solution adaptée à vos besoins.
            </p>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center fade-in" style="transition-delay: 0.4s;">
                <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <a href="#flotte"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                        Voir les véhicules disponibles
                    </a>
                    <a href="#devis"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                        Demander un devis personnalisé
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#offres" class="text-white transition duration-300 hover:text-yellow-400">
            <i class="text-2xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Nos offres de location -->
<section id="offres" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos offres de location</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Découvrez nos formules flexibles, pensées pour s'adapter à votre activité et à votre budget.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg shadow-lg">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">Formule</th>
                        <th class="py-4 px-6 text-center">Durée</th>
                        <th class="py-4 px-6 text-center">Public visé</th>
                        <th class="py-4 px-6 text-center">Inclus</th>
                        <th class="py-4 px-6 text-center">Tarif TTC</th>
                        <th class="py-4 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Location courte durée</td>
                        <td class="py-4 px-6 text-center">1 à 7 jours</td>
                        <td class="py-4 px-6 text-center">Particuliers / Chauffeurs VTC occasionnels</td>
                        <td class="py-4 px-6 text-center">Assurance + Entretien + Assistance</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">Dès 100 €/jour</td>
                        <td class="py-4 px-6 text-center">
                            <a href="#reservation"
                                class="inline-flex items-center px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 text-sm">
                                Réserver
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Location moyenne durée</td>
                        <td class="py-4 px-6 text-center">1 à 4 semaines</td>
                        <td class="py-4 px-6 text-center">Chauffeurs VTC actifs ou entreprises</td>
                        <td class="py-4 px-6 text-center">Assurance + Maintenance + Véhicule de remplacement</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">Dès 280 €/semaine</td>
                        <td class="py-4 px-6 text-center">
                            <a href="#reservation"
                                class="inline-flex items-center px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 text-sm">
                                Réserver
                            </a>
                        </td>
                    </tr>
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Location longue durée (LLD)</td>
                        <td class="py-4 px-6 text-center">1 à 12 mois</td>
                        <td class="py-4 px-6 text-center">Chauffeurs indépendants / Flottes d'entreprises</td>
                        <td class="py-4 px-6 text-center">Assurance, révision, pneus, véhicule de prêt</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">Dès 790 €/mois</td>
                        <td class="py-4 px-6 text-center">
                            <a href="#reservation"
                                class="inline-flex items-center px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 text-sm">
                                Réserver
                            </a>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">Location avec chauffeur</td>
                        <td class="py-4 px-6 text-center">Sur demande</td>
                        <td class="py-4 px-6 text-center">Événements / Transferts / VIP</td>
                        <td class="py-4 px-6 text-center">Véhicule + Chauffeur professionnel + Service personnalisé</td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">Sur devis</td>
                        <td class="py-4 px-6 text-center">
                            <a href="#devis"
                                class="inline-flex items-center px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 text-sm">
                                Demander devis
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row gap-6 justify-center">
            <a href="#reservation"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Réserver maintenant
            </a>
            <a href="#simulation"
                class="inline-flex items-center px-12 py-4 bg-gray-900 text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
                Obtenir une simulation
            </a>
        </div>
    </div>
</section>

<!-- Notre flotte de véhicules premium -->
<section id="flotte" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Notre flotte de véhicules premium</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">Catégories de véhicules disponibles</p>
        </div>

        <!-- Véhicules économiques -->
        <div class="mb-16">
            <h3 class="mb-8 text-3xl font-semibold text-center text-gray-800">Véhicules économiques</h3>
            <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">
                Idéal pour les nouveaux chauffeurs ou les petits budgets.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($ecoVehicles as $vehicle)
                <div class="vehicle-card" data-vehicle-id="{{ $vehicle->id }}">
                    <div class="w-full h-48 overflow-hidden">
                        @if($vehicle->image_url)
                        <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="default-car-image">
                            <img src="https://images.unsplash.com/photo-1621135802920-133df287f89c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                                alt="Voiture économique" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $vehicle->full_name }}</h4>
                        <p class="text-gray-600 mb-3">{{ $vehicle->category_fr }} • {{ $vehicle->fuel_type_fr }}</p>
                        <div class="mb-4">
                            <span class="text-2xl font-bold text-yellow-600">{{ $vehicle->weekly_rate_formatted
                                }}</span>
                            <span class="text-gray-500">/semaine</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="selectVehicle({{ $vehicle->id }}, '{{ addslashes($vehicle->full_name) }}')"
                                class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                                Sélectionner
                            </button>
                            <a href="{{ route('vehicle.details', $vehicle->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-800 font-semibold rounded-lg hover:bg-gray-200 transition-all duration-300">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-car text-gray-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun véhicule disponible</h4>
                    <p class="text-gray-600">Aucun véhicule économique n'est disponible pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Véhicules confort / business -->
        <div class="mb-16">
            <h3 class="mb-8 text-3xl font-semibold text-center text-gray-800">Véhicules confort / business</h3>
            <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">
                Parfait pour les VTC expérimentés ou les transferts professionnels.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($businessVehicles as $vehicle)
                <div class="vehicle-card" data-vehicle-id="{{ $vehicle->id }}">
                    <div class="w-full h-48 overflow-hidden">
                        @if($vehicle->image_url)
                        <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="default-car-image">
                            <img src="https://images.unsplash.com/photo-1617814076666-1dedaf7c4cbe?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                                alt="Voiture business" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $vehicle->full_name }}</h4>
                        <p class="text-gray-600 mb-3">{{ $vehicle->category_fr }} • {{ $vehicle->fuel_type_fr }}</p>
                        <div class="mb-4">
                            <span class="text-2xl font-bold text-yellow-600">{{ $vehicle->weekly_rate_formatted
                                }}</span>
                            <span class="text-gray-500">/semaine</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="selectVehicle({{ $vehicle->id }}, '{{ addslashes($vehicle->full_name) }}')"
                                class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                                Sélectionner
                            </button>
                            <a href="{{ route('vehicle.details', $vehicle->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-800 font-semibold rounded-lg hover:bg-gray-200 transition-all duration-300">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-car text-gray-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun véhicule disponible</h4>
                    <p class="text-gray-600">Aucun véhicule business n'est disponible pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Véhicules prestige -->
        <div class="mb-16">
            <h3 class="mb-8 text-3xl font-semibold text-center text-gray-800">Véhicules prestige</h3>
            <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">
                Le luxe à portée de main.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($prestigeVehicles as $vehicle)
                <div class="vehicle-card" data-vehicle-id="{{ $vehicle->id }}">
                    <div class="w-full h-48 overflow-hidden">
                        @if($vehicle->image_url)
                        <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="default-car-image">
                            <img src="https://images.unsplash.com/photo-1563720223485-8d84e8a6e9e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&h=400&q=80"
                                alt="Voiture prestige" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $vehicle->full_name }}</h4>
                        <p class="text-gray-600 mb-3">{{ $vehicle->category_fr }} • {{ $vehicle->fuel_type_fr }}</p>
                        <div class="mb-4">
                            <span class="text-2xl font-bold text-yellow-600">{{ $vehicle->weekly_rate_formatted
                                }}</span>
                            <span class="text-gray-500">/semaine</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="selectVehicle({{ $vehicle->id }}, '{{ addslashes($vehicle->full_name) }}')"
                                class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                                Sélectionner
                            </button>
                            <a href="{{ route('vehicle.details', $vehicle->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-800 font-semibold rounded-lg hover:bg-gray-200 transition-all duration-300">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-car text-gray-400 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun véhicule disponible</h4>
                    <p class="text-gray-600">Aucun véhicule prestige n'est disponible pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Services inclus -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Services inclus avec chaque location</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Chaque véhicule DJOK PRESTIGE bénéficie d'un service clé en main, sans frais cachés.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
            ['Assurance tous risques', 'fas fa-shield-alt'],
            ['Entretien et révision régulière', 'fas fa-tools'],
            ['Assistance 24h/24 et 7j/7', 'fas fa-headset'],
            ['Véhicule de remplacement en cas de panne', 'fas fa-car'],
            ['Nettoyage professionnel avant chaque mise à disposition', 'fas fa-spray-can'],
            ['Option GPS, siège bébé, ou chargeur électrique', 'fas fa-cogs']
            ] as $service)
            <div class="offer-card">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-100 rounded-lg">
                            <i class="{{ $service[1] }} text-yellow-600 text-xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-gray-900">{{ $service[0] }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="#reservation"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Demander la disponibilité de mon véhicule
            </a>
        </div>
    </div>
</section>

<!-- Offres spéciales chauffeurs VTC -->
<section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Offres spéciales Chauffeurs VTC</h2>
            <p class="text-xl max-w-3xl mx-auto text-gray-300">
                Vous débutez ou vous exercez déjà en tant que chauffeur ? DJOK PRESTIGE vous accompagne avec des
                formules adaptées aux pros du transport.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="bg-gray-800 rounded-xl p-8">
                <h3 class="text-2xl font-bold mb-4">Formule "START PRO"</h3>
                <p class="text-gray-300 mb-6">
                    Pour les nouveaux chauffeurs qui n'ont pas encore leur propre véhicule.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check text-yellow-400 mr-3"></i>
                        <span>Véhicule prêt à rouler (assuré et contrôlé)</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-yellow-400 mr-3"></i>
                        <span>Contrat flexible sans engagement long</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-yellow-400 mr-3"></i>
                        <span>Option formation + location groupée (tarif préférentiel)</span>
                    </li>
                </ul>
                <a href="#devis"
                    class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Découvrir la formule START PRO
                </a>
            </div>

            <div class="bg-gray-800 rounded-xl p-8">
                <h3 class="text-2xl font-bold mb-4">Formule "FULL VTC"</h3>
                <p class="text-gray-300 mb-6">
                    Pour les chauffeurs expérimentés.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check text-yellow-400 mr-3"></i>
                        <span>Véhicule haut de gamme (Mercedes, Tesla...)</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-yellow-400 mr-3"></i>
                        <span>Assistance 24/7</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-yellow-400 mr-3"></i>
                        <span>Option rachat de véhicule à la fin du contrat</span>
                    </li>
                </ul>
                <a href="#devis"
                    class="inline-flex items-center px-8 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    Découvrir la formule FULL VTC
                </a>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="#devis"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Je suis chauffeur, je veux un devis
            </a>
        </div>
    </div>
</section>

<!-- Conditions de location -->
<section id="conditions" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Conditions de location</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Pièces requises :</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-file-alt text-yellow-600 mt-1 mr-3"></i>
                                <span>Pièce d'identité ou titre de séjour valide</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-id-card text-yellow-600 mt-1 mr-3"></i>
                                <span>Permis B depuis +3 ans</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-home text-yellow-600 mt-1 mr-3"></i>
                                <span>Justificatif de domicile (-3 mois)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-badge-check text-yellow-600 mt-1 mr-3"></i>
                                <span>Carte professionnelle VTC (si location pro)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-euro-sign text-yellow-600 mt-1 mr-3"></i>
                                <span>Dépôt de garantie (selon le véhicule choisi)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Modalités de paiement</h2>
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Moyens de paiement acceptés :</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-credit-card text-blue-500 mr-3"></i>
                                <span>Carte bancaire</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-university text-green-500 mr-3"></i>
                                <span>Virement bancaire</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-money-bill-wave text-yellow-500 mr-3"></i>
                                <span>Espèces (dans la limite autorisée)</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Échéancier de paiement :</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-percentage text-yellow-600 mr-3"></i>
                                <span>Acompte de 40 % à la réservation</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-calendar-alt text-yellow-600 mr-3"></i>
                                <span>Paiement échelonné possible pour les contrats longue durée</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de réservation -->
<section id="reservation" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Réserver votre véhicule</h2>
                <p class="text-gray-600">
                    Remplissez le formulaire ci-dessous pour réserver votre véhicule. Notre équipe vous contactera dans
                    les
                    plus brefs délais.
                </p>
            </div>

            <!-- Messages d'erreur/succès -->
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Colonne gauche : Formulaire -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Formulaire de réservation</h3>
                        <p class="text-gray-600 mb-6">Remplissez ce formulaire pour réserver votre véhicule en ligne.
                        </p>

                        <form action="{{ route('location.reservation.store') }}" method="POST" id="reservationForm">
                            @csrf

                            <!-- Véhicule sélectionné (caché) -->
                            <input type="hidden" name="vehicle_id" id="selected_vehicle_id"
                                value="{{ old('vehicle_id') }}">

                            <div class="space-y-4">
                                <!-- Champ Nom complet -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Nom complet *</label>
                                    <input type="text" name="nom" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        value="{{ old('nom') }}">
                                    @error('nom')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Champ Email -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Email *</label>
                                    <input type="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        value="{{ old('email') }}">
                                    @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Champ Téléphone -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Téléphone *</label>
                                    <input type="tel" name="telephone" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        value="{{ old('telephone') }}">
                                    @error('telephone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Champ Type de véhicule (affiché en lecture seule) -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Véhicule sélectionné *</label>
                                    <input type="text" id="vehicle_display" readonly required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 cursor-not-allowed"
                                        value="{{ old('vehicle_model', 'Veuillez sélectionner un véhicule ci-dessus') }}">
                                    <p class="text-sm text-gray-500 mt-1">Cliquez sur "Sélectionner" sur le véhicule de
                                        votre choix</p>
                                    @error('vehicle_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CHAMP DATE DE DÉBUT DE LOCATION -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Date de début de location *</label>
                                    <input type="date" name="date_debut" id="date_debut" required
                                        min="{{ date('Y-m-d') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        value="{{ old('date_debut') }}">
                                    <p class="text-sm text-gray-500 mt-1">La date minimale est aujourd'hui</p>
                                    @error('date_debut')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CHAMP DATE DE FIN DE LOCATION -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Date de fin de location *</label>
                                    <input type="date" name="date_fin" id="date_fin" required
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        value="{{ old('date_fin') }}">
                                    <p class="text-sm text-gray-500 mt-1">La date doit être postérieure à la date de
                                        début</p>
                                    @error('date_fin')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Message supplémentaire -->
                                <div>
                                    <label class="block text-gray-700 mb-2">Message (optionnel)</label>
                                    <textarea name="notes" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                        placeholder="Informations complémentaires, questions...">{{ old('notes') }}</textarea>
                                </div>

                                <!-- Vérification de disponibilité -->
                                <div id="availability_check" class="hidden p-4 bg-gray-50 rounded-lg">
                                    <div id="availability_result"></div>
                                </div>

                                <!-- Estimation de prix -->
                                <div id="price_estimation"
                                    class="hidden p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <h4 class="font-bold text-yellow-900 mb-2">Estimation de prix :</h4>
                                    <div id="price_result"></div>
                                </div>

                                <!-- CGV -->
                                <div>
                                    <div class="flex items-start">
                                        <input type="checkbox" name="terms" id="terms" required
                                            class="mt-1 mr-3 h-5 w-5 text-yellow-600 rounded focus:ring-yellow-500">
                                        <label for="terms" class="text-gray-700 text-sm">
                                            J'accepte les <a href="{{ route('cgv') }}"
                                                class="text-yellow-600 hover:underline">conditions générales de
                                                location</a>
                                            et j'ai pris connaissance de la <a href="{{ route('rgpd') }}"
                                                class="text-yellow-600 hover:underline">politique de
                                                confidentialité</a>.
                                        </label>
                                    </div>
                                    @error('terms')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bouton de soumission -->
                                <button type="submit" id="submit_btn"
                                    class="w-full mt-6 inline-flex items-center justify-center px-6 py-4 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Envoyer ma demande de réservation
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Colonne droite : Contact et devis -->
                    <div id="devis">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Demande de devis / Simulation</h3>
                        <p class="text-gray-600 mb-6">Besoin d'un devis personnalisé ou d'une simulation de tarif ?</p>

                        <div class="space-y-6">
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <h4 class="font-bold text-blue-900 mb-2">Contact rapide :</h4>
                                <p class="text-blue-800">
                                    <i class="fas fa-phone-alt text-blue-600 mr-2"></i>
                                    Téléphone :
                                    <a href="tel:0176380017" class="font-semibold hover:underline">01 76 38 00 17</a>
                                </p>
                                <p class="text-blue-800 mt-2">
                                    <i class="fas fa-envelope text-blue-600 mr-2"></i>
                                    Email :
                                    <a href="mailto:location@djokprestige.com"
                                        class="font-semibold hover:underline">location@djokprestige.com</a>
                                </p>
                            </div>

                            <div class="p-4 bg-green-50 rounded-lg">
                                <h4 class="font-bold text-green-900 mb-2">Horaires d'ouverture :</h4>
                                <p class="text-green-800">
                                    <i class="fas fa-clock text-green-600 mr-2"></i>
                                    Lundi - Vendredi : 9h00 - 19h00
                                </p>
                                <p class="text-green-800 mt-2">
                                    <i class="fas fa-clock text-green-600 mr-2"></i>
                                    Samedi : 9h00 - 13h00
                                </p>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('contact') }}"
                                    class="inline-flex items-center px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
                                    <i class="fas fa-file-invoice-dollar mr-3"></i>Demander un devis personnalisé
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Véhicules récemment ajoutés -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Découvrez tous nos véhicules</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Notre flotte est régulièrement mise à jour avec de nouveaux véhicules. Consultez les pages détaillées
                pour en savoir plus.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @php
            // Récupérer 4 véhicules au hasard pour montrer la variété
            $randomVehicles = collect([]);

            // Récupérer des véhicules de chaque catégorie
            if($ecoVehicles->count() > 0) {
            $randomVehicles = $randomVehicles->merge($ecoVehicles->random(min(1, $ecoVehicles->count())));
            }
            if($businessVehicles->count() > 0) {
            $randomVehicles = $randomVehicles->merge($businessVehicles->random(min(1, $businessVehicles->count())));
            }
            if($prestigeVehicles->count() > 0) {
            $randomVehicles = $randomVehicles->merge($prestigeVehicles->random(min(1, $prestigeVehicles->count())));
            }

            // Compléter avec d'autres véhicules si nécessaire
            $allVehicles = collect([]);
            if($ecoVehicles->count() > 0) $allVehicles = $allVehicles->merge($ecoVehicles);
            if($businessVehicles->count() > 0) $allVehicles = $allVehicles->merge($businessVehicles);
            if($prestigeVehicles->count() > 0) $allVehicles = $allVehicles->merge($prestigeVehicles);

            // Si on n'a pas assez de véhicules, compléter avec ceux déjà sélectionnés
            $vehicleIds = $randomVehicles->pluck('id')->toArray();
            $needed = 4 - $randomVehicles->count();

            if ($needed > 0 && $allVehicles->count() > $randomVehicles->count()) {
            $additionalVehicles = $allVehicles
            ->whereNotIn('id', $vehicleIds)
            ->take($needed);
            $randomVehicles = $randomVehicles->merge($additionalVehicles);
            }
            @endphp

            @foreach($randomVehicles->take(4) as $vehicle)
            <div class="bg-gray-50 rounded-xl p-4 hover:shadow-lg transition-all duration-300">
                <div class="mb-4">
                    <div class="w-full h-32 overflow-hidden rounded-lg">
                        @if($vehicle->image_url)
                        <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="default-car-image h-32">
                            <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                                class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>
                </div>
                <h4 class="font-bold text-gray-900 mb-2">{{ $vehicle->full_name }}</h4>
                <div class="flex items-center justify-between mb-3">
                    <span class="{{ $vehicle->categoryColor }} px-2 py-1 rounded-full text-xs font-semibold">
                        {{ $vehicle->category_fr }}
                    </span>
                    <span class="text-sm text-gray-600">{{ $vehicle->fuel_type_fr }}</span>
                </div>
                <a href="{{ route('vehicle.details', $vehicle->id) }}"
                    class="block text-center w-full px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                    Voir les détails
                </a>
            </div>
            @endforeach

            @if($randomVehicles->count() == 0)
            <div class="col-span-4 text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-car text-gray-400 text-2xl"></i>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Aucun véhicule disponible</h4>
                <p class="text-gray-600">Revenez bientôt pour découvrir notre flotte.</p>
            </div>
            @endif
        </div>

        <div class="text-center mt-8">
            @php
            $totalCount = $allVehicles->count();
            @endphp
            @if($totalCount > 0)
            <p class="text-gray-600 mb-4">
                {{ $totalCount }} véhicule{{ $totalCount > 1 ? 's' : '' }} disponible{{ $totalCount > 1 ? 's' : '' }}
                dans notre flotte.
            </p>
            @endif

            <a href="#flotte"
                class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300">
                <i class="fas fa-car mr-2"></i>
                Voir toute la flotte
            </a>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6">Trouvez le véhicule parfait pour vos besoins</h2>
        <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
            Que vous soyez chauffeur VTC, entrepreneur ou particulier, nous avons la solution adaptée à vos besoins.
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="#flotte"
                class="inline-flex items-center px-8 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                <i class="fas fa-car mr-3"></i>
                Explorer notre flotte
            </a>
            <a href="tel:0176380017"
                class="inline-flex items-center px-8 py-4 bg-gray-700 text-white text-lg font-semibold rounded-lg hover:bg-gray-600 transition-all duration-300">
                <i class="fas fa-phone mr-3"></i>
                Nous appeler : 01 76 38 00 17
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                <i class="fas fa-shield-alt text-yellow-400 text-2xl mb-3"></i>
                <h4 class="font-bold mb-2">Assurance incluse</h4>
                <p class="text-sm text-gray-300">Tous risques avec assistance 24h/24</p>
            </div>
            <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                <i class="fas fa-tools text-yellow-400 text-2xl mb-3"></i>
                <h4 class="font-bold mb-2">Entretien compris</h4>
                <p class="text-sm text-gray-300">Révisions et maintenance incluses</p>
            </div>
            <div class="bg-gray-800 bg-opacity-50 p-4 rounded-lg">
                <i class="fas fa-calendar-check text-yellow-400 text-2xl mb-3"></i>
                <h4 class="font-bold mb-2">Flexibilité totale</h4>
                <p class="text-sm text-gray-300">Location à la journée, semaine ou mois</p>
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

    // Smooth scroll pour les ancres
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Gestion des dates
    const dateDebutInput = document.querySelector('#date_debut');
    const dateFinInput = document.querySelector('#date_fin');
    const vehicleIdInput = document.querySelector('#selected_vehicle_id');
    const availabilityCheck = document.querySelector('#availability_check');
    const availabilityResult = document.querySelector('#availability_result');
    const priceEstimation = document.querySelector('#price_estimation');
    const priceResult = document.querySelector('#price_result');
    const submitBtn = document.querySelector('#submit_btn');

    if (dateDebutInput && dateFinInput && vehicleIdInput) {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);

        // Formater les dates au format YYYY-MM-DD
        const formattedToday = today.toISOString().split('T')[0];
        const formattedTomorrow = tomorrow.toISOString().split('T')[0];

        // Définir les dates minimales
        dateDebutInput.min = formattedToday;
        dateFinInput.min = formattedTomorrow;

        // Mettre à jour la date minimale de fin lorsque la date de début change
        dateDebutInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            const nextDay = new Date(selectedDate);
            nextDay.setDate(nextDay.getDate() + 1);

            const formattedNextDay = nextDay.toISOString().split('T')[0];
            dateFinInput.min = formattedNextDay;

            // Si la date de fin est antérieure à la nouvelle date minimale, réinitialiser
            if (dateFinInput.value && dateFinInput.value < formattedNextDay) {
                dateFinInput.value = formattedNextDay;
            }

            checkAvailabilityAndPrice();
        });

        // Validation : date de fin doit être postérieure à date de début
        dateFinInput.addEventListener('change', function() {
            if (dateDebutInput.value && this.value) {
                const dateDebut = new Date(dateDebutInput.value);
                const dateFin = new Date(this.value);

                if (dateFin <= dateDebut) {
                    alert("La date de fin doit être postérieure à la date de début.");
                    const nextDay = new Date(dateDebut);
                    nextDay.setDate(nextDay.getDate() + 1);
                    this.value = nextDay.toISOString().split('T')[0];
                }
            }

            checkAvailabilityAndPrice();
        });

        // Vérifier la disponibilité et calculer le prix
        function checkAvailabilityAndPrice() {
            const vehicleId = vehicleIdInput.value;
            const dateDebut = dateDebutInput.value;
            const dateFin = dateFinInput.value;

            if (!vehicleId || !dateDebut || !dateFin) {
                availabilityCheck.classList.add('hidden');
                priceEstimation.classList.add('hidden');
                return;
            }

            // Vérifier que la date de fin est après la date de début
            if (new Date(dateFin) <= new Date(dateDebut)) {
                return;
            }

            // Afficher le loader
            availabilityResult.innerHTML = `
                <div class="flex items-center">
                    <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-yellow-600 mr-2"></div>
                    <span>Vérification en cours...</span>
                </div>
            `;
            availabilityCheck.classList.remove('hidden');

            // Envoyer la requête AJAX
            fetch('{{ route("location.reservation.check.availability") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    vehicle_id: vehicleId,
                    date_debut: dateDebut,
                    date_fin: dateFin
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.available) {
                    availabilityResult.innerHTML = `
                        <div class="text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            ${data.message}
                        </div>
                    `;

                    // Afficher l'estimation de prix
                    priceResult.innerHTML = `
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span>Durée :</span>
                                <span class="font-semibold">${data.duree_jours} jours</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Type de tarif :</span>
                                <span class="font-semibold">${data.tarif_type}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Montant estimé :</span>
                                <span class="font-bold text-lg text-yellow-700">${parseFloat(data.montant_estime).toFixed(2).replace('.', ',')} €</span>
                            </div>
                            <div class="text-sm text-gray-600 mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Prix indicatif TTC
                            </div>
                        </div>
                    `;
                    priceEstimation.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    availabilityResult.innerHTML = `
                        <div class="text-red-600">
                            <i class="fas fa-times-circle mr-2"></i>
                            ${data.message}
                        </div>
                    `;
                    priceEstimation.classList.add('hidden');
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                availabilityResult.innerHTML = `
                    <div class="text-red-600">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Erreur lors de la vérification. Veuillez réessayer.
                    </div>
                `;
                priceEstimation.classList.add('hidden');
            });
        }

        // Vérifier la disponibilité lorsque le véhicule change
        vehicleIdInput.addEventListener('change', checkAvailabilityAndPrice);
    }
});

// Fonction pour sélectionner un véhicule
function selectVehicle(vehicleId, vehicleName) {
    document.getElementById('selected_vehicle_id').value = vehicleId;
    document.getElementById('vehicle_display').value = vehicleName;

    // Scroll vers le formulaire
    document.getElementById('reservation').scrollIntoView({ behavior: 'smooth' });

    // Vérifier la disponibilité si les dates sont déjà remplies
    const dateDebut = document.getElementById('date_debut').value;
    const dateFin = document.getElementById('date_fin').value;

    if (dateDebut && dateFin) {
        setTimeout(() => {
            // Appeler la fonction checkAvailabilityAndPrice si elle existe
            if (typeof checkAvailabilityAndPrice === 'function') {
                checkAvailabilityAndPrice();
            }
        }, 500);
    }
}
</script>
@endsection