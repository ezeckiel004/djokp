<?php

return [
    'title' => 'Seguimiento solicitud - :reference',
    'page_title' => 'Seguimiento de su solicitud',
    'reference' => 'Referencia',

    'statut' => [
        'title' => 'Estado de su solicitud',
        'labels' => [
            'nouvelle' => 'Nueva',
            'devis_envoye' => 'Presupuesto enviado',
            'confirme' => 'Confirmada',
            'annule' => 'Cancelada',
        ],
        'created_at' => 'Creada el',
    ],

    'informations_personnelles' => [
        'title' => 'Sus informaciones',
        'nom' => 'Nombre',
        'email' => 'Email',
        'telephone' => 'Teléfono',
        'motif' => 'Motivo',
        'motif_labels' => [
            'vacances' => 'Vacaciones',
            'affaires' => 'Negocios',
            'evenement' => 'Evento',
            'autre' => 'Otro',
        ],
    ],

    'details_sejour' => [
        'title' => 'Detalles de la estancia',
        'date_arrivee' => 'Fecha de llegada',
        'duree' => 'Duración',
        'personnes' => 'Personas',
        'accompagnement' => 'Acompañamiento',
        'accompagnement_labels' => [
            'solo' => 'Solo(a)',
            'couple' => 'En pareja',
            'famille' => 'En familia',
            'groupe' => 'En grupo',
        ],
    ],

    'services_demandes' => [
        'title' => 'Servicios solicitados',
        'aucun_service' => 'Ningún servicio especificado',
        'services_list' => [
            'transport' => 'Transporte',
            'reservation_restaurant' => 'Reserva restaurante',
            'guide_touristique' => 'Guía turístico',
            'mise_a_disposition_vehicule' => 'Puesta a disposición vehículo',
            'organisation_soiree' => 'Organización velada',
            'courses' => 'Compras',
            'nettoyage' => 'Limpieza',
            'autres' => 'Otros servicios',
        ],
    ],

    'message' => [
        'title' => 'Su mensaje',
    ],

    'besoin_aide' => [
        'title' => '¿Necesita ayuda?',
        'telephone' => [
            'label' => 'Teléfono',
            'number' => '+33 1 76 38 00 17',
        ],
        'email' => [
            'label' => 'Email',
            'address' => 'conciergerie@djokprestige.com',
        ],
        'horaires' => [
            'label' => 'Horarios',
            'value' => 'Lun-Vie: 9h-19h',
        ],
        'icons' => [
            'telephone' => 'fas fa-phone-alt',
            'email' => 'fas fa-envelope',
            'horaires' => 'fas fa-clock',
        ],
    ],

    'devis' => [
        'title' => 'Presupuesto',
        'envoye_le' => 'Presupuesto enviado el',
        'montant' => 'Importe',
    ],

    'actions' => [
        'telecharger_devis' => 'Descargar presupuesto',
        'confirmer_demande' => 'Confirmar solicitud',
        'annuler_demande' => 'Cancelar solicitud',
        'modifier_demande' => 'Modificar solicitud',
        'retour_accueil' => 'Volver al inicio',
    ],

    'validation' => [
        'confirmation_required' => 'Por favor, confirme su solicitud para continuar.',
        'annulation_confirm' => '¿Está seguro de querer cancelar esta solicitud?',
        'modification_possible' => 'La modificación solo es posible para solicitudes en estado "Nueva".',
    ],

    'timeline' => [
        'title' => 'Historial del tratamiento',
        'etapes' => [
            'creation' => [
                'titre' => 'Solicitud creada',
                'description' => 'Su solicitud ha sido registrada',
                'icon' => 'fas fa-file-alt',
            ],
            'traitement' => [
                'titre' => 'En tratamiento',
                'description' => 'Nuestro equipo analiza su solicitud',
                'icon' => 'fas fa-user-check',
            ],
            'devis' => [
                'titre' => 'Presupuesto enviado',
                'description' => 'Hemos enviado un presupuesto detallado',
                'icon' => 'fas fa-file-invoice-dollar',
            ],
            'confirmation' => [
                'titre' => 'Confirmada',
                'description' => 'Su solicitud está confirmada',
                'icon' => 'fas fa-check-circle',
            ],
            'finalisation' => [
                'titre' => 'Finalización',
                'description' => 'Preparación de servicios',
                'icon' => 'fas fa-concierge-bell',
            ],
        ],
    ],

    'documents' => [
        'title' => 'Documentos asociados',
        'devis' => 'Presupuesto',
        'contrat' => 'Contrato',
        'facture' => 'Factura',
        'telecharger' => 'Descargar',
        'visualiser' => 'Visualizar',
    ],

    'messages' => [
        'success_confirmation' => 'Su solicitud ha sido confirmada con éxito.',
        'success_annulation' => 'Su solicitud ha sido cancelada.',
        'error_statut' => 'Esta acción no es posible con el estado actual.',
    ],
];
