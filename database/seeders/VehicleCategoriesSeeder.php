<?php

namespace Database\Seeders;

use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;

class VehicleCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'categorie' => 'eco',
                'display_name' => 'Économique',
                'prise_en_charge' => 3.50,
                'prix_au_km' => 1.20,
                'prix_minimum' => 15.00,
                'actif' => true,
            ],
            [
                'categorie' => 'business',
                'display_name' => 'Business / Confort',
                'prise_en_charge' => 5.00,
                'prix_au_km' => 1.80,
                'prix_minimum' => 25.00,
                'actif' => true,
            ],
            [
                'categorie' => 'prestige',
                'display_name' => 'Prestige',
                'prise_en_charge' => 8.00,
                'prix_au_km' => 2.50,
                'prix_minimum' => 40.00,
                'actif' => true,
            ],
            [
                'categorie' => 'van',
                'display_name' => 'Van / Utilitaire',
                'prise_en_charge' => 10.00,
                'prix_au_km' => 2.00,
                'prix_minimum' => 35.00,
                'actif' => true,
            ],
        ];

        foreach ($categories as $category) {
            VehicleCategory::firstOrCreate(
                ['categorie' => $category['categorie']],
                $category
            );
        }

        $this->command->info('Catégories de véhicules créées avec succès !');
    }
}
