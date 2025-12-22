<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DJOK PRESTIGE - VTC, Formations & Entrepreneuriat')</title>

    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Styles inspirés de body-djok-prestige.html -->
    <style>
        :root {
            --gold: #caa24d;
            --gold-rgb: 202, 162, 77;
            --black: #000;
            --dark: #0d0d0d;
            --gray: #bdbdbd;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background: #000;
            color: #fff;
            font-family: "Montserrat", sans-serif;
        }

        /* Style sobre pour les sections */
        .section-title {
            text-align: center;
            color: var(--gold);
            margin: 60px 0 30px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        /* Cards services */
        .service-card {
            background: #fff;
            color: #000;
            border-radius: 0;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        /* Buttons style body-djok */
        .gold-button {
            background: var(--gold);
            color: #000;
            border: none;
            padding: 12px 25px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .gold-button:hover {
            opacity: 0.9;
        }

        /* Box estimation */
        .estimation-box {
            background: #fff;
            color: #000;
            max-width: 450px;
            margin: 30px auto;
            padding: 25px;
        }

        .estimation-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }

        /* Reviews style */
        .review-box {
            background: #111;
            padding: 20px;
            width: 280px;
            font-size: 0.9rem;
        }

        /* Animations minimalistes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        /* Styles pour les boutons flottants - Style sobre */
        .floating-buttons-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .certification-btn {
            background: rgba(var(--gold-rgb), 0.9);
            color: black;
            padding: 14px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(var(--gold-rgb), 0.5);
            cursor: not-allowed;
            opacity: 0.9;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 55px;
            backdrop-filter: blur(10px);
        }

        .certification-btn:hover {
            opacity: 1;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .certification-btn i {
            margin-right: 10px;
            font-size: 18px;
        }

        .icon-buttons-container {
            display: flex;
            gap: 15px;
        }

        .icon-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            cursor: not-allowed;
            opacity: 0.9;
            transition: all 0.3s ease;
            color: white;
            backdrop-filter: blur(10px);
        }

        .icon-btn:hover {
            opacity: 1;
            transform: scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
        }

        .whatsapp-btn {
            background: rgba(37, 211, 102, 0.9);
        }

        .contact-btn {
            background: rgba(var(--gold-rgb), 0.9);
        }

        /* Responsive pour les boutons flottants */
        @media (max-width: 768px) {
            .floating-buttons-container {
                display: none !important;
                /* Cacher sur mobile */
            }

            /* Conserver les anciens styles pour référence */
            /*
            .floating-buttons-container {
                bottom: 20px;
                right: 15px;
                gap: 10px;
            }

            .certification-btn {
                padding: 12px 18px;
                font-size: 12px;
                min-height: 50px;
            }

            .certification-btn i {
                font-size: 16px;
                margin-right: 8px;
            }

            .icon-btn {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .icon-buttons-container {
                gap: 10px;
            }
            */
        }

        @media (min-width: 769px) {
            .floating-buttons-container {
                display: flex !important;
                /* Afficher sur desktop */
            }
        }

        @media (max-width: 640px) {
            .floating-buttons-container {
                flex-direction: column;
                align-items: flex-end;
                gap: 10px;
            }

            .certification-btn {
                padding: 10px 16px;
                font-size: 11px;
                min-height: 45px;
            }

            .certification-btn i {
                font-size: 15px;
                margin-right: 6px;
            }

            .icon-buttons-container {
                width: 100%;
                justify-content: flex-end;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .floating-buttons-container {
                bottom: 15px;
                right: 10px;
                gap: 8px;
            }

            .certification-btn {
                padding: 8px 12px;
                font-size: 10px;
                min-height: 40px;
                border-radius: 6px;
            }

            .certification-btn span {
                white-space: normal;
                line-height: 1.2;
            }

            .certification-btn i {
                font-size: 14px;
                margin-right: 5px;
            }

            .icon-btn {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }

            .section-title {
                margin: 40px 0 20px;
                font-size: 1.5rem;
            }
        }

        /* Responsive général */
        @media (max-width: 768px) {
            .section-title {
                margin: 40px 0 20px;
                font-size: 1.5rem;
            }

            .hero-slide h1 {
                font-size: 2rem !important;
            }
        }

        /* Assurer que le contenu n'est pas caché par les boutons */
        .min-h-screen {
            padding-bottom: 100px;
        }
    </style>

    <!-- Tailwind CSS pour le layout -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black text-white">
    <!-- La navbar -->
    @include('layouts.navbar')

    @yield('content')

    <!-- Newsletter et Footer -->
    @include('layouts.newsletter-section')
    @include('layouts.footer')

    <!-- Boutons flottants - Cachés sur mobile avec hidden md:flex -->
    <div class="floating-buttons-container hidden md:flex">
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

            <!-- Contact -->
            <a href="{{ route('contact') }}" class="icon-btn contact-btn" title="Contactez-nous">
                <i class="fas fa-address-book"></i>
            </a>
        </div>
    </div>

    <script>
        // Scripts pour les boutons flottants
        document.addEventListener('DOMContentLoaded', function() {
            const floatingButtons = document.querySelector('.floating-buttons-container');

            // Fonction pour ajuster la position selon la taille de l'écran
            function adjustButtonPosition() {
                if (!floatingButtons) return;

                const width = window.innerWidth;
                const isMobile = width <= 768;

                // Si on est sur mobile, ne pas exécuter le reste
                if (isMobile) return;

                // Sur desktop, ajustements selon la taille
                if (width <= 1024) {
                    floatingButtons.style.gap = '12px';
                } else {
                    floatingButtons.style.gap = '15px';
                }
            }

            // Ajuster au chargement seulement sur desktop
            adjustButtonPosition();

            // Ajuster lors des événements de redimensionnement seulement sur desktop
            window.addEventListener('resize', adjustButtonPosition);
            window.addEventListener('orientationchange', function() {
                setTimeout(adjustButtonPosition, 100);
            });

            // Animation pour les boutons flottants seulement sur desktop
            setTimeout(() => {
                if (floatingButtons && window.innerWidth > 768) {
                    floatingButtons.style.opacity = '0';
                    floatingButtons.style.transform = 'translateY(20px)';
                    floatingButtons.style.transition = 'opacity 0.5s ease, transform 0.5s ease';

                    setTimeout(() => {
                        floatingButtons.style.opacity = '1';
                        floatingButtons.style.transform = 'translateY(0)';
                    }, 100);
                }
            }, 500);

            // Gestion du slider avec style sobre (si présent)
            const slides = document.querySelectorAll('.hero-slide');
            const indicators = document.querySelectorAll('.slider-indicator');
            let currentSlide = 0;

            if (slides.length > 0) {
                function showSlide(index) {
                    slides.forEach(slide => slide.classList.remove('active'));
                    indicators.forEach(indicator => indicator.classList.remove('active'));

                    slides[index].classList.add('active');
                    indicators[index].classList.add('active');
                    currentSlide = index;
                }

                // Auto-slide
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                }, 5000);

                // Événements pour les contrôles du slider
                document.querySelector('.slider-prev')?.addEventListener('click', () => {
                    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
                    showSlide(currentSlide);
                });

                document.querySelector('.slider-next')?.addEventListener('click', () => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    showSlide(currentSlide);
                });

                // Indicateurs
                indicators.forEach((indicator, index) => {
                    indicator.addEventListener('click', () => showSlide(index));
                });
            }
        });
    </script>
</body>

</html>
