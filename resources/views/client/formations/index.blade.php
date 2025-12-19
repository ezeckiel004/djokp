{{-- resources/views/client/formations/index.blade.php --}}

@extends('layouts.client')

@section('title', 'Mes Formations')
@section('page-title', 'Mes Formations')
@section('page-description', 'Gérez vos formations et accédez à vos cours')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Formations</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Mes Formations</h3>
            <p class="mt-1 text-sm text-gray-500">Liste de toutes vos formations et leur statut</p>
        </div>

        <div class="px-4 py-5 sm:p-6">
            @if($userFormations->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Formation
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date d'inscription
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Accès jusqu'au
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($userFormations as $userFormation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $userFormation->formation->title ?? 'Formation non trouvée' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $userFormation->formation->type_formation ?? '' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                $statusColors = [
                                'active' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'expired' => 'bg-red-100 text-red-800',
                                'completed' => 'bg-blue-100 text-blue-800',
                                ];
                                $colorClass = $statusColors[$userFormation->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                    {{ ucfirst($userFormation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $userFormation->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($userFormation->access_end)
                                {{ \Carbon\Carbon::parse($userFormation->access_end)->format('d/m/Y') }}
                                @else
                                -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('client.formations.show', $userFormation->id) }}"
                                    class="text-djok-yellow hover:text-yellow-700 mr-3">
                                    <i class="fas fa-eye mr-1"></i> Détails
                                </a>
                                @if($userFormation->status === 'active')
                                <a href="{{ route('client.formations.acceder', $userFormation->id) }}"
                                    class="text-green-600 hover:text-green-900">
                                    <i class="fas fa-play mr-1"></i> Accéder
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $userFormations->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune formation</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Vous n'avez pas encore de formation inscrite.
                </p>
                <div class="mt-6">
                    <a href="{{ route('formation') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-search mr-2"></i> Parcourir les formations
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Informations supplémentaires -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Statut des formations</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <li><span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-1">Active</span>
                                : Vous pouvez accéder à la formation</li>
                            <li><span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mr-1">En
                                    attente</span> : Votre inscription est en cours de traitement</li>
                            <li><span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mr-1">Expirée</span>
                                : Votre accès a expiré</li>
                            <li><span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">Terminée</span>
                                : Vous avez complété la formation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-question-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-green-800">Besoin d'aide ?</h3>
                    <div class="mt-2 text-sm text-green-700">
                        <p>Si vous rencontrez des problèmes pour accéder à vos formations :</p>
                        <ul class="list-disc pl-5 mt-1 space-y-1">
                            <li>Contactez notre support technique</li>
                            <li>Vérifiez que votre paiement est bien validé</li>
                            <li>Assurez-vous que votre accès n'a pas expiré</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Scripts JavaScript supplémentaires si nécessaire
    console.log('Page formations chargée');
</script>
@endpush
