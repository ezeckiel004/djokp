@extends('layouts.admin')

@section('title', 'Demandes Formation Internationale')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Demandes Formation Internationale</h1>
        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-600">
                {{ $demandes->total() }} demandes au total
            </div>
            <a href="{{ route('admin.demandes-formation-internationale.create') }}"
                class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>Nouvelle demande
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <div>{{ session('success') }}</div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-3"></i>
            <div>{{ session('error') }}</div>
        </div>
    </div>
    @endif

    <!-- Filtres -->
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.demandes-formation-internationale.index') }}"
                class="px-4 py-2 rounded transition-colors duration-200 {{ !request('statut') ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Toutes ({{ \App\Models\DemandeFormationInternationale::count() }})
            </a>
            <a href="{{ route('admin.demandes-formation-internationale.index', ['statut' => 'nouveau']) }}"
                class="px-4 py-2 rounded transition-colors duration-200 {{ request('statut') == 'nouveau' ? 'bg-yellow-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Nouvelles ({{ \App\Models\DemandeFormationInternationale::where('statut', 'nouveau')->count() }})
            </a>
            <a href="{{ route('admin.demandes-formation-internationale.index', ['statut' => 'en_cours']) }}"
                class="px-4 py-2 rounded transition-colors duration-200 {{ request('statut') == 'en_cours' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                En cours ({{ \App\Models\DemandeFormationInternationale::where('statut', 'en_cours')->count() }})
            </a>
            <a href="{{ route('admin.demandes-formation-internationale.index', ['statut' => 'traite']) }}"
                class="px-4 py-2 rounded transition-colors duration-200 {{ request('statut') == 'traite' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Traitées ({{ \App\Models\DemandeFormationInternationale::where('statut', 'traite')->count() }})
            </a>
            <a href="{{ route('admin.demandes-formation-internationale.index', ['statut' => 'annule']) }}"
                class="px-4 py-2 rounded transition-colors duration-200 {{ request('statut') == 'annule' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                Annulées ({{ \App\Models\DemandeFormationInternationale::where('statut', 'annule')->count() }})
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nom
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
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($demandes as $demande)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900">{{ $demande->nom_complet }}</div>
                            <div class="text-sm text-gray-500">{{ $demande->nationalite }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $demande->formation_label }}</div>
                            @if($demande->date_debut)
                            <div class="text-xs text-gray-500 mt-1">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $demande->date_debut->format('d/m/Y') }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <a href="mailto:{{ $demande->email }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $demande->email }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-500">
                                <a href="tel:{{ $demande->telephone }}" class="hover:text-gray-700">
                                    {{ $demande->telephone }}
                                </a>
                            </div>
                            @if($demande->whatsapp)
                            <div class="text-xs text-green-600 mt-1">
                                <i class="fab fa-whatsapp mr-1"></i>
                                {{ $demande->whatsapp }}
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $demande->created_at->format('d/m/Y') }}
                            <div class="text-xs text-gray-400">
                                {{ $demande->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $demande->statut_color }}">
                                {{ $demande->statut_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('admin.demandes-formation-internationale.show', $demande) }}"
                                    class="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                                    title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.demandes-formation-internationale.edit', $demande) }}"
                                    class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                    title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.demandes-formation-internationale.destroy', $demande) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ? Cette action est irréversible.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                        title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                <p class="text-lg font-medium text-gray-400">Aucune demande trouvée</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    @if(request('statut'))
                                    Aucune demande avec le statut "{{ request('statut') }}"
                                    @else
                                    Commencez par créer une nouvelle demande
                                    @endif
                                </p>
                                @if(request('statut'))
                                <a href="{{ route('admin.demandes-formation-internationale.index') }}"
                                    class="mt-4 text-yellow-600 hover:text-yellow-700">
                                    Voir toutes les demandes
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($demandes->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Affichage de
                    <span class="font-medium">{{ $demandes->firstItem() }}</span>
                    à
                    <span class="font-medium">{{ $demandes->lastItem() }}</span>
                    sur
                    <span class="font-medium">{{ $demandes->total() }}</span>
                    demandes
                </div>
                <div>
                    {{ $demandes->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Statistiques rapides -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center">
                <div class="rounded-full bg-yellow-100 p-3 mr-4">
                    <i class="fas fa-inbox text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nouvelles demandes</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ \App\Models\DemandeFormationInternationale::where('statut', 'nouveau')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center">
                <div class="rounded-full bg-blue-100 p-3 mr-4">
                    <i class="fas fa-spinner text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">En cours</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ \App\Models\DemandeFormationInternationale::where('statut', 'en_cours')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center">
                <div class="rounded-full bg-green-100 p-3 mr-4">
                    <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Traitées</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ \App\Models\DemandeFormationInternationale::where('statut', 'traite')->count() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex items-center">
                <div class="rounded-full bg-red-100 p-3 mr-4">
                    <i class="fas fa-times-circle text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Annulées</p>
                    <p class="text-2xl font-bold text-gray-900">
                        {{ \App\Models\DemandeFormationInternationale::where('statut', 'annule')->count() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
