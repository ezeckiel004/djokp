@extends('layouts.admin')

@section('title', 'Gestion des réservations')

@section('page-title', 'Réservations de véhicules')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques et actions -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $reservations->total() }} réservation(s)
                </h3>
                <div class="mt-1 flex flex-wrap gap-2">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $reservations->where('status', 'pending')->count() }} en attente
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        {{ $reservations->where('status', 'confirmed')->count() }} confirmées
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-car mr-1"></i>
                        {{ $reservations->where('status', 'in_progress')->count() }} en cours
                    </span>
                </div>
            </div>

            <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                <div class="text-sm text-gray-500 self-center">
                    Page {{ $reservations->currentPage() }} sur {{ $reservations->lastPage() }}
                </div>
                <a href="{{ route('admin.reservations.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-plus mr-2"></i>
                    Nouvelle réservation
                </a>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center space-y-2 md:space-y-0 md:space-x-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="search-reservations" placeholder="Rechercher une réservation..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                </div>
            </div>

            <div class="flex space-x-2">
                <select id="filter-status"
                    class="block w-full md:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                    <option value="">Tous les statuts</option>
                    <option value="pending">En attente</option>
                    <option value="confirmed">Confirmé</option>
                    <option value="in_progress">En cours</option>
                    <option value="completed">Terminé</option>
                    <option value="cancelled">Annulé</option>
                </select>

                <select id="filter-type"
                    class="block w-full md:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                    <option value="">Tous les types</option>
                    <option value="location">Location</option>
                    <option value="vtc_transport">VTC/Transport</option>
                    <option value="conciergerie">Conciergerie</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tableau des réservations -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center">
                            Client
                            <button type="button" class="ml-1 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-sort"></i>
                            </button>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Véhicule/Service
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Dates
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
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
                @forelse($reservations as $reservation)
                <tr class="hover:bg-gray-50 reservation-row" data-status="{{ $reservation->status }}"
                    data-type="{{ $reservation->type }}"
                    data-search="{{ strtolower($reservation->user->name . ' ' . $reservation->user->email . ' ' . ($reservation->vehicle ? $reservation->vehicle->registration : '') . ' ' . $reservation->id) }}">
                    <!-- Client -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-djok-yellow flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $reservation->user->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $reservation->user->email }}
                                </div>
                                @if($reservation->user->phone)
                                <div class="text-xs text-gray-400">
                                    <i class="fas fa-phone mr-1"></i>{{ $reservation->user->phone }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Véhicule/Service -->
                    <td class="px-6 py-4">
                        @if($reservation->vehicle)
                        <div class="text-sm font-medium text-gray-900">
                            {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $reservation->vehicle->registration }}
                        </div>
                        @else
                        <span class="text-sm text-gray-500 italic">Service sans véhicule</span>
                        @endif
                    </td>

                    <!-- Dates -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>
                            {{ $reservation->start_date->format('d/m/Y') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            <i class="fas fa-arrow-right mr-1"></i>
                            {{ $reservation->end_date->format('d/m/Y') }}
                        </div>
                        @if($reservation->pickup_time)
                        <div class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-clock mr-1"></i>
                            {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                        </div>
                        @endif
                    </td>

                    <!-- Type -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @switch($reservation->type)
                        @case('location')
                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                            <i class="fas fa-car mr-1"></i>Location
                        </span>
                        @break
                        @case('vtc_transport')
                        <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                            <i class="fas fa-taxi mr-1"></i>VTC
                        </span>
                        @break
                        @case('conciergerie')
                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                            <i class="fas fa-concierge-bell mr-1"></i>Conciergerie
                        </span>
                        @break
                        @endswitch

                        @if($reservation->passengers > 1)
                        <div class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-users mr-1"></i>{{ $reservation->passengers }} pers.
                        </div>
                        @endif
                    </td>

                    <!-- Montant -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ number_format($reservation->total_amount, 2) }}€
                        </div>
                        @if($reservation->deposit_amount > 0)
                        <div class="text-xs text-green-600">
                            <i class="fas fa-hand-holding-usd mr-1"></i>
                            Acompte: {{ number_format($reservation->deposit_amount, 2) }}€
                        </div>
                        @endif
                    </td>

                    <!-- Statut avec changement rapide -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <!-- Badge actuel -->
                            @php
                            $statusClasses = [
                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'confirmed' => 'bg-blue-100 text-blue-800 border-blue-200',
                            'in_progress' => 'bg-purple-100 text-purple-800 border-purple-200',
                            'completed' => 'bg-green-100 text-green-800 border-green-200',
                            'cancelled' => 'bg-red-100 text-red-800 border-red-200'
                            ];

                            $statusIcons = [
                            'pending' => 'fa-clock',
                            'confirmed' => 'fa-check-circle',
                            'in_progress' => 'fa-car',
                            'completed' => 'fa-flag-checkered',
                            'cancelled' => 'fa-ban'
                            ];

                            $statusLabels = [
                            'pending' => 'En attente',
                            'confirmed' => 'Confirmé',
                            'in_progress' => 'En cours',
                            'completed' => 'Terminé',
                            'cancelled' => 'Annulé'
                            ];
                            @endphp

                            <span id="status-badge-{{ $reservation->id }}"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusClasses[$reservation->status] }}">
                                <i class="fas {{ $statusIcons[$reservation->status] }} mr-1"></i>
                                {{ $statusLabels[$reservation->status] }}
                            </span>

                            <!-- Sélecteur de statut (visible au survol) -->
                            <div class="hidden group-hover:block">
                                <select data-reservation-id="{{ $reservation->id }}"
                                    class="status-select mt-1 block w-full pl-3 pr-10 py-1 text-xs border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow rounded-md">
                                    <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>En
                                        attente</option>
                                    <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : ''
                                        }}>Confirmé</option>
                                    <option value="in_progress" {{ $reservation->status == 'in_progress' ? 'selected' :
                                        '' }}>En cours</option>
                                    <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : ''
                                        }}>Terminé</option>
                                    <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : ''
                                        }}>Annulé</option>
                                </select>
                            </div>
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <!-- Bouton Voir -->
                            <a href="{{ route('admin.reservations.show', $reservation) }}"
                                class="text-gray-400 hover:text-djok-yellow transition-colors duration-200"
                                title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Bouton Éditer -->
                            <a href="{{ route('admin.reservations.edit', $reservation) }}"
                                class="text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Bouton Facture -->
                            <button type="button"
                                class="text-gray-400 hover:text-green-600 transition-colors duration-200"
                                title="Générer facture">
                                <i class="fas fa-file-invoice"></i>
                            </button>

                            <!-- Bouton Supprimer -->
                            <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST"
                                class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ? Cette action est irréversible.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-gray-400 hover:text-red-600 transition-colors duration-200"
                                    title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-calendar-times text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation</h3>
                            <p class="text-gray-500 mb-6">Commencez par créer une nouvelle réservation.</p>
                            <a href="{{ route('admin.reservations.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600">
                                <i class="fas fa-plus mr-2"></i>
                                Créer une réservation
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($reservations->hasPages())
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200">
        {{ $reservations->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Éléments DOM
    const searchInput = document.getElementById('search-reservations');
    const filterStatus = document.getElementById('filter-status');
    const filterType = document.getElementById('filter-type');
    const reservationRows = document.querySelectorAll('.reservation-row');
    const statusSelects = document.querySelectorAll('.status-select');

    // Filtrage en temps réel
    function filterReservations() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;
        const typeFilter = filterType.value;

        reservationRows.forEach(row => {
            const matchesSearch = row.dataset.search.includes(searchTerm);
            const matchesStatus = !statusFilter || row.dataset.status === statusFilter;
            const matchesType = !typeFilter || row.dataset.type === typeFilter;

            if (matchesSearch && matchesStatus && matchesType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Événements de filtrage
    searchInput.addEventListener('input', filterReservations);
    filterStatus.addEventListener('change', filterReservations);
    filterType.addEventListener('change', filterReservations);

    // Gestion du changement rapide de statut
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const reservationId = this.dataset.reservationId;
            const newStatus = this.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Afficher un indicateur de chargement
            const badge = document.getElementById(`status-badge-${reservationId}`);
            const originalContent = badge.innerHTML;
            badge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Chargement...';

            // Envoyer la requête AJAX
            fetch(`/admin/reservations/${reservationId}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Mettre à jour le badge de statut
                    const statusClasses = {
                        'pending': 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'confirmed': 'bg-blue-100 text-blue-800 border-blue-200',
                        'in_progress': 'bg-purple-100 text-purple-800 border-purple-200',
                        'completed': 'bg-green-100 text-green-800 border-green-200',
                        'cancelled': 'bg-red-100 text-red-800 border-red-200'
                    };

                    const statusIcons = {
                        'pending': 'fa-clock',
                        'confirmed': 'fa-check-circle',
                        'in_progress': 'fa-car',
                        'completed': 'fa-flag-checkered',
                        'cancelled': 'fa-ban'
                    };

                    const statusLabels = {
                        'pending': 'En attente',
                        'confirmed': 'Confirmé',
                        'in_progress': 'En cours',
                        'completed': 'Terminé',
                        'cancelled': 'Annulé'
                    };

                    badge.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border ${statusClasses[newStatus]}`;
                    badge.innerHTML = `<i class="fas ${statusIcons[newStatus]} mr-1"></i>${statusLabels[newStatus]}`;

                    // Mettre à jour l'attribut data-status pour le filtrage
                    const row = badge.closest('.reservation-row');
                    if (row) {
                        row.dataset.status = newStatus;
                    }

                    // Afficher une notification
                    showNotification('Statut mis à jour avec succès', 'success');
                } else {
                    throw new Error(data.message || 'Une erreur est survenue');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                badge.innerHTML = originalContent;
                showNotification('Erreur lors de la mise à jour du statut', 'error');
            });
        });
    });

    // Fonction pour afficher les notifications
    function showNotification(message, type = 'info') {
        // Créer l'élément de notification
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 translate-x-full ${type === 'success' ? 'bg-green-50 text-green-800 border border-green-200' : 'bg-red-50 text-red-800 border border-red-200'}`;

        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        // Animation d'entrée
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 10);

        // Animation de sortie après 3 secondes
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Ajouter la classe "group" aux lignes pour le hover
    reservationRows.forEach(row => {
        row.classList.add('group');
    });
});
</script>
@endpush

@push('styles')
<style>
    .data-table {
        min-width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
        padding: 0.75rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b7280;
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table tbody td {
        padding: 1rem 1.5rem;
        white-space: nowrap;
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .status-select {
        font-size: 0.75rem;
        padding: 0.25rem 2rem 0.25rem 0.5rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        appearance: none;
    }

    .reservation-row {
        transition: background-color 0.2s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .data-table {
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .data-table thead {
            display: none;
        }

        .data-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            padding: 1rem;
        }

        .data-table tbody td {
            display: block;
            padding: 0.5rem 0;
            border-bottom: none;
            white-space: normal;
        }

        .data-table tbody td:before {
            content: attr(data-label);
            display: block;
            font-weight: 600;
            color: #6b7280;
            margin-bottom: 0.25rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .data-table tbody td:last-child {
            padding-bottom: 0;
        }
    }
</style>
@endpush
