<!-- resources/views/layouts/navbar.blade.php -->
<header class="header">
    <!-- Top -->
    <div class="header-top">
        <div class="phone">
            <i class="fa-solid fa-phone"></i> 06.99.16.44.55
        </div>
    </div>

    <!-- Logo -->
    <div class="logo-container">
        <div class="logo">
            <img src="{{ asset('DP.png') }}" alt="DJOK PRESTIGE">
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="nav hidden md:flex">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">ACCUEIL</a>
        <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">A PROPOS</a>

        <!-- Formations Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <a href="#" @click.prevent="open = !open"
                :class="{ 'active': {{ request()->is('formation*') ? 'true' : 'false' }} }" class="flex items-center">
                FORMATIONS <i class="fa-solid fa-chevron-down ml-1 transition-transform duration-300"
                    :class="{ 'rotate-180': open }"></i>
            </a>
            <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.300ms
                class="absolute z-[9999] w-48 mt-2 bg-black border border-yellow-600 rounded-lg shadow-lg top-full left-0">
                <a href="{{ route('formation') }}"
                    class="block px-4 py-3 text-sm text-white hover:bg-yellow-600 hover:text-black border-b border-gray-800">
                    Formation VTC
                </a>
                <a href="{{ route('formation.international') }}"
                    class="block px-4 py-3 text-sm text-white hover:bg-yellow-600 hover:text-black">
                    Formation Internationale
                </a>
            </div>
        </div>

        <!-- Services Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <a href="#" @click.prevent="open = !open"
                :class="{ 'active': {{ request()->is('reservation') || request()->is('location') || request()->is('conciergerie') ? 'true' : 'false' }} }"
                class="flex items-center">
                NOS SERVICES <i class="fa-solid fa-chevron-down ml-1 transition-transform duration-300"
                    :class="{ 'rotate-180': open }"></i>
            </a>
            <div x-show="open" @click.outside="open = false" x-transition.opacity.duration.300ms
                class="absolute z-[9999] w-48 mt-2 bg-black border border-yellow-600 rounded-lg shadow-lg top-full left-0">
                <a href="{{ route('reservation') }}"
                    class="block px-4 py-3 text-sm text-white hover:bg-yellow-600 hover:text-black border-b border-gray-800">
                    VTC & Transport
                </a>
                <a href="{{ route('location') }}"
                    class="block px-4 py-3 text-sm text-white hover:bg-yellow-600 hover:text-black border-b border-gray-800">
                    Location de Voitures
                </a>
                <a href="{{ route('conciergerie') }}"
                    class="block px-4 py-3 text-sm text-white hover:bg-yellow-600 hover:text-black">
                    Conciergerie
                </a>
            </div>
        </div>

        <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">NOUS CONTACTER</a>
        <a href="{{ route('blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">BLOG</a>
    </nav>

    <!-- Auth -->
    <div class="auth-section">
        @if (Route::has('login'))
        <div class="auth-links">
            @auth
            <a href="{{ url('/user/dashboard') }}" class="dashboard-link">
                <i class="fas fa-tachometer-alt"></i> DASHBOARD
            </a>
            @else
            @if (Route::has('register'))
            <a href="{{ route('espaceclient') }}" class="client-btn">
                <i class="fas fa-user-shield"></i> ESPACE CLIENT
            </a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <!-- Mobile Menu -->
    <div x-data="{ mobileOpen: false, formationsMobileOpen: false, servicesMobileOpen: false }">
        <!-- Mobile Menu Button -->
        <button @click="mobileOpen = !mobileOpen" class="mobile-menu-btn md:hidden">
            <i :class="mobileOpen ? 'fas fa-times' : 'fas fa-bars'" class="text-xl"></i>
        </button>

        <!-- Mobile Menu Content -->
        <div x-show="mobileOpen" x-transition.opacity.duration.300ms @click.outside="mobileOpen = false"
            class="mobile-menu md:hidden">
            <div class="mobile-menu-content">
                <a href="{{ url('/') }}" @click="mobileOpen = false" class="mobile-link">
                    ACCUEIL
                </a>
                <a href="{{ route('about') }}" @click="mobileOpen = false" class="mobile-link">
                    A PROPOS
                </a>

                <!-- Formations Mobile -->
                <div class="mobile-dropdown">
                    <button @click="formationsMobileOpen = !formationsMobileOpen" class="mobile-dropdown-btn">
                        FORMATIONS <i class="fas fa-chevron-down transform transition-transform duration-300"
                            :class="{ 'rotate-180': formationsMobileOpen }"></i>
                    </button>
                    <div x-show="formationsMobileOpen" x-collapse class="mobile-dropdown-content">
                        <a href="{{ route('formation') }}" @click="mobileOpen = false" class="mobile-sub-link">
                            Formation VTC
                        </a>
                        <a href="{{ route('formation.international') }}" @click="mobileOpen = false"
                            class="mobile-sub-link">
                            Formation Internationale
                        </a>
                    </div>
                </div>

                <!-- Services Mobile -->
                <div class="mobile-dropdown">
                    <button @click="servicesMobileOpen = !servicesMobileOpen" class="mobile-dropdown-btn">
                        NOS SERVICES <i class="fas fa-chevron-down transform transition-transform duration-300"
                            :class="{ 'rotate-180': servicesMobileOpen }"></i>
                    </button>
                    <div x-show="servicesMobileOpen" x-collapse class="mobile-dropdown-content">
                        <a href="{{ route('reservation') }}" @click="mobileOpen = false" class="mobile-sub-link">
                            VTC & Transport
                        </a>
                        <a href="{{ route('location') }}" @click="mobileOpen = false" class="mobile-sub-link">
                            Location de Voitures
                        </a>
                        <a href="{{ route('conciergerie') }}" @click="mobileOpen = false" class="mobile-sub-link">
                            Conciergerie
                        </a>
                    </div>
                </div>

                <a href="{{ route('contact') }}" @click="mobileOpen = false" class="mobile-link">
                    NOUS CONTACTER
                </a>
                <a href="{{ route('blog') }}" @click="mobileOpen = false" class="mobile-link">
                    BLOG
                </a>

                <!-- Auth Mobile -->
                <div class="mobile-auth">
                    @auth
                    <a href="{{ url('/user/dashboard') }}" @click="mobileOpen = false" class="mobile-dashboard">
                        <i class="fas fa-tachometer-alt"></i> DASHBOARD
                    </a>
                    @else
                    <a href="{{ route('espaceclient') }}" @click="mobileOpen = false" class="mobile-client-btn">
                        <i class="fas fa-user-shield"></i> ESPACE CLIENT
                    </a>
                    @endauth
                </div>

                <!-- Contact Mobile -->
                <div class="mobile-contact">
                    <div class="mobile-phone">
                        <i class="fa-solid fa-phone text-yellow-600"></i> 06.99.16.44.55
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    /* Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
    }

    /* Header */
    .header {
        background: #000;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        padding: 15px 50px;
        position: relative;
        width: 100%;
        z-index: 100;
    }

    /* Header Top - Le numéro reste à gauche */
    .header-top {
        display: flex;
        justify-content: flex-start;
        /* Changé de center à flex-start */
        align-items: center;
        width: 100%;
    }

    .phone {
        background: #caa24d;
        color: #000;
        padding: 8px 15px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Logo Container */
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 15px 0;
        margin-top: -50px;
        /* Retour à -50px comme avant */
        width: 100%;
    }

    /* Logo */
    .logo {
        text-align: center;
    }

    .logo img {
        max-width: 180px;
        width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    /* Desktop Navigation */
    .nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 35px;
        margin-top: 10px;
        position: relative;
        z-index: 101;
    }

    .nav a {
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding-bottom: 6px;
        position: relative;
        transition: color 0.3s ease;
        white-space: nowrap;
    }

    .nav a.active,
    .nav a:hover {
        color: #caa24d;
    }

    .nav a.active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 100%;
        height: 2px;
        background: #caa24d;
    }

    /* Dropdown Styles */
    .nav .relative {
        position: relative;
    }

    .nav .relative a {
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .nav .relative .rotate-180 {
        transform: rotate(180deg);
    }

    .nav .absolute {
        position: absolute;
        top: 100%;
        left: 0;
        background: #000;
        border: 1px solid #caa24d;
        border-radius: 4px;
        min-width: 220px;
        z-index: 9999;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .nav .absolute a {
        display: block;
        padding: 12px 20px;
        font-size: 13px;
        color: #fff;
        transition: all 0.3s ease;
    }

    .nav .absolute a:hover {
        background: #caa24d;
        color: #000;
    }

    /* Auth Section - RESTE À DROITE */
    .auth-section {
        position: absolute;
        right: 50px;
        bottom: 15px;
        display: flex;
        align-items: center;
        z-index: 101;
    }

    /* Auth Links */
    .auth-links {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .dashboard-link {
        color: #caa24d;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        border: 1px solid #caa24d;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .dashboard-link:hover {
        background: rgba(202, 162, 77, 0.1);
    }

    .client-btn {
        background: #caa24d;
        color: #000;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }

    .client-btn:hover {
        background: #e6b85c;
        transform: translateY(-2px);
    }

    /* Mobile Menu Button */
    .mobile-menu-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        color: #caa24d;
        cursor: pointer;
        display: none;
        z-index: 102;
        padding: 10px;
    }

    /* Mobile Menu */
    .mobile-menu {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.98);
        z-index: 9998;
        overflow-y: auto;
    }

    .mobile-menu-content {
        padding: 80px 20px 40px;
        min-height: 100%;
        overflow-y: auto;
    }

    .mobile-link {
        display: block;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .mobile-link:hover {
        color: #caa24d;
    }

    /* Mobile Dropdown */
    .mobile-dropdown {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .mobile-dropdown-btn {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        padding: 15px 0;
        background: none;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .mobile-dropdown-btn:hover {
        color: #caa24d;
    }

    .mobile-dropdown-content {
        padding-left: 20px;
    }

    .mobile-sub-link {
        display: block;
        color: #ccc;
        text-decoration: none;
        font-size: 14px;
        padding: 12px 0;
        transition: all 0.3s ease;
    }

    .mobile-sub-link:hover {
        color: #caa24d;
    }

    /* Mobile Auth */
    .mobile-auth {
        margin-top: 30px;
        padding: 20px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .mobile-dashboard {
        display: block;
        color: #caa24d;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        padding: 15px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #caa24d;
        border-radius: 4px;
        padding: 15px;
        text-align: center;
        justify-content: center;
        margin-bottom: 15px;
    }

    .mobile-client-btn {
        display: block;
        background: #caa24d;
        color: #000;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
        padding: 15px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    /* Mobile Contact */
    .mobile-contact {
        margin-top: 30px;
    }

    .mobile-phone {
        background: #caa24d;
        color: #000;
        padding: 15px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .header {
            padding: 15px 30px;
        }

        .auth-section {
            right: 30px;
        }
    }

    @media (max-width: 768px) {

        .nav,
        .auth-section {
            display: none;
        }

        .mobile-menu-btn {
            display: block;
        }

        .header {
            padding: 15px;
        }

        .logo-container {
            margin-top: 10px;
        }

        .logo img {
            max-width: 140px;
        }

        .header-top {
            justify-content: flex-start;
            /* Garde à gauche sur mobile aussi */
        }

        .mobile-menu-content {
            padding: 70px 20px 30px;
        }
    }

    @media (max-width: 640px) {
        .header {
            padding: 12px;
        }

        .logo img {
            max-width: 120px;
        }

        .phone {
            font-size: 12px;
            padding: 8px 15px;
        }
    }

    @media (max-width: 480px) {
        .header {
            padding: 10px;
        }

        .logo img {
            max-width: 110px;
        }

        .phone {
            font-size: 11px;
            padding: 6px 12px;
        }
    }
</style>
