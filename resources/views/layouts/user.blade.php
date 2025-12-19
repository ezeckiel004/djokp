<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Utilisateur') - DJOK PRESTIGE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <h1 class="text-xl font-bold text-gray-800">DJOK PRESTIGE</h1>
                    </div>

                    <!-- Menu Desktop -->
                    <div class="hidden md:ml-6 md:flex md:items-center md:space-x-4">
                        <a href="{{ route('user.dashboard') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-100 {{ request()->routeIs('user.dashboard') ? 'text-blue-600 bg-blue-50' : '' }}">
                            <i class="mr-1 fas fa-tachometer-alt"></i>Tableau de bord
                        </a>

                        <a href="{{ route('user.sessions.index') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-100 {{ request()->routeIs('user.sessions.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                            <i class="mr-1 fas fa-graduation-cap"></i>Formations
                        </a>

                        <a href="{{ route('user.reservations.index') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-100 {{ request()->routeIs('user.reservations.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                            <i class="mr-1 fas fa-calendar-alt"></i>Mes réservations
                        </a>

                        {{-- Dans la section navigation --}}
                        <a href="{{ route('user.fichiers.index') }}"
                            class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors {{ request()->routeIs('user.fichiers.*') ? 'bg-gray-100 text-blue-600' : '' }}">
                            <i class="mr-3 fas fa-folder"></i>
                            Mes Fichiers
                        </a>

                        {{-- <a href="{{ route('user.formations.index') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-100 {{ request()->routeIs('user.formations.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                            <i class="mr-1 fas fa-book-open"></i>Mes formations
                        </a>

                        <a href="{{ route('user.seminaires.index') }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-100 {{ request()->routeIs('user.seminaires.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                            <i class="mr-1 fas fa-users"></i>Mes séminaires
                        </a> --}}
                    </div>
                </div>

                <!-- Menu droite Desktop -->
                <div class="hidden md:flex md:items-center md:space-x-4">
                    <a href="{{ route('user.profil') }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-100 {{ request()->routeIs('user.profil') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="mr-1 fas fa-user"></i>Mon profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-3 py-2 text-sm font-medium text-gray-700 rounded-md hover:text-red-600 hover:bg-gray-100">
                            <i class="mr-1 fas fa-sign-out-alt"></i>Déconnexion
                        </button>
                    </form>
                </div>

                <!-- Menu Mobile -->
                <div class="flex items-center md:hidden">
                    <button type="button" id="mobile-menu-button"
                        class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Ouvrir le menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu Mobile (caché par défaut) -->
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('user.dashboard') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-50 {{ request()->routeIs('user.dashboard') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <i class="mr-2 fas fa-tachometer-alt"></i>Tableau de bord
                </a>

                <a href="{{ route('user.sessions.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-50 {{ request()->routeIs('user.sessions.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <i class="mr-2 fas fa-graduation-cap"></i>Formations
                </a>

                <a href="{{ route('user.reservations.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-50 {{ request()->routeIs('user.reservations.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <i class="mr-2 fas fa-calendar-alt"></i>Mes réservations
                </a>

                {{-- <a href="{{ route('user.formations.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-50 {{ request()->routeIs('user.formations.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <i class="mr-2 fas fa-book-open"></i>Mes formations
                </a>

                <a href="{{ route('user.seminaires.index') }}"
                    class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-50 {{ request()->routeIs('user.seminaires.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <i class="mr-2 fas fa-users"></i>Mes séminaires
                </a> --}}
            </div>

            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="space-y-1">
                    <a href="{{ route('user.profil') }}"
                        class="block px-3 py-2 text-base font-medium text-gray-700 rounded-md hover:text-blue-600 hover:bg-gray-50 {{ request()->routeIs('user.profil') ? 'text-blue-600 bg-blue-50' : '' }}">
                        <i class="mr-2 fas fa-user"></i>Mon profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full px-3 py-2 text-base font-medium text-left text-gray-700 rounded-md hover:text-red-600 hover:bg-gray-50">
                            <i class="mr-2 fas fa-sign-out-alt"></i>Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="px-4 py-6 mx-auto max-w-7xl">
        <!-- Messages Flash -->
        @if(session('success'))
        <div class="p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded">
            <div class="flex items-center">
                <i class="mr-3 text-xl fas fa-check-circle"></i>
                <div>
                    <p class="font-semibold">Succès</p>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="p-4 mb-6 text-red-800 bg-red-100 border-l-4 border-red-500 rounded">
            <div class="flex items-center">
                <i class="mr-3 text-xl fas fa-exclamation-circle"></i>
                <div>
                    <p class="font-semibold">Erreur</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('warning'))
        <div class="p-4 mb-6 text-yellow-800 bg-yellow-100 border-l-4 border-yellow-500 rounded">
            <div class="flex items-center">
                <i class="mr-3 text-xl fas fa-exclamation-triangle"></i>
                <div>
                    <p class="font-semibold">Attention</p>
                    <p>{{ session('warning') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('info'))
        <div class="p-4 mb-6 text-blue-800 bg-blue-100 border-l-4 border-blue-500 rounded">
            <div class="flex items-center">
                <i class="mr-3 text-xl fas fa-info-circle"></i>
                <div>
                    <p class="font-semibold">Information</p>
                    <p>{{ session('info') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Contenu de la page -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="px-4 py-8 mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <!-- Logo et description -->
                <div class="md:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800">DJOK PRESTIGE</h3>
                    <p class="mt-2 text-gray-600">
                        Votre partenaire de confiance pour les services VTC,
                        les formations professionnelles et les séminaires d'entreprise.
                    </p>
                    <div class="flex mt-4 space-x-4">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Liens rapides -->
                <div>
                    <h4 class="font-semibold text-gray-800">Liens rapides</h4>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('welcome') }}" class="text-gray-600 hover:text-gray-900">Accueil</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-900">À propos</a></li>
                        <li><a href="{{ route('formation') }}" class="text-gray-600 hover:text-gray-900">Formations</a>
                        </li>
                        <li><a href="{{ route('blog') }}" class="text-gray-600 hover:text-gray-900">Blog</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold text-gray-800">Contact</h4>
                    <ul class="mt-4 space-y-2 text-gray-600">
                        <li class="flex items-center">
                            <i class="mr-2 fas fa-phone"></i>
                            +33 1 23 45 67 89
                        </li>
                        <li class="flex items-center">
                            <i class="mr-2 fas fa-envelope"></i>
                            contact@djokprestige.com
                        </li>
                        <li class="flex items-center">
                            <i class="mr-2 fas fa-map-marker-alt"></i>
                            Paris, France
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-8 mt-8 border-t border-gray-200">
                <div class="flex flex-col items-center justify-between md:flex-row">
                    <p class="text-sm text-gray-600">
                        &copy; {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.
                    </p>
                    <div class="flex mt-4 space-x-6 md:mt-0">
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Mentions légales</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">Politique de confidentialité</a>
                        <a href="#" class="text-sm text-gray-600 hover:text-gray-900">CGU</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <!-- Script pour le menu mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Fermer le menu si on clique en dehors
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
