<?php

return [
    'title' => 'Payment Cancelled | DJOK PRESTIGE',
    'header' => [
        'title' => 'Payment Cancelled',
        'subtitle' => 'Your transaction has been interrupted.',
    ],

    'message' => [
        'title' => 'Unsuccessful Transaction',
        'content' => 'Your payment has been cancelled or an error occurred during the process. No charge has been made to your account.',
        'info' => 'If this cancellation was unintentional, you can try again.',
    ],

    'causes' => [
        'title' => 'Possible causes:',
        'items' => [
            'voluntary' => 'Voluntary cancellation during payment process',
            'technical' => 'Temporary technical issue with payment system',
            'card' => 'Incorrect credit card information',
            'timeout' => 'Timeout during input',
        ],
    ],

    'actions' => [
        'retry' => 'Retry payment',
        'back_formations' => 'Back to training',
        'back_home' => 'Back to home',
    ],

    'assistance' => [
        'title' => 'Need help?',
        'content' => 'Our support team is here to help you resolve this issue.',
        'phone' => '01 76 38 00 17',
        'phone_hours' => 'Mon-Fri 9am-7pm',
        'email' => 'support@djokprestige.com',
        'response_time' => 'Response within 24 hours',
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
        'no_charge' => 'No charge made',
        'safe_transaction' => 'Secure transaction cancelled',
        'can_retry' => 'You can try again anytime',
    ],
];
