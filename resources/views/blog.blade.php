@extends('layouts.main')

@section('title', 'Blog - DJOK PRESTIGE')

@section('content')
<!-- Header Hero Section -->
<header class="flex flex-col min-h-screen hero-bg">
    @include('layouts.navbar')

    <div class="flex flex-col items-center justify-center flex-1 px-4 text-center text-white">
        <h1 class="mb-6 text-5xl font-bold md:text-6xl animate-fade-in-up" style="animation-delay: 0.2s;">
            Blog DJOK PRESTIGE
        </h1>
        <p class="max-w-3xl mb-8 text-xl md:text-2xl animate-fade-in-up" style="animation-delay: 0.4s;">
            Actualités, conseils et expertise dans le transport, la formation et l'entrepreneuriat
        </p>
        <div class="flex flex-col gap-4 sm:flex-row animate-fade-in-up" style="animation-delay: 0.6s;">
            <a href="#articles"
                class="px-8 py-3 text-lg font-semibold text-white transition duration-300 transform bg-yellow-600 rounded-lg hover:bg-yellow-700 hover:scale-105 hover:shadow-xl">
                Découvrir nos articles
            </a>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#articles" class="text-white transition duration-300 hover:text-yellow-400">
            <i class="text-2xl fas fa-chevron-down"></i>
        </a>
    </div>
</header>

<!-- Search and Categories -->
<div class="container mx-auto py-12 px-4">
    <div class="flex flex-col lg:flex-row justify-between items-center gap-6 mb-12">
        <!-- Live Search (désactivé pour la démo) -->
        <div class="w-full lg:w-1/2">
            <div class="relative">
                <input type="text" disabled placeholder="Recherche bientôt disponible..."
                    class="w-full p-4 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 transition duration-300 transform bg-gray-100">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- Filtres services -->
        <div class="flex flex-wrap gap-3 justify-center lg:justify-end">
            <a href="{{ route('blog.category', 'location') }}"
                class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium hover:bg-yellow-200 transition">
                Location
            </a>
            <a href="{{ route('blog.category', 'vtc-transport') }}"
                class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                VTC Transport
            </a>
            <a href="{{ route('blog.category', 'conciergerie') }}"
                class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium hover:bg-green-200 transition">
                Conciergerie
            </a>
            <a href="{{ route('blog.category', 'formation') }}"
                class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium hover:bg-purple-200 transition">
                Formation
            </a>
        </div>
    </div>

    <!-- Articles à la une -->
    @if($featuredArticles->count() > 0)
    <section id="articles" class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Articles à la Une</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach($featuredArticles as $index => $article)
            <div
                class="bg-white rounded-2xl shadow-lg overflow-hidden group @if($index % 2 == 0) animate-slide-in-left @else animate-slide-in-right @endif">
                <div
                    class="h-64 flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-{{ $article->color_class }}-400 to-{{ $article->color_class }}-600">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/20 blur-xl scale-150 animate-pulse"></div>
                            <div
                                class="relative bg-white/10 backdrop-blur-sm rounded-full p-8 shadow-2xl border border-white/20">
                                <i
                                    class="{{ $article->icon ?? 'fas fa-newspaper' }} text-white text-8xl opacity-90"></i>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-black opacity-10"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <i class="{{ $article->icon ?? 'fas fa-newspaper' }} text-white text-7xl relative z-10"></i>

                    <div class="absolute bottom-4 left-6 right-6 text-left z-10">
                        <div
                            class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $article->reading_time }} min
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="px-3 py-1 bg-{{ $article->color_class }}-100 text-{{ $article->color_class }}-800 rounded-full text-xs font-medium">
                            {{ $article->category_label }}
                        </span>
                        <span class="text-gray-500 text-sm">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $article->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">
                        {{ $article->title }}
                    </h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                    <a href="{{ route('blog.show', $article->slug) }}"
                        class="inline-flex items-center font-semibold text-{{ $article->color_class }}-600 hover:text-{{ $article->color_class }}-700">
                        Lire l'article
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- Tous les articles -->
    @if($articles->count() > 0)
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Tous nos Articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <div class="bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition duration-300">
                @if($article->image)
                <div class="h-48 overflow-hidden">
                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
                </div>
                @else
                <div
                    class="h-48 flex items-center justify-center relative overflow-hidden bg-gradient-to-r from-{{ $article->color_class }}-400 to-{{ $article->color_class }}-600">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-white/20 blur-xl scale-150 animate-pulse"></div>
                            <div class="relative bg-white/10 backdrop-blur-sm rounded-full p-6 shadow-xl">
                                <i
                                    class="{{ $article->icon ?? 'fas fa-newspaper' }} text-white text-6xl opacity-90"></i>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <i class="{{ $article->icon ?? 'fas fa-newspaper' }} text-white text-5xl relative z-10"></i>
                </div>
                @endif

                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span
                            class="px-3 py-1 bg-{{ $article->color_class }}-100 text-{{ $article->color_class }}-800 rounded-full text-xs font-medium">
                            {{ $article->category_label }}
                        </span>
                        <span class="text-gray-500 text-sm">{{ $article->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2">
                        {{ $article->title }}
                    </h3>
                    <p class="text-gray-600 mb-4 text-sm line-clamp-3">
                        {{ $article->excerpt }}
                    </p>
                    <a href="{{ route('blog.show', $article->slug) }}"
                        class="inline-flex items-center font-medium text-sm text-{{ $article->color_class }}-600 hover:text-{{ $article->color_class }}-700">
                        Lire plus
                        <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-12">
            {{ $articles->links() }}
        </div>
        @endif
    </section>
    @endif

    <!-- Thématiques -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Explorez nos Thématiques</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Location -->
            <a href="{{ route('blog.category', 'location') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 bg-yellow-100">
                        <i class="fas fa-car text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Location</h3>
                    <p class="text-gray-600 mb-6">Véhicules premium</p>
                    <span class="inline-block px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                        {{ $categoryCounts['location'] }} article{{ $categoryCounts['location'] > 1 ? 's' : '' }}
                    </span>
                </div>
            </a>

            <!-- VTC Transport -->
            <a href="{{ route('blog.category', 'vtc-transport') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 bg-blue-100">
                        <i class="fas fa-taxi text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">VTC Transport</h3>
                    <p class="text-gray-600 mb-6">Transport haut de gamme</p>
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                        {{ $categoryCounts['vtc-transport'] }} article{{ $categoryCounts['vtc-transport'] > 1 ? 's' : ''
                        }}
                    </span>
                </div>
            </a>

            <!-- Conciergerie -->
            <a href="{{ route('blog.category', 'conciergerie') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 bg-green-100">
                        <i class="fas fa-bell text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Conciergerie</h3>
                    <p class="text-gray-600 mb-6">Services sur mesure</p>
                    <span class="inline-block px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                        {{ $categoryCounts['conciergerie'] }} article{{ $categoryCounts['conciergerie'] > 1 ? 's' : ''
                        }}
                    </span>
                </div>
            </a>

            <!-- Formation -->
            <a href="{{ route('blog.category', 'formation') }}"
                class="block hover:transform hover:scale-105 transition duration-300">
                <div class="bg-white p-8 rounded-2xl shadow-md text-center border border-gray-100">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 bg-purple-100">
                        <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Formation</h3>
                    <p class="text-gray-600 mb-6">Expertise certifiée</p>
                    <span class="inline-block px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
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
</style>
@endsection
