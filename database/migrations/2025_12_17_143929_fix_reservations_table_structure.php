<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // 1. Rendre user_id nullable SI ce n'est pas déjà fait
            if (Schema::hasColumn('reservations', 'user_id')) {
                $table->foreignId('user_id')->nullable()->change();
            }

            // 2. Rendre vehicle_id nullable SI ce n'est pas déjà fait
            if (Schema::hasColumn('reservations', 'vehicle_id')) {
                $table->foreignId('vehicle_id')->nullable()->change();
            }

            // 3. Ajouter les champs manquants UNIQUEMENT s'ils n'existent pas
            if (!Schema::hasColumn('reservations', 'source')) {
                $table->enum('source', ['admin', 'client', 'public'])->default('public')->after('status');
            }

            if (!Schema::hasColumn('reservations', 'reference')) {
                $table->string('reference')->unique()->nullable()->after('source');
            }

            // 4. Ajouter un champ pour savoir si c'est une réservation VTC
            if (!Schema::hasColumn('reservations', 'is_vtc_booking')) {
                $table->boolean('is_vtc_booking')->default(false)->after('reference');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimer seulement les nouveaux champs que nous avons ajoutés
            if (Schema::hasColumn('reservations', 'source')) {
                $table->dropColumn('source');
            }

            if (Schema::hasColumn('reservations', 'reference')) {
                $table->dropColumn('reference');
            }

            if (Schema::hasColumn('reservations', 'is_vtc_booking')) {
                $table->dropColumn('is_vtc_booking');
            }

            // Remettre user_id et vehicle_id comme non nullable (optionnel)
            // $table->foreignId('user_id')->nullable(false)->change();
            // $table->foreignId('vehicle_id')->nullable(false)->change();
        });
    }
};
