@extends('layouts.main')

@section('title', 'Blog - DJOK PRESTIGE')

@section('content')
<!-- Header Hero Section - Style sobre -->
<header class="relative min-h-screen flex items-center" style="background: #000;">
    <div class="absolute inset-0 bg-black">
        <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80"
            alt="Blog DJOK PRESTIGE" class="w-full h-full object-cover opacity-40">
        <div class="absolute inset-0" style="background: rgba(0, 0, 0, 0.7);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 py-20 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-8" style="color: var(--gold);">
                Blog DJOK PRESTIGE
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-12">
                Actualités, conseils et expertise dans le transport, la formation et l'entrepreneuriat
            </p>

            <!-- Bouton - Style sobre -->
            <div class="animate-fade-in-up" style="animation-delay: 0.6s;">
                <a href="#articles"
                    class="inline-flex items-center px-8 py-3 font-semibold text-center transition duration-300"
                    style="background: var(--gold); color: black;">
                    Découvrir nos articles
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <a href="#articles" class="text-white transition duration-300 hover:text-var(--gold)">
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
                <input type="text" disabled placeholder="Recherche bientôt disponible..."
                    class="w-full p-4 pl-12 border rounded focus:outline-none transition duration-300"
                    style="background: #111; border-color: #444; color: white;">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2"
                    style="color: var(--gold);"></i>
            </div>
        </div>

        <!-- Filtres services - Style sobre -->
        <div class="flex flex-wrap gap-3 justify-center lg:justify-end">
            <a href="{{ route('blog.category', 'location') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);">
                Location
            </a>
            <a href="{{ route('blog.category', 'vtc-transport') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3);">
                VTC Transport
            </a>
            <a href="{{ route('blog.category', 'conciergerie') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                style="background: rgba(34, 197, 94, 0.1); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.3);">
                Conciergerie
            </a>
            <a href="{{ route('blog.category', 'formation') }}"
                class="px-4 py-2 rounded-full text-sm font-medium transition"
                style="background: rgba(147, 51, 234, 0.1); color: #c4b5fd; border: 1px solid rgba(147, 51, 234, 0.3);">
                Formation
            </a>
        </div>
    </div>

    <!-- Articles à la une - Style sobre -->
    @if($featuredArticles->count() > 0)
    <section id="articles" class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center" style="color: var(--gold);">Articles à la Une</h2>
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
                            {{ $article->reading_time }} min
                        </div>
                    </div>
                </div>

                <!-- Contenu de l'article -->
                <div class="p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium"
                            style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold);">
                            {{ $article->category_label }}
                        </span>
                        <span style="color: #aaa; font-size: 0.875rem;">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $article->created_at->format('d M Y') }}
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
                        Lire l'article
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Tous les articles - Style sobre -->
    @if($articles->count() > 0)
    <section class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center" style="color: var(--gold);">Tous nos Articles</h2>
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
                            {{ $article->category_label }}
                        </span>
                        <span style="color: #aaa; font-size: 0.875rem;">{{ $article->created_at->format('d M Y')
                            }}</span>
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
                        Lire plus
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
                <span class="px-3 py-2 rounded" style="background: #222; color: #666; border: 1px solid #333;">
                    <i class="fas fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $articles->previousPageUrl() }}"
                    class="px-3 py-2 rounded hover:opacity-80 transition duration-300"
                    style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif

                <!-- Page Numbers -->
                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                @if ($page == $articles->currentPage())
                <span class="px-3 py-2 rounded font-semibold" style="background: var(--gold); color: black;">
                    {{ $page }}
                </span>
                @else
                <a href="{{ $url }}" class="px-3 py-2 rounded hover:opacity-80 transition duration-300"
                    style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);">
                    {{ $page }}
                </a>
                @endif
                @endforeach

                <!-- Next Page Link -->
                @if ($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}"
                    class="px-3 py-2 rounded hover:opacity-80 transition duration-300"
                    style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @else
                <span class="px-3 py-2 rounded" style="background: #222; color: #666; border: 1px solid #333;">
                    <i class="fas fa-chevron-right"></i>
                </span>
                @endif
            </div>
        </div>
        @endif
    </section>
    @endif

    <!-- Thématiques - Style sobre -->
    <section class="mb-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center" style="color: var(--gold);">Explorez nos Thématiques
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Location -->
            <a href="{{ route('blog.category', 'location') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="p-6 md:p-8 rounded text-center" style="background: #111; border: 1px solid #333;">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6"
                        style="background: rgba(var(--gold-rgb), 0.1);">
                        <i class="fas fa-car text-2xl md:text-3xl" style="color: var(--gold);"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3" style="color: white;">Location</h3>
                    <p class="mb-4 md:mb-6" style="color: #aaa;">Véhicules premium</p>
                    <span class="inline-block px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium"
                        style="background: rgba(var(--gold-rgb), 0.1); color: var(--gold); border: 1px solid rgba(var(--gold-rgb), 0.3);">
                        {{ $categoryCounts['location'] }} article{{ $categoryCounts['location'] > 1 ? 's' : '' }}
                    </span>
                </div>
            </a>

            <!-- VTC Transport -->
            <a href="{{ route('blog.category', 'vtc-transport') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="p-6 md:p-8 rounded text-center" style="background: #111; border: 1px solid #333;">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6"
                        style="background: rgba(59, 130, 246, 0.1);">
                        <i class="fas fa-taxi text-2xl md:text-3xl" style="color: #60a5fa;"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3" style="color: white;">VTC Transport</h3>
                    <p class="mb-4 md:mb-6" style="color: #aaa;">Transport haut de gamme</p>
                    <span class="inline-block px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium"
                        style="background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3);">
                        {{ $categoryCounts['vtc-transport'] }} article{{ $categoryCounts['vtc-transport'] > 1 ? 's' : ''
                        }}
                    </span>
                </div>
            </a>

            <!-- Conciergerie -->
            <a href="{{ route('blog.category', 'conciergerie') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="p-6 md:p-8 rounded text-center" style="background: #111; border: 1px solid #333;">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6"
                        style="background: rgba(34, 197, 94, 0.1);">
                        <i class="fas fa-bell text-2xl md:text-3xl" style="color: #86efac;"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3" style="color: white;">Conciergerie</h3>
                    <p class="mb-4 md:mb-6" style="color: #aaa;">Services sur mesure</p>
                    <span class="inline-block px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium"
                        style="background: rgba(34, 197, 94, 0.1); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.3);">
                        {{ $categoryCounts['conciergerie'] }} article{{ $categoryCounts['conciergerie'] > 1 ? 's' : ''
                        }}
                    </span>
                </div>
            </a>

            <!-- Formation -->
            <a href="{{ route('blog.category', 'formation') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="p-6 md:p-8 rounded text-center" style="background: #111; border: 1px solid #333;">
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-full flex items-center justify-center mx-auto mb-4 md:mb-6"
                        style="background: rgba(147, 51, 234, 0.1);">
                        <i class="fas fa-graduation-cap text-2xl md:text-3xl" style="color: #c4b5fd;"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3" style="color: white;">Formation</h3>
                    <p class="mb-4 md:mb-6" style="color: #aaa;">Expertise certifiée</p>
                    <span class="inline-block px-3 py-1 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-medium"
                        style="background: rgba(147, 51, 234, 0.1); color: #c4b5fd; border: 1px solid rgba(147, 51, 234, 0.3);">
                        {{ $categoryCounts['formation'] }} article{{ $categoryCounts['formation'] > 1 ? 's' : '' }}
                    </span>
                </div>
            </a>
        </div>
    </section>
</div>

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