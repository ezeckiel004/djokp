<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmation de support - DJOK PRESTIGE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #d97706;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }

        .message-box {
            background-color: white;
            border-left: 4px solid #d97706;
            padding: 15px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }

        .contact-info {
            background-color: #fef3c7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DJOK PRESTIGE</h1>
        <h2>Demande de support enregistrée</h2>
    </div>

    <div class="content">
        <p>Bonjour <strong>{{ $contact->name }}</strong>,</p>

        <p>Nous avons bien reçu votre demande de support et nous vous en remercions.</p>

        <div class="message-box">
            <h3>Votre demande :</h3>
            <p>{{ $contact->message }}</p>
        </div>

        <div class="contact-info">
            <h4>Nos coordonnées :</h4>
            <p><strong>Téléphone :</strong> 01 76 38 00 17</p>
            <p><strong>Email :</strong> support@djokprestige.com</p>
            <p><strong>WhatsApp :</strong> +33 1 76 38 00 17</p>
            <p><strong>Horaires :</strong> Lun-Ven: 9h-19h | Sam: 9h-13h</p>
        </div>

        <p>Notre équipe traitera votre demande dans les meilleurs délais.</p>

        <p>Si vous avez besoin d'informations complémentaires, n'hésitez pas à nous contacter.</p>

        <p>Cordialement,<br>
            <strong>L'équipe DJOK PRESTIGE</strong>
        </p>
    </div>

    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
        <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
    </div>
</body>

</html>
