@extends('layouts.main')

@section('title', $formation->title . ' | DJOK PRESTIGE')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-12">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center justify-between">
            <div class="lg:w-2/3 mb-8 lg:mb-0">
                <nav class="mb-4" aria-label="breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="{{ route('home') }}" class="text-blue-200 hover:text-white">
                                <i class="fas fa-home"></i> Accueil
                            </a>
                        </li>
                        <li class="text-gray-400">
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li>
                            <a href="{{ route('formation') }}" class="text-blue-200 hover:text-white">
                                Formations
                            </a>
                        </li>
                        <li class="text-gray-400">
                            <i class="fas fa-chevron-right"></i>
                        </li>
                        <li class="text-white font-semibold">
                            {{ $formation->title }}
                        </li>
                    </ol>
                </nav>

                <h1 class="text-3xl md:text-4xl font-bold mb-4">{{ $formation->title }}</h1>

                <div class="flex flex-wrap gap-2 mb-6">
                    <!-- Format -->
                    <span class="px-3 py-1.5 text-sm font-medium rounded-full bg-white bg-opacity-20 backdrop-blur-sm">
                        <i class="fas fa-chalkboard-teacher mr-1"></i>
                        {{ $formation->format_affichage ?? ucfirst($formation->format_type) }}
                    </span>

                    <!-- Type -->
                    <span
                        class="px-3 py-1.5 text-sm font-medium rounded-full {{ $formation->type_formation === 'e_learning' ? 'bg-green-500' : 'bg-yellow-500' }}">
                        {{ $formation->type_formation === 'e_learning' ? 'Formation en ligne' : 'Formation présentielle'
                        }}
                    </span>

                    <!-- Catégorie -->
                    <span class="px-3 py-1.5 text-sm font-medium rounded-full bg-indigo-500">
                        @if($formation->categorie === 'vtc_theorique')
                        VTC Théorique
                        @elseif($formation->categorie === 'vtc_pratique')
                        VTC Pratique
                        @elseif($formation->categorie === 'e_learning')
                        E-learning
                        @elseif($formation->categorie === 'renouvellement')
                        Renouvellement
                        @elseif($formation->categorie === 'international')
                        International
                        @endif
                    </span>

                    <!-- Certification -->
                    @if($formation->is_certified)
                    <span class="px-3 py-1.5 text-sm font-medium rounded-full bg-yellow-500">
                        <i class="fas fa-certificate mr-1"></i>Certifiée
                    </span>
                    @endif

                    <!-- CPF -->
                    @if($formation->is_financeable_cpf)
                    <span class="px-3 py-1.5 text-sm font-medium rounded-full bg-purple-500">
                        <i class="fas fa-euro-sign mr-1"></i>Éligible CPF
                    </span>
                    @endif
                </div>

                <p class="text-lg text-blue-200 mb-6 max-w-3xl">
                    {{ Str::limit(strip_tags($formation->description), 200) }}
                </p>
            </div>

            <!-- Carte prix et action -->
            <div class="lg:w-1/3">
                <div class="bg-white text-gray-900 rounded-xl shadow-2xl p-6">
                    <div class="text-center mb-6">
                        <div class="text-4xl font-bold text-yellow-600 mb-1">
                            {{ number_format($formation->price, 0, ',', ' ') }}€
                        </div>
                        <div class="text-gray-600">Prix TTC</div>
                    </div>

                    <!-- Durée et médias -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">
                                {{ $formation->duration_hours }}h
                            </div>
                            <div class="text-gray-600 text-sm">Durée</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">
                                {{ $formation->media->count() }}
                            </div>
                            <div class="text-gray-600 text-sm">Ressources</div>
                        </div>
                    </div>

                    <!-- Services inclus -->
                    <div class="space-y-3 mb-6">
                        @if($formation->frais_examen === 'Inclus')
                        <div class="flex items-center text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Frais d'examen inclus</span>
                        </div>
                        @endif

                        @if($formation->location_vehicule === 'Inclus')
                        <div class="flex items-center text-green-600">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Location véhicule incluse</span>
                        </div>
                        @endif
                    </div>

                    <!-- Bouton principal -->
                    @if($formation->type_formation === 'presentiel')
                    <a href="{{ route('formation.inscrire.presentiel', $formation->id) }}"
                        class="w-full mb-3 inline-flex items-center justify-center px-6 py-3.5 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>
                        S'inscrire à cette formation
                    </a>
                    @elseif($formation->type_formation === 'e_learning')
                    <a href="{{ route('formation.acheter.elearning', $formation->id) }}"
                        class="w-full mb-3 inline-flex items-center justify-center px-6 py-3.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Acheter cette formation
                    </a>
                    @endif

                    <!-- Bouton secondaire -->
                    <a href="#contact"
                        class="w-full inline-flex items-center justify-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300">
                        <i class="fas fa-question-circle mr-2"></i>
                        Demander plus d'informations
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contenu principal -->
<div class="container mx-auto px-6 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Colonne gauche (2/3) -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Description complète -->
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                    <i class="fas fa-align-left text-yellow-600 mr-2"></i>
                    Description complète
                </h2>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($formation->description)) !!}
                </div>
            </section>

            <!-- Programme détaillé -->
            @if($formation->program && count($formation->program) > 0)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                    <i class="fas fa-list-ol text-yellow-600 mr-2"></i>
                    Programme détaillé
                </h2>
                <div class="space-y-4">
                    @foreach($formation->program as $index => $item)
                    <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-start">
                            <div
                                class="flex-shrink-0 h-8 w-8 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center mr-3">
                                <span class="font-bold text-sm">{{ $index + 1 }}</span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Module {{ $index + 1 }}</h3>
                                <p class="text-gray-700">{{ $item }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Fichiers multimédias (toujours verrouillés dans la page show) -->
            @php
            $pdfs = $formation->media->where('type', 'pdf');
            $videos = $formation->media->where('type', 'video');
            @endphp

            @if($pdfs->count() > 0 || $videos->count() > 0)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                    <i class="fas fa-photo-video text-yellow-600 mr-2"></i>
                    Ressources multimédias disponibles
                </h2>

                <!-- Message d'information -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-1">Ressources verrouillées</h4>
                            <p class="text-blue-700 text-sm">
                                Les ressources multimédias sont disponibles après achat de la
                                formation.
                                Vous pouvez voir le contenu disponible, mais l'accès direct est réservé aux clients.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Vidéos -->
                @if($videos->count() > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-video text-blue-600 mr-2"></i>
                        Vidéos ({{ $videos->count() }})
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($videos as $video)
                        <div
                            class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200 relative">
                            <!-- Overlay de verrouillage -->
                            <div
                                class="absolute inset-0 bg-gray-900 bg-opacity-50 z-10 flex items-center justify-center">
                                <div class="text-center p-4">
                                    <div class="text-white mb-2">
                                        <i class="fas fa-lock text-3xl"></i>
                                    </div>
                                    <p class="text-white font-semibold">Accès réservé</p>
                                    <p class="text-gray-300 text-sm mt-1">Achetez la formation pour débloquer</p>
                                </div>
                            </div>

                            <div class="h-40 bg-gray-100 relative">
                                @if($video->thumbnail_path)
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="h-full flex items-center justify-center">
                                    <i class="fas fa-video text-gray-400 text-3xl"></i>
                                </div>
                                @endif
                                @if($video->duration)
                                <div
                                    class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                                    {{ $video->duration }}
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="font-medium text-gray-900 mb-1">{{ $video->title }}</h4>
                                @if($video->description)
                                <p class="text-sm text-gray-600 mb-2">{{ Str::limit($video->description, 60) }}</p>
                                @endif
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span>{{ $video->file_name }}</span>
                                    <span>{{ $video->file_size }}</span>
                                </div>

                                <!-- Bouton verrouillé -->
                                <div class="mt-3">
                                    <button disabled
                                        class="inline-flex items-center px-3 py-1.5 text-sm bg-gray-400 text-white rounded-lg cursor-not-allowed">
                                        <i class="fas fa-lock mr-1"></i> Verrouillé
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- PDFs -->
                @if($pdfs->count() > 0)
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-pdf text-red-600 mr-2"></i>
                        Documents PDF ({{ $pdfs->count() }})
                    </h3>
                    <div class="space-y-3">
                        @foreach($pdfs as $pdf)
                        <div
                            class="flex items-center justify-between bg-white p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors duration-200 relative">
                            <!-- Overlay de verrouillage -->
                            <div
                                class="absolute inset-0 bg-gray-100 bg-opacity-90 z-10 flex items-center justify-center rounded-lg">
                                <div class="text-center p-4">
                                    <div class="text-gray-600 mb-2">
                                        <i class="fas fa-lock text-2xl"></i>
                                    </div>
                                    <p class="text-gray-700 font-semibold">Document verrouillé</p>
                                </div>
                            </div>

                            <div class="flex items-center">
                                <div class="h-12 w-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $pdf->title }}</h4>
                                    @if($pdf->description)
                                    <p class="text-sm text-gray-600">{{ Str::limit($pdf->description, 80) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-500 mb-1">{{ $pdf->file_size }}</div>

                                <!-- Bouton verrouillé -->
                                <button disabled
                                    class="inline-flex items-center px-3 py-1.5 text-sm bg-gray-400 text-white rounded-lg cursor-not-allowed">
                                    <i class="fas fa-lock mr-1"></i> Verrouillé
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </section>
            @endif

            <!-- Services inclus -->
            @if($formation->included_services && count($formation->included_services) > 0)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                    <i class="fas fa-gift text-yellow-600 mr-2"></i>
                    Services inclus
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($formation->included_services as $service)
                    <div class="flex items-center p-4 bg-green-50 rounded-lg border border-green-100">
                        <div
                            class="flex-shrink-0 h-8 w-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-green-600 text-sm"></i>
                        </div>
                        <span class="text-gray-800">{{ $service }}</span>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Prérequis -->
            @if($formation->requirements && count($formation->requirements) > 0)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-3 border-b border-gray-200">
                    <i class="fas fa-clipboard-check text-yellow-600 mr-2"></i>
                    Prérequis
                </h2>
                <ul class="space-y-3">
                    @foreach($formation->requirements as $requirement)
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                        <span class="text-gray-700">{{ $requirement }}</span>
                    </li>
                    @endforeach
                </ul>
            </section>
            @endif
        </div>

        <!-- Colonne droite (1/3) -->
        <div class="space-y-8">
            <!-- Carte d'action fixe -->
            <div class="sticky top-6">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Réserver cette formation</h3>

                    <div class="space-y-4">
                        <!-- Prix -->
                        <div class="text-center mb-6">
                            <div class="text-3xl font-bold text-yellow-600">
                                {{ number_format($formation->price, 0, ',', ' ') }}€
                            </div>
                            <div class="text-gray-600">Prix TTC</div>
                        </div>

                        <!-- Bouton principal -->
                        @if($formation->type_formation === 'presentiel')
                        <a href="{{ route('formation.inscrire.presentiel', $formation->id) }}"
                            class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 mb-3">
                            <i class="fas fa-user-plus mr-2"></i>
                            S'inscrire maintenant
                        </a>
                        @elseif($formation->type_formation === 'e_learning')
                        <a href="{{ route('formation.acheter.elearning', $formation->id) }}"
                            class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105 mb-3">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Acheter cette formation
                        </a>
                        @endif

                        <!-- Information sur les médias -->
                        <div class="p-4 bg-yellow-50 rounded-lg">
                            <h4 class="font-bold text-yellow-900 mb-2 flex items-center">
                                <i class="fas fa-video mr-2"></i>
                                Contenu multimédia
                            </h4>
                            <p class="text-sm text-yellow-700">
                                Cette formation comprend {{ $formation->media->count() }} ressources (vidéos, PDFs)
                                disponibles après <strong>achat</strong>.
                            </p>
                        </div>

                        <!-- Informations complémentaires -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Durée :</span>
                                <span class="font-semibold">{{ $formation->duree ?? $formation->duration_hours.'h'
                                    }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Format :</span>
                                <span class="font-semibold">{{ $formation->format_affichage ??
                                    ucfirst($formation->format_type) }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Type :</span>
                                <span
                                    class="font-semibold {{ $formation->type_formation === 'e_learning' ? 'text-green-600' : 'text-yellow-600' }}">
                                    {{ $formation->type_formation === 'e_learning' ? 'En ligne' : 'Présentiel' }}
                                </span>
                            </div>
                        </div>

                        <!-- Financement -->
                        @if($formation->is_financeable_cpf)
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-bold text-blue-900 mb-2 flex items-center">
                                <i class="fas fa-euro-sign mr-2"></i>
                                Financement CPF disponible
                            </h4>
                            <p class="text-sm text-blue-700">
                                Cette formation est éligible au Compte Personnel de Formation.
                            </p>
                        </div>
                        @endif

                        <!-- Contact rapide -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="font-bold text-gray-900 mb-3">Questions ?</h4>
                            <div class="space-y-2">
                                <a href="tel:0176380017"
                                    class="flex items-center text-gray-700 hover:text-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-phone-alt mr-3"></i>
                                    <span>01 76 38 00 17</span>
                                </a>
                                <a href="mailto:formation@djokprestige.com"
                                    class="flex items-center text-gray-700 hover:text-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-envelope mr-3"></i>
                                    <span>formation@djokprestige.com</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formation similaire -->
            @php
            $similarFormations = App\Models\Formation::where('id', '!=', $formation->id)
            ->where('is_active', true)
            ->where('type_formation', $formation->type_formation)
            ->limit(3)
            ->get();
            @endphp

            @if($similarFormations->count() > 0)
            <div class="bg-gray-50 rounded-xl p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Formations similaires</h3>
                <div class="space-y-4">
                    @foreach($similarFormations as $similar)
                    <a href="{{ route('formation.show', $similar->slug) }}"
                        class="block bg-white rounded-lg p-4 hover:shadow-md transition-shadow duration-200 border border-gray-200">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">{{ Str::limit($similar->title, 40) }}</h4>
                                <div class="text-sm text-gray-600 mb-2">{{ $similar->duree ??
                                    $similar->duration_hours.'h' }}</div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-yellow-600">{{ number_format($similar->price, 0, ',',
                                    ' ') }}€</div>
                            </div>
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <span
                                class="px-2 py-1 rounded-full {{ $similar->type_formation === 'e_learning' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $similar->type_formation === 'e_learning' ? 'En ligne' : 'Présentiel' }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Section contact -->
<section id="contact" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Demander plus d'informations</h2>

            <!-- Messages d'erreur/succès -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                    <div>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                    <div>
                        <h4 class="font-bold text-red-800 mb-1">Veuillez corriger les erreurs suivantes :</h4>
                        <ul class="text-red-700 text-sm mt-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Formulaire -->
                <div>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- CHAMPS IMPORTANTS : service_id DOIT être "autre" et autre_service DOIT contenir la formation -->
                        <input type="hidden" name="service_id" value="autre">

                        <!-- On utilise old() avec une valeur par défaut pour éviter qu'il soit vide après rechargement -->
                        <input type="hidden" name="autre_service"
                            value="{{ old('autre_service', $formation->title ?? 'Formation ' . ($formation->title ?? '')) }}">

                        <!-- Champs supplémentaires pour contexte -->
                        <input type="hidden" name="formation_id" value="{{ $formation->id ?? '' }}">
                        <input type="hidden" name="type_demande" value="formation">

                        <div>
                            <label for="nom" class="block text-gray-700 mb-2">Nom complet *</label>
                            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                                class="w-full px-4 py-3 border {{ $errors->has('nom') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                            @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="email" class="block text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="w-full px-4 py-3 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="telephone" class="block text-gray-700 mb-2">Téléphone *</label>
                                <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}"
                                    required
                                    class="w-full px-4 py-3 border {{ $errors->has('telephone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent">
                                @error('telephone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Affichage formation concernée (VISUEL UNIQUEMENT) -->
                        <div>
                            <label class="block text-gray-700 mb-2">Formation concernée *</label>
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="font-semibold text-gray-900">{{ $formation->title }}</div>
                                <div class="text-sm text-gray-600 mt-2">
                                    <span class="inline-block mr-4">
                                        <i class="fas fa-clock mr-1"></i>{{ $formation->duree ??
                                        $formation->duration_hours.'h' }}
                                    </span>
                                    <span class="inline-block mr-4">
                                        <i class="fas fa-euro-sign mr-1"></i>{{ number_format($formation->price, 0, ',',
                                        ' ') }} €
                                    </span>
                                    <span class="inline-block">
                                        <i class="fas fa-chalkboard-teacher mr-1"></i>{{ $formation->type_formation ===
                                        'e_learning' ? 'En ligne' : 'Présentiel' }}
                                    </span>
                                </div>
                                <!-- Petit message d'information -->
                                <p class="text-xs text-gray-500 mt-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Cette information est automatiquement envoyée avec votre demande
                                </p>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-gray-700 mb-2">Message *</label>
                            <textarea name="message" id="message" rows="5" required
                                class="w-full px-4 py-3 border {{ $errors->has('message') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                placeholder="Vos questions sur cette formation...">{{ old('message') }}</textarea>
                            @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full inline-flex items-center justify-center px-6 py-3.5 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Envoyer ma demande
                        </button>

                        <!-- Message d'information -->
                        <p class="text-xs text-gray-500 text-center mt-4">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Vos informations sont sécurisées et ne seront utilisées que pour répondre à votre demande
                        </p>
                    </form>
                </div>

                <!-- Informations de contact -->
                <div>
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Contactez-nous</h3>

                        <div class="space-y-6">
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Par téléphone</h4>
                                <a href="tel:0176380017"
                                    class="flex items-center text-lg text-gray-700 hover:text-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-phone-alt text-yellow-600 mr-3"></i>
                                    <span>01 76 38 00 17</span>
                                </a>
                                <p class="text-sm text-gray-600 mt-2">Lun-Ven: 9h-19h | Sam: 9h-13h</p>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Par email</h4>
                                <a href="mailto:formation@djokprestige.com"
                                    class="flex items-center text-lg text-gray-700 hover:text-yellow-600 transition-colors duration-200">
                                    <i class="fas fa-envelope text-yellow-600 mr-3"></i>
                                    <span>formation@djokprestige.com</span>
                                </a>
                            </div>

                            <div>
                                <h4 class="font-semibold text-gray-900 mb-3">Notre centre</h4>
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-yellow-600 mr-3 mt-1"></i>
                                    <div>
                                        <p class="text-gray-700">DJOK PRESTIGE Formation</p>
                                        <p class="text-gray-600 text-sm">123 Avenue des Champs-Élysées</p>
                                        <p class="text-gray-600 text-sm">75008 Paris</p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ rapide -->
                            <div class="pt-6 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-3">Questions fréquentes</h4>
                                <div class="space-y-3">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">Puis-je payer en plusieurs fois ?</p>
                                        <p class="text-gray-600">Oui, nous proposons des facilités de paiement.</p>
                                    </div>
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">Comment utiliser mon CPF ?</p>
                                        <p class="text-gray-600">Notre équipe vous accompagne dans les démarches.</p>
                                    </div>
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">Quand puis-je commencer ?</p>
                                        <p class="text-gray-600">Démarrage possible sous 48h pour les formations en
                                            ligne.</p>
                                    </div>
                                </div>
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

        // Animation au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        // Animer les sections
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(section);
        });

        // Auto-hide du message de succès
        const successMessage = document.querySelector('.bg-green-50');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 8000);
        }

        // Vérification du formulaire avant envoi (optionnel)
        const contactForm = document.querySelector('form[action*="contact.store"]');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                // Vérifier que autre_service n'est pas vide
                const autreServiceInput = this.querySelector('input[name="autre_service"]');
                if (autreServiceInput && !autreServiceInput.value.trim()) {
                    e.preventDefault();
                    alert('Erreur: Veuillez rafraîchir la page et réessayer.');
                    return false;
                }
            });
        }
    });
</script>
@endsection
