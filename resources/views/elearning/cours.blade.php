@extends('layouts.main')

@section('title', $cours->title . ' - DJOK PRESTIGE')

@section('content')
<style>
    /* Correction pour les descriptions */
    .description-text {
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
        line-height: 1.6em;
    }

    /* Pour les longues descriptions dans le cours */
    .cours-description {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 10px;
    }

    /* Pour la description des QCM */
    .qcm-description {
        white-space: normal;
        word-wrap: break-word;
        overflow-wrap: break-word;
        line-height: 1.5em;
        margin-top: 8px;
    }

    /* Scrollbar personnalisée */
    .cours-description::-webkit-scrollbar {
        width: 6px;
    }

    .cours-description::-webkit-scrollbar-track {
        background: #2d2d2d;
        border-radius: 3px;
    }

    .cours-description::-webkit-scrollbar-thumb {
        background: #b89449;
        border-radius: 3px;
    }

    /* Assurer que les iframes sont bien visibles */
    iframe,
    video {
        max-width: 100%;
        display: block;
    }

    .aspect-video {
        aspect-ratio: 16 / 9;
        width: 100%;
    }

    /* Pour le conteneur PDF */
    .pdf-container {
        height: 500px;
        border: 1px solid #333;
        border-radius: 8px;
        overflow: hidden;
    }

    /* Correction pour les cartes de contenu */
    .content-card {
        min-width: 0;
        overflow: hidden;
    }
</style>

<!-- Header -->
<div class="bg-black border-b border-gray-800">
    <div class="container px-4 mx-auto md:px-6">
        <div class="flex items-center justify-between py-4">
            <div class="flex items-center">
                <a href="{{ route('elearning.virtual-room') }}" class="mr-4">
                    <i class="fas fa-arrow-left" style="color: #b89449;"></i>
                </a>
                <img src="{{ asset('DP2.webp') }}" alt="DJOK PRESTIGE" class="h-8">
                <div class="ml-4">
                    <h1 class="text-sm font-bold text-white">{{ $cours->title }}</h1>
                    <p class="text-xs text-gray-400">Cours e-learning</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div class="hidden text-right md:block">
                    <div class="text-sm font-medium text-white">{{ $acces->prenom }} {{ $acces->nom }}</div>
                    <div class="text-xs text-gray-400">Progression: {{ $acces->progression_percentage }}%</div>
                </div>
                <a href="{{ route('elearning.virtual-room') }}"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded"
                    style="background: #333; color: white;">
                    Retour à la salle
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="min-h-screen py-8" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
            <!-- Contenu du cours -->
            <div class="lg:col-span-3">
                <div class="mb-6 rounded-lg" style="background: #111; border: 1px solid #333;">
                    <div class="p-6">
                        <div class="flex flex-wrap items-center justify-between mb-6">
                            <div class="flex-1 min-w-0">
                                <h2 class="mb-2 text-xl font-bold text-white truncate">{{ $cours->title }}</h2>
                                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-400">
                                    <span class="flex items-center">
                                        <i class="mr-1 fas fa-clock"></i>
                                        {{ $cours->duration_formatted ?? 'Non spécifié' }}
                                    </span>
                                    @if($cours->hasVideo())
                                    <span class="flex items-center">
                                        <i class="mr-1 fas fa-video"></i>
                                        Vidéo incluse
                                    </span>
                                    @endif
                                    @if($cours->hasPdf())
                                    <span class="flex items-center">
                                        <i class="mr-1 fas fa-file-pdf"></i>
                                        Document inclus
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if(!$progression->cours_completed)
                            <form id="completeForm" action="{{ route('elearning.cours.complete', $cours->id) }}"
                                method="POST">
                                @csrf
                                <button type="submit"
                                    class="px-4 py-2 font-medium transition-colors rounded whitespace-nowrap"
                                    style="background: #b89449; color: black;">
                                    <i class="mr-1 fas fa-check"></i>
                                    Marquer comme terminé
                                </button>
                            </form>
                            @else
                            <div class="px-4 py-2 rounded whitespace-nowrap"
                                style="background: #064e3b; color: #a7f3d0;">
                                <i class="mr-1 fas fa-check-circle"></i>
                                Terminé le {{ $progression->updated_at->format('d/m/Y') }}
                            </div>
                            @endif
                        </div>

                        @if($cours->description)
                        <div class="p-4 mb-6 rounded cours-description" style="background: #1a1a1a;">
                            <h3 class="mb-2 font-bold text-white">Description</h3>
                            <p class="text-gray-300 description-text">{{ $cours->description }}</p>
                        </div>
                        @endif

                        <!-- Contenu principal -->
                        <div class="mb-6">
                            <!-- Section Vidéo (si vidéo existe) -->
                            @if($cours->hasVideo())
                            <div class="mb-8">
                                <h3 class="mb-3 text-lg font-bold text-white">Vidéo du cours</h3>
                                <div class="overflow-hidden bg-black rounded-lg aspect-video">
                                    @if(str_contains($cours->video_url, 'youtube.com') ||
                                    str_contains($cours->video_url, 'youtu.be'))
                                    <!-- YouTube embed -->
                                    @php
                                    $youtubeId = '';
                                    if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                                    $cours->video_url, $matches)) {
                                    $youtubeId = $matches[1];
                                    }
                                    @endphp
                                    @if($youtubeId)
                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" class="w-full h-full"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                    @endif
                                    @elseif(str_contains($cours->video_url, 'vimeo.com'))
                                    <!-- Vimeo embed -->
                                    @php
                                    $vimeoId = '';
                                    if (preg_match('/vimeo\.com\/(\d+)/', $cours->video_url, $matches)) {
                                    $vimeoId = $matches[1];
                                    }
                                    @endphp
                                    @if($vimeoId)
                                    <iframe src="https://player.vimeo.com/video/{{ $vimeoId }}" class="w-full h-full"
                                        frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                    @endif
                                    @else
                                    <!-- Vidéo HTML5 native -->
                                    <video controls class="w-full h-full" controlsList="nodownload">
                                        <source src="{{ $cours->video_url }}" type="video/mp4">
                                        Votre navigateur ne supporte pas la lecture de vidéos.
                                    </video>
                                    @endif
                                </div>
                                @if($cours->video_display_name)
                                <p class="mt-2 text-sm text-gray-400">
                                    <i class="mr-1 fas fa-file-video"></i>
                                    {{ $cours->video_display_name }}
                                </p>
                                @endif
                            </div>
                            @endif

                            <!-- Section Document (si PDF existe) -->
                            @if($cours->hasPdf())
                            <div class="mb-8">
                                <div class="flex flex-col items-start justify-between mb-3 sm:flex-row sm:items-center">
                                    <h3 class="mb-2 text-lg font-bold text-white sm:mb-0">Document du cours</h3>
                                    <div class="flex gap-2">
                                        <a href="{{ $cours->pdf_url }}" target="_blank"
                                            class="px-4 py-2 text-sm font-medium transition-colors rounded whitespace-nowrap"
                                            style="background: #1e40af; color: white;">
                                            <i class="mr-1 fas fa-external-link-alt"></i>
                                            Lire le document
                                        </a>
                                    </div>
                                </div>

                                @if($cours->pdf_display_name)
                                <div class="p-3 mb-3 rounded" style="background: #1a1a1a;">
                                    <div class="flex items-start">
                                        <i class="mt-1 mr-3 fas fa-info-circle" style="color: #b89449;"></i>
                                        <div>
                                            <p class="text-sm text-gray-300">
                                                Ce cours contient un document que vous pouvez lire en cliquant sur "Lire
                                                le document".
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endif

                            <!-- Section Contenu texte/HTML (si contenu texte existe) -->
                           @if($cours->content)
                        <div class="min-w-0 mb-8">
                            <h3 class="mb-3 text-lg font-bold text-white break-words">Contenu du cours</h3>
                            <div class="min-w-0 p-4 overflow-hidden rounded" style="background: #1a1a1a;">
                                <div class="prose break-words prose-invert max-w-none">
                                    {!! $cours->content !!}
                                </div>
                            </div>
                        </div>
                        @endif

                            <!-- Message si aucun contenu -->
                            @if(!$cours->hasVideo() && !$cours->hasPdf() && !$cours->content)
                            <div class="py-12 text-center">
                                <i class="mb-4 text-4xl fas fa-book-open" style="color: #666;"></i>
                                <p class="text-gray-400">Contenu du cours à venir</p>
                            </div>
                            @endif
                        </div>

                        <!-- Navigation simplifiée -->
                        <div class="flex justify-between pt-6 border-t border-gray-800">
                            <div>
                                <a href="{{ route('elearning.virtual-room') }}" class="inline-flex items-center text-sm"
                                    style="color: #b89449;">
                                    <i class="mr-2 fas fa-arrow-left"></i>
                                    Retour à la salle
                                </a>
                            </div>
                            <div>
                                @if($cours->qcms->isNotEmpty())
                                <a href="{{ route('elearning.qcm.show', $cours->qcms->first()->id) }}"
                                    class="inline-flex items-center text-sm" style="color: #b89449;">
                                    Passer le QCM
                                    <i class="ml-2 fas fa-arrow-right"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QCM associé -->
                @if($cours->qcms->isNotEmpty())
                @php
                $coursQcm = $cours->qcms->first();
                @endphp
                <div class="overflow-hidden rounded-lg content-card" style="background: #111; border: 1px solid #333;">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-white">QCM associé</h3>
                            @if($progression->qcm_score)
                            <span class="px-3 py-1 text-sm font-semibold rounded-full whitespace-nowrap"
                                style="{{ $progression->hasPassedQcm() ? 'background: #064e3b; color: #a7f3d0;' : 'background: #7f1d1d; color: #fca5a5;' }}">
                                Score: {{ $progression->qcm_score }}%
                            </span>
                            @endif
                        </div>

                        <div class="flex flex-col justify-between p-4 overflow-hidden rounded md:flex-row md:items-center"
                            style="background: #1a1a1a;">
                            <div class="flex-1 min-w-0 mb-3 md:mb-0">
                                <h4 class="mb-1 font-medium text-white truncate">{{ $coursQcm->title }}</h4>
                                <div class="mb-2 text-sm text-gray-400">
                                    {{ $coursQcm->questions_count }} questions
                                    @if($coursQcm->time_limit_minutes)
                                    • {{ $coursQcm->time_limit_minutes }} minutes
                                    @endif
                                </div>
                                @if($coursQcm->description)
                                <div class="overflow-hidden">
                                    <p class="text-sm text-gray-500 break-words qcm-description">
                                        {{ $coursQcm->description }}
                                    </p>
                                </div>
                                @endif
                            </div>
                            <div class="flex-shrink-0 mt-3 md:ml-4 md:mt-0">
                                <a href="{{ route('elearning.qcm.show', $coursQcm->id) }}"
                                    class="px-4 py-2 text-sm font-medium transition-colors rounded whitespace-nowrap"
                                    style="background: #1e40af; color: white;">
                                    @if($progression->qcm_completed)
                                    Repasser le QCM
                                    @else
                                    Passer le QCM
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Progression -->
                <div class="mb-6 rounded-lg content-card" style="background: #111; border: 1px solid #333;">
                    <div class="p-6">
                        <h3 class="mb-4 font-bold text-white">Votre progression</h3>

                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between mb-1 text-sm text-gray-400">
                                    <span>Cours terminé</span>
                                    <span>
                                        @if($progression->cours_completed)
                                        <i class="fas fa-check" style="color: #10b981;"></i>
                                        @else
                                        <i class="fas fa-times" style="color: #ef4444;"></i>
                                        @endif
                                    </span>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full" style="background: #333;">
                                    <div class="h-full"
                                        style="background: {{ $progression->cours_completed ? '#10b981' : '#ef4444' }}; width: {{ $progression->cours_completed ? 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>

                            @if($cours->qcms->isNotEmpty())
                            @php
                            $coursQcm = $cours->qcms->first();
                            @endphp
                            <div>
                                <div class="flex justify-between mb-1 text-sm text-gray-400">
                                    <span>QCM complété</span>
                                    <span>
                                        @if($progression->qcm_completed)
                                        <i class="fas fa-check" style="color: #10b981;"></i>
                                        @else
                                        <i class="fas fa-times" style="color: #ef4444;"></i>
                                        @endif
                                    </span>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full" style="background: #333;">
                                    <div class="h-full"
                                        style="background: {{ $progression->qcm_completed ? '#10b981' : '#ef4444' }}; width: {{ $progression->qcm_completed ? 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>

                            @if($progression->qcm_completed)
                            <div>
                                <div class="flex justify-between mb-1 text-sm text-gray-400">
                                    <span>Score obtenu</span>
                                    <span
                                        class="font-medium {{ $progression->hasPassedQcm() ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $progression->qcm_score }}%
                                    </span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Score minimum requis : {{ $coursQcm->passing_score }}%
                                </div>
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info du cours -->
                <div class="p-6 rounded-lg content-card" style="background: #1a1a1a; border: 1px solid #333;">
                    <h3 class="mb-4 font-bold text-white">Informations</h3>

                    <div class="space-y-3">
                        <div>
                            <p class="mb-1 text-xs text-gray-400">Durée estimée</p>
                            <p class="text-sm text-white">{{ $cours->duration_formatted ?? 'Non spécifiée' }}</p>
                        </div>

                        <div>
                            <p class="mb-1 text-xs text-gray-400">Type de contenu</p>
                            <p class="text-sm text-white">
                                @if($cours->hasVideo() && $cours->hasPdf())
                                <i class="mr-1 fas fa-video"></i> Vidéo +
                                <i class="ml-2 mr-1 fas fa-file-pdf"></i> Document
                                @elseif($cours->hasVideo())
                                <i class="mr-1 fas fa-video"></i> Vidéo
                                @elseif($cours->hasPdf())
                                <i class="mr-1 fas fa-file-pdf"></i> Document
                                @elseif($cours->content)
                                <i class="mr-1 fas fa-file-alt"></i> Contenu texte
                                @else
                                <i class="mr-1 fas fa-question-circle"></i> Non spécifié
                                @endif
                            </p>
                        </div>

                        @if($cours->hasVideo())
                        <div>
                            <p class="mb-1 text-xs text-gray-400">Fichier vidéo</p>
                            <p class="text-sm text-white truncate" title="{{ $cours->video_display_name }}">
                                {{ $cours->video_display_name }}
                            </p>
                        </div>
                        @endif

                        @if($cours->hasPdf())
                        <div>
                            <p class="mb-1 text-xs text-gray-400">Document</p>
                            <p class="text-sm text-white truncate" title="{{ $cours->pdf_display_name }}">
                                {{ $cours->pdf_display_name }}
                            </p>
                        </div>
                        @endif

                        <div>
                            <p class="mb-1 text-xs text-gray-400">Dernière mise à jour</p>
                            <p class="text-sm text-white">{{ $cours->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Marquer le cours comme terminé
    document.getElementById('completeForm')?.addEventListener('submit', function(e) {
        e.preventDefault();

        fetch(this.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });

    // Gestion de la vidéo si présente
    @if($cours->hasVideo())
        // Initialiser le lecteur vidéo
        function initVideoPlayer() {
            console.log('Vidéo détectée:', '{{ $cours->video_url }}');

            // Si c'est une vidéo HTML5, ajouter des événements
            const videoElement = document.querySelector('video');
            if (videoElement) {
                videoElement.addEventListener('ended', function() {
                    console.log('Vidéo terminée');
                });
            }
        }

        initVideoPlayer();
    @endif

    // Gestion du document
    @if($cours->hasPdf())
        console.log('Document disponible:', '{{ $cours->pdf_url }}');

        // Ouvrir le document dans un nouvel onglet
        document.querySelector('a[href*=".pdf"]')?.addEventListener('click', function(e) {
            console.log('Ouverture du document:', this.href);
            // Le document s'ouvre dans un nouvel onglet via target="_blank"
        });
    @endif
</script>
@endsection
@endsection
