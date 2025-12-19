@extends('layouts.admin')

@section('title', 'Modifier le service')

@section('page-title', 'Modifier le service')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Formulaire principal -->
        <div class="lg:w-2/3">
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form action="{{ route('admin.services.update', $service) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-8">
                            <!-- Informations de base -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du service</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Nom du service *
                                        </label>
                                        <input type="text" name="name" id="name" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                            value="{{ old('name', $service->name) }}"
                                            placeholder="Ex: Transport aéroport, Visite guidée, Hébergement...">
                                        @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="icon" class="block text-sm font-medium text-gray-700">
                                            Icône FontAwesome
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span
                                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                                <i class="fas fa-icons"></i>
                                            </span>
                                            <input type="text" name="icon" id="icon"
                                                class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md border border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                                value="{{ old('icon', $service->icon) }}" placeholder="fas fa-car">
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Ex: fas fa-car, fas fa-plane, fas fa-hotel
                                        </p>
                                        @error('icon')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="color" class="block text-sm font-medium text-gray-700">
                                            Couleur
                                        </label>
                                        <div class="mt-1 flex items-center space-x-2">
                                            <input type="color" name="color" id="color"
                                                class="h-10 w-10 cursor-pointer rounded border border-gray-300"
                                                value="{{ old('color', $service->color ?: '#667eea') }}">
                                            <input type="text"
                                                class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                                value="{{ old('color', $service->color ?: '#667eea') }}" readonly>
                                        </div>
                                        @error('color')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="description" class="block text-sm font-medium text-gray-700">
                                            Description
                                        </label>
                                        <textarea name="description" id="description" rows="3"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                            placeholder="Décrivez le service en quelques mots...">{{ old('description', $service->description) }}</textarea>
                                        @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tarification -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Tarification</h3>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="price_from" class="block text-sm font-medium text-gray-700">
                                            Prix à partir de (€)
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <span
                                                class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                                €
                                            </span>
                                            <input type="number" name="price_from" id="price_from" step="0.01" min="0"
                                                class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none border border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                                value="{{ old('price_from', $service->price_from) }}"
                                                placeholder="0.00">
                                        </div>
                                        @error('price_from')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="price_unit" class="block text-sm font-medium text-gray-700">
                                            Unité de prix
                                        </label>
                                        <input type="text" name="price_unit" id="price_unit"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                            value="{{ old('price_unit', $service->price_unit) }}"
                                            placeholder="jour, nuit, mois...">
                                        @error('price_unit')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="period" class="block text-sm font-medium text-gray-700">
                                            Période *
                                        </label>
                                        <select name="period" id="period" required
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                            <option value="">Sélectionnez une période</option>
                                            <option value="jour" {{ (old('period', $service->period) == 'jour') ?
                                                'selected' : '' }}>Par jour</option>
                                            <option value="journee" {{ (old('period', $service->period) == 'journee') ?
                                                'selected' : '' }}>Par journée</option>
                                            <option value="nuit" {{ (old('period', $service->period) == 'nuit') ?
                                                'selected' : '' }}>Par nuit</option>
                                            <option value="visite" {{ (old('period', $service->period) == 'visite') ?
                                                'selected' : '' }}>Par visite</option>
                                            <option value="mois" {{ (old('period', $service->period) == 'mois') ?
                                                'selected' : '' }}>Par mois</option>
                                            <option value="trajet" {{ (old('period', $service->period) == 'trajet') ?
                                                'selected' : '' }}>Par trajet</option>
                                            <option value="heure" {{ (old('period', $service->period) == 'heure') ?
                                                'selected' : '' }}>Par heure</option>
                                            <option value="forfait" {{ (old('period', $service->period) == 'forfait') ?
                                                'selected' : '' }}>Forfait unique</option>
                                        </select>
                                        @error('period')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Configuration -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Configuration</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="sort_order" class="block text-sm font-medium text-gray-700">
                                            Ordre d'affichage
                                        </label>
                                        <input type="number" name="sort_order" id="sort_order" min="0"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                            value="{{ old('sort_order', $service->sort_order) }}">
                                        @error('sort_order')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500">0 = premier, plus élevé = plus bas</p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Statut du service
                                        </label>
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center">
                                                <input type="radio" name="is_active" id="is_active_1" value="1" {{
                                                    (old('is_active', $service->is_active) ? 'checked' : '') }}
                                                class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300">
                                                <label for="is_active_1" class="ml-2 block text-sm text-gray-900">
                                                    Actif
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input type="radio" name="is_active" id="is_active_0" value="0" {{
                                                    (!old('is_active', $service->is_active) ? 'checked' : '') }}
                                                class="h-4 w-4 text-gray-300 focus:ring-gray-500 border-gray-300">
                                                <label for="is_active_0" class="ml-2 block text-sm text-gray-900">
                                                    Inactif
                                                </label>
                                            </div>
                                        </div>
                                        @error('is_active')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                        <p class="mt-1 text-xs text-gray-500">Les services inactifs n'apparaissent pas
                                            publiquement</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                            <a href="{{ route('admin.services.index') }}" class="btn-secondary">
                                Annuler
                            </a>
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save mr-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Aperçu -->
        <div class="lg:w-1/3">
            <div class="bg-white shadow rounded-lg sticky top-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Aperçu du service</h3>

                    <!-- Informations actuelles -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>Informations actuelles
                        </h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Nom :</span>
                                <span class="font-medium">{{ $service->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Créé le :</span>
                                <span class="font-medium">{{ $service->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Mis à jour :</span>
                                <span class="font-medium">{{ $service->updated_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Icône et nom -->
                        <div class="text-center">
                            <div id="previewIcon"
                                class="inline-flex items-center justify-center h-20 w-20 rounded-full mb-4"
                                style="background-color: {{ old('color', $service->color ?: '#667eea') }}20; color: {{ old('color', $service->color ?: '#667eea') }}">
                                <i class="{{ $service->icon ?: 'fas fa-cog' }} text-3xl"></i>
                            </div>
                            <h4 id="previewName" class="text-xl font-semibold text-gray-900 mb-2">
                                {{ $service->name }}
                            </h4>
                            <p id="previewDescription" class="text-sm text-gray-600">
                                {{ $service->description ?: 'Description du service...' }}
                            </p>
                        </div>

                        <!-- Tarif -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Tarif à partir de :</span>
                                <span id="previewPrice" class="text-lg font-bold text-djok-yellow">
                                    {{ $service->price_formatted }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Période :</span>
                                <span id="previewPeriod" class="text-sm font-medium text-gray-700">
                                    {{ $service->period_formatted ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <!-- Informations -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Ordre d'affichage :</span>
                                <span id="previewOrder" class="text-sm font-medium text-gray-700">
                                    {{ $service->sort_order }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">Statut :</span>
                                <span id="previewStatus"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    <i class="fas {{ $service->is_active ? 'fa-check-circle' : 'fa-ban' }} mr-1"></i>
                                    {{ $service->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </div>
                        </div>

                        <!-- Attention -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5"></i>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-yellow-800">Attention</h4>
                                    <p class="text-sm text-yellow-700 mt-1">
                                        La modification d'un service affecte immédiatement son affichage public.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Éléments du formulaire
        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const priceInput = document.getElementById('price_from');
        const priceUnitInput = document.getElementById('price_unit');
        const periodSelect = document.getElementById('period');
        const iconInput = document.getElementById('icon');
        const colorInput = document.getElementById('color');
        const orderInput = document.getElementById('sort_order');
        const statusActive = document.getElementById('is_active_1');
        const statusInactive = document.getElementById('is_active_0');

        // Éléments de l'aperçu
        const previewName = document.getElementById('previewName');
        const previewDescription = document.getElementById('previewDescription');
        const previewPrice = document.getElementById('previewPrice');
        const previewPeriod = document.getElementById('previewPeriod');
        const previewIcon = document.getElementById('previewIcon');
        const previewOrder = document.getElementById('previewOrder');
        const previewStatus = document.getElementById('previewStatus');

        // Valeurs originales pour le fallback
        const originalName = "{{ $service->name }}";
        const originalDescription = "{{ $service->description ?: 'Description du service...' }}";
        const originalPrice = "{{ $service->price_formatted }}";
        const originalPeriod = "{{ $service->period_formatted ?: '-' }}";
        const originalColor = "{{ $service->color ?: '#667eea' }}";
        const originalIcon = "{{ $service->icon ?: 'fas fa-cog' }}";
        const originalOrder = "{{ $service->sort_order }}";
        const originalIsActive = {{ $service->is_active ? 'true' : 'false' }};

        // Mise à jour de l'aperçu
        function updatePreview() {
            // Nom
            if (nameInput.value && nameInput.value !== originalName) {
                previewName.textContent = nameInput.value;
            } else if (!nameInput.value) {
                previewName.textContent = originalName;
            }

            // Description
            if (descriptionInput.value && descriptionInput.value !== originalDescription) {
                previewDescription.textContent = descriptionInput.value;
            } else if (!descriptionInput.value) {
                previewDescription.textContent = originalDescription;
            }

            // Prix
            if (priceInput.value) {
                let price = parseFloat(priceInput.value).toFixed(2).replace('.', ',');
                let unit = priceUnitInput.value ? '/' + priceUnitInput.value : '';
                previewPrice.textContent = price + ' €' + unit;
                previewPrice.classList.add('text-djok-yellow');
                previewPrice.classList.remove('text-gray-500');
            } else {
                previewPrice.textContent = originalPrice;
                previewPrice.classList.remove('text-djok-yellow');
                if (originalPrice === 'Sur devis') {
                    previewPrice.classList.add('text-gray-500');
                } else {
                    previewPrice.classList.add('text-djok-yellow');
                }
            }

            // Période
            if (periodSelect.value && periodSelect.value !== "{{ $service->period }}") {
                const periods = {
                    'jour': 'Par jour',
                    'journee': 'Par journée',
                    'nuit': 'Par nuit',
                    'visite': 'Par visite',
                    'mois': 'Par mois',
                    'trajet': 'Par trajet',
                    'heure': 'Par heure',
                    'forfait': 'Forfait unique'
                };
                previewPeriod.textContent = periods[periodSelect.value] || periodSelect.value;
            } else if (!periodSelect.value) {
                previewPeriod.textContent = originalPeriod;
            }

            // Icône
            const iconValue = iconInput.value || originalIcon;
            previewIcon.innerHTML = `<i class="${iconValue} text-3xl"></i>`;

            // Couleur
            const color = colorInput.value || originalColor;
            previewIcon.style.color = color;
            previewIcon.style.backgroundColor = color + '20'; // 20 = 12% opacity

            // Ordre
            previewOrder.textContent = orderInput.value || originalOrder;

            // Statut
            const isActive = statusActive.checked;
            if (isActive) {
                previewStatus.innerHTML = '<i class="fas fa-check-circle mr-1"></i>Actif';
                previewStatus.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800';
            } else {
                previewStatus.innerHTML = '<i class="fas fa-ban mr-1"></i>Inactif';
                previewStatus.className = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800';
            }
        }

        // Écouter les changements
        const inputs = [nameInput, descriptionInput, priceInput, priceUnitInput, periodSelect, iconInput, colorInput, orderInput];
        inputs.forEach(input => {
            input.addEventListener('input', updatePreview);
        });
        periodSelect.addEventListener('change', updatePreview);
        statusActive.addEventListener('change', updatePreview);
        statusInactive.addEventListener('change', updatePreview);

        // Synchroniser le champ couleur
        colorInput.addEventListener('input', function() {
            const colorText = colorInput.nextElementSibling;
            colorText.value = this.value;
            updatePreview();
        });

        // Initialiser l'aperçu
        updatePreview();
    });
</script>
@endpush

@push('styles')
<style>
    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        width: 32px;
        height: 32px;
        cursor: pointer;
    }

    input[type="color"]::-webkit-color-swatch-wrapper {
        padding: 0;
    }

    input[type="color"]::-webkit-color-swatch {
        border: 1px solid #d1d5db;
        border-radius: 4px;
    }

    .sticky {
        position: sticky;
    }
</style>
@endpush
