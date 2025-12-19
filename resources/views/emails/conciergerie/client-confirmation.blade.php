<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de votre demande - {{ $demande->reference }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
        }

        .header {
            background-color: #d97706;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .content {
            padding: 30px;
        }

        .confirmation-box {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 30px;
        }

        .reference {
            font-size: 24px;
            font-weight: bold;
            color: #155724;
            letter-spacing: 2px;
            margin: 15px 0;
        }

        .summary {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 20px;
            margin: 25px 0;
        }

        .section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .section-title {
            color: #d97706;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-item {
            margin-bottom: 12px;
        }

        .label {
            font-weight: bold;
            color: #666666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .value {
            color: #333333;
            font-size: 15px;
        }

        .services-list {
            margin: 15px 0;
        }

        .service-item {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 8px 15px;
            margin: 5px 0;
            border-radius: 4px;
            border-left: 3px solid #d97706;
        }

        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 25px 0;
        }

        .step {
            text-align: center;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }

        .step-number {
            display: inline-block;
            width: 35px;
            height: 35px;
            background-color: #d97706;
            color: white;
            border-radius: 50%;
            line-height: 35px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .cta-button {
            display: inline-block;
            background-color: #d97706;
            color: white;
            text-decoration: none;
            padding: 15px 35px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
        }

        .contact-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 20px;
            margin: 25px 0;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            text-align: center;
        }

        .contact-item {
            padding: 15px;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .steps {
                grid-template-columns: 1fr;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Confirmation de votre demande</h1>
            <p style="margin: 10px 0 0 0; font-size: 18px;">Conciergerie DJOK PRESTIGE</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Confirmation Box -->
            <div class="confirmation-box">
                <h2 style="margin: 0 0 15px 0; color: #155724; font-size: 24px;">
                    Bonjour {{ $demande->nom_complet }},
                </h2>
                <p style="margin: 0 0 20px 0; color: #155724; font-size: 16px;">
                    Nous avons bien recu votre demande de conciergerie et nous vous en remercions.
                </p>
                <div class="reference">{{ $demande->reference }}</div>
                <p style="margin: 15px 0 0 0; color: #666666; font-size: 14px;">
                    Reference a conserver pour tout echange
                </p>
            </div>

            <!-- Resume de la demande -->
            <div class="summary">
                <h3 style="margin: 0 0 15px 0; color: #856404; font-size: 20px; text-align: center;">
                    Recapitulatif de votre demande
                </h3>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="label">Date d'arrivee</div>
                        <div class="value">{{ \Carbon\Carbon::parse($demande->date_arrivee)->format('d/m/Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Duree du sejour</div>
                        <div class="value">{{ $demande->duree_sejour }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Nombre de personnes</div>
                        <div class="value">{{ $demande->nombre_personnes }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Motif du voyage</div>
                        <div class="value">{{ $demande->getMotifLabelAttribute() }}</div>
                    </div>
                </div>

                <!-- Services -->
                <div style="margin-top: 20px;">
                    <div class="label" style="text-align: center; margin-bottom: 10px;">Services demandes :</div>
                    <div class="services-list">
                        @php
                        // Decoder les services depuis JSON
                        $services = json_decode($demande->services, true);
                        $services = is_array($services) ? $services : [];
                        @endphp

                        @if(count($services) > 0)
                        @foreach($services as $service)
                        <div class="service-item">{{ $service }}</div>
                        @endforeach
                        @else
                        <div class="service-item">Aucun service specifie</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Prochaines etapes -->
            <div class="section">
                <div class="section-title">Prochaines etapes</div>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h4 style="margin: 10px 0; color: #333333;">Analyse de votre demande</h4>
                        <p style="color: #666666; font-size: 14px;">Notre equipe examine vos besoins specifiques</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h4 style="margin: 10px 0; color: #333333;">Devis personnalise</h4>
                        <p style="color: #666666; font-size: 14px;">Reception sous 24h maximum</p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h4 style="margin: 10px 0; color: #333333;">Contact telephonique</h4>
                        <p style="color: #666666; font-size: 14px;">Affinage des besoins si necessaire</p>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <h4 style="margin: 10px 0; color: #333333;">Validation & Reservation</h4>
                        <p style="color: #666666; font-size: 14px;">Confirmation et preparation de votre sejour</p>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="contact-box">
                <h3 style="text-align: center; color: #333333; margin-bottom: 20px;">Contactez-nous</h3>
                <div class="contact-grid">
                    <div class="contact-item">
                        <div style="font-weight: bold; margin-bottom: 5px;">Telephone</div>
                        <div><a href="tel:0176380017" style="color: #d97706; text-decoration: none;">01 76 38 00 17</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div style="font-weight: bold; margin-bottom: 5px;">WhatsApp</div>
                        <div style="color: #d97706;">Disponible 24h/24</div>
                    </div>
                    <div class="contact-item">
                        <div style="font-weight: bold; margin-bottom: 5px;">Email</div>
                        <div><a href="mailto:conciergerie@djokprestige.com"
                                style="color: #d97706; text-decoration: none;">conciergerie@djokprestige.com</a></div>
                    </div>
                </div>
                <p style="text-align: center; margin-top: 20px; color: #666666; font-size: 14px;">
                    Notre equipe est a votre disposition du lundi au vendredi de 9h a 19h,
                    et le week-end pour les urgences.
                </p>
            </div>

            <!-- Message du client -->
            @if($demande->message)
            <div class="section">
                <div class="section-title">Votre message</div>
                <div
                    style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; border-left: 3px solid #d97706;">
                    {{ $demande->message }}
                </div>
            </div>
            @endif

            <!-- Remerciements -->
            <div style="text-align: center; margin: 30px 0 20px 0;">
                <h3 style="color: #333333; margin-bottom: 15px;">Merci de votre confiance !</h3>
                <p style="color: #666666; max-width: 500px; margin: 0 auto;">
                    L'equipe DJOK PRESTIGE s'engage a vous offrir un service personnalise
                    pour que votre arrivee et votre sejour en France soient une reussite.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h3 style="margin: 0 0 15px 0; font-size: 22px;">DJOK PRESTIGE</h3>
            <p style="margin: 0 0 25px 0; color: #ced4da; font-size: 16px;">
                Votre partenaire pour une arrivee et un sejour serein en France
            </p>

            <div style="margin: 25px 0; padding: 15px; background-color: rgba(255,255,255,0.1); border-radius: 5px;">
                <p style="margin: 0; color: #adb5bd; font-size: 14px;">
                    Important : Si vous ne voyez pas cet email, verifiez vos spams.
                    Ajoutez conciergerie@djokprestige.com a vos contacts.
                </p>
            </div>

            <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #495057;">
                <p style="margin: 0 0 10px 0; font-size: 12px; color: #adb5bd;">
                    Cet email a ete envoye automatiquement suite a votre demande sur djokprestige.com
                </p>
                <p style="margin: 0; font-size: 12px; color: #adb5bd;">
                    © {{ date('Y') }} DJOK PRESTIGE. Tous droits reserves.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
