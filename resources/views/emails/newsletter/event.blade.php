<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->subject }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            background-color: #fefce8;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border: 3px solid #f59e0b;
        }

        .event-header {
            background: linear-gradient(135deg, #0ea5e9, #1d4ed8);
            color: white;
            padding: 40px 20px;
            text-align: center;
            position: relative;
        }

        .event-header:before {
            content: "🎉";
            font-size: 50px;
            position: absolute;
            top: 10px;
            right: 20px;
            opacity: 0.3;
        }

        .event-header h1 {
            margin: 0;
            font-size: 32px;
        }

        .event-date {
            background: rgba(255, 255, 255, 0.2);
            display: inline-block;
            padding: 10px 20px;
            border-radius: 30px;
            margin-top: 15px;
            font-size: 16px;
        }

        .content {
            padding: 30px;
        }

        .event-details {
            background-color: #f0f9ff;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #0ea5e9;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-item strong {
            color: #1d4ed8;
        }

        .register-button {
            display: block;
            width: 200px;
            margin: 30px auto;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #475569;
        }

        .unsubscribe {
            margin-top: 20px;
            font-size: 11px;
        }

        .unsubscribe a {
            color: #475569;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="event-header">
            <h1>📅 ÉVÉNEMENT À VENIR</h1>
            <div class="event-date">
                <i class="fas fa-calendar-alt"></i>
                {{ now()->addDays(14)->format('d F Y') }}
                <i class="fas fa-clock"></i>
                19:00
            </div>
        </div>

        <div class="content">
            <p>Cher {{ $subscription->name ?? 'client' }},</p>

            <p>Nous avons le plaisir de vous inviter à un événement exceptionnel :</p>

            <div class="event-details">
                <div class="detail-item">
                    <strong>📍 Lieu :</strong> Notre siège social
                </div>
                <div class="detail-item">
                    <strong>📅 Date :</strong> {{ now()->addDays(14)->format('d/m/Y') }}
                </div>
                <div class="detail-item">
                    <strong>⏰ Heure :</strong> 19:00 - 22:00
                </div>
                <div class="detail-item">
                    <strong>🎯 Thème :</strong> Lancement de nos nouveaux produits
                </div>
            </div>

            {!! $content !!}

            <a href="#" class="register-button">S'INSCRIRE À L'ÉVÉNEMENT</a>

            @if($trackingPixel)
            <img src="{{ $trackingPixel }}" alt="" width="1" height="1" style="display:none;">
            @endif

            <p style="text-align: center; margin-top: 30px;">
                <em>Places limitées - Réservez vite !</em>
            </p>
        </div>

        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong><br>
                Organisation d'événements d'exception</p>

            <div class="unsubscribe">
                <p>
                    Vous recevez cet email car vous êtes inscrit à notre newsletter.<br>
                    <a href="{{ $unsubscribeUrl }}">Se désabonner</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
