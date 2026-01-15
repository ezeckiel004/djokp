@extends('layouts.main')

@section('title', __('blog.title'))

@section('content')
<!-- Header Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80"
            alt="{{ __('blog.hero_title') }}" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                {{ __('blog.hero_title') }}
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12">
                {{ __('blog.hero_description') }}
            </p>

            <!-- Bouton - Style sobre -->
            <div class="animate-fade-in-up" style="animation-delay: 0.6s;">
                <a href="#articles"
                    class="inline-flex items-center px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    {{ __('blog.discover_articles') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#articles" class="text-white transition duration-300 hover:text-var(--gold)"
            aria-label="{{ __('blog.scroll_down') }}">
            <i class="text-xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Search and Categories - Style sobre -->
<div class="container mx-auto py-12 px-4 md:px-6" style="background: #000;">
    <div class="flex flex-col lg:flex-row justify-between items-center gap-6 mb-12">
        <!-- Live Search -->
        <div class="w-full lg:w-1/2">
            <div class="relative">
                <input type="text" disabled placeholder="{{ __('blog.search_placeholder') }}"
                    class="w-full p-4 pl-12 border rounded focus:outline-none transition duration-300"
                    style="background: #111; border-color: #444; color: white;"
                    aria-label="{{ __('blog.search_articles') }}">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2"
                    style="color: var(--gold);"></i>
            </div>
        </div>

        <!-- Filtres services - Style sobre -->
        <div class="flex flex-wrap gap-3 justify-center lg:justify-end"
            aria-label="{{ __('blog.filter_by_category') }}">
            @foreach([
            'location' => ['color' => 'var(--gold)', 'bg_opacity' => 0.1, 'border_opacity' => 0.3],
            'vtc-transport' => ['color' => '#60a5fa', 'bg_opacity' => 0.1, 'border_opacity' => 0.3],
            'conciergerie' => ['color' => '#86efac', 'bg_opacity' => 0.1, 'border_opacity' => 0.3],
            'formation' => ['color' => '#c4b5fd', 'bg_opacity' => 0.1, 'border_opacity' => 0.3]
            ] as $category => $style)
            <a href="{{ route('blog.category', $category) }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                style="background: rgba({{ $style['color'] == 'var(--gold)' ? 'var(--gold-rgb)' : hexToRgb($style['color']) }}, {{ $style['bg_opacity'] }});
                       color: {{ $style['color'] }};
                       border: 1px solid rgba({{ $style['color'] == 'var(--gold)' ? 'var(--gold-rgb)' : hexToRgb($style['color']) }}, {{ $style['border_opacity'] }});">
                {{ __("blog.category_{$category}") }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Articles à la une - Style sobre -->
    @if($featuredArticles->count() > 0)
    <section id="articles" class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center" style="color: var(--gold);">{{
            __('blog.featured_articles') }}</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($featuredArticles as $index => $article)
            <div class="overflow-hidden group @if($index % 2 == 0) animate-slide-in-left @else animate-slide-in-right @endif"
                style="background: #111; border: 1px solid #333;">
                <!-- En-tête de l'article -->
                <div class="h-64 flex items-center justify-center relative overflow-hidden"
                    style="background: linear-gradient(135deg, rgba(var(--gold-rgb), 0.8), rgba(var(--gold-rgb), 0.4));">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/10 blur-xl scale-150 animate-pulse"></div>
                            <div class="relative rounded-full p-8 backdrop-blur-sm border border-white/10"
                                style="background: rgba(255, 255, 255, 0.05);">
                                <i
                                    class="{{ $article->icon ?? 'fas fa-newspaper' }} text-white text-8xl opacity-90"></i>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>

                    <div class="absolute bottom-4 left-6 right-6 text-left z-10">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm"
                            style="background: rgba(255, 255, 255, 0.1); color: white; backdrop-filter: blur(10px);">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $article->reading_time }} {{ __('blog.min_read') }}
                        </div>
                    </div>
                </div>

                <!-- Contenu de l'article -->
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium"
                            style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold);">
                            {{ __("blog.categories.{$article->category}") }}
                        </span>
                        <span style="color: #aaa; font-size: 0.875rem;">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $article->created_at->format(__('blog.date_format')) }}
                        </span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-4" style="color: white;">
                        {{ $article->title }}
                    </h3>
                    <p class="mb-6 leading-relaxed" style="color: #ccc;">
                        {{ $article->excerpt }}
                    </p>
                    <a href="{{ route('blog.show', $article->slug) }}"
                        class="inline-flex items-center font-semibold hover:opacity-80 transition duration-300"
                        style="color: var(--gold);">
                        {{ __('blog.read_article') }}
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @else
    <div class="text-center py-12">
        <p class="text-gray-400">{{ __('blog.no_featured_articles') }}</p>
    </div>
    @endif

    <!-- Tous les articles - Style sobre -->
    @if($articles->count() > 0)
    <section class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center" style="color: var(--gold);">{{
            __('blog.all_articles') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
            <div class="overflow-hidden group transition duration-300 hover:border-opacity-50"
                style="background: #111; border: 1px solid #333;">
                <!-- Image ou placeholder -->
                @if($article->image)
                <div class="h-48 overflow-hidden">
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
                </div>
                @else
                <div class="h-48 flex items-center justify-center relative overflow-hidden"
                    style="background: linear-gradient(135deg, rgba(var(--gold-rgb), 0.6), rgba(var(--gold-rgb), 0.3));">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/10 blur-xl scale-150 animate-pulse"></div>
                            <div class="relative rounded-full p-6 backdrop-blur-sm"
                                style="background: rgba(255, 255, 255, 0.05);">
                                <i
                                    class="{{ $article->icon ?? 'fas fa-newspaper' }} text-white text-6xl opacity-90"></i>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                </div>
                @endif

                <!-- Contenu -->
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-medium"
                            style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold);">
                            {{ __("blog.categories.{$article->category}") }}
                        </span>
                        <span style="color: #aaa; font-size: 0.875rem;">
                            {{ $article->created_at->format(__('blog.date_format')) }}
                        </span>
                    </div>
                    <h3 class="text-lg font-bold mb-3 line-clamp-2" style="color: white;">
                        {{ $article->title }}
                    </h3>
                    <p class="mb-4 text-sm line-clamp-3" style="color: #ccc;">
                        {{ $article->excerpt }}
                    </p>
                    <a href="{{ route('blog.show', $article->slug) }}"
                        class="inline-flex items-center font-medium text-sm hover:opacity-80 transition duration-300"
                        style="color: var(--gold);">
                        {{ __('blog.read_more') }}
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination - Style sobre -->
        @if($articles->hasPages())
        <div class="mt-12">
            <div class="flex items-center justify-center gap-2">
                <!-- Previous Page Link -->
                @if ($articles->onFirstPage())
                <span class="px-3 py-2 rounded" style="background: #222; color: #666; border: 1px solid #333;"
                    aria-label="{{ __('blog.previous') }}">
                    <i class="fas fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $articles->previousPageUrl() }}"
                    class="px-3 py-2 rounded hover:opacity-80 transition duration-300"
                    style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);"
                    aria-label="{{ __('blog.previous') }}">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                <!-- Page Numbers -->
                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                @if ($page == $articles->currentPage())
                <span class="px-3 py-2 rounded font-semibold" style="background: var(--gold); color: black;"
                    aria-label="{{ __('blog.page') }} {{ $page }}">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}" class="px-3 py-2 rounded hover:opacity-80 transition duration-300"
                    style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);"
                    aria-label="{{ __('blog.page') }} {{ $page }}">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}"
                    class="px-3 py-2 rounded hover:opacity-80 transition duration-300"
                    style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);"
                    aria-label="{{ __('blog.next') }}">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @else
                <span class="px-3 py-2 rounded" style="background: #222; color: #666; border: 1px solid #333;"
                    aria-label="{{ __('blog.next') }}">
                    <i class="fas fa-chevron-right"></i>
                </span>
                @endif
            </div>
        </div>
        @endif
    </section>
    @else
    <div class="text-center py-12">
        <p class="text-gray-400">{{ __('blog.no_articles') }}</p>
    </div>
    @endif

    <!-- Thématiques - Style sobre -->
    <section class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center" style="color: var(--gold);">{{
            __('blog.explore_themes') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
            'location' => ['icon' => 'fa-car', 'color' => 'var(--gold)', 'subtitle_key' => 'location_subtitle'],
            'vtc-transport' => ['icon' => 'fa-taxi', 'color' => '#60a5fa', 'subtitle_key' => 'vtc_subtitle'],
            'conciergerie' => ['icon' => 'fa-bell', 'color' => '#86efac', 'subtitle_key' => 'conciergerie_subtitle'],
            'formation' => ['icon' => 'fa-graduation-cap', 'color' => '#c4b5fd', 'subtitle_key' => 'formation_subtitle']
            ] as $category => $details)
            <a href="{{ route('blog.category', $category) }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="p-6 md:p-8 rounded text-center" style="background: #111; border: 1px solid #333;">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6"
                        style="background: rgba({{ $details['color'] == 'var(--gold)' ? 'var(--gold-rgb)' : hexToRgb($details['color']) }}, 0.1);">
                        <i class="fas {{ $details['icon'] }} text-2xl md:text-3xl"
                            style="color: {{ $details['color'] }};"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3" style="color: white;">
                        {{ __("blog.category_{$category}") }}
                    </h3>
                    <p class="mb-4 md:mb-6" style="color: #aaa;">
                        {{ __("blog.{$details['subtitle_key']}") }}
                    </p>
                    <span class="inline-block px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium"
                        style="background: rgba({{ $details['color'] == 'var(--gold)' ? 'var(--gold-rgb)' : hexToRgb($details['color']) }}, 0.1);
                               color: {{ $details['color'] }};
                               border: 1px solid rgba({{ $details['color'] == 'var(--gold)' ? 'var(--gold-rgb)' : hexToRgb($details['color']) }}, 0.3);">
                        {{ $categoryCounts[$category] }} {{ __(($categoryCounts[$category] > 1 ? 'blog.articles' :
                        'blog.article')) }}
                    </span>
                </div>
            </a>
            @endforeach
        </div>
    </section>
</div>

<!-- Helper function for Blade (add this in AppServiceProvider or create a helper) -->
@php
function hexToRgb($hex) {
$hex = str_replace('#', '', $hex);
if(strlen($hex) == 3) {
$r = hexdec(substr($hex,0,1).substr($hex,0,1));
$g = hexdec(substr($hex,1,1).substr($hex,1,1));
$b = hexdec(substr($hex,2,1).substr($hex,2,1));
} else {
$r = hexdec(substr($hex,0,2));
$g = hexdec(substr($hex,2,2));
$b = hexdec(substr($hex,4,2));
}
return $r . ',' . $g . ',' . $b;
}
@endphp

<!-- Animations CSS simplifiées -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 0.6;
            transform: scale(1);
        }

        50% {
            opacity: 0.9;
            transform: scale(1.1);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 1s ease-out forwards;
    }

    .animate-slide-in-left {
        animation: slideInLeft 0.8s ease-out forwards;
    }

    .animate-slide-in-right {
        animation: slideInRight 0.8s ease-out forwards;
    }

    .animate-pulse {
        animation: pulse 3s ease-in-out infinite;
    }

    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }

    .line-clamp-3 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }

    /* Styles généraux pour le style sobre */
    :root {
        --gold: #D4AF37;
        /* Or classique */
        --gold-rgb: 212, 175, 55;
        /* Valeurs RGB pour utiliser avec rgba() */
    }
</style>
@endsection
