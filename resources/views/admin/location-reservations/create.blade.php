@extends('layouts.admin')

@section('title', 'Nouvelle Réservation Location')

@section('page-actions')
<a href="{{ route('admin.location-reservations.index') }}" class="btn-secondary">
    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
</a>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Nouvelle réservation de location</h2>

            <form action="{{ route('admin.location-reservations.store') }}" method="POST" id="reservationForm">
                @csrf

                <div class="space-y-8">
                    <!-- Informations client -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations client</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom complet *
                                </label>
                                <input type="text" name="nom" id="nom" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('nom') }}">
                                @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email *
                                </label>
                                <input type="email" name="email" id="email" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('email') }}">
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="telephone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone *
                                </label>
                                <input type="tel" name="telephone" id="telephone" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('telephone') }}">
                                @error('telephone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Sélection véhicule -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Sélection du véhicule</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Véhicule *
                                </label>
                                <select name="vehicle_id" id="vehicle_id" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                    <option value="">Sélectionnez un véhicule</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id')==$vehicle->id ? 'selected' :
                                        '' }}
                                        data-daily-rate="{{ $vehicle->daily_rate }}"
                                        data-weekly-rate="{{ $vehicle->weekly_rate }}"
                                        data-monthly-rate="{{ $vehicle->monthly_rate }}">
                                        {{ $vehicle->full_name }} - {{ $vehicle->registration }}
                                        ({{ $vehicle->category_fr }} - {{ $vehicle->daily_rate_formatted }}/jour)
                                    </option>
                                    @endforeach
                                </select>
                                @error('vehicle_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="vehicle_info" class="hidden">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-medium text-gray-900 mb-2">Informations du véhicule</h4>
                                    <div class="space-y-2">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tarif journalier:</span>
                                            <span id="daily_rate_display" class="font-medium"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tarif hebdomadaire:</span>
                                            <span id="weekly_rate_display" class="font-medium"></span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">Tarif mensuel:</span>
                                            <span id="monthly_rate_display" class="font-medium"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Période de location -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Période de location</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de début *
                                </label>
                                <input type="date" name="date_debut" id="date_debut" required min="{{ date('Y-m-d') }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('date_debut') }}">
                                @error('date_debut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de fin *
                                </label>
                                <input type="date" name="date_fin" id="date_fin" required
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('date_fin') }}">
                                @error('date_fin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div id="periode_info" class="mt-4 hidden">
                            <div class="bg-blue-50 p-4 rounded-lg">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium text-blue-900">Informations de la période</h4>
                                        <p id="duree_info" class="text-sm text-blue-700"></p>
                                    </div>
                                    <div id="montant_info" class="text-right">
                                        <p class="text-2xl font-bold text-blue-900" id="montant_total"></p>
                                        <p class="text-sm text-blue-700" id="tarif_type"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Montant et statut -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Configuration</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="montant_total" class="block text-sm font-medium text-gray-700 mb-2">
                                    Montant total *
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" name="montant_total" id="montant_total" required
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                        value="{{ old('montant_total') }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                </div>
                                @error('montant_total')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Montant TTC pour la période sélectionnée</p>
                            </div>

                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                                    Statut *
                                </label>
                                <select name="statut" id="statut" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                    <option value="en_attente" {{ old('statut', 'en_attente' )=='en_attente'
                                        ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmee" {{ old('statut')=='confirmee' ? 'selected' : '' }}>
                                        Confirmée</option>
                                    <option value="en_cours" {{ old('statut')=='en_cours' ? 'selected' : '' }}>En cours
                                    </option>
                                </select>
                                @error('statut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes (optionnel)
                        </label>
                        <textarea name="notes" id="notes" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            placeholder="Notes internes concernant cette réservation...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.location-reservations.index') }}" class="btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>Créer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const vehicleSelect = document.getElementById('vehicle_id');
    const dateDebutInput = document.getElementById('date_debut');
    const dateFinInput = document.getElementById('date_fin');
    const montantTotalInput = document.getElementById('montant_total');
    const vehicleInfoDiv = document.getElementById('vehicle_info');
    const periodeInfoDiv = document.getElementById('periode_info');

    function updateVehicleInfo() {
        const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
        if (selectedOption.value) {
            const dailyRate = selectedOption.dataset.dailyRate;
            const weeklyRate = selectedOption.dataset.weeklyRate;
            const monthlyRate = selectedOption.dataset.monthlyRate;

            document.getElementById('daily_rate_display').textContent = parseFloat(dailyRate).toFixed(2) + ' €';
            document.getElementById('weekly_rate_display').textContent = parseFloat(weeklyRate).toFixed(2) + ' €';
            document.getElementById('monthly_rate_display').textContent = parseFloat(monthlyRate).toFixed(2) + ' €';

            vehicleInfoDiv.classList.remove('hidden');
        } else {
            vehicleInfoDiv.classList.add('hidden');
        }
    }

    function calculateMontant() {
        if (!vehicleSelect.value || !dateDebutInput.value || !dateFinInput.value) {
            periodeInfoDiv.classList.add('hidden');
            return;
        }

        const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
        const dailyRate = parseFloat(selectedOption.dataset.dailyRate);
        const weeklyRate = parseFloat(selectedOption.dataset.weeklyRate);
        const monthlyRate = parseFloat(selectedOption.dataset.monthlyRate);

        const dateDebut = new Date(dateDebutInput.value);
        const dateFin = new Date(dateFinInput.value);

        if (dateFin <= dateDebut) {
            periodeInfoDiv.classList.add('hidden');
            return;
        }

        // Calculer la durée en jours
        const diffTime = Math.abs(dateFin - dateDebut);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        // Calculer le montant
        let montantTotal;
        let tarifType;

        if (diffDays <= 7) {
            // Tarif journalier
            montantTotal = diffDays * dailyRate;
            tarifType = `Tarif journalier (${dailyRate.toFixed(2)} €/jour)`;
        } else if (diffDays <= 30) {
            // Tarif hebdomadaire
            const semaines = Math.ceil(diffDays / 7);
            montantTotal = semaines * weeklyRate;
            tarifType = `Tarif hebdomadaire (${weeklyRate.toFixed(2)} €/semaine)`;
        } else {
            // Tarif mensuel
            const mois = Math.ceil(diffDays / 30);
            montantTotal = mois * monthlyRate;
            tarifType = `Tarif mensuel (${monthlyRate.toFixed(2)} €/mois)`;
        }

        // Mettre à jour l'affichage
        document.getElementById('duree_info').textContent = `${diffDays} jours`;
        document.getElementById('montant_total').textContent = montantTotal.toFixed(2) + ' €';
        document.getElementById('tarif_type').textContent = tarifType;

        // Mettre à jour le champ montant total
        montantTotalInput.value = montantTotal.toFixed(2);

        // Afficher les informations
        periodeInfoDiv.classList.remove('hidden');
    }

    // Événements
    vehicleSelect.addEventListener('change', function() {
        updateVehicleInfo();
        calculateMontant();
    });

    dateDebutInput.addEventListener('change', function() {
        const minDate = new Date(this.value);
        minDate.setDate(minDate.getDate() + 1);
        dateFinInput.min = minDate.toISOString().split('T')[0];
        calculateMontant();
    });

    dateFinInput.addEventListener('change', calculateMontant);

    // Initialiser
    updateVehicleInfo();
});
</script>
@endpush
