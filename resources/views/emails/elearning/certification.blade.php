<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre certificat de formation - DJOK PRESTIGE</title>
    <style>
        /* Reset et styles de base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .email-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        /* Header */
        .header {
            background-color: #1a1a1a;
            padding: 40px 30px;
            text-align: center;
        }

        .logo {
            color: #b89449;
            font-size: 28px;
            font-weight: bold;
            text-decoration: none;
            margin-bottom: 20px;
            display: block;
        }

        .title {
            color: #ffffff;
            font-size: 28px;
            font-weight: bold;
            margin: 0;
            line-height: 1.3;
        }

        .subtitle {
            color: #b89449;
            font-size: 18px;
            margin: 10px 0 0 0;
            font-weight: normal;
        }

        /* Contenu principal */
        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #333333;
        }

        .greeting strong {
            color: #1a1a1a;
        }

        .message {
            color: #555555;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Boîte de certificat */
        .certificate-box {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
            border: 1px solid #eaeaea;
        }

        .certificate-title {
            color: #b89449;
            font-size: 22px;
            font-weight: bold;
            margin: 0 0 20px 0;
            text-align: center;
        }

        .certificate-info {
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eeeeee;
        }

        .info-label {
            font-weight: bold;
            color: #1a1a1a;
            width: 160px;
            flex-shrink: 0;
        }

        .info-value {
            color: #555555;
            flex-grow: 1;
        }

        /* Section fichier joint */
        .attachment-section {
            background-color: #f0f7ff;
            border-radius: 8px;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
            border: 2px dashed #b89449;
        }

        .attachment-title {
            color: #1a1a1a;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .attachment-file {
            display: inline-block;
            background-color: #ffffff;
            padding: 12px 25px;
            border-radius: 6px;
            border: 1px solid #b89449;
            color: #1a1a1a;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0;
        }

        .attachment-note {
            color: #666666;
            font-size: 14px;
            margin-top: 15px;
            font-style: italic;
        }

        /* Instructions */
        .instructions {
            background-color: #fff8e1;
            border-left: 4px solid #b89449;
            padding: 20px;
            margin: 30px 0;
            border-radius: 4px;
        }

        .instructions-title {
            color: #1a1a1a;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .instructions-list {
            margin: 0;
            padding-left: 20px;
        }

        .instructions-list li {
            margin-bottom: 8px;
            color: #555555;
        }

        /* Contact */
        .contact {
            text-align: center;
            margin: 40px 0 20px 0;
            padding-top: 30px;
            border-top: 1px solid #eaeaea;
        }

        .contact-title {
            color: #1a1a1a;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .contact-details {
            color: #555555;
            font-size: 15px;
            line-height: 1.8;
        }

        .contact-link {
            color: #b89449;
            text-decoration: none;
            font-weight: bold;
        }

        .contact-link:hover {
            text-decoration: underline;
        }

        /* Footer */
        .footer {
            background-color: #1a1a1a;
            padding: 30px;
            text-align: center;
        }

        .footer-text {
            color: #999999;
            font-size: 13px;
            line-height: 1.5;
            margin: 8px 0;
        }

        .copyright {
            color: #b89449;
            font-size: 14px;
            margin-top: 20px;
            font-weight: bold;
        }

        /* Responsive */
        @media only screen and (max-width: 600px) {

            .header,
            .content,
            .footer {
                padding: 30px 20px;
            }

            .title {
                font-size: 24px;
            }

            .subtitle {
                font-size: 16px;
            }

            .certificate-box,
            .attachment-section,
            .instructions {
                padding: 20px;
            }

            .certificate-title {
                font-size: 20px;
            }

            .info-row {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <!-- En-tête -->
        <div class="header">
            <div class="logo">DJOK PRESTIGE</div>
            <h1 class="title">CERTIFICAT DE FORMATION</h1>
            <p class="subtitle">Votre certification est prête</p>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <p class="greeting">
                Bonjour <strong>{{ $acces->prenom }} {{ $acces->nom }}</strong>,
            </p>

            <p class="message">
                Nous avons le plaisir de vous informer que votre certification de formation
                <strong>DJOK PRESTIGE</strong> a été émise avec succès.
            </p>

            <!-- Détails du certificat -->
            <div class="certificate-box">
                <h2 class="certificate-title">DÉTAILS DE VOTRE CERTIFICAT</h2>

                <div class="certificate-info">
                    <div class="info-row">
                        <span class="info-label">Nom complet :</span>
                        <span class="info-value">{{ $acces->prenom }} {{ $acces->nom }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Formation :</span>
                        <span class="info-value">E-learning DJOK PRESTIGE</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Date d'émission :</span>
                        <span class="info-value">{{ now()->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Code d'accès :</span>
                        <span class="info-value">{{ $acces->access_code }}</span>
                    </div>
                </div>
            </div>

            <!-- Section fichier joint -->
            <div class="attachment-section">
                <h3 class="attachment-title">VOTRE CERTIFICAT EST EN PIÈCE JOINTE</h3>
                <div class="attachment-file">
                    certificat-formation-djok-prestige.pdf
                </div>
                <p class="attachment-note">
                    Ce fichier PDF est joint à cet email. Vous pouvez le télécharger
                    et le sauvegarder sur votre ordinateur ou votre téléphone.
                </p>
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <h3 class="instructions-title">CONSEILS IMPORTANTS</h3>
                <ul class="instructions-list">
                    <li>Conservez ce certificat dans un endroit sûr</li>
                    <li>Imprimez-le pour vos dossiers professionnels</li>
                    <li>Ce document atteste de votre formation complète</li>
                    <li>Il est valable à vie et constitue une preuve officielle</li>
                </ul>
            </div>

            <p class="message">
                Pour toute demande de duplicata, de version imprimée officielle
                ou pour toute question concernant votre certification, notre équipe
                de support est à votre disposition.
            </p>

            <!-- Contact -->
            <div class="contact">
                <h3 class="contact-title">CONTACTEZ NOTRE SUPPORT</h3>
                <div class="contact-details">
                    <p><strong>Email :</strong>
                        <a href="mailto:support@djokprestige.com" class="contact-link">
                            support@djokprestige.com
                        </a>
                    </p>
                    <p><strong>Téléphone :</strong> 01 76 38 00 17</p>
                    <p><strong>Horaires :</strong> Lundi au Vendredi, 9h-18h</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">
                Cet email a été envoyé automatiquement suite à l'émission de votre certification.
            </p>
            <p class="footer-text">
                Merci de ne pas répondre directement à cet email.
            </p>
            <p class="copyright">
                © {{ date('Y') }} DJOK PRESTIGE - Tous droits réservés
            </p>
        </div>
    </div>
</body>

</html>