<?php

return [
    'title' => 'Formulario de Reclamación - DJOK PRESTIGE',
    'main_title' => 'Formulario de Reclamación',
    'subtitle' => '¿Desea realizar una reclamación o formular una sugerencia? Complete el formulario a continuación.',

    'informations_importantes' => [
        'title' => 'Información importante',
        'items' => [
            'Procesamos todas las reclamaciones en un plazo máximo de 2 días laborables',
            'Para reclamaciones complejas, le mantendremos informado del avance',
            'Recibirá un acuse de recibo por email en las 24 horas',
        ],
    ],

    'formulaire' => [
        'informations_personnelles' => 'Información personal',
        'champs' => [
            'nom' => [
                'label' => 'Apellido *',
                'placeholder' => 'Su apellido',
            ],
            'prenom' => [
                'label' => 'Nombre *',
                'placeholder' => 'Su nombre',
            ],
            'email' => [
                'label' => 'Email *',
                'placeholder' => 'su@email.com',
            ],
            'telephone' => [
                'label' => 'Teléfono',
                'placeholder' => '+33 1 23 45 67 89',
            ],
            'type_reclamation' => [
                'label' => 'Tipo de solicitud *',
                'placeholder' => 'Seleccione el tipo de solicitud',
                'options' => [
                    '' => 'Seleccione el tipo de solicitud',
                    'reclamation' => 'Reclamación',
                    'suggestion' => 'Sugerencia',
                    'question' => 'Pregunta',
                    'probleme_technique' => 'Problema técnico',
                    'autre' => 'Otro',
                ],
            ],
            'service_concerne' => [
                'label' => 'Servicio concernido *',
                'placeholder' => 'Seleccione el servicio concernido',
                'options' => [
                    '' => 'Seleccione el servicio concernido',
                    'formation_vtc' => 'Formación VTC',
                    'location_vehicules' => 'Alquiler de vehículos',
                    'service_vtc' => 'Servicio VTC & Transporte',
                    'conciergerie' => 'Conserjería',
                    'formation_international' => 'Formación Internacional',
                    'autre' => 'Otro',
                ],
            ],
            'sujet' => [
                'label' => 'Asunto *',
                'placeholder' => 'Asunto de su mensaje',
            ],
            'message' => [
                'label' => 'Mensaje detallado *',
                'placeholder' => 'Describa su reclamación o sugerencia en detalle...',
            ],
            'pieces_jointes' => [
                'label' => 'Documentos adjuntos (opcional)',
                'info' => 'Formatos aceptados: PDF, JPG, PNG, DOC. Tamaño máximo: 5MB por archivo',
            ],
        ],
        'consentement' => [
            'label' => 'Acepto que mis datos personales sean tratados en el marco del tratamiento de mi reclamación, conforme a la :privacy_policy de DJOK PRESTIGE.',
            'privacy_policy' => 'política de privacidad',
        ],
        'submit' => 'Enviar mi reclamación',
    ],

    'contact_alternatives' => [
        'title' => 'Información de contacto alternativa',
        'telephone' => [
            'title' => 'Teléfono',
            'number' => '+33 1 48 47 52 13',
            'horaires' => 'Lun-Vie: 9h-18h',
        ],
        'email' => [
            'title' => 'Email',
            'address' => 'contact@djokprestige.com',
            'delai_reponse' => 'Respuesta en 24h',
        ],
        'adresse' => [
            'title' => 'Dirección',
            'rue' => '66 Avenue des Champs Élysées',
            'ville' => '75008 París, Francia',
        ],
    ],

    'mediateur' => [
        'title' => 'Mediador del consumo',
        'description' => 'Si no está satisfecho con nuestra respuesta, puede recurrir al mediador del consumo:',
        'nom' => 'Mediador del consumo SMP',
        'url' => 'https://www.mediateur-consommation-smp.fr',
        'acceder' => 'Acceder',
    ],

    'validation' => [
        'required' => 'Este campo es obligatorio.',
        'email' => 'Por favor, introduzca una dirección de email válida.',
        'max' => 'El archivo no debe superar :max MB.',
        'accepted' => 'Debe aceptar las condiciones.',
    ],

    'success_message' => 'Su reclamación ha sido enviada con éxito. Le responderemos lo antes posible.',
    'error_message' => 'Se ha producido un error al enviar su reclamación. Por favor, inténtelo de nuevo.',

    'back_to_home' => 'Volver al inicio',
];
