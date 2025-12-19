@extends('layouts.admin')

@section('title', 'Statistiques Newsletter')

@section('page-actions')
<a href="{{ route('admin.newsletter.campaigns.create') }}"
    class="inline-flex items-center px-4 py-2 bg-djok-yellow text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
    <i class="fas fa-plus mr-2"></i> Nouvelle campagne
</a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Statistiques principales -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-users text-blue-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total abonnés</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalSubscribers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-check text-green-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Abonnés actifs</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $activeSubscribers }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-user-slash text-red-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Taux de désabonnement</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($unsubscribedRate, 1) }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-chart-line text-purple-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Taux d'ouverture moyen</p>
                        <p class="text-3xl font-bold text-gray-900">{{ number_format($averageOpenRate, 1) }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deuxième ligne de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-paper-plane text-indigo-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Total campagnes</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalCampaigns }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Campagnes envoyées</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $sentCampaigns }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg border">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-percentage text-orange-500 text-3xl"></i>
                    </div>
                    <div class="ml-5">
                        <p class="text-sm font-medium text-gray-500">Performance moyenne</p>
                        <div class="text-3xl font-bold text-gray-900">{{ number_format($averageOpenRate, 1) }}%</div>
                        <p class="text-sm text-gray-500 mt-1">Taux d'ouverture</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques et tableaux -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Évolution des inscriptions -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Évolution des inscriptions (30 jours)</h3>
                <p class="mt-1 text-sm text-gray-500">Nouvelles inscriptions par jour.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                @if($subscriptionGrowth->count() > 0)
                <div class="space-y-4">
                    @foreach($subscriptionGrowth as $day)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">{{ \Carbon\Carbon::parse($day->date)->format('d/m') }}</span>
                            <span class="font-medium">{{ $day->count }} inscription(s)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-djok-yellow h-2 rounded-full"
                                style="width: {{ ($day->count / max($subscriptionGrowth->max('count'), 1)) * 100 }}%">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <i class="fas fa-chart-line text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucune donnée disponible pour les 30 derniers jours</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Sources d'inscription -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Sources d'inscription</h3>
                <p class="mt-1 text-sm text-gray-500">D'où viennent vos abonnés.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                @if($subscriptionSources->count() > 0)
                <div class="space-y-4">
                    @foreach($subscriptionSources as $source)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-600">{{ $source->source ?: 'Direct' }}</span>
                            <span class="font-medium">{{ $source->count }} ({{ number_format(($source->count /
                                $totalSubscribers) * 100, 1) }}%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full"
                                style="width: {{ ($source->count / $totalSubscribers) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <i class="fas fa-funnel-dollar text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucune donnée de source disponible</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Campagnes récentes -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Campagnes récentes</h3>
            <p class="mt-1 text-sm text-gray-500">Les 5 dernières campagnes envoyées.</p>
        </div>
        <div class="border-t border-gray-200">
            @if($recentCampaigns->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sujet
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Destinataires
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Performance
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentCampaigns as $campaign)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
                                        class="hover:text-djok-yellow">
                                        {{ Str::limit($campaign->subject, 40) }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($campaign->sent_at)
                                <div class="text-sm text-gray-900">{{ $campaign->sent_at->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $campaign->sent_at->format('H:i') }}</div>
                                @else
                                <div class="text-sm text-gray-500">-</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $campaign->total_recipients }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <div class="text-sm font-medium text-green-600">{{
                                            number_format($campaign->openRate(), 1) }}%</div>
                                        <div class="text-xs text-gray-500">Ouverture</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm font-medium text-blue-600">{{
                                            number_format($campaign->clickRate(), 1) }}%</div>
                                        <div class="text-xs text-gray-500">Clics</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
                                    class="text-djok-yellow hover:text-yellow-700 mr-3" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-4 py-12 text-center">
                <i class="fas fa-envelope-open-text text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-500">Aucune campagne récente disponible</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Analyse de performance -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Analyse de performance</h3>
            <p class="mt-1 text-sm text-gray-500">Indicateurs clés de vos campagnes.</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 border rounded-lg">
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ number_format($averageOpenRate, 1) }}%</div>
                    <div class="text-lg font-medium text-gray-900">Taux d'ouverture moyen</div>
                    <p class="text-sm text-gray-500 mt-2">Pourcentage d'emails ouverts</p>
                </div>

                <div class="text-center p-6 border rounded-lg">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $activeSubscribers }}</div>
                    <div class="text-lg font-medium text-gray-900">Audience active</div>
                    <p class="text-sm text-gray-500 mt-2">Abonnés actuellement actifs</p>
                </div>

                <div class="text-center p-6 border rounded-lg">
                    <div class="text-4xl font-bold text-purple-600 mb-2">{{ number_format($sentCampaigns > 0 ?
                        $totalSubscribers / $sentCampaigns : 0, 1) }}</div>
                    <div class="text-lg font-medium text-gray-900">Engagement moyen</div>
                    <p class="text-sm text-gray-500 mt-2">Campagnes par abonné</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .progress-bar {
        transition: width 0.5s ease-in-out;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Animation des barres de progression
    const progressBars = document.querySelectorAll('.bg-djok-yellow, .bg-blue-500, .bg-green-600, .bg-blue-600');
    progressBars.forEach(bar => {
        const originalWidth = bar.style.width;
        bar.style.width = '0%';
        setTimeout(() => {
            bar.style.width = originalWidth;
        }, 100);
    });
});
</script>
@endpush
