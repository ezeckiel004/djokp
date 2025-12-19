<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de conciergerie - {{ $demande->reference }}</title>
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

        .reference {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 25px;
        }

        .section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }

        .section:last-child {
            border-bottom: none;
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
            margin-bottom: 10px;
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

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }

        .service-tag {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
        }

        .message-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            font-style: italic;
        }

        .actions {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid #f0f0f0;
        }

        .btn {
            display: inline-block;
            background-color: #d97706;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 4px;
            font-weight: bold;
            margin: 0 10px;
        }

        .footer {
            background-color: #343a40;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }

        .contact-item {
            text-align: center;
        }

        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .contact-info {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0; font-size: 28px;">Nouvelle Demande de Conciergerie</h1>
            <h2 style="margin: 10px 0 0 0; font-weight: normal; font-size: 20px;">DJOK PRESTIGE</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Référence -->
            <div class="reference">
                <div style="font-size: 18px; font-weight: bold; color: #856404; margin-bottom: 5px;">
                    Reference de la demande
                </div>
                <div style="font-size: 24px; font-weight: bold; color: #000000; letter-spacing: 2px;">
                    {{ $demande->reference }}
                </div>
                <div style="margin-top: 10px; font-size: 14px; color: #666666;">
                    Date : {{ now()->format('d/m/Y à H:i') }}
                </div>
            </div>

            <!-- Informations client -->
            <div class="section">
                <div class="section-title">Informations du client</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="label">Nom complet</div>
                        <div class="value">{{ $demande->nom_complet }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Email</div>
                        <div class="value">
                            <a href="mailto:{{ $demande->email }}" style="color: #d97706; text-decoration: none;">
                                {{ $demande->email }}
                            </a>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="label">Telephone</div>
                        <div class="value">
                            <a href="tel:{{ $demande->telephone }}" style="color: #d97706; text-decoration: none;">
                                {{ $demande->telephone }}
                            </a>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="label">Date d'arrivee</div>
                        <div class="value">{{ \Carbon\Carbon::parse($demande->date_arrivee)->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Details du sejour -->
            <div class="section">
                <div class="section-title">Details du sejour</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="label">Motif du voyage</div>
                        <div class="value">{{ $demande->getMotifLabelAttribute() }}</div>
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
                        <div class="label">Budget estime</div>
                        <div class="value">{{ $demande->budget ?: 'Non specifie' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="label">Type d'accompagnement</div>
                        <div class="value">{{ $demande->getAccompagnementLabelAttribute() }}</div>
                    </div>
                </div>
            </div>

            <!-- Services demandes -->
            <div class="section">
                <div class="section-title">Services demandes</div>
                <div class="services-grid">
                    @php
                    // Decoder les services depuis JSON
                    $services = json_decode($demande->services, true);
                    $services = is_array($services) ? $services : [];
                    @endphp

                    @if(count($services) > 0)
                    @foreach($services as $service)
                    <div class="service-tag">{{ $service }}</div>
                    @endforeach
                    @else
                    <div class="service-tag">Aucun service specifie</div>
                    @endif
                </div>
            </div>

            <!-- Message client -->
            @if($demande->message)
            <div class="section">
                <div class="section-title">Message du client</div>
                <div class="message-box">
                    {{ $demande->message }}
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="actions">
                <p style="margin-bottom: 20px; color: #666666;">Gerer cette demande :</p>
                <a href="mailto:{{ $demande->email }}" class="btn" style="background-color: #28a745;">
                    Repondre au client
                </a>
                <a href="tel:{{ $demande->telephone }}" class="btn">
                    Appeler le client
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <h3 style="margin: 0 0 20px 0; font-size: 20px;">DJOK PRESTIGE</h3>
            <p style="margin-bottom: 20px; color: #ced4da;">Votre partenaire pour une arrivee et un sejour serein en
                France</p>

            <div class="contact-info">
                <div class="contact-item">
                    <div style="font-weight: bold; margin-bottom: 5px;">Telephone</div>
                    <div>01 76 38 00 17</div>
                </div>
                <div class="contact-item">
                    <div style="font-weight: bold; margin-bottom: 5px;">WhatsApp</div>
                    <div>Disponible 24h/24</div>
                </div>
                <div class="contact-item">
                    <div style="font-weight: bold; margin-bottom: 5px;">Email</div>
                    <div>conciergerie@djokprestige.com</div>
                </div>
            </div>

            <div
                style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #495057; font-size: 12px; color: #adb5bd;">
                Cet email a ete envoye automatiquement depuis le formulaire de conciergerie.<br>
                © {{ date('Y') }} DJOK PRESTIGE. Tous droits reserves.
            </div>
        </div>
    </div>
</body>

</html>
