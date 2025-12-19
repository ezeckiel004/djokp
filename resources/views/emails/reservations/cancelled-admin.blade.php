<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URGENT - Réservation annulée #{{ $reservation->reference }}</title>
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
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 22px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .urgent-badge {
            background-color: #ffffff;
            color: #dc2626;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .email-body {
            padding: 30px;
        }

        .cancellation-alert {
            background-color: #fee2e2;
            border: 3px solid #dc2626;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
            text-align: center;
        }

        .cancellation-alert h2 {
            color: #991b1b;
            margin-bottom: 15px;
            font-size: 20px;
        }

        .client-info {
            background-color: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .client-info h3 {
            color: #92400e;
            margin-bottom: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .info-item {
            background: white;
            padding: 12px;
            border-radius: 6px;
            border-left: 3px solid #f59e0b;
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

        .reservation-details {
            background-color: #f8fafc;
            border: 2px solid #1e429f;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .reservation-details h3 {
            color: #1e429f;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .timeline {
            background-color: #f0f9ff;
            border: 2px dashed #0ea5e9;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .timeline h3 {
            color: #0369a1;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e7eb;
        }

        .timeline-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            background-color: #dbeafe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .timeline-content {
            flex-grow: 1;
        }

        .timeline-time {
            color: #6b7280;
            font-size: 13px;
        }

        .action-required {
            background-color: #fef2f2;
            border: 3px solid #dc2626;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }

        .action-required h3 {
            color: #991b1b;
            margin-bottom: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-list {
            padding-left: 20px;
            margin: 15px 0;
        }

        .action-list li {
            margin-bottom: 10px;
            color: #4b5563;
        }

        .btn-urgent {
            display: inline-block;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            margin: 25px 0;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-urgent:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .btn-admin {
            display: inline-block;
            background: linear-gradient(135deg, #1e429f 0%, #1a56db 100%);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            margin: 20px 0;
            transition: transform 0.2s;
        }

        .btn-admin:hover {
            transform: translateY(-2px);
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #1f2937;
            color: white;
            font-size: 14px;
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

            .timeline-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .timeline-icon {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🚫 RÉSERVATION ANNULÉE</h1>
            <div class="urgent-badge">URGENT - ACTION REQUISE</div>
        </div>

        <div class="email-body">
            <div class="cancellation-alert">
                <h2>⚠️ UNE RÉSERVATION VIENT D'ÊTRE ANNULÉE PAR LE CLIENT</h2>
                <p style="font-size: 18px; font-weight: bold; color: #dc2626;">
                    Référence : #{{ $reservation->reference }}
                </p>
            </div>

            <div class="client-info">
                <h3>👤 Informations client</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nom complet :</span>
                        <span class="info-value">{{ $reservation->nom }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Téléphone :</span>
                        <span class="info-value">{{ $reservation->telephone }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email :</span>
                        <span class="info-value">{{ $reservation->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Client connecté :</span>
                        <span class="info-value">
                            {{ $reservation->user_id ? '✅ Oui' : '❌ Non' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="reservation-details">
                <h3>📋 Détails de la réservation annulée</h3>
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
                    <div class="info-item">
                        <span class="info-label">Montant estimé :</span>
                        <span class="info-value" style="color: #dc2626; font-weight: bold;">
                            {{ number_format($reservation->total_amount, 2) }} €
                        </span>
                    </div>
                </div>
            </div>

            @if($reservation->instructions)
            <div class="info-item" style="background-color: #f0f9ff; border-color: #0ea5e9;">
                <span class="info-label">Instructions spéciales :</span>
                <span class="info-value">{{ $reservation->instructions }}</span>
            </div>
            @endif

            <div class="timeline">
                <h3>⏰ Chronologie</h3>
                <div class="timeline-item">
                    <div class="timeline-icon">📅</div>
                    <div class="timeline-content">
                        <strong>Réservation créée</strong>
                        <div class="timeline-time">
                            {{ $reservation->created_at->locale('fr')->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}
                        </div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-icon">❌</div>
                    <div class="timeline-content">
                        <strong>Réservation annulée</strong>
                        <div class="timeline-time">
                            {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-required">
                <h3>🚨 ACTIONS REQUISES IMMÉDIATEMENT</h3>
                <ul class="action-list">
                    <li><strong>1. Libérer le créneau</strong> dans l'agenda du/des véhicule(s) concerné(s)</li>
                    <li><strong>2. Notifier le chauffeur</strong> si un chauffeur était déjà affecté</li>
                    <li><strong>3. Mettre à jour les statistiques</strong> d'annulation</li>
                    <li><strong>4. Vérifier si le client</strong> a d'autres réservations à venir</li>
                </ul>

                <div style="text-align: center; margin: 25px 0;">
                    <button class="btn-urgent" onclick="window.open('tel:+33176380017')">
                        📞 APPELER LE RESPONSABLE
                    </button>
                </div>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/admin/reservations/' . $reservation->id) }}" class="btn-admin">
                    🔍 VOIR LA RÉSERVATION DANS L'ADMIN
                </a>
            </div>

            <p style="color: #6b7280; font-size: 14px; margin-top: 20px; text-align: center;">
                <em>Cet email a été envoyé automatiquement par le système d'alerte des annulations.</em>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Djok Prestige VTC - Système d'alerte des annulations</p>
            <p style="font-size: 12px; color: #d1d5db; margin-top: 10px;">
                ID Réservation: {{ $reservation->id }} | Référence: {{ $reservation->reference }} | Annulée à: {{
                now()->format('H:i:s') }}
            </p>
        </div>
    </div>
</body>

</html>