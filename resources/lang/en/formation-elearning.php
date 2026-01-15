<?php

return [
    'acheter_elearning' => [
        'title' => 'Buy :formation | DJOK PRESTIGE',
        'breadcrumb' => [
            'accueil' => 'Home',
            'formations' => 'Training',
        ],

        'header' => [
            'type' => 'E-learning training',
            'access' => '12 months access',
            'icon' => 'fas fa-graduation-cap',
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
            'inclus' => [
                'title' => 'What\'s included',
                'check_icon' => 'fas fa-check-circle',
            ],
            'multimedia' => [
                'title' => 'Multimedia content',
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
            'title' => 'Proceed to purchase',
            'prix' => [
                'label' => 'VAT incl. • Immediate access after payment',
                'currency' => '€',
            ],
            'avantages' => [
                'title' => 'Benefits',
                'items' => [
                    [
                        'text' => '24/7 access',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Technical support included',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Training certificate',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Unlimited access for 12 months',
                        'icon' => 'fas fa-check',
                    ],
                ],
                'icon_color' => 'green',
            ],
            'paiement' => [
                'title' => 'Payment information',
                'connecte_comme' => 'Connected as',
                'moyen_paiement' => 'Payment method',
                'carte_bancaire' => [
                    'label' => 'Credit card',
                    'description' => 'Secure payment by Stripe',
                    'icon' => 'fas fa-credit-card',
                ],
            ],
            'champs' => [
                'email' => [
                    'label' => 'Email *',
                    'placeholder' => 'your@email.com',
                ],
                'nom' => [
                    'label' => 'Full name *',
                    'placeholder' => 'Your name',
                ],
            ],
            'cgv' => [
                'label' => 'I accept the :cgu and the :rgpd.',
                'cgu' => 'terms of use',
                'rgpd' => 'privacy policy',
            ],
            'bouton_paiement' => [
                'text' => 'Pay :prix €',
                'icon' => 'fas fa-lock',
                'loading_icon' => 'fas fa-spinner fa-spin',
            ],
            'securite' => [
                'text' => '100% secure payment • SSL encrypted',
                'icon' => 'fas fa-shield-alt',
                'color' => 'green',
            ],
        ],

        'assistance' => [
            'title' => 'Need help?',
            'telephone' => [
                'label' => '+33 1 76 38 00 17',
                'horaires' => 'Mon-Fri 9am-7pm',
                'icon' => 'fas fa-phone-alt',
                'color' => 'yellow',
            ],
            'email' => [
                'label' => 'support@djokprestige.com',
                'delai' => 'Response within 24h',
                'icon' => 'fas fa-envelope',
                'color' => 'yellow',
            ],
        ],

        'retour' => [
            'text' => 'Back to training',
            'icon' => 'fas fa-arrow-left',
        ],

        'validation' => [
            'required_fields' => 'Please fill in all required fields.',
            'invalid_email' => 'Please enter a valid email address.',
            'accept_cgv' => 'Please accept the terms and conditions.',
            'payment_error' => 'An error occurred. Please try again.',
        ],

        'messages' => [
            'success' => 'Payment successful!',
            'processing' => 'Processing payment...',
            'redirecting' => 'Redirecting to secure payment...',
        ],
    ],
];
