@extends('layouts.main')

@section('title', 'Indicateurs de Performance - DJOK PRESTIGE')

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-6xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-4 text-3xl font-bold text-center text-gray-900">INDICATEURS DE PERFORMANCE</h1>
            <p class="mb-8 text-lg text-center text-gray-600">
                Transparence et excellence au cœur de notre démarche qualité
            </p>

            <!-- Introduction -->
            <div class="p-6 mb-10 rounded-lg bg-blue-50">
                <h2 class="mb-4 text-xl font-bold text-gray-900">Notre engagement qualité</h2>
                <p class="text-gray-700">
                    DJOK PRESTIGE, centre de formation certifié Qualiopi, s'engage à mesurer et améliorer
                    continuellement
                    la qualité de ses prestations. Les indicateurs présentés ci-dessous reflètent notre performance
                    et notre engagement envers nos stagiaires.
                </p>
                <p class="mt-3 text-gray-700">
                    Ces données sont actualisées trimestriellement et font l'objet d'un suivi rigoureux par notre équipe
                    qualité.
                </p>
            </div>

            <!-- Tableau des indicateurs -->
            <div class="mb-12 overflow-hidden rounded-lg shadow">
                <div class="px-6 py-4 bg-gray-900">
                    <h2 class="text-xl font-bold text-white">Tableau de bord des performances 2024</h2>
                </div>
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">Indicateur</th>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">Résultat 2024</th>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">Évolution vs 2023</th>
                            <th class="px-6 py-4 text-left text-gray-700 border-b">Objectif 2025</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Stagiaires accompagnés -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-blue-600 rounded-full">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <span class="font-medium">Stagiaires accompagnés</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-blue-700">482</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-arrow-up"></i> + 28 %
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">550</td>
                        </tr>

                        <!-- Formations dispensées -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-purple-600 rounded-full">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <span class="font-medium">Formations dispensées</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-purple-700">73</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-arrow-up"></i> + 12 %
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">85</td>
                        </tr>

                        <!-- Taux de réussite à l'examen VTC -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-green-600 rounded-full">
                                        <i class="fas fa-medal"></i>
                                    </div>
                                    <span class="font-medium">Taux de réussite à l'examen VTC</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-green-700">94 %</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-arrow-up"></i> + 3 pts
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">96 %</td>
                        </tr>

                        <!-- Taux de satisfaction globale -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-yellow-600 rounded-full">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <span class="font-medium">Taux de satisfaction globale</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-yellow-700">97 %</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                                    stable
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">98 %</td>
                        </tr>

                        <!-- Taux d'abandon -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-red-600 rounded-full">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                    <span class="font-medium">Taux d'abandon</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-red-700">3 %</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-arrow-down"></i> - 2 pts
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">2 %</td>
                        </tr>

                        <!-- Retour à l'emploi / création d'entreprise -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-indigo-600 rounded-full">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                    <span class="font-medium">Retour à l'emploi / création d'entreprise</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-indigo-700">88 %</td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-arrow-up"></i> + 5 pts
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">90 %</td>
                        </tr>

                        <!-- Réclamations enregistrées -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-gray-600 rounded-full">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <span class="font-medium">Réclamations enregistrées</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-gray-700">
                                2 sur 482 (0,4 %)
                            </td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-green-800 bg-green-100 rounded-full">
                                    <i class="mr-1 fas fa-arrow-down"></i> - 1 cas
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">≤ 1 %</td>
                        </tr>

                        <!-- Délai moyen de traitement des réclamations -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <div class="flex items-center">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 mr-3 text-white bg-teal-600 rounded-full">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <span class="font-medium">Délai moyen de traitement des réclamations</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-lg font-bold border-b text-teal-700">
                                2 jours ouvrés
                            </td>
                            <td class="px-6 py-4 border-b">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                                    stable
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 border-b">2 jours ouvrés</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Méthodologie et explications -->
            <div class="grid grid-cols-1 gap-8 mb-12 md:grid-cols-2">
                <div class="p-6 bg-gray-50 rounded-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        <i class="mr-2 fas fa-chart-line"></i> Méthodologie de mesure
                    </h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-blue-600 fas fa-check-circle"></i>
                            <span>Enquêtes de satisfaction systématiques à l'issue de chaque formation</span>
                        </li>
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-blue-600 fas fa-check-circle"></i>
                            <span>Suivi individualisé des résultats aux examens officiels</span>
                        </li>
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-blue-600 fas fa-check-circle"></i>
                            <span>Point à 6 mois post-formation pour mesurer l'insertion professionnelle</span>
                        </li>
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-blue-600 fas fa-check-circle"></i>
                            <span>Audit qualité interne trimestriel</span>
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-gray-50 rounded-lg">
                    <h3 class="mb-4 text-xl font-bold text-gray-900">
                        <i class="mr-2 fas fa-bullseye"></i> Nos objectifs qualité
                    </h3>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-green-600 fas fa-trophy"></i>
                            <span>Atteindre 96% de taux de réussite à l'examen VTC</span>
                        </li>
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-green-600 fas fa-trophy"></i>
                            <span>Maintenir un taux d'abandon inférieur à 2%</span>
                        </li>
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-green-600 fas fa-trophy"></i>
                            <span>Traiter toutes les réclamations en moins de 48h</span>
                        </li>
                        <li class="flex items-start">
                            <i class="mt-1 mr-3 text-green-600 fas fa-trophy"></i>
                            <span>Accompagner 550 stagiaires en 2025</span>
                        </li>
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
                        <h3 class="mb-2 text-xl font-bold text-gray-900">Centre certifié Qualiopi</h3>
                        <p class="text-gray-700">
                            DJOK PRESTIGE est certifié Qualiopi depuis 2023, garantissant la qualité de nos processus
                            de formation et notre engagement en faveur de l'amélioration continue.
                        </p>
                        <a href="#" class="inline-flex items-center mt-3 text-blue-700 hover:underline">
                            <i class="mr-2 fas fa-download"></i>
                            Télécharger notre certification officielle
                        </a>
                    </div>
                </div>
            </div>

            <!-- Date de mise à jour -->
            <div class="p-4 rounded-lg bg-gray-100">
                <div class="flex items-center justify-center">
                    <i class="mr-3 text-gray-600 fas fa-info-circle"></i>
                    <p class="text-sm text-gray-600">
                        <strong>Dernière mise à jour :</strong> Décembre 2024 | Prochaine mise à jour prévue : Mars 2025
                    </p>
                </div>
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
@endsection