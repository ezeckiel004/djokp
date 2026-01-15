@extends('layouts.main')

@section('title', 'Confirmation de paiement')

@section('content')
<style>
    .payment-confirm-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }

    .payment-card {
        background: #111;
        border: 1px solid #333;
        border-radius: 12px;
        padding: 3rem;
        max-width: 600px;
        width: 100%;
        text-align: center;
    }

    .payment-icon {
        font-size: 4rem;
        color: #10b981;
        margin-bottom: 1.5rem;
    }

    .payment-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: white;
        margin-bottom: 1rem;
    }

    .payment-subtitle {
        color: var(--gold);
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .payment-message {
        color: #ccc;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .payment-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-success {
        background: #10b981;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-success:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .btn-primary {
        background: var(--gold);
        color: black;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: transparent;
        color: var(--gold);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        border: 1px solid var(--gold);
    }

    .btn-secondary:hover {
        background: rgba(var(--gold-rgb), 0.1);
    }

    .payment-details {
        background: #1a1a1a;
        border-radius: 8px;
        padding: 1.5rem;
        margin-top: 2rem;
        text-align: left;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #333;
    }

    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        color: #888;
        flex: 1;
    }

    .detail-value {
        color: white;
        font-weight: 500;
        flex: 1;
        text-align: right;
    }

    .receipt-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #333;
    }

    .receipt-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--gold);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s;
    }

    .receipt-btn:hover {
        color: white;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #10b981;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        text-align: left;
    }

    @media (max-width: 640px) {
        .payment-card {
            padding: 2rem;
        }

        .payment-icon {
            font-size: 3rem;
        }

        .payment-title {
            font-size: 1.5rem;
        }

        .payment-actions {
            flex-direction: column;
        }

        .detail-item {
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-value {
            text-align: left;
        }
    }
</style>

<div class="payment-confirm-container">
    <div class="payment-card">
        <div class="payment-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h1 class="payment-title">Paiement confirmé !</h1>

        @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
        @endif

        @if($paiement)
        <div class="payment-subtitle">
            Référence : {{ $paiement->reference }}
        </div>

        <div class="payment-details">
            <h3 style="color: white; margin-bottom: 1rem; font-size: 1.1rem;">Résumé de votre commande</h3>

            <div class="detail-item">
                <span class="detail-label">Service :</span>
                <span class="detail-value">{{ $paiement->service_name }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Montant :</span>
                <span class="detail-value">{{ $paiement->formatted_amount }} TTC</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Statut :</span>
                <span class="detail-value">
                    <span style="color: #10b981; font-weight: 600;">
                        <i class="fas fa-check mr-1"></i>Payé
                    </span>
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Date :</span>
                <span class="detail-value">{{ $paiement->paid_at->format('d/m/Y à H:i') }}</span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Méthode :</span>
                <span class="detail-value">Carte bancaire (Stripe)</span>
            </div>

            @if($paiement->customer_email)
            <div class="detail-item">
                <span class="detail-label">Email :</span>
                <span class="detail-value">{{ $paiement->customer_email }}</span>
            </div>
            @endif
        </div>

        <div class="receipt-section">
            <p style="color: #888; margin-bottom: 1rem;">
                Un reçu détaillé a été envoyé à votre adresse email.
            </p>
            <a href="#" onclick="printReceipt()" class="receipt-btn">
                <i class="fas fa-print"></i> Imprimer le reçu
            </a>
        </div>

        <div class="payment-actions">
            @if($paiement->isReservation())
            <a href="{{ route('client.reservations.show', $paiement->reservation_id) ?? '#' }}" class="btn-success">
                <i class="fas fa-calendar-check mr-2"></i> Voir ma réservation
            </a>
            <a href="{{ route('client.dashboard') }}" class="btn-primary">
                <i class="fas fa-tachometer-alt mr-2"></i> Mon espace client
            </a>
            @elseif($paiement->isFormation())
            <a href="{{ route('client.formations.show', $paiement->service_id) }}" class="btn-success">
                <i class="fas fa-play-circle mr-2"></i> Commencer la formation
            </a>
            <a href="{{ route('client.dashboard') }}" class="btn-primary">
                <i class="fas fa-tachometer-alt mr-2"></i> Mon espace client
            </a>
            @else
            <a href="{{ route('client.dashboard') }}" class="btn-success">
                <i class="fas fa-tachometer-alt mr-2"></i> Accéder à mon espace
            </a>
            @endif

            <a href="{{ route('home') }}" class="btn-secondary">
                <i class="fas fa-home mr-2"></i> Retour à l'accueil
            </a>
        </div>

        <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #333;">
            <p style="color: #888; font-size: 0.875rem; line-height: 1.5;">
                <i class="fas fa-info-circle mr-1"></i>
                Pour toute question concernant votre commande, vous pouvez nous contacter au
                <a href="tel:0176380017" style="color: var(--gold);">01 76 38 00 17</a> ou par email à
                <a href="mailto:contact@djokprestige.com" style="color: var(--gold);">contact@djokprestige.com</a>.
            </p>
        </div>
        @else
        <div class="alert-success">
            <i class="fas fa-check-circle mr-2"></i>
            Votre paiement a été traité avec succès.
        </div>

        <div class="payment-actions">
            <a href="{{ route('client.dashboard') }}" class="btn-success">
                <i class="fas fa-tachometer-alt mr-2"></i> Accéder à mon espace
            </a>
            <a href="{{ route('home') }}" class="btn-secondary">
                <i class="fas fa-home mr-2"></i> Retour à l'accueil
            </a>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Envoyer un événement de suivi (si Google Analytics est configuré)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'purchase', {
                'transaction_id': '{{ $paiement->reference ?? "" }}',
                'value': {{ $paiement->amount ?? 0 }},
                'currency': 'EUR',
                'items': [{
                    'item_name': '{{ $paiement->service_name ?? "Service" }}',
                    'price': {{ $paiement->amount ?? 0 }},
                    'quantity': 1
                }]
            });
        }

        // Afficher un message de bienvenue
        setTimeout(() => {
            console.log('Confirmation de paiement chargée');
        }, 1000);
    });

    function printReceipt() {
        const printContent = `
            <html>
            <head>
                <title>Reçu de paiement - {{ $paiement->reference ?? '' }}</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    .header { text-align: center; margin-bottom: 30px; }
                    .logo { font-size: 24px; font-weight: bold; color: #333; }
                    .title { font-size: 18px; margin: 20px 0; }
                    .details { width: 100%; border-collapse: collapse; margin: 20px 0; }
                    .details td { padding: 8px 0; border-bottom: 1px solid #eee; }
                    .details .label { color: #666; }
                    .total { font-weight: bold; font-size: 16px; margin-top: 20px; }
                    .footer { margin-top: 40px; text-align: center; color: #666; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class="header">
                    <div class="logo">DJOK PRESTIGE</div>
                    <div class="title">Reçu de paiement</div>
                </div>
                
                <table class="details">
                    <tr>
                        <td class="label">Référence :</td>
                        <td>{{ $paiement->reference ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Date :</td>
                        <td>{{ $paiement->paid_at->format('d/m/Y H:i') ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Service :</td>
                        <td>{{ $paiement->service_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Montant :</td>
                        <td>{{ $paiement->formatted_amount ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Statut :</td>
                        <td>Payé</td>
                    </tr>
                    <tr>
                        <td class="label">Méthode :</td>
                        <td>Carte bancaire</td>
                    </tr>
                </table>
                
                <div class="footer">
                    <p>Merci pour votre confiance !</p>
                    <p>DJOK PRESTIGE - 01 76 38 00 17 - contact@djokprestige.com</p>
                </div>
            </body>
            </html>
        `;

        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endsection