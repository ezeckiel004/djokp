<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de réception</title>
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

        .header p {
            color: #718096;
            font-size: 16px;
        }

        .content {
            margin-bottom: 30px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
        }

        .message-box {
            background-color: #edf2f7;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .message-box p {
            margin: 0;
            color: #4a5568;
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

        .detail-label {
            font-weight: 600;
            color: #4a5568;
        }

        .detail-value {
            color: #2d3748;
        }

        .reference {
            text-align: center;
            background-color: #667eea;
            color: white;
            padding: 12px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: bold;
            margin: 25px 0;
        }

        .next-steps {
            background-color: #fffaf0;
            border: 1px solid #feebc8;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .next-steps h3 {
            color: #dd6b20;
            margin-top: 0;
        }

        .next-steps ul {
            padding-left: 20px;
            margin: 15px 0 0 0;
        }

        .next-steps li {
            margin-bottom: 8px;
            color: #744210;
        }

        .contact-info {
            background-color: #ebf8ff;
            border: 1px solid #bee3f8;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .contact-info h3 {
            color: #2c5282;
            margin-top: 0;
        }

        .buttons {
            text-align: center;
            margin: 30px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 0 10px;
        }

        .btn:hover {
            background-color: #5a67d8;
        }

        .footer {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
            color: #718096;
            font-size: 14px;
        }

        .footer a {
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Message bien reçu</h1>
            <p>DJOK PRESTIGE vous remercie pour votre message</p>
        </div>

        <div class="content">
            <div class="greeting">Bonjour {{ $contact->nom }},</div>

            <p>Nous avons bien reçu votre message et nous vous en remercions. Notre équipe va examiner votre demande et
                vous répondra dans les plus brefs délais.</p>

            <div class="reference">
                Référence : #{{ $contact->id }}
            </div>

            <div class="details">
                <div class="detail-item">
                    <span class="detail-label">Date d'envoi :</span>
                    <span class="detail-value">{{ $contact->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Service concerné :</span>
                    <span class="detail-value">{{ $contact->service_name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Votre email :</span>
                    <span class="detail-value">{{ $contact->email }}</span>
                </div>
                @if($contact->telephone)
                <div class="detail-item">
                    <span class="detail-label">Votre téléphone :</span>
                    <span class="detail-value">{{ $contact->telephone }}</span>
                </div>
                @endif
            </div>

            <div class="next-steps">
                <h3>Prochaines étapes</h3>
                <ul>
                    <li>Notre équipe va analyser votre demande</li>
                    <li>Vous recevrez une réponse sous 24 à 48 heures</li>
                    <li>Pour toute urgence, contactez-nous au 01 23 45 67 89</li>
                    <li>Conservez votre numéro de référence (#{{ $contact->id }})</li>
                </ul>
            </div>

            <div class="contact-info">
                <h3>Besoin d'aide rapidement ?</h3>
                <p>Notre équipe est disponible pour vous aider :</p>
                <p><strong>Email :</strong> contact@djokprestige.com</p>
                <p><strong>Téléphone :</strong> 01 23 45 67 89</p>
                <p><strong>Horaires :</strong> Lundi - Vendredi, 9h - 18h</p>
            </div>

            <div class="buttons">
                <a href="mailto:contact@djokprestige.com" class="btn">Nous contacter</a>
                <a href="{{ url('/') }}" class="btn">Visiter notre site</a>
            </div>
        </div>

        <div class="footer">
            <p>Cet email est envoyé automatiquement, merci de ne pas y répondre.</p>
            <p>DJOK PRESTIGE &copy; {{ date('Y') }} - Tous droits réservés</p>
            <p><a href="{{ route('rgpd') }}">Politique de confidentialité</a> | <a href="{{ route('cgu') }}">Conditions
                    d'utilisation</a></p>
        </div>
    </div>
</body>

</html>
