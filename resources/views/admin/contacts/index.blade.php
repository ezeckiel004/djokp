@extends('layouts.admin')

@section('title', 'Gestion des messages')

@section('page-title', 'Messages reçus')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques et actions -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $contacts->total() }} message(s)
                </h3>
                <div class="mt-1 flex flex-wrap gap-2">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <i class="fas fa-envelope mr-1"></i>
                        {{ $contacts->where('is_read', false)->count() }} non lus
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-eye mr-1"></i>
                        {{ $contacts->where('is_read', true)->count() }} lus
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-reply mr-1"></i>
                        {{ $contacts->where('is_replied', true)->count() }} répondu
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $contacts->where('is_replied', false)->where('is_read', true)->count() }} en attente
                    </span>
                </div>
            </div>

            <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                <div class="text-sm text-gray-500 self-center">
                    Page {{ $contacts->currentPage() }} sur {{ $contacts->lastPage() }}
                </div>
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
                    <input type="text" id="search-contacts" placeholder="Rechercher un message..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                </div>
            </div>

            <div class="flex space-x-2">
                <select id="filter-status"
                    class="block w-full md:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                    <option value="">Tous les statuts</option>
                    <option value="non_lu">Non lu</option>
                    <option value="lu_non_repondu">Lu non répondu</option>
                    <option value="repondu">Répondu</option>
                </select>

                <a href="{{ route('admin.contacts.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-redo mr-2"></i>
                    Réinitialiser
                </a>
            </div>
        </div>
    </div>

    <!-- Tableau des messages -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Expéditeur
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Service
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Message
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($contacts as $contact)
                @php
                // Déterminer le statut pour le filtrage
                $filterStatus = 'non_lu';
                if ($contact->is_read && $contact->is_replied) {
                $filterStatus = 'repondu';
                } elseif ($contact->is_read && !$contact->is_replied) {
                $filterStatus = 'lu_non_repondu';
                }
                @endphp
                <tr class="hover:bg-gray-50 contact-row {{ !$contact->is_read ? 'bg-blue-50' : '' }}"
                    data-status="{{ $filterStatus }}"
                    data-search="{{ strtolower($contact->nom . ' ' . $contact->email . ' ' . $contact->telephone . ' ' . $contact->message . ' ' . $contact->id) }}">
                    <!-- Expéditeur -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div
                                class="h-10 w-10 rounded-full {{ !$contact->is_read ? 'bg-red-500' : 'bg-gray-400' }} flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ strtoupper(substr($contact->nom, 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $contact->nom }}
                                    @if(!$contact->is_read)
                                    <span class="ml-1 inline-flex h-2 w-2 rounded-full bg-red-500"></span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500 break-all">
                                    {{ $contact->email }}
                                </div>
                                @if($contact->telephone)
                                <div class="text-xs text-gray-400">
                                    <i class="fas fa-phone mr-1"></i>{{ $contact->telephone }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Service -->
                    <td class="px-6 py-4">
                        @if($contact->service)
                        <div class="flex items-center">
                            <div class="h-8 w-8 rounded-full flex items-center justify-center mr-2"
                                style="color: {{ $contact->service->color ?? '#667eea' }}">
                                {!! $contact->service->icon_html ?? '<i class="fas fa-cog"></i>' !!}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $contact->service->name }}
                                </div>
                            </div>
                        </div>
                        @elseif($contact->autre_service)
                        <div class="text-sm font-medium text-gray-900">
                            {{ $contact->autre_service }}
                        </div>
                        <div class="text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>Autre service
                        </div>
                        @else
                        <span class="text-sm text-gray-400 italic">Non spécifié</span>
                        @endif
                    </td>

                    <!-- Message -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900 line-clamp-2">
                            {{ Str::limit($contact->message, 150) }}
                        </div>
                        @if($contact->reply_message)
                        <div class="text-xs text-green-600 mt-1">
                            <i class="fas fa-reply mr-1"></i>
                            Réponse: {{ Str::limit($contact->reply_message, 50) }}
                        </div>
                        @endif
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <!-- Badge principal -->
                            @if(!$contact->is_read)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                <i class="fas fa-envelope mr-1"></i>Non lu
                            </span>
                            @elseif($contact->is_replied)
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                <i class="fas fa-check-circle mr-1"></i>Répondu
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                <i class="fas fa-eye mr-1"></i>Lu non répondu
                            </span>
                            @endif

                            <!-- Boutons d'action rapide -->
                            <div class="flex space-x-1 hidden group-hover:flex">
                                @if(!$contact->is_read)
                                <button type="button" data-contact-id="{{ $contact->id }}" data-action="mark-read"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-blue-50 text-blue-700 hover:bg-blue-100">
                                    <i class="fas fa-eye mr-1"></i>Marquer lu
                                </button>
                                @endif

                                @if($contact->is_read && !$contact->is_replied)
                                <button type="button" data-contact-id="{{ $contact->id }}" data-action="mark-replied"
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded bg-green-50 text-green-700 hover:bg-green-100">
                                    <i class="fas fa-reply mr-1"></i>Marquer répondu
                                </button>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Date -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <i class="fas fa-calendar-alt mr-1 text-gray-400"></i>
                            {{ $contact->created_at->format('d/m/Y') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $contact->created_at->format('H:i') }}
                        </div>
                        @if($contact->replied_at)
                        <div class="text-xs text-green-600 mt-1">
                            <i class="fas fa-reply-all mr-1"></i>
                            Répondu: {{ $contact->replied_at->format('d/m H:i') }}
                        </div>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <!-- Bouton Voir -->
                            <a href="{{ route('admin.contacts.show', $contact) }}"
                                class="text-gray-400 hover:text-djok-yellow transition-colors duration-200"
                                title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Bouton Répondre -->
                            <a href="mailto:{{ $contact->email }}?subject=Réponse à votre demande #{{ $contact->id }}"
                                class="text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                title="Répondre par email">
                                <i class="fas fa-reply"></i>
                            </a>

                            <!-- Bouton Supprimer -->
                            <button type="button" data-contact-id="{{ $contact->id }}"
                                data-contact-name="{{ $contact->nom }}"
                                class="delete-contact-btn text-gray-400 hover:text-red-600 transition-colors duration-200"
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
                            <i class="fas fa-envelope-open text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun message</h3>
                            <p class="text-gray-500 mb-6">Aucun message n'a été reçu pour le moment.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($contacts->hasPages())
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200">
        {{ $contacts->links() }}
    </div>
    @endif
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Confirmer la suppression</h3>
            <p class="text-sm text-gray-500">
                Êtes-vous sûr de vouloir supprimer le message de "<span id="contactNameToDelete"></span>" ?
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Éléments DOM
    const searchInput = document.getElementById('search-contacts');
    const filterStatus = document.getElementById('filter-status');
    const contactRows = document.querySelectorAll('.contact-row');

    // Éléments pour la suppression
    const deleteButtons = document.querySelectorAll('.delete-contact-btn');
    const deleteModal = document.getElementById('deleteModal');
    const contactNameToDelete = document.getElementById('contactNameToDelete');
    const deleteForm = document.getElementById('deleteForm');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    // Filtrage en temps réel
    function filterContacts() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;

        contactRows.forEach(row => {
            const matchesSearch = row.dataset.search.includes(searchTerm);
            const matchesStatus = !statusFilter || row.dataset.status === statusFilter;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Événements de filtrage
    searchInput.addEventListener('input', filterContacts);
    filterStatus.addEventListener('change', filterContacts);

    // Gestion des actions rapides
    document.querySelectorAll('[data-action]').forEach(button => {
        button.addEventListener('click', function() {
            const contactId = this.dataset.contactId;
            const action = this.dataset.action;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Préparer les données
            let url = `/admin/contacts/${contactId}/quick-update`;
            let data = {};

            if (action === 'mark-read') {
                data = { is_read: true };
            } else if (action === 'mark-replied') {
                data = { is_replied: true };
            }

            // Envoyer la requête AJAX
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Erreur lors de la mise à jour', 'error');
            });
        });
    });

    // Gestion de la suppression
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const contactId = this.dataset.contactId;
            const contactName = this.dataset.contactName;

            contactNameToDelete.textContent = contactName;
            deleteForm.action = `/admin/contacts/${contactId}`;
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
    contactRows.forEach(row => {
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

    .contact-row {
        transition: background-color 0.2s ease;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
