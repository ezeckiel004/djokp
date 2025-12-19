<!-- Top Navigation -->
<header class="sticky top-0 z-20 bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6">
        <!-- Left: Menu button -->
        <div class="flex items-center">
            <button @click="sidebarOpen = true"
                class="md:hidden p-2 -ml-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100">
                <i class="fas fa-bars text-lg"></i>
            </button>

            <!-- Page Title -->
            <div class="ml-4">
                <h1 class="text-xl font-semibold text-gray-800">
                    @yield('page-title', 'Dashboard')
                </h1>
                <p class="text-sm text-gray-600">
                    @yield('page-description', 'Tableau de bord')
                </p>
            </div>
        </div>

        <!-- Right: User Menu -->
        <div class="relative">
            <button @click="profileOpen = !profileOpen"
                class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100">
                <div class="w-8 h-8 rounded-full bg-djok-yellow flex items-center justify-center">
                    <span class="text-white font-semibold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                </div>
                <div class="hidden md:block">
                    <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                </div>
                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
            </button>

            <!-- Dropdown -->
            <div x-show="profileOpen" x-transition @click.outside="profileOpen = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                <div class="px-4 py-2 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                </div>

                <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-2"></i>Mon profil
                </a>
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-home mr-2"></i>Retour au site
                </a>

                <div class="border-t border-gray-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
