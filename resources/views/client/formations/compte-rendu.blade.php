{{-- resources/views/client/formations/compte-rendu.blade.php --}}
@extends('layouts.client')

@section('title', 'Compte-rendu de formation')
@section('page-title', 'Compte-rendu : ' . ($userFormation->formation->title ?? 'Formation'))
@section('page-description', 'Détails et suivi de votre formation')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.index') }}" class="text-gray-500 hover:text-djok-yellow">
            Formations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.show', $userFormation->id) }}"
            class="text-gray-500 hover:text-djok-yellow">
            {{ Str::limit($userFormation->formation->title ?? 'Formation', 30) }}
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Compte-rendu</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- En-tête --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Compte-rendu de formation</h2>
                <p class="text-gray-600">{{ $userFormation->formation->title ?? 'Formation' }}</p>
            </div>
            <div class="mt-4 md:mt-0">
                @php
                $statusColors = [
                'active' => 'bg-green-100 text-green-800',
                'completed' => 'bg-blue-100 text-blue-800',
                'pending' => 'bg-yellow-100 text-yellow-800',
                'cancelled' => 'bg-red-100 text-red-800',
                ];
                $colorClass = $statusColors[$userFormation->status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $colorClass }}">
                    {{ ucfirst($userFormation->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Informations générales --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-info-circle text-djok-yellow mr-2"></i>
                Informations formation
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Type de formation</p>
                    <p class="font-medium text-gray-900">
                        {{ $userFormation->formation->type ?? 'Non spécifié' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Durée</p>
                    <p class="font-medium text-gray-900">
                        {{ $userFormation->formation->duration ?? 'Non spécifié' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Niveau</p>
                    <p class="font-medium text-gray-900">
                        {{ $userFormation->formation->level ?? 'Non spécifié' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date d'inscription</p>
                    <p class="font-medium text-gray-900">
                        {{ $userFormation->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-chart-line text-djok-yellow mr-2"></i>
                Progression
            </h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Progression globale</span>
                        <span class="text-sm font-medium text-gray-900">{{ $userFormation->progress ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-djok-yellow h-2 rounded-full"
                            style="width: {{ $userFormation->progress ?? 0 }}%"></div>
                    </div>
                </div>

                @if($userFormation->access_start && $userFormation->access_end)
                <div class="pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500 mb-2">Période d'accès</p>
                    <p class="text-sm text-gray-900">
                        Du {{ $userFormation->access_start->format('d/m/Y') }}
                        au {{ $userFormation->access_end->format('d/m/Y') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        @php
                        $now = now();
                        $start = $userFormation->access_start;
                        $end = $userFormation->access_end;

                        if ($now < $start) { $daysLeft=$start->diffInDays($now);
                            $message = "Début dans $daysLeft jour(s)";
                            $color = 'text-yellow-600';
                            } elseif ($now > $end) {
                            $daysAgo = $now->diffInDays($end);
                            $message = "Terminé il y a $daysAgo jour(s)";
                            $color = 'text-red-600';
                            } else {
                            $totalDays = $start->diffInDays($end);
                            $daysPassed = $start->diffInDays($now);
                            $percentage = ($daysPassed / $totalDays) * 100;
                            $message = round($percentage) . "% du temps écoulé";
                            $color = 'text-green-600';
                            }
                            @endphp
                            <span class="{{ $color }} font-medium">{{ $message }}</span>
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modules et progression détaillée --}}
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <i class="fas fa-list-ol text-djok-yellow mr-2"></i>
                Modules de formation
            </h3>

            @if($userFormation->formation && $userFormation->formation->modules &&
            count($userFormation->formation->modules) > 0)
            <div class="space-y-4">
                @foreach($userFormation->formation->modules as $index => $module)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <div
                                class="h-8 w-8 bg-djok-yellow text-white rounded-full flex items-center justify-center mr-3">
                                {{ $index + 1 }}
                            </div>
                            <h4 class="font-medium text-gray-900">{{ $module['title'] ?? 'Module ' . ($index + 1) }}
                            </h4>
                        </div>
                        <div class="flex items-center">
                            @php
                            $moduleProgress = $userFormation->module_progress[$module['id'] ?? $index] ?? 0;
                            $progressColor = $moduleProgress == 100 ? 'text-green-600' : ($moduleProgress > 0 ?
                            'text-yellow-600' : 'text-gray-600');
                            @endphp
                            <span class="text-sm font-medium {{ $progressColor }} mr-2">
                                {{ $moduleProgress }}%
                            </span>
                            @if($moduleProgress == 100)
                            <i class="fas fa-check-circle text-green-500"></i>
                            @elseif($moduleProgress > 0)
                            <i class="fas fa-spinner text-yellow-500 animate-spin"></i>
                            @else
                            <i class="far fa-circle text-gray-300"></i>
                            @endif
                        </div>
                    </div>

                    @if(!empty($module['description']))
                    <p class="text-sm text-gray-600 mb-3">{{ $module['description'] }}</p>
                    @endif

                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <div>
                            @if(!empty($module['duration']))
                            <i class="far fa-clock mr-1"></i> {{ $module['duration'] }}
                            @endif
                        </div>
                        <div>
                            @if($moduleProgress > 0)
                            <span class="{{ $moduleProgress == 100 ? 'text-green-600' : 'text-yellow-600' }}">
                                {{ $moduleProgress == 100 ? 'Terminé' : 'En cours' }}
                            </span>
                            @else
                            <span class="text-gray-400">Non commencé</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-book-open text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500">Aucun module disponible pour cette formation</p>
                <p class="text-sm text-gray-400 mt-1">Les modules seront ajoutés prochainement</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Évaluations et résultats --}}
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <i class="fas fa-chart-bar text-djok-yellow mr-2"></i>
                Évaluations et résultats
            </h3>

            @if($userFormation->scores && count($userFormation->scores) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Évaluation
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Score
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($userFormation->scores as $score)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $score['test_name'] ?? 'Évaluation ' . $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                {{ isset($score['date']) ? \Carbon\Carbon::parse($score['date'])->format('d/m/Y') :
                                'N/A' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-900 mr-2">
                                        {{ $score['score'] ?? 0 }}/{{ $score['max_score'] ?? 100 }}
                                    </span>
                                    @php
                                    $percentage = isset($score['score'], $score['max_score']) && $score['max_score'] > 0
                                    ? ($score['score'] / $score['max_score']) * 100
                                    : 0;

                                    if ($percentage >= 80) {
                                    $scoreColor = 'text-green-600';
                                    $scoreIcon = 'fa-check-circle';
                                    } elseif ($percentage >= 50) {
                                    $scoreColor = 'text-yellow-600';
                                    $scoreIcon = 'fa-exclamation-circle';
                                    } else {
                                    $scoreColor = 'text-red-600';
                                    $scoreIcon = 'fa-times-circle';
                                    }
                                    @endphp
                                    <i class="fas {{ $scoreIcon }} {{ $scoreColor }}"></i>
                                </div>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @php
                                if ($percentage >= 80) {
                                $statusColor = 'bg-green-100 text-green-800';
                                $statusText = 'Réussi';
                                } elseif ($percentage >= 50) {
                                $statusColor = 'bg-yellow-100 text-yellow-800';
                                $statusText = 'Moyen';
                                } else {
                                $statusColor = 'bg-red-100 text-red-800';
                                $statusText = 'Échoué';
                                }
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($userFormation->average_score)
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-700">Score moyen</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $userFormation->average_score }}/100</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-700">Classement</p>
                        <p class="text-lg font-medium text-blue-900">
                            @if($userFormation->average_score >= 80)
                            Excellent
                            @elseif($userFormation->average_score >= 60)
                            Bon
                            @elseif($userFormation->average_score >= 40)
                            Satisfaisant
                            @else
                            À améliorer
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @else
            <div class="text-center py-8">
                <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-clipboard-check text-gray-400 text-2xl"></i>
                </div>
                <p class="text-gray-500">Aucune évaluation disponible</p>
                <p class="text-sm text-gray-400 mt-1">Les évaluations seront disponibles au cours de la formation</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Notes et commentaires --}}
    @if($userFormation->notes && count($userFormation->notes) > 0)
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <i class="fas fa-sticky-note text-djok-yellow mr-2"></i>
                Notes et commentaires
            </h3>

            <div class="space-y-4">
                @foreach($userFormation->notes as $note)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $note['title'] ?? 'Note ' . $loop->iteration }}
                            </p>
                            @if(isset($note['date']))
                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note['date'])->format('d/m/Y H:i') }}
                            </p>
                            @endif
                        </div>
                        @if(isset($note['type']))
                        <span
                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                            {{ $note['type'] == 'formateur' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $note['type'] == 'formateur' ? 'Formateur' : 'Personnel' }}
                        </span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-700">{{ $note['content'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- Actions --}}
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <a href="{{ route('client.formations.show', $userFormation->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la formation
                </a>

                <a href="{{ route('client.formations.acceder', $userFormation->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-play mr-2"></i> Reprendre la formation
                </a>
            </div>

            <div class="flex items-center space-x-3">
                @if($userFormation->status == 'completed')
                <a href="#"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-download mr-2"></i> Télécharger certificat
                </a>
                @endif

                <a href="{{ route('client.formations.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-list mr-2"></i> Toutes mes formations
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-djok-yellow {
        background-color: #F8B400;
    }

    .text-djok-yellow {
        color: #F8B400;
    }

    .hover\:bg-yellow-700:hover {
        background-color: #e69c00;
    }

    .focus\:ring-djok-yellow:focus {
        --tw-ring-color: rgba(248, 180, 0, 0.5);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des barres de progression
        const progressBars = document.querySelectorAll('[style*="width:"]');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.transition = 'width 1s ease-in-out';
                bar.style.width = width;
            }, 300);
        });

        // Tooltips pour les scores
        const scoreElements = document.querySelectorAll('.fa-check-circle, .fa-exclamation-circle, .fa-times-circle');
        scoreElements.forEach(element => {
            const parent = element.closest('td');
            if (parent) {
                const scoreText = parent.querySelector('.text-gray-900')?.textContent || '';
                element.title = scoreText;
            }
        });
    });
</script>
@endpush
