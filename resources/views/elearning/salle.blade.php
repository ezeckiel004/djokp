@extends('layouts.main')

@section('title', 'Connexion salle virtuelle - DJOK PRESTIGE')

@section('content')
<!-- Hero Section -->
<div class="py-12" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-2xl mx-auto text-center">
            <img src="{{ asset('DP2.webp') }}" alt="DJOK PRESTIGE" class="h-20 mx-auto mb-6">
            <h1 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Salle virtuelle e-learning</h1>
            <p class="text-gray-400">
                Connectez-vous avec votre code d'accès reçu par email
            </p>
        </div>
    </div>
</div>

<!-- Login Section -->
<div class="py-16" style="background: #111;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-md mx-auto">
            @if(session('error'))
            <div class="mb-6 p-4 rounded" style="background: #2a0f0f; border: 1px solid #7f1d1d;">
                <div class="flex items-center">
                    <i class="mr-3 fas fa-exclamation-circle" style="color: #f56565;"></i>
                    <p class="text-red-100">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-4 rounded" style="background: #064e3b; border: 1px solid #047857;">
                <div class="flex items-center">
                    <i class="mr-3 fas fa-check-circle" style="color: #a7f3d0;"></i>
                    <p class="text-green-100">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            <div class="p-6 rounded-lg" style="background: #1a1a1a; border: 1px solid #333;">
                <h2 class="mb-6 text-lg font-bold text-white md:text-xl">Connexion</h2>

                <form class="space-y-6" action="{{ route('elearning.login') }}" method="POST">
                    @csrf

                    <div>
                        <label for="access_code" class="block mb-2 text-sm font-medium" style="color: #ddd;">
                            Code d'accès
                        </label>
                        <input id="access_code" name="access_code" type="text" required
                            class="w-full px-4 py-2 {{ $errors->has('access_code') ? 'border-red-500' : 'border-gray-600' }}"
                            style="background: #111; border: 1px solid #444; color: white;"
                            placeholder="Ex: ABC123DEF4">
                        @error('access_code')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Code à 10 caractères reçu par email</p>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium" style="color: #ddd;">
                            Email
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="w-full px-4 py-2 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-600' }}"
                            style="background: #111; border: 1px solid #444; color: white;"
                            placeholder="votre@email.com">
                        @error('email')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full py-2 font-medium transition-all duration-300 flex items-center justify-center"
                            style="background: #b89449; color: black;">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Se connecter
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-700">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-exclamation-triangle" style="color: #b89449;"></i>
                            <p class="text-sm text-gray-400">
                                <strong>Attention :</strong> Une seule connexion active à la fois par code d'accès.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-envelope" style="color: #b89449;"></i>
                            <p class="text-sm text-gray-400">
                                Vous avez perdu votre code ? Contactez-nous à
                                <a href="mailto:support@djokprestige.com"
                                    class="font-semibold text-white hover:underline">support@djokprestige.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('elearning.index') }}" class="text-gray-400 hover:text-white">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Retour aux forfaits e-learning
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
