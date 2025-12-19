<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle Inscription - DJOK PRESTIGE</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #111827;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .header-alert {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .header-alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(220, 38, 38, 0.8), rgba(153, 27, 27, 0.8));
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .alert-title {
            color: white;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .alert-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 16px;
        }

        .status-panel {
            background: #fef3c7;
            border-left: 6px solid #f59e0b;
            padding: 20px;
            margin: 20px 30px;
            border-radius: 10px;
            text-align: center;
        }

        .status-text {
            font-size: 18px;
            font-weight: 600;
            color: #92400e;
        }

        .content {
            padding: 30px;
        }

        .section {
            margin-bottom: 35px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: white;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 18px;
            text-transform: uppercase;
        }

        .section-content {
            padding: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-card {
            background: #f9fafb;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .info-value {
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
        }

        .info-highlight {
            color: #dc2626;
            font-weight: 600;
        }

        .message-box {
            background: #f3f4f6;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #3b82f6;
            font-style: italic;
            color: #4b5563;
        }

        .empty-message {
            color: #9ca3af;
            font-style: italic;
        }

        .actions-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin: 30px 0;
        }

        .actions-title {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 25px;
            text-align: center;
            text-transform: uppercase;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .action-button {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .action-primary {
            background: linear-gradient(to right, #f59e0b, #fbbf24);
            color: black;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .action-success {
            background: linear-gradient(to right, #059669, #10b981);
            color: white;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
        }

        .action-warning {
            background: linear-gradient(to right, #d97706, #f59e0b);
            color: white;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
        }

        .action-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .tech-info {
            background: #1f2937;
            color: #d1d5db;
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
            font-size: 14px;
        }

        .tech-label {
            color: #9ca3af;
            font-size: 12px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .tech-value {
            font-family: monospace;
            background: #374151;
            padding: 8px 12px;
            border-radius: 6px;
            margin: 5px 0 15px 0;
        }

        .footer {
            background: #111827;
            color: #9ca3af;
            padding: 25px;
            text-align: center;
            font-size: 14px;
        }

        .notification-info {
            font-size: 12px;
            color: #6b7280;
            margin-top: 15px;
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px 15px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .section {
                margin: 15px 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-alert">
            <div class="header-content">
                <div class="alert-title">NOUVELLE INSCRIPTION</div>
                <div class="alert-subtitle">Formation Présentielle • {{ $formation->title }}</div>
            </div>
        </div>

        <div class="status-panel">
            <div class="status-text">ACTION REQUISE : Contact à établir sous 48h</div>
        </div>

        <div class="content">
            <div class="section">
                <div class="section-header">INFORMATIONS DU PARTICIPANT</div>
                <div class="section-content">
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-label">Nom complet</div>
                            <div class="info-value">{{ $participant->prenom }} {{ $participant->nom }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Email</div>
                            <div class="info-value">{{ $participant->email }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Téléphone</div>
                            <div class="info-value">{{ $participant->telephone }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Adresse</div>
                            <div class="info-value">{{ $participant->adresse }}, {{ $participant->code_postal }} {{
                                $participant->ville }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Date de naissance</div>
                            <div class="info-value">{{
                                \Carbon\Carbon::parse($participant->date_naissance)->format('d/m/Y') }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Âge</div>
                            <div class="info-value info-highlight">{{
                                \Carbon\Carbon::parse($participant->date_naissance)->age }} ans</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Permis obtenu le</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($participant->permis_date)->format('d/m/Y')
                                }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Ancienneté permis</div>
                            <div class="info-value info-highlight">{{
                                \Carbon\Carbon::parse($participant->permis_date)->diffInYears(now()) }} ans</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-header">FORMATION CHOISIE</div>
                <div class="section-content">
                    <div class="info-grid">
                        <div class="info-card">
                            <div class="info-label">Formation</div>
                            <div class="info-value">{{ $formation->title }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Référence</div>
                            <div class="info-value">#F-{{ $formation->id }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Format</div>
                            <div class="info-value">{{ $formation->format_affichage ?? 'Présentiel' }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Durée</div>
                            <div class="info-value">{{ $formation->duree }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Prix</div>
                            <div class="info-value info-highlight">{{ number_format($formation->price, 0, ',', ' ') }} €
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Financement</div>
                            <div class="info-value">{{ ucfirst(str_replace('_', ' ',
                                $participant->donnees_supplementaires['financement'] ?? 'personnel')) }}</div>
                        </div>
                        <div class="info-card">
                            <div class="info-label">Frais examen</div>
                            <div class="info-value">{{ $formation->frais_examen ?? 'Non inclus' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-header">MESSAGE DU PARTICIPANT</div>
                <div class="section-content">
                    @if($participant->notes)
                    <div class="message-box">
                        {{ $participant->notes }}
                    </div>
                    @else
                    <div class="empty-message">Aucun message fourni par le participant.</div>
                    @endif
                </div>
            </div>

            <div class="actions-section">
                <div class="actions-title">ACTIONS RAPIDES</div>
                <div class="actions-grid">
                    <a href="{{ url('/admin/participants/' . $participant->id) }}" class="action-button action-primary">
                        Accéder au dossier complet
                    </a>
                    <a href="mailto:{{ $participant->email }}" class="action-button action-success">
                        Contacter par email
                    </a>
                    <a href="tel:{{ $participant->telephone }}" class="action-button action-warning">
                        Appeler le participant
                    </a>
                </div>
            </div>

            <div class="section">
                <div class="section-header">ACTIONS REQUISES</div>
                <div class="section-content">
                    <ol style="padding-left: 20px; color: #1f2937;">
                        <li style="margin-bottom: 12px;"><strong>Contacter le participant</strong> sous 48h ouvrables
                        </li>
                        <li style="margin-bottom: 12px;"><strong>Vérifier les prérequis administratifs</strong> et
                            documents</li>
                        <li style="margin-bottom: 12px;"><strong>Confirmer l'inscription</strong> après validation du
                            dossier</li>
                        <li style="margin-bottom: 12px;"><strong>Envoyer le dossier d'inscription</strong> complet</li>
                        <li style="margin-bottom: 12px;"><strong>Planifier la session de formation</strong> avec le
                            participant</li>
                        <li><strong>Mettre à jour le statut</strong> dans le système</li>
                    </ol>
                </div>
            </div>

            <div class="tech-info">
                <div class="tech-label">DATE DE L'INSCRIPTION</div>
                <div class="tech-value">{{ now()->format('d/m/Y à H:i:s') }}</div>

                <div class="tech-label">REFERENCE INSCRIPTION</div>
                <div class="tech-value">#INS-{{ $participant->id }}</div>

                <div class="tech-label">ID PARTICIPANT</div>
                <div class="tech-value">{{ $participant->id }}</div>

                <div class="tech-label">ID FORMATION</div>
                <div class="tech-value">{{ $formation->id }}</div>
            </div>
        </div>

        <div class="footer">
            <div>Notification automatique - Système d'inscription DJOK PRESTIGE</div>
            <div class="notification-info">
                Cet email a été généré automatiquement suite à une nouvelle inscription sur le site.
                Ne pas répondre à cet email.
            </div>
        </div>
    </div>
</body>

</html>
