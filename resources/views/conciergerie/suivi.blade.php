@extends('layouts.main')

@section('title', __('conciergerie-suivi.title', ['reference' => $demande->reference]))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- En-tête -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ __('conciergerie-suivi.page_title') }}
                </h1>
                <p class="text-gray-600">
                    {{ __('conciergerie-suivi.reference') }} : <strong>{{ $demande->reference }}</strong>
                </p>
            </div>

            <!-- Statut -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900 mb-2">
                            {{ __('conciergerie-suivi.statut.title') }}
                        </h2>
                        <div class="flex flex-wrap items-center gap-3">
                            @php
                            $statutColors = [
                            'nouvelle' => 'bg-yellow-500',
                            'devis_envoye' => 'bg-blue-500',
                            'confirme' => 'bg-green-500',
                            'annule' => 'bg-gray-500',
                            ];
                            $statutColor = $statutColors[$demande->statut] ?? 'bg-gray-500';
                            @endphp
                            <span class="px-4 py-2 rounded-full text-white font-semibold {{ $statutColor }}">
                                {{ __('conciergerie-suivi.statut.labels.' . $demande->statut) }}
                            </span>
                            <span class="text-gray-600">
                                {{ __('conciergerie-suivi.statut.created_at') }} {{ $demande->created_at->format('d/m/Y
                                à H:i') }}
                            </span>
                        </div>
                    </div>

                    @if($demande->montant_devis)
                    <div class="text-center md:text-right">
                        <div class="text-3xl font-bold text-yellow-600">
                            {{ $demande->montant_formate }}
                        </div>
                        <div class="text-gray-600">
                            {{ __('conciergerie-suivi.devis.envoye_le') }} {{ $demande->date_devis->format('d/m/Y') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations et détails -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Informations personnelles -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        {{ __('conciergerie-suivi.informations_personnelles.title') }}
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.informations_personnelles.nom') }}
                                :</span>
                            <span class="font-medium">{{ $demande->nom_complet }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.informations_personnelles.email') }}
                                :</span>
                            <span class="font-medium">{{ $demande->email }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.informations_personnelles.telephone')
                                }} :</span>
                            <span class="font-medium">{{ $demande->telephone }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.informations_personnelles.motif') }}
                                :</span>
                            <span class="font-medium">
                                {{ __('conciergerie-suivi.informations_personnelles.motif_labels.' . $demande->motif) }}
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Détails du séjour -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">
                        {{ __('conciergerie-suivi.details_sejour.title') }}
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.details_sejour.date_arrivee') }}
                                :</span>
                            <span class="font-medium">{{ $demande->date_arrivee->format('d/m/Y') }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.details_sejour.duree') }} :</span>
                            <span class="font-medium">{{ $demande->duree_sejour }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.details_sejour.personnes') }} :</span>
                            <span class="font-medium">{{ $demande->nombre_personnes }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">{{ __('conciergerie-suivi.details_sejour.accompagnement') }}
                                :</span>
                            <span class="font-medium">
                                {{ __('conciergerie-suivi.details_sejour.accompagnement_labels.' .
                                $demande->accompagnement) }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Services demandés -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    {{ __('conciergerie-suivi.services_demandes.title') }}
                </h3>
                <div class="flex flex-wrap gap-3">
                    @if($demande->services && count($demande->services) > 0)
                    @foreach($demande->services as $service)
                    @php
                    $serviceKey = str_replace(' ', '_', strtolower($service));
                    $serviceLabel = __('conciergerie-suivi.services_demandes.services_list.' . $serviceKey, [],
                    app()->getLocale());
                    $displayLabel = $serviceLabel !== 'conciergerie-suivi.services_demandes.services_list.' .
                    $serviceKey ? $serviceLabel : $service;
                    @endphp
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-medium">
                        {{ $displayLabel }}
                    </span>
                    @endforeach
                    @else
                    <p class="text-gray-600">{{ __('conciergerie-suivi.services_demandes.aucun_service') }}</p>
                    @endif
                </div>
            </div>

            <!-- Message -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    {{ __('conciergerie-suivi.message.title') }}
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 whitespace-pre-line">{{ $demande->message }}</p>
                </div>
            </div>

            <!-- Timeline (optionnel) -->
            @if(isset($timeline) && count($timeline) > 0)
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">
                    {{ __('conciergerie-suivi.timeline.title') }}
                </h3>
                <div class="space-y-6">
                    @foreach($timeline as $event)
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <i class="text-blue-600 {{ $event['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <h4 class="font-semibold text-gray-900">{{ $event['title'] }}</h4>
                                <span class="text-sm text-gray-500">{{ $event['date'] }}</span>
                            </div>
                            <p class="text-gray-600 mt-1">{{ $event['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                <div class="flex flex-wrap gap-4">
                    @if($demande->montant_devis && $demande->statut == 'devis_envoye')
                    <a href="{{ route('conciergerie.download-devis', $demande->id) }}"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-download mr-2"></i>
                        {{ __('conciergerie-suivi.actions.telecharger_devis') }}
                    </a>

                    <form action="{{ route('conciergerie.confirm', $demande->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                            <i class="fas fa-check mr-2"></i>
                            {{ __('conciergerie-suivi.actions.confirmer_demande') }}
                        </button>
                    </form>
                    @endif

                    @if($demande->statut == 'nouvelle')
                    <form action="{{ route('conciergerie.cancel', $demande->id) }}" method="POST"
                        onsubmit="return confirm('{{ __('conciergerie-suivi.validation.annulation_confirm') }}')"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-300">
                            <i class="fas fa-times mr-2"></i>
                            {{ __('conciergerie-suivi.actions.annuler_demande') }}
                        </button>
                    </form>

                    <a href="{{ route('conciergerie.modify', $demande->id) }}"
                        class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-300">
                        <i class="fas fa-edit mr-2"></i>
                        {{ __('conciergerie-suivi.actions.modifier_demande') }}
                    </a>
                    @endif

                    <a href="{{ url('/') }}"
                        class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition duration-300">
                        <i class="fas fa-home mr-2"></i>
                        {{ __('conciergerie-suivi.actions.retour_accueil') }}
                    </a>
                </div>
            </div>

            <!-- Besoin d'aide -->
            <div class="bg-gray-900 text-white rounded-2xl p-6 md:p-8">
                <h3 class="text-xl font-bold mb-6 text-center">
                    {{ __('conciergerie-suivi.besoin_aide.title') }}
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                            <i
                                class="{{ __('conciergerie-suivi.besoin_aide.icons.telephone') }} text-white text-xl"></i>
                        </div>
                        <p class="font-semibold mb-2">{{ __('conciergerie-suivi.besoin_aide.telephone.label') }}</p>
                        <a href="tel:{{ __('conciergerie-suivi.besoin_aide.telephone.number') }}"
                            class="text-yellow-400 hover:text-yellow-300">
                            {{ __('conciergerie-suivi.besoin_aide.telephone.number') }}
                        </a>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                            <i class="{{ __('conciergerie-suivi.besoin_aide.icons.email') }} text-white text-xl"></i>
                        </div>
                        <p class="font-semibold mb-2">{{ __('conciergerie-suivi.besoin_aide.email.label') }}</p>
                        <a href="mailto:{{ __('conciergerie-suivi.besoin_aide.email.address') }}"
                            class="text-yellow-400 hover:text-yellow-300">
                            {{ __('conciergerie-suivi.besoin_aide.email.address') }}
                        </a>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                            <i class="{{ __('conciergerie-suivi.besoin_aide.icons.horaires') }} text-white text-xl"></i>
                        </div>
                        <p class="font-semibold mb-2">{{ __('conciergerie-suivi.besoin_aide.horaires.label') }}</p>
                        <p class="text-yellow-400">{{ __('conciergerie-suivi.besoin_aide.horaires.value') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style supplémentaire -->
<style>
    @media (max-width: 768px) {
        .rounded-2xl {
            border-radius: 1rem;
        }

        .gap-8 {
            gap: 1.5rem;
        }
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation d'entrée
        const cards = document.querySelectorAll('.bg-white');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });

        // Messages flash
        @if(session('success'))
        const successMessage = "{{ session('success') }}";
        showNotification(successMessage, 'success');
        @endif

        @if(session('error'))
        const errorMessage = "{{ session('error') }}";
        showNotification(errorMessage, 'error');
        @endif

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
                'bg-red-100 text-red-800 border border-red-200'
            }`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        }

        // Boutons de confirmation
        const confirmButtons = document.querySelectorAll('form[onsubmit*="confirm"]');
        confirmButtons.forEach(button => {
            button.addEventListener('submit', function(e) {
                if (!confirm(this.getAttribute('data-confirm') || '{{ __("conciergerie-suivi.validation.annulation_confirm") }}')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
