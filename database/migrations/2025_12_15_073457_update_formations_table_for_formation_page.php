<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ajouter les nouveaux champs seulement s'ils n'existent pas déjà
        if (!Schema::hasColumn('formations', 'duree')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->string('duree')->after('description')->nullable();
            });
        }

        if (!Schema::hasColumn('formations', 'format_affichage')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->string('format_affichage')->after('format')->nullable();
            });
        }

        if (!Schema::hasColumn('formations', 'frais_examen')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->string('frais_examen')->after('format_affichage')->default('Inclus');
            });
        }

        if (!Schema::hasColumn('formations', 'location_vehicule')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->string('location_vehicule')->after('frais_examen')->default('Inclus');
            });
        }

        // Gérer le renommage de la colonne 'format'
        if (Schema::hasColumn('formations', 'format') && !Schema::hasColumn('formations', 'format_type')) {
            // Ajouter la nouvelle colonne format_type
            Schema::table('formations', function (Blueprint $table) {
                $table->enum('format_type', ['presentiel', 'en_ligne', 'mixte'])->nullable()->after('format_affichage');
            });

            // Copier les données de 'format' vers 'format_type'
            $formations = DB::table('formations')->get();
            foreach ($formations as $formation) {
                DB::table('formations')
                    ->where('id', $formation->id)
                    ->update(['format_type' => $formation->format]);
            }

            // Rendre format_type non nullable après avoir copié les données
            DB::statement('ALTER TABLE formations MODIFY COLUMN format_type ENUM(\'presentiel\', \'en_ligne\', \'mixte\') NOT NULL DEFAULT \'presentiel\'');

            // Supprimer l'ancienne colonne 'format'
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('format');
            });
        }
    }

    public function down(): void
    {
        // Pour le rollback, nous faisons l'inverse

        // Recréer la colonne 'format' si elle n'existe pas
        if (!Schema::hasColumn('formations', 'format') && Schema::hasColumn('formations', 'format_type')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->enum('format', ['presentiel', 'en_ligne', 'mixte'])->nullable()->after('format_type');
            });

            // Copier les données de format_type vers format
            $formations = DB::table('formations')->get();
            foreach ($formations as $formation) {
                DB::table('formations')
                    ->where('id', $formation->id)
                    ->update(['format' => $formation->format_type]);
            }

            // Rendre format non nullable
            DB::statement('ALTER TABLE formations MODIFY COLUMN format ENUM(\'presentiel\', \'en_ligne\', \'mixte\') NOT NULL DEFAULT \'presentiel\'');

            // Supprimer format_type
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('format_type');
            });
        }

        // Supprimer les nouveaux champs s'ils existent
        if (Schema::hasColumn('formations', 'duree')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('duree');
            });
        }

        if (Schema::hasColumn('formations', 'format_affichage')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('format_affichage');
            });
        }

        if (Schema::hasColumn('formations', 'frais_examen')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('frais_examen');
            });
        }

        if (Schema::hasColumn('formations', 'location_vehicule')) {
            Schema::table('formations', function (Blueprint $table) {
                $table->dropColumn('location_vehicule');
            });
        }
    }
};
