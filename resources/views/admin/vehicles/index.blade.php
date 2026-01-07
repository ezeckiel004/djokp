@extends('layouts.admin')

@section('title', 'Véhicules')

@section('page-title', 'Gestion des véhicules')

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Header -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Véhicules</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Gérez la flotte de véhicules disponibles pour la location et les réservations.
                </p>
            </div>
            <a href="{{ route('admin.vehicles.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>Nouveau véhicule
            </a>
        </div>
    </div>

    <!-- Liste des véhicules -->
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
                        Catégorie
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Informations
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tarifs
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
                @forelse($vehicles as $vehicle)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-16">
                                <img class="h-12 w-16 object-cover rounded-md" src="{{ $vehicle->image_url }}"
                                    alt="{{ $vehicle->full_name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $vehicle->brand }} {{ $vehicle->model }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $vehicle->registration }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $vehicle->year }} • {{ $vehicle->color }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($vehicle->vehicleCategory)
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vehicle->vehicleCategory->actif ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $vehicle->vehicleCategory->display_name }}
                        </span>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $vehicle->vehicleCategory->categorie }}
                        </div>
                        @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Non catégorisé
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <div class="flex items-center">
                                <i class="fas fa-gas-pump text-gray-400 mr-2"></i>
                                {{ $vehicle->fuel_type_fr }}
                            </div>
                            <div class="flex items-center mt-1">
                                <i class="fas fa-users text-gray-400 mr-2"></i>
                                {{ $vehicle->seats }} places
                            </div>
                            @if($vehicle->features)
                            <div class="mt-1 text-xs text-gray-500">
                                {{ Str::limit($vehicle->features_display, 50) }}
                            </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Journalier:</span>
                                <span class="font-semibold">{{ $vehicle->daily_rate_formatted }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Hebdomadaire:</span>
                                <span class="font-semibold">{{ $vehicle->weekly_rate_formatted }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Mensuel:</span>
                                <span class="font-semibold">{{ $vehicle->monthly_rate_formatted }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vehicle->availability_color }}">
                            {{ $vehicle->availability_fr }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                                class="text-blue-600 hover:text-blue-900" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}"
                                class="text-djok-yellow hover:text-yellow-700" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                        Aucun véhicule trouvé.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($vehicles->hasPages())
    <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $vehicles->links() }}
    </div>
    @endif
</div>
@endsection
