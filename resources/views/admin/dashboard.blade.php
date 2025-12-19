@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Tableau de bord')

@section('page-description', 'Aperçu général de votre plateforme')

@section('content')
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <!-- Carte Utilisateurs -->
    <div class="stat-card">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Utilisateurs totaux
                        </dt>
                        <dd class="text-lg font-semibold text-gray-900">
                            {{ $stats['total_users'] }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte Inscriptions -->
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

    <!-- Carte Réservations -->
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

    <!-- Carte Véhicules -->
    <div class="stat-card">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <i class="fas fa-car text-white text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Véhicules
                        </dt>
                        <dd class="text-lg font-semibold text-gray-900">
                            {{ $stats['total_vehicles'] }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Derniers utilisateurs -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                Derniers utilisateurs inscrits
            </h3>
        </div>
        <div class="px-4 py-4 sm:p-6">
            <div class="flow-root">
                <ul class="divide-y divide-gray-200">
                    @foreach($recent_users as $user)
                    <li class="py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-10 w-10 rounded-full bg-djok-yellow flex items-center justify-center">
                                    <span class="text-white font-semibold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $user->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <div class="inline-flex items-center">
                                <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="px-4 py-3 sm:px-6 border-t border-gray-200">
            <a href="{{ route('admin.users.index') }}"
                class="text-sm font-medium text-djok-yellow hover:text-yellow-700">
                Voir tous les utilisateurs →
            </a>
        </div>
    </div>

    <!-- Dernières inscriptions -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                Dernières inscriptions formations
            </h3>
        </div>
        <div class="px-4 py-4 sm:p-6">
            <div class="flow-root">
                <ul class="divide-y divide-gray-200">
                    @foreach($recent_inscriptions as $inscription)
                    <li class="py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $inscription->formation->title ?? 'Formation inconnue' }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $inscription->user->name }}
                                </p>
                            </div>
                            <div class="inline-flex items-center">
                                @switch($inscription->status)
                                @case('pending')
                                <span class="badge badge-warning">En attente</span>
                                @break
                                @case('confirmed')
                                <span class="badge badge-info">Confirmé</span>
                                @break
                                @case('in_progress')
                                <span class="badge badge-primary">En cours</span>
                                @break
                                @case('completed')
                                <span class="badge badge-success">Terminé</span>
                                @break
                                @default
                                <span class="badge badge-secondary">{{ $inscription->status }}</span>
                                @endswitch
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="px-4 py-3 sm:px-6 border-t border-gray-200">
            <a href="{{ route('admin.inscriptions.index') }}"
                class="text-sm font-medium text-djok-yellow hover:text-yellow-700">
                Voir toutes les inscriptions →
            </a>
        </div>
    </div>
</div>

<!-- Messages en attente -->
<div class="bg-white shadow rounded-lg mb-8">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900 flex items-center">
            <i class="fas fa-envelope mr-2"></i>
            Messages en attente
            @if($recent_contacts->count() > 0)
            <span class="ml-2 bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                {{ $recent_contacts->count() }} nouveau(x)
            </span>
            @endif
        </h3>
    </div>
    <div class="px-4 py-4 sm:p-6">
        @if($recent_contacts->count() > 0)
        <div class="flow-root">
            <ul class="divide-y divide-gray-200">
                @foreach($recent_contacts as $contact)
                <li class="py-4 hover:bg-gray-50 cursor-pointer"
                    onclick="window.location='{{ route('admin.contacts.show', $contact) }}'">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center">
                                <p class="text-sm font-medium text-gray-900 truncate mr-2">
                                    {{ $contact->name }}
                                </p>
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-800 rounded">
                                    {{ $contact->subject }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500 truncate mt-1">
                                {{ Str::limit($contact->message, 100) }}
                            </p>
                        </div>
                        <div class="ml-4 flex-shrink-0">
                            <p class="text-xs text-gray-500">
                                {{ $contact->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @else
        <div class="text-center py-6">
            <i class="fas fa-check-circle text-green-400 text-4xl mb-3"></i>
            <p class="text-gray-500">Aucun message en attente</p>
        </div>
        @endif
    </div>
    <div class="px-4 py-3 sm:px-6 border-t border-gray-200">
        <a href="{{ route('admin.contacts.index') }}"
            class="text-sm font-medium text-djok-yellow hover:text-yellow-700">
            Gérer tous les messages →
        </a>
    </div>
</div>

<!-- Graphique des revenus mensuels -->
<div class="bg-white shadow rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Revenus mensuels (Réservations)</h3>
    <canvas id="revenueChart" height="100"></canvas>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');

        // Préparer les données
        const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        const revenues = Array(12).fill(0);

        @foreach($monthly_stats as $month => $stat)
            revenues[{{ $month }} - 1] = {{ $stat->revenue ?? 0 }};
        @endforeach

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Revenus (€)',
                    data: revenues,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + '€';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
