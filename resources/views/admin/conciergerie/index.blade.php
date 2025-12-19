@extends('layouts.admin')

@section('title', 'Gestion des Demandes de Conciergerie')

{{-- @section('page-actions')
<a href="{{ route('admin.conciergerie-demandes.statistiques') }}"
    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
    <i class="fas fa-chart-bar mr-2"></i> Voir les statistiques
</a>
@endsection --}}

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Liste des demandes de conciergerie</h3>
        <p class="mt-1 text-sm text-gray-500">Gérez toutes les demandes de services de conciergerie.</p>
    </div>

    <!-- Filtres -->
    <div class="border-t border-gray-200 px-4 py-4 bg-gray-50">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select name="statut" id="statut"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                    <option value="">Tous les statuts</option>
                    @foreach(App\Models\ConciergerieDemande::STATUTS as $key => $label)
                    <option value="{{ $key }}" {{ request('statut')==$key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                <input type="text" name="search" id="search"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md"
                    placeholder="Nom, email, référence..." value="{{ request('search') }}">
            </div>
            <div>
                <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-1">Date début</label>
                <input type="date" name="date_debut" id="date_debut"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md"
                    value="{{ request('date_debut') }}">
            </div>
            <div>
                <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-1">Date fin</label>
                <input type="date" name="date_fin" id="date_fin"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md"
                    value="{{ request('date_fin') }}">
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="w-full px-4 py-2 bg-djok-yellow text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-filter mr-2"></i> Filtrer
                </button>
            </div>
        </form>
    </div>

    <!-- Tableau des demandes -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'reference', 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}"
                            class="hover:text-gray-700 transition-colors">
                            Référence
                            @if(request('sort') == 'reference')
                            <i class="fas fa-sort-{{ request('order') == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                            <i class="fas fa-sort text-gray-300"></i>
                            @endif
                        </a>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Client
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Motif
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Arrivée
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Devis
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date création
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($demandes as $demande)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <div class="text-sm font-medium text-gray-900">{{ $demande->reference }}</div>
                            @if($demande->devis_envoye)
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mt-1">
                                <i class="fas fa-file-invoice-dollar mr-1 text-xs"></i>
                                Devis envoyé
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col">
                            <div class="text-sm font-medium text-gray-900">{{ $demande->nom_complet }}</div>
                            <div class="text-sm text-gray-500">{{ $demande->email }}</div>
                            <div class="text-sm text-gray-500">{{ $demande->telephone }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $demande->motif_label }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $demande->date_arrivee->format('d/m/Y') }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $demande->nombre_personnes }} personne{{ $demande->nombre_personnes > 1 ? 's' : '' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $demande->statut == 'nouvelle' ? 'bg-yellow-100 text-yellow-800' : ($demande->statut == 'confirme' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ $demande->statut_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($demande->montant_devis)
                        <div class="text-sm font-medium text-gray-900">
                            {{ $demande->montant_formate }}
                        </div>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            À déterminer
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $demande->created_at->format('d/m/Y') }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $demande->created_at->format('H:i') }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.conciergerie-demandes.show', $demande) }}"
                                class="text-blue-600 hover:text-blue-900 transition-colors" title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button onclick="openStatusModal({{ $demande->id }})"
                                class="text-yellow-600 hover:text-yellow-900 transition-colors"
                                title="Changer le statut">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <i class="fas fa-concierge-bell text-4xl text-gray-300"></i>
                            <p class="text-lg font-medium text-gray-700">Aucune demande trouvée</p>
                            <p class="text-sm text-gray-500">Commencez par créer une nouvelle demande ou ajustez vos
                                filtres</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($demandes->hasPages())
    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
        {{ $demandes->links() }}
    </div>
    @endif
</div>

<!-- Modal pour changer le statut -->
<div id="statusModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <i class="fas fa-exchange-alt text-yellow-600 mr-2"></i>
            Changer le statut
        </h3>
        <form id="statusForm" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label for="modalStatut" class="block text-sm font-medium text-gray-700 mb-1">
                        Nouveau statut
                    </label>
                    <select name="statut" id="modalStatut"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                        @foreach(App\Models\ConciergerieDemande::STATUTS as $key => $label)
                        <option value="{{ $key }}">
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-djok-yellow text-white font-semibold rounded-md hover:bg-yellow-700 transition-colors">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openStatusModal(demandeId) {
        document.getElementById('statusForm').action = `/admin/conciergerie-demandes/${demandeId}/update-statut`;
        document.getElementById('statusModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }

    // Fermer le modal en cliquant en dehors
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Fermer le modal avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('statusModal').classList.contains('hidden')) {
            closeModal();
        }
    });
</script>
@endpush