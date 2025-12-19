<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'annulation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .cancel-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: #ef4444;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .info-box {
            background-color: #fef2f2;
            border: 2px solid #fecaca;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .details {
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 15px 0;
        }

        .feedback {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Confirmation d'annulation</h1>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>

            <p>Nous confirmons l'annulation de votre demande de service conciergerie <strong>#{{ $demande->reference
                    }}</strong>.</p>

            <div class="cancel-badge">
                Statut : Annulé
            </div>

            <div class="info-box">
                <p>Votre demande a été annulée avec succès. Tous les préparatifs et réservations associés ont été
                    stoppés.</p>

                @if(!empty($raison))
                <p><strong>Raison de l'annulation :</strong> {{ $raison }}</p>
                @endif
            </div>

            <div class="details">
                <h3>Détails de la demande annulée :</h3>
                <p><strong>Référence :</strong> {{ $demande->reference }}</p>
                <p><strong>Date d'arrivée prévue :</strong> {{ $demande->date_arrivee->format('d/m/Y') }}</p>
                <p><strong>Date de création :</strong> {{ $demande->created_at->format('d/m/Y') }}</p>
                <p><strong>Statut final :</strong> Annulé</p>
            </div>

            <div class="feedback">
                <h3>Votre avis nous intéresse</h3>
                <p>Afin d'améliorer continuellement nos services, nous serions ravis de connaître les raisons de votre
                    annulation.</p>
                <p>Vous pouvez nous faire part de vos retours en répondant simplement à cet email.</p>
            </div>

            <p><strong>À bientôt peut-être ?</strong></p>
            <p>Si vous envisagez un futur voyage, n'hésitez pas à nous recontacter. Nous serons ravis de vous
                accompagner à nouveau.</p>

            <p>Pour toute question concernant cette annulation :</p>
            <p>📧 {{ config('mail.from.address') }}</p>
            <p>📞 +221 33 867 90 00</p>

            <a href="{{ route('conciergerie') }}" class="btn">
                Faire une nouvelle demande
            </a>

            <p>Nous vous remercions d'avoir considéré DJOK PRESTIGE pour vos besoins de conciergerie.</p>

            <p>Cordialement,<br>
                <strong>L'équipe DJOK PRESTIGE</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Cet email confirme l'annulation définitive de votre demande.</p>
        </div>
    </div>
</body>

</html>
