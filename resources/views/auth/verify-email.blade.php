<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('verify.title') }} - DJOK PRESTIGE</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            overflow: hidden;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fadeInRight 0.8s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .btn-scale {
            transition: all 0.3s ease;
        }

        .btn-scale:hover {
            transform: scale(1.05);
        }

        /* Style pour l'image en cercle */
        .circle-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
        }
    </style>
</head>

<body class="h-screen flex">
    <!-- Section Formulaire (50%) - GAUCHE -->
    <div class="w-full lg:w-1/2 h-full flex justify-center bg-gray-50 animate-fade-in-left overflow-y-auto p-6 lg:p-8">
        <div class="w-full max-w-md pt-32 pb-16">
            <!-- En-tête -->
            <div class="text-center mb-10">
                <!-- Image DP2.webp en cercle -->
                <div class="mb-6 animate-float">
                    <img src="{{ asset('DP2.webp') }}" alt="Security Person" class="circle-image mx-auto">
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ __('verify.heading') }}</h1>
                <p class="text-gray-600 text-lg leading-relaxed">
                    {!! __('verify.welcome_message') !!}
                </p>
            </div>

            <!-- Message principal -->
            <div class="bg-blue-50 border border-blue-300 text-blue-800 p-5 rounded-xl mb-6 text-center shadow-sm">
                <p class="text-sm font-medium">
                    {{ __('verify.not_received_message') }}<br>
                    <span class="text-blue-900">{{ __('verify.resend_offer') }}</span>
                </p>
            </div>

            <!-- Message de succès -->
            @if (session('status') == 'verification-link-sent')
            <div
                class="bg-green-50 border border-green-300 text-green-800 p-4 rounded-xl mb-6 text-center shadow-sm animate-pulse">
                <p class="text-sm font-bold">
                    {{ __('verify.resend_success') }}
                </p>
            </div>
            @endif

            <!-- Boutons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-8">
                <!-- Renvoyer l'email -->
                <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                    @csrf
                    <x-primary-button
                        class="w-full sm:w-auto justify-center py-4 px-8 text-lg font-semibold bg-gradient-to-r from-green-500 to-teal-600 hover:from-green-600 hover:to-teal-700 text-white rounded-xl shadow-lg btn-scale">
                        {{ __('verify.resend_button') }}
                    </x-primary-button>
                </form>

                <!-- Déconnexion -->
                <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center">
                    @csrf
                    <button type="submit"
                        class="text-orange-600 hover:text-orange-800 font-medium text-sm underline transition-colors duration-200">
                        {{ __('verify.logout_button') }}
                    </button>
                </form>
            </div>

            <!-- Avantages rapides -->
            <div
                class="mt-10 p-6 bg-gradient-to-r from-teal-50 to-green-50 rounded-xl border border-teal-200 shadow-inner">
                <div class="flex items-center text-teal-800 mb-3">
                    <i class="fas fa-shield-alt text-teal-600 text-xl mr-3"></i>
                    <span class="font-semibold">{{ __('verify.benefit_security') }}</span>
                </div>
                <div class="flex items-center text-teal-800">
                    <i class="fas fa-envelope text-teal-600 text-xl mr-3"></i>
                    <span class="font-semibold">{{ __('verify.benefit_access') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Image (50%) - DROITE -->
    <div class="hidden lg:block w-1/2 h-full relative animate-fade-in-right">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80"
            alt="{{ __('verify.image_alt') }}" class="w-full h-full object-cover">
        <!-- Overlay sombre -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Texte superposé -->
        <div class="absolute inset-0 flex items-center justify-center p-12">
            <div class="text-center text-white max-w-2xl">
                <div
                    class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-8 backdrop-blur-sm border border-white/30">
                    <i class="fas fa-rocket text-3xl text-yellow-300 animate-float"></i>
                </div>
                <h2 class="text-5xl font-bold mb-6">{!! __('verify.right_title') !!}</h2>
                <p class="text-xl mb-8 text-gray-200 leading-relaxed">
                    {{ __('verify.right_description') }}
                </p>

                <div class="grid grid-cols-2 gap-6 text-base mb-10">
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('verify.feature_trainings') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('verify.feature_support') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('verify.feature_network') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('verify.feature_opportunities') }}</span>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="grid grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">5000+</div>
                        <div class="text-gray-300">{{ __('verify.stats_members') }}</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">95%</div>
                        <div class="text-gray-300">{{ __('verify.stats_satisfaction') }}</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                        <div class="text-gray-300">{{ __('verify.stats_support') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-fade-in-left, .animate-fade-in-right');
            elements.forEach((el, i) => {
                el.style.animationDelay = `${i * 0.2}s`;
            });
        });
    </script>
</body>

</html>
