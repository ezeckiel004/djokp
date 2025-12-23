@extends('layouts.admin')

@section('title', 'Gestion des participants')

@section('page-title', 'Gestion des participants')

@section('page-actions')
<a href="{{ route('admin.participants.create') }}" class="btn-primary">
    <i class="fas fa-user-plus mr-2"></i>Nouveau participant
</a>
<a href="{{ route('admin.participants.statistics') }}" class="btn-secondary">
    <i class="fas fa-chart-bar mr-2"></i>Statistiques
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $participants->total() }} participant(s)
                </h3>
                @php
                $enAttenteCount = $participants->where('statut', 'en_attente')->count();
                $confirmeCount = $participants->where('statut', 'confirme')->count();
                $termineCount = $participants->where('statut', 'termine')->count();
                @endphp
                <div class="mt-1 flex items-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1"></span>
                        {{ $enAttenteCount }} en attente
                    </span>
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                        {{ $confirmeCount }} confirmé(s)
                    </span>
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-1"></span>
                        {{ $termineCount }} terminé(s)
                    </span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                Page {{ $participants->currentPage() }} sur {{ $participants->lastPage() }}
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="px-4 py-4 sm:px-6 border-b border-gray-200 bg-gray-50">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Recherche -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"
                    placeholder="Nom, prénom, email...">
            </div>

            <!-- Formation -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Formation</label>
                <select name="formation_id" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option value="">Toutes les formations</option>
                    @foreach($formations as $formation)
                    <option value="{{ $formation->id }}" {{ request('formation_id')==$formation->id ? 'selected' : ''
                        }}>
                        {{ $formation->title }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Statut -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Statut</label>
                <select name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option value="">Tous les statuts</option>
                    @foreach($statuts as $key => $value)
                    <option value="{{ $key }}" {{ request('statut')==$key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Type formation -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Type de formation</label>
                <select name="type_formation" class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option value="">Tous les types</option>
                    <option value="presentiel" {{ request('type_formation')=='presentiel' ? 'selected' : '' }}>
                        Présentiel</option>
                    <option value="en_ligne" {{ request('type_formation')=='en_ligne' ? 'selected' : '' }}>En ligne
                    </option>
                    <option value="mixte" {{ request('type_formation')=='mixte' ? 'selected' : '' }}>Mixte</option>
                </select>
            </div>

            <!-- Boutons actions -->
            <div class="md:col-span-4 flex justify-end space-x-2 pt-2">
                <button type="submit" class="btn-primary btn-sm">
                    <i class="fas fa-search mr-1"></i> Filtrer
                </button>
                <a href="{{ route('admin.participants.index') }}" class="btn-secondary btn-sm">
                    <i class="fas fa-times mr-1"></i> Effacer
                </a>
            </div>
        </form>
    </div>

    <!-- Tableau des participants -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Participant
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Formation
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Contact
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Progression
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($participants as $participant)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <!-- Nom et infos -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-lg flex items-center justify-center mr-3
                                @if($participant->type_formation === 'en_ligne') bg-gradient-to-br from-purple-100 to-purple-200
                                @else bg-gradient-to-br from-blue-100 to-blue-200 @endif">
                                @if($participant->type_formation === 'en_ligne')
                                <i class="fas fa-laptop text-purple-600"></i>
                                @else
                                <i class="fas fa-user text-blue-600"></i>
                                @endif
                            </div>
                            <div class="ml-1">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $participant->nom_complet }}
                                </div>
                                <div class="text-sm text-gray-500 flex items-center space-x-2 mt-1">
                                    @if($participant->age)
                                    <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-700 rounded">
                                        <i class="fas fa-birthday-cake mr-1 text-xs"></i>
                                        {{ $participant->age }} ans
                                    </span>
                                    @endif
                                    @if($participant->annee_permis)
                                    <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded">
                                        <i class="fas fa-id-card mr-1 text-xs"></i>
                                        {{ $participant->annee_permis }} ans permis
                                    </span>
                                    @endif
                                    @if($participant->user_id)
                                    <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded">
                                        <i class="fas fa-user-check mr-1 text-xs"></i>
                                        Compte
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Formation -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ Str::limit($participant->formation->title, 25) }}
                        </div>
                        <div class="text-sm text-gray-900 font-semibold mt-1">
                            {{ number_format($participant->formation->price, 0, ',', ' ') }}€
                        </div>
                    </td>

                    <!-- Contact -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-envelope text-gray-400 mr-2 text-xs"></i>
                                <a href="mailto:{{ $participant->email }}" class="text-blue-600 hover:text-blue-900">
                                    {{ $participant->email }}
                                </a>
                            </div>
                            @if($participant->telephone)
                            <div class="flex items-center">
                                <i class="fas fa-phone text-gray-400 mr-2 text-xs"></i>
                                <a href="tel:{{ $participant->telephone }}" class="text-gray-900">
                                    {{ $participant->telephone }}
                                </a>
                            </div>
                            @endif
                        </div>
                    </td>

                    <!-- Type de formation -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($participant->type_formation === 'en_ligne')
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-laptop mr-1"></i>
                            En ligne
                        </span>
                        @elseif($participant->type_formation === 'mixte')
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-blender mr-1"></i>
                            Mixte
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-users mr-1"></i>
                            Présentiel
                        </span>
                        @endif
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <!-- Statut principal -->
                            @php
                            $badgeClass = [
                            'en_attente' => 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200',
                            'confirme' => 'bg-green-100 text-green-800 hover:bg-green-200',
                            'annule' => 'bg-red-100 text-red-800 hover:bg-red-200',
                            'termine' => 'bg-blue-100 text-blue-800 hover:bg-blue-200',
                            ][$participant->statut] ?? 'bg-gray-100 text-gray-800';
                            @endphp

                            <button onclick="updateParticipantStatus({{ $participant->id }})"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }} transition-colors duration-200 cursor-pointer">
                                @php
                                $statusIcon = [
                                'en_attente' => 'clock',
                                'confirme' => 'check-circle',
                                'annule' => 'times-circle',
                                'termine' => 'graduation-cap',
                                ][$participant->statut] ?? 'question-circle';
                                @endphp
                                <i class="fas fa-{{ $statusIcon }} mr-1 text-xs"></i>
                                {{ $participant->statut_readable }}
                            </button>

                            <!-- Dates -->
                            <div class="text-xs text-gray-500 space-y-0.5">
                                @if($participant->date_debut)
                                <div class="flex items-center">
                                    <i class="fas fa-play mr-1 text-xs"></i>
                                    {{ $participant->date_debut->format('d/m/Y') }}
                                </div>
                                @endif
                                @if($participant->date_fin)
                                <div class="flex items-center">
                                    <i class="fas fa-flag-checkered mr-1 text-xs"></i>
                                    {{ $participant->date_fin->format('d/m/Y') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Progression -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center space-x-3">
                            <div class="flex-1">
                                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-green-500 rounded-full"
                                        style="width: {{ $participant->progression }}%">
                                    </div>
                                </div>
                            </div>
                            <span class="text-sm font-medium text-gray-900 whitespace-nowrap" style="min-width: 45px;">
                                {{ $participant->progression }}%
                            </span>
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <!-- Voir -->
                            <a href="{{ route('admin.participants.show', $participant->id) }}"
                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200 group p-2 rounded-lg bg-blue-50 hover:bg-blue-100"
                                title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Éditer -->
                            <a href="{{ route('admin.participants.edit', $participant->id) }}"
                                class="text-green-600 hover:text-green-900 transition-colors duration-200 group p-2 rounded-lg bg-green-50 hover:bg-green-100"
                                title="Éditer">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Contact rapide -->
                            <a href="mailto:{{ $participant->email }}"
                                class="text-purple-600 hover:text-purple-900 transition-colors duration-200 group p-2 rounded-lg bg-purple-50 hover:bg-purple-100"
                                title="Envoyer un email">
                                <i class="fas fa-envelope"></i>
                            </a>

                            @if($participant->telephone)
                            <a href="tel:{{ $participant->telephone }}"
                                class="text-teal-600 hover:text-teal-900 transition-colors duration-200 group p-2 rounded-lg bg-teal-50 hover:bg-teal-100"
                                title="Appeler">
                                <i class="fas fa-phone"></i>
                            </a>
                            @endif

                            <!-- Supprimer -->
                            <button type="button"
                                onclick="confirmDelete({{ $participant->id }}, '{{ $participant->nom_complet }}')"
                                class="text-red-600 hover:text-red-900 transition-colors duration-200 group p-2 rounded-lg bg-red-50 hover:bg-red-100"
                                title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun participant trouvé</h3>
                            <p class="text-gray-500 mb-4">Commencez par ajouter vos premiers participants.</p>
                            <a href="{{ route('admin.participants.create') }}" class="btn-primary">
                                <i class="fas fa-user-plus mr-2"></i>Ajouter un participant
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($participants->hasPages())
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Affichage de <span class="font-medium">{{ $participants->firstItem() }}</span> à
                <span class="font-medium">{{ $participants->lastItem() }}</span> sur
                <span class="font-medium">{{ $participants->total() }}</span> participants
            </div>
            <div class="flex items-center space-x-2">
                {{ $participants->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="deleteMessage"></p>
                <p class="text-danger mt-3"><strong>Cette action est irréversible !</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i> Annuler
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de changement de statut -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Changer le statut
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="statusForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau statut</label>
                        <select name="statut" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                            <option value="">Sélectionnez un statut</option>
                            @foreach($statuts as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date de début</label>
                            <input type="date" name="date_debut"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date de fin</label>
                            <input type="date" name="date_fin"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i> Annuler
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-check mr-2"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(participantId, participantName) {
        // Mettre à jour le message
        document.getElementById('deleteMessage').textContent =
            `Êtes-vous sûr de vouloir supprimer le participant "${participantName}" ?`;

        // Mettre à jour l'action du formulaire
        const form = document.getElementById('deleteForm');
        form.action = `/admin/participants/${participantId}`;

        // Afficher la modal
        $('#deleteModal').modal('show');
    }

    function updateParticipantStatus(participantId) {
        // Mettre à jour l'action du formulaire
        const form = document.getElementById('statusForm');
        form.action = `/admin/participants/${participantId}/update-status`;

        // Réinitialiser le formulaire
        form.reset();

        // Afficher la modal
        $('#statusModal').modal('show');
    }

    // Initialisation des tooltips
    $(function () {
        $('[title]').tooltip();

        // Auto-focus sur le champ de recherche
        $('input[name="search"]').focus();
    });
</script>
@endpush
