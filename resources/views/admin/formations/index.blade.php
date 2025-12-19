@extends('layouts.admin')

@section('title', 'Gestion des formations')

@section('page-title', 'Gestion des formations')

@section('page-actions')
<a href="{{ route('admin.formations.create') }}" class="btn-primary">
    <i class="fas fa-plus mr-2"></i>Nouvelle formation
</a>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête avec statistiques -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $formations->total() }} formation(s)
                </h3>
                @php
                $activeCount = $formations->where('is_active', true)->count();
                $certifiedCount = $formations->where('is_certified', true)->count();
                $elearningCount = $formations->where('type_formation', 'e_learning')->count();
                @endphp
                <div class="mt-1 flex items-center space-x-4 text-sm text-gray-600">
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-1"></span>
                        {{ $activeCount }} active(s)
                    </span>
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-1"></span>
                        {{ $certifiedCount }} certifiée(s)
                    </span>
                    <span class="flex items-center">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-1"></span>
                        {{ $elearningCount }} e-learning
                    </span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                Page {{ $formations->currentPage() }} sur {{ $formations->lastPage() }}
            </div>
        </div>
    </div>

    <!-- Tableau des formations -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Formation
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Durée
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prix
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Format
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
                @forelse($formations as $formation)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <!-- Nom et infos -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 rounded-lg flex items-center justify-center mr-3
                                @if($formation->type_formation === 'e_learning') bg-gradient-to-br from-purple-100 to-purple-200
                                @else bg-gradient-to-br from-blue-100 to-blue-200 @endif">
                                @if($formation->type_formation === 'e_learning')
                                <i class="fas fa-laptop text-purple-600"></i>
                                @else
                                <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                @endif
                            </div>
                            <div class="ml-1">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $formation->title }}
                                </div>
                                <div class="text-sm text-gray-500 flex items-center space-x-2 mt-1">
                                    @php
                                    $categorieLabels = [
                                    'vtc_theorique' => 'VTC Théorique',
                                    'vtc_pratique' => 'VTC Pratique',
                                    'e_learning' => 'E-learning',
                                    'renouvellement' => 'Renouvellement'
                                    ];
                                    @endphp
                                    <span class="px-2 py-0.5 text-xs bg-gray-100 text-gray-700 rounded">
                                        {{ $categorieLabels[$formation->categorie] ?? $formation->categorie }}
                                    </span>
                                    @if($formation->media_count > 0)
                                    <span
                                        class="px-2 py-0.5 text-xs bg-blue-100 text-blue-700 rounded flex items-center">
                                        <i class="fas fa-file mr-1 text-xs"></i>
                                        {{ $formation->media_count }}
                                    </span>
                                    @endif
                                    @if($formation->is_financeable_cpf)
                                    <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded">
                                        CPF
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>

                    <!-- Durée -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900 font-medium">
                            {{ $formation->duration_hours }}h
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $formation->duree ?? '--' }}
                        </div>
                    </td>

                    <!-- Prix -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">
                            {{ number_format($formation->price, 0, ',', ' ') }}€
                        </div>
                        @if($formation->is_financeable_cpf)
                        <div class="text-xs text-green-600">
                            <i class="fas fa-euro-sign mr-1"></i>Financement CPF
                        </div>
                        @endif
                    </td>

                    <!-- Type -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($formation->type_formation === 'e_learning')
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="fas fa-laptop mr-1"></i>
                            E-learning
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <i class="fas fa-users mr-1"></i>
                            Présentiel
                        </span>
                        @endif
                    </td>

                    <!-- Format -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                        $formatColors = [
                        'presentiel' => 'bg-blue-100 text-blue-800',
                        'en_ligne' => 'bg-green-100 text-green-800',
                        'mixte' => 'bg-yellow-100 text-yellow-800'
                        ];
                        @endphp
                        <span
                            class="px-2.5 py-1 text-xs font-medium rounded-full {{ $formatColors[$formation->format_type] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($formation->format_type) }}
                        </span>
                    </td>

                    <!-- Statut -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex flex-col space-y-2">
                            <!-- Statut actif/inactif -->
                            <button onclick="toggleFormationStatus({{ $formation->id }})"
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $formation->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }} transition-colors duration-200 cursor-pointer">
                                @if($formation->is_active)
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                Active
                                @else
                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                Inactive
                                @endif
                            </button>

                            <!-- Stripe status pour e-learning -->
                            @if($formation->type_formation === 'e_learning')
                            <div class="flex items-center">
                                @if($formation->stripe_price_id)
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fab fa-stripe mr-1 text-xs"></i>
                                    Stripe OK
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fab fa-stripe mr-1 text-xs"></i>
                                    Pas Stripe
                                </span>
                                @endif
                            </div>
                            @endif

                            <!-- Certification -->
                            @if($formation->is_certified)
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                <i class="fas fa-certificate mr-1 text-xs"></i>
                                Certifiée
                            </span>
                            @endif
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <!-- Voir -->
                            <a href="{{ route('admin.formations.show', $formation) }}"
                                class="text-blue-600 hover:text-blue-900 transition-colors duration-200 group p-2 rounded-lg bg-blue-50 hover:bg-blue-100"
                                title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </a>

                            <!-- Éditer -->
                            <a href="{{ route('admin.formations.edit', $formation) }}"
                                class="text-green-600 hover:text-green-900 transition-colors duration-200 group p-2 rounded-lg bg-green-50 hover:bg-green-100"
                                title="Éditer">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Sync Stripe (e-learning seulement) -->
                            @if($formation->type_formation === 'e_learning' && !$formation->stripe_price_id)
                            <a href="{{ route('admin.formations.sync-stripe', $formation) }}"
                                class="text-purple-600 hover:text-purple-900 transition-colors duration-200 group p-2 rounded-lg bg-purple-50 hover:bg-purple-100"
                                title="Créer produit Stripe"
                                onclick="return confirm('Créer un produit Stripe pour cette formation e-learning ?')">
                                <i class="fab fa-stripe"></i>
                            </a>
                            @endif

                            <!-- Supprimer -->
                            <form action="{{ route('admin.formations.destroy', $formation) }}" method="POST"
                                class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette formation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-900 transition-colors duration-200 group p-2 rounded-lg bg-red-50 hover:bg-red-100"
                                    title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-graduation-cap text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune formation trouvée</h3>
                            <p class="text-gray-500 mb-4">Commencez par créer votre première formation.</p>
                            <a href="{{ route('admin.formations.create') }}" class="btn-primary">
                                <i class="fas fa-plus mr-2"></i>Créer une formation
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($formations->hasPages())
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Affichage de <span class="font-medium">{{ $formations->firstItem() }}</span> à
                <span class="font-medium">{{ $formations->lastItem() }}</span> sur
                <span class="font-medium">{{ $formations->total() }}</span> formations
            </div>
            <div class="flex items-center space-x-2">
                {{ $formations->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    function toggleFormationStatus(formationId) {
        if (confirm('Êtes-vous sûr de vouloir changer le statut de cette formation ?')) {
            fetch(`/admin/formations/${formationId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erreur lors de la mise à jour du statut');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la mise à jour du statut');
            });
        }
    }
</script>
@endpush
@endsection
