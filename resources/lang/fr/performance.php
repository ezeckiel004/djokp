<?php

return [
    'title' => 'Indicateurs de Performance - DJOK PRESTIGE',
    'main_title' => 'INDICATEURS DE PERFORMANCE',
    'subtitle' => 'Transparence et excellence au cœur de notre démarche qualité',

    'engagement_qualite' => [
        'title' => 'Notre engagement qualité',
        'contents' => [
            'DJOK PRESTIGE, centre de formation certifié Qualiopi, s\'engage à mesurer et améliorer continuellement la qualité de ses prestations. Les indicateurs présentés ci-dessous reflètent notre performance et notre engagement envers nos stagiaires.',
            'Ces données sont actualisées trimestriellement et font l\'objet d\'un suivi rigoureux par notre équipe qualité.',
        ]
    ],

    'tableau_performance' => [
        'title' => 'Tableau de bord des performances 2024',
        'headers' => [
            'indicateur' => 'Indicateur',
            'resultat_2024' => 'Résultat 2024',
            'evolution_vs_2023' => 'Évolution vs 2023',
            'objectif_2025' => 'Objectif 2025',
        ],
        'indicateurs' => [
            [
                'nom' => 'Stagiaires accompagnés',
                'icon' => 'fas fa-users',
                'color' => 'blue',
                'resultat' => '482',
                'evolution' => '+ 28 %',
                'evolution_type' => 'positive',
                'objectif' => '550',
            ],
            [
                'nom' => 'Formations dispensées',
                'icon' => 'fas fa-graduation-cap',
                'color' => 'purple',
                'resultat' => '73',
                'evolution' => '+ 12 %',
                'evolution_type' => 'positive',
                'objectif' => '85',
            ],
            [
                'nom' => 'Taux de réussite à l\'examen VTC',
                'icon' => 'fas fa-medal',
                'color' => 'green',
                'resultat' => '94 %',
                'evolution' => '+ 3 pts',
                'evolution_type' => 'positive',
                'objectif' => '96 %',
            ],
            [
                'nom' => 'Taux de satisfaction globale',
                'icon' => 'fas fa-star',
                'color' => 'yellow',
                'resultat' => '97 %',
                'evolution' => 'stable',
                'evolution_type' => 'stable',
                'objectif' => '98 %',
            ],
            [
                'nom' => 'Taux d\'abandon',
                'icon' => 'fas fa-user-times',
                'color' => 'red',
                'resultat' => '3 %',
                'evolution' => '- 2 pts',
                'evolution_type' => 'negative',
                'objectif' => '2 %',
            ],
            [
                'nom' => 'Retour à l\'emploi / création d\'entreprise',
                'icon' => 'fas fa-briefcase',
                'color' => 'indigo',
                'resultat' => '88 %',
                'evolution' => '+ 5 pts',
                'evolution_type' => 'positive',
                'objectif' => '90 %',
            ],
            [
                'nom' => 'Réclamations enregistrées',
                'icon' => 'fas fa-exclamation-triangle',
                'color' => 'gray',
                'resultat' => '2 sur 482 (0,4 %)',
                'evolution' => '- 1 cas',
                'evolution_type' => 'negative',
                'objectif' => '≤ 1 %',
            ],
            [
                'nom' => 'Délai moyen de traitement des réclamations',
                'icon' => 'fas fa-clock',
                'color' => 'teal',
                'resultat' => '2 jours ouvrés',
                'evolution' => 'stable',
                'evolution_type' => 'stable',
                'objectif' => '2 jours ouvrés',
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
        'title' => 'Méthodologie de mesure',
        'icon' => 'fas fa-chart-line',
        'items' => [
            'Enquêtes de satisfaction systématiques à l\'issue de chaque formation',
            'Suivi individualisé des résultats aux examens officiels',
            'Point à 6 mois post-formation pour mesurer l\'insertion professionnelle',
            'Audit qualité interne trimestriel',
        ],
    ],

    'objectifs_qualite' => [
        'title' => 'Nos objectifs qualité',
        'icon' => 'fas fa-bullseye',
        'items' => [
            'Atteindre 96% de taux de réussite à l\'examen VTC',
            'Maintenir un taux d\'abandon inférieur à 2%',
            'Traiter toutes les réclamations en moins de 48h',
            'Accompagner 550 stagiaires en 2025',
        ],
    ],

    'certification_qualiopi' => [
        'title' => 'Centre certifié Qualiopi',
        'content' => 'DJOK PRESTIGE est certifié Qualiopi depuis 2023, garantissant la qualité de nos processus de formation et notre engagement en faveur de l\'amélioration continue.',
        'download_link' => 'Télécharger notre certification officielle',
        'download_icon' => 'fas fa-download',
    ],

    'mise_a_jour' => [
        'last_update' => 'Dernière mise à jour :',
        'last_update_date' => 'Décembre 2024',
        'next_update' => 'Prochaine mise à jour prévue :',
        'next_update_date' => 'Mars 2025',
        'icon' => 'fas fa-info-circle',
    ],

    'back_to_home' => 'Retour à l\'accueil',
];
