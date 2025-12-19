<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur serveur - DJOK Prestige</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <div class="mb-6">
                <i class="fas fa-server text-6xl text-red-500 mb-4"></i>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">500</h1>
                <h2 class="text-xl font-semibold text-gray-700">Erreur serveur</h2>
            </div>

            <p class="text-gray-600 mb-8">
                Une erreur interne s'est produite. Notre équipe technique a été notifiée.
                Veuillez réessayer plus tard.
            </p>

            <div class="space-y-3">
                <a href="{{ url('/') }}"
                    class="block w-full py-3 bg-djok-yellow text-white font-medium rounded-lg hover:bg-yellow-600 transition duration-300">
                    Retour à l'accueil
                </a>
                <a href="javascript:history.back()"
                    class="block w-full py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition duration-300">
                    Page précédente
                </a>
            </div>
        </div>
    </div>
</body>

</html>
