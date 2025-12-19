<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }

        .status-en_attente {
            background-color: #fbbf24;
            color: #78350f;
        }

        .status-confirme {
            background-color: #10b981;
            color: #064e3b;
        }

        .status-annule {
            background-color: #ef4444;
            color: #7f1d1d;
        }

        .status-termine {
            background-color: #3b82f6;
            color: #1e3a8a;
        }

        .status-supprime {
            background-color: #6b7280;
            color: #111827;
        }

        .info-box {
            background-color: #f8fafc;
            border-left: 4px solid #3b82f6;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .details {
            margin: 25px 0;
            padding: 20px;
            background-color: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #2563eb;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .content {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <h1>DJOK Prestige Formation</h1>
            <p>Votre partenaire d'excellence</p>
        </div>

        <!-- Contenu principal -->
        <div class="content">
            <h2>Bonjour {{ $participant->prenom }} {{ $participant->nom }},</h2>

            <p>Nous vous informons que le statut de votre inscription a été mis à jour :</p>

            <!-- Badge de statut -->
            <div class="status-badge status-{{ $newStatus }}">
                @php
                $statusLabels = [
                'en_attente' => 'En attente',
                'confirme' => 'Confirmé',
                'annule' => 'Annulé',
                'termine' => 'Terminé',
                'supprime' => 'Supprimé',
                ];
                @endphp
                <strong>{{ $statusLabels[$newStatus] ?? $newStatus }}</strong>
            </div>

            <!-- Message personnalisé selon le statut -->
            <div class="info-box">
                @if($newStatus === 'confirme')
                <h3>FELICITATIONS !</h3>
                <p>Votre inscription à la formation a été confirmée. Vous pouvez maintenant accéder à votre espace de
                    formation.</p>
                @if($participant->date_debut)
                <p><strong>Date de début :</strong> {{ \Carbon\Carbon::parse($participant->date_debut)->format('d/m/Y')
                    }}</p>
                @endif
                @elseif($newStatus === 'termine')
                <h3>BRAVO !</h3>
                <p>Vous avez terminé avec succès votre formation. Félicitations pour votre accomplissement !</p>
                @if($participant->date_fin)
                <p><strong>Date de fin :</strong> {{ \Carbon\Carbon::parse($participant->date_fin)->format('d/m/Y') }}
                </p>
                @endif
                @elseif($newStatus === 'annule')
                <h3>INFORMATION IMPORTANTE</h3>
                <p>Votre inscription a été annulée. Pour plus d'informations, n'hésitez pas à nous contacter.</p>
                @elseif($newStatus === 'supprime')
                <h3>INFORMATION</h3>
                <p>Votre inscription a été supprimée de notre système. Si vous pensez qu'il s'agit d'une erreur,
                    veuillez nous contacter.</p>
                @else
                <p>Votre inscription est maintenant en attente de confirmation. Nous vous tiendrons informé des
                    prochaines étapes.</p>
                @endif
            </div>

            <!-- Détails de la formation -->
            <div class="details">
                <h3>Détails de votre formation</h3>
                <p><strong>Formation :</strong> {{ $participant->formation->title ?? 'Formation' }}</p>
                <p><strong>Type :</strong>
                    @if($participant->type_formation === 'en_ligne')
                    Formation en ligne
                    @elseif($participant->type_formation === 'mixte')
                    Formation mixte
                    @else
                    Formation présentielle
                    @endif
                </p>
                @if($participant->formation->price ?? false)
                <p><strong>Prix :</strong> {{ number_format($participant->formation->price, 0, ',', ' ') }} €</p>
                @endif
            </div>

            <!-- Call to action -->
            @if($newStatus === 'confirme' || $newStatus === 'termine')
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('formations.mes-formations') }}" class="btn">
                    @if($newStatus === 'confirme')
                    Accéder à ma formation
                    @else
                    Voir mon certificat
                    @endif
                </a>
            </div>
            @endif

            <!-- Contacts -->
            <p>Pour toute question concernant votre formation, n'hésitez pas à nous contacter :</p>
            <ul>
                <li><strong>Téléphone :</strong> +221 33 867 90 00</li>
                <li><strong>Email :</strong> contact@djokprestige.com</li>
                <li><strong>Site web :</strong> <a href="https://djokprestige.com">djokprestige.com</a></li>
            </ul>

            <p>Cordialement,<br>
                <strong>L'équipe DJOK Prestige</strong>
            </p>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <p>© {{ date('Y') }} DJOK Prestige. Tous droits réservés.</p>
            <p>
                <a href="https://djokprestige.com/cgv" style="color: #64748b;">Conditions générales</a> |
                <a href="https://djokprestige.com/contact" style="color: #64748b;">Contact</a> |
                <a href="https://djokprestige.com" style="color: #64748b;">Site web</a>
            </p>
        </div>
    </div>
</body>

</html>
