<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre réservation - DJOK PRESTIGE VTC</title>
    <style>
        /* Reset CSS */
        body {
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #000000;
            padding: 30px;
            text-align: center;
            border-bottom: 4px solid #D4AF37;
        }

        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #D4AF37;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 40px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .status-pending {
            background-color: #FFEAA7;
            color: #E17055;
        }

        .status-confirmed {
            background-color: #A5D6A7;
            color: #2E7D32;
        }

        .status-in_progress {
            background-color: #B39DDB;
            color: #4527A0;
        }

        .status-completed {
            background-color: #80CBC4;
            color: #00695C;
        }

        .status-cancelled {
            background-color: #EF9A9A;
            color: #C62828;
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #D4AF37;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .info-box h3 {
            color: #D4AF37;
            margin-top: 0;
            margin-bottom: 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .detail-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 500;
            color: #333;
        }

        .price-box {
            background-color: #fff8e1;
            border: 2px solid #D4AF37;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            text-align: center;
        }

        .price-label {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .price-amount {
            font-size: 28px;
            font-weight: bold;
            color: #D4AF37;
        }

        .cta-button {
            display: inline-block;
            background-color: #D4AF37;
            color: #000000;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #B8941F;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }

        .contact-info {
            margin: 20px 0;
            font-size: 14px;
        }

        .contact-info a {
            color: #D4AF37;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <!-- Remplacez cette URL par votre logo -->
            <img src="https://djokprestige.com/logo.png" alt="DJOK PRESTIGE" class="logo">
            <h1>DJOK PRESTIGE VTC</h1>
        </div>

        <!-- Contenu -->
        <div class="content">
            <!-- Badge de statut -->
            <div class="status-badge status-{{ $reservation->status }}">
                {{ $statusLabel }}
            </div>

            <!-- Salutation -->
            <h2>Bonjour {{ $reservation->nom }},</h2>

            <p>Votre réservation VTC chez <strong>DJOK PRESTIGE</strong> a été mise à jour.</p>

            <!-- Message selon le statut -->
            @switch($reservation->status)
            @case('confirmed')
            <div class="info-box">
                <h3>✅ Votre réservation est confirmée !</h3>
                <p>Nous avons bien reçu votre demande et nous avons le plaisir de vous confirmer votre réservation.
                    Votre chauffeur sera présent à l'heure et au lieu convenus.</p>
            </div>
            @break

            @case('in_progress')
            <div class="info-box">
                <h3>🚗 Votre service VTC est en cours</h3>
                <p>Votre chauffeur est en route pour vous prendre en charge. Vous pouvez suivre votre trajet en temps
                    réel.</p>
            </div>
            @break

            @case('completed')
            <div class="info-box">
                <h3>🏁 Service terminé avec succès</h3>
                <p>Votre trajet avec DJOK PRESTIGE VTC s'est terminé avec succès. Nous espérons que votre expérience a
                    été à la hauteur de vos attentes.</p>
            </div>
            @break

            @case('cancelled')
            <div class="info-box">
                <h3>❌ Réservation annulée</h3>
                <p>Votre réservation a été annulée. Si vous avez des questions ou souhaitez reprogrammer, n'hésitez pas
                    à nous contacter.</p>
            </div>
            @break

            @default
            <div class="info-box">
                <h3>📋 Votre réservation est en attente</h3>
                <p>Nous avons bien reçu votre demande et nous la traitons dans les plus brefs délais. Vous recevrez une
                    confirmation dès que possible.</p>
            </div>
            @endswitch

            <!-- Détails de la réservation -->
            <h3>📋 Détails de votre réservation</h3>
            <div class="details-grid">
                <div class="detail-item">
                    <div class="detail-label">Référence</div>
                    <div class="detail-value"><strong>{{ $reservation->reference }}</strong></div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Type de service</div>
                    <div class="detail-value">{{ $serviceLabel }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Date</div>
                    <div class="detail-value">
                        @if($reservation->date)
                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                        @else
                        {{ $reservation->start_date->format('d/m/Y') }}
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Heure</div>
                    <div class="detail-value">
                        @if($reservation->heure)
                        {{ $reservation->heure }}
                        @elseif($reservation->pickup_time)
                        {{ \Carbon\Carbon::parse($reservation->pickup_time)->format('H:i') }}
                        @else
                        Non spécifiée
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Lieu de départ</div>
                    <div class="detail-value">{{ $reservation->depart ?? $reservation->pickup_location }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Lieu d'arrivée</div>
                    <div class="detail-value">{{ $reservation->arrivee ?? $reservation->dropoff_location }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Passagers</div>
                    <div class="detail-value">{{ $reservation->passagers ?? $reservation->passengers }} personne(s)
                    </div>
                </div>

                @if($reservation->vehicleCategory)
                <div class="detail-item">
                    <div class="detail-label">Véhicule</div>
                    <div class="detail-value">{{ $reservation->vehicleCategory->display_name }}</div>
                </div>
                @endif
            </div>

            <!-- Informations financières -->
            <div class="price-box">
                <div class="price-label">Montant total</div>
                <div class="price-amount">{{ number_format($reservation->total_amount, 2, ',', ' ') }} €</div>
                @if($reservation->deposit_amount > 0)
                <p style="margin-top: 10px; font-size: 14px; color: #666;">
                    Acompte: {{ number_format($reservation->deposit_amount, 2, ',', ' ') }} €
                </p>
                @endif
            </div>

            <!-- Instructions supplémentaires -->
            @if($reservation->instructions || $reservation->special_requests)
            <div class="info-box">
                <h3>📝 Instructions supplémentaires</h3>
                <p>{{ $reservation->instructions ?? $reservation->special_requests }}</p>
            </div>
            @endif

            <!-- Call to Action -->
            @if($reservation->status == 'confirmed')
            <div style="text-align: center; margin: 30px 0;">
                <p>Votre chauffeur vous attendra avec une pancarte nominative.</p>
                <p style="font-size: 14px; color: #666; margin-top: 10px;">
                    En cas de retard ou de changement, merci de nous prévenir au plus vite.
                </p>
            </div>
            @endif

            <!-- Contact -->
            <div class="contact-info">
                <h3>📞 Contactez-nous</h3>
                <p>
                    <strong>Téléphone:</strong> <a href="tel:+33176380017">01 76 38 00 17</a><br>
                    <strong>Email:</strong> <a href="mailto:vtc@djokprestige.com">vtc@djokprestige.com</a><br>
                    <strong>Site web:</strong> <a href="https://djokprestige.com">djokprestige.com</a>
                </p>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE VTC. Tous droits réservés.</p>
            <p>
                24h/24 - 7j/7 | Paris, Île-de-France & France entière<br>
                <small>
                    Cet email a été envoyé automatiquement. Merci de ne pas y répondre directement.<br>
                    Pour toute question, utilisez les coordonnées ci-dessus.
                </small>
            </p>
        </div>
    </div>
</body>

</html>
