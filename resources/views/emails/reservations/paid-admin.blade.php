@component('mail::message')
# 🚗 NOUVELLE RÉSERVATION PAYÉE

Une nouvelle réservation vient d'être payée sur le site DJOK PRESTIGE.

## 📋 Détails de la réservation
**Référence :** {{ $reservation->reference }}
**Client :** {{ $reservation->nom }}
**Email :** {{ $reservation->email }}
**Téléphone :** {{ $reservation->telephone }}
**Service :** {{ $reservation->type_service_label }}
**Trajet :** {{ $reservation->depart }} → {{ $reservation->arrivee }}
**Date :** {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
**Heure :** {{ $reservation->heure }}
**Véhicule :** {{ $reservation->type_vehicule }}
**Passagers :** {{ $reservation->passagers }}

## 💰 Détails du paiement
**Montant :** {{ number_format($paiement->amount, 2, ',', ' ') }} € TTC
**Référence paiement :** {{ $paiement->reference }}
**Date paiement :** {{ $paiement->paid_at->format('d/m/Y à H:i') }}
**ID Session Stripe :** {{ $paiement->stripe_session_id }}

## 📝 Instructions client
@if($reservation->instructions)
{{ $reservation->instructions }}
@else
*Aucune instruction particulière*
@endif

@component('mail::button', ['url' => route('admin.reservations.show', $reservation->id), 'color' => 'primary'])
Voir la réservation dans l'admin
@endcomponent

@component('mail::button', ['url' => route('admin.paiements.show', $paiement->id), 'color' => 'success'])
Voir le paiement
@endcomponent

## 📊 Statistiques rapides
- Montant total : {{ number_format($paiement->amount, 2, ',', ' ') }} €
- Réservation créée : {{ $reservation->created_at->format('d/m/Y H:i') }}
- Client {{ $reservation->user_id ? 'avec compte' : 'sans compte' }}

@component('mail::subcopy')
Ceci est une notification automatique du système de paiement.
@endcomponent
@endcomponent