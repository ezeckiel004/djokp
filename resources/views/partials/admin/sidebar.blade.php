<!-- Desktop Sidebar -->
<aside class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 z-30">
    <div class="w-64 bg-gray-800 text-white flex flex-col h-full">
        <!-- Header -->
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <div
                    class="w-12 h-12 rounded-xl bg-gradient-to-r from-djok-yellow to-yellow-600 flex items-center justify-center hover-lift">
                    <i class="fas fa-crown text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">DJOK PRESTIGE</h1>
                    <p class="text-gray-400 text-sm">Administration</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto sidebar-scroll p-4">
            @php
            $currentRoute = request()->route()->getName();
            $pendingCount = \App\Models\Contact::where('status', 'new')->count();
            $pendingInternationalCount = \App\Models\DemandeFormationInternationale::where('statut',
            'nouveau')->count();
            $pendingConciergerieCount = \App\Models\ConciergerieDemande::where('statut', 'nouvelle')->count();
            $pendingParticipantsCount = \App\Models\Participant::where('statut', 'en_attente')->count();

            // AJOUTER LE COMPTEUR D'ARTICLES EN ATTENTE
            $pendingArticlesCount = \App\Models\Article::where('published', false)->count();
            $draftArticlesCount = \App\Models\Article::where('published', false)->count();
            $publishedArticlesCount = \App\Models\Article::where('published', true)->count();

            // Compteurs newsletter
            $pendingNewsletterCount = \App\Models\NewsletterSubscription::where('status', 'pending')->count();
            $draftCampaignsCount = \App\Models\NewsletterCampaign::where('status', 'draft')->count();
            $scheduledCampaignsCount = \App\Models\NewsletterCampaign::where('status', 'scheduled')->count();

            // Compteur paiements (AJOUTÉ)
            $pendingPaiementsCount = \App\Models\Paiement::where('status', 'pending')->count();

            // Compteur réservations en attente (AJOUTÉ)
            $pendingReservationsCount = \App\Models\Reservation::where('status', 'pending')->count();
            @endphp

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-tachometer-alt w-5 mr-3 text-center"></i>
                <span>Tableau de bord</span>
            </a>

            <!-- Utilisateurs -->
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.users') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-users w-5 mr-3 text-center"></i>
                <span>Utilisateurs</span>
            </a>

            <!-- Services -->
            <a href="{{ route('admin.services.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.services') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-concierge-bell w-5 mr-3 text-center"></i>
                <span>Services</span>
            </a>

            <!-- Formations -->
            <a href="{{ route('admin.formations.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.formations') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-graduation-cap w-5 mr-3 text-center"></i>
                <span>Formations</span>
            </a>

            <!-- PAIEMENTS - AJOUTÉ ICI -->
            <a href="{{ route('admin.paiements.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.paiements') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-credit-card w-5 mr-3 text-center"></i>
                <span class="flex-1">Paiements</span>
                @if($pendingPaiementsCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingPaiementsCount }}
                </span>
                @endif
            </a>

            <!-- PARTICIPANTS - AJOUTÉ ICI -->
            <a href="{{ route('admin.participants.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.participants') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-user-graduate w-5 mr-3 text-center"></i>
                <span class="flex-1">Participants Formation</span>
                @if($pendingParticipantsCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingParticipantsCount }}
                </span>
                @endif
            </a>

            <!-- ============================================ -->
            <!-- ARTICLES DU BLOG - SECTION AJOUTÉE -->
            <!-- ============================================ -->
            <div class="mb-4 mt-4 pt-4 border-t border-gray-700">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4">Blog</p>

                <!-- Articles -->
                <a href="{{ route('admin.articles.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.articles') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-newspaper w-5 mr-3 text-center"></i>
                    <span class="flex-1">Articles</span>
                    @if($pendingArticlesCount > 0)
                    <span
                        class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                        {{ $pendingArticlesCount }}
                    </span>
                    @endif
                </a>

                <!-- Nouvel article -->
                <a href="{{ route('admin.articles.create') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.articles.create') ? 'bg-gray-700' : '' }} mb-2 bg-green-900 bg-opacity-30 hover:bg-green-800">
                    <i class="fas fa-plus-circle w-5 mr-3 text-center"></i>
                    <span>Nouvel article</span>
                </a>
            </div>
            <!-- ============================================ -->

            <!-- Formation Internationale -->
            <a href="{{ route('admin.demandes-formation-internationale.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.demandes-formation-internationale') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-globe-americas w-5 mr-3 text-center"></i>
                <span class="flex-1">Formation Internationale</span>
                @if($pendingInternationalCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingInternationalCount }}
                </span>
                @endif
            </a>

            <!-- Conciergerie -->
            <a href="{{ route('admin.conciergerie-demandes.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.conciergerie-demandes') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-concierge-bell w-5 mr-3 text-center"></i>
                <span class="flex-1">Conciergerie</span>
                @if($pendingConciergerieCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingConciergerieCount }}
                </span>
                @endif
            </a>

            <!-- SECTION VÉHICULES -->
            <div class="mb-4 mt-4 pt-4 border-t border-gray-700">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4">Véhicules</p>

                <!-- Véhicules -->
                <a href="{{ route('admin.vehicles.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.vehicles') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-car w-5 mr-3 text-center"></i>
                    <span>Véhicules</span>
                </a>

                <!-- Catégories de véhicules -->
                <a href="{{ route('admin.vehicle-categories.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.vehicle-categories') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-tags w-5 mr-3 text-center"></i>
                    <span>Catégories véhicules</span>
                </a>

                <!-- Réservations Location -->
                <a href="{{ route('admin.location-reservations.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.location-reservations') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-calendar-check w-5 mr-3 text-center"></i>
                    <span>Réservations Location</span>
                </a>

                <!-- RÉSERVATIONS VTC - NOUVEAU LIEN -->
                <a href="{{ route('admin.reservations.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.reservations') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-taxi w-5 mr-3 text-center"></i>
                    <span class="flex-1">Réservations VTC</span>
                    @if($pendingReservationsCount > 0)
                    <span
                        class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                        {{ $pendingReservationsCount }}
                    </span>
                    @endif
                </a>
            </div>

            <!-- NEWSLETTER - SECTION AJOUTÉE -->
            <div class="mb-4 mt-4 pt-4 border-t border-gray-700">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4">Newsletter</p>

                <!-- Abonnés -->
                <a href="{{ route('admin.newsletter.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-users w-5 mr-3 text-center"></i>
                    <span class="flex-1">Abonnés</span>
                    @if($pendingNewsletterCount > 0)
                    <span
                        class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                        {{ $pendingNewsletterCount }}
                    </span>
                    @endif
                </a>

                <!-- Campagnes -->
                <a href="{{ route('admin.newsletter.campaigns') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter.campaigns') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-paper-plane w-5 mr-3 text-center"></i>
                    <span class="flex-1">Campagnes</span>
                    @if($draftCampaignsCount > 0 || $scheduledCampaignsCount > 0)
                    <div class="flex space-x-1">
                        @if($draftCampaignsCount > 0)
                        <span class="bg-blue-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center"
                            title="Brouillons">
                            {{ $draftCampaignsCount }}
                        </span>
                        @endif
                        @if($scheduledCampaignsCount > 0)
                        <span class="bg-orange-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center"
                            title="Planifiées">
                            {{ $scheduledCampaignsCount }}
                        </span>
                        @endif
                    </div>
                    @endif
                </a>

                <!-- Statistiques Newsletter -->
                <a href="{{ route('admin.newsletter.statistics') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter.statistics') ? 'bg-gray-700' : '' }} mb-2">
                    <i class="fas fa-chart-bar w-5 mr-3 text-center"></i>
                    <span>Statistiques Newsletter</span>
                </a>

                <!-- Nouvelle campagne -->
                <a href="{{ route('admin.newsletter.campaigns.create') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter.campaigns.create') ? 'bg-gray-700' : '' }} mb-2 bg-green-900 bg-opacity-30 hover:bg-green-800">
                    <i class="fas fa-plus-circle w-5 mr-3 text-center"></i>
                    <span>Nouvelle campagne</span>
                </a>
            </div>

            <!-- Messages -->
            <a href="{{ route('admin.contacts.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.contacts') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-envelope w-5 mr-3 text-center"></i>
                <span class="flex-1">Messages</span>
                @if($pendingCount > 0)
                <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingCount }}
                </span>
                @endif
            </a>

            <!-- Statistiques -->
            <a href="{{ route('admin.statistics') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.statistics') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-chart-line w-5 mr-3 text-center"></i>
                <span>Statistiques</span>
            </a>

            <!-- Paramètres / Mon Profil -->
            <a href="{{ route('admin.profile.edit') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.profile.*') ? 'bg-gray-700' : '' }} mb-2">
                <i class="fas fa-user-circle w-5 mr-3 text-center"></i>
                <span>Mon Profil</span>
            </a>

            <!-- Déconnexion -->
            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button type="submit"
                    class="flex items-center w-full text-left py-3 px-4 rounded-lg hover:bg-gray-700 text-red-300">
                    <i class="fas fa-sign-out-alt w-5 mr-3 text-center"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-gray-700">
            <a href="{{ route('home') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 text-blue-300">
                <i class="fas fa-arrow-left w-5 mr-3 text-center"></i>
                <span>Retour au site</span>
            </a>
        </div>
    </div>
</aside>

<!-- Mobile Sidebar Backdrop -->
<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-black bg-opacity-50 md:hidden"
    @click="sidebarOpen = false">
</div>

<!-- Mobile Sidebar -->
<div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" class="fixed inset-0 z-40 flex md:hidden" x-cloak>

    <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-900">
        <!-- Close Button -->
        <div class="absolute top-4 right-4">
            <button @click="sidebarOpen = false"
                class="p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-800">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Logo Mobile -->
        <div class="p-4 border-b border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-djok-yellow flex items-center justify-center">
                    <i class="fas fa-crown text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-white font-bold text-lg">DJOK PRESTIGE</h1>
                    <p class="text-gray-400 text-xs">Administration</p>
                </div>
            </div>
        </div>

        <!-- Navigation Mobile -->
        <nav class="flex-1 overflow-y-auto p-4">
            @php
            $currentRoute = request()->route()->getName();
            $pendingCount = \App\Models\Contact::where('status', 'new')->count();
            $pendingInternationalCount = \App\Models\DemandeFormationInternationale::where('statut',
            'nouveau')->count();
            $pendingConciergerieCount = \App\Models\ConciergerieDemande::where('statut', 'nouvelle')->count();
            $pendingParticipantsCount = \App\Models\Participant::where('statut', 'en_attente')->count();

            // AJOUTER LE COMPTEUR D'ARTICLES POUR MOBILE
            $pendingArticlesCount = \App\Models\Article::where('published', false)->count();

            // Compteurs newsletter pour mobile
            $pendingNewsletterCount = \App\Models\NewsletterSubscription::where('status', 'pending')->count();
            $draftCampaignsCount = \App\Models\NewsletterCampaign::where('status', 'draft')->count();
            $scheduledCampaignsCount = \App\Models\NewsletterCampaign::where('status', 'scheduled')->count();

            // Compteur paiements pour mobile (AJOUTÉ)
            $pendingPaiementsCount = \App\Models\Paiement::where('status', 'pending')->count();

            // Compteur réservations pour mobile (AJOUTÉ)
            $pendingReservationsCount = \App\Models\Reservation::where('status', 'pending')->count();
            @endphp

            <!-- Les mêmes liens que le sidebar desktop -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.dashboard') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-tachometer-alt w-5 mr-3 text-center"></i>
                <span>Tableau de bord</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.users') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-users w-5 mr-3 text-center"></i>
                <span>Utilisateurs</span>
            </a>

            <!-- Services (Mobile) -->
            <a href="{{ route('admin.services.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.services') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-concierge-bell w-5 mr-3 text-center"></i>
                <span>Services</span>
            </a>

            <a href="{{ route('admin.formations.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.formations') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-graduation-cap w-5 mr-3 text-center"></i>
                <span>Formations</span>
            </a>

            <!-- PAIEMENTS MOBILE - AJOUTÉ ICI -->
            <a href="{{ route('admin.paiements.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.paiements') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-credit-card w-5 mr-3 text-center"></i>
                <span class="flex-1">Paiements</span>
                @if($pendingPaiementsCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingPaiementsCount }}
                </span>
                @endif
            </a>

            <!-- PARTICIPANTS MOBILE -->
            <a href="{{ route('admin.participants.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.participants') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-user-graduate w-5 mr-3 text-center"></i>
                <span class="flex-1">Participants Formation</span>
                @if($pendingParticipantsCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingParticipantsCount }}
                </span>
                @endif
            </a>

            <!-- ============================================ -->
            <!-- ARTICLES DU BLOG MOBILE - SECTION AJOUTÉE -->
            <!-- ============================================ -->
            <div class="mb-4 mt-4 pt-4 border-t border-gray-700">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4">Blog</p>

                <!-- Articles Mobile -->
                <a href="{{ route('admin.articles.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.articles') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-newspaper w-5 mr-3 text-center"></i>
                    <span class="flex-1">Articles</span>
                    @if($pendingArticlesCount > 0)
                    <span
                        class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                        {{ $pendingArticlesCount }}
                    </span>
                    @endif
                </a>

                <!-- Nouvel article Mobile -->
                <a href="{{ route('admin.articles.create') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.articles.create') ? 'bg-gray-700' : '' }} mb-2 bg-green-900 bg-opacity-30 hover:bg-green-800"
                    @click="sidebarOpen = false">
                    <i class="fas fa-plus-circle w-5 mr-3 text-center"></i>
                    <span>Nouvel article</span>
                </a>
            </div>
            <!-- ============================================ -->

            <a href="{{ route('admin.demandes-formation-internationale.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.demandes-formation-internationale') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-globe-americas w-5 mr-3 text-center"></i>
                <span class="flex-1">Formation Internationale</span>
                @if($pendingInternationalCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingInternationalCount }}
                </span>
                @endif
            </a>

            <a href="{{ route('admin.conciergerie-demandes.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.conciergerie-demandes') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-concierge-bell w-5 mr-3 text-center"></i>
                <span class="flex-1">Conciergerie</span>
                @if($pendingConciergerieCount > 0)
                <span class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingConciergerieCount }}
                </span>
                @endif
            </a>

            <!-- SECTION VÉHICULES MOBILE -->
            <div class="mb-4 mt-4 pt-4 border-t border-gray-700">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4">Véhicules</p>

                <!-- Véhicules Mobile -->
                <a href="{{ route('admin.vehicles.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.vehicles') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-car w-5 mr-3 text-center"></i>
                    <span>Véhicules</span>
                </a>

                <!-- Réservations Location Mobile -->
                <a href="{{ route('admin.location-reservations.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.location-reservations') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-calendar-check w-5 mr-3 text-center"></i>
                    <span>Réservations Location</span>
                </a>

                <!-- RÉSERVATIONS VTC MOBILE - NOUVEAU LIEN -->
                <a href="{{ route('admin.reservations.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.reservations') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-taxi w-5 mr-3 text-center"></i>
                    <span class="flex-1">Réservations VTC</span>
                    @if($pendingReservationsCount > 0)
                    <span
                        class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                        {{ $pendingReservationsCount }}
                    </span>
                    @endif
                </a>
            </div>

            <!-- NEWSLETTER MOBILE - SECTION AJOUTÉE -->
            <div class="mb-4 mt-4 pt-4 border-t border-gray-700">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 px-4">Newsletter</p>

                <!-- Abonnés Mobile -->
                <a href="{{ route('admin.newsletter.index') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-users w-5 mr-3 text-center"></i>
                    <span class="flex-1">Abonnés</span>
                    @if($pendingNewsletterCount > 0)
                    <span
                        class="bg-yellow-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                        {{ $pendingNewsletterCount }}
                    </span>
                    @endif
                </a>

                <!-- Campagnes Mobile -->
                <a href="{{ route('admin.newsletter.campaigns') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter.campaigns') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-paper-plane w-5 mr-3 text-center"></i>
                    <span class="flex-1">Campagnes</span>
                    @if($draftCampaignsCount > 0 || $scheduledCampaignsCount > 0)
                    <div class="flex space-x-1">
                        @if($draftCampaignsCount > 0)
                        <span class="bg-blue-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center"
                            title="Brouillons">
                            {{ $draftCampaignsCount }}
                        </span>
                        @endif
                        @if($scheduledCampaignsCount > 0)
                        <span class="bg-orange-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center"
                            title="Planifiées">
                            {{ $scheduledCampaignsCount }}
                        </span>
                        @endif
                    </div>
                    @endif
                </a>

                <!-- Statistiques Newsletter Mobile -->
                <a href="{{ route('admin.newsletter.statistics') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter.statistics') ? 'bg-gray-700' : '' }} mb-2"
                    @click="sidebarOpen = false">
                    <i class="fas fa-chart-bar w-5 mr-3 text-center"></i>
                    <span>Statistiques Newsletter</span>
                </a>

                <!-- Nouvelle campagne Mobile -->
                <a href="{{ route('admin.newsletter.campaigns.create') }}"
                    class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.newsletter.campaigns.create') ? 'bg-gray-700' : '' }} mb-2 bg-green-900 bg-opacity-30 hover:bg-green-800"
                    @click="sidebarOpen = false">
                    <i class="fas fa-plus-circle w-5 mr-3 text-center"></i>
                    <span>Nouvelle campagne</span>
                </a>
            </div>

            <a href="{{ route('admin.contacts.index') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.contacts') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-envelope w-5 mr-3 text-center"></i>
                <span class="flex-1">Messages</span>
                @if($pendingCount > 0)
                <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1 min-w-6 text-center animate-pulse">
                    {{ $pendingCount }}
                </span>
                @endif
            </a>

            <a href="{{ route('admin.statistics') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ str_starts_with($currentRoute, 'admin.statistics') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-chart-line w-5 mr-3 text-center"></i>
                <span>Statistiques</span>
            </a>

            <!-- Mon Profil Mobile -->
            <a href="{{ route('admin.profile.edit') }}"
                class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.profile.*') ? 'bg-gray-700' : '' }} mb-2"
                @click="sidebarOpen = false">
                <i class="fas fa-user-circle w-5 mr-3 text-center"></i>
                <span>Mon Profil</span>
            </a>

            <!-- Déconnexion mobile -->
            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button type="submit"
                    class="flex items-center w-full text-left py-3 px-4 rounded-lg hover:bg-gray-700 text-red-300"
                    @click="sidebarOpen = false">
                    <i class="fas fa-sign-out-alt w-5 mr-3 text-center"></i>
                    <span>Déconnexion</span>
                </button>
            </form>
        </nav>

        <!-- Footer mobile -->
        <div class="p-4 border-t border-gray-700">
            <a href="{{ route('home') }}" class="flex items-center py-3 px-4 rounded-lg hover:bg-gray-700 text-blue-300"
                @click="sidebarOpen = false">
                <i class="fas fa-arrow-left w-5 mr-3 text-center"></i>
                <span>Retour au site</span>
            </a>
        </div>
    </div>
</div>
