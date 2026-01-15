<?php

return [
    'inscrire_presentiel' => [
        'title' => 'Inscription :formation - Présentiel | DJOK PRESTIGE',
        'breadcrumb' => [
            'accueil' => 'Accueil',
            'formations' => 'Formations',
        ],

        'header' => [
            'type' => 'Formation présentielle',
            'date' => 'Date',
            'duree' => 'Durée',
            'lieu' => 'Lieu',
            'places_restantes' => 'places restantes',
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
            'objectifs' => [
                'title' => 'Objectifs pédagogiques',
            ],
            'public' => [
                'title' => 'Public visé',
            ],
            'prerequis' => [
                'title' => 'Prérequis',
            ],
            'equipement' => [
                'title' => 'Équipement fourni',
                'check_icon' => 'fas fa-check-circle',
            ],
        ],

        'inscription' => [
            'title' => 'Inscription',
            'prix' => [
                'label' => 'TTC',
                'currency' => '€',
                'options' => [
                    'formation_complete' => 'Formation complète',
                    'reinscription' => 'Réinscription',
                    'autre' => 'Autre option',
                ],
            ],
            'informations_personnelles' => [
                'title' => 'Vos informations personnelles',
                'champs' => [
                    'civilite' => [
                        'label' => 'Civilité *',
                        'options' => [
                            'monsieur' => 'Monsieur',
                            'madame' => 'Madame',
                            'mademoiselle' => 'Mademoiselle',
                        ],
                    ],
                    'nom' => [
                        'label' => 'Nom *',
                        'placeholder' => 'Votre nom',
                    ],
                    'prenom' => [
                        'label' => 'Prénom *',
                        'placeholder' => 'Votre prénom',
                    ],
                    'email' => [
                        'label' => 'Email *',
                        'placeholder' => 'votre@email.com',
                    ],
                    'telephone' => [
                        'label' => 'Téléphone *',
                        'placeholder' => '+33 1 23 45 67 89',
                    ],
                    'date_naissance' => [
                        'label' => 'Date de naissance *',
                        'placeholder' => 'JJ/MM/AAAA',
                    ],
                    'adresse' => [
                        'label' => 'Adresse',
                        'placeholder' => 'Votre adresse',
                    ],
                    'code_postal' => [
                        'label' => 'Code postal',
                        'placeholder' => '75000',
                    ],
                    'ville' => [
                        'label' => 'Ville',
                        'placeholder' => 'Votre ville',
                    ],
                    'pays' => [
                        'label' => 'Pays',
                        'placeholder' => 'France',
                    ],
                ],
            ],
            'statut_professionnel' => [
                'title' => 'Statut professionnel',
                'options' => [
                    'salarie' => 'Salarié(e)',
                    'demandeur_emploi' => 'Demandeur d\'emploi',
                    'independant' => 'Indépendant(e)',
                    'etudiant' => 'Étudiant(e)',
                    'autre' => 'Autre',
                ],
            ],
            'entreprise' => [
                'title' => 'Entreprise',
                'champs' => [
                    'nom_entreprise' => 'Nom de l\'entreprise',
                    'siret' => 'N° SIRET',
                    'adresse_entreprise' => 'Adresse de l\'entreprise',
                    'contact_rh' => 'Contact RH',
                ],
            ],
            'financement' => [
                'title' => 'Mode de financement',
                'options' => [
                    'personnel' => 'Financement personnel',
                    'employeur' => 'Financement employeur',
                    'pole_emploi' => 'Pôle Emploi',
                    'cif' => 'CIF (Compte Individuel de Formation)',
                    'cpf' => 'CPF (Compte Personnel de Formation)',
                ],
            ],
            'documents' => [
                'title' => 'Documents à fournir',
                'liste' => [
                    'piece_identite' => 'Copie de la pièce d\'identité (recto/verso)',
                    'justificatif_domicile' => 'Justificatif de domicile de moins de 3 mois',
                    'photo_identite' => 'Photo d\'identité',
                    'cv' => 'Curriculum Vitae',
                    'diplome' => 'Copie du dernier diplôme',
                ],
            ],
            'cgv' => [
                'label' => 'J\'accepte les :cgu et la :rgpd.',
                'cgu' => 'conditions générales d\'utilisation',
                'rgpd' => 'politique de confidentialité',
            ],
            'bouton_inscription' => [
                'text' => 'S\'inscrire maintenant',
                'icon' => 'fas fa-user-plus',
                'loading_icon' => 'fas fa-spinner fa-spin',
            ],
        ],

        'lieu' => [
            'title' => 'Lieu de la formation',
            'adresse' => 'Adresse',
            'salle' => 'Salle',
            'equipements' => [
                'title' => 'Équipements disponibles',
                'items' => [
                    'ordinateurs' => 'Ordinateurs disponibles',
                    'videoprojecteur' => 'Vidéoprojecteur',
                    'wifi' => 'Wi-Fi gratuit',
                    'parking' => 'Parking gratuit',
                    'cafeteria' => 'Cafétéria',
                ],
            ],
        ],

        'contact' => [
            'title' => 'Contact',
            'telephone' => [
                'label' => '01 76 38 00 17',
                'horaires' => 'Lun-Ven 9h-19h',
                'icon' => 'fas fa-phone-alt',
                'color' => 'blue',
            ],
            'email' => [
                'label' => 'formations@djokprestige.com',
                'delai' => 'Réponse sous 24h',
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
            'text' => 'Retour aux formations',
            'icon' => 'fas fa-arrow-left',
        ],

        'validation' => [
            'required_fields' => 'Veuillez remplir tous les champs obligatoires (*).',
            'invalid_email' => 'Veuillez entrer une adresse email valide.',
            'invalid_telephone' => 'Veuillez entrer un numéro de téléphone valide.',
            'invalid_date' => 'Veuillez entrer une date valide (JJ/MM/AAAA).',
            'accept_cgv' => 'Veuillez accepter les conditions générales.',
            'inscription_error' => 'Une erreur est survenue. Veuillez réessayer.',
            'places_epuisees' => 'Désolé, il n\'y a plus de places disponibles pour cette session.',
        ],

        'messages' => [
            'success' => 'Votre inscription a été enregistrée avec succès !',
            'confirmation' => 'Un email de confirmation vous a été envoyé.',
            'processing' => 'Traitement de votre inscription...',
        ],

        'confirmation' => [
            'title' => 'Étape suivante',
            'steps' => [
                'email' => 'Vous recevrez un email de confirmation',
                'documents' => 'Envoyez vos documents par email',
                'paiement' => 'Effectuez le règlement',
                'finalisation' => 'Finalisation de l\'inscription',
            ],
        ],
    ],
];
