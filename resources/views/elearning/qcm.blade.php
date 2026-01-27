@extends('layouts.main')

@section('title', 'QCM - DJOK PRESTIGE')

@section('content')
<!-- Header -->
<div class="bg-black border-b border-gray-800">
    <div class="container px-4 mx-auto md:px-6">
        <div class="flex flex-col py-4 md:flex-row md:items-center md:justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <a href="{{ route('elearning.virtual-room') }}" class="flex items-center">
                    <img src="{{ asset('DP2.webp') }}" alt="DJOK PRESTIGE" class="h-10">
                    <div class="ml-4">
                        <h1 class="text-lg font-bold text-white">QCM</h1>
                        <p class="text-sm text-gray-400">{{ $qcm->title }}</p>
                    </div>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <div class="hidden text-right md:block">
                    <div class="text-sm font-medium text-white">{{ $acces->prenom }} {{ $acces->nom }}</div>
                    <div class="text-xs text-gray-400">Salle: {{ $acces->virtual_room_code }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Message d'alerte si déjà complété -->
@php
$progression = \App\Models\ElearningProgression::where('acces_id', $acces->id)
->where('qcm_id', $qcm->id)
->first();
@endphp

@if($progression && $progression->qcm_completed)
<div class="container px-4 mx-auto mt-4 md:px-6">
    <div class="p-4 rounded-lg" style="background: #1e3a8a; border: 1px solid #2563eb;">
        <div class="flex items-center">
            <i class="mr-3 fas fa-info-circle" style="color: #60a5fa;"></i>
            <div>
                <h4 class="mb-1 font-bold text-white">Note importante</h4>
                <p class="text-blue-100">
                    Vous avez déjà complété ce QCM. Votre précédent score était de
                    <strong>{{ $progression->qcm_score }}%</strong>
                    ({{ $progression->qcm_attempts }}/{{ $qcm->attempts_allowed == 0 ? '∞' : $qcm->attempts_allowed }}
                    tentatives).
                    @if($qcm->attempts_allowed > 0 && $progression->qcm_attempts >= $qcm->attempts_allowed)
                    <br><strong class="text-red-400">Ceci est votre dernière tentative autorisée.</strong>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endif

<!-- QCM Content -->
<div class="py-8" style="background: #000; min-height: calc(100vh - 200px);">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-4xl mx-auto">
            <!-- QCM Info -->
            <div class="p-6 mb-8 rounded-lg" style="background: #111; border: 1px solid #333;">
                <div class="flex flex-col justify-between mb-4 md:flex-row md:items-center">
                    <div class="flex-1 min-w-0 mr-4">
                        <h2 class="mb-2 text-xl font-bold text-white break-words">{{ $qcm->title }}</h2>
                        @if($qcm->description)
                        <p class="overflow-hidden text-gray-400 break-words whitespace-normal">
                            {{ $qcm->description }}
                        </p>
                        @endif
                    </div>
                    <div class="flex items-center flex-shrink-0 mt-4 space-x-4 md:mt-0">
                        <div class="text-center">
                            <div class="text-lg font-bold" style="color: #b89449;">{{ $qcm->questions_count }}</div>
                            <div class="text-xs text-gray-400">questions</div>
                        </div>
                        @if($qcm->is_examen_blanc)
                        <span class="px-3 py-1 text-sm font-semibold rounded-full whitespace-nowrap"
                            style="background: #7f1d1d; color: #fca5a5;">
                            Examen blanc
                        </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 pt-4 border-t border-gray-800 md:grid-cols-4">
                    <div class="text-center">
                        <div class="mb-1 text-sm font-medium text-gray-400">Note minimale</div>
                        <div class="text-lg font-bold" style="color: #60a5fa;">{{ $qcm->passing_score }}%</div>
                    </div>
                    @if($qcm->time_limit_minutes)
                    <div class="text-center">
                        <div class="mb-1 text-sm font-medium text-gray-400">Temps limite</div>
                        <div class="text-lg font-bold" style="color: #10b981;">{{ $qcm->time_limit_minutes }} min</div>
                    </div>
                    @endif
                    <div class="text-center">
                        <div class="mb-1 text-sm font-medium text-gray-400">Tentatives</div>
                        <div class="text-lg font-bold" style="color: #ddd;">
                            @if($progression)
                            {{ $progression->qcm_attempts }}/{{ $qcm->attempts_allowed == 0 ? '∞' :
                            $qcm->attempts_allowed }}
                            @else
                            0/{{ $qcm->attempts_allowed == 0 ? '∞' : $qcm->attempts_allowed }}
                            @endif
                        </div>
                    </div>
                    @if($qcm->allow_multiple_correct)
                    <div class="text-center">
                        <div class="mb-1 text-sm font-medium text-gray-400">Type de QCM</div>
                        <div class="text-lg font-bold" style="color: #a855f7;">
                            <i class="mr-1 fas fa-check-double"></i> Multi-réponses
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Instructions -->
            @if($qcm->is_examen_blanc)
            <div class="p-4 mb-6 rounded-lg" style="background: #1a1a1a; border: 1px solid #7f1d1d;">
                <div class="flex items-start">
                    <i class="mt-1 mr-3 fas fa-exclamation-triangle" style="color: #f56565;"></i>
                    <div class="flex-1 min-w-0">
                        <h3 class="mb-2 font-bold text-white break-words">Instructions pour l'examen blanc</h3>
                        <p class="text-sm text-gray-300 break-words whitespace-normal">
                            Cet examen blanc simule les conditions réelles de l'examen.
                            Vous avez <strong>{{ $qcm->time_limit_minutes ?? 'illimité' }} minutes</strong> pour
                            répondre
                            à toutes les questions. Une fois terminé, vous verrez votre score et pourrez
                            revoir vos réponses.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Instructions pour QCM multi-réponses -->
            @if($qcm->allow_multiple_correct)
            <div class="p-4 mb-6 rounded-lg" style="background: #1a1a1a; border: 1px solid #7c3aed;">
                <div class="flex items-start">
                    <i class="mt-1 mr-3 fas fa-info-circle" style="color: #a855f7;"></i>
                    <div class="flex-1 min-w-0">
                        <h3 class="mb-2 font-bold text-white break-words">Instructions pour le QCM multi-réponses</h3>
                        <p class="text-sm text-gray-300 break-words whitespace-normal">
                            <strong>Ce QCM autorise plusieurs réponses correctes par question.</strong>
                            Certaines questions peuvent avoir une ou plusieurs réponses correctes.
                            Cochez toutes les réponses qui vous semblent correctes pour chaque question.
                        </p>
                        <div class="mt-2 text-xs text-gray-400 break-words whitespace-normal">
                            <i class="mr-1 fas fa-check-circle"></i> Points complets si toutes les réponses correctes
                            sont cochées
                            <br>
                            <i class="mr-1 fas fa-exclamation-circle"></i> Points partiels selon le nombre de réponses
                            correctement identifiées
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Timer (si limité) -->
            @if($qcm->time_limit_minutes)
            <div class="mb-6">
                <div class="flex items-center justify-center">
                    <div class="p-4 text-center rounded-lg" style="background: #111; border: 1px solid #333;">
                        <div class="mb-1 text-sm font-medium text-gray-400">Temps restant</div>
                        <div id="timer" class="text-3xl font-bold" style="color: #b89449;">
                            {{ sprintf('%02d:00', $qcm->time_limit_minutes) }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- QCM Form -->
            <form id="qcmForm" action="{{ route('elearning.qcm.submit', $qcm->id) }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="qcm_id" value="{{ $qcm->id }}">
                <input type="hidden" name="allow_multiple_correct" value="{{ $qcm->allow_multiple_correct ? 1 : 0 }}">

                @php
                $questions = $qcm->questions ?? ($qcm->questions_data['questions'] ?? []);
                $questionsCount = count($questions);
                @endphp

                @if($questionsCount > 0)
                @foreach($questions as $index => $question)
                <div class="p-6 rounded-lg" style="background: #111; border: 1px solid #333;">
                    <div class="flex items-start mb-4">
                        <div class="flex-shrink-0 mr-4">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full"
                                style="background: #1e40af;">
                                <span class="text-sm font-bold text-white">{{ $index + 1 }}</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="mb-4 text-lg font-medium text-white break-words">{{ $question['text'] ??
                                'Question ' .
                                ($index + 1) }}</h3>

                            <div class="space-y-3">
                                @foreach($question['answers'] ?? [] as $letter => $answer)
                                <div class="flex items-center">
                                    @if($qcm->allow_multiple_correct)
                                    <input type="checkbox" id="question_{{ $index }}_{{ $letter }}"
                                        name="answers[{{ $question['id'] ?? $index }}][]" value="{{ $letter }}"
                                        class="w-4 h-4 rounded" style="accent-color: #b89449;">
                                    @else
                                    <input type="radio" id="question_{{ $index }}_{{ $letter }}"
                                        name="answers[{{ $question['id'] ?? $index }}]" value="{{ $letter }}"
                                        class="w-4 h-4" style="accent-color: #b89449;">
                                    @endif
                                    <label for="question_{{ $index }}_{{ $letter }}"
                                        class="flex-1 ml-3 text-gray-300 break-words whitespace-normal transition-colors cursor-pointer hover:text-white">
                                        <span class="mr-2 font-medium" style="color: #b89449;">{{ $letter }}.</span>
                                        {{ $answer }}
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            @if($qcm->allow_multiple_correct)
                            <div class="mt-4 text-sm text-gray-400 break-words whitespace-normal">
                                <i class="mr-1 fas fa-check-double"></i>
                                Sélectionnez toutes les réponses correctes
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="p-6 rounded-lg" style="background: #111; border: 1px solid #333;">
                    <div class="text-center">
                        <i class="mb-4 text-3xl text-yellow-500 fas fa-exclamation-triangle"></i>
                        <h3 class="mb-2 text-lg font-medium text-white">Aucune question disponible</h3>
                        <p class="text-gray-400">Ce QCM ne contient aucune question pour le moment.</p>
                    </div>
                </div>
                @endif

                <!-- Submit Button -->
                <div class="sticky z-10 bottom-6">
                    <div class="p-4 rounded-lg shadow-lg" style="background: #111; border: 1px solid #333;">
                        <div class="flex flex-col justify-between md:flex-row md:items-center">
                            <div class="flex-1 min-w-0 mb-4 mr-4 md:mb-0">
                                <p class="text-sm text-gray-400 break-words whitespace-normal">
                                    Vous avez répondu à <span id="answeredCount">0</span> sur <span
                                        id="totalQuestions">{{ $questionsCount }}</span>
                                    questions
                                </p>
                                <div class="flex items-center mt-1 space-x-4">
                                    @if($qcm->time_limit_minutes)
                                    <div class="flex items-center">
                                        <i class="mr-2 text-xs text-gray-500 fas fa-clock"></i>
                                        <span class="text-xs text-gray-500">Temps restant : </span>
                                        <span id="timerDisplay" class="ml-1 text-xs font-bold" style="color: #b89449;">
                                            {{ sprintf('%02d:00', $qcm->time_limit_minutes) }}
                                        </span>
                                    </div>
                                    @endif
                                    @if($qcm->allow_multiple_correct)
                                    <div class="flex items-center">
                                        <i class="mr-2 text-xs text-purple-500 fas fa-check-double"></i>
                                        <span class="text-xs text-gray-500">QCM multi-réponses</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-shrink-0 space-x-3">
                                <a href="{{ route('elearning.virtual-room') }}" onclick="return confirmNavigation()"
                                    class="px-6 py-3 font-medium transition-colors rounded whitespace-nowrap"
                                    style="background: #333; color: white;">
                                    <i class="mr-2 fas fa-arrow-left"></i> Retour
                                </a>
                                @if($questionsCount > 0)
                                <button type="button" id="submitQcmBtn"
                                    class="px-6 py-3 font-medium transition-colors rounded whitespace-nowrap"
                                    style="background: #b89449; color: black;">
                                    <i class="mr-2 fas fa-paper-plane"></i> Terminer le QCM
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Results Modal -->
<div id="resultsModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-2xl rounded-lg" style="background: #111; border: 1px solid #333;">
            <div class="p-6">
                <h2 class="mb-2 text-2xl font-bold text-white">Résultats du QCM</h2>
                <p class="mb-6 text-gray-400">{{ $qcm->title }}</p>

                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="p-4 text-center rounded-lg" style="background: #1a1a1a;">
                        <div class="mb-2 text-5xl font-bold" id="resultScore" style="color: #b89449;">0%</div>
                        <div class="text-sm text-gray-400">Votre score</div>
                    </div>
                    <div class="p-4 text-center rounded-lg" style="background: #1a1a1a;">
                        <div class="mb-2 text-5xl font-bold" style="color: #60a5fa;">{{ $qcm->passing_score }}%</div>
                        <div class="text-sm text-gray-400">Note minimale</div>
                    </div>
                </div>

                <!-- Détails des réponses -->
                <div class="mb-6" id="resultsDetails" style="display: none;">
                    <h3 class="mb-3 font-bold text-white">Détail des réponses</h3>
                    <div class="pr-2 space-y-3 overflow-y-auto max-h-64" id="questionsDetails">
                        <!-- Les détails seront ajoutés dynamiquement ici -->
                    </div>
                </div>

                <div class="p-4 mb-6 rounded-lg" id="resultStatus"
                    style="background: #064e3b; border: 1px solid #047857;">
                    <div class="flex items-center">
                        <i class="mr-3 fas fa-check-circle" style="color: #a7f3d0;"></i>
                        <div>
                            <h4 class="mb-1 font-bold text-white" id="statusTitle">Félicitations !</h4>
                            <p class="text-sm text-gray-200" id="statusMessage">Vous avez réussi le QCM.</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-6 space-x-3 border-t border-gray-800">
                    <button type="button" onclick="toggleResultsDetails()"
                        class="px-4 py-2 font-medium transition-colors rounded" style="background: #333; color: white;">
                        <i class="mr-2 fas fa-list"></i> Voir détails
                    </button>
                    <a href="{{ route('elearning.virtual-room') }}"
                        class="px-6 py-2 font-medium transition-colors rounded"
                        style="background: #b89449; color: black;">
                        <i class="mr-2 fas fa-home"></i> Retour à la salle
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup de confirmation personnalisé -->
<div id="reloadConfirmModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md rounded-lg" style="background: #111; border: 1px solid #333;">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <i class="mr-3 text-2xl fas fa-exclamation-triangle" style="color: #f59e0b;"></i>
                    <h3 class="text-xl font-bold text-white">Attention ! Fraude détectée</h3>
                </div>

                <div class="mb-6">
                    <p class="mb-3 text-gray-300">
                        Vous avez tenté de recharger la page pendant le QCM.
                    </p>
                    <p class="text-gray-300">
                        <strong>Cette action est considérée comme une tentative de fraude.</strong>
                    </p>
                    <div class="p-3 mt-4 rounded" style="background: #1a1a1a; border: 1px solid #7f1d1d;">
                        <p class="text-sm text-red-400">
                            <i class="mr-2 fas fa-exclamation-circle"></i>
                            Vous serez immédiatement redirigé vers la salle virtuelle.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end pt-4 space-x-3 border-t border-gray-800">
                    <button type="button" id="cancelReloadBtn" class="px-6 py-2 font-medium transition-colors rounded"
                        style="background: #333; color: white;">
                        Annuler
                    </button>
                    <button type="button" id="confirmReloadBtn" class="px-6 py-2 font-medium transition-colors rounded"
                        style="background: #dc2626; color: white;">
                        <i class="mr-2 fas fa-redo"></i> Confirmer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Variables globales pour le contrôle
    let formSubmitted = false;
    let hasAnswers = false;
    let timerInterval = null;
    let reloadConfirmed = false;
    let allowMultipleCorrect = {{ $qcm->allow_multiple_correct ? 'true' : 'false' }};
    let qcmId = {{ $qcm->id }};
    
    // Vérifier IMMÉDIATEMENT si on vient de confirmer un rechargement
    if (sessionStorage.getItem('qcm_reload_confirmed_' + qcmId)) {
        console.log('🚨 REDIRECTION POUR FRAUDE CONFIRMÉE');
        sessionStorage.removeItem('qcm_reload_confirmed_' + qcmId);
        window.location.href = '{{ route("elearning.virtual-room") }}';
        // Empêcher l'exécution du reste du script
        throw new Error('Redirection pour fraude confirmée');
    }

    // Fonction pour confirmer la navigation
    function confirmNavigation() {
        if (hasAnswers && !formSubmitted) {
            return confirm('Vous avez des réponses non sauvegardées. Êtes-vous sûr de vouloir quitter cette page ?');
        }
        return true;
    }

    // Fonction pour afficher la modal de confirmation de rechargement
    function showReloadConfirm() {
        if (hasAnswers && !formSubmitted && !reloadConfirmed) {
            const modal = document.getElementById('reloadConfirmModal');
            modal.classList.remove('hidden');

            // Bloquer le défilement
            document.body.style.overflow = 'hidden';

            return false;
        }
        return true;
    }

    // Fonction pour confirmer le rechargement - REDIRECTION IMMÉDIATE
    function confirmReloadAndProceed() {
        reloadConfirmed = true;
        const modal = document.getElementById('reloadConfirmModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';

        // Marquer dans sessionStorage que le rechargement a été confirmé
        sessionStorage.setItem('qcm_reload_confirmed_' + qcmId, 'true');
        
        // Rediriger IMMÉDIATEMENT vers la salle virtuelle
        console.log('🚨 CONFIRMATION DE RECHARGEMENT - REDIRECTION');
        window.location.href = '{{ route("elearning.virtual-room") }}';
    }

    // Fonction pour annuler le rechargement
    function cancelReload() {
        const modal = document.getElementById('reloadConfirmModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Fonction pour basculer l'affichage des détails
    function toggleResultsDetails() {
        const details = document.getElementById('resultsDetails');
        if (details.style.display === 'none' || details.style.display === '') {
            details.style.display = 'block';
        } else {
            details.style.display = 'none';
        }
    }

    // Gestion du beforeunload pour toutes les navigations
    window.addEventListener('beforeunload', function(e) {
        if (hasAnswers && !formSubmitted && !reloadConfirmed) {
            e.preventDefault();
            e.returnValue = 'Vous avez des réponses non sauvegardées. Êtes-vous sûr de vouloir quitter ?';
            return e.returnValue;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== PAGE QCM CHARGÉE ===');
        console.log('QCM ID:', qcmId);
        console.log('Mode multi-réponses:', allowMultipleCorrect);

        // Initialiser les boutons de la modal
        document.getElementById('cancelReloadBtn').addEventListener('click', cancelReload);
        document.getElementById('confirmReloadBtn').addEventListener('click', confirmReloadAndProceed);

        const form = document.getElementById('qcmForm');
        const submitBtn = document.getElementById('submitQcmBtn');
        const answeredCount = document.getElementById('answeredCount');
        const totalQuestionsElement = document.getElementById('totalQuestions');
        const totalQuestions = parseInt(totalQuestionsElement.textContent) || 0;

        // Sélectionner les inputs selon le type de QCM
        let inputSelector = allowMultipleCorrect
            ? 'input[type="checkbox"]'
            : 'input[type="radio"]';

        const questions = document.querySelectorAll(inputSelector);

        console.log('Questions trouvées:', totalQuestions);
        console.log('Type d\'inputs:', inputSelector);
        console.log('Timer activé:', {{ $qcm->time_limit_minutes ? 'true' : 'false' }});

        // Intercepter les touches de rechargement
        document.addEventListener('keydown', function(e) {
            // F5
            if (e.key === 'F5') {
                if (hasAnswers && !formSubmitted && !reloadConfirmed) {
                    e.preventDefault();
                    e.stopPropagation();
                    showReloadConfirm();
                    return false;
                }
            }

            // Ctrl+R ou Ctrl+Shift+R
            if ((e.ctrlKey && e.key === 'r') || (e.ctrlKey && e.key === 'R') ||
                (e.ctrlKey && e.shiftKey && e.key === 'R')) {
                if (hasAnswers && !formSubmitted && !reloadConfirmed) {
                    e.preventDefault();
                    e.stopPropagation();
                    showReloadConfirm();
                    return false;
                }
            }

            // Ctrl+F5
            if (e.ctrlKey && e.key === 'F5') {
                if (hasAnswers && !formSubmitted && !reloadConfirmed) {
                    e.preventDefault();
                    e.stopPropagation();
                    showReloadConfirm();
                    return false;
                }
            }

            // Cmd+R (Mac)
            if (e.metaKey && e.key === 'r') {
                if (hasAnswers && !formSubmitted && !reloadConfirmed) {
                    e.preventDefault();
                    e.stopPropagation();
                    showReloadConfirm();
                    return false;
                }
            }
        });

        // Timer
        @if($qcm->time_limit_minutes)
        let timeLeft = {{ $qcm->time_limit_minutes * 60 }};
        console.log('Timer initialisé avec', timeLeft, 'secondes');

        const timerDisplay = document.getElementById('timerDisplay');
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            if (timeLeft <= 0) {
                console.log('⏰ TEMPS ÉCOULÉ !');
                clearInterval(timerInterval);
                timerInterval = null;
                autoSubmitQcm();
                return;
            }

            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            const timeString = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timerDisplay) timerDisplay.textContent = timeString;
            if (timerElement) timerElement.textContent = timeString;

            if (minutes < 1) {
                if (timerElement) timerElement.style.color = '#ef4444';
                if (timerDisplay) timerDisplay.style.color = '#ef4444';
            } else if (minutes < 5) {
                if (timerElement) timerElement.style.color = '#f59e0b';
                if (timerDisplay) timerDisplay.style.color = '#f59e0b';
            } else {
                if (timerElement) timerElement.style.color = '#b89449';
                if (timerDisplay) timerDisplay.style.color = '#b89449';
            }
        }

        console.log('🚀 Démarrage du timer...');
        updateTimer();
        timerInterval = setInterval(updateTimer, 1000);
        console.log('✅ Timer démarré');
        @endif

        // Update answered count
        function updateAnsweredCount() {
            let answered;

            if (allowMultipleCorrect) {
                const questionGroups = {};
                document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                    const name = checkbox.name.match(/\[([^\]]+)\]/)[1];
                    questionGroups[name] = true;
                });
                answered = Object.keys(questionGroups).length;
            } else {
                answered = document.querySelectorAll('input[type="radio"]:checked').length;
            }

            answeredCount.textContent = answered;
            hasAnswers = answered > 0;

            console.log('Réponses:', answered, '/', totalQuestions, 'hasAnswers:', hasAnswers);

            if (answered === totalQuestions) {
                submitBtn.innerHTML = '<i class="mr-2 fas fa-check"></i> Toutes questions répondues - Terminer';
                submitBtn.style.background = '#10b981';
            } else {
                submitBtn.innerHTML = '<i class="mr-2 fas fa-paper-plane"></i> Terminer le QCM';
                submitBtn.style.background = '#b89449';
            }
        }

        questions.forEach(input => {
            input.addEventListener('change', updateAnsweredCount);
        });

        updateAnsweredCount();

        // Submit QCM
        if (submitBtn) {
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Bouton soumettre cliqué');

                const answered = parseInt(answeredCount.textContent);
                console.log('Questions avec réponses:', answered);

                if (answered === 0) {
                    alert('Veuillez répondre au moins à une question avant de soumettre.');
                    return;
                }

                if (answered < totalQuestions) {
                    if (!confirm(`Vous avez répondu à ${answered} sur ${totalQuestions} questions. Souhaitez-vous quand même soumettre vos réponses ?`)) {
                        return;
                    }
                }

                submitQcm();
            });
        }

        function autoSubmitQcm() {
            console.log('⏰ autoSubmitQcm appelé');
            if (!formSubmitted) {
                formSubmitted = true;
                submitQcm();
            }
        }

        function submitQcm() {
            console.log('📤 Début de la soumission');

            if (formSubmitted) {
                console.log('⚠️ Formulaire déjà soumis, annulation');
                return;
            }
            formSubmitted = true;

            const answers = {};

            if (allowMultipleCorrect) {
                document.querySelectorAll('input[type="checkbox"]:checked').forEach(checkbox => {
                    const name = checkbox.name.match(/\[([^\]]+)\]/)[1];
                    if (!answers[name]) {
                        answers[name] = [];
                    }
                    answers[name].push(checkbox.value);
                });
            } else {
                document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                    const name = radio.name.match(/\[([^\]]+)\]/)[1];
                    answers[name] = radio.value;
                });
            }

            console.log('Réponses collectées:', answers);

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="mr-2 fas fa-spinner fa-spin"></i> Calcul du score...';

            const csrfToken = document.querySelector('input[name="_token"]').value;
            console.log('CSRF Token:', csrfToken);

            const formData = new FormData();
            formData.append('_token', csrfToken);
            formData.append('qcm_id', qcmId);
            formData.append('allow_multiple_correct', allowMultipleCorrect ? 1 : 0);

            Object.entries(answers).forEach(([questionId, answer]) => {
                if (allowMultipleCorrect && Array.isArray(answer)) {
                    answer.forEach(val => {
                        formData.append(`answers[${questionId}][]`, val);
                    });
                } else {
                    formData.append(`answers[${questionId}]`, answer);
                }
            });

            console.log('Données à envoyer (FormData):');
            for (let [key, value] of formData.entries()) {
                console.log(key, ':', value);
            }

            const submitData = async () => {
                try {
                    console.log('🔄 Envoi des données au serveur...');
                    console.log('URL:', '{{ route("elearning.qcm.submit", $qcm->id) }}');

                    const response = await fetch('{{ route("elearning.qcm.submit", $qcm->id) }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    });

                    console.log('📨 Réponse reçue, status:', response.status);

                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('Texte d\'erreur du serveur:', errorText);

                        if (response.status === 422) {
                            try {
                                const errorData = JSON.parse(errorText);
                                throw new Error(`Erreur de validation: ${JSON.stringify(errorData.errors)}`);
                            } catch {
                                throw new Error(`Erreur serveur (${response.status}): ${errorText.substring(0, 200)}`);
                            }
                        } else if (response.status === 500) {
                            throw new Error(`Erreur serveur interne (500). Vérifiez les logs Laravel.`);
                        } else {
                            throw new Error(`Erreur HTTP ${response.status}: ${errorText.substring(0, 200)}`);
                        }
                    }

                    const data = await response.json();
                    console.log('✅ Données JSON reçues:', data);

                    if (data.success) {
                        showResults(data);
                    } else {
                        throw new Error(data.error || data.message || 'Erreur inconnue du serveur');
                    }

                } catch (error) {
                    console.error('❌ Erreur complète:', error);
                    console.error('Stack trace:', error.stack);

                    // Réactiver le bouton
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="mr-2 fas fa-paper-plane"></i> Terminer le QCM';
                    formSubmitted = false;

                    let errorMessage = 'Erreur lors de la soumission.\n\n';

                    if (error.message.includes('Erreur serveur interne (500)')) {
                        errorMessage += 'Le serveur a rencontré une erreur interne.\n';
                        errorMessage += 'Veuillez vérifier les logs Laravel (storage/logs/laravel.log).\n\n';
                        errorMessage += 'Détails techniques: ' + error.message;
                    } else if (error.message.includes('Erreur de validation')) {
                        errorMessage += 'Il y a un problème avec les données envoyées.\n';
                        errorMessage += 'Détails: ' + error.message;
                    } else if (error.message.includes('Failed to fetch')) {
                        errorMessage += 'Impossible de se connecter au serveur.\n';
                        errorMessage += 'Vérifiez votre connexion internet.';
                    } else {
                        errorMessage += 'Détails: ' + error.message;
                    }

                    alert(errorMessage);

                    console.log('=== DEBUG INFO ===');
                    console.log('URL complète:', window.location.origin + '/elearning/qcm/' + qcmId + '/submit');
                    console.log('Méthode: POST');
                    console.log('Headers envoyés:', {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken ? 'présent' : 'absent'
                    });
                    console.log('FormData:', Array.from(formData.entries()));
                }
            };

            submitData();
        }

        function showResults(data) {
            console.log('🎯 Affichage des résultats:', data);

            const score = Math.round(data.score);
            const passed = score >= {{ $qcm->passing_score }};

            document.getElementById('resultScore').textContent = score + '%';

            const resultStatus = document.getElementById('resultStatus');
            const statusTitle = document.getElementById('statusTitle');
            const statusMessage = document.getElementById('statusMessage');

            if (passed) {
                resultStatus.style.background = '#064e3b';
                resultStatus.style.borderColor = '#047857';
                statusTitle.textContent = 'Félicitations !';
                statusMessage.textContent = `Vous avez réussi le QCM avec ${score}%.`;
            } else {
                resultStatus.style.background = '#7f1d1d';
                resultStatus.style.borderColor = '#ef4444';
                statusTitle.textContent = 'Non réussite';
                statusMessage.textContent = `Votre score de ${score}% est inférieur à la note minimale requise ({{ $qcm->passing_score }}%).`;
            }

            if (data.details) {
                const detailsContainer = document.getElementById('questionsDetails');
                detailsContainer.innerHTML = '';

                data.details.forEach((detail, index) => {
                    const detailDiv = document.createElement('div');
                    detailDiv.className = 'p-3 rounded';
                    detailDiv.style.background = detail.correct ? '#064e3b' : '#7f1d1d';
                    detailDiv.style.border = detail.correct ? '1px solid #047857' : '1px solid #ef4444';

                    const icon = detail.correct ?
                        '<i class="mr-2 fas fa-check-circle" style="color: #a7f3d0;"></i>' :
                        '<i class="mr-2 fas fa-times-circle" style="color: #fca5a5;"></i>';

                    const points = detail.points !== undefined ?
                        ` (${detail.points}/${detail.maxPoints} points)` : '';

                    detailDiv.innerHTML = `
                        <div class="flex items-start">
                            ${icon}
                            <div class="flex-1">
                                <div class="mb-1 font-medium text-white">Question ${index + 1}: ${detail.correct ? 'Correcte' : 'Incorrecte'}${points}</div>
                                ${detail.feedback ? `<div class="text-sm text-gray-300">${detail.feedback}</div>` : ''}
                            </div>
                        </div>
                    `;

                    detailsContainer.appendChild(detailDiv);
                });
            }

            document.getElementById('resultsModal').classList.remove('hidden');

            @if($qcm->time_limit_minutes)
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
            }
            @endif

            questions.forEach(input => {
                input.disabled = true;
            });

            hasAnswers = false;
            reloadConfirmed = true;
            
            // Nettoyer le sessionStorage après soumission réussie
            sessionStorage.removeItem('qcm_reload_confirmed_' + qcmId);
        }

        // Empêcher la soumission du formulaire avec Enter
        form.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });

        console.log('=== SCRIPT QCM COMPLÈTEMENT CHARGÉ ===');
    });
</script>
@endsection