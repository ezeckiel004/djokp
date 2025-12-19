@extends('layouts.admin')

@section('title', 'Gestion des slugs des formations')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Gestion des slugs des formations</h1>
        <div class="space-x-2">
            <a href="{{ route('formations.check-duplicates') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Vérifier les doublons
            </a>
            <form action="{{ route('formations.fix-all-slugs') }}" method="POST" class="inline">
                @csrf
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir corriger tous les slugs ?')"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    Corriger tous les slugs
                </button>
            </form>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($formations as $formation)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $formation->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{
                        Str::limit($formation->title, 50) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <code class="text-sm bg-gray-100 px-2 py-1 rounded">{{ $formation->slug }}</code>
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
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <form action="{{ route('formations.fix-slug', $formation->id) }}" method="POST">
                            @csrf
                            <button type="submit" onclick="return confirm('Corriger le slug de cette formation ?')"
                                class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600">
                                Corriger
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <h3 class="text-lg font-semibold mb-2">À propos des slugs :</h3>
        <ul class="list-disc pl-5 text-sm text-gray-600 space-y-1">
            <li>Les slugs sont utilisés pour les URLs des formations (ex: /formation/slug-de-la-formation)</li>
            <li>Un slug correct inclut le type de formation : "-presentiel" ou "-en-ligne"</li>
            <li>Chaque slug doit être unique dans la base de données</li>
            <li>Cliquez sur "Corriger" pour regénérer le slug d'une formation spécifique</li>
            <li>Utilisez "Corriger tous les slugs" pour mettre à jour toutes les formations</li>
        </ul>
    </div>
</div>
@endsection
