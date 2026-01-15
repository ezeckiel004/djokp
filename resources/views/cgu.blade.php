@extends('layouts.main')

@section('title', __('cgu.title'))

@section('content')
<div class="min-h-screen py-12 bg-gray-50">
    <div class="max-w-4xl px-4 mx-auto">
        <div class="p-8 bg-white rounded-lg shadow-lg">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">{{ __('cgu.main_title') }}</h1>

            <div class="prose prose-lg max-w-none">
                <p class="mb-6 text-center text-gray-600">
                    {{ __('cgu.subtitle') }}
                </p>

                <div class="space-y-8">
                    <!-- Article 1 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_1') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_1_content') }}
                        </p>
                        <ul class="mt-2 space-y-1 text-gray-700 list-disc list-inside">
                            <li><strong>{{ __('cgu.definitions.site', ['site' => '']) }}</strong></li>
                            <li><strong>{{ __('cgu.definitions.cgu', ['cgu' => '']) }}</strong></li>
                            <li><strong>{{ __('cgu.definitions.contract', ['contract' => '']) }}</strong></li>
                            <li><strong>{{ __('cgu.definitions.services', ['services' => '']) }}</strong></li>
                            <li><strong>{{ __('cgu.definitions.user', ['user' => '']) }}</strong></li>
                        </ul>
                    </div>

                    <!-- Article 2 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_2') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_2_content') }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <strong>{{ __('cgu.company_info.phone') }}</strong> {{ __('cgu.company_info.phone_value')
                            }}<br>
                            <strong>{{ __('cgu.company_info.email') }}</strong> {{ __('cgu.company_info.email_value') }}
                        </p>
                        <p class="mt-2 text-gray-700">
                            <strong>{{ __('cgu.host_info.label') }}</strong> {{ __('cgu.host_info.name') }}<br>
                            {{ __('cgu.host_info.siret') }}<br>
                            {{ __('cgu.host_info.address') }}
                        </p>
                    </div>

                    <!-- Article 3 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_3') }}</h2>
                        @foreach (__('cgu.article_3_contents') as $paragraph)
                        <p class="{{ !$loop->first ? 'mt-2' : '' }} text-gray-700">
                            {{ $paragraph }}
                        </p>
                        @endforeach
                    </div>

                    <!-- Article 4 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_4') }}</h2>
                        @foreach (__('cgu.article_4_contents') as $paragraph)
                        <p class="{{ !$loop->first ? 'mt-2' : '' }} text-gray-700">
                            {{ $paragraph }}
                        </p>
                        @endforeach
                    </div>

                    <!-- Article 5 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_5') }}</h2>
                        @foreach (__('cgu.article_5_contents') as $paragraph)
                        <p class="{{ !$loop->first ? 'mt-2' : '' }} text-gray-700">
                            {{ $paragraph }}
                        </p>
                        @endforeach
                    </div>

                    <!-- Article 6 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_6') }}</h2>

                        <h3 class="mb-3 text-lg font-semibold text-gray-800">{{ __('cgu.section_6_1') }}</h3>
                        <p class="mb-4 text-gray-700">
                            {{ __('cgu.section_6_1_intro') }}
                        </p>
                        <ul class="mb-6 space-y-1 text-gray-700 list-disc list-inside">
                            @foreach (__('cgu.obligations') as $obligation)
                            <li>{{ $obligation }}</li>
                            @endforeach
                        </ul>

                        <h3 class="mb-3 text-lg font-semibold text-gray-800">{{ __('cgu.section_6_2') }}</h3>
                        <p class="text-gray-700">
                            {{ __('cgu.section_6_2_content') }}
                        </p>
                    </div>

                    <!-- Article 7 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_7') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_7_content') }}
                        </p>
                    </div>

                    <!-- Article 8 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_8') }}</h2>
                        @foreach (__('cgu.article_8_contents') as $paragraph)
                        <p class="{{ !$loop->first ? 'mt-2' : '' }} text-gray-700">
                            {{ $paragraph }}
                        </p>
                        @endforeach
                    </div>

                    <!-- Article 9 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_9') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_9_content') }}
                        </p>
                    </div>

                    <!-- Article 10 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_10') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_10_content') }}
                        </p>
                    </div>

                    <!-- Article 11 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_11') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_11_content') }}
                        </p>
                    </div>

                    <!-- Article 12 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_12') }}</h2>
                        <p class="text-gray-700">
                            {{ __('cgu.article_12_content') }}
                        </p>
                    </div>

                    <!-- Article 13 -->
                    <div>
                        <h2 class="mb-4 text-xl font-bold text-gray-900">{{ __('cgu.article_13') }}</h2>
                        @foreach (__('cgu.article_13_contents') as $paragraph)
                        <p class="{{ !$loop->first ? 'mt-2' : '' }} text-gray-700">
                            {{ $paragraph }}
                        </p>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 mt-12 rounded-lg bg-gray-50">
                    <p class="text-sm text-gray-600">
                        <strong>{{ __('cgu.footer.last_update') }}</strong> {{ __('cgu.footer.last_update_date') }}<br>
                        <strong>{{ __('cgu.footer.contact') }}</strong> {{ __('cgu.footer.contact_email') }}<br>
                        <strong>{{ __('cgu.footer.phone') }}</strong> {{ __('cgu.footer.phone_number') }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            {{ __('cgu.back_to_home') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
