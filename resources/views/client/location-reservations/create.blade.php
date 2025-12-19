{{-- resources/views/client/location-reservations/create.blade.php --}}
@extends('layouts.client')

@section('title', 'Nouvelle réservation de location')
@section('page-title', 'Nouvelle réservation')
@section('page-description', 'Réservez un véhicule pour vos déplacements')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.location-reservations.index') }}"
            class="text-gray-500 hover:text-yellow-600 transition-colors">
            Mes réservations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Nouvelle réservation</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- Messages d'erreur/succès --}}
    @if ($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Veuillez corriger les erreurs suivantes :</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        {{-- En-tête --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Sélectionnez un véhicule</h2>
            <p class="text-gray-600 mt-1">Choisissez le véhicule qui correspond à vos besoins</p>
        </div>

        {{-- Véhicules disponibles --}}
        @if($vehicles->count() > 0)
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                @foreach($vehicles as $vehicle)
                <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 vehicle-card"
                    id="vehicle-{{ $vehicle->id }}" data-vehicle-id="{{ $vehicle->id }}"
                    data-vehicle-name="{{ $vehicle->brand }} {{ $vehicle->model }}"
                    data-vehicle-category="{{ $vehicle->category_fr }}"
                    data-vehicle-daily-rate="{{ $vehicle->daily_rate_formatted }}">
                    <div class="md:flex">
                        {{-- Image du véhicule --}}
                        <div class="md:w-1/3">
                            <div class="h-48 md:h-full bg-gray-100 overflow-hidden">
                                @if($vehicle->image_url)
                                <img src="{{ $vehicle->image_url }}" alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-gradient-to-r from-gray-200 to-gray-300">
                                    <i class="fas fa-car text-gray-400 text-4xl"></i>
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- Informations du véhicule --}}
                        <div class="md:w-2/3 p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">
                                        {{ $vehicle->brand }} {{ $vehicle->model }}
                                    </h3>
                                    <div class="flex items-center mt-2 space-x-3">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full {{ $vehicle->categoryColor }}">
                                            {{ $vehicle->category_fr }}
                                        </span>
                                        <span class="text-sm text-gray-600">
                                            <i class="fas fa-gas-pump mr-1"></i>{{ $vehicle->fuel_type_fr }}
                                        </span>
                                        @if($vehicle->year)
                                        <span class="text-sm text-gray-600">
                                            <i class="fas fa-calendar mr-1"></i>{{ $vehicle->year }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <button type="button"
                                    onclick="selectVehicle({{ $vehicle->id }}, '{{ $vehicle->brand }} {{ $vehicle->model }}', '{{ $vehicle->category_fr }}', '{{ $vehicle->daily_rate_formatted }}')"
                                    class="px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors select-vehicle-btn"
                                    data-vehicle-id="{{ $vehicle->id }}">
                                    Sélectionner
                                </button>
                            </div>

                            <div class="mt-4 space-y-3">
                                {{-- Équipements --}}
                                @if($vehicle->features && is_array($vehicle->features) && count($vehicle->features) > 0)
                                <div>
                                    <div class="text-xs font-medium text-gray-500 mb-1">Équipements inclus :</div>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($vehicle->features as $feature)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-50 text-blue-700 border border-blue-100">
                                            <i class="fas fa-check text-blue-500 mr-1 text-xs"></i>
                                            {{ $feature }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                {{-- Caractéristiques techniques --}}
                                <div class="grid grid-cols-2 gap-2 text-sm">
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-users mr-2 text-gray-400"></i>
                                        <span>{{ $vehicle->seats }} places</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-gas-pump mr-2 text-gray-400"></i>
                                        <span>{{ $vehicle->fuel_type_fr }}</span>
                                    </div>
                                    @if($vehicle->year)
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                        <span>{{ $vehicle->year }}</span>
                                    </div>
                                    @endif
                                    <div class="flex items-center text-gray-600">
                                        <i class="fas fa-palette mr-2 text-gray-400"></i>
                                        <span>{{ $vehicle->color ?? 'Standard' }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <span class="text-2xl font-bold text-yellow-600">
                                            {{ $vehicle->daily_rate_formatted }}
                                        </span>
                                        <span class="text-gray-500">/jour</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm text-gray-500">À la semaine</div>
                                        <div class="font-semibold text-gray-900">
                                            {{ $vehicle->weekly_rate_formatted }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Formulaire de réservation --}}
        <div id="reservation-form" class="px-6 py-4 border-t border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Détails de la réservation</h2>

            <form action="{{ route('client.location-reservations.store') }}" method="POST"
                id="location-reservation-form">
                @csrf

                <input type="hidden" name="vehicle_id" id="selected_vehicle_id" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Véhicule sélectionné --}}
                    <div class="md:col-span-2">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="font-medium text-gray-900">Véhicule sélectionné</h4>
                                    <div id="selected-vehicle-info" class="text-sm text-gray-600 mt-1">
                                        <div class="flex items-center">
                                            <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
                                            <span>Veuillez sélectionner un véhicule ci-dessus</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" onclick="clearSelection()"
                                    class="text-sm text-red-600 hover:text-red-800 transition-colors"
                                    id="clear-selection-btn" style="display: none;">
                                    <i class="fas fa-times mr-1"></i>Changer
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Dates de location --}}
                    <div>
                        <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">
                            Date de début *
                        </label>
                        <input type="date" name="date_debut" id="date_debut" required min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                        <p class="mt-1 text-xs text-gray-500">La location commence au minimum aujourd'hui</p>
                    </div>

                    <div>
                        <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">
                            Date de fin *
                        </label>
                        <input type="date" name="date_fin" id="date_fin" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                        <p class="mt-1 text-xs text-gray-500">Doit être postérieure à la date de début</p>
                    </div>

                    {{-- Estimation de prix --}}
                    <div class="md:col-span-2" id="price-estimation" style="display: none;">
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <h4 class="font-medium text-yellow-900 mb-2">Estimation du prix</h4>
                            <div id="price-details" class="text-sm text-yellow-800"></div>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            Notes complémentaires (optionnel)
                        </label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                            placeholder="Demandes spécifiques, informations supplémentaires..."></textarea>
                    </div>

                    {{-- Conditions --}}
                    <div class="md:col-span-2">
                        <div class="flex items-start">
                            <input type="checkbox" name="terms" id="terms" required
                                class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded mt-1">
                            <label for="terms" class="ml-2 text-sm text-gray-700">
                                J'accepte les
                                <a href="{{ route('cgv') }}" target="_blank"
                                    class="text-yellow-600 hover:text-yellow-800 underline">
                                    conditions générales de location
                                </a>
                                et la
                                <a href="{{ route('rgpd') }}" target="_blank"
                                    class="text-yellow-600 hover:text-yellow-800 underline">
                                    politique de confidentialité
                                </a>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Boutons d'action --}}
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-4">
                    <a href="{{ route('client.location-reservations.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Annuler
                    </a>
                    <button type="submit" id="submit-btn" disabled
                        class="px-6 py-2 bg-yellow-600 text-white font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas fa-check-circle mr-2"></i>
                        Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="p-12 text-center">
            <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-car text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun véhicule disponible</h3>
            <p class="text-gray-500">Tous nos véhicules sont actuellement réservés.</p>
            <a href="{{ route('client.location-reservations.index') }}"
                class="mt-4 inline-flex items-center px-4 py-2 bg-gray-900 text-white font-medium rounded-md hover:bg-gray-800 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour aux réservations
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    let selectedVehicle = null;

    function selectVehicle(vehicleId, vehicleName, vehicleCategory, dailyRate) {
        // Retirer la sélection précédente
        document.querySelectorAll('.vehicle-card').forEach(card => {
            card.classList.remove('border-yellow-500', 'border-2');
            card.classList.add('border-gray-200');
        });

        document.querySelectorAll('.select-vehicle-btn').forEach(btn => {
            btn.textContent = 'Sélectionner';
            btn.classList.remove('bg-green-600', 'hover:bg-green-700');
            btn.classList.add('bg-yellow-600', 'hover:bg-yellow-700');
        });

        // Mettre en évidence le véhicule sélectionné
        const vehicleCard = document.getElementById(`vehicle-${vehicleId}`);
        if (vehicleCard) {
            vehicleCard.classList.remove('border-gray-200');
            vehicleCard.classList.add('border-yellow-500', 'border-2');
        }

        // Changer le bouton du véhicule sélectionné
        const selectBtn = document.querySelector(`.select-vehicle-btn[data-vehicle-id="${vehicleId}"]`);
        if (selectBtn) {
            selectBtn.textContent = '✓ Sélectionné';
            selectBtn.classList.remove('bg-yellow-600', 'hover:bg-yellow-700');
            selectBtn.classList.add('bg-green-600', 'hover:bg-green-700');
        }

        // Stocker la sélection
        selectedVehicle = vehicleId;
        document.getElementById('selected_vehicle_id').value = vehicleId;

        // Mettre à jour l'affichage du véhicule sélectionné
        document.getElementById('selected-vehicle-info').innerHTML = `
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold text-gray-900">${vehicleName}</div>
                    <div class="flex items-center mt-1">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-200">${vehicleCategory}</span>
                        <span class="ml-2 text-gray-600">${dailyRate}/jour</span>
                    </div>
                </div>
            </div>
        `;

        // Afficher le bouton pour changer la sélection
        document.getElementById('clear-selection-btn').style.display = 'block';

        // Activer le bouton de soumission
        document.getElementById('submit-btn').disabled = false;

        // Calculer le prix si des dates sont déjà renseignées
        calculatePrice();

        // Faire défiler jusqu'au formulaire
        document.getElementById('reservation-form').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }

    function clearSelection() {
        selectedVehicle = null;
        document.getElementById('selected_vehicle_id').value = '';

        // Réinitialiser les cartes de véhicule
        document.querySelectorAll('.vehicle-card').forEach(card => {
            card.classList.remove('border-yellow-500', 'border-2');
            card.classList.add('border-gray-200');
        });

        document.querySelectorAll('.select-vehicle-btn').forEach(btn => {
            btn.textContent = 'Sélectionner';
            btn.classList.remove('bg-green-600', 'hover:bg-green-700');
            btn.classList.add('bg-yellow-600', 'hover:bg-yellow-700');
        });

        // Réinitialiser l'affichage
        document.getElementById('selected-vehicle-info').innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-info-circle text-yellow-500 mr-2"></i>
                <span>Veuillez sélectionner un véhicule ci-dessus</span>
            </div>
        `;

        // Cacher le bouton pour changer
        document.getElementById('clear-selection-btn').style.display = 'none';

        // Désactiver le bouton de soumission
        document.getElementById('submit-btn').disabled = true;

        // Cacher l'estimation de prix
        document.getElementById('price-estimation').style.display = 'none';
    }

    function calculatePrice() {
        const dateDebut = document.getElementById('date_debut').value;
        const dateFin = document.getElementById('date_fin').value;

        if (!selectedVehicle || !dateDebut || !dateFin) {
            document.getElementById('price-estimation').style.display = 'none';
            return;
        }

        // Vérifier que la date de fin est après la date de début
        if (new Date(dateFin) <= new Date(dateDebut)) {
            document.getElementById('price-estimation').style.display = 'none';
            return;
        }

        // Calculer le nombre de jours
        const start = new Date(dateDebut);
        const end = new Date(dateFin);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        // Récupérer les informations du véhicule sélectionné
        const vehicleCard = document.getElementById(`vehicle-${selectedVehicle}`);
        const dailyRateText = vehicleCard ? vehicleCard.querySelector('.text-yellow-600').textContent : '100 €';

        // Extraire le prix numérique
        const dailyRateMatch = dailyRateText.match(/(\d+[\.,]?\d*)/);
        const dailyRate = dailyRateMatch ? parseFloat(dailyRateMatch[0].replace(',', '.')) : 100;

        let total = dailyRate * diffDays;

        // Appliquer des réductions pour les longues durées
        if (diffDays >= 30) {
            total *= 0.85; // 15% de réduction pour 1 mois
        } else if (diffDays >= 7) {
            total *= 0.90; // 10% de réduction pour 1 semaine
        }

        // Afficher l'estimation
        document.getElementById('price-details').innerHTML = `
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-gray-600">Durée</div>
                    <div class="font-semibold">${diffDays} jour${diffDays > 1 ? 's' : ''}</div>
                </div>
                <div>
                    <div class="text-gray-600">Total estimé</div>
                    <div class="font-bold text-lg">${total.toFixed(2).replace('.', ',')} €</div>
                </div>
            </div>
            <div class="mt-2 text-xs text-yellow-700">
                <i class="fas fa-info-circle mr-1"></i>
                Prix indicatif TTC. Le montant final peut varier.
            </div>
        `;

        document.getElementById('price-estimation').style.display = 'block';
    }

    // Écouter les changements de dates
    document.addEventListener('DOMContentLoaded', function() {
        const dateDebut = document.getElementById('date_debut');
        const dateFin = document.getElementById('date_fin');

        if (dateDebut && dateFin) {
            // Définir la date minimale pour aujourd'hui
            const today = new Date().toISOString().split('T')[0];
            dateDebut.min = today;

            dateDebut.addEventListener('change', function() {
                // Mettre à jour la date minimale pour la fin
                const minDate = new Date(this.value);
                minDate.setDate(minDate.getDate() + 1);
                dateFin.min = minDate.toISOString().split('T')[0];

                // Si la date de fin est antérieure, la réinitialiser
                if (dateFin.value && new Date(dateFin.value) <= new Date(this.value)) {
                    dateFin.value = '';
                }

                calculatePrice();
            });

            dateFin.addEventListener('change', function() {
                // Validation simple
                if (dateDebut.value && this.value) {
                    if (new Date(this.value) <= new Date(dateDebut.value)) {
                        alert('La date de fin doit être postérieure à la date de début.');
                        const nextDay = new Date(dateDebut.value);
                        nextDay.setDate(nextDay.getDate() + 1);
                        this.value = nextDay.toISOString().split('T')[0];
                    }
                }
                calculatePrice();
            });
        }

        // Validation du formulaire
        const form = document.getElementById('location-reservation-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!selectedVehicle) {
                    e.preventDefault();
                    alert('Veuillez sélectionner un véhicule.');
                    return;
                }

                const dateDebutVal = document.getElementById('date_debut').value;
                const dateFinVal = document.getElementById('date_fin').value;

                if (!dateDebutVal || !dateFinVal) {
                    e.preventDefault();
                    alert('Veuillez renseigner les dates de location.');
                    return;
                }

                if (new Date(dateFinVal) <= new Date(dateDebutVal)) {
                    e.preventDefault();
                    alert('La date de fin doit être postérieure à la date de début.');
                    return;
                }

                // Vérifier les CGV
                const terms = document.getElementById('terms');
                if (!terms.checked) {
                    e.preventDefault();
                    alert('Veuillez accepter les conditions générales de location.');
                    return;
                }

                // Afficher un indicateur de chargement
                const submitBtn = document.getElementById('submit-btn');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Traitement en cours...';
                submitBtn.disabled = true;
            });
        }
    });
</script>

<style>
    .vehicle-card {
        transition: all 0.3s ease;
    }

    .vehicle-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .vehicle-card.border-yellow-500 {
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }
</style>
@endpush
