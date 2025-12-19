<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation de réservation</title>
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
            background: #dc3545;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background: white;
            border-radius: 5px;
            margin-top: 20px;
        }

        .details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }

        .alert {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .client-info {
            background: #e2f4ff;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>ANNULATION DE RÉSERVATION</h1>
            <p>Une réservation a été annulée par le client</p>
        </div>

        <div class="content">
            <div class="alert">
                <p><strong>ATTENTION :</strong> Une réservation vient d'être annulée.</p>
            </div>

            <div class="details">
                <h3>Informations de la réservation</h3>
                <p><strong>Référence :</strong> {{ $reservation->reference }}</p>
                <p><strong>Date de création :</strong> {{ \Carbon\Carbon::parse($reservation->created_at)->format('d/m/Y
                    H:i') }}</p>
                <p><strong>Statut :</strong> Annulée</p>
                <p><strong>Date d'annulation :</strong> {{ now()->format('d/m/Y H:i') }}</p>

                @if($reason)
                <p><strong>Raison de l'annulation :</strong> {{ $reason }}</p>
                @else
                <p><strong>Raison de l'annulation :</strong> Non spécifiée par le client</p>
                @endif
            </div>

            <div class="client-info">
                <h3>Informations du client</h3>
                <p><strong>Nom :</strong> {{ $reservation->nom }}</p>
                <p><strong>Email :</strong> {{ $reservation->email }}</p>
                <p><strong>Téléphone :</strong> {{ $reservation->telephone }}</p>
                <p><strong>Client enregistré :</strong> {{ $reservation->user_id ? 'Oui' : 'Non' }}</p>
            </div>

            <div class="details">
                <h3>Détails du véhicule</h3>
                <p><strong>Véhicule :</strong> {{ $reservation->vehicle->brand }} {{ $reservation->vehicle->model }} ({{
                    $reservation->vehicle->plate_number }})</p>
                <p><strong>Catégorie :</strong> {{ $reservation->vehicle->category_fr }}</p>
                <p><strong>Carburant :</strong> {{ $reservation->vehicle->fuel_type_fr }}</p>
                <p><strong>Période initiale :</strong> {{
                    \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} au {{
                    \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
                <p><strong>Durée :</strong> {{
                    \Carbon\Carbon::parse($reservation->date_debut)->diffInDays(\Carbon\Carbon::parse($reservation->date_fin))
                    + 1 }} jours</p>
                <p><strong>Montant total :</strong> {{ number_format($reservation->montant_total, 2, ',', ' ') }} €</p>
            </div>

            <div class="actions">
                <h3>Actions nécessaires</h3>
                <ul>
                    <li>Le véhicule a été automatiquement marqué comme disponible</li>
                    <li>Vérifier si un remboursement est nécessaire</li>
                    <li>Archiver les documents relatifs à cette réservation</li>
                    <li>Si le client a déposé une caution, organiser son remboursement</li>
                </ul>
            </div>

            <div style="margin-top: 30px; text-align: center;">
                <p><a href="{{ url('/admin/location-reservations/' . $reservation->id) }}"
                        style="background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Voir
                        la réservation dans l'admin</a></p>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} DJOK Prestige - Système de gestion des réservations</p>
            <p>Cet email a été envoyé automatiquement.</p>
        </div>
    </div>
</body>

</html>
