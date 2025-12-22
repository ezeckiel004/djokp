@extends('layouts.main')

@section('title', 'Formation à l’International - DJOK PRESTIGE')

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
        <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
            alt="Formation International" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                Formation à l'international – Vivez l'expérience DJOK PRESTIGE en France
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12">
                Vous rêvez de venir en France pour développer vos compétences, obtenir une qualification reconnue et
                découvrir un environnement professionnel d'excellence ? DJOK PRESTIGE, centre de formation certifié
                Qualiopi, vous accueille dans un cadre idéal à Paris et en Île-de-France.
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#formations"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    Découvrir les formations
                </a>
                <a href="#accompagnement"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center border transition duration-300"
                    style="border-color: var(--gold); color: var(--gold);">
                    Accompagnement Visa
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#formations" class="text-white transition duration-300 hover:text-var(--gold)">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Domaines de formation - Style sobre -->
<section id="formations" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Domaines de formation
                disponibles</h2>
        </div>

        <!-- Formations principales -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-center mb-8" style="color: white;">Formations principales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $formations = App\Models\Formation::where('is_active', true)
                ->whereIn('categorie', ['international', 'vtc_theorique', 'vtc_pratique'])
                ->take(6)
                ->get();
                @endphp

                @if($formations->count() > 0)
                @foreach($formations as $formation)
                <div class="p-6" style="background: #111; border: 1px solid #333;">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 flex items-center justify-center rounded-lg"
                                style="background: var(--gold);">
                                <i class="fas fa-graduation-cap text-black"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold mb-2" style="color: white;">{{ $formation->title }}</h4>
                            <p class="text-gray-400">{{ Str::limit($formation->description, 100) }}</p>
                            <div class="mt-2 text-sm text-gray-500">
                                <span class="font-semibold">{{ $formation->duration_hours }}h</span>
                                •
                                <span class="font-semibold" style="color: var(--gold);">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </span>
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
                <div class="p-6" style="background: #111; border: 1px solid #333;">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 flex items-center justify-center rounded-lg"
                                style="background: var(--gold);">
                                <i class="fas fa-graduation-cap text-black"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold mb-2" style="color: white;">{{ $formation[0] }}</h4>
                            <p class="text-gray-400">{{ $formation[1] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Modules optionnels -->
        <div>
            <h3 class="text-2xl font-semibold text-center mb-8" style="color: white;">Modules optionnels</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <ul class="space-y-4">
                        @foreach(['Leadership et management', 'Développement personnel', 'Vente et négociation
                        commerciale', 'Finance d\'entreprise et fiscalité'] as $module)
                        <li class="flex items-center p-4" style="background: #111; border: 1px solid #333;">
                            <i class="fas fa-check mr-3" style="color: var(--gold);"></i>
                            <span class="font-medium" style="color: white;">{{ $module }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <ul class="space-y-4">
                        @foreach(['Gestion de projet', 'Communication interculturelle', 'Digital transformation',
                        'Stratégie d\'entreprise'] as $module)
                        <li class="flex items-center p-4" style="background: #111; border: 1px solid #333;">
                            <i class="fas fa-check mr-3" style="color: var(--gold);"></i>
                            <span class="font-medium" style="color: white;">{{ $module }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Public visé - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Public visé</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4"
                    style="background: #1e40af;">
                    <i class="fas fa-user-graduate text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Étudiants internationaux</h3>
                <p class="text-gray-400">Bénéficiez d'une immersion professionnelle certifiée et reconnue en France.</p>
            </div>

            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4"
                    style="background: #065f46;">
                    <i class="fas fa-briefcase text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Entrepreneurs & dirigeants africains</h3>
                <p class="text-gray-400">Apprenez les standards européens de gestion, d'organisation et de service à la
                    clientèle.</p>
            </div>

            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4"
                    style="background: #5b21b6;">
                    <i class="fas fa-building text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Institutions et écoles partenaires</h3>
                <p class="text-gray-400">Offrez à vos étudiants et bénéficiaires une formation internationale de qualité
                    avec hébergement inclus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Accompagnement visa - Style sobre -->
<section id="accompagnement" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Accompagnement visa &
                    arrivée</h2>
                <p class="text-gray-400 max-w-3xl mx-auto">
                    DJOK PRESTIGE vous fournit tous les documents nécessaires à votre demande de visa
                </p>
            </div>

            <div class="p-6 md:p-8 mb-12" style="background: #111; border: 1px solid #333;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-6" style="color: white;">Documents fournis</h3>
                        <ul class="space-y-4">
                            @foreach([
                            'Lettre d\'inscription et de formation',
                            'Attestation d\'hébergement',
                            'Attestation de paiement (si demandée par le consulat)',
                            'Assistance logistique pour le trajet et la réception à l\'aéroport'
                            ] as $document)
                            <li class="flex items-start">
                                <i class="fas fa-file-alt mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">{{ $document }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-6" style="color: white;">Support continu</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fab fa-whatsapp mt-1 mr-3" style="color: #25D366;"></i>
                                <span style="color: white;">Support WhatsApp pour le suivi de votre arrivée</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-plane-arrival mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">Accueil à l'aéroport</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-map-signs mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">Orientation et installation</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-headset mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">Assistance 24/7</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="#contact"
                        class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                        style="background: var(--gold); color: black;">
                        Je souhaite être accompagné dans ma demande de visa
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi choisir DJOK PRESTIGE - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Pourquoi choisir DJOK PRESTIGE ?
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach([
            ['Centre certifié Qualiopi', 'fas fa-award'],
            ['Équipe franco-africaine expérimentée', 'fas fa-users'],
            ['Formations adaptées aux réalités du terrain africain', 'fas fa-globe-africa'],
            ['Hébergement & transport intégrés', 'fas fa-home'],
            ['Service conciergerie & accompagnement personnalisé', 'fas fa-concierge-bell'],
            ['Témoignages vidéos de stagiaires internationaux', 'fas fa-video'],
            ['Réseau de partenaires Afrique–France', 'fas fa-handshake'],
            ['Transport & logistique simplifiés', 'fas fa-shipping-fast']
            ] as $avantage)
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-full mb-3"
                    style="background: var(--gold);">
                    <i class="{{ $avantage[1] }} text-black text-lg"></i>
                </div>
                <span class="text-xs md:text-sm font-medium" style="color: white;">{{ $avantage[0] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact et inscription - Style sobre -->
<section id="contact" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto p-6 md:p-8" style="background: #111; border: 1px solid #333;">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8" style="color: var(--gold);">Demander un
                programme personnalisé</h2>

            @if(session('error'))
            <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;" id="error-message">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3"
                        style="background: #dc2626;">
                        <i class="fas fa-exclamation-circle text-white"></i>
                    </div>
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

            <form action="{{ route('formation-internationale.store') }}" method="POST" id="formation-form">
                @csrf

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Nom complet *</label>
                            <input type="text" name="nom" required value="{{ old('nom') }}"
                                class="w-full px-4 py-3 rounded @error('nom') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="Votre nom et prénom">
                            @error('nom')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Nationalité *</label>
                            <input type="text" name="nationalite" required value="{{ old('nationalite') }}"
                                class="w-full px-4 py-3 rounded @error('nationalite') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="Votre nationalité">
                            @error('nationalite')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Email *</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded @error('email') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="votre@email.com">
                            @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Téléphone (WhatsApp) *</label>
                            <input type="tel" name="telephone" required value="{{ old('telephone') }}"
                                class="w-full px-4 py-3 rounded @error('telephone') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="+33 1 23 45 67 89">
                            @error('telephone')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">WhatsApp (si différent)</label>
                        <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}"
                            class="w-full px-4 py-3 rounded @error('whatsapp') border-red-500 @enderror"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;"
                            placeholder="+225 07 00 00 00 00">
                        @error('whatsapp')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">Type de formation souhaitée *</label>
                        <select name="formation" required
                            class="w-full px-4 py-3 rounded @error('formation') border-red-500 @enderror"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;">
                            <option value="" style="color: #666;">Sélectionnez une formation</option>
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
                                    '' }} style="color: white;">
                                    {{ $formation->title }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endif

                            <optgroup label="Autres formations">
                                <option value="vtc" {{ old('formation')=='vtc' ? 'selected' : '' }}
                                    style="color: white;">Formation VTC</option>
                                <option value="micro_entreprise" {{ old('formation')=='micro_entreprise' ? 'selected'
                                    : '' }} style="color: white;">
                                    Formation Micro-entreprise & gestion</option>
                                <option value="marketing" {{ old('formation')=='marketing' ? 'selected' : '' }}
                                    style="color: white;">
                                    Formation Communication & marketing digital</option>
                                <option value="creation_entreprise" {{ old('formation')=='creation_entreprise'
                                    ? 'selected' : '' }} style="color: white;">
                                    Formation Création d'entreprise</option>
                                <option value="bureautique" {{ old('formation')=='bureautique' ? 'selected' : '' }}
                                    style="color: white;">
                                    Formation Bureautique & Excel</option>
                                <option value="langue" {{ old('formation')=='langue' ? 'selected' : '' }}
                                    style="color: white;">Formation Langue & accueil client</option>
                                <option value="personnalise" {{ old('formation')=='personnalise' ? 'selected' : '' }}
                                    style="color: white;">
                                    Programme personnalisé</option>
                            </optgroup>
                        </select>
                        @error('formation')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">Services d'accompagnement
                            nécessaires</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
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
                            <label class="flex items-center p-2 rounded cursor-pointer"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;">
                                <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service,
                                    $oldServices) ? 'checked' : '' }} class="mr-3 rounded" style="border-color: #666;">
                                <span class="text-sm">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">Votre projet et besoins spécifiques
                            *</label>
                        <textarea name="message" rows="4" required
                            class="w-full px-4 py-3 rounded @error('message') border-red-500 @enderror"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;"
                            placeholder="Décrivez votre projet professionnel, vos attentes, et toute information utile...">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Date de début souhaitée</label>
                            <input type="date" name="date_debut" value="{{ old('date_debut') }}"
                                class="w-full px-4 py-3 rounded @error('date_debut') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;">
                            @error('date_debut')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">Durée estimée du séjour</label>
                            <select name="duree"
                                class="w-full px-4 py-3 rounded @error('duree') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;">
                                <option value="" style="color: #666;">Sélectionnez une durée</option>
                                <option value="1-2 semaines" {{ old('duree')=='1-2 semaines' ? 'selected' : '' }}
                                    style="color: white;">1-2 semaines</option>
                                <option value="1 mois" {{ old('duree')=='1 mois' ? 'selected' : '' }}
                                    style="color: white;">1 mois</option>
                                <option value="3 mois" {{ old('duree')=='3 mois' ? 'selected' : '' }}
                                    style="color: white;">3 mois</option>
                                <option value="6 mois" {{ old('duree')=='6 mois' ? 'selected' : '' }}
                                    style="color: white;">6 mois</option>
                                <option value="1 an" {{ old('duree')=='1 an' ? 'selected' : '' }} style="color: white;">
                                    1 an</option>
                            </select>
                            @error('duree')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="relative">
                        <button type="submit" id="submit-btn"
                            class="w-full px-6 md:px-8 py-3 font-semibold rounded transition-all duration-300 flex items-center justify-center"
                            style="background: var(--gold); color: black;">
                            <span id="btn-text" class="flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-3"></i>
                                Envoyer ma demande de programme
                            </span>
                            <span id="btn-loading" class="hidden flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin mr-3"></i>
                                Traitement en cours...
                            </span>
                        </button>
                    </div>

                    <p class="text-center text-sm mt-4" style="color: #888;">
                        <i class="fas fa-shield-alt mr-2"></i>
                        Vos informations sont sécurisées et ne seront pas partagées avec des tiers.
                    </p>
                </div>
            </form>
        </div>

        <!-- Contact rapide - Style sobre -->
        <div class="mt-12 max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6" style="background: #111; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: #1e40af;">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">Téléphone international</h3>
                    <a href="tel:+33176380017" class="font-semibold hover:text-blue-300" style="color: #60a5fa;">+33 1
                        76 38 00 17</a>
                </div>

                <div class="text-center p-6" style="background: #111; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: #25D366;">
                        <i class="fab fa-whatsapp text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">WhatsApp</h3>
                    <p class="font-semibold" style="color: #86efac;">Disponible 24h/24</p>
                </div>

                <div class="text-center p-6" style="background: #111; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: var(--gold);">
                        <i class="fas fa-envelope text-black"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">Email</h3>
                    <a href="mailto:international@djokprestige.com" class="font-semibold hover:text-yellow-300"
                        style="color: var(--gold);">
                        international@djokprestige.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
            if (document.querySelector('[class*="border-red"]')) {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        }

        // Scroll vers le formulaire s'il y a des erreurs
        if (document.querySelector('[class*="border-red"]')) {
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
