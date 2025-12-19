<!DOCTYPE html>
<html>

<head>
    <title>{{ $campaign->subject }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
            margin-bottom: 20px;
        }

        .content {
            padding: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 12px;
            color: #666666;
            text-align: center;
        }

        .unsubscribe-link {
            color: #666666;
            text-decoration: none;
        }

        .unsubscribe-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1 style="color: #333333; margin: 0;">{{ config('app.name') }}</h1>
            <h2 style="color: #666666; margin: 10px 0 0 0;">{{ $campaign->subject }}</h2>
        </div>

        <div class="content">
            {!! $content !!}
        </div>

        <div class="footer">
            <p>Cet email vous a été envoyé par <strong>{{ config('app.name') }}</strong></p>
            <p style="margin-top: 15px;">
                <small>
                    Vous recevez cet email car vous êtes inscrit à notre newsletter.<br>
                    <a href="{{ $unsubscribeUrl }}" class="unsubscribe-link">
                        Cliquez ici pour vous désabonner
                    </a>
                </small>
            </p>
            <p style="margin-top: 10px; font-size: 11px; color: #999999;">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
            </p>
        </div>
    </div>
</body>

</html>
