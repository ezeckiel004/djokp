@extends('layouts.admin')

@section('title', 'Éditer Réservation ' . $locationReservation->reference)

@section('page-actions')
<div class="flex space-x-3">
    <a href="{{ route('admin.location-reservations.show', $locationReservation) }}" class="btn-secondary">
        <i class="fas fa-eye mr-2"></i> Voir
    </a>
    <a href="{{ route('admin.location-reservations.index') }}" class="btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i> Retour
    </a>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Éditer la réservation {{ $locationReservation->reference
                }}</h2>

            <form action="{{ route('admin.location-reservations.update', $locationReservation) }}" method="POST">
                @csrf
                @method('PUT')

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
                                    value="{{ old('nom', $locationReservation->nom) }}">
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
                                    value="{{ old('email', $locationReservation->email) }}">
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
                                    value="{{ old('telephone', $locationReservation->telephone) }}">
                                @error('telephone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Véhicule -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Véhicule</h3>
                        <div>
                            <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Véhicule *
                            </label>
                            <select name="vehicle_id" id="vehicle_id" required
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                <option value="">Sélectionnez un véhicule</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $locationReservation->
                                    vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->full_name }} - {{ $vehicle->registration }}
                                    ({{ $vehicle->category_fr }} - {{ $vehicle->daily_rate_formatted }}/jour)
                                    {{ $vehicle->id == $locationReservation->vehicle_id ? '(actuel)' : '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('vehicle_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($locationReservation->vehicle)
                            <div class="mt-4 bg-blue-50 p-4 rounded-lg">
                                <h4 class="font-medium text-blue-900 mb-2">Véhicule actuel</h4>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-lg object-cover"
                                            src="{{ $locationReservation->vehicle->image_url }}"
                                            alt="{{ $locationReservation->vehicle->full_name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $locationReservation->vehicle->full_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $locationReservation->vehicle->registration }} •
                                            {{ $locationReservation->vehicle->category_fr }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
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
                                <input type="date" name="date_debut" id="date_debut" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('date_debut', $locationReservation->date_debut->format('Y-m-d')) }}">
                                @error('date_debut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de fin *
                                </label>
                                <input type="date" name="date_fin" id="date_fin" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                                    value="{{ old('date_fin', $locationReservation->date_fin->format('Y-m-d')) }}">
                                @error('date_fin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4 bg-gray-50 p-4 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="font-medium text-gray-900">Période actuelle</h4>
                                    <p class="text-sm text-gray-600">
                                        {{ $locationReservation->date_debut->format('d/m/Y') }} → {{
                                        $locationReservation->date_fin->format('d/m/Y') }}
                                        ({{ $locationReservation->duree_jours }} jours)
                                    </p>
                                </div>
                                @if($locationReservation->estEnCours())
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                    <i class="fas fa-play mr-1"></i> En cours
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Configuration -->
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
                                        value="{{ old('montant_total', $locationReservation->montant_total) }}">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                </div>
                                @error('montant_total')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                                    Statut *
                                </label>
                                <select name="statut" id="statut" required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                                    <option value="en_attente" {{ old('statut', $locationReservation->statut) ==
                                        'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmee" {{ old('statut', $locationReservation->statut) ==
                                        'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="en_cours" {{ old('statut', $locationReservation->statut) ==
                                        'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="terminee" {{ old('statut', $locationReservation->statut) ==
                                        'terminee' ? 'selected' : '' }}>Terminée</option>
                                    <option value="annulee" {{ old('statut', $locationReservation->statut) == 'annulee'
                                        ? 'selected' : '' }}>Annulée</option>
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
                            Notes
                        </label>
                        <textarea name="notes" id="notes" rows="4"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm"
                            placeholder="Notes concernant cette réservation...">{{ old('notes', $locationReservation->notes) }}</textarea>
                        @error('notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Boutons -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.location-reservations.show', $locationReservation) }}"
                        class="btn-secondary">
                        Annuler
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
