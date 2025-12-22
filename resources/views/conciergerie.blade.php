@extends('layouts.main')

@section('title', 'Conciergerie - Arriver & Vivre en France | DJOK PRESTIGE')

@section('content')
<!-- Message de succès - Style sobre -->
@if(session('success'))
<div id="success-alert" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-2xl">
    <div class="mx-4 p-4" style="background: #064e3b; border-left: 4px solid #10b981;">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full" style="background: #047857;">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-semibold text-white">Demande envoyée avec succès !</h3>
                    <div class="mt-1 text-green-100">
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
                class="text-green-300 hover:text-white">
                <i class="fas fa-times"></i>
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

<!-- Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
            alt="Conciergerie Arriver en France" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                Arriver & Vivre en France avec DJOK PRESTIGE
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12">
                Votre arrivée en France, sans stress. DJOK PRESTIGE s'occupe de tout : transfert aéroport, hébergement,
                véhicule, guide, et assistance administrative légère. Vous vous concentrez sur l'essentiel (formation,
                business, séjour), on gère le reste.
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#devis" class="w-full sm:w-auto px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    Demander un devis conciergerie
                </a>
                <a href="#contact"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center border transition duration-300"
                    style="border-color: var(--gold); color: var(--gold);">
                    Être rappelé en 10 minutes
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

<!-- Nos services - Style sobre -->
<section id="services" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Nos services (à la carte)</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
            ['Transferts aéroports & gares', 'fas fa-plane-arrival', 'Accueil pancarte nominative, suivi vol/train,
            attente incluse.'],
            ['Location de voiture', 'fas fa-car', 'Économique, business, prestige, électrique – avec ou sans
            chauffeur.'],
            ['Hébergement', 'fas fa-hotel', 'Hôtel 3★ à 5★, appart-hôtel, appartements meublés (séjours 1 semaine à 6
            mois).'],
            ['Guide touristique privé', 'fas fa-map-marked-alt', 'Circuits Paris, Versailles, Mont-Saint-Michel,
            châteaux de la Loire, Côte d\'Azur.'],
            ['Conciergerie de vie', 'fas fa-concierge-bell', 'Carte SIM, pass transport, ouverture compte en ligne,
            assurance voyage.'],
            ['Assistance installation légère', 'fas fa-hands-helping', 'Rendez-vous médical, orientation administrative,
            accompagnement campus/école.'],
            ['Business concierge', 'fas fa-briefcase', 'Salles de réunion, interprète, chauffeur à la journée, visites
            de sites / salons pro.'],
            ['VIP & événementiel', 'fas fa-crown', 'Accès lounge, fast-track, photographes, sécurité discrète (sur
            devis).']
            ] as $service)
            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 flex items-center justify-center rounded-lg"
                            style="background: var(--gold);">
                            <i class="{{ $service[1] }} text-black"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-bold mb-2" style="color: white;">{{ $service[0] }}</h4>
                        <p class="text-gray-400">{{ $service[2] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Packs conciergerie - Style sobre -->
<section id="packs" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Packs Conciergerie</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Des solutions complètes adaptées à chaque type de séjour en France
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
            ['Arrivée Essentielle', 'Séjour court (2–5 jours)', '390 €', [
            'Transfert aéroport',
            '2 nuits hôtel 3★',
            'Carte SIM',
            'Support WhatsApp'
            ]],
            ['Formation Sereine', 'Stagiaires / étudiants', '1 490 €', [
            'Transfert',
            'Appartement meublé 1 mois',
            'Carte SIM',
            'Pass transport',
            'RDV d\'accueil'
            ]],
            ['Affaires Business', 'Entrepreneurs / B2B', '890 €', [
            'Chauffeur 1 jour',
            'Hôtel 4★',
            'Salle réunion 1/2 jour',
            'Interprète 2h'
            ]],
            ['Famille Confort', 'Familles 3–6 personnes', '1 190 €', [
            'Van + siège bébé',
            'Appartement 2 chambres',
            'Panier d\'arrivée',
            'Guide 1/2 journée'
            ]]
            ] as $pack)
            <div class="p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <h3 class="text-xl font-bold mb-2" style="color: white;">{{ $pack[0] }}</h3>
                <p class="text-gray-400 mb-4">{{ $pack[1] }}</p>
                <ul class="space-y-2 mb-6">
                    @foreach($pack[3] as $item)
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: #ddd;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
                <div class="text-2xl font-bold mb-4" style="color: var(--gold);">À partir de {{ $pack[2] }}</div>
                <a href="#devis"
                    class="inline-flex items-center justify-center w-full px-4 py-3 font-semibold rounded transition duration-300"
                    style="background: var(--gold); color: black;">
                    Choisir ce pack
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Tableau des tarifs prévisionnels - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Tarifs Prévisionnels</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Estimation transparente des coûts pour vous aider à planifier sereinement votre budget
            </p>
            <div class="inline-flex items-center justify-center gap-3 mt-6 p-3 rounded"
                style="background: rgba(var(--gold-rgb), 0.1);">
                <i class="fas fa-info-circle" style="color: var(--gold);"></i>
                <span class="font-medium" style="color: var(--gold);">Tarifs indicatifs à partir de</span>
            </div>
        </div>

        <div class="overflow-x-auto rounded" style="background: #111; border: 1px solid #333;">
            <table class="w-full">
                <thead style="background: #1a1a1a;">
                    <tr>
                        <th class="py-4 px-6 text-left font-semibold" style="color: var(--gold);">Service</th>
                        <th class="py-4 px-6 text-left font-semibold" style="color: var(--gold);">Description</th>
                        <th class="py-4 px-6 text-center font-semibold" style="color: var(--gold);">Tarif</th>
                        <th class="py-4 px-6 text-center font-semibold" style="color: var(--gold);">Période</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([
                    ['Transfert Aéroport', 'Accueil avec pancarte nominative, suivi vol en temps réel', '65 €', 'Par
                    trajet'],
                    ['Location Voiture Éco', 'Clio, 208, Citadine - Assurance incluse', '49 €', 'Par jour'],
                    ['Location Voiture Prestige', 'Classe E, BMW Série 5, Tesla Model 3', '149 €', 'Par jour'],
                    ['Chauffeur Privé', 'Service 8h avec véhicule business, professionnel bilingue', '350 €', 'Par
                    journée'],
                    ['Hôtel 3★', 'Chambre double standard, petit-déjeuner inclus', '110 €', 'Par nuit'],
                    ['Appartement Studio', 'Meublé, équipé, wifi fibre, ménage inclus', '1 250 €', 'Par mois'],
                    ['Guide Paris Essentiel', 'Visite 4h des monuments, guide diplômé', '190 €', 'Par visite'],
                    ['Pack Installation Starter', 'Carte SIM + Pass Navigo + RDV d\'accueil personnalisé', '99 €',
                    'Forfait unique'],
                    ['Assistance Administrative', 'Accompagnement démarches, prise de RDV', '75 €', 'Par heure'],
                    ['Interprète', 'Traduction FR/EN/AR/ES, secteur médical ou professionnel', '45 €', 'Par heure']
                    ] as $row)
                    <tr class="border-t" style="border-color: #333;">
                        <td class="py-4 px-6 font-semibold" style="color: white;">{{ $row[0] }}</td>
                        <td class="py-4 px-6" style="color: #aaa;">{{ $row[1] }}</td>
                        <td class="py-4 px-6 text-center font-bold" style="color: var(--gold);">{{ $row[2] }}</td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm"
                                style="background: #222; color: #ccc;">
                                {{ $row[3] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Informations importantes -->
        <div class="mt-8 p-6 rounded" style="background: #111; border: 1px solid #333;">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 flex items-center justify-center rounded"
                        style="background: rgba(var(--gold-rgb), 0.2);">
                        <i class="fas fa-exclamation-triangle" style="color: var(--gold);"></i>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-2" style="color: white;">Informations importantes</h4>
                    <p class="text-gray-400">
                        Ces tarifs sont indicatifs et peuvent varier selon la saison, la durée,
                        les options choisies et la disponibilité. Les prix définitifs seront
                        confirmés dans votre devis personnalisé.
                    </p>
                </div>
            </div>
        </div>

        <!-- Cartes informatives -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
            ['Pas de frais cachés', 'fas fa-percentage', 'Tous nos tarifs incluent TVA et frais de service. Aucun
            supplément surprise.'],
            ['Garantie meilleur prix', 'fas fa-handshake', 'Nous garantissons les prix les plus compétitifs pour des
            services équivalents.'],
            ['Devis sous 24h', 'fas fa-clock', 'Recevez votre devis personnalisé en moins de 24 heures ouvrées.']
            ] as $card)
            <div class="p-6 rounded" style="background: #111; border: 1px solid #333;">
                <div class="w-12 h-12 flex items-center justify-center rounded mb-4"
                    style="background: rgba(var(--gold-rgb), 0.1);">
                    <i class="{{ $card[1] }}" style="color: var(--gold);"></i>
                </div>
                <h4 class="font-bold mb-2" style="color: white;">{{ $card[0] }}</h4>
                <p class="text-gray-400">{{ $card[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Location de voiture - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Location de voiture (avec/sans
                chauffeur)</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            @foreach([
            ['Éco', 'Clio, 208', '49 €/jour'],
            ['Business', 'Passat, Classe C', '89 €/jour'],
            ['Prestige', 'Classe E, BMW Série 5, Tesla Model 3', '149 €/jour'],
            ['Van 7 places', 'Classe V', '179 €/jour']
            ] as $vehicle)
            <div class="p-6 text-center" style="background: #1a1a1a; border: 1px solid #333;">
                <h3 class="text-lg font-bold mb-2" style="color: white;">{{ $vehicle[0] }}</h3>
                <p class="text-gray-400 mb-4">{{ $vehicle[1] }}</p>
                <div class="text-xl font-bold mb-6" style="color: var(--gold);">Dès {{ $vehicle[2] }}</div>
                <a href="{{ route('location') }}"
                    class="inline-flex items-center justify-center w-full px-4 py-3 font-semibold rounded transition duration-300"
                    style="background: var(--gold); color: black;">
                    Réserver
                </a>
            </div>
            @endforeach
        </div>

        <div class="mt-8 p-6 rounded" style="background: #1a1a1a; border: 1px solid #333;">
            <h3 class="text-lg font-bold mb-4" style="color: white;">Options disponibles :</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach([
                ['GPS', 'fas fa-map-marker-alt'],
                ['Siège bébé', 'fas fa-baby'],
                ['Conducteur additionnel', 'fas fa-user-plus'],
                ['Recharge électrique', 'fas fa-charging-station']
                ] as $option)
                <div class="flex items-center">
                    <i class="{{ $option[1] }} mr-3" style="color: var(--gold);"></i>
                    <span style="color: #ddd;">{{ $option[0] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Hébergements - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Hébergements (réseau
                partenaires)</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Hôtels 3★, 4★, 5★ (Paris, Lyon, Marseille, Bordeaux, Lille, Nice, Cannes). Apparts meublés (court /
                moyen séjour) : cuisine équipée, linge, Wi-Fi, ménage. Appart-hôtels : services hôteliers + kitchenette,
                idéal formation 2–12 semaines.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @foreach([
            ['Hôtel 3★ Paris 15e', 'Centre ville, accès transports', '110 €/nuit'],
            ['Appart meublé Studio Paris', 'Équipé, wifi, proche métro', '1 250 €/mois'],
            ['2 pièces proche La Défense', 'Pour professionnels, 2 chambres', '1 850 €/mois']
            ] as $hebergement)
            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <h3 class="text-lg font-bold mb-2" style="color: white;">{{ $hebergement[0] }}</h3>
                <p class="text-gray-400 mb-4">{{ $hebergement[1] }}</p>
                <div class="text-xl font-bold" style="color: var(--gold);">Dès {{ $hebergement[2] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Guides & expériences - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Guides & expériences privées
            </h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Guides FR/EN/AR/PT, accès coupe-file selon sites (billets en sus).
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
            ['Paris essentiel 4h', 'Tour Eiffel, Louvre, Opéra, Champs-Élysées', '190 €'],
            ['Versailles & jardins', '1/2 journée', '240 €'],
            ['Châteaux de la Loire', 'Journée', '490 €'],
            ['Bordeaux vins', 'Journée, dégustations', '520 €'],
            ['Côte d\'Azur', 'Nice–Cannes–Monaco, journée', '540 €']
            ] as $experience)
            <div class="p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <h3 class="text-lg font-bold mb-2" style="color: white;">{{ $experience[0] }}</h3>
                <p class="text-gray-400 mb-4">{{ $experience[1] }}</p>
                <div class="text-xl font-bold" style="color: var(--gold);">Dès {{ $experience[2] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Packs installation - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Packs "installation douce"</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
            ['Starter', '99 €', [
            'Carte SIM',
            'Pass Navigo',
            'RDV d\'accueil'
            ]],
            ['Study', '179 €', [
            'Tout le pack Starter +',
            'Attestation hébergement',
            'RDV assurance santé'
            ]],
            ['Pro', '290 €', [
            'Tout le pack Study +',
            'Assistance ouverture compte en ligne',
            'Salle réunion 2h'
            ]]
            ] as $pack)
            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <h3 class="text-xl font-bold mb-4" style="color: white;">{{ $pack[0] }}</h3>
                <ul class="space-y-3 mb-6">
                    @foreach($pack[2] as $item)
                    <li class="flex items-start">
                        <i class="fas fa-check mt-1 mr-3" style="color: var(--gold);"></i>
                        <span style="color: #ddd;">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
                <div class="text-2xl font-bold" style="color: var(--gold);">{{ $pack[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Formulaire devis - Style sobre -->
<section id="devis" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto p-6 md:p-8" style="background: #1a1a1a; border: 1px solid #333;">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8" style="color: var(--gold);">Demander un devis
                conciergerie personnalisé</h2>

            @if(session('success'))
            <div class="p-4 mb-6" style="background: #064e3b; border: 1px solid #047857;">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3"
                        style="background: #047857;">
                        <i class="fas fa-check-circle text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white">Demande envoyée</h4>
                        <p class="text-green-100">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3"
                        style="background: #dc2626;">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white">Veuillez corriger les erreurs suivantes :</h4>
                        <ul class="text-red-100 list-disc list-inside mt-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('conciergerie.store') }}" method="POST" id="conciergerieForm">
                @csrf

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Nom complet *</label>
                            <input type="text" name="nom" required
                                class="w-full px-4 py-3 rounded @error('nom') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;"
                                placeholder="Votre nom et prénom" value="{{ old('nom') }}">
                            @error('nom')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 rounded @error('email') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;"
                                placeholder="votre@email.com" value="{{ old('email') }}">
                            @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Téléphone *</label>
                            <input type="tel" name="telephone" required
                                class="w-full px-4 py-3 rounded @error('telephone') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;"
                                placeholder="06 12 34 56 78" value="{{ old('telephone') }}">
                            @error('telephone')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Motif du voyage *</label>
                            <select name="motif_voyage" required
                                class="w-full px-4 py-3 rounded @error('motif_voyage') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;">
                                <option value="" style="color: #666;">Sélectionnez un motif</option>
                                @foreach([
                                'tourisme' => 'Tourisme',
                                'affaires' => 'Affaires / Business',
                                'formation' => 'Formation / Études',
                                'installation' => 'Installation en France',
                                'familial' => 'Visite familiale',
                                'evenementiel' => 'Événementiel',
                                'autre' => 'Autre'
                                ] as $value => $label)
                                <option value="{{ $value }}" {{ old('motif_voyage')==$value ? 'selected' : '' }}
                                    style="color: white;">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('motif_voyage')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Date d'arrivée *</label>
                            <input type="date" name="date_arrivee" required
                                class="w-full px-4 py-3 rounded @error('date_arrivee') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;"
                                value="{{ old('date_arrivee') }}">
                            @error('date_arrivee')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Durée du séjour *</label>
                            <select name="duree_sejour" required
                                class="w-full px-4 py-3 rounded @error('duree_sejour') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;">
                                <option value="" style="color: #666;">Sélectionnez la durée</option>
                                @foreach([
                                '1-3' => '1-3 jours',
                                '4-7' => '4-7 jours',
                                '1-2' => '1-2 semaines',
                                '3-4' => '3-4 semaines',
                                '1-3' => '1-3 mois',
                                '3-6' => '3-6 mois',
                                '6+' => 'Plus de 6 mois'
                                ] as $value => $label)
                                <option value="{{ $value }}" {{ old('duree_sejour')==$value ? 'selected' : '' }}
                                    style="color: white;">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('duree_sejour')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Nombre de personnes *</label>
                            <select name="nombre_personnes" required
                                class="w-full px-4 py-3 rounded @error('nombre_personnes') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;">
                                <option value="" style="color: #666;">Sélectionnez</option>
                                @foreach([
                                '1' => '1 personne',
                                '2' => '2 personnes',
                                '3-4' => '3-4 personnes',
                                '5-6' => '5-6 personnes',
                                '7+' => 'Plus de 6 personnes'
                                ] as $value => $label)
                                <option value="{{ $value }}" {{ old('nombre_personnes')==$value ? 'selected' : '' }}
                                    style="color: white;">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('nombre_personnes')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Budget estimé (en €)</label>
                            <select name="budget"
                                class="w-full px-4 py-3 rounded @error('budget') border-red-500 @enderror"
                                style="background: #111; border: 1px solid #444; color: white;">
                                <option value="" style="color: #666;">Sélectionnez une fourchette</option>
                                @foreach([
                                '500-1000' => '500 - 1 000 €',
                                '1000-2000' => '1 000 - 2 000 €',
                                '2000-5000' => '2 000 - 5 000 €',
                                '5000-10000' => '5 000 - 10 000 €',
                                '10000+' => 'Plus de 10 000 €',
                                'sur_devis' => 'Sur devis'
                                ] as $value => $label)
                                <option value="{{ $value }}" {{ old('budget')==$value ? 'selected' : '' }}
                                    style="color: white;">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('budget')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">Type d'accompagnement souhaité
                            *</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @php
                            $oldType = old('type_accompagnement');
                            @endphp
                            @foreach([
                            'chauffeur' => ['Avec chauffeur', 'Service VTC/Chauffeur privé'],
                            'location' => ['Location de voiture', 'Sans chauffeur'],
                            'mixte' => ['Mixte', 'Chauffeur + location']
                            ] as $value => $labels)
                            <div class="flex items-center p-4 rounded cursor-pointer"
                                style="background: #111; border: 1px solid #444;">
                                <input type="radio" id="accomp_{{ $value }}" name="type_accompagnement"
                                    value="{{ $value }}" class="mr-3" {{ $oldType==$value ? 'checked' : '' }}
                                    onchange="showRedirectionInfo('{{ $value }}')">
                                <label for="accomp_{{ $value }}" class="cursor-pointer">
                                    <span class="font-medium" style="color: white;">{{ $labels[0] }}</span>
                                    <p class="text-sm mt-1" style="color: #aaa;">{{ $labels[1] }}</p>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('type_accompagnement')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <div id="redirectionInfo" class="mt-4 p-4 rounded hidden"
                            style="background: rgba(var(--gold-rgb), 0.1); border: 1px solid rgba(var(--gold-rgb), 0.3);">
                            <p style="color: var(--gold);">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span id="redirectionText"></span>
                                <a id="redirectionLink" href="#" class="font-semibold underline ml-1"
                                    style="color: var(--gold);"></a>
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">Services souhaités *</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @php
                            $oldServices = old('services', []);
                            @endphp
                            @foreach([
                            'Transfert aéroport/gare',
                            'Location voiture',
                            'Hébergement',
                            'Guide touristique',
                            'Assistance administrative',
                            'Services business',
                            'Installation/logement',
                            'Courses arrivée',
                            'Interprète/traduction',
                            'Billets spectacles',
                            'Réservation restaurants',
                            'Service ménage'
                            ] as $service)
                            <label class="flex items-center p-2 rounded cursor-pointer"
                                style="background: #111; border: 1px solid #444;">
                                <input type="checkbox" name="services[]" value="{{ $service }}" class="mr-2 rounded"
                                    style="border-color: #666;" {{ in_array($service, $oldServices) ? 'checked' : '' }}>
                                <span class="text-sm" style="color: #ddd;">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('services')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">Message / Besoins spécifiques
                            *</label>
                        <textarea name="message" rows="5" required
                            class="w-full px-4 py-3 rounded @error('message') border-red-500 @enderror"
                            style="background: #111; border: 1px solid #444; color: white;"
                            placeholder="Décrivez vos besoins en détail, vos attentes particulières, vos contraintes...">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="relative">
                        <button type="submit" id="submit-btn"
                            class="w-full px-6 md:px-8 py-3 font-semibold rounded transition-all duration-300 flex items-center justify-center"
                            style="background: var(--gold); color: black;">
                            <span id="btn-text" class="flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-3"></i>
                                Envoyer ma demande de devis
                            </span>
                            <span id="btn-loading" class="hidden flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin mr-3"></i>
                                Traitement en cours...
                            </span>
                        </button>
                    </div>

                    <p class="text-center text-sm mt-4" style="color: #888;">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Votre demande sera traitée sous 24h maximum. Nous vous enverrons un devis personnalisé.
                    </p>
                </div>
            </form>
        </div>

        <!-- Contact rapide - Style sobre -->
        <div id="contact" class="mt-12 max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: var(--gold);">
                        <i class="fas fa-phone-alt text-black"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">Téléphone</h3>
                    <a href="tel:0176380017" class="font-semibold hover:text-yellow-300" style="color: var(--gold);">01
                        76 38 00 17</a>
                </div>

                <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: #25D366;">
                        <i class="fab fa-whatsapp text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">WhatsApp</h3>
                    <p class="font-semibold" style="color: #86efac;">Disponible 24h/24</p>
                </div>

                <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: var(--gold);">
                        <i class="fas fa-envelope text-black"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">Email</h3>
                    <a href="mailto:conciergerie@djokprestige.com" class="font-semibold hover:text-yellow-300"
                        style="color: var(--gold);">
                        conciergerie@djokprestige.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide du message de succès
        const successMessage = document.getElementById('success-alert');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                successMessage.style.transition = 'opacity 0.5s ease';
                setTimeout(() => successMessage.remove(), 500);
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
        const form = document.getElementById('conciergerieForm');
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
            if (document.querySelector('[class*="border-red"]')) {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        }

        // Scroll vers le formulaire s'il y a des erreurs
        if (document.querySelector('[class*="border-red"]')) {
            setTimeout(() => {
                document.getElementById('devis').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 300);
        }

        // Définir la date minimum pour le champ date d'arrivée (aujourd'hui)
        const dateInput = document.querySelector('input[name="date_arrivee"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;

            // Si aucune valeur n'est définie, mettre la date d'aujourd'hui
            if (!dateInput.value) {
                dateInput.value = today;
            }
        }

        // Afficher la redirection si un type d'accompagnement est déjà sélectionné
        const selectedType = document.querySelector('input[name="type_accompagnement"]:checked');
        if (selectedType) {
            showRedirectionInfo(selectedType.value);
        }
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
                link.target = '_blank';
                break;
            case 'location':
                textSpan.textContent = 'Pour louer un véhicule sans chauffeur, visitez notre page';
                link.textContent = 'Location de voiture';
                link.href = "{{ route('location') }}";
                link.target = '_blank';
                break;
            case 'mixte':
                textSpan.textContent = 'Pour combiner chauffeur et location, nous vous conseillons de consulter nos deux pages :';
                link.textContent = 'VTC & Location';
                link.href = "#";
                link.target = '_blank';
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
</script>
@endsection
