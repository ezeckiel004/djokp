<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de votre inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            background-color: #0f3664;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 30px 20px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-in_progress {
            background-color: #e9d5ff;
            color: #6b21a8;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .info-card {
            background-color: #f8fafc;
            border-left: 4px solid #0f3664;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #f59e0b;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>DJOK PRESTIGE</h1>
            <p>École de Formation au Transport</p>
        </div>

        <div class="content">
            <h2>Bonjour {{ $data['student_name'] }},</h2>

            @if($data['action'] == 'created')
            <p>Nous vous confirmons la création de votre inscription à la formation :</p>
            @elseif($data['action'] == 'deleted')
            <p>Votre inscription à la formation a été annulée :</p>
            @else
            <p>Le statut de votre inscription a été mis à jour :</p>
            @if($data['old_status'])
            <p><strong>Ancien statut :</strong> {{ $data['old_status'] }}</p>
            @endif
            @endif

            <div class="info-card">
                <h3 style="margin-top: 0;">Formation : {{ $data['formation_title'] }}</h3>

                @if($data['action'] != 'deleted')
                <div class="status-badge status-{{ $data['status'] }}">
                    Nouveau statut : {{ $data['new_status'] }}
                </div>
                @endif

                <p><strong>Date de début :</strong> {{ $data['start_date'] }}</p>
                <p><strong>Date de fin :</strong> {{ $data['end_date'] }}</p>
                <p><strong>Montant payé :</strong> {{ $data['amount_paid'] }}</p>
                <p><strong>Montant total :</strong> {{ $data['total_amount'] }}</p>
                <p><strong>Reste à payer :</strong> {{ $data['remaining_amount'] }}</p>
            </div>

            @if($data['status'] == 'confirmed')
            <p>Votre formation est confirmée. Vous recevrez prochainement les détails concernant le début des cours.</p>
            @elseif($data['status'] == 'in_progress')
            <p>Votre formation est maintenant en cours. Bon apprentissage !</p>
            @elseif($data['status'] == 'completed')
            <p>Félicitations ! Vous avez terminé votre formation. Vous recevrez votre certificat sous peu.</p>
            @elseif($data['status'] == 'cancelled')
            <p>Votre inscription a été annulée. Pour toute question, n'hésitez pas à nous contacter.</p>
            @endif

            <div style="text-align: center;">
                <a href="{{ config('app.url') }}/dashboard/inscriptions" class="btn">
                    Voir mes inscriptions
                </a>
            </div>

            <p>Pour toute question, contactez-nous :</p>
            <ul>
                <li>Email : formations@djokprestige.com</li>
                <li>Téléphone : 01 76 38 00 17</li>
            </ul>
        </div>

        <div class="footer">
            <p>DJOK PRESTIGE © {{ date('Y') }}. Tous droits réservés.</p>
            <p>Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>

</html>
