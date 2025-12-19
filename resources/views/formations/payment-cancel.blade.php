@extends('layouts.main')

@section('title', 'Paiement annulé | DJOK PRESTIGE')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
            <!-- Carte d'annulation -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- En-tête annulation -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-8 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                        <i class="fas fa-times-circle text-orange-600 text-4xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Paiement annulé</h1>
                    <p class="text-orange-100">Votre transaction a été interrompue.</p>
                </div>

                <div class="p-8">
                    <!-- Message -->
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-4">
                            <i class="fas fa-exclamation-triangle text-orange-600 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Transaction non aboutie</h2>
                        <p class="text-gray-700 mb-6">
                            Votre paiement a été annulé ou une erreur est survenue pendant le processus.
                            Aucun prélèvement n'a été effectué sur votre compte.
                        </p>

                        <div class="p-4 bg-orange-50 rounded-lg border border-orange-200 max-w-md mx-auto">
                            <p class="text-orange-800">
                                <i class="fas fa-info-circle text-orange-600 mr-2"></i>
                                Si cette annulation était involontaire, vous pouvez réessayer.
                            </p>
                        </div>
                    </div>

                    <!-- Causes possibles -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Causes possibles :</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-times text-red-500 mt-1 mr-3"></i>
                                <span>Annulation volontaire pendant le processus de paiement</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
                                <span>Problème technique temporaire avec le système de paiement</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-credit-card text-red-500 mt-1 mr-3"></i>
                                <span>Informations de carte bancaire incorrectes</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-red-500 mt-1 mr-3"></i>
                                <span>Délai d'attente trop long lors de la saisie</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                            <i class="fas fa-redo mr-2"></i>
                            Réessayer le paiement
                        </a>
                        <a href="{{ route('formation') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Retour aux formations
                        </a>
                    </div>

                    <!-- Assistance -->
                    <div class="p-6 bg-gray-50 rounded-xl text-center">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">Besoin d'aide ?</h3>
                        <p class="text-gray-700 mb-4">
                            Notre équipe de support est là pour vous aider à résoudre ce problème.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <div class="flex items-center justify-center text-gray-700">
                                <i class="fas fa-phone-alt text-yellow-600 mr-2"></i>
                                <div>
                                    <p class="font-medium">01 76 38 00 17</p>
                                    <p class="text-sm text-gray-600">Lun-Ven 9h-19h</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center text-gray-700">
                                <i class="fas fa-envelope text-yellow-600 mr-2"></i>
                                <div>
                                    <p class="font-medium">support@djokprestige.com</p>
                                    <p class="text-sm text-gray-600">Réponse sous 24h</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
