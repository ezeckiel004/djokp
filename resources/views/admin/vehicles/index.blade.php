@extends('layouts.admin')

@section('title', 'Gestion des véhicules')

@section('page-title', 'Gestion de la flotte')

@section('page-actions')
<a href="{{ route('admin.vehicles.create') }}" class="btn-primary">
    <i class="fas fa-plus mr-2"></i>Nouveau véhicule
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $vehicles->total() }} véhicule(s)
                </h3>
                @php
                $availableCount = $vehicles->where('is_available', true)->count();
                $unavailableCount = $vehicles->where('is_available', false)->count();
                @endphp
                <div class="mt-1 flex items-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                        {{ $availableCount }} disponible(s)
                    </span>
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-red-500 rounded-full mr-1"></span>
                        {{ $unavailableCount }} indisponible(s)
                    </span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                Page {{ $vehicles->currentPage() }} sur {{ $vehicles->lastPage() }}
            </div>
        </div>
    </div>

    <!-- Tableau des véhicules -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Véhicule
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Immatriculation
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Catégorie
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Disponibilité
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tarifs
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($vehicles as $vehicle)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <!-- Informations du véhicule -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div
                                class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-car text-gray-600"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $vehicle->brand }} {{ $vehicle->model }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $vehicle->year }} • {{ $vehicle->color }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Immatriculation -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="font-mono text-sm font-medium text-gray-900 bg-gray-100 px-2 py-1 rounded">
                            {{ $vehicle->registration }}
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $vehicle->seats }} places • {{ $vehicle->fuel_type }}
                        </div>
                    </td>

                    <!-- Catégorie -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                        $categoryColors = [
                        'eco' => 'bg-green-100 text-green-800',
                        'business' => 'bg-blue-100 text-blue-800',
                        'prestige' => 'bg-purple-100 text-purple-800',
                        'van' => 'bg-yellow-100 text-yellow-800'
                        ];
                        $categoryLabels = [
                        'eco' => 'Éco',
                        'business' => 'Business',
                        'prestige' => 'Prestige',
                        'van' => 'Van'
                        ];
                        @endphp
                        <span
                            class="px-2.5 py-1 text-xs font-medium rounded-full {{ $categoryColors[$vehicle->category] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $categoryLabels[$vehicle->category] ?? $vehicle->category }}
                        </span>
                    </td>

                    <!-- Disponibilité -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($vehicle->is_available)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                            Disponible
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                            Indisponible
                        </span>
                        @endif
                    </td>

                    <!-- Tarifs -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">
                            {{ number_format($vehicle->daily_rate, 2) }}€/jour
                        </div>
                        <div class="text-xs text-gray-500">
                            Sem: {{ number_format($vehicle->weekly_rate, 2) }}€
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-3">
                            <!-- Voir -->
                            <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200 group"
                                title="Voir les détails">
                                <div class="p-2 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </a>

                            <!-- Éditer -->
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}"
                                class="text-green-600 hover:text-green-900 transition-colors duration-200 group"
                                title="Éditer">
                                <div class="p-2 rounded-lg bg-green-50 group-hover:bg-green-100">
                                    <i class="fas fa-edit"></i>
                                </div>
                            </a>

                            <!-- Supprimer -->
                            <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 transition-colors duration-200 group"
                                    title="Supprimer">
                                    <div class="p-2 rounded-lg bg-red-50 group-hover:bg-red-100">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-car text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun véhicule trouvé</h3>
                            <p class="text-gray-500 mb-4">Commencez par ajouter votre premier véhicule à la flotte.</p>
                            <a href="{{ route('admin.vehicles.create') }}" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>Ajouter un véhicule
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($vehicles->hasPages())
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Affichage de <span class="font-medium">{{ $vehicles->firstItem() }}</span> à
                <span class="font-medium">{{ $vehicles->lastItem() }}</span> sur
                <span class="font-medium">{{ $vehicles->total() }}</span> véhicules
            </div>
            <div class="flex items-center space-x-2">
                {{ $vehicles->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
