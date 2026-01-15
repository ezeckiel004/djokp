<?php

return [
    'title' => ':vehicle_name - DJOK PRESTIGE Location',

    'alerts' => [
        'success' => [
            'title' => 'Réservation envoyée avec succès !',
            'timeout' => 8000,
        ],
        'error' => [
            'title' => 'Erreur',
        ],
    ],

    'hero' => [
        'availability' => 'Disponibilité',
        'category' => 'Catégorie',
        'reserve_now' => 'Réserver maintenant',
        'call_us' => 'Nous appeler',
        'back_to_vehicles' => 'Retour aux véhicules',
    ],

    'sections' => [
        'gallery' => 'Galerie',
        'description' => 'Description',
        'specs' => 'Fiche technique',
        'features' => 'Équipements & options',
        'pricing' => 'Tarifs de location',
        'booking_form' => 'Réserver :vehicle_name',
        'similar_vehicles' => 'Véhicules similaires',
        'faq' => 'Questions fréquentes',
        'cta' => 'Prêt à réserver :vehicle_name ?',
    ],

    'specs' => [
        'brand' => 'Marque',
        'model' => 'Modèle',
        'year' => 'Année',
        'color' => 'Couleur',
        'fuel_type' => 'Type de carburant',
        'seats' => 'Nombre de places',
        'seats_unit' => 'places',
        'registration' => 'Immatriculation',
        'category' => 'Catégorie',
    ],

    'features' => [
        'default' => [
            'air_conditioning' => 'Climatisation',
            'gps' => 'GPS',
            'bluetooth' => 'Bluetooth',
            'rear_camera' => 'Caméra de recul',
        ],
        'included' => 'Inclus :',
    ],

    'pricing' => [
        'daily' => [
            'title' => 'Location à la journée',
            'min_days' => 'Minimum 1 jour',
            'unit' => 'TTC / jour',
        ],
        'weekly' => [
            'title' => 'Location à la semaine',
            'min_days' => 'Minimum 7 jours',
            'unit' => 'TTC / semaine',
        ],
        'monthly' => [
            'title' => 'Location au mois',
            'min_days' => 'Minimum 30 jours',
            'unit' => 'TTC / mois',
        ],
        'included' => [
            'title' => 'Inclus dans tous nos tarifs :',
            'description' => 'Assurance tous risques, entretien, assistance 24h/24',
        ],
    ],

    'booking' => [
        'cta' => 'Réserver ce véhicule',
        'security_note' => 'Réservation 100% sécurisée • Sans engagement',
        'form_description' => 'Remplissez le formulaire ci-dessous pour réserver ce véhicule. Notre équipe vous contactera dans les plus brefs délais.',

        'fields' => [
            'full_name' => 'Nom complet *',
            'email' => 'Email *',
            'phone' => 'Téléphone *',
            'selected_vehicle' => 'Véhicule sélectionné *',
            'vehicle_hint' => 'Vous réservez ce véhicule',
            'start_date' => 'Date de début de location *',
            'start_hint' => 'La date minimale est aujourd\'hui',
            'end_date' => 'Date de fin de location *',
            'end_hint' => 'La date doit être postérieure à la date de début',
            'message' => 'Message (optionnel)',
            'message_placeholder' => 'Informations complémentaires, questions...',
            'terms' => [
                'label' => 'J\'accepte les :cgv_link et j\'ai pris connaissance de la :privacy_link.',
                'cgv' => 'conditions générales de location',
                'privacy' => 'politique de confidentialité',
            ],
        ],

        'availability_check' => [
            'checking' => 'Vérification en cours...',
            'available' => 'Disponible',
            'not_available' => 'Non disponible',
            'error' => 'Erreur lors de la vérification. Veuillez réessayer.',
        ],

        'price_estimation' => [
            'title' => 'Estimation de prix :',
            'duration' => 'Durée :',
            'rate_type' => 'Type de tarif :',
            'estimated_amount' => 'Montant estimé :',
            'note' => 'Prix indicatif TTC',
            'days' => 'jours',
        ],

        'submit' => [
            'button' => 'Envoyer ma demande de réservation',
            'security_note' => 'Vos données sont sécurisées',
        ],
    ],

    'similar_vehicles' => [
        'description' => 'Découvrez d\'autres véhicules de la même catégorie qui pourraient vous intéresser.',
        'view_details' => 'Voir les détails',
        'per_day' => '/jour',
    ],

    'faq' => [
        'title' => 'Tout ce que vous devez savoir sur la location de ce véhicule.',
        'items' => [
            'documents' => [
                'question' => 'Quels documents sont nécessaires pour la location ?',
                'answer' => 'Pour louer ce véhicule, vous aurez besoin de : votre pièce d\'identité valide, permis de conduire B depuis plus de 3 ans, justificatif de domicile de moins de 3 mois, et pour les locations professionnelles, votre carte VTC.',
            ],
            'insurance' => [
                'question' => 'L\'assurance est-elle incluse ?',
                'answer' => 'Oui, toutes nos locations incluent une assurance tous risques avec franchise réduite. L\'assurance conducteur supplémentaire est également disponible en option.',
            ],
            'modification' => [
                'question' => 'Puis-je modifier ou annuler ma réservation ?',
                'answer' => 'Vous pouvez modifier votre réservation jusqu\'à 48h avant le début de la location. Les annulations sont possibles avec des conditions variables selon le délai.',
            ],
            'mileage' => [
                'question' => 'Y a-t-il un kilométrage maximum ?',
                'answer' => 'Pour les locations courte durée, un forfait kilométrique est inclus. Pour les locations longue durée, le kilométrage est illimité pour les véhicules VTC.',
            ],
        ],
    ],

    'cta' => [
        'description' => 'Contactez-nous directement pour toute question ou pour réserver ce véhicule par téléphone.',
        'phone' => '01 76 38 00 17',
        'email' => 'location@djokprestige.com',
    ],

    'messages' => [
        'date_error' => 'La date de fin doit être postérieure à la date de début.',
        'scroll_to_form' => 'Faites défiler jusqu\'au formulaire',
    ],

    'icons' => [
        'check' => 'fas fa-check',
        'times' => 'fas fa-times',
        'exclamation' => 'fas fa-exclamation-triangle',
        'calendar' => 'fas fa-calendar-alt',
        'phone' => 'fas fa-phone',
        'car' => 'fas fa-car',
        'cogs' => 'fas fa-cogs',
        'arrow_left' => 'fas fa-arrow-left',
        'check_circle' => 'fas fa-check-circle',
        'shield' => 'fas fa-shield-alt',
        'info_circle' => 'fas fa-info-circle',
        'lock' => 'fas fa-lock',
        'paper_plane' => 'fas fa-paper-plane',
        'envelope' => 'fas fa-envelope',
        'calendar_check' => 'fas fa-calendar-check',
        'check_in_circle' => 'fas fa-check-circle',
        'times_in_circle' => 'fas fa-times-circle',
        'spinner' => 'fas fa-spinner',
        'bolt' => 'fas fa-bolt',
        'map_marker' => 'fas fa-map-marker-alt',
        'bluetooth' => 'fas fa-bluetooth',
        'camera' => 'fas fa-camera',
        'graduation' => 'fas fa-graduation-cap',
        'file_invoice' => 'fas fa-file-invoice',
        'handshake' => 'fas fa-handshake',
    ],
];
