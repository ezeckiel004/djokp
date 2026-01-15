<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('confirm.title') }} - DJOK PRESTIGE</title>

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

        .form-input:focus {
            transform: scale(1.02);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="h-screen flex">
    <!-- Section Formulaire (50%) - GAUCHE -->
    <div class="w-full lg:w-1/2 h-full flex justify-center bg-gray-50 animate-fade-in-left overflow-y-auto p-6 lg:p-8">
        <div class="w-full max-w-md pt-32 pb-16">
            <!-- En-tête -->
            <div class="text-center mb-8">
                <div
                    class="w-24 h-24 bg-gradient-to-r from-red-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-float shadow-lg">
                    <i class="fas fa-shield-lock text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ __('confirm.heading') }}</h1>
                <p class="text-gray-600 text-lg">
                    {{ __('confirm.message') }}
                </p>
            </div>

            <!-- Formulaire -->
            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <!-- Mot de passe -->
                <div>
                    <x-input-label for="password" value="{{ __('confirm.current_password') }}" />
                    <x-text-input id="password" type="password" name="password"
                        class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent form-input"
                        required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Bouton -->
                <div class="mt-6">
                    <x-primary-button
                        class="w-full justify-center py-4 text-lg font-semibold bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        {{ __('confirm.button') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Lien retour -->
            <div class="mt-6 text-center">
                <a href="{{ url()->previous() }}"
                    class="text-orange-600 hover:text-orange-800 font-medium text-sm underline">
                    {{ __('confirm.back_link') }}
                </a>
            </div>

            <!-- Avantages rapides -->
            <div class="mt-8 p-6 bg-orange-50 rounded-xl border border-orange-200 text-sm">
                <div class="flex items-center text-orange-800 mb-3">
                    <i class="fas fa-lock text-orange-500 text-lg mr-3"></i>
                    <span class="font-medium">{{ __('confirm.protected_access') }}</span>
                </div>
                <div class="flex items-center text-orange-800">
                    <i class="fas fa-check-circle text-orange-500 text-lg mr-3"></i>
                    <span class="font-medium">{{ __('confirm.enhanced_security') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Image (50%) - DROITE -->
    <div class="hidden lg:block w-1/2 h-full relative animate-fade-in-right">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80"
            alt="{{ __('confirm.image_alt') }}" class="w-full h-full object-cover">
        <!-- Overlay sombre -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Texte superposé -->
        <div class="absolute inset-0 flex items-center justify-center p-12">
            <div class="text-center text-white max-w-2xl">
                <div
                    class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-8 backdrop-blur-sm border border-white/30">
                    <i class="fas fa-rocket text-3xl text-yellow-300 animate-float"></i>
                </div>
                <h2 class="text-5xl font-bold mb-6">{!! __('confirm.right_title') !!}</h2>
                <p class="text-xl mb-8 text-gray-200 leading-relaxed">
                    {{ __('confirm.right_description') }}
                </p>

                <div class="grid grid-cols-2 gap-6 text-base mb-10">
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('confirm.feature_trainings') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('confirm.feature_support') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('confirm.feature_network') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-check-circle text-yellow-300 text-xl mr-3"></i>
                        <span class="text-lg">{{ __('confirm.feature_opportunities') }}</span>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="grid grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">5000+</div>
                        <div class="text-gray-300">{{ __('confirm.stats_members') }}</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">95%</div>
                        <div class="text-gray-300">{{ __('confirm.stats_satisfaction') }}</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                        <div class="text-gray-300">{{ __('confirm.stats_support') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-fade-in-left, .animate-fade-in-right');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>
</body>

</html>
