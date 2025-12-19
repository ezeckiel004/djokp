<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALERTE - Nouvelle demande formation internationale</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }

        .alert-header {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin-bottom: 25px;
        }

        .alert-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .alert-badge {
            display: inline-block;
            background: #fbbf24;
            color: #78350f;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .reference {
            background: #1f2937;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-align: center;
            font-family: monospace;
            font-size: 18px;
            font-weight: 700;
            margin: 20px 0;
            letter-spacing: 1px;
            border: 2px solid #fbbf24;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 15px;
            margin-bottom: 20px;
            color: #1f2937;
            font-size: 18px;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 20px 0;
        }

        .info-item {
            padding: 10px 0;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #1f2937;
            font-size: 15px;
        }

        .urgent-box {
            background: #fef2f2;
            border: 2px solid #dc2626;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
        }

        .urgent-title {
            color: #dc2626;
            font-size: 20px;
            font-weight: 700;
            margin: 0 0 15px 0;
        }

        .deadline {
            background: #dc2626;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }

        .admin-actions {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }

        .btn {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s ease;
            font-size: 15px;
            margin: 5px 10px;
        }

        .btn:hover {
            background: #2563eb;
        }

        .btn-email {
            background: #059669;
        }

        .btn-phone {
            background: #0ea5e9;
        }

        .btn-whatsapp {
            background: #25D366;
        }

        .btn-admin {
            background: #6366f1;
        }

        .message-box {
            background: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            border-left: 4px solid #f59e0b;
            margin: 15px 0;
            white-space: pre-line;
            line-height: 1.8;
            font-size: 15px;
        }

        .formation-details {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border: 1px solid #38bdf8;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .formation-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e40af;
            margin: 10px 0;
            text-align: center;
        }

        .footer {
            border-top: 1px solid #e5e7eb;
            margin: 40px 0 20px 0;
            padding-top: 20px;
            color: #6b7280;
            font-size: 13px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 20px;
            }

            .alert-header {
                padding: 20px;
            }

            .btn {
                display: block;
                margin: 10px 0;
                width: 100%;
            }
        }

        a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- En-tête d'alerte -->
    <div class="alert-header">
        <span class="alert-badge">ACTION REQUISE</span>
        <h1>NOUVELLE DEMANDE FORMATION INTERNATIONALE</h1>
        <div style="margin-top: 10px; opacity: 0.9; font-size: 14px;">
            Notification système - Priorité haute
        </div>
    </div>

    <!-- Référence -->
    <div class="reference">
        RÉFÉRENCE : INT{{ $demande->id }}
    </div>

    <!-- Informations du demandeur -->
    <div class="card">
        <div class="card-header">📋 Informations du demandeur</div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nom complet</div>
                <div class="info-value">{{ $demande->nom_complet }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Nationalité</div>
                <div class="info-value">{{ $demande->nationalite }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">
                    <a href="mailto:{{ $demande->email }}">{{ $demande->email }}</a>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Téléphone</div>
                <div class="info-value">
                    <a href="tel:{{ $demande->telephone }}">{{ $demande->telephone }}</a>
                </div>
            </div>

            @if($demande->whatsapp && $demande->whatsapp != $demande->telephone)
            <div class="info-item">
                <div class="info-label">WhatsApp</div>
                <div class="info-value">
                    <a href="https://wa.me/{{ $demande->whatsapp }}">{{ $demande->whatsapp }}</a>
                </div>
            </div>
            @endif

            <div class="info-item">
                <div class="info-label">Statut</div>
                <div class="info-value">
                    <span
                        style="background: #10b981; color: white; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600;">
                        {{ ucfirst($demande->statut) }}
                    </span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Date de la demande</div>
                <div class="info-value">{{ $dateDemande }}</div>
            </div>
        </div>
    </div>

    <!-- Formation demandée -->
    <div class="formation-details">
        <div style="font-weight: 600; color: #0369a1; font-size: 16px; text-align: center;">FORMATION DEMANDÉE</div>
        <div class="formation-title">{{ $formationTitre }}</div>

        @if($demande->date_debut)
        <div style="text-align: center; margin-top: 15px;">
            <strong>Date de début souhaitée :</strong> {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y')
            }}
        </div>
        @endif

        @if($demande->duree)
        <div style="text-align: center; margin-top: 10px;">
            <strong>Durée estimée :</strong> {{ $demande->duree }}
        </div>
        @endif

        @if(!empty($services))
        <div style="margin-top: 20px;">
            <div style="font-weight: 600; color: #0369a1; margin-bottom: 10px; text-align: center;">Services demandés
            </div>
            <div style="display: flex; flex-wrap: wrap; gap: 8px; justify-content: center;">
                @foreach($services as $service)
                <span
                    style="background: white; color: #92400e; padding: 6px 12px; border-radius: 15px; font-size: 13px; font-weight: 500; border: 1px solid #fde68a;">
                    {{ $service }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Message du demandeur -->
    <div class="card">
        <div class="card-header">📝 Message du demandeur</div>
        <div class="message-box">
            {{ $demande->message }}
        </div>
    </div>

    <!-- Boîte urgente -->
    <div class="urgent-box">
        <div class="urgent-title">⚠️ ACTION REQUISE DANS LES 48 HEURES</div>
        <p style="color: #7f1d1d; line-height: 1.6; margin: 15px 0;">
            Ce prospect nécessite un suivi immédiat pour maximiser les chances de conversion.
            Le contact doit être établi dans les plus brefs délais.
        </p>
        <div class="deadline">
            Date limite : {{ \Carbon\Carbon::parse($demande->created_at)->addHours(48)->format('d/m/Y à H:i') }}
        </div>
    </div>

    <!-- Actions administratives -->
    <div class="admin-actions">
        <div style="font-weight: 600; color: #0369a1; margin-bottom: 20px; font-size: 16px;">
            Actions rapides recommandées
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
            <a href="mailto:{{ $demande->email }}" class="btn btn-email">
                📧 Répondre par email
            </a>

            <a href="tel:{{ $demande->telephone }}" class="btn btn-phone">
                📞 Appeler le demandeur
            </a>

            @if($demande->whatsapp)
            <a href="https://wa.me/{{ $demande->whatsapp }}" class="btn btn-whatsapp">
                💬 WhatsApp
            </a>
            @endif

            <a href="{{ $adminUrl }}" class="btn btn-admin">
                🖥️ Interface admin
            </a>
        </div>
    </div>

    <!-- Bouton principal -->
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $adminUrl }}" class="btn" style="padding: 14px 32px; font-size: 16px; background: #dc2626;">
            🔔 GÉRER CETTE DEMANDE DANS L'ADMIN
        </a>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        <p><strong>DJOK PRESTIGE - Système de notifications</strong></p>
        <p>Email automatique - Système de gestion des formations internationales</p>
        <p style="font-size: 12px; color: #9ca3af; margin-top: 10px;">
            Cette demande a été reçue via le formulaire public le {{ $dateDemande }}
        </p>
    </div>
</body>

</html>
