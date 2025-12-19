<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation d'annulation {{ $demande->reference }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 5px 5px;
            border: 1px solid #ddd;
            border-top: none;
        }

        .confirmation-box {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }

        .details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        table td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        .highlight {
            font-weight: bold;
            color: #dc3545;
        }

        .cta-button {
            display: inline-block;
            background-color: #F8B400;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>CONFIRMATION D'ANNULATION</h1>
            <p>Référence : {{ $demande->reference }}</p>
        </div>

        <div class="content">
            <div class="confirmation-box">
                <h2>Votre demande a été annulée avec succès</h2>
                <p>Date d'annulation : <span class="highlight">{{ $annulationDate }}</span></p>
            </div>

            <p>Bonjour {{ $demande->nom_complet }},</p>

            <p>Nous confirmons l'annulation de votre demande de conciergerie référencée <strong>{{ $demande->reference
                    }}</strong>.</p>

            <div class="details">
                <h3>Récapitulatif de votre demande annulée</h3>

                <table>
                    <tr>
                        <td><strong>Référence :</strong></td>
                        <td>{{ $demande->reference }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date de création :</strong></td>
                        <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Motif du voyage :</strong></td>
                        <td>{{ $demande->motif_voyage }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date d'arrivée prévue :</strong></td>
                        <td>
                            @if($demande->date_arrivee)
                            {{ \Carbon\Carbon::parse($demande->date_arrivee)->format('d/m/Y') }}
                            @else
                            Non précisée
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Durée du séjour :</strong></td>
                        <td>{{ $demande->duree_sejour }}</td>
                    </tr>
                    <tr>
                        <td><strong>Type d'accompagnement :</strong></td>
                        <td>{{ $demande->type_accompagnement }}</td>
                    </tr>
                </table>

                @php
                $services = json_decode($demande->services, true) ?? [];
                @endphp

                @if(!empty($services))
                <p><strong>Services demandés :</strong></p>
                <ul>
                    @foreach($services as $service)
                    <li>{{ $service }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div style="background-color: #f1f1f1; padding: 20px; border-radius: 5px; margin: 20px 0;">
                <h3>Besoin d'aide ?</h3>
                <p>Si vous avez annulé cette demande par erreur, ou si vous souhaitez créer une nouvelle demande,
                    n'hésitez pas à nous contacter :</p>

                <div style="margin: 15px 0;">
                    <a href="{{ route('client.conciergerie-demandes.create') }}" class="cta-button">
                        Créer une nouvelle demande
                    </a>
                </div>

                <p>Ou contactez-nous directement :</p>
                <p>
                    📧 Email : <a href="mailto:conciergerie@djokprestige.com">conciergerie@djokprestige.com</a><br>
                    📞 Téléphone : 01 76 38 00 17
                </p>
            </div>

            <div class="footer">
                <p><strong>Merci de votre confiance</strong></p>
                <p><strong>Conciergerie DJOK Prestige</strong></p>
                <p>Votre satisfaction est notre priorité</p>
                <p style="margin-top: 20px; font-size: 12px; color: #999;">
                    Cet email est un accusé de réception automatique. Pour toute question, veuillez répondre à cet
                    email.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
