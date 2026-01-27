@extends('layouts.admin')

@section('title', 'Gestion des accès E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container px-4 py-8 mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des accès</h1>
                <p class="mt-1 text-gray-600">Suivi des utilisateurs e-learning</p>
            </div>
            <div class="flex space-x-3">
                <!-- Filtres -->
                <select id="statusFilter" class="px-3 py-2 text-sm border border-gray-300 rounded-lg">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Actifs</option>
                    <option value="expired" {{ request('status')=='expired' ? 'selected' : '' }}>Expirés</option>
                    <option value="suspended" {{ request('status')=='suspended' ? 'selected' : '' }}>Suspendus</option>
                </select>

                <!-- Recherche -->
                <form method="GET" class="flex">
                    <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}"
                        class="w-64 px-3 py-2 text-sm border border-gray-300 rounded-l-lg">
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-r-lg hover:bg-blue-700">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Liste des accès -->
    <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Utilisateur
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Forfait
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Codes d'accès
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Progression
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Dates
                        </th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($acces as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $item->prenom }} {{ $item->nom }}</div>
                            <div class="text-xs text-gray-500">{{ $item->email }}</div>
                            <div class="text-xs text-gray-500">{{ $item->telephone }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $item->forfait->name }}</div>
                            <div class="text-xs text-gray-500">{{ $item->forfait->duration_days }} jours</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-mono text-sm">{{ $item->access_code }}</div>
                            <div class="text-xs text-gray-500">{{ $item->virtual_room_code }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Remplacement de la barre de progression par des indicateurs textuels -->
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <div class="w-32">
                                        <div class="text-sm font-medium text-gray-700">
                                            Cours: {{ $item->cours_completed }}/{{ $item->total_cours }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-500">
                                    Score: {{ number_format($item->average_qcm_score, 1) }}%
                                </div>
                                @if($item->certification_eligible)
                                <div
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-certificate"></i>
                                    Certifiable
                                </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                Début: {{ $item->access_start->format('d/m/Y') }}
                            </div>
                            <div class="text-sm {{ $item->access_end < now() ? 'text-red-600' : 'text-gray-900' }}">
                                Fin: {{ $item->access_end->format('d/m/Y') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $item->access_end->diffForHumans() }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.elearning.acces.show', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-800" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if($item->status === 'active')
                                <form action="{{ route('admin.elearning.acces.suspend', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-800"
                                        title="Suspendre" onclick="return confirm('Suspendre cet accès ?')">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                </form>
                                @elseif($item->status === 'suspended')
                                <form action="{{ route('admin.elearning.acces.activate', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800" title="Activer">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </form>
                                @endif

                                <!-- Bouton Supprimer -->
                                <form action="{{ route('admin.elearning.acces.destroy', $item->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet accès ? Cette action est irréversible.')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($acces->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $acces->links() }}
        </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Filtre par statut
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const url = new URL(window.location.href);

        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }

        window.location.href = url.toString();
    });
</script>
@endsection
