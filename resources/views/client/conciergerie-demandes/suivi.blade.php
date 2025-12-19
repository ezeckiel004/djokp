{{-- resources/views/conciergerie/suivi.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi demande {{ $demande->reference }} - DJOK PRESTIGE</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bg-djok-yellow {
            background-color: #F8B400;
        }

        .text-djok-yellow {
            color: #F8B400;
        }

        .hover\:bg-yellow-700:hover {
            background-color: #e69c00;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">
                            DJOK PRESTIGE
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('conciergerie') }}"
                            class="text-gray-600 hover:text-djok-yellow transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Retour à la conciergerie
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">Suivi de votre demande</h1>
                    <p class="text-gray-600">Suivez l'avancement de votre demande de conciergerie</p>
                </div>

                <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
                    <!-- En-tête avec référence -->
                    <div class="bg-gradient-to-r from-djok-yellow to-yellow-500 p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-white">Référence : {{ $demande->reference }}</h2>
                                <p class="text-yellow-100 mt-1">
                                    Créée le {{ $demande->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                            <div class="mt-4 md:mt-0">
                                @php
                                $statusColors = [
                                'nouvelle' => 'bg-blue-100 text-blue-800',
                                'en_cours' => 'bg-yellow-100 text-yellow-800',
                                'devis_envoye' => 'bg-purple-100 text-purple-800',
                                'confirme' => 'bg-green-100 text-green-800',
                                'annule' => 'bg-red-100 text-red-800',
                                'termine' => 'bg-gray-100 text-gray-800',
                                ];
                                $colorClass = $statusColors[$demande->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span
                                    class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $colorClass }} bg-white">
                                    <i class="fas fa-circle text-xs mr-2"></i>
                                    {{ $demande->getStatutLabelAttribute() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Informations principales -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="fas fa-user-circle text-djok-yellow mr-2"></i>
                                    Informations client
                                </h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500">Nom</p>
                                        <p class="font-medium">{{ $demande->nom_complet }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email</p>
                                        <p class="font-medium">{{ $demande->email }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Téléphone</p>
                                        <p class="font-medium">{{ $demande->telephone }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="fas fa-plane text-djok-yellow mr-2"></i>
                                    Informations séjour
                                </h3>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm text-gray-500">Motif</p>
                                        <p class="font-medium">{{ $demande->getMotifLabelAttribute() }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Date d'arrivée</p>
                                        <p class="font-medium">
                                            {{ $demande->date_arrivee ? $demande->date_arrivee->format('d/m/Y') : 'Non
                                            précisée' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Durée</p>
                                        <p class="font-medium">{{ $demande->duree_sejour }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline du statut -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-6">
                                <i class="fas fa-history text-djok-yellow mr-2"></i>
                                Progression de votre demande
                            </h3>

                            <div class="space-y-6">
                                @php
                                $statuts = [
                                'nouvelle' => ['icon' => 'fa-plus-circle', 'color' => 'text-blue-500', 'label' =>
                                'Demande créée'],
                                'en_cours' => ['icon' => 'fa-spinner', 'color' => 'text-yellow-500', 'label' => 'En
                                traitement'],
                                'devis_envoye' => ['icon' => 'fa-file-invoice', 'color' => 'text-purple-500', 'label' =>
                                'Devis envoyé'],
                                'confirme' => ['icon' => 'fa-check-circle', 'color' => 'text-green-500', 'label' =>
                                'Devis confirmé'],
                                'annule' => ['icon' => 'fa-times-circle', 'color' => 'text-red-500', 'label' => 'Demande
                                annulée'],
                                'termine' => ['icon' => 'fa-flag-checkered', 'color' => 'text-gray-500', 'label' =>
                                'Service terminé'],
                                ];

                                $currentStatut = $demande->statut;
                                $statutKeys = array_keys($statuts);
                                $currentIndex = array_search($currentStatut, $statutKeys);
                                @endphp

                                @foreach($statuts as $key => $info)
                                @php
                                $isActive = array_search($key, $statutKeys) <= $currentIndex;
                                    $isCurrent=$key===$currentStatut; @endphp <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="h-10 w-10 rounded-full flex items-center justify-center
                                            {{ $isActive ? $info['color'] . ' bg-opacity-10 ' . str_replace('text-', 'bg-', $info['color']) : 'text-gray-300 bg-gray-100' }}">
                                            <i class="fas {{ $info['icon'] }}"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center justify-between">
                                            <p
                                                class="text-sm font-medium {{ $isActive ? 'text-gray-900' : 'text-gray-400' }}">
                                                {{ $info['label'] }}
                                            </p>
                                            @if($isCurrent)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-djok-yellow text-white">
                                                Actuel
                                            </span>
                                            @endif
                                        </div>
                                        @if($key === 'nouvelle')
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $demande->created_at->format('d/m/Y H:i') }}
                                        </p>
                                        @elseif($key === $currentStatut && $key !== 'nouvelle')
                                        <p class="text-xs text-gray-500 mt-1">
                                            Dernière mise à jour : {{ $demande->updated_at->format('d/m/Y H:i') }}
                                        </p>
                                        @endif
                                    </div>
                            </div>

                            @if($key !== 'termine')
                            <div
                                class="ml-5 pl-5 border-l-2 {{ $isActive ? 'border-djok-yellow' : 'border-gray-200' }} h-6">
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Devis -->
                    @if($demande->devis_envoye)
                    <div class="mb-8">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-green-900 mb-4">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>
                                Devis envoyé
                            </h4>
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-green-700">Montant</p>
                                    <p class="text-2xl font-bold text-green-900">{{
                                        $demande->getMontantFormateAttribute() }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-green-700">Envoyé le</p>
                                    <p class="font-medium text-green-900">
                                        {{ $demande->date_devis ? $demande->date_devis->format('d/m/Y') : 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-green-700 mt-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Un devis détaillé a été envoyé à votre adresse email.
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations de contact -->
            <div class="bg-gradient-to-r from-gray-900 to-black text-white rounded-xl p-8">
                <h3 class="text-xl font-bold mb-6 text-center">Besoin d'aide ?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div
                            class="h-12 w-12 bg-djok-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-phone-alt text-white text-xl"></i>
                        </div>
                        <p class="font-semibold">Téléphone</p>
                        <a href="tel:0176380017" class="text-djok-yellow hover:text-yellow-300">01 76 38 00 17</a>
                    </div>

                    <div class="text-center">
                        <div
                            class="h-12 w-12 bg-djok-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <p class="font-semibold">Email</p>
                        <a href="mailto:conciergerie@djokprestige.com" class="text-djok-yellow hover:text-yellow-300">
                            conciergerie@djokprestige.com
                        </a>
                    </div>

                    <div class="text-center">
                        <div
                            class="h-12 w-12 bg-djok-yellow rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fab fa-whatsapp text-white text-xl"></i>
                        </div>
                        <p class="font-semibold">WhatsApp</p>
                        <p class="text-djok-yellow">Disponible 24h/24</p>
                    </div>
                </div>
            </div>
    </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="text-center text-gray-500 text-sm">
                <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
                <p class="mt-1">
                    <a href="{{ route('cgv') }}" class="hover:text-djok-yellow">CGV</a> |
                    <a href="{{ route('cgu') }}" class="hover:text-djok-yellow">CGU</a> |
                    <a href="{{ route('mentions-legales') }}" class="hover:text-djok-yellow">Mentions légales</a>
                </p>
            </div>
        </div>
    </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-refresh de la page toutes les 30 secondes pour les mises à jour
            setTimeout(function() {
                window.location.reload();
            }, 30000); // 30 secondes

            // Avertissement avant refresh
            let timeLeft = 30;
            const timerElement = document.createElement('div');
            timerElement.className = 'fixed bottom-4 right-4 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm';
            timerElement.innerHTML = `<i class="fas fa-sync-alt mr-2"></i> Mise à jour automatique dans <span id="countdown">${timeLeft}</span>s`;
            document.body.appendChild(timerElement);

            const countdownElement = document.getElementById('countdown');
            const countdownInterval = setInterval(function() {
                timeLeft--;
                countdownElement.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    timerElement.remove();
                }
            }, 1000);
        });
    </script>
</body>

</html>
