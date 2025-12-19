{{-- resources/views/client/conciergerie-demandes/show.blade.php --}}
@extends('layouts.client')

@section('title', 'Détail de la demande')
@section('page-title', 'Demande ' . $demande->reference)
@section('page-description', 'Détails et suivi de votre demande')

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
        <span class="text-gray-500">{{ $demande->reference }}</span>
    </div>
</li>
@endsection

@section('content')
@php
// Décoder les services depuis le JSON
$services = json_decode($demande->services, true) ?? [];
@endphp

<div class="max-w-5xl mx-auto">
    {{-- En-tête avec statut --}}
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Demande {{ $demande->reference }}</h2>
                <p class="text-gray-600">
                    Créée le {{ $demande->created_at->format('d/m/Y à H:i') }}
                    • Dernière mise à jour : {{ $demande->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>
            <div class="mt-4 md:mt-0">
                @php
                $statusColors = [
                'nouvelle' => 'bg-blue-100 text-blue-800',
                'en_cours' => 'bg-yellow-100 text-yellow-800',
                'devis_envoye' => 'bg-purple-100 text-purple-800',
                'confirme' => 'bg-green-100 text-green-800',
                'annule' => 'bg-red-100 text-red-800',
                'termine' => 'bg-gray-100 text-gray-800',
                ];
                $colorClass = $statusColors[$demande->statut] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $colorClass }}">
                    <i class="fas fa-circle text-xs mr-2"></i>
                    {{ $demande->getStatutLabelAttribute() }}
                </span>
            </div>
        </div>
    </div>

    {{-- Grille d'informations --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- Informations client --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-user-circle text-djok-yellow mr-2"></i>
                Informations client
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Nom complet</p>
                    <p class="font-medium text-gray-900">{{ $demande->nom_complet }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-900">{{ $demande->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Téléphone</p>
                    <p class="font-medium text-gray-900">{{ $demande->telephone }}</p>
                </div>
            </div>
        </div>

        {{-- Informations séjour --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-plane text-djok-yellow mr-2"></i>
                Informations séjour
            </h3>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">Motif du voyage</p>
                    <p class="font-medium text-gray-900">{{ $demande->motif_voyage }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date d'arrivée</p>
                    <p class="font-medium text-gray-900">
                        @if($demande->date_arrivee)
                        {{ \Carbon\Carbon::parse($demande->date_arrivee)->format('d/m/Y') }}
                        @else
                        Non précisée
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Durée du séjour</p>
                    <p class="font-medium text-gray-900">{{ $demande->duree_sejour }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Nombre de personnes</p>
                    <p class="font-medium text-gray-900">{{ $demande->nombre_personnes }}</p>
                </div>
                @if($demande->budget)
                <div>
                    <p class="text-sm text-gray-500">Budget estimé</p>
                    <p class="font-medium text-gray-900">{{ $demande->budget }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Devis et accompagnement --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-file-invoice text-djok-yellow mr-2"></i>
                Devis & Accompagnement
            </h3>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Type d'accompagnement</p>
                    <p class="font-medium text-gray-900">{{ $demande->type_accompagnement }}</p>
                </div>

                @if($demande->devis_envoye)
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-green-900">Devis envoyé</p>
                        @if($demande->date_devis)
                        <p class="text-xs text-green-700">
                            {{ \Carbon\Carbon::parse($demande->date_devis)->format('d/m/Y') }}
                        </p>
                        @endif
                    </div>
                    <p class="text-2xl font-bold text-green-900 mb-2">
                        @if($demande->montant_devis)
                        {{ number_format($demande->montant_devis, 0, ',', ' ') }} {{ $demande->devise ?? 'EUR' }}
                        @else
                        Montant non spécifié
                        @endif
                    </p>
                    @if($demande->statut === 'devis_envoye')
                    <form action="{{ route('client.conciergerie-demandes.confirmer-devis', $demande->id) }}"
                        method="POST" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-check-circle mr-2"></i> Confirmer ce devis
                        </button>
                    </form>
                    @endif
                </div>
                @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <p class="text-sm text-yellow-800">
                        <i class="fas fa-clock mr-2"></i>
                        Devis en préparation
                    </p>
                </div>
                @endif

                @if($demande->statut === 'devis_envoye' && $demande->devis_envoye)
                <div class="mt-4">
                    <form action="{{ route('client.conciergerie-demandes.demander-nouveau-devis', $demande->id) }}"
                        method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Demander un nouveau devis
                            </label>
                            <textarea name="message" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"
                                placeholder="Expliquez pourquoi vous souhaitez un nouveau devis..."></textarea>
                        </div>
                        <button type="submit"
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                            <i class="fas fa-redo mr-2"></i> Demander un nouveau devis
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Services demandés --}}
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-list-alt text-djok-yellow mr-2"></i>
                Services demandés
            </h3>
            @if(!empty($services))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($services as $service)
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <span class="text-gray-700">{{ $service }}</span>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 italic">Aucun service spécifié</p>
            @endif
        </div>
    </div>

    {{-- Message détaillé --}}
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                <i class="fas fa-comment-alt text-djok-yellow mr-2"></i>
                Message détaillé
            </h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-700 whitespace-pre-line">{{ $demande->message }}</p>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
            <div class="flex items-center space-x-4">
                <a href="{{ route('client.conciergerie-demandes.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>

                @if(in_array($demande->statut, ['nouvelle', 'en_cours']))
                <form action="{{ route('client.conciergerie-demandes.destroy', $demande->id) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette demande ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-red-300 text-red-700 text-sm font-medium rounded-md hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-times mr-2"></i> Annuler la demande
                    </button>
                </form>
                @endif
            </div>

            <div class="flex items-center space-x-3">
                <a href="{{ route('client.conciergerie-demandes.export-pdf', $demande->id) }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-download mr-2"></i> Télécharger en PDF
                </a>

                <a href="{{ route('client.conciergerie-demandes.create') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-plus mr-2"></i> Nouvelle demande
                </a>
            </div>
        </div>
    </div>

    {{-- Timeline du statut --}}
    <div class="mt-8 bg-white shadow rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
            <i class="fas fa-history text-djok-yellow mr-2"></i>
            Historique du statut
        </h3>
        <div class="space-y-4">
            @php
            $statuts = [
            'nouvelle' => ['icon' => 'fa-plus-circle', 'color' => 'text-blue-500', 'label' => 'Demande créée'],
            'en_cours' => ['icon' => 'fa-spinner', 'color' => 'text-yellow-500', 'label' => 'En traitement'],
            'devis_envoye' => ['icon' => 'fa-file-invoice', 'color' => 'text-purple-500', 'label' => 'Devis envoyé'],
            'confirme' => ['icon' => 'fa-check-circle', 'color' => 'text-green-500', 'label' => 'Devis confirmé'],
            'annule' => ['icon' => 'fa-times-circle', 'color' => 'text-red-500', 'label' => 'Demande annulée'],
            'termine' => ['icon' => 'fa-flag-checkered', 'color' => 'text-gray-500', 'label' => 'Service terminé'],
            ];

            $currentStatut = $demande->statut;
            $statutKeys = array_keys($statuts);
            $currentIndex = array_search($currentStatut, $statutKeys);
            @endphp

            @foreach($statuts as $key => $info)
            @php
            $isActive = array_search($key, $statutKeys) <= $currentIndex; $isCurrent=$key===$currentStatut; @endphp <div
                class="flex items-center">
                <div class="flex-shrink-0">
                    <div
                        class="h-8 w-8 rounded-full flex items-center justify-center
                        {{ $isActive ? $info['color'] . ' bg-opacity-10 ' . str_replace('text-', 'bg-', $info['color']) : 'text-gray-300 bg-gray-100' }}">
                        <i class="fas {{ $info['icon'] }}"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium {{ $isActive ? 'text-gray-900' : 'text-gray-400' }}">
                            {{ $info['label'] }}
                        </p>
                        @if($isCurrent)
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-djok-yellow text-white">
                            Actuel
                        </span>
                        @endif
                    </div>
                    @if($key === 'nouvelle')
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $demande->created_at->format('d/m/Y H:i') }}
                    </p>
                    @elseif($key === $currentStatut && $key !== 'nouvelle')
                    <p class="text-xs text-gray-500 mt-1">
                        Dernière mise à jour : {{ $demande->updated_at->format('d/m/Y H:i') }}
                    </p>
                    @endif
                </div>
        </div>

        @if($key !== 'termine')
        <div class="ml-4 pl-4 border-l-2 {{ $isActive ? 'border-djok-yellow' : 'border-gray-200' }} h-6"></div>
        @endif
        @endforeach
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
