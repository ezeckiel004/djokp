{{-- resources/views/client/conciergerie-demandes/statistiques.blade.php --}}
@extends('layouts.client')

@section('title', 'Statistiques de conciergerie')
@section('page-title', 'Statistiques')
@section('page-description', 'Statistiques de vos demandes de conciergerie')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.conciergerie-demandes.index') }}" class="text-gray-500 hover:text-djok-yellow">
            Demandes
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Statistiques</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- En-tête --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Statistiques de vos demandes</h2>
        <p class="text-gray-600">Vue d'ensemble de votre activité conciergerie</p>
    </div>

    {{-- Cartes de statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-inbox text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $statistiques['total'] }}</h3>
                    <p class="text-sm text-gray-600">Demandes totales</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $statistiques['en_cours'] }}</h3>
                    <p class="text-sm text-gray-600">En cours</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $statistiques['confirmees'] }}</h3>
                    <p class="text-sm text-gray-600">Confirmées</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="h-12 w-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file-invoice text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $statistiques['devis_envoyes'] }}</h3>
                    <p class="text-sm text-gray-600">Devis envoyés</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Graphiques et détails --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        {{-- Statistiques par statut --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <i class="fas fa-chart-pie text-djok-yellow mr-2"></i>
                Répartition par statut
            </h3>

            <div class="space-y-4">
                @foreach(['nouvelle', 'en_cours', 'devis_envoye', 'confirme', 'annule', 'termine'] as $statut)
                @if($statistiques[$statut . ($statut === 'devis_envoye' ? 's' : 'es')] > 0)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        @php
                        $statusColors = [
                        'nouvelle' => 'bg-blue-100 text-blue-800',
                        'en_cours' => 'bg-yellow-100 text-yellow-800',
                        'devis_envoye' => 'bg-purple-100 text-purple-800',
                        'confirme' => 'bg-green-100 text-green-800',
                        'annule' => 'bg-red-100 text-red-800',
                        'termine' => 'bg-gray-100 text-gray-800',
                        ];
                        $colorClass = $statusColors[$statut] ?? 'bg-gray-100 text-gray-800';
                        $label = App\Models\ConciergerieDemande::STATUTS[$statut] ?? ucfirst($statut);
                        @endphp
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }} mr-3">
                            {{ $label }}
                        </span>
                        <span class="text-sm text-gray-600">
                            {{ $statistiques[$statut . ($statut === 'devis_envoye' ? 's' : 'es')] }} demande(s)
                        </span>
                    </div>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $statistiques['total'] > 0 ? round(($statistiques[$statut . ($statut === 'devis_envoye' ? 's'
                        : 'es')] / $statistiques['total']) * 100, 1) : 0 }}%
                    </span>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- Demandes par mois --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <i class="fas fa-calendar-alt text-djok-yellow mr-2"></i>
                Évolution sur 6 mois
            </h3>

            @if($demandesParMois->count() > 0)
            <div class="space-y-4">
                @foreach($demandesParMois as $mois => $data)
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $mois)->format('M Y') }}
                        </span>
                        <span class="text-sm font-medium text-gray-900">{{ $data->total }} demande(s)</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                        $max = $demandesParMois->max('total');
                        $width = $max > 0 ? ($data->total / $max) * 100 : 0;
                        @endphp
                        <div class="bg-djok-yellow h-2 rounded-full" style="width: {{ $width }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">Aucune donnée disponible</p>
            @endif
        </div>
    </div>

    {{-- Statistiques par motif --}}
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <i class="fas fa-plane text-djok-yellow mr-2"></i>
                Répartition par motif de voyage
            </h3>

            @if($demandesParMotif->count() > 0)
            <div class="space-y-4">
                @foreach($demandesParMotif as $motif => $data)
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="h-10 w-10 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                            @php
                            $icons = [
                            'tourisme' => 'fa-umbrella-beach',
                            'affaires' => 'fa-briefcase',
                            'formation' => 'fa-graduation-cap',
                            'installation' => 'fa-home',
                            'familial' => 'fa-users',
                            'evenementiel' => 'fa-calendar-star',
                            'autre' => 'fa-ellipsis-h',
                            ];
                            $icon = $icons[$motif] ?? 'fa-plane';
                            @endphp
                            <i class="fas {{ $icon }} text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">
                                {{ App\Models\ConciergerieDemande::MOTIFS[$motif] ?? ucfirst($motif) }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $data->total }} demande(s)</p>
                        </div>
                    </div>
                    <span class="text-sm font-medium text-gray-900">
                        {{ $statistiques['total'] > 0 ? round(($data->total / $statistiques['total']) * 100, 1) : 0 }}%
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">Aucune donnée disponible</p>
            @endif
        </div>
    </div>

    {{-- Résumé et actions --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h3 class="text-lg font-medium text-blue-900 mb-2">Résumé de votre activité</h3>
                <p class="text-blue-700">
                    Vous avez créé <strong>{{ $statistiques['total'] }} demande(s)</strong> au total.
                    @if($statistiques['confirmees'] > 0)
                    <br><strong>{{ $statistiques['confirmees'] }} demande(s)</strong> ont été confirmées.
                    @endif
                    @if($statistiques['devis_envoyes'] > 0)
                    <br><strong>{{ $statistiques['devis_envoyes'] }} devis</strong> vous ont été envoyés.
                    @endif
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('client.conciergerie-demandes.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-blue-300 text-blue-700 text-sm font-medium rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-list mr-2"></i> Voir toutes les demandes
                </a>
                <a href="{{ route('client.conciergerie-demandes.create') }}"
                    class="ml-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-plus mr-2"></i> Nouvelle demande
                </a>
            </div>
        </div>
    </div>
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
