@extends('layouts.main')

@section('title', 'Mentions Légales - DJOK PRESTIGE')

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">MENTIONS LÉGALES</h1>

            <div class="space-y-8 prose prose-lg max-w-none">
                <!-- Propriétaire Rédacteur -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">PROPRIÉTAIRE RÉDACTEUR</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            Le présent site www.djokprestige.com est la propriété de Djok Prestige SAS dont le siège
                            social est situé :
                        </p>
                        <ul class="mt-3 space-y-2 text-gray-700">
                            <li><strong>Adresse :</strong> 66 Avenue des Champs Elysées 75008 Paris</li>
                            <li><strong>SIRET :</strong> 90326843100017</li>
                            <li><strong>Code NAF :</strong> 4932Z</li>
                            <li><strong>Téléphone :</strong> 0148475213</li>
                            <li><strong>Email :</strong> contact@djokprestige.com</li>
                        </ul>
                    </div>
                </div>

                <!-- Hébergeur -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">HÉBERGEUR</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            Ce site web est hébergé par :
                        </p>
                        <ul class="mt-3 space-y-2 text-gray-700">
                            <li><strong>Société :</strong> HOSTINGER</li>
                            <li><strong>Capital social :</strong> 100 000 €</li>
                            <li><strong>SIRET :</strong> 510 909 807 00032</li>
                            <li><strong>RCS :</strong> Clermont Ferrant</li>
                            <li><strong>Siège social :</strong> Chemin des Pardiaux, 63000 Clermont-Ferrand</li>
                            <li><strong>Site web :</strong> https://www.HOSTINGER.fr/</li>
                        </ul>
                    </div>
                </div>

                <!-- Propriétés Intellectuelles -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">PROPRIÉTÉS INTELLECTUELLES</h2>
                    <p class="text-gray-700">
                        L'ensemble des contenus diffusés sur le site www.djokprestige.com est protégé par la législation
                        française et internationale relative au droit d'auteur.
                    </p>
                    <p class="mt-3 text-gray-700">
                        Toute reproduction ou représentation partielle ou totale de ce site, par quelque procédé que ce
                        soit, n'est permise qu'en vue d'un usage strictement privé. Toute autre utilisation est
                        interdite sauf autorisation préalable et expresse de Djok Prestige SAS.
                    </p>
                </div>

                <!-- Création de liens -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">CRÉATION DE LIENS VERS LE SITE</h2>
                    <p class="text-gray-700">
                        La création de liens hypertextes (simples ou profonds) vers le site est soumise à l'autorisation
                        préalable, expresse et écrite de Djok Prestige SAS.
                    </p>
                    <p class="mt-3 text-gray-700">
                        Toute demande d'autorisation doit être adressée par l'intermédiaire du formulaire disponible sur
                        la page contact du site.
                    </p>
                </div>

                <!-- Liens externes -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">LIENS EXTERNES</h2>
                    <p class="text-gray-700">
                        Le site www.djokprestige.com peut contenir des liens hypertextes allant vers d'autres sites.
                        Aucun engagement concernant ces autres sites n'est pris : Djok Prestige SAS ne serait en aucune
                        façon responsable des contenus, fonctionnement et accès de ceux-ci.
                    </p>
                </div>

                <!-- RGPD -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">PROTECTION DES DONNÉES PERSONNELLES (RGPD)</h2>
                    <p class="text-gray-700">
                        Le traitement des données personnelles et le respect de la vie privée sont au centre de nos
                        attentions. Djok Prestige SAS s'engage à respecter la législation en vigueur en matière de
                        protection de la vie privée et des données personnelles et, en particulier, le règlement
                        européen sur la protection des données personnelles (RGPD) du 20 juin 2018.
                    </p>
                    <p class="mt-3 text-gray-700">
                        Pour plus d'informations sur notre politique de protection des données, veuillez consulter notre
                        <a href="{{ route('rgpd') }}" class="text-blue-600 hover:underline">Politique de
                            Confidentialité</a>.
                    </p>
                </div>

                <!-- Cookies -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">COOKIES</h2>
                    <p class="text-gray-700">
                        Le site www.djokprestige.com utilise des cookies pour améliorer l'expérience utilisateur. Les
                        cookies sont de petits fichiers texte stockés sur votre appareil qui nous aident à analyser
                        l'utilisation du site et à personnaliser le contenu.
                    </p>
                    <p class="mt-3 text-gray-700">
                        Vous pouvez configurer votre navigateur pour refuser tous les cookies ou pour indiquer quand un
                        cookie est envoyé. Cependant, certaines fonctionnalités du site pourraient ne pas fonctionner
                        correctement sans cookies.
                    </p>
                </div>

                <!-- Contact -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">CONTACT</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            Pour toute question relative aux présentes mentions légales, vous pouvez nous contacter :
                        </p>
                        <ul class="mt-3 space-y-2 text-gray-700">
                            <li><strong>Par email :</strong> contact@djokprestige.com</li>
                            <li><strong>Par téléphone :</strong> +33 1 48 47 52 13</li>
                            <li><strong>Par courrier :</strong> Djok Prestige SAS, 66 Avenue des Champs Élysées, 75008
                                Paris, France</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="p-6 mt-12 rounded-lg bg-gray-50">
                <p class="text-sm text-center text-gray-600">
                    <strong>Date de dernière mise à jour :</strong> 1er Janvier 2024<br>
                    Djok Prestige SAS - SAS au capital de 500€ - RCS Paris B 903 268 431
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
