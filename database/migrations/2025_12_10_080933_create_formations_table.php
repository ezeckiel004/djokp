<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('duration_hours');
            $table->enum('format', ['presentiel', 'en_ligne', 'mixte']);
            $table->enum('type', ['vtc_theorique', 'vtc_pratique', 'e_learning', 'renouvellement', 'international']);
            $table->boolean('is_certified')->default(false);
            $table->boolean('is_financeable_cpf')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('program')->nullable();
            $table->json('requirements')->nullable();
            $table->json('included_services')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
