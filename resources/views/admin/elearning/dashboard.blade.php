@extends('layouts.admin')

@section('title', 'Dashboard E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard E-learning</h1>
                <p class="text-gray-600 mt-1">Gestion des formations en ligne</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.elearning.forfaits.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Nouveau forfait
                </a>
                <a href="{{ route('admin.elearning.statistics') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-chart-bar mr-2"></i>
                    Statistiques
                </a>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_acces'] }}</div>
                    <div class="text-gray-600">Accès totaux</div>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    {{ $stats['active_acces'] }} actifs
                </span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-euro-sign text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['revenue'], 0, ',', ' ') }} €
                    </div>
                    <div class="text-gray-600">Chiffre d'affaires</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-purple-100 text-purple-600 mr-4">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_cours'] }}</div>
                    <div class="text-gray-600">Cours disponibles</div>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-green-600">
                    <i class="fas fa-check mr-1"></i>
                    {{ $stats['active_cours'] }} actifs
                </span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-chart-line text-xl"></i>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['average_progression'], 1) }}%
                    </div>
                    <div class="text-gray-600">Progression moyenne</div>
                </div>
            </div>
            <div class="mt-4">
                <span class="text-sm text-blue-600">
                    <i class="fas fa-star mr-1"></i>
                    Score: {{ number_format($stats['average_score'], 1) }}%
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Accès récents -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Accès récents</h2>
                <a href="{{ route('admin.elearning.acces') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    Voir tous →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Utilisateur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Forfait
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date fin
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($recentAcces as $acces)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $acces->prenom }} {{ $acces->nom }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $acces->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $acces->forfait->name }}</div>
                                <div class="text-xs text-gray-500">{{ $acces->forfait->duration_days }} jours</div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                $statusColors = [
                                'active' => 'bg-green-100 text-green-800',
                                'expired' => 'bg-red-100 text-red-800',
                                'suspended' => 'bg-yellow-100 text-yellow-800',
                                ];
                                @endphp
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$acces->status] ?? 'bg-gray-100' }}">
                                    {{ $acces->status === 'active' ? 'Actif' : ($acces->status === 'expired' ? 'Expiré'
                                    : 'Suspendu') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $acces->access_end->format('d/m/Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Accès expirant -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Accès expirant bientôt</h2>
                <p class="text-sm text-gray-600">Prochains 7 jours</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Utilisateur
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jours restants
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Progression
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($expiringAcces as $acces)
                        @php
                        $daysLeft = $acces->access_end->diffInDays(now());
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $acces->prenom }} {{ $acces->nom }}
                                </div>
                                <div class="text-xs text-gray-500">{{ $acces->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($daysLeft <= 3) <span class="text-red-600 font-bold">{{ $daysLeft }}
                                        jour(s)</span>
                                        <i class="fas fa-exclamation-triangle text-red-500 ml-2"></i>
                                        @elseif($daysLeft <= 7) <span class="text-yellow-600 font-medium">{{ $daysLeft
                                            }} jour(s)</span>
                                            @else
                                            <span class="text-gray-600">{{ $daysLeft }} jour(s)</span>
                                            @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-16 h-2 bg-gray-200 rounded-full overflow-hidden mr-2">
                                        <div class="h-full bg-green-500"
                                            style="width: {{ $acces->progression_percentage }}%"></div>
                                    </div>
                                    <span class="text-xs">{{ number_format($acces->progression_percentage, 1) }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.elearning.acces.show', $acces->id) }}"
                                    class="text-blue-600 hover:text-blue-800 text-sm">
                                    <i class="fas fa-eye mr-1"></i>
                                    Voir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @if($expiringAcces->isEmpty())
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Aucun accès n'expire dans les 7 prochains jours
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.elearning.cours') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 mr-4">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Gérer les cours</h3>
                    <p class="text-sm text-gray-600 mt-1">Ajouter, modifier ou supprimer des cours</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.elearning.qcms') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-green-100 text-green-600 mr-4">
                    <i class="fas fa-question-circle text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Gérer les QCM</h3>
                    <p class="text-sm text-gray-600 mt-1">Créer des QCM et examens blancs</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.elearning.sessions.active') }}"
            class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-lg bg-yellow-100 text-yellow-600 mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900">Sessions actives</h3>
                    <p class="text-sm text-gray-600 mt-1">Voir et gérer les connexions en cours</p>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
