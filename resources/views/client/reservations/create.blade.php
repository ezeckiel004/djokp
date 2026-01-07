{{-- resources/views/client/reservations/create.blade.php --}}

@extends('layouts.client')

@section('title', 'Nouvelle réservation VTC')
@section('page-title', 'Nouvelle réservation VTC')
@section('page-description', 'Réservez votre chauffeur privé')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.reservations.index') }}" class="text-gray-700 hover:text-djok-yellow">
            Réservations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Nouvelle</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Nouvelle réservation VTC</h3>
            <p class="mt-1 text-sm text-gray-500">Remplissez le formulaire ci-dessous pour réserver votre chauffeur</p>
        </div>

        <form action="{{ route('client.reservations.store') }}" method="POST">
            @csrf
            <div class="px-4 py-5 sm:p-6 space-y-6">
                <!-- Type de service -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de service</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input type="radio" name="type_service" id="transfert" value="transfert"
                                class="sr-only peer" checked>
                            <label for="transfert"
                                class="flex flex-col p-4 border rounded-lg cursor-pointer peer-checked:border-djok-yellow peer-checked:ring-2 peer-checked:ring-djok-yellow">
                                <div class="flex items-center">
                                    <i class="fas fa-plane-arrival text-djok-yellow text-xl mr-3"></i>
                                    <span class="font-medium">Transfert</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Aéroport, Gare, Hôtel</p>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="type_service" id="professionnel" value="professionnel"
                                class="sr-only peer">
                            <label for="professionnel"
                                class="flex flex-col p-4 border rounded-lg cursor-pointer peer-checked:border-djok-yellow peer-checked:ring-2 peer-checked:ring-djok-yellow">
                                <div class="flex items-center">
                                    <i class="fas fa-briefcase text-blue-600 text-xl mr-3"></i>
                                    <span class="font-medium">Professionnel</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Réunions, rendez-vous</p>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="type_service" id="evenement" value="evenement"
                                class="sr-only peer">
                            <label for="evenement"
                                class="flex flex-col p-4 border rounded-lg cursor-pointer peer-checked:border-djok-yellow peer-checked:ring-2 peer-checked:ring-djok-yellow">
                                <div class="flex items-center">
                                    <i class="fas fa-glass-cheers text-purple-600 text-xl mr-3"></i>
                                    <span class="font-medium">Événement</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Mariage, soirée, festivité</p>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="type_service" id="mise_disposition" value="mise_disposition"
                                class="sr-only peer">
                            <label for="mise_disposition"
                                class="flex flex-col p-4 border rounded-lg cursor-pointer peer-checked:border-djok-yellow peer-checked:ring-2 peer-checked:ring-djok-yellow">
                                <div class="flex items-center">
                                    <i class="fas fa-car text-green-600 text-xl mr-3"></i>
                                    <span class="font-medium">Mise à disposition</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">À la journée ou demi-journée</p>
                            </label>
                        </div>
                    </div>
                    @error('type_service')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Trajet -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="depart" class="block text-sm font-medium text-gray-700 mb-2">
                            Lieu de départ *
                        </label>
                        <input type="text" name="depart" id="depart" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow"
                            placeholder="Adresse, aéroport, hôtel...">
                        @error('depart')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="arrivee" class="block text-sm font-medium text-gray-700 mb-2">
                            Lieu d'arrivée *
                        </label>
                        <input type="text" name="arrivee" id="arrivee" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow"
                            placeholder="Adresse, aéroport, hôtel...">
                        @error('arrivee')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Date & Heure -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                            Date *
                        </label>
                        <input type="date" name="date" id="date" required min="{{ date('Y-m-d') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow">
                        @error('date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="heure" class="block text-sm font-medium text-gray-700 mb-2">
                            Heure *
                        </label>
                        <input type="time" name="heure" id="heure" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow">
                        @error('heure')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Véhicule & Passagers -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label for="vehicle_category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Type de véhicule *
                        </label>
                        <select name="vehicle_category_id" id="vehicle_category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow">
                            <option value="">Choisir un véhicule</option>
                            @foreach($vehicleCategories as $category)
                            <option value="{{ $category->id }}" {{ old('vehicle_category_id')==$category->id ?
                                'selected' : '' }}>
                                {{ $category->display_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('vehicle_category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="passagers" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre de passagers *
                        </label>
                        <select name="passagers" id="passagers" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow">
                            <option value="">Nombre de personnes</option>
                            @for($i = 1; $i <= 8; $i++) <option value="{{ $i }}" {{ old('passagers')==$i ? 'selected'
                                : '' }}>
                                {{ $i }} passager(s)
                                </option>
                                @endfor
                        </select>
                        @error('passagers')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Instructions -->
                <div>
                    <label for="instructions" class="block text-sm font-medium text-gray-700 mb-2">
                        Instructions spéciales
                    </label>
                    <textarea name="instructions" id="instructions" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow"
                        placeholder="Informations complémentaires pour le chauffeur...">{{ old('instructions') }}</textarea>
                    @error('instructions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Informations client (pré-remplies) -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-medium text-gray-900 mb-2">Vos informations</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Nom</p>
                            <p class="font-medium">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Email</p>
                            <p class="font-medium">{{ auth()->user()->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Téléphone</p>
                            <p class="font-medium">{{ auth()->user()->phone ?? 'Non renseigné' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Référence</p>
                            <p class="font-medium">Générée automatiquement</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-4 py-3 bg-gray-50 sm:px-6 border-t border-gray-200">
                <div class="flex justify-between">
                    <a href="{{ route('client.reservations.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-check mr-2"></i> Confirmer la réservation
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Informations -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Informations importantes</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <ul class="list-disc pl-5 space-y-1">
                        <li>Votre réservation sera traitée dans les plus brefs délais</li>
                        <li>Vous recevrez une confirmation par email</li>
                        <li>Les réservations peuvent être modifiées ou annulées jusqu'à 24h avant</li>
                        <li>Pour toute urgence, contactez le 01 76 38 00 17</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Définir la date minimale à aujourd'hui
    document.getElementById('date').min = new Date().toISOString().split('T')[0];

    // Validation basique
    document.querySelector('form').addEventListener('submit', function(e) {
        const vehicleSelect = document.getElementById('vehicle_category_id');
        const passengersSelect = document.getElementById('passagers');

        if (vehicleSelect.value === '') {
            e.preventDefault();
            alert('Veuillez sélectionner un type de véhicule');
            vehicleSelect.focus();
            return false;
        }

        if (passengersSelect.value === '') {
            e.preventDefault();
            alert('Veuillez sélectionner le nombre de passagers');
            passengersSelect.focus();
            return false;
        }
    });
</script>
@endpush
