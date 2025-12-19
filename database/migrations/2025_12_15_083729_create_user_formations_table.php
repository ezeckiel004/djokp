<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            $table->foreignId('paiement_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('status', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('access_start')->nullable();
            $table->timestamp('access_end')->nullable();
            $table->decimal('progress', 5, 2)->default(0); // Progression en %
            $table->json('completion_data')->nullable(); // Données de progression
            $table->timestamps();

            $table->unique(['user_id', 'formation_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_formations');
    }
};
