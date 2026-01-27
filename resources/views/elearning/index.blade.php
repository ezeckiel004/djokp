@extends('layouts.main')

@section('title', 'Formation E-learning - DJOK PRESTIGE')

@section('content')
<!-- Messages de succès/erreur - Style sobre -->
<div class="container px-4 mx-auto md:px-6">
    @if(session('success'))
    <div class="mt-6 mb-6">
        <div class="p-4" style="background: #111; border-left: 4px solid #b89449;">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle" style="color: #b89449;"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-white">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mt-6 mb-6">
        <div class="p-4" style="background: #2a0f0f; border-left: 4px solid #f56565;">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle" style="color: #f56565;"></i>
                </div>
                <div class="ml-3">
                    <p class="font-medium text-white">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Hero Section - Style sobre -->
<header class="relative flex items-center min-h-screen" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
            alt="Formation E-learning" class="object-cover w-full h-full opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container relative z-10 px-4 py-20 mx-auto md:px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="mb-8 text-3xl font-bold md:text-4xl lg:text-5xl" style="color: #b89449;">
                Formation E-learning VTC
            </h1>

            <p class="mb-10 text-lg text-gray-300 md:text-xl">
                Préparez-vous à l'examen VTC en candidat libre avec nos cours en ligne, QCM et examens blancs.
                Accès immédiat après paiement, depuis chez vous.
            </p>

            <p class="mb-12 text-lg" style="color: #b89449;">
                Formation certifiée et conforme au programme officiel
            </p>

            <!-- Avantages clés - Style sobre -->
            <div class="grid grid-cols-1 gap-6 mb-16 md:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-laptop"></i>
                    </div>
                    <span class="text-sm text-center">100% en ligne</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-clock"></i>
                    </div>
                    <span class="text-sm text-center">Accès 24h/24</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-chalkboard-teacher"></i>
                    </div>
                    <span class="text-sm text-center">Formateurs experts</span>
                </div>
                <div class="flex flex-col items-center text-white">
                    <div class="flex items-center justify-center mb-4 w-14 h-14" style="background: #b89449;">
                        <i class="text-xl text-black fas fa-certificate"></i>
                    </div>
                    <span class="text-sm text-center">Certification incluse</span>
                </div>
            </div>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                <a href="#forfaits" class="w-full px-8 py-3 font-semibold text-center transition duration-300 sm:w-auto"
                    style="background: #b89449; color: black;">
                    Voir les forfaits
                </a>
                <a href="{{ route('elearning.salle') }}"
                    class="w-full px-8 py-3 font-semibold text-center transition duration-300 border sm:w-auto"
                    style="border-color: #b89449; color: #b89449;">
                    Accéder à ma salle
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute transform -translate-x-1/2 bottom-8 left-1/2">
        <a href="#forfaits" class="text-white transition duration-300 hover:text-b89449"
            aria-label="Défiler vers le bas">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Forfaits - Style sobre -->
<section id="forfaits" class="py-16" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Nos forfaits e-learning</h2>
            <p class="max-w-3xl mx-auto text-gray-400">
                Choisissez la formule qui correspond à vos besoins et à votre rythme d'apprentissage
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 max-w-6xl mx-auto md:grid-cols-3">
            @foreach($forfaits as $forfait)
            <div class="overflow-hidden rounded-lg" style="background: #111; border: 1px solid #333;">
                <!-- Header du forfait -->
                <div class="p-6" style="background: #1a1a1a;">
                    <h3 class="mb-2 text-xl font-bold text-white">{{ $forfait->name }}</h3>
                    <div class="flex items-center">
                        <span class="text-3xl font-bold" style="color: #b89449;">{{ $forfait->formatted_price }}</span>
                        <span class="ml-2 text-gray-400">/ {{ $forfait->duration_days }} jours</span>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="p-6">
                    <p class="mb-6 text-gray-300">{{ $forfait->description }}</p>

                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                            <span class="text-gray-300">Accès {{ $forfait->duration_days }} jours</span>
                        </li>
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                            <span class="text-gray-300">Tous les cours disponibles</span>
                        </li>
                        @if($forfait->includes_qcm)
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                            <span class="text-gray-300">QCM d'auto-évaluation</span>
                        </li>
                        @endif
                        @if($forfait->includes_examens_blancs)
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                            <span class="text-gray-300">Examens blancs corrigés</span>
                        </li>
                        @endif
                        @if($forfait->includes_certification)
                        <li class="flex items-center">
                            <i class="mr-3 fas fa-check" style="color: #46b94c;"></i>
                            <span class="text-gray-300">Certificat de formation</span>
                        </li>
                        @endif
                    </ul>

                    <a href="{{ route('elearning.acheter', $forfait->slug) }}"
                        class="block w-full py-3 text-center font-semibold transition duration-300"
                        style="background: #b89449; color: black;">
                        Choisir ce forfait
                    </a>
                </div>
            </div>
            @endforeach

            @if($forfaits->count() === 0)
            <div class="col-span-3 py-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-4" style="background: #111;">
                    <i class="text-2xl fas fa-book" style="color: #b89449;"></i>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-white">Aucun forfait disponible</h3>
                <p class="text-gray-400">Les forfaits e-learning seront bientôt disponibles.</p>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Comment ça marche - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Comment ça marche ?</h2>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-6" style="background: #b89449;">
                    <i class="text-2xl fas fa-shopping-cart"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">1. Choisissez votre forfait</h3>
                <p class="text-gray-400">Sélectionnez la durée d'accès qui vous convient</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-6" style="background: #b89449;">
                    <i class="text-2xl fas fa-credit-card"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">2. Paiement sécurisé</h3>
                <p class="text-gray-400">Payez en ligne de manière sécurisée avec Stripe</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 mb-6" style="background: #b89449;">
                    <i class="text-2xl fas fa-laptop"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold text-white">3. Accès immédiat</h3>
                <p class="text-gray-400">Recevez vos codes d'accès par email et commencez</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ - Style sobre -->
<section class="py-16" style="background: #000;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="mb-12 text-center">
            <h2 class="mb-4 text-2xl font-bold md:text-3xl" style="color: #b89449;">Questions fréquentes</h2>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="overflow-hidden rounded-lg" style="background: #111; border: 1px solid #333;">
                <div class="p-6">
                    <h3 class="mb-3 text-lg font-semibold text-white">Ai-je besoin de créer un compte ?</h3>
                    <p class="text-gray-400">Non, tout se fait par email. Vous recevez un code d'accès unique après
                        paiement que vous utilisez pour accéder à la salle virtuelle.</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-lg" style="background: #111; border: 1px solid #333;">
                <div class="p-6">
                    <h3 class="mb-3 text-lg font-semibold text-white">Puis-je me connecter sur plusieurs appareils ?
                    </h3>
                    <p class="text-gray-400">Pour des raisons de sécurité, un seul appareil peut être connecté à la fois
                        avec votre code. Vous devez vous déconnecter avant de vous connecter sur un autre appareil.</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-lg" style="background: #111; border: 1px solid #333;">
                <div class="p-6">
                    <h3 class="mb-3 text-lg font-semibold text-white">Que se passe-t-il à la fin de mon forfait ?</h3>
                    <p class="text-gray-400">Votre accès expire automatiquement. Vous pouvez renouveler en achetant un
                        nouveau forfait si vous souhaitez continuer à vous entraîner.</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-lg" style="background: #111; border: 1px solid #333;">
                <div class="p-6">
                    <h3 class="mb-3 text-lg font-semibold text-white">Puis-je télécharger les cours ?</h3>
                    <p class="text-gray-400">Non, pour des raisons de droits d'auteur et de protection du contenu, les
                        cours sont accessibles uniquement en streaming dans votre espace sécurisé.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Accès salle virtuelle - Style sobre -->
<section class="py-16" style="background: #b89449; color: black;">
    <div class="container px-4 mx-auto md:px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="mb-6 text-2xl font-bold md:text-3xl">Déjà un accès e-learning ?</h2>
            <p class="mb-8 text-lg">
                Connectez-vous à votre salle virtuelle avec votre code d'accès et votre email
            </p>
            <a href="{{ route('elearning.salle') }}"
                class="inline-flex items-center px-8 py-3 font-semibold transition-all duration-300"
                style="background: #000; color: white;">
                <i class="mr-3 fas fa-sign-in-alt"></i>Accéder à ma salle
            </a>
        </div>
    </div>
</section>
@endsection
