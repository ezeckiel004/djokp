<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') - DJOK PRESTIGE</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'djok-yellow': '#f59e0b',
                        'djok-dark': '#111827',
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js avec les plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }

        /* Scrollbar personnalisée */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-track {
            background: #1f2937;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #f59e0b;
            border-radius: 9999px;
        }

        /* Hover effects */
        .hover-lift {
            transition: transform 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        /* Hide elements with x-cloak until Alpine loads */
        [x-cloak] {
            display: none !important;
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full" x-data="{ sidebarOpen: false, profileOpen: false }">
    <!-- Inclusions des partials -->
    @include('partials.admin.sidebar')

    <!-- Main Content Area -->
    <div class="md:pl-64 flex flex-col flex-1 min-h-screen transition-all duration-300"
        :class="sidebarOpen ? 'translate-x-64' : ''">
        @include('partials.admin.navbar')

        <!-- Main Content -->
        <main class="flex-1">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    <!-- Session Messages -->
                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Page Actions -->
                    @hasSection('page-actions')
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2">
                            @yield('page-actions')
                        </div>
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="fade-in">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                <div class="text-center text-sm text-gray-600">
                    &copy; {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script>
        // Auto-hide messages
        setTimeout(() => {
            document.querySelectorAll('.fade-in').forEach(alert => {
                if (alert.classList.contains('bg-green-50') || alert.classList.contains('bg-red-50')) {
                    alert.remove();
                }
            });
        }, 5000);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                sidebarOpen = false;
                profileOpen = false;
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('[x-show="sidebarOpen"]');
            const menuButton = document.querySelector('[\\@click="sidebarOpen = true"]');

            if (sidebar && !sidebar.contains(event.target) &&
                menuButton && !menuButton.contains(event.target) &&
                window.innerWidth < 768) {
                sidebarOpen = false;
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
