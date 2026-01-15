<?php

return [
    'acheter_elearning' => [
        'title' => 'Comprar :formation | DJOK PRESTIGE',
        'breadcrumb' => [
            'accueil' => 'Inicio',
            'formations' => 'Formaciones',
        ],

        'header' => [
            'type' => 'Formación e-learning',
            'access' => 'Acceso 12 meses',
            'icon' => 'fas fa-graduation-cap',
        ],

        'details' => [
            'title' => 'Detalles de la formación',
            'description' => [
                'title' => 'Descripción',
            ],
            'programme' => [
                'title' => 'Programa',
                'check_icon' => 'fas fa-check',
            ],
            'inclus' => [
                'title' => 'Qué está incluido',
                'check_icon' => 'fas fa-check-circle',
            ],
            'multimedia' => [
                'title' => 'Contenido multimedia',
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
            'title' => 'Proceder a la compra',
            'prix' => [
                'label' => 'IVA incl. • Acceso inmediato después del pago',
                'currency' => '€',
            ],
            'avantages' => [
                'title' => 'Ventajas',
                'items' => [
                    [
                        'text' => 'Acceso 24h/24, 7d/7',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Soporte técnico incluido',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Certificado de formación',
                        'icon' => 'fas fa-check',
                    ],
                    [
                        'text' => 'Acceso ilimitado durante 12 meses',
                        'icon' => 'fas fa-check',
                    ],
                ],
                'icon_color' => 'green',
            ],
            'paiement' => [
                'title' => 'Información de pago',
                'connecte_comme' => 'Conectado como',
                'moyen_paiement' => 'Método de pago',
                'carte_bancaire' => [
                    'label' => 'Tarjeta bancaria',
                    'description' => 'Pago seguro por Stripe',
                    'icon' => 'fas fa-credit-card',
                ],
            ],
            'champs' => [
                'email' => [
                    'label' => 'Email *',
                    'placeholder' => 'su@email.com',
                ],
                'nom' => [
                    'label' => 'Nombre completo *',
                    'placeholder' => 'Su nombre',
                ],
            ],
            'cgv' => [
                'label' => 'Acepto las :cgu y la :rgpd.',
                'cgu' => 'condiciones generales de uso',
                'rgpd' => 'política de privacidad',
            ],
            'bouton_paiement' => [
                'text' => 'Pagar :prix €',
                'icon' => 'fas fa-lock',
                'loading_icon' => 'fas fa-spinner fa-spin',
            ],
            'securite' => [
                'text' => 'Pago 100% seguro • SSL encriptado',
                'icon' => 'fas fa-shield-alt',
                'color' => 'green',
            ],
        ],

        'assistance' => [
            'title' => '¿Necesita ayuda?',
            'telephone' => [
                'label' => '+33 1 76 38 00 17',
                'horaires' => 'Lun-Vie 9h-19h',
                'icon' => 'fas fa-phone-alt',
                'color' => 'yellow',
            ],
            'email' => [
                'label' => 'support@djokprestige.com',
                'delai' => 'Respuesta en 24h',
                'icon' => 'fas fa-envelope',
                'color' => 'yellow',
            ],
        ],

        'retour' => [
            'text' => 'Volver a las formaciones',
            'icon' => 'fas fa-arrow-left',
        ],

        'validation' => [
            'required_fields' => 'Por favor, complete todos los campos obligatorios.',
            'invalid_email' => 'Por favor, introduzca una dirección de email válida.',
            'accept_cgv' => 'Por favor, acepte las condiciones generales.',
            'payment_error' => 'Se ha producido un error. Por favor, inténtelo de nuevo.',
        ],

        'messages' => [
            'success' => '¡Pago realizado con éxito!',
            'processing' => 'Procesando el pago...',
            'redirecting' => 'Redirigiendo al pago seguro...',
        ],
    ],
];
