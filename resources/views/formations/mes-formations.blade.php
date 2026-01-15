@extends('layouts.main')

@section('title', __('mes-formations.mes_formations.title'))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- En-tête avec statistiques -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                {{ __('mes-formations.mes_formations.page_title') }}
            </h1>
            <p class="text-gray-600 mb-6">Suivez votre progression et accédez à vos formations</p>

            <!-- Statistiques -->
            @if($userFormations->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-blue-600">{{ $userFormations->count() }}</div>
                    <div class="text-sm text-gray-600">{{
                        __('mes-formations.mes_formations.statistiques.total_formations') }}</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-green-600">{{ $formationsEnCours }}</div>
                    <div class="text-sm text-gray-600">{{ __('mes-formations.mes_formations.statistiques.en_cours') }}
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-purple-600">{{ $formationsTerminees }}</div>
                    <div class="text-sm text-gray-600">{{ __('mes-formations.mes_formations.statistiques.terminees') }}
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="text-2xl font-bold text-yellow-600">{{ $progressionMoyenne }}%</div>
                    <div class="text-sm text-gray-600">{{
                        __('mes-formations.mes_formations.statistiques.progression_moyenne') }}</div>
                </div>
            </div>
            @endif
        </div>

        <!-- Filtres -->
        @if($userFormations->count() > 0)
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex space-x-2 overflow-x-auto pb-2">
                <button data-filter="all"
                    class="filter-btn active px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">
                    {{ __('mes-formations.mes_formations.filtres.toutes') }}
                </button>
                <button data-filter="en_cours"
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300">
                    {{ __('mes-formations.mes_formations.filtres.en_cours') }}
                </button>
                <button data-filter="terminees"
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300">
                    {{ __('mes-formations.mes_formations.filtres.terminees') }}
                </button>
                <button data-filter="expirees"
                    class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300">
                    {{ __('mes-formations.mes_formations.filtres.expirees') }}
                </button>
            </div>
            <div class="relative">
                <input type="text" id="search-formations"
                    placeholder="{{ __('mes-formations.mes_formations.filtres.rechercher') }}"
                    class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        @endif

        @if($userFormations->count() > 0)
        <!-- Grille des formations -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8" id="formations-grid">
            @foreach($userFormations as $userFormation)
            @php
            // Déterminer le statut de la formation
            $now = now();
            $isExpired = $userFormation->access_end->isPast();
            $isAlmostExpired = $userFormation->access_end->diffInDays($now) <= 7 && !$isExpired;
                $isCompleted=$userFormation->progress >= 100;

                $statusClass = 'bg-gray-100 text-gray-800';
                $statusText = __('mes-formations.mes_formations.statut.en_cours');

                if ($isExpired) {
                $statusClass = 'bg-red-100 text-red-800';
                $statusText = __('mes-formations.mes_formations.statut.expire');
                } elseif ($isAlmostExpired) {
                $statusClass = 'bg-yellow-100 text-yellow-800';
                $statusText = __('mes-formations.mes_formations.statut.bientot_expire');
                } elseif ($isCompleted) {
                $statusClass = 'bg-green-100 text-green-800';
                $statusText = __('mes-formations.mes_formations.statut.termine');
                }

                // Classes pour le filtre
                $filterClasses = 'formation-card';
                if ($isExpired) $filterClasses .= ' expired';
                if ($isCompleted) $filterClasses .= ' completed';
                if (!$isExpired && !$isCompleted) $filterClasses .= ' in-progress';
                @endphp

                <div
                    class="{{ $filterClasses }} bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                    <!-- En-tête de la carte -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $userFormation->formation->title }}</h3>
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                                @if($isAlmostExpired && !$isExpired)
                                <span class="px-2 py-1 bg-yellow-50 text-yellow-700 text-xs rounded-lg">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $userFormation->access_end->diffForHumans() }}
                                </span>
                                @endif
                            </div>
                        </div>
                        @if($isCompleted)
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-green-600"></i>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <p class="text-gray-600 mb-4 text-sm">
                        {{ Str::limit($userFormation->formation->description,
                        __('mes-formations.mes_formations.formations_achetees.description_limit')) }}
                    </p>

                    <!-- Barre de progression -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-1">
                            <div class="text-sm text-gray-500">
                                {{ __('mes-formations.mes_formations.formations_achetees.progression') }}
                            </div>
                            <span class="text-sm font-medium">{{ $userFormation->progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-yellow-600 h-2.5 rounded-full transition-all duration-500"
                                style="width: {{ $userFormation->progress }}%"></div>
                        </div>
                        @if($userFormation->progress >= 100)
                        <div class="mt-1 text-xs text-green-600 font-medium">
                            {{ __('mes-formations.mes_formations.messages.felicitations') }}
                        </div>
                        @elseif($userFormation->progress >= 70)
                        <div class="mt-1 text-xs text-blue-600 font-medium">
                            {{ __('mes-formations.mes_formations.messages.continuer') }}
                        </div>
                        @endif
                    </div>

                    <!-- Dates d'accès -->
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div>
                            <i class="fas fa-play-circle mr-1"></i>
                            {{ __('mes-formations.mes_formations.formations_achetees.debut') }}: {{
                            $userFormation->access_start->format('d/m/Y') }}
                        </div>
                        <div>
                            <i class="fas fa-flag-checkered mr-1"></i>
                            {{ __('mes-formations.mes_formations.formations_achetees.fin') }}: {{
                            $userFormation->access_end->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- Statistiques de progression -->
                    <div class="grid grid-cols-3 gap-2 mb-4">
                        <div class="text-center">
                            <div class="text-lg font-bold text-blue-600">{{ $userFormation->cours_completes ?? 0 }}
                            </div>
                            <div class="text-xs text-gray-600">{{
                                __('mes-formations.mes_formations.progressions.cours_completes') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-green-600">{{ $userFormation->quiz_reussis ?? 0 }}</div>
                            <div class="text-xs text-gray-600">{{
                                __('mes-formations.mes_formations.progressions.quiz_reussis') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-lg font-bold text-purple-600">{{ $userFormation->temps_consacre ?? '0h' }}
                            </div>
                            <div class="text-xs text-gray-600">{{
                                __('mes-formations.mes_formations.progressions.temps_consacre') }}</div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-2">
                        @if(!$isExpired)
                        <a href="{{ route('formations.acceder', $userFormation->formation_id) }}"
                            class="block w-full text-center py-2.5 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-medium">
                            @if($isCompleted)
                            <i class="fas fa-redo mr-2"></i>{{
                            __('mes-formations.mes_formations.actions.reprendre_formation') }}
                            @else
                            <i class="fas fa-play mr-2"></i>{{
                            __('mes-formations.mes_formations.formations_achetees.acceder') }}
                            @endif
                        </a>
                        @endif

                        <div class="flex space-x-2">
                            @if($isCompleted)
                            <a href="{{ route('formations.certificat', $userFormation->id) }}"
                                class="flex-1 text-center py-2 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition text-sm font-medium">
                                <i class="fas fa-download mr-1"></i>{{
                                __('mes-formations.mes_formations.actions.telecharger_certificat') }}
                            </a>
                            @endif

                            @if($isAlmostExpired && !$isExpired)
                            <button onclick="renouvelerAcces({{ $userFormation->id }})"
                                class="flex-1 text-center py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-sm font-medium">
                                <i class="fas fa-sync mr-1"></i>{{
                                __('mes-formations.mes_formations.actions.renouveler_acces') }}
                            </button>
                            @endif

                            <a href="{{ route('formation.show', $userFormation->formation_id) }}"
                                class="flex-1 text-center py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                                <i class="fas fa-info-circle mr-1"></i>{{
                                __('mes-formations.mes_formations.actions.voir_details') }}
                            </a>
                        </div>
                    </div>

                    <!-- Badges -->
                    @if($userFormation->badges && count($userFormation->badges) > 0)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="text-xs text-gray-500 mb-2">{{ __('mes-formations.mes_formations.badges.excellence')
                            }}</div>
                        <div class="flex flex-wrap gap-1">
                            @foreach($userFormation->badges as $badge)
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded-lg">
                                <i class="fas fa-award mr-1"></i>{{ $badge }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
        </div>

        <!-- Pagination -->
        @if($userFormations->hasPages())
        <div class="mt-8">
            {{ $userFormations->links() }}
        </div>
        @endif

        @else
        <!-- Aucune formation -->
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <i
                    class="{{ __('mes-formations.mes_formations.formations_achetees.icon_aucune') }} text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">
                {{ __('mes-formations.mes_formations.formations_achetees.aucune_formation') }}
            </h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">
                {{ __('mes-formations.mes_formations.formations_achetees.message_aucune') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('formation') }}"
                    class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition">
                    <i class="fas fa-book-open mr-2"></i>
                    {{ __('mes-formations.mes_formations.formations_achetees.decouvrir') }}
                </a>
                <a href="{{ route('user.profile') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-user mr-2"></i>
                    Voir mon profil
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filtrage des formations
        const filterButtons = document.querySelectorAll('.filter-btn');
        const formationCards = document.querySelectorAll('.formation-card');
        const searchInput = document.getElementById('search-formations');

        // Gestion des filtres
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Retirer la classe active de tous les boutons
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                });

                // Ajouter la classe active au bouton cliqué
                this.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-gray-300');
                this.classList.add('active', 'bg-blue-600', 'text-white');

                const filter = this.getAttribute('data-filter');

                formationCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'block';
                    } else {
                        if (card.classList.contains(filter.replace('_', '-'))) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }

                    // Animation d'apparition
                    setTimeout(() => {
                        if (card.style.display === 'block') {
                            card.style.opacity = '0';
                            card.style.transform = 'translateY(10px)';
                            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';

                            setTimeout(() => {
                                card.style.opacity = '1';
                                card.style.transform = 'translateY(0)';
                            }, 50);
                        }
                    }, 10);
                });
            });
        });

        // Recherche de formations
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            formationCards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const description = card.querySelector('p').textContent.toLowerCase();

                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    card.style.display = 'block';

                    // Animation
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(10px)';
                    card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';

                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Animation d'entrée des cartes
        formationCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });

        // Fonction pour renouveler l'accès
        window.renouvelerAcces = function(formationId) {
            if (confirm('{{ __("mes-formations.mes_formations.notifications.renouveler") }}')) {
                // Afficher le loading
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Traitement...';
                button.disabled = true;

                // Simuler une requête AJAX
                fetch(`/formations/${formationId}/renouveler`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Accès renouvelé avec succès !', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Une erreur est survenue', 'error');
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Une erreur est survenue', 'error');
                    button.innerHTML = originalText;
                    button.disabled = false;
                });
            }
        };

        // Fonction pour afficher les notifications
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
                'bg-red-100 text-red-800 border border-red-200'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        }

        // Mettre à jour les compteurs de progression
        const progressBars = document.querySelectorAll('.bg-yellow-600');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';

            setTimeout(() => {
                bar.style.transition = 'width 1s ease-in-out';
                bar.style.width = width;
            }, 300);
        });
    });
</script>

<style>
    @media (max-width: 640px) {
        .formation-card {
            margin-bottom: 1rem;
        }

        .filter-btn {
            white-space: nowrap;
        }
    }

    .formation-card {
        transition: all 0.3s ease;
    }

    .formation-card:hover {
        transform: translateY(-5px);
    }

    /* Animation pour les barres de progression */
    .bg-yellow-600 {
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Badges animations */
    .bg-blue-100 {
        animation: badgePulse 2s infinite;
    }

    @keyframes badgePulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            opacity: 1;
        }
    }

    /* Style pour les cartes expirées */
    .formation-card.expired {
        opacity: 0.8;
        border-left: 4px solid #ef4444;
    }

    .formation-card.completed {
        border-left: 4px solid #10b981;
    }

    .formation-card.in-progress {
        border-left: 4px solid #f59e0b;
    }
</style>
@endsection
