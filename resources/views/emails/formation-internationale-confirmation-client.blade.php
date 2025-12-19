<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de votre demande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            color: white;
            padding: 40px 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f9fafb;
            padding: 40px 30px;
            border-radius: 0 0 10px 10px;
        }

        .details {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            border-left: 4px solid #f59e0b;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .formation-highlight {
            background: linear-gradient(to right, #f0f9ff, #e0f2fe);
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            border: 2px solid #38bdf8;
            text-align: center;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6b7280;
            font-size: 14px;
        }

        .button {
            display: inline-block;
            background: #f59e0b;
            color: white;
            padding: 14px 35px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
        }

        .contact-info {
            background: #f0fdf4;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
            border: 1px solid #bbf7d0;
        }

        .step {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 6px;
            border-left: 3px solid #4f46e5;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <h1>✅ Demande Confirmée</h1>
            <p>Merci pour votre intérêt, {{ $demande->nom_complet }} !</p>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <p>Bonjour <strong>{{ $demande->nom_complet }}</strong>,</p>
            <p>Votre demande de formation internationale a bien été reçue et est en cours de traitement par notre équipe
                spécialisée.</p>

            <!-- Référence -->
            <div style="text-align: center; margin: 25px 0;">
                <div
                    style="background: #1f2937; color: white; padding: 12px 25px; border-radius: 6px; display: inline-block; font-family: monospace; font-size: 16px; font-weight: bold;">
                    Référence : INT{{ $demande->id }}
                </div>
            </div>

            <!-- Détails de la formation -->
            <div class="formation-highlight">
                <h2 style="margin-top: 0; color: #1e40af;">Formation demandée</h2>
                <p style="font-size: 20px; font-weight: bold; color: #1e40af; margin: 15px 0;">
                    {{ $formationTitre }}
                </p>

                @if($demande->date_debut)
                <p><strong>Date de début souhaitée :</strong> {{
                    \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</p>
                @endif

                @if($demande->duree)
                <p><strong>Durée estimée :</strong> {{ $demande->duree }}</p>
                @endif
            </div>

            <!-- Détails personnels -->
            <div class="details">
                <h2 style="margin-top: 0; color: #1f2937;">Vos informations</h2>
                <p><strong>Nom complet :</strong> {{ $demande->nom_complet }}</p>
                <p><strong>Nationalité :</strong> {{ $demande->nationalite }}</p>
                <p><strong>Email :</strong> {{ $demande->email }}</p>
                <p><strong>Téléphone :</strong> {{ $demande->telephone }}</p>

                @if($demande->whatsapp && $demande->whatsapp != $demande->telephone)
                <p><strong>WhatsApp :</strong> {{ $demande->whatsapp }}</p>
                @endif

                <p><strong>Date de la demande :</strong> {{ $dateDemande }}</p>
            </div>

            <!-- Services demandés -->
            @if(!empty($services))
            <div class="details">
                <h2 style="margin-top: 0; color: #1f2937;">Services demandés</h2>
                <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 15px;">
                    @foreach($services as $service)
                    <span
                        style="background: #fef3c7; color: #92400e; padding: 6px 12px; border-radius: 15px; font-size: 14px;">
                        {{ $service }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Votre message -->
            @if($demande->message)
            <div class="details">
                <h2 style="margin-top: 0; color: #1f2937;">Votre message</h2>
                <p
                    style="background: #f9fafb; padding: 15px; border-radius: 6px; margin: 15px 0; white-space: pre-line;">
                    {{ $demande->message }}
                </p>
            </div>
            @endif

            <!-- Prochaines étapes -->
            <div style="background: #f8fafc; padding: 25px; border-radius: 8px; margin: 30px 0;">
                <h2 style="margin-top: 0; color: #1f2937;">Les prochaines étapes</h2>

                <div class="step">
                    <strong>1. Contact initial</strong>
                    <p>Notre conseiller vous contactera sous 48 heures par téléphone ou email</p>
                </div>

                <div class="step">
                    <strong>2. Étude personnalisée</strong>
                    <p>Analyse détaillée de vos besoins et objectifs</p>
                </div>

                <div class="step">
                    <strong>3. Proposition sur mesure</strong>
                    <p>Élaboration d'un programme adapté à vos exigences</p>
                </div>

                <div class="step">
                    <strong>4. Devis détaillé</strong>
                    <p>Envoi d'une proposition financière transparente</p>
                </div>
            </div>

            <!-- Informations de contact -->
            <div class="contact-info">
                <h3 style="margin-top: 0; color: #065f46;">Notre équipe est à votre écoute</h3>
                <ul style="margin: 15px 0; padding-left: 20px;">
                    <li><strong>Téléphone :</strong> +221 33 867 90 00</li>
                    <li><strong>Email :</strong> international@djokprestige.com</li>
                    <li><strong>WhatsApp :</strong> +221 33 867 90 00</li>
                </ul>
                <p style="color: #1f2937; margin-top: 15px;">
                    Disponibilité : Lundi - Vendredi, 8h - 18h (GMT)
                </p>
            </div>

            <!-- Bouton d'action -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="https://djokprestige.com/contact" class="button">
                    Nous contacter
                </a>
            </div>

            <p>Nous sommes ravis de pouvoir vous accompagner dans votre projet de formation internationale.</p>
            <p>A très bientôt,</p>
            <p><strong>L'équipe DJOK PRESTIGE International</strong></p>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Email automatique de confirmation - Ne pas répondre à cet email</p>
            <p style="margin-top: 20px;">
                <a href="https://djokprestige.com/cgv" style="color: #6b7280; margin: 0 10px;">Conditions Générales</a>
                |
                <a href="https://djokprestige.com/confidentialite"
                    style="color: #6b7280; margin: 0 10px;">Confidentialité</a> |
                <a href="https://djokprestige.com/contact" style="color: #6b7280; margin: 0 10px;">Contact</a>
            </p>
        </div>
    </div>
</body>

</html>
