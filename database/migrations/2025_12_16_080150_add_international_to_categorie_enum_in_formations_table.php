<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ajouter 'international' à l'enum de la colonne categorie
        DB::statement("ALTER TABLE formations MODIFY COLUMN categorie ENUM('vtc_theorique','vtc_pratique','e_learning','renouvellement','international') NOT NULL DEFAULT 'vtc_theorique'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retirer 'international' de l'enum (retour à l'état précédent)
        DB::statement("ALTER TABLE formations MODIFY COLUMN categorie ENUM('vtc_theorique','vtc_pratique','e_learning','renouvellement') NOT NULL DEFAULT 'vtc_theorique'");
    }
};
