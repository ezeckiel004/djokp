<?php

return [
    'title' => 'Inscripción Formación Presencial',

    'breadcrumb' => [
        'home' => 'Inicio',
        'trainings' => 'Formaciones',
        'registration' => 'Inscripción',
    ],

    'header' => [
        'title' => 'Inscripción a la formación',
        'format' => 'Formación presencial',
    ],

    'form' => [
        'title' => 'Formulario de inscripción',
        'subtitle' => 'Complete el formulario a continuación para inscribirse en esta formación',

        'prefilled_info' => 'Información pre-llenada',
        'connected_as' => 'Está conectado como',
        'info_prefilled' => 'Alguna información ha sido pre-llenada para su conveniencia. Puede modificarla si es necesario.',

        'sections' => [
            'personal_info' => 'Información Personal',
            'address' => 'Dirección',
            'funding' => 'Método de Financiación',
            'additional_info' => 'Información Adicional',
        ],

        'fields' => [
            'civility' => 'Título',
            'last_name' => 'Apellido',
            'first_name' => 'Nombre',
            'email' => 'Correo Electrónico',
            'phone' => 'Teléfono',
            'birth_date' => 'Fecha de Nacimiento',
            'license_date' => 'Fecha del Permiso',
            'address' => 'Dirección',
            'zip_code' => 'Código Postal',
            'city' => 'Ciudad',
            'message' => 'Mensaje',
            'optional' => 'opcional',
        ],

        'placeholders' => [
            'last_name' => 'Su apellido',
            'first_name' => 'Su nombre',
            'email' => 'su@email.com',
            'phone' => '+33 1 23 45 67 89',
            'date_format' => 'Formato: DD/MM/AAAA',
            'min_age' => 'Edad mínima: 16 años',
            'address' => 'Número y calle',
            'zip_code' => '75000',
            'city' => 'París',
            'message' => 'Especifique aquí sus expectativas, preguntas o información adicional...',
            'message_desc' => 'Puede especificar su disponibilidad, objetivos específicos o cualquier otra información útil.',
        ],

        'options' => [
            'mr' => 'Señor',
            'mrs' => 'Señora',
        ],

        'funding' => [
            'personal' => 'Financiación personal',
            'personal_desc' => 'Pago directo con tarjeta bancaria o transferencia',
            'cpf' => 'CPF (Cuenta Personal de Formación)',
            'cpf_desc' => 'Uso de sus horas de formación DIF',
            'pole_emploi' => 'Pôle Emploi',
            'pole_emploi_desc' => 'Cubierto por Pôle Emploi (AIF)',
        ],

        'terms' => [
            'accept' => 'Acepto los',
            'terms' => 'términos y condiciones',
            'and' => 'y la',
            'privacy' => 'política de privacidad',
        ],

        'submit' => 'Enviar mi solicitud de inscripción',
        'confirmation' => 'Recibirá un correo de confirmación en 24 horas.',
    ],

    'summary' => [
        'title' => 'Detalles de la Formación',
        'training' => 'Formación',
        'duration' => 'Duración',
        'format' => 'Formato',
        'in_person' => 'Presencial',
        'price' => 'Precio',
        'quote' => 'Sobre presupuesto',
        'exam_fees' => 'de tasas de examen',
    ],

    'program' => [
        'title' => 'Programa',
        'other_modules' => 'otros módulos',
    ],

    'documents' => [
        'title' => 'Documentos Requeridos',
        'id_copy' => 'Copia del documento de identidad',
        'residence_proof' => 'Justificante de domicilio (< 3 meses)',
        'driving_license' => 'Permiso de conducir',
        'id_photo' => 'Foto de identidad',
        'send_to' => 'Enviar documentos a:',
    ],

    'contact' => [
        'title' => '¿Necesita ayuda?',
        'phone_hours' => 'Lun-Vie 9h-19h',
        'email_response' => 'Respuesta en 24h',
    ],

    'messages' => [
        'error' => 'Error',
        'success' => '¡Éxito!',
    ],

    'validation' => [
        'required_fields' => 'Por favor, complete todos los campos obligatorios.',
        'min_age' => 'Debe tener al menos 16 años para registrarse.',
        'license_future' => 'La fecha del permiso no puede ser futura.',
    ],

    'back_button' => 'Volver a la formación',
];
