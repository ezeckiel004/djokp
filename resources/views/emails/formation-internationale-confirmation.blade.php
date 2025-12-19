<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre demande - DJOK PRESTIGE</title>
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

        .header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
        }

        .header-subtitle {
            margin-top: 10px;
            opacity: 0.9;
            font-size: 15px;
        }

        .card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 20px;
            margin-bottom: 25px;
            color: #1f2937;
            font-size: 20px;
            font-weight: 600;
        }

        .thank-you {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            margin: 25px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
            margin: 25px 0;
        }

        .info-item {
            padding: 12px 0;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 15px;
            margin-bottom: 8px;
        }

        .info-value {
            color: #1f2937;
            font-size: 16px;
        }

        .message-box {
            background: #f9fafb;
            padding: 25px;
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
            margin: 20px 0;
            white-space: pre-line;
            line-height: 1.8;
            font-size: 16px;
        }

        .badge-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .badge {
            display: inline-block;
            background: #dbeafe;
            color: #1e40af;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #bfdbfe;
        }

        .reference {
            background: #1f2937;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            text-align: center;
            font-family: monospace;
            font-size: 18px;
            font-weight: 600;
            margin: 20px 0;
            letter-spacing: 1px;
        }

        .contact-info {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            text-align: center;
        }

        .contact-item {
            padding: 15px;
        }

        .contact-label {
            font-weight: 600;
            color: #065f46;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .contact-value {
            color: #1f2937;
            font-size: 16px;
            font-weight: 500;
        }

        .next-steps {
            background: #fef3c7;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
        }

        .steps-list {
            margin: 15px 0 0 0;
            padding-left: 20px;
        }

        .steps-list li {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .footer {
            border-top: 1px solid #e5e7eb;
            margin: 40px 0 20px 0;
            padding-top: 25px;
            color: #6b7280;
            font-size: 14px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 25px 20px;
            }

            .card {
                padding: 25px 20px;
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
    <!-- En-tête -->
    <div class="header">
        <h1>DJOK PRESTIGE International</h1>
        <div class="header-subtitle">Votre partenaire pour des formations d'excellence à l'international</div>
    </div>

    <!-- Message de remerciement -->
    <div class="thank-you">
        <h2 style="margin-top: 0; color: #1e40af;">Merci pour votre demande, {{ $demande->prenom ??
            $demande->nom_complet }} !</h2>
        <p style="font-size: 16px; margin: 10px 0 0 0;">
            Nous avons bien reçu votre demande de formation internationale et nous vous en remercions.
        </p>
    </div>

    <!-- Référence -->
    <div class="reference">
        RÉFÉRENCE DE VOTRE DEMANDE : INT{{ $demande->id }}
    </div>

    <!-- Carte 1 : Récapitulatif -->
    <div class="card">
        <div class="card-header">Récapitulatif de votre demande</div>

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
                <div class="info-value">{{ $demande->email }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Téléphone</div>
                <div class="info-value">{{ $demande->telephone }}</div>
            </div>

            @if($demande->whatsapp && $demande->whatsapp != $demande->telephone)
            <div class="info-item">
                <div class="info-label">WhatsApp</div>
                <div class="info-value">{{ $demande->whatsapp }}</div>
            </div>
            @endif

            <div class="info-item">
                <div class="info-label">Date de la demande</div>
                <div class="info-value">{{ $dateDemande }}</div>
            </div>
        </div>
    </div>

    <!-- Carte 2 : Formation demandée -->
    <div class="card">
        <div class="card-header">Formation demandée</div>

        <div style="margin-bottom: 25px;">
            <div class="info-label">Formation souhaitée</div>
            <div class="info-value" style="font-size: 20px; color: #1e40af; font-weight: 600;">
                {{ $formationTitre }}
            </div>
        </div>

        @if($demande->date_debut)
        <div style="margin-bottom: 20px;">
            <div class="info-label">Date de début souhaitée</div>
            <div class="info-value">{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</div>
        </div>
        @endif

        @if($demande->duree)
        <div style="margin-bottom: 20px;">
            <div class="info-label">Durée estimée</div>
            <div class="info-value">{{ $demande->duree }}</div>
        </div>
        @endif

        @if(!empty($services))
        <div style="margin-top: 25px;">
            <div class="info-label">Services demandés</div>
            <div class="badge-container">
                @foreach($services as $service)
                <span class="badge">{{ $service }}</span>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Carte 3 : Votre message -->
    <div class="card">
        <div class="card-header">Votre message</div>
        <div class="message-box">
            {{ $demande->message }}
        </div>
    </div>

    <!-- Prochaines étapes -->
    <div class="next-steps">
        <h3 style="margin-top: 0; color: #92400e;">Les prochaines étapes</h3>
        <ul class="steps-list">
            <li><strong>Sous 48 heures</strong> : Un conseiller spécialisé vous contactera par téléphone ou email</li>
            <li><strong>Étude de votre projet</strong> : Analyse détaillée de vos besoins et objectifs</li>
            <li><strong>Proposition sur mesure</strong> : Élaboration d'un programme adapté à vos exigences</li>
            <li><strong>Devis personnalisé</strong> : Envoi d'une proposition détaillée avec tous les coûts</li>
            <li><strong>Planification</strong> : Organisation logistique et administrative</li>
        </ul>
    </div>

    <!-- Contact -->
    <div class="contact-info">
        <h3 style="margin-top: 0; color: #065f46; text-align: center;">Pour toute question</h3>
        <div class="contact-grid">
            <div class="contact-item">
                <div class="contact-label">Téléphone</div>
                <div class="contact-value">{{ $telephoneContact }}</div>
            </div>
            <div class="contact-item">
                <div class="contact-label">WhatsApp</div>
                <div class="contact-value">{{ $whatsappContact }}</div>
            </div>
            <div class="contact-item">
                <div class="contact-label">Email</div>
                <div class="contact-value">{{ $emailContact }}</div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        <p><strong>DJOK PRESTIGE - Service International</strong></p>
        <p>Email automatique de confirmation - Ne pas répondre à cet email</p>
        <p style="font-size: 13px; color: #9ca3af; margin-top: 15px;">
            Si vous n'avez pas fait cette demande, veuillez ignorer cet email.<br>
            Votre demande a été enregistrée le {{ $dateDemande }}
        </p>
    </div>
</body>

</html>
