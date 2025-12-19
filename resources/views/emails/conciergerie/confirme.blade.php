<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre demande est confirmée !</title>
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
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
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

        .confirmed-badge {
            display: inline-block;
            padding: 8px 20px;
            background-color: #059669;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .success-box {
            background-color: #d1fae5;
            border: 2px solid #10b981;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            text-align: center;
        }

        .next-steps {
            background-color: #f0f9ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
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
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 15px 0;
        }

        .icon {
            font-size: 48px;
            color: #059669;
            margin: 20px 0;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
            margin: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #059669;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-left: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 5px;
            width: 14px;
            height: 14px;
            background-color: #059669;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🎉 Demande confirmée !</h1>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>

            <p>Félicitations ! Votre demande de service conciergerie <strong>#{{ $demande->reference }}</strong> a été
                officiellement confirmée.</p>

            <div class="confirmed-badge">
                Statut : Confirmé
            </div>

            <div class="success-box">
                <div class="icon">✓</div>
                <h3 style="color: #059669; margin-top: 10px;">Votre réservation est validée</h3>
                <p>Notre équipe commence dès maintenant les préparatifs pour votre séjour.</p>
            </div>

            <div class="details">
                <h3>Détails de votre réservation :</h3>
                <p><strong>Référence :</strong> {{ $demande->reference }}</p>
                <p><strong>Date d'arrivée :</strong> {{ $demande->date_arrivee->format('d/m/Y') }}</p>
                <p><strong>Montant total :</strong> {{ $demande->montant_formate }}</p>
                <p><strong>Nombre de personnes :</strong> {{ $demande->nombre_personnes }}</p>
            </div>

            <div class="next-steps">
                <h3>Ce qui se passe maintenant :</h3>

                <div class="timeline">
                    <div class="timeline-item">
                        <strong>Assignation de votre conseiller</strong>
                        <p>Un conseiller dédié vous sera attribué dans les 24h</p>
                    </div>

                    <div class="timeline-item">
                        <strong>Préparation du planning détaillé</strong>
                        <p>Nous établissons un planning précis pour votre séjour</p>
                    </div>

                    <div class="timeline-item">
                        <strong>Coordination des services</strong>
                        <p>Tous les prestataires sont contactés et briefés</p>
                    </div>

                    <div class="timeline-item">
                        <strong>Contact de confirmation</strong>
                        <p>Votre conseiller vous contactera pour finaliser les détails</p>
                    </div>
                </div>
            </div>

            <p><strong>Votre contact principal :</strong></p>
            <div style="background-color: #f0fdf4; padding: 15px; border-radius: 6px; margin: 15px 0;">
                <p>📧 {{ config('mail.from.address') }}</p>
                <p>📞 +221 33 867 90 00</p>
                <p>📱 WhatsApp : +221 33 867 90 00</p>
            </div>

            <p>Pour toute question ou modification, n'hésitez pas à contacter votre conseiller.</p>

            <a href="{{ route('conciergerie.suivi', $demande->reference) }}" class="btn">
                Voir les détails de ma demande
            </a>

            <p>Nous sommes ravis de pouvoir vous accompagner et nous mettons tout en œuvre pour rendre votre séjour
                exceptionnel.</p>

            <p>Cordialement,<br>
                <strong>L'équipe DJOK PRESTIGE</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Cet email confirme votre réservation. Conservez-le précieusement.</p>
        </div>
    </div>
</body>

</html>
