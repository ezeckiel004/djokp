<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Vos codes d'accès e-learning - DJOK PRESTIGE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #000;
            color: #b89449;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }

        .code-box {
            background-color: #fff;
            border: 2px dashed #b89449;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            font-family: monospace;
            font-size: 18px;
            font-weight: bold;
        }

        .instructions {
            background-color: #f0f0f0;
            padding: 15px;
            border-left: 4px solid #b89449;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background-color: #b89449;
            color: #000;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DJOK PRESTIGE</h1>
        <h2>Formation E-learning</h2>
    </div>

    <div class="content">
        <h3>Bonjour {{ $acces->prenom }} {{ $acces->nom }},</h3>

        <p>Votre achat du forfait <strong>{{ $forfait->name }}</strong> a été confirmé avec succès.</p>

        <p>Voici vos codes d'accès à la plateforme e-learning :</p>

        <div class="code-box">
            <p><strong>Code d'accès :</strong></p>
            <p style="font-size: 24px; letter-spacing: 2px;">{{ $acces->access_code }}</p>
        </div>

        <div class="code-box">
            <p><strong>Salle virtuelle :</strong></p>
            <p style="font-size: 24px; letter-spacing: 2px;">{{ $acces->virtual_room_code }}</p>
        </div>

        <div class="instructions">
            <h4>Comment accéder à votre formation :</h4>
            <ol>
                <li>Rendez-vous sur : <a href="{{ route('elearning.salle') }}">{{ route('elearning.salle') }}</a></li>
                <li>Entrez votre code d'accès : <strong>{{ $acces->access_code }}</strong></li>
                <li>Entrez votre email : <strong>{{ $acces->email }}</strong></li>
                <li>Cliquez sur "Accéder à la salle virtuelle"</li>
            </ol>
        </div>

        <p><strong>Durée d'accès :</strong> Du {{ $acces->access_start->format('d/m/Y') }} au {{
            $acces->access_end->format('d/m/Y') }} ({{ $forfait->duration_days }} jours)</p>

        <p style="text-align: center;">
            <a href="{{ route('elearning.salle') }}" class="button">
                Accéder à votre formation
            </a>
        </p>

        <div class="instructions">
            <p><strong>Important :</strong></p>
            <ul>
                <li>Une seule connexion simultanée est autorisée</li>
                <li>Conservez précieusement ce message</li>
                <li>En cas de problème, contactez le support technique</li>
            </ul>
        </div>

        <p>Nous vous souhaitons une excellente formation !</p>

        <p>Cordialement,<br>
            <strong>L'équipe DJOK PRESTIGE</strong>
        </p>
    </div>

    <div class="footer">
        <p>DJOK PRESTIGE - 123 Avenue des Champs-Élysées, 75008 Paris</p>
        <p>Tél: 01 76 38 00 17 | Email: contact@djokprestige.com</p>
        <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
    </div>
</body>

</html>