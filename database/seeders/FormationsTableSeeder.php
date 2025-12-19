<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Seeder;

class FormationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $formations = [
            [
                'title' => 'Formation Théorique VTC',
                'slug' => 'formation-theorique-vtc',
                'description' => 'Formation complète pour la partie théorique de l\'examen VTC. Couvre la réglementation, la sécurité routière, la gestion d\'entreprise, et toutes les connaissances nécessaires pour réussir l\'examen théorique.',
                'price' => 600.00,
                'duree' => '1 semaine',
                'format_affichage' => 'Présentiel',
                'frais_examen' => 'Inclus',
                'location_vehicule' => 'Inclus',
                'format_type' => 'presentiel',
                'duration_hours' => 40,
                'type' => 'vtc_theorique',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
                'program' => [
                    'Module 1 : Réglementation du transport public',
                    'Module 2 : Sécurité routière',
                    'Module 3 : Gestion d\'entreprise',
                    'Module 4 : Développement commercial',
                    'Module 5 : Langues française et anglaise'
                ],
                'requirements' => [
                    'Permis B depuis au moins 3 ans',
                    'Casier judiciaire vierge',
                    'Aptitude médicale à la conduite',
                    'Niveau de français correct'
                ],
                'included_services' => [
                    'Manuel de formation complet',
                    'Accès à la plateforme e-learning',
                    'Frais d\'inscription à l\'examen inclus',
                    'Support pédagogique'
                ]
            ],
            [
                'title' => 'Formation Pratique VTC',
                'slug' => 'formation-pratique-vtc',
                'description' => 'Formation pratique pour la conduite VTC professionnelle. Mise en situation réelle avec formateur expert.',
                'price' => 600.00,
                'duree' => '½ journée',
                'format_affichage' => 'Présentiel',
                'frais_examen' => 'Inclus',
                'location_vehicule' => 'Inclus',
                'format_type' => 'presentiel',
                'duration_hours' => 4,
                'type' => 'vtc_pratique',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
                'program' => [
                    'Préparation du véhicule VTC',
                    'Accueil client professionnel',
                    'Conduite sécuritaire et écologique',
                    'Gestion des imprévus',
                    'Communication client'
                ],
                'requirements' => [
                    'Avoir validé la partie théorique',
                    'Permis B depuis au moins 3 ans',
                    'Véhicule adapté ou location incluse'
                ],
                'included_services' => [
                    'Véhicule professionnel fourni',
                    'Formateur expert VTC',
                    'Évaluation pratique',
                    'Certificat de formation'
                ]
            ],
            [
                'title' => 'Formation E-Learning Full Option',
                'slug' => 'formation-e-learning-full-option',
                'description' => 'Formation complète en ligne avec modules interactifs, accessible à distance avec accompagnement personnalisé.',
                'price' => 1200.00,
                'duree' => 'À votre rythme',
                'format_affichage' => 'En ligne + Présentiel',
                'frais_examen' => 'Inclus',
                'location_vehicule' => 'Inclus',
                'format_type' => 'mixte',
                'duration_hours' => 60,
                'type' => 'e_learning',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
                'program' => [
                    'Modules vidéo interactifs',
                    'Quiz et exercices corrigés',
                    'Tutorat en ligne',
                    'Formation pratique en présentiel',
                    'Préparation à l\'examen'
                ],
                'requirements' => [
                    'Accès à un ordinateur et internet',
                    'Permis B depuis au moins 3 ans',
                    'Autonomie dans l\'apprentissage'
                ],
                'included_services' => [
                    'Accès illimité 12 mois à la plateforme',
                    'Support technique et pédagogique',
                    'Formation pratique incluse',
                    'Frais d\'examen inclus'
                ]
            ],
            [
                'title' => 'Renouvellement Carte VTC',
                'slug' => 'renouvellement-carte-vtc',
                'description' => 'Formation obligatoire pour le renouvellement de la carte VTC tous les 5 ans. Mise à jour des réglementations.',
                'price' => 160.00,
                'duree' => '14 h',
                'format_affichage' => 'Présentiel',
                'frais_examen' => '-',
                'location_vehicule' => '-',
                'format_type' => 'presentiel',
                'duration_hours' => 14,
                'type' => 'renouvellement',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
                'program' => [
                    'Actualisation réglementaire',
                    'Nouvelles technologies VTC',
                    'Sécurité routière mise à jour',
                    'Développement durable et mobilité'
                ],
                'requirements' => [
                    'Carte VTC à renouveler',
                    'Permis B valide',
                    'Exercice de l\'activité VTC'
                ],
                'included_services' => [
                    'Attestation de formation',
                    'Mise à jour documentation',
                    'Support administratif pour le renouvellement'
                ]
            ]
        ];

        foreach ($formations as $formationData) {
            Formation::create($formationData);
        }
    }
}
