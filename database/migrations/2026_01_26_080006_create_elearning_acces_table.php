<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elearning_acces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('forfait_id')->constrained('elearning_forfaits')->onDelete('cascade');
            $table->foreignId('paiement_id')->nullable()->constrained()->onDelete('set null');

            // Informations utilisateur
            $table->string('email');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();

            // Code d'accès unique
            $table->string('access_code')->unique();
            $table->string('virtual_room_code');

            // Session actuelle
            $table->string('current_session_token')->nullable();
            $table->timestamp('current_session_start')->nullable();
            $table->ipAddress('current_session_ip')->nullable();
            $table->string('current_session_browser')->nullable();

            // Dates d'accès - CHANGÉ: nullable avec valeur par défaut
            $table->timestamp('access_start')->useCurrent();
            $table->timestamp('access_end')->nullable();
            $table->timestamp('last_access_at')->nullable();

            // Progression
            $table->integer('cours_completed')->default(0);
            $table->integer('total_cours')->default(0);
            $table->decimal('average_qcm_score', 5, 2)->default(0);
            $table->json('exam_results')->nullable();

            // Certification
            $table->boolean('certification_eligible')->default(false);
            $table->string('certification_file_path')->nullable();
            $table->timestamp('certification_sent_at')->nullable();

            // Statut
            $table->enum('status', ['active', 'expired', 'suspended'])->default('active');
            $table->text('suspension_reason')->nullable();

            $table->timestamps();

            // Index
            $table->index(['access_code', 'email']);
            $table->index(['virtual_room_code', 'status']);
            $table->index(['access_end', 'status']);
            $table->index('email');
        });

        // Ajouter un commentaire explicatif si nécessaire
        DB::statement("ALTER TABLE elearning_acces COMMENT = 'Accès aux formations e-learning'");
    }

    public function down(): void
    {
        Schema::dropIfExists('elearning_acces');
    }
};
