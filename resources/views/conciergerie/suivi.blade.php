@extends('layouts.main')

@section('title', 'Suivi demande - ' . $demande->reference)

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- En-tête -->
            <div class="text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Suivi de votre demande
                </h1>
                <p class="text-gray-600">
                    Référence : <strong>{{ $demande->reference }}</strong>
                </p>
            </div>

            <!-- Statut -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">Statut de votre demande</h2>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-2 rounded-full text-white font-semibold 
                                {{ $demande->statut == 'nouvelle' ? 'bg-yellow-500' : 
                                   ($demande->statut == 'devis_envoye' ? 'bg-blue-500' : 
                                   ($demande->statut == 'confirme' ? 'bg-green-500' : 'bg-gray-500')) }}">
                                {{ $demande->statut_label }}
                            </span>
                            <span class="text-gray-600">
                                {{ $demande->created_at->format('d/m/Y à H:i') }}
                            </span>
                        </div>
                    </div>

                    @if($demande->montant_devis)
                    <div class="text-center">
                        <div class="text-3xl font-bold text-yellow-600">
                            {{ $demande->montant_formate }}
                        </div>
                        <div class="text-gray-600">Devis envoyé le {{ $demande->date_devis->format('d/m/Y') }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Informations -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Vos informations</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-gray-600">Nom :</span>
                            <span class="font-medium">{{ $demande->nom_complet }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Email :</span>
                            <span class="font-medium">{{ $demande->email }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Téléphone :</span>
                            <span class="font-medium">{{ $demande->telephone }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Motif :</span>
                            <span class="font-medium">{{ $demande->motif_label }}</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Détails du séjour</h3>
                    <ul class="space-y-3">
                        <li class="flex justify-between">
                            <span class="text-gray-600">Date d'arrivée :</span>
                            <span class="font-medium">{{ $demande->date_arrivee->format('d/m/Y') }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Durée :</span>
                            <span class="font-medium">{{ $demande->duree_sejour }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Personnes :</span>
                            <span class="font-medium">{{ $demande->nombre_personnes }}</span>
                        </li>
                        <li class="flex justify-between">
                            <span class="text-gray-600">Accompagnement :</span>
                            <span class="font-medium">{{ $demande->accompagnement_label }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Services demandés -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Services demandés</h3>
                <div class="flex flex-wrap gap-3">
                    @if($demande->services)
                    @foreach($demande->services as $service)
                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-medium">
                        {{ $service }}
                    </span>
                    @endforeach
                    @else
                    <p class="text-gray-600">Aucun service spécifié</p>
                    @endif
                </div>
            </div>

            <!-- Message -->
            <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Votre message</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-gray-700 whitespace-pre-line">{{ $demande->message }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-900 text-white rounded-2xl p-8">
                <h3 class="text-xl font-bold mb-6 text-center">Besoin d'aide ?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                            <i class="fas fa-phone-alt text-white text-xl"></i>
                        </div>
                        <p class="font-semibold mb-2">Téléphone</p>
                        <a href="tel:0176380017" class="text-yellow-400 hover:text-yellow-300">01 76 38 00 17</a>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <p class="font-semibold mb-2">Email</p>
                        <a href="mailto:conciergerie@djokprestige.com"
                            class="text-yellow-400 hover:text-yellow-300">conciergerie@djokprestige.com</a>
                    </div>

                    <div class="text-center">
                        <div class="w-12 h-12 flex items-center justify-center bg-yellow-600 rounded-full mx-auto mb-4">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <p class="font-semibold mb-2">Horaires</p>
                        <p class="text-yellow-400">Lun-Ven: 9h-19h</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection