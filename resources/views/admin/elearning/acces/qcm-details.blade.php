@extends('layouts.admin')

@section('title', 'Détails QCM - ' . ($progression->qcm->title ?? 'QCM') . ' | Admin DJOK PRESTIGE')

@section('content')
<div class="container px-4 py-8 mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.elearning.acces.show', $acces->id) }}" class="text-blue-600 hover:text-blue-800">
            <i class="mr-2 fas fa-arrow-left"></i> Retour aux détails de l'accès
        </a>
    </div>

    <!-- Header -->
    <div class="p-6 mb-8 bg-white border border-gray-200 shadow-sm rounded-xl">
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Détails du QCM</h1>
                <h2 class="mt-1 text-lg font-semibold text-gray-700">{{ $progression->qcm->title ?? 'QCM non défini' }}
                </h2>
                <div class="flex items-center mt-3 space-x-4">
                    <div class="flex items-center">
                        <span class="mr-2 text-gray-600">Par:</span>
                        <span class="font-medium">{{ $acces->prenom }} {{ $acces->nom }}</span>
                    </div>
                    <div class="text-gray-600">{{ $acces->email }}</div>
                    @if($progression->qcm && $progression->qcm->is_examen_blanc)
                    <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
                        Examen blanc
                    </span>
                    @endif
                </div>
            </div>

            <div class="text-right">
                <div class="text-3xl font-bold {{ ($stats['passed'] ?? false) ? 'text-green-600' : 'text-red-600' }}">
                    {{ $stats['score'] ?? 0 }}%
                </div>
                <div class="mt-1 text-sm text-gray-500">
                    Score minimum: {{ $stats['passing_score'] ?? 70 }}%
                </div>
                <div class="mt-2">
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{
                        ($stats['passed'] ?? false) ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    }}">
                        {{ ($stats['passed'] ?? false) ? 'Réussi' : 'Échoué' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">
        <div class="p-6 text-center bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_questions'] ?? 0 }}</div>
            <div class="mt-1 text-sm text-gray-600">Questions totales</div>
        </div>

        @php
        $correctCount = count(array_filter($questions, fn($q) => $q['is_correct'] ?? false));
        $incorrectCount = ($stats['total_questions'] ?? 0) - $correctCount;
        @endphp

        <div class="p-6 text-center bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="text-2xl font-bold text-green-600">{{ $correctCount }}</div>
            <div class="mt-1 text-sm text-gray-600">Réponses correctes</div>
        </div>

        <div class="p-6 text-center bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="text-2xl font-bold text-red-600">{{ $incorrectCount }}</div>
            <div class="mt-1 text-sm text-gray-600">Réponses incorrectes</div>
        </div>

        <div class="p-6 text-center bg-white border border-gray-200 shadow-sm rounded-xl">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['attempt_number'] ?? 0 }}</div>
            <div class="mt-1 text-sm text-gray-600">Tentative(s)</div>
        </div>
    </div>

    <!-- Informations de la tentative -->
    <div class="p-6 mb-8 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="mb-4 text-lg font-semibold text-gray-900">Informations de la tentative</h3>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
                <div class="mb-1 text-sm text-gray-500">Date de complétion</div>
                <div class="font-medium">
                    {{ isset($stats['completed_at']) && $stats['completed_at'] ? $stats['completed_at']->format('d/m/Y
                    H:i') : 'Date inconnue' }}
                </div>
            </div>
            <div>
                <div class="mb-1 text-sm text-gray-500">Type de QCM</div>
                <div class="font-medium">
                    {{ ($stats['allow_multiple_correct'] ?? false) ? 'Multiples réponses' : 'Réponse unique' }}
                </div>
            </div>
            <div>
                <div class="mb-1 text-sm text-gray-500">Statut</div>
                <div class="font-medium {{ ($stats['passed'] ?? false) ? 'text-green-600' : 'text-red-600' }}">
                    {{ ($stats['passed'] ?? false) ? 'Réussi' : 'Échoué' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des questions avec réponses -->
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl">
        <h3 class="mb-6 text-lg font-semibold text-gray-900">Détails des questions et réponses</h3>

        @if(count($questions) === 0)
        <div class="py-8 text-center">
            <i class="mb-4 text-4xl text-gray-400 fas fa-info-circle"></i>
            <p class="text-gray-600">Aucune donnée de réponse disponible pour ce QCM.</p>
            <p class="mt-2 text-sm text-gray-500">Les réponses détaillées n'ont pas été enregistrées pour cette
                tentative.</p>
        </div>
        @else
        <div class="space-y-6">
            @foreach($questions as $question)
            <div class="p-4 transition-colors border border-gray-200 rounded-lg hover:bg-gray-50">
                <div class="flex items-start mb-4">
                    <div class="flex-shrink-0 mt-1 mr-3">
                        @if($question['is_correct'] ?? false)
                        <i class="text-lg text-green-500 fas fa-check-circle"></i>
                        @else
                        <i class="text-lg text-red-500 fas fa-times-circle"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-start justify-between">
                            <h4 class="font-medium text-gray-900">
                                Question {{ $question['question_number'] ?? ($loop->index + 1) }}
                            </h4>
                            <span
                                class="text-sm font-medium {{ ($question['is_correct'] ?? false) ? 'text-green-600' : 'text-red-600' }}">
                                {{ $question['points'] ?? 0 }}/{{ $question['max_points'] ?? 1 }} point(s)
                            </span>
                        </div>
                        <p class="mt-2 text-gray-700">{{ $question['question'] ?? 'Question sans texte' }}</p>
                    </div>
                </div>

                <!-- Options -->
                @if(!empty($question['options']) && is_array($question['options']))
                <div class="ml-9">
                    <div class="mb-2 text-sm text-gray-500">Options disponibles:</div>
                    <div class="grid grid-cols-1 gap-2 md:grid-cols-2">
                        @foreach($question['options'] as $option)
                        <div class="flex items-center p-2 rounded border {{
                            ($option['is_correct'] ?? false) ? 'border-green-200 bg-green-50' : 
                            (($option['is_selected'] ?? false) && !($option['is_correct'] ?? false) ? 'border-red-200 bg-red-50' : 'border-gray-200')
                        }}">
                            <div class="mr-3">
                                @if(($option['is_correct'] ?? false) && ($option['is_selected'] ?? false))
                                <i class="text-green-500 fas fa-check-circle"></i>
                                @elseif(($option['is_correct'] ?? false) && !($option['is_selected'] ?? false))
                                <i class="text-green-500 fas fa-check"></i>
                                @elseif(!($option['is_correct'] ?? false) && ($option['is_selected'] ?? false))
                                <i class="text-red-500 fas fa-times"></i>
                                @else
                                <i class="text-gray-300 fas fa-circle"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div
                                    class="font-medium {{ ($option['is_selected'] ?? false) ? 'text-gray-900' : 'text-gray-600' }}">
                                    {{ $option['value'] ?? 'Option sans valeur' }}
                                </div>
                                @if($option['is_selected'] ?? false)
                                <div class="text-xs mt-1 {{
                                    ($option['is_correct'] ?? false) ? 'text-green-600' : 'text-red-600'
                                }}">
                                    {{ ($option['is_correct'] ?? false) ? 'Correcte' : 'Incorrecte' }}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Réponses de l'utilisateur -->
                <div class="grid grid-cols-1 gap-4 mt-4 ml-9 md:grid-cols-2">
                    <div>
                        <div class="mb-1 text-sm text-gray-500">Réponse de l'utilisateur:</div>
                        <div class="p-2 font-medium bg-gray-100 rounded">
                            @if(is_array($question['user_answer'] ?? null))
                            {{ implode(', ', $question['user_answer']) }}
                            @else
                            {{ $question['user_answer'] ?? 'Non répondue' }}
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="mb-1 text-sm text-gray-500">Réponse correcte:</div>
                        <div class="p-2 font-medium rounded bg-green-50">
                            @if(is_array($question['correct_answer'] ?? null))
                            {{ implode(', ', $question['correct_answer']) }}
                            @else
                            {{ $question['correct_answer'] ?? 'Non définie' }}
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Explication -->
                @if(!empty($question['explanation']))
                <div class="mt-4 ml-9">
                    <div class="mb-1 text-sm text-gray-500">Explication:</div>
                    <div class="p-3 text-gray-700 rounded bg-blue-50">
                        {{ $question['explanation'] }}
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection