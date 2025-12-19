@extends('layouts.client')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('page-description', 'Bienvenue sur votre espace client')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Tableau de bord</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- ============================================== --}}
    {{-- MESSAGE DE SUCCÈS APRÈS PAIEMENT --}}
    {{-- ============================================== --}}
    @if(session('success') && session('payment_completed'))
    <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg shadow-sm p-5">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-lg"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-green-800">Paiement confirmé !</h3>
                        <div class="mt-2 space-y-2">
                            <p class="text-green-700">
                                <i class="fas fa-check text-green-500 mr-2"></i>
                                {{ session('success') }}
                            </p>
                            @if(session('formation_title'))
                            <div class="flex items-center text-green-700">
                                <i class="fas fa-graduation-cap text-green-500 mr-2"></i>
                                <span class="font-medium">{{ session('formation_title') }}</span>
                            </div>
                            @endif
                            @if(session('payment_reference'))
                            <div class="flex items-center text-sm text-green-600">
                                <i class="fas fa-receipt text-green-500 mr-2"></i>
                                <span>Référence : {{ session('payment_reference') }}</span>
                            </div>
                            @endif
                            @if(session('payment_amount'))
                            <div class="flex items-center text-sm text-green-600">
                                <i class="fas fa-euro-sign text-green-500 mr-2"></i>
                                <span>Montant : {{ number_format(session('payment_amount'), 2, ',', ' ') }} €</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.remove()"
                        class="text-green-400 hover:text-green-600 transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ route('client.formations.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        <i class="fas fa-graduation-cap mr-2"></i> Accéder à mes formations
                    </a>
                    <a href="{{ route('client.factures.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-green-300 text-green-700 text-sm font-medium rounded-md hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        <i class="fas fa-file-invoice mr-2"></i> Voir ma facture
                    </a>
                    <a href="{{ route('client.formations.catalogue') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <i class="fas fa-book-open mr-2"></i> Découvrir d'autres formations
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ============================================== --}}
    {{-- MESSAGES D'ALERTE STANDARD --}}
    {{-- ============================================== --}}
    @if(session('success') && !session('payment_completed'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-blue-700">{{ session('info') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('warning'))
    <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">{{ session('warning') }}</p>
            </div>
        </div>
    </div>
    @endif

    {{-- ============================================== --}}
    {{-- STATISTIQUES FORMATIONS --}}
    {{-- ============================================== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Formations totales -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-book text-blue-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Formations totales
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['formations_total'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('client.formations.index') }}"
                        class="font-medium text-djok-yellow hover:text-yellow-700">
                        Voir toutes
                    </a>
                </div>
            </div>
        </div>

        <!-- Formations actives -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-graduation-cap text-green-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Formations actives
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['formations_actives'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('client.formations.catalogue') }}"
                        class="font-medium text-djok-yellow hover:text-yellow-700">
                        En découvrir plus
                    </a>
                </div>
            </div>
        </div>

        <!-- Formations terminées -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-purple-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Terminées
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $stats['formations_terminees'] }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <span class="text-gray-500">
                        {{ $stats['formations_total'] > 0 ? round(($stats['formations_terminees'] /
                        $stats['formations_total']) * 100, 1) : 0 }}%
                    </span>
                </div>
            </div>
        </div>

        <!-- Dépenses totales -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-euro-sign text-yellow-600 text-2xl"></i>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Dépenses totales
                            </dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ number_format($stats['depenses_total'], 0, ',', ' ') }} €
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('client.factures.index') }}"
                        class="font-medium text-djok-yellow hover:text-yellow-700">
                        Voir factures
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- CONTENU PRINCIPAL --}}
    {{-- ============================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Formations actives -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Formations actives</h3>
                        <p class="mt-1 text-sm text-gray-500">Vos formations en cours</p>
                    </div>
                    <a href="{{ route('client.formations.index') }}"
                        class="text-sm text-djok-yellow hover:text-yellow-700">
                        Voir toutes →
                    </a>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                @if($formationsActives->count() > 0)
                <div class="flow-root">
                    <ul class="divide-y divide-gray-200">
                        @foreach($formationsActives as $userFormation)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg flex items-center justify-center
                                        @if($userFormation->formation->type_formation === 'e_learning') bg-blue-100 text-blue-600
                                        @elseif($userFormation->formation->type_formation === 'presentiel') bg-green-100 text-green-600
                                        @else bg-purple-100 text-purple-600 @endif">
                                        <i class="fas
                                            @if($userFormation->formation->type_formation === 'e_learning') fa-laptop
                                            @elseif($userFormation->formation->type_formation === 'presentiel') fa-users
                                            @else fa-blender @endif text-lg">
                                        </i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $userFormation->formation->title ?? 'Formation' }}
                                    </p>
                                    <div class="flex items-center mt-1 space-x-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                            @if($userFormation->status === 'active') bg-green-100 text-green-800
                                            @elseif($userFormation->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($userFormation->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            @if($userFormation->progress)
                                            Progression : {{ $userFormation->progress }}%
                                            @else
                                            Pas encore commencé
                                            @endif
                                        </span>
                                    </div>
                                    @if($userFormation->access_end)
                                    <p class="text-xs text-gray-500 mt-1">
                                        Accès jusqu'au {{ $userFormation->access_end->format('d/m/Y') }}
                                    </p>
                                    @endif
                                </div>
                                <div>
                                    @if($userFormation->status === 'active')
                                    <a href="{{ route('client.formations.acceder', $userFormation->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                                        <i class="fas fa-play mr-1"></i> Accéder
                                    </a>
                                    @elseif($userFormation->status === 'pending')
                                    <span
                                        class="inline-flex items-center px-3 py-1.5 border border-yellow-300 text-xs font-medium rounded-md text-yellow-700 bg-yellow-50">
                                        <i class="fas fa-clock mr-1"></i> En attente
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="text-center py-8">
                    <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-graduation-cap text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-500">Aucune formation active</p>
                    <a href="{{ route('client.formations.catalogue') }}"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700">
                        <i class="fas fa-book-open mr-2"></i> Parcourir le catalogue
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Formations recommandées -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Formations recommandées</h3>
                        <p class="mt-1 text-sm text-gray-500">Découvrez de nouvelles formations</p>
                    </div>
                    <a href="{{ route('client.formations.catalogue') }}"
                        class="text-sm text-djok-yellow hover:text-yellow-700">
                        Tout voir →
                    </a>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                @if($formationsRecommandees->count() > 0)
                <div class="space-y-4">
                    @foreach($formationsRecommandees as $formation)
                    <div
                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="h-10 w-10 rounded-lg flex items-center justify-center
                                @if($formation->type_formation === 'e_learning') bg-blue-100 text-blue-600
                                @elseif($formation->type_formation === 'presentiel') bg-green-100 text-green-600
                                @else bg-purple-100 text-purple-600 @endif">
                                <i class="fas
                                    @if($formation->type_formation === 'e_learning') fa-laptop
                                    @elseif($formation->type_formation === 'presentiel') fa-users
                                    @else fa-blender @endif">
                                </i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $formation->title }}</h4>
                                <p class="text-xs text-gray-500">
                                    {{ $formation->type_formation === 'e_learning' ? 'En ligne' :
                                    ($formation->type_formation === 'presentiel' ? 'Présentiel' : 'Mixte') }}
                                    • {{ $formation->duree ?? 'Durée non définie' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end space-y-2">
                            <span class="text-lg font-bold text-yellow-600">
                                {{ number_format($formation->price, 0, ',', ' ') }} €
                            </span>
                            <a href="{{ route('client.formations.inscrire', $formation->id) }}" class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md
                                      @if($formation->type_formation === 'e_learning') bg-green-600 hover:bg-green-700
                                      @else bg-yellow-600 hover:bg-yellow-700 @endif
                                      text-white">
                                <i class="fas
                                    @if($formation->type_formation === 'e_learning') fa-shopping-cart
                                    @else fa-user-plus @endif mr-1">
                                </i>
                                {{ $formation->type_formation === 'e_learning' ? 'Acheter' : 'S\'inscrire' }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @elseif($formationsDisponibles->count() > 0)
                <div class="space-y-4">
                    @foreach($formationsDisponibles as $formation)
                    <div
                        class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="h-10 w-10 rounded-lg flex items-center justify-center
                                @if($formation->type_formation === 'e_learning') bg-blue-100 text-blue-600
                                @elseif($formation->type_formation === 'presentiel') bg-green-100 text-green-600
                                @else bg-purple-100 text-purple-600 @endif">
                                <i class="fas
                                    @if($formation->type_formation === 'e_learning') fa-laptop
                                    @elseif($formation->type_formation === 'presentiel') fa-users
                                    @else fa-blender @endif">
                                </i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">{{ $formation->title }}</h4>
                                <p class="text-xs text-gray-500">
                                    {{ $formation->type_formation === 'e_learning' ? 'En ligne' :
                                    ($formation->type_formation === 'presentiel' ? 'Présentiel' : 'Mixte') }}
                                    • {{ $formation->duree ?? 'Durée non définie' }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end space-y-2">
                            <span class="text-lg font-bold text-yellow-600">
                                {{ number_format($formation->price, 0, ',', ' ') }} €
                            </span>
                            <a href="{{ route('client.formations.catalogue.details', $formation->id) }}"
                                class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-md bg-blue-600 hover:bg-blue-700 text-white">
                                <i class="fas fa-eye mr-1"></i> Détails
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-search text-gray-400 text-2xl"></i>
                    </div>
                    <p class="text-gray-500">Aucune formation recommandée pour le moment</p>
                    <a href="{{ route('formation') }}"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-external-link-alt mr-2"></i> Voir toutes les formations
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- ACTIVITÉS RÉCENTES --}}
    {{-- ============================================== --}}
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Activités récentes</h3>
                <p class="mt-1 text-sm text-gray-500">Vos dernières actions</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Réservations récentes -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Réservations récentes</h4>
                        @if($locationReservations->count() > 0 || $reservations->count() > 0)
                        <div class="space-y-4">
                            @if($locationReservations->count() > 0)
                            @foreach($locationReservations->take(3) as $reservation)
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-car text-blue-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $reservation->vehicle->brand ?? 'Véhicule' }} {{
                                            $reservation->vehicle->model ?? '' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m') }} - {{
                                            \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>
                            @endforeach
                            @endif

                            @if($reservations->count() > 0)
                            @foreach($reservations->take(2) as $reservation)
                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-taxi text-purple-600 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            VTC {{ \Carbon\Carbon::parse($reservation->pickup_datetime)->format('d/m
                                            H:i') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $reservation->pickup_address }} → {{ $reservation->destination_address }}
                                        </p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @else
                        <div class="text-center py-6">
                            <i class="fas fa-calendar text-gray-300 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500">Aucune réservation récente</p>
                        </div>
                        @endif
                    </div>

                    <!-- Demandes récentes -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Demandes récentes</h4>
                        @if($conciergerieDemandes->count() > 0)
                        <div class="space-y-4">
                            @foreach($conciergerieDemandes->take(5) as $demande)
                            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="h-8 w-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-concierge-bell text-yellow-600 text-sm"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $demande->service }}
                                        </p>
                                        <p class="text-xs text-gray-500 truncate">
                                            {{ $demande->created_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($demande->statut === 'traitee') bg-green-100 text-green-800
                                    @elseif($demande->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($demande->statut) }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-6">
                            <i class="fas fa-inbox text-gray-300 text-2xl mb-2"></i>
                            <p class="text-sm text-gray-500">Aucune demande récente</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- ACTIONS RAPIDES --}}
    {{-- ============================================== --}}
    <div class="mt-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Actions rapides</h3>
                <p class="mt-1 text-sm text-gray-500">Accédez rapidement aux fonctionnalités principales</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('client.formations.catalogue') }}"
                        class="bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                        <div
                            class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-blue-600 text-white mb-3">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-900">Catalogue formations</h4>
                        <p class="text-xs text-gray-600 mt-1">Découvrir et s'inscrire</p>
                    </a>

                    <a href="{{ route('client.location-reservations.create') }}"
                        class="bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                        <div
                            class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-green-600 text-white mb-3">
                            <i class="fas fa-car text-xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-900">Louer un véhicule</h4>
                        <p class="text-xs text-gray-600 mt-1">Réserver une voiture</p>
                    </a>

                    <a href="{{ route('client.conciergerie-demandes.create') }}"
                        class="bg-gradient-to-br from-yellow-50 to-yellow-100 hover:from-yellow-100 hover:to-yellow-200 p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                        <div
                            class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-yellow-600 text-white mb-3">
                            <i class="fas fa-concierge-bell text-xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-900">Conciergerie</h4>
                        <p class="text-xs text-gray-600 mt-1">Services sur mesure</p>
                    </a>

                    <a href="{{ route('client.factures.index') }}"
                        class="bg-gradient-to-br from-red-50 to-red-100 hover:from-red-100 hover:to-red-200 p-4 rounded-lg text-center transition-all duration-300 hover:shadow-md">
                        <div
                            class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-red-600 text-white mb-3">
                            <i class="fas fa-file-invoice text-xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-gray-900">Mes factures</h4>
                        <p class="text-xs text-gray-600 mt-1">Télécharger et consulter</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- NOUVELLE FORMATION (si récente) --}}
    {{-- ============================================== --}}
    @if(session('payment_completed') && $formationsActives->count() > 0)
    <div class="mt-8">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-rocket text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-medium text-green-900">Commencez votre nouvelle formation !</h3>
                    <p class="text-green-700 mt-1">
                        Votre formation "<strong>{{ session('formation_title') ??
                            $formationsActives->first()->formation->title }}</strong>" est maintenant accessible.
                    </p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="{{ route('client.formations.acceder', $formationsActives->first()->id) }}"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-play mr-2"></i> Commencer maintenant
                        </a>
                        <a href="{{ route('client.formations.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-green-300 text-green-700 text-sm font-medium rounded-md hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-list mr-2"></i> Voir toutes mes formations
                        </a>
                        <a href="{{ route('client.factures.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-receipt mr-2"></i> Voir la facture
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .bg-djok-yellow {
        background-color: #F8B400;
    }

    .text-djok-yellow {
        color: #F8B400;
    }

    .hover\:bg-yellow-700:hover {
        background-color: #e69c00;
    }

    .focus\:ring-djok-yellow:focus {
        --tw-ring-color: rgba(248, 180, 0, 0.5);
    }
</style>
@endpush

@push('scripts')
<script>
    // Auto-dismiss messages after 10 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const messages = document.querySelectorAll('.bg-green-50, .bg-red-50, .bg-blue-50, .bg-yellow-50');
            messages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s ease';
                message.style.opacity = '0';
                setTimeout(function() {
                    if (message.parentNode) {
                        message.parentNode.removeChild(message);
                    }
                }, 500);
            });
        }, 10000);
    });

    // Charger plus de données via AJAX
    document.addEventListener('DOMContentLoaded', function() {
        // Bouton pour rafraîchir les statistiques
        const refreshBtn = document.getElementById('refresh-stats');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                fetch('{{ route("client.dashboard.stats") }}')
                    .then(response => response.json())
                    .then(data => {
                        // Mettre à jour les statistiques
                        Object.keys(data).forEach(key => {
                            const element = document.getElementById(`stat-${key}`);
                            if (element) {
                                element.textContent = data[key];
                            }
                        });
                    })
                    .catch(error => console.error('Erreur:', error));
            });
        }
    });
</script>
@endpush
