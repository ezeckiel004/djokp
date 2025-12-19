<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de réservation confirmée</title>
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
            background: linear-gradient(135deg, #1a56db 0%, #1e429f 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
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

        .reservation-info {
            background-color: #f8fafc;
            border-left: 4px solid #1a56db;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 5px;
        }

        .reservation-info h2 {
            color: #1e429f;
            margin-bottom: 15px;
            font-size: 18px;
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
        }

        .info-value {
            color: #111827;
            font-size: 15px;
        }

        .changes-section {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .changes-section h3 {
            color: #d97706;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .change-item {
            background: white;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 10px;
            border-left: 3px solid #f59e0b;
        }

        .old-value {
            text-decoration: line-through;
            color: #9ca3af;
        }

        .new-value {
            color: #059669;
            font-weight: 600;
        }

        .arrow {
            color: #6b7280;
            margin: 0 10px;
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
            margin: 20px 0;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .instructions-box {
            background-color: #f0f9ff;
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8fafc;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
        }

        .contact-info {
            background-color: #dcfce7;
            border: 1px solid #22c55e;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
        }

        .phone-number {
            font-size: 18px;
            font-weight: bold;
            color: #166534;
            display: block;
            margin: 10px 0;
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
            <h1>Modification confirmée ✅</h1>
            <p>Votre réservation a été modifiée avec succès</p>
        </div>

        <div class="email-body">
            <p>Bonjour <strong>{{ $reservation->nom }}</strong>,</p>

            <p>Votre réservation <strong>#{{ $reservation->reference }}</strong> a été modifiée avec succès.</p>

            <div class="reservation-info">
                <h2>📋 Détails de la réservation</h2>
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
                        <span class="info-label">Date :</span>
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

            @if(count($changes) > 0)
            <div class="changes-section">
                <h3>🔄 Modifications apportées</h3>
                @foreach($changes as $field => $change)
                <div class="change-item">
                    <strong>{{ $field }}</strong><br>
                    <span class="old-value">{{ $change['old'] }}</span>
                    <span class="arrow">→</span>
                    <span class="new-value">{{ $change['new'] }}</span>
                </div>
                @endforeach
            </div>
            @endif

            @if($reservation->instructions)
            <div class="instructions-box">
                <h3>📝 Instructions spéciales</h3>
                <p>{{ $reservation->instructions }}</p>
            </div>
            @endif

            <div class="info-item">
                <span class="info-label">Montant estimé :</span>
                <span class="info-value" style="font-size: 18px; color: #1e429f; font-weight: bold;">
                    {{ number_format($reservation->total_amount, 2) }} €
                </span>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('client.reservations.show', $reservation->id) }}" class="btn-primary">
                    👁️ Voir ma réservation
                </a>
            </div>

            <div class="contact-info">
                <p><strong>Besoin d'aide ou de modifier à nouveau ?</strong></p>
                <p>Contactez-nous au :</p>
                <span class="phone-number">📞 01 76 38 00 17</span>
                <p>Ou par email : vtc@djokprestige.com</p>
            </div>

            <p style="margin-top: 20px;">Cordialement,<br>
                <strong>L'équipe Djok Prestige VTC</strong>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Djok Prestige VTC. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>

</html>
