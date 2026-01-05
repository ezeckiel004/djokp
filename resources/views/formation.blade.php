@extends('layouts.main')

@section('title', 'Formation VTC Professionnel | DJOK PRESTIGE')

@section('content')
<!-- Messages de succès/erreur - Style sobre -->
<div class="container mx-auto px-4 md:px-6">
    @if(session('success'))
    <div class="mb-6 mt-6">
        <div class="p-4" style="background: #111; border-left: 4px solid var(--gold);">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle" style="color: var(--gold);"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-white">{{ session('success') }}</p>
                    @if(str_contains(session('success'), 'Félicitations'))
                    <p class="text-gray-300 text-sm mt-1">
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
    <div class="mb-6 mt-6">
        <div class="p-4" style="background: #2a0f0f; border-left: 4px solid #f56565;">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle" style="color: #f56565;"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-white">{{ session('error') }}</p>
                    <p class="text-gray-300 text-sm mt-1">
                        Si le problème persiste, contactez notre support au 01 76 38 00 17
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="mb-6 mt-6">
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
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
            alt="Formation VTC" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                Devenez chauffeur VTC professionnel avec DJOK PRESTIGE
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-10">
                Rejoignez un centre de formation certifié Qualiopi et agréé VTC par la Préfecture, reconnu pour la
                qualité de son accompagnement et son taux de réussite exceptionnel.
            </p>

            <p class="text-lg mb-12" style="color: var(--gold);">
                Plusieurs chauffeurs déjà formés avec succès !
            </p>

            <!-- Avantages clés - Style sobre -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <div class="flex flex-col items-center text-white">
                    <div class="w-14 h-14 flex items-center justify-center mb-4" style="background: var(--gold);">
                        <i class="fas fa-clock text-black text-xl"></i>
                    </div>
                    <span class="text-center text-sm">Formation complète en présentiel ou en ligne</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="w-14 h-14 flex items-center justify-center mb-4" style="background: var(--gold);">
                        <i class="fas fa-euro-sign text-black text-xl"></i>
                    </div>
                    <span class="text-center text-sm">Finançable jusqu'à 100% (CPF, OPCO, Pôle Emploi)</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="w-14 h-14 flex items-center justify-center mb-4" style="background: var(--gold);">
                        <i class="fas fa-chalkboard-teacher text-black text-xl"></i>
                    </div>
                    <span class="text-center text-sm">Formateurs experts issus du terrain</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="w-14 h-14 flex items-center justify-center mb-4" style="background: var(--gold);">
                        <i class="fas fa-car text-black text-xl"></i>
                    </div>
                    <span class="text-center text-sm">Formation pratique sur véhicule professionnel</span>
                </div>
            </div>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#formations"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    Voir nos formations
                </a>
                <a href="#inscription"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center border transition duration-300"
                    style="border-color: var(--gold); color: var(--gold);">
                    Demander un devis
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

<!-- Nos formations disponibles (tableau) - Style sobre -->
<section id="formations" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Nos formations VTC disponibles
            </h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Présentation claire sous forme de tableau interactif. Les cours en ligne sont accessibles pour les
                apprenants partout en France désirant suivre la formation VTC à distance avec exercices et corrigés.
            </p>
        </div>

        <div class="overflow-x-auto mb-12">
            <table class="w-full" style="background: #111; color: white;">
                <thead style="background: #000;">
                    <tr>
                        <th class="py-4 px-4 md:px-6 text-left text-white">Formation</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Durée</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Format</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Frais d'examen</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Location véhicule</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Tarif TTC</th>
                        <th class="py-4 px-4 md:px-6 text-center text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formations as $formation)
                    <tr class="border-b border-gray-800 hover:bg-gray-900 transition duration-200">
                        <td class="py-4 px-4 md:px-6 font-semibold text-white">{{ $formation->title }}</td>
                        <td class="py-4 px-4 md:px-6 text-center text-gray-300">{{ $formation->duree }}</td>
                        <td class="py-4 px-4 md:px-6 text-center text-gray-300">{{ $formation->format_affichage }}</td>
                        <td
                            class="py-4 px-4 md:px-6 text-center {{ $formation->frais_examen == 'Inclus' ? 'text-green-400' : 'text-gray-500' }}">
                            {{ $formation->frais_examen }}
                        </td>
                        <td
                            class="py-4 px-4 md:px-6 text-center {{ $formation->location_vehicule == 'Inclus' ? 'text-green-400' : 'text-gray-500' }}">
                            {{ $formation->location_vehicule }}
                        </td>
                        <td class="py-4 px-4 md:px-6 text-center font-bold" style="color: var(--gold);">
                            {{ number_format($formation->price, 0, ',', ' ') }} €
                        </td>
                        <td class="py-4 px-4 md:px-6 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Bouton Voir Programme PDF -->
                                @if($formation->program || $formation->programme_pdf_exists)
                                <a href="{{ $formation->programme_pdf_route }}" target="_blank"
                                    class="inline-flex items-center px-3 py-2 text-sm transition-all duration-300 hover:bg-gray-800 rounded"
                                    style="background: #1f2937; color: white; border: 1px solid #374151;"
                                    title="Voir le programme PDF" onclick="trackPdfView('{{ $formation->title }}')">
                                    <i class="fas fa-eye mr-1"></i>
                                </a>
                                @endif

                                <!-- Bouton S'inscrire/Acheter -->
                                @if($formation->type_formation == 'presentiel')
                                <a href="{{ route('formation.inscrire.presentiel', $formation->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-semibold transition-all duration-300 hover:opacity-90 rounded"
                                    style="background: var(--gold); color: black;">
                                    <i class="fas fa-user-plus mr-2"></i>S'inscrire
                                </a>
                                @elseif($formation->type_formation == 'e_learning')
                                <a href="{{ route('formation.acheter.elearning', $formation->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-semibold transition-all duration-300 hover:opacity-90 rounded"
                                    style="background: #059669; color: white;">
                                    <i class="fas fa-shopping-cart mr-2"></i>Acheter
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-900 mb-2">
                                <i class="fas fa-graduation-cap text-gray-400"></i>
                            </div>
                            <p class="text-gray-400">Aucune formation disponible pour le moment.</p>
                            <p class="text-sm text-gray-500 mt-1">Revenez bientôt !</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Cartes des formations - Style sobre -->
        <div class="mt-16">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Découvrez nos formations en
                    détail</h2>
                <p class="text-gray-400 max-w-3xl mx-auto">
                    Chaque formation est conçue pour vous offrir la meilleure expérience d'apprentissage,
                    avec un accompagnement personnalisé et des ressources multimédias complètes.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($formations as $formation)
                <div
                    class="bg-gray-900 overflow-hidden border border-gray-800 hover:border-gray-700 transition duration-300 rounded-lg">
                    <!-- En-tête avec miniature si disponible -->
                    @php
                    $videoMedia = $formation->media->where('type', 'video')->first();
                    @endphp

                    <div class="relative h-48" style="background: #000;">
                        @if($videoMedia && $videoMedia->thumbnail_path)
                        <img src="{{ $videoMedia->thumbnail_url }}" alt="{{ $formation->title }}"
                            class="w-full h-full object-cover opacity-70">
                        @else
                        <div class="h-full flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-graduation-cap text-white text-3xl mb-2"></i>
                                <p class="text-white font-semibold">{{ Str::limit($formation->title, 30) }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Badge type de formation -->
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded"
                                style="{{ $formation->type_formation === 'e_learning' ? 'background: #059669;' : 'background: var(--gold); color: black;' }}">
                                {{ $formation->type_formation === 'e_learning' ? 'En ligne' : 'Présentiel' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Catégorie -->
                        <div class="mb-3">
                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded"
                                style="background: #222; color: #ddd;">
                                {{ $formation->categorie === 'vtc_theorique' ? 'VTC Théorique' :
                                ($formation->categorie === 'vtc_pratique' ? 'VTC Pratique' :
                                ($formation->categorie === 'e_learning' ? 'E-learning' : 'Renouvellement')) }}
                            </span>
                        </div>

                        <!-- Titre -->
                        <h3 class="text-lg font-bold mb-2 truncate" style="color: white;">{{ $formation->title }}</h3>

                        <!-- Description courte -->
                        <p class="text-gray-400 text-sm mb-4">
                            {{ Str::limit(strip_tags($formation->description), 100) }}
                        </p>

                        <!-- Stats -->
                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-gray-400 mr-1"></i>
                                <span>{{ $formation->duree ?? 'Non définie' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-video text-gray-400 mr-1"></i>
                                <span>{{ $formation->media->where('type', 'video')->count() }} vidéos</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-file-pdf text-gray-400 mr-1"></i>
                                <span>{{ $formation->media->where('type', 'pdf')->count() }} PDF</span>
                            </div>
                        </div>

                        <!-- Prix -->
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-xl font-bold" style="color: var(--gold);">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </span>
                                <span class="text-sm text-gray-500 block">TTC</span>
                            </div>

                            <!-- Frais inclus -->
                            <div class="text-right">
                                @if($formation->frais_examen === 'Inclus')
                                <span class="text-xs px-2 py-1 rounded"
                                    style="background: #064e3b; color: #a7f3d0;">Examen
                                    inclus</span>
                                @endif
                                @if($formation->location_vehicule === 'Inclus')
                                <span class="text-xs px-2 py-1 block mt-1 rounded"
                                    style="background: #064e3b; color: #a7f3d0;">Véhicule inclus</span>
                                @endif
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="space-y-3">
                            <!-- Bouton Programme PDF -->
                            @if($formation->program || $formation->programme_pdf_exists)
                            <a href="{{ $formation->programme_pdf_route }}" target="_blank"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 font-semibold transition-all duration-300 hover:bg-blue-800 rounded"
                                style="background: #1e40af; color: white;" title="Voir le programme détaillé"
                                onclick="trackPdfView('{{ $formation->title }}')">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Télécharger le programme
                            </a>
                            @endif

                            <!-- Bouton Détails -->
                            <a href="{{ route('formation.show', $formation->slug) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 font-semibold transition-all duration-300 hover:bg-gray-800 rounded"
                                style="background: #111; color: white;">
                                <i class="fas fa-info-circle mr-2"></i>
                                Voir les détails
                            </a>

                            <!-- Bouton S'inscrire/Acheter -->
                            @if($formation->type_formation === 'presentiel')
                            <a href="{{ route('formation.inscrire.presentiel', $formation->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 font-semibold transition-all duration-300 hover:opacity-90 rounded"
                                style="background: var(--gold); color: black;">
                                <i class="fas fa-user-plus mr-2"></i>
                                S'inscrire maintenant
                            </a>
                            @elseif($formation->type_formation === 'e_learning')
                            <a href="{{ route('formation.acheter.elearning', $formation->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 font-semibold transition-all duration-300 hover:opacity-90 rounded"
                                style="background: #059669; color: white;">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Acheter la formation
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($formations->count() === 0)
            <div class="text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-900 mb-4">
                    <i class="fas fa-graduation-cap text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold mb-2" style="color: white;">Aucune formation disponible</h3>
                <p class="text-gray-400">Nos formations seront bientôt disponibles. Revenez prochainement !</p>
            </div>
            @endif
        </div>

        <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#inscription"
                class="inline-flex items-center px-8 py-3 text-lg font-semibold transition-all duration-300 rounded"
                style="background: var(--gold); color: black;">
                S'inscrire maintenant
            </a>
            <a href="#"
                class="inline-flex items-center px-8 py-3 text-lg font-semibold transition-all duration-300 rounded"
                style="background: #111; color: white; border: 1px solid #333;">
                Télécharger la brochure complète
            </a>
        </div>
    </div>
</section>

<!-- Programme officiel VTC - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Contenu de la formation –
                Programme officiel VTC</h2>
            <p class="text-gray-400 max-w-3xl mx-auto">
                Le programme DJOK PRESTIGE couvre l'ensemble des épreuves prévues par les CMA (Chambres des Métiers et
                de l'Artisanat). Il prépare efficacement aux épreuves théoriques et pratiques du T3P.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Épreuve A -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: var(--gold);">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 text-sm font-semibold mr-3" style="background: var(--gold); color: black;">
                        ÉPREUVE A
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 3</span>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Réglementation du T3P & Prévention</h3>
                <p class="text-gray-400 mb-4">Durée : 45 minutes • Questions : 5 QRC + 10 QCM</p>
                <p class="text-gray-300">Apprenez les règles du transport public, les obligations légales du chauffeur
                    et les principes de prévention.</p>
            </div>

            <!-- Épreuve B -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: var(--gold);">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 text-sm font-semibold mr-3" style="background: var(--gold); color: black;">
                        ÉPREUVE B
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 2</span>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Gestion d'entreprise</h3>
                <p class="text-gray-400 mb-4">Durée : 45 minutes • Questions : 2 QRC + 16 QCM</p>
                <p class="text-gray-300">Maîtrisez la création d'entreprise VTC, la facturation, la fiscalité et la
                    gestion quotidienne.</p>
            </div>

            <!-- Épreuve C -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: var(--gold);">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 text-sm font-semibold mr-3" style="background: var(--gold); color: black;">
                        ÉPREUVE C
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 3</span>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Sécurité routière</h3>
                <p class="text-gray-400 mb-4">Durée : 30 minutes • Questions : 20 QCM</p>
                <p class="text-gray-300">Approfondissez vos connaissances en sécurité, code de la route professionnel et
                    conduite écologique.</p>
            </div>

            <!-- Épreuve D -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: var(--gold);">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 text-sm font-semibold mr-3" style="background: var(--gold); color: black;">
                        ÉPREUVE D
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 2</span>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Langue française</h3>
                <p class="text-gray-400 mb-4">Durée : 30 minutes • Questions : 3 QRC + 7 QCM</p>
                <p class="text-gray-300">Développez une expression orale et écrite fluide avec un vocabulaire
                    professionnel.</p>
            </div>

            <!-- Épreuve E -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: var(--gold);">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 text-sm font-semibold mr-3" style="background: var(--gold); color: black;">
                        ÉPREUVE E
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 1</span>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Langue anglaise (niveau A2)</h3>
                <p class="text-gray-400 mb-4">Durée : 30 minutes • Questions : 20 QCM</p>
                <p class="text-gray-300">Maîtrisez les bases de l'anglais professionnel pour échanger avec une clientèle
                    internationale.</p>
            </div>

            <!-- Épreuve F -->
            <div class="p-6 border-l-4" style="background: #1a1a1a; border-color: var(--gold);">
                <div class="flex items-start mb-4">
                    <div class="px-3 py-1 text-sm font-semibold mr-3" style="background: var(--gold); color: black;">
                        ÉPREUVE F
                    </div>
                    <span class="text-sm text-gray-400">Coefficient : 3</span>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">Développement commercial spécifique VTC</h3>
                <p class="text-gray-400 mb-4">Durée : 30 minutes • Questions : 4 QRC + 12 QCM</p>
                <p class="text-gray-300">Apprenez à trouver des clients, à fidéliser et à maximiser vos revenus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Formation pratique VTC - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Formation pratique VTC</h2>
                <p class="text-gray-400 mb-6">
                    La pratique est au cœur de la pédagogie DJOK PRESTIGE. Nos formateurs expérimentés vous accompagnent
                    sur le terrain pour acquérir la maîtrise de la conduite professionnelle.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-car mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Mise en situation réelle</h4>
                            <p class="text-gray-400 text-sm">Accueil client, trajet, GPS, bagages</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-comments mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Communication et service client premium</h4>
                            <p class="text-gray-400 text-sm">Relation client haut de gamme</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Gestion des imprévus et sécurité</h4>
                            <p class="text-gray-400 text-sm">Réactions adaptées aux situations critiques</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8" style="background: #111;">
                <h3 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Évaluation pratique</h3>
                <p class="text-gray-400 mb-6">Vous serez évalué sur :</p>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <i class="fas fa-check mr-3" style="color: #10b981;"></i>
                        <span style="color: white;">Préparation du véhicule</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-3" style="color: #10b981;"></i>
                        <span style="color: white;">Planification et exécution du trajet</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-3" style="color: #10b981;"></i>
                        <span style="color: white;">Sécurité et confort du client</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check mr-3" style="color: #10b981;"></i>
                        <span style="color: white;">Communication professionnelle</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Formation e-learning - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
            <div class="text-white">
                <h2 class="text-2xl md:text-3xl font-bold mb-6">Formation e-learning full option</h2>
                <p class="text-gray-400 mb-6">
                    Vous n'avez pas la possibilité de venir en centre ? Notre formation à distance vous permet
                    d'apprendre à votre rythme grâce à une plateforme intuitive.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center">
                        <i class="fas fa-video mr-3" style="color: var(--gold);"></i>
                        <span>Modules vidéo + PDF interactifs</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-question-circle mr-3" style="color: var(--gold);"></i>
                        <span>Quiz et exercices corrigés</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user-tie mr-3" style="color: var(--gold);"></i>
                        <span>Accompagnement individuel</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt mr-3" style="color: var(--gold);"></i>
                        <span>Accès illimité 12 mois</span>
                    </div>
                </div>

                <a href="#formations"
                    class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                    style="background: var(--gold); color: black;">
                    <i class="fas fa-laptop mr-3"></i>Découvrir nos formations en ligne
                </a>
            </div>

            <div class="p-6 md:p-8" style="background: #111; color: white;">
                <h3 class="text-lg md:text-xl font-bold mb-4">Formation continue – Renouvellement carte VTC</h3>
                <p class="text-gray-400 mb-4">
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
                        <div class="text-2xl md:text-3xl font-bold" style="color: var(--gold);">160 €</div>
                        <div class="text-sm text-gray-400">TTC</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Conditions d'inscription - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Conditions d'inscription à
                    l'examen VTC</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-passport mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Nationalité et statut</h4>
                            <p class="text-gray-400">Citoyen européen ou titre de séjour valide en France</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-id-card mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Permis de conduire</h4>
                            <p class="text-gray-400">Permis B depuis au moins 3 ans</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-heartbeat mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Aptitude physique</h4>
                            <p class="text-gray-400">Aptitude à la conduite professionnelle</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-gavel mt-1 mr-3" style="color: var(--gold);"></i>
                        <div>
                            <h4 class="font-semibold" style="color: white;">Casier judiciaire</h4>
                            <p class="text-gray-400">Casier judiciaire vierge (bulletin n°2)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-4" style="background: var(--gold); color: black;">
                    <p>
                        <i class="fas fa-info-circle mr-2"></i>
                        Le PSC1 (Prévention et secours civiques de niveau 1) est conseillé mais non obligatoire à
                        l'inscription.
                    </p>
                </div>
            </div>

            <div>
                <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">Dossier d'inscription CMA
                </h2>
                <p class="text-gray-400 mb-6">
                    Depuis 2017, les CMA gèrent les examens VTC. DJOK PRESTIGE vous accompagne dans la constitution de
                    votre dossier.
                </p>

                <div class="p-6 mb-6" style="background: #1a1a1a; border: 1px solid #333;">
                    <h4 class="font-bold mb-4" style="color: white;">Documents requis :</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-file-alt mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Pièce d'identité ou titre de séjour valide</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-id-card mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Permis B recto-verso lisible</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-home mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Justificatif de domicile (-3 mois)</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-camera mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Photo d'identité 35x45 mm</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-euro-sign mr-3" style="color: #60a5fa;"></i>
                            <span style="color: white;">Règlement CMA (233 €)</span>
                        </li>
                    </ul>
                </div>

                <div class="p-4" style="background: #064e3b; border: 1px solid #047857;">
                    <p class="text-white">
                        <i class="fas fa-check-circle mr-2" style="color: #a7f3d0;"></i>
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
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">Pourquoi choisir DJOK PRESTIGE ?
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="text-xl mb-4" style="color: var(--gold);">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4 class="text-lg font-bold mb-2" style="color: white;">Formation complète et finançable</h4>
                <p class="text-gray-400">CPF, OPCO, Pôle emploi</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="text-xl mb-4" style="color: var(--gold);">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4 class="text-lg font-bold mb-2" style="color: white;">Accompagnement personnalisé</h4>
                <p class="text-gray-400">Administratif et pédagogique</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="text-xl mb-4" style="color: var(--gold);">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="text-lg font-bold mb-2" style="color: white;">Taux de réussite exceptionnel</h4>
                <p class="text-gray-400">Supérieur à 95 %</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="text-xl mb-4" style="color: var(--gold);">
                    <i class="fas fa-users"></i>
                </div>
                <h4 class="text-lg font-bold mb-2" style="color: white;">Formateurs agréés et pédagogues</h4>
                <p class="text-gray-400">Experts issus du terrain</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="text-xl mb-4" style="color: var(--gold);">
                    <i class="fas fa-car"></i>
                </div>
                <h4 class="text-lg font-bold mb-2" style="color: white;">Matériel moderne</h4>
                <p class="text-gray-400">Véhicules récents et simulateurs</p>
            </div>

            <div class="p-6" style="background: #111; border: 1px solid #333;">
                <div class="text-xl mb-4" style="color: var(--gold);">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h4 class="text-lg font-bold mb-2" style="color: white;">Paiement flexible</h4>
                <p class="text-gray-400">En plusieurs fois possible</p>
            </div>
        </div>

        <div class="text-center">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#formations"
                    class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                    style="background: var(--gold); color: black;">
                    <i class="fas fa-user-plus mr-3"></i>Je m'inscris dès maintenant
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                    style="background: #111; color: white; border: 1px solid #333;">
                    <i class="fas fa-phone mr-3"></i>Être rappelé par un conseiller
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Accompagnement post-formation - Style sobre -->
<section class="py-16" style="background: var(--gold); color: black;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Accompagnement post-formation</h2>
            <p class="text-lg max-w-3xl mx-auto">
                Chez DJOK PRESTIGE, nous allons au-delà de la formation. Nos conseillers vous accompagnent dans vos
                démarches pour l'obtention de la carte VTC, la création de votre entreprise, et même le financement de
                votre véhicule.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="text-xl mb-4">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h4 class="text-lg font-bold mb-2">Création d'entreprise</h4>
                <p>Micro-entreprise / SASU</p>
            </div>

            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="text-xl mb-4">
                    <i class="fas fa-calculator"></i>
                </div>
                <h4 class="text-lg font-bold mb-2">Simulation de rentabilité</h4>
                <p>Planification financière</p>
            </div>

            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="text-xl mb-4">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="text-lg font-bold mb-2">Partenariats exclusifs</h4>
                <p>Véhicules et assurances</p>
            </div>

            <div class="p-6" style="background: rgba(255, 255, 255, 0.2);">
                <div class="text-xl mb-4">
                    <i class="fas fa-key"></i>
                </div>
                <h4 class="text-lg font-bold mb-2">Accès privilégié</h4>
                <p>Offres de location DJOK PRESTIGE</p>
            </div>
        </div>
    </div>
</section>

<!-- Section inscription - Style sobre -->
<section id="inscription" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto p-6 md:p-8" style="background: #1a1a1a; border: 1px solid #333;">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8" style="color: var(--gold);">Demande
                d'information</h2>

            @if(session('success') && !str_contains(session('success'), 'Félicitations'))
            <div class="p-4 mb-6" style="background: #064e3b; border: 1px solid #047857;">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3" style="color: #a7f3d0;"></i>
                    <div>
                        <h4 class="font-bold" style="color: white;">Message envoyé</h4>
                        <p class="text-green-100">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- AFFICHAGE DES ERREURS -->
            @if($errors->any())
            <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3" style="color: #fca5a5;"></i>
                    <div>
                        <h4 class="font-bold" style="color: white;">Veuillez corriger les erreurs suivantes :</h4>
                        <ul class="text-red-100 text-sm mt-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Nous contacter</h3>
                    <p class="text-gray-400 mb-6">Remplissez ce formulaire pour obtenir plus d'informations sur nos
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
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;">
                                @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Téléphone</label>
                                <input type="tel" name="telephone" value="{{ old('telephone') }}"
                                    class="w-full px-4 py-3 {{ $errors->has('telephone') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;"
                                    placeholder="01 23 45 67 89">
                                @error('telephone')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
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
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block mb-2" style="color: #ddd;">Message *</label>
                                <textarea name="message" rows="4" required
                                    class="w-full px-4 py-3 {{ $errors->has('message') ? 'border-red-500' : 'border-gray-600' }}"
                                    style="background: #111; border: 1px solid #444; color: white;"
                                    placeholder="Votre message...">{{ old('message') }}</textarea>
                                @error('message')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full mt-6 inline-flex items-center justify-center px-6 py-4 font-semibold transition-all duration-300"
                                style="background: var(--gold); color: black;">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Envoyer ma demande
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    <h3 class="text-lg md:text-xl font-bold mb-4" style="color: white;">Informations pratiques</h3>

                    <div class="space-y-6">
                        <div class="p-4" style="background: #1e3a8a;">
                            <h4 class="font-bold mb-2" style="color: white;">Contact rapide :</h4>
                            <p class="text-blue-100">
                                <i class="fas fa-phone-alt mr-2"></i>
                                Téléphone :
                                <a href="tel:0176380017" class="font-semibold hover:underline" style="color: white;">01
                                    76 38 00 17</a>
                            </p>
                            <p class="text-blue-100 mt-2">
                                <i class="fas fa-envelope mr-2"></i>
                                Email :
                                <a href="mailto:formation@djokprestige.com" class="font-semibold hover:underline"
                                    style="color: white;">formation@djokprestige.com</a>
                            </p>
                        </div>

                        <div class="p-4" style="background: #064e3b;">
                            <h4 class="font-bold mb-2" style="color: white;">Horaires d'ouverture :</h4>
                            <p class="text-green-100">
                                <i class="fas fa-clock mr-2"></i>
                                Lundi - Vendredi : 9h00 - 19h00
                            </p>
                            <p class="text-green-100 mt-2">
                                <i class="fas fa-clock mr-2"></i>
                                Samedi : 9h00 - 13h00
                            </p>
                        </div>

                        <div class="p-4" style="background: #78350f;">
                            <h4 class="font-bold mb-2" style="color: white;">Adresse du centre :</h4>
                            <p class="text-yellow-100">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                DJOK PRESTIGE Formation<br>
                                123 Avenue des Champs-Élysées<br>
                                75008 Paris
                            </p>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('formation') }}"
                                class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                                style="background: #111; color: white; border: 1px solid #333;">
                                <i class="fas fa-graduation-cap mr-3"></i>Revoir nos formations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Auto-hide du message de succès
        const successMessage = document.querySelector('.bg-green-50');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 8000);
        }
    });

    function trackPdfView(formationTitle) {
        // Envoyer un événement à Google Analytics (si configuré)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'pdf_view', {
                'event_category': 'Formation',
                'event_label': formationTitle,
                'value': 1
            });
        }

        // Optionnel : envoyer une requête à votre backend pour tracker
        fetch('/api/track-pdf-view', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                formation_title: formationTitle,
                url: window.location.href,
                timestamp: new Date().toISOString()
            })
        }).catch(error => console.log('Tracking error:', error));
    }
</script>
@endsection
