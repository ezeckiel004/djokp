<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\FormationMedia;
use Illuminate\Database\Seeder;

class FormationsTestSeeder extends Seeder
{
    public function run(): void
    {
        // Formation présentiel
        $presentiel = Formation::updateOrCreate(
            [
                'slug' => 'formation-theorique-vtc'
            ],
            [
                'title' => 'Formation Théorique VTC',
                'description' => 'Formation présentielle complète pour devenir chauffeur VTC professionnel. Cours théoriques approfondis avec formateurs experts.',
                'price' => 600.00,
                'duree' => '1 semaine',
                'format_affichage' => 'Présentiel',
                'frais_examen' => 'Inclus',
                'location_vehicule' => 'Inclus',
                'type_formation' => 'presentiel',
                'format_type' => 'presentiel',
                'duration_hours' => 40,
                'categorie' => 'vtc_theorique',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
                'program' => [
                    'Réglementation du transport public',
                    'Sécurité routière avancée',
                    'Gestion administrative VTC',
                    'Service client premium'
                ],
                'requirements' => [
                    'Permis B depuis 3 ans minimum',
                    'Casier judiciaire vierge',
                    'Aptitude médicale à la conduite'
                ],
                'included_services' => [
                    'Manuel de formation complet',
                    'Accès plateforme e-learning',
                    'Simulation examen',
                    'Accompagnement administratif'
                ]
            ]
        );

        // Formation e-learning
        $elearning = Formation::updateOrCreate(
            [
                'slug' => 'formation-e-learning-full-option'
            ],
            [
                'title' => 'Formation E-Learning Full Option',
                'description' => 'Formation e-learning complète avec vidéos, PDF et accompagnement personnalisé. Apprenez à votre rythme depuis chez vous.',
                'price' => 1200.00,
                'duree' => 'À votre rythme',
                'format_affichage' => 'En ligne',
                'frais_examen' => 'Inclus',
                'location_vehicule' => 'Inclus',
                'type_formation' => 'e_learning',
                'format_type' => 'en_ligne',
                'duration_hours' => 60,
                'categorie' => 'e_learning',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
                'program' => [
                    'Modules vidéo interactifs',
                    'Exercices pratiques corrigés',
                    'Tutorat en ligne',
                    'Préparation examen final'
                ],
                'requirements' => [
                    'Accès internet',
                    'Ordinateur ou tablette',
                    'Autonomie d\'apprentissage'
                ],
                'included_services' => [
                    'Accès 12 mois à la plateforme',
                    'Support technique 7j/7',
                    'Certificat de formation',
                    'Communauté d\'entraide'
                ]
            ]
        );

        // Ajouter des médias pour la formation e-learning
        if ($elearning) {
            // Supprimer les médias existants pour éviter les doublons
            FormationMedia::where('formation_id', $elearning->id)->delete();

            FormationMedia::create([
                'formation_id' => $elearning->id,
                'type' => 'pdf',
                'title' => 'Manuel de formation VTC',
                'description' => 'Manuel complet de la formation avec tous les chapitres',
                'file_path' => 'formations/manuel-vtc.pdf',
                'file_name' => 'manuel-vtc.pdf',
                'file_size' => '2.5 MB',
                'order' => 1,
                'is_active' => true,
            ]);

            FormationMedia::create([
                'formation_id' => $elearning->id,
                'type' => 'video',
                'title' => 'Introduction à la réglementation VTC',
                'description' => 'Vidéo d\'introduction à la réglementation du métier de VTC',
                'file_path' => 'formations/introduction-reglementation.mp4',
                'file_name' => 'introduction-reglementation.mp4',
                'file_size' => '150 MB',
                'duration' => '25:30',
                'order' => 2,
                'is_active' => true,
            ]);
        }

        // Ajouter quelques formations supplémentaires pour avoir un tableau complet
        $formationsSupp = [
            [
                'slug' => 'formation-pratique-vtc',
                'title' => 'Formation Pratique VTC',
                'description' => 'Formation pratique sur véhicule professionnel',
                'price' => 600.00,
                'duree' => '½ journée',
                'format_affichage' => 'Présentiel',
                'frais_examen' => 'Inclus',
                'location_vehicule' => 'Inclus',
                'type_formation' => 'presentiel',
                'format_type' => 'presentiel',
                'duration_hours' => 4,
                'categorie' => 'vtc_pratique',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
            ],
            [
                'slug' => 'renouvellement-carte-vtc',
                'title' => 'Renouvellement Carte VTC',
                'description' => 'Formation obligatoire pour renouveler sa carte VTC',
                'price' => 160.00,
                'duree' => '14 h',
                'format_affichage' => 'Présentiel',
                'frais_examen' => '-',
                'location_vehicule' => '-',
                'type_formation' => 'presentiel',
                'format_type' => 'presentiel',
                'duration_hours' => 14,
                'categorie' => 'renouvellement',
                'is_certified' => true,
                'is_financeable_cpf' => true,
                'is_active' => true,
            ]
        ];

        foreach ($formationsSupp as $formationData) {
            Formation::updateOrCreate(
                ['slug' => $formationData['slug']],
                $formationData
            );
        }

        $this->command->info('Formations de test créées avec succès !');
        $this->command->info('- 2 formations présentiel');
        $this->command->info('- 1 formation e-learning avec médias');
        $this->command->info('- 1 formation de renouvellement');
    }
}
