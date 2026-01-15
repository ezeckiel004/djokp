<?php

return [
    'title' => 'Complaint Form - DJOK PRESTIGE',
    'main_title' => 'Complaint Form',
    'subtitle' => 'Do you wish to file a complaint or make a suggestion? Please fill out the form below.',

    'informations_importantes' => [
        'title' => 'Important Information',
        'items' => [
            'We process all complaints within a maximum of 2 working days',
            'For complex complaints, we will keep you informed of progress',
            'You will receive an email acknowledgment within 24 hours',
        ],
    ],

    'formulaire' => [
        'informations_personnelles' => 'Personal Information',
        'champs' => [
            'nom' => [
                'label' => 'Last Name *',
                'placeholder' => 'Your last name',
            ],
            'prenom' => [
                'label' => 'First Name *',
                'placeholder' => 'Your first name',
            ],
            'email' => [
                'label' => 'Email *',
                'placeholder' => 'your@email.com',
            ],
            'telephone' => [
                'label' => 'Phone',
                'placeholder' => '+33 1 23 45 67 89',
            ],
            'type_reclamation' => [
                'label' => 'Request Type *',
                'placeholder' => 'Select the request type',
                'options' => [
                    '' => 'Select the request type',
                    'reclamation' => 'Complaint',
                    'suggestion' => 'Suggestion',
                    'question' => 'Question',
                    'probleme_technique' => 'Technical Problem',
                    'autre' => 'Other',
                ],
            ],
            'service_concerne' => [
                'label' => 'Service Concerned *',
                'placeholder' => 'Select the concerned service',
                'options' => [
                    '' => 'Select the concerned service',
                    'formation_vtc' => 'VTC Training',
                    'location_vehicules' => 'Vehicle Rental',
                    'service_vtc' => 'VTC & Transport Service',
                    'conciergerie' => 'Concierge Service',
                    'formation_international' => 'International Training',
                    'autre' => 'Other',
                ],
            ],
            'sujet' => [
                'label' => 'Subject *',
                'placeholder' => 'Subject of your message',
            ],
            'message' => [
                'label' => 'Detailed Message *',
                'placeholder' => 'Describe your complaint or suggestion in detail...',
            ],
            'pieces_jointes' => [
                'label' => 'Attachments (optional)',
                'info' => 'Accepted formats: PDF, JPG, PNG, DOC. Max size: 5MB per file',
            ],
        ],
        'consentement' => [
            'label' => 'I accept that my personal data will be processed as part of the handling of my complaint, in accordance with the DJOK PRESTIGE :privacy_policy.',
            'privacy_policy' => 'privacy policy',
        ],
        'submit' => 'Submit My Complaint',
    ],

    'contact_alternatives' => [
        'title' => 'Alternative Contact Information',
        'telephone' => [
            'title' => 'Phone',
            'number' => '+33 1 48 47 52 13',
            'horaires' => 'Mon-Fri: 9am-6pm',
        ],
        'email' => [
            'title' => 'Email',
            'address' => 'contact@djokprestige.com',
            'delai_reponse' => 'Response within 24h',
        ],
        'adresse' => [
            'title' => 'Address',
            'rue' => '66 Avenue des Champs Élysées',
            'ville' => '75008 Paris, France',
        ],
    ],

    'mediateur' => [
        'title' => 'Consumer Mediator',
        'description' => 'If you are not satisfied with our response, you can refer the matter to the consumer mediator:',
        'nom' => 'Consumer Mediator SMP',
        'url' => 'https://www.mediateur-consommation-smp.fr',
        'acceder' => 'Access',
    ],

    'validation' => [
        'required' => 'This field is required.',
        'email' => 'Please enter a valid email address.',
        'max' => 'The file must not exceed :max MB.',
        'accepted' => 'You must accept the terms.',
    ],

    'success_message' => 'Your complaint has been sent successfully. We will respond as soon as possible.',
    'error_message' => 'An error occurred while sending your complaint. Please try again.',

    'back_to_home' => 'Back to home',
];
