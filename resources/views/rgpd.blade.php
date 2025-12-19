@extends('layouts.base-black')

@section('title', 'Politique de Confidentialité RGPD - DJOK PRESTIGE')

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">POLITIQUE DE CONFIDENTIALITÉ RGPD</h1>

            <div class="space-y-8 prose prose-lg max-w-none">
                <!-- Introduction -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Introduction</h2>
                    <p class="text-gray-700">
                        Le traitement des données personnelles et le respect de la vie privée sont au centre de nos
                        attentions.
                        Aussi, Djok Prestige SAS s'engage à respecter la législation en vigueur en matière de protection
                        de la vie privée et des données personnelles et, en particulier, le règlement européen sur la
                        protection des données personnelles (RGPD) du 20 juin 2018.
                    </p>
                </div>

                <!-- Objectif -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Objectif de la présente politique</h2>
                    <p class="text-gray-700">
                        Djok Prestige SAS souhaite informer les « Utilisateurs » de la manière dont nous protégeons les
                        données à caractère personnel (ci-après les « Données Personnelles »), étant entendu que toute
                        information relative à une personne physique identifiée ou qui peut être identifiée, directement
                        ou indirectement, par référence à un numéro d'identification ou à un ou plusieurs éléments qui
                        lui sont propres est considérée comme une Donnée Personnelle.
                    </p>
                </div>

                <!-- Responsable de traitement -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Identité et coordonnées des responsables de
                        traitement</h2>
                    <p class="text-gray-700">
                        Le responsable du traitement est, au sens de la CNIL, la personne qui détermine les moyens et
                        les finalités du traitement. Le sous-traitant est une personne traitant des données à caractère
                        personnel pour le compte du responsable du traitement.
                    </p>
                    <div class="p-4 mt-4 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            <strong>Responsable du traitement :</strong><br>
                            Djok Prestige SAS<br>
                            66 Avenue des Champs Élysées, 75008 Paris<br>
                            SIRET : 90326843100017<br>
                            Email : contact@djokprestige.com
                        </p>
                    </div>
                </div>

                <!-- Collecte des données -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Collecte et origine des données</h2>
                    <p class="text-gray-700">
                        Toutes les données « Utilisateurs » sont collectées directement auprès de ces derniers. Djok
                        Prestige SAS s'engage à recueillir le consentement des « Utilisateurs » et/ou à leur permettre
                        de s'opposer à l'utilisation de leurs « Données Personnelles » pour certaines finalités, dès que
                        cela est nécessaire.
                    </p>
                </div>

                <!-- Finalités -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Finalités des données collectées</h2>

                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Nécessité de la collecte</h3>
                    <p class="mb-4 text-gray-700">
                        Lors de sa consultation du site www.djokprestige.com ou de son inscription, un « Utilisateur »
                        peut être amené à remplir un formulaire en ligne. Ce formulaire est limité aux données
                        strictement nécessaires au traitement de sa demande par Djok Prestige SAS.
                    </p>

                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Finalités principales</h3>
                    <ul class="space-y-2 text-gray-700 list-disc list-inside">
                        <li>Traitement des demandes de renseignements</li>
                        <li>Inscription aux formations</li>
                        <li>Gestion des réservations de services</li>
                        <li>Envoi d'informations commerciales (avec consentement)</li>
                        <li>Amélioration de nos services</li>
                    </ul>
                </div>

                <!-- Données collectées -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Données personnelles collectées</h2>
                    <p class="mb-4 text-gray-700">
                        Les catégories de données personnelles que nous pouvons collecter incluent :
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 rounded-lg bg-gray-50">
                            <h4 class="mb-2 font-semibold text-gray-800">Données d'identification</h4>
                            <ul class="space-y-1 text-sm text-gray-700 list-disc list-inside">
                                <li>Nom et prénom</li>
                                <li>Adresse email</li>
                                <li>Numéro de téléphone</li>
                                <li>Adresse postale</li>
                            </ul>
                        </div>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <h4 class="mb-2 font-semibold text-gray-800">Données professionnelles</h4>
                            <ul class="space-y-1 text-sm text-gray-700 list-disc list-inside">
                                <li>CV et expérience professionnelle</li>
                                <li>Documents d'identité</li>
                                <li>Permis de conduire</li>
                                <li>Justificatifs de domicile</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Durée de conservation -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Durée de conservation des données</h2>
                    <p class="text-gray-700">
                        Nous conservons vos données uniquement le temps nécessaire pour les finalités poursuivies,
                        conformément aux prescriptions légales et réglementaires.
                    </p>
                    <div class="p-4 mt-4 rounded-lg bg-gray-50">
                        <p class="text-sm text-gray-700">
                            <strong>Exemples de durées de conservation :</strong><br>
                            • Données de prospect : 3 ans à partir du dernier contact<br>
                            • Données client : durée de la relation contractuelle + 5 ans<br>
                            • Données comptables : 10 ans<br>
                            • Cookies : 13 mois maximum
                        </p>
                    </div>
                </div>

                <!-- Droits des utilisateurs -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Droits des Utilisateurs</h2>
                    <p class="mb-4 text-gray-700">
                        Conformément à la réglementation européenne en vigueur, les « Utilisateurs » disposent des
                        droits suivants :
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 rounded-lg bg-blue-50">
                            <h4 class="mb-2 font-semibold text-blue-800">Droits principaux</h4>
                            <ul class="space-y-2 text-sm text-blue-700 list-none">
                                <li>✓ Droit d'accès et de rectification</li>
                                <li>✓ Droit à l'effacement</li>
                                <li>✓ Droit à la limitation du traitement</li>
                                <li>✓ Droit d'opposition</li>
                            </ul>
                        </div>
                        <div class="p-4 rounded-lg bg-green-50">
                            <h4 class="mb-2 font-semibold text-green-800">Droits spécifiques</h4>
                            <ul class="space-y-2 text-sm text-green-700 list-none">
                                <li>✓ Droit à la portabilité des données</li>
                                <li>✓ Droit de retirer son consentement</li>
                                <li>✓ Droit de définir des directives post-mortem</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Exercice des droits -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Exercice de vos droits</h2>
                    <p class="text-gray-700">
                        Pour exercer vos droits ou pour toute question concernant le traitement de vos données
                        personnelles, vous pouvez nous contacter :
                    </p>
                    <div class="p-6 mt-4 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            <strong>Par email :</strong> contact@djokprestige.com<br>
                            <strong>Par courrier :</strong> Djok Prestige SAS<br>
                            66 Avenue des Champs Élysées<br>
                            75008 Paris, France
                        </p>
                        <p class="mt-3 text-sm text-gray-700">
                            Nous nous engageons à répondre dans un délai d'un mois suivant la réception de votre
                            demande. Ce délai peut être prolongé de deux mois compte tenu de la complexité et du nombre
                            de demandes.
                        </p>
                    </div>
                </div>

                <!-- Sécurité -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Sécurité des données</h2>
                    <p class="text-gray-700">
                        Djok Prestige SAS met en œuvre toutes les mesures techniques et organisationnelles afin
                        d'assurer la sécurité des traitements de « Données Personnelles » et la confidentialité de
                        Données Personnelles.
                    </p>
                    <p class="mt-3 text-gray-700">
                        Nous prenons toutes les précautions utiles, au regard de la nature des données et des risques
                        présentés par le traitement, afin de préserver la sécurité des données et, notamment, d'empêcher
                        qu'elles soient déformées, endommagées, ou que des tiers non autorisés y aient accès.
                    </p>
                </div>

                <!-- Cookies -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Cookies et traceurs</h2>
                    <p class="text-gray-700">
                        Un « cookie » est un petit fichier d'information envoyé sur le navigateur de l' « Utilisateur »
                        et enregistré au sein du terminal de l' « Utilisateur ». Djok Prestige SAS est susceptible de
                        traiter les informations de l' « Utilisateur » concernant sa visite du site, telles que les
                        pages consultées, les recherches effectuées.
                    </p>
                    <p class="mt-3 text-gray-700">
                        Vous pouvez configurer votre navigateur pour refuser les cookies. Cependant, certaines
                        fonctionnalités du site pourraient ne pas fonctionner correctement sans cookies.
                    </p>
                </div>

                <!-- Contact DPO -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Contact Délégué à la Protection des Données</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            Pour toute question relative à la protection de vos données personnelles, vous pouvez
                            contacter notre délégué à la protection des données (DPO) :
                        </p>
                        <p class="mt-3 text-gray-700">
                            <strong>Email :</strong> dpo@djokprestige.com<br>
                            <strong>Courrier :</strong> Délégué à la Protection des Données<br>
                            Djok Prestige SAS<br>
                            66 Avenue des Champs Élysées<br>
                            75008 Paris, France
                        </p>
                    </div>
                </div>

                <!-- Réclamation CNIL -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">Réclamation auprès de la CNIL</h2>
                    <p class="text-gray-700">
                        Si vous estimez, après nous avoir contactés, que vos droits « Informatique et Libertés » ne sont
                        pas respectés, vous pouvez adresser une réclamation à la Commission Nationale de l'Informatique
                        et des Libertés (CNIL).
                    </p>
                    <div class="p-4 mt-4 rounded-lg bg-yellow-50">
                        <p class="text-sm text-yellow-800">
                            <strong>Commission Nationale de l'Informatique et des Libertés (CNIL)</strong><br>
                            3 Place de Fontenoy<br>
                            TSA 80715<br>
                            75334 PARIS CEDEX 07<br>
                            Téléphone : +33 1 53 73 22 22<br>
                            Site web : www.cnil.fr
                        </p>
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
