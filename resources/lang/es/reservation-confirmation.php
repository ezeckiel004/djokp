<?php

return [
    'title' => 'Confirmación de Reserva - DJOK PRESTIGE',

    'header' => [
        'title' => '¡Solicitud de reserva confirmada!',
        'subtitle' => 'Hemos recibido su solicitud. Se ha enviado un correo de confirmación a :email',
    ],

    'summary' => [
        'title' => 'Resumen de su reserva',
        'vehicle_details' => 'Detalles del vehículo',
        'rental_details' => 'Detalles del alquiler',
        'vehicle' => 'Vehículo:',
        'category' => 'Categoría:',
        'fuel' => 'Combustible:',
        'reference' => 'Referencia:',
        'period' => 'Período:',
        'period_from_to' => 'del :date_debut al :date_fin',
        'duration' => 'Duración:',
        'days' => 'días',
        'estimated_amount' => 'Monto estimado:',
        'vat_included' => 'IVA incluido',
    ],

    'next_steps' => [
        'title' => 'Próximos pasos',
        'steps' => [
            1 => [
                'number' => '1',
                'text' => 'Nuestro equipo verifica la disponibilidad definitiva del vehículo',
            ],
            2 => [
                'number' => '2',
                'text' => 'Recibirá una confirmación definitiva por correo en 24 horas',
            ],
            3 => [
                'number' => '3',
                'text' => 'Un asesor se pondrá en contacto con usted al :telephone para finalizar',
            ],
        ],
    ],

    'actions' => [
        'view_vehicles' => 'Ver otros vehículos',
        'go_home' => 'Volver a la página de inicio',
    ],

    'footer' => [
        'title' => '¿Tiene una pregunta?',
        'contact_phone' => 'Contáctenos al :phone',
        'contact_email' => 'o por correo a :email',
        'reference_note' => 'Referencia a conservar:',
    ],

    'status' => [
        'pending' => 'Pendiente de confirmación',
        'confirmed' => 'Confirmada',
        'cancelled' => 'Cancelada',
    ],

    'dates' => [
        'format' => 'd/m/Y',
        'from' => 'del',
        'to' => 'al',
        'today' => 'Hoy',
        'tomorrow' => 'Mañana',
    ],

    'messages' => [
        'thank_you' => '¡Gracias por su confianza!',
        'processing' => 'Su solicitud está siendo procesada.',
        'contact_soon' => 'Nos pondremos en contacto con usted pronto.',
        'save_reference' => 'Conserve su número de referencia.',
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
