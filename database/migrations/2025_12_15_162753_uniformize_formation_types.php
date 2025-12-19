<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Étape 1: S'assurer que la colonne type_formation existe et peut contenir 'mixte'
        if (Schema::hasColumn('formations', 'type_formation')) {
            // Mettre à jour l'enum pour inclure 'mixte' et 'en_ligne' (au lieu de 'e_learning')
            DB::statement("ALTER TABLE formations MODIFY COLUMN type_formation ENUM('presentiel', 'e_learning', 'en_ligne', 'mixte') DEFAULT 'presentiel'");

            // Mettre à jour les valeurs 'e_learning' en 'en_ligne' pour cohérence
            DB::table('formations')
                ->where('type_formation', 'e_learning')
                ->update(['type_formation' => 'en_ligne']);
        } else {
            // Créer la colonne si elle n'existe pas
            Schema::table('formations', function (Blueprint $table) {
                $table->enum('type_formation', ['presentiel', 'en_ligne', 'mixte'])
                    ->default('presentiel')
                    ->after('title');
            });
        }

        // Étape 2: Si format_type existe, copier ses valeurs dans type_formation
        if (Schema::hasColumn('formations', 'format_type')) {
            $formations = DB::table('formations')->get();
            foreach ($formations as $formation) {
                DB::table('formations')
                    ->where('id', $formation->id)
                    ->update(['type_formation' => $formation->format_type]);
            }
        }
    }

    public function down(): void
    {
        // Pour le rollback, on laisse type_formation tel quel
        // Pas besoin de rollback car nous voulons garder cette structure
    }
};
