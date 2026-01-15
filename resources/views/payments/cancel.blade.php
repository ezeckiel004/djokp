@extends('layouts.main')

@section('title', 'Paiement annulé')

@section('content')
<style>
    .payment-cancel-container {
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
        max-width: 500px;
        width: 100%;
        text-align: center;
    }

    .payment-icon {
        font-size: 4rem;
        color: #f87171;
        margin-bottom: 1.5rem;
    }

    .payment-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: white;
        margin-bottom: 1rem;
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
        margin-bottom: 0.5rem;
    }

    .detail-label {
        color: #888;
    }

    .detail-value {
        color: white;
        font-weight: 500;
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
    }
</style>

<div class="payment-cancel-container">
    <div class="payment-card">
        <div class="payment-icon">
            <i class="fas fa-times-circle"></i>
        </div>

        <h1 class="payment-title">Paiement annulé</h1>

        <div class="payment-message">
            @if(isset($message))
                {{ $message }}
            @else
                Votre paiement a été annulé. Aucun prélèvement n'a été effectué sur votre compte.
            @endif
        </div>

        @if(isset($paiement) && $paiement)
            <div class="payment-details">
                <h3 style="color: white; margin-bottom: 1rem; font-size: 1.1rem;">Détails de la transaction</h3>
                <div class="detail-item">
                    <span class="detail-label">Référence :</span>
                    <span class="detail-value">{{ $paiement->reference }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Service :</span>
                    <span class="detail-value">{{ $paiement->service_name }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Montant :</span>
                    <span class="detail-value">{{ $paiement->formatted_amount }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Date :</span>
                    <span class="detail-value">{{ $paiement->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        @endif

        <div class="payment-actions">
            @if(isset($paiement) && $paiement)
                @if($paiement->isReservation())
                    <a href="{{ route('reservation') }}" class="btn-primary">
                        <i class="fas fa-redo mr-2"></i> Nouvelle réservation
                    </a>
                @elseif($paiement->isFormation())
                    <a href="{{ route('formation.show', $paiement->formation->slug ?? '') }}" class="btn-primary">
                        <i class="fas fa-redo mr-2"></i> Retour à la formation
                    </a>
                @endif
            @endif

            <a href="{{ route('home') }}" class="btn-secondary">
                <i class="fas fa-home mr-2"></i> Retour à l'accueil
            </a>

            <a href="{{ route('contact') }}" class="btn-secondary">
                <i class="fas fa-question-circle mr-2"></i> Besoin d'aide ?
            </a>
        </div>

        <div style="margin-top: 2rem; padding-top: 1rem; border-top: 1px solid #333;">
            <p style="color: #888; font-size: 0.875rem;">
                <i class="fas fa-info-circle mr-1"></i>
                Si vous avez des questions concernant cette annulation, n'hésitez pas à nous contacter.
            </p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Envoyer un événement de suivi (si Google Analytics est configuré)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'payment_cancelled', {
                'event_category': 'Payment',
                'event_label': 'Cancelled Payment',
                'value': 1
            });
        }

        // Afficher un message de bienvenue
        setTimeout(() => {
            console.log('Page d\'annulation de paiement chargée');
        }, 1000);
    });
</script>
@endsection