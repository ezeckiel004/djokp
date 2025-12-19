{{-- resources/views/client/reservations/edit.blade.php --}}

@extends('layouts.client')

@section('title', 'Modifier la réservation #' . $reservation->reference)
@section('page-title', 'Modifier la réservation #' . $reservation->reference)
@section('page-description', 'Modifiez les détails de votre réservation VTC')

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
        <a href="{{ route('client.reservations.show', $reservation->id) }}"
            class="text-gray-700 hover:text-djok-yellow">
            #{{ $reservation->reference }}
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Modifier</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Alert si modification limitée -->
    @if($reservation->date && \Carbon\Carbon::parse($reservation->date) < now()->addDays(1))
        <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Attention : Cette réservation est prévue pour demain ou plus tôt.
                        Les modifications peuvent être limitées. Contactez-nous pour toute modification urgente.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Modifier la réservation</h3>
                <p class="mt-1 text-sm text-gray-500">Modifiez les détails de votre réservation #{{
                    $reservation->reference }}</p>
            </div>

            <form action="{{ route('client.reservations.update', $reservation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="px-4 py-5 sm:p-6 space-y-6">
                    <!-- Type de service -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Type de service</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <input type="radio" name="type_service" id="transfert" value="transfert"
                                    class="sr-only peer" {{ $reservation->type_service == 'transfert' ? 'checked' : ''
                                }}>
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
                                    class="sr-only peer" {{ $reservation->type_service == 'professionnel' ? 'checked' :
                                '' }}>
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
                                    class="sr-only peer" {{ $reservation->type_service == 'evenement' ? 'checked' : ''
                                }}>
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
                                    class="sr-only peer" {{ $reservation->type_service == 'mise_disposition' ? 'checked'
                                : '' }}>
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
                                value="{{ old('depart', $reservation->depart) }}"
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
                                value="{{ old('arrivee', $reservation->arrivee) }}"
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
                            <input type="date" name="date" id="date" required
                                value="{{ old('date', $reservation->formatted_date ?? date('Y-m-d')) }}"
                                min="{{ date('Y-m-d') }}"
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
                                value="{{ old('heure', $reservation->heure) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow">
                            @error('heure')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Véhicule & Passagers -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de véhicule *</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" name="type_vehicule" id="eco" value="eco"
                                        class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300" {{
                                        $reservation->type_vehicule == 'eco' ? 'checked' : '' }}>
                                    <label for="eco" class="ml-3">
                                        <span class="font-medium">Économique</span>
                                        <p class="text-sm text-gray-500">Jusqu'à 3 passagers</p>
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="type_vehicule" id="business" value="business"
                                        class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300" {{
                                        $reservation->type_vehicule == 'business' ? 'checked' : '' }}>
                                    <label for="business" class="ml-3">
                                        <span class="font-medium">Business</span>
                                        <p class="text-sm text-gray-500">Jusqu'à 4 passagers</p>
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="type_vehicule" id="prestige" value="prestige"
                                        class="h-4 w-4 text-djok-yellow focus:ring-djok-yellow border-gray-300" {{
                                        $reservation->type_vehicule == 'prestige' ? 'checked' : '' }}>
                                    <label for="prestige" class="ml-3">
                                        <span class="font-medium">Prestige</span>
                                        <p class="text-sm text-gray-500">Jusqu'à 8 passagers</p>
                                    </label>
                                </div>
                            </div>
                            @error('type_vehicule')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="passagers" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre de passagers *
                            </label>
                            <select name="passagers" id="passagers" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-djok-yellow focus:border-djok-yellow">
                                <option value="1" {{ $reservation->passagers == '1' ? 'selected' : '' }}>1 passager
                                </option>
                                <option value="2" {{ $reservation->passagers == '2' ? 'selected' : '' }}>2 passagers
                                </option>
                                <option value="3" {{ $reservation->passagers == '3' ? 'selected' : '' }}>3 passagers
                                </option>
                                <option value="4" {{ $reservation->passagers == '4' ? 'selected' : '' }}>4 passagers
                                </option>
                                <option value="5+" {{ $reservation->passagers == '5+' ? 'selected' : '' }}>5+ passagers
                                </option>
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
                            placeholder="Informations complémentaires pour le chauffeur...">{{ old('instructions', $reservation->instructions) }}</textarea>
                        @error('instructions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informations réservation -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Informations de la réservation</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Référence</p>
                                <p class="font-medium">{{ $reservation->reference }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Statut</p>
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                {{ $reservation->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($reservation->status == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $reservation->status == 'pending' ? 'En attente' :
                                    ($reservation->status == 'confirmed' ? 'Confirmée' : $reservation->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-gray-500">Date de création</p>
                                <p class="font-medium">{{ $reservation->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-4 py-3 bg-gray-50 sm:px-6 border-t border-gray-200">
                    <div class="flex justify-between">
                        <div class="flex space-x-3">
                            <a href="{{ route('client.reservations.show', $reservation->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                                <i class="fas fa-times mr-2"></i> Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                                <i class="fas fa-save mr-2"></i> Enregistrer les modifications
                            </button>
                        </div>
                        @if($reservation->status === 'pending')
                        <form action="{{ route('client.reservations.destroy', $reservation->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ? Cette action est irréversible.')"
                                class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                <i class="fas fa-trash mr-2"></i> Supprimer définitivement
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Limitations -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Conditions de modification</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Les modifications sont autorisées jusqu'à 24 heures avant la date de service</li>
                            <li>Après modification, la réservation repasse en statut "En attente" pour validation</li>
                            <li>Toute modification importante peut entraîner un réajustement du tarif</li>
                            <li>Vous recevrez une confirmation par email après validation</li>
                            <li>Pour toute question, contactez le service client au 01 76 38 00 17</li>
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

    // Afficher un message de confirmation avant soumission
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir modifier cette réservation ?')) {
            e.preventDefault();
        }
    });
</script>
@endpush
