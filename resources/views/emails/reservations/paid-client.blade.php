@component('mail::message')
# 🎉 Confirmation de votre réservation !

Bonjour {{ $reservation->nom }},

Votre réservation **{{ $reservation->reference }}** a été confirmée et payée avec succès.

## 📋 Détails de votre réservation
**Référence :** {{ $reservation->reference }}
**Service :** {{ $reservation->type_service_label }}
**Trajet :** {{ $reservation->depart }} → {{ $reservation->arrivee }}
**Date :** {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
**Heure :** {{ $reservation->heure }}
**Véhicule :** {{ $reservation->type_vehicule }}
**Passagers :** {{ $reservation->passagers }} personne(s)

## 💳 Détails du paiement
**Montant :** {{ number_format($paiement->amount, 2, ',', ' ') }} € TTC
**Référence paiement :** {{ $paiement->reference }}
**Date paiement :** {{ $paiement->paid_at->format('d/m/Y à H:i') }}
**Statut :** ✅ Payé

## 📍 Informations importantes
- Présentez-vous au point de rendez-vous 10 minutes avant l'heure prévue
- Notre chauffeur portera une pancarte avec votre nom
- Pour toute modification, contactez-nous au **01 76 38 00 17**

@component('mail::button', ['url' => route('client.reservations.show', $reservation->id), 'color' => 'success'])
Voir ma réservation
@endcomponent

## 📞 Contact
Pour toute question, notre équipe est à votre disposition :
📞 **01 76 38 00 17**
✉️ **vtc@djokprestige.com**

Merci pour votre confiance,

**L'équipe DJOK PRESTIGE**
*Excellence et Prestige dans tous vos déplacements*

@component('mail::subcopy')
Ceci est un message automatique, merci de ne pas y répondre directement.
Pour toute demande, utilisez les coordonnées ci-dessus.
@endcomponent
@endcomponent