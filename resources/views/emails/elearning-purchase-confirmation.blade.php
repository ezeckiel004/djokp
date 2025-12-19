<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'achat de formation | DJOK PRESTIGE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1e40af;
            padding: 30px 20px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #1e3a8a;
            font-weight: 600;
        }

        .section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #f59e0b;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 15px;
        }

        .detail-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #3b82f6;
        }

        .detail-label {
            font-size: 12px;
            color: #666666;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .detail-value {
            font-size: 16px;
            font-weight: 600;
            color: #222222;
        }

        .steps-container {
            margin-top: 20px;
        }

        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            padding: 12px;
            background-color: #f0f9ff;
            border-radius: 6px;
        }

        .step-number {
            background-color: #3b82f6;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 14px;
        }

        .step-content {
            flex: 1;
        }

        .step-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #1e3a8a;
            font-size: 15px;
        }

        .button-container {
            text-align: center;
            margin: 25px 0;
        }

        .button {
            display: inline-block;
            background-color: #f59e0b;
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #d97706;
        }

        .contact-info {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 20px;
            margin-top: 25px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #444444;
            font-size: 14px;
        }

        .contact-label {
            font-weight: 600;
            min-width: 140px;
            color: #1e3a8a;
        }

        .highlight-box {
            background-color: #10b981;
            color: white;
            padding: 20px;
            border-radius: 6px;
            text-align: center;
            margin: 25px 0;
        }

        .highlight-box h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }

        .footer {
            background-color: #1e293b;
            color: #cccccc;
            padding: 25px 20px;
            text-align: center;
            font-size: 14px;
        }

        .copyright {
            font-size: 12px;
            opacity: 0.7;
            margin-top: 15px;
            line-height: 1.5;
        }

        .tag {
            display: inline-block;
            padding: 4px 10px;
            background-color: #e0f2fe;
            color: #0369a1;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin: 3px;
        }

        .info-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 4px;
            margin: 15px 0;
            color: #92400e;
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px 15px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 20px;
            }

            .section-title {
                font-size: 16px;
            }

            .step {
                flex-direction: column;
            }

            .step-number {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>Confirmation d'achat de formation</h1>
            <p>Formation {{ $formation->title }}</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Bonjour {{ $user ? $user->name : $paiement->customer_info['name'] ?? 'Client' }},
            </div>

            <p>Nous vous confirmons l'achat réussi de votre formation. Vous avez maintenant accès à l'intégralité du
                contenu.</p>

            <!-- Highlight Box -->
            <div class="highlight-box">
                <h3>Félicitations !</h3>
                <p>Votre formation est activée et disponible immédiatement</p>
            </div>

            <!-- Purchase Details -->
            <div class="section">
                <div class="section-title">Détails de votre achat</div>

                <div class="details-grid">
                    <div class="detail-item">
                        <span class="detail-label">Référence</span>
                        <span class="detail-value">{{ $paiement->reference }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Date d'achat</span>
                        <span class="detail-value">{{ $paiement->paid_at->format('d/m/Y à H:i') }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Montant</span>
                        <span class="detail-value">{{ number_format($paiement->amount, 0, ',', ' ') }} € TTC</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Accès valide jusqu'au</span>
                        <span class="detail-value">{{ now()->addYear()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Formation Details -->
            <div class="section">
                <div class="section-title">Détails de la formation</div>

                <h3 style="color: #1e3a8a; margin-bottom: 15px; font-size: 18px;">{{ $formation->title }}</h3>

                <div style="margin-bottom: 15px;">
                    <span class="tag">{{ $formation->duration_hours }} heures</span>
                    <span class="tag">{{ $formation->format_affichage ?? ucfirst($formation->format_type) }}</span>
                    <span class="tag">{{ $formation->media->count() }} ressources</span>
                    <span class="tag">{{ $formation->type_formation === 'e_learning' ? 'E-learning' : 'Présentiel'
                        }}</span>
                </div>

                <p style="color: #555555; line-height: 1.6;">{{ Str::limit(strip_tags($formation->description), 200) }}
                </p>
            </div>

            <!-- Access Instructions -->
            <div class="section">
                <div class="section-title">Comment accéder à votre formation</div>

                <div class="steps-container">
                    @if($user)
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <div class="step-title">Connectez-vous à votre espace client</div>
                            <p>Utilisez vos identifiants pour accéder à votre compte</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <div class="step-title">Accédez à "Mes formations"</div>
                            <p>Dans votre tableau de bord, cliquez sur la section "Mes formations"</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <div class="step-title">Commencez votre apprentissage</div>
                            <p>Cliquez sur "Accéder à la formation" pour démarrer immédiatement</p>
                        </div>
                    </div>
                    @else
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <div class="step-title">Créez votre compte</div>
                            <p>Utilisez l'adresse email : <strong>{{ $paiement->customer_info['email'] }}</strong></p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <div class="step-title">Confirmez votre email</div>
                            <p>Vérifiez votre boîte mail pour confirmer votre compte</p>
                        </div>
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <div class="step-title">Accédez à votre formation</div>
                            <p>Une fois connecté, rendez-vous dans "Mes formations"</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Button -->
                <div class="button-container">
                    <a href="{{ $user ? route('formations.mes-formations') : route('register') }}" class="button">
                        Accéder à mes formations
                    </a>
                </div>
            </div>

            <!-- Information Box -->
            <div class="info-box">
                <p><strong>Conseil pour bien débuter :</strong> Nous vous recommandons de commencer par le premier
                    module et de suivre les formations dans l'ordre pour une progression optimale. Prenez des notes et
                    n'hésitez pas à revenir sur les vidéos si nécessaire.</p>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <div class="section-title" style="border-bottom: none; padding-bottom: 0;">Assistance et contact</div>

                <div class="contact-item">
                    <span class="contact-label">Téléphone :</span>
                    <span>01 76 38 00 17</span>
                </div>

                <div class="contact-item">
                    <span class="contact-label">Email formation :</span>
                    <span>formation@djokprestige.com</span>
                </div>

                <div class="contact-item">
                    <span class="contact-label">Support technique :</span>
                    <span>support@djokprestige.com</span>
                </div>

                <div class="contact-item">
                    <span class="contact-label">Horaires :</span>
                    <span>Lun-Ven: 9h-19h | Sam: 9h-13h</span>
                </div>

                <p style="margin-top: 12px; font-size: 13px; color: #666;">
                    Notre équipe est disponible pour répondre à toutes vos questions concernant votre formation.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div style="margin-bottom: 15px;">
                <strong style="color: #ffffff; font-size: 16px;">DJOK PRESTIGE Formation</strong>
                <p style="margin: 8px 0; font-size: 14px;">Votre excellence, notre priorité</p>
            </div>

            <div style="margin: 15px 0; font-size: 12px;">
                <p>123 Avenue des Champs-Élysées<br>75008 Paris, France</p>
            </div>

            <div class="copyright">
                © {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.<br>
                <a href="{{ route('mentions-legales') }}" style="color: #cccccc; text-decoration: underline;">Mentions
                    légales</a> |
                <a href="{{ route('rgpd') }}" style="color: #cccccc; text-decoration: underline;">Politique de
                    confidentialité</a> |
                <a href="{{ route('cgv') }}" style="color: #cccccc; text-decoration: underline;">CGV</a>
            </div>
        </div>
    </div>
</body>

</html>
