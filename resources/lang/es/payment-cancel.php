<?php

return [
    'title' => 'Pago Cancelado | DJOK PRESTIGE',
    'header' => [
        'title' => 'Pago Cancelado',
        'subtitle' => 'Su transacción ha sido interrumpida.',
    ],

    'message' => [
        'title' => 'Transacción no exitosa',
        'content' => 'Su pago ha sido cancelado o ocurrió un error durante el proceso. No se ha realizado ningún cargo en su cuenta.',
        'info' => 'Si esta cancelación fue involuntaria, puede intentarlo nuevamente.',
    ],

    'causes' => [
        'title' => 'Posibles causas:',
        'items' => [
            'voluntary' => 'Cancelación voluntaria durante el proceso de pago',
            'technical' => 'Problema técnico temporal con el sistema de pago',
            'card' => 'Información de tarjeta de crédito incorrecta',
            'timeout' => 'Tiempo de espera agotado durante la entrada',
        ],
    ],

    'actions' => [
        'retry' => 'Reintentar pago',
        'back_formations' => 'Volver a formaciones',
        'back_home' => 'Volver al inicio',
    ],

    'assistance' => [
        'title' => '¿Necesita ayuda?',
        'content' => 'Nuestro equipo de soporte está aquí para ayudarle a resolver este problema.',
        'phone' => '01 76 38 00 17',
        'phone_hours' => 'Lun-Vie 9h-19h',
        'email' => 'support@djokprestige.com',
        'response_time' => 'Respuesta en 24 horas',
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
        'no_charge' => 'Ningún cargo realizado',
        'safe_transaction' => 'Transacción segura cancelada',
        'can_retry' => 'Puede intentarlo nuevamente en cualquier momento',
    ],
];
