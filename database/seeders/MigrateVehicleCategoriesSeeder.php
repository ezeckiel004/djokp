<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\VehicleCategory;
use Illuminate\Database\Seeder;

class MigrateVehicleCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les catégories si elles n'existent pas
        $categories = [
            'eco' => ['display_name' => 'Économique', 'prise_en_charge' => 3.50, 'prix_au_km' => 1.20, 'prix_minimum' => 15.00],
            'business' => ['display_name' => 'Business / Confort', 'prise_en_charge' => 5.00, 'prix_au_km' => 1.80, 'prix_minimum' => 25.00],
            'prestige' => ['display_name' => 'Prestige', 'prise_en_charge' => 8.00, 'prix_au_km' => 2.50, 'prix_minimum' => 40.00],
            'van' => ['display_name' => 'Van / Utilitaire', 'prise_en_charge' => 10.00, 'prix_au_km' => 2.00, 'prix_minimum' => 35.00],
        ];

        $categoryModels = [];
        foreach ($categories as $categorie => $data) {
            $categoryModels[$categorie] = VehicleCategory::firstOrCreate(
                ['categorie' => $categorie],
                array_merge(['categorie' => $categorie], $data)
            );
        }

        // Associer les véhicules existants aux nouvelles catégories
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            $oldCategory = $vehicle->category; // Attention: après la migration, cette colonne n'existe plus

            // Dans un premier temps, gardons l'ancienne colonne pour la migration
            if (isset($categoryModels[$oldCategory])) {
                $vehicle->vehicle_category_id = $categoryModels[$oldCategory]->id;
                $vehicle->save();
            }
        }

        $this->command->info('Catégories de véhicules migrées avec succès !');
    }
}
