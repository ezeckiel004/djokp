<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('auth.title') }}</title>

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

        .tab-transition {
            transition: all 0.3s ease-in-out;
        }

        /* Style pour l'œil du mot de passe */
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #3b82f6;
        }

        /* Style pour l'image en cercle */
        .circle-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="h-screen flex">
    <!-- Section Formulaire (50%) - GAUCHE -->
    <div class="w-full lg:w-1/2 h-full flex justify-center bg-gray-50 animate-fade-in-left overflow-y-auto p-6 lg:p-8">
        <div class="w-full max-w-md pt-2 pb-2" x-data="{ activeTab: 'login' }">

            <!-- En-tête -->
            <div class="text-center mb-8">
                <!-- Image DP2.webp en cercle - plus grande et sans contour -->
                <div class="mb-6 animate-float">
                    <img src="{{ asset('DP2.webp') }}" alt="Security Person" class="circle-image mx-auto">
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ __('auth.welcome') }}</h1>
                <p class="text-gray-600 text-lg">{{ __('auth.subtitle') }}</p>
            </div>

            <!-- Navigation des Tabs -->
            <div class="flex border-b border-gray-200 mb-8">
                <button @click="activeTab = 'login'"
                    :class="activeTab === 'login' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex-1 py-4 text-center border-b-2 font-medium text-lg tab-transition">
                    {{ __('auth.login_tab') }}
                </button>
                <button @click="activeTab = 'register'"
                    :class="activeTab === 'register' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex-1 py-4 text-center border-b-2 font-medium text-lg tab-transition">
                    {{ __('auth.register_tab') }}
                </button>
            </div>

            <!-- ==================== FORMULAIRE DE CONNEXION ==================== -->
            <div x-show="activeTab === 'login'" class="tab-transition">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-sm text-red-600" :status="session('status')" />

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('auth.email_label')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input"
                            :placeholder="__('auth.email_placeholder')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Mot de passe -->
                    <div class="relative">
                        <x-input-label for="password_login" :value="__('auth.password_label')" />
                        <div class="relative">
                            <x-text-input id="password_login" type="password" name="password"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input pr-12"
                                required autocomplete="current-password" />
                            <button type="button" onclick="togglePassword('password_login', 'eye-icon-login')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 password-toggle"
                                aria-label="{{ __('auth.password_toggle') }}">
                                <i id="eye-icon-login" class="far fa-eye text-gray-500 text-lg"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me + Mot de passe oublié -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="block">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-5 h-5">
                                <span class="ms-2 text-sm text-gray-600 font-medium">{{ __('auth.remember_me') }}</span>
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-blue-600 hover:text-blue-800 underline font-medium">
                            {{ __('auth.forgot_password') }}
                        </a>
                        @endif
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6">
                        <x-primary-button
                            class="w-full justify-center py-4 text-lg font-semibold bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            {{ __('auth.login_button') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Avantages rapides -->
                <div class="mt-8 p-6 bg-blue-50 rounded-xl border border-blue-200 text-sm">
                    <div class="flex items-center text-blue-800 mb-3">
                        <i class="fas fa-bolt mr-2"></i>
                        <span class="font-medium">{{ __('auth.login_benefits_title') }}</span>
                    </div>
                    <div class="flex items-center text-blue-800">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span class="font-medium">{{ __('auth.login_benefits_security') }}</span>
                    </div>
                </div>
            </div>

            <!-- ==================== FORMULAIRE D'INSCRIPTION ==================== -->
            <div x-show="activeTab === 'register'" class="tab-transition">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Le rôle client a l'ID 5 selon votre seeder -->
                    <input type="hidden" name="role_id" value="5">
                    <input type="hidden" name="is_active" value="1">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Prénom et Nom combinés dans le champ name -->
                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('auth.full_name_label')" />
                            <x-text-input id="name" type="text" name="name" :value="old('name')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                :placeholder="__('auth.full_name_placeholder')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="email_register" :value="__('auth.email_label_register')" />
                        <x-text-input id="email_register" type="email" name="email" :value="old('email')"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                            :placeholder="__('auth.email_placeholder')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('auth.phone_label')" />
                        <x-text-input id="phone" type="tel" name="phone" :value="old('phone')"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                            :placeholder="__('auth.phone_placeholder')" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <x-input-label for="password" :value="__('auth.password_label_register')" />
                            <div class="relative">
                                <x-text-input id="password" type="password" name="password"
                                    class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input pr-12"
                                    required autocomplete="new-password" />
                                <button type="button" onclick="togglePassword('password', 'eye-icon-password')"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 password-toggle"
                                    aria-label="{{ __('auth.password_toggle') }}">
                                    <i id="eye-icon-password" class="far fa-eye text-gray-500 text-lg"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="relative">
                            <x-input-label for="password_confirmation" :value="__('auth.confirm_password_label')" />
                            <div class="relative">
                                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                    class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input pr-12"
                                    required autocomplete="new-password" />
                                <button type="button"
                                    onclick="togglePassword('password_confirmation', 'eye-icon-confirm')"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 password-toggle"
                                    aria-label="{{ __('auth.password_toggle') }}">
                                    <i id="eye-icon-confirm" class="far fa-eye text-gray-500 text-lg"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Champs optionnels supplémentaires -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="address" :value="__('auth.address_label')" />
                            <x-text-input id="address" type="text" name="address" :value="old('address')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                :placeholder="__('auth.address_placeholder')" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" :value="__('auth.city_label')" />
                            <x-text-input id="city" type="text" name="city" :value="old('city')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                :placeholder="__('auth.city_placeholder')" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="country" :value="__('auth.country_label')" />
                            <x-text-input id="country" type="text" name="country" :value="old('country')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                :placeholder="__('auth.country_placeholder')" />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="birth_date" :value="__('auth.birth_date_label')" />
                            <x-text-input id="birth_date" type="date" name="birth_date" :value="old('birth_date')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input" />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="cni_number" :value="__('auth.cni_label')" />
                            <x-text-input id="cni_number" type="text" name="cni_number" :value="old('cni_number')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                :placeholder="__('auth.cni_placeholder')" />
                            <x-input-error :messages="$errors->get('cni_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="driver_license" :value="__('auth.license_label')" />
                            <x-text-input id="driver_license" type="text" name="driver_license"
                                :value="old('driver_license')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                :placeholder="__('auth.license_placeholder')" />
                            <x-input-error :messages="$errors->get('driver_license')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-start text-sm text-gray-600">
                        <input type="checkbox" id="newsletter" name="newsletter" value="1" {{ old('newsletter')
                            ? 'checked' : '' }} class="rounded text-green-500 focus:ring-green-500 w-5 h-5 mt-0.5">
                        <label for="newsletter" class="ms-3">
                            {{ __('auth.newsletter_label') }}
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('newsletter')" class="mt-2" />

                    <div class="mt-6">
                        <x-primary-button
                            class="w-full justify-center py-4 text-lg font-semibold bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            {{ __('auth.register_button') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- Bénéfices inscription -->
                <div class="mt-8 p-6 bg-green-50 rounded-xl border border-green-200 text-sm">
                    <div class="flex items-center text-green-800 mb-3">
                        <i class="fas fa-gift mr-2"></i>
                        <span class="font-medium">{{ __('auth.register_benefits_welcome') }}</span>
                    </div>
                    <div class="flex items-center text-green-800 mb-3">
                        <i class="fas fa-trophy mr-2"></i>
                        <span class="font-medium">{{ __('auth.register_benefits_training') }}</span>
                    </div>
                    <div class="flex items-center text-green-800">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <span class="font-medium">{{ __('auth.register_benefits_security') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Image (50%) - DROITE -->
    <div class="hidden lg:block w-1/2 h-full relative animate-fade-in-right">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80"
            alt="{{ __('auth.welcome') }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 flex items-center justify-center p-12">
            <div class="text-center text-white max-w-2xl">
                <div
                    class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-8 backdrop-blur-sm border border-white/30">
                    <i class="fas fa-rocket text-3xl text-yellow-300 animate-float"></i>
                </div>
                <h2 class="text-5xl font-bold mb-6">{!! __('auth.right_section_title') !!}</h2>
                <p class="text-xl mb-8 text-gray-200 leading-relaxed">
                    {{ __('auth.right_section_description') }}
                </p>

                <div class="grid grid-cols-2 gap-6 text-base mb-10">
                    <div class="flex items-center justify-start">
                        <i class="fas fa-graduation-cap mr-3 text-yellow-300"></i>
                        <span class="text-lg">{{ __('auth.feature_certified') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-headset mr-3 text-yellow-300"></i>
                        <span class="text-lg">{{ __('auth.feature_support') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-users mr-3 text-yellow-300"></i>
                        <span class="text-lg">{{ __('auth.feature_network') }}</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-briefcase mr-3 text-yellow-300"></i>
                        <span class="text-lg">{{ __('auth.feature_opportunities') }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">5000+</div>
                        <div class="text-gray-300">{{ __('auth.stats_members') }}</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">95%</div>
                        <div class="text-gray-300">{{ __('auth.stats_satisfaction') }}</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                        <div class="text-gray-300">{{ __('auth.stats_support') }}</div>
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

        // Fonction pour basculer l'affichage du mot de passe
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeIcon.classList.add('text-blue-500');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.remove('text-blue-500');
                eyeIcon.classList.add('fa-eye');
            }
        }

        // Traduction automatique des messages d'erreur (optionnel)
        @if($errors->any())
        document.addEventListener('alpine:init', () => {
            // Vous pouvez ajouter ici des traductions spécifiques pour les messages d'erreur
            console.log('Errors detected, you can add custom error handling here');
        });
        @endif
    </script>
</body>

</html>
