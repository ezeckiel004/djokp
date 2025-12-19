<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre demande</title>
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
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
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

        .status-box {
            background-color: #f8fafc;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Mise à jour de votre demande</h1>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>

            <p>Votre demande de service conciergerie <strong>#{{ $demande->reference }}</strong> a été mise à jour.</p>

            <div class="status-box">
                <p><strong>Ancien statut :</strong> {{ $demande::STATUTS[$ancienStatut] ?? $ancienStatut }}</p>
                <p><strong>Nouveau statut :</strong> {{ $demande::STATUTS[$nouveauStatut] ?? $nouveauStatut }}</p>
            </div>

            <p>Vous pouvez suivre l'évolution de votre demande à tout moment :</p>

            <a href="{{ route('conciergerie.suivi', $demande->reference) }}" class="btn">
                Suivre ma demande
            </a>

            <p>Pour toute question concernant cette mise à jour :</p>
            <p>📧 {{ config('mail.from.address') }}</p>
            <p>📞 +221 33 867 90 00</p>

            <p>Cordialement,<br>
                <strong>L'équipe DJOK PRESTIGE</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
        </div>
    </div>
</body>

</html>
