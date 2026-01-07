@extends('layouts.admin')

@section('title', 'Créer une réservation VTC')

@section('page-title', 'Nouvelle réservation VTC')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">
            Formulaire de création de réservation VTC
        </h3>
        <p class="mt-1 text-sm text-gray-500">
            Créez une nouvelle réservation de transport VTC
        </p>
    </div>

    <form action="{{ route('admin.reservations.store') }}" method="POST" class="p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Type de service VTC -->
            <div>
                <label for="type_service" class="block text-sm font-medium text-gray-700">Type de service *</label>
                <select name="type_service" id="type_service" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Sélectionner un service</option>
                    @foreach($vtcServiceTypes as $key => $label)
                    <option value="{{ $key }}" {{ old('type_service')==$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('type_service')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catégorie de véhicule -->
            <div>
                <label for="vehicle_category_id" class="block text-sm font-medium text-gray-700">Type de véhicule
                    *</label>
                <select name="vehicle_category_id" id="vehicle_category_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Choisir un véhicule</option>
                    @foreach($vehicleCategories as $category)
                    <option value="{{ $category->id }}" {{ old('vehicle_category_id')==$category->id ? 'selected' : ''
                        }}>
                        {{ $category->display_name }}
                    </option>
                    @endforeach
                </select>
                @error('vehicle_category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lieu de départ -->
            <div>
                <label for="depart" class="block text-sm font-medium text-gray-700">Lieu de départ *</label>
                <input type="text" name="depart" id="depart" required value="{{ old('depart') }}"
                    placeholder="Ex: 123 Avenue des Champs-Élysées, Paris"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('depart')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lieu d'arrivée -->
            <div>
                <label for="arrivee" class="block text-sm font-medium text-gray-700">Lieu d'arrivée *</label>
                <input type="text" name="arrivee" id="arrivee" required value="{{ old('arrivee') }}"
                    placeholder="Ex: Aéroport Charles de Gaulle, Paris"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('arrivee')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date *</label>
                <input type="date" name="date" id="date" required value="{{ old('date') }}" min="{{ date('Y-m-d') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Heure -->
            <div>
                <label for="heure" class="block text-sm font-medium text-gray-700">Heure *</label>
                <input type="time" name="heure" id="heure" required value="{{ old('heure') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('heure')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre de passagers -->
            <div>
                <label for="passagers" class="block text-sm font-medium text-gray-700">Nombre de passagers *</label>
                <select name="passagers" id="passagers" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Nombre de personnes</option>
                    @for($i = 1; $i <= 8; $i++) <option value="{{ $i }}" {{ old('passagers')==$i ? 'selected' : '' }}>{{
                        $i }} personne{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                </select>
                @error('passagers')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Statut -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Statut *</label>
                <select name="status" id="status" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    @foreach($statuses as $key => $label)
                    <option value="{{ $key }}" {{ old('status')==$key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Informations client -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom complet *</label>
                <input type="text" name="nom" id="nom" required value="{{ old('nom') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('nom')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone *</label>
                <input type="tel" name="telephone" id="telephone" required value="{{ old('telephone') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('telephone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Montants -->
            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Montant total (€) *</label>
                <input type="number" step="0.01" name="total_amount" id="total_amount" required
                    value="{{ old('total_amount') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('total_amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deposit_amount" class="block text-sm font-medium text-gray-700">Acompte (€)</label>
                <input type="number" step="0.01" name="deposit_amount" id="deposit_amount"
                    value="{{ old('deposit_amount', 0) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('deposit_amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Instructions -->
        <div class="mt-6">
            <label for="instructions" class="block text-sm font-medium text-gray-700">Instructions
                supplémentaires</label>
            <textarea name="instructions" id="instructions" rows="3"
                placeholder="Informations spécifiques pour le chauffeur..."
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">{{ old('instructions') }}</textarea>
            @error('instructions')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Boutons -->
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('admin.reservations.index') }}"
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                Annuler
            </a>
            <button type="submit"
                class="px-4 py-2 bg-djok-yellow text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                Créer la réservation
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la date
        const dateInput = document.getElementById('date');
        if (dateInput) {
            dateInput.min = new Date().toISOString().split('T')[0];
        }

        // Validation des montants
        const depositInput = document.getElementById('deposit_amount');
        const totalInput = document.getElementById('total_amount');

        if (depositInput && totalInput) {
            depositInput.addEventListener('input', function() {
                if (parseFloat(this.value) > parseFloat(totalInput.value)) {
                    this.value = totalInput.value;
                }
            });
        }

        // Gestion de la date de fin (même que date de début pour VTC)
        const dateField = document.getElementById('date');
        if (dateField) {
            dateField.addEventListener('change', function() {
                // Pour VTC, start_date et end_date sont identiques
            });
        }
    });
</script>
@endsection
