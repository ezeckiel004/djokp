{{-- resources/views/client/conciergerie-demandes/pdf.blade.php --}}
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande Conciergerie {{ $demande->reference }} - DJOK PRESTIGE</title>
    <style>
        @page {
            margin: 50px 40px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            border-bottom: 2px solid #F8B400;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo h1 {
            color: #F8B400;
            margin: 0;
            font-size: 24px;
        }

        .logo p {
            color: #666;
            margin: 5px 0 0;
        }

        .reference {
            text-align: right;
            margin-bottom: 10px;
        }

        .reference-code {
            font-size: 18px;
            font-weight: bold;
            color: #F8B400;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            background-color: #f5f5f5;
            padding: 8px 12px;
            border-left: 4px solid #F8B400;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            color: #666;
            margin-bottom: 3px;
        }

        .info-value {
            color: #333;
        }

        .services-list {
            list-style: none;
            padding: 0;
        }

        .services-list li {
            margin-bottom: 5px;
            padding-left: 20px;
            position: relative;
        }

        .services-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #F8B400;
            font-weight: bold;
        }

        .message-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .statut-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .statut-nouvelle {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .statut-en_cours {
            background-color: #fef3c7;
            color: #92400e;
        }

        .statut-devis_envoye {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .statut-confirme {
            background-color: #d1fae5;
            color: #065f46;
        }

        .statut-annule {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .statut-termine {
            background-color: #e5e7eb;
            color: #374151;
        }

        .footer {
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        .devis-box {
            border: 2px solid #F8B400;
            padding: 15px;
            margin: 20px 0;
            background-color: #fff9e6;
            border-radius: 5px;
        }

        .devis-amount {
            font-size: 24px;
            font-weight: bold;
            color: #F8B400;
            text-align: center;
            margin: 10px 0;
        }

        .contact-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
        }

        .print-date {
            text-align: right;
            font-size: 10px;
            color: #999;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="print-date">
        Généré le {{ $date_export }}
    </div>

    <div class="header">
        <div class="logo">
            <h1>DJOK PRESTIGE</h1>
            <p>Conciergerie & Services France</p>
        </div>

        <div class="reference">
            <div class="info-label">RÉFÉRENCE</div>
            <div class="reference-code">{{ $demande->reference }}</div>
        </div>

        <div class="info-grid">
            <div>
                <div class="info-item">
                    <div class="info-label">STATUT</div>
                    @php
                    $statutClasses = [
                    'nouvelle' => 'statut-nouvelle',
                    'en_cours' => 'statut-en_cours',
                    'devis_envoye' => 'statut-devis_envoye',
                    'confirme' => 'statut-confirme',
                    'annule' => 'statut-annule',
                    'termine' => 'statut-termine',
                    ];
                    $statutClass = $statutClasses[$demande->statut] ?? 'statut-nouvelle';
                    @endphp
                    <span class="statut-badge {{ $statutClass }}">
                        {{ $demande->getStatutLabelAttribute() }}
                    </span>
                </div>

                <div class="info-item">
                    <div class="info-label">DATE DE CRÉATION</div>
                    <div class="info-value">{{ $demande->created_at->format('d/m/Y H:i') }}</div>
                </div>
            </div>

            <div>
                <div class="info-item">
                    <div class="info-label">CLIENT</div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">EMAIL</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Informations client --}}
    <div class="section">
        <div class="section-title">INFORMATIONS CLIENT</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nom complet</div>
                <div class="info-value">{{ $demande->nom_complet }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">{{ $demande->email }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Téléphone</div>
                <div class="info-value">{{ $demande->telephone }}</div>
            </div>
        </div>
    </div>

    {{-- Informations séjour --}}
    <div class="section">
        <div class="section-title">INFORMATIONS SÉJOUR</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Motif du voyage</div>
                <div class="info-value">{{ $demande->getMotifLabelAttribute() }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Date d'arrivée</div>
                <div class="info-value">
                    {{ $demande->date_arrivee ? $demande->date_arrivee->format('d/m/Y') : 'Non précisée' }}
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Durée du séjour</div>
                <div class="info-value">{{ $demande->duree_sejour }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Nombre de personnes</div>
                <div class="info-value">{{ $demande->nombre_personnes }}</div>
            </div>

            @if($demande->budget)
            <div class="info-item">
                <div class="info-label">Budget estimé</div>
                <div class="info-value">{{ $demande->budget }}</div>
            </div>
            @endif

            <div class="info-item">
                <div class="info-label">Type d'accompagnement</div>
                <div class="info-value">{{ $demande->getAccompagnementLabelAttribute() }}</div>
            </div>
        </div>
    </div>

    {{-- Services demandés --}}
    <div class="section">
        <div class="section-title">SERVICES DEMANDÉS</div>
        @if($demande->services && count($demande->services) > 0)
        <ul class="services-list">
            @foreach($demande->services as $service)
            <li>{{ $service }}</li>
            @endforeach
        </ul>
        @else
        <p>Aucun service spécifié</p>
        @endif
    </div>

    {{-- Devis --}}
    @if($demande->devis_envoye)
    <div class="section">
        <div class="section-title">DEVIS</div>
        <div class="devis-box">
            <div style="text-align: center; margin-bottom: 15px;">
                <strong>DEVIS ENVOYÉ</strong><br>
                @if($demande->date_devis)
                Date : {{ $demande->date_devis->format('d/m/Y') }}
                @endif
            </div>

            <div class="devis-amount">
                {{ $demande->getMontantFormateAttribute() }}
            </div>

            <div style="text-align: center; font-size: 11px; color: #666;">
                Statut : {{ $demande->getStatutLabelAttribute() }}
            </div>
        </div>
    </div>
    @endif

    {{-- Message détaillé --}}
    <div class="section">
        <div class="section-title">MESSAGE DÉTAILLÉ</div>
        <div class="message-box">
            {!! nl2br(e($demande->message)) !!}
        </div>
    </div>

    {{-- Contact --}}
    <div class="contact-info">
        <div>
            <strong>Contact DJOK PRESTIGE</strong><br>
            Tél: 01 76 38 00 17<br>
            Email: conciergerie@djokprestige.com<br>
            WhatsApp: Disponible 24h/24
        </div>

        <div style="text-align: right;">
            <strong>Informations techniques</strong><br>
            Référence: {{ $demande->reference }}<br>
            ID Demande: {{ $demande->id }}<br>
            Client ID: {{ $user->id }}
        </div>
    </div>

    <div class="footer">
        <p><strong>DJOK PRESTIGE - Arriver & Vivre en France</strong></p>
        <p>Document généré automatiquement. Ce document ne constitue pas un contrat.</p>
        <p>© {{ date('Y') }} DJOK PRESTIGE. Tous droits réservés.</p>
    </div>

    <script>
        // Auto-print option (uncomment if you want auto-print)
        // window.onload = function() {
        //     window.print();
        // }

        // Close window after print (uncomment if needed)
        // window.onafterprint = function() {
        //     window.close();
        // }
    </script>
</body>

</html>
