<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client - DJOK PRESTIGE</title>

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
    </style>
</head>

<body class="h-screen flex">
    <!-- Section Formulaire (50%) - GAUCHE -->
    <div class="w-full lg:w-1/2 h-full flex justify-center bg-gray-50 animate-fade-in-left overflow-y-auto p-6 lg:p-8">
        <div class="w-full max-w-md pt-2 pb-2" x-data="{ activeTab: 'login' }">

            <!-- En-tête -->
            <div class="text-center mb-8">
                <div
                    class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-float shadow-lg">
                    <i class="fas fa-user-shield text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Espace Client</h1>
                <p class="text-gray-600 text-lg">Accédez à votre espace personnel DJOK PRESTIGE</p>
            </div>

            <!-- Navigation des Tabs -->
            <div class="flex border-b border-gray-200 mb-8">
                <button @click="activeTab = 'login'"
                    :class="activeTab === 'login' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex-1 py-4 text-center border-b-2 font-medium text-lg tab-transition">
                    Connexion
                </button>
                <button @click="activeTab = 'register'"
                    :class="activeTab === 'register' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="flex-1 py-4 text-center border-b-2 font-medium text-lg tab-transition">
                    Inscription
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
                        <x-input-label for="email" value="Adresse email" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input"
                            placeholder="votre@email.com" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <x-input-label for="password" value="Mot de passe" />
                        <x-text-input id="password" type="password" name="password"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent form-input"
                            required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me + Mot de passe oublié -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="block">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-5 h-5">
                                <span class="ms-2 text-sm text-gray-600 font-medium">Se souvenir de moi</span>
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-blue-600 hover:text-blue-800 underline font-medium">
                            Mot de passe oublié ?
                        </a>
                        @endif
                    </div>

                    <!-- Bouton -->
                    <div class="mt-6">
                        <x-primary-button
                            class="w-full justify-center py-4 text-lg font-semibold bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            Se connecter
                        </x-primary-button>
                    </div>
                </form>

                <!-- Avantages rapides -->
                <div class="mt-8 p-6 bg-blue-50 rounded-xl border border-blue-200 text-sm">
                    <div class="flex items-center text-blue-800 mb-3">
                        <span class="font-medium">Accès immédiat après connexion</span>
                    </div>
                    <div class="flex items-center text-blue-800">
                        <span class="font-medium">Espace sécurisé et privé</span>
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
                            <x-input-label for="name" value="Nom complet *" />
                            <x-text-input id="name" type="text" name="name" :value="old('name')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                placeholder="Votre nom complet" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="email" value="Email *" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                            placeholder="votre@email.com" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" value="Téléphone" />
                        <x-text-input id="phone" type="tel" name="phone" :value="old('phone')"
                            class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                            placeholder="+221 XX XXX XX XX" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="password" value="Mot de passe *" />
                            <x-text-input id="password" type="password" name="password"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password_confirmation" value="Confirmation *" />
                            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Champs optionnels supplémentaires -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="address" value="Adresse" />
                            <x-text-input id="address" type="text" name="address" :value="old('address')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                placeholder="Votre adresse" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" value="Ville" />
                            <x-text-input id="city" type="text" name="city" :value="old('city')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                placeholder="Votre ville" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="country" value="Pays" />
                            <x-text-input id="country" type="text" name="country" :value="old('country')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                placeholder="Votre pays" />
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="birth_date" value="Date de naissance" />
                            <x-text-input id="birth_date" type="date" name="birth_date" :value="old('birth_date')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input" />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="cni_number" value="Numéro CNI" />
                            <x-text-input id="cni_number" type="text" name="cni_number" :value="old('cni_number')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                placeholder="Numéro de carte d'identité" />
                            <x-input-error :messages="$errors->get('cni_number')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="driver_license" value="Permis de conduire" />
                            <x-text-input id="driver_license" type="text" name="driver_license"
                                :value="old('driver_license')"
                                class="block mt-1 w-full text-lg py-4 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent form-input"
                                placeholder="Numéro de permis" />
                            <x-input-error :messages="$errors->get('driver_license')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-start text-sm text-gray-600">
                        <input type="checkbox" id="newsletter" name="newsletter" value="1" {{ old('newsletter')
                            ? 'checked' : '' }} class="rounded text-green-500 focus:ring-green-500 w-5 h-5 mt-0.5">
                        <label for="newsletter" class="ms-3">
                            Je souhaite recevoir la newsletter et les offres spéciales
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('newsletter')" class="mt-2" />

                    <div class="mt-6">
                        <x-primary-button
                            class="w-full justify-center py-4 text-lg font-semibold bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            Créer mon compte
                        </x-primary-button>
                    </div>
                </form>

                <!-- Bénéfices inscription -->
                <div class="mt-8 p-6 bg-green-50 rounded-xl border border-green-200 text-sm">
                    <div class="flex items-center text-green-800 mb-3">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="font-medium">Offre de bienvenue exclusive</span>
                    </div>
                    <div class="flex items-center text-green-800 mb-3">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="font-medium">Accès prioritaire aux nouvelles formations</span>
                    </div>
                    <div class="flex items-center text-green-800">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span class="font-medium">Espace personnel sécurisé</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Image (50%) - DROITE -->
    <div class="hidden lg:block w-1/2 h-full relative animate-fade-in-right">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80"
            alt="Espace Client DJOK PRESTIGE" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 flex items-center justify-center p-12">
            <div class="text-center text-white max-w-2xl">
                <div
                    class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-8 backdrop-blur-sm border border-white/30">
                    <i class="fas fa-rocket text-3xl text-yellow-300 animate-float"></i>
                </div>
                <h2 class="text-5xl font-bold mb-6">Votre Succès<br>Commence Ici</h2>
                <p class="text-xl mb-8 text-gray-200 leading-relaxed">
                    Rejoignez une communauté de professionnels et développez vos compétences
                    avec DJOK PRESTIGE. Accédez à des formations exclusives et boostez votre carrière.
                </p>

                <div class="grid grid-cols-2 gap-6 text-base mb-10">
                    <div class="flex items-center justify-start">
                        <i class="fas fa-graduation-cap mr-3 text-yellow-300"></i>
                        <span class="text-lg">Formations certifiantes</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-headset mr-3 text-yellow-300"></i>
                        <span class="text-lg">Support expert 24/7</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-users mr-3 text-yellow-300"></i>
                        <span class="text-lg">Réseau professionnel</span>
                    </div>
                    <div class="flex items-center justify-start">
                        <i class="fas fa-briefcase mr-3 text-yellow-300"></i>
                        <span class="text-lg">Opportunités business</span>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-8 text-center">
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">5000+</div>
                        <div class="text-gray-300">Membres actifs</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">95%</div>
                        <div class="text-gray-300">Taux de satisfaction</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-yellow-300 mb-2">24/7</div>
                        <div class="text-gray-300">Support disponible</div>
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
