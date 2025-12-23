<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation demande conciergerie {{ $demande->reference }}</title>
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

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 20px 0;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>ANNULATION DEMANDE CONCIERGERIE</h1>
            <p>Référence : {{ $demande->reference }}</p>
        </div>

        <div class="content">
            <div class="info-box">
                <p><strong>⚠️ ATTENTION :</strong> Une demande de conciergerie vient d'être annulée par le client.</p>
                <p>Date d'annulation : <span class="highlight">{{ $annulationDate }}</span></p>
            </div>

            <h2>Détails de la demande annulée</h2>

            <div class="details">
                <h3>Informations client</h3>
                <table>
                    <tr>
                        <td><strong>Nom complet :</strong></td>
                        <td>{{ $demande->nom_complet }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email :</strong></td>
                        <td>{{ $demande->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Téléphone :</strong></td>
                        <td>{{ $demande->telephone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Statut avant annulation :</strong></td>
                        <td>{{ ucfirst($demande->statut) }}</td>
                    </tr>
                </table>

                <h3>Informations séjour</h3>
                <table>
                    <tr>
                        <td><strong>Motif :</strong></td>
                        <td>{{ $demande->motif_voyage }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date arrivée :</strong></td>
                        <td>
                            @if($demande->date_arrivee)
                            {{ \Carbon\Carbon::parse($demande->date_arrivee)->format('d/m/Y') }}
                            @else
                            Non précisée
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Durée :</strong></td>
                        <td>{{ $demande->duree_sejour }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nombre personnes :</strong></td>
                        <td>{{ $demande->nombre_personnes }}</td>
                    </tr>
                </table>

                <h3>Accompagnement & Services</h3>
                <p><strong>Type d'accompagnement :</strong> {{ $demande->type_accompagnement }}</p>

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

            <h3>Message original</h3>
            <div style="background-color: #f1f1f1; padding: 15px; border-radius: 5px; margin: 15px 0;">
                <p>{{ $demande->message }}</p>
            </div>

            <div class="footer">
                <p><strong>Conciergerie DJOK Prestige</strong></p>
                <p>Email : conciergerie@djokprestige.com</p>
                <p>Téléphone : 01 76 38 00 17</p>
                <p style="margin-top: 20px; font-size: 12px; color: #999;">
                    Cet email a été généré automatiquement. Veuillez ne pas y répondre directement.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
