@extends('layouts.admin')

@section('title', 'Créer une inscription')

@section('page-title', 'Nouvelle inscription')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">
            Formulaire de création d'inscription
        </h3>
    </div>

    <form action="{{ route('admin.inscriptions.store') }}" method="POST" class="p-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Utilisateur -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Étudiant *</label>
                <select name="user_id" id="user_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Sélectionner un étudiant</option>
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

            <!-- Formation -->
            <div>
                <label for="formation_id" class="block text-sm font-medium text-gray-700">Formation *</label>
                <select name="formation_id" id="formation_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Sélectionner une formation</option>
                    @foreach($formations as $formation)
                    <option value="{{ $formation->id }}" {{ old('formation_id')==$formation->id ? 'selected' : '' }}>
                        {{ $formation->title }} - {{ $formation->type }} ({{ number_format($formation->price, 2) }}€)
                    </option>
                    @endforeach
                </select>
                @error('formation_id')
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

            <!-- Méthode de paiement -->
            <div>
                <label for="payment_method" class="block text-sm font-medium text-gray-700">Méthode de paiement</label>
                <select name="payment_method" id="payment_method"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    <option value="">Non spécifié</option>
                    @foreach($paymentMethods as $key => $label)
                    <option value="{{ $key }}" {{ old('payment_method')==$key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                @error('payment_method')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dates -->
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Date de début</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('start_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('end_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Montant payé -->
            <div>
                <label for="amount_paid" class="block text-sm font-medium text-gray-700">Montant payé (€) *</label>
                <input type="number" step="0.01" name="amount_paid" id="amount_paid" required
                    value="{{ old('amount_paid', 0) }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('amount_paid')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Notes -->
        <div class="mt-6">
            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
            <textarea name="notes" id="notes" rows="3"
                placeholder="Informations supplémentaires, modalités spéciales, etc."
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">{{ old('notes') }}</textarea>
            @error('notes')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Boutons -->
        <div class="mt-8 flex justify-end space-x-3">
            <a href="{{ route('admin.inscriptions.index') }}"
                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                Annuler
            </a>
            <button type="submit"
                class="px-4 py-2 bg-djok-yellow text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                Créer l'inscription
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Gestion des dates
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    startDateInput.addEventListener('change', function() {
        if (this.value) {
            endDateInput.min = this.value;
        }
    });

    // Auto-remplissage du prix de la formation
    const formationSelect = document.getElementById('formation_id');
    const amountPaidInput = document.getElementById('amount_paid');

    formationSelect.addEventListener('change', function() {
        if (this.value) {
            // Vous pouvez ajouter ici une requête AJAX pour récupérer le prix
            // Pour l'instant, on suppose que le prix est dans l'attribut data-price
            const selectedOption = this.options[this.selectedIndex];
            const priceText = selectedOption.textContent;
            const priceMatch = priceText.match(/\(([\d.,]+)€\)/);

            if (priceMatch) {
                const price = parseFloat(priceMatch[1].replace(',', '.'));
                if (!isNaN(price)) {
                    amountPaidInput.value = price;
                }
            }
        }
    });
});
</script>
@endsection
