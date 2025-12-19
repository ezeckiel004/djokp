@component('mail::message')
# Votre devis conciergerie

Bonjour {{ $demande->nom_complet }},

Suite à votre demande de conciergerie (référence : {{ $demande->reference }}), nous avons le plaisir de vous transmettre
notre proposition.

**Montant du devis :** {{ $demande->montant_formate }}

**Détails de notre proposition :**
{!! nl2br(e($detailsDevis)) !!}

@if($notesClient)
**Informations complémentaires :**
{!! nl2br(e($notesClient)) !!}
@endif

Pour confirmer ce devis ou pour toute question, vous pouvez :
- Nous répondre directement à cet email
- Nous appeler au 01 76 38 00 17
- Utiliser le lien de suivi ci-dessous

@component('mail::button', ['url' => route('conciergerie.suivi', $demande->reference)])
Voir et confirmer mon devis
@endcomponent

Ce devis est valable 30 jours à compter de sa date d'émission.

Cordialement,
L'équipe DJOK PRESTIGE
@endcomponent