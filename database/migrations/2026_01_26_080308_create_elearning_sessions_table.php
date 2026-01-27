<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elearning_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acces_id')->constrained('elearning_acces')->onDelete('cascade');
            $table->string('session_token')->unique();
            $table->ipAddress('ip_address');
            $table->string('user_agent')->nullable();

            // CORRECTION : Utiliser dateTime ou rendre nullable avec useCurrent()
            $table->dateTime('login_at'); // Changé de timestamp à dateTime
            $table->dateTime('last_activity_at'); // Changé de timestamp à dateTime
            $table->dateTime('logout_at')->nullable(); // Déjà nullable, ok

            $table->json('activity_log')->nullable();
            $table->boolean('forced_logout')->default(false);

            $table->timestamps();

            $table->index(['acces_id', 'login_at']);
            $table->index('session_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elearning_sessions');
    }
};
