<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre réservation</title>
    <style>
        /* Styles de base */
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
            color: #fbbf24;
        }

        .email-header .logo {
            font-size: 32px;
            font-weight: bold;
            color: #fbbf24;
            margin-bottom: 10px;
        }

        .email-body {
            padding: 30px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin: 10px 0;
        }

        .status-confirmed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-in-progress {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-completed {
            background-color: #f3f4f6;
            color: #374151;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .info-card {
            background-color: #f8fafc;
            border-left: 4px solid #fbbf24;
            padding: 20px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 20px 0;
        }

        .detail-item {
            padding: 10px;
            background-color: #f8fafc;
            border-radius: 4px;
        }

        .detail-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 16px;
            font-weight: bold;
            color: #1e293b;
        }

        .button {
            display: inline-block;
            background-color: #fbbf24;
            color: #1a202c;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .button:hover {
            background-color: #f59e0b;
        }

        .email-footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 12px;
            border-top: 1px solid #e2e8f0;
        }

        .contact-info {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .section-title {
            color: #1e293b;
            border-bottom: 2px solid #fbbf24;
            padding-bottom: 8px;
            margin-top: 25px;
            margin-bottom: 15px;
        }

        @media (max-width: 600px) {
            .details-grid {
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
        <!-- En-tête -->
        <div class="email-header">
            <div class="logo">DJOK PRESTIGE</div>
            <h1>Mise à jour de votre réservation</h1>
        </div>

        <!-- Corps de l'email -->
        <div class="email-body">
            <p>Bonjour <strong>{{ $reservation->nom }}</strong>,</p>

            <p>Le statut de votre réservation <strong>{{ $reservation->reference }}</strong> a été mis à jour.</p>

            <!-- Badge de statut -->
            <div class="status-badge status-{{ str_replace('_', '-', $nouveauStatut) }}">
                {{ $reservation->statut_fr }}
            </div>

            @if($ancienStatut)
            <p>Ancien statut : <strong>{{ match($ancienStatut) {
                    'en_attente' => 'En attente',
                    'confirmee' => 'Confirmée',
                    'en_cours' => 'En cours',
                    'terminee' => 'Terminée',
                    'annulee' => 'Annulée',
                    default => $ancienStatut
                    } }}</strong></p>
            @endif

            <!-- Message personnalisé -->
            @if($messagePersonnalise)
            <div class="info-card">
                <p><strong>Message de notre équipe :</strong></p>
                <p>{{ $messagePersonnalise }}</p>
            </div>
            @endif

            <h3 class="section-title">Détails de votre réservation</h3>

            <div class="details-grid">
                <div class="detail-item">
                    <div class="detail-label">Référence</div>
                    <div class="detail-value">{{ $reservation->reference }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Véhicule</div>
                    <div class="detail-value">{{ $reservation->vehicle->full_name ?? 'N/A' }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Immatriculation</div>
                    <div class="detail-value">{{ $reservation->vehicle->registration ?? 'N/A' }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Date de début</div>
                    <div class="detail-value">{{ $reservation->date_debut->format('d/m/Y') }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Date de fin</div>
                    <div class="detail-value">{{ $reservation->date_fin->format('d/m/Y') }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Durée</div>
                    <div class="detail-value">{{ $reservation->duree_jours }} jours</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Montant total</div>
                    <div class="detail-value">{{ $reservation->montant_formatted }}</div>
                </div>
            </div>

            <!-- Bouton d'action -->
            <div style="text-align: center;">
                <a href="{{ url('/reservations/' . $reservation->id) }}" class="button">
                    Consulter ma réservation
                </a>
            </div>

            <!-- Informations complémentaires selon le statut -->
            @switch($nouveauStatut)
            @case('confirmee')
            <div class="info-card">
                <h4>Prochaines étapes</h4>
                <p>Notre équipe vous contactera sous peu pour finaliser les modalités de prise en charge du véhicule.
                </p>
                <p>Pensez à préparer les documents suivants :</p>
                <ul>
                    <li>Permis de conduire valide</li>
                    <li>Carte d'identité ou passeport</li>
                    <li>Carte de crédit pour la caution</li>
                </ul>
            </div>
            @break

            @case('en_cours')
            <div class="info-card">
                <h4>Votre location est en cours</h4>
                <p>Profitez bien de votre véhicule !</p>
                <p>En cas de problème, contactez notre assistance 24h/24 :</p>
                <p><strong>{{ $reservation->telephone ?? '06 12 34 56 78' }}</strong></p>
            </div>
            @break

            @case('terminee')
            <div class="info-card">
                <h4>Location terminée</h4>
                <p>Merci d'avoir choisi DJOK Prestige !</p>
                <p>Nous espérons vous revoir bientôt.</p>
            </div>
            @break

            @case('annulee')
            <div class="info-card">
                <h4>Réservation annulée</h4>
                <p>Votre réservation a été annulée.</p>
                <p>Nous restons à votre disposition pour toute nouvelle demande.</p>
            </div>
            @break
            @endswitch

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                <p>Cet email vous a été envoyé car vous avez effectué une réservation sur notre site DJOK Prestige.</p>
                <p>Pour toute question concernant votre réservation, vous pouvez répondre à cet email.</p>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="email-footer">
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>

            <div class="contact-info">
                <p><strong>DJOK Prestige - Location de véhicules de luxe</strong></p>
                <p>123 Avenue des Champs-Élysées, 75008 Paris</p>
                <p>Téléphone : +33 1 23 45 67 89</p>
                <p>Email : contact@djokprestige.com</p>
                <p>Site web : www.djokprestige.com</p>
            </div>

            <p style="margin-top: 20px; font-size: 10px; color: #94a3b8;">
                © {{ date('Y') }} DJOK Prestige. Tous droits réservés.
            </p>
        </div>
    </div>
</body>

</html>
