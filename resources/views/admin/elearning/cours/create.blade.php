@extends('layouts.admin')

@section('title', 'Nouveau cours E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="mb-6">
        <a href="{{ route('admin.elearning.cours') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux cours
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Créer un nouveau cours</h2>
        </div>

        <form action="{{ route('admin.elearning.cours.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre du cours *</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ex: Réglementation VTC" value="{{ old('title') }}">
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug (URL) *</label>
                    <input type="text" name="slug" id="slug" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ex: reglementation-vtc" value="{{ old('slug') }}">
                    <p class="text-xs text-gray-500 mt-1">Utilisez des tirets, pas d'espaces</p>
                    @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Description du cours...">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenu du cours *</label>
                <textarea id="content" name="content" rows="15" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">Fichier vidéo</label>
                    <input type="file" name="video_file" id="video_file" accept=".mp4,.mov,.avi,.mkv"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Formats acceptés: MP4, MOV, AVI, MKV (max 100MB)</p>
                    @error('video_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Champ pour le nom de la vidéo -->
                    <div class="mt-2">
                        <label for="video_name" class="block text-xs text-gray-600 mb-1">Nom d'affichage de la vidéo
                            (optionnel)</label>
                        <input type="text" name="video_name" id="video_name"
                            class="w-full px-3 py-1 text-sm border border-gray-300 rounded"
                            placeholder="Ex: Introduction à la réglementation" value="{{ old('video_name') }}">
                    </div>
                </div>

                <div>
                    <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-2">Fichier PDF</label>
                    <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Format: PDF (max 50MB)</p>
                    @error('pdf_file')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Champ pour le nom du PDF -->
                    <div class="mt-2">
                        <label for="pdf_name" class="block text-xs text-gray-600 mb-1">Nom d'affichage du PDF
                            (optionnel)</label>
                        <input type="text" name="pdf_name" id="pdf_name"
                            class="w-full px-3 py-1 text-sm border border-gray-300 rounded"
                            placeholder="Ex: Support de cours complet" value="{{ old('pdf_name') }}">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-2">Durée
                        (minutes)</label>
                    <input type="number" name="duration_minutes" id="duration_minutes" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('duration_minutes', 60) }}">
                    @error('duration_minutes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="order" id="order" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ old('order', 0) }}">
                    @error('order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Cours actif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.elearning.cours') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Créer le cours
                </button>
            </div>
        </form>
    </div>
</div>

@section('scripts')
<script>
    // Auto-générer le slug à partir du titre
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Enlève les accents
            .replace(/[^a-z0-9\s-]/g, '') // Enlève les caractères spéciaux
            .replace(/\s+/g, '-') // Remplace les espaces par des tirets
            .replace(/-+/g, '-') // Évite les tirets multiples
            .trim();
        
        document.getElementById('slug').value = slug;
    });
</script>

<!-- TinyMCE simple (sans upload d'images) -->
<script src="https://cdn.tiny.cloud/1/YOUR_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        height: 500,
        menubar: true,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        // Désactive les uploads d'images dans TinyMCE
        images_upload_url: false,
        images_upload_handler: false
    });
</script>
@endsection
@endsection