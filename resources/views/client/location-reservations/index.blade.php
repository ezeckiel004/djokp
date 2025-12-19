{{-- resources/views/client/location-reservations/index.blade.php --}}
@extends('layouts.client')

@section('title', 'Mes réservations de location')
@section('page-title', 'Mes réservations de location')
@section('page-description', 'Gérez vos réservations de véhicules')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Location</span>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Mes réservations</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Messages de statut --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
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

    {{-- En-tête avec bouton de création --}}
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Mes réservations de location</h1>
            <p class="text-gray-600 mt-1">Consultez et gérez toutes vos réservations de véhicules</p>
        </div>
        <a href="{{ route('client.location-reservations.create') }}"
            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Nouvelle réservation
        </a>
    </div>

    {{-- Filtres --}}
    <div class="mb-6 bg-white shadow rounded-lg p-4">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <label for="statut_filter" class="block text-sm font-medium text-gray-700 mb-1">Filtrer par
                    statut</label>
                <select id="statut_filter"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 rounded-md">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente">En attente</option>
                    <option value="confirmee">Confirmée</option>
                    <option value="en_cours">En cours</option>
                    <option value="terminee">Terminée</option>
                    <option value="annulee">Annulée</option>
                </select>
            </div>
            <div class="flex-1">
                <label for="date_filter" class="block text-sm font-medium text-gray-700 mb-1">Filtrer par
                    période</label>
                <select id="date_filter"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 rounded-md">
                    <option value="">Toutes les périodes</option>
                    <option value="future">À venir</option>
                    <option value="en_cours">En cours</option>
                    <option value="passee">Passée</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Tableau des réservations --}}
    @if($reservations->count() > 0)
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Référence
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Véhicule
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Période
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reservations as $reservation)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->reference }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->created_at->format('d/m/Y') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $reservation->vehicle->brand ?? 'N/A' }} {{ $reservation->vehicle->model ?? '' }}
                            </div>
                            @if($reservation->vehicle)
                            <div class="text-sm text-gray-500">{{ $reservation->vehicle->category_fr ?? '' }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-gray-500">
                                au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $reservation->duree_jours }} jours
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ number_format($reservation->montant_total, 2, ',', ' ') }} €
                            </div>
                            @if($reservation->tarif_journalier_moyen_formatted)
                            <div class="text-xs text-gray-500">
                                {{ $reservation->tarif_journalier_moyen_formatted }}/jour
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $reservation->statut_couleur }}">
                                {{ $reservation->statut_fr }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('client.location-reservations.show', $reservation->id) }}"
                                    class="text-blue-600 hover:text-blue-900 transition-colors"
                                    title="Voir les détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($reservation->peutEtreAnnulee())
                                <form action="{{ route('client.location-reservations.destroy', $reservation->id) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors"
                                        title="Annuler">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $reservations->links() }}
        </div>
    </div>
    @else
    <div class="bg-white shadow rounded-lg p-8 text-center">
        <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-car text-gray-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation trouvée</h3>
        <p class="text-gray-500 mb-6">Vous n'avez pas encore de réservation de location.</p>
        <a href="{{ route('client.location-reservations.create') }}"
            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Faire ma première réservation
        </a>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrage par statut
        const statutFilter = document.getElementById('statut_filter');
        const dateFilter = document.getElementById('date_filter');

        function applyFilters() {
            const statutValue = statutFilter.value;
            const dateValue = dateFilter.value;

            // Ici, vous pourriez ajouter du filtrage AJAX ou recharger la page avec des paramètres
            console.log('Filtres appliqués:', { statut: statutValue, date: dateValue });

            // Pour l'instant, on va simplement cacher/montrer les lignes
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const statutCell = row.querySelector('.px-2.inline-flex');
                const dateDebut = row.querySelector('td:nth-child(3) .text-gray-900').textContent;
                const dateFin = row.querySelector('td:nth-child(3) .text-gray-500').textContent.replace('au ', '');

                let statutMatch = true;
                let dateMatch = true;

                // Filtrer par statut
                if (statutValue) {
                    const statutText = statutCell.textContent.trim().toLowerCase();
                    const statutMap = {
                        'en_attente': 'en attente',
                        'confirmee': 'confirmée',
                        'en_cours': 'en cours',
                        'terminee': 'terminée',
                        'annulee': 'annulée'
                    };
                    statutMatch = statutText === statutMap[statutValue];
                }

                // Filtrer par date
                if (dateValue) {
                    const today = new Date();
                    const debut = parseDate(dateDebut);
                    const fin = parseDate(dateFin);

                    switch(dateValue) {
                        case 'future':
                            dateMatch = debut > today;
                            break;
                        case 'en_cours':
                            dateMatch = debut <= today && fin >= today;
                            break;
                        case 'passee':
                            dateMatch = fin < today;
                            break;
                    }
                }

                // Afficher/masquer la ligne
                row.style.display = (statutMatch && dateMatch) ? '' : 'none';
            });
        }

        function parseDate(dateString) {
            const parts = dateString.split('/');
            return new Date(parts[2], parts[1] - 1, parts[0]);
        }

        statutFilter.addEventListener('change', applyFilters);
        dateFilter.addEventListener('change', applyFilters);
    });
</script>
@endpush
