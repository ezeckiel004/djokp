<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation d'inscription - DJOK PRESTIGE</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            padding: 40px 20px;
            text-align: center;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .logo {
            color: #fbbf24;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .logo-subtitle {
            color: white;
            font-size: 16px;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .main-title {
            color: white;
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            text-transform: uppercase;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            color: #1a1a1a;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #fbbf24;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            color: #fbbf24;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #fbbf24;
            text-transform: uppercase;
        }

        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #fbbf24;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .info-item {
            margin-bottom: 12px;
            display: flex;
        }

        .info-label {
            font-weight: 600;
            color: #374151;
            min-width: 160px;
        }

        .info-value {
            color: #1f2937;
        }

        .steps-list {
            list-style: none;
            padding: 0;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .step-number {
            background: #fbbf24;
            color: black;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .step-description {
            color: #6b7280;
            font-size: 14px;
        }

        .contact-section {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin: 30px 0;
        }

        .contact-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: white;
            text-transform: uppercase;
        }

        .contact-item {
            margin-bottom: 10px;
        }

        .button {
            display: inline-block;
            background: linear-gradient(to right, #f59e0b, #fbbf24);
            color: black;
            text-decoration: none;
            font-weight: 600;
            padding: 14px 32px;
            border-radius: 8px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        }

        .footer {
            background: #111827;
            color: #9ca3af;
            padding: 30px;
            text-align: center;
            font-size: 14px;
        }

        .footer-links {
            margin-bottom: 20px;
        }

        .footer-link {
            color: #fbbf24;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .copyright {
            font-size: 12px;
            color: #6b7280;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px 15px;
            }

            .info-item {
                flex-direction: column;
            }

            .info-label {
                margin-bottom: 5px;
            }

            .step-item {
                flex-direction: column;
            }

            .step-number {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <div class="logo">DJOK PRESTIGE</div>
                <div class="logo-subtitle">VTC • Formations • Entrepreneuriat</div>
                <div class="main-title">CONFIRMATION DE VOTRE INSCRIPTION</div>
            </div>
        </div>

        <div class="content">
            <div class="greeting">
                Bonjour {{ $participant->prenom }} {{ $participant->nom }},
            </div>

            <p>Nous accusons réception de votre demande d'inscription à la formation <strong>"{{ $formation->title
                    }}"</strong>. Votre dossier est maintenant en cours de traitement.</p>

            <div class="section">
                <div class="section-title">DETAILS DE VOTRE INSCRIPTION</div>
                <div class="info-box">
                    <div class="info-item">
                        <span class="info-label">Formation :</span>
                        <span class="info-value">{{ $formation->title }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Format :</span>
                        <span class="info-value">{{ $formation->format_affichage ?? 'Présentiel' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Durée :</span>
                        <span class="info-value">{{ $formation->duree }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Prix :</span>
                        <span class="info-value">{{ number_format($formation->price, 0, ',', ' ') }} €</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Frais d'examen :</span>
                        <span class="info-value">{{ $formation->frais_examen ?? 'Non inclus' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Financement :</span>
                        <span class="info-value">{{ ucfirst(str_replace('_', ' ',
                            $participant->donnees_supplementaires['financement'] ?? 'personnel')) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date d'inscription :</span>
                        <span class="info-value">{{ now()->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">PROCHAINE ETAPE</div>
                <p>Notre équipe pédagogique va étudier votre dossier et vous contactera sous <strong>48h
                        ouvrables</strong> pour :</p>

                <ul class="steps-list">
                    <li class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <div class="step-title">Confirmer votre inscription</div>
                            <div class="step-description">Vérification de votre dossier complet</div>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <div class="step-title">Présenter les démarches administratives</div>
                            <div class="step-description">Guide des documents nécessaires</div>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <div class="step-title">Planifier le début de votre formation</div>
                            <div class="step-description">Dates et horaires disponibles</div>
                        </div>
                    </li>
                    <li class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <div class="step-title">Expliquer les modalités de paiement</div>
                            <div class="step-description">Options et échéanciers</div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="contact-section">
                <div class="contact-title">BESOIN D'AIDE ?</div>
                <div class="contact-item">
                    <strong>Téléphone :</strong> 01 76 38 00 17
                </div>
                <div class="contact-item">
                    <strong>Email :</strong> formation@djokprestige.com
                </div>
                <div class="contact-item">
                    <strong>Horaires :</strong> Lundi-Vendredi 9h-19h
                </div>
            </div>

            <div class="section">
                <div class="section-title">DOCUMENTS A PREPARER</div>
                <p>Pour faciliter le traitement de votre dossier, préparez les documents suivants :</p>
                <ul style="color: #4b5563; margin-left: 20px;">
                    <li>Photocopie de la carte d'identité recto-verso</li>
                    <li>Photocopie du permis de conduire</li>
                    <li>Justificatif de domicile de moins de 3 mois</li>
                    <li>Photo d'identité récente format passeport</li>
                </ul>
            </div>

            <div style="text-align: center; margin: 40px 0;">
                <a href="{{ route('formation') }}" class="button">
                    Découvrir nos autres formations
                </a>
            </div>

            <p style="color: #6b7280; font-size: 14px; margin-top: 30px;">
                <strong>L'équipe DJOK PRESTIGE Formation</strong><br>
                Votre succès est notre priorité
            </p>
        </div>

        <div class="footer">
            <div class="footer-links">
                <a href="{{ route('home') }}" class="footer-link">Accueil</a>
                <a href="{{ route('formation') }}" class="footer-link">Formations</a>
                <a href="{{ route('contact') }}" class="footer-link">Contact</a>
                <a href="{{ route('cgv') }}" class="footer-link">CGV</a>
                <a href="{{ route('rgpd') }}" class="footer-link">Confidentialité</a>
            </div>
            <div class="copyright">
                Vous avez reçu cet email car vous avez soumis une demande d'inscription sur notre site.<br>
                Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet email ou nous contacter.<br><br>
                © {{ date('Y') }} DJOK PRESTIGE - Tous droits réservés
            </div>
        </div>
    </div>
</body>

</html>
