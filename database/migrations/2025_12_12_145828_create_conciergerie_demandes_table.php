<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conciergerie_demandes', function (Blueprint $table) {
            $table->id();

            // Informations client
            $table->string('nom_complet');
            $table->string('email');
            $table->string('telephone');

            // Informations séjour
            $table->string('motif_voyage');
            $table->date('date_arrivee');
            $table->string('duree_sejour');
            $table->string('nombre_personnes');
            $table->string('budget')->nullable();
            $table->string('type_accompagnement');

            // Services demandés (stockés en JSON)
            $table->json('services')->nullable();

            // Message
            $table->text('message');

            // Informations administratives
            $table->string('statut')->default('nouvelle');
            $table->string('reference')->unique();
            $table->text('notes_admin')->nullable();
            $table->decimal('montant_devis', 10, 2)->nullable();
            $table->string('devise')->default('EUR');
            $table->date('date_devis')->nullable();

            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conciergerie_demandes');
    }
};
