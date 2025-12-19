{{-- resources/views/client/reservations/index.blade.php --}}

@extends('layouts.client')

@section('title', 'Mes réservations VTC')
@section('page-title', 'Mes réservations VTC')
@section('page-description', 'Gérez toutes vos réservations de chauffeur privé')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Réservations VTC</span>
    </div>
</li>
@endsection

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Mes réservations</h2>
    <a href="{{ route('client.reservations.create') }}"
        class="inline-flex items-center px-4 py-2 bg-djok-yellow text-white rounded-lg hover:bg-yellow-700 transition-colors duration-200">
        <i class="fas fa-plus mr-2"></i> Nouvelle réservation
    </a>
</div>

@if($reservations->isEmpty())
<div class="bg-white shadow rounded-lg p-8 text-center">
    <i class="fas fa-calendar-times text-gray-300 text-5xl mb-4"></i>
    <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation</h3>
    <p class="text-gray-500 mb-4">Vous n'avez pas encore effectué de réservation VTC.</p>
    <a href="{{ route('client.reservations.create') }}"
        class="inline-flex items-center px-4 py-2 bg-djok-yellow text-white rounded-lg hover:bg-yellow-700">
        <i class="fas fa-car mr-2"></i> Réserver un chauffeur
    </a>
</div>
@else
<div class="bg-white shadow rounded-lg overflow-hidden">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Historique des réservations</h3>
        <p class="mt-1 text-sm text-gray-500">Toutes vos demandes de service VTC</p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Référence
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Service
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date & Heure
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Trajet
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Statut
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($reservations as $reservation)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $reservation->reference }}</div>
                        <div class="text-xs text-gray-500">
                            @if($reservation->created_at)
                            {{ $reservation->created_at->format('d/m/Y') }}
                            @else
                            -
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">
                            @if($reservation->type_service === 'transfert')
                            <i class="fas fa-plane-arrival mr-1"></i> Transfert
                            @elseif($reservation->type_service === 'professionnel')
                            <i class="fas fa-briefcase mr-1"></i> Professionnel
                            @elseif($reservation->type_service === 'evenement')
                            <i class="fas fa-glass-cheers mr-1"></i> Événement
                            @else
                            <i class="fas fa-car mr-1"></i> Mise à disposition
                            @endif
                        </div>
                        <div class="text-xs text-gray-500">{{ $reservation->type_vehicule }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            @if($reservation->date)
                            {{ $reservation->date->format('d/m/Y') }}
                            @else
                            -
                            @endif
                        </div>
                        <div class="text-xs text-gray-500">{{ $reservation->heure }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">
                            <i class="fas fa-map-marker-alt text-red-500 mr-1"></i> {{ Str::limit($reservation->depart,
                            20) }}
                        </div>
                        <div class="text-sm text-gray-900">
                            <i class="fas fa-flag-checkered text-green-500 mr-1"></i> {{
                            Str::limit($reservation->arrivee, 20) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                        $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'confirmed' => 'bg-green-100 text-green-800',
                        'in_progress' => 'bg-blue-100 text-blue-800',
                        'completed' => 'bg-gray-100 text-gray-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        ];
                        $statusLabels = [
                        'pending' => 'En attente',
                        'confirmed' => 'Confirmée',
                        'in_progress' => 'En cours',
                        'completed' => 'Terminée',
                        'cancelled' => 'Annulée',
                        ];
                        @endphp
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$reservation->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $statusLabels[$reservation->status] ?? $reservation->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('client.reservations.show', $reservation->id) }}"
                            class="text-djok-yellow hover:text-yellow-700 mr-3">
                            <i class="fas fa-eye mr-1"></i> Voir
                        </a>
                        @if($reservation->status === 'pending')
                        <a href="{{ route('client.reservations.edit', $reservation->id) }}"
                            class="text-blue-600 hover:text-blue-900 mr-3">
                            <i class="fas fa-edit mr-1"></i> Modifier
                        </a>
                        <form action="{{ route('client.reservations.destroy', $reservation->id) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash mr-1"></i> Annuler
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $reservations->links() }}
    </div>
    @endif

    <!-- Stats -->
    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-4">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                En attente
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $reservations->where('status', 'pending')->count() }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Confirmées
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $reservations->where('status', 'confirmed')->count() }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <i class="fas fa-spinner text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                En cours
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $reservations->where('status', 'in_progress')->count() }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-gray-100 rounded-md p-3">
                        <i class="fas fa-flag-checkered text-gray-600 text-xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Terminées
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $reservations->where('status', 'completed')->count() }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('styles')
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .pagination li {
            margin: 0 2px;
        }

        .pagination li a,
        .pagination li span {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pagination li a:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        .pagination li.active span {
            background-color: #f59e0b;
            border-color: #f59e0b;
            color: white;
        }

        .pagination li.disabled span {
            color: #9ca3af;
            background-color: #f9fafb;
            border-color: #e5e7eb;
        }
    </style>
    @endpush
