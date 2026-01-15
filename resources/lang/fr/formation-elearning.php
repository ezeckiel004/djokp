<?php

return [
    'acheter_elearning' => [
        'title' => 'Acheter :formation | DJOK PRESTIGE',
        'breadcrumb' => [
            'accueil' => 'Accueil',
            'formations' => 'Formations',
        ],

        'header' => [
            'type' => 'Formation e-learning',
            'access' => 'Accès 12 mois',
            'icon' => 'fas fa-graduation-cap',
        ],

        'details' => [
            'title' => 'Détails de la formation',
            'description' => [
                'title' => 'Description',
            ],
            'programme' => [
                'title' => 'Programme',
                'check_icon' => 'fas fa-check',
            ],
            'inclus' => [
                'title' => 'Ce qui est inclus',
                'check_icon' => 'fas fa-check-circle',
            ],
            'multimedia' => [
                'title' => 'Contenu multimédia',
                'types' => [
                    'pdf' => [
                        'icon' => 'fas fa-file-pdf',
                        'color' => 'red',
                    ],
                    'video' => [
                        'icon' => 'fas fa-video',
                        'color' => 'blue',
                    ],
                ],
            ],
        ],

        'achat' => [
            'title' => 'Procéder à l\'achat',
            'prix' => [
                'label' => 'TTC • Accès immédiat après paiement',
                'currency' => '€',
            ],
            'avantages' => [
                'title' => 'Avantages',
                'items' => [
                    [
                        'text' => 'Accès 24h/24, 7j/7',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Support technique inclus',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Certificat de formation',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Accès illimité pendant 12 mois',
                        'icon' => 'fas fa-check',
                    ],
                ],
                'icon_color' => 'green',
            ],
            'paiement' => [
                'title' => 'Informations de paiement',
                'connecte_comme' => 'Connecté en tant que',
                'moyen_paiement' => 'Moyen de paiement',
                'carte_bancaire' => [
                    'label' => 'Carte bancaire',
                    'description' => 'Paiement sécurisé par Stripe',
                    'icon' => 'fas fa-credit-card',
                ],
            ],
            'champs' => [
                'email' => [
                    'label' => 'Email *',
                    'placeholder' => 'votre@email.com',
                ],
                'nom' => [
                    'label' => 'Nom complet *',
                    'placeholder' => 'Votre nom',
                ],
            ],
            'cgv' => [
                'label' => 'J\'accepte les :cgu et la :rgpd.',
                'cgu' => 'conditions générales d\'utilisation',
                'rgpd' => 'politique de confidentialité',
            ],
            'bouton_paiement' => [
                'text' => 'Payer :prix €',
                'icon' => 'fas fa-lock',
                'loading_icon' => 'fas fa-spinner fa-spin',
            ],
            'securite' => [
                'text' => 'Paiement 100% sécurisé • SSL crypté',
                'icon' => 'fas fa-shield-alt',
                'color' => 'green',
            ],
        ],

        'assistance' => [
            'title' => 'Besoins d\'aide ?',
            'telephone' => [
                'label' => '01 76 38 00 17',
                'horaires' => 'Lun-Ven 9h-19h',
                'icon' => 'fas fa-phone-alt',
                'color' => 'yellow',
            ],
            'email' => [
                'label' => 'support@djokprestige.com',
                'delai' => 'Réponse sous 24h',
                'icon' => 'fas fa-envelope',
                'color' => 'yellow',
            ],
        ],

        'retour' => [
            'text' => 'Retour aux formations',
            'icon' => 'fas fa-arrow-left',
        ],

        'validation' => [
            'required_fields' => 'Veuillez remplir tous les champs requis.',
            'invalid_email' => 'Veuillez entrer une adresse email valide.',
            'accept_cgv' => 'Veuillez accepter les conditions générales.',
            'payment_error' => 'Une erreur est survenue. Veuillez réessayer.',
        ],

        'messages' => [
            'success' => 'Paiement effectué avec succès !',
            'processing' => 'Traitement du paiement en cours...',
            'redirecting' => 'Redirection vers le paiement sécurisé...',
        ],
    ],
];
