<?php

return [
    'title' => 'Paiement annulé | DJOK PRESTIGE',
    'header' => [
        'title' => 'Paiement annulé',
        'subtitle' => 'Votre transaction a été interrompue.',
    ],

    'message' => [
        'title' => 'Transaction non aboutie',
        'content' => 'Votre paiement a été annulé ou une erreur est survenue pendant le processus. Aucun prélèvement n\'a été effectué sur votre compte.',
        'info' => 'Si cette annulation était involontaire, vous pouvez réessayer.',
    ],

    'causes' => [
        'title' => 'Causes possibles :',
        'items' => [
            'voluntary' => 'Annulation volontaire pendant le processus de paiement',
            'technical' => 'Problème technique temporaire avec le système de paiement',
            'card' => 'Informations de carte bancaire incorrectes',
            'timeout' => 'Délai d\'attente trop long lors de la saisie',
        ],
    ],

    'actions' => [
        'retry' => 'Réessayer le paiement',
        'back_formations' => 'Retour aux formations',
        'back_home' => 'Retour à l\'accueil',
    ],

    'assistance' => [
        'title' => 'Besoin d\'aide ?',
        'content' => 'Notre équipe de support est là pour vous aider à résoudre ce problème.',
        'phone' => '01 76 38 00 17',
        'phone_hours' => 'Lun-Ven 9h-19h',
        'email' => 'support@djokprestige.com',
        'response_time' => 'Réponse sous 24h',
    ],

    'icons' => [
        'cancel' => 'fas fa-times-circle',
        'warning' => 'fas fa-exclamation-triangle',
        'info' => 'fas fa-info-circle',
        'retry' => 'fas fa-redo',
        'back' => 'fas fa-arrow-left',
        'phone' => 'fas fa-phone-alt',
        'email' => 'fas fa-envelope',
    ],

    'status_messages' => [
        'no_charge' => 'Aucun prélèvement effectué',
        'safe_transaction' => 'Transaction sécurisée annulée',
        'can_retry' => 'Vous pouvez réessayer à tout moment',
    ],
];
