@extends('layouts.client')

@section('title', $formation->title . ' | DJOK PRESTIGE')
@section('page-title', $formation->title)
@section('page-description', 'Détails de la formation')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.catalogue') }}" class="text-gray-500 hover:text-gray-700">
            Catalogue
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span>{{ $formation->title }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Messages d'alerte -->
    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Badge déjà inscrit -->
    @if($dejaInscrit)
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    <i class="fas fa-check-circle mr-1"></i>
                    Vous êtes déjà inscrit à cette formation.
                    <a href="{{ route('client.formations.index') }}" class="font-medium underline ml-1">
                        Voir mes formations
                    </a>
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- En-tête de la formation -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
        <div class="md:flex">
            <!-- Image/Vidéo -->
            <div class="md:w-2/5 bg-gradient-to-r
                @if($formation->type_formation === 'e_learning') from-blue-600 to-blue-800
                @elseif($formation->type_formation === 'presentiel') from-green-600 to-green-800
                @else from-purple-600 to-purple-800 @endif p-8">

                @if($formation->media->where('type', 'video')->first())
                @php $videoMedia = $formation->media->where('type', 'video')->first(); @endphp
                <div class="relative h-64 rounded-lg overflow-hidden">
                    @if($videoMedia->thumbnail_path)
                    <img src="{{ Storage::url($videoMedia->thumbnail_path) }}" alt="{{ $formation->title }}"
                        class="w-full h-full object-cover">
                    @else
                    <div class="h-full flex items-center justify-center">
                        <i class="fas fa-play-circle text-white text-6xl"></i>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-play-circle text-white text-5xl mb-2"></i>
                            <p class="text-white font-medium">Aperçu de la formation</p>
                        </div>
                    </div>
                </div>
                @else
                <div class="h-64 flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-graduation-cap text-white text-6xl mb-4"></i>
                        <h3 class="text-white text-xl font-bold">{{ $formation->title }}</h3>
                    </div>
                </div>
                @endif

                <!-- Badges -->
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        @if($formation->type_formation === 'e_learning') bg-blue-500
                        @elseif($formation->type_formation === 'presentiel') bg-green-500
                        @else bg-purple-500 @endif text-white">
                        {{ $formation->type_formation === 'e_learning' ? 'En ligne' :
                        ($formation->type_formation === 'presentiel' ? 'Présentiel' : 'Mixte') }}
                    </span>

                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-800 text-white">
                        {{ $formation->categorie === 'vtc_theorique' ? 'VTC Théorique' :
                        ($formation->categorie === 'vtc_pratique' ? 'VTC Pratique' :
                        ($formation->categorie === 'e_learning' ? 'E-learning' : 'Renouvellement')) }}
                    </span>

                    @if($formation->is_certified)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white">
                        <i class="fas fa-certificate mr-1"></i> Certifié
                    </span>
                    @endif

                    @if($formation->is_financeable_cpf)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-500 text-white">
                        <i class="fas fa-euro-sign mr-1"></i> CPF
                    </span>
                    @endif
                </div>
            </div>

            <!-- Détails -->
            <div class="md:w-3/5 p-8">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $formation->title }}</h1>
                        <p class="text-gray-600">{{ $formation->format_affichage ?? 'Formation complète' }}</p>
                    </div>

                    <div class="text-right">
                        <div class="text-3xl font-bold text-yellow-600">
                            {{ number_format($formation->price, 0, ',', ' ') }} €
                        </div>
                        <div class="text-sm text-gray-500">TTC</div>
                    </div>
                </div>

                <!-- Informations clés -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-clock text-gray-400 mr-2"></i>
                        <div>
                            <p class="text-sm text-gray-500">Durée</p>
                            <p class="font-medium">{{ $formation->duree ?? 'Non définie' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <i class="fas fa-video text-gray-400 mr-2"></i>
                        <div>
                            <p class="text-sm text-gray-500">Contenu</p>
                            <p class="font-medium">{{ $formation->media->count() }} média(s)</p>
                        </div>
                    </div>

                    @if($formation->frais_examen)
                    <div class="flex items-center">
                        <i class="fas fa-file-alt text-gray-400 mr-2"></i>
                        <div>
                            <p class="text-sm text-gray-500">Examen</p>
                            <p
                                class="font-medium {{ $formation->frais_examen === 'Inclus' ? 'text-green-600' : 'text-gray-600' }}">
                                {{ $formation->frais_examen }}
                            </p>
                        </div>
                    </div>
                    @endif

                    @if($formation->location_vehicule)
                    <div class="flex items-center">
                        <i class="fas fa-car text-gray-400 mr-2"></i>
                        <div>
                            <p class="text-sm text-gray-500">Véhicule</p>
                            <p
                                class="font-medium {{ $formation->location_vehicule === 'Inclus' ? 'text-green-600' : 'text-gray-600' }}">
                                {{ $formation->location_vehicule }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($formation->description)) !!}
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-wrap gap-3">
                    @if(!$dejaInscrit)
                    @if($formation->type_formation === 'e_learning')
                    <a href="{{ route('client.formations.inscrire', $formation->id) }}"
                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Acheter maintenant
                    </a>
                    @else
                    <a href="{{ route('client.formations.inscrire', $formation->id) }}"
                        class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-user-plus mr-2"></i>
                        S'inscrire
                    </a>
                    @endif
                    @else
                    <button disabled
                        class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg cursor-not-allowed">
                        <i class="fas fa-check-circle mr-2"></i>
                        Déjà inscrit
                    </button>
                    @endif

                    <a href="{{ route('client.formations.catalogue') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour au catalogue
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu détaillé -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Programme -->
        @if($formation->program && is_array($formation->program))
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Programme de la formation</h3>
                <div class="space-y-4">
                    @foreach($formation->program as $index => $item)
                    <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                        <div
                            class="flex-shrink-0 h-8 w-8 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center font-bold mr-3">
                            {{ $index + 1 }}
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-800">{{ $item }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Informations complémentaires -->
        <div class="space-y-6">
            <!-- Prérequis -->
            @if($formation->requirements && is_array($formation->requirements))
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Prérequis</h3>
                <ul class="space-y-2">
                    @foreach($formation->requirements as $requirement)
                    <li class="flex items-start">
                        <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
                        <span class="text-gray-700">{{ $requirement }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Services inclus -->
            @if($formation->included_services && is_array($formation->included_services))
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Services inclus</h3>
                <ul class="space-y-2">
                    @foreach($formation->included_services as $service)
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i>
                        <span class="text-gray-700">{{ $service }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Contenu média -->
            @if($formation->media->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Contenu multimédia</h3>
                <div class="space-y-3">
                    @php
                    $videos = $formation->media->where('type', 'video');
                    $pdfs = $formation->media->where('type', 'pdf');
                    @endphp

                    @if($videos->count() > 0)
                    <div class="mb-4">
                        <h4 class="font-medium text-gray-900 mb-2">
                            <i class="fas fa-video text-blue-500 mr-2"></i>
                            Vidéos ({{ $videos->count() }})
                        </h4>
                        <ul class="space-y-2">
                            @foreach($videos->take(3) as $video)
                            <li class="text-sm text-gray-600">
                                <i class="fas fa-play-circle text-gray-400 mr-1"></i>
                                {{ $video->title }}
                                @if($video->duration)
                                <span class="text-gray-400 ml-2">{{ $video->duration }}</span>
                                @endif
                            </li>
                            @endforeach
                            @if($videos->count() > 3)
                            <li class="text-sm text-gray-500">
                                + {{ $videos->count() - 3 }} vidéo(s) supplémentaire(s)
                            </li>
                            @endif
                        </ul>
                    </div>
                    @endif

                    @if($pdfs->count() > 0)
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            Documents PDF ({{ $pdfs->count() }})
                        </h4>
                        <ul class="space-y-2">
                            @foreach($pdfs->take(3) as $pdf)
                            <li class="text-sm text-gray-600">
                                <i class="fas fa-file-alt text-gray-400 mr-1"></i>
                                {{ $pdf->title }}
                            </li>
                            @endforeach
                            @if($pdfs->count() > 3)
                            <li class="text-sm text-gray-500">
                                + {{ $pdfs->count() - 3 }} document(s) supplémentaire(s)
                            </li>
                            @endif
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- FAQ / Questions fréquentes -->
    <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Questions fréquentes</h3>
        <div class="space-y-4">
            <div class="border-b border-gray-200 pb-4">
                <h4 class="font-medium text-gray-900 mb-2">Comment s'inscrire à cette formation ?</h4>
                <p class="text-gray-600 text-sm">
                    Cliquez sur le bouton "S'inscrire" ou "Acheter maintenant" selon le type de formation.
                    Pour le présentiel, vous serez contacté pour planifier les sessions.
                    Pour l'e-learning, l'accès est immédiat après paiement.
                </p>
            </div>

            <div class="border-b border-gray-200 pb-4">
                <h4 class="font-medium text-gray-900 mb-2">Quels sont les modes de paiement acceptés ?</h4>
                <p class="text-gray-600 text-sm">
                    Paiement en ligne sécurisé par carte bancaire. Pour le présentiel, possibilité de payer en plusieurs
                    fois.
                    Financement CPF disponible si la formation est éligible.
                </p>
            </div>

            <div class="border-b border-gray-200 pb-4">
                <h4 class="font-medium text-gray-900 mb-2">Combien de temps dure l'accès à la formation ?</h4>
                <p class="text-gray-600 text-sm">
                    Pour les formations e-learning : accès 12 mois à compter de la date d'achat.
                    Pour le présentiel : selon le planning établi avec notre centre.
                </p>
            </div>

            <div>
                <h4 class="font-medium text-gray-900 mb-2">Puis-je me désinscrire et me faire rembourser ?</h4>
                <p class="text-gray-600 text-sm">
                    Oui, selon nos conditions générales de vente.
                    Délai de rétractation de 14 jours pour les formations e-learning.
                    Contactez notre service client pour plus d'informations.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact rapide -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-blue-900 mb-2">Des questions sur cette formation ?</h3>
                <p class="text-blue-700">
                    Notre équipe pédagogique est à votre disposition pour répondre à toutes vos questions.
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="tel:0176380017"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors mr-3">
                    <i class="fas fa-phone mr-2"></i> 01 76 38 00 17
                </a>
                <a href="mailto:formation@djokprestige.com"
                    class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                    <i class="fas fa-envelope mr-2"></i> Nous écrire
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose {
        line-height: 1.75;
    }

    .prose p {
        margin-bottom: 1rem;
    }

    /* Animation pour les badges */
    @keyframes pulse-gentle {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }
    }

    .bg-yellow-600 {
        animation: pulse-gentle 2s infinite;
    }

    /* Transition pour les éléments */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    /* Style pour les listes */
    ul {
        list-style-type: none;
        padding-left: 0;
    }

    /* Amélioration de la lisibilité */
    .text-gray-700 {
        color: #374151;
    }

    .text-gray-600 {
        color: #4b5563;
    }
</style>
@endpush

@push('scripts')
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

    // Animation pour les éléments au scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, {
        threshold: 0.1
    });

    // Observer les sections
    document.querySelectorAll('.bg-white.rounded-xl').forEach(section => {
        observer.observe(section);
    });

    // Gestion des messages d'alerte
    const alertMessages = document.querySelectorAll('.bg-red-50, .bg-green-50, .bg-blue-50');
    alertMessages.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                if (alert.parentNode) {
                    alert.parentNode.removeChild(alert);
                }
            }, 500);
        }, 5000);
    });
});
</script>
@endpush
