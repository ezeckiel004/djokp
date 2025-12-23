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
            <img src="{{ asset('DP2.webp') }}" alt="DJOK PRESTIGE">
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="desktop-nav">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">ACCUEIL</a>
        <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">A PROPOS</a>

        <!-- Formations Dropdown -->
        <div class="dropdown">
            <a href="#" class="dropdown-toggle {{ request()->is('formation*') ? 'active' : '' }}">
                FORMATIONS <i class="fa-solid fa-chevron-down ml-1"></i>
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('formation') }}" class="dropdown-item">
                    Formation VTC
                </a>
                <a href="{{ route('formation.international') }}" class="dropdown-item">
                    Formation Internationale
                </a>
            </div>
        </div>

        <!-- Services Dropdown -->
        <div class="dropdown">
            <a href="#"
                class="dropdown-toggle {{ request()->is('reservation') || request()->is('location') || request()->is('conciergerie') ? 'active' : '' }}">
                NOS SERVICES <i class="fa-solid fa-chevron-down ml-1"></i>
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('reservation') }}" class="dropdown-item">
                    VTC & Transport
                </a>
                <a href="{{ route('location') }}" class="dropdown-item">
                    Location de Voitures
                </a>
                <a href="{{ route('conciergerie') }}" class="dropdown-item">
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

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu mobile">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-content">
            <a href="{{ url('/') }}" class="mobile-link">ACCUEIL</a>
            <a href="{{ route('about') }}" class="mobile-link">A PROPOS</a>

            <!-- Formations Mobile -->
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" data-target="formations-dropdown">
                    FORMATIONS <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content" id="formations-dropdown">
                    <a href="{{ route('formation') }}" class="mobile-sub-link">Formation VTC</a>
                    <a href="{{ route('formation.international') }}" class="mobile-sub-link">Formation
                        Internationale</a>
                </div>
            </div>

            <!-- Services Mobile -->
            <div class="mobile-dropdown">
                <button class="mobile-dropdown-btn" data-target="services-dropdown">
                    NOS SERVICES <i class="fas fa-chevron-down"></i>
                </button>
                <div class="mobile-dropdown-content" id="services-dropdown">
                    <a href="{{ route('reservation') }}" class="mobile-sub-link">VTC & Transport</a>
                    <a href="{{ route('location') }}" class="mobile-sub-link">Location de Voitures</a>
                    <a href="{{ route('conciergerie') }}" class="mobile-sub-link">Conciergerie</a>
                </div>
            </div>

            <a href="{{ route('contact') }}" class="mobile-link">NOUS CONTACTER</a>
            <a href="{{ route('blog') }}" class="mobile-link">BLOG</a>

            <!-- Auth Mobile -->
            <div class="mobile-auth">
                @auth
                <a href="{{ url('/user/dashboard') }}" class="mobile-dashboard">
                    <i class="fas fa-tachometer-alt"></i> DASHBOARD
                </a>
                @else
                <a href="{{ route('espaceclient') }}" class="mobile-client-btn">
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

    /* Header Top */
    .header-top {
        display: flex;
        justify-content: flex-start;
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
    .desktop-nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 35px;
        margin-top: 10px;
        position: relative;
        z-index: 101;
    }

    .desktop-nav a {
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        padding-bottom: 6px;
        position: relative;
        transition: color 0.3s ease;
        white-space: nowrap;
    }

    .desktop-nav a.active,
    .desktop-nav a:hover {
        color: #caa24d;
    }

    .desktop-nav a.active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -8px;
        width: 100%;
        height: 2px;
        background: #caa24d;
    }

    /* Desktop Dropdown */
    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: #000;
        border: 1px solid #caa24d;
        border-radius: 4px;
        min-width: 220px;
        z-index: 9999;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        display: none;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        display: block;
        padding: 12px 20px;
        font-size: 13px;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-item:hover {
        background: #caa24d;
        color: #000;
    }

    /* Auth Section */
    .auth-section {
        position: absolute;
        right: 50px;
        bottom: 15px;
        display: flex;
        align-items: center;
        z-index: 101;
    }

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
        z-index: 10000;
        padding: 10px;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        display: none;
    }

    .mobile-menu-btn:hover {
        background: rgba(202, 162, 77, 0.1);
        border-radius: 4px;
    }

    .mobile-menu-btn i {
        font-size: 24px;
    }

    .mobile-menu-btn.active i {
        content: "\f00d";
    }

    /* Mobile Menu */
    .mobile-menu {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.98);
        z-index: 9999;
        overflow-y: auto;
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .mobile-menu.active {
        display: block;
        opacity: 1;
    }

    .mobile-menu-content {
        padding: 100px 20px 40px;
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

    .mobile-dropdown-btn i {
        transition: transform 0.3s ease;
    }

    .mobile-dropdown-btn.active i {
        transform: rotate(180deg);
    }

    .mobile-dropdown-content {
        padding-left: 20px;
        display: none;
    }

    .mobile-dropdown-content.active {
        display: block;
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

        .desktop-nav,
        .auth-section {
            display: none;
        }

        .mobile-menu-btn {
            display: flex;
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
        }

        .mobile-menu-content {
            padding: 100px 20px 30px;
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

        .mobile-menu-btn {
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
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

        .mobile-menu-btn {
            top: 12px;
            right: 12px;
            width: 36px;
            height: 36px;
        }

        .mobile-menu-btn i {
            font-size: 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Éléments du DOM
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuIcon = mobileMenuBtn.querySelector('i');

    // Ouvrir/fermer le menu mobile
    mobileMenuBtn.addEventListener('click', function() {
        const isMenuOpen = mobileMenu.classList.contains('active');

        if (isMenuOpen) {
            // Fermer le menu
            mobileMenu.classList.remove('active');
            mobileMenuIcon.classList.remove('fa-times');
            mobileMenuIcon.classList.add('fa-bars');
            document.body.style.overflow = ''; // Réactiver le défilement
        } else {
            // Ouvrir le menu
            mobileMenu.classList.add('active');
            mobileMenuIcon.classList.remove('fa-bars');
            mobileMenuIcon.classList.add('fa-times');
            document.body.style.overflow = 'hidden'; // Bloquer le défilement
        }
    });

    // Fermer le menu en cliquant sur un lien
    const mobileLinks = document.querySelectorAll('.mobile-link, .mobile-sub-link, .mobile-dashboard, .mobile-client-btn');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            mobileMenuIcon.classList.remove('fa-times');
            mobileMenuIcon.classList.add('fa-bars');
            document.body.style.overflow = '';
        });
    });

    // Gérer les dropdowns mobiles
    const mobileDropdownBtns = document.querySelectorAll('.mobile-dropdown-btn');
    mobileDropdownBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const dropdownContent = document.getElementById(targetId);

            // Fermer tous les autres dropdowns
            mobileDropdownBtns.forEach(otherBtn => {
                if (otherBtn !== btn) {
                    const otherTargetId = otherBtn.getAttribute('data-target');
                    const otherContent = document.getElementById(otherTargetId);
                    otherContent.classList.remove('active');
                    otherBtn.classList.remove('active');
                }
            });

            // Basculer le dropdown actuel
            dropdownContent.classList.toggle('active');
            this.classList.toggle('active');
        });
    });

    // Fermer le menu en cliquant en dehors (sur le fond)
    mobileMenu.addEventListener('click', function(e) {
        if (e.target === mobileMenu) {
            mobileMenu.classList.remove('active');
            mobileMenuIcon.classList.remove('fa-times');
            mobileMenuIcon.classList.add('fa-bars');
            document.body.style.overflow = '';
        }
    });

    // Fermer le menu avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            mobileMenu.classList.remove('active');
            mobileMenuIcon.classList.remove('fa-times');
            mobileMenuIcon.classList.add('fa-bars');
            document.body.style.overflow = '';
        }
    });
});
</script>
