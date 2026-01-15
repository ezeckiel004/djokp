<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            // 1. Renommer formation_id en service_id (plus générique)
            $table->renameColumn('formation_id', 'service_id');

            // 2. Ajouter un champ pour spécifier le type de service
            $table->string('service_type')->default('formation');

            // 3. Ajouter des champs pour les services liés
            $table->foreignId('reservation_id')->nullable()->after('user_id');
            $table->foreignId('location_id')->nullable()->after('reservation_id');
            $table->foreignId('conciergerie_id')->nullable()->after('location_id');
            $table->foreignId('formation_internationale_id')->nullable()->after('conciergerie_id');

            // 4. Ajouter des infos spécifiques au service
            $table->json('service_details')->nullable()->after('customer_info');

            // 5. Ajouter un index pour les recherches par service
            $table->index(['service_type', 'service_id']);
        });

        // Mettre à jour les enregistrements existants
        DB::statement("UPDATE paiements SET service_type = 'formation'");
    }

    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            // 1. Renommer service_id en formation_id
            $table->renameColumn('service_id', 'formation_id');

            // 2. Supprimer les nouveaux champs
            $table->dropColumn('service_type');
            $table->dropColumn('reservation_id');
            $table->dropColumn('location_id');
            $table->dropColumn('conciergerie_id');
            $table->dropColumn('formation_internationale_id');
            $table->dropColumn('service_details');

            // 3. Supprimer l'index
            $table->dropIndex(['service_type', 'service_id']);
        });
    }
};
