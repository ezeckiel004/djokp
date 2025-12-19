{{-- resources/views/admin/participants/statistics.blade.php --}}
@extends('layouts.admin')

@section('title', 'Statistiques des Participants')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.participants.index') }}">Participants</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Statistiques</li>
                                </ol>
                            </nav>
                            <h4 class="card-title mb-0 mt-2">
                                <i class="fas fa-chart-bar mr-2"></i>Statistiques des Participants
                            </h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.participants.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Retour à la liste
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques globales -->
    <div class="row mb-4">
        <!-- Total participants -->
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Participants</h6>
                            <h3 class="mb-0">{{ $totalParticipants }}</h3>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmés -->
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Confirmés</h6>
                            <h3 class="mb-0">{{ $parStatut['confirme'] ?? 0 }}</h3>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- En attente -->
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">En attente</h6>
                            <h3 class="mb-0">{{ $parStatut['en_attente'] ?? 0 }}</h3>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terminés -->
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Terminés</h6>
                            <h3 class="mb-0">{{ $parStatut['termine'] ?? 0 }}</h3>
                        </div>
                        <div class="icon-circle">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mb-4">
        <!-- Répartition par statut -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie mr-2"></i>Répartition par statut</h5>
                </div>
                <div class="card-body">
                    <canvas id="statutChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Répartition par type de formation -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-pie mr-2"></i>Répartition par type de formation</h5>
                </div>
                <div class="card-body">
                    <canvas id="typeChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top formations -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-trophy mr-2"></i>Top 10 des formations les plus populaires</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Formation</th>
                                    <th>Nombre de participants</th>
                                    <th>Type</th>
                                    <th>Prix</th>
                                    <th>Statistiques</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parFormation as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $item->formation->title }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-primary">{{ $item->count }}</span> participants
                                    </td>
                                    <td>
                                        <span class="badge badge-info">
                                            {{ $item->formation->type_formation == 'presentiel' ? 'Présentiel' :
                                            ($item->formation->type_formation == 'en_ligne' ? 'En ligne' : 'Mixte') }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ number_format($item->formation->price, 0, ',', ' ') }} €</strong>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.participants.index') }}?formation_id={{ $item->formation_id }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> Voir les participants
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Évolution mensuelle -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line mr-2"></i>Évolution mensuelle des inscriptions</h5>
                </div>
                <div class="card-body">
                    <canvas id="evolutionChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart.js configuration
        Chart.defaults.color = '#6c757d';
        Chart.defaults.borderColor = '#dee2e6';

        // 1. Chart pour la répartition par statut
        const statutCtx = document.getElementById('statutChart').getContext('2d');
        const statutChart = new Chart(statutCtx, {
            type: 'doughnut',
            data: {
                labels: ['En attente', 'Confirmés', 'Annulés', 'Terminés'],
                datasets: [{
                    data: [
                        {{ $parStatut['en_attente'] ?? 0 }},
                        {{ $parStatut['confirme'] ?? 0 }},
                        {{ $parStatut['annule'] ?? 0 }},
                        {{ $parStatut['termine'] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#ffc107',
                        '#28a745',
                        '#dc3545',
                        '#17a2b8'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw + ' participants';
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // 2. Chart pour la répartition par type de formation
        const typeCtx = document.getElementById('typeChart').getContext('2d');
        const typeChart = new Chart(typeCtx, {
            type: 'pie',
            data: {
                labels: ['Présentiel', 'En ligne', 'Mixte'],
                datasets: [{
                    data: [
                        {{ $parType['presentiel'] ?? 0 }},
                        {{ $parType['en_ligne'] ?? 0 }},
                        {{ $parType['mixte'] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#007bff',
                        '#28a745',
                        '#6f42c1'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // 3. Chart pour l'évolution mensuelle
        const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
        const evolutionChart = new Chart(evolutionCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($evolution->pluck('mois')) !!},
                datasets: [{
                    label: 'Nombre d\'inscriptions',
                    data: {!! json_encode($evolution->pluck('count')) !!},
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre d\'inscriptions'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });
    });
</script>
@endsection

@section('styles')
<style>
    .icon-circle {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
