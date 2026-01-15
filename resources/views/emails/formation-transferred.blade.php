<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert de votre inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background-color: #6b21a8;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 30px 20px;
        }

        .transfer-card {
            background-color: #f8fafc;
            border: 2px solid #e5e7eb;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            text-align: center;
        }

        .old-formation {
            color: #ef4444;
            text-decoration: line-through;
        }

        .new-formation {
            color: #10b981;
            font-weight: bold;
        }

        .arrow {
            font-size: 24px;
            margin: 10px 0;
            color: #6b21a8;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #8b5cf6;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>DJOK PRESTIGE</h1>
            <p>Transfert de Formation</p>
        </div>

        <div class="content">
            <h2>Bonjour {{ $data['student_name'] }},</h2>

            <p>Nous vous informons que votre inscription a été transférée vers une nouvelle formation.</p>

            <div class="transfer-card">
                <h3>Ancienne formation</h3>
                <p class="old-formation">{{ $data['old_formation'] }}</p>

                <div class="arrow">↓</div>

                <h3>Nouvelle formation</h3>
                <p class="new-formation">{{ $data['new_formation'] }}</p>

                <p><em>Date du transfert : {{ $data['transfer_date'] }}</em></p>
            </div>

            <p><strong>Important :</strong> Suite à ce transfert, le statut de votre inscription a été réinitialisé à
                "En attente". Vous serez contacté(e) prochainement pour la confirmation de la nouvelle formation.</p>

            <div style="text-align: center;">
                <a href="{{ config('app.url') }}/dashboard/inscriptions" class="btn">
                    Voir mes inscriptions
                </a>
            </div>

            <p>Pour toute question concernant ce transfert, n'hésitez pas à nous contacter :</p>
            <ul>
                <li>Email : formations@djokprestige.com</li>
                <li>Téléphone : 01 76 38 00 17</li>
            </ul>
        </div>

        <div class="footer">
            <p>DJOK PRESTIGE © {{ date('Y') }}. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>

</html>
