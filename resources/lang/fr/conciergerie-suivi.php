<?php

return [
    'title' => 'Suivi demande - :reference',
    'page_title' => 'Suivi de votre demande',
    'reference' => 'Référence',

    'statut' => [
        'title' => 'Statut de votre demande',
        'labels' => [
            'nouvelle' => 'Nouvelle',
            'devis_envoye' => 'Devis envoyé',
            'confirme' => 'Confirmé',
            'annule' => 'Annulé',
        ],
        'created_at' => 'Créée le',
    ],

    'informations_personnelles' => [
        'title' => 'Vos informations',
        'nom' => 'Nom',
        'email' => 'Email',
        'telephone' => 'Téléphone',
        'motif' => 'Motif',
        'motif_labels' => [
            'vacances' => 'Vacances',
            'affaires' => 'Affaires',
            'evenement' => 'Événement',
            'autre' => 'Autre',
        ],
    ],

    'details_sejour' => [
        'title' => 'Détails du séjour',
        'date_arrivee' => 'Date d\'arrivée',
        'duree' => 'Durée',
        'personnes' => 'Personnes',
        'accompagnement' => 'Accompagnement',
        'accompagnement_labels' => [
            'solo' => 'Seul(e)',
            'couple' => 'En couple',
            'famille' => 'En famille',
            'groupe' => 'En groupe',
        ],
    ],

    'services_demandes' => [
        'title' => 'Services demandés',
        'aucun_service' => 'Aucun service spécifié',
        'services_list' => [
            'transport' => 'Transport',
            'reservation_restaurant' => 'Réservation restaurant',
            'guide_touristique' => 'Guide touristique',
            'mise_a_disposition_vehicule' => 'Mise à disposition véhicule',
            'organisation_soiree' => 'Organisation soirée',
            'courses' => 'Courses',
            'nettoyage' => 'Nettoyage',
            'autres' => 'Autres services',
        ],
    ],

    'message' => [
        'title' => 'Votre message',
    ],

    'besoin_aide' => [
        'title' => 'Besoin d\'aide ?',
        'telephone' => [
            'label' => 'Téléphone',
            'number' => '01 76 38 00 17',
        ],
        'email' => [
            'label' => 'Email',
            'address' => 'conciergerie@djokprestige.com',
        ],
        'horaires' => [
            'label' => 'Horaires',
            'value' => 'Lun-Ven: 9h-19h',
        ],
        'icons' => [
            'telephone' => 'fas fa-phone-alt',
            'email' => 'fas fa-envelope',
            'horaires' => 'fas fa-clock',
        ],
    ],

    'devis' => [
        'title' => 'Devis',
        'envoye_le' => 'Devis envoyé le',
        'montant' => 'Montant',
    ],

    'actions' => [
        'telecharger_devis' => 'Télécharger le devis',
        'confirmer_demande' => 'Confirmer la demande',
        'annuler_demande' => 'Annuler la demande',
        'modifier_demande' => 'Modifier la demande',
        'retour_accueil' => 'Retour à l\'accueil',
    ],

    'validation' => [
        'confirmation_required' => 'Veuillez confirmer votre demande pour continuer.',
        'annulation_confirm' => 'Êtes-vous sûr de vouloir annuler cette demande ?',
        'modification_possible' => 'La modification n\'est possible que pour les demandes en statut "Nouvelle".',
    ],

    'timeline' => [
        'title' => 'Historique du traitement',
        'etapes' => [
            'creation' => [
                'titre' => 'Demande créée',
                'description' => 'Votre demande a été enregistrée',
                'icon' => 'fas fa-file-alt',
            ],
            'traitement' => [
                'titre' => 'En traitement',
                'description' => 'Notre équipe analyse votre demande',
                'icon' => 'fas fa-user-check',
            ],
            'devis' => [
                'titre' => 'Devis envoyé',
                'description' => 'Nous avons envoyé un devis détaillé',
                'icon' => 'fas fa-file-invoice-dollar',
            ],
            'confirmation' => [
                'titre' => 'Confirmée',
                'description' => 'Votre demande est confirmée',
                'icon' => 'fas fa-check-circle',
            ],
            'finalisation' => [
                'titre' => 'Finalisation',
                'description' => 'Préparation des services',
                'icon' => 'fas fa-concierge-bell',
            ],
        ],
    ],

    'documents' => [
        'title' => 'Documents associés',
        'devis' => 'Devis',
        'contrat' => 'Contrat',
        'facture' => 'Facture',
        'telecharger' => 'Télécharger',
        'visualiser' => 'Visualiser',
    ],

    'messages' => [
        'success_confirmation' => 'Votre demande a été confirmée avec succès.',
        'success_annulation' => 'Votre demande a été annulée.',
        'error_statut' => 'Cette action n\'est pas possible avec le statut actuel.',
    ],
];
