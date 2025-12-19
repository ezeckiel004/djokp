@extends('layouts.admin')

@section('title', 'Créer un Article')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Créer un nouvel article</h1>
        <p class="text-gray-600">Remplissez le formulaire pour publier un nouvel article</p>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Colonne principale -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Titre -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Titre de l'article *
                    </label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        required>
                    @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Extrait -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                        Extrait (description courte) *
                    </label>
                    <textarea name="excerpt" id="excerpt" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        required>{{ old('excerpt') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Cette description apparaîtra sur la liste des articles (150
                        caractères max)</p>
                    @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contenu -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="content" class="block text-sm font-medium text-gray-700">
                            Contenu de l'article *
                        </label>
                        <div class="text-sm text-gray-500">
                            <button type="button" onclick="formatText('bold')" class="mr-2 hover:text-yellow-600"
                                title="Gras">
                                <i class="fas fa-bold"></i>
                            </button>
                            <button type="button" onclick="formatText('italic')" class="mr-2 hover:text-yellow-600"
                                title="Italique">
                                <i class="fas fa-italic"></i>
                            </button>
                            <button type="button" onclick="formatText('underline')" class="mr-2 hover:text-yellow-600"
                                title="Souligné">
                                <i class="fas fa-underline"></i>
                            </button>
                            <button type="button" onclick="insertLink()" class="mr-2 hover:text-yellow-600"
                                title="Lien">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>

                    <textarea name="content" id="content" rows="20"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 font-sans text-base leading-relaxed"
                        required placeholder="Commencez à rédiger votre article ici...">{{ old('content') }}</textarea>

                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm font-medium text-gray-700 mb-2">Conseils de rédaction :</p>
                        <ul class="text-xs text-gray-600 space-y-1">
                            <li>• Utilisez des paragraphes courts (3-5 lignes maximum)</li>
                            <li>• Séparez les paragraphes par une ligne vide</li>
                            <li>• Utilisez **gras** pour les mots importants</li>
                            <li>• Ajoutez des sous-titres avec ###</li>
                            <li>• Pour les listes, utilisez * pour les puces</li>
                        </ul>
                    </div>

                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Colonne latérale -->
            <div class="space-y-6">
                <!-- Image -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Image principale
                    </label>
                    <div class="mt-1">
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100"
                            accept="image/*">
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG jusqu'à 2MB</p>
                        @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aperçu image -->
                    <div id="imagePreview" class="mt-3 hidden">
                        <p class="text-sm text-gray-600 mb-2">Aperçu :</p>
                        <img id="previewImage" class="w-full h-48 object-cover rounded-lg">
                    </div>
                </div>

                <!-- Catégorie -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        Catégorie *
                    </label>
                    <select name="category" id="category"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ old('category')==$key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icône et Couleur -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            Icône
                        </label>
                        <select name="icon" id="icon"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">Sélectionner une icône</option>
                            @foreach($icons as $key => $label)
                            <option value="{{ $key }}" {{ old('icon')==$key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                            Couleur
                        </label>
                        <select name="color" id="color"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="">Couleur par défaut</option>
                            @foreach($colors as $key => $label)
                            <option value="{{ $key }}" {{ old('color')==$key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Temps de lecture -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Temps de lecture (minutes)
                    </label>
                    <input type="number" name="reading_time" id="reading_time" value="{{ old('reading_time', 3) }}"
                        min="1"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                    @error('reading_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Options -->
                <div class="bg-gray-50 p-4 rounded-lg space-y-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked'
                            : '' }} class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                        <label for="featured" class="ml-2 text-sm text-gray-700">
                            Mettre en avant (à la une)
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked'
                            : '' }} class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                        <label for="published" class="ml-2 text-sm text-gray-700">
                            Publier immédiatement
                        </label>
                    </div>
                </div>

                <!-- Compteur de mots -->
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-blue-700">Statistiques :</span>
                        <span id="wordCount" class="text-sm text-blue-600">0 mots</span>
                    </div>
                    <div class="mt-1 text-xs text-blue-600">
                        <p id="readingTimeEstimate">Temps estimé : 0 min</p>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex space-x-3">
                    <button type="submit"
                        class="flex-1 bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-3 rounded-lg font-medium transition duration-300">
                        <i class="fas fa-save mr-2"></i>Enregistrer
                    </button>
                    <a href="{{ route('admin.articles.index') }}"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-3 rounded-lg font-medium text-center transition duration-300">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Aperçu de l'image
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('previewImage');
    const previewContainer = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
    } else {
        previewContainer.classList.add('hidden');
    }
});

// Formatage du texte
function formatText(format) {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = textarea.value.substring(start, end);

    let formattedText = '';
    let cursorPos = 0;

    switch(format) {
        case 'bold':
            formattedText = '**' + selectedText + '**';
            cursorPos = start + 2;
            break;
        case 'italic':
            formattedText = '*' + selectedText + '*';
            cursorPos = start + 1;
            break;
        case 'underline':
            formattedText = '__' + selectedText + '__';
            cursorPos = start + 2;
            break;
    }

    // Remplacer le texte sélectionné
    textarea.value = textarea.value.substring(0, start) +
                     formattedText +
                     textarea.value.substring(end);

    // Replacer le curseur
    textarea.focus();
    textarea.setSelectionRange(cursorPos, cursorPos + selectedText.length);

    // Mettre à jour le compteur
    updateWordCount();
}

function insertLink() {
    const textarea = document.getElementById('content');
    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selectedText = textarea.value.substring(start, end);
    const url = prompt('Entrez l\'URL du lien :', 'https://');

    if (url) {
        const linkText = selectedText || 'Lien';
        const formattedLink = '[' + linkText + '](' + url + ')';

        textarea.value = textarea.value.substring(0, start) +
                         formattedLink +
                         textarea.value.substring(end);

        textarea.focus();
        const cursorPos = start + formattedLink.length;
        textarea.setSelectionRange(cursorPos, cursorPos);

        // Mettre à jour le compteur
        updateWordCount();
    }
}

// Compteur de mots
function updateWordCount() {
    const textarea = document.getElementById('content');
    const text = textarea.value;

    // Compter les mots (séparés par des espaces)
    const words = text.trim().split(/\s+/).filter(word => word.length > 0);
    const wordCount = words.length;

    // Mettre à jour l'affichage
    document.getElementById('wordCount').textContent = wordCount + ' mot' + (wordCount > 1 ? 's' : '');

    // Calculer le temps de lecture estimé (250 mots/minute)
    const readingTime = Math.ceil(wordCount / 250);
    document.getElementById('readingTimeEstimate').textContent = 'Temps estimé : ' +
        (readingTime > 0 ? readingTime + ' min' : '< 1 min');

    // Mettre à jour le champ hidden si nécessaire
    const readingTimeInput = document.getElementById('reading_time');
    if (readingTimeInput && readingTimeInput.value < readingTime && readingTime > 0) {
        readingTimeInput.value = readingTime;
    }
}

// Initialiser le compteur
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');

    // Mettre à jour le compteur au chargement
    updateWordCount();

    // Mettre à jour le compteur à chaque saisie
    contentTextarea.addEventListener('input', updateWordCount);

    // Mettre à jour le compteur au collage
    contentTextarea.addEventListener('paste', function() {
        setTimeout(updateWordCount, 100);
    });

    // Limiteur pour l'extrait
    const excerptTextarea = document.getElementById('excerpt');
    excerptTextarea.addEventListener('input', function() {
        if (this.value.length > 150) {
            this.value = this.value.substring(0, 150);
        }
    });
});
</script>
@endpush
@endsection
