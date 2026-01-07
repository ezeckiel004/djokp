@extends('layouts.admin')

@section('title', 'Catégories de véhicules')

@section('page-title', 'Gestion des catégories de véhicules')

@section('content')
<div class="bg-white shadow rounded-lg">
    <!-- Header -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Catégories de véhicules</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Gérez les catégories de véhicules pour les réservations VTC.
                </p>
            </div>
            <a href="{{ route('admin.vehicle-categories.create') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>Nouvelle catégorie
            </a>
        </div>
    </div>

    <!-- Liste des catégories -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Catégorie
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prise en charge
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix au km
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix minimum
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Véhicules
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $category->display_name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $category->categorie }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $category->prise_en_charge_formatted }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $category->prix_au_km_formatted }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $category->prix_minimum_formatted }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $category->actif ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $category->actif ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $category->vehicles->count() > 0 ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $category->vehicles->count() }} véhicule(s)
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.vehicle-categories.edit', $category) }}"
                                class="text-djok-yellow hover:text-yellow-700">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.vehicle-categories.show', $category) }}"
                                class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.vehicle-categories.destroy', $category) }}" method="POST"
                                onsubmit="return confirmDeleteCategory({{ $category->vehicles->count() }}, '{{ $category->display_name }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        Aucune catégorie de véhicule trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($categories->hasPages())
    <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $categories->links() }}
    </div>
    @endif
</div>

<script>
function confirmDeleteCategory(vehiclesCount, categoryName) {
    if (vehiclesCount > 0) {
        return confirm(
            `ATTENTION !\n\n` +
            `Vous êtes sur le point de supprimer la catégorie "${categoryName}".\n\n` +
            `Cette catégorie contient ${vehiclesCount} véhicule(s).\n` +
            `La suppression de la catégorie entraînera également la suppression de tous ces véhicules.\n\n` +
            `Êtes-vous vraiment sûr de vouloir continuer ?`
        );
    } else {
        return confirm(`Êtes-vous sûr de vouloir supprimer la catégorie "${categoryName}" ?`);
    }
}
</script>
@endsection
