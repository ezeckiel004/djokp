<?php

return [
    'title' => 'Indicadores de Rendimiento - DJOK PRESTIGE',
    'main_title' => 'INDICADORES DE RENDIMIENTO',
    'subtitle' => 'Transparencia y excelencia en el corazón de nuestro enfoque de calidad',

    'engagement_qualite' => [
        'title' => 'Nuestro compromiso de calidad',
        'contents' => [
            'DJOK PRESTIGE, centro de formación certificado Qualiopi, se compromete a medir y mejorar continuamente la calidad de sus prestaciones. Los indicadores presentados a continuación reflejan nuestro rendimiento y nuestro compromiso hacia nuestros aprendices.',
            'Estos datos se actualizan trimestralmente y son objeto de un seguimiento riguroso por nuestro equipo de calidad.',
        ]
    ],

    'tableau_performance' => [
        'title' => 'Tablero de rendimiento 2024',
        'headers' => [
            'indicateur' => 'Indicador',
            'resultat_2024' => 'Resultado 2024',
            'evolution_vs_2023' => 'Evolución vs 2023',
            'objectif_2025' => 'Objetivo 2025',
        ],
        'indicateurs' => [
            [
                'nom' => 'Aprendices acompañados',
                'icon' => 'fas fa-users',
                'color' => 'blue',
                'resultat' => '482',
                'evolution' => '+ 28 %',
                'evolution_type' => 'positive',
                'objectif' => '550',
            ],
            [
                'nom' => 'Formaciones impartidas',
                'icon' => 'fas fa-graduation-cap',
                'color' => 'purple',
                'resultat' => '73',
                'evolution' => '+ 12 %',
                'evolution_type' => 'positive',
                'objectif' => '85',
            ],
            [
                'nom' => 'Tasa de éxito en el examen VTC',
                'icon' => 'fas fa-medal',
                'color' => 'green',
                'resultat' => '94 %',
                'evolution' => '+ 3 pts',
                'evolution_type' => 'positive',
                'objectif' => '96 %',
            ],
            [
                'nom' => 'Tasa de satisfacción global',
                'icon' => 'fas fa-star',
                'color' => 'yellow',
                'resultat' => '97 %',
                'evolution' => 'estable',
                'evolution_type' => 'stable',
                'objectif' => '98 %',
            ],
            [
                'nom' => 'Tasa de abandono',
                'icon' => 'fas fa-user-times',
                'color' => 'red',
                'resultat' => '3 %',
                'evolution' => '- 2 pts',
                'evolution_type' => 'negative',
                'objectif' => '2 %',
            ],
            [
                'nom' => 'Retorno al empleo / creación de empresa',
                'icon' => 'fas fa-briefcase',
                'color' => 'indigo',
                'resultat' => '88 %',
                'evolution' => '+ 5 pts',
                'evolution_type' => 'positive',
                'objectif' => '90 %',
            ],
            [
                'nom' => 'Reclamaciones registradas',
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'gray',
                'resultat' => '2 sobre 482 (0,4 %)',
                'evolution' => '- 1 caso',
                'evolution_type' => 'negative',
                'objectif' => '≤ 1 %',
            ],
            [
                'nom' => 'Tiempo medio de tratamiento de reclamaciones',
                'icon' => 'fas fa-clock',
                'color' => 'teal',
                'resultat' => '2 días laborables',
                'evolution' => 'estable',
                'evolution_type' => 'stable',
                'objectif' => '2 días laborables',
            ],
        ],
        'evolution_labels' => [
            'positive' => [
                'class' => 'text-green-800 bg-green-100',
                'icon' => 'fas fa-arrow-up',
            ],
            'negative' => [
                'class' => 'text-green-800 bg-green-100',
                'icon' => 'fas fa-arrow-down',
            ],
            'stable' => [
                'class' => 'text-blue-800 bg-blue-100',
                'icon' => '',
            ],
        ],
    ],

    'methodologie' => [
        'title' => 'Metodología de medición',
        'icon' => 'fas fa-chart-line',
        'items' => [
            'Encuestas de satisfacción sistemáticas al finalizar cada formación',
            'Seguimiento individualizado de los resultados en los exámenes oficiales',
            'Punto a los 6 meses post-formación para medir la inserción profesional',
            'Auditoría de calidad interna trimestral',
        ],
    ],

    'objectifs_qualite' => [
        'title' => 'Nuestros objetivos de calidad',
        'icon' => 'fas fa-bullseye',
        'items' => [
            'Alcanzar el 96% de tasa de éxito en el examen VTC',
            'Mantener una tasa de abandono inferior al 2%',
            'Tratar todas las reclamaciones en menos de 48 horas',
            'Acompañar a 550 aprendices en 2025',
        ],
    ],

    'certification_qualiopi' => [
        'title' => 'Centro certificado Qualiopi',
        'content' => 'DJOK PRESTIGE está certificado Qualiopi desde 2023, garantizando la calidad de nuestros procesos de formación y nuestro compromiso a favor de la mejora continua.',
        'download_link' => 'Descargar nuestra certificación oficial',
        'download_icon' => 'fas fa-download',
    ],

    'mise_a_jour' => [
        'last_update' => 'Última actualización:',
        'last_update_date' => 'Diciembre 2024',
        'next_update' => 'Próxima actualización prevista:',
        'next_update_date' => 'Marzo 2025',
        'icon' => 'fas fa-info-circle',
    ],

    'back_to_home' => 'Volver al inicio',
];
