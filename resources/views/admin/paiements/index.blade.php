@extends('layouts.admin')

@section('title', 'Gestion des paiements | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des paiements</h1>
                <p class="text-gray-600 mt-1">Suivi des transactions e-learning</p>
            </div>
            <div class="flex space-x-3">
                <!-- Filtres -->
                <div class="flex space-x-2">
                    <select id="statusFilter"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        onchange="window.location.href='?status='+this.value">
                        <option value="">Tous les statuts</option>
                        <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Payés</option>
                        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>En attente</option>
                        <option value="canceled" {{ request('status')=='canceled' ? 'selected' : '' }}>Annulés</option>
                        <option value="refunded" {{ request('status')=='refunded' ? 'selected' : '' }}>Remboursés
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages de succès/erreur -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-money-check-alt text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $statistiques['total'] }}</div>
                    <div class="text-gray-600">Total paiements</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $statistiques['payes'] }}</div>
                    <div class="text-gray-600">Payés</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $statistiques['en_attente'] }}</div>
                    <div class="text-gray-600">En attente</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-euro-sign text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ number_format($statistiques['total_amount'], 0,
                        ',', ' ') }} €</div>
                    <div class="text-gray-600">Chiffre d'affaires</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des paiements -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Liste des transactions</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Référence</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Formation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($paiements as $paiement)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-mono text-sm text-gray-900">{{ $paiement->reference }}</div>
                            <div class="text-xs text-gray-500">Stripe: {{ substr($paiement->stripe_session_id ?? 'N/A',
                                0, 10) }}...</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $paiement->customer_info['name'] ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-500">{{ $paiement->customer_info['email'] ?? 'N/A' }}</div>
                            @if($paiement->user)
                            <div class="text-xs">
                                <a href="{{ route('admin.users.show', $paiement->user_id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-user mr-1"></i> Compte
                                </a>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($paiement->formation)
                            <div class="text-sm text-gray-900">{{ Str::limit($paiement->formation->title, 30) }}</div>
                            <div class="text-xs text-gray-500">{{ $paiement->formation->type_formation === 'e_learning'
                                ? 'E-learning' : 'Présentiel' }}</div>
                            @else
                            <div class="text-sm text-gray-500">Formation supprimée</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ number_format($paiement->amount, 0, ',',
                                ' ') }} €</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                            $statusColors = [
                            'paid' => 'bg-green-100 text-green-800',
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'canceled' => 'bg-red-100 text-red-800',
                            'refunded' => 'bg-purple-100 text-purple-800',
                            'failed' => 'bg-gray-100 text-gray-800',
                            ];
                            @endphp
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$paiement->status] ?? 'bg-gray-100 text-gray-800' }}">
                                @if($paiement->status === 'paid')
                                Payé
                                @elseif($paiement->status === 'pending')
                                En attente
                                @elseif($paiement->status === 'canceled')
                                Annulé
                                @elseif($paiement->status === 'refunded')
                                Remboursé
                                @elseif($paiement->status === 'failed')
                                Échoué
                                @else
                                {{ $paiement->status }}
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $paiement->created_at->format('d/m/Y') }}<br>
                            <span class="text-xs">{{ $paiement->created_at->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.paiements.show', $paiement) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors mr-2">
                                <i class="fas fa-eye mr-1"></i>
                                Détails
                            </a>
                            @if($paiement->status === 'paid')
                            <button
                                onclick="openRefundModal('{{ $paiement->reference }}', '{{ $paiement->id }}', '{{ number_format($paiement->amount, 0, ',', ' ') }} €')"
                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">
                                <i class="fas fa-undo mr-1"></i>
                                Rembourser
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($paiements->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $paiements->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal de remboursement global -->
<div id="globalRefundModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Confirmer le remboursement</h3>
            <button type="button" onclick="closeRefundModal()" class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mb-4">
            <p class="text-gray-700">Rembourser le paiement <span id="refundReference" class="font-semibold"></span> ?
            </p>
            <p class="text-sm text-gray-600 mt-1">Montant : <span id="refundAmount" class="font-semibold"></span></p>
        </div>

        <form id="refundForm" method="POST">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="refundReason" class="block text-sm font-medium text-gray-700 mb-2">Raison du remboursement
                    (optionnel)</label>
                <textarea name="reason" id="refundReason" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Raison du remboursement..."></textarea>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                    <p class="text-sm text-yellow-800">
                        <strong>Attention :</strong> Cette action est irréversible. Le client sera remboursé via Stripe.
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeRefundModal()"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Confirmer le remboursement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openRefundModal(reference, paiementId, amount) {
        document.getElementById('refundReference').textContent = reference;
        document.getElementById('refundAmount').textContent = amount;
        document.getElementById('refundForm').action = `/admin/paiements/${paiementId}/refund`;
        document.getElementById('globalRefundModal').classList.remove('hidden');
    }

    function closeRefundModal() {
        document.getElementById('globalRefundModal').classList.add('hidden');
    }

    // Fermer le modal si on clique en dehors
    document.getElementById('globalRefundModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRefundModal();
        }
    });

    // Filtrer par statut
    document.getElementById('statusFilter').addEventListener('change', function() {
        const status = this.value;
        const url = new URL(window.location.href);

        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }

        window.location.href = url.toString();
    });
</script>
@endsection
