@extends('layouts.main')

@section('title', 'Location de Véhicules VTC - DJOK PRESTIGE')

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

    /* Modal styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.9);
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
        background: #111;
        border: 1px solid #333;
        border-radius: 8px;
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
        border-radius: 4px;
    }

    .default-car-image {
        width: 100%;
        height: 12rem;
        position: relative;
        overflow: hidden;
    }

    .default-car-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
</style>

<!-- Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
            alt="Location de véhicules VTC" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.8);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                Louez votre véhicule VTC haut de gamme avec DJOK PRESTIGE
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12 fade-in">
                Vous cherchez un véhicule pour travailler, voyager ou simplement profiter du confort d'une voiture
                premium ? DJOK PRESTIGE met à votre disposition une flotte de véhicules récents, entretenus et assurés,
                disponibles à la journée, à la semaine ou au mois, avec ou sans chauffeur.
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center fade-in" style="transition-delay: 0.2s;">
                <a href="#flotte"
                    class="w-full sm:w-auto px-6 md:px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    Voir les véhicules disponibles
                </a>
                <a href="#devis"
                    class="w-full sm:w-auto px-6 md:px-8 py-3 font-semibold text-center border transition duration-300"
                    style="border-color: var(--gold); color: var(--gold);">
                    Demander un devis personnalisé
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#offres" class="text-white transition duration-300 hover:text-var(--gold)">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Nos offres de location - Style sobre -->
<section id="offres" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Nos offres de location</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Découvrez nos formules flexibles, pensées pour s'adapter à votre activité et à votre budget.
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full" style="background: #111; border: 1px solid #333;">
                <thead style="background: #000;">
                    <tr>
                        <th class="py-4 px-4 md:px-6 text-left text-white">Formule</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Durée</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Public visé</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Inclus</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Tarif TTC</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                    [
                    'formule' => 'Location courte durée',
                    'duree' => '1 à 7 jours',
                    'public' => 'Particuliers / Chauffeurs VTC occasionnels',
                    'inclus' => 'Assurance + Entretien + Assistance',
                    'tarif' => 'Dès 100 €/jour',
                    'action' => 'Réserver'
                    ],
                    [
                    'formule' => 'Location moyenne durée',
                    'duree' => '1 à 4 semaines',
                    'public' => 'Chauffeurs VTC actifs ou entreprises',
                    'inclus' => 'Assurance + Maintenance + Véhicule de remplacement',
                    'tarif' => 'Dès 280 €/semaine',
                    'action' => 'Réserver'
                    ],
                    [
                    'formule' => 'Location longue durée (LLD)',
                    'duree' => '1 à 12 mois',
                    'public' => 'Chauffeurs indépendants / Flottes d\'entreprises',
                    'inclus' => 'Assurance, révision, pneus, véhicule de prêt',
                    'tarif' => 'Dès 790 €/mois',
                    'action' => 'Réserver'
                    ],
                    [
                    'formule' => 'Location avec chauffeur',
                    'duree' => 'Sur demande',
                    'public' => 'Événements / Transferts / VIP',
                    'inclus' => 'Véhicule + Chauffeur professionnel + Service personnalisé',
                    'tarif' => 'Sur devis',
                    'action' => 'Demander devis'
                    ]
                    ] as $offer)
                    <tr class="border-b" style="border-color: #333; color: white;">
                        <td class="py-4 px-4 md:px-6 font-semibold">{{ $offer['formule'] }}</td>
                        <td class="py-4 px-4 md:px-6 text-center">{{ $offer['duree'] }}</td>
                        <td class="py-4 px-4 md:px-6 text-center">{{ $offer['public'] }}</td>
                        <td class="py-4 px-4 md:px-6 text-center">{{ $offer['inclus'] }}</td>
                        <td class="py-4 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">{{
                            $offer['tarif'] }}</td>
                        <td class="py-4 px-4 md:px-6 text-center">
                            @if($offer['action'] === 'Réserver')
                            <a href="#reservation"
                                class="inline-flex items-center px-4 md:px-6 py-2 text-sm font-semibold transition-all duration-300"
                                style="background: var(--gold); color: black;">
                                Réserver
                            </a>
                            @else
                            <a href="#devis"
                                class="inline-flex items-center px-4 md:px-6 py-2 text-sm font-semibold transition-all duration-300"
                                style="border: 1px solid var(--gold); color: var(--gold);">
                                Demander devis
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#reservation"
                class="inline-flex items-center px-6 md:px-8 py-3 font-semibold text-center transition duration-300"
                style="background: var(--gold); color: black;">
                Réserver maintenant
            </a>
            <a href="#simulation"
                class="inline-flex items-center px-6 md:px-8 py-3 font-semibold text-center border transition duration-300"
                style="border-color: var(--gold); color: var(--gold);">
                Obtenir une simulation
            </a>
        </div>
    </div>
</section>

<!-- Notre flotte de véhicules premium - Style sobre -->
<section id="flotte" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Notre flotte de véhicules
                premium</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">Catégories de véhicules disponibles</p>
        </div>

        <!-- Véhicules économiques -->
        <div class="mb-16">
            <h3 class="mb-8 text-2xl md:text-3xl font-semibold text-center" style="color: white;">Véhicules économiques
            </h3>
            <p class="text-center text-gray-400 mb-8 max-w-2xl mx-auto">
                Idéal pour les nouveaux chauffeurs ou les petits budgets.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($ecoVehicles as $vehicle)
                <div class="p-4 md:p-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="w-full h-48 md:h-56 overflow-hidden rounded mb-4">
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
                    <div>
                        <h4 class="text-lg md:text-xl font-bold mb-2" style="color: white;">{{ $vehicle->full_name }}
                        </h4>
                        <p class="text-gray-400 mb-3 text-sm">{{ $vehicle->category_fr }} • {{ $vehicle->fuel_type_fr }}
                        </p>
                        <div class="mb-4">
                            <span class="text-xl md:text-2xl font-bold" style="color: var(--gold);">{{
                                $vehicle->weekly_rate_formatted }}</span>
                            <span class="text-gray-500">/semaine</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="selectVehicle({{ $vehicle->id }}, '{{ addslashes($vehicle->full_name) }}')"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 md:py-3 font-semibold transition-all duration-300"
                                style="background: var(--gold); color: black;">
                                Sélectionner
                            </button>
                            <a href="{{ route('vehicle.details', $vehicle->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 md:py-3 font-semibold transition-all duration-300"
                                style="background: #111; color: white; border: 1px solid #333;">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
                        style="background: #1a1a1a; border: 1px solid #333;">
                        <i class="fas fa-car" style="color: #666; font-size: 1.5rem;"></i>
                    </div>
                    <h4 class="text-lg font-medium mb-2" style="color: white;">Aucun véhicule disponible</h4>
                    <p class="text-gray-400">Aucun véhicule économique n'est disponible pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Véhicules confort / business -->
        <div class="mb-16">
            <h3 class="mb-8 text-2xl md:text-3xl font-semibold text-center" style="color: white;">Véhicules confort /
                business</h3>
            <p class="text-center text-gray-400 mb-8 max-w-2xl mx-auto">
                Parfait pour les VTC expérimentés ou les transferts professionnels.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($businessVehicles as $vehicle)
                <div class="p-4 md:p-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="w-full h-48 md:h-56 overflow-hidden rounded mb-4">
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
                    <div>
                        <h4 class="text-lg md:text-xl font-bold mb-2" style="color: white;">{{ $vehicle->full_name }}
                        </h4>
                        <p class="text-gray-400 mb-3 text-sm">{{ $vehicle->category_fr }} • {{ $vehicle->fuel_type_fr }}
                        </p>
                        <div class="mb-4">
                            <span class="text-xl md:text-2xl font-bold" style="color: var(--gold);">{{
                                $vehicle->weekly_rate_formatted }}</span>
                            <span class="text-gray-500">/semaine</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="selectVehicle({{ $vehicle->id }}, '{{ addslashes($vehicle->full_name) }}')"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 md:py-3 font-semibold transition-all duration-300"
                                style="background: var(--gold); color: black;">
                                Sélectionner
                            </button>
                            <a href="{{ route('vehicle.details', $vehicle->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 md:py-3 font-semibold transition-all duration-300"
                                style="background: #111; color: white; border: 1px solid #333;">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
                        style="background: #1a1a1a; border: 1px solid #333;">
                        <i class="fas fa-car" style="color: #666; font-size: 1.5rem;"></i>
                    </div>
                    <h4 class="text-lg font-medium mb-2" style="color: white;">Aucun véhicule disponible</h4>
                    <p class="text-gray-400">Aucun véhicule business n'est disponible pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Véhicules prestige -->
        <div class="mb-16">
            <h3 class="mb-8 text-2xl md:text-3xl font-semibold text-center" style="color: white;">Véhicules prestige
            </h3>
            <p class="text-center text-gray-400 mb-8 max-w-2xl mx-auto">
                Le luxe à portée de main.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($prestigeVehicles as $vehicle)
                <div class="p-4 md:p-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="w-full h-48 md:h-56 overflow-hidden rounded mb-4">
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
                    <div>
                        <h4 class="text-lg md:text-xl font-bold mb-2" style="color: white;">{{ $vehicle->full_name }}
                        </h4>
                        <p class="text-gray-400 mb-3 text-sm">{{ $vehicle->category_fr }} • {{ $vehicle->fuel_type_fr }}
                        </p>
                        <div class="mb-4">
                            <span class="text-xl md:text-2xl font-bold" style="color: var(--gold);">{{
                                $vehicle->weekly_rate_formatted }}</span>
                            <span class="text-gray-500">/semaine</span>
                        </div>
                        <div class="flex gap-3">
                            <button onclick="selectVehicle({{ $vehicle->id }}, '{{ addslashes($vehicle->full_name) }}')"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 md:py-3 font-semibold transition-all duration-300"
                                style="background: var(--gold); color: black;">
                                Sélectionner
                            </button>
                            <a href="{{ route('vehicle.details', $vehicle->id) }}"
                                class="flex-1 inline-flex items-center justify-center px-4 py-2 md:py-3 font-semibold transition-all duration-300"
                                style="background: #111; color: white; border: 1px solid #333;">
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
                        style="background: #1a1a1a; border: 1px solid #333;">
                        <i class="fas fa-car" style="color: #666; font-size: 1.5rem;"></i>
                    </div>
                    <h4 class="text-lg font-medium mb-2" style="color: white;">Aucun véhicule disponible</h4>
                    <p class="text-gray-400">Aucun véhicule prestige n'est disponible pour le moment.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

<!-- Services inclus - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Services inclus avec chaque
                location</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Chaque véhicule DJOK PRESTIGE bénéficie d'un service clé en main, sans frais cachés.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @foreach([
            ['Assurance tous risques', 'fas fa-shield-alt'],
            ['Entretien et révision régulière', 'fas fa-tools'],
            ['Assistance 24h/24 et 7j/7', 'fas fa-headset'],
            ['Véhicule de remplacement en cas de panne', 'fas fa-car'],
            ['Nettoyage professionnel avant chaque mise à disposition', 'fas fa-spray-can'],
            ['Option GPS, siège bébé, ou chargeur électrique', 'fas fa-cogs']
            ] as $service)
            <div class="p-4 md:p-6" style="background: #111; border: 1px solid #333;">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded"
                            style="background: #1a1a1a;">
                            <i class="{{ $service[1] }}" style="color: var(--gold);"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-semibold" style="color: white;">{{ $service[0] }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="#reservation"
                class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition duration-300"
                style="background: var(--gold); color: black;">
                Demander la disponibilité de mon véhicule
            </a>
        </div>
    </div>
</section>

<!-- Offres spéciales chauffeurs VTC - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Offres spéciales Chauffeurs VTC
            </h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Vous débutez ou vous exercez déjà en tant que chauffeur ? DJOK PRESTIGE vous accompagne avec des
                formules adaptées aux pros du transport.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
            <div class="p-6 md:p-8" style="background: #1a1a1a; border: 1px solid #333;">
                <h3 class="text-xl md:text-2xl font-bold mb-4" style="color: white;">Formule "START PRO"</h3>
                <p class="text-gray-400 mb-6">
                    Pour les nouveaux chauffeurs qui n'ont pas encore leur propre véhicule.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: white;">Véhicule prêt à rouler (assuré et contrôlé)</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: white;">Contrat flexible sans engagement long</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: white;">Option formation + location groupée (tarif préférentiel)</span>
                    </li>
                </ul>
                <a href="#devis"
                    class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                    style="background: var(--gold); color: black;">
                    Découvrir la formule START PRO
                </a>
            </div>

            <div class="p-6 md:p-8" style="background: #1a1a1a; border: 1px solid #333;">
                <h3 class="text-xl md:text-2xl font-bold mb-4" style="color: white;">Formule "FULL VTC"</h3>
                <p class="text-gray-400 mb-6">
                    Pour les chauffeurs expérimentés.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: white;">Véhicule haut de gamme (Mercedes, Tesla...)</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: white;">Assistance 24/7</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: white;">Option rachat de véhicule à la fin du contrat</span>
                    </li>
                </ul>
                <a href="#devis"
                    class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                    style="background: var(--gold); color: black;">
                    Découvrir la formule FULL VTC
                </a>
            </div>
        </div>

        <div class="mt-12 text-center">
            <a href="#devis" class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition duration-300"
                style="background: var(--gold); color: black;">
                Je suis chauffeur, je veux un devis
            </a>
        </div>
    </div>
</section>

<!-- Conditions de location - Style sobre -->
<section id="conditions" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-12">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Conditions de location</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg md:text-xl font-semibold mb-3" style="color: white;">Pièces requises :</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-file-alt text-sm mt-1 mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Pièce d'identité ou titre de séjour valide</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-id-card text-sm mt-1 mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Permis B depuis +3 ans</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-home text-sm mt-1 mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Justificatif de domicile (-3 mois)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-badge-check text-sm mt-1 mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Carte professionnelle VTC (si location pro)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-euro-sign text-sm mt-1 mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Dépôt de garantie (selon le véhicule choisi)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Modalités de paiement</h2>
                <div class="space-y-6">
                    <div class="p-4 md:p-6 rounded" style="background: #111; border: 1px solid #333;">
                        <h3 class="text-lg font-semibold mb-3" style="color: white;">Moyens de paiement acceptés :</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-credit-card mr-3" style="color: #60a5fa;"></i>
                                <span style="color: white;">Carte bancaire</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-university mr-3" style="color: #60a5fa;"></i>
                                <span style="color: white;">Virement bancaire</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-money-bill-wave mr-3" style="color: #60a5fa;"></i>
                                <span style="color: white;">Espèces (dans la limite autorisée)</span>
                            </li>
                        </ul>
                    </div>

                    <div class="p-4 md:p-6 rounded" style="background: #1a1a1a; border: 1px solid #333;">
                        <h3 class="text-lg font-semibold mb-3" style="color: white;">Échéancier de paiement :</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <i class="fas fa-percentage mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Acompte de 40 % à la réservation</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3" style="color: var(--gold);"></i>
                                <span style="color: white;">Paiement échelonné possible pour les contrats longue
                                    durée</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire de réservation - Style sobre -->
<section id="reservation" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Réserver votre véhicule</h2>
                <p class="text-gray-400">
                    Remplissez le formulaire ci-dessous pour réserver votre véhicule. Notre équipe vous contactera dans
                    les plus brefs délais.
                </p>
            </div>

            <!-- Messages d'erreur/succès -->
            @if(session('error'))
            <div class="mb-6 p-4 rounded fade-in" style="background: #7f1d1d; border: 1px solid #991b1b;">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle" style="color: #fca5a5;"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-white font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-4 rounded fade-in" style="background: #064e3b; border: 1px solid #047857;">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle" style="color: #a7f3d0;"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-white font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="p-6 md:p-8" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8">
                    <!-- Colonne gauche : Formulaire -->
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold mb-4" style="color: white;">Formulaire de réservation
                        </h3>
                        <p class="text-gray-400 mb-6">Remplissez ce formulaire pour réserver votre véhicule en ligne.
                        </p>

                        <form action="{{ route('location.reservation.store') }}" method="POST" id="reservationForm">
                            @csrf

                            <!-- Véhicule sélectionné (caché) -->
                            <input type="hidden" name="vehicle_id" id="selected_vehicle_id"
                                value="{{ old('vehicle_id') }}">

                            <div class="space-y-4">
                                <!-- Champ Nom complet -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Nom complet *</label>
                                    <input type="text" name="nom" required
                                        class="w-full px-4 py-3 rounded focus:outline-none"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        value="{{ old('nom') }}">
                                    @error('nom')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Champ Email -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Email *</label>
                                    <input type="email" name="email" required
                                        class="w-full px-4 py-3 rounded focus:outline-none"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        value="{{ old('email') }}">
                                    @error('email')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Champ Téléphone -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Téléphone *</label>
                                    <input type="tel" name="telephone" required
                                        class="w-full px-4 py-3 rounded focus:outline-none"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        value="{{ old('telephone') }}">
                                    @error('telephone')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Champ Type de véhicule (affiché en lecture seule) -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Véhicule sélectionné
                                        *</label>
                                    <input type="text" id="vehicle_display" readonly required
                                        class="w-full px-4 py-3 rounded focus:outline-none cursor-not-allowed"
                                        style="background: #0a0a0a; border: 1px solid #333; color: #888;"
                                        value="{{ old('vehicle_model', 'Veuillez sélectionner un véhicule ci-dessus') }}">
                                    <p class="text-xs text-gray-500 mt-1">Cliquez sur "Sélectionner" sur le véhicule de
                                        votre choix</p>
                                    @error('vehicle_id')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CHAMP DATE DE DÉBUT DE LOCATION -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Date de début de location
                                        *</label>
                                    <input type="date" name="date_debut" id="date_debut" required
                                        min="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded focus:outline-none"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        value="{{ old('date_debut') }}">
                                    <p class="text-xs text-gray-500 mt-1">La date minimale est aujourd'hui</p>
                                    @error('date_debut')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CHAMP DATE DE FIN DE LOCATION -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Date de fin de location
                                        *</label>
                                    <input type="date" name="date_fin" id="date_fin" required
                                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full px-4 py-3 rounded focus:outline-none"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        value="{{ old('date_fin') }}">
                                    <p class="text-xs text-gray-500 mt-1">La date doit être postérieure à la date de
                                        début</p>
                                    @error('date_fin')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Message supplémentaire -->
                                <div>
                                    <label class="block mb-2 font-medium" style="color: #ddd;">Message
                                        (optionnel)</label>
                                    <textarea name="notes" rows="3" class="w-full px-4 py-3 rounded focus:outline-none"
                                        style="background: #111; border: 1px solid #444; color: white;"
                                        placeholder="Informations complémentaires, questions...">{{ old('notes') }}</textarea>
                                </div>

                                <!-- Vérification de disponibilité -->
                                <div id="availability_check" class="hidden p-4 rounded"
                                    style="background: #111; border: 1px solid #444;">
                                    <div id="availability_result"></div>
                                </div>

                                <!-- Estimation de prix -->
                                <div id="price_estimation" class="hidden p-4 rounded"
                                    style="background: #1a1a1a; border: 1px solid #333;">
                                    <h4 class="font-bold mb-2" style="color: var(--gold);">Estimation de prix :</h4>
                                    <div id="price_result"></div>
                                </div>

                                <!-- CGV -->
                                <div>
                                    <div class="flex items-start">
                                        <input type="checkbox" name="terms" id="terms" required
                                            class="mt-1 mr-3 h-5 w-5 rounded focus:outline-none"
                                            style="background: #111; border: 1px solid #444;">
                                        <label for="terms" class="text-gray-300 text-sm">
                                            J'accepte les <a href="{{ route('cgv') }}" style="color: var(--gold);"
                                                class="hover:text-yellow-400">conditions générales de location</a>
                                            et j'ai pris connaissance de la <a href="{{ route('rgpd') }}"
                                                style="color: var(--gold);" class="hover:text-yellow-400">politique de
                                                confidentialité</a>.
                                        </label>
                                    </div>
                                    @error('terms')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bouton de soumission -->
                                <button type="submit" id="submit_btn"
                                    class="w-full mt-6 inline-flex items-center justify-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                                    style="background: var(--gold); color: black;">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Envoyer ma demande de réservation
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Colonne droite : Contact et devis -->
                    <div id="devis">
                        <h3 class="text-xl md:text-2xl font-bold mb-4" style="color: white;">Demande de devis /
                            Simulation</h3>
                        <p class="text-gray-400 mb-6">Besoin d'un devis personnalisé ou d'une simulation de tarif ?</p>

                        <div class="space-y-6">
                            <div class="p-4 rounded" style="background: #111; border: 1px solid #333;">
                                <h4 class="font-bold mb-2" style="color: white;">Contact rapide :</h4>
                                <p class="text-gray-300">
                                    <i class="fas fa-phone-alt mr-2" style="color: var(--gold);"></i>
                                    Téléphone :
                                    <a href="tel:0176380017"
                                        class="font-semibold hover:text-yellow-400 transition duration-300"
                                        style="color: var(--gold);">01 76 38 00 17</a>
                                </p>
                                <p class="text-gray-300 mt-2">
                                    <i class="fas fa-envelope mr-2" style="color: var(--gold);"></i>
                                    Email :
                                    <a href="mailto:location@djokprestige.com"
                                        class="font-semibold hover:text-yellow-400 transition duration-300"
                                        style="color: var(--gold);">location@djokprestige.com</a>
                                </p>
                            </div>

                            <div class="p-4 rounded" style="background: #111; border: 1px solid #333;">
                                <h4 class="font-bold mb-2" style="color: white;">Horaires d'ouverture :</h4>
                                <p class="text-gray-300">
                                    <i class="fas fa-clock mr-2" style="color: var(--gold);"></i>
                                    Lundi - Vendredi : 9h00 - 19h00
                                </p>
                                <p class="text-gray-300 mt-2">
                                    <i class="fas fa-clock mr-2" style="color: var(--gold);"></i>
                                    Samedi : 9h00 - 13h00
                                </p>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('contact') }}"
                                    class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                                    style="background: #111; color: white; border: 1px solid #333;">
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

<!-- Véhicules récemment ajoutés - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Découvrez tous nos véhicules
            </h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Notre flotte est régulièrement mise à jour avec de nouveaux véhicules. Consultez les pages détaillées
                pour en savoir plus.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
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
            <div class="p-4" style="background: #111; border: 1px solid #333;">
                <div class="mb-4">
                    <div class="w-full h-32 md:h-40 overflow-hidden rounded">
                        @if($vehicle->image_url)
                        <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="default-car-image h-32 md:h-40">
                            <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=200&q=80"
                                alt="{{ $vehicle->full_name }}" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>
                </div>
                <h4 class="font-bold mb-2" style="color: white;">{{ $vehicle->full_name }}</h4>
                <div class="flex items-center justify-between mb-3">
                    <span class="px-2 py-1 rounded text-xs font-semibold"
                        style="background: #1a1a1a; color: var(--gold);">
                        {{ $vehicle->category_fr }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $vehicle->fuel_type_fr }}</span>
                </div>
                <a href="{{ route('vehicle.details', $vehicle->id) }}"
                    class="block text-center w-full px-4 py-2 font-semibold transition-all duration-300"
                    style="background: var(--gold); color: black;">
                    Voir les détails
                </a>
            </div>
            @endforeach

            @if($randomVehicles->count() == 0)
            <div class="col-span-4 text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4"
                    style="background: #1a1a1a; border: 1px solid #333;">
                    <i class="fas fa-car" style="color: #666; font-size: 1.5rem;"></i>
                </div>
                <h4 class="text-lg font-medium mb-2" style="color: white;">Aucun véhicule disponible</h4>
                <p class="text-gray-400">Revenez bientôt pour découvrir notre flotte.</p>
            </div>
            @endif
        </div>

        <div class="text-center mt-8">
            @php
            $totalCount = $allVehicles->count();
            @endphp
            @if($totalCount > 0)
            <p class="text-gray-400 mb-4">
                {{ $totalCount }} véhicule{{ $totalCount > 1 ? 's' : '' }} disponible{{ $totalCount > 1 ? 's' : '' }}
                dans notre flotte.
            </p>
            @endif

            <a href="#flotte"
                class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                style="background: #111; color: white; border: 1px solid #333;">
                <i class="fas fa-car mr-2"></i>
                Voir toute la flotte
            </a>
        </div>
    </div>
</section>

<!-- CTA Final - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6 text-center">
        <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Trouvez le véhicule parfait pour vos
            besoins</h2>
        <p class="text-gray-400 mb-8 max-w-2xl mx-auto">
            Que vous soyez chauffeur VTC, entrepreneur ou particulier, nous avons la solution adaptée à vos besoins.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#flotte"
                class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                style="background: var(--gold); color: black;">
                <i class="fas fa-car mr-3"></i>
                Explorer notre flotte
            </a>
            <a href="tel:0176380017"
                class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                style="background: #1a1a1a; color: white; border: 1px solid #333;">
                <i class="fas fa-phone mr-3"></i>
                Nous appeler : 01 76 38 00 17
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 max-w-4xl mx-auto">
            @foreach([
            ['Assurance incluse', 'fas fa-shield-alt', 'Tous risques avec assistance 24h/24'],
            ['Entretien compris', 'fas fa-tools', 'Révisions et maintenance incluses'],
            ['Flexibilité totale', 'fas fa-calendar-check', 'Location à la journée, semaine ou mois']
            ] as $feature)
            <div class="p-4 rounded" style="background: #1a1a1a; border: 1px solid #333;">
                <i class="{{ $feature[1] }} mb-3" style="color: var(--gold); font-size: 1.5rem;"></i>
                <h4 class="font-bold mb-2" style="color: white;">{{ $feature[0] }}</h4>
                <p class="text-sm" style="color: #999;">{{ $feature[2] }}</p>
            </div>
            @endforeach
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
                        <span class="text-white">Vérification en cours...</span>
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
                            <div class="text-green-400">
                                <i class="fas fa-check-circle mr-2"></i>
                                ${data.message}
                            </div>
                        `;

                        // Afficher l'estimation de prix
                        priceResult.innerHTML = `
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Durée :</span>
                                    <span class="font-semibold text-white">${data.duree_jours} jours</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Type de tarif :</span>
                                    <span class="font-semibold text-white">${data.tarif_type}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-300">Montant estimé :</span>
                                    <span class="font-bold text-lg" style="color: var(--gold);">${parseFloat(data.montant_estime).toFixed(2).replace('.', ',')} €</span>
                                </div>
                                <div class="text-xs text-gray-500 mt-2">
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
                            <div class="text-red-400">
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
                        <div class="text-red-400">
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
