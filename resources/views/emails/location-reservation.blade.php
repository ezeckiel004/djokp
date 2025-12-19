<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $type === 'client' ? 'Confirmation de réservation' : 'Nouvelle réservation' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #f59e0b;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .vehicle-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .reservation-details {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            background: #f59e0b;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }

        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .info-box {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .admin-info {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <div class="logo">DJOK PRESTIGE</div>
            <h1>
                @if($type === 'client')
                Confirmation de votre demande de réservation
                @else
                Nouvelle demande de réservation
                @endif
            </h1>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            @if($type === 'client')
            <p>Bonjour <strong>{{ $reservation->nom }}</strong>,</p>
            <p>Nous avons bien reçu votre demande de réservation de véhicule. Voici un récapitulatif :</p>
            @else
            <p>Une nouvelle demande de réservation a été soumise :</p>
            @endif

            <!-- Détails du véhicule -->
            <div class="vehicle-card">
                <h3>Véhicule réservé</h3>
                <p><strong>Marque/Modèle :</strong> {{ $reservation->vehicle->full_name ?? 'N/A' }}</p>
                <p><strong>Catégorie :</strong> {{ $reservation->vehicle->category_fr ?? 'N/A' }}</p>
                <p><strong>Carburant :</strong> {{ $reservation->vehicle->fuel_type_fr ?? 'N/A' }}</p>
                @if($reservation->vehicle)
                <p><strong>Tarif journalier :</strong> {{ number_format($reservation->vehicle->daily_rate, 2, ',', ' ')
                    }} €</p>
                @endif
            </div>

            <!-- Détails de la réservation -->
            <div class="reservation-details">
                <h3>Détails de la réservation</h3>
                <p><strong>Référence :</strong> {{ $reservation->reference }}</p>
                <p><strong>Période :</strong> du {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                    au {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
                <p><strong>Durée :</strong> {{ $reservation->duree_jours }} jours</p>
                <p><strong>Montant estimé :</strong> {{ $reservation->montant_formatted }} TTC</p>
                <p><strong>Statut :</strong> {{ $reservation->statut_fr }}</p>
            </div>

            <!-- Informations du client -->
            <div class="info-box">
                <h3>Informations du client</h3>
                <p><strong>Nom complet :</strong> {{ $reservation->nom }}</p>
                <p><strong>Email :</strong> {{ $reservation->email }}</p>
                <p><strong>Téléphone :</strong> {{ $reservation->telephone }}</p>
                @if($reservation->notes)
                <p><strong>Message :</strong> {{ $reservation->notes }}</p>
                @endif
            </div>

            @if($type === 'client')
            <!-- Instructions pour le client -->
            <div class="info-box">
                <h3>Prochaines étapes</h3>
                <ol>
                    <li>Notre équipe va vérifier la disponibilité du véhicule</li>
                    <li>Vous recevrez une confirmation définitive sous 24h</li>
                    <li>Un conseiller vous contactera pour finaliser la réservation</li>
                    <li>Préparez les documents requis (voir conditions sur notre site)</li>
                </ol>
            </div>

            <!-- Bouton d'action pour le client -->
            <center>
                <a href="{{ route('location.reservation.confirmation', $reservation->reference) }}" class="button">
                    Voir le détail de ma réservation
                </a>
            </center>

            <p>Vous pouvez suivre l'avancement de votre réservation en utilisant votre référence : <strong>{{
                    $reservation->reference }}</strong></p>
            @else
            <!-- Informations pour l'admin -->
            <div class="admin-info">
                <h3>Actions requises</h3>
                <ol>
                    <li>Vérifier la disponibilité du véhicule (ID: {{ $reservation->vehicle_id }})</li>
                    <li>Contacter le client pour confirmation : {{ $reservation->telephone }}</li>
                    <li>Mettre à jour le statut dans l'admin</li>
                    <li>Préparer les documents de location</li>
                </ol>
            </div>

            <!-- Bouton d'action pour l'admin -->
            <center>
                <a href="{{ url('admin/location-reservations/' . $reservation->id) }}" class="button">
                    Gérer cette réservation
                </a>
            </center>
            @endif

            <!-- Coordonnées -->
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                <p><strong>Contact DJOK PRESTIGE :</strong></p>
                <p>📞 Téléphone : <a href="tel:0176380017">01 76 38 00 17</a></p>
                <p>📧 Email : <a href="mailto:location@djokprestige.com">location@djokprestige.com</a></p>
                <p>📍 Adresse : Consultez notre site pour notre adresse</p>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
            @if($type === 'client')
            <p style="font-size: 12px; color: #94a3b8;">
                Si vous n'êtes pas à l'origine de cette réservation, veuillez nous contacter immédiatement.
            </p>
            @endif
        </div>
    </div>
</body>

</html>
