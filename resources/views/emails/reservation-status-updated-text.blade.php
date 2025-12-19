MISE À JOUR DE VOTRE RÉSERVATION
=================================

Bonjour {{ $reservation->nom }},

Le statut de votre réservation {{ $reservation->reference }} a été mis à jour.

NOUVEAU STATUT : {{ $reservation->statut_fr }}

@if($ancienStatut)
ANCIEN STATUT : {{ match($ancienStatut) {
'en_attente' => 'En attente',
'confirmee' => 'Confirmée',
'en_cours' => 'En cours',
'terminee' => 'Terminée',
'annulee' => 'Annulée',
default => $ancienStatut
} }}
@endif

@if($messagePersonnalise)
MESSAGE DE NOTRE ÉQUIPE :
{{ $messagePersonnalise }}
@endif

DÉTAILS DE LA RÉSERVATION
=========================
Référence : {{ $reservation->reference }}
Véhicule : {{ $reservation->vehicle->full_name ?? 'N/A' }}
Immatriculation : {{ $reservation->vehicle->registration ?? 'N/A' }}
Date de début : {{ $reservation->date_debut->format('d/m/Y') }}
Date de fin : {{ $reservation->date_fin->format('d/m/Y') }}
Durée : {{ $reservation->duree_jours }} jours
Montant total : {{ $reservation->montant_formatted }}

INFORMATIONS IMPORTANTES
========================
@switch($nouveauStatut)
@case('confirmee')
Votre réservation a été confirmée.

Prochaines étapes :
Notre équipe vous contactera sous peu pour finaliser les modalités de prise en charge du véhicule.

Documents à préparer :
- Permis de conduire valide
- Carte d'identité ou passeport
- Carte de crédit pour la caution
@break

@case('en_cours')
Votre location est maintenant en cours.

Profitez bien de votre véhicule !

En cas de problème, contactez notre assistance 24h/24 :
Téléphone : {{ $reservation->telephone ?? '06 12 34 56 78' }}
@break

@case('terminee')
Votre location est terminée.

Merci d'avoir choisi DJOK Prestige !
Nous espérons vous revoir bientôt.
@break

@case('annulee')
Votre réservation a été annulée.

Nous restons à votre disposition pour toute nouvelle demande.
@break
@endswitch

CONSULTER VOTRE RÉSERVATION
===========================
Pour consulter votre réservation, cliquez sur le lien suivant :
{{ url('/reservations/' . $reservation->id) }}

---

DJOK PRESTIGE
Location de véhicules de luxe

Adresse : 123 Avenue des Champs-Élysées, 75008 Paris
Téléphone : +33 1 23 45 67 89
Email : contact@djokprestige.com
Site web : www.djokprestige.com

---

Cet email vous a été envoyé car vous avez effectué une réservation sur notre site DJOK Prestige.
Pour toute question concernant votre réservation, vous pouvez répondre à cet email.

© {{ date('Y') }} DJOK Prestige. Tous droits réservés.
