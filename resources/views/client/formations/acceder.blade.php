{{-- resources/views/client/formations/acceder.blade.php --}}
@extends('layouts.client')

@section('title', 'Accéder à la formation')
@section('page-title', 'Accéder à la formation')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.index') }}" class="text-gray-500 hover:text-djok-yellow transition-colors">
            Mes Formations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.show', $userFormation->id) }}" class="text-gray-500 hover:text-djok-yellow transition-colors">
            {{ $formation->title }}
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Accéder</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $formation->title }}</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $formation->type_formation === 'e_learning' ? 'Formation en ligne' : 'Formation présentielle' }}
                    </p>
                </div>
                <div class="text-sm text-gray-500">
                    @if($userFormation->progress > 0)
                    <div class="flex items-center">
                        <span class="mr-2">Progression :</span>
                        <div class="w-32 bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $userFormation->progress }}%"></div>
                        </div>
                        <span class="ml-2 font-medium">{{ $userFormation->progress }}%</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6">
            @if($medias->count() > 0)
                <div class="mb-8">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Contenu pédagogique</h4>
                    <div class="space-y-4">
                        @foreach($medias as $media)
                            <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                @if($media->type === 'video')
                                                    <i class="fas fa-play text-blue-600"></i>
                                                @elseif($media->type === 'pdf')
                                                    <i class="fas fa-file-pdf text-red-600"></i>
                                                @elseif($media->type === 'document')
                                                    <i class="fas fa-file-word text-blue-600"></i>
                                                @elseif($media->type === 'presentation')
                                                    <i class="fas fa-file-powerpoint text-orange-600"></i>
                                                @else
                                                    <i class="fas fa-file text-gray-600"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="font-medium text-gray-900">{{ $media->title }}</h5>
                                                <p class="text-sm text-gray-500">{{ $media->description }}</p>
                                                <div class="mt-1">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ ucfirst($media->type) }}
                                                    </span>
                                                    @if($media->duration)
                                                        <span class="ml-2 text-xs text-gray-500">
                                                            Durée : {{ $media->duration }}
                                                        </span>
                                                    @endif
                                                    @if($media->file_size)
                                                        <span class="ml-2 text-xs text-gray-500">
                                                            Taille : {{ $media->file_size }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        @if($media->type === 'video')
                                            <button type="button"
                                                    onclick="playVideo('{{ $media->file_path }}', '{{ $media->title }}')"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                                                <i class="fas fa-play mr-2"></i> Lire
                                            </button>
                                        @else
                                            <a href="{{ asset('storage/' . $media->file_path) }}"
                                               target="_blank"
                                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <i class="fas fa-download mr-2"></i> Télécharger
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Contenu en préparation</h3>
                    <p class="mt-2 text-sm text-gray-500">
                        Le contenu de cette formation est actuellement en cours de préparation.
                    </p>
                </div>
            @endif

            <!-- Modal pour vidéos -->
            <div id="videoModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full sm:p-6">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="videoTitle"></h3>
                                    <button type="button" onclick="closeVideo()" class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="mt-2">
                                    <div class="aspect-w-16 aspect-h-9">
                                        <video id="videoPlayer" controls class="w-full h-auto">
                                            Votre navigateur ne supporte pas la lecture de vidéos.
                                        </video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations d'accès -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Informations d'accès</h4>
                        <dl class="mt-2 text-sm text-gray-500 space-y-1">
                            <div class="flex justify-between">
                                <dt>Date de début :</dt>
                                <dd class="font-medium">{{ $userFormation->access_start->format('d/m/Y') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Date de fin :</dt>
                                <dd class="font-medium">{{ $userFormation->access_end->format('d/m/Y') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Jours restants :</dt>
                                <dd class="font-medium {{ now()->diffInDays($userFormation->access_end) < 30 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ now()->diffInDays($userFormation->access_end) }} jours
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Statut :</dt>
                                <dd>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Actif
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Actions</h4>
                        <div class="mt-2 space-y-3">
                            <a href="{{ route('client.formations.compte-rendu', $userFormation->id) }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow w-full justify-center">
                                <i class="fas fa-file-alt mr-2"></i> Consulter le compte-rendu
                            </a>
                            <div class="flex space-x-2">
                                <a href="{{ route('client.formations.show', $userFormation->id) }}"
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 flex-1 justify-center">
                                    <i class="fas fa-info-circle mr-2"></i> Détails
                                </a>
                                <a href="{{ route('client.formations.index') }}"
                                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 flex-1 justify-center">
                                    <i class="fas fa-arrow-left mr-2"></i> Retour
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes importantes -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Notes importantes</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Votre accès à cette formation est valable jusqu'au {{ $userFormation->access_end->format('d/m/Y') }}</li>
                        <li>Téléchargez les documents pour les consulter hors ligne</li>
                        <li>Pensez à marquer votre progression pour suivre votre avancement</li>
                        <li>En cas de problème technique, contactez notre support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function playVideo(videoUrl, title) {
        const modal = document.getElementById('videoModal');
        const videoPlayer = document.getElementById('videoPlayer');
        const videoTitle = document.getElementById('videoTitle');

        videoPlayer.src = '/storage/' + videoUrl;
        videoTitle.textContent = title;
        modal.classList.remove('hidden');

        // Jouer la vidéo automatiquement
        videoPlayer.play();
    }

    function closeVideo() {
        const modal = document.getElementById('videoModal');
        const videoPlayer = document.getElementById('videoPlayer');

        videoPlayer.pause();
        videoPlayer.src = '';
        modal.classList.add('hidden');
    }

    // Fermer la modal avec la touche Échap
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeVideo();
        }
    });

    // Fermer la modal en cliquant à l'extérieur
    document.getElementById('videoModal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeVideo();
        }
    });
</script>
@endpush
