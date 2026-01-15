<?php

return [
    'title' => 'Request tracking - :reference',
    'page_title' => 'Your request tracking',
    'reference' => 'Reference',

    'statut' => [
        'title' => 'Your request status',
        'labels' => [
            'nouvelle' => 'New',
            'devis_envoye' => 'Quote sent',
            'confirme' => 'Confirmed',
            'annule' => 'Cancelled',
        ],
        'created_at' => 'Created on',
    ],

    'informations_personnelles' => [
        'title' => 'Your information',
        'nom' => 'Name',
        'email' => 'Email',
        'telephone' => 'Phone',
        'motif' => 'Purpose',
        'motif_labels' => [
            'vacances' => 'Vacation',
            'affaires' => 'Business',
            'evenement' => 'Event',
            'autre' => 'Other',
        ],
    ],

    'details_sejour' => [
        'title' => 'Stay details',
        'date_arrivee' => 'Arrival date',
        'duree' => 'Duration',
        'personnes' => 'People',
        'accompagnement' => 'Accompaniment',
        'accompagnement_labels' => [
            'solo' => 'Alone',
            'couple' => 'Couple',
            'famille' => 'Family',
            'groupe' => 'Group',
        ],
    ],

    'services_demandes' => [
        'title' => 'Requested services',
        'aucun_service' => 'No service specified',
        'services_list' => [
            'transport' => 'Transport',
            'reservation_restaurant' => 'Restaurant reservation',
            'guide_touristique' => 'Tourist guide',
            'mise_a_disposition_vehicule' => 'Vehicle provision',
            'organisation_soiree' => 'Evening organization',
            'courses' => 'Shopping',
            'nettoyage' => 'Cleaning',
            'autres' => 'Other services',
        ],
    ],

    'message' => [
        'title' => 'Your message',
    ],

    'besoin_aide' => [
        'title' => 'Need help?',
        'telephone' => [
            'label' => 'Phone',
            'number' => '+33 1 76 38 00 17',
        ],
        'email' => [
            'label' => 'Email',
            'address' => 'conciergerie@djokprestige.com',
        ],
        'horaires' => [
            'label' => 'Opening hours',
            'value' => 'Mon-Fri: 9am-7pm',
        ],
        'icons' => [
            'telephone' => 'fas fa-phone-alt',
            'email' => 'fas fa-envelope',
            'horaires' => 'fas fa-clock',
        ],
    ],

    'devis' => [
        'title' => 'Quote',
        'envoye_le' => 'Quote sent on',
        'montant' => 'Amount',
    ],

    'actions' => [
        'telecharger_devis' => 'Download quote',
        'confirmer_demande' => 'Confirm request',
        'annuler_demande' => 'Cancel request',
        'modifier_demande' => 'Modify request',
        'retour_accueil' => 'Back to home',
    ],

    'validation' => [
        'confirmation_required' => 'Please confirm your request to continue.',
        'annulation_confirm' => 'Are you sure you want to cancel this request?',
        'modification_possible' => 'Modification is only possible for requests in "New" status.',
    ],

    'timeline' => [
        'title' => 'Processing history',
        'etapes' => [
            'creation' => [
                'titre' => 'Request created',
                'description' => 'Your request has been recorded',
                'icon' => 'fas fa-file-alt',
            ],
            'traitement' => [
                'titre' => 'In processing',
                'description' => 'Our team is analyzing your request',
                'icon' => 'fas fa-user-check',
            ],
            'devis' => [
                'titre' => 'Quote sent',
                'description' => 'We have sent a detailed quote',
                'icon' => 'fas fa-file-invoice-dollar',
            ],
            'confirmation' => [
                'titre' => 'Confirmed',
                'description' => 'Your request is confirmed',
                'icon' => 'fas fa-check-circle',
            ],
            'finalisation' => [
                'titre' => 'Finalization',
                'description' => 'Service preparation',
                'icon' => 'fas fa-concierge-bell',
            ],
        ],
    ],

    'documents' => [
        'title' => 'Associated documents',
        'devis' => 'Quote',
        'contrat' => 'Contract',
        'facture' => 'Invoice',
        'telecharger' => 'Download',
        'visualiser' => 'View',
    ],

    'messages' => [
        'success_confirmation' => 'Your request has been confirmed successfully.',
        'success_annulation' => 'Your request has been cancelled.',
        'error_statut' => 'This action is not possible with the current status.',
    ],
];
