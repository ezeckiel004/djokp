@extends('layouts.base-black')

@section('title', __('reservation-confirmation.title'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- En-tête de confirmation -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="{{ __('reservation-confirmation.icons.check') }} text-green-600 text-2xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('reservation-confirmation.header.title') }}
                </h1>
                <p class="text-gray-600">
                    {{ __('reservation-confirmation.header.subtitle', ['email' => $reservation->email]) }}
                </p>
            </div>

            <!-- Récapitulatif -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    {{ __('reservation-confirmation.summary.title') }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Détails du véhicule -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">
                            {{ __('reservation-confirmation.summary.vehicle_details') }}
                        </h3>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.vehicle') }}</strong>
                            {{ $reservation->vehicle->full_name ?? 'N/A' }}
                        </p>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.category') }}</strong>
                            {{ $reservation->vehicle->category_fr ?? 'N/A' }}
                        </p>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.fuel') }}</strong>
                            {{ $reservation->vehicle->fuel_type_fr ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Détails de la location -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">
                            {{ __('reservation-confirmation.summary.rental_details') }}
                        </h3>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.reference') }}</strong>
                            {{ $reservation->reference }}
                        </p>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.period') }}</strong>
                            {{ __('reservation-confirmation.summary.period_from_to', [
                            'date_debut' =>
                            \Carbon\Carbon::parse($reservation->date_debut)->format(__('reservation-confirmation.dates.format')),
                            'date_fin' =>
                            \Carbon\Carbon::parse($reservation->date_fin)->format(__('reservation-confirmation.dates.format'))
                            ]) }}
                        </p>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.duration') }}</strong>
                            {{
                            \Carbon\Carbon::parse($reservation->date_debut)->diffInDays(\Carbon\Carbon::parse($reservation->date_fin))
                            + 1 }}
                            {{ __('reservation-confirmation.summary.days') }}
                        </p>
                        <p class="text-gray-900">
                            <strong>{{ __('reservation-confirmation.summary.estimated_amount') }}</strong>
                            {{ number_format($reservation->montant_total, 2, ',', ' ') }} €
                            {{ __('reservation-confirmation.summary.vat_included') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Prochaines étapes -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-yellow-900 mb-3">
                    {{ __('reservation-confirmation.next_steps.title') }}
                </h3>
                <ol class="space-y-3">
                    @foreach(__('reservation-confirmation.next_steps.steps') as $step)
                    <li class="flex items-start">
                        <span
                            class="flex items-center justify-center w-6 h-6 bg-yellow-600 text-white rounded-full text-sm mr-3 flex-shrink-0">
                            {{ $step['number'] }}
                        </span>
                        <span>
                            @if($step['number'] == '3')
                            {{ str_replace(':telephone', '<strong>' . $reservation->telephone . '</strong>',
                            $step['text']) }}
                            @else
                            {{ $step['text'] }}
                            @endif
                        </span>
                    </li>
                    @endforeach
                </ol>
            </div>

            <!-- Messages supplémentaires -->
            <div class="mb-6 space-y-3">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="{{ __('reservation-confirmation.icons.shield') }} text-blue-600 mr-3"></i>
                        <p class="text-blue-800">
                            {{ __('reservation-confirmation.messages.save_reference') }}
                        </p>
                    </div>
                </div>

                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="{{ __('reservation-confirmation.icons.clock') }} text-green-600 mr-3"></i>
                        <p class="text-green-800">
                            {{ __('reservation-confirmation.messages.processing') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('location') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300">
                    <i class="{{ __('reservation-confirmation.icons.car') }} mr-2"></i>
                    {{ __('reservation-confirmation.actions.view_vehicles') }}
                </a>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                    <i class="{{ __('reservation-confirmation.icons.home') }} mr-2"></i>
                    {{ __('reservation-confirmation.actions.go_home') }}
                </a>
            </div>

            <!-- Pied de page -->
            <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-500">
                <p class="mb-2">
                    <strong>{{ __('reservation-confirmation.footer.title') }}</strong>
                </p>
                <p>
                    {{ __('reservation-confirmation.footer.contact_phone', ['phone' => '01 76 38 00 17']) }}
                    {{ __('reservation-confirmation.footer.contact_email', ['email' => 'location@djokprestige.com']) }}
                </p>
                <p class="mt-2">
                    {{ __('reservation-confirmation.footer.reference_note') }}
                    <code class="bg-gray-100 px-2 py-1 rounded">{{ $reservation->reference }}</code>
                </p>
            </div>

            <!-- Message de remerciement -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 italic">
                    <i class="{{ __('reservation-confirmation.icons.info') }} text-yellow-600 mr-2"></i>
                    {{ __('reservation-confirmation.messages.thank_you') }}
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Script pour l'animation -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des étapes
        const steps = document.querySelectorAll('ol li');
        steps.forEach((step, index) => {
            step.style.opacity = '0';
            step.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                step.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                step.style.opacity = '1';
                step.style.transform = 'translateX(0)';
            }, 300 * (index + 1));
        });

        // Animation du check
        const checkIcon = document.querySelector('.fa-check');
        if (checkIcon) {
            checkIcon.style.transform = 'scale(0)';
            setTimeout(() => {
                checkIcon.style.transition = 'transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                checkIcon.style.transform = 'scale(1) rotate(360deg)';
            }, 500);
        }

        // Effet de confetti léger
        const createConfetti = () => {
            const colors = ['#10B981', '#F59E0B', '#3B82F6', '#8B5CF6'];
            const container = document.querySelector('.bg-white');
            
            for (let i = 0; i < 15; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti absolute';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.top = '-20px';
                confetti.style.width = '6px';
                confetti.style.height = '6px';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.borderRadius = '50%';
                confetti.style.opacity = '0.7';
                confetti.style.animation = `confettiFall ${Math.random() * 2 + 2}s ease-in forwards`;
                confetti.style.animationDelay = Math.random() + 's';
                
                container.appendChild(confetti);
            }
        };

        // Ajouter le style CSS pour l'animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes confettiFall {
                0% {
                    opacity: 0;
                    transform: translateY(-20px) rotate(0deg);
                }
                10% {
                    opacity: 0.7;
                }
                100% {
                    opacity: 0;
                    transform: translateY(400px) rotate(720deg);
                }
            }
            
            .confetti {
                pointer-events: none;
                z-index: 1;
            }
        `;
        document.head.appendChild(style);

        // Lancer le confetti après un délai
        setTimeout(createConfetti, 800);
    });
</script>
@endpush

<style>
    .bg-white {
        position: relative;
        overflow: hidden;
    }

    .bg-gray-50 {
        transition: transform 0.3s ease;
    }

    .bg-gray-50:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 640px) {
        .grid {
            gap: 1rem;
        }

        .p-8 {
            padding: 1.5rem;
        }
    }
</style>
@endsection