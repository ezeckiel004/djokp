@extends('layouts.client')

@section('title', 'Dashboard Chauffeur - DJOK PRESTIGE')

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
                            <p class="text-muted mb-0">Votre tableau de bord chauffeur</p>
                        </div>
                        <div class="badge bg-warning text-dark">
                            <i class="fas fa-taxi me-1"></i> Chauffeur VTC
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
                                Courses aujourd'hui
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['today_trips'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-road fa-2x text-gray-300"></i>
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
                                Courses à venir
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['upcoming_trips'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
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
                                Courses ce mois
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['completed_trips'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                                Gains ce mois
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{
                                number_format($stats['monthly_earnings'], 2) }} €</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-euro-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses d'aujourd'hui -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clock me-2"></i>Courses d'aujourd'hui
                    </h6>
                </div>
                <div class="card-body">
                    @if($todayReservations->isEmpty())
                    <p class="text-muted">Aucune course prévue pour aujourd'hui.</p>
                    @else
                    <div class="list-group">
                        @foreach($todayReservations as $reservation)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    @if($reservation->vehicle)
                                    {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }}
                                    @else
                                    Véhicule assigné
                                    @endif
                                </h5>
                                <span class="badge bg-primary">
                                    {{ $reservation->pickup_time ?
                                    \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') : '--:--' }}
                                </span>
                            </div>
                            <p class="mb-1">
                                <i class="fas fa-user me-1"></i>
                                {{ $reservation->user->name }}
                            </p>
                            <small>
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $reservation->pickup_location ?? 'Lieu à définir' }}
                            </small>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Courses à venir -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar me-2"></i>Prochaines courses
                    </h6>
                </div>
                <div class="card-body">
                    @if($upcomingReservations->isEmpty())
                    <p class="text-muted">Aucune course à venir.</p>
                    @else
                    <div class="list-group">
                        @foreach($upcomingReservations as $reservation)
                        <div class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">
                                    {{ $reservation->user->name }}
                                </h5>
                                <span class="badge bg-success">
                                    {{ $reservation->start_date->format('d/m') }}
                                </span>
                            </div>
                            <p class="mb-1">
                                <i class="fas fa-car me-1"></i>
                                {{ $reservation->vehicle ? $reservation->vehicle->brand . ' ' .
                                $reservation->vehicle->model : 'Véhicule à assigner' }}
                            </p>
                            <small>
                                <i class="fas fa-map-pin me-1"></i>
                                {{ $reservation->pickup_location ?? 'Lieu à définir' }}
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
                            <a href="{{ route('chauffeur.schedule') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-calendar-alt fa-2x mb-2"></i><br>
                                Mon planning
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('chauffeur.missions.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-tasks fa-2x mb-2"></i><br>
                                Mes missions
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('chauffeur.vehicle') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-car fa-2x mb-2"></i><br>
                                Mon véhicule
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('chauffeur.earnings') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-chart-line fa-2x mb-2"></i><br>
                                Mes revenus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
