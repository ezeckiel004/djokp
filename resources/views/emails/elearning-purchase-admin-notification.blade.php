<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel achat e-learning | DJOK PRESTIGE Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #333333;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #cccccc;
        }

        .header {
            background-color: #dc2626;
            padding: 25px 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 25px;
        }

        .alert-box {
            background-color: #fee2e2;
            border: 1px solid #fca5a5;
            color: #dc2626;
            padding: 15px;
            border-radius: 6px;
            font-weight: bold;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .section {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e5e5e5;
        }

        .section-title {
            font-size: 17px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #3b82f6;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 10px;
        }

        .info-item {
            padding: 12px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border-left: 3px solid #3b82f6;
        }

        .info-label {
            font-size: 11px;
            color: #666666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 4px;
            display: block;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #222222;
        }

        .summary-box {
            background-color: #10b981;
            color: white;
            padding: 18px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .customer-details {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            padding: 18px;
            border-radius: 6px;
            margin-top: 15px;
        }

        .customer-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #d1d5db;
        }

        .customer-label {
            font-weight: 600;
            color: #92400e;
            font-size: 13px;
        }

        .customer-value {
            color: #1e293b;
            font-weight: 500;
            font-size: 13px;
        }

        .action-buttons {
            margin-top: 25px;
            text-align: center;
        }

        .button {
            display: inline-block;
            padding: 10px 22px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            margin: 0 8px;
        }

        .button:hover {
            background-color: #2563eb;
        }

        .button-secondary {
            background-color: #6b7280;
        }

        .button-secondary:hover {
            background-color: #4b5563;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-warning {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .stats-box {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            font-size: 12px;
            margin-top: 20px;
        }

        .stats-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .footer {
            background-color: #1e293b;
            color: #cccccc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            .content {
                padding: 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 18px;
            }

            .section-title {
                font-size: 16px;
            }

            .button {
                display: block;
                margin: 10px 0;
            }

            .customer-row {
                flex-direction: column;
            }

            .customer-label {
                margin-bottom: 3px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>NOUVEL ACHAT E-LEARNING</h1>
            <p>Notification système - {{ date('d/m/Y H:i') }}</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert -->
            <div class="alert-box">
                Nouvelle vente en ligne effectuée - Action requise
            </div>

            <!-- Summary -->
            <div class="summary-box">
                <div class="summary-item">
                    <span>Montant de la vente :</span>
                    <strong>{{ number_format($paiement->amount, 0, ',', ' ') }} €</strong>
                </div>
                <div class="summary-item">
                    <span>Type :</span>
                    <strong>E-learning</strong>
                </div>
                <div class="summary-item">
                    <span>Statut :</span>
                    <strong>Payé et confirmé</strong>
                </div>
            </div>

            <!-- Formation Details -->
            <div class="section">
                <div class="section-title">Formation vendue</div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">ID Formation</span>
                        <span class="info-value">#{{ $formation->id }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Référence paiement</span>
                        <span class="info-value">{{ $paiement->reference }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Date de l'achat</span>
                        <span class="info-value">{{ $paiement->paid_at->format('d/m/Y H:i:s') }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">ID Session Stripe</span>
                        <span class="info-value">{{ $paiement->stripe_session_id }}</span>
                    </div>
                </div>

                <div style="margin-top: 15px; padding: 15px; background-color: #f0f9ff; border-radius: 5px;">
                    <strong style="color: #1e3a8a; font-size: 16px;">{{ $formation->title }}</strong>
                    <p style="margin-top: 10px; font-size: 14px; color: #555;">
                        {{ Str::limit(strip_tags($formation->description), 150) }}
                    </p>
                    <div style="margin-top: 10px; font-size: 13px; color: #666;">
                        Durée : {{ $formation->duration_hours }} heures •
                        Type : {{ $formation->type_formation === 'e_learning' ? 'E-learning' : 'Présentiel' }} •
                        Prix : {{ number_format($formation->price, 0, ',', ' ') }} €
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="section">
                <div class="section-title">Informations client</div>

                <div class="customer-details">
                    @if($user)
                    <div class="customer-row">
                        <span class="customer-label">Client enregistré :</span>
                        <span class="status-badge status-success">OUI</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">ID Client :</span>
                        <span class="customer-value">{{ $user->id }}</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">Nom complet :</span>
                        <span class="customer-value">{{ $user->name }}</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">Email :</span>
                        <span class="customer-value">{{ $user->email }}</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">Compte créé le :</span>
                        <span class="customer-value">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    @else
                    <div class="customer-row">
                        <span class="customer-label">Client enregistré :</span>
                        <span class="status-badge status-error">NON</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">Nom :</span>
                        <span class="customer-value">{{ $paiement->customer_info['name'] ?? 'Non fourni' }}</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">Email :</span>
                        <span class="customer-value">{{ $paiement->customer_info['email'] ?? 'Non fourni' }}</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">Statut :</span>
                        <span class="customer-value" style="color: #dc2626; font-weight: bold;">
                            Compte à créer manuellement
                        </span>
                    </div>
                    @endif

                    <div class="customer-row">
                        <span class="customer-label">Mode de paiement :</span>
                        <span class="customer-value">Stripe</span>
                    </div>

                    <div class="customer-row">
                        <span class="customer-label">ID Paiement Stripe :</span>
                        <span class="customer-value" style="font-size: 11px;">{{ $paiement->stripe_payment_intent_id
                            }}</span>
                    </div>
                </div>
            </div>

            <!-- System Information -->
            <div class="section">
                <div class="section-title">Informations système</div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Accès attribué</span>
                        <span class="info-value">
                            @if($userFormation)
                            <span class="status-badge status-success">OUI</span>
                            @else
                            <span class="status-badge status-error">NON</span>
                            @endif
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Email confirmation</span>
                        <span class="info-value">
                            @if($emailSent)
                            <span class="status-badge status-success">ENVOYÉ</span>
                            @else
                            <span class="status-badge status-error">NON ENVOYÉ</span>
                            @endif
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Accès valide jusqu'au</span>
                        <span class="info-value">{{ now()->addYear()->format('d/m/Y') }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Référence interne</span>
                        <span class="info-value">{{ $paiement->reference }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="action-buttons">
                <a href="{{ url('/admin/paiements/' . $paiement->id) }}" class="button">
                    Voir le paiement
                </a>

                @if($user)
                <a href="{{ url('/admin/users/' . $user->id) }}" class="button button-secondary">
                    Voir le client
                </a>
                @endif

                <a href="{{ url('/admin/formations/' . $formation->id) }}" class="button button-secondary">
                    Voir la formation
                </a>
            </div>

            <!-- Quick Stats -->
            <div class="stats-box">
                <div class="stats-row">
                    <span><strong>Prix formation :</strong></span>
                    <span>{{ number_format($formation->price, 0, ',', ' ') }} €</span>
                </div>
                <div class="stats-row">
                    <span><strong>Type :</strong></span>
                    <span>{{ $formation->type_formation === 'e_learning' ? 'E-learning' : 'Présentiel' }}</span>
                </div>
                <div class="stats-row">
                    <span><strong>Durée :</strong></span>
                    <span>{{ $formation->duration_hours }} heures</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Notification automatique - Système DJOK PRESTIGE Formation</p>
            <p style="margin-top: 10px; opacity: 0.7; font-size: 11px;">
                © {{ date('Y') }} DJOK PRESTIGE. Cet email est envoyé automatiquement, merci de ne pas y répondre.
            </p>
        </div>
    </div>
</body>

</html>
