@extends('layouts.admin')

@section('title', 'Statistiques Conciergerie')

@section('page-actions')
<a href="{{ route('admin.conciergerie-demandes.index') }}"
    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all duration-300 transform hover:scale-105">
    <i class="fas fa-arrow-left mr-2"></i> Retour aux demandes
</a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Cartes de statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-file-alt text-3xl text-blue-500"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $total }}</h3>
                    <p class="text-sm font-medium text-gray-500">Total demandes</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-3xl text-yellow-500"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $nouvelles }}</h3>
                    <p class="text-sm font-medium text-gray-500">Nouvelles demandes</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $confirmees }}</h3>
                    <p class="text-sm font-medium text-gray-500">Confirmées</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-euro-sign text-3xl text-purple-500"></i>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900">{{ number_format($chiffreAffairesTotal, 2, ',', ' ') }}
                        €</h3>
                    <p class="text-sm font-medium text-gray-500">Chiffre d'affaires</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique d'évolution mensuelle -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Évolution mensuelle</h3>
        </div>
        <div class="p-6">
            @if($statsMensuelles->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mois
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nouvelles
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Confirmées
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                CA (€)
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($statsMensuelles as $stats)
                        <tr>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ \Carbon\Carbon::createFromFormat('Y-m', $stats->mois)->format('M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $stats->total }}
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $stats->nouvelles }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $stats->confirmees }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                {{ number_format($stats->chiffre_affaires, 2, ',', ' ') }} €
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-chart-line text-4xl mb-3 text-gray-300"></i>
                <p>Aucune donnée disponible pour l'analyse mensuelle</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Répartition par statut et motif -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Répartition par statut -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Répartition par statut</h3>
            </div>
            <div class="p-6">
                @if($statsParStatut->count() > 0)
                <div class="space-y-4">
                    @foreach($statsParStatut as $statut => $stats)
                    <div>
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">
                                {{ App\Models\ConciergerieDemande::STATUTS[$statut] ?? $statut }}
                            </span>
                            <span class="text-sm font-medium text-gray-900">{{ $stats->count }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-{{ $statut == 'nouvelle' ? 'yellow' : ($statut == 'confirme' ? 'green' : 'blue') }}-500 h-2.5 rounded-full"
                                style="width: {{ ($stats->count / $total) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <p>Aucune donnée disponible</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Répartition par motif -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Répartition par motif</h3>
            </div>
            <div class="p-6">
                @if($statsParMotif->count() > 0)
                <div class="space-y-3">
                    @foreach($statsParMotif as $stats)
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-700">{{ $stats->motif }}</span>
                        <span class="text-sm font-medium text-gray-900">{{ $stats->count }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <p>Aucune donnée disponible</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Services les plus demandés -->
    @if($servicesDemandes->count() > 0)
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Services les plus demandés</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($servicesDemandes as $service => $count)
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">{{ $service }}</span>
                        <span class="text-sm font-medium text-gray-900">{{ $count }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-djok-yellow h-2.5 rounded-full"
                            style="width: {{ ($count / $servicesDemandes->max()) * 100 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Statistiques additionnelles -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex flex-col items-center text-center">
                <i class="fas fa-file-invoice-dollar text-4xl text-green-500 mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900">Devis envoyés</h4>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $devisEnvoyes }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex flex-col items-center text-center">
                <i class="fas fa-ban text-4xl text-red-500 mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900">Annulées</h4>
                <p class="text-2xl font-bold text-gray-900 mt-2">{{ $annulees }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex flex-col items-center text-center">
                <i class="fas fa-calculator text-4xl text-purple-500 mb-4"></i>
                <h4 class="text-lg font-medium text-gray-900">Moyenne devis</h4>
                <p class="text-2xl font-bold text-gray-900 mt-2">
                    {{ number_format($moyenneDevis ?? 0, 2, ',', ' ') }} €
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-yellow-500 {
        background-color: #ecc94b;
    }

    .bg-green-500 {
        background-color: #48bb78;
    }

    .bg-blue-500 {
        background-color: #4299e1;
    }
</style>
@endpush