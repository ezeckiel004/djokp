@extends('layouts.admin')

@section('title', 'Gestion des Réservations Location')

@section('page-actions')
<a href="{{ route('admin.location-reservations.create') }}"
    class="inline-flex items-center px-4 py-2 bg-djok-yellow text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
    <i class="fas fa-plus mr-2"></i> Nouvelle réservation
</a>
@endsection

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Liste des réservations location</h3>
        <p class="mt-1 text-sm text-gray-500">Gérez toutes les réservations de véhicules.</p>
    </div>

    <div class="border-t border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Référence
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Véhicule
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Période
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
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
                    @forelse($reservations as $reservation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->reference }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $reservation->nom }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->email }}</div>
                            <div class="text-sm text-gray-500">{{ $reservation->telephone }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}
                            </div>
                            <div class="text-sm text-gray-500">{{ $reservation->vehicle->registration }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $reservation->date_debut->format('d/m/Y') }} → {{
                                $reservation->date_fin->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-gray-500">{{ $reservation->duree_jours }} jours</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ number_format($reservation->montant_total, 2, ',', ' ') }} €
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $reservation->statut_couleur }}">
                                {{ $reservation->statut_fr }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.location-reservations.show', $reservation) }}"
                                class="text-djok-yellow hover:text-yellow-700 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.location-reservations.edit', $reservation) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.location-reservations.destroy', $reservation) }}"
                                method="POST" class="inline-block"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Aucune réservation trouvée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 bg-gray-50 sm:px-6">
            {{ $reservations->links() }}
        </div>
    </div>
</div>

<!-- Modal pour changer le statut -->
<div id="statusModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Changer le statut</h3>
        <form id="statusForm" method="POST">
            @csrf
            <select name="statut"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-djok-yellow focus:border-djok-yellow sm:text-sm rounded-md">
                <option value="en_attente">En attente</option>
                <option value="confirmee">Confirmée</option>
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminée</option>
                <option value="annulee">Annulée</option>
            </select>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit" class="px-4 py-2 bg-djok-yellow text-white rounded-md hover:bg-yellow-700">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openStatusModal(reservationId) {
    document.getElementById('statusForm').action = `/admin/location-reservations/${reservationId}/update-status`;
    document.getElementById('statusModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('statusModal').classList.add('hidden');
}
</script>
@endpush
