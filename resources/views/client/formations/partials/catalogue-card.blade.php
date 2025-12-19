<div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <!-- En-tête avec image/icône -->
    <div class="relative h-48 bg-gradient-to-r
        @if($formation->type_formation === 'e_learning') from-blue-600 to-blue-800
        @elseif($formation->type_formation === 'presentiel') from-green-600 to-green-800
        @else from-purple-600 to-purple-800 @endif">

        @if($formation->media->first() && $formation->media->first()->thumbnail_path)
        <img src="{{ Storage::url($formation->media->first()->thumbnail_path) }}" alt="{{ $formation->title }}"
            class="w-full h-full object-cover">
        @else
        <div class="h-full flex items-center justify-center">
            <div class="text-center">
                <i class="fas fa-graduation-cap text-white text-4xl mb-2"></i>
                <p class="text-white font-semibold text-sm px-4">{{ Str::limit($formation->title, 40) }}</p>
            </div>
        </div>
        @endif

        <!-- Badge type -->
        <div class="absolute top-4 right-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold
                @if($formation->type_formation === 'e_learning') bg-blue-500
                @elseif($formation->type_formation === 'presentiel') bg-green-500
                @else bg-purple-500 @endif text-white">
                {{ $formation->type_formation === 'e_learning' ? 'En ligne' :
                ($formation->type_formation === 'presentiel' ? 'Présentiel' : 'Mixte') }}
            </span>
        </div>

        <!-- Badge déjà acheté -->
        @if(in_array($formation->id, $formationsAcheteesIds))
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500 text-white">
                <i class="fas fa-check mr-1"></i> Déjà acheté
            </span>
        </div>
        @endif
    </div>

    <div class="p-6">
        <!-- Catégorie -->
        <div class="mb-3">
            <span class="inline-block px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-800 rounded-full">
                {{ $formation->categorie === 'vtc_theorique' ? 'VTC Théorique' :
                ($formation->categorie === 'vtc_pratique' ? 'VTC Pratique' :
                ($formation->categorie === 'e_learning' ? 'E-learning' : 'Renouvellement')) }}
            </span>
        </div>

        <!-- Titre -->
        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $formation->title }}</h3>

        <!-- Description courte -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            {{ Str::limit(strip_tags($formation->description), 100) }}
        </p>

        <!-- Informations -->
        <div class="space-y-2 mb-4">
            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-clock text-gray-400 mr-2"></i>
                <span>{{ $formation->duree ?? 'Non définie' }}</span>
            </div>
            <div class="flex items-center text-sm text-gray-500">
                <i class="fas fa-video text-gray-400 mr-2"></i>
                <span>{{ $formation->media_count ?? 0 }} média(s)</span>
            </div>
            @if($formation->frais_examen === 'Inclus')
            <div class="flex items-center text-sm text-green-600">
                <i class="fas fa-check-circle mr-2"></i>
                <span>Frais d'examen inclus</span>
            </div>
            @endif
        </div>

        <!-- Prix et boutons -->
        <div class="flex items-center justify-between">
            <div>
                <span class="text-2xl font-bold text-yellow-600">
                    {{ number_format($formation->price, 0, ',', ' ') }} €
                </span>
                <span class="text-sm text-gray-500 block">TTC</span>
            </div>

            <div class="space-x-2">
                <!-- Bouton Détails -->
                <a href="{{ route('client.formations.catalogue.details', $formation) }}"
                    class="inline-flex items-center px-3 py-2 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 transition">
                    <i class="fas fa-eye mr-1"></i> Détails
                </a>

                <!-- Bouton Inscription -->
                @if(!in_array($formation->id, $formationsAcheteesIds))
                <a href="{{ route('client.formations.inscrire', $formation) }}" class="inline-flex items-center px-3 py-2
                          @if($formation->type_formation === 'e_learning') bg-green-600 hover:bg-green-700
                          @else bg-yellow-600 hover:bg-yellow-700 @endif
                          text-white text-sm font-semibold rounded-lg transition">
                    <i class="fas
                        @if($formation->type_formation === 'e_learning') fa-shopping-cart
                        @else fa-user-plus @endif mr-1"></i>
                    {{ $formation->type_formation === 'e_learning' ? 'Acheter' : 'S\'inscrire' }}
                </a>
                @else
                <span
                    class="inline-flex items-center px-3 py-2 bg-gray-300 text-gray-700 text-sm font-semibold rounded-lg cursor-not-allowed">
                    <i class="fas fa-check mr-1"></i> Déjà inscrit
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
