{{-- resources/views/client/factures/index.blade.php --}}

@extends('layouts.client')

@section('title', 'Mes factures')
@section('page-title', 'Mes factures')
@section('page-description', 'Consultez l\'historique de vos paiements et factures')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Factures</span>
    </div>
</li>
@endsection

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Historique des paiements</h3>
        <p class="mt-1 text-sm text-gray-500">Liste de toutes vos transactions payées</p>
    </div>

    @if($paiements->isEmpty())
    <div class="px-4 py-12 text-center">
        <i class="fas fa-file-invoice-dollar text-gray-300 text-5xl mb-4"></i>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune facture disponible</h3>
        <p class="text-gray-500">Vous n'avez pas encore de factures payées dans votre historique.</p>
    </div>
    @else
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
                        Formation
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Montant
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date de paiement
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Méthode
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($paiements as $paiement)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $paiement->reference }}</div>
                        <div class="text-xs text-gray-500">ID: {{ $paiement->id }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $paiement->formation->titre ?? 'N/A' }}
                        </div>
                        @if($paiement->formation)
                        <div class="text-xs text-gray-500">
                            {{ $paiement->formation->type ?? '' }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            {{ number_format($paiement->amount, 2, ',', ' ') }} €
                        </div>
                        @if($paiement->discount_amount > 0)
                        <div class="text-xs text-green-600">
                            -{{ number_format($paiement->discount_amount, 2, ',', ' ') }} €
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $paiement->paid_at ? $paiement->paid_at->format('d/m/Y') : '-' }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $paiement->paid_at ? $paiement->paid_at->format('H:i') : '' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($paiement->payment_method === 'card') bg-blue-100 text-blue-800
                            @elseif($paiement->payment_method === 'transfer') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            @if($paiement->payment_method === 'card')
                            <i class="fas fa-credit-card mr-1"></i> Carte bancaire
                            @elseif($paiement->payment_method === 'transfer')
                            <i class="fas fa-university mr-1"></i> Virement
                            @else
                            {{ $paiement->payment_method }}
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('client.factures.show', $paiement->id) }}"
                            class="text-djok-yellow hover:text-yellow-700 mr-3">
                            <i class="fas fa-eye mr-1"></i> Voir
                        </a>
                        <a href="{{ route('client.factures.download', $paiement->id) }}"
                            class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-download mr-1"></i> PDF
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $paiements->links() }}
    </div>
    @endif
</div>

<!-- Stats -->
<div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-3">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                    <i class="fas fa-receipt text-green-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Factures payées
                        </dt>
                        <dd class="text-lg font-medium text-gray-900">
                            {{ $paiements->total() }}
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
                    <i class="fas fa-money-bill-wave text-blue-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Total dépensé
                        </dt>
                        <dd class="text-lg font-medium text-gray-900">
                            @php
                            $total = $paiements->sum('amount');
                            $totalDiscount = $paiements->sum('discount_amount');
                            $totalNet = $total - $totalDiscount;
                            @endphp
                            {{ number_format($totalNet, 2, ',', ' ') }} €
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                    <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Dernier paiement
                        </dt>
                        <dd class="text-lg font-medium text-gray-900">
                            @if($paiements->isNotEmpty() && $paiements->first()->paid_at)
                            {{ $paiements->first()->paid_at->format('d/m/Y') }}
                            @else
                            -
                            @endif
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
