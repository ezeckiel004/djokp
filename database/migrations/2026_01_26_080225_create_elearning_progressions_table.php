<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elearning_progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acces_id')->constrained('elearning_acces')->onDelete('cascade');
            $table->foreignId('cours_id')->constrained('elearning_cours')->onDelete('cascade');
            $table->foreignId('qcm_id')->nullable()->constrained('elearning_qcms')->onDelete('set null');

            $table->boolean('cours_completed')->default(false);
            $table->timestamp('cours_completed_at')->nullable();

            $table->boolean('qcm_completed')->default(false);
            $table->integer('qcm_score')->nullable();
            $table->integer('qcm_attempts')->default(0);
            $table->timestamp('qcm_completed_at')->nullable();

            $table->timestamps();

            $table->unique(['acces_id', 'cours_id']);
            $table->index(['acces_id', 'cours_completed']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elearning_progressions');
    }
};
