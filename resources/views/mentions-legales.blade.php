@extends('layouts.main')

@section('title', __('mentions-legales.title'))

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">{{ __('mentions-legales.main_title') }}</h1>

            <div class="space-y-8 prose prose-lg max-w-none">
                <!-- Propriétaire Rédacteur -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{
                        __('mentions-legales.proprietaire_redacteur.title') }}</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            {{ __('mentions-legales.proprietaire_redacteur.content') }}
                        </p>
                        <ul class="mt-3 space-y-2 text-gray-700">
                            <li><strong>{{ __('mentions-legales.proprietaire_redacteur.details.adresse') }}</strong> {{
                                __('mentions-legales.proprietaire_redacteur.details.adresse_value') }}</li>
                            <li><strong>{{ __('mentions-legales.proprietaire_redacteur.details.siret') }}</strong> {{
                                __('mentions-legales.proprietaire_redacteur.details.siret_value') }}</li>
                            <li><strong>{{ __('mentions-legales.proprietaire_redacteur.details.naf') }}</strong> {{
                                __('mentions-legales.proprietaire_redacteur.details.naf_value') }}</li>
                            <li><strong>{{ __('mentions-legales.proprietaire_redacteur.details.telephone') }}</strong>
                                {{ __('mentions-legales.proprietaire_redacteur.details.telephone_value') }}</li>
                            <li><strong>{{ __('mentions-legales.proprietaire_redacteur.details.email') }}</strong> {{
                                __('mentions-legales.proprietaire_redacteur.details.email_value') }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Hébergeur -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('mentions-legales.hebergeur.title') }}</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            {{ __('mentions-legales.hebergeur.content') }}
                        </p>
                        <ul class="mt-3 space-y-2 text-gray-700">
                            <li><strong>{{ __('mentions-legales.hebergeur.details.societe') }}</strong> {{
                                __('mentions-legales.hebergeur.details.societe_value') }}</li>
                            <li><strong>{{ __('mentions-legales.hebergeur.details.capital') }}</strong> {{
                                __('mentions-legales.hebergeur.details.capital_value') }}</li>
                            <li><strong>{{ __('mentions-legales.hebergeur.details.siret') }}</strong> {{
                                __('mentions-legales.hebergeur.details.siret_value') }}</li>
                            <li><strong>{{ __('mentions-legales.hebergeur.details.rcs') }}</strong> {{
                                __('mentions-legales.hebergeur.details.rcs_value') }}</li>
                            <li><strong>{{ __('mentions-legales.hebergeur.details.siege') }}</strong> {{
                                __('mentions-legales.hebergeur.details.siege_value') }}</li>
                            <li><strong>{{ __('mentions-legales.hebergeur.details.site_web') }}</strong> {{
                                __('mentions-legales.hebergeur.details.site_web_value') }}</li>
                        </ul>
                    </div>
                </div>

                <!-- Propriétés Intellectuelles -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{
                        __('mentions-legales.proprietes_intellectuelles.title') }}</h2>
                    @foreach (__('mentions-legales.proprietes_intellectuelles.contents') as $paragraph)
                    <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                        {{ $paragraph }}
                    </p>
                    @endforeach
                </div>

                <!-- Création de liens -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('mentions-legales.creation_liens.title') }}
                    </h2>
                    @foreach (__('mentions-legales.creation_liens.contents') as $paragraph)
                    <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                        {{ $paragraph }}
                    </p>
                    @endforeach
                </div>

                <!-- Liens externes -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('mentions-legales.liens_externes.title') }}
                    </h2>
                    <p class="text-gray-700">
                        {{ __('mentions-legales.liens_externes.content') }}
                    </p>
                </div>

                <!-- RGPD -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('mentions-legales.rgpd.title') }}</h2>
                    @foreach (__('mentions-legales.rgpd.contents') as $paragraph)
                    <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                        {!! str_replace(
                        ':privacy_policy',
                        '<a href="' . route('rgpd') . '" class="text-blue-600 hover:underline">' .
                            __('mentions-legales.rgpd.privacy_policy') . '</a>',
                        $paragraph
                        ) !!}
                    </p>
                    @endforeach
                </div>

                <!-- Cookies -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('mentions-legales.cookies.title') }}</h2>
                    @foreach (__('mentions-legales.cookies.contents') as $paragraph)
                    <p class="{{ !$loop->first ? 'mt-3' : '' }} text-gray-700">
                        {{ $paragraph }}
                    </p>
                    @endforeach
                </div>

                <!-- Contact -->
                <div>
                    <h2 class="mb-4 text-2xl font-bold text-gray-900">{{ __('mentions-legales.contact.title') }}</h2>
                    <div class="p-6 rounded-lg bg-gray-50">
                        <p class="text-gray-700">
                            {{ __('mentions-legales.contact.content') }}
                        </p>
                        <ul class="mt-3 space-y-2 text-gray-700">
                            <li><strong>{{ __('mentions-legales.contact.details.email') }}</strong> {{
                                __('mentions-legales.contact.details.email_value') }}</li>
                            <li><strong>{{ __('mentions-legales.contact.details.telephone') }}</strong> {{
                                __('mentions-legales.contact.details.telephone_value') }}</li>
                            <li><strong>{{ __('mentions-legales.contact.details.courrier') }}</strong> {{
                                __('mentions-legales.contact.details.courrier_value') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="p-6 mt-12 rounded-lg bg-gray-50">
                <p class="text-sm text-center text-gray-600">
                    <strong>{{ __('mentions-legales.footer.last_update') }}</strong> {{
                    __('mentions-legales.footer.last_update_date') }}<br>
                    {{ __('mentions-legales.footer.company_info') }}
                </p>

                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        {{ __('mentions-legales.back_to_home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
