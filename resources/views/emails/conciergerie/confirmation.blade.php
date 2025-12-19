<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis envoyé - {{ $demande->reference }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1e40af;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .content {
            padding: 30px;
        }

        .devis-box {
            background-color: #eff6ff;
            border: 2px solid #3b82f6;
            border-radius: 10px;
            padding: 25px;
            margin: 20px 0;
            text-align: center;
        }

        .devis-amount {
            font-size: 36px;
            font-weight: bold;
            color: #1e40af;
            margin: 10px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }

        .info-card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
        }

        .info-title {
            font-weight: bold;
            color: #475569;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .info-value {
            color: #1e293b;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: bold;
            margin: 10px 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2563eb;
        }

        .footer {
            background-color: #1e293b;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1 style="margin: 0; font-size: 24px;">Devis Conciergerie</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">DJOK PRESTIGE</p>
        </div>

        <div class="content">
            <h2 style="color: #1e40af; margin-bottom: 20px;">Bonjour {{ $demande->nom_complet }},</h2>

            <p style="margin-bottom: 20px;">Nous avons préparé votre devis personnalisé comme demandé.</p>

            <div class="devis-box">
                <div style="color: #475569; margin-bottom: 10px;">Montant du devis</div>
                <div class="devis-amount">{{ $demande->montant_formate }}</div>
                <div style="color: #64748b; margin-top: 10px;">Référence : {{ $demande->reference }}</div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="info-title">Validité du devis</div>
                    <div class="info-value">30 jours</div>
                </div>
                <div class="info-card">
                    <div class="info-title">Date d'arrivée</div>
                    <div class="info-value">{{ $demande->date_arrivee->format('d/m/Y') }}</div>
                </div>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="#" class="btn">📄 Voir le devis complet</a>
                <a href="mailto:conciergerie@djokprestige.com" class="btn" style="background-color: #10b981;">
                    ✉️ Nous contacter
                </a>
            </div>
        </div>

        <div class="footer">
            <p style="margin: 0; font-size: 14px;">© {{ date('Y') }} DJOK PRESTIGE</p>
            <p style="margin: 10px 0 0 0; font-size: 12px; opacity: 0.8;">Tous droits réservés</p>
        </div>
    </div>
</body>

</html>
