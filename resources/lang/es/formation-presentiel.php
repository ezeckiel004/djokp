<?php

return [
    'inscrire_presentiel' => [
        'title' => 'Inscripción :formation - Presencial | DJOK PRESTIGE',
        'breadcrumb' => [
            'accueil' => 'Inicio',
            'formations' => 'Formaciones',
        ],

        'header' => [
            'type' => 'Formación presencial',
            'date' => 'Fecha',
            'duree' => 'Duración',
            'lieu' => 'Lugar',
            'places_restantes' => 'plazas restantes',
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
            'objectifs' => [
                'title' => 'Objetivos pedagógicos',
            ],
            'public' => [
                'title' => 'Público objetivo',
            ],
            'prerequis' => [
                'title' => 'Prerrequisitos',
            ],
            'equipement' => [
                'title' => 'Equipamiento proporcionado',
                'check_icon' => 'fas fa-check-circle',
            ],
        ],

        'inscription' => [
            'title' => 'Inscripción',
            'prix' => [
                'label' => 'IVA incl.',
                'currency' => '€',
                'options' => [
                    'formation_complete' => 'Formación completa',
                    'reinscription' => 'Reinscripción',
                    'autre' => 'Otra opción',
                ],
            ],
            'informations_personnelles' => [
                'title' => 'Sus informaciones personales',
                'champs' => [
                    'civilite' => [
                        'label' => 'Título *',
                        'options' => [
                            'monsieur' => 'Señor',
                            'madame' => 'Señora',
                            'mademoiselle' => 'Señorita',
                        ],
                    ],
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
                        'label' => 'Teléfono *',
                        'placeholder' => '+33 1 23 45 67 89',
                    ],
                    'date_naissance' => [
                        'label' => 'Fecha de nacimiento *',
                        'placeholder' => 'DD/MM/AAAA',
                    ],
                    'adresse' => [
                        'label' => 'Dirección',
                        'placeholder' => 'Su dirección',
                    ],
                    'code_postal' => [
                        'label' => 'Código postal',
                        'placeholder' => '75000',
                    ],
                    'ville' => [
                        'label' => 'Ciudad',
                        'placeholder' => 'Su ciudad',
                    ],
                    'pays' => [
                        'label' => 'País',
                        'placeholder' => 'Francia',
                    ],
                ],
            ],
            'statut_professionnel' => [
                'title' => 'Situación profesional',
                'options' => [
                    'salarie' => 'Asalariado(a)',
                    'demandeur_emploi' => 'Demandante de empleo',
                    'independant' => 'Independiente',
                    'etudiant' => 'Estudiante',
                    'autre' => 'Otro',
                ],
            ],
            'entreprise' => [
                'title' => 'Empresa',
                'champs' => [
                    'nom_entreprise' => 'Nombre de la empresa',
                    'siret' => 'N° SIRET',
                    'adresse_entreprise' => 'Dirección de la empresa',
                    'contact_rh' => 'Contacto RRHH',
                ],
            ],
            'financement' => [
                'title' => 'Modo de financiación',
                'options' => [
                    'personnel' => 'Financiación personal',
                    'employeur' => 'Financiación empleador',
                    'pole_emploi' => 'Servicio de empleo',
                    'cif' => 'CIF (Cuenta Individual de Formación)',
                    'cpf' => 'CPF (Cuenta Personal de Formación)',
                ],
            ],
            'documents' => [
                'title' => 'Documentos a proporcionar',
                'liste' => [
                    'piece_identite' => 'Copia del documento de identidad (anverso/reverso)',
                    'justificatif_domicile' => 'Justificante de domicilio de menos de 3 meses',
                    'photo_identite' => 'Foto de identidad',
                    'cv' => 'Curriculum Vitae',
                    'diplome' => 'Copia del último diploma',
                ],
            ],
            'cgv' => [
                'label' => 'Acepto las :cgu y la :rgpd.',
                'cgu' => 'condiciones generales de uso',
                'rgpd' => 'política de privacidad',
            ],
            'bouton_inscription' => [
                'text' => 'Inscribirse ahora',
                'icon' => 'fas fa-user-plus',
                'loading_icon' => 'fas fa-spinner fa-spin',
            ],
        ],

        'lieu' => [
            'title' => 'Lugar de la formación',
            'adresse' => 'Dirección',
            'salle' => 'Sala',
            'equipements' => [
                'title' => 'Equipamiento disponible',
                'items' => [
                    'ordinateurs' => 'Ordenadores disponibles',
                    'videoprojecteur' => 'Videoproyector',
                    'wifi' => 'Wi-Fi gratuito',
                    'parking' => 'Parking gratuito',
                    'cafeteria' => 'Cafetería',
                ],
            ],
        ],

        'contact' => [
            'title' => 'Contacto',
            'telephone' => [
                'label' => '+33 1 76 38 00 17',
                'horaires' => 'Lun-Vie 9h-19h',
                'icon' => 'fas fa-phone-alt',
                'color' => 'blue',
            ],
            'email' => [
                'label' => 'formations@djokprestige.com',
                'delai' => 'Respuesta en 24h',
                'icon' => 'fas fa-envelope',
                'color' => 'green',
            ],
            'adresse' => [
                'label' => '66 Avenue des Champs Élysées',
                'ville' => '75008 París',
                'icon' => 'fas fa-map-marker-alt',
                'color' => 'red',
            ],
        ],

        'retour' => [
            'text' => 'Volver a las formaciones',
            'icon' => 'fas fa-arrow-left',
        ],

        'validation' => [
            'required_fields' => 'Por favor, complete todos los campos obligatorios (*).',
            'invalid_email' => 'Por favor, introduzca una dirección de email válida.',
            'invalid_telephone' => 'Por favor, introduzca un número de teléfono válido.',
            'invalid_date' => 'Por favor, introduzca una fecha válida (DD/MM/AAAA).',
            'accept_cgv' => 'Por favor, acepte las condiciones generales.',
            'inscription_error' => 'Se ha producido un error. Por favor, inténtelo de nuevo.',
            'places_epuisees' => 'Lo sentimos, no hay más plazas disponibles para esta sesión.',
        ],

        'messages' => [
            'success' => '¡Su inscripción ha sido registrada con éxito!',
            'confirmation' => 'Se le ha enviado un email de confirmación.',
            'processing' => 'Procesando su inscripción...',
        ],

        'confirmation' => [
            'title' => 'Próximos pasos',
            'steps' => [
                'email' => 'Recibirá un email de confirmación',
                'documents' => 'Envíe sus documentos por email',
                'paiement' => 'Realice el pago',
                'finalisation' => 'Finalización de la inscripción',
            ],
        ],
    ],
];
