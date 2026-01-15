<?php

return [
    'title' => 'Booking Confirmation - DJOK PRESTIGE',

    'header' => [
        'title' => 'Booking request confirmed!',
        'subtitle' => 'We have received your request. A confirmation email has been sent to :email',
    ],

    'summary' => [
        'title' => 'Booking Summary',
        'vehicle_details' => 'Vehicle Details',
        'rental_details' => 'Rental Details',
        'vehicle' => 'Vehicle:',
        'category' => 'Category:',
        'fuel' => 'Fuel:',
        'reference' => 'Reference:',
        'period' => 'Period:',
        'period_from_to' => 'from :date_debut to :date_fin',
        'duration' => 'Duration:',
        'days' => 'days',
        'estimated_amount' => 'Estimated amount:',
        'vat_included' => 'VAT included',
    ],

    'next_steps' => [
        'title' => 'Next Steps',
        'steps' => [
            1 => [
                'number' => '1',
                'text' => 'Our team checks the final availability of the vehicle',
            ],
            2 => [
                'number' => '2',
                'text' => 'You will receive a final confirmation email within 24 hours',
            ],
            3 => [
                'number' => '3',
                'text' => 'An advisor will contact you at :telephone to finalize',
            ],
        ],
    ],

    'actions' => [
        'view_vehicles' => 'View other vehicles',
        'go_home' => 'Return to homepage',
    ],

    'footer' => [
        'title' => 'Have a question?',
        'contact_phone' => 'Contact us at :phone',
        'contact_email' => 'or by email at :email',
        'reference_note' => 'Reference to keep:',
    ],

    'status' => [
        'pending' => 'Pending confirmation',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancelled',
    ],

    'dates' => [
        'format' => 'd/m/Y',
        'from' => 'from',
        'to' => 'to',
        'today' => 'Today',
        'tomorrow' => 'Tomorrow',
    ],

    'messages' => [
        'thank_you' => 'Thank you for your trust!',
        'processing' => 'Your request is being processed.',
        'contact_soon' => 'We will contact you soon.',
        'save_reference' => 'Keep your reference number safe.',
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
