@extends('layouts.admin')

@section('title', 'Éditer ' . $vehicle->brand . ' ' . $vehicle->model)

@section('page-title', 'Éditer le véhicule')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Informations générales -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations générales</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="registration" class="block text-sm font-medium text-gray-700">
                                    Immatriculation *
                                </label>
                                <input type="text" name="registration" id="registration" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('registration', $vehicle->registration) }}">
                                @error('registration')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="brand" class="block text-sm font-medium text-gray-700">
                                    Marque *
                                </label>
                                <input type="text" name="brand" id="brand" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('brand', $vehicle->brand) }}">
                                @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="model" class="block text-sm font-medium text-gray-700">
                                    Modèle *
                                </label>
                                <input type="text" name="model" id="model" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('model', $vehicle->model) }}">
                                @error('model')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="year" class="block text-sm font-medium text-gray-700">
                                    Année *
                                </label>
                                <input type="number" name="year" id="year" required min="2000" max="{{ date('Y') + 1 }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('year', $vehicle->year) }}">
                                @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700">
                                    Couleur *
                                </label>
                                <input type="text" name="color" id="color" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('color', $vehicle->color) }}">
                                @error('color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="seats" class="block text-sm font-medium text-gray-700">
                                    Nombre de places *
                                </label>
                                <input type="number" name="seats" id="seats" required min="1" max="20"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('seats', $vehicle->seats) }}">
                                @error('seats')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image du véhicule -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Image du véhicule</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Photo actuelle
                            </label>
                            <div class="flex items-center">
                                <div class="w-48 h-32 bg-gray-100 rounded-lg overflow-hidden border border-gray-300">
                                    @if($vehicle->image_url)
                                    <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->full_name }}"
                                        class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <div class="text-center">
                                            <i class="fas fa-car text-gray-400 text-3xl mb-2"></i>
                                            <p class="text-xs text-gray-500">Image par défaut</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-4 flex-1">
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nouvelle image
                                    </label>
                                    <input type="file" name="image" id="image"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-djok-yellow file:text-white hover:file:bg-yellow-700"
                                        accept="image/jpeg,image/png,image/gif,image/webp">
                                    <p class="text-xs text-gray-500 mt-2">
                                        Formats acceptés : JPEG, PNG, GIF, WEBP (max 2MB)
                                    </p>

                                    @if($vehicle->image)
                                    <div class="mt-3 flex items-center">
                                        <input type="checkbox" name="remove_image" id="remove_image" value="1"
                                            class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                        <label for="remove_image" class="ml-2 text-sm text-gray-700">
                                            Supprimer l'image actuelle
                                        </label>
                                    </div>
                                    @endif

                                    @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catégorisation -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Catégorisation</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="vehicle_category_id" class="block text-sm font-medium text-gray-700">
                                    Catégorie *
                                </label>
                                <select name="vehicle_category_id" id="vehicle_category_id" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('vehicle_category_id', $vehicle->
                                        vehicle_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->display_name }} ({{ $category->categorie }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('vehicle_category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="fuel_type" class="block text-sm font-medium text-gray-700">
                                    Type de carburant *
                                </label>
                                <select name="fuel_type" id="fuel_type" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                    <option value="essence" {{ old('fuel_type', $vehicle->fuel_type) == 'essence' ?
                                        'selected' : '' }}>Essence</option>
                                    <option value="diesel" {{ old('fuel_type', $vehicle->fuel_type) == 'diesel' ?
                                        'selected' : '' }}>Diesel</option>
                                    <option value="hybrid" {{ old('fuel_type', $vehicle->fuel_type) == 'hybrid' ?
                                        'selected' : '' }}>Hybride</option>
                                    <option value="electric" {{ old('fuel_type', $vehicle->fuel_type) == 'electric' ?
                                        'selected' : '' }}>Électrique</option>
                                </select>
                                @error('fuel_type')
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
                                <label for="daily_rate" class="block text-sm font-medium text-gray-700">
                                    Tarif journalier (€) *
                                </label>
                                <input type="number" step="0.01" name="daily_rate" id="daily_rate" required min="0"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('daily_rate', $vehicle->daily_rate) }}">
                                @error('daily_rate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="weekly_rate" class="block text-sm font-medium text-gray-700">
                                    Tarif hebdomadaire (€) *
                                </label>
                                <input type="number" step="0.01" name="weekly_rate" id="weekly_rate" required min="0"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('weekly_rate', $vehicle->weekly_rate) }}">
                                @error('weekly_rate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="monthly_rate" class="block text-sm font-medium text-gray-700">
                                    Tarif mensuel (€) *
                                </label>
                                <input type="number" step="0.01" name="monthly_rate" id="monthly_rate" required min="0"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('monthly_rate', $vehicle->monthly_rate) }}">
                                @error('monthly_rate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Équipements -->
                    <div>
                        <label for="features" class="block text-sm font-medium text-gray-700">
                            Équipements (une ligne par équipement)
                        </label>
                        <textarea name="features" id="features" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            placeholder="Ex: Climatisation automatique&#10;Système audio premium&#10;Caméra de recul">{{ old('features', $vehicle->features ? implode("\n", $vehicle->features) : '') }}</textarea>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">{{ old('description', $vehicle->description) }}</textarea>
                    </div>

                    <!-- Statut -->
                    <div>
                        <div class="flex items-center">
                            <input type="checkbox" name="is_available" id="is_available" value="1" {{
                                old('is_available', $vehicle->is_available) ? 'checked' : '' }}
                            class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300 rounded">
                            <label for="is_available" class="ml-2 block text-sm text-gray-900">
                                Véhicule disponible
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <a href="{{ route('admin.vehicles.index') }}" class="btn-secondary">
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

@push('scripts')
<script>
    // Aperçu de la nouvelle image
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            const previewDiv = document.querySelector('.w-48.h-32');

            reader.onload = function(e) {
                previewDiv.innerHTML = `
                    <img src="${e.target.result}" alt="Nouvelle image"
                         class="w-full h-full object-cover">
                `;
            }
            reader.readAsDataURL(file);
        }
    });

    // Réinitialiser l'aperçu si on coche "supprimer l'image"
    document.getElementById('remove_image').addEventListener('change', function() {
        if (this.checked) {
            const previewDiv = document.querySelector('.w-48.h-32');
            previewDiv.innerHTML = `
                <div class="w-full h-full flex items-center justify-center">
                    <div class="text-center">
                        <i class="fas fa-car text-gray-400 text-3xl mb-2"></i>
                        <p class="text-xs text-gray-500">Image sera supprimée</p>
                    </div>
                </div>
            `;
        }
    });
</script>
@endpush
@endsection
