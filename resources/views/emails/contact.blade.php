<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau contact - DJOK PRESTIGE</title>
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
            background: linear-gradient(to right, #1d4ed8, #1e40af);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f9fafb;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            border: 1px solid #e5e7eb;
        }

        .info-box {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .label {
            font-weight: bold;
            color: #4b5563;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📧 Nouveau message de contact</h1>
            <p>DJOK PRESTIGE - Formulaire de contact</p>
        </div>

        <div class="content">
            <div class="info-box">
                <h2 style="margin-top: 0; color: #1e40af;">Informations du contact</h2>

                <p><span class="label">Nom :</span> {{ $nom }}</p>
                <p><span class="label">Email :</span> {{ $email }}</p>
                @if($telephone)
                <p><span class="label">Téléphone :</span> {{ $telephone }}</p>
                @endif
                <p><span class="label">Service concerné :</span> {{ $service_name }}</p>
            </div>

            <div class="info-box">
                <h3 style="color: #1e40af; margin-top: 0;">Message</h3>
                <p style="white-space: pre-wrap;">{{ $message }}</p>
            </div>

            <div style="background: #dbeafe; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6;">
                <p style="margin: 0; color: #1e40af;">
                    <strong>📋 Action requise :</strong> Merci de répondre à ce contact dans les 24h.
                </p>
            </div>
        </div>

        <div class="footer">
            <p>Ce message a été envoyé depuis le formulaire de contact du site DJOK PRESTIGE.</p>
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>
