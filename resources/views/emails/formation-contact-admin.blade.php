<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouvelle demande formation</title>
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

        .alert-badge {
            background-color: #667eea;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
        }

        .formation-info {
            background-color: #f0f7ff;
            border: 1px solid #c3dafe;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }

        .message-box {
            background-color: #edf2f7;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
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
            <h1>Nouvelle demande de formation</h1>
            <div class="alert-badge">FORMATION</div>
        </div>

        <div class="content">
            <p><strong>Une nouvelle demande d'information sur nos formations vient d'être reçue.</strong></p>

            <div class="formation-info">
                <h3>Formation demandée :</h3>
                <p><strong>{{ $contact->autre_service }}</strong></p>
            </div>

            <p><strong>Contact :</strong></p>
            <p>{{ $contact->nom }}<br>
                {{ $contact->email }}<br>
                @if($contact->telephone)
                {{ $contact->telephone }}
                @endif</p>

            <div class="message-box">
                <strong>Message :</strong>
                <p>{{ $contact->message }}</p>
            </div>

            <p><strong>Informations :</strong></p>
            <p>Référence : #{{ $contact->id }}<br>
                Date : {{ $contact->created_at->format('d/m/Y H:i') }}<br>
                Source : Page formation</p>

            <p style="margin-top: 30px; text-align: center;">
                <a href="{{ route('admin.contacts.show', $contact) }}"
                    style="display: inline-block; background-color: #667eea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; font-weight: 600;">
                    Voir la demande
                </a>
            </p>
        </div>

        <div class="footer">
            <p>Notification automatique - DJOK PRESTIGE Formation</p>
        </div>
    </div>
</body>

</html>
