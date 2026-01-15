@extends('layouts.main')

@section('title', __('rgpd.title'))

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">{{ __('rgpd.main_title') }}</h1>

            <div class="space-y-8 prose prose-lg max-w-none">
                <!-- Introduction -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.introduction.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.introduction.content') }}
                    </p>
                </div>

                <!-- Objectif -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.objectif.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.objectif.content') }}
                    </p>
                </div>

                <!-- Responsable de traitement -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.responsable_traitement.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.responsable_traitement.content') }}
                    </p>
                    <div class="p-4 mt-4 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            <strong>{{ __('rgpd.responsable_traitement.responsable.title') }}</strong><br>
                            {{ __('rgpd.responsable_traitement.responsable.nom') }}<br>
                            {{ __('rgpd.responsable_traitement.responsable.adresse') }}<br>
                            {{ __('rgpd.responsable_traitement.responsable.siret') }}<br>
                            {{ __('rgpd.responsable_traitement.responsable.email') }}
                        </p>
                    </div>
                </div>

                <!-- Collecte des données -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.collecte_donnees.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.collecte_donnees.content') }}
                    </p>
                </div>

                <!-- Finalités -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.finalites.title') }}</h2>

                    <h3 class="mb-3 text-lg font-semibold text-gray-800">{{ __('rgpd.finalites.necessite.title') }}</h3>
                    <p class="mb-4 text-gray-700">
                        {{ __('rgpd.finalites.necessite.content') }}
                    </p>

                    <h3 class="mb-3 text-lg font-semibold text-gray-800">{{
                        __('rgpd.finalites.finalites_principales.title') }}</h3>
                    <ul class="space-y-2 text-gray-700 list-disc list-inside">
                        @foreach (__('rgpd.finalites.finalites_principales.items') as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>

                <!-- Données collectées -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.donnees_collectees.title') }}</h2>
                    <p class="mb-4 text-gray-700">
                        {{ __('rgpd.donnees_collectees.intro') }}
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 rounded-lg bg-gray-50">
                            <h4 class="mb-2 font-semibold text-gray-800">{{
                                __('rgpd.donnees_collectees.identification.title') }}</h4>
                            <ul class="space-y-1 text-sm text-gray-700 list-disc list-inside">
                                @foreach (__('rgpd.donnees_collectees.identification.items') as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <h4 class="mb-2 font-semibold text-gray-800">{{
                                __('rgpd.donnees_collectees.professionnelles.title') }}</h4>
                            <ul class="space-y-1 text-sm text-gray-700 list-disc list-inside">
                                @foreach (__('rgpd.donnees_collectees.professionnelles.items') as $item)
                                <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Durée de conservation -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.duree_conservation.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.duree_conservation.content') }}
                    </p>
                    <div class="p-4 mt-4 rounded-lg bg-gray-50">
                        <p class="text-sm text-gray-700">
                            <strong>{{ __('rgpd.duree_conservation.exemples.title') }}</strong><br>
                            • {{ __('rgpd.duree_conservation.exemples.items.0') }}<br>
                            • {{ __('rgpd.duree_conservation.exemples.items.1') }}<br>
                            • {{ __('rgpd.duree_conservation.exemples.items.2') }}<br>
                            • {{ __('rgpd.duree_conservation.exemples.items.3') }}
                        </p>
                    </div>
                </div>

                <!-- Droits des utilisateurs -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.droits_utilisateurs.title') }}</h2>
                    <p class="mb-4 text-gray-700">
                        {{ __('rgpd.droits_utilisateurs.intro') }}
                    </p>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 rounded-lg bg-blue-50">
                            <h4 class="mb-2 font-semibold text-blue-800">{{
                                __('rgpd.droits_utilisateurs.droits_principaux.title') }}</h4>
                            <ul class="space-y-2 text-sm text-blue-700 list-none">
                                @foreach (__('rgpd.droits_utilisateurs.droits_principaux.items') as $item)
                                <li>✓ {{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-4 rounded-lg bg-green-50">
                            <h4 class="mb-2 font-semibold text-green-800">{{
                                __('rgpd.droits_utilisateurs.droits_specifiques.title') }}</h4>
                            <ul class="space-y-2 text-sm text-green-700 list-none">
                                @foreach (__('rgpd.droits_utilisateurs.droits_specifiques.items') as $item)
                                <li>✓ {{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Exercice des droits -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.exercice_droits.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.exercice_droits.content') }}
                    </p>
                    <div class="p-6 mt-4 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            <strong>{{ __('rgpd.exercice_droits.contact.email') }}</strong> {{
                            __('rgpd.exercice_droits.contact.email_value') }}<br>
                            <strong>{{ __('rgpd.exercice_droits.contact.courrier') }}</strong> {{
                            __('rgpd.exercice_droits.contact.courrier_value') }}<br>
                            {{ __('rgpd.exercice_droits.contact.adresse') }}<br>
                            {{ __('rgpd.exercice_droits.contact.ville') }}
                        </p>
                        <p class="mt-3 text-sm text-gray-700">
                            {{ __('rgpd.exercice_droits.delai') }}
                        </p>
                    </div>
                </div>

                <!-- Sécurité -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.securite.title') }}</h2>
                    @foreach (__('rgpd.securite.contents') as $paragraph)
                    <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                        {{ $paragraph }}
                    </p>
                    @endforeach
                </div>

                <!-- Cookies -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.cookies.title') }}</h2>
                    @foreach (__('rgpd.cookies.contents') as $paragraph)
                    <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                        {{ $paragraph }}
                    </p>
                    @endforeach
                </div>

                <!-- Contact DPO -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.dpo.title') }}</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            {{ __('rgpd.dpo.intro') }}
                        </p>
                        <p class="mt-3 text-gray-700">
                            <strong>{{ __('rgpd.dpo.details.email') }}</strong> {{ __('rgpd.dpo.details.email_value')
                            }}<br>
                            <strong>{{ __('rgpd.dpo.details.courrier') }}</strong> {{
                            __('rgpd.dpo.details.courrier_value') }}<br>
                            {{ __('rgpd.dpo.details.societe') }}<br>
                            {{ __('rgpd.dpo.details.adresse') }}<br>
                            {{ __('rgpd.dpo.details.ville') }}
                        </p>
                    </div>
                </div>

                <!-- Réclamation CNIL -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('rgpd.reclamation_cnil.title') }}</h2>
                    <p class="text-gray-700">
                        {{ __('rgpd.reclamation_cnil.content') }}
                    </p>
                    <div class="p-4 mt-4 rounded-lg bg-yellow-50">
                        <p class="text-sm text-yellow-800">
                            <strong>{{ __('rgpd.reclamation_cnil.cnil_details.nom') }}</strong><br>
                            {{ __('rgpd.reclamation_cnil.cnil_details.adresse1') }}<br>
                            {{ __('rgpd.reclamation_cnil.cnil_details.adresse2') }}<br>
                            {{ __('rgpd.reclamation_cnil.cnil_details.adresse3') }}<br>
                            {{ __('rgpd.reclamation_cnil.cnil_details.telephone') }}<br>
                            {{ __('rgpd.reclamation_cnil.cnil_details.site_web') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6 mt-12 rounded-lg bg-gray-50">
                <p class="text-sm text-center text-gray-600">
                    <strong>{{ __('rgpd.footer.last_update') }}</strong> {{ __('rgpd.footer.last_update_date') }}<br>
                    {{ __('rgpd.footer.company_info') }}
                </p>

                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        {{ __('rgpd.back_to_home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
