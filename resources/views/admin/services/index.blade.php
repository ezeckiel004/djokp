@extends('layouts.admin')

@section('title', 'Gestion des services')

@section('page-title', 'Gestion des services')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques et actions -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $services->count() }} service(s)
                </h3>
                <div class="mt-1 flex flex-wrap gap-2">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-eye mr-1"></i>
                        {{ $services->where('is_active', true)->count() }} actifs
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <i class="fas fa-eye-slash mr-1"></i>
                        {{ $services->where('is_active', false)->count() }} inactifs
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-sort-numeric-up mr-1"></i>
                        Trié par ordre
                    </span>
                </div>
            </div>

            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.services.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-plus mr-2"></i>
                    Nouveau service
                </a>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center justify-between space-y-2 md:space-y-0">
            <div class="text-sm text-gray-600">
                <i class="fas fa-info-circle mr-1"></i>
                Les services créés ici apparaîtront dans le formulaire de contact
            </div>
            <div class="text-sm text-gray-600 flex items-center">
                <i class="fas fa-arrows-alt mr-1"></i>
                Glissez-déposez les lignes pour réorganiser l'ordre
            </div>
        </div>
    </div>

    <!-- Tableau des services -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ordre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Service
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tarif
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 sortable-list">
                @forelse($services as $service)
                <tr data-id="{{ $service->id }}" class="hover:bg-gray-50 service-row">
                    <!-- Ordre -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="drag-handle cursor-move mr-3 text-gray-400 hover:text-djok-yellow">
                                <i class="fas fa-bars"></i>
                            </div>
                            <div class="text-sm font-medium text-gray-900">
                                {{ $service->sort_order }}
                            </div>
                        </div>
                    </td>

                    <!-- Service -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full flex items-center justify-center mr-4"
                                style="color: {{ $service->color ?? '#667eea' }}">
                                {!! $service->icon_html !!}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $service->name }}
                                </div>
                                @if($service->slug)
                                <div class="text-xs text-gray-500">
                                    {{ $service->slug }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Description -->
                    <td class="px-6 py-4">
                        @if($service->description)
                        <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $service->description }}">
                            {{ Str::limit($service->description, 60) }}
                        </div>
                        @else
                        <span class="text-sm text-gray-400 italic">Aucune description</span>
                        @endif
                    </td>

                    <!-- Tarif -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $service->price_formatted }}
                        </div>
                        @if($service->period_formatted)
                        <div class="text-xs text-gray-500">
                            {{ $service->period_formatted }}
                        </div>
                        @endif
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <!-- Badge actuel -->
                            <span id="status-badge-{{ $service->id }}"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                <i class="fas {{ $service->is_active ? 'fa-eye' : 'fa-eye-slash' }} mr-1"></i>
                                {{ $service->is_active ? 'Actif' : 'Inactif' }}
                            </span>

                            <!-- Bouton de changement rapide de statut -->
                            <div class="hidden group-hover:block">
                                <button type="button" data-service-id="{{ $service->id }}"
                                    data-current-status="{{ $service->is_active }}"
                                    class="toggle-status-btn inline-flex items-center px-2 py-1 text-xs font-medium rounded {{ $service->is_active ? 'bg-red-50 text-red-700 hover:bg-red-100' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
                                    <i class="fas {{ $service->is_active ? 'fa-eye-slash mr-1' : 'fa-eye mr-1' }}"></i>
                                    {{ $service->is_active ? 'Désactiver' : 'Activer' }}
                                </button>
                            </div>
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <!-- Bouton Éditer -->
                            <a href="{{ route('admin.services.edit', $service) }}"
                                class="text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Bouton Changer le statut -->
                            <button type="button" data-service-id="{{ $service->id }}"
                                data-current-status="{{ $service->is_active }}"
                                class="quick-toggle-status text-gray-400 hover:text-{{ $service->is_active ? 'red' : 'green' }}-600 transition-colors duration-200"
                                title="{{ $service->is_active ? 'Désactiver' : 'Activer' }}">
                                <i class="fas fa-{{ $service->is_active ? 'eye-slash' : 'eye' }}"></i>
                            </button>

                            <!-- Bouton Supprimer -->
                            <button type="button" data-service-id="{{ $service->id }}"
                                data-service-name="{{ $service->name }}"
                                class="delete-service-btn text-gray-400 hover:text-red-600 transition-colors duration-200"
                                title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-concierge-bell text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun service</h3>
                            <p class="text-gray-500 mb-6">Commencez par créer votre premier service.</p>
                            <a href="{{ route('admin.services.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600">
                                <i class="fas fa-plus mr-2"></i>
                                Créer un service
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Confirmer la suppression</h3>
            <p class="text-sm text-gray-500">
                Êtes-vous sûr de vouloir supprimer le service "<span id="serviceNameToDelete"></span>" ?
                Cette action est irréversible.
            </p>
        </div>
        <div class="px-6 py-4 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
            <button type="button" id="cancelDelete"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                Annuler
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Éléments DOM
    const serviceRows = document.querySelectorAll('.service-row');

    // Éléments pour la suppression
    const deleteButtons = document.querySelectorAll('.delete-service-btn');
    const deleteModal = document.getElementById('deleteModal');
    const serviceNameToDelete = document.getElementById('serviceNameToDelete');
    const deleteForm = document.getElementById('deleteForm');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    // Tri drag & drop
    const sortableList = document.querySelector('.sortable-list');
    if (sortableList) {
        new Sortable(sortableList, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                const services = [];
                sortableList.querySelectorAll('tr').forEach((row, index) => {
                    services.push(row.dataset.id);
                });

                fetch('{{ route("admin.services.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ services: services })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mettre à jour les numéros d'ordre
                        sortableList.querySelectorAll('tr').forEach((row, index) => {
                            const orderCell = row.querySelector('td:first-child .text-sm');
                            if (orderCell) {
                                orderCell.textContent = index + 1;
                            }
                        });
                        showNotification('Ordre des services mis à jour', 'success');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
                });
            }
        });
    }

    // Gestion du changement rapide de statut
    document.querySelectorAll('.toggle-status-btn, .quick-toggle-status').forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.dataset.serviceId;
            const currentStatus = this.dataset.currentStatus === '1';
            const newStatus = !currentStatus;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Afficher un indicateur de chargement
            const badge = document.getElementById(`status-badge-${serviceId}`);
            const originalContent = badge.innerHTML;
            badge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Chargement...';

            // Envoyer la requête AJAX
            fetch(`/admin/services/${serviceId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
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
                    badge.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${newStatus ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
                    badge.innerHTML = `<i class="fas ${newStatus ? 'fa-eye' : 'fa-eye-slash'} mr-1"></i>${newStatus ? 'Actif' : 'Inactif'}`;

                    // Mettre à jour les boutons de statut
                    const toggleButtons = document.querySelectorAll(`[data-service-id="${serviceId}"]`);
                    toggleButtons.forEach(btn => {
                        btn.dataset.currentStatus = newStatus ? '1' : '0';
                        if (btn.classList.contains('toggle-status-btn')) {
                            btn.className = `inline-flex items-center px-2 py-1 text-xs font-medium rounded ${newStatus ? 'bg-red-50 text-red-700 hover:bg-red-100' : 'bg-green-50 text-green-700 hover:bg-green-100'}`;
                            btn.innerHTML = `<i class="fas ${newStatus ? 'fa-eye-slash mr-1' : 'fa-eye mr-1'}"></i>${newStatus ? 'Désactiver' : 'Activer'}`;
                        }
                        if (btn.classList.contains('quick-toggle-status')) {
                            btn.className = `quick-toggle-status text-gray-400 hover:text-${newStatus ? 'red' : 'green'}-600 transition-colors duration-200`;
                            btn.innerHTML = `<i class="fas fa-${newStatus ? 'eye-slash' : 'eye'}"></i>`;
                            btn.title = newStatus ? 'Désactiver' : 'Activer';
                        }
                    });

                    // Afficher une notification
                    showNotification('Statut du service mis à jour', 'success');
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

    // Gestion de la suppression
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const serviceId = this.dataset.serviceId;
            const serviceName = this.dataset.serviceName;

            serviceNameToDelete.textContent = serviceName;
            deleteForm.action = `/admin/services/${serviceId}`;
            deleteModal.classList.remove('hidden');
        });
    });

    // Fermer le modal
    cancelDeleteBtn.addEventListener('click', function() {
        deleteModal.classList.add('hidden');
    });

    // Fermer le modal en cliquant à l'extérieur
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
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
    serviceRows.forEach(row => {
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
        border-bottom: 1px solid #e5e7eb;
    }

    .data-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .service-row {
        transition: background-color 0.2s ease;
    }

    .sortable-ghost {
        opacity: 0.4;
        background-color: #f3f4f6;
    }

    .sortable-chosen {
        background-color: #fef3c7;
    }

    .sortable-drag {
        opacity: 1 !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .drag-handle:hover {
        color: #fbbf24 !important;
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
