@extends('layouts.main')

@section('title', __('payment-success.title'))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
            <!-- Carte de confirmation -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- En-tête succès -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                        <i class="{{ __('payment-success.icons.success') }} text-green-600 text-4xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                        {{ __('payment-success.header.title') }}
                    </h1>
                    <p class="text-green-100">
                        {{ __('payment-success.header.subtitle') }}
                    </p>
                </div>

                <div class="p-8">
                    <!-- Récapitulatif -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            {{ __('payment-success.summary.title') }}
                        </h2>

                        <div class="space-y-6">
                            <!-- Formation -->
                            <div class="p-6 bg-gray-50 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-3">{{ __('payment-success.summary.formation') }}:
                                    {{ $formation->title }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <span class="font-medium">{{ __('payment-success.summary.reference') }}</span>
                                        <span class="ml-2">{{ $paiement->reference }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">{{ __('payment-success.summary.date') }}</span>
                                        <span class="ml-2">{{ $paiement->paid_at->format('d/m/Y à H:i') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">{{ __('payment-success.summary.amount') }}</span>
                                        <span class="ml-2 font-bold text-green-600">
                                            {{ number_format($paiement->amount, 0, ',', ' ') }} €
                                        </span>
                                    </div>
                                    <div>
                                        <span class="font-medium">{{ __('payment-success.summary.status') }}</span>
                                        <span class="ml-2">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                {{ __('payment-success.summary.paid') }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Accès -->
                            <div class="p-6 bg-blue-50 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-3">
                                    {{ __('payment-success.access.title') }}
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="{{ __('payment-success.icons.laptop') }} text-blue-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">{{ __('payment-success.access.platform.title') }}</p>
                                            <p class="text-sm text-gray-600">{{
                                                __('payment-success.access.platform.description') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="{{ __('payment-success.icons.calendar') }} text-blue-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">{{ __('payment-success.access.duration.title') }}</p>
                                            <p class="text-sm text-gray-600">{{
                                                __('payment-success.access.duration.description') }}</p>
                                        </div>
                                    </div>
                                    @if(auth()->check())
                                    <div class="mt-4">
                                        <a href="{{ route('dashboard') }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
                                            <i class="{{ __('payment-success.icons.dashboard') }} mr-2"></i>
                                            {{ __('payment-success.access.dashboard_button') }}
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Prochaines étapes -->
                            <div class="p-6 bg-yellow-50 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-3">
                                    {{ __('payment-success.next_steps.title') }}
                                </h3>
                                <div class="space-y-4">
                                    @foreach(__('payment-success.next_steps.steps') as $key => $step)
                                    <div class="flex items-start">
                                        <div
                                            class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <span class="text-yellow-800 font-bold">
                                                {{ __('payment-success.icons.step_number.' . $loop->index) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $step['title'] }}</p>
                                            <p class="text-sm text-gray-600">{{ $step['description'] }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Facture -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            {{ __('payment-success.invoice.title') }}
                        </h3>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-700">{{ __('payment-success.invoice.description') }}</p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ str_replace(':reference', $paiement->reference,
                                        __('payment-success.invoice.reference_note')) }}
                                    </p>
                                </div>
                                <div>
                                    <span class="px-3 py-1 bg-gray-200 text-gray-800 text-sm font-medium rounded-full">
                                        {{ __('payment-success.invoice.availability') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('formation') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300">
                            <i class="{{ __('payment-success.icons.graduation') }} mr-2"></i>
                            {{ __('payment-success.actions.discover') }}
                        </a>
                        @if(auth()->check())
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                            <i class="{{ __('payment-success.icons.dashboard') }} mr-2"></i>
                            {{ __('payment-success.actions.dashboard') }}
                        </a>
                        @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                            <i class="{{ __('payment-success.icons.login') }} mr-2"></i>
                            {{ __('payment-success.actions.login') }}
                        </a>
                        @endif
                    </div>

                    <!-- Assistance -->
                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-gray-600 mb-3">{{ __('payment-success.assistance.title') }}</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <div class="flex items-center text-gray-700">
                                <i class="{{ __('payment-success.icons.phone') }} text-yellow-600 mr-2"></i>
                                <span>{{ __('payment-success.assistance.phone') }}</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="{{ __('payment-success.icons.email') }} text-yellow-600 mr-2"></i>
                                <span>{{ __('payment-success.assistance.email') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Messages de statut -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div class="p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-bolt text-green-600 text-xl mb-2"></i>
                                <p class="text-sm text-green-700 font-medium">{{
                                    __('payment-success.status_messages.immediate_access') }}</p>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <i class="fas fa-file-invoice text-blue-600 text-xl mb-2"></i>
                                <p class="text-sm text-blue-700 font-medium">{{
                                    __('payment-success.status_messages.invoice_sent') }}</p>
                            </div>
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <i class="fas fa-handshake text-purple-600 text-xl mb-2"></i>
                                <p class="text-sm text-purple-700 font-medium">{{
                                    __('payment-success.status_messages.welcome') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des étapes
        const steps = document.querySelectorAll('.flex.items-start');
        steps.forEach((step, index) => {
            step.style.opacity = '0';
            step.style.transform = 'translateX(-20px)';

            setTimeout(() => {
                step.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                step.style.opacity = '1';
                step.style.transform = 'translateX(0)';
            }, 300 * (index + 1));
        });

        // Confetti animation (si paiement réussi)
        setTimeout(() => {
            const confettiCount = 100;
            const container = document.querySelector('.bg-gradient-to-r');

            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti absolute';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = Math.random() * 100 + '%';
                confetti.style.width = '8px';
                confetti.style.height = '8px';
                confetti.style.backgroundColor = ['#10B981', '#34D399', '#6EE7B7', '#A7F3D0'][Math.floor(Math.random() * 4)];
                confetti.style.borderRadius = '50%';
                confetti.style.opacity = '0';
                confetti.style.animation = 'confettiFall 3s ease-in-out forwards';
                confetti.style.animationDelay = Math.random() * 2 + 's';

                container.appendChild(confetti);
            }
        }, 500);
    });

    // Style pour l'animation confetti
    const style = document.createElement('style');
    style.textContent = `
        @keyframes confettiFall {
            0% {
                opacity: 0;
                transform: translateY(-100px) rotate(0deg);
            }
            10% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: translateY(500px) rotate(720deg);
            }
        }

        .confetti {
            pointer-events: none;
            z-index: 10;
        }
    `;
    document.head.appendChild(style);
</script>
@endpush

<style>
    .bg-gradient-to-r {
        position: relative;
        overflow: hidden;
    }

    .p-6 {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .p-6:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection
