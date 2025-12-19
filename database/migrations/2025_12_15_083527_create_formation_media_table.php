<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('formation_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'pdf', 'video'
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path'); // Chemin vers le fichier
            $table->string('file_name'); // Nom original du fichier
            $table->string('file_size')->nullable();
            $table->string('duration')->nullable(); // Pour les vidéos
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('formation_media');
    }
};
