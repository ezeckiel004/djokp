<?php

return [
    'title' => 'Confirmation de réservation - DJOK PRESTIGE',

    'header' => [
        'title' => 'Demande de réservation confirmée !',
        'subtitle' => 'Nous avons bien reçu votre demande. Un email de confirmation vous a été envoyé à :email',
    ],

    'summary' => [
        'title' => 'Récapitulatif de votre réservation',
        'vehicle_details' => 'Détails du véhicule',
        'rental_details' => 'Détails de la location',
        'vehicle' => 'Véhicule :',
        'category' => 'Catégorie :',
        'fuel' => 'Carburant :',
        'reference' => 'Référence :',
        'period' => 'Période :',
        'period_from_to' => 'du :date_debut au :date_fin',
        'duration' => 'Durée :',
        'days' => 'jours',
        'estimated_amount' => 'Montant estimé :',
        'vat_included' => 'TTC',
    ],

    'next_steps' => [
        'title' => 'Prochaines étapes',
        'steps' => [
            1 => [
                'number' => '1',
                'text' => 'Notre équipe vérifie la disponibilité définitive du véhicule',
            ],
            2 => [
                'number' => '2',
                'text' => 'Vous recevrez une confirmation définitive par email sous 24h',
            ],
            3 => [
                'number' => '3',
                'text' => 'Un conseiller vous contactera au :telephone pour finaliser',
            ],
        ],
    ],

    'actions' => [
        'view_vehicles' => 'Voir d\'autres véhicules',
        'go_home' => 'Retour à l\'accueil',
    ],

    'footer' => [
        'title' => 'Vous avez une question ?',
        'contact_phone' => 'Contactez-nous au :phone',
        'contact_email' => 'ou par email à :email',
        'reference_note' => 'Référence à conserver :',
    ],

    'status' => [
        'pending' => 'En attente de confirmation',
        'confirmed' => 'Confirmée',
        'cancelled' => 'Annulée',
    ],

    'dates' => [
        'format' => 'd/m/Y',
        'from' => 'du',
        'to' => 'au',
        'today' => 'Aujourd\'hui',
        'tomorrow' => 'Demain',
    ],

    'messages' => [
        'thank_you' => 'Merci pour votre confiance !',
        'processing' => 'Votre demande est en cours de traitement.',
        'contact_soon' => 'Nous vous contacterons très prochainement.',
        'save_reference' => 'Conservez bien votre numéro de référence.',
    ],

    'icons' => [
        'check' => 'fas fa-check',
        'car' => 'fas fa-car',
        'home' => 'fas fa-home',
        'phone' => 'fas fa-phone',
        'envelope' => 'fas fa-envelope',
        'calendar' => 'fas fa-calendar-alt',
        'clock' => 'fas fa-clock',
        'shield' => 'fas fa-shield-alt',
        'info' => 'fas fa-info-circle',
    ],
];
