@extends('layouts.admin')

@section('title', 'Modifier l\'inscription #' . $inscription->id)

@section('page-title', 'Modifier l\'inscription')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Modification de l'inscription #{{ $inscription->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Étudiant: {{ $inscription->user->name }} |
                    Formation: {{ $inscription->formation->title }}
                </p>
            </div>
            <span
                class="badge {{ $inscription->status == 'pending' ? 'badge-warning' : ($inscription->status == 'confirmed' ? 'badge-info' : ($inscription->status == 'in_progress' ? 'badge-primary' : ($inscription->status == 'completed' ? 'badge-success' : 'badge-danger'))) }}">
                {{ $statuses[$inscription->status] }}
            </span>
        </div>
    </div>

    <form action="{{ route('admin.inscriptions.update', $inscription) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Utilisateur -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Étudiant *</label>
                <select name="user_id" id="user_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $inscription->user_id == $user->id ? 'selected' : '' }}>
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
                    @foreach($formations as $formation)
                    <option value="{{ $formation->id }}" {{ $inscription->formation_id == $formation->id ? 'selected' :
                        '' }}>
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
                    <option value="{{ $key }}" {{ $inscription->status == $key ? 'selected' : '' }}>
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
                    <option value="{{ $key }}" {{ $inscription->payment_method == $key ? 'selected' : '' }}>
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
                <input type="date" name="start_date" id="start_date"
                    value="{{ old('start_date', $inscription->start_date ? $inscription->start_date->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('start_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" name="end_date" id="end_date"
                    value="{{ old('end_date', $inscription->end_date ? $inscription->end_date->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                @error('end_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Montant payé -->
            <div>
                <label for="amount_paid" class="block text-sm font-medium text-gray-700">Montant payé (€) *</label>
                <input type="number" step="0.01" name="amount_paid" id="amount_paid" required
                    value="{{ old('amount_paid', $inscription->amount_paid) }}"
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
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">{{ old('notes', $inscription->notes) }}</textarea>
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
                Mettre à jour
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
});
</script>
@endsection
