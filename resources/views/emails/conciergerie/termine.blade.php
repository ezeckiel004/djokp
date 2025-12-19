<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre séjour est terminé</title>
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
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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

        .thank-you-box {
            background-color: #faf5ff;
            border: 2px solid #8b5cf6;
            padding: 30px;
            margin: 20px 0;
            border-radius: 8px;
            text-align: center;
        }

        .review-request {
            background-color: #f0f9ff;
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
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 15px 0;
        }

        .icon {
            font-size: 48px;
            color: #8b5cf6;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Merci d'avoir choisi DJOK PRESTIGE !</h1>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>

            <p>Votre séjour avec la référence <strong>#{{ $demande->reference }}</strong> est maintenant terminé.</p>

            <div class="thank-you-box">
                <div class="icon">🌟</div>
                <h3 style="color: #8b5cf6; margin-top: 10px;">Merci pour votre confiance !</h3>
                <p>Nous espérons que votre séjour s'est déroulé à votre entière satisfaction et que nos services ont
                    répondu à vos attentes.</p>
            </div>

            <div class="review-request">
                <h3>Votre avis compte énormément pour nous</h3>
                <p>Pour nous aider à améliorer nos services et aider d'autres voyageurs, nous serions honorés si vous
                    pouviez prendre quelques minutes pour nous donner votre retour.</p>

                <p><strong>Comment était votre expérience ?</strong></p>

                <a href="mailto:{{ config('mail.from.address') }}?subject=Avis%20sur%20le%20séjour%20{{ $demande->reference }}"
                    class="btn">
                    Donner mon avis
                </a>
            </div>

            <p><strong>À très bientôt !</strong></p>
            <p>Nous espérons avoir le plaisir de vous accompagner à nouveau lors d'un prochain séjour.</p>

            <p>Pour toute question ou pour planifier un futur voyage :</p>
            <p>📧 {{ config('mail.from.address') }}</p>
            <p>📞 +221 33 867 90 00</p>

            <p>Encore merci pour votre confiance,</p>
            <p><strong>L'équipe DJOK PRESTIGE</strong></p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Nous espérons vous revoir très bientôt !</p>
        </div>
    </div>
</body>

</html>
