@extends('layouts.main')

@section('title', __('about.title'))

@section('content')
<!-- Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
            alt="{{ __('about.hero_title') }}" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <!-- Hero Content -->
    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                {{ __('about.hero_title') }}
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-12 max-w-3xl mx-auto">
                {{ __('about.hero_subtitle') }}
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#mission"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center transition duration-300 hover:scale-105"
                    style="background: var(--gold); color: black;">
                    {{ __('about.our_mission') }}
                </a>
                <a href="#histoire"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center border transition duration-300 hover:scale-105"
                    style="border-color: var(--gold); color: var(--gold);">
                    {{ __('about.our_history') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#mission" class="text-white transition duration-300 hover:text-var(--gold)" aria-label="{{ __('about.scroll_down') }}">
            <i class="text-xl fas fa-chevron-down animate-bounce"></i>
        </a>
    </div>
</header>

<!-- Mission Section - Style sobre -->
<section id="mission" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{ __('about.mission_title') }}</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    {{ __('about.mission_description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Excellence -->
                <div class="p-8 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg mb-6"
                            style="background: var(--gold);">
                            <i class="fas fa-medal text-black text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4" style="color: white;">{{ __('about.value_excellence') }}</h3>
                        <p class="text-gray-400">{{ __('about.value_excellence_desc') }}</p>
                    </div>
                </div>

                <!-- Accompagnement -->
                <div class="p-8 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg mb-6"
                            style="background: var(--gold);">
                            <i class="fas fa-hands-helping text-black text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4" style="color: white;">{{ __('about.value_support') }}</h3>
                        <p class="text-gray-400">{{ __('about.value_support_desc') }}</p>
                    </div>
                </div>

                <!-- Partenariat -->
                <div class="p-8 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg mb-6"
                            style="background: var(--gold);">
                            <i class="fas fa-handshake text-black text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4" style="color: white;">{{ __('about.value_partnership') }}</h3>
                        <p class="text-gray-400">{{ __('about.value_partnership_desc') }}</p>
                    </div>
                </div>

                <!-- Durabilité -->
                <div class="p-8 transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg mb-6"
                            style="background: var(--gold);">
                            <i class="fas fa-leaf text-black text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4" style="color: white;">{{ __('about.value_sustainability') }}</h3>
                        <p class="text-gray-400">{{ __('about.value_sustainability_desc') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Histoire Section - Style sobre -->
<!-- Histoire Section - Style sobre -->
<section id="histoire" class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{ __('about.history_title')
                    }}</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    {{ __('about.history_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Timeline -->
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="space-y-8">
                        <!-- 2020 -->
                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                    style="background: var(--gold);">
                                    <span class="font-bold text-black text-lg">{{ __('about.timeline_2020') }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                    style="color: white;">{{ __('about.timeline_2020_title') }}</h3>
                                <p class="text-gray-400">{{ __('about.timeline_2020_desc') }}</p>
                            </div>
                        </div>

                        <!-- 2021 -->
                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                    style="background: var(--gold);">
                                    <span class="font-bold text-black text-lg">{{ __('about.timeline_2021') }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                    style="color: white;">{{ __('about.timeline_2021_title') }}</h3>
                                <p class="text-gray-400">{{ __('about.timeline_2021_desc') }}</p>
                            </div>
                        </div>

                        <!-- 2022 -->
                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                    style="background: var(--gold);">
                                    <span class="font-bold text-black text-lg">{{ __('about.timeline_2022') }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                    style="color: white;">{{ __('about.timeline_2022_title') }}</h3>
                                <p class="text-gray-400">{{ __('about.timeline_2022_desc') }}</p>
                            </div>
                        </div>

                        <!-- 2024 -->
                        <div class="flex items-start space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                    style="background: var(--gold);">
                                    <span class="font-bold text-black text-lg">{{ __('about.timeline_2024') }}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                    style="color: white;">{{ __('about.timeline_2024_title') }}</h3>
                                <p class="text-gray-400">{{ __('about.timeline_2024_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Valeurs Qualitatives -->
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <div class="flex flex-col items-center justify-center h-full">
                        <div class="w-28 h-28 flex items-center justify-center rounded-full mb-8"
                            style="background: rgba(202, 162, 77, 0.1);">
                            <i class="text-5xl fas fa-medal" style="color: var(--gold);"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-center" style="color: white;">{{
                            __('about.commitment_title') }}</h3>
                        <p class="text-gray-300 text-center mb-8 max-w-xl">
                            {{ __('about.commitment_description') }}
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 w-full">
                            <!-- Accompagnement personnalisé -->
                            <div class="p-5 md:p-6 transition-all duration-300 hover:scale-105 flex flex-col h-full"
                                style="background: #111; border: 1px solid #333;">
                                <div class="flex items-start h-full">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-lg"
                                            style="background: var(--gold);">
                                            <i class="fas fa-user-friends text-black text-base md:text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h4 class="text-base md:text-lg font-bold mb-2 leading-tight"
                                            style="color: white;">
                                            {{ __('about.commitment_personalized') }}
                                        </h4>
                                        <p class="text-xs md:text-sm text-gray-400 break-words">
                                            {{ __('about.commitment_personalized_desc') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Formations certifiées -->
                            <div class="p-5 md:p-6 transition-all duration-300 hover:scale-105 flex flex-col h-full"
                                style="background: #111; border: 1px solid #333;">
                                <div class="flex items-start h-full">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-lg"
                                            style="background: var(--gold);">
                                            <i class="fas fa-certificate text-black text-base md:text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h4 class="text-base md:text-lg font-bold mb-2 leading-tight"
                                            style="color: white;">
                                            {{ __('about.commitment_certified') }}
                                        </h4>
                                        <p class="text-xs md:text-sm text-gray-400 break-words">
                                            {{ __('about.commitment_certified_desc') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Engagement qualité -->
                            <div class="p-5 md:p-6 transition-all duration-300 hover:scale-105 flex flex-col h-full"
                                style="background: #111; border: 1px solid #333;">
                                <div class="flex items-start h-full">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-lg"
                                            style="background: var(--gold);">
                                            <i class="fas fa-star text-black text-base md:text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h4 class="text-base md:text-lg font-bold mb-2 leading-tight"
                                            style="color: white;">
                                            {{ __('about.commitment_quality') }}
                                        </h4>
                                        <p class="text-xs md:text-sm text-gray-400 break-words">
                                            {{ __('about.commitment_quality_desc') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Satisfaction au cœur -->
                            <div class="p-5 md:p-6 transition-all duration-300 hover:scale-105 flex flex-col h-full"
                                style="background: #111; border: 1px solid #333;">
                                <div class="flex items-start h-full">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-lg"
                                            style="background: var(--gold);">
                                            <i class="fas fa-heart text-black text-base md:text-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 overflow-hidden">
                                        <h4 class="text-base md:text-lg font-bold mb-2 leading-tight"
                                            style="color: white;">
                                            {{ __('about.commitment_satisfaction') }}
                                        </h4>
                                        <p class="text-xs md:text-sm text-gray-400 break-words">
                                            {{ __('about.commitment_satisfaction_desc') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Équipe Section - Style sobre -->
{{-- <section class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{ __('about.team_title') }}</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    {{ __('about.team_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Djibril Kone -->
                <div class="p-8 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="w-24 h-24 flex items-center justify-center rounded-full mx-auto mb-6 transition-all duration-300 hover:scale-110 hover:rotate-12"
                        style="background: var(--gold);">
                        <i class="fas fa-user-tie text-black text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: white;">{{ __('about.member_djibril') }}</h3>
                    <p class="text-gray-400 mb-4">{{ __('about.member_djibril_role') }}</p>
                    <div class="mt-6">
                        <div class="w-16 h-1 mx-auto" style="background: var(--gold);"></div>
                    </div>
                </div>

                <!-- Sarah Martin -->
                <div class="p-8 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="w-24 h-24 flex items-center justify-center rounded-full mx-auto mb-6 transition-all duration-300 hover:scale-110 hover:rotate-12"
                        style="background: var(--gold);">
                        <i class="fas fa-user-graduate text-black text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: white;">{{ __('about.member_sarah') }}</h3>
                    <p class="text-gray-400 mb-4">{{ __('about.member_sarah_role') }}</p>
                    <div class="mt-6">
                        <div class="w-16 h-1 mx-auto" style="background: var(--gold);"></div>
                    </div>
                </div>

                <!-- Ahmed Benali -->
                <div class="p-8 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="w-24 h-24 flex items-center justify-center rounded-full mx-auto mb-6 transition-all duration-300 hover:scale-110 hover:rotate-12"
                        style="background: var(--gold);">
                        <i class="fas fa-chart-line text-black text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: white;">{{ __('about.member_ahmed') }}</h3>
                    <p class="text-gray-400 mb-4">{{ __('about.member_ahmed_role') }}</p>
                    <div class="mt-6">
                        <div class="w-16 h-1 mx-auto" style="background: var(--gold);"></div>
                    </div>
                </div>

                <!-- Marie Dubois -->
                <div class="p-8 text-center transition-all duration-300 hover:scale-105 hover:shadow-xl"
                    style="background: #111; border: 1px solid #333;">
                    <div class="w-24 h-24 flex items-center justify-center rounded-full mx-auto mb-6 transition-all duration-300 hover:scale-110 hover:rotate-12"
                        style="background: var(--gold);">
                        <i class="fas fa-cogs text-black text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3" style="color: white;">{{ __('about.member_marie') }}</h3>
                    <p class="text-gray-400 mb-4">{{ __('about.member_marie_role') }}</p>
                    <div class="mt-6">
                        <div class="w-16 h-1 mx-auto" style="background: var(--gold);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!-- Vision Section - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{ __('about.vision_title') }}</h2>
                <p class="text-lg text-gray-300 max-w-3xl mx-auto">
                    {{ __('about.vision_subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Colonne 1 -->
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <!-- Innovation Continue -->
                    <div class="flex items-start space-x-6 mb-8 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-eye text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">{{ __('about.vision_innovation') }}</h3>
                            <p class="text-gray-400">
                                {{ __('about.vision_innovation_desc') }}
                            </p>
                        </div>
                    </div>

                    <!-- Développement Africain -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-globe-africa text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">{{ __('about.vision_africa') }}</h3>
                            <p class="text-gray-400">
                                {{ __('about.vision_africa_desc') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Colonne 2 -->
                <div class="p-8" style="background: #1a1a1a; border: 1px solid #333;">
                    <!-- Excellence & Qualité -->
                    <div class="flex items-start space-x-6 mb-8 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-award text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">{{ __('about.vision_quality') }}</h3>
                            <p class="text-gray-400">
                                {{ __('about.vision_quality_desc') }}
                            </p>
                        </div>
                    </div>

                    <!-- Partenariats Durables -->
                    <div class="flex items-start space-x-6 group">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 flex items-center justify-center rounded-lg transition-all duration-300 group-hover:scale-110"
                                style="background: var(--gold);">
                                <i class="fas fa-handshake text-black text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-3 group-hover:text-var(--gold) transition-colors duration-300"
                                style="color: white;">{{ __('about.vision_partnerships') }}</h3>
                            <p class="text-gray-400">
                                {{ __('about.vision_partnerships_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto text-center p-10" style="background: #1a1a1a; border: 1px solid #333;">
            <h2 class="text-2xl md:text-3xl font-bold mb-6" style="color: var(--gold);">
                {{ __('about.cta_title') }}
            </h2>
            <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
                {{ __('about.cta_description') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="w-full sm:w-auto px-8 py-4 font-semibold text-center transition-all duration-300 hover:scale-105"
                    style="background: var(--gold); color: black;">
                    {{ __('about.contact_us') }}
                </a>
                <a href="{{ route('formation') }}"
                    class="w-full sm:w-auto px-8 py-4 font-semibold text-center border transition-all duration-300 hover:scale-105"
                    style="border-color: var(--gold); color: var(--gold);">
                    {{ __('about.view_trainings') }}
                </a>
            </div>
            <p class="text-gray-500 text-sm mt-6">
                <i class="fas fa-phone-alt mr-2"></i>
                {{ str_replace(':phone', __('common.phone'), __('about.contact_phone')) }}
            </p>
        </div>
    </div>
</section>

<!-- Les styles CSS restent exactement les mêmes -->

<style>
    /* Animations d'apparition au scroll */
    .section-animate {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .section-animate.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Styles pour les cartes */
    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: translateY(-5px);
    }

    /* Animation du scroll indicator */
    .animate-bounce {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-10px);
        }

        60% {
            transform: translateY(-5px);
        }
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        section {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .p-8 {
            padding: 1.5rem;
        }

        .grid {
            gap: 1.5rem;
        }
    }

    @media (max-width: 640px) {
        h1 {
            font-size: 2rem !important;
        }

        h2 {
            font-size: 1.75rem !important;
        }

        .text-lg {
            font-size: 1rem;
        }
    }

/* Force le wrap des mots longs */
.break-words {
word-wrap: break-word;
overflow-wrap: break-word;
}

/* Assure une hauteur uniforme pour toutes les cartes */
.h-full {
height: 100%;
}

/* Ajustements pour les grands écrans */
@media (min-width: 1536px) {
.max-w-6xl {
max-width: 72rem;
}

.gap-4 {
gap: 1.5rem;
}

.p-5 {
padding: 1.5rem;
}
}

/* Pour les très petits écrans */
@media (max-width: 640px) {
.text-base {
font-size: 0.875rem;
}

.text-xs {
font-size: 0.75rem;
}

.mr-4 {
margin-right: 0.75rem;
}
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const target = document.querySelector(targetId);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animation d'apparition des sections au scroll
        const sections = document.querySelectorAll('section');

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            section.classList.add('section-animate');
            observer.observe(section);
        });

        // Animation pour les cartes au hover
        const cards = document.querySelectorAll('.p-8, .p-6');
        cards.forEach(card => {
            card.classList.add('hover-scale');
        });
    });
</script>
@endsection
