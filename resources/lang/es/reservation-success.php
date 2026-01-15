<?php

return [
    'title' => 'Reserva exitosa - DJOK PRESTIGE',
    'hero' => [
        'emoji' => '🎉',
        'title' => '¡Reserva exitosa!',
        'subtitle' => 'Su reserva ha sido registrada',
    ],

    'success_message' => [
        'title' => '¡Gracias por su reserva!',
        'items' => [
            'Su reserva ha sido registrada y está pendiente de confirmación.',
            'Recibirá un email de confirmación en unos minutos.',
            'Nuestro equipo procesará su solicitud en un máximo de 24 horas.',
        ],
    ],

    'actions' => [
        'back_to_home' => [
            'text' => 'Volver al inicio',
            'icon' => 'fas fa-home',
        ],
        'create_account' => [
            'text' => 'Crear una cuenta',
            'icon' => 'fas fa-user-plus',
        ],
        'my_reservations' => [
            'text' => 'Mis reservas',
            'icon' => 'fas fa-list',
        ],
    ],

    'next_steps' => [
        'title' => 'Próximos pasos',
        'steps' => [
            [
                'title' => 'Email de confirmación',
                'description' => 'Recibirá un email de confirmación con los detalles de su reserva.',
                'icon' => 'fas fa-envelope',
                'color' => 'blue',
            ],
            [
                'title' => 'Tratamiento de la solicitud',
                'description' => 'Nuestro equipo procesará su solicitud y le contactará si es necesario.',
                'icon' => 'fas fa-user-check',
                'color' => 'green',
            ],
            [
                'title' => 'Preparación',
                'description' => 'Preparamos todo para que su experiencia sea excepcional.',
                'icon' => 'fas fa-concierge-bell',
                'color' => 'yellow',
            ],
        ],
    ],

    'contact_info' => [
        'title' => '¿Necesita ayuda?',
        'description' => 'Nuestro equipo está a su disposición para cualquier pregunta.',
        'items' => [
            [
                'title' => 'Por teléfono',
                'content' => '+33 1 48 47 52 13',
                'icon' => 'fas fa-phone',
                'color' => 'blue',
            ],
            [
                'title' => 'Por email',
                'content' => 'contact@djokprestige.com',
                'icon' => 'fas fa-envelope',
                'color' => 'green',
            ],
            [
                'title' => 'Horarios',
                'content' => 'Lun-Vie: 9h-18h',
                'icon' => 'fas fa-clock',
                'color' => 'purple',
            ],
        ],
    ],
];
