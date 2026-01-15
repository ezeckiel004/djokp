@extends('layouts.admin')

@section('title', 'Gestion des paiements | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des paiements</h1>
                <p class="text-gray-600 mt-1">Suivi des transactions multi-services</p>
            </div>
            <div class="flex space-x-3">
                <!-- Bouton Statistiques -->
                <a href="{{ route('admin.paiements.statistiques') }}"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Statistiques
                </a>

                <!-- Filtres -->
                <div class="flex space-x-2">
                    <select id="serviceTypeFilter"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        onchange="filterByServiceType(this.value)">
                        <option value="">Tous les services</option>
                        <option value="formation" {{ request('service_type')=='formation' ? 'selected' : '' }}>
                            Formations</option>
                        <option value="reservation" {{ request('service_type')=='reservation' ? 'selected' : '' }}>
                            Réservations VTC</option>
                        <option value="location" {{ request('service_type')=='location' ? 'selected' : '' }}>Locations
                        </option>
                        <option value="conciergerie" {{ request('service_type')=='conciergerie' ? 'selected' : '' }}>
                            Conciergerie</option>
                        <option value="formation_internationale" {{ request('service_type')=='formation_internationale'
                            ? 'selected' : '' }}>Formations internationales</option>
                    </select>

                    <select id="statusFilter"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        onchange="filterByStatus(this.value)">
                        <option value="">Tous les statuts</option>
                        <option value="paid" {{ request('status')=='paid' ? 'selected' : '' }}>Payés</option>
                        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>En attente</option>
                        <option value="canceled" {{ request('status')=='canceled' ? 'selected' : '' }}>Annulés</option>
                        <option value="failed" {{ request('status')=='failed' ? 'selected' : '' }}>Échoués</option>
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

    <!-- Distribution par service -->
    <div class="mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Répartition par service</h3>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($statistiques['par_service'] as $serviceType => $count)
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $count }}</div>
                    <div class="text-sm text-gray-600">
                        @if($serviceType === 'formation')
                        Formations
                        @elseif($serviceType === 'reservation')
                        Réservations
                        @elseif($serviceType === 'location')
                        Locations
                        @elseif($serviceType === 'conciergerie')
                        Conciergerie
                        @elseif($serviceType === 'formation_internationale')
                        Form. Int.
                        @else
                        {{ $serviceType }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Liste des paiements -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Liste des transactions</h2>
            <p class="text-sm text-gray-600 mt-1">{{ $paiements->total() }} transactions trouvées</p>
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
                            Service</th>
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
                    @forelse($paiements as $paiement)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-mono text-sm text-gray-900">{{ $paiement->reference }}</div>
                            <div class="text-xs text-gray-500">Stripe: {{ substr($paiement->stripe_session_id ?? 'N/A',
                                0, 10) }}...</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $paiement->customer_name }}</div>
                            <div class="text-xs text-gray-500">{{ $paiement->customer_email ?? 'N/A' }}</div>
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
                            <div class="flex items-center">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $paiement->service_type_color }}">
                                    {{ $paiement->formatted_service_type }}
                                </span>
                                <span class="ml-2 text-sm text-gray-900">
                                    @if($paiement->isFormation() && $paiement->formation)
                                    {{ Str::limit($paiement->formation->title, 25) }}
                                    @elseif($paiement->isReservation() && $paiement->reservation)
                                    {{ Str::limit($paiement->reservation->depart, 15) }} → {{
                                    Str::limit($paiement->reservation->arrivee, 15) }}
                                    @else
                                    {{ Str::limit($paiement->service_name, 30) }}
                                    @endif
                                </span>
                            </div>
                            @if($paiement->isReservation() && $paiement->reservation)
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $paiement->reservation->type_vehicule }} • {{ $paiement->reservation->passagers }}
                                pers.
                            </div>
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
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('admin.paiements.show', $paiement) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors text-xs">
                                    <i class="fas fa-eye mr-1"></i>
                                    Détails
                                </a>

                                @if($paiement->isReservation() && $paiement->reservation)
                                <a href="{{ route('admin.reservations.show', $paiement->reservation_id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors text-xs">
                                    <i class="fas fa-car mr-1"></i>
                                    Réservation
                                </a>
                                @endif

                                @if($paiement->isFormation() && $paiement->formation)
                                <a href="{{ route('admin.formations.show', $paiement->service_id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors text-xs">
                                    <i class="fas fa-graduation-cap mr-1"></i>
                                    Formation
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-receipt text-4xl text-gray-300 mb-4"></i>
                                <p class="text-lg font-medium text-gray-900">Aucun paiement trouvé</p>
                                <p class="text-gray-600 mt-1">Aucune transaction n'a été enregistrée pour le moment.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
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
@endsection

@section('scripts')
<script>
    function filterByServiceType(serviceType) {
        const url = new URL(window.location.href);
        
        if (serviceType) {
            url.searchParams.set('service_type', serviceType);
        } else {
            url.searchParams.delete('service_type');
        }
        
        window.location.href = url.toString();
    }
    
    function filterByStatus(status) {
        const url = new URL(window.location.href);
        
        if (status) {
            url.searchParams.set('status', status);
        } else {
            url.searchParams.delete('status');
        }
        
        window.location.href = url.toString();
    }
</script>
@endsection