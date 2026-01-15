<?php

return [
    'inscrire_presentiel' => [
        'title' => 'Registration :formation - In-person | DJOK PRESTIGE',
        'breadcrumb' => [
            'accueil' => 'Home',
            'formations' => 'Training',
        ],

        'header' => [
            'type' => 'In-person training',
            'date' => 'Date',
            'duree' => 'Duration',
            'lieu' => 'Location',
            'places_restantes' => 'spots remaining',
        ],

        'details' => [
            'title' => 'Training details',
            'description' => [
                'title' => 'Description',
            ],
            'programme' => [
                'title' => 'Program',
                'check_icon' => 'fas fa-check',
            ],
            'objectifs' => [
                'title' => 'Learning objectives',
            ],
            'public' => [
                'title' => 'Target audience',
            ],
            'prerequis' => [
                'title' => 'Prerequisites',
            ],
            'equipement' => [
                'title' => 'Equipment provided',
                'check_icon' => 'fas fa-check-circle',
            ],
        ],

        'inscription' => [
            'title' => 'Registration',
            'prix' => [
                'label' => 'VAT incl.',
                'currency' => '€',
                'options' => [
                    'formation_complete' => 'Complete training',
                    'reinscription' => 'Re-registration',
                    'autre' => 'Other option',
                ],
            ],
            'informations_personnelles' => [
                'title' => 'Your personal information',
                'champs' => [
                    'civilite' => [
                        'label' => 'Title *',
                        'options' => [
                            'monsieur' => 'Mr.',
                            'madame' => 'Mrs.',
                            'mademoiselle' => 'Miss',
                        ],
                    ],
                    'nom' => [
                        'label' => 'Last name *',
                        'placeholder' => 'Your last name',
                    ],
                    'prenom' => [
                        'label' => 'First name *',
                        'placeholder' => 'Your first name',
                    ],
                    'email' => [
                        'label' => 'Email *',
                        'placeholder' => 'your@email.com',
                    ],
                    'telephone' => [
                        'label' => 'Phone *',
                        'placeholder' => '+33 1 23 45 67 89',
                    ],
                    'date_naissance' => [
                        'label' => 'Date of birth *',
                        'placeholder' => 'DD/MM/YYYY',
                    ],
                    'adresse' => [
                        'label' => 'Address',
                        'placeholder' => 'Your address',
                    ],
                    'code_postal' => [
                        'label' => 'Postal code',
                        'placeholder' => '75000',
                    ],
                    'ville' => [
                        'label' => 'City',
                        'placeholder' => 'Your city',
                    ],
                    'pays' => [
                        'label' => 'Country',
                        'placeholder' => 'France',
                    ],
                ],
            ],
            'statut_professionnel' => [
                'title' => 'Professional status',
                'options' => [
                    'salarie' => 'Employee',
                    'demandeur_emploi' => 'Job seeker',
                    'independant' => 'Self-employed',
                    'etudiant' => 'Student',
                    'autre' => 'Other',
                ],
            ],
            'entreprise' => [
                'title' => 'Company',
                'champs' => [
                    'nom_entreprise' => 'Company name',
                    'siret' => 'SIRET number',
                    'adresse_entreprise' => 'Company address',
                    'contact_rh' => 'HR contact',
                ],
            ],
            'financement' => [
                'title' => 'Funding method',
                'options' => [
                    'personnel' => 'Personal funding',
                    'employeur' => 'Employer funding',
                    'pole_emploi' => 'Employment center',
                    'cif' => 'CIF (Individual Training Account)',
                    'cpf' => 'CPF (Personal Training Account)',
                ],
            ],
            'documents' => [
                'title' => 'Documents to provide',
                'liste' => [
                    'piece_identite' => 'Copy of ID (front/back)',
                    'justificatif_domicile' => 'Proof of address (less than 3 months)',
                    'photo_identite' => 'ID photo',
                    'cv' => 'Curriculum Vitae',
                    'diplome' => 'Copy of last diploma',
                ],
            ],
            'cgv' => [
                'label' => 'I accept the :cgu and the :rgpd.',
                'cgu' => 'terms of use',
                'rgpd' => 'privacy policy',
            ],
            'bouton_inscription' => [
                'text' => 'Register now',
                'icon' => 'fas fa-user-plus',
                'loading_icon' => 'fas fa-spinner fa-spin',
            ],
        ],

        'lieu' => [
            'title' => 'Training location',
            'adresse' => 'Address',
            'salle' => 'Room',
            'equipements' => [
                'title' => 'Available equipment',
                'items' => [
                    'ordinateurs' => 'Available computers',
                    'videoprojecteur' => 'Video projector',
                    'wifi' => 'Free Wi-Fi',
                    'parking' => 'Free parking',
                    'cafeteria' => 'Cafeteria',
                ],
            ],
        ],

        'contact' => [
            'title' => 'Contact',
            'telephone' => [
                'label' => '+33 1 76 38 00 17',
                'horaires' => 'Mon-Fri 9am-7pm',
                'icon' => 'fas fa-phone-alt',
                'color' => 'blue',
            ],
            'email' => [
                'label' => 'formations@djokprestige.com',
                'delai' => 'Response within 24h',
                'icon' => 'fas fa-envelope',
                'color' => 'green',
            ],
            'adresse' => [
                'label' => '66 Avenue des Champs Élysées',
                'ville' => '75008 Paris',
                'icon' => 'fas fa-map-marker-alt',
                'color' => 'red',
            ],
        ],

        'retour' => [
            'text' => 'Back to training',
            'icon' => 'fas fa-arrow-left',
        ],

        'validation' => [
            'required_fields' => 'Please fill in all required fields (*).',
            'invalid_email' => 'Please enter a valid email address.',
            'invalid_telephone' => 'Please enter a valid phone number.',
            'invalid_date' => 'Please enter a valid date (DD/MM/YYYY).',
            'accept_cgv' => 'Please accept the terms and conditions.',
            'inscription_error' => 'An error occurred. Please try again.',
            'places_epuisees' => 'Sorry, there are no more spots available for this session.',
        ],

        'messages' => [
            'success' => 'Your registration has been successfully recorded!',
            'confirmation' => 'A confirmation email has been sent to you.',
            'processing' => 'Processing your registration...',
        ],

        'confirmation' => [
            'title' => 'Next steps',
            'steps' => [
                'email' => 'You will receive a confirmation email',
                'documents' => 'Send your documents by email',
                'paiement' => 'Make the payment',
                'finalisation' => 'Finalization of registration',
            ],
        ],
    ],
];
