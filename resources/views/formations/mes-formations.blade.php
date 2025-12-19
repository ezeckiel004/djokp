@extends('layouts.main')

@section('title', 'Mes Formations | DJOK PRESTIGE')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Mes Formations</h1>

        @if($userFormations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($userFormations as $userFormation)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $userFormation->formation->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($userFormation->formation->description, 100) }}</p>

                <div class="flex items-center justify-between mb-4">
                    <div>
                        <div class="text-sm text-gray-500">Progression</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-yellow-600 h-2.5 rounded-full"
                                style="width: {{ $userFormation->progress }}%"></div>
                        </div>
                    </div>
                    <span class="text-sm font-medium">{{ $userFormation->progress }}%</span>
                </div>

                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <div>Début: {{ $userFormation->access_start->format('d/m/Y') }}</div>
                    <div>Fin: {{ $userFormation->access_end->format('d/m/Y') }}</div>
                </div>

                <a href="{{ route('formations.acceder', $userFormation->formation_id) }}"
                    class="block w-full text-center py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                    Accéder à la formation
                </a>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                <i class="fas fa-graduation-cap text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune formation achetée</h3>
            <p class="text-gray-500 mb-6">Vous n'avez pas encore acheté de formation.</p>
            <a href="{{ route('formation') }}"
                class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700">
                <i class="fas fa-book-open mr-2"></i>Découvrir nos formations
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
