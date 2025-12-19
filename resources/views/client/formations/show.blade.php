{{-- resources/views/client/formations/show.blade.php --}}
@extends('layouts.client')

@section('title', 'Détails de la formation')
@section('page-title', 'Détails de la formation')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.index') }}" class="text-gray-500 hover:text-djok-yellow transition-colors">
            Mes Formations
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">{{ $userFormation->formation->title }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $userFormation->formation->title }}</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $userFormation->formation->type_formation === 'e_learning' ? 'Formation en ligne' :
                        'Formation présentielle' }}
                    </p>
                </div>
                <div>
                    @php
                    $statusColors = [
                    'active' => 'bg-green-100 text-green-800',
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'expired' => 'bg-red-100 text-red-800',
                    'completed' => 'bg-blue-100 text-blue-800',
                    ];
                    $colorClass = $statusColors[$userFormation->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                        {{ ucfirst($userFormation->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Informations générales -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">Description</h4>
                    <div class="prose max-w-none">
                        {!! $userFormation->formation->description !!}
                    </div>

                    @if($userFormation->formation->objectives)
                    <div class="mt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Objectifs</h4>
                        <ul class="list-disc pl-5 space-y-2 text-gray-600">
                            @foreach(explode("\n", $userFormation->formation->objectives) as $objective)
                            <li>{{ trim($objective) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($userFormation->formation->prerequisites)
                    <div class="mt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Prérequis</h4>
                        <ul class="list-disc pl-5 space-y-2 text-gray-600">
                            @foreach(explode("\n", $userFormation->formation->prerequisites) as $prerequisite)
                            <li>{{ trim($prerequisite) }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <!-- Informations d'accès -->
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Informations d'accès</h4>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Date d'inscription :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->created_at->format('d/m/Y') }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Date de début :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->access_start->format('d/m/Y') }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Date de fin :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->access_end->format('d/m/Y') }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Jours restants :</dt>
                                <dd
                                    class="text-sm font-medium {{ now()->diffInDays($userFormation->access_end) < 30 ? 'text-red-600' : 'text-green-600' }}">
                                    {{ now()->diffInDays($userFormation->access_end) }} jours
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Progression :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->progress ?? 0 }}%
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Actions -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Actions</h4>
                        <div class="space-y-2">
                            @if($userFormation->status === 'active')
                            <a href="{{ route('client.formations.acceder', $userFormation->id) }}"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow w-full">
                                <i class="fas fa-play mr-2"></i> Accéder à la formation
                            </a>
                            @endif

                            <a href="{{ route('client.formations.compte-rendu', $userFormation->id) }}"
                                class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow w-full">
                                <i class="fas fa-file-alt mr-2"></i> Compte-rendu
                            </a>

                            @if($userFormation->paiement)
                            <a href="{{ route('client.factures.show', $userFormation->paiement->id) }}"
                                class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow w-full">
                                <i class="fas fa-receipt mr-2"></i> Facture
                            </a>
                            @endif

                            <a href="{{ route('client.formations.index') }}"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 w-full">
                                <i class="fas fa-arrow-left mr-2"></i> Retour aux formations
                            </a>
                        </div>
                    </div>

                    <!-- Informations formation -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-gray-900 mb-3">Détails formation</h4>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Durée :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->formation->duree }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Format :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->formation->format_affichage }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Niveau :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->formation->niveau }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500">Public :</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    {{ $userFormation->formation->public }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
