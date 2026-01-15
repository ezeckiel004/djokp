@extends('layouts.main')

@section('title', __('reservation-success.title'))

@section('content')
<!-- Header Hero Section -->
<header class="flex flex-col min-h-[60vh] reservation-hero-bg">
    @include('layouts.navbar')

    <!-- Hero Content -->
    <div class="flex flex-col items-center justify-center flex-1 px-4 text-center text-white">
        <div class="mb-6 text-6xl">{{ __('reservation-success.hero.emoji') }}</div>
        <h1 class="mb-6 text-5xl font-bold md:text-6xl">{{ __('reservation-success.hero.title') }}</h1>
        <p class="max-w-3xl mb-8 text-xl md:text-2xl">
            {{ __('reservation-success.hero.subtitle') }}
        </p>
    </div>
</header>

<!-- Success Message Section -->
<section class="py-16 bg-white">
    <div class="px-4 mx-auto max-w-4xl">
        <!-- Main Success Card -->
        <div class="p-8 text-center bg-green-50 rounded-2xl">
            <div class="flex items-center justify-center w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full">
                <i class="text-3xl text-green-600 fas fa-check-circle"></i>
            </div>

            <h2 class="mb-4 text-3xl font-bold text-gray-900">{{ __('reservation-success.success_message.title') }}</h2>

            <div class="p-6 mb-6 text-left bg-white rounded-lg">
                @foreach (__('reservation-success.success_message.items') as $item)
                <p class="{{ !$loop->last ? 'mb-4' : '' }} text-lg text-gray-700">
                    {{ $item }}
                </p>
                @endforeach
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col gap-4 mb-8 sm:flex-row sm:justify-center">
                <a href="{{ url('/') }}"
                    class="px-8 py-3 text-white transition duration-300 bg-yellow-600 rounded-lg hover:bg-yellow-700">
                    <i class="mr-2 {{ __('reservation-success.actions.back_to_home.icon') }}"></i>
                    {{ __('reservation-success.actions.back_to_home.text') }}
                </a>

                @guest
                <a href="{{ route('register') }}"
                    class="px-8 py-3 text-gray-700 transition duration-300 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 {{ __('reservation-success.actions.create_account.icon') }}"></i>
                    {{ __('reservation-success.actions.create_account.text') }}
                </a>
                @else
                <a href="{{ route('user.reservations.index') }}"
                    class="px-8 py-3 text-gray-700 transition duration-300 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 {{ __('reservation-success.actions.my_reservations.icon') }}"></i>
                    {{ __('reservation-success.actions.my_reservations.text') }}
                </a>
                @endguest
            </div>
        </div>

        <!-- Next Steps -->
        @if(isset(__('reservation-success.next_steps')))
        <div class="mt-12">
            <h3 class="mb-8 text-2xl font-bold text-center text-gray-900">
                {{ __('reservation-success.next_steps.title') }}
            </h3>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                @foreach (__('reservation-success.next_steps.steps') as $step)
                <div class="p-6 text-center rounded-lg bg-gray-50">
                    <div
                        class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-{{ $step['color'] }}-100 rounded-full">
                        <i class="text-xl text-{{ $step['color'] }}-600 {{ $step['icon'] }}"></i>
                    </div>
                    <h4 class="mb-2 text-lg font-semibold text-gray-800">{{ $step['title'] }}</h4>
                    <p class="text-gray-600">{{ $step['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Contact Information -->
        @if(isset(__('reservation-success.contact_info')))
        <div class="mt-12">
            <div class="p-8 text-center rounded-lg bg-blue-50">
                <h3 class="mb-3 text-2xl font-bold text-gray-900">
                    {{ __('reservation-success.contact_info.title') }}
                </h3>
                <p class="mb-8 text-gray-700">
                    {{ __('reservation-success.contact_info.description') }}
                </p>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    @foreach (__('reservation-success.contact_info.items') as $item)
                    <div class="p-6 text-center bg-white rounded-lg">
                        <div
                            class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-{{ $item['color'] }}-100 rounded-full">
                            <i class="text-xl text-{{ $item['color'] }}-600 {{ $item['icon'] }}"></i>
                        </div>
                        <h4 class="mb-2 font-semibold text-gray-800">{{ $item['title'] }}</h4>
                        <p class="text-gray-600">{{ $item['content'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Reservation Summary (Optional - if you have reservation data) -->
        @if(isset($reservation))
        <div class="p-6 mt-8 border border-gray-200 rounded-lg">
            <h3 class="mb-4 text-xl font-bold text-gray-900">Détails de votre réservation</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <p class="text-gray-600"><strong>Référence :</strong> {{ $reservation->reference }}</p>
                    <p class="text-gray-600"><strong>Date :</strong> {{ $reservation->date->format('d/m/Y') }}</p>
                    <p class="text-gray-600"><strong>Heure :</strong> {{ $reservation->time }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><strong>Service :</strong> {{ $reservation->service->name }}</p>
                    <p class="text-gray-600"><strong>Statut :</strong> En attente de confirmation</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Social Sharing (Optional) -->
        <div class="p-6 mt-8 text-center rounded-lg bg-gray-50">
            <h4 class="mb-4 text-lg font-semibold text-gray-800">Partagez votre expérience</h4>
            <div class="flex justify-center space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                    class="px-4 py-2 text-white transition duration-300 bg-blue-600 rounded-lg hover:bg-blue-700">
                    <i class="mr-2 fab fa-facebook-f"></i> Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?text=Je viens de réserver sur DJOK PRESTIGE !&url={{ urlencode(url()->current()) }}"
                    target="_blank"
                    class="px-4 py-2 text-white transition duration-300 bg-blue-400 rounded-lg hover:bg-blue-500">
                    <i class="mr-2 fab fa-twitter"></i> Twitter
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                    target="_blank"
                    class="px-4 py-2 text-white transition duration-300 bg-blue-800 rounded-lg hover:bg-blue-900">
                    <i class="mr-2 fab fa-linkedin-in"></i> LinkedIn
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

<!-- Style pour l'arrière-plan hero -->
<style>
    .reservation-hero-bg {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
            url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
    }

    @media (max-width: 768px) {
        .reservation-hero-bg {
            min-height: 50vh;
        }

        h1 {
            font-size: 2.5rem;
        }

        p {
            font-size: 1.125rem;
        }
    }
</style>

<!-- Script pour les animations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée des éléments
        const elements = document.querySelectorAll('.rounded-2xl, .rounded-lg');
        elements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';

            setTimeout(() => {
                element.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, 100 * index);
        });

        // Animation du checkmark
        const checkmark = document.querySelector('.fa-check-circle');
        if (checkmark) {
            setTimeout(() => {
                checkmark.classList.add('animate-pulse');
            }, 500);
        }

        // Confetti animation (simple version)
        function createConfetti() {
            const colors = ['#fbbf24', '#10b981', '#3b82f6', '#8b5cf6'];
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.position = 'fixed';
                confetti.style.width = '10px';
                confetti.style.height = '10px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.borderRadius = '50%';
                confetti.style.top = '0';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.zIndex = '9999';
                confetti.style.pointerEvents = 'none';

                document.body.appendChild(confetti);

                // Animation
                confetti.animate([
                    { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
                    { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
                ], {
                    duration: 2000 + Math.random() * 2000,
                    easing: 'cubic-bezier(0.215, 0.61, 0.355, 1)'
                });

                // Remove after animation
                setTimeout(() => confetti.remove(), 4000);
            }
        }

        // Lance les confettis après le chargement de la page
        setTimeout(createConfetti, 1000);
    });
</script>
