@extends('layouts.admin')

@section('title', 'Gestion des QCM E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des QCM</h1>
                <p class="text-gray-600 mt-1">Quiz et examens blancs pour l'e-learning</p>
            </div>
            <a href="{{ route('admin.elearning.qcms.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Nouveau QCM
            </a>
        </div>
    </div>

    <!-- Filtres -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
        <div class="flex space-x-4">
            <select id="typeFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Tous les types</option>
                <option value="examen" {{ request('type')=='examen' ? 'selected' : '' }}>Examens blancs</option>
                <option value="qcm" {{ request('type')=='qcm' ? 'selected' : '' }}>QCM normaux</option>
            </select>

            <select id="coursFilter" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <option value="">Tous les cours</option>
                @foreach($cours as $coursItem)
                <option value="{{ $coursItem->id }}" {{ request('cours')==$coursItem->id ? 'selected' : '' }}>
                    {{ $coursItem->title }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Liste des QCM -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Titre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cours
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Questions
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Score minimal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($qcms as $qcm)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $qcm->title }}</div>
                            @if($qcm->description)
                            <div class="text-xs text-gray-500 truncate max-w-xs">{{ $qcm->description }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($qcm->cours)
                            <div class="text-sm text-gray-900">{{ $qcm->cours->title }}</div>
                            @else
                            <span class="text-xs text-gray-400">Indépendant</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $qcm->questions_count }} questions</div>
                            @if($qcm->time_limit_minutes)
                            <div class="text-xs text-gray-500">{{ $qcm->time_limit_minutes }} min</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $qcm->passing_score }}%</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($qcm->is_examen_blanc)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                Examen blanc
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                QCM normal
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($qcm->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Actif
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                Inactif
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.elearning.qcms.edit', $qcm->id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.elearning.qcms.show', $qcm->id) }}"
                                    class="text-green-600 hover:text-green-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.elearning.qcms.destroy', $qcm->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Supprimer ce QCM ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-file-alt text-4xl text-gray-300 mb-3"></i>
                                <p class="text-lg font-medium text-gray-400">Aucun QCM créé</p>
                                <p class="text-sm text-gray-400 mt-1">Commencez par créer votre premier QCM</p>
                                <a href="{{ route('admin.elearning.qcms.create') }}"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Créer un QCM
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Filtrage côté client pour les QCM
    document.addEventListener('DOMContentLoaded', function() {
        const typeFilter = document.getElementById('typeFilter');
        const coursFilter = document.getElementById('coursFilter');
        const tableRows = document.querySelectorAll('tbody tr');

        function filterRows() {
            const selectedType = typeFilter.value;
            const selectedCours = coursFilter.value;

            tableRows.forEach(row => {
                let showRow = true;

                // Filtre par type
                if (selectedType) {
                    const typeCell = row.querySelector('td:nth-child(5)');
                    if (typeCell) {
                        const isExamenBlanc = typeCell.textContent.includes('Examen blanc');
                        if (selectedType === 'examen' && !isExamenBlanc) {
                            showRow = false;
                        }
                        if (selectedType === 'qcm' && isExamenBlanc) {
                            showRow = false;
                        }
                    }
                }

                // Filtre par cours (simplifié côté client)
                if (selectedCours) {
                    const coursCell = row.querySelector('td:nth-child(2)');
                    // Cette logique nécessiterait un attribut data-cours-id sur chaque ligne
                    // Pour l'instant, on filtre côté serveur via l'URL
                }

                row.style.display = showRow ? '' : 'none';
            });
        }

        typeFilter.addEventListener('change', function() {
            if (coursFilter.value) {
                // Redirection avec filtres
                window.location.href = '{{ route("admin.elearning.qcms") }}?type=' + this.value + '&cours=' + coursFilter.value;
            } else {
                window.location.href = '{{ route("admin.elearning.qcms") }}?type=' + this.value;
            }
        });

        coursFilter.addEventListener('change', function() {
            if (typeFilter.value) {
                window.location.href = '{{ route("admin.elearning.qcms") }}?type=' + typeFilter.value + '&cours=' + this.value;
            } else {
                window.location.href = '{{ route("admin.elearning.qcms") }}?cours=' + this.value;
            }
        });
    });
</script>
@endsection
@endsection
