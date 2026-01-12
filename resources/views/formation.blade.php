@extends('layouts.main')

@section('title', 'Formation VTC Professionnel | DJOK PRESTIGE')

@section('content')
<!-- Messages de succès/erreur - Style sobre -->
<div class="container px-4 mx-auto md:px-6">
    @if(session('success'))
    <div class="mt-6 mb-6">
        <div class="p-4" style="background: #111; border-left: 4px solid #b89449;">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle" style="color: #b89449;"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-white">{{ session('success') }}</p>
                    @if(str_contains(session('success'), 'Félicitations'))
                    <p class="mt-1 text-sm text-gray-300">
                        Vous pouvez maintenant accéder à votre formation depuis votre espace personnel.
                        <a href="{{ route('client.formations.index') }}"
                            class="font-semibold underline hover:text-gray-100">
                            Voir mes formations
                        </a>
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mt-6 mb-6">
        <div class="p-4" style="background: #2a0f0f; border-left: 4px solid #f56565;">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle" style="color: #f56565;"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-white">{{ session('error') }}</p>
                    <p class="mt-1 text-sm text-gray-300">
                        Si le problème persiste, contactez notre support au 01 76 38 00 17
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="mt-6 mb-6">
        <div class="p-4" style="background: #0f2a3d; border-left: 4px solid #4299e1;">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle" style="color: #4299e1;"></i>
                </div>
                <div class="ml-3">
                    <p class="text-white">{{ session('info') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Hero Section - Style sobre -->
<header class="relative flex items-center min-h-screen" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
            alt="Formation VTC" class="object-cover w-full h-full opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container relative z-10 px-4 py-20 mx-auto md:px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="mb-8 text-3xl font-bold md:text-4xl lg:text-5xl" style="color: #b89449;">
                Devenez chauffeur VTC professionnel avec DJOK PRESTIGE
            </h1>

            <p class="mb-10 text-lg text-gray-300 md:text-xl">
                Rejoignez un centre de formation certifié Qualiopi et agréé VTC par la Préfecture, reconnu pour la
                qualité de son accompagnement et son taux de réussite exceptionnel.
            </p>

            <p class="mb-12 text-lg" style="color: #b89449;">
                Plusieurs chauffeurs déjà formés avec succès !
            </p>

            <!-- Avantages clés - Style sobre -->
            <div class="grid grid-cols-1 gap-6 mb-16 md:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-clock"></i>
                    </div>
                    <span class="text-sm text-center">Formation complète en présentiel ou en ligne</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-euro-sign"></i>
                    </div>
                    <span class="text-sm text-center">Finançable jusqu'à 100% (CPF, OPCO, Pôle Emploi)</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-chalkboard-teacher"></i>
                    </div>
                    <span class="text-sm text-center">Formateurs experts issus du terrain</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-car"></i>
                    </div>
                    <span class="text-sm text-center">Formation pratique sur véhicule professionnel</span>
                </div>
            </div>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="#formations"
                    class="w-full px-8 py-3 font-semibold text-center transition duration-300 sm:w-auto"
                    style="background: #b89449; color: black;">
                    Voir nos formations
                </a>
                <a href="#inscription"
                    class="w-full px-8 py-3 font-semibold text-center transition duration-300 border sm:w-auto"
                    style="border-color: #b89449; color: #b89449;">
                    Demander un devis
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute transform -translate-x-1/2 bottom-8 left-1/2">
        <a href="#formations" class="text-white transition duration-300 hover:text-b89449">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Nos formations disponibles - Tableau moderne style noir -->
<section id="formations" class="py-16" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-8 text-center">
            <h2 class="mb-2 text-2xl font-bold md:text-3xl" style="color: #b89449;">NOS FORMATIONS THÉORIQUES VTC</h2>
            <p class="max-w-3xl mx-auto text-sm italic text-gray-400 md:text-base">
                Cliquez sur une formation pour obtenir plus d'informations et un devis gratuit
            </p>
        </div>

        <!-- Tableau principal -->
        <div class="overflow-x-auto">
            <div class="min-w-full" style="background: #111; border-radius: 18px; overflow: hidden;">
                <!-- En-tête du tableau (desktop seulement) -->
                <div class="hidden px-4 py-3 font-bold text-center bg-black md:grid md:grid-cols-6">
                    <div class="text-white"></div>
                    <div class="py-2 text-white">Durée</div>
                    <div class="py-2 text-white">E-learning</div>
                    <div class="py-2 text-white">Frais d'examen</div>
                    <div class="py-2 text-white">Véhicule examen</div>
                    <div class="py-2 text-white"></div>
                </div>

                <!-- Lignes des formations -->
                @forelse($formations as $formation)
                <div class="formation-row group">
                    <!-- Mobile: Label en pleine largeur -->
                    <div class="md:hidden">
                        @php
                        $labelColor = $formation->type_formation == 'presentiel' ? '#2bb3e6' : '#9bc64c';
                        @endphp
                        <div class="w-full formation-label-mobile" style="background: {{ $labelColor }};">
                            <div class="px-6 py-4 text-sm font-bold leading-tight text-center text-white md:text-base">
                                @php
                                $titleParts = explode(' ', $formation->title);
                                $formattedTitle = $formation->title;

                                if (count($titleParts) >= 3) {
                                $firstWord = strtoupper($titleParts[0]);
                                $rest = implode(' ', array_slice($titleParts, 1));

                                if (str_contains($firstWord, 'THÉORIE') || str_contains($firstWord, 'E-LEARNING') ||
                                str_contains($firstWord, 'COMPLET')) {
                                $formattedTitle = $firstWord . '<br>' . $rest;
                                }
                                }
                                @endphp
                                {!! $formattedTitle !!}
                            </div>
                        </div>
                    </div>

                    <!-- Desktop: Grille normale -->
                    <div
                        class="hidden px-4 py-3 transition duration-200 border-b border-gray-800 md:grid md:grid-cols-6 md:items-center group-hover:bg-gray-900">
                        <!-- Label avec forme flèche - Première colonne -->
                        <div class="flex justify-center">
                            @php
                            $labelColor = $formation->type_formation == 'presentiel' ? '#2bb3e6' : '#9bc64c';
                            @endphp

                            <div class="formation-label-desktop" style="background: {{ $labelColor }};">
                                <div
                                    class="max-w-xs px-6 py-3 text-sm font-bold leading-tight text-white whitespace-normal md:text-base">
                                    {!! $formattedTitle ?? $formation->title !!}
                                </div>
                            </div>
                        </div>

                        <!-- Durée - Deuxième colonne -->
                        <div class="py-2 text-sm text-center text-gray-300">
                            {{ $formation->duree ?? '–' }}
                        </div>

                        <!-- E-learning - Troisième colonne -->
                        <div class="py-2 text-sm text-center text-gray-300">
                            @if($formation->type_formation == 'e_learning')
                            Théorique{{ $formation->categorie == 'vtc_pratique' ? '<br>+ pratique' : '' }}
                            @else
                            {{ str_contains(strtolower($formation->format_affichage), 'présentiel') ? 'Présentiel' :
                            $formation->format_affichage }}
                            @endif
                        </div>

                        <!-- Frais d'examen - Quatrième colonne -->
                        <div class="py-2 text-sm text-center text-gray-300">
                            {{ $formation->frais_examen == 'Inclus' ? 'inclus' : '–' }}
                        </div>

                        <!-- Véhicule examen - Cinquième colonne -->
                        <div class="py-2 text-sm text-center text-gray-300">
                            {{ $formation->location_vehicule == 'Inclus' ? 'inclus' : '–' }}
                        </div>

                        <!-- Prix avec effet hover - Sixième colonne -->
                        <div class="py-2 text-center">
                            @php
                            $priceColor = $formation->type_formation == 'presentiel' ? '#2bb3e6' : '#9bc64c';
                            @endphp

                            <a href="{{ route('formation.show', $formation->slug) }}"
                                class="relative inline-block px-4 py-2 overflow-hidden font-bold text-white transition-all duration-300 rounded-lg cursor-pointer price-btn"
                                style="background: {{ $priceColor }}; min-width: 120px;"
                                onmouseover="this.style.background='{{ $priceColor == '#2bb3e6' ? '#1a8fbe' : '#7fa63c' }}'"
                                onmouseout="this.style.background='{{ $priceColor }}'">
                                <span class="block text-sm transition-all duration-300 price-text md:text-base">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </span>
                                <span
                                    class="absolute inset-0 flex items-center justify-center text-sm transition-all duration-300 transform translate-y-2 opacity-0 price-hover-text md:text-base">
                                    Découvrir
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- Mobile: Contenu sous le label -->
                    <div class="bg-gray-900 border-b border-gray-800 md:hidden">
                        <div class="p-4 space-y-3">
                            <!-- Informations -->
                            <div class="grid grid-cols-2 gap-3 text-sm text-gray-300">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-400">Durée:</span>
                                    <span>{{ $formation->duree ?? '–' }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-400">E-learning:</span>
                                    <span>
                                        @if($formation->type_formation == 'e_learning')
                                        Théorique{{ $formation->categorie == 'vtc_pratique' ? '+ pratique' : '' }}
                                        @else
                                        {{ str_contains(strtolower($formation->format_affichage), 'présentiel') ?
                                        'Présentiel' : $formation->format_affichage }}
                                        @endif
                                    </span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-400">Frais d'examen:</span>
                                    <span>{{ $formation->frais_examen == 'Inclus' ? 'inclus' : '–' }}</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-400">Véhicule examen:</span>
                                    <span>{{ $formation->location_vehicule == 'Inclus' ? 'inclus' : '–' }}</span>
                                </div>
                            </div>

                            <!-- Bouton Prix -->
                            <div class="pt-3">
                                @php
                                $priceColor = $formation->type_formation == 'presentiel' ? '#2bb3e6' : '#9bc64c';
                                @endphp
                                <a href="{{ route('formation.show', $formation->slug) }}"
                                    class="relative inline-block w-full px-4 py-3 overflow-hidden font-bold text-center text-white transition-all duration-300 rounded-lg cursor-pointer price-btn-mobile"
                                    style="background: {{ $priceColor }};">
                                    <span class="block text-base transition-all duration-300 price-text-mobile">
                                        {{ number_format($formation->price, 0, ',', ' ') }} € - Découvrir
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Message aucune formation -->
                <div class="col-span-6 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 mb-3 bg-gray-900 rounded-full">
                        <i class="text-xl text-gray-400 fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="mb-1 text-base font-semibold text-white">Aucune formation disponible</h3>
                    <p class="text-sm text-gray-400">Nos formations seront bientôt disponibles. Revenez prochainement !
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Section cartes avec détail -->
        <div class="mt-12">
            <div class="mb-8 text-center">
                <h2 class="mb-2 text-xl font-bold md:text-2xl" style="color: #b89449;">Découvrez nos formations en
                    détail</h2>
                <p class="max-w-3xl mx-auto text-sm text-gray-400 md:text-base">
                    Chaque formation est conçue pour vous offrir la meilleure expérience d'apprentissage,
                    avec un accompagnement personnalisé et des ressources multimédias complètes.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($formations as $formation)
                <div
                    class="overflow-hidden transition duration-300 bg-gray-900 border border-gray-800 rounded-lg hover:border-gray-700">
                    <!-- En-tête avec badge -->
                    @php
                    $videoMedia = $formation->media->where('type', 'video')->first();
                    $badgeColor = $formation->type_formation === 'e_learning' ? '#46b94c' : '#b89449';
                    @endphp

                    <div class="relative h-40" style="background: #000;">
                        @if($videoMedia && $videoMedia->thumbnail_path)
                        <img src="{{ $videoMedia->thumbnail_url }}" alt="{{ $formation->title }}"
                            class="object-cover w-full h-full opacity-70">
                        @else
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <i class="mb-2 text-2xl text-white fas fa-graduation-cap"></i>
                                <p class="text-sm font-semibold text-white">{{ Str::limit($formation->title, 30) }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Badge type de formation -->
                        <div class="absolute top-3 right-3">
                            <span class="px-2 py-1 text-xs font-semibold text-white rounded"
                                style="background: {{ $badgeColor }};">
                                {{ $formation->type_formation === 'e_learning' ? 'En ligne' : 'Présentiel' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-4">
                        <!-- Catégorie -->
                        <div class="mb-2">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded"
                                style="background: #222; color: #ddd;">
                                {{ $formation->categorie === 'vtc_theorique' ? 'VTC Théorique' :
                                ($formation->categorie === 'vtc_pratique' ? 'VTC Pratique' :
                                ($formation->categorie === 'e_learning' ? 'E-learning' : 'Renouvellement')) }}
                            </span>
                        </div>

                        <!-- Titre -->
                        <h3 class="mb-1 text-base font-bold text-white truncate">{{ $formation->title }}</h3>

                        <!-- Description courte -->
                        <p class="mb-3 text-xs text-gray-400">
                            {{ Str::limit(strip_tags($formation->description), 80) }}
                        </p>

                        <!-- Stats -->
                        <div class="flex items-center justify-between mb-3 text-xs text-gray-500">
                            <div class="flex items-center">
                                <i class="mr-1 text-gray-400 fas fa-clock"></i>
                                <span>{{ $formation->duree ?? 'Non définie' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="mr-1 text-gray-400 fas fa-video"></i>
                                <span>{{ $formation->media->where('type', 'video')->count() }} vidéos</span>
                            </div>
                            <div class="flex items-center">
                                <i class="mr-1 text-gray-400 fas fa-file-pdf"></i>
                                <span>{{ $formation->media->where('type', 'pdf')->count() }} PDF</span>
                            </div>
                        </div>

                        <!-- Prix -->
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="text-lg font-bold" style="color: #b89449;">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </span>
                                <span class="block text-xs text-gray-500">TTC</span>
                            </div>

                            <!-- Frais inclus -->
                            <div class="text-right">
                                @if($formation->frais_examen === 'Inclus')
                                <span class="px-2 py-1 text-xs rounded"
                                    style="background: #064e3b; color: #a7f3d0;">Examen inclus</span>
                                @endif
                                @if($formation->location_vehicule === 'Inclus')
                                <span class="block px-2 py-1 mt-1 text-xs rounded"
                                    style="background: #064e3b; color: #a7f3d0;">Véhicule inclus</span>
                                @endif
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="space-y-2">
                            <!-- Bouton Programme PDF -->
                            @if($formation->program || $formation->programme_pdf_exists)
                            <a href="{{ $formation->programme_pdf_route }}" target="_blank"
                                class="inline-flex items-center justify-center w-full px-3 py-2 text-xs font-semibold transition-all duration-300 rounded hover:bg-blue-800"
                                style="background: #1e40af; color: white;" title="Voir le programme détaillé"
                                onclick="trackPdfView('{{ $formation->title }}')">
                                <i class="mr-2 fas fa-file-pdf"></i>
                                Télécharger le programme
                            </a>
                            @endif

                            <!-- Bouton Détails -->
                            <a href="{{ route('formation.show', $formation->slug) }}"
                                class="inline-flex items-center justify-center w-full px-3 py-2 text-xs font-semibold transition-all duration-300 rounded hover:bg-gray-800"
                                style="background: #111; color: white;">
                                <i class="mr-2 fas fa-info-circle"></i>
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($formations->count() === 0)
            <div class="py-8 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 mb-3 bg-gray-900 rounded-full">
                    <i class="text-xl text-gray-400 fas fa-graduation-cap"></i>
                </div>
                <h3 class="mb-1 text-base font-semibold text-white">Aucune formation disponible</h3>
                <p class="text-sm text-gray-400">Nos formations seront bientôt disponibles. Revenez prochainement !</p>
            </div>
            @endif
        </div>

        <!-- Boutons d'action -->
        <div class="flex flex-col justify-center gap-3 mt-8 sm:flex-row">
            <a href="#inscription"
                class="inline-flex items-center px-6 py-2 text-base font-semibold transition-all duration-300"
                style="background: #b89449; color: black;">
                S'inscrire maintenant
            </a>
            <a href="#" class="inline-flex items-center px-6 py-2 text-base font-semibold transition-all duration-300"
                style="background: #111; color: white; border: 1px solid #333;">
                Télécharger la brochure complète
            </a>
        </div>
    </div>
</section>

<!-- Programme officiel VTC - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Contenu de la formation –
                Programme officiel VTC</h2>
            <p class="max-w-3xl mx-auto text-gray-400">
                Le programme DJOK PRESTIGE couvre l'ensemble des épreuves prévues par les CMA (Chambres des Métiers et
                de l'Artisanat). Il prépare efficacement aux épreuves théoriques et pratiques du T3P.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Épreuve A -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: #b89449;">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 mr-3 text-sm font-semibold" style="background: #b89449; color: black;">
                        ÉPREUVE A
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 3</span>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">Réglementation du T3P & Prévention</h3>
                <p class="mb-4 text-gray-400">Durée : 45 minutes • Questions : 5 QRC + 10 QCM</p>
                <p class="text-gray-300">Apprenez les règles du transport public, les obligations légales du chauffeur
                    et les principes de prévention.</p>
            </div>

            <!-- Épreuve B -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: #b89449;">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 mr-3 text-sm font-semibold" style="background: #b89449; color: black;">
                        ÉPREUVE B
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 2</span>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">Gestion d'entreprise</h3>
                <p class="mb-4 text-gray-400">Durée : 45 minutes • Questions : 2 QRC + 16 QCM</p>
                <p class="text-gray-300">Maîtrisez la création d'entreprise VTC, la facturation, la fiscalité et la
                    gestion quotidienne.</p>
            </div>

            <!-- Épreuve C -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: #b89449;">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 mr-3 text-sm font-semibold" style="background: #b89449; color: black;">
                        ÉPREUVE C
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 3</span>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">Sécurité routière</h3>
                <p class="mb-4 text-gray-400">Durée : 30 minutes • Questions : 20 QCM</p>
                <p class="text-gray-300">Approfondissez vos connaissances en sécurité, code de la route professionnel et
                    conduite écologique.</p>
            </div>

            <!-- Épreuve D -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: #b89449;">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 mr-3 text-sm font-semibold" style="background: #b89449; color: black;">
                        ÉPREUVE D
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 2</span>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">Langue française</h3>
                <p class="mb-4 text-gray-400">Durée : 30 minutes • Questions : 3 QRC + 7 QCM</p>
                <p class="text-gray-300">Développez une expression orale et écrite fluide avec un vocabulaire
                    professionnel.</p>
            </div>

            <!-- Épreuve E -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: #b89449;">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 mr-3 text-sm font-semibold" style="background: #b89449; color: black;">
                        ÉPREUVE E
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 1</span>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">Langue anglaise (niveau A2)</h3>
                <p class="mb-4 text-gray-400">Durée : 30 minutes • Questions : 20 QCM</p>
                <p class="text-gray-300">Maîtrisez les bases de l'anglais professionnel pour échanger avec une clientèle
                    internationale.</p>
            </div>

            <!-- Épreuve F -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: #b89449;">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 mr-3 text-sm font-semibold" style="background: #b89449; color: black;">
                        ÉPREUVE F
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 3</span>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">Développement commercial spécifique VTC</h3>
                <p class="mb-4 text-gray-400">Durée : 30 minutes • Questions : 4 QRC + 12 QCM</p>
                <p class="text-gray-300">Apprenez à trouver des clients, à fidéliser et à maximiser vos revenus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Formation pratique VTC - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 md:gap-12">
            <div>
                <h2 class="mb-6 text-2xl font-bold md:text-3xl" style="color: #b89449;">Formation pratique VTC</h2>
                <p class="mb-6 text-gray-400">
                    La pratique est au cœur de la pédagogie DJOK PRESTIGE. Nos formateurs expérimentés vous accompagnent
                    sur le terrain pour acquérir la maîtrise de la conduite professionnelle.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-car" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Mise en situation réelle</h4>
                            <p class="text-sm text-gray-400">Accueil client, trajet, GPS, bagages</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-comments" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Communication et service client premium</h4>
                            <p class="text-sm text-gray-400">Relation client haut de gamme</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-exclamation-triangle" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Gestion des imprévus et sécurité</h4>
                            <p class="text-sm text-gray-400">Réactions adaptées aux situations critiques</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8" style="background: #111;">
                <h3 class="mb-4 text-lg font-bold text-white md:text-xl">Évaluation pratique</h3>
                <p class="mb-6 text-gray-400">Vous serez évalué sur :</p>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                        <span class="text-white">Préparation du véhicule</span>
                    </li>
                    <li class="flex items-center">
                        <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                        <span class="text-white">Planification et exécution du trajet</span>
                    </li>
                    <li class="flex items-center">
                        <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                        <span class="text-white">Sécurité et confort du client</span>
                    </li>
                    <li class="flex items-center">
                        <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                        <span class="text-white">Communication professionnelle</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Formation e-learning - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 md:gap-12">
            <div class="text-white">
                <h2 class="mb-6 text-2xl font-bold md:text-3xl">Formation e-learning full option</h2>
                <p class="mb-6 text-gray-400">
                    Vous n'avez pas la possibilité de venir en centre ? Notre formation à distance vous permet
                    d'apprendre à votre rythme grâce à une plateforme intuitive.
                </p>

                <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2">
                    <div class="flex items-center">
                        <i class="mr-3 fas fa-video" style="color: #b89449;"></i>
                        <span>Modules vidéo + PDF interactifs</span>
                    </div>
                    <div class="flex items-center">
                        <i class="mr-3 fas fa-question-circle" style="color: #b89449;"></i>
                        <span>Quiz et exercices corrigés</span>
                    </div>
                    <div class="flex items-center">
                        <i class="mr-3 fas fa-user-tie" style="color: #b89449;"></i>
                        <span>Accompagnement individuel</span>
                    </div>
                    <div class="flex items-center">
                        <i class="mr-3 fas fa-calendar-alt" style="color: #b89449;"></i>
                        <span>Accès illimité 12 mois</span>
                    </div>
                </div>

                <a href="#formations"
                    class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                    style="background: #b89449; color: black;">
                    <i class="mr-3 fas fa-laptop"></i>Découvrir nos formations en ligne
                </a>
            </div>

            <div class="p-6 md:p-8" style="background: #111; color: white;">
                <h3 class="mb-4 text-lg font-bold md:text-xl">Formation continue – Renouvellement carte VTC</h3>
                <p class="mb-4 text-gray-400">
                    Obligation légale : la carte VTC doit être renouvelée tous les 5 ans. DJOK PRESTIGE propose un
                    module complet de 14 heures validé par la Préfecture.
                </p>
                <div class="p-4" style="background: #222;">
                    <div>
                        <h4 class="font-bold">Objectifs :</h4>
                        <p class="text-sm text-gray-400">Mise à jour réglementaire • Sécurité routière • Service client
                            • Nouvelles tendances</p>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-bold md:text-3xl" style="color: #b89449;">160 €</div>
                        <div class="text-sm text-gray-400">TTC</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Conditions d'inscription - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 md:gap-12">
            <div>
                <h2 class="mb-6 text-2xl font-bold md:text-3xl" style="color: #b89449;">Conditions d'inscription à
                    l'examen VTC</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-passport" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Nationalité et statut</h4>
                            <p class="text-gray-400">Citoyen européen ou titre de séjour valide en France</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-id-card" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Permis de conduire</h4>
                            <p class="text-gray-400">Permis B depuis au moins 3 ans</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-heartbeat" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Aptitude physique</h4>
                            <p class="text-gray-400">Aptitude à la conduite professionnelle</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="mt-1 mr-3 fas fa-gavel" style="color: #b89449;"></i>
                        <div>
                            <h4 class="font-semibold text-white">Casier judiciaire</h4>
                            <p class="text-gray-400">Casier judiciaire vierge (bulletin n°2)</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 mt-8" style="background: #b89449; color: black;">
                    <p>
                        <i class="mr-2 fas fa-info-circle"></i>
                        Le PSC1 (Prévention et secours civiques de niveau 1) est conseillé mais non obligatoire à
                        l'inscription.
                    </p>
                </div>
            </div>

            <div>
                <h2 class="mb-6 text-2xl font-bold md:text-3xl" style="color: #b89449;">Dossier d'inscription CMA
                </h2>
                <p class="mb-6 text-gray-400">
                    Depuis 2017, les CMA gèrent les examens VTC. DJOK PRESTIGE vous accompagne dans la constitution de
                    votre dossier.
                </p>

                <div class="p-6 mb-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <h4 class="mb-4 font-bold text-white">Documents requis :</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-file-alt" style="color: #60a5fa;"></i>
                            <span class="text-white">Pièce d'identité ou titre de séjour valide</span>
                        </li>
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-id-card" style="color: #60a5fa;"></i>
                            <span class="text-white">Permis B recto-verso lisible</span>
                        </li>
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-home" style="color: #60a5fa;"></i>
                            <span class="text-white">Justificatif de domicile (-3 mois)</span>
                        </li>
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-camera" style="color: #60a5fa;"></i>
                            <span class="text-white">Photo d'identité 35x45 mm</span>
                        </li>
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-euro-sign" style="color: #60a5fa;"></i>
                            <span class="text-white">Règlement CMA (233 €)</span>
                        </li>
                    </ul>
                </div>

                <div class="p-4" style="background: #064e3b; border: 1px solid #047857;">
                    <p class="text-white">
                        <i class="mr-2 fas fa-check-circle" style="color: #a7f3d0;"></i>
                        DJOK PRESTIGE s'occupe de votre dossier de A à Z ! Nous transmettons directement votre
                        inscription à la CMA partenaire.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi choisir DJOK PRESTIGE - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Pourquoi choisir DJOK PRESTIGE ?
            </h2>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-12 md:grid-cols-2 lg:grid-cols-3">
            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="mb-4 text-xl" style="color: #b89449;">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold text-white">Formation complète et finançable</h4>
                <p class="text-gray-400">CPF, OPCO, Pôle emploi</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="mb-4 text-xl" style="color: #b89449;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold text-white">Accompagnement personnalisé</h4>
                <p class="text-gray-400">Administratif et pédagogique</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="mb-4 text-xl" style="color: #b89449;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold text-white">Taux de réussite exceptionnel</h4>
                <p class="text-gray-400">Supérieur à 95 %</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="mb-4 text-xl" style="color: #b89449;">
                    <i class="fas fa-users"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold text-white">Formateurs agréés et pédagogues</h4>
                <p class="text-gray-400">Experts issus du terrain</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="mb-4 text-xl" style="color: #b89449;">
                    <i class="fas fa-car"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold text-white">Matériel moderne</h4>
                <p class="text-gray-400">Véhicules récents et simulateurs</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="mb-4 text-xl" style="color: #b89449;">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold text-white">Paiement flexible</h4>
                <p class="text-gray-400">En plusieurs fois possible</p>
            </div>
        </div>

        <div class="text-center">
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="#formations"
                    class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                    style="background: #b89449; color: black;">
                    <i class="mr-3 fas fa-user-plus"></i>Je m'inscris dès maintenant
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                    style="background: #111; color: white; border: 1px solid #333;">
                    <i class="mr-3 fas fa-phone"></i>Être rappelé par un conseiller
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Accompagnement post-formation - Style sobre -->
<section class="py-16" style="background: #b89449; color: black;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl">Accompagnement post-formation</h2>
            <p class="max-w-3xl mx-auto text-lg">
                Chez DJOK PRESTIGE, nous allons au-delà de la formation. Nos conseillers vous accompagnent dans vos
                démarches pour l'obtention de la carte VTC, la création de votre entreprise, et même le financement de
                votre véhicule.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="mb-4 text-xl">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold">Création d'entreprise</h4>
                <p>Micro-entreprise / SASU</p>
            </div>

            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="mb-4 text-xl">
                    <i class="fas fa-calculator"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold">Simulation de rentabilité</h4>
                <p>Planification financière</p>
            </div>

            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="mb-4 text-xl">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold">Partenariats exclusifs</h4>
                <p>Véhicules et assurances</p>
            </div>

            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="mb-4 text-xl">
                    <i class="fas fa-key"></i>
                </div>
                <h4 class="mb-2 text-lg font-bold">Accès privilégié</h4>
                <p>Offres de location DJOK PRESTIGE</p>
            </div>
        </div>
    </div>
</section>

<!-- Section inscription - Style sobre -->
<section id="inscription" class="py-16" style="background: #111;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-4xl p-6 mx-auto md:p-8" style="background: #1a1a1a; border: 1px solid #333;">
            <h2 class="mb-8 text-2xl font-bold text-center md:text-3xl" style="color: #b89449;">Demande
                d'information</h2>

            @if(session('success') && !str_contains(session('success'), 'Félicitations'))
            <div class="p-4 mb-6" style="background: #064e3b; border: 1px solid #047857;">
                <div class="flex items-center">
                    <i class="mr-3 fas fa-check-circle" style="color: #a7f3d0;"></i>
                    <div>
                        <h4 class="font-bold text-white">Message envoyé</h4>
                        <p class="text-green-100">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- AFFICHAGE DES ERREURS -->
            @if($errors->any())
            <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;">
                <div class="flex items-center">
                    <i class="mr-3 fas fa-exclamation-circle" style="color: #fca5a5;"></i>
                    <div>
                        <h4 class="font-bold text-white">Veuillez corriger les erreurs suivantes :</h4>
                        <ul class="mt-1 text-sm text-red-100">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                <div>
                    <h3 class="mb-4 text-lg font-bold text-white md:text-xl">Nous contacter</h3>
                    <p class="mb-6 text-gray-400">Remplissez ce formulaire pour obtenir plus d'informations sur nos
                        formations.</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- CHAMP CACHÉ POUR SERVICE_ID -->
                        <input type="hidden" name="service_id" value="autre">

                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2" style="color: #ddd;">Nom complet *</label>
                                <input type="text" name="nom" value="{{ old('nom') }}" required
                                    class="w-full px-4 py-3 {{ $errors->has('nom') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;">
                                @error('nom')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;">
                                @error('email')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Téléphone</label>
                                <input type="tel" name="telephone" value="{{ old('telephone') }}"
                                    class="w-full px-4 py-3 {{ $errors->has('telephone') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;"
                                    placeholder="01 23 45 67 89">
                                @error('telephone')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Formation intéressée *</label>
                                <select name="autre_service" required
                                    class="w-full px-4 py-3 {{ $errors->has('autre_service') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;">
                                    <option value="" style="color: #666;">Sélectionnez une formation</option>
                                    @foreach($formations as $formation)
                                    <option value="{{ $formation->title }}" {{ old('autre_service')==$formation->title ?
                                        'selected' : '' }} style="color: white;">
                                        {{ $formation->title }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('autre_service')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Message *</label>
                                <textarea name="message" rows="4" required
                                    class="w-full px-4 py-3 {{ $errors->has('message') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;"
                                    placeholder="Votre message...">{{ old('message') }}</textarea>
                                @error('message')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="inline-flex items-center justify-center w-full px-6 py-4 mt-6 font-semibold transition-all duration-300"
                                style="background: #b89449; color: black;">
                                <i class="mr-2 fas fa-paper-plane"></i>
                                Envoyer ma demande
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    <h3 class="mb-4 text-lg font-bold text-white md:text-xl">Informations pratiques</h3>

                    <div class="space-y-6">
                        <div class="p-4" style="background: #1e3a8a;">
                            <h4 class="mb-2 font-bold text-white">Contact rapide :</h4>
                            <p class="text-blue-100">
                                <i class="mr-2 fas fa-phone-alt"></i>
                                Téléphone :
                                <a href="tel:0176380017" class="font-semibold text-white hover:underline">01
                                    76 38 00 17</a>
                            </p>
                            <p class="mt-2 text-blue-100">
                                <i class="mr-2 fas fa-envelope"></i>
                                Email :
                                <a href="mailto:formation@djokprestige.com"
                                    class="font-semibold text-white hover:underline">formation@djokprestige.com</a>
                            </p>
                        </div>

                        <div class="p-4" style="background: #064e3b;">
                            <h4 class="mb-2 font-bold text-white">Horaires d'ouverture :</h4>
                            <p class="text-green-100">
                                <i class="mr-2 fas fa-clock"></i>
                                Lundi - Vendredi : 9h00 - 19h00
                            </p>
                            <p class="mt-2 text-green-100">
                                <i class="mr-2 fas fa-clock"></i>
                                Samedi : 9h00 - 13h00
                            </p>
                        </div>

                        <div class="p-4" style="background: #78350f;">
                            <h4 class="mb-2 font-bold text-white">Adresse du centre :</h4>
                            <p class="text-yellow-100">
                                <i class="mr-2 fas fa-map-marker-alt"></i>
                                DJOK PRESTIGE Formation<br>
                                123 Avenue des Champs-Élysées<br>
                                75008 Paris
                            </p>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('formation') }}"
                                class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                                style="background: #111; color: white; border: 1px solid #333;">
                                <i class="mr-3 fas fa-graduation-cap"></i>Revoir nos formations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Styles pour le tableau moderne - CORRIGÉ */
    .formation-label-desktop {
        position: relative;
        color: #fff;
        font-weight: bold;
        padding: 8px 16px;
        padding-right: 24px;
        /* Plus d'espace à droite pour éviter la coupure */
        min-width: 160px;
        max-width: 200px;
        line-height: 1.2;
        text-align: center;
        /* FORME FLÈCHE améliorée pour desktop - moins agressive */
        clip-path: polygon(0 0, 92% 0, 100% 50%, 92% 100%, 0 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .formation-label-mobile {
        position: relative;
        color: #fff;
        font-weight: bold;
        padding: 12px 16px;
        padding-right: 20px;
        line-height: 1.2;
        text-align: center;
        /* FORME FLÈCHE pour mobile - moins agressive */
        clip-path: polygon(0 0, 96% 0, 100% 50%, 96% 100%, 0 100%);
        width: 100%;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 60px;
    }

    /* Container pour le texte dans les labels */
    .formation-label-desktop>div,
    .formation-label-mobile>div {
        width: 100%;
        padding: 0 8px;
        word-break: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }

    /* Effet hover pour les boutons prix desktop */
    .price-btn {
        position: relative;
        min-height: 40px;
        transition: background 0.3s ease;
    }

    .price-btn:hover .price-text {
        opacity: 0;
        transform: translateY(-8px);
    }

    .price-btn:hover .price-hover-text {
        opacity: 1;
        transform: translateY(0);
    }

    .price-text {
        opacity: 1;
        transform: translateY(0);
    }

    .price-hover-text {
        opacity: 0;
        transform: translateY(8px);
        letter-spacing: 0.5px;
    }

    /* Style pour mobile */
    .price-btn-mobile {
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .price-btn-mobile:active {
        transform: scale(0.98);
    }

    /* Style des lignes de formation */
    .formation-row {
        border-bottom: 1px solid #333;
    }

    .formation-row:last-child {
        border-bottom: none;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .formation-label-mobile {
            border-radius: 0;
            margin-top: -1px;
        }

        .formation-row:first-child .formation-label-mobile {
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
    }

    @media (min-width: 768px) {
        .formation-row:hover {
            background-color: #1f2937;
        }

        /* Ajustement pour grands écrans */
        @media (min-width: 1280px) {
            .formation-label-desktop {
                max-width: 220px;
                padding-right: 28px;
                clip-path: polygon(0 0, 94% 0, 100% 50%, 94% 100%, 0 100%);
            }
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Effet hover sur les boutons prix desktop
        const priceButtons = document.querySelectorAll('.price-btn');

        priceButtons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                const priceText = this.querySelector('.price-text');
                const hoverText = this.querySelector('.price-hover-text');

                if(priceText && hoverText) {
                    priceText.style.opacity = '0';
                    priceText.style.transform = 'translateY(-8px)';
                    hoverText.style.opacity = '1';
                    hoverText.style.transform = 'translateY(0)';
                }
            });

            button.addEventListener('mouseleave', function() {
                const priceText = this.querySelector('.price-text');
                const hoverText = this.querySelector('.price-hover-text');

                if(priceText && hoverText) {
                    priceText.style.opacity = '1';
                    priceText.style.transform = 'translateY(0)';
                    hoverText.style.opacity = '0';
                    hoverText.style.transform = 'translateY(8px)';
                }
            });
        });

        // Effet de toucher pour mobile
        const mobilePriceButtons = document.querySelectorAll('.price-btn-mobile');
        mobilePriceButtons.forEach(button => {
            button.addEventListener('touchstart', function() {
                this.style.opacity = '0.9';
            });
            
            button.addEventListener('touchend', function() {
                this.style.opacity = '1';
            });
        });
    });
</script>
@endsection