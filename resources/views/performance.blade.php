@extends('layouts.main')

@section('title', __('performance.title'))

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-6xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-4 text-3xl font-bold text-center text-gray-900">{{ __('performance.main_title') }}</h1>
            <p class="mb-8 text-lg text-center text-gray-600">
                {{ __('performance.subtitle') }}
            </p>

            <!-- Introduction -->
            <div class="p-6 mb-10 rounded-lg bg-blue-50">
                <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('performance.engagement_qualite.title') }}</h2>
                @foreach (__('performance.engagement_qualite.contents') as $paragraph)
                <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                    {{ $paragraph }}
                </p>
                @endforeach
            </div>

            <!-- Tableau des indicateurs -->
            <div class="mb-12 overflow-hidden rounded-lg shadow">
                <div class="px-6 py-4 bg-gray-900">
                    <h2 class="text-xl font-bold text-white">{{ __('performance.tableau_performance.title') }}</h2>
                </div>
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">{{
                                __('performance.tableau_performance.headers.indicateur') }}</th>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">{{
                                __('performance.tableau_performance.headers.resultat_2024') }}</th>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">{{
                                __('performance.tableau_performance.headers.evolution_vs_2023') }}</th>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">{{
                                __('performance.tableau_performance.headers.objectif_2025') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (__('performance.tableau_performance.indicateurs') as $indicateur)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-{{ $indicateur['color'] }}-600 rounded-full">
                                        <i class="{{ $indicateur['icon'] }}"></i>
                                    </div>
                                    <span class="font-medium">{{ $indicateur['nom'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-{{ $indicateur['color'] }}-700">
                                {{ $indicateur['resultat'] }}
                            </td>
                            <td class="px-6 py-4 border-b">
                                @php
                                $evolutionClass = __('performance.tableau_performance.evolution_labels.' .
                                $indicateur['evolution_type'] . '.class');
                                $evolutionIcon = __('performance.tableau_performance.evolution_labels.' .
                                $indicateur['evolution_type'] . '.icon');
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full {{ $evolutionClass }}">
                                    @if($evolutionIcon)
                                    <i class="mr-1 {{ $evolutionIcon }}"></i>
                                    @endif
                                    {{ $indicateur['evolution'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">{{ $indicateur['objectif'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Méthodologie et explications -->
            <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2">
                <div class="p-6 bg-gray-50 rounded-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        <i class="mr-2 {{ __('performance.methodologie.icon') }}"></i>
                        {{ __('performance.methodologie.title') }}
                    </h3>
                    <ul class="space-y-3 text-gray-700">
                        @foreach (__('performance.methodologie.items') as $item)
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-blue-600 fas fa-check-circle"></i>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="p-6 bg-gray-50 rounded-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        <i class="mr-2 {{ __('performance.objectifs_qualite.icon') }}"></i>
                        {{ __('performance.objectifs_qualite.title') }}
                    </h3>
                    <ul class="space-y-3 text-gray-700">
                        @foreach (__('performance.objectifs_qualite.items') as $item)
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-green-600 fas fa-trophy"></i>
                            <span>{{ $item }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Certification Qualiopi -->
            <div class="p-6 mb-8 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50">
                <div class="flex flex-col items-center md:flex-row">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 md:mb-0 md:mr-6">
                        <i class="text-3xl text-blue-700 fas fa-award"></i>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="mb-2 text-xl font-bold text-gray-900">{{
                            __('performance.certification_qualiopi.title') }}</h3>
                        <p class="text-gray-700">
                            {{ __('performance.certification_qualiopi.content') }}
                        </p>
                        <a href="#" class="inline-flex items-center mt-3 text-blue-700 hover:underline">
                            <i class="mr-2 {{ __('performance.certification_qualiopi.download_icon') }}"></i>
                            {{ __('performance.certification_qualiopi.download_link') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- Date de mise à jour -->
            <div class="p-4 rounded-lg bg-gray-100">
                <div class="flex items-center justify-center">
                    <i class="mr-3 text-gray-600 {{ __('performance.mise_a_jour.icon') }}"></i>
                    <p class="text-sm text-gray-600">
                        <strong>{{ __('performance.mise_a_jour.last_update') }}</strong>
                        {{ __('performance.mise_a_jour.last_update_date') }} |
                        <strong>{{ __('performance.mise_a_jour.next_update') }}</strong>
                        {{ __('performance.mise_a_jour.next_update_date') }}
                    </p>
                </div>
            </div>

            <!-- Retour à l'accueil -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    {{ __('performance.back_to_home') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Style supplémentaire -->
<style>
    table {
        border-collapse: separate;
        border-spacing: 0;
    }

    th,
    td {
        border-bottom: 1px solid #e5e7eb;
    }

    tr:last-child td {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        .p-8 {
            padding: 1.5rem;
        }
    }
</style>

<!-- Script pour gérer les classes de couleur dynamiques -->
<script>
    // Cette fonction assure que les classes de couleur Tailwind sont correctement appliquées
    document.addEventListener('DOMContentLoaded', function() {
        // Pour chaque cellule de résultat, s'assurer que la couleur est correcte
        const colorCells = document.querySelectorAll('td[class*="text-"]');
        colorCells.forEach(cell => {
            const classes = cell.className.split(' ');
            classes.forEach(className => {
                if (className.startsWith('text-') && className.endsWith('-700')) {
                    // La classe de couleur est déjà présente
                }
            });
        });
    });
</script>
@endsection
