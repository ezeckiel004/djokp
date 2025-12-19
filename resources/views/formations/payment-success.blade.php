@extends('layouts.main')

@section('title', 'Paiement réussi | DJOK PRESTIGE')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
            <!-- Carte de confirmation -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- En-tête succès -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                        <i class="fas fa-check-circle text-green-600 text-4xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Paiement réussi !</h1>
                    <p class="text-green-100">Votre inscription a été confirmée avec succès.</p>
                </div>

                <div class="p-8">
                    <!-- Récapitulatif -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Récapitulatif de votre commande</h2>

                        <div class="space-y-6">
                            <!-- Formation -->
                            <div class="p-6 bg-gray-50 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-3">{{ $formation->title }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                                    <div>
                                        <span class="font-medium">Référence :</span>
                                        <span class="ml-2">{{ $paiement->reference }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">Date :</span>
                                        <span class="ml-2">{{ $paiement->paid_at->format('d/m/Y à H:i') }}</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">Montant :</span>
                                        <span class="ml-2 font-bold text-green-600">{{ number_format($paiement->amount,
                                            0, ',', ' ') }} €</span>
                                    </div>
                                    <div>
                                        <span class="font-medium">Statut :</span>
                                        <span class="ml-2">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                Payé
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Accès -->
                            <div class="p-6 bg-blue-50 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-3">Votre accès à la formation</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-laptop text-blue-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">Plateforme e-learning</p>
                                            <p class="text-sm text-gray-600">Accès immédiat 24h/24</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt text-blue-600 mr-3"></i>
                                        <div>
                                            <p class="font-medium">Durée d'accès</p>
                                            <p class="text-sm text-gray-600">12 mois à partir d'aujourd'hui</p>
                                        </div>
                                    </div>
                                    @if(auth()->check())
                                    <div class="mt-4">
                                        <a href="{{ route('dashboard') }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
                                            <i class="fas fa-tachometer-alt mr-2"></i>
                                            Accéder à mon espace formation
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Prochaines étapes -->
                            <div class="p-6 bg-yellow-50 rounded-xl">
                                <h3 class="font-bold text-gray-900 mb-3">Prochaines étapes</h3>
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div
                                            class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <span class="text-yellow-800 font-bold">1</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Email de confirmation</p>
                                            <p class="text-sm text-gray-600">Vous recevrez sous peu un email avec vos
                                                identifiants</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div
                                            class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <span class="text-yellow-800 font-bold">2</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Accès à la plateforme</p>
                                            <p class="text-sm text-gray-600">Connectez-vous avec les identifiants
                                                fournis</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div
                                            class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                            <span class="text-yellow-800 font-bold">3</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Démarrage de la formation</p>
                                            <p class="text-sm text-gray-600">Commencez votre formation dès aujourd'hui
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Facture -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Facture</h3>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-gray-700">Une facture a été générée et envoyée à votre adresse email.
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">Référence : {{ $paiement->reference }}</p>
                                </div>
                                <div>
                                    <span class="px-3 py-1 bg-gray-200 text-gray-800 text-sm font-medium rounded-full">
                                        Disponible dans votre espace
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('formation') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Découvrir d'autres formations
                        </a>
                        @if(auth()->check())
                        <a href="{{ route('dashboard') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                            <i class="fas fa-tachometer-alt mr-2"></i>
                            Mon espace formation
                        </a>
                        @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Se connecter
                        </a>
                        @endif
                    </div>

                    <!-- Assistance -->
                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-gray-600 mb-3">Une question concernant votre commande ?</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-phone-alt text-yellow-600 mr-2"></i>
                                <span>01 76 38 00 17</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="fas fa-envelope text-yellow-600 mr-2"></i>
                                <span>support@djokprestige.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
