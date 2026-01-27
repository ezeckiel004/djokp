<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elearning_qcms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cours_id')->nullable()->constrained('elearning_cours')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('questions_count')->default(10);
            $table->integer('passing_score')->default(70);
            $table->integer('time_limit_minutes')->nullable();
            $table->integer('attempts_allowed')->default(3);
            $table->boolean('is_examen_blanc')->default(false);
            $table->boolean('is_active')->default(true);
            $table->json('questions_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elearning_qcms');
    }
};
