<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de réservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f9fafb;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }

        .details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6b7280;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            background: #f59e0b;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>✅ Réservation Confirmée</h1>
            <p>Merci pour votre confiance, {{ $userName }} !</p>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $userName }}</strong>,</p>
            <p>Votre demande de réservation a bien été reçue et est en cours de traitement.</p>

            <div class="details">
                <h2>📋 Détails de votre réservation</h2>
                <p><strong>Référence :</strong> {{ $reservation['reference'] ?? 'En attente' }}</p>
                <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($reservation['start_date'])->format('d/m/Y') }}</p>
                <p><strong>Heure :</strong> {{ $reservation['pickup_time'] ?? 'À confirmer' }}</p>
                <p><strong>Départ :</strong> {{ $reservation['pickup_location'] }}</p>
                <p><strong>Arrivée :</strong> {{ $reservation['dropoff_location'] }}</p>
                <p><strong>Type véhicule :</strong> {{ ucfirst($reservation['vehicle_type']) }}</p>
                <p><strong>Passagers :</strong> {{ $reservation['passengers'] }}</p>
                <p><strong>Prix estimé :</strong> {{ number_format($reservation['estimated_price'], 2) }} €</p>
            </div>

            <p>Notre équipe va vous contacter dans les plus brefs délais pour finaliser votre réservation.</p>

            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ config('app.url') }}/reservations/suivi" class="button">
                    Suivre ma réservation
                </a>
            </p>

            <p>Pour toute question, contactez-nous :</p>
            <ul>
                <li>📞 <strong>Téléphone :</strong> +33 1 23 45 67 89</li>
                <li>📧 <strong>Email :</strong> contact@djokprestige.com</li>
                <li>⏰ <strong>Disponibilité :</strong> 7j/7 - 24h/24</li>
            </ul>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Paris, France</p>
            <p>
                <a href="{{ config('app.url') }}/cgv" style="color: #6b7280;">Conditions Générales</a> |
                <a href="{{ config('app.url') }}/confidentialite" style="color: #6b7280;">Confidentialité</a>
            </p>
        </div>
    </div>
</body>

</html>
