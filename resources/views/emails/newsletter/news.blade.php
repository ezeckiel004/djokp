<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->subject }}</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            line-height: 1.8;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .news-header {
            background-color: #1e40af;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .news-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .news-date {
            font-size: 14px;
            opacity: 0.8;
            margin-top: 10px;
        }

        .content {
            padding: 30px;
        }

        .news-item {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        .news-item:last-child {
            border-bottom: none;
        }

        .news-title {
            color: #1e40af;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .news-excerpt {
            color: #666;
            font-size: 14px;
        }

        .read-more {
            color: #1e40af;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            background-color: #f1f5f9;
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
        <div class="news-header">
            <h1>📰 {{ config('app.name') }} - Actualités</h1>
            <div class="news-date">{{ now()->format('d/m/Y') }}</div>
        </div>

        <div class="content">
            <p>Bonjour {{ $subscription->name ?? 'cher abonné' }},</p>

            <p>Voici les dernières actualités et mises à jour :</p>

            {!! $content !!}

            @if($trackingPixel)
            <img src="{{ $trackingPixel }}" alt="" width="1" height="1" style="display:none;">
            @endif

            <p style="margin-top: 30px;">
                <em>Restez informé de nos dernières nouvelles !</em>
            </p>
        </div>

        <div class="footer">
            <p><strong>{{ config('app.name') }}</strong><br>
                Votre source d'information privilégiée</p>

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
