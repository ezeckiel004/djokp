<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée - DJOK Prestige</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-4 py-16 text-center">
        <!-- Logo DJOK -->
        <div class="mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-djok-yellow rounded-full mb-4">
                <i class="fas fa-crown text-3xl text-white"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900">DJOK <span class="text-djok-yellow">Prestige</span></h1>
        </div>

        <!-- Contenu erreur 404 -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
            <div class="animate-float mb-8">
                <div class="inline-flex items-center justify-center w-32 h-32 bg-red-100 rounded-full">
                    <i class="fas fa-exclamation-triangle text-6xl text-red-500"></i>
                </div>
            </div>

            <h2 class="text-5xl font-bold text-gray-900 mb-4">404</h2>
            <h3 class="text-2xl font-semibold text-gray-700 mb-6">Page non trouvée</h3>

            <p class="text-gray-600 mb-8 text-lg max-w-2xl mx-auto">
                Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                Veuillez vérifier l'URL ou retourner à l'accueil.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-djok-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition duration-300 transform hover:scale-105">
                    <i class="fas fa-home mr-2"></i>
                    Retour à l'accueil
                </a>

                <a href="javascript:history.back()"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Page précédente
                </a>
            </div>

            <!-- Services disponibles -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">Services disponibles</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('location') }}"
                        class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <i class="fas fa-car text-djok-yellow text-xl mb-2"></i>
                        <p class="font-medium">Location</p>
                    </a>

                    <a href="{{ route('vtc-transport') }}"
                        class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <i class="fas fa-taxi text-djok-yellow text-xl mb-2"></i>
                        <p class="font-medium">VTC Transport</p>
                    </a>

                    <a href="{{ route('conciergerie') }}"
                        class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300">
                        <i class="fas fa-concierge-bell text-djok-yellow text-xl mb-2"></i>
                        <p class="font-medium">Conciergerie</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-gray-500 text-sm">
            <p>© {{ date('Y') }} DJOK Prestige. Tous droits réservés.</p>
            <div class="mt-2 space-x-4">
                <a href="{{ route('contact') }}" class="hover:text-djok-yellow">Contact</a>
                <a href="{{ route('cgv') }}" class="hover:text-djok-yellow">CGV</a>
                <a href="{{ route('mentions-legales') }}" class="hover:text-djok-yellow">Mentions légales</a>
            </div>
        </div>
    </div>
</body>

</html>
