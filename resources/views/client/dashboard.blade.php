@extends('layouts.client')

@section('title', 'Dashboard Client')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Bienvenue dans votre espace personnel')

@section('content')
<div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">
    <!-- Bienvenue -->
    <div class="lg:col-span-3">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Bienvenue, {{ auth()->user()->name }} !</h2>
                    <p class="mt-2 opacity-90">Gérez facilement vos formations, réservations et documents depuis votre
                        espace personnel.</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <div class="flex space-x-3">
                        <a href="{{ route('client.reservations.create') }}"
                            class="bg-white text-yellow-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                            <i class="fas fa-plus mr-2"></i>Nouvelle réservation
                        </a>
                        <a href="{{ route('formation') }}"
                            class="bg-yellow-700 text-white px-4 py-2 rounded-lg font-semibold hover:bg-yellow-800 transition">
                            <i class="fas fa-graduation-cap mr-2"></i>Nouvelle formation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques rapides -->
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <!-- Formations actives -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Formations actives
                        </dt>
                        <dd class="text-lg font-semibold text-gray-900">
                            {{ $stats['active_formations'] ?? 0 }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('client.formations.index') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    Voir mes formations
                </a>
            </div>
        </div>
    </div>

    <!-- Réservations à venir -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Réservations à venir
                        </dt>
                        <dd class="text-lg font-semibold text-gray-900">
                            {{ $stats['upcoming_reservations'] ?? 0 }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('client.reservations.index') }}"
                    class="font-medium text-green-600 hover:text-green-500">
                    Voir mes réservations
                </a>
            </div>
        </div>
    </div>

    <!-- Factures en attente -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Factures à payer
                        </dt>
                        <dd class="text-lg font-semibold text-gray-900">
                            {{ $stats['pending_invoices'] ?? 0 }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('client.invoices.index') }}"
                    class="font-medium text-yellow-600 hover:text-yellow-500">
                    Voir mes factures
                </a>
            </div>
        </div>
    </div>

    <!-- Support -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-headset text-white text-xl"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Tickets support
                        </dt>
                        <dd class="text-lg font-semibold text-gray-900">
                            {{ $stats['open_tickets'] ?? 0 }}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('client.support') }}" class="font-medium text-purple-600 hover:text-purple-500">
                    Contacter le support
                </a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Formations récentes -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                <i class="fas fa-graduation-cap mr-2 text-blue-500"></i>Mes formations récentes
            </h3>
        </div>
        <div class="p-6">
            @if($inscriptions->isEmpty())
            <div class="text-center py-8">
                <i class="fas fa-graduation-cap text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Vous n'avez aucune formation en cours.</p>
                <a href="{{ route('formation') }}"
                    class="inline-block mt-4 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                    <i class="fas fa-plus mr-2"></i>Découvrir les formations
                </a>
            </div>
            @else
            <div class="space-y-4">
                @foreach($inscriptions->take(3) as $inscription)
                <div class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-blue-600"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="font-medium text-gray-900">{{ $inscription->formation->title }}</h4>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <span class="mr-4">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                {{ $inscription->start_date?->format('d/m/Y') ?? 'À définir' }}
                            </span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{
                                $inscription->status === 'confirmed' ? 'green' :
                                ($inscription->status === 'in_progress' ? 'blue' :
                                ($inscription->status === 'completed' ? 'gray' : 'yellow'))
                            }}-100 text-{{
                                $inscription->status === 'confirmed' ? 'green' :
                                ($inscription->status === 'in_progress' ? 'blue' :
                                ($inscription->status === 'completed' ? 'gray' : 'yellow'))
                            }}-800">
                                {{ $inscription->status }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <a href="{{ route('client.formations.show', $inscription->id) }}"
                            class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @if($inscriptions->count() > 3)
            <div class="mt-4 text-center">
                <a href="{{ route('client.formations.index') }}"
                    class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Voir toutes mes formations ({{ $inscriptions->count() }})
                </a>
            </div>
            @endif
            @endif
        </div>
    </div>

    <!-- Réservations récentes -->
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                <i class="fas fa-car mr-2 text-green-500"></i>Mes réservations récentes
            </h3>
        </div>
        <div class="p-6">
            @if($reservations->isEmpty())
            <div class="text-center py-8">
                <i class="fas fa-car text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Vous n'avez aucune réservation.</p>
                <div class="mt-4 space-x-3">
                    <a href="{{ route('location') }}"
                        class="inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                        <i class="fas fa-car mr-2"></i>Louer un véhicule
                    </a>
                    <a href="{{ route('vtc-transport') }}"
                        class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <i class="fas fa-taxi mr-2"></i>Réserver un VTC
                    </a>
                </div>
            </div>
            @else
            <div class="space-y-4">
                @foreach($reservations->take(3) as $reservation)
                <div class="flex items-start p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i
                                class="fas fa-{{ $reservation->type === 'location' ? 'car' : 'taxi' }} text-green-600"></i>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="font-medium text-gray-900">
                            {{ $reservation->type === 'location' ? 'Location véhicule' : 'Service VTC' }}
                        </h4>
                        <div class="mt-1 space-y-1 text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-day mr-2"></i>
                                {{ $reservation->start_date->format('d/m/Y') }}
                                @if($reservation->end_date)
                                - {{ $reservation->end_date->format('d/m/Y') }}
                                @endif
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i>
                                {{ $reservation->pickup_location ?? 'Non spécifié' }}
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 text-right">
                        <div class="font-semibold text-gray-900">
                            {{ number_format($reservation->total_amount, 2) }} €
                        </div>
                        <span class="mt-1 inline-block px-2 py-1 text-xs font-semibold rounded-full bg-{{
                            $reservation->status === 'confirmed' ? 'green' :
                            ($reservation->status === 'completed' ? 'gray' : 'yellow')
                        }}-100 text-{{
                            $reservation->status === 'confirmed' ? 'green' :
                            ($reservation->status === 'completed' ? 'gray' : 'yellow')
                        }}-800">
                            {{ $reservation->status }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            @if($reservations->count() > 3)
            <div class="mt-4 text-center">
                <a href="{{ route('client.reservations.index') }}"
                    class="text-sm font-medium text-green-600 hover:text-green-500">
                    Voir toutes mes réservations ({{ $reservations->count() }})
                </a>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>

<!-- Actions rapides -->
<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            <i class="fas fa-bolt mr-2 text-yellow-500"></i>Actions rapides
        </h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('formation') }}"
                class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <span class="font-medium text-gray-900">Nouvelle formation</span>
                <span class="text-sm text-gray-600 text-center mt-1">Inscrivez-vous à une formation</span>
            </a>

            <a href="{{ route('location') }}"
                class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-car text-white text-xl"></i>
                </div>
                <span class="font-medium text-gray-900">Louer un véhicule</span>
                <span class="text-sm text-gray-600 text-center mt-1">Véhicules premium disponibles</span>
            </a>

            <a href="{{ route('vtc-transport') }}"
                class="flex flex-col items-center p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                <div class="w-12 h-12 bg-yellow-500 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-taxi text-white text-xl"></i>
                </div>
                <span class="font-medium text-gray-900">Service VTC</span>
                <span class="text-sm text-gray-600 text-center mt-1">Transport haut de gamme</span>
            </a>

            <a href="{{ route('client.support') }}"
                class="flex flex-col items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-3">
                    <i class="fas fa-headset text-white text-xl"></i>
                </div>
                <span class="font-medium text-gray-900">Support client</span>
                <span class="text-sm text-gray-600 text-center mt-1">Besoin d'aide ? Contactez-nous</span>
            </a>
        </div>
    </div>
</div>

<!-- Prochain rendez-vous -->
@if($nextReservation = $reservations->where('start_date', '>=', now())->sortBy('start_date')->first())
<div class="mt-8 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg shadow-lg p-6 text-white">
    <div class="flex flex-col md:flex-row md:items-center justify-between">
        <div>
            <h3 class="text-xl font-bold mb-2">
                <i class="fas fa-calendar-check mr-2"></i>Votre prochain rendez-vous
            </h3>
            <div class="space-y-2">
                <p class="flex items-center">
                    <i class="fas fa-calendar-day mr-2"></i>
                    {{ $nextReservation->start_date->format('l d F Y') }}
                </p>
                <p class="flex items-center">
                    <i class="fas fa-clock mr-2"></i>
                    {{ $nextReservation->start_date->format('H:i') }}
                </p>
                @if($nextReservation->pickup_location)
                <p class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    {{ $nextReservation->pickup_location }}
                </p>
                @endif
            </div>
        </div>
        <div class="mt-4 md:mt-0">
            <a href="{{ route('client.reservations.show', $nextReservation->id) }}"
                class="bg-white text-yellow-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">
                Voir les détails
            </a>
        </div>
    </div>
</div>
@endif
@endsection
