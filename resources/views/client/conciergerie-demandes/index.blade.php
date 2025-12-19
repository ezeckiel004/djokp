{{-- resources/views/client/conciergerie-demandes/index.blade.php --}}
@extends('layouts.client')

@section('title', 'Mes demandes de conciergerie')
@section('page-title', 'Demandes de conciergerie')
@section('page-description', 'Gérez vos demandes de services conciergerie')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Demandes</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    {{-- Messages de succès/erreur --}}
    @if(session('success'))
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

    {{-- En-tête avec bouton de création --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Mes demandes de conciergerie</h2>
            <p class="text-gray-600">Suivez l'avancement de vos demandes de services</p>
        </div>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            {{-- <a href="{{ route('client.conciergerie-demandes.statistiques') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                <i class="fas fa-chart-bar mr-2"></i> Statistiques
            </a> --}}
            <a href="{{ route('client.conciergerie-demandes.create') }}"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                <i class="fas fa-plus mr-2"></i> Nouvelle demande
            </a>
        </div>
    </div>

    {{-- Filtres --}}
    <div class="mb-6 bg-white shadow rounded-lg p-4">
        <form action="{{ route('client.conciergerie-demandes.filtrer') }}" method="POST"
            class="flex flex-col sm:flex-row sm:items-center sm:space-x-4">
            @csrf
            <div class="flex-1 mb-4 sm:mb-0">
                <label class="block text-sm font-medium text-gray-700 mb-2">Recherche</label>
                <input type="text" name="recherche" value="{{ $recherche ?? '' }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent"
                    placeholder="Référence, nom, message...">
            </div>
            <div class="w-full sm:w-48 mb-4 sm:mb-0">
                <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                <select name="statut"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-djok-yellow focus:border-transparent">
                    <option value="tous" {{ ($statut ?? '' )=='tous' ? 'selected' : '' }}>Tous les statuts</option>
                    @foreach(App\Models\ConciergerieDemande::STATUTS as $key => $label)
                    <option value="{{ $key }}" {{ ($statut ?? '' )==$key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-filter mr-2"></i> Filtrer
                </button>
                @if(($statut ?? '') || ($recherche ?? ''))
                <a href="{{ route('client.conciergerie-demandes.index') }}"
                    class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-times mr-2"></i> Réinitialiser
                </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Tableau des demandes --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        @if($demandes->count() > 0)
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
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Motif
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Arrivée
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Devis
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($demandes as $demande)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $demande->reference }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $demande->created_at->format('d/m/Y') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $demande->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $demande->getMotifLabelAttribute() }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $demande->date_arrivee ? $demande->date_arrivee->format('d/m/Y') : 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
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
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colorClass }}">
                                {{ $demande->getStatutLabelAttribute() }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                @if($demande->montant_devis)
                                <span class="font-semibold">{{ $demande->getMontantFormateAttribute() }}</span>
                                @if($demande->date_devis)
                                <div class="text-xs text-gray-500">
                                    {{ $demande->date_devis->format('d/m/Y') }}
                                </div>
                                @endif
                                @else
                                <span class="text-gray-500">En attente</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('client.conciergerie-demandes.show', $demande->id) }}"
                                class="text-djok-yellow hover:text-yellow-700 mr-4">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            @if($demande->statut === 'nouvelle')
                            <form action="{{ route('client.conciergerie-demandes.destroy', $demande->id) }}"
                                method="POST" class="inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette demande ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-times"></i> Annuler
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $demandes->links() }}
        </div>
        @else
        {{-- Aucune demande --}}
        <div class="text-center py-12">
            <div class="mx-auto h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-concierge-bell text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune demande</h3>
            <p class="text-gray-500 mb-6">Vous n'avez pas encore de demande de conciergerie.</p>
            <a href="{{ route('client.conciergerie-demandes.create') }}"
                class="inline-flex items-center px-4 py-2 bg-djok-yellow text-white font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                <i class="fas fa-plus mr-2"></i> Créer une demande
            </a>
            <p class="mt-4 text-sm text-gray-500">
                ou <a href="{{ route('conciergerie') }}" class="text-djok-yellow hover:text-yellow-700">consultez nos
                    services de conciergerie</a>
            </p>
        </div>
        @endif
    </div>

    {{-- Informations --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg font-medium text-blue-900">Suivi de vos demandes</h4>
                    <p class="text-blue-700 mt-2">
                        Chaque demande est traitée dans les 24 heures ouvrées. Vous recevrez un email à chaque
                        changement de statut.
                    </p>
                    <ul class="mt-3 space-y-2 text-sm text-blue-600">
                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Réponse sous 24h maximum</li>
                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Devis personnalisé gratuit</li>
                        <li><i class="fas fa-check-circle text-green-500 mr-2"></i> Modifications possibles avant
                            confirmation</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-question-circle text-gray-500 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg font-medium text-gray-900">Besoin d'aide ?</h4>
                    <p class="text-gray-700 mt-2">
                        Contactez notre service conciergerie pour toute question concernant vos demandes.
                    </p>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone-alt mr-2"></i>
                            <span>01 76 38 00 17</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>conciergerie@djokprestige.com</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fab fa-whatsapp mr-2"></i>
                            <span>WhatsApp : Disponible 24h/24</span>
                        </div>
                    </div>
                </div>
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
