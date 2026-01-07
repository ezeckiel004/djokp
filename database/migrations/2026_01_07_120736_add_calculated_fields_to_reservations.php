<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Ajouter la clé étrangère pour vehicle_category_id
            if (!Schema::hasColumn('reservations', 'vehicle_category_id')) {
                $table->foreignId('vehicle_category_id')->nullable()->constrained('vehicle_categories')->onDelete('set null')->after('vehicle_id');
            }

            // Ajouter les champs de coordonnées GPS
            if (!Schema::hasColumn('reservations', 'depart_lat')) {
                $table->decimal('depart_lat', 10, 8)->nullable()->after('arrivee');
            }
            if (!Schema::hasColumn('reservations', 'depart_lng')) {
                $table->decimal('depart_lng', 10, 8)->nullable()->after('depart_lat');
            }
            if (!Schema::hasColumn('reservations', 'arrivee_lat')) {
                $table->decimal('arrivee_lat', 10, 8)->nullable()->after('depart_lng');
            }
            if (!Schema::hasColumn('reservations', 'arrivee_lng')) {
                $table->decimal('arrivee_lng', 10, 8)->nullable()->after('arrivee_lat');
            }

            // Ajouter les champs calculés
            if (!Schema::hasColumn('reservations', 'calculated_prise_charge')) {
                $table->decimal('calculated_prise_charge', 10, 2)->nullable()->after('arrivee_lng');
            }
            if (!Schema::hasColumn('reservations', 'calculated_distance_price')) {
                $table->decimal('calculated_distance_price', 10, 2)->nullable()->after('calculated_prise_charge');
            }
            if (!Schema::hasColumn('reservations', 'calculated_price_ht')) {
                $table->decimal('calculated_price_ht', 10, 2)->nullable()->after('calculated_distance_price');
            }
            if (!Schema::hasColumn('reservations', 'calculated_tva')) {
                $table->decimal('calculated_tva', 10, 2)->nullable()->after('calculated_price_ht');
            }
            if (!Schema::hasColumn('reservations', 'calculated_price_ttc')) {
                $table->decimal('calculated_price_ttc', 10, 2)->nullable()->after('calculated_tva');
            }
            if (!Schema::hasColumn('reservations', 'calculated_distance_km')) {
                $table->decimal('calculated_distance_km', 10, 2)->nullable()->after('calculated_price_ttc');
            }
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Supprimer les champs ajoutés
            $table->dropForeign(['vehicle_category_id']);
            $table->dropColumn([
                'vehicle_category_id',
                'depart_lat',
                'depart_lng',
                'arrivee_lat',
                'arrivee_lng',
                'calculated_prise_charge',
                'calculated_distance_price',
                'calculated_price_ht',
                'calculated_tva',
                'calculated_price_ttc',
                'calculated_distance_km'
            ]);
        });
    }
};
