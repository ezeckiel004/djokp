@extends('layouts.admin')

@section('title', 'Statistiques des paiements | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Statistiques des paiements</h1>
                <p class="text-gray-600 mt-1">Analyse des performances financières</p>
            </div>
            <div class="flex space-x-3">
                <!-- Filtre période -->
                <div class="flex space-x-2">
                    <select id="periodeFilter" onchange="window.location.href='?periode='+this.value"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="mois" {{ $periode=='mois' ? 'selected' : '' }}>Par mois</option>
                        <option value="semaine" {{ $periode=='semaine' ? 'selected' : '' }}>Par semaine</option>
                        <option value="jour" {{ $periode=='jour' ? 'selected' : '' }}>Par jour</option>
                    </select>

                    <a href="{{ route('admin.paiements.export') }}?periode={{ $periode }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-file-export mr-2"></i>
                        Exporter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total paiements -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-receipt text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $statistiques['total_paiements'] }}</div>
                    <div class="text-gray-600">Total paiements</div>
                </div>
            </div>
        </div>

        <!-- Paiements payés -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $statistiques['paiements_payes'] }}</div>
                    <div class="text-gray-600">Paiements payés</div>
                </div>
            </div>
        </div>

        <!-- Taux de conversion -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $statistiques['taux_conversion'] }}%</div>
                    <div class="text-gray-600">Taux de conversion</div>
                </div>
            </div>
        </div>

        <!-- Chiffre d'affaires -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-euro-sign text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ number_format($statistiques['chiffre_affaires'], 0,
                        ',', ' ') }} €</div>
                    <div class="text-gray-600">Chiffre d'affaires</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Évolution des paiements -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Évolution des paiements</h3>
            <div class="h-64">
                <canvas id="evolutionChart"></canvas>
            </div>
        </div>

        <!-- Répartition par service -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Répartition par service</h3>
            <div class="h-64">
                <canvas id="serviceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Derniers paiements -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Derniers paiements</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Référence
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Service
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($paiementsRecents as $paiement)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.paiements.show', $paiement) }}"
                                class="text-blue-600 hover:text-blue-800 font-mono text-sm">
                                {{ $paiement->reference }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $paiement->customer_name }}</div>
                            <div class="text-xs text-gray-500">{{ $paiement->customer_email ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $paiement->service_type_color }}">
                                {{ $paiement->formatted_service_type }}
                            </span>
                            <div class="text-xs text-gray-600 mt-1">{{ Str::limit($paiement->service_name, 30) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-green-600">
                                {{ number_format($paiement->amount, 0, ',', ' ') }} €
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $paiement->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Aucun paiement récent
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Meilleurs clients -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Top 10 clients</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre de paiements
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Montant total
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Panier moyen
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($meilleursClients as $client)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            @if($client->user)
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-gray-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $client->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $client->user->email }}</div>
                                </div>
                            </div>
                            @else
                            <div class="text-sm text-gray-500">Client sans compte</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $client->paiements_count }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-green-600">
                                {{ number_format($client->total_depense, 0, ',', ' ') }} €
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ number_format($client->total_depense / $client->paiements_count, 0, ',', ' ') }} €
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                            Aucun client avec des paiements
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Évolution des paiements
        const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
        const evolutionDates = @json(array_column($evolution, 'date'));
        const evolutionMontants = @json(array_column($evolution, 'montant'));
        const evolutionNombres = @json(array_column($evolution, 'nombre'));
        
        new Chart(evolutionCtx, {
            type: 'line',
            data: {
                labels: evolutionDates,
                datasets: [
                    {
                        label: 'Montant (€)',
                        data: evolutionMontants,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        yAxisID: 'y',
                        tension: 0.4
                    },
                    {
                        label: 'Nombre',
                        data: evolutionNombres,
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        yAxisID: 'y1',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Montant (€)'
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('fr-FR') + ' €';
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Nombre'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });

        // Répartition par service
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        const serviceLabels = @json($repartitionService->pluck('service_type')->map(function($type) {
            switch($type) {
                case 'formation': return 'Formations';
                case 'reservation': return 'Réservations';
                case 'location': return 'Locations';
                case 'conciergerie': return 'Conciergerie';
                case 'formation_internationale': return 'Form. Int.';
                default: return $type;
            }
        }));
        const serviceData = @json($repartitionService->pluck('total'));
        const serviceCounts = @json($repartitionService->pluck('count'));
        
        new Chart(serviceCtx, {
            type: 'doughnut',
            data: {
                labels: serviceLabels,
                datasets: [{
                    data: serviceData,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(139, 92, 246)',
                        'rgb(245, 158, 11)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const count = serviceCounts[context.dataIndex] || 0;
                                return `${label}: ${value.toLocaleString('fr-FR')} € (${count} paiements)`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection