<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle réservation</title>
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
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .alert-badge {
            background-color: #ef4444;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .reservation-details {
            background-color: #fef2f2;
            border: 2px solid #fecaca;
            padding: 25px;
            margin: 25px 0;
            border-radius: 8px;
        }

        .detail-item {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }

        .detail-label {
            font-weight: bold;
            min-width: 180px;
            color: #7f1d1d;
        }

        .detail-value {
            color: #111827;
            flex: 1;
        }

        .client-info {
            background-color: #f0f9ff;
            border: 2px solid #0ea5e9;
            padding: 25px;
            margin: 25px 0;
            border-radius: 8px;
        }

        .actions {
            margin-top: 30px;
            padding: 25px;
            background-color: #f8fafc;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
        }

        .btn {
            display: inline-block;
            background-color: #dc2626;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 5px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #b91c1c;
        }

        .btn-secondary {
            background-color: #6b7280;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .btn-success {
            background-color: #10b981;
        }

        .btn-success:hover {
            background-color: #059669;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 2px solid #eee;
            margin-top: 30px;
        }

        .urgent {
            background-color: #fef3c7;
            color: #92400e;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
            font-weight: bold;
        }

        .reservation-id {
            font-size: 18px;
            color: #dc2626;
            font-weight: bold;
            padding: 10px;
            background-color: #fee2e2;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="alert-badge">🚨 NOUVELLE RÉSERVATION URGENTE</div>
            <h2 style="margin: 10px 0;">Nouvelle demande de réservation reçue</h2>
            <p>Demande reçue le {{ date('d/m/Y à H:i') }}</p>
        </div>

        <div class="content">
            <div class="reservation-id">
                📋 Référence : RES{{ strtoupper(substr(md5($data['email'] . time()), 0, 8)) }}
            </div>

            <div class="urgent">
                ⚡ <strong>ACTION REQUISE :</strong> Contacter le client dans les 30 minutes maximum
            </div>

            <div class="reservation-details">
                <h3 style="margin-top: 0; color: #b91c1c; border-bottom: 2px solid #fecaca; padding-bottom: 10px;">📋
                    DÉTAILS DE LA RÉSERVATION</h3>

                <div class="detail-item">
                    <div class="detail-label">Type de service :</div>
                    <div class="detail-value">
                        @php
                        $serviceTypes = [
                        'transfert' => 'Transfert aéroport/gare',
                        'professionnel' => 'Déplacement professionnel',
                        'evenement' => 'Événement/mariage',
                        'mise_disposition' => 'Mise à disposition'
                        ];
                        @endphp
                        <strong style="color: #dc2626;">{{ $serviceTypes[$data['type_service']] ?? $data['type_service']
                            }}</strong>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Trajet :</div>
                    <div class="detail-value">
                        🚩 <strong style="color: #1f2937;">{{ $data['depart'] }}</strong>
                        →
                        🏁 <strong style="color: #1f2937;">{{ $data['arrivee'] }}</strong>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Date et heure :</div>
                    <div class="detail-value">
                        📅 <strong>{{ \Carbon\Carbon::parse($data['date'])->locale('fr')->isoFormat('dddd D MMMM YYYY')
                            }}</strong>
                        à
                        🕐 <strong>{{ $data['heure'] }}</strong>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Véhicule demandé :</div>
                    <div class="detail-value">
                        @php
                        $vehicleTypes = [
                        'eco' => '🚗 Véhicule Éco',
                        'business' => '🚙 Véhicule Business',
                        'prestige' => '🏎️ Véhicule Prestige'
                        ];
                        @endphp
                        <strong>{{ $vehicleTypes[$data['type_vehicule']] ?? $data['type_vehicule'] }}</strong>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Nombre de passagers :</div>
                    <div class="detail-value">👥 <strong>{{ $data['passagers'] }} personne(s)</strong></div>
                </div>

                @if(!empty($data['instructions']))
                <div class="detail-item">
                    <div class="detail-label">Instructions spéciales :</div>
                    <div class="detail-value">
                        <div
                            style="background-color: #f3f4f6; padding: 10px; border-radius: 5px; border-left: 3px solid #6b7280;">
                            {{ $data['instructions'] }}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="client-info">
                <h3 style="margin-top: 0; color: #0ea5e9; border-bottom: 2px solid #bae6fd; padding-bottom: 10px;">👤
                    INFORMATIONS CLIENT</h3>

                <div class="detail-item">
                    <div class="detail-label">Nom complet :</div>
                    <div class="detail-value">
                        <strong>{{ $data['nom'] }}</strong>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Téléphone :</div>
                    <div class="detail-value">
                        📞 <a href="tel:{{ $data['telephone'] }}"
                            style="color: #0ea5e9; text-decoration: none; font-weight: bold;">{{ $data['telephone']
                            }}</a>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Email :</div>
                    <div class="detail-value">
                        📧 <a
                            href="mailto:{{ $data['email'] }}?subject=Confirmation%20réservation%20DJOK%20PRESTIGE&body=Bonjour%20{{ urlencode($data['nom']) }}%2C%0A%0ANous%20vous%20confirmons%20votre%20réservation...'"
                            style="color: #0ea5e9; text-decoration: none; font-weight: bold;">
                            {{ $data['email'] }}
                        </a>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Heure d'envoi :</div>
                    <div class="detail-value">
                        ⏰ {{ date('H:i') }} (il y a moins de 5 minutes)
                    </div>
                </div>
            </div>

            <div class="actions">
                <h3 style="margin-top: 0; color: #374151;">🎯 ACTIONS RECOMMANDÉES</h3>

                <div style="margin-bottom: 20px;">
                    <p><strong>Priorité :</strong>
                        @if($data['type_service'] == 'transfert' && strtotime($data['date']) == strtotime('today'))
                        <span style="color: #dc2626; font-weight: bold;">MAXIMUM (Transfert aujourd'hui)</span>
                        @elseif(strtotime($data['date']) <= strtotime('+2 days')) <span
                            style="color: #ea580c; font-weight: bold;">ÉLEVÉE (Dans 48h)</span>
                            @else
                            <span style="color: #059669; font-weight: bold;">NORMALE</span>
                            @endif
                    </p>
                </div>

                <div style="text-align: center;">
                    <p>
                        <a href="mailto:{{ $data['email'] }}?subject=Confirmation%20réservation%20DJOK%20PRESTIGE&body=Bonjour%20{{ urlencode($data['nom']) }}%2C%0A%0ANous%20vous%20confirmons%20votre%20réservation%20pour%20le%20{{ urlencode(\Carbon\Carbon::parse($data['date'])->locale('fr')->isoFormat('dddd D MMMM YYYY')) }}%20à%20{{ $data['heure'] }}.%0A%0ATrajet%20%3A%20{{ urlencode($data['depart']) }}%20→%20{{ urlencode($data['arrivee']) }}%0A%0ACordialement%2C%0AL%27équipe%20DJOK%20PRESTIGE"
                            class="btn-success" style="color: white; text-decoration: none;">
                            ✉️ Envoyer confirmation
                        </a>

                        <a href="tel:{{ $data['telephone'] }}" class="btn" style="color: white; text-decoration: none;">
                            📞 Appeler le client
                        </a>

                        <a href="{{ route('admin.reservations.index') }}" class="btn-secondary"
                            style="color: white; text-decoration: none;">
                            📋 Voir dans l'admin
                        </a>
                    </p>
                </div>

                <p style="margin-top: 20px; font-size: 12px; color: #6b7280;">
                    <strong>Note :</strong> Un email automatique a déjà été envoyé au client. Pensez à le contacter pour
                    confirmer la disponibilité du véhicule et finaliser la réservation.
                </p>
            </div>

            <p style="font-size: 12px; color: #6b7280; text-align: center;">
                <strong>Source :</strong> Formulaire de réservation site web •
                <strong>IP :</strong> {{ request()->ip() }} •
                <strong>User Agent :</strong> {{ substr(request()->userAgent(), 0, 50) }}...
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE - Système de notifications automatiques</p>
            <p><small>Cet email a été envoyé automatiquement depuis l'interface de réservation du site web.</small></p>
            <p><small>Vous recevez cet email car vous êtes administrateur du système.</small></p>
        </div>
    </div>
</body>

</html>
