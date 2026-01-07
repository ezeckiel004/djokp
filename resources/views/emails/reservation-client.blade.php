<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 30px;
        }

        .reservation-details {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }

        .detail-item {
            margin-bottom: 10px;
            display: flex;
            align-items: flex-start;
        }

        .detail-label {
            font-weight: bold;
            min-width: 150px;
            color: #92400e;
        }

        .detail-value {
            color: #1f2937;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #eee;
            margin-top: 30px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #f59e0b;
        }

        .contact-info {
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 1px solid #fbbf24;
        }

        .btn {
            display: inline-block;
            background-color: #f59e0b;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #d97706;
        }

        .highlight {
            background-color: #fef3c7;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
            border-left: 4px solid #f59e0b;
        }

        .price-breakdown {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }

        .price-total {
            font-weight: bold;
            font-size: 18px;
            color: #f59e0b;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 2px solid #f59e0b;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>DJOK PRESTIGE</h1>
            <p>Votre réservation a bien été reçue</p>
        </div>

        <div class="content">
            <p>Bonjour <strong>{{ $data['nom'] }}</strong>,</p>

            <p>Nous avons bien reçu votre demande de réservation et vous en remercions.</p>

            <div class="reservation-details">
                <h3 style="margin-top: 0; color: #92400e;">Détails de votre réservation :</h3>

                <div class="detail-item">
                    <div class="detail-label">Référence :</div>
                    <div class="detail-value">{{ $data['reference'] }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Type de service :</div>
                    <div class="detail-value">
                        {{ $data['type_service_label'] ?? $data['type_service'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Trajet :</div>
                    <div class="detail-value">
                        {{ $data['depart'] }} → {{ $data['arrivee'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Date et heure :</div>
                    <div class="detail-value">
                        {{ \Carbon\Carbon::parse($data['date'])->locale('fr')->isoFormat('dddd D MMMM YYYY') }} à {{
                        $data['heure'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Véhicule :</div>
                    <div class="detail-value">
                        {{ $data['type_vehicule'] ?? $data['vehicle_category_name'] }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Passagers :</div>
                    <div class="detail-value">{{ $data['passagers'] }} personne(s)</div>
                </div>

                @if(!empty($data['instructions']))
                <div class="detail-item">
                    <div class="detail-label">Instructions :</div>
                    <div class="detail-value">{{ $data['instructions'] }}</div>
                </div>
                @endif

                @if(isset($data['calculated_prices']) && isset($data['formatted_prices']))
                <div class="price-breakdown">
                    <h4 style="margin-top: 0; color: #92400e;">Détail du prix :</h4>

                    <div class="price-item">
                        <span>Distance estimée :</span>
                        <span>{{ $data['formatted_prices']['distance_km'] ?? '0,0' }} km</span>
                    </div>

                    <div class="price-item">
                        <span>Prise en charge :</span>
                        <span>{{ $data['formatted_prices']['prise_charge'] ?? '0,00' }} €</span>
                    </div>

                    <div class="price-item">
                        <span>Distance (× prix au km) :</span>
                        <span>{{ $data['formatted_prices']['distance_price'] ?? '0,00' }} €</span>
                    </div>

                    <div class="price-item">
                        <span>Sous-total HT :</span>
                        <span>{{ $data['formatted_prices']['price_ht'] ?? '0,00' }} €</span>
                    </div>

                    <div class="price-item">
                        <span>× Nombre de passagers :</span>
                        <span>{{ $data['calculated_prices']['passengers'] ?? 1 }}</span>
                    </div>

                    <div class="price-item">
                        <span>Total HT :</span>
                        <span>{{ $data['formatted_prices']['price_ht'] ?? '0,00' }} €</span>
                    </div>

                    <div class="price-item">
                        <span>TVA (10%) :</span>
                        <span>{{ $data['formatted_prices']['tva'] ?? '0,00' }} €</span>
                    </div>

                    <div class="price-total">
                        <span>Total TTC :</span>
                        <span>{{ $data['formatted_prices']['price_ttc'] ?? '0,00' }} €</span>
                    </div>
                </div>
                @endif
            </div>

            <div class="highlight">
                <p><strong>🚗 Votre numéro de réservation :</strong> {{ $data['reference'] }}</p>
                <p><small>Conservez ce numéro pour toute communication avec notre service.</small></p>
            </div>

            <p><strong>📋 Prochaines étapes :</strong></p>
            <ol>
                <li>Notre équipe va traiter votre demande dans les plus brefs délais</li>
                <li>Vous recevrez une confirmation définitive par email ou téléphone</li>
                <li>Vous serez informé du numéro d'immatriculation et du nom de votre chauffeur</li>
                <li>24h avant votre trajet, vous recevrez les coordonnées exactes de prise en charge</li>
            </ol>

            <div class="contact-info">
                <p><strong>📞 Nos coordonnées :</strong></p>
                <p>Téléphone : <a href="tel:0176380017" style="color: #92400e; text-decoration: none;">01 76 38 00
                        17</a></p>
                <p>Email : <a href="mailto:vtc@djokprestige.com"
                        style="color: #92400e; text-decoration: none;">vtc@djokprestige.com</a></p>
                <p>🌙 Disponible 24h/24 - 7j/7</p>
            </div>

            <p style="text-align: center;">
                <a href="{{ url('/') }}" class="btn" style="color: white; text-decoration: none;">Visiter notre site
                    web</a>
            </p>

            <p><small><strong>Information importante :</strong> Ceci est un accusé de réception automatique. Notre
                    équipe commerciale vous contactera dans un délai maximum de 2 heures pour confirmer votre
                    réservation.</small></p>
        </div>

        <div class="footer">
            <div class="logo">DJOK PRESTIGE</div>
            <p>Transport VTC haut de gamme - Paris & France</p>
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p><small>Cet email a été envoyé automatiquement, merci de ne pas y répondre directement.</small></p>
        </div>
    </div>
</body>

</html>
