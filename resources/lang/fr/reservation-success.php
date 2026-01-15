<?php

return [
    'title' => 'Réservation réussie - DJOK PRESTIGE',
    'hero' => [
        'emoji' => '🎉',
        'title' => 'Réservation réussie !',
        'subtitle' => 'Votre réservation a bien été enregistrée',
    ],

    'success_message' => [
        'title' => 'Merci pour votre réservation !',
        'items' => [
            'Votre réservation a bien été enregistrée et est en attente de confirmation.',
            'Vous allez recevoir un email de confirmation dans quelques minutes.',
            'Notre équipe traitera votre demande sous 24 heures maximum.',
        ],
    ],

    'actions' => [
        'back_to_home' => [
            'text' => 'Retour à l\'accueil',
            'icon' => 'fas fa-home',
        ],
        'create_account' => [
            'text' => 'Créer un compte',
            'icon' => 'fas fa-user-plus',
        ],
        'my_reservations' => [
            'text' => 'Mes réservations',
            'icon' => 'fas fa-list',
        ],
    ],

    'next_steps' => [
        'title' => 'Prochaines étapes',
        'steps' => [
            [
                'title' => 'Email de confirmation',
                'description' => 'Vous recevrez un email de confirmation avec les détails de votre réservation.',
                'icon' => 'fas fa-envelope',
                'color' => 'blue',
            ],
            [
                'title' => 'Traitement de la demande',
                'description' => 'Notre équipe traitera votre demande et vous contactera si nécessaire.',
                'icon' => 'fas fa-user-check',
                'color' => 'green',
            ],
            [
                'title' => 'Préparation',
                'description' => 'Nous préparons tout pour que votre expérience soit exceptionnelle.',
                'icon' => 'fas fa-concierge-bell',
                'color' => 'yellow',
            ],
        ],
    ],

    'contact_info' => [
        'title' => 'Besoin d\'aide ?',
        'description' => 'Notre équipe est à votre disposition pour toute question.',
        'items' => [
            [
                'title' => 'Par téléphone',
                'content' => '+33 1 48 47 52 13',
                'icon' => 'fas fa-phone',
                'color' => 'blue',
            ],
            [
                'title' => 'Par email',
                'content' => 'contact@djokprestige.com',
                'icon' => 'fas fa-envelope',
                'color' => 'green',
            ],
            [
                'title' => 'Horaires',
                'content' => 'Lun-Ven: 9h-18h',
                'icon' => 'fas fa-clock',
                'color' => 'purple',
            ],
        ],
    ],
];
