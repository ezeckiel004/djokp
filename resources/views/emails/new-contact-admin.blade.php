<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nouveau message de contact</title>
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
            border-bottom: 2px solid #e53e3e;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #c53030;
            margin-bottom: 10px;
        }

        .alert-badge {
            display: inline-block;
            background-color: #e53e3e;
            color: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 14px;
            margin-left: 10px;
        }

        .content {
            margin-bottom: 30px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }

        .info-card {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 20px;
        }

        .info-card h3 {
            color: #4a5568;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .message-content {
            background-color: #edf2f7;
            padding: 25px;
            border-radius: 6px;
            margin: 25px 0;
        }

        .message-content h3 {
            color: #2d3748;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .message-text {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            white-space: pre-line;
            line-height: 1.8;
        }

        .service-badge {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: 600;
            margin: 5px 0;
        }

        .metadata {
            color: #718096;
            font-size: 14px;
            margin: 10px 0;
        }

        .actions {
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

        .btn-view {
            background-color: #38b2ac;
        }

        .btn-view:hover {
            background-color: #319795;
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
            <h1>Nouveau message de contact <span class="alert-badge">Nouveau</span></h1>
            <p>Un nouveau message a été reçu via le formulaire de contact</p>
        </div>

        <div class="content">
            <p><strong>Un visiteur vient de soumettre une demande via le formulaire de contact du site.</strong></p>

            <div class="info-grid">
                <div class="info-card">
                    <h3>Expéditeur</h3>
                    <p><strong>{{ $contact->nom }}</strong></p>
                    <p>{{ $contact->email }}</p>
                    @if($contact->telephone)
                    <p>{{ $contact->telephone }}</p>
                    @endif
                </div>

                <div class="info-card">
                    <h3>Service demandé</h3>
                    <div class="service-badge">
                        {{ $contact->service_name }}
                    </div>
                    <div class="metadata">
                        Envoyé le : {{ $contact->created_at->format('d/m/Y à H:i') }}
                    </div>
                    <div class="metadata">
                        Référence : #{{ $contact->id }}
                    </div>
                </div>
            </div>

            <div class="message-content">
                <h3>Message</h3>
                <div class="message-text">
                    {{ $contact->message }}
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-view">
                    Voir le message
                </a>
                <a href="mailto:{{ $contact->email }}?subject=Réponse à votre demande #{{ $contact->id }}" class="btn">
                    Répondre
                </a>
            </div>

            <p><small>Pour accéder à tous les messages, connectez-vous à l'<a
                        href="{{ route('admin.contacts.index') }}">interface d'administration</a>.</small></p>
        </div>

        <div class="footer">
            <p>Cet email a été envoyé automatiquement par le système DJOK PRESTIGE.</p>
            <p>Vous recevez cet email car vous êtes configuré comme administrateur du site.</p>
        </div>
    </div>
</body>

</html>
