<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre réservation</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .email-header .reference {
            font-size: 18px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .email-body {
            padding: 30px;
        }

        .status-section {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #d97706;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin: 5px 0;
        }

        .status-confirmee {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-en_cours {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-terminee {
            background-color: #f3f4f6;
            color: #374151;
        }

        .status-annulee {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-en_attente {
            background-color: #fef3c7;
            color: #92400e;
        }

        .info-section {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .info-section h3 {
            color: #1f2937;
            margin-bottom: 15px;
            font-size: 18px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 8px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .info-value {
            color: #111827;
            font-size: 15px;
        }

        .message-section {
            background-color: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .message-section h3 {
            color: #92400e;
            margin-bottom: 10px;
        }

        .vehicle-section {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .vehicle-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .cta-button {
            display: inline-block;
            background-color: #d97706;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #b45309;
        }

        .email-footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }

        .footer-links {
            margin-top: 15px;
        }

        .footer-links a {
            color: #d97706;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #d97706;
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .email-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">DJOK</div>
            <h1>Mise à jour de votre réservation</h1>
            <div class="reference">Référence : {{ $reservation->reference }}</div>
        </div>

        <!-- Body -->
        <div class="email-body">
            <!-- Salutation -->
            <p style="margin-bottom: 20px; font-size: 16px;">
                Bonjour <strong>{{ $reservation->nom }}</strong>,
            </p>

            <!-- Status Update -->
            <div class="status-section">
                <h2 style="color: #1f2937; margin-bottom: 15px;">Changement de statut</h2>
                @if($ancienStatut)
                <p style="margin-bottom: 10px;">
                    Le statut de votre réservation a changé :
                </p>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                    <span class="status-badge status-{{ $ancienStatut }}">
                        {{ ucfirst(str_replace('_', ' ', $ancienStatut)) }}
                    </span>
                    <span style="color: #6b7280;">→</span>
                    <span class="status-badge status-{{ $nouveauStatut }}">
                        {{ ucfirst(str_replace('_', ' ', $nouveauStatut)) }}
                    </span>
                </div>
                @else
                <p style="margin-bottom: 10px;">
                    Le statut de votre réservation est maintenant :
                </p>
                <div style="margin-bottom: 15px;">
                    <span class="status-badge status-{{ $nouveauStatut }}">
                        {{ ucfirst(str_replace('_', ' ', $nouveauStatut)) }}
                    </span>
                </div>
                @endif
            </div>

            <!-- Personal Message -->
            @if($messagePersonnalise)
            <div class="message-section">
                <h3>Message de notre équipe</h3>
                <p style="color: #4b5563; line-height: 1.6;">
                    {{ $messagePersonnalise }}
                </p>
            </div>
            @endif

            <!-- Reservation Details -->
            <div class="info-section">
                <h3>Détails de la réservation</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Période de location</div>
                        <div class="info-value">
                            Du {{ $reservation->date_debut->format('d/m/Y') }}<br>
                            Au {{ $reservation->date_fin->format('d/m/Y') }}
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Durée</div>
                        <div class="info-value">{{ $reservation->duree_jours }} jours</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Montant total</div>
                        <div class="info-value">{{ $reservation->montant_formatted }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Client</div>
                        <div class="info-value">
                            {{ $reservation->nom }}<br>
                            {{ $reservation->email }}<br>
                            {{ $reservation->telephone }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Info -->
            <div class="vehicle-section">
                <h3>Véhicule réservé</h3>
                @if($reservation->vehicle->image_url)
                <img src="{{ $reservation->vehicle->image_url }}" alt="{{ $reservation->vehicle->full_name }}"
                    class="vehicle-image">
                @endif
                <div style="margin-top: 15px;">
                    <div style="font-weight: bold; font-size: 18px; margin-bottom: 5px;">
                        {{ $reservation->vehicle->full_name }}
                    </div>
                    <div style="color: #4b5563; margin-bottom: 10px;">
                        {{ $reservation->vehicle->registration }}
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px; font-size: 14px;">
                        <span style="background-color: #e5e7eb; padding: 4px 8px; border-radius: 4px;">
                            {{ $reservation->vehicle->category_fr }}
                        </span>
                        <span style="background-color: #e5e7eb; padding: 4px 8px; border-radius: 4px;">
                            {{ $reservation->vehicle->fuel_type_fr }}
                        </span>
                        <span style="background-color: #e5e7eb; padding: 4px 8px; border-radius: 4px;">
                            {{ $reservation->vehicle->seats }} places
                        </span>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div style="text-align: center; margin-top: 30px;">
                <p style="margin-bottom: 20px; color: #4b5563;">
                    Pour plus d'informations ou pour modifier votre réservation, veuillez nous contacter.
                </p>
                <a href="mailto:contact@djok.com?subject=Réservation%20{{ $reservation->reference }}"
                    class="cta-button">
                    Contacter notre équipe
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p style="margin-bottom: 10px;">
                <strong>DJOK - Location de véhicules premium</strong>
            </p>
            <p style="margin-bottom: 15px; font-size: 13px;">
                Cet email a été envoyé automatiquement. Merci de ne pas y répondre directement.
            </p>
            <div class="footer-links">
                <a href="{{ url('/contact') }}">Contact</a> |
                <a href="{{ url('/cgv') }}">CGV</a> |
                <a href="{{ url('/mentions-legales') }}">Mentions légales</a>
            </div>
            <p style="margin-top: 15px; font-size: 12px; color: #9ca3af;">
                © {{ date('Y') }} DJOK. Tous droits réservés.
            </p>
        </div>
    </div>
</body>

</html>
