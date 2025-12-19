<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demande d'information formation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9fafb;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 2px solid #667eea;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #1a202c;
            margin-bottom: 10px;
        }

        .content {
            margin-bottom: 30px;
        }

        .formation-badge {
            background-color: #667eea;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            display: inline-block;
            margin: 10px 0;
        }

        .details {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .footer {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Demande d'information formation reçue</h1>
            <p>DJOK PRESTIGE Formation vous remercie pour votre intérêt</p>
        </div>

        <div class="content">
            <p><strong>Bonjour {{ $contact->nom }},</strong></p>

            <p>Nous avons bien reçu votre demande d'information concernant notre formation :</p>

            <div class="formation-badge">
                {{ $contact->autre_service }}
            </div>

            <div class="details">
                <div class="detail-item">
                    <span>Référence :</span>
                    <strong>#{{ $contact->id }}</strong>
                </div>
                <div class="detail-item">
                    <span>Date de la demande :</span>
                    <span>{{ $contact->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div class="detail-item">
                    <span>Votre email :</span>
                    <span>{{ $contact->email }}</span>
                </div>
                @if($contact->telephone)
                <div class="detail-item">
                    <span>Votre téléphone :</span>
                    <span>{{ $contact->telephone }}</span>
                </div>
                @endif
            </div>

            <p>Notre équipe formation va analyser votre demande et vous contactera dans les plus brefs délais pour
                répondre à toutes vos questions.</p>

            <p><strong>En attendant :</strong></p>
            <ul>
                <li>Visitez notre page formation pour plus de détails</li>
                <li>Téléchargez notre brochure complète</li>
                <li>Contactez-nous au 01 76 38 00 17 pour toute question urgente</li>
            </ul>

            <p>Bien cordialement,<br>
                <strong>L'équipe DJOK PRESTIGE Formation</strong>
            </p>
        </div>

        <div class="footer">
            <p>Cet email est envoyé automatiquement, merci de ne pas y répondre.</p>
            <p>DJOK PRESTIGE Formation &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>

</html>
