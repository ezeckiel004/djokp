{{-- resources/views/client/location-reservations/edit.blade.php --}}
@extends('layouts.client')

@section('title', 'Modifier la réservation ' . $reservation->reference)
@section('page-title', 'Modifier la réservation')
@section('page-description', 'Modifiez les détails de votre réservation')

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
        <a href="{{ route('client.location-reservations.show', $reservation->id) }}"
            class="text-gray-500 hover:text-yellow-600 transition-colors">
            {{ $reservation->reference }}
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
    {{-- Messages --}}
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
            <h2 class="text-xl font-bold text-gray-800">Modifier la réservation {{ $reservation->reference }}</h2>
            <p class="text-gray-600 mt-1">Statut actuel :
                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $reservation->statut_couleur }}">
                    {{ $reservation->statut_fr }}
                </span>
            </p>
        </div>

        {{-- Formulaire de modification --}}
        <div class="p-6">
            <form action="{{ route('client.location-reservations.update', $reservation->id) }}" method="POST"
                id="edit-reservation-form">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Véhicule actuel --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Véhicule actuel</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center">
                                @if($reservation->vehicle && $reservation->vehicle->image_url)
                                <div class="flex-shrink-0 h-16 w-16 mr-4">
                                    <img src="{{ $reservation->vehicle->image_url }}"
                                        alt="{{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}"
                                        class="h-16 w-16 object-cover rounded">
                                </div>
                                @endif
                                <div>
                                    <h4 class="font-medium text-gray-900">
                                        {{ $reservation->vehicle->brand ?? 'N/A' }} {{ $reservation->vehicle->model ??
                                        '' }}
                                    </h4>
                                    <p class="text-sm text-gray-600">
                                        {{ $reservation->vehicle->category_fr ?? '' }}
                                        @if($reservation->vehicle && $reservation->vehicle->fuel_type_fr)
                                        • {{ $reservation->vehicle->fuel_type_fr }}
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Sélectionné lors de la création de la réservation
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nouveau véhicule (si modification autorisée) --}}
                    @if($reservation->statut === 'en_attente')
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Changer de véhicule</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Sélectionnez un nouveau véhicule
                                </label>
                                <select name="vehicle_id" id="vehicle_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                                    <option value="{{ $reservation->vehicle_id }}">
                                        {{ $reservation->vehicle->brand ?? 'N/A' }} {{ $reservation->vehicle->model ??
                                        '' }} (actuel)
                                    </option>
                                    @foreach($vehicles as $vehicle)
                                    @if($vehicle->id !== $reservation->vehicle_id)
                                    <option value="{{ $vehicle->id }}">
                                        {{ $vehicle->brand }} {{ $vehicle->model }} - {{ $vehicle->category_fr }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                <p class="mt-1 text-xs text-gray-500">
                                    Si vous changez de véhicule, le prix sera recalculé automatiquement
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Dates de location --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Modifier les dates</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de début *
                                </label>
                                <input type="date" name="date_debut" id="date_debut"
                                    value="{{ old('date_debut', $reservation->date_debut->format('Y-m-d')) }}" required
                                    min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                            </div>

                            <div>
                                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de fin *
                                </label>
                                <input type="date" name="date_fin" id="date_fin"
                                    value="{{ old('date_fin', $reservation->date_fin->format('Y-m-d')) }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                            </div>
                        </div>

                        {{-- Estimation de prix --}}
                        <div class="mt-4" id="price-estimation">
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <h4 class="font-medium text-yellow-900 mb-2">Nouvelle estimation</h4>
                                <div id="price-details" class="text-sm text-yellow-800">
                                    Modifiez les dates ou le véhicule pour voir le nouveau prix
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notes</h3>
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Informations complémentaires
                            </label>
                            <textarea name="notes" id="notes" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="Demandes spécifiques, informations supplémentaires...">{{ old('notes', $reservation->notes) }}</textarea>
                        </div>
                    </div>

                    {{-- Récapitulatif des changements --}}
                    <div id="changes-summary" class="hidden">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Récapitulatif des changements</h3>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="space-y-3" id="changes-details"></div>
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="pt-6 border-t border-gray-200 flex justify-between">
                        <div>
                            <a href="{{ route('client.location-reservations.show', $reservation->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                                <i class="fas fa-times mr-2"></i>Annuler
                            </a>
                        </div>

                        <div class="space-x-3">
                            <button type="button" onclick="previewChanges()"
                                class="inline-flex items-center px-4 py-2 border border-blue-300 text-blue-700 text-sm font-medium rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <i class="fas fa-eye mr-2"></i>Voir les changements
                            </button>

                            <button type="submit" id="submit-btn"
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Variables globales
    const originalData = {
        vehicle_id: {{ $reservation->vehicle_id }},
        date_debut: '{{ $reservation->date_debut->format("Y-m-d") }}',
        date_fin: '{{ $reservation->date_fin->format("Y-m-d") }}',
        notes: '{{ addslashes($reservation->notes ?? "") }}'
    };

    // Tarif journalier du véhicule actuel
    const vehicleDailyRate = {{ $reservation->vehicle->daily_rate ?? 100 }};

    // Calculer le nouveau prix
    function calculateNewPrice() {
        const vehicleSelect = document.getElementById('vehicle_id');
        const dateDebut = document.getElementById('date_debut').value;
        const dateFin = document.getElementById('date_fin').value;

        if (!dateDebut || !dateFin) {
            document.getElementById('price-details').innerHTML =
                'Veuillez renseigner les dates de location';
            return;
        }

        // Vérifier que la date de fin est après la date de début
        if (new Date(dateFin) <= new Date(dateDebut)) {
            document.getElementById('price-details').innerHTML =
                '<span class="text-red-600">La date de fin doit être postérieure à la date de début</span>';
            return;
        }

        // Calculer le nombre de jours
        const start = new Date(dateDebut);
        const end = new Date(dateFin);
        const diffTime = Math.abs(end - start);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

        // Déterminer le tarif journalier
        let dailyRate = vehicleDailyRate;
        if (vehicleSelect.value != originalData.vehicle_id) {
            // Si le véhicule change, on prend un tarif par défaut
            // À remplacer par une requête AJAX pour récupérer le tarif réel
            dailyRate = 120;
        }

        // Calculer le total
        let total = dailyRate * diffDays;

        // Appliquer des réductions pour les longues durées
        if (diffDays >= 30) {
            total *= 0.85; // 15% de réduction pour 1 mois
        } else if (diffDays >= 7) {
            total *= 0.90; // 10% de réduction pour 1 semaine
        }

        // Ancien montant
        const oldTotal = {{ $reservation->montant_total }};
        const difference = total - oldTotal;

        // Afficher l'estimation
        document.getElementById('price-details').innerHTML = `
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div class="text-gray-600">Durée</div>
                    <div class="font-semibold">${diffDays} jour${diffDays > 1 ? 's' : ''}</div>
                </div>
                <div>
                    <div class="text-gray-600">Nouveau total</div>
                    <div class="font-bold text-lg">${total.toFixed(2).replace('.', ',')} €</div>
                </div>
            </div>
            ${difference !== 0 ? `
            <div class="mt-2 pt-2 border-t border-yellow-200">
                <div class="flex justify-between">
                    <span class="text-gray-600">Ancien montant :</span>
                    <span class="font-medium">${oldTotal.toFixed(2).replace('.', ',')} €</span>
                </div>
                <div class="flex justify-between mt-1">
                    <span class="text-gray-600">Différence :</span>
                    <span class="font-bold ${difference > 0 ? 'text-red-600' : 'text-green-600'}">
                        ${difference > 0 ? '+' : ''}${difference.toFixed(2).replace('.', ',')} €
                    </span>
                </div>
            </div>
            ` : ''}
            <div class="mt-2 text-xs text-yellow-700">
                <i class="fas fa-info-circle mr-1"></i>
                Estimation basée sur le tarif journalier moyen
            </div>
        `;
    }

    // Afficher un aperçu des changements
    function previewChanges() {
        const form = document.getElementById('edit-reservation-form');
        const formData = new FormData(form);
        const changes = [];

        // Vérifier les changements de véhicule
        if (parseInt(formData.get('vehicle_id')) !== originalData.vehicle_id) {
            const vehicleSelect = document.getElementById('vehicle_id');
            const selectedOption = vehicleSelect.options[vehicleSelect.selectedIndex];
            changes.push({
                field: 'Véhicule',
                old: '{{ addslashes($reservation->vehicle->brand ?? "N/A") }} {{ addslashes($reservation->vehicle->model ?? "") }}',
                new: selectedOption.text.split(' (actuel)')[0]
            });
        }

        // Vérifier les changements de dates
        if (formData.get('date_debut') !== originalData.date_debut) {
            changes.push({
                field: 'Date de début',
                old: formatDate(originalData.date_debut),
                new: formatDate(formData.get('date_debut'))
            });
        }

        if (formData.get('date_fin') !== originalData.date_fin) {
            changes.push({
                field: 'Date de fin',
                old: formatDate(originalData.date_fin),
                new: formatDate(formData.get('date_fin'))
            });
        }

        // Vérifier les changements de notes
        if (formData.get('notes') !== originalData.notes) {
            const oldNotes = originalData.notes || '(aucune note)';
            const newNotes = formData.get('notes') || '(aucune note)';

            if (oldNotes !== newNotes) {
                changes.push({
                    field: 'Notes',
                    old: oldNotes.length > 50 ? oldNotes.substring(0, 50) + '...' : oldNotes,
                    new: newNotes.length > 50 ? newNotes.substring(0, 50) + '...' : newNotes
                });
            }
        }

        // Afficher le récapitulatif
        const summaryDiv = document.getElementById('changes-summary');
        const detailsDiv = document.getElementById('changes-details');

        if (changes.length > 0) {
            let html = '<h4 class="font-medium text-blue-900 mb-2">Modifications détectées :</h4>';

            changes.forEach(change => {
                html += `
                <div class="border-l-4 border-blue-300 pl-3 py-1">
                    <div class="font-medium text-blue-800">${change.field}</div>
                    <div class="text-sm">
                        <div class="text-red-600 line-through">${change.old}</div>
                        <div class="text-green-600 font-medium">→ ${change.new}</div>
                    </div>
                </div>
                `;
            });

            detailsDiv.innerHTML = html;
            summaryDiv.classList.remove('hidden');

            // Faire défiler jusqu'au récapitulatif
            summaryDiv.scrollIntoView({ behavior: 'smooth' });
        } else {
            detailsDiv.innerHTML = '<div class="text-blue-800">Aucune modification détectée</div>';
            summaryDiv.classList.remove('hidden');
        }
    }

    // Formater une date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR');
    }

    // Écouter les changements
    document.addEventListener('DOMContentLoaded', function() {
        const dateDebut = document.getElementById('date_debut');
        const dateFin = document.getElementById('date_fin');
        const vehicleSelect = document.getElementById('vehicle_id');

        // Initialiser la date minimale pour la fin
        if (dateDebut && dateFin) {
            dateDebut.addEventListener('change', function() {
                const minDate = new Date(this.value);
                minDate.setDate(minDate.getDate() + 1);
                dateFin.min = minDate.toISOString().split('T')[0];

                calculateNewPrice();
            });

            dateFin.addEventListener('change', calculateNewPrice);
        }

        if (vehicleSelect) {
            vehicleSelect.addEventListener('change', calculateNewPrice);
        }

        // Calculer le prix initial
        calculateNewPrice();

        // Validation du formulaire
        const form = document.getElementById('edit-reservation-form');
        if (form) {
            form.addEventListener('submit', function(e) {
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

                // Demander confirmation si des changements significatifs sont détectés
                const vehicleSelect = document.getElementById('vehicle_id');
                if (vehicleSelect && parseInt(vehicleSelect.value) !== originalData.vehicle_id) {
                    if (!confirm('Changer de véhicule peut entraîner une modification du prix. Continuer ?')) {
                        e.preventDefault();
                        return;
                    }
                }

                // Afficher un indicateur de chargement
                const submitBtn = document.getElementById('submit-btn');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Traitement en cours...';
                submitBtn.disabled = true;
            });
        }
    });
</script>
@endpush
