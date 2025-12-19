{{-- resources/views/client/factures/show.blade.php --}}

@extends('layouts.client')

@section('title', 'Facture #' . $paiement->reference)
@section('page-title', 'Facture #' . $paiement->reference)
@section('page-description', 'Détails de votre transaction')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.factures.index') }}" class="text-gray-700 hover:text-djok-yellow">
            Factures
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Détails</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Facture #{{ $paiement->reference }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Date d'émission: {{ $paiement->created_at->format('d/m/Y') }}
                    </p>
                </div>
                <div class="text-right">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i> Payée
                    </span>
                </div>
            </div>
        </div>

        <!-- Client & Company Info -->
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Client Info -->
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Facturé à</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-medium text-gray-900">{{ $paiement->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $paiement->user->email }}</p>
                        @if($paiement->user->phone)
                        <p class="text-sm text-gray-600">{{ $paiement->user->phone }}</p>
                        @endif
                    </div>
                </div>

                <!-- Company Info -->
                <div>
                    <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Émetteur</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="font-medium text-gray-900">DJOK PRESTIGE</p>
                        <p class="text-sm text-gray-600">Service Formation</p>
                        <p class="text-sm text-gray-600">contact@djokprestige.com</p>
                        <p class="text-sm text-gray-600">+33 1 23 45 67 89</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="border-t border-gray-200">
            <div class="px-4 py-5 sm:px-6">
                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Détails de la commande</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Montant</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $paiement->formation->titre ?? 'Formation'
                                        }}</div>
                                    @if($paiement->formation)
                                    <div class="text-sm text-gray-500">{{ $paiement->formation->description ?? '' }}
                                    </div>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        Formation
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-lg font-medium text-gray-900">
                                    {{ number_format($paiement->amount, 2, ',', ' ') }} €
                                </td>
                            </tr>

                            @if($paiement->discount_amount > 0)
                            <tr class="bg-green-50">
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">Remise</div>
                                    <div class="text-sm text-gray-500">Code promo ou réduction</div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Réduction
                                    </span>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-lg font-medium text-green-600">
                                    -{{ number_format($paiement->discount_amount, 2, ',', ' ') }} €
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-gray-50 px-4 py-5 sm:px-6 border-t border-gray-200">
            <div class="flex justify-end">
                <div class="w-full md:w-1/3">
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Sous-total</dt>
                            <dd class="text-sm text-gray-900">{{ number_format($paiement->amount, 2, ',', ' ') }} €</dd>
                        </div>

                        @if($paiement->discount_amount > 0)
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Remise</dt>
                            <dd class="text-sm text-green-600">-{{ number_format($paiement->discount_amount, 2, ',', '
                                ') }} €</dd>
                        </div>
                        @endif

                        <div class="border-t pt-2">
                            <div class="flex justify-between">
                                <dt class="text-base font-bold text-gray-900">Total</dt>
                                <dd class="text-base font-bold text-gray-900">
                                    {{ number_format($paiement->amount - $paiement->discount_amount, 2, ',', ' ') }} €
                                </dd>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="px-4 py-5 sm:px-6 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Informations de paiement</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-500">Méthode de paiement</p>
                    <p class="font-medium text-gray-900">
                        @if($paiement->payment_method === 'card')
                        <i class="fas fa-credit-card mr-2"></i>Carte bancaire
                        @elseif($paiement->payment_method === 'transfer')
                        <i class="fas fa-university mr-2"></i>Virement bancaire
                        @else
                        {{ $paiement->payment_method }}
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Date de paiement</p>
                    <p class="font-medium text-gray-900">
                        {{ $paiement->paid_at ? $paiement->paid_at->format('d/m/Y à H:i') : 'Non payé' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex justify-end space-x-3">
        <a href="{{ route('client.factures.index') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
            <i class="fas fa-arrow-left mr-2"></i> Retour aux factures
        </a>
        <a href="{{ route('client.factures.download', $paiement->id) }}"
            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-djok-yellow hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
            <i class="fas fa-download mr-2"></i> Télécharger en PDF
        </a>
    </div>
</div>
@endsection
