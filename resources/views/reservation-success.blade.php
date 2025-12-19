@extends('layouts.main')

@section('title', 'Réservation réussie - DJOK PRESTIGE')

@section('content')
<!-- Header Hero Section -->
<header class="flex flex-col min-h-[60vh] reservation-hero-bg">
    @include('layouts.navbar')

    <!-- Hero Content -->
    <div class="flex flex-col items-center justify-center flex-1 px-4 text-center text-white">
        <div class="mb-6 text-6xl">🎉</div>
        <h1 class="mb-6 text-5xl font-bold md:text-6xl">Réservation réussie !</h1>
        <p class="max-w-3xl mb-8 text-xl md:text-2xl">
            Votre réservation a bien été enregistrée
        </p>
    </div>
</header>

<!-- Success Message Section -->
<section class="py-16 bg-white">
    <div class="px-4 mx-auto max-w-2xl">
        <div class="p-8 text-center bg-green-50 rounded-2xl">
            <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full">
                <i class="text-3xl text-green-600 fas fa-check-circle"></i>
            </div>

            <h2 class="mb-4 text-3xl font-bold text-gray-900">Merci pour votre réservation !</h2>

            <div class="p-6 mb-6 text-left bg-white rounded-lg">
                <p class="mb-4 text-lg text-gray-700">
                    ✅ Votre réservation a bien été enregistrée et est en attente de confirmation.
                </p>
                <p class="mb-4 text-lg text-gray-700">
                    📧 Vous allez recevoir un email de confirmation dans quelques minutes.
                </p>
                <p class="text-lg text-gray-700">
                    ⏱️ Notre équipe traitera votre demande sous 24 heures maximum.
                </p>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:justify-center">
                <a href="{{ url('/') }}"
                    class="px-8 py-3 text-white transition duration-300 bg-yellow-600 rounded-lg hover:bg-yellow-700">
                    <i class="mr-2 fas fa-home"></i>Retour à l'accueil
                </a>

                @guest
                <a href="{{ route('register') }}"
                    class="px-8 py-3 text-gray-700 transition duration-300 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 fas fa-user-plus"></i>Créer un compte
                </a>
                @else
                <a href="{{ route('user.reservations.index') }}"
                    class="px-8 py-3 text-gray-700 transition duration-300 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 fas fa-list"></i>Mes réservations
                </a>
                @endguest
            </div>
        </div>
    </div>
</section>
@endsection
