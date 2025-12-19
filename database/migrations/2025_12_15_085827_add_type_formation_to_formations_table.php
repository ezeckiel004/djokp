<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            // Ajouter la colonne type_formation si elle n'existe pas
            if (!Schema::hasColumn('formations', 'type_formation')) {
                $table->enum('type_formation', ['presentiel', 'e_learning'])->default('presentiel')->after('location_vehicule');
            }

            // Ajouter les colonnes Stripe si elles n'existent pas
            if (!Schema::hasColumn('formations', 'stripe_product_id')) {
                $table->string('stripe_product_id')->nullable()->after('is_active');
            }

            if (!Schema::hasColumn('formations', 'stripe_price_id')) {
                $table->string('stripe_price_id')->nullable()->after('stripe_product_id');
            }
        });

        // Gérer le renommage de 'type' en 'categorie' pour MariaDB
        if (Schema::hasColumn('formations', 'type') && !Schema::hasColumn('formations', 'categorie')) {
            // Ajouter la nouvelle colonne categorie
            Schema::table('formations', function (Blueprint $table) {
                $table->enum('categorie', ['vtc_theorique', 'vtc_pratique', 'e_learning', 'renouvellement'])->nullable()->after('duration_hours');
            });

            // Copier les données
            $formations = DB::table('formations')->get();
            foreach ($formations as $formation) {
                DB::table('formations')
                    ->where('id', $formation->id)
                    ->update(['categorie' => $formation->type]);
            }

            // Supprimer l'ancienne colonne
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('type');
            });

            // Rendre categorie non nullable
            DB::statement('ALTER TABLE formations MODIFY COLUMN categorie ENUM(\'vtc_theorique\', \'vtc_pratique\', \'e_learning\', \'renouvellement\') NOT NULL DEFAULT \'vtc_theorique\'');
        }
    }

    public function down(): void
    {
        Schema::table('formations', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            if (Schema::hasColumn('formations', 'type_formation')) {
                $table->dropColumn('type_formation');
            }

            if (Schema::hasColumn('formations', 'stripe_product_id')) {
                $table->dropColumn('stripe_product_id');
            }

            if (Schema::hasColumn('formations', 'stripe_price_id')) {
                $table->dropColumn('stripe_price_id');
            }

            // Gérer le rollback de categorie vers type
            if (Schema::hasColumn('formations', 'categorie') && !Schema::hasColumn('formations', 'type')) {
                // Ajouter la colonne type
                $table->enum('type', ['vtc_theorique', 'vtc_pratique', 'e_learning', 'renouvellement'])->nullable()->after('duration_hours');

                // Copier les données
                $formations = DB::table('formations')->get();
                foreach ($formations as $formation) {
                    DB::table('formations')
                        ->where('id', $formation->id)
                        ->update(['type' => $formation->categorie]);
                }

                // Supprimer categorie
                $table->dropColumn('categorie');

                // Rendre type non nullable
                DB::statement('ALTER TABLE formations MODIFY COLUMN type ENUM(\'vtc_theorique\', \'vtc_pratique\', \'e_learning\', \'renouvellement\') NOT NULL DEFAULT \'vtc_theorique\'');
            }
        });
    }
};
