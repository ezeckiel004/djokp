<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DJOK PRESTIGE - VTC, Formations & Entrepreneuriat')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Styles -->
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
        }

        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* CORRECTION POUR CACHER LES TOGGLE DUPLIQUÉS */
        [x-cloak] {
            display: none !important;
        }

        /* Cache tous les boutons toggle sauf celui du navbar */
        body:not(.mobile-menu-open) .toggle-button-main,
        body.mobile-menu-open .toggle-button-navbar {
            display: none !important;
        }

        /* Assurer la visibilité du bon bouton */
        .toggle-button-navbar {
            display: block !important;
        }

        /* Styles pour les boutons flottants */
        .floating-buttons-container {
            position: fixed;
            bottom: 80px;
            right: 30px;
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .certification-btn {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
            border: none;
            cursor: not-allowed;
            opacity: 0.9;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 55px;
        }

        .certification-btn:hover {
            opacity: 1;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.6);
        }

        .certification-btn i {
            margin-right: 10px;
            font-size: 20px;
        }

        .icon-buttons-container {
            display: flex;
            gap: 15px;
        }

        .icon-btn {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
            border: none;
            cursor: pointer;
            opacity: 0.9;
            transition: all 0.3s ease;
            color: white;
            text-decoration: none;
        }

        .icon-btn:hover {
            opacity: 1;
            transform: scale(1.15);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
        }

        .whatsapp-btn {
            background: linear-gradient(135deg, #25D366, #128C7E);
        }

        .contact-btn {
            background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        }

        /* Ajouter dans votre fichier CSS principal */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ===== RESPONSIVE MOBILE - POSITION PRESQUE AU CENTRE ===== */

        /* Desktop & Tablette - Position normale */
        @media (min-width: 769px) {
            .floating-buttons-container {
                bottom: 80px;
                right: 30px;
            }
        }

        /* Tablette portrait (768px et moins) */
        @media (max-width: 768px) {
            .floating-buttons-container {
                /* POSITIONNÉ PLUS HAUT - PRESQUE AU CENTRE */
                bottom: 40vh;
                /* 40% depuis le bas = presque au centre */
                right: 20px;
                transform: translateY(50%);
                /* Ajustement pour centrer verticalement */
                gap: 12px;
            }

            .certification-btn {
                padding: 13px 20px;
                font-size: 14px;
                min-height: 52px;
            }

            .certification-btn i {
                font-size: 18px;
            }

            .icon-btn {
                width: 55px;
                height: 55px;
                font-size: 22px;
            }
        }

        /* Mobile paysage (640px et moins) */
        @media (max-width: 640px) {
            .floating-buttons-container {
                bottom: 35vh;
                /* Un peu plus haut */
                right: 15px;
                transform: translateY(50%);
                gap: 10px;
            }

            .certification-btn {
                padding: 12px 18px;
                font-size: 13px;
                min-height: 50px;
                white-space: normal;
                line-height: 1.2;
                text-align: center;
            }

            .certification-btn i {
                margin-right: 8px;
                font-size: 17px;
                flex-shrink: 0;
            }

            .icon-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }
        }

        /* Mobile portrait (480px et moins) */
        @media (max-width: 480px) {
            .floating-buttons-container {
                /* SUR MOBILE PORTRAIT, ON REMONTE ENCORE PLUS */
                bottom: 30vh;
                /* 30% depuis le bas = bien au-dessus du bas */
                right: 12px;
                transform: translateY(50%);
                gap: 8px;
                flex-direction: row;
                align-items: center;
            }

            .certification-btn {
                padding: 11px 16px;
                font-size: 12px;
                min-height: 48px;
                border-radius: 6px;
            }

            .certification-btn i {
                margin-right: 6px;
                font-size: 16px;
            }

            .icon-btn {
                width: 48px;
                height: 48px;
                font-size: 19px;
            }

            .icon-buttons-container {
                gap: 8px;
            }
        }

        /* Petit mobile (380px et moins) */
        @media (max-width: 380px) {
            .floating-buttons-container {
                /* SUR TRÈS PETIT MOBILE, ON S'ADAPTE ENCORE */
                bottom: 25vh;
                /* 25% depuis le bas = bien visible */
                right: 10px;
                transform: translateY(50%);
                gap: 6px;
                flex-direction: row;
                align-items: center;
                padding: 10px;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(5px);
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .certification-btn {
                padding: 10px 14px;
                font-size: 11px;
                min-height: 45px;
                flex-grow: 1;
                white-space: normal;
                line-height: 1.1;
            }

            .certification-btn span {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .certification-btn i {
                margin-right: 5px;
                font-size: 15px;
            }

            .icon-btn {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .icon-buttons-container {
                gap: 6px;
                flex-shrink: 0;
            }
        }

        /* Très petit mobile (320px et moins) */
        @media (max-width: 320px) {
            .floating-buttons-container {
                bottom: 20vh;
                /* 20% depuis le bas = assez haut */
                right: 8px;
                transform: translateY(50%);
                flex-direction: row;
                align-items: center;
                gap: 5px;
                padding: 8px;
            }

            .certification-btn {
                padding: 9px 12px;
                font-size: 10px;
                min-height: 42px;
                text-align: center;
            }

            .certification-btn i {
                margin-right: 4px;
                font-size: 14px;
            }

            .icon-btn {
                width: 42px;
                height: 42px;
                font-size: 17px;
            }

            .icon-buttons-container {
                gap: 5px;
            }
        }

        /* Pour les écrans en mode paysage sur mobile */
        @media (max-height: 500px) and (max-width: 900px) {
            .floating-buttons-container {
                bottom: 15vh;
                /* Plus bas en paysage car l'écran est court */
                right: 15px;
                transform: translateY(50%);
            }
        }

        /* Pour les tablettes en mode portrait (écran haut) */
        @media (min-height: 1000px) and (max-width: 768px) {
            .floating-buttons-container {
                bottom: 25vh;
                /* Plus bas sur les hautes résolutions */
                right: 25px;
                transform: translateY(50%);
            }
        }

        /* Assurer que les boutons ne chevauchent pas le contenu */
        @media (max-width: 768px) {
            main {
                padding-bottom: 100px;
            }
        }

        /* Pour éviter les problèmes sur les anciens navigateurs */
        @supports not (backdrop-filter: blur(5px)) {
            .floating-buttons-container {
                background: rgba(255, 255, 255, 0.95);
            }
        }
    </style>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased" :class="{ 'mobile-menu-open': mobileMenuOpen }" x-data="{ mobileMenuOpen: false }">
    <!-- La navbar DOIT être incluse ici -->
    @include('layouts.navbar')

    @yield('content')

    <!-- Newsletter juste avant le footer -->
    @include('layouts.newsletter-section')

    @include('layouts.footer')

    <!-- Boutons flottants en bas à droite - SUR LA MÊME LIGNE -->
    <div class="floating-buttons-container">
        <!-- Bouton Certification -->
        <button class="certification-btn" disabled
            title="Téléchargez notre certification officielle (Disponible prochainement)">
            <i class="fas fa-download"></i>
            <span>Téléchargez notre certification</span>
        </button>

        <!-- Conteneur pour les icônes -->
        <div class="icon-buttons-container">
            <!-- WhatsApp -->
            <button class="icon-btn whatsapp-btn" disabled title="WhatsApp (Disponible prochainement)">
                <i class="fab fa-whatsapp"></i>
            </button>

            <!-- Contact avec lien vers la page de contact -->
            <a href="{{ route('contact') }}" class="icon-btn contact-btn" title="Contactez-nous">
                <i class="fas fa-address-book"></i>
            </a>
        </div>
    </div>

    <script>
        // Synchronisation de l'état du menu mobile
        document.addEventListener('alpine:init', () => {
            Alpine.data('mobileMenu', () => ({
                mobileMenuOpen: false,

                init() {
                    // Écouter les changements d'état du menu
                    this.$watch('mobileMenuOpen', (value) => {
                        // Mettre à jour la classe sur le body
                        if (value) {
                            document.body.classList.add('mobile-menu-open');
                        } else {
                            document.body.classList.remove('mobile-menu-open');
                        }
                    });
                }
            }));
        });

        // Optimisation pour mobile : ajustement dynamique de la position
        document.addEventListener('DOMContentLoaded', function() {
            const floatingButtons = document.querySelector('.floating-buttons-container');

            // Fonction pour ajuster la position selon la taille de l'écran
            function adjustButtonPosition() {
                if (!floatingButtons) return;

                const width = window.innerWidth;
                const height = window.innerHeight;
                const isMobile = width <= 768;

                if (isMobile) {
                    // Sur mobile, calculer une position presque centrale
                    const mobileBottom = Math.max(20, height * 0.25); // 25% depuis le bas minimum 20px
                    floatingButtons.style.bottom = mobileBottom + 'px';

                    // Ajuster la taille en fonction de la hauteur
                    if (height < 600) {
                        floatingButtons.style.transform = 'translateY(30%)';
                    } else {
                        floatingButtons.style.transform = 'translateY(50%)';
                    }
                } else {
                    // Sur desktop, position fixe
                    floatingButtons.style.bottom = '80px';
                    floatingButtons.style.transform = 'none';
                }

                // Cacher sur écrans trop courts
                if (height < 400) {
                    floatingButtons.style.display = 'none';
                } else {
                    floatingButtons.style.display = 'flex';
                }
            }

            // Ajuster au chargement
            adjustButtonPosition();

            // Ajuster lors des événements de redimensionnement
            window.addEventListener('resize', adjustButtonPosition);
            window.addEventListener('orientationchange', function() {
                setTimeout(adjustButtonPosition, 100);
            });

            // Ajuster lors du défilement pour s'assurer que c'est visible
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                if (scrollTimeout) {
                    clearTimeout(scrollTimeout);
                }
                scrollTimeout = setTimeout(adjustButtonPosition, 100);
            });
        });
    </script>
</body>

</html>
