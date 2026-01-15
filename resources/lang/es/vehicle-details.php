<?php

return [
    'title' => ':vehicle_name - DJOK PRESTIGE Alquiler',

    'alerts' => [
        'success' => [
            'title' => '¡Reserva enviada con éxito!',
            'timeout' => 8000,
        ],
        'error' => [
            'title' => 'Error',
        ],
    ],

    'hero' => [
        'availability' => 'Disponibilidad',
        'category' => 'Categoría',
        'reserve_now' => 'Reservar ahora',
        'call_us' => 'Llamarnos',
        'back_to_vehicles' => 'Volver a vehículos',
    ],

    'sections' => [
        'gallery' => 'Galería',
        'description' => 'Descripción',
        'specs' => 'Ficha técnica',
        'features' => 'Equipamiento y opciones',
        'pricing' => 'Precios de alquiler',
        'booking_form' => 'Reservar :vehicle_name',
        'similar_vehicles' => 'Vehículos similares',
        'faq' => 'Preguntas frecuentes',
        'cta' => '¿Listo para reservar :vehicle_name ?',
    ],

    'specs' => [
        'brand' => 'Marca',
        'model' => 'Modelo',
        'year' => 'Año',
        'color' => 'Color',
        'fuel_type' => 'Tipo de combustible',
        'seats' => 'Número de asientos',
        'seats_unit' => 'asientos',
        'registration' => 'Matrícula',
        'category' => 'Categoría',
    ],

    'features' => [
        'default' => [
            'air_conditioning' => 'Aire acondicionado',
            'gps' => 'GPS',
            'bluetooth' => 'Bluetooth',
            'rear_camera' => 'Cámara trasera',
        ],
        'included' => 'Incluido:',
    ],

    'pricing' => [
        'daily' => [
            'title' => 'Alquiler diario',
            'min_days' => 'Mínimo 1 día',
            'unit' => 'IVA incluido / día',
        ],
        'weekly' => [
            'title' => 'Alquiler semanal',
            'min_days' => 'Mínimo 7 días',
            'unit' => 'IVA incluido / semana',
        ],
        'monthly' => [
            'title' => 'Alquiler mensual',
            'min_days' => 'Mínimo 30 días',
            'unit' => 'IVA incluido / mes',
        ],
        'included' => [
            'title' => 'Incluido en todas nuestras tarifas:',
            'description' => 'Seguro a todo riesgo, mantenimiento, asistencia 24/7',
        ],
    ],

    'booking' => [
        'cta' => 'Reservar este vehículo',
        'security_note' => 'Reserva 100% segura • Sin compromiso',
        'form_description' => 'Complete el formulario a continuación para reservar este vehículo. Nuestro equipo se pondrá en contacto con usted lo antes posible.',

        'fields' => [
            'full_name' => 'Nombre completo *',
            'email' => 'Email *',
            'phone' => 'Teléfono *',
            'selected_vehicle' => 'Vehículo seleccionado *',
            'vehicle_hint' => 'Está reservando este vehículo',
            'start_date' => 'Fecha de inicio del alquiler *',
            'start_hint' => 'La fecha mínima es hoy',
            'end_date' => 'Fecha de fin del alquiler *',
            'end_hint' => 'La fecha debe ser posterior a la fecha de inicio',
            'message' => 'Mensaje (opcional)',
            'message_placeholder' => 'Información adicional, preguntas...',
            'terms' => [
                'label' => 'Acepto los :cgv_link y he leído la :privacy_link.',
                'cgv' => 'condiciones generales de alquiler',
                'privacy' => 'política de privacidad',
            ],
        ],

        'availability_check' => [
            'checking' => 'Verificando disponibilidad...',
            'available' => 'Disponible',
            'not_available' => 'No disponible',
            'error' => 'Error al verificar disponibilidad. Por favor, intente nuevamente.',
        ],

        'price_estimation' => [
            'title' => 'Estimación de precio:',
            'duration' => 'Duración:',
            'rate_type' => 'Tipo de tarifa:',
            'estimated_amount' => 'Monto estimado:',
            'note' => 'Precio indicativo IVA incluido',
            'days' => 'días',
        ],

        'submit' => [
            'button' => 'Enviar mi solicitud de reserva',
            'security_note' => 'Sus datos están seguros',
        ],
    ],

    'similar_vehicles' => [
        'description' => 'Descubra otros vehículos de la misma categoría que puedan interesarle.',
        'view_details' => 'Ver detalles',
        'per_day' => '/día',
    ],

    'faq' => [
        'title' => 'Todo lo que necesita saber sobre el alquiler de este vehículo.',
        'items' => [
            'documents' => [
                'question' => '¿Qué documentos son necesarios para el alquiler?',
                'answer' => 'Para alquilar este vehículo, necesitará: su documento de identidad válido, licencia de conducir B desde hace más de 3 años, comprobante de domicilio de menos de 3 meses, y para alquileres profesionales, su tarjeta VTC.',
            ],
            'insurance' => [
                'question' => '¿El seguro está incluido?',
                'answer' => 'Sí, todos nuestros alquileres incluyen seguro a todo riesgo con franquicia reducida. El seguro de conductor adicional también está disponible como opción.',
            ],
            'modification' => [
                'question' => '¿Puedo modificar o cancelar mi reserva?',
                'answer' => 'Puede modificar su reserva hasta 48 horas antes del inicio del alquiler. Las cancelaciones son posibles con condiciones variables según el plazo.',
            ],
            'mileage' => [
                'question' => '¿Hay un kilometraje máximo?',
                'answer' => 'Para alquileres de corta duración, se incluye un paquete de kilometraje. Para alquileres de larga duración, el kilometraje es ilimitado para vehículos VTC.',
            ],
        ],
    ],

    'cta' => [
        'description' => 'Contáctenos directamente para cualquier pregunta o para reservar este vehículo por teléfono.',
        'phone' => '01 76 38 00 17',
        'email' => 'location@djokprestige.com',
    ],

    'messages' => [
        'date_error' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
        'scroll_to_form' => 'Desplácese al formulario',
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
