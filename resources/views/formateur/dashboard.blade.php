@extends('layouts.client')

@section('title', 'Dashboard Formateur - DJOK PRESTIGE')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-1">Bonjour, {{ $user->name }} !</h4>
                            <p class="text-muted mb-0">Votre tableau de bord formateur</p>
                        </div>
                        <div class="badge bg-info text-white">
                            <i class="fas fa-chalkboard-teacher me-1"></i> Formateur VTC
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Élèves en cours
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['current_students'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Formations terminées
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['completed_formations'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Évaluations en attente
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['pending_evaluations'] }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Taux de réussite
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['success_rate'] }}%</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formations en cours -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chalkboard-teacher me-2"></i>Formations en cours
                    </h6>
                </div>
                <div class="card-body">
                    @if($currentFormations->isEmpty())
                    <p class="text-muted">Aucune formation en cours.</p>
                    @else
                    <div class="list-group">
                        @foreach($currentFormations as $inscription)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    {{ $inscription->formation->title }}
                                </h5>
                                <span
                                    class="badge bg-{{ $inscription->status === 'in_progress' ? 'primary' : 'warning' }}">
                                    {{ $inscription->status }}
                                </span>
                            </div>
                            <p class="mb-1">
                                <i class="fas fa-user me-1"></i>
                                {{ $inscription->user->name }}
                            </p>
                            <small>
                                <i class="fas fa-calendar me-1"></i>
                                Début : {{ $inscription->start_date?->format('d/m/Y') ?? 'À définir' }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Prochaines sessions -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar me-2"></i>Prochaines sessions
                    </h6>
                </div>
                <div class="card-body">
                    @if($upcomingSessions->isEmpty())
                    <p class="text-muted">Aucune session à venir.</p>
                    @else
                    <div class="list-group">
                        @foreach($upcomingSessions as $session)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    {{ $session->formation->title }}
                                </h5>
                                <span class="badge bg-success">
                                    {{ $session->start_date->format('d/m') }}
                                </span>
                            </div>
                            <p class="mb-1">
                                <i class="fas fa-users me-1"></i>
                                {{ $session->user->name }} et {{ rand(1, 5) }} autres participants
                            </p>
                            <small>
                                <i class="fas fa-clock me-1"></i>
                                Durée : {{ $session->formation->duration_hours }}h
                            </small>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bolt me-2"></i>Actions rapides
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('formateur.formations.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-chalkboard fa-2x mb-2"></i><br>
                                Mes formations
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('formateur.students.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-user-graduate fa-2x mb-2"></i><br>
                                Mes élèves
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('formateur.schedule') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i><br>
                                Mon planning
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('formateur.evaluations.index') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-clipboard-list fa-2x mb-2"></i><br>
                                Évaluations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
