@extends('layouts.base-black')

@section('title', 'Indicateurs de Performance - DJOK PRESTIGE')

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-6xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">INDICATEURS DE PERFORMANCE</h1>

            <div class="mb-8 prose prose-lg max-w-none">
                <p class="text-center text-gray-600">
                    Transparence et excellence : découvrez les résultats de DJOK PRESTIGE pour l'année 2024
                </p>
            </div>

            <!-- Tableau des indicateurs -->
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-lg shadow">
                    <thead class="text-white bg-gray-800">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-left">Indicateur</th>
                            <th class="px-6 py-4 font-semibold text-center">Résultat 2024</th>
                            <th class="px-6 py-4 font-semibold text-center">Évolution vs 2023</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Stagiaires accompagnés</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">482</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">+ 28 %</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Formations dispensées</td>
                            <td class="px-6 py-4 font-semibold text-center text-blue-600">73</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">+ 12 %</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Taux de réussite à l'examen VTC</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">94 %</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">+ 3 pts</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Taux de satisfaction globale</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">97 %</td>
                            <td class="px-6 py-4 font-semibold text-center text-gray-600">stable</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Taux d'abandon</td>
                            <td class="px-6 py-4 font-semibold text-center text-red-600">3 %</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">- 2 pts</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Retour à l'emploi / création d'entreprise</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">88 %</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">+ 5 pts</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Réclamations enregistrées</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">2 sur 482 (0,4 %)</td>
                            <td class="px-6 py-4 font-semibold text-center text-green-600">- 1 cas</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium">Délai moyen de traitement des réclamations</td>
                            <td class="px-6 py-4 font-semibold text-center text-blue-600">2 jours ouvrés</td>
                            <td class="px-6 py-4 font-semibold text-center text-gray-600">stable</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Analyse des résultats -->
            <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-2">
                <div class="p-6 rounded-lg bg-blue-50">
                    <h3 class="mb-4 text-xl font-bold text-blue-800">Points Forts 2024</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-green-500">✓</span>
                            <span class="text-blue-700">Croissance significative du nombre de stagiaires (+28%)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-green-500">✓</span>
                            <span class="text-blue-700">Amélioration continue du taux de réussite aux examens</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-green-500">✓</span>
                            <span class="text-blue-700">Taux de satisfaction maintenu à un niveau d'excellence
                                (97%)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-green-500">✓</span>
                            <span class="text-blue-700">Réduction du taux d'abandon grâce à un meilleur
                                accompagnement</span>
                        </li>
                    </ul>
                </div>

                <div class="p-6 rounded-lg bg-green-50">
                    <h3 class="mb-4 text-xl font-bold text-green-800">Perspectives 2025</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-blue-500">🎯</span>
                            <span class="text-green-700">Atteindre 600 stagiaires accompagnés</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-blue-500">🎯</span>
                            <span class="text-green-700">Dépasser les 95% de taux de réussite</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-blue-500">🎯</span>
                            <span class="text-green-700">Lancer 5 nouvelles formations certifiantes</span>
                        </li>
                        <li class="flex items-start">
                            <span class="mt-1 mr-2 text-blue-500">🎯</span>
                            <span class="text-green-700">Développer les partenariats internationaux</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Engagement qualité -->
            <div class="p-8 mt-12 rounded-lg bg-yellow-50">
                <h3 class="mb-6 text-2xl font-bold text-center text-yellow-800">Notre Engagement Qualité</h3>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                            <span class="text-2xl text-yellow-600">🏅</span>
                        </div>
                        <h4 class="mb-2 font-semibold text-yellow-800">Certification Qualiopi</h4>
                        <p class="text-sm text-yellow-700">Reconnaissance officielle de la qualité de nos formations</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                            <span class="text-2xl text-yellow-600">⭐</span>
                        </div>
                        <h4 class="mb-2 font-semibold text-yellow-800">Excellence Pédagogique</h4>
                        <p class="text-sm text-yellow-700">Formateurs experts et méthodes innovantes</p>
                    </div>
                    <div class="text-center">
                        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                            <span class="text-2xl text-yellow-600">🤝</span>
                        </div>
                        <h4 class="mb-2 font-semibold text-yellow-800">Accompagnement Personnalisé</h4>
                        <p class="text-sm text-yellow-700">Suivi individuel jusqu'à l'insertion professionnelle</p>
                    </div>
                </div>
            </div>

            <!-- Témoignages -->
            <div class="mt-12">
                <h3 class="mb-6 text-2xl font-bold text-center text-gray-900">Témoignages de nos Anciens Stagiaires</h3>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div class="p-6 bg-white border border-gray-200 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 bg-gray-300 rounded-full">
                                <span class="font-semibold text-gray-600">AM</span>
                            </div>
                            <div>
                                <h4 class="font-semibold">Ahmed M.</h4>
                                <p class="text-sm text-gray-600">Formation VTC - Promotion 2024</p>
                            </div>
                        </div>
                        <p class="italic text-gray-700">
                            "Une formation complète avec un accompagnement exceptionnel. J'ai obtenu ma carte VTC du
                            premier coup grâce à la qualité de la préparation."
                        </p>
                    </div>
                    <div class="p-6 bg-white border border-gray-200 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex items-center justify-center w-12 h-12 mr-4 bg-gray-300 rounded-full">
                                <span class="font-semibold text-gray-600">SM</span>
                            </div>
                            <div>
                                <h4 class="font-semibold">Sophie M.</h4>
                                <p class="text-sm text-gray-600">Formation Entrepreneuriat - Promotion 2024</p>
                            </div>
                        </div>
                        <p class="italic text-gray-700">
                            "Le programme international m'a permis de créer mon entreprise en France avec un
                            accompagnement sur mesure. Je recommande vivement !"
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 mt-12 rounded-lg bg-gray-50">
                <p class="text-sm text-center text-gray-600">
                    <strong>Date de dernière mise à jour :</strong> Décembre 2024<br>
                    Ces indicateurs sont mis à jour trimestriellement pour assurer une transparence totale sur notre
                    performance.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
