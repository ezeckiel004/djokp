<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation de réservation confirmée</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .email-header .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
            display: block;
        }

        .email-body {
            padding: 30px;
        }

        .cancellation-alert {
            background-color: #fef2f2;
            border: 2px solid #ef4444;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
        }

        .cancellation-alert h2 {
            color: #dc2626;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .reservation-details {
            background-color: #f8fafc;
            border: 2px dashed #9ca3af;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .reservation-details h2 {
            color: #4b5563;
            margin-bottom: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .info-value {
            color: #111827;
            font-size: 15px;
        }

        .cancellation-info {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .cancellation-info h3 {
            color: #92400e;
            margin-bottom: 10px;
        }

        .btn-secondary {
            display: inline-block;
            background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            transition: transform 0.2s;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
        }

        .new-reservation {
            background-color: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            margin: 30px 0;
        }

        .new-reservation h3 {
            color: #0369a1;
            margin-bottom: 15px;
        }

        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #1a56db 0%, #1e429f 100%);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin: 15px 0;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .contact-info {
            background-color: #dcfce7;
            border: 1px solid #22c55e;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }

        .phone-number {
            font-size: 20px;
            font-weight: bold;
            color: #166534;
            display: block;
            margin: 15px 0;
            letter-spacing: 1px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8fafc;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .email-body {
                padding: 20px;
            }

            .email-header {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <div class="logo">DJOK PRESTIGE VTC</div>
            <h1>❌ Annulation confirmée</h1>
            <p>Votre réservation a été annulée</p>
        </div>

        <div class="email-body">
            <div class="cancellation-alert">
                <h2>🔄 Réservation annulée</h2>
                <p>Votre réservation <strong>#{{ $reservation->reference }}</strong> a été annulée avec succès.</p>
            </div>

            <p>Bonjour <strong>{{ $reservation->nom }}</strong>,</p>

            <p>Nous accusons réception de l'annulation de votre réservation. Voici les détails de la réservation annulée
                :</p>

            <div class="reservation-details">
                <h2>📋 Détails de la réservation annulée</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Référence :</span>
                        <span class="info-value">{{ $reservation->reference }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Service :</span>
                        <span class="info-value">{{ ucfirst($reservation->type_service) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date prévue :</span>
                        <span class="info-value">{{
                            \Carbon\Carbon::parse($reservation->date)->locale('fr')->isoFormat('dddd D MMMM YYYY')
                            }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Heure :</span>
                        <span class="info-value">{{ $reservation->heure }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Départ :</span>
                        <span class="info-value">{{ $reservation->depart }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Arrivée :</span>
                        <span class="info-value">{{ $reservation->arrivee }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Véhicule :</span>
                        <span class="info-value">{{ ucfirst($reservation->type_vehicule) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Passagers :</span>
                        <span class="info-value">{{ $reservation->passagers }}</span>
                    </div>
                </div>
            </div>

            <div class="cancellation-info">
                <h3>ℹ️ Information</h3>
                <p>Nous sommes désolés que vous ayez dû annuler votre réservation.</p>
                <p>En fonction de notre politique d'annulation, aucun frais ne vous sera facturé pour cette annulation.
                </p>
            </div>

            <div class="new-reservation">
                <h3>🚗 Souhaitez-vous réserver à nouveau ?</h3>
                <p>Nous serions ravis de vous accueillir à nouveau pour votre prochain trajet.</p>
                <p>Notre équipe reste à votre disposition pour toute nouvelle réservation.</p>

                <div style="margin: 25px 0;">
                    <a href="{{ route('client.reservations.create') }}" class="btn-primary">
                        ✨ Faire une nouvelle réservation
                    </a>
                </div>
            </div>

            <div class="contact-info">
                <p><strong>Pour toute nouvelle réservation ou information :</strong></p>
                <span class="phone-number">📞 01 76 38 00 17</span>
                <p>Email : vtc@djokprestige.com</p>
                <p style="margin-top: 10px; font-size: 14px; color: #4b5563;">
                    Horaires : Lundi - Dimanche, 7h00 - 23h00
                </p>
            </div>

            <p style="margin-top: 20px; text-align: center; color: #6b7280;">
                Nous espérons vous revoir bientôt sur nos routes !
            </p>

            <p style="margin-top: 20px;">Cordialement,<br>
                <strong>L'équipe Djok Prestige VTC</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Djok Prestige VTC. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement suite à l'annulation de votre réservation.</p>
        </div>
    </div>
</body>

</html>
