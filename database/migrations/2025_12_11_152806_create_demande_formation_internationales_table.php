<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_demande_formation_internationales_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('demande_formation_internationales', function (Blueprint $table) {
            $table->id();

            // Relation avec la table formations
            $table->foreignId('formation_id')->nullable()->constrained('formations')->onDelete('set null');

            // Informations personnelles
            $table->string('nom_complet');
            $table->string('nationalite');
            $table->string('email');
            $table->string('telephone');
            $table->string('whatsapp')->nullable();

            // Si formation personnalisée
            $table->string('formation_personnalisee')->nullable();

            // Message
            $table->text('message');

            // Services (stockés en JSON)
            $table->json('services')->nullable();

            // Dates
            $table->date('date_debut')->nullable();
            $table->string('duree')->nullable();

            // Statut
            $table->enum('statut', [
                'nouveau',
                'en_cours',
                'traite',
                'annule'
            ])->default('nouveau');

            $table->text('notes_admin')->nullable();
            $table->timestamps();

            // Index
            $table->index('statut');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('demande_formation_internationales');
    }
};
