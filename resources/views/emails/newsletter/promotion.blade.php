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
            background-color: #f5f5f5;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .promo-header {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .promo-header h1 {
            margin: 0;
            font-size: 28px;
        }

        .promo-header .tag {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            margin-top: 10px;
            font-size: 14px;
        }

        .content {
            padding: 30px;
        }

        .cta-button {
            display: inline-block;
            background-color: #f59e0b;
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }

        .highlight {
            background-color: #fff7ed;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        .social {
            margin: 20px 0;
        }

        .social a {
            margin: 0 10px;
            text-decoration: none;
        }

        .unsubscribe {
            color: #666;
            font-size: 11px;
            margin-top: 20px;
        }

        .unsubscribe a {
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="promo-header">
            <h1>🎉 OFFRE SPÉCIALE !</h1>
            <div class="tag">Promotion exclusive</div>
        </div>

        <div class="content">
            <p>Bonjour {{ $subscription->name ?? 'cher client' }},</p>

            {!! $content !!}

            <div class="highlight">
                <p><strong>⚠️ Offre limitée dans le temps !</strong></p>
                <p>Cette promotion est valable jusqu'au {{ now()->addDays(7)->format('d/m/Y') }} uniquement.</p>
            </div>

            @if($trackingPixel)
            <img src="{{ $trackingPixel }}" alt="" width="1" height="1" style="display:none;">
            @endif
        </div>

        <div class="footer">
            <div class="social">
                Suivez-nous sur les réseaux sociaux :
                <br>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">Twitter</a>
            </div>

            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>

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
