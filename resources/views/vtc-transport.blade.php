@extends('layouts.main')

@section('title', 'VTC & Transport - DJOK PRESTIGE')

@section('content')
<!-- Header Hero Section - Style sobre -->
<header class="flex flex-col min-h-[60vh]" style="background: #000;">
    @include('layouts.navbar')

    <div class="flex flex-col items-center justify-center flex-1 px-4 text-center">
        <h1 class="mb-6 text-4xl md:text-5xl font-bold" style="color: var(--gold);">VTC & Transport</h1>
        <p class="max-w-3xl mb-8 text-lg md:text-xl text-gray-300">
            Service de transport haut de gamme - Confort, sécurité et ponctualité
        </p>
        <a href="#reserver" class="px-8 py-3 font-semibold transition duration-300"
            style="background: var(--gold); color: black;">
            Réserver un trajet
        </a>
    </div>
</header>

<!-- Calculateur de Tarifs - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-3xl font-bold text-center" style="color: var(--gold);">Calculateur de Tarifs</h2>

        <div class="p-6 md:p-8" style="background: #111; border: 1px solid #333;">
            <div class="grid grid-cols-1 gap-4 md:gap-6 mb-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 font-semibold" style="color: #ddd;">Lieu de départ</label>
                    <input type="text" class="w-full px-4 py-3 rounded"
                        style="background: #1a1a1a; border: 1px solid #444; color: white;"
                        placeholder="Adresse de départ">
                </div>
                <div>
                    <label class="block mb-2 font-semibold" style="color: #ddd;">Lieu d'arrivée</label>
                    <input type="text" class="w-full px-4 py-3 rounded"
                        style="background: #1a1a1a; border: 1px solid #444; color: white;"
                        placeholder="Adresse de destination">
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold" style="color: #ddd;">Type de véhicule</label>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <button class="p-4 rounded" style="background: #111; border: 1px solid #444; color: white;">
                        <div class="text-lg font-semibold">Éco</div>
                        <div class="font-bold" style="color: var(--gold);">À partir de 45€</div>
                    </button>
                    <button class="p-4 rounded" style="background: #111; border: 1px solid #444; color: white;">
                        <div class="text-lg font-semibold">Business</div>
                        <div class="font-bold" style="color: var(--gold);">À partir de 65€</div>
                    </button>
                    <button class="p-4 rounded" style="background: #111; border: 1px solid #444; color: white;">
                        <div class="text-lg font-semibold">Prestige</div>
                        <div class="font-bold" style="color: var(--gold);">À partir de 90€</div>
                    </button>
                </div>
            </div>

            <button class="w-full px-8 py-3 font-semibold transition duration-300"
                style="background: var(--gold); color: black;">
                Calculer le prix
            </button>
        </div>
    </div>
</section>

<!-- Services de Transport - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="mb-12 text-3xl font-bold text-center" style="color: var(--gold);">Nos Services de Transport</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Transferts Aéroports -->
            <div class="p-6 text-center" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full"
                    style="background: #1e40af;">
                    <i class="text-xl fas fa-plane text-white"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold" style="color: white;">Transferts Aéroports & Gares</h3>
                <p class="mb-4 text-gray-400">Vers tous les aéroports et gares de France</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-400">
                    <li>✓ Accueil personnalisé</li>
                    <li>✓ Suivi en temps réel</li>
                    <li>✓ Attente gratuite</li>
                </ul>
                <button class="px-4 py-2 font-semibold transition duration-300"
                    style="background: #1e40af; color: white;">
                    Réserver
                </button>
            </div>

            <!-- Déplacements Pro -->
            <div class="p-6 text-center" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full"
                    style="background: #065f46;">
                    <i class="text-xl fas fa-briefcase text-white"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold" style="color: white;">Déplacements Professionnels</h3>
                <p class="mb-4 text-gray-400">Pour vos rendez-vous et séminaires</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-400">
                    <li>✓ Facturation simplifiée</li>
                    <li>✓ Forfaits journaliers</li>
                    <li>✓ Services VIP</li>
                </ul>
                <button class="px-4 py-2 font-semibold transition duration-300"
                    style="background: #065f46; color: white;">
                    Réserver
                </button>
            </div>

            <!-- Événements -->
            <div class="p-6 text-center" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full"
                    style="background: #5b21b6;">
                    <i class="text-xl fas fa-glass-cheers text-white"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold" style="color: white;">Événements & Mariages</h3>
                <p class="mb-4 text-gray-400">Pour vos moments exceptionnels</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-400">
                    <li>✓ Transfert invités</li>
                    <li>✓ Véhicules décorés</li>
                    <li>✓ Service personnalisé</li>
                </ul>
                <button class="px-4 py-2 font-semibold transition duration-300"
                    style="background: #5b21b6; color: white;">
                    Demander devis
                </button>
            </div>

            <!-- Mise à disposition -->
            <div class="p-6 text-center" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full"
                    style="background: var(--gold);">
                    <i class="text-xl fas fa-clock text-black"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold" style="color: white;">Mise à Disposition</h3>
                <p class="mb-4 text-gray-400">Chauffeur privé à la journée</p>
                <ul class="mb-4 space-y-2 text-sm text-gray-400">
                    <li>✓ Demi-journée</li>
                    <li>✓ Journée complète</li>
                    <li>✓ Soirée</li>
                </ul>
                <button class="px-4 py-2 font-semibold transition duration-300"
                    style="background: var(--gold); color: black;">
                    Réserver
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Tarification Transparente - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-3xl font-bold text-center" style="color: var(--gold);">Tarifs Transparents</h2>

        <div class="overflow-x-auto">
            <table class="w-full" style="background: #111; border: 1px solid #333;">
                <thead>
                    <tr style="background: #000;">
                        <th class="px-4 md:px-6 py-3 text-left text-white">Trajet</th>
                        <th class="px-4 md:px-6 py-3 text-center text-white">Éco</th>
                        <th class="px-4 md:px-6 py-3 text-center text-white">Business</th>
                        <th class="px-4 md:px-6 py-3 text-center text-white">Prestige</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: #333;">
                    @foreach([
                    ['Paris → Orly', '45 €', '65 €', '90 €'],
                    ['Paris → CDG', '60 €', '80 €', '110 €'],
                    ['Paris → La Défense', '40 €', '60 €', '85 €'],
                    ['Paris → Versailles', '55 €', '75 €', '100 €']
                    ] as $trajet)
                    <tr class="hover:bg-gray-900" style="color: white;">
                        <td class="px-4 md:px-6 py-3 font-semibold">{{ $trajet[0] }}</td>
                        <td class="px-4 md:px-6 py-3 font-bold text-center" style="color: var(--gold);">{{ $trajet[1] }}
                        </td>
                        <td class="px-4 md:px-6 py-3 font-bold text-center" style="color: var(--gold);">{{ $trajet[2] }}
                        </td>
                        <td class="px-4 md:px-6 py-3 font-bold text-center" style="color: var(--gold);">{{ $trajet[3] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 text-center">
            <button class="px-8 py-3 font-semibold transition duration-300"
                style="background: var(--gold); color: black;">
                Simuler mon tarif
            </button>
        </div>
    </div>
</section>

<!-- Options Confort - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-3xl font-bold text-center" style="color: var(--gold);">Confort à Bord</h2>

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
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-3 rounded-full"
                    style="background: #1a1a1a; border: 1px solid #333;">
                    <i class="{{ $option[0] }}" style="color: var(--gold); font-size: 1.25rem;"></i>
                </div>
                <span class="text-sm font-semibold" style="color: white;">{{ $option[1] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Réservation - Style sobre -->
<section id="reserver" class="py-16" style="background: #000;">
    <div class="max-w-4xl px-4 mx-auto">
        <h2 class="mb-12 text-3xl font-bold text-center" style="color: var(--gold);">Réservation en ligne</h2>

        <div class="p-6 md:p-8" style="background: #111; border: 1px solid #333;">
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label class="block mb-2 font-semibold" style="color: #ddd;">Nom complet *</label>
                        <input type="text" required class="w-full px-4 py-3 rounded"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;" placeholder="Votre nom">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold" style="color: #ddd;">Téléphone *</label>
                        <input type="tel" required class="w-full px-4 py-3 rounded"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;"
                            placeholder="Votre téléphone">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div>
                        <label class="block mb-2 font-semibold" style="color: #ddd;">Email *</label>
                        <input type="email" required class="w-full px-4 py-3 rounded"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;"
                            placeholder="votre@email.com">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold" style="color: #ddd;">Date et heure *</label>
                        <input type="datetime-local" required class="w-full px-4 py-3 rounded"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;">
                    </div>
                </div>

                <div>
                    <label class="block mb-2 font-semibold" style="color: #ddd;">Message (optionnel)</label>
                    <textarea rows="4" class="w-full px-4 py-3 rounded"
                        style="background: #1a1a1a; border: 1px solid #444; color: white;"
                        placeholder="Informations complémentaires..."></textarea>
                </div>

                <button type="submit" class="w-full px-8 py-3 font-semibold transition duration-300"
                    style="background: var(--gold); color: black;">
                    Réserver maintenant
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Contact VTC - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full"
                    style="background: var(--gold);">
                    <i class="fas fa-phone text-black"></i>
                </div>
                <h3 class="mb-2 font-bold" style="color: white;">Téléphone</h3>
                <a href="tel:0176380017" class="font-semibold hover:text-gray-300" style="color: #ddd;">01 76 38 00
                    17</a>
            </div>

            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full"
                    style="background: var(--gold);">
                    <i class="fab fa-whatsapp text-black"></i>
                </div>
                <h3 class="mb-2 font-bold" style="color: white;">WhatsApp</h3>
                <p class="font-semibold" style="color: #ddd;">Réservation rapide</p>
            </div>

            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full"
                    style="background: var(--gold);">
                    <i class="fas fa-clock text-black"></i>
                </div>
                <h3 class="mb-2 font-bold" style="color: white;">Disponibilité</h3>
                <p class="font-semibold" style="color: #ddd;">24h/24 - 7j/7</p>
            </div>
        </div>
    </div>
</section>
@endsection
