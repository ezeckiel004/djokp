<?php

return [
    'title' => 'Formulaire de Réclamation - DJOK PRESTIGE',
    'main_title' => 'Formulaire de Réclamation',
    'subtitle' => 'Vous souhaitez faire une réclamation ou formuler une suggestion ? Remplissez le formulaire ci-dessous.',

    'informations_importantes' => [
        'title' => 'Informations importantes',
        'items' => [
            'Nous traitons toutes les réclamations dans un délai maximum de 2 jours ouvrés',
            'Pour les réclamations complexes, nous vous tiendrons informé de l\'avancement',
            'Vous recevrez un accusé de réception par email dans les 24 heures',
        ],
    ],

    'formulaire' => [
        'informations_personnelles' => 'Informations personnelles',
        'champs' => [
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
                'label' => 'Téléphone',
                'placeholder' => '+33 1 23 45 67 89',
            ],
            'type_reclamation' => [
                'label' => 'Type de demande *',
                'placeholder' => 'Sélectionnez le type de demande',
                'options' => [
                    '' => 'Sélectionnez le type de demande',
                    'reclamation' => 'Réclamation',
                    'suggestion' => 'Suggestion',
                    'question' => 'Question',
                    'probleme_technique' => 'Problème technique',
                    'autre' => 'Autre',
                ],
            ],
            'service_concerne' => [
                'label' => 'Service concerné *',
                'placeholder' => 'Sélectionnez le service concerné',
                'options' => [
                    '' => 'Sélectionnez le service concerné',
                    'formation_vtc' => 'Formation VTC',
                    'location_vehicules' => 'Location de véhicules',
                    'service_vtc' => 'Service VTC & Transport',
                    'conciergerie' => 'Conciergerie',
                    'formation_international' => 'Formation Internationale',
                    'autre' => 'Autre',
                ],
            ],
            'sujet' => [
                'label' => 'Sujet *',
                'placeholder' => 'Objet de votre message',
            ],
            'message' => [
                'label' => 'Message détaillé *',
                'placeholder' => 'Décrivez votre réclamation ou suggestion en détail...',
            ],
            'pieces_jointes' => [
                'label' => 'Pièces jointes (optionnel)',
                'info' => 'Formats acceptés : PDF, JPG, PNG, DOC. Taille max : 5MB par fichier',
            ],
        ],
        'consentement' => [
            'label' => 'J\'accepte que mes données personnelles soient traitées dans le cadre du traitement de ma réclamation, conformément à la :privacy_policy de DJOK PRESTIGE.',
            'privacy_policy' => 'politique de confidentialité',
        ],
        'submit' => 'Envoyer ma réclamation',
    ],

    'contact_alternatives' => [
        'title' => 'Informations de contact alternatives',
        'telephone' => [
            'title' => 'Téléphone',
            'number' => '+33 1 48 47 52 13',
            'horaires' => 'Lun-Ven: 9h-18h',
        ],
        'email' => [
            'title' => 'Email',
            'address' => 'contact@djokprestige.com',
            'delai_reponse' => 'Réponse sous 24h',
        ],
        'adresse' => [
            'title' => 'Adresse',
            'rue' => '66 Avenue des Champs Élysées',
            'ville' => '75008 Paris, France',
        ],
    ],

    'mediateur' => [
        'title' => 'Médiateur de la consommation',
        'description' => 'Si vous n\'êtes pas satisfait de notre réponse, vous pouvez saisir le médiateur de la consommation :',
        'nom' => 'Médiateur de la consommation SMP',
        'url' => 'https://www.mediateur-consommation-smp.fr',
        'acceder' => 'Accéder',
    ],

    'validation' => [
        'required' => 'Ce champ est requis.',
        'email' => 'Veuillez entrer une adresse email valide.',
        'max' => 'Le fichier ne doit pas dépasser :max MB.',
        'accepted' => 'Vous devez accepter les conditions.',
    ],

    'success_message' => 'Votre réclamation a été envoyée avec succès. Nous vous répondrons dans les plus brefs délais.',
    'error_message' => 'Une erreur est survenue lors de l\'envoi de votre réclamation. Veuillez réessayer.',

    'back_to_home' => 'Retour à l\'accueil',
];
