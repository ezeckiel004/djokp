@extends('layouts.admin')

@section('title', 'Statistiques')

@section('page-title', 'Statistiques et rapports')

@section('content')
<div class="space-y-6">
    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="stat-card">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                        <i class="fas fa-users text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Utilisateurs
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900">
                                {{ $stats['total_users'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                        <i class="fas fa-file-signature text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Inscriptions
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900">
                                {{ $stats['total_inscriptions'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                        <i class="fas fa-calendar-alt text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Réservations
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900">
                                {{ $stats['total_reservations'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                        <i class="fas fa-envelope text-white text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Messages en attente
                            </dt>
                            <dd class="text-lg font-semibold text-gray-900">
                                {{ $stats['pending_contacts'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Évolution des inscriptions -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Évolution des inscriptions</h3>
            <canvas id="inscriptionsChart" height="200"></canvas>
        </div>

        <!-- Évolution des réservations -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Évolution des réservations</h3>
            <canvas id="reservationsChart" height="200"></canvas>
        </div>
    </div>

    <!-- Répartitions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Répartition par rôle -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Répartition des utilisateurs par rôle</h3>
            <canvas id="rolesChart" height="200"></canvas>
        </div>

        <!-- Statuts des inscriptions -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Statuts des inscriptions</h3>
            <canvas id="statusChart" height="200"></canvas>
        </div>
    </div>

    <!-- Top utilisateurs -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Top 5 des utilisateurs actifs</h3>
        </div>
        <div class="px-4 py-4 sm:p-6">
            <div class="flow-root">
                <ul class="divide-y divide-gray-200">
                    @foreach($top_users_reservations as $user)
                    <li class="py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-djok-yellow flex items-center justify-center">
                                    <span class="text-white font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ $user->reservations_count }}
                                    réservations</p>
                                <p class="text-sm text-gray-500">{{ $user->role->name ?? 'Aucun rôle' }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Graphique des inscriptions
        const inscriptionsCtx = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(inscriptionsCtx, {
            type: 'line',
            data: {
                labels: @json($monthly_inscriptions->map(fn($item) => $item->month)),
                datasets: [{
                    label: 'Inscriptions',
                    data: @json($monthly_inscriptions->pluck('total')),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Graphique des réservations
        const reservationsCtx = document.getElementById('reservationsChart').getContext('2d');
        new Chart(reservationsCtx, {
            type: 'bar',
            data: {
                labels: @json($monthly_reservations->map(fn($item) => $item->month)),
                datasets: [{
                    label: 'Réservations',
                    data: @json($monthly_reservations->pluck('total')),
                    backgroundColor: '#8b5cf6'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Graphique des rôles
        const rolesCtx = document.getElementById('rolesChart').getContext('2d');
        new Chart(rolesCtx, {
            type: 'doughnut',
            data: {
                labels: @json($users_by_role->map(fn($item) => $item->role?->name ?? 'Sans rôle')),
                datasets: [{
                    data: @json($users_by_role->pluck('total')),
                    backgroundColor: [
                        '#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        // Graphique des statuts
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: @json($inscription_status->pluck('status')),
                datasets: [{
                    data: @json($inscription_status->pluck('total')),
                    backgroundColor: [
                        '#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#8b5cf6'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
