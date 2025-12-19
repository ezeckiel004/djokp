@extends('layouts.admin')

@section('title', 'Créer une réservation')

@section('page-title', 'Nouvelle réservation')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">
            Formulaire de création de réservation
        </h3>
    </div>

    <form action="{{ route('admin.reservations.store') }}" method="POST" class="p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Client -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Client *</label>
                <select name="user_id" id="user_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Sélectionner un client</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id')==$user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
                @error('user_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type de réservation -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700">Type de service *</label>
                <select name="type" id="type" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    @foreach($types as $key => $label)
                    <option value="{{ $key }}" {{ old('type')==$key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Véhicule (conditionnel) -->
            <div id="vehicle-field">
                <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Véhicule *</label>
                <select name="vehicle_id" id="vehicle_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Sélectionner un véhicule</option>
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id')==$vehicle->id ? 'selected' : '' }}>
                        {{ $vehicle->brand }} {{ $vehicle->model }}
                        ({{ $vehicle->registration }}) - {{ ucfirst($vehicle->category) }}
                    </option>
                    @endforeach
                </select>
                @error('vehicle_id')
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

            <!-- Dates -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début *</label>
                <input type="date" name="start_date" id="start_date" required value="{{ old('start_date') }}"
                    min="{{ date('Y-m-d') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('start_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin *</label>
                <input type="date" name="end_date" id="end_date" required value="{{ old('end_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('end_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Heure de prise en charge -->
            <div>
                <label for="pickup_time" class="block text-sm font-medium text-gray-700">Heure de prise en
                    charge</label>
                <input type="time" name="pickup_time" id="pickup_time" value="{{ old('pickup_time') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('pickup_time')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre de passagers -->
            <div>
                <label for="passengers" class="block text-sm font-medium text-gray-700">Nombre de passagers</label>
                <input type="number" name="passengers" id="passengers" min="1" max="20"
                    value="{{ old('passengers', 1) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('passengers')
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

            <!-- Lieux -->
            <div>
                <label for="pickup_location" class="block text-sm font-medium text-gray-700">Lieu de prise en
                    charge</label>
                <input type="text" name="pickup_location" id="pickup_location" value="{{ old('pickup_location') }}"
                    placeholder="Adresse complète"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('pickup_location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dropoff_location" class="block text-sm font-medium text-gray-700">Lieu de
                    restitution/dépose</label>
                <input type="text" name="dropoff_location" id="dropoff_location" value="{{ old('dropoff_location') }}"
                    placeholder="Adresse complète"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('dropoff_location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Demandes spéciales -->
        <div class="mt-6">
            <label for="special_requests" class="block text-sm font-medium text-gray-700">Demandes spéciales</label>
            <textarea name="special_requests" id="special_requests" rows="3"
                placeholder="Informations supplémentaires, préférences, etc."
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">{{ old('special_requests') }}</textarea>
            @error('special_requests')
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
    const typeSelect = document.getElementById('type');
    const vehicleField = document.getElementById('vehicle-field');
    const vehicleSelect = document.getElementById('vehicle_id');

    function toggleVehicleField() {
        if (typeSelect.value === 'location') {
            vehicleField.style.display = 'block';
            vehicleSelect.required = true;
        } else {
            vehicleField.style.display = 'block'; // Toujours affiché mais optionnel
            vehicleSelect.required = false;
        }
    }

    // Initial state
    toggleVehicleField();

    // Listen for changes
    typeSelect.addEventListener('change', toggleVehicleField);

    // Gestion de la date de fin
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    startDateInput.addEventListener('change', function() {
        endDateInput.min = this.value;
        if (endDateInput.value && endDateInput.value < this.value) {
            endDateInput.value = this.value;
        }
    });

    // Validation des montants
    const totalAmountInput = document.getElementById('total_amount');
    const depositAmountInput = document.getElementById('deposit_amount');

    depositAmountInput.addEventListener('input', function() {
        if (parseFloat(this.value) > parseFloat(totalAmountInput.value)) {
            this.value = totalAmountInput.value;
        }
    });
});
</script>
@endsection
