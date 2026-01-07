<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categorie')->unique(); // Nom unique de la catégorie
            $table->string('display_name'); // Nom d'affichage
            $table->decimal('prise_en_charge', 10, 2)->default(0);
            $table->decimal('prix_au_km', 10, 2)->default(0);
            $table->decimal('prix_minimum', 10, 2)->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });

        // Ajouter une colonne de référence dans la table vehicles
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('vehicle_category_id')->nullable()->constrained('vehicle_categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['vehicle_category_id']);
            $table->dropColumn('vehicle_category_id');
        });

        Schema::dropIfExists('vehicle_categories');
    }
};
