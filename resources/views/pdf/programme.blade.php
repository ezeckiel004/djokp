<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programme de formation - {{ $formation->title }} | DJOK PRESTIGE</title>
    <style>
        /* Styles pour le PDF */
        @page {
            margin: 50px 30px;
            size: A4;
            @bottom-right {
                content: "Page " counter(page) " sur " counter(pages);
                font-size: 10px;
                color: #666;
            }
        }
        
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        /* En-tête */
        .header {
            border-bottom: 3px solid #D4AF37;
            padding-bottom: 15px;
            margin-bottom: 30px;
            position: relative;
        }
        
        .header-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header-title {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .header-title h1 {
            color: #D4AF37;
            font-size: 24px;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
        
        .header-title h2 {
            color: #333;
            font-size: 18px;
            margin: 0;
            font-weight: normal;
        }
        
        .header-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 1px solid #dee2e6;
        }
        
        .header-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .header-info td {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .header-info .label {
            font-weight: bold;
            color: #666;
            width: 40%;
        }
        
        /* Sections */
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        
        .section-title {
            color: #D4AF37;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 2px solid #D4AF37;
            padding-bottom: 5px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Tableau des informations générales */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        
        .info-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 10px;
            border: 1px solid #dee2e6;
            font-weight: bold;
            color: #333;
            width: 30%;
        }
        
        .info-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }
        
        /* Badges inclus/non inclus */
        .badge-inclus {
            display: inline-block;
            padding: 3px 8px;
            background-color: #10b981;
            color: white;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .badge-noninclus {
            display: inline-block;
            padding: 3px 8px;
            background-color: #ef4444;
            color: white;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .badge-optionnel {
            display: inline-block;
            padding: 3px 8px;
            background-color: #f59e0b;
            color: white;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        
        /* Programme */
        .programme-list {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        
        .programme-item {
            margin-bottom: 8px;
            padding-left: 25px;
            position: relative;
            line-height: 1.6;
        }
        
        .programme-item:before {
            content: "✓";
            color: #D4AF37;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: 0;
        }
        
        /* Prérequis */
        .prerequis-list {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        
        .prerequis-item {
            margin-bottom: 8px;
            padding-left: 25px;
            position: relative;
            line-height: 1.6;
        }
        
        .prerequis-item:before {
            content: "•";
            color: #D4AF37;
            font-weight: bold;
            position: absolute;
            left: 0;
            top: 0;
            font-size: 18px;
        }
        
        /* Services inclus */
        .services-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 10px 0;
        }
        
        .service-badge {
            background-color: #D4AF37;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 11px;
            display: inline-block;
        }
        
        /* Pied de page */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #dee2e6;
            padding: 10px 30px;
            font-size: 10px;
            color: #666;
            text-align: center;
            background-color: white;
        }
        
        .footer-contact {
            margin-bottom: 5px;
        }
        
        .footer-contact a {
            color: #D4AF37;
            text-decoration: none;
        }
        
        .footer-legal {
            font-size: 9px;
            color: #999;
        }
        
        /* Médias */
        .media-summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
            border-left: 4px solid #D4AF37;
        }
        
        .media-count {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }
        
        .media-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .media-icon {
            color: #D4AF37;
        }
        
        /* Conditions et informations */
        .conditions {
            background-color: #fff9e6;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border-left: 3px solid #D4AF37;
        }
        
        .info-important {
            background-color: #f0f9ff;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border-left: 3px solid #3b82f6;
        }
        
        /* Break pages */
        .page-break {
            page-break-before: always;
        }
        
        /* Utilitaires */
        .text-center {
            text-align: center;
        }
        
        .text-gold {
            color: #D4AF37;
        }
        
        .text-bold {
            font-weight: bold;
        }
        
        .mt-10 {
            margin-top: 10px;
        }
        
        .mt-20 {
            margin-top: 20px;
        }
        
        .mb-10 {
            margin-bottom: 10px;
        }
        
        .mb-20 {
            margin-bottom: 20px;
        }
        
        .p-15 {
            padding: 15px;
        }
        
        /* Prix */
        .price-display {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 15px 0;
            border: 1px solid #dee2e6;
        }
        
        .price-amount {
            font-size: 24px;
            font-weight: bold;
            color: #D4AF37;
        }
        
        .price-label {
            font-size: 12px;
            color: #666;
        }
        
        /* Certification */
        .certification-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: #10b981;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        
        /* Description */
        .description-content {
            line-height: 1.6;
            color: #555;
            text-align: justify;
        }
        
        /* Grille */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        /* Responsive */
        @media print {
            .no-print {
                display: none;
            }
            
            body {
                font-size: 11px;
            }
            
            .section-title {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <div class="header-title">
            <h1>DJOK PRESTIGE</h1>
            <h2>Centre de Formation VTC Professionnel</h2>
        </div>
        
        <div class="header-info">
            <table>
                <tr>
                    <td class="label">Référence :</td>
                    <td><strong>FORM-{{ $formation->id }}-{{ date('Y') }}</strong></td>
                </tr>
                <tr>
                    <td class="label">Date de génération :</td>
                    <td>{{ $generationDate }}</td>
                </tr>
                <tr>
                    <td class="label">Document :</td>
                    <td><strong>Programme détaillé de formation</strong></td>
                </tr>
                <tr>
                    <td class="label">Document valide jusqu'au :</td>
                    <td>{{ now()->addDays(30)->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <!-- Titre et informations principales -->
    <div class="section">
        <div class="price-display">
            <div class="price-amount">{{ number_format($formation->price, 0, ',', ' ') }} € TTC</div>
            <div class="price-label">Prix de la formation</div>
        </div>
        
        <h1 style="font-size: 20px; color: #333; margin-bottom: 10px; text-align: center;">{{ $formation->title }}</h1>
        
        @if($formation->description)
        <div class="description-content mt-10">
            {!! nl2br(htmlspecialchars($formation->description)) !!}
        </div>
        @endif
    </div>
    
    <!-- Informations générales -->
    <div class="section">
        <div class="section-title">Informations générales</div>
        <table class="info-table">
            <tr>
                <th>Durée de la formation</th>
                <td>
                    @if($formation->duree)
                        {{ $formation->duree }}
                    @else
                        {{ $formation->duration_hours }} heures
                        @if($formation->duration_hours >= 24)
                            ({{ ceil($formation->duration_hours / 8) }} jours)
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <th>Format</th>
                <td>
                    @if($formation->format_affichage)
                        {{ $formation->format_affichage }}
                    @else
                        {{ $formation->type_formation == 'presentiel' ? 'Présentiel' : 'En ligne' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Catégorie</th>
                <td>
                    @if($formation->categorie == 'vtc_theorique')
                        VTC Théorique
                    @elseif($formation->categorie == 'vtc_pratique')
                        VTC Pratique
                    @elseif($formation->categorie == 'e_learning')
                        E-learning
                    @elseif($formation->categorie == 'renouvellement')
                        Renouvellement carte VTC
                    @else
                        {{ $formation->categorie }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Frais d'examen</th>
                <td>
                    @if($formation->frais_examen == 'Inclus')
                        <span class="badge-inclus">Inclus</span>
                    @elseif($formation->frais_examen == 'Non inclus')
                        <span class="badge-noninclus">Non inclus</span>
                    @elseif($formation->frais_examen == 'Optionnel')
                        <span class="badge-optionnel">Optionnel</span>
                    @else
                        {{ $formation->frais_examen ?? 'Non inclus' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Location véhicule</th>
                <td>
                    @if($formation->location_vehicule == 'Inclus')
                        <span class="badge-inclus">Inclus</span>
                    @elseif($formation->location_vehicule == 'Non inclus')
                        <span class="badge-noninclus">Non inclus</span>
                    @elseif($formation->location_vehicule == 'Optionnel')
                        <span class="badge-optionnel">Optionnel</span>
                    @else
                        {{ $formation->location_vehicule ?? 'Non inclus' }}
                    @endif
                </td>
            </tr>
            <tr>
                <th>Certification</th>
                <td>
                    @if($formation->is_certified)
                        <span class="certification-badge">
                            <i class="fas fa-certificate"></i>
                            Formation certifiée Qualiopi
                        </span>
                    @else
                        Formation standard
                    @endif
                </td>
            </tr>
            <tr>
                <th>Financement CPF</th>
                <td>
                    @if($formation->is_financeable_cpf)
                        <span class="badge-inclus">Éligible au CPF</span>
                    @else
                        <span class="badge-noninclus">Non éligible au CPF</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Statut</th>
                <td>
                    @if($formation->is_active)
                        <span style="color: #10b981; font-weight: bold;">● Formation active</span>
                    @else
                        <span style="color: #ef4444; font-weight: bold;">● Formation inactive</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Programme détaillé -->
    @if(!empty($program))
    <div class="section">
        <div class="section-title">Programme détaillé</div>
        <p class="mb-10" style="color: #555; font-style: italic;">
            Le programme complet de formation, module par module :
        </p>
        <ul class="programme-list">
            @foreach($program as $index => $item)
            <li class="programme-item">
                <strong>Module {{ $index + 1 }} :</strong> {{ $item }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <!-- Prérequis -->
    @if(!empty($requirements))
    <div class="section">
        <div class="section-title">Prérequis & Conditions d'admission</div>
        <p class="mb-10" style="color: #555;">
            Pour pouvoir suivre cette formation, vous devez remplir les conditions suivantes :
        </p>
        <ul class="prerequis-list">
            @foreach($requirements as $requirement)
            <li class="prerequis-item">{{ $requirement }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <!-- Services inclus -->
    @if(!empty($includedServices))
    <div class="section">
        <div class="section-title">Services inclus</div>
        <p class="mb-10" style="color: #555;">
            Ce qui est inclus dans le prix de la formation :
        </p>
        <div class="services-grid">
            @foreach($includedServices as $service)
            <span class="service-badge">{{ $service }}</span>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Ressources pédagogiques -->
    <div class="section">
        <div class="section-title">Ressources pédagogiques</div>
        <div class="media-summary">
            <p><strong>Contenu multimédia inclus :</strong></p>
            <div class="media-count">
                @if($pdfCount > 0)
                <div class="media-item">
                    <span class="media-icon">📄</span>
                    <span>{{ $pdfCount }} document(s) PDF</span>
                </div>
                @endif
                @if($videoCount > 0)
                <div class="media-item">
                    <span class="media-icon">🎥</span>
                    <span>{{ $videoCount }} vidéo(s) pédagogique(s)</span>
                </div>
                @endif
            </div>
            <p class="mt-10" style="font-size: 11px; color: #666; font-style: italic;">
                <i class="fas fa-info-circle"></i> L'accès aux ressources pédagogiques complètes est soumis à l'inscription et au paiement de la formation.
            </p>
        </div>
    </div>
    
    <!-- Modalités pratiques -->
    <div class="section">
        <div class="section-title">Modalités pratiques</div>
        <div class="grid-2">
            <div>
                <h4 style="color: #333; margin-bottom: 10px; font-size: 14px;">📅 Organisation</h4>
                <ul style="list-style: none; padding-left: 0;">
                    <li style="margin-bottom: 8px;">• Formation disponible en présentiel ou en ligne</li>
                    <li style="margin-bottom: 8px;">• Horaires flexibles selon la formule choisie</li>
                    <li style="margin-bottom: 8px;">• Accompagnement personnalisé tout au long de la formation</li>
                    <li>• Évaluation continue et finale</li>
                </ul>
            </div>
            <div>
                <h4 style="color: #333; margin-bottom: 10px; font-size: 14px;">🎓 Validation</h4>
                <ul style="list-style: none; padding-left: 0;">
                    <li style="margin-bottom: 8px;">• Attestation de formation à l'issue de la formation</li>
                    <li style="margin-bottom: 8px;">• Certificat de réussite (si formation certifiée)</li>
                    <li>• Accompagnement pour les démarches administratives</li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Conditions et informations importantes -->
    <div class="conditions">
        <div class="section-title" style="color: #d97706; border-color: #d97706;">⚠ Informations importantes</div>
        <p style="margin: 10px 0; font-weight: bold;">
            Ce document est un programme indicatif. Le contenu exact de la formation peut être adapté en fonction :
        </p>
        <ul style="margin: 10px 0; padding-left: 20px;">
            <li style="margin-bottom: 5px;">Des besoins spécifiques des participants</li>
            <li style="margin-bottom: 5px;">Des évolutions réglementaires en vigueur</li>
            <li style="margin-bottom: 5px;">Des disponibilités des formateurs et des salles</li>
            <li>Des adaptations pédagogiques nécessaires</li>
        </ul>
        <p class="mt-10" style="font-size: 11px;">
            Les tarifs indiqués sont valables à la date d'édition de ce document et peuvent être révisés.
        </p>
    </div>
    
    <!-- Contact et inscriptions -->
    <div class="info-important">
        <div class="section-title" style="color: #3b82f6; border-color: #3b82f6;">📞 Contact & Inscriptions</div>
        <p style="margin: 10px 0;">
            Pour plus d'informations ou pour vous inscrire, contactez-nous :
        </p>
        <table style="width: 100%; margin: 15px 0;">
            <tr>
                <td style="width: 30%; font-weight: bold;">Téléphone :</td>
                <td><a href="tel:{{ $contactInfo['telephone'] }}" style="color: #3b82f6; text-decoration: none;">{{ $contactInfo['telephone'] }}</a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Email :</td>
                <td><a href="mailto:{{ $contactInfo['email'] }}" style="color: #3b82f6; text-decoration: none;">{{ $contactInfo['email'] }}</a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Site web :</td>
                <td><a href="{{ $contactInfo['site'] }}" style="color: #3b82f6; text-decoration: none;">{{ $contactInfo['site'] }}</a></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">Adresse :</td>
                <td>{{ $contactInfo['adresse'] }}</td>
            </tr>
        </table>
        <p style="margin: 10px 0; font-size: 11px;">
            <strong>Horaires d'ouverture :</strong> Lundi - Vendredi : 9h00 - 19h00 • Samedi : 9h00 - 13h00
        </p>
    </div>
    
    <!-- Pied de page -->
    <div class="footer">
        <div class="footer-contact">
            DJOK PRESTIGE Formation • {{ $contactInfo['adresse'] }} • 
            <a href="tel:{{ $contactInfo['telephone'] }}">{{ $contactInfo['telephone'] }}</a> • 
            <a href="mailto:{{ $contactInfo['email'] }}">{{ $contactInfo['email'] }}</a>
        </div>
        <div class="footer-legal">
            SIRET: 000 000 000 00000 • N° de déclaration d'activité: 00 00 00000 00 • 
            Organisme de formation certifié Qualiopi • Document généré le {{ $generationDate }}
        </div>
    </div>
</body>
</html>