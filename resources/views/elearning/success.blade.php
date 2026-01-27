@extends('layouts.main')

@section('title', 'Achat e-learning confirmé - DJOK PRESTIGE')

@section('content')
<!-- Hero Section -->
<div class="py-12" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <a href="{{ route('elearning.index') }}"
                    class="inline-flex items-center text-gray-400 hover:text-white">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Retour aux forfaits
                </a>
            </div>

            <h1 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Achat confirmé !</h1>
            <p class="text-gray-400">Votre forfait e-learning a été activé avec succès</p>
        </div>
    </div>
</div>

<!-- Confirmation Section -->
<div class="py-16" style="background: #111;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Messages de succès -->
            @if(session('success'))
            <div class="mb-6 p-6 rounded-lg" style="background: #064e3b; border: 1px solid #047857;">
                <div class="flex items-center">
                    <i class="mr-4 text-2xl fas fa-check-circle" style="color: #a7f3d0;"></i>
                    <div>
                        <h3 class="mb-2 text-xl font-bold text-white">Paiement confirmé</h3>
                        <p class="text-green-200">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Informations paiement -->
                <div class="p-6 rounded-lg" style="background: #1a1a1a; border: 1px solid #333;">
                    <h2 class="mb-6 text-xl font-bold text-white">
                        <i class="mr-2 fas fa-receipt"></i> Informations de paiement
                    </h2>

                    @if(isset($paiement))
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                            <span class="text-gray-300">Référence</span>
                            <span class="font-bold text-white">{{ $paiement->reference }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                            <span class="text-gray-300">Montant</span>
                            <span class="text-xl font-bold" style="color: #b89449;">
                                {{ number_format($paiement->amount, 2, ',', ' ') }} €
                            </span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                            <span class="text-gray-300">Date</span>
                            <span class="font-bold text-white">{{ $paiement->paid_at->format('d/m/Y H:i') }}</span>
                        </div>

                        <div class="flex justify-between items-center pb-4 border-b border-gray-700">
                            <span class="text-gray-300">Statut</span>
                            <span class="px-3 py-1 text-sm font-bold rounded-full"
                                style="background: #064e3b; color: #a7f3d0;">
                                <i class="mr-1 fas fa-check-circle"></i> Confirmé
                            </span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-300">Méthode</span>
                            <span class="font-bold text-white">
                                <i class="mr-2 fab fa-cc-stripe"></i> Carte bancaire
                            </span>
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 p-4 rounded" style="background: #0c4a6e; border: 1px solid #075985;">
                        <div class="flex items-center">
                            <i class="mr-3 fas fa-shield-alt" style="color: #7dd3fc;"></i>
                            <div>
                                <p class="text-white text-sm">
                                    <strong>Transaction sécurisée :</strong> Votre paiement a été traité par Stripe avec
                                    les plus hauts standards de sécurité.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations accès -->
                <div class="p-6 rounded-lg" style="background: #1a1a1a; border: 1px solid #333;">
                    <h2 class="mb-6 text-xl font-bold text-white">
                        <i class="mr-2 fas fa-graduation-cap"></i> Informations d'accès
                    </h2>

                    @if(isset($acces))
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-user" style="color: #b89449;"></i>
                            <div>
                                <h4 class="font-semibold text-white">Étudiant</h4>
                                <p class="text-gray-400">{{ $acces->prenom }} {{ $acces->nom }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-envelope" style="color: #b89449;"></i>
                            <div>
                                <h4 class="font-semibold text-white">Email</h4>
                                <p class="text-gray-400">{{ $acces->email }}</p>
                            </div>
                        </div>

                        @if($acces->telephone)
                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-phone" style="color: #b89449;"></i>
                            <div>
                                <h4 class="font-semibold text-white">Téléphone</h4>
                                <p class="text-gray-400">{{ $acces->telephone }}</p>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-book-open" style="color: #b89449;"></i>
                            <div>
                                <h4 class="font-semibold text-white">Forfait</h4>
                                <p class="text-gray-400">{{ $acces->forfait->name ?? 'Forfait e-learning' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="mt-1 mr-3 fas fa-calendar" style="color: #b89449;"></i>
                            <div>
                                <h4 class="font-semibold text-white">Durée d'accès</h4>
                                <p class="text-gray-400">{{ $acces->forfait->duration_days ?? 28 }} jours</p>
                            </div>
                        </div>
                    </div>

                    <!-- Message important -->
                    <div class="mt-8 p-4 rounded" style="background: #78350f; border: 1px solid #92400e;">
                        <div class="flex items-center">
                            <i class="mr-3 fas fa-info-circle" style="color: #fbbf24;"></i>
                            <div>
                                <h5 class="font-bold text-white mb-1">Important</h5>
                                <p class="text-amber-200 text-sm">
                                    Vos codes d'accès ont été envoyés à l'adresse : <strong>{{ $acces->email }}</strong>
                                </p>
                                <p class="text-amber-200 text-sm mt-2">
                                    Si vous ne recevez pas l'email dans les prochaines minutes, vérifiez votre dossier
                                    spam.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('elearning.salle') }}"
                    class="flex items-center justify-center py-3 font-semibold transition-all duration-300 rounded-lg hover:bg-yellow-600"
                    style="background: #b89449; color: black;">
                    <i class="mr-2 fas fa-door-open"></i>
                    Accéder à la salle virtuelle
                </a>

                <a href="{{ route('elearning.index') }}"
                    class="flex items-center justify-center py-3 font-semibold transition-all duration-300 border rounded-lg hover:bg-gray-800"
                    style="border-color: #b89449; color: #b89449;">
                    <i class="mr-2 fas fa-list"></i>
                    Voir d'autres forfaits
                </a>
            </div>

            <!-- Support -->
            <div class="mt-12 text-center">
                <div class="inline-block p-4 rounded-lg" style="background: #1a1a1a;">
                    <i class="block mb-2 text-2xl fas fa-headset" style="color: #b89449;"></i>
                    <h4 class="font-bold text-white mb-2">Besoin d'aide ?</h4>
                    <p class="text-gray-400 text-sm">
                        Contactez notre support :
                        <a href="mailto:support@djokprestige.com" class="hover:text-white" style="color: #b89449;">
                            support@djokprestige.com
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informations complémentaires -->
<section class="py-12" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="mb-8 text-2xl font-bold text-center" style="color: #b89449;">À propos de votre accès</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 text-center rounded-lg" style="background: #111;">
                    <i class="text-2xl mb-3 fas fa-lock" style="color: #b89449;"></i>
                    <h4 class="font-bold text-white mb-2">Sécurisé</h4>
                    <p class="text-sm text-gray-400">1 seule connexion simultanée autorisée pour garantir la sécurité de
                        votre compte</p>
                </div>

                <div class="p-4 text-center rounded-lg" style="background: #111;">
                    <i class="text-2xl mb-3 fas fa-clock" style="color: #b89449;"></i>
                    <h4 class="font-bold text-white mb-2">24/7</h4>
                    <p class="text-sm text-gray-400">Accédez à vos cours à tout moment, 24h/24 et 7j/7</p>
                </div>

                <div class="p-4 text-center rounded-lg" style="background: #111;">
                    <i class="text-2xl mb-3 fas fa-mobile-alt" style="color: #b89449;"></i>
                    <h4 class="font-bold text-white mb-2">Mobile</h4>
                    <p class="text-sm text-gray-400">Compatibles avec tous les appareils : ordinateur, tablette,
                        smartphone</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
