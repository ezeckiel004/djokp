@extends('layouts.main')

@section('title', trans('international.title'))

@section('content')
<!-- Message de succès - Style sobre -->
@if(session('success'))
<div id="success-alert" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-2xl">
    <div class="mx-4 p-4" style="background: #064e3b; border-left: 4px solid #10b981;">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full" style="background: #047857;">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-semibold text-white">{{ trans('international.success_title') }}</h3>
                    <div class="mt-1 text-green-100">
                        <p>{{ session('success') }}</p>
                        @if(session('email'))
                        <p class="text-sm mt-1">
                            {!! trans('international.confirmation_email', ['email' => session('email')]) !!}
                        </p>
                        @endif
                        <p class="text-sm mt-1">
                            {{ trans('international.contact_soon') }}
                        </p>
                    </div>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('success-alert').remove();"
                class="text-green-300 hover:text-white" aria-label="{{ trans('international.close_alert') }}">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alert.remove(), 500);
        }
    }, 10000);
</script>
@endif

<!-- Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
            alt="{{ trans('international.hero_title') }}" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                {{ trans('international.hero_title') }}
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12">
                {{ trans('international.hero_description') }}
            </p>

            <!-- Boutons - Style sobre -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#formations"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    {{ trans('international.discover_formations') }}
                </a>
                <a href="#accompagnement"
                    class="w-full sm:w-auto px-8 py-3 font-semibold text-center border transition duration-300"
                    style="border-color: var(--gold); color: var(--gold);">
                    {{ trans('international.visa_accompaniment') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#formations" class="text-white transition duration-300 hover:text-var(--gold)"
            aria-label="{{ trans('international.scroll_down') }}">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Domaines de formation - Style sobre -->
<section id="formations" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{
                trans('international.formation_domains') }}</h2>
        </div>

        <!-- Formations principales -->
        <div class="mb-16">
            <h3 class="text-2xl font-semibold text-center mb-8" style="color: white;">{{
                trans('international.main_formations') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                $formations = App\Models\Formation::where('is_active', true)
                ->whereIn('categorie', ['international', 'vtc_theorique', 'vtc_pratique'])
                ->take(6)
                ->get();
                @endphp

                @if($formations->count() > 0)
                @foreach($formations as $formation)
                <div class="p-6" style="background: #111; border: 1px solid #333;">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 flex items-center justify-center rounded-lg"
                                style="background: var(--gold);">
                                <i class="fas fa-graduation-cap text-black"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold mb-2" style="color: white;">{{ $formation->title }}</h4>
                            <p class="text-gray-400">{{ Str::limit($formation->description, 100) }}</p>
                            <div class="mt-2 text-sm text-gray-500">
                                <span class="font-semibold">{{ $formation->duration_hours }}h</span>
                                •
                                <span class="font-semibold" style="color: var(--gold);">
                                    {{ number_format($formation->price, 0, ',', ' ') }} €
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                @foreach([
                [trans('international.formation_vtc'), trans('international.formation_vtc_desc')],
                [trans('international.formation_micro_entreprise'),
                trans('international.formation_micro_entreprise_desc')],
                [trans('international.formation_marketing'), trans('international.formation_marketing_desc')],
                [trans('international.formation_business_creation'),
                trans('international.formation_business_creation_desc')],
                [trans('international.formation_bureautique'), trans('international.formation_bureautique_desc')],
                [trans('international.formation_language'), trans('international.formation_language_desc')]
                ] as $formation)
                <div class="p-6" style="background: #111; border: 1px solid #333;">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 flex items-center justify-center rounded-lg"
                                style="background: var(--gold);">
                                <i class="fas fa-graduation-cap text-black"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold mb-2" style="color: white;">{{ $formation[0] }}</h4>
                            <p class="text-gray-400">{{ $formation[1] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <!-- Modules optionnels -->
        <div>
            <h3 class="text-2xl font-semibold text-center mb-8" style="color: white;">{{
                trans('international.optional_modules') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <ul class="space-y-4">
                        @foreach([
                        trans('international.module_leadership'),
                        trans('international.module_personal_development'),
                        trans('international.module_sales'),
                        trans('international.module_finance')
                        ] as $module)
                        <li class="flex items-center p-4" style="background: #111; border: 1px solid #333;">
                            <i class="fas fa-check mr-3" style="color: var(--gold);"></i>
                            <span class="font-medium" style="color: white;">{{ $module }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <ul class="space-y-4">
                        @foreach([
                        trans('international.module_project_management'),
                        trans('international.module_intercultural'),
                        trans('international.module_digital_transformation'),
                        trans('international.module_business_strategy')
                        ] as $module)
                        <li class="flex items-center p-4" style="background: #111; border: 1px solid #333;">
                            <i class="fas fa-check mr-3" style="color: var(--gold);"></i>
                            <span class="font-medium" style="color: white;">{{ $module }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Public visé - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{
                trans('international.target_audience') }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4"
                    style="background: #1e40af;">
                    <i class="fas fa-user-graduate text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">{{ trans('international.students') }}</h3>
                <p class="text-gray-400">{{ trans('international.students_desc') }}</p>
            </div>

            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4"
                    style="background: #065f46;">
                    <i class="fas fa-briefcase text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">{{ trans('international.entrepreneurs') }}</h3>
                <p class="text-gray-400">{{ trans('international.entrepreneurs_desc') }}</p>
            </div>

            <div class="text-center p-6" style="background: #1a1a1a; border: 1px solid #333;">
                <div class="w-16 h-16 flex items-center justify-center rounded-full mx-auto mb-4"
                    style="background: #5b21b6;">
                    <i class="fas fa-building text-white"></i>
                </div>
                <h3 class="text-lg font-bold mb-3" style="color: white;">{{ trans('international.institutions') }}</h3>
                <p class="text-gray-400">{{ trans('international.institutions_desc') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Accompagnement visa - Style sobre -->
<section id="accompagnement" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{
                    trans('international.visa_title') }}</h2>
                <p class="text-gray-400 max-w-3xl mx-auto">
                    {{ trans('international.visa_subtitle') }}
                </p>
            </div>

            <div class="p-6 md:p-8 mb-12" style="background: #111; border: 1px solid #333;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-6" style="color: white;">{{
                            trans('international.documents_provided') }}</h3>
                        <ul class="space-y-4">
                            @foreach([
                            trans('international.document_inscription'),
                            trans('international.document_accommodation'),
                            trans('international.document_payment'),
                            trans('international.document_logistic')
                            ] as $document)
                            <li class="flex items-start">
                                <i class="fas fa-file-alt mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">{{ $document }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-6" style="color: white;">{{
                            trans('international.support_continuous') }}</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fab fa-whatsapp mt-1 mr-3" style="color: #25D366;"></i>
                                <span style="color: white;">{{ trans('international.support_whatsapp') }}</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-plane-arrival mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">{{ trans('international.support_airport') }}</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-map-signs mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">{{ trans('international.support_orientation') }}</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-headset mt-1 mr-3" style="color: #3b82f6;"></i>
                                <span style="color: white;">{{ trans('international.support_247') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="#contact"
                        class="inline-flex items-center px-6 md:px-8 py-3 font-semibold transition-all duration-300"
                        style="background: var(--gold); color: black;">
                        {{ trans('international.visa_button') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pourquoi choisir DJOK PRESTIGE - Style sobre -->
<section class="py-16" style="background: #111;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="text-center mb-12">
            <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: var(--gold);">{{
                trans('international.why_title') }}
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            @foreach([
            [trans('international.why_certified'), 'fas fa-award'],
            [trans('international.why_team'), 'fas fa-users'],
            [trans('international.why_adapted'), 'fas fa-globe-africa'],
            [trans('international.why_accommodation'), 'fas fa-home'],
            [trans('international.why_concierge'), 'fas fa-concierge-bell'],
            [trans('international.why_testimonials'), 'fas fa-video'],
            [trans('international.why_network'), 'fas fa-handshake'],
            [trans('international.why_logistics'), 'fas fa-shipping-fast']
            ] as $avantage)
            <div class="flex flex-col items-center text-center">
                <div class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-full mb-3"
                    style="background: var(--gold);">
                    <i class="{{ $avantage[1] }} text-black text-lg"></i>
                </div>
                <span class="text-xs md:text-sm font-medium" style="color: white;">{{ $avantage[0] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact et inscription - Style sobre -->
<section id="contact" class="py-16" style="background: #000;">
    <div class="container mx-auto px-4 md:px-6">
        <div class="max-w-4xl mx-auto p-6 md:p-8" style="background: #111; border: 1px solid #333;">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-8" style="color: var(--gold);">{{
                trans('international.contact_title') }}</h2>

            @if(session('error'))
            <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;" id="error-message">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3"
                        style="background: #dc2626;">
                        <i class="fas fa-exclamation-circle text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white">{{ trans('international.error_title') }}</h4>
                        <p class="text-red-100">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="p-4 mb-6" style="background: #7f1d1d; border: 1px solid #991b1b;">
                <div class="flex items-center">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full mr-3"
                        style="background: #dc2626;">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white">{{ trans('international.error_correction') }}</h4>
                        <ul class="text-red-100 list-disc list-inside mt-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('formation-internationale.store') }}" method="POST" id="formation-form">
                @csrf

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">{{
                                trans('international.full_name') }}</label>
                            <input type="text" name="nom" required value="{{ old('nom') }}"
                                class="w-full px-4 py-3 rounded @error('nom') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="{{ trans('international.full_name_placeholder') }}">
                            @error('nom')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">{{
                                trans('international.nationality') }}</label>
                            <input type="text" name="nationalite" required value="{{ old('nationalite') }}"
                                class="w-full px-4 py-3 rounded @error('nationalite') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="{{ trans('international.nationality_placeholder') }}">
                            @error('nationalite')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">{{ trans('international.email')
                                }}</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded @error('email') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="{{ trans('international.email_placeholder') }}">
                            @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">{{ trans('international.phone')
                                }}</label>
                            <input type="tel" name="telephone" required value="{{ old('telephone') }}"
                                class="w-full px-4 py-3 rounded @error('telephone') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;"
                                placeholder="{{ trans('international.phone_placeholder') }}">
                            @error('telephone')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">{{ trans('international.whatsapp')
                            }}</label>
                        <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}"
                            class="w-full px-4 py-3 rounded @error('whatsapp') border-red-500 @enderror"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;"
                            placeholder="{{ trans('international.whatsapp_placeholder') }}">
                        @error('whatsapp')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">{{
                            trans('international.formation_type') }}</label>
                        <select name="formation" required
                            class="w-full px-4 py-3 rounded @error('formation') border-red-500 @enderror"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;">
                            <option value="" style="color: #666;">{{ trans('international.select_formation') }}</option>
                            <!-- Formations existantes -->
                            @php
                            $formationsList = App\Models\Formation::where('is_active', true)
                            ->whereIn('categorie', ['international', 'vtc_theorique', 'vtc_pratique', 'e_learning',
                            'renouvellement'])
                            ->get();
                            @endphp

                            @if($formationsList->count() > 0)
                            <optgroup label="{{ trans('international.available_formations') }}">
                                @foreach($formationsList as $formation)
                                <option value="{{ $formation->id }}" {{ old('formation')==$formation->id ? 'selected' :
                                    '' }} style="color: white;">
                                    {{ $formation->title }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endif

                            <optgroup label="{{ trans('international.other_formations') }}">
                                <option value="vtc" {{ old('formation')=='vtc' ? 'selected' : '' }}
                                    style="color: white;">{{ trans('international.formation_vtc_option') }}</option>
                                <option value="micro_entreprise" {{ old('formation')=='micro_entreprise' ? 'selected'
                                    : '' }} style="color: white;">
                                    {{ trans('international.formation_micro_option') }}</option>
                                <option value="marketing" {{ old('formation')=='marketing' ? 'selected' : '' }}
                                    style="color: white;">
                                    {{ trans('international.formation_marketing_option') }}</option>
                                <option value="creation_entreprise" {{ old('formation')=='creation_entreprise'
                                    ? 'selected' : '' }} style="color: white;">
                                    {{ trans('international.formation_business_option') }}</option>
                                <option value="bureautique" {{ old('formation')=='bureautique' ? 'selected' : '' }}
                                    style="color: white;">
                                    {{ trans('international.formation_bureautique_option') }}</option>
                                <option value="langue" {{ old('formation')=='langue' ? 'selected' : '' }}
                                    style="color: white;">{{ trans('international.formation_language_option') }}
                                </option>
                                <option value="personnalise" {{ old('formation')=='personnalise' ? 'selected' : '' }}
                                    style="color: white;">
                                    {{ trans('international.formation_custom') }}</option>
                            </optgroup>
                        </select>
                        @error('formation')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">{{
                            trans('international.services_title') }}</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                            @php
                            $oldServices = old('services', []);
                            @endphp
                            @foreach([
                            trans('international.service_visa'),
                            trans('international.service_accommodation'),
                            trans('international.service_transport'),
                            trans('international.service_concierge'),
                            trans('international.service_insurance'),
                            trans('international.service_internship')
                            ] as $service)
                            <label class="flex items-center p-2 rounded cursor-pointer"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;">
                                <input type="checkbox" name="services[]" value="{{ $service }}" {{ in_array($service,
                                    $oldServices) ? 'checked' : '' }} class="mr-3 rounded" style="border-color: #666;">
                                <span class="text-sm">{{ $service }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium" style="color: #ddd;">{{
                            trans('international.project_title') }}</label>
                        <textarea name="message" rows="4" required
                            class="w-full px-4 py-3 rounded @error('message') border-red-500 @enderror"
                            style="background: #1a1a1a; border: 1px solid #444; color: white;"
                            placeholder="{{ trans('international.project_placeholder') }}">{{ old('message') }}</textarea>
                        @error('message')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">{{
                                trans('international.start_date') }}</label>
                            <input type="date" name="date_debut" value="{{ old('date_debut') }}"
                                class="w-full px-4 py-3 rounded @error('date_debut') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;">
                            @error('date_debut')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 font-medium" style="color: #ddd;">{{
                                trans('international.duration') }}</label>
                            <select name="duree"
                                class="w-full px-4 py-3 rounded @error('duree') border-red-500 @enderror"
                                style="background: #1a1a1a; border: 1px solid #444; color: white;">
                                <option value="" style="color: #666;">{{ trans('international.select_duration') }}
                                </option>
                                <option value="1-2 semaines" {{ old('duree')=='1-2 semaines' ? 'selected' : '' }}
                                    style="color: white;">{{ trans('international.duration_1_2') }}</option>
                                <option value="1 mois" {{ old('duree')=='1 mois' ? 'selected' : '' }}
                                    style="color: white;">{{ trans('international.duration_1_month') }}</option>
                                <option value="3 mois" {{ old('duree')=='3 mois' ? 'selected' : '' }}
                                    style="color: white;">{{ trans('international.duration_3_months') }}</option>
                                <option value="6 mois" {{ old('duree')=='6 mois' ? 'selected' : '' }}
                                    style="color: white;">{{ trans('international.duration_6_months') }}</option>
                                <option value="1 an" {{ old('duree')=='1 an' ? 'selected' : '' }} style="color: white;">
                                    {{ trans('international.duration_1_year') }}</option>
                            </select>
                            @error('duree')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="relative">
                        <button type="submit" id="submit-btn"
                            class="w-full px-6 md:px-8 py-3 font-semibold rounded transition-all duration-300 flex items-center justify-center"
                            style="background: var(--gold); color: black;">
                            <span id="btn-text" class="flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-3"></i>
                                {{ trans('international.submit_button') }}
                            </span>
                            <span id="btn-loading" class="hidden flex items-center justify-center">
                                <i class="fas fa-spinner fa-spin mr-3"></i>
                                {{ trans('international.processing') }}
                            </span>
                        </button>
                    </div>

                    <p class="text-center text-sm mt-4" style="color: #888;">
                        <i class="fas fa-shield-alt mr-2"></i>
                        {{ trans('international.security_notice') }}
                    </p>
                </div>
            </form>
        </div>

        <!-- Contact rapide - Style sobre -->
        <div class="mt-12 max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6" style="background: #111; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: #1e40af;">
                        <i class="fas fa-phone text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">{{
                        trans('international.international_phone') }}</h3>
                    <a href="tel:+33176380017" class="font-semibold hover:text-blue-300" style="color: #60a5fa;">+33 1
                        76 38 00 17</a>
                </div>

                <div class="text-center p-6" style="background: #111; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: #25D366;">
                        <i class="fab fa-whatsapp text-white"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">WhatsApp</h3>
                    <p class="font-semibold" style="color: #86efac;">{{ trans('international.whatsapp_available') }}</p>
                </div>

                <div class="text-center p-6" style="background: #111; border: 1px solid #333;">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full mx-auto mb-4"
                        style="background: var(--gold);">
                        <i class="fas fa-envelope text-black"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-2" style="color: white;">{{ trans('international.email_label') }}
                    </h3>
                    <a href="mailto:international@djokprestige.com" class="font-semibold hover:text-yellow-300"
                        style="color: var(--gold);">
                        international@djokprestige.com
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide des messages d'erreur
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.display = 'none';
            }, 8000);
        }

        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Gestion du formulaire
        const form = document.getElementById('formation-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoading = document.getElementById('btn-loading');

        if (form) {
            form.addEventListener('submit', function() {
                // Désactiver le bouton et montrer le loader
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
            });

            // Si retour avec erreurs, réactiver le bouton
            if (document.querySelector('[class*="border-red"]')) {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        }

        // Scroll vers le formulaire s'il y a des erreurs
        if (document.querySelector('[class*="border-red"]')) {
            setTimeout(() => {
                document.getElementById('contact').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 300);
        }

        // Scroll vers le message de succès s'il existe
        if (document.getElementById('success-alert')) {
            setTimeout(() => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 100);
        }

        // Date minimum pour la date de début
        const dateInput = document.querySelector('input[name="date_debut"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;
        }
    });
</script>
@endsection