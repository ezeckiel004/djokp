@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs')

@section('page-title', 'Gestion des utilisateurs')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques et actions -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $users->total() }} utilisateur(s)
                </h3>
                <div class="mt-1 flex flex-wrap gap-2">
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-user-check mr-1"></i>
                        {{ $users->where('is_active', true)->count() }} actifs
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <i class="fas fa-user-slash mr-1"></i>
                        {{ $users->where('is_active', false)->count() }} inactifs
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-user-tie mr-1"></i>
                        {{ $users->where('role_id', 1)->count() }} administrateurs
                    </span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-graduation-cap mr-1"></i>
                        {{ $users->where('role_id', '!=', 1)->count() }} étudiants
                    </span>
                </div>
            </div>

            <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row gap-3">
                <div class="text-sm text-gray-500 self-center">
                    Page {{ $users->currentPage() }} sur {{ $users->lastPage() }}
                </div>
                <a href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-plus mr-2"></i>
                    Nouvel utilisateur
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
                    <input type="text" id="search-users" placeholder="Rechercher un utilisateur..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm">
                </div>
            </div>

            <div class="flex space-x-2">
                <select id="filter-role"
                    class="block w-full md:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                    <option value="">Tous les rôles</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                <select id="filter-status"
                    class="block w-full md:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                    <option value="">Tous les statuts</option>
                    <option value="1">Actif</option>
                    <option value="0">Inactif</option>
                </select>

                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-redo mr-2"></i>
                    Réinitialiser
                </a>
            </div>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Utilisateur
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rôle
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Inscription
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
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 user-row" data-role="{{ $user->role_id ?? '' }}"
                    data-status="{{ $user->is_active }}"
                    data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . $user->phone . ' ' . $user->city . ' ' . $user->country) }}">
                    <!-- Utilisateur -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-djok-yellow flex items-center justify-center">
                                <span class="text-white font-semibold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </div>
                                @if($user->id === auth()->id())
                                <span class="text-xs px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-user mr-1"></i>Vous
                                </span>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Rôle -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @php
                            $roleColors = [
                            1 => 'bg-red-100 text-red-800',
                            2 => 'bg-blue-100 text-blue-800',
                            3 => 'bg-green-100 text-green-800',
                            4 => 'bg-purple-100 text-purple-800',
                            5 => 'bg-yellow-100 text-yellow-800'
                            ];
                            @endphp
                            <span
                                class="px-2 py-1 text-xs rounded-full {{ $roleColors[$user->role_id] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $user->role->name ?? 'Aucun rôle' }}
                            </span>
                        </div>
                    </td>

                    <!-- Contact -->
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            @if($user->phone)
                            <i class="fas fa-phone mr-1 text-gray-400"></i>
                            {{ $user->phone }}
                            @else
                            <span class="text-gray-400 italic">Non renseigné</span>
                            @endif
                        </div>
                        @if($user->city || $user->country)
                        <div class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            {{ $user->city }}
                            @if($user->city && $user->country)
                            ,
                            @endif
                            {{ $user->country }}
                        </div>
                        @endif
                    </td>

                    <!-- Inscription -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <i class="fas fa-calendar-plus mr-1 text-gray-400"></i>
                            {{ $user->created_at->format('d/m/Y') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                        @if($user->last_login_at)
                        <div class="text-xs text-gray-400 mt-1">
                            <i class="fas fa-sign-in-alt mr-1"></i>
                            Dernière connexion: {{ $user->last_login_at->format('d/m/Y H:i') }}
                        </div>
                        @endif
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <!-- Badge actuel -->
                            <span id="status-badge-{{ $user->id }}"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                <i class="fas {{ $user->is_active ? 'fa-check-circle' : 'fa-ban' }} mr-1"></i>
                                {{ $user->is_active ? 'Actif' : 'Inactif' }}
                            </span>

                            <!-- Bouton de changement rapide de statut -->
                            @if($user->id !== auth()->id())
                            <div class="hidden group-hover:block">
                                <button type="button" data-user-id="{{ $user->id }}"
                                    data-current-status="{{ $user->is_active }}"
                                    class="toggle-status-btn inline-flex items-center px-2 py-1 text-xs font-medium rounded {{ $user->is_active ? 'bg-red-50 text-red-700 hover:bg-red-100' : 'bg-green-50 text-green-700 hover:bg-green-100' }}">
                                    <i class="fas {{ $user->is_active ? 'fa-ban mr-1' : 'fa-check mr-1' }}"></i>
                                    {{ $user->is_active ? 'Désactiver' : 'Activer' }}
                                </button>
                            </div>
                            @endif
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <!-- Bouton Voir -->
                            <a href="{{ route('admin.users.show', $user) }}"
                                class="text-gray-400 hover:text-djok-yellow transition-colors duration-200"
                                title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Bouton Éditer -->
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="text-gray-400 hover:text-blue-600 transition-colors duration-200"
                                title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Bouton Changer le statut (visible seulement si pas l'utilisateur courant) -->
                            @if($user->id !== auth()->id())
                            <button type="button" data-user-id="{{ $user->id }}"
                                data-current-status="{{ $user->is_active }}"
                                class="quick-toggle-status text-gray-400 hover:text-{{ $user->is_active ? 'red' : 'green' }}-600 transition-colors duration-200"
                                title="{{ $user->is_active ? 'Désactiver' : 'Activer' }}">
                                <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }}"></i>
                            </button>

                            <!-- Bouton Supprimer -->
                            <button type="button" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                class="delete-user-btn text-gray-400 hover:text-red-600 transition-colors duration-200"
                                title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-users text-gray-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun utilisateur</h3>
                            <p class="text-gray-500 mb-6">Commencez par créer un nouvel utilisateur.</p>
                            <a href="{{ route('admin.users.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-600">
                                <i class="fas fa-plus mr-2"></i>
                                Créer un utilisateur
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200">
        {{ $users->links() }}
    </div>
    @endif
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
        <div class="px-6 py-4">
            <h3 class="text-lg font-medium text-gray-900 mb-2">Confirmer la suppression</h3>
            <p class="text-sm text-gray-500">
                Êtes-vous sûr de vouloir supprimer l'utilisateur "<span id="userNameToDelete"></span>" ?
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
    const searchInput = document.getElementById('search-users');
    const filterRole = document.getElementById('filter-role');
    const filterStatus = document.getElementById('filter-status');
    const userRows = document.querySelectorAll('.user-row');

    // Éléments pour la suppression
    const deleteButtons = document.querySelectorAll('.delete-user-btn');
    const deleteModal = document.getElementById('deleteModal');
    const userNameToDelete = document.getElementById('userNameToDelete');
    const deleteForm = document.getElementById('deleteForm');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    // Filtrage en temps réel
    function filterUsers() {
        const searchTerm = searchInput.value.toLowerCase();
        const roleFilter = filterRole.value;
        const statusFilter = filterStatus.value;

        userRows.forEach(row => {
            const matchesSearch = row.dataset.search.includes(searchTerm);
            const matchesRole = !roleFilter || row.dataset.role === roleFilter;
            const matchesStatus = !statusFilter || row.dataset.status === statusFilter;

            if (matchesSearch && matchesRole && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Événements de filtrage
    searchInput.addEventListener('input', filterUsers);
    filterRole.addEventListener('change', filterUsers);
    filterStatus.addEventListener('change', filterUsers);

    // Gestion du changement rapide de statut
    document.querySelectorAll('.toggle-status-btn, .quick-toggle-status').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const currentStatus = this.dataset.currentStatus === '1';
            const newStatus = !currentStatus;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Afficher un indicateur de chargement
            const badge = document.getElementById(`status-badge-${userId}`);
            const originalContent = badge.innerHTML;
            badge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Chargement...';

            // Envoyer la requête AJAX
            fetch(`/admin/users/${userId}/toggle-status`, {
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
                    badge.innerHTML = `<i class="fas ${newStatus ? 'fa-check-circle' : 'fa-ban'} mr-1"></i>${newStatus ? 'Actif' : 'Inactif'}`;

                    // Mettre à jour l'attribut data-status pour le filtrage
                    const row = badge.closest('.user-row');
                    if (row) {
                        row.dataset.status = newStatus ? '1' : '0';
                    }

                    // Mettre à jour les boutons de statut
                    const toggleButtons = document.querySelectorAll(`[data-user-id="${userId}"]`);
                    toggleButtons.forEach(btn => {
                        btn.dataset.currentStatus = newStatus ? '1' : '0';
                        if (btn.classList.contains('toggle-status-btn')) {
                            btn.className = `inline-flex items-center px-2 py-1 text-xs font-medium rounded ${newStatus ? 'bg-red-50 text-red-700 hover:bg-red-100' : 'bg-green-50 text-green-700 hover:bg-green-100'}`;
                            btn.innerHTML = `<i class="fas ${newStatus ? 'fa-ban mr-1' : 'fa-check mr-1'}"></i>${newStatus ? 'Désactiver' : 'Activer'}`;
                        }
                        if (btn.classList.contains('quick-toggle-status')) {
                            btn.className = `quick-toggle-status text-gray-400 hover:text-${newStatus ? 'red' : 'green'}-600 transition-colors duration-200`;
                            btn.innerHTML = `<i class="fas fa-${newStatus ? 'ban' : 'check'}"></i>`;
                            btn.title = newStatus ? 'Désactiver' : 'Activer';
                        }
                    });

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

    // Gestion de la suppression
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.dataset.userName;

            userNameToDelete.textContent = userName;
            deleteForm.action = `/admin/users/${userId}`;
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
    userRows.forEach(row => {
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

    .user-row {
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
