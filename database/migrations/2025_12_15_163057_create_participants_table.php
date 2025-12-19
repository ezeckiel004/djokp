<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();

            // Référence à la formation
            $table->foreignId('formation_id')
                ->constrained()
                ->onDelete('cascade');

            // Référence à l'utilisateur (optionnel - pour ceux qui ont un compte)
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            // Référence au paiement (optionnel)
            $table->foreignId('paiement_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Informations personnelles (peuvent être différentes de l'utilisateur)
            $table->string('nom');
            $table->string('prenom');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->string('code_postal')->nullable();
            $table->date('date_naissance')->nullable();
            $table->date('permis_date')->nullable();

            // Type de formation choisi
            $table->enum('type_formation', ['presentiel', 'en_ligne', 'mixte'])
                ->default('presentiel');

            // Statut de l'inscription
            $table->enum('statut', [
                'en_attente',     // Inscription soumise
                'confirme',       // Inscription confirmée
                'annule',         // Inscription annulée
                'termine'         // Formation terminée
            ])->default('en_attente');

            // Suivi de progression
            $table->decimal('progression', 5, 2)->default(0);
            $table->timestamp('date_debut')->nullable();
            $table->timestamp('date_fin')->nullable();

            // Informations supplémentaires
            $table->text('notes')->nullable();
            $table->json('donnees_supplementaires')->nullable();

            $table->timestamps();

            // Index pour performances
            $table->index(['formation_id', 'statut']);
            $table->index('email');
            $table->index(['nom', 'prenom']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
