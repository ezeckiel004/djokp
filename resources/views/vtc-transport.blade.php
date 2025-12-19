@extends('layouts.main')

@section('title', 'VTC & Transport - DJOK PRESTIGE')

@section('content')
<!-- Header Hero Section -->
<header class="flex flex-col min-h-[60vh] bg-gradient-to-r from-gray-900 to-purple-900">
    @include('layouts.navbar')

    <div class="flex flex-col items-center justify-center flex-1 px-4 text-center text-white">
        <h1 class="mb-6 text-5xl font-bold md:text-6xl">VTC & Transport</h1>
        <p class="max-w-3xl mb-8 text-xl md:text-2xl">
            Service de transport haut de gamme - Confort, sécurité et ponctualité
        </p>
        <a href="#reserver"
            class="px-8 py-4 text-lg font-semibold text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
            Réserver un trajet
        </a>
    </div>
</header>

<!-- Calculateur de Tarifs -->
<section class="py-16 bg-white">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-4xl font-bold text-center text-gray-900">Calculateur de Tarifs</h2>

        <div class="p-8 shadow-lg bg-gray-50 rounded-xl">
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 font-semibold">Lieu de départ</label>
                    <input type="text" class="w-full px-4 py-3 border rounded-lg" placeholder="Adresse de départ">
                </div>
                <div>
                    <label class="block mb-2 font-semibold">Lieu d'arrivée</label>
                    <input type="text" class="w-full px-4 py-3 border rounded-lg" placeholder="Adresse de destination">
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">Type de véhicule</label>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <button class="p-4 border-2 border-gray-300 rounded-lg hover:border-yellow-500">
                        <div class="text-lg font-semibold">Éco</div>
                        <div class="font-bold text-yellow-600">À partir de 45€</div>
                    </button>
                    <button class="p-4 border-2 border-gray-300 rounded-lg hover:border-yellow-500">
                        <div class="text-lg font-semibold">Business</div>
                        <div class="font-bold text-yellow-600">À partir de 65€</div>
                    </button>
                    <button class="p-4 border-2 border-gray-300 rounded-lg hover:border-yellow-500">
                        <div class="text-lg font-semibold">Prestige</div>
                        <div class="font-bold text-yellow-600">À partir de 90€</div>
                    </button>
                </div>
            </div>

            <button class="w-full px-8 py-4 font-semibold text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
                Calculer le prix
            </button>
        </div>
    </div>
</section>

<!-- Services de Transport -->
<section class="py-16 bg-gray-50">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="mb-12 text-4xl font-bold text-center text-gray-900">Nos Services de Transport</h2>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- Transferts Aéroports -->
            <div class="p-6 text-center bg-white shadow-lg rounded-xl">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full">
                    <i class="text-2xl text-blue-600 fas fa-plane"></i>
                </div>
                <h3 class="mb-3 text-xl font-bold">Transferts Aéroports & Gares</h3>
                <p class="mb-4 text-gray-600">Vers tous les aéroports et gares de France</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-600">
                    <li>✓ Accueil personnalisé</li>
                    <li>✓ Suivi en temps réel</li>
                    <li>✓ Attente gratuite</li>
                </ul>
                <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Réserver
                </button>
            </div>

            <!-- Déplacements Pro -->
            <div class="p-6 text-center bg-white shadow-lg rounded-xl">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full">
                    <i class="text-2xl text-green-600 fas fa-briefcase"></i>
                </div>
                <h3 class="mb-3 text-xl font-bold">Déplacements Professionnels</h3>
                <p class="mb-4 text-gray-600">Pour vos rendez-vous et séminaires</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-600">
                    <li>✓ Facturation simplifiée</li>
                    <li>✓ Forfaits journaliers</li>
                    <li>✓ Services VIP</li>
                </ul>
                <button class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Réserver
                </button>
            </div>

            <!-- Événements -->
            <div class="p-6 text-center bg-white shadow-lg rounded-xl">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full">
                    <i class="text-2xl text-purple-600 fas fa-glass-cheers"></i>
                </div>
                <h3 class="mb-3 text-xl font-bold">Événements & Mariages</h3>
                <p class="mb-4 text-gray-600">Pour vos moments exceptionnels</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-600">
                    <li>✓ Transfert invités</li>
                    <li>✓ Véhicules décorés</li>
                    <li>✓ Service personnalisé</li>
                </ul>
                <button class="px-4 py-2 text-white bg-purple-600 rounded hover:bg-purple-700">
                    Demander devis
                </button>
            </div>

            <!-- Mise à disposition -->
            <div class="p-6 text-center bg-white shadow-lg rounded-xl">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                    <i class="text-2xl text-yellow-600 fas fa-clock"></i>
                </div>
                <h3 class="mb-3 text-xl font-bold">Mise à Disposition</h3>
                <p class="mb-4 text-gray-600">Chauffeur privé à la journée</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-600">
                    <li>✓ Demi-journée</li>
                    <li>✓ Journée complète</li>
                    <li>✓ Soirée</li>
                </ul>
                <button class="px-4 py-2 text-white bg-yellow-600 rounded hover:bg-yellow-700">
                    Réserver
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Tarification Transparente -->
<section class="py-16 bg-white">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-4xl font-bold text-center text-gray-900">Tarifs Transparents</h2>

        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg shadow-lg">
                <thead class="text-white bg-gray-800">
                    <tr>
                        <th class="px-6 py-4 text-left">Trajet</th>
                        <th class="px-6 py-4 text-center">Éco</th>
                        <th class="px-6 py-4 text-center">Business</th>
                        <th class="px-6 py-4 text-center">Prestige</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach([
                    ['Paris → Orly', '45 €', '65 €', '90 €'],
                    ['Paris → CDG', '60 €', '80 €', '110 €'],
                    ['Paris → La Défense', '40 €', '60 €', '85 €'],
                    ['Paris → Versailles', '55 €', '75 €', '100 €']
                    ] as $trajet)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold">{{ $trajet[0] }}</td>
                        <td class="px-6 py-4 font-bold text-center text-green-600">{{ $trajet[1] }}</td>
                        <td class="px-6 py-4 font-bold text-center text-blue-600">{{ $trajet[2] }}</td>
                        <td class="px-6 py-4 font-bold text-center text-purple-600">{{ $trajet[3] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-center">
            <button class="px-8 py-4 font-semibold text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
                Simuler mon tarif
            </button>
        </div>
    </div>
</section>

<!-- Options Confort -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-4xl font-bold text-center text-gray-900">Confort à Bord</h2>

        <div class="grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-6">
            @foreach([
            ['fas fa-wifi', 'Wi-Fi gratuit'],
            ['fas fa-snowflake', 'Climatisation'],
            ['fas fa-mobile-alt', 'Chargeurs'],
            ['fas fa-tint', 'Eau & rafraîchissements'],
            ['fas fa-baby', 'Siège bébé'],
            ['fas fa-credit-card', 'Paiement CB']
            ] as $option)
            <div class="text-center">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-3 bg-white rounded-full shadow-lg">
                    <i class="{{ $option[0] }} text-yellow-600 text-xl"></i>
                </div>
                <span class="text-sm font-semibold">{{ $option[1] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
