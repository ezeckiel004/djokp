@extends('layouts.main')

@section('title', 'Formation VTC Professionnel | DJOK PRESTIGE')

@section('content')
<!-- Messages de succès/erreur -->
<div class="container mx-auto px-6">
    @if(session('success'))
    <div class="mb-6 mt-6">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    @if(str_contains(session('success'), 'Félicitations'))
                    <p class="text-green-700 text-sm mt-1">
                        Vous pouvez maintenant accéder à votre formation depuis votre espace personnel.
                        <a href="{{ route('client.formations.index') }}"
                            class="font-semibold underline hover:text-green-900">
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
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    <p class="text-red-700 text-sm mt-1">
                        Si le problème persiste, contactez notre support au 01 76 38 00 17
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="mb-6 mt-6">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-blue-800">{{ session('info') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.6)),
            url('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1') center/cover no-repeat;
    }

    .programme-card {
        @apply bg-white rounded-xl shadow-lg p-6 transition-all duration-300 hover: shadow-xl hover:scale-[1.02];
    }

    .avantage-card {
        @apply bg-gray-50 rounded-lg p-6 border border-gray-200 transition-all duration-300 hover: border-yellow-400 hover:bg-white;
    }

    .module-card {
        @apply bg-white rounded-lg p-6 border-l-4 border-yellow-500 shadow-sm transition-all duration-300 hover: shadow-md;
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

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<!-- Hero Section -->
<header class="hero-bg relative min-h-screen flex items-center">
    <div class="container mx-auto px-6 py-20">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-8 fade-in">
                Devenez chauffeur VTC professionnel avec DJOK PRESTIGE
            </h1>

            <p class="text-xl text-white mb-10 fade-in" style="transition-delay: 0.2s;">
                Rejoignez un centre de formation certifié Qualiopi et agréé VTC par la Préfecture, reconnu pour la
                qualité de son accompagnement et son taux de réussite exceptionnel. Notre programme complet — théorique,
                pratique et e-learning — vous prépare à l'examen officiel et à la réalité du métier.
            </p>

            <p class="text-lg text-yellow-300 mb-12 fade-in" style="transition-delay: 0.3s;">
                Plusieurs chauffeurs déjà formés avec succès !
            </p>

            <!-- Avantages clés -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
                <div class="flex flex-col items-center text-white fade-in" style="transition-delay: 0.4s;">
                    <div class="w-16 h-16 flex items-center justify-center bg-yellow-600 rounded-full mb-4">
                        <i class="fas fa-clock text-white text-2xl"></i>
                    </div>
                    <span class="text-center">Formation complète en présentiel ou en ligne</span>
                </div>
                <div class="flex flex-col items-center text-white fade-in" style="transition-delay: 0.5s;">
                    <div class="w-16 h-16 flex items-center justify-center bg-yellow-600 rounded-full mb-4">
                        <i class="fas fa-euro-sign text-white text-2xl"></i>
                    </div>
                    <span class="text-center">Finançable jusqu'à 100% (CPF, OPCO, Pôle Emploi)</span>
                </div>
                <div class="flex flex-col items-center text-white fade-in" style="transition-delay: 0.6s;">
                    <div class="w-16 h-16 flex items-center justify-center bg-yellow-600 rounded-full mb-4">
                        <i class="fas fa-chalkboard-teacher text-white text-2xl"></i>
                    </div>
                    <span class="text-center">Formateurs experts issus du terrain</span>
                </div>
                <div class="flex flex-col items-center text-white fade-in" style="transition-delay: 0.7s;">
                    <div class="w-16 h-16 flex items-center justify-center bg-yellow-600 rounded-full mb-4">
                        <i class="fas fa-car text-white text-2xl"></i>
                    </div>
                    <span class="text-center">Formation pratique sur véhicule professionnel</span>
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center fade-in" style="transition-delay: 0.8s;">
                <div class="flex flex-col items-center gap-4 sm:flex-row sm:justify-center">
                    <a href="#formations"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl sm:w-auto">
                        Voir nos formations
                    </a>
                    <a href="#inscription"
                        class="w-full px-12 py-4 text-lg font-semibold text-center text-white transition duration-300 transform bg-transparent border-2 border-white rounded-lg hover:bg-white hover:text-gray-900 hover:scale-105 sm:w-auto">
                        Demander un devis
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#formations" class="text-white transition duration-300 hover:text-yellow-400">
            <i class="text-2xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Nos formations disponibles (tableau) -->
<section id="formations" class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Nos formations VTC disponibles</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Présentation claire sous forme de tableau interactif. Les cours en ligne sont accessibles pour les
                apprenants partout en France désirant suivre la formation VTC à distance avec exercices et corrigés.
            </p>
        </div>

        <div class="overflow-x-auto mb-12">
            <table class="w-full bg-white rounded-lg shadow-lg">
                <thead class="bg-gray-900 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">Formation</th>
                        <th class="py-4 px-6 text-center">Durée</th>
                        <th class="py-4 px-6 text-center">Format</th>
                        <th class="py-4 px-6 text-center">Frais d'examen</th>
                        <th class="py-4 px-6 text-center">Location véhicule</th>
                        <th class="py-4 px-6 text-center">Tarif TTC</th>
                        <th class="py-4 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($formations as $formation)
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="py-4 px-6 font-semibold">{{ $formation->title }}</td>
                        <td class="py-4 px-6 text-center">{{ $formation->duree }}</td>
                        <td class="py-4 px-6 text-center">{{ $formation->format_affichage }}</td>
                        <td
                            class="py-4 px-6 text-center {{ $formation->frais_examen == 'Inclus' ? 'text-green-600' : 'text-gray-500' }}">
                            {{ $formation->frais_examen }}
                        </td>
                        <td
                            class="py-4 px-6 text-center {{ $formation->location_vehicule == 'Inclus' ? 'text-green-600' : 'text-gray-500' }}">
                            {{ $formation->location_vehicule }}
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-yellow-600">
                            {{ number_format($formation->price, 0, ',', ' ') }} €
                        </td>
                        <td class="py-4 px-6 text-center">
                            @if($formation->type_formation == 'presentiel')
                            <a href="{{ route('formation.inscrire.presentiel', $formation->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 text-sm">
                                <i class="fas fa-user-plus mr-2"></i>S'inscrire
                            </a>
                            @elseif($formation->type_formation == 'e_learning')
                            <a href="{{ route('formation.acheter.elearning', $formation->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105 text-sm">
                                <i class="fas fa-shopping-cart mr-2"></i>Acheter
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-gray-500">
                            <div
                                class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-full mb-2">
                                <i class="fas fa-graduation-cap text-gray-400"></i>
                            </div>
                            <p>Aucune formation disponible pour le moment.</p>
                            <p class="text-sm text-gray-400 mt-1">Revenez bientôt !</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Cartes des formations -->
        <div class="mt-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Découvrez nos formations en détail</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Chaque formation est conçue pour vous offrir la meilleure expérience d'apprentissage,
                    avec un accompagnement personnalisé et des ressources multimédias complètes.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($formations as $formation)
                <div
                    class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300 transform hover:scale-[1.02]">
                    <!-- En-tête avec miniature si disponible -->
                    @php
                    $videoMedia = $formation->media->where('type', 'video')->first();
                    @endphp

                    <div class="relative h-48 bg-gradient-to-r from-blue-600 to-blue-800">
                        @if($videoMedia && $videoMedia->thumbnail_path)
                        <img src="{{ $videoMedia->thumbnail_url }}" alt="{{ $formation->title }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="h-full flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-graduation-cap text-white text-4xl mb-2"></i>
                                <p class="text-white font-semibold">{{ Str::limit($formation->title, 30) }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Badge type de formation -->
                        <div class="absolute top-4 right-4">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold {{ $formation->type_formation === 'e_learning' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                {{ $formation->type_formation === 'e_learning' ? 'En ligne' : 'Présentiel' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Catégorie -->
                        <div class="mb-3">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                {{ $formation->categorie === 'vtc_theorique' ? 'VTC Théorique' :
                                ($formation->categorie === 'vtc_pratique' ? 'VTC Pratique' :
                                ($formation->categorie === 'e_learning' ? 'E-learning' : 'Renouvellement')) }}
                            </span>
                        </div>

                        <!-- Titre -->
                        <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $formation->title }}</h3>

                        <!-- Description courte -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
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
                                <span class="text-2xl font-bold text-yellow-600">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </span>
                                <span class="text-sm text-gray-500 block">TTC</span>
                            </div>

                            <!-- Frais inclus -->
                            <div class="text-right">
                                @if($formation->frais_examen === 'Inclus')
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Examen inclus</span>
                                @endif
                                @if($formation->location_vehicule === 'Inclus')
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded block mt-1">Véhicule
                                    inclus</span>
                                @endif
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="space-y-3">
                            <!-- Bouton Détails -->
                            <a href="{{ route('formation.show', $formation->slug) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300">
                                <i class="fas fa-eye mr-2"></i>
                                Voir les détails
                            </a>

                            <!-- Bouton S'inscrire/Acheter -->
                            @if($formation->type_formation === 'presentiel')
                            <a href="{{ route('formation.inscrire.presentiel', $formation->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                                <i class="fas fa-user-plus mr-2"></i>
                                S'inscrire maintenant
                            </a>
                            @elseif($formation->type_formation === 'e_learning')
                            <a href="{{ route('formation.acheter.elearning', $formation->id) }}"
                                class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300">
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
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-graduation-cap text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune formation disponible</h3>
                <p class="text-gray-600">Nos formations seront bientôt disponibles. Revenez prochainement !</p>
            </div>
            @endif
        </div>

        <div class="mt-12 flex flex-col sm:flex-row gap-6 justify-center">
            <a href="#inscription"
                class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                S'inscrire maintenant
            </a>
            <a href="#"
                class="inline-flex items-center px-12 py-4 bg-gray-900 text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
                Télécharger la brochure complète
            </a>
        </div>
    </div>
</section>

<!-- Programme officiel VTC -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Contenu de la formation – Programme officiel
                VTC</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Le programme DJOK PRESTIGE couvre l'ensemble des épreuves prévues par les CMA (Chambres des Métiers et
                de l'Artisanat). Il prépare efficacement aux épreuves théoriques et pratiques du T3P.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Épreuve A -->
            <div class="module-card">
                <div class="flex items-start mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mr-3">
                        ÉPREUVE A
                    </div>
                    <span class="text-sm text-gray-500">Coefficient : 3</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Réglementation du T3P & Prévention</h3>
                <p class="text-gray-600 mb-4">Durée : 45 minutes • Questions : 5 QRC + 10 QCM</p>
                <p class="text-gray-700">Apprenez les règles du transport public, les obligations légales du chauffeur
                    et les principes de prévention.</p>
            </div>

            <!-- Épreuve B -->
            <div class="module-card">
                <div class="flex items-start mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mr-3">
                        ÉPREUVE B
                    </div>
                    <span class="text-sm text-gray-500">Coefficient : 2</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Gestion d'entreprise</h3>
                <p class="text-gray-600 mb-4">Durée : 45 minutes • Questions : 2 QRC + 16 QCM</p>
                <p class="text-gray-700">Maîtrisez la création d'entreprise VTC, la facturation, la fiscalité et la
                    gestion quotidienne.</p>
            </div>

            <!-- Épreuve C -->
            <div class="module-card">
                <div class="flex items-start mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mr-3">
                        ÉPREUVE C
                    </div>
                    <span class="text-sm text-gray-500">Coefficient : 3</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Sécurité routière</h3>
                <p class="text-gray-600 mb-4">Durée : 30 minutes • Questions : 20 QCM</p>
                <p class="text-gray-700">Approfondissez vos connaissances en sécurité, code de la route professionnel et
                    conduite écologique.</p>
            </div>

            <!-- Épreuve D -->
            <div class="module-card">
                <div class="flex items-start mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mr-3">
                        ÉPREUVE D
                    </div>
                    <span class="text-sm text-gray-500">Coefficient : 2</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Langue française</h3>
                <p class="text-gray-600 mb-4">Durée : 30 minutes • Questions : 3 QRC + 7 QCM</p>
                <p class="text-gray-700">Développez une expression orale et écrite fluide avec un vocabulaire
                    professionnel.</p>
            </div>

            <!-- Épreuve E -->
            <div class="module-card">
                <div class="flex items-start mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mr-3">
                        ÉPREUVE E
                    </div>
                    <span class="text-sm text-gray-500">Coefficient : 1</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Langue anglaise (niveau A2)</h3>
                <p class="text-gray-600 mb-4">Durée : 30 minutes • Questions : 20 QCM</p>
                <p class="text-gray-700">Maîtrisez les bases de l'anglais professionnel pour échanger avec une clientèle
                    internationale.</p>
            </div>

            <!-- Épreuve F -->
            <div class="module-card">
                <div class="flex items-start mb-4">
                    <div class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mr-3">
                        ÉPREUVE F
                    </div>
                    <span class="text-sm text-gray-500">Coefficient : 3</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Développement commercial spécifique VTC</h3>
                <p class="text-gray-600 mb-4">Durée : 30 minutes • Questions : 4 QRC + 12 QCM</p>
                <p class="text-gray-700">Apprenez à trouver des clients, à fidéliser et à maximiser vos revenus.</p>
            </div>
        </div>
    </div>
</section>

<!-- Formation pratique VTC -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Formation pratique VTC</h2>
                <p class="text-gray-600 mb-6">
                    La pratique est au cœur de la pédagogie DJOK PRESTIGE. Nos formateurs expérimentés vous accompagnent
                    sur le terrain pour acquérir la maîtrise de la conduite professionnelle.
                </p>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-car text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Mise en situation réelle</h4>
                            <p class="text-gray-600 text-sm">Accueil client, trajet, GPS, bagages</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-comments text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Communication et service client premium</h4>
                            <p class="text-gray-600 text-sm">Relation client haut de gamme</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Gestion des imprévus et sécurité</h4>
                            <p class="text-gray-600 text-sm">Réactions adaptées aux situations critiques</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Évaluation pratique</h3>
                <p class="text-gray-600 mb-6">Vous serez évalué sur :</p>
                <ul class="space-y-3">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Préparation du véhicule</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Planification et exécution du trajet</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Sécurité et confort du client</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Communication professionnelle</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Formation e-learning -->
<section class="py-16 bg-gradient-to-r from-gray-900 to-gray-800 text-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Formation e-learning full option</h2>
                <p class="text-gray-300 mb-6">
                    Vous n'avez pas la possibilité de venir en centre ? Notre formation à distance vous permet
                    d'apprendre à votre rythme grâce à une plateforme intuitive.
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="flex items-center">
                        <i class="fas fa-video text-yellow-400 text-xl mr-3"></i>
                        <span>Modules vidéo + PDF interactifs</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-question-circle text-yellow-400 text-xl mr-3"></i>
                        <span>Quiz et exercices corrigés</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-user-tie text-yellow-400 text-xl mr-3"></i>
                        <span>Accompagnement individuel</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt text-yellow-400 text-xl mr-3"></i>
                        <span>Accès illimité 12 mois</span>
                    </div>
                </div>

                <a href="#formations"
                    class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <i class="fas fa-laptop mr-3"></i>Découvrir nos formations en ligne
                </a>
            </div>

            <div class="bg-gray-800 rounded-xl p-8">
                <h3 class="text-2xl font-bold mb-4">Formation continue – Renouvellement carte VTC</h3>
                <p class="text-gray-300 mb-4">
                    Obligation légale : la carte VTC doit être renouvelée tous les 5 ans. DJOK PRESTIGE propose un
                    module complet de 14 heures validé par la Préfecture.
                </p>
                <div class="flex items-center justify-between bg-gray-700 p-4 rounded-lg">
                    <div>
                        <h4 class="font-bold">Objectifs :</h4>
                        <p class="text-sm text-gray-300">Mise à jour réglementaire • Sécurité routière • Service client
                            • Nouvelles tendances</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold text-yellow-400">160 €</div>
                        <div class="text-sm text-gray-300">TTC</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Conditions d'inscription -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Conditions d'inscription à l'examen VTC
                </h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-passport text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Nationalité et statut</h4>
                            <p class="text-gray-600">Citoyen européen ou titre de séjour valide en France</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-id-card text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Permis de conduire</h4>
                            <p class="text-gray-600">Permis B depuis au moins 3 ans</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-heartbeat text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Aptitude physique</h4>
                            <p class="text-gray-600">Aptitude à la conduite professionnelle</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-gavel text-yellow-600 text-lg mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-gray-900">Casier judiciaire</h4>
                            <p class="text-gray-600">Casier judiciaire vierge (bulletin n°2)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <p class="text-gray-700">
                        <i class="fas fa-info-circle text-yellow-600 mr-2"></i>
                        Le PSC1 (Prévention et secours civiques de niveau 1) est conseillé mais non obligatoire à
                        l'inscription.
                    </p>
                </div>
            </div>

            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Dossier d'inscription CMA</h2>
                <p class="text-gray-600 mb-6">
                    Depuis 2017, les CMA gèrent les examens VTC. DJOK PRESTIGE vous accompagne dans la constitution de
                    votre dossier.
                </p>

                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <h4 class="font-bold text-gray-900 mb-4">Documents requis :</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-file-alt text-blue-500 mr-3"></i>
                            <span>Pièce d'identité ou titre de séjour valide</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-id-card text-blue-500 mr-3"></i>
                            <span>Permis B recto-verso lisible</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-home text-blue-500 mr-3"></i>
                            <span>Justificatif de domicile (-3 mois)</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-camera text-blue-500 mr-3"></i>
                            <span>Photo d'identité 35x45 mm</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-euro-sign text-blue-500 mr-3"></i>
                            <span>Règlement CMA (233 €)</span>
                        </li>
                    </ul>
                </div>

                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-800">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        DJOK PRESTIGE s'occupe de votre dossier de A à Z ! Nous transmettons directement votre
                        inscription à la CMA partenaire.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi choisir DJOK PRESTIGE -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pourquoi choisir DJOK PRESTIGE ?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            <div class="avantage-card">
                <div class="text-yellow-600 text-2xl mb-4">
                    <i class="fas fa-certificate"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Formation complète et finançable</h4>
                <p class="text-gray-600">CPF, OPCO, Pôle emploi</p>
            </div>

            <div class="avantage-card">
                <div class="text-yellow-600 text-2xl mb-4">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Accompagnement personnalisé</h4>
                <p class="text-gray-600">Administratif et pédagogique</p>
            </div>

            <div class="avantage-card">
                <div class="text-yellow-600 text-2xl mb-4">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Taux de réussite exceptionnel</h4>
                <p class="text-gray-600">Supérieur à 95 %</p>
            </div>

            <div class="avantage-card">
                <div class="text-yellow-600 text-2xl mb-4">
                    <i class="fas fa-users"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Formateurs agréés et pédagogues</h4>
                <p class="text-gray-600">Experts issus du terrain</p>
            </div>

            <div class="avantage-card">
                <div class="text-yellow-600 text-2xl mb-4">
                    <i class="fas fa-car"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Matériel moderne</h4>
                <p class="text-gray-600">Véhicules récents et simulateurs</p>
            </div>

            <div class="avantage-card">
                <div class="text-yellow-600 text-2xl mb-4">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Paiement flexible</h4>
                <p class="text-gray-600">En plusieurs fois possible</p>
            </div>
        </div>

        <div class="text-center">
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="#formations"
                    class="inline-flex items-center px-12 py-4 bg-yellow-600 text-white text-lg font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                    <i class="fas fa-user-plus mr-3"></i>Je m'inscris dès maintenant
                </a>
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center px-12 py-4 bg-gray-900 text-white text-lg font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-phone mr-3"></i>Être rappelé par un conseiller
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Accompagnement post-formation -->
<section class="py-16 bg-gradient-to-r from-yellow-600 to-yellow-700 text-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Accompagnement post-formation</h2>
            <p class="text-xl max-w-3xl mx-auto">
                Chez DJOK PRESTIGE, nous allons au-delà de la formation. Nos conseillers vous accompagnent dans vos
                démarches pour l'obtention de la carte VTC, la création de votre entreprise, et même le financement de
                votre véhicule.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                <div class="text-2xl mb-4">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Création d'entreprise</h4>
                <p class="text-yellow-100">Micro-entreprise / SASU</p>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                <div class="text-2xl mb-4">
                    <i class="fas fa-calculator"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Simulation de rentabilité</h4>
                <p class="text-yellow-100">Planification financière</p>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                <div class="text-2xl mb-4">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Partenariats exclusifs</h4>
                <p class="text-yellow-100">Véhicules et assurances</p>
            </div>

            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6">
                <div class="text-2xl mb-4">
                    <i class="fas fa-key"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Accès privilégié</h4>
                <p class="text-yellow-100">Offres de location DJOK PRESTIGE</p>
            </div>
        </div>
    </div>
</section>

<!-- Section inscription AVEC FORMULAIRE CORRIGÉ -->
<section id="inscription" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-8">Demande d'information</h2>

            @if(session('success') && !str_contains(session('success'), 'Félicitations'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                    <div>
                        <h4 class="font-bold text-green-800">Message envoyé</h4>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- AFFICHAGE DES ERREURS -->
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                    <div>
                        <h4 class="font-bold text-red-800">Veuillez corriger les erreurs suivantes :</h4>
                        <ul class="text-red-700 text-sm mt-1">
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
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Nous contacter</h3>
                    <p class="text-gray-600 mb-6">Remplissez ce formulaire pour obtenir plus d'informations sur nos
                        formations.</p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- CHAMP CACHÉ POUR SERVICE_ID -->
                        <input type="hidden" name="service_id" value="autre">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Nom complet *</label>
                                <input type="text" name="nom" value="{{ old('nom') }}" required
                                    class="w-full px-4 py-3 border {{ $errors->has('nom') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                @error('nom')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Téléphone</label>
                                <input type="tel" name="telephone" value="{{ old('telephone') }}"
                                    class="w-full px-4 py-3 border {{ $errors->has('telephone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    placeholder="01 23 45 67 89">
                                @error('telephone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Formation intéressée *</label>
                                <select name="autre_service" required
                                    class="w-full px-4 py-3 border {{ $errors->has('autre_service') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                    <option value="">Sélectionnez une formation</option>
                                    @foreach($formations as $formation)
                                    <option value="{{ $formation->title }}" {{ old('autre_service')==$formation->title ?
                                        'selected' : '' }}>
                                        {{ $formation->title }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('autre_service')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 mb-2">Message *</label>
                                <textarea name="message" rows="4" required
                                    class="w-full px-4 py-3 border {{ $errors->has('message') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                    placeholder="Votre message...">{{ old('message') }}</textarea>
                                @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full mt-6 inline-flex items-center justify-center px-6 py-4 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Envoyer ma demande
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Informations pratiques</h3>

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
                                <a href="mailto:formation@djokprestige.com"
                                    class="font-semibold hover:underline">formation@djokprestige.com</a>
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

                        <div class="p-4 bg-yellow-50 rounded-lg">
                            <h4 class="font-bold text-yellow-900 mb-2">Adresse du centre :</h4>
                            <p class="text-yellow-800">
                                <i class="fas fa-map-marker-alt text-yellow-600 mr-2"></i>
                                DJOK PRESTIGE Formation<br>
                                123 Avenue des Champs-Élysées<br>
                                75008 Paris
                            </p>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('formation') }}"
                                class="inline-flex items-center px-8 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300 transform hover:scale-105">
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

        // Auto-hide du message de succès
        const successMessage = document.querySelector('.bg-green-50');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 8000);
        }
    });
</script>
@endsection
