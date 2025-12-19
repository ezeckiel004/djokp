<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre demande est en cours de traitement</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: #4f46e5;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .info-box {
            background-color: #f8fafc;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .details {
            background-color: #f1f5f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .details h3 {
            color: #1e293b;
            margin-top: 0;
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

        .contact-info {
            background-color: #f0f9ff;
            border: 1px solid #e0f2fe;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Votre demande est en cours de traitement</h1>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>

            <p>Nous tenons à vous informer que votre demande de service conciergerie <strong>#{{ $demande->reference
                    }}</strong> est maintenant en cours de traitement par notre équipe.</p>

            <div class="status-badge">
                Statut : En cours de traitement
            </div>

            <div class="info-box">
                <p>Notre équipe examine actuellement vos besoins spécifiques et prépare une offre personnalisée pour
                    vous. Nous vous contacterons très prochainement pour discuter des détails.</p>
            </div>

            <div class="details">
                <h3>Récapitulatif de votre demande :</h3>
                <p><strong>Date d'arrivée :</strong> {{ $demande->date_arrivee->format('d/m/Y') }}</p>
                <p><strong>Durée du séjour :</strong> {{ $demande->duree_sejour }}</p>
                <p><strong>Nombre de personnes :</strong> {{ $demande->nombre_personnes }}</p>
                <p><strong>Motif du voyage :</strong> {{ $demande->motif_label }}</p>

                @if(!empty($demande->services) && is_array($demande->services))
                <p><strong>Services demandés :</strong></p>
                <ul>
                    @foreach($demande->services as $service)
                    <li>{{ $service }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="contact-info">
                <p><strong>Besoin d'une modification ?</strong></p>
                <p>Si vous souhaitez modifier certaines informations de votre demande, n'hésitez pas à nous contacter :
                </p>
                <p>📧 {{ config('mail.from.address') }}</p>
                <p>📞 +221 33 867 90 00</p>
            </div>

            <p>Vous pouvez suivre l'évolution de votre demande à tout moment en utilisant le lien ci-dessous :</p>
            <a href="{{ route('conciergerie.suivi', $demande->reference) }}" class="btn">
                Suivre ma demande
            </a>

            <p>Cordialement,<br>
                <strong>L'équipe DJOK PRESTIGE</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Cet email vous a été envoyé automatiquement. Veuillez ne pas y répondre directement.</p>
        </div>
    </div>
</body>

</html>
