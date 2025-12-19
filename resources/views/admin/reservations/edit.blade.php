@extends('layouts.admin')

@section('title', 'Modifier la réservation #' . $reservation->id)

@section('page-title', 'Modifier la réservation')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Modification de la réservation #{{ $reservation->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Client: {{ $reservation->user->name }} |
                    Type: {{ $types[$reservation->type] }}
                </p>
            </div>
            <span
                class="badge {{ $reservation->status == 'pending' ? 'badge-warning' : ($reservation->status == 'confirmed' ? 'badge-info' : ($reservation->status == 'in_progress' ? 'badge-primary' : ($reservation->status == 'completed' ? 'badge-success' : 'badge-danger'))) }}">
                {{ $reservation->status == 'pending' ? 'En attente' : ($reservation->status == 'confirmed' ? 'Confirmé'
                : ($reservation->status == 'in_progress' ? 'En cours' : ($reservation->status == 'completed' ? 'Terminé'
                : 'Annulé'))) }}
            </span>
        </div>
    </div>

    <form action="{{ route('admin.reservations.update', $reservation) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Client -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Client *</label>
                <select name="user_id" id="user_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $reservation->user_id == $user->id ? 'selected' : '' }}>
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
                    <option value="{{ $key }}" {{ $reservation->type == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Véhicule -->
            <div id="vehicle-field">
                <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Véhicule</label>
                <select name="vehicle_id" id="vehicle_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Sélectionner un véhicule</option>
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}" {{ $reservation->vehicle_id == $vehicle->id ? 'selected' : '' }}
                        {{ !$vehicle->is_available && $reservation->vehicle_id != $vehicle->id ? 'disabled' : '' }}>
                        {{ $vehicle->brand }} {{ $vehicle->model }}
                        ({{ $vehicle->registration }}) - {{ ucfirst($vehicle->category) }}
                        {{ !$vehicle->is_available && $reservation->vehicle_id != $vehicle->id ? ' - Non disponible' :
                        '' }}
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
                    <option value="{{ $key }}" {{ $reservation->status == $key ? 'selected' : '' }}>
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
                <input type="date" name="start_date" id="start_date" required
                    value="{{ old('start_date', $reservation->start_date->format('Y-m-d')) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('start_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin *</label>
                <input type="date" name="end_date" id="end_date" required
                    value="{{ old('end_date', $reservation->end_date->format('Y-m-d')) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('end_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Heure de prise en charge -->
            <div>
                <label for="pickup_time" class="block text-sm font-medium text-gray-700">Heure de prise en
                    charge</label>
                <input type="time" name="pickup_time" id="pickup_time"
                    value="{{ old('pickup_time', $reservation->pickup_time ? $reservation->pickup_time->format('H:i') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('pickup_time')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre de passagers -->
            <div>
                <label for="passengers" class="block text-sm font-medium text-gray-700">Nombre de passagers</label>
                <input type="number" name="passengers" id="passengers" min="1" max="20"
                    value="{{ old('passengers', $reservation->passengers) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('passengers')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Montants -->
            <div>
                <label for="total_amount" class="block text-sm font-medium text-gray-700">Montant total (€) *</label>
                <input type="number" step="0.01" name="total_amount" id="total_amount" required
                    value="{{ old('total_amount', $reservation->total_amount) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('total_amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deposit_amount" class="block text-sm font-medium text-gray-700">Acompte (€)</label>
                <input type="number" step="0.01" name="deposit_amount" id="deposit_amount"
                    value="{{ old('deposit_amount', $reservation->deposit_amount) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('deposit_amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lieux -->
            <div>
                <label for="pickup_location" class="block text-sm font-medium text-gray-700">Lieu de prise en
                    charge</label>
                <input type="text" name="pickup_location" id="pickup_location"
                    value="{{ old('pickup_location', $reservation->pickup_location) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('pickup_location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dropoff_location" class="block text-sm font-medium text-gray-700">Lieu de
                    restitution/dépose</label>
                <input type="text" name="dropoff_location" id="dropoff_location"
                    value="{{ old('dropoff_location', $reservation->dropoff_location) }}"
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
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">{{ old('special_requests', $reservation->special_requests) }}</textarea>
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
                Mettre à jour
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
    });
});
</script>
@endsection
