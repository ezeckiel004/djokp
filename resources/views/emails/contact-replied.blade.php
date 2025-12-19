<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réponse à votre demande</title>
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
            border-bottom: 2px solid #48bb78;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #22543d;
            margin-bottom: 10px;
        }

        .status-badge {
            display: inline-block;
            background-color: #48bb78;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin-top: 10px;
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

        .response-content {
            background-color: #f0fff4;
            border: 1px solid #c6f6d5;
            border-radius: 6px;
            padding: 25px;
            margin: 25px 0;
        }

        .response-content h3 {
            color: #22543d;
            margin-top: 0;
        }

        .reply-text {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            margin-top: 15px;
            white-space: pre-line;
            line-height: 1.8;
        }

        .timeline {
            margin: 25px 0;
            padding-left: 20px;
            border-left: 3px solid #667eea;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 25px;
            padding-left: 25px;
        }

        .timeline-item:before {
            content: "";
            position: absolute;
            left: -8px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #667eea;
        }

        .timeline-date {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 5px;
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

        .btn-secondary {
            background-color: #718096;
        }

        .btn-secondary:hover {
            background-color: #4a5568;
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
            <h1>Réponse à votre demande</h1>
            <div class="status-badge">Demande traitée</div>
        </div>

        <div class="content">
            <div class="greeting">Bonjour {{ $contact->nom }},</div>

            <p>Votre demande a été examinée par notre équipe. Voici les informations concernant le traitement de votre
                message.</p>

            <div class="details">
                <div class="detail-item">
                    <span class="detail-label">Référence :</span>
                    <span class="detail-value">#{{ $contact->id }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date d'envoi :</span>
                    <span class="detail-value">{{ $contact->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Service concerné :</span>
                    <span class="detail-value">{{ $contact->service_name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date de réponse :</span>
                    <span class="detail-value">{{ $contact->replied_at ? $contact->replied_at->format('d/m/Y à H:i') :
                        now()->format('d/m/Y à H:i') }}</span>
                </div>
            </div>

            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">{{ $contact->created_at->format('d/m/Y H:i') }}</div>
                    <p>Votre message a été reçu</p>
                </div>
                @if($contact->replied_at)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $contact->replied_at->format('d/m/Y H:i') }}</div>
                    <p>Notre équipe a répondu à votre demande</p>
                </div>
                @endif
            </div>

            <div class="response-content">
                <h3>Notre réponse</h3>
                @if($contact->reply_message)
                <div class="reply-text">
                    {{ $contact->reply_message }}
                </div>
                @else
                <div class="reply-text">
                    <p>Votre demande a été traitée avec succès !</p>
                    <p>Pour toute information complémentaire, n'hésitez pas à nous contacter à l'adresse
                        contact@djokprestige.com ou par téléphone au 01 23 45 67 89.</p>
                </div>
                @endif
            </div>

            <div class="contact-info">
                <h3>Nous contacter</h3>
                <p>Pour toute question supplémentaire :</p>
                <p><strong>Email :</strong> contact@djokprestige.com</p>
                <p><strong>Téléphone :</strong> 01 23 45 67 89</p>
                <p><strong>Horaires :</strong> Lundi - Vendredi, 9h - 18h</p>
            </div>

            <div class="buttons">
                <a href="mailto:contact@djokprestige.com" class="btn">Poser une question</a>
                <a href="{{ route('contact') }}" class="btn-secondary">Nouvelle demande</a>
            </div>
        </div>

        <div class="footer">
            <p>Cet email a été envoyé automatiquement par le système DJOK PRESTIGE.</p>
            <p>Si vous avez des questions, n'hésitez pas à répondre à cet email.</p>
            <p>DJOK PRESTIGE &copy; {{ date('Y') }} - Tous droits réservés</p>
        </div>
    </div>
</body>

</html>
