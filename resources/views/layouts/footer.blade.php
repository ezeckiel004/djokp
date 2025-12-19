<!-- Footer -->
<footer class="py-12 text-white bg-gray-900">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <!-- Colonne 1: Navigation rapide -->
            <div>
                <h3 class="mb-4 text-xl font-bold">Navigation rapide</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Accueil</a></li>
                    <li><a href="{{ route('about') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">À propos</a></li>
                    <li><a href="{{ route('formation') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formations VTC</a></li>
                    <li><a href="{{ route('location') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Location de
                            véhicules</a></li>
                    <li><a href="{{ route('vtc-transport') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">VTC & Transport</a></li>
                    <li><a href="{{ route('conciergerie') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Conciergerie</a></li>
                    <li><a href="{{ route('formation.international') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation
                            International</a></li>
                    <li><a href="{{ route('blog') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Blog</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Contact</a></li>
                    <li><a href="{{ route('espaceclient') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Espace Client</a></li>
                    <li><a href="{{ route('reservation') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Réservation</a></li>
                </ul>
            </div>

            <!-- Colonne 2: Nos formations -->
            <div>
                <h3 class="mb-4 text-xl font-bold">Nos formations</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('formation') }}#formation-theorique"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation théorique
                            VTC</a></li>
                    <li><a href="{{ route('formation') }}#formation-pratique"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation pratique
                            VTC</a></li>
                    <li><a href="{{ route('formation') }}#e-learning"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation e-learning</a>
                    </li>
                    <li><a href="{{ route('formation') }}#renouvellement"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation continue /
                            Renouvellement carte VTC</a></li>
                    <li><a href="{{ route('formation') }}#creation-entreprise"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation création
                            d'entreprise</a></li>
                    <li><a href="{{ route('formation.international') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Formation
                            entrepreneuriat Afrique</a></li>
                    <li><a href="{{ route('formation') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Toutes nos
                            formations</a></li>
                </ul>
            </div>

            <!-- Colonne 3: Informations légales -->
            <div>
                <h3 class="mb-4 text-xl font-bold">Informations légales</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('cgv') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">CGV - Conditions
                            Générales de Vente</a></li>
                    <li><a href="{{ route('cgu') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">CGU - Conditions
                            Générales d'Utilisation</a></li>
                    <li><a href="{{ route('mentions-legales') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Mentions légales</a>
                    </li>
                    <li><a href="{{ route('rgpd') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Politique RGPD</a></li>
                    <li><a href="{{ route('performance') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Indicateurs de
                            performance</a></li>
                    <li><a href="{{ route('reclamation') }}"
                            class="text-gray-400 transition duration-300 hover:text-yellow-400">Réclamation</a></li>
                </ul>
            </div>

            <!-- Colonne 4: Contact & Réseaux -->
            <div>
                <h3 class="mb-4 text-xl font-bold">Contact</h3>
                <div class="space-y-3 text-gray-400">
                    <p class="flex items-start">
                        <span class="mr-2 font-medium">Adresse:</span>
                        66 Avenue des Champs Élysées, 75008 Paris
                    </p>
                    <p class="flex items-start">
                        <span class="mr-2 font-medium">Téléphone:</span>
                        +33 1 48 47 52 13
                    </p>
                    <p class="flex items-start">
                        <span class="mr-2 font-medium">Email:</span>
                        contact@djokprestige.com
                    </p>
                    <p class="flex items-start">
                        <span class="mr-2 font-medium">WhatsApp:</span>
                        +33 7 45 89 XX XX
                    </p>
                </div>

                <div class="mt-6">
                    <h3 class="mb-4 text-xl font-bold">Réseaux sociaux</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 transition duration-300 hover:text-yellow-400">
                            Facebook
                        </a>
                        <a href="#" class="text-gray-400 transition duration-300 hover:text-yellow-400">
                            Twitter
                        </a>
                        <a href="#" class="text-gray-400 transition duration-300 hover:text-yellow-400">
                            LinkedIn
                        </a>
                        <a href="#" class="text-gray-400 transition duration-300 hover:text-yellow-400">
                            Instagram
                        </a>
                    </div>
                </div>

                <!-- Certification -->
                <div class="p-4 mt-6 bg-gray-800 rounded-lg">
                    <p class="text-sm font-semibold text-yellow-400">Centre de formation certifié Qualiopi</p>
                    <p class="mt-1 text-xs text-gray-400">Agréé VTC par la Préfecture</p>
                    <a href="#" class="inline-block mt-2 text-xs text-white underline">Téléchargez notre certification
                        officielle</a>
                </div>
            </div>
        </div>

        <!-- Section bas de footer -->
        <div class="pt-8 mt-8 border-t border-gray-800">
            <div class="flex flex-col items-center justify-between md:flex-row">
                <div class="mb-4 text-center md:text-left md:mb-0">
                    <p class="text-gray-400">&copy; {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
                    <p class="mt-1 text-sm text-gray-500">SAS au capital de 500€ - RCS Paris B 903 268 431 - SIRET
                        90326843100017</p>
                </div>

                <div class="flex space-x-6 text-sm">
                    <a href="{{ route('cgv') }}"
                        class="text-gray-400 transition duration-300 hover:text-yellow-400">CGV</a>
                    <a href="{{ route('mentions-legales') }}"
                        class="text-gray-400 transition duration-300 hover:text-yellow-400">Mentions légales</a>
                    <a href="{{ route('rgpd') }}"
                        class="text-gray-400 transition duration-300 hover:text-yellow-400">Confidentialité</a>
                    <a href="{{ route('reclamation') }}"
                        class="text-gray-400 transition duration-300 hover:text-yellow-400">Réclamation</a>
                </div>
            </div>
        </div>
    </div>
</footer>
