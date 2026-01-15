<?php

return [
    'title' => 'In-Person Training Registration',

    'breadcrumb' => [
        'home' => 'Home',
        'trainings' => 'Trainings',
        'registration' => 'Registration',
    ],

    'header' => [
        'title' => 'Training Registration',
        'format' => 'In-person training',
    ],

    'form' => [
        'title' => 'Registration Form',
        'subtitle' => 'Fill out the form below to register for this training',

        'prefilled_info' => 'Pre-filled information',
        'connected_as' => 'You are logged in as',
        'info_prefilled' => 'Some information has been pre-filled for your convenience. You can modify it if necessary.',

        'sections' => [
            'personal_info' => 'Personal Information',
            'address' => 'Address',
            'funding' => 'Funding Method',
            'additional_info' => 'Additional Information',
        ],

        'fields' => [
            'civility' => 'Title',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'birth_date' => 'Date of Birth',
            'license_date' => 'License Date',
            'address' => 'Address',
            'zip_code' => 'Postal Code',
            'city' => 'City',
            'message' => 'Message',
            'optional' => 'optional',
        ],

        'placeholders' => [
            'last_name' => 'Your last name',
            'first_name' => 'Your first name',
            'email' => 'your@email.com',
            'phone' => '+33 1 23 45 67 89',
            'date_format' => 'Format: DD/MM/YYYY',
            'min_age' => 'Minimum age: 16 years',
            'address' => 'Street and number',
            'zip_code' => '75000',
            'city' => 'Paris',
            'message' => 'Specify your expectations, questions, or additional information here...',
            'message_desc' => 'You can specify your availability, specific objectives, or any other useful information.',
        ],

        'options' => [
            'mr' => 'Mr.',
            'mrs' => 'Mrs.',
        ],

        'funding' => [
            'personal' => 'Personal funding',
            'personal_desc' => 'Direct payment by credit card or bank transfer',
            'cpf' => 'CPF (Personal Training Account)',
            'cpf_desc' => 'Use of your DIF training hours',
            'pole_emploi' => 'Pôle Emploi',
            'pole_emploi_desc' => 'Covered by Pôle Emploi (AIF)',
        ],

        'terms' => [
            'accept' => 'I accept the',
            'terms' => 'terms and conditions',
            'and' => 'and the',
            'privacy' => 'privacy policy',
        ],

        'submit' => 'Submit my registration request',
        'confirmation' => 'You will receive a confirmation email within 24 hours.',
    ],

    'summary' => [
        'title' => 'Training Details',
        'training' => 'Training',
        'duration' => 'Duration',
        'format' => 'Format',
        'in_person' => 'In-person',
        'price' => 'Price',
        'quote' => 'On quote',
        'exam_fees' => 'exam fees',
    ],

    'program' => [
        'title' => 'Program',
        'other_modules' => 'other modules',
    ],

    'documents' => [
        'title' => 'Required Documents',
        'id_copy' => 'ID card copy',
        'residence_proof' => 'Proof of residence (< 3 months)',
        'driving_license' => 'Driving license',
        'id_photo' => 'ID photo',
        'send_to' => 'Send documents to:',
    ],

    'contact' => [
        'title' => 'Need help?',
        'phone_hours' => 'Mon-Fri 9am-7pm',
        'email_response' => 'Response within 24h',
    ],

    'messages' => [
        'error' => 'Error',
        'success' => 'Success!',
    ],

    'validation' => [
        'required_fields' => 'Please fill in all required fields.',
        'min_age' => 'You must be at least 16 years old to register.',
        'license_future' => 'License date cannot be in the future.',
    ],

    'back_button' => 'Back to training',
];
