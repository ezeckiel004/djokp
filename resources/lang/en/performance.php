<?php

return [
    'title' => 'Performance Indicators - DJOK PRESTIGE',
    'main_title' => 'PERFORMANCE INDICATORS',
    'subtitle' => 'Transparency and excellence at the heart of our quality approach',

    'engagement_qualite' => [
        'title' => 'Our quality commitment',
        'contents' => [
            'DJOK PRESTIGE, a Qualiopi certified training center, is committed to continuously measuring and improving the quality of its services. The indicators presented below reflect our performance and our commitment to our trainees.',
            'This data is updated quarterly and is subject to rigorous monitoring by our quality team.',
        ]
    ],

    'tableau_performance' => [
        'title' => '2024 Performance Dashboard',
        'headers' => [
            'indicateur' => 'Indicator',
            'resultat_2024' => '2024 Result',
            'evolution_vs_2023' => 'Evolution vs 2023',
            'objectif_2025' => '2025 Objective',
        ],
        'indicateurs' => [
            [
                'nom' => 'Trainees supported',
                'icon' => 'fas fa-users',
                'color' => 'blue',
                'resultat' => '482',
                'evolution' => '+ 28 %',
                'evolution_type' => 'positive',
                'objectif' => '550',
            ],
            [
                'nom' => 'Training courses delivered',
                'icon' => 'fas fa-graduation-cap',
                'color' => 'purple',
                'resultat' => '73',
                'evolution' => '+ 12 %',
                'evolution_type' => 'positive',
                'objectif' => '85',
            ],
            [
                'nom' => 'VTC exam success rate',
                'icon' => 'fas fa-medal',
                'color' => 'green',
                'resultat' => '94 %',
                'evolution' => '+ 3 pts',
                'evolution_type' => 'positive',
                'objectif' => '96 %',
            ],
            [
                'nom' => 'Overall satisfaction rate',
                'icon' => 'fas fa-star',
                'color' => 'yellow',
                'resultat' => '97 %',
                'evolution' => 'stable',
                'evolution_type' => 'stable',
                'objectif' => '98 %',
            ],
            [
                'nom' => 'Dropout rate',
                'icon' => 'fas fa-user-times',
                'color' => 'red',
                'resultat' => '3 %',
                'evolution' => '- 2 pts',
                'evolution_type' => 'negative',
                'objectif' => '2 %',
            ],
            [
                'nom' => 'Return to employment / business creation',
                'icon' => 'fas fa-briefcase',
                'color' => 'indigo',
                'resultat' => '88 %',
                'evolution' => '+ 5 pts',
                'evolution_type' => 'positive',
                'objectif' => '90 %',
            ],
            [
                'nom' => 'Recorded complaints',
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'gray',
                'resultat' => '2 out of 482 (0.4 %)',
                'evolution' => '- 1 case',
                'evolution_type' => 'negative',
                'objectif' => '≤ 1 %',
            ],
            [
                'nom' => 'Average complaint processing time',
                'icon' => 'fas fa-clock',
                'color' => 'teal',
                'resultat' => '2 working days',
                'evolution' => 'stable',
                'evolution_type' => 'stable',
                'objectif' => '2 working days',
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
        'title' => 'Measurement methodology',
        'icon' => 'fas fa-chart-line',
        'items' => [
            'Systematic satisfaction surveys at the end of each training',
            'Individualized monitoring of official exam results',
            'Checkpoint at 6 months post-training to measure professional integration',
            'Quarterly internal quality audit',
        ],
    ],

    'objectifs_qualite' => [
        'title' => 'Our quality objectives',
        'icon' => 'fas fa-bullseye',
        'items' => [
            'Achieve 96% success rate in the VTC exam',
            'Maintain a dropout rate below 2%',
            'Process all complaints in less than 48 hours',
            'Support 550 trainees in 2025',
        ],
    ],

    'certification_qualiopi' => [
        'title' => 'Qualiopi certified center',
        'content' => 'DJOK PRESTIGE has been Qualiopi certified since 2023, guaranteeing the quality of our training processes and our commitment to continuous improvement.',
        'download_link' => 'Download our official certification',
        'download_icon' => 'fas fa-download',
    ],

    'mise_a_jour' => [
        'last_update' => 'Last update:',
        'last_update_date' => 'December 2024',
        'next_update' => 'Next update scheduled:',
        'next_update_date' => 'March 2025',
        'icon' => 'fas fa-info-circle',
    ],

    'back_to_home' => 'Back to home',
];
