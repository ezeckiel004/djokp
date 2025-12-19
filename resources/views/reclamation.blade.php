@extends('layouts.base-black')

@section('title', 'Formulaire de Réclamation - DJOK PRESTIGE')

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-2 text-3xl font-bold text-center text-gray-900">Formulaire de Réclamation</h1>
            <p class="mb-8 text-center text-gray-600">Vous souhaitez faire une réclamation ou formuler une suggestion ?
                Remplissez le formulaire ci-dessous.</p>

            <!-- Informations importantes -->
            <div class="p-6 mb-8 border border-blue-200 rounded-lg bg-blue-50">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="mb-2 text-lg font-semibold text-blue-800">Informations importantes</h3>
                        <ul class="space-y-1 text-sm text-blue-700">
                            <li>• Nous traitons toutes les réclamations dans un délai maximum de 2 jours ouvrés</li>
                            <li>• Pour les réclamations complexes, nous vous tiendrons informé de l'avancement</li>
                            <li>• Vous recevrez un accusé de réception par email dans les 24 heures</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Formulaire de réclamation -->
            <form action="#" method="POST" class="space-y-6">
                @csrf

                <!-- Informations personnelles -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="nom" class="block mb-2 text-sm font-medium text-gray-700">Nom *</label>
                        <input type="text" id="nom" name="nom" required
                            class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            placeholder="Votre nom">
                    </div>
                    <div>
                        <label for="prenom" class="block mb-2 text-sm font-medium text-gray-700">Prénom *</label>
                        <input type="text" id="prenom" name="prenom" required
                            class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            placeholder="Votre prénom">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            placeholder="votre@email.com">
                    </div>
                    <div>
                        <label for="telephone" class="block mb-2 text-sm font-medium text-gray-700">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone"
                            class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                            placeholder="+33 1 23 45 67 89">
                    </div>
                </div>

                <!-- Type de réclamation -->
                <div>
                    <label for="type_reclamation" class="block mb-2 text-sm font-medium text-gray-700">Type de demande
                        *</label>
                    <select id="type_reclamation" name="type_reclamation" required
                        class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">Sélectionnez le type de demande</option>
                        <option value="reclamation">Réclamation</option>
                        <option value="suggestion">Suggestion</option>
                        <option value="question">Question</option>
                        <option value="probleme_technique">Problème technique</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <!-- Service concerné -->
                <div>
                    <label for="service_concerne" class="block mb-2 text-sm font-medium text-gray-700">Service concerné
                        *</label>
                    <select id="service_concerne" name="service_concerne" required
                        class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                        <option value="">Sélectionnez le service concerné</option>
                        <option value="formation_vtc">Formation VTC</option>
                        <option value="location_vehicules">Location de véhicules</option>
                        <option value="service_vtc">Service VTC & Transport</option>
                        <option value="conciergerie">Conciergerie</option>
                        <option value="formation_international">Formation Internationale</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <!-- Sujet -->
                <div>
                    <label for="sujet" class="block mb-2 text-sm font-medium text-gray-700">Sujet *</label>
                    <input type="text" id="sujet" name="sujet" required
                        class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Objet de votre message">
                </div>

                <!-- Message -->
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Message détaillé *</label>
                    <textarea id="message" name="message" rows="6" required
                        class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Décrivez votre réclamation ou suggestion en détail..."></textarea>
                </div>

                <!-- Pièces jointes -->
                <div>
                    <label for="pieces_jointes" class="block mb-2 text-sm font-medium text-gray-700">Pièces jointes
                        (optionnel)</label>
                    <input type="file" id="pieces_jointes" name="pieces_jointes"
                        class="w-full px-4 py-3 transition duration-300 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        multiple>
                    <p class="mt-2 text-sm text-gray-500">Formats acceptés : PDF, JPG, PNG, DOC. Taille max : 5MB par
                        fichier</p>
                </div>

                <!-- Consentement -->
                <div class="flex items-start">
                    <input type="checkbox" id="consentement" name="consentement" required
                        class="mt-1 mr-3 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                    <label for="consentement" class="text-sm text-gray-700">
                        J'accepte que mes données personnelles soient traitées dans le cadre du traitement de ma
                        réclamation, conformément à la
                        <a href="{{ route('rgpd') }}" class="text-yellow-600 hover:underline">politique de
                            confidentialité</a> de DJOK PRESTIGE.
                    </label>
                </div>

                <!-- Bouton d'envoi -->
                <div class="text-center">
                    <button type="submit"
                        class="px-8 py-4 font-semibold text-black transition duration-300 transform bg-yellow-500 rounded-lg hover:bg-yellow-400 hover:scale-105">
                        Envoyer ma réclamation
                    </button>
                </div>
            </form>

            <!-- Informations de contact alternatives -->
            <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-3">
                <div class="p-6 text-center rounded-lg bg-gray-50">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-800">Téléphone</h3>
                    <p class="text-gray-600">+33 1 48 47 52 13</p>
                    <p class="text-sm text-gray-500">Lun-Ven: 9h-18h</p>
                </div>

                <div class="p-6 text-center rounded-lg bg-gray-50">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-green-100 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-800">Email</h3>
                    <p class="text-gray-600">contact@djokprestige.com</p>
                    <p class="text-sm text-gray-500">Réponse sous 24h</p>
                </div>

                <div class="p-6 text-center rounded-lg bg-gray-50">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-purple-100 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 font-semibold text-gray-800">Adresse</h3>
                    <p class="text-gray-600">66 Avenue des Champs Élysées</p>
                    <p class="text-sm text-gray-500">75008 Paris, France</p>
                </div>
            </div>

            <!-- Médiateur -->
            <div class="p-6 mt-8 border border-yellow-200 rounded-lg bg-yellow-50">
                <h3 class="mb-3 text-lg font-semibold text-yellow-800">Médiateur de la consommation</h3>
                <p class="mb-3 text-sm text-yellow-700">
                    Si vous n'êtes pas satisfait de notre réponse, vous pouvez saisir le médiateur de la consommation :
                </p>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-yellow-800">Médiateur de la consommation SMP</p>
                        <a href="https://www.mediateur-consommation-smp.fr"
                            class="text-sm text-yellow-600 hover:underline">
                            https://www.mediateur-consommation-smp.fr
                        </a>
                    </div>
                    <a href="https://www.mediateur-consommation-smp.fr"
                        class="px-4 py-2 text-sm font-semibold text-black transition duration-300 bg-yellow-500 rounded hover:bg-yellow-400">
                        Accéder
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
