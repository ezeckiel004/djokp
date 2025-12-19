<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre devis est prêt !</title>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

        .success-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: #10b981;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .devis-box {
            background-color: #f0fdf4;
            border: 2px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
        }

        .devis-amount {
            font-size: 28px;
            color: #10b981;
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
        }

        .devis-details {
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 15px 0;
        }

        .steps {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .step-number {
            background-color: #4f46e5;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Votre devis est prêt !</h1>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>

            <p>Nous avons le plaisir de vous informer que votre devis pour la demande <strong>#{{ $demande->reference
                    }}</strong> est maintenant disponible.</p>

            <div class="success-badge">
                Statut : Devis envoyé
            </div>

            <div class="devis-box">
                <h3 style="text-align: center; color: #059669;">VOTRE DEVIS PERSONNALISÉ</h3>

                <div class="devis-amount">
                    {{ $demande->montant_formate }}
                </div>

                <p style="text-align: center;">Ce montant inclut tous les services demandés et les prestations
                    associées.</p>
            </div>

            <div class="devis-details">
                <h3>Détails de votre devis :</h3>
                {!! nl2br(e($details)) !!}

                @if(!empty($notes))
                <div style="background-color: #fef3c7; padding: 15px; border-radius: 6px; margin-top: 15px;">
                    <strong>Notes de notre équipe :</strong>
                    <p>{!! nl2br(e($notes)) !!}</p>
                </div>
                @endif
            </div>

            <div class="steps">
                <h3>Prochaines étapes :</h3>

                <div class="step">
                    <div class="step-number">1</div>
                    <div>
                        <strong>Examinez votre devis</strong>
                        <p>Prenez le temps de lire attentivement tous les détails</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div>
                        <strong>Contactez-nous pour toute question</strong>
                        <p>Nous sommes disponibles pour répondre à vos interrogations</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div>
                        <strong>Confirmez votre demande</strong>
                        <p>Pour valider le devis et débuter les préparatifs</p>
                    </div>
                </div>
            </div>

            <p>Pour confirmer votre demande ou pour toute question concernant ce devis, vous pouvez :</p>
            <p>📧 Nous répondre directement à cet email</p>
            <p>📞 Nous appeler au +221 33 867 90 00</p>

            <p>Vous pouvez suivre l'évolution de votre demande à tout moment :</p>
            <a href="{{ route('conciergerie.suivi', $demande->reference) }}" class="btn">
                Suivre ma demande
            </a>

            <p>Cordialement,<br>
                <strong>L'équipe DJOK PRESTIGE</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Ce devis est valable 30 jours à compter de la date d'envoi.</p>
        </div>
    </div>
</body>

</html>
