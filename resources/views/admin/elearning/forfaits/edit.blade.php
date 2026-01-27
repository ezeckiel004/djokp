@extends('layouts.admin')

@section('title', 'Modifier le forfait E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.elearning.forfaits') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux forfaits
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Modifier le forfait</h2>
            <p class="text-sm text-gray-600 mt-1">{{ $forfait->name }}</p>
        </div>

        <form action="{{ route('admin.elearning.forfaits.update', $forfait->id) }}" method="POST" class="p-6"
            id="forfaitForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom du forfait *</label>
                    <input type="text" name="name" required value="{{ old('name', $forfait->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ex: Forfait Révision 30 jours">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Slug (URL) *</label>
                    <input type="text" name="slug" required value="{{ old('slug', $forfait->slug) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ex: forfait-revision-30-jours">
                    <p class="text-xs text-gray-500 mt-1">Utilisez des tirets, pas d'espaces</p>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Description détaillée du forfait...">{{ old('description', $forfait->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Prix (€) *</label>
                    <input type="number" name="price" step="0.01" min="0" required
                        value="{{ old('price', $forfait->price) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="49.90">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Durée (jours) *</label>
                    <input type="number" name="duration_days" min="1" max="365" required
                        value="{{ old('duration_days', $forfait->duration_days) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="30">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Connexions max *</label>
                    <input type="number" name="max_concurrent_connections" min="1" max="10" required
                        value="{{ old('max_concurrent_connections', $forfait->max_concurrent_connections) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Fonctionnalités</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="includes_qcm" value="1" {{ old('includes_qcm',
                            $forfait->includes_qcm) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Inclut les QCM</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="includes_examens_blancs" value="1" {{
                            old('includes_examens_blancs', $forfait->includes_examens_blancs) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Inclut les examens blancs</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="includes_certification" value="1" {{ old('includes_certification',
                            $forfait->includes_certification) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Inclut une certification</span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="access_order" min="0"
                        value="{{ old('access_order', $forfait->access_order) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div class="flex items-center">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $forfait->is_active) ?
                        'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm font-medium text-gray-700">Forfait actif</span>
                    </label>
                </div>
            </div>

            <!-- Section des fonctionnalités détaillées -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <label class="block text-sm font-medium text-gray-700">Fonctionnalités détaillées</label>
                    <button type="button" id="addFeatureBtn"
                        class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                        <i class="fas fa-plus mr-1"></i> Ajouter une fonctionnalité
                    </button>
                </div>

                <div id="featuresContainer" class="space-y-3">
                    @php
                    $features = $forfait->features ?? [];
                    if (is_string($features)) {
                    $features = json_decode($features, true) ?? [];
                    }
                    @endphp

                    @if(count($features) > 0)
                    @foreach($features as $index => $feature)
                    <div class="feature-item flex items-center space-x-2">
                        <input type="text" name="feature_titles[]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Titre de la fonctionnalité"
                            value="{{ old('feature_titles.'.$index, $feature['title'] ?? '') }}">
                        <textarea name="feature_descriptions[]" rows="1"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Description...">{{ old('feature_descriptions.'.$index, $feature['description'] ?? '') }}</textarea>
                        <button type="button" class="remove-feature px-3 py-2 text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    @endforeach
                    @else
                    <div class="feature-item flex items-center space-x-2">
                        <input type="text" name="feature_titles[]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Titre de la fonctionnalité" value="{{ old('feature_titles.0', '') }}">
                        <textarea name="feature_descriptions[]" rows="1"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Description...">{{ old('feature_descriptions.0', '') }}</textarea>
                        <button type="button" class="remove-feature px-3 py-2 text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Champ caché pour les fonctionnalités JSON -->
                <input type="hidden" name="features" id="featuresJson" value="{{ json_encode($features) }}">

                <p class="text-xs text-gray-500 mt-2">
                    Ajoutez des fonctionnalités spécifiques à ce forfait. Ces informations seront affichées sur la page
                    d'achat.
                </p>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="create_stripe_product" value="1" {{ old('create_stripe_product')
                        ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">Créer un produit Stripe associé</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">
                    Crée automatiquement un produit et un prix sur Stripe pour ce forfait (uniquement si pas déjà créé)
                </p>
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.elearning.forfaits') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const featuresContainer = document.getElementById('featuresContainer');
    const addFeatureBtn = document.getElementById('addFeatureBtn');
    const featuresJson = document.getElementById('featuresJson');
    const form = document.getElementById('forfaitForm');

    // Fonction pour ajouter une nouvelle fonctionnalité
    function addFeature(title = '', description = '') {
        const featureDiv = document.createElement('div');
        featureDiv.className = 'feature-item flex items-center space-x-2';
        featureDiv.innerHTML = `
            <input type="text" name="feature_titles[]"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Titre de la fonctionnalité"
                value="${title}">
            <textarea name="feature_descriptions[]" rows="1"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Description...">${description}</textarea>
            <button type="button" class="remove-feature px-3 py-2 text-red-600 hover:text-red-800">
                <i class="fas fa-trash"></i>
            </button>
        `;

        featuresContainer.appendChild(featureDiv);

        // Ajouter l'événement de suppression
        featureDiv.querySelector('.remove-feature').addEventListener('click', function() {
            featureDiv.remove();
            updateFeaturesJson();
        });

        // Ajouter les événements de mise à jour
        featureDiv.querySelector('input').addEventListener('input', updateFeaturesJson);
        featureDiv.querySelector('textarea').addEventListener('input', updateFeaturesJson);

        updateFeaturesJson();
    }

    // Fonction pour mettre à jour le JSON des fonctionnalités
    function updateFeaturesJson() {
        const titles = document.querySelectorAll('input[name="feature_titles[]"]');
        const descriptions = document.querySelectorAll('textarea[name="feature_descriptions[]"]');

        const features = [];

        titles.forEach((titleInput, index) => {
            const title = titleInput.value.trim();
            const description = descriptions[index] ? descriptions[index].value.trim() : '';

            if (title) {
                features.push({
                    title: title,
                    description: description
                });
            }
        });

        // Convertir en JSON et mettre à jour le champ caché
        featuresJson.value = JSON.stringify(features);
    }

    // Initialiser les événements de suppression pour les fonctionnalités existantes
    document.querySelectorAll('.remove-feature').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.feature-item').remove();
            updateFeaturesJson();
        });
    });

    // Initialiser les événements de mise à jour pour les fonctionnalités existantes
    document.querySelectorAll('input[name="feature_titles[]"]').forEach(input => {
        input.addEventListener('input', updateFeaturesJson);
    });
    document.querySelectorAll('textarea[name="feature_descriptions[]"]').forEach(textarea => {
        textarea.addEventListener('input', updateFeaturesJson);
    });

    // Événement pour le bouton d'ajout
    addFeatureBtn.addEventListener('click', function() {
        addFeature();
    });

    // Événement de soumission du formulaire
    form.addEventListener('submit', function(e) {
        // S'assurer que le JSON est à jour
        updateFeaturesJson();
    });

    // Mettre à jour le JSON lors du chargement initial
    updateFeaturesJson();
});
</script>

<style>
    .feature-item textarea {
        min-height: 40px;
        resize: vertical;
    }
</style>
@endpush
@endsection
