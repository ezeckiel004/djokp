<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Vérifier si la colonne 'category' existe (sans utiliser Schema::hasColumn)
        $categoryColumnExists = $this->columnExists('vehicles', 'category');

        if ($categoryColumnExists) {
            // 2. Migrer les données de l'ancienne colonne category vers les nouvelles catégories
            $this->migrateCategoryData();

            // 3. Supprimer l'ancienne colonne category
            DB::statement('ALTER TABLE vehicles DROP COLUMN category');
        }

        // 4. Vérifier si vehicle_category_id existe
        $categoryIdColumnExists = $this->columnExists('vehicles', 'vehicle_category_id');

        if (!$categoryIdColumnExists) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->foreignId('vehicle_category_id')->nullable()->after('color');
            });
        }

        // 5. Ajouter la contrainte de clé étrangère si elle n'existe pas
        $this->addForeignKeyIfNotExists();
    }

    public function down(): void
    {
        // Recréer l'ancienne colonne category
        if (!$this->columnExists('vehicles', 'category')) {
            DB::statement("ALTER TABLE vehicles ADD COLUMN category VARCHAR(50) NULL");
        }

        // Mettre à jour les données (approximation)
        $categories = DB::table('vehicle_categories')->get();

        foreach ($categories as $category) {
            DB::table('vehicles')
                ->where('vehicle_category_id', $category->id)
                ->update(['category' => $category->categorie]);
        }

        // Supprimer la contrainte de clé étrangère
        if ($this->columnExists('vehicles', 'vehicle_category_id')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->dropForeign(['vehicle_category_id']);
            });
        }
    }

    /**
     * Vérifie si une colonne existe sans utiliser Schema::hasColumn
     */
    private function columnExists(string $table, string $column): bool
    {
        try {
            $result = DB::select("
                SELECT COUNT(*) as count
                FROM information_schema.columns
                WHERE table_name = ?
                AND column_name = ?
                AND table_schema = DATABASE()
            ", [$table, $column]);

            return $result[0]->count > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Migre les données de l'ancienne colonne category
     */
    private function migrateCategoryData(): void
    {
        // Récupérer toutes les catégories existantes
        $categories = [
            'eco' => ['display_name' => 'Économique', 'prise_en_charge' => 3.50, 'prix_au_km' => 1.20, 'prix_minimum' => 15.00],
            'business' => ['display_name' => 'Business / Confort', 'prise_en_charge' => 5.00, 'prix_au_km' => 1.80, 'prix_minimum' => 25.00],
            'prestige' => ['display_name' => 'Prestige', 'prise_en_charge' => 8.00, 'prix_au_km' => 2.50, 'prix_minimum' => 40.00],
            'van' => ['display_name' => 'Van / Utilitaire', 'prise_en_charge' => 10.00, 'prix_au_km' => 2.00, 'prix_minimum' => 35.00],
        ];

        foreach ($categories as $code => $data) {
            // Trouver ou créer la catégorie
            $category = DB::table('vehicle_categories')
                ->where('categorie', $code)
                ->first();

            if (!$category) {
                $categoryId = DB::table('vehicle_categories')->insertGetId(
                    array_merge(['categorie' => $code], $data, ['actif' => true, 'created_at' => now(), 'updated_at' => now()])
                );
            } else {
                $categoryId = $category->id;
            }

            // Mettre à jour les véhicules de cette catégorie
            DB::table('vehicles')
                ->where('category', $code)
                ->where(function ($query) {
                    $query->whereNull('vehicle_category_id')
                        ->orWhere('vehicle_category_id', 0);
                })
                ->update(['vehicle_category_id' => $categoryId]);
        }
    }

    /**
     * Ajoute la contrainte de clé étrangère si elle n'existe pas
     */
    private function addForeignKeyIfNotExists(): void
    {
        try {
            // Vérifier si la contrainte existe déjà
            $foreignKeys = DB::select("
                SELECT CONSTRAINT_NAME
                FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                WHERE TABLE_SCHEMA = DATABASE()
                AND TABLE_NAME = 'vehicles'
                AND COLUMN_NAME = 'vehicle_category_id'
                AND CONSTRAINT_NAME LIKE '%foreign%'
            ");

            if (empty($foreignKeys)) {
                Schema::table('vehicles', function (Blueprint $table) {
                    $table->foreign('vehicle_category_id')
                        ->references('id')
                        ->on('vehicle_categories')
                        ->onDelete('set null');
                });
            }
        } catch (\Exception $e) {
            // Ignorer l'erreur si la contrainte existe déjà
        }
    }
};
