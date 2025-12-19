@extends('layouts.base-black')

@section('title', 'Confirmation de réservation - DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Demande de réservation confirmée !</h1>
                <p class="text-gray-600">
                    Nous avons bien reçu votre demande. Un email de confirmation vous a été envoyé à <strong>{{
                        $reservation->email }}</strong>
                </p>
            </div>

            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Récapitulatif de votre réservation</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Détails du véhicule</h3>
                        <p class="text-gray-900"><strong>Véhicule :</strong> {{ $reservation->vehicle->full_name ??
                            'N/A' }}</p>
                        <p class="text-gray-900"><strong>Catégorie :</strong> {{ $reservation->vehicle->category_fr ??
                            'N/A' }}</p>
                        <p class="text-gray-900"><strong>Carburant :</strong> {{ $reservation->vehicle->fuel_type_fr ??
                            'N/A' }}</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Détails de la location</h3>
                        <p class="text-gray-900"><strong>Référence :</strong> {{ $reservation->reference }}</p>
                        <p class="text-gray-900"><strong>Période :</strong> du {{
                            \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{
                            \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
                        <p class="text-gray-900"><strong>Durée :</strong> {{
                            \Carbon\Carbon::parse($reservation->date_debut)->diffInDays(\Carbon\Carbon::parse($reservation->date_fin))
                            + 1 }} jours</p>
                        <p class="text-gray-900"><strong>Montant estimé :</strong> {{
                            number_format($reservation->montant_total, 2, ',', ' ') }} € TTC</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-bold text-yellow-900 mb-3">Prochaines étapes</h3>
                <ol class="space-y-3">
                    <li class="flex items-start">
                        <span
                            class="flex items-center justify-center w-6 h-6 bg-yellow-600 text-white rounded-full text-sm mr-3 flex-shrink-0">1</span>
                        <span>Notre équipe vérifie la disponibilité définitive du véhicule</span>
                    </li>
                    <li class="flex items-start">
                        <span
                            class="flex items-center justify-center w-6 h-6 bg-yellow-600 text-white rounded-full text-sm mr-3 flex-shrink-0">2</span>
                        <span>Vous recevrez une confirmation définitive par email sous 24h</span>
                    </li>
                    <li class="flex items-start">
                        <span
                            class="flex items-center justify-center w-6 h-6 bg-yellow-600 text-white rounded-full text-sm mr-3 flex-shrink-0">3</span>
                        <span>Un conseiller vous contactera au <strong>{{ $reservation->telephone }}</strong> pour
                            finaliser</span>
                    </li>
                </ol>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('location') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all duration-300">
                    <i class="fas fa-car mr-2"></i>
                    Voir d'autres véhicules
                </a>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                    <i class="fas fa-home mr-2"></i>
                    Retour à l'accueil
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>Vous avez une question ? Contactez-nous au <strong>01 76 38 00 17</strong> ou par email à
                    <strong>location@djokprestige.com</strong></p>
                <p class="mt-2">Référence à conserver : <code
                        class="bg-gray-100 px-2 py-1 rounded">{{ $reservation->reference }}</code></p>
            </div>
        </div>
    </div>
</div>
@endsection
