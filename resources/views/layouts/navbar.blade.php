<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent"
    x-data="{ mobileMenuOpen: false, moreMenuOpen: false, scrolled: false }"
    @scroll.window="scrolled = window.scrollY > 50"
    :class="scrolled ? 'bg-white shadow-lg py-4' : 'bg-transparent py-6'">

    <div class="flex items-center justify-between px-4 lg:px-6">
        <!-- Logo -->
        <div class="text-xl lg:text-2xl font-bold transition-colors duration-300"
            :class="scrolled ? 'text-gray-900' : 'text-white'">
            DJOK PRESTIGE
        </div>

        <!-- Desktop Menu (grands écrans) -->
        <div class="items-center hidden space-x-6 lg:flex">
            <!-- Accueil -->
            <a href="{{ url('/') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Accueil
            </a>

            <!-- Formation VTC -->
            <a href="{{ route('formation') }}" class="font-semibold transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Formation VTC
            </a>

            <!-- Formation à l'international -->
            <a href="{{ route('formation.international') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Formation à l'international
            </a>

            <!-- VTC & Transport -->
            <a href="{{ route('reservation') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                VTC & Transport
            </a>

            <!-- Location de voitures -->
            <a href="{{ route('location') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Location de voitures
            </a>

            <!-- Conciergerie -->
            <a href="{{ route('conciergerie') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Conciergerie
            </a>

            <!-- Blog -->
            <a href="{{ route('blog') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Blog
            </a>
        </div>

        <!-- Menu Moyen Écran (md - avec menu "Plus") -->
        <div class="items-center hidden space-x-4 md:flex lg:hidden">
            <!-- Liens principaux visibles sur écrans moyens -->
            <a href="{{ url('/') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Accueil
            </a>

            <a href="{{ route('formation') }}" class="font-semibold transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                Formation VTC
            </a>

            <a href="{{ route('reservation') }}" class="transition duration-300 hover:text-yellow-400"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                VTC & Transport
            </a>

            <!-- Menu déroulant "Plus" pour les autres liens -->
            <div class="relative" x-data="{ moreOpen: false }">
                <button @click="moreOpen = !moreOpen" @click.outside="moreOpen = false"
                    class="flex items-center space-x-1 transition duration-300 hover:text-yellow-400 focus:outline-none"
                    :class="scrolled ? 'text-gray-900' : 'text-white'">
                    <span>Plus</span>
                    <i class="text-xs transition-transform duration-200 fas fa-chevron-down"
                        :class="{ 'transform rotate-180': moreOpen }"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="moreOpen" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="absolute right-0 z-50 w-48 mt-3 bg-white border border-gray-200 rounded-lg shadow-lg top-full"
                    style="display: none;">
                    <div class="py-2">
                        <a href="{{ route('formation.international') }}" @click="moreOpen = false"
                            class="block px-4 py-2 text-sm text-gray-700 transition duration-200 hover:bg-yellow-50 hover:text-yellow-700">
                            Formation à l'international
                        </a>
                        <a href="{{ route('location') }}" @click="moreOpen = false"
                            class="block px-4 py-2 text-sm text-gray-700 transition duration-200 hover:bg-yellow-50 hover:text-yellow-700">
                            Location de voitures
                        </a>
                        <a href="{{ route('conciergerie') }}" @click="moreOpen = false"
                            class="block px-4 py-2 text-sm text-gray-700 transition duration-200 hover:bg-yellow-50 hover:text-yellow-700">
                            Conciergerie
                        </a>
                        <a href="{{ route('blog') }}" @click="moreOpen = false"
                            class="block px-4 py-2 text-sm text-gray-700 transition duration-200 hover:bg-yellow-50 hover:text-yellow-700">
                            Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop & Tablet Auth Links (visible sur md et plus) -->
        <div class="items-center hidden space-x-4 md:flex">
            @if (Route::has('login'))
            <div class="text-right">
                @auth
                <a href="{{ url('/user/dashboard') }}" class="transition duration-300 hover:text-yellow-400"
                    :class="scrolled ? 'text-gray-900' : 'text-white'">
                    <i class="mr-2 fas fa-tachometer-alt"></i>Dashboard
                </a>
                @else
                @if (Route::has('register'))
                <a href="{{ route('espaceclient') }}"
                    class="px-3 py-2 text-sm font-medium text-white transition duration-300 bg-yellow-600 rounded-lg hover:bg-yellow-700 lg:px-4 lg:py-3">
                    <i class="mr-1 fas fa-user-shield lg:mr-2"></i>
                    <span class="hidden lg:inline">Espace Client</span>
                    <span class="lg:hidden">Client</span>
                </a>
                @endif
                @endauth
            </div>
            @endif
        </div>

        <!-- Mobile Auth Button & Menu Button -->
        <div class="flex items-center space-x-4 md:hidden">
            @if (Route::has('login'))
            @auth
            <!-- Bouton Dashboard visible sur mobile -->
            <a href="{{ url('/user/dashboard') }}"
                class="px-3 py-2 text-sm font-medium text-white transition duration-300 bg-yellow-600 rounded-lg hover:bg-yellow-700">
                <i class="fas fa-tachometer-alt"></i>
            </a>
            @else
            @if (Route::has('register'))
            <!-- Bouton Espace Client visible sur mobile -->
            <a href="{{ route('espaceclient') }}"
                class="px-3 py-2 text-sm font-medium text-white transition duration-300 bg-yellow-600 rounded-lg hover:bg-yellow-700">
                <i class="fas fa-user-shield"></i>
            </a>
            @endif
            @endauth
            @endif

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="p-2 text-xl transition duration-300 focus:outline-none"
                :class="scrolled ? 'text-gray-900' : 'text-white'">
                <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu (petit écran) -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-4"
        class="absolute left-0 right-0 z-40 px-4 py-6 text-gray-900 bg-white shadow-lg md:hidden top-full"
        style="display: none;" @click.outside="mobileMenuOpen = false">

        <div class="space-y-4">
            <!-- Accueil Mobile -->
            <a href="{{ url('/') }}" @click="mobileMenuOpen = false"
                class="block py-4 text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                Accueil
            </a>

            <!-- Formation VTC Mobile -->
            <a href="{{ route('formation') }}" @click="mobileMenuOpen = false"
                class="block py-4 font-semibold text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                Formation VTC
            </a>

            <!-- Formation à l'international Mobile -->
            <a href="{{ route('formation.international') }}" @click="mobileMenuOpen = false"
                class="block py-4 text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                Formation à l'international
            </a>

            <!-- VTC & Transport Mobile -->
            <a href="{{ route('reservation') }}" @click="mobileMenuOpen = false"
                class="block py-4 text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                VTC & Transport
            </a>

            <!-- Location de voitures Mobile -->
            <a href="{{ route('location') }}" @click="mobileMenuOpen = false"
                class="block py-4 text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                Location de voitures
            </a>

            <!-- Conciergerie Mobile -->
            <a href="{{ route('conciergerie') }}" @click="mobileMenuOpen = false"
                class="block py-4 text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                Conciergerie
            </a>

            <!-- Blog Mobile -->
            <a href="{{ route('blog') }}" @click="mobileMenuOpen = false"
                class="block py-4 text-gray-900 transition duration-300 border-b border-gray-200 hover:text-yellow-600">
                Blog
            </a>

            <!-- Mobile Auth Links (dans le menu déroulant) -->
            <div class="pt-4 space-y-4">
                @auth
                <a href="{{ url('/user/dashboard') }}" @click="mobileMenuOpen = false"
                    class="block py-3 text-gray-900 transition duration-300 hover:text-yellow-600">
                    <i class="mr-2 fas fa-tachometer-alt"></i>Dashboard
                </a>
                @else
                @if (Route::has('register'))
                <a href="{{ route('espaceclient') }}" @click="mobileMenuOpen = false"
                    class="block py-3 font-medium text-yellow-600 transition duration-300 hover:text-yellow-700">
                    <i class="mr-2 fas fa-user-shield"></i>Espace Client
                </a>
                @endif
                @endauth
            </div>

            <!-- Mobile Contact -->
            <div class="pt-6 border-t border-gray-200">
                <div class="space-y-4 text-sm text-center text-gray-600">
                    <div class="flex items-center justify-center space-x-2">
                        <i class="text-yellow-600 fas fa-phone"></i>
                        <span>01 48 47 52 13</span>
                    </div>
                    <div class="flex items-center justify-center space-x-2">
                        <i class="text-green-500 fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </div>
                    <a href="{{ route('espaceclient') }}" @click="mobileMenuOpen = false"
                        class="block mt-3 text-base font-medium text-yellow-600">
                        Espace Client
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
