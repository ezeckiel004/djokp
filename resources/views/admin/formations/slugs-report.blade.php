@extends('layouts.admin')

@section('title', 'Rapport des slugs des formations')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Rapport des slugs des formations</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.formations.check-slugs-admin') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Vérifier les doublons
            </a>
            <form action="{{ route('admin.formations.fix-all-slugs-admin') }}" method="POST" class="inline">
                @csrf
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir corriger tous les slugs ?')"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Corriger tous les slugs
                </button>
            </form>
            <a href="{{ route('admin.formations.index') }}"
                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                Retour aux formations
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-600 mr-2"></i>
            <span class="text-green-800">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('warning'))
    <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
            <span class="text-yellow-800">{{ session('warning') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-times-circle text-red-600 mr-2"></i>
            <span class="text-red-800">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-gray-900">{{ $analysis['total'] }}</div>
            <div class="text-sm text-gray-500">Total formations</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-green-600">{{ $analysis['with_presentiel_suffix'] }}</div>
            <div class="text-sm text-gray-500">Avec "-presentiel"</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-blue-600">{{ $analysis['with_en_ligne_suffix'] }}</div>
            <div class="text-sm text-gray-500">Avec "-en-ligne"</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-yellow-600">{{ $analysis['without_suffix'] }}</div>
            <div class="text-sm text-gray-500">Sans suffixe</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-green-600">{{ $analysis['active'] }}</div>
            <div class="text-sm text-gray-500">Actives</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-red-600">{{ $analysis['inactive'] }}</div>
            <div class="text-sm text-gray-500">Inactives</div>
        </div>
    </div>

    <!-- Liste des formations -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug
                        actuel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($formations as $formation)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $formation->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <div class="truncate max-w-xs">{{ $formation->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $formation->slug }}</code>
                            @if(str_contains($formation->slug, '-presentiel') && $formation->type_formation ===
                            'presentiel')
                            <i class="fas fa-check text-green-500 ml-2" title="Slug correct"></i>
                            @elseif(str_contains($formation->slug, '-en-ligne') && $formation->type_formation ===
                            'e_learning')
                            <i class="fas fa-check text-green-500 ml-2" title="Slug correct"></i>
                            @else
                            <i class="fas fa-exclamation-triangle text-yellow-500 ml-2" title="Slug incorrect"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 py-1 text-xs rounded-full {{ $formation->type_formation === 'e_learning' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $formation->type_formation === 'e_learning' ? 'E-learning' : 'Présentiel' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $formation->getFormattedTypeAttribute() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span
                            class="px-2 py-1 text-xs rounded-full {{ $formation->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $formation->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.formations.admin-fix-slug', $formation->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600"
                                onclick="return confirm('Corriger le slug de cette formation ?')">
                                Corriger
                            </a>
                            <a href="{{ route('admin.formations.show', $formation) }}"
                                class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                                Voir
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Instructions -->
    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">Instructions pour les slugs :</h3>
        <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1">
            <li>Les slugs corrects doivent inclure le suffixe correspondant au type de formation :</li>
            <ul class="list-circle pl-5 mt-1">
                <li>Formations <strong>présentiel</strong> : <code>nom-formation-presentiel</code></li>
                <li>Formations <strong>e-learning</strong> : <code>nom-formation-en-ligne</code></li>
            </ul>
            <li>Les icônes indiquent si le slug est correct : ✓ vert (correct), ⚠ jaune (à corriger)</li>
            <li>Cliquez sur "Corriger" pour regénérer le slug d'une formation spécifique</li>
            <li>Utilisez "Corriger tous les slugs" pour mettre à jour toutes les formations</li>
            <li>Vérifiez les doublons avant de corriger</li>
        </ul>
    </div>
</div>
@endsection
