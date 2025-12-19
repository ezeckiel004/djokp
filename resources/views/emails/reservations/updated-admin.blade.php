<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation modifiée - #{{ $reservation->reference }}</title>
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
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
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

        .alert-badge {
            background-color: #dc2626;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        .email-body {
            padding: 30px;
        }

        .client-info {
            background-color: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .client-info h2 {
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
            border: 1px solid #1e429f;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .reservation-details h2 {
            color: #1e429f;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .changes-section {
            background-color: #fee2e2;
            border: 2px solid #dc2626;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .changes-section h3 {
            color: #991b1b;
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
            border-left: 3px solid #dc2626;
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

        .action-required {
            background-color: #fef2f2;
            border: 2px solid #ef4444;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }

        .action-required h3 {
            color: #b91c1c;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
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

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-left: 10px;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background-color: #d1fae5;
            color: #065f46;
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
            <h1>🔄 Réservation modifiée par le client</h1>
            <div class="alert-badge">Action requise</div>
        </div>

        <div class="email-body">
            <div class="client-info">
                <h2>👤 Informations client</h2>
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
                    <div class="info-item">
                        <span class="info-label">Statut :</span>
                        <span class="info-value">
                            {{ ucfirst($reservation->status) }}
                            <span class="status-badge status-pending">{{ $reservation->status }}</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Montant estimé :</span>
                        <span class="info-value" style="font-weight: bold; color: #1e429f;">
                            {{ number_format($reservation->total_amount, 2) }} €
                        </span>
                    </div>
                </div>
            </div>

            @if(count($changes) > 0)
            <div class="changes-section">
                <h3>📝 Modifications détectées</h3>
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
            <div class="info-item" style="background-color: #f0f9ff; border-color: #0ea5e9;">
                <span class="info-label">Instructions spéciales :</span>
                <span class="info-value">{{ $reservation->instructions }}</span>
            </div>
            @endif

            <div class="action-required">
                <h3>⚠️ Action requise</h3>
                <p>Vérifier la disponibilité du véhicule pour la nouvelle date/heure et mettre à jour l'affectation si
                    nécessaire.</p>
                <p><strong>Créée le :</strong> {{ $reservation->created_at->locale('fr')->isoFormat('dddd D MMMM YYYY
                    [à] HH:mm') }}</p>
                <p><strong>Modifiée le :</strong> {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}</p>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/admin/reservations/' . $reservation->id) }}" class="btn-admin">
                    🔍 Voir la réservation dans l'admin
                </a>
            </div>

            <p style="color: #6b7280; font-size: 14px; margin-top: 20px;">
                <em>Cet email a été envoyé automatiquement par le système de réservation VTC.</em>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Djok Prestige VTC - Système de notification</p>
            <p style="font-size: 12px; color: #d1d5db; margin-top: 10px;">
                ID Réservation: {{ $reservation->id }} | Référence: {{ $reservation->reference }}
            </p>
        </div>
    </div>
</body>

</html>