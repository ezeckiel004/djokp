<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Ajout des nouveaux champs pour le formulaire public
            $table->string('type_service')->nullable()->after('type');
            $table->string('depart')->nullable()->after('type_service');
            $table->string('arrivee')->nullable()->after('depart');
            $table->date('date')->nullable()->after('arrivee');
            $table->time('heure')->nullable()->after('date');
            $table->string('type_vehicule')->nullable()->after('heure');
            $table->string('passagers')->nullable()->after('type_vehicule');
            $table->string('nom')->nullable()->after('passagers');
            $table->string('telephone')->nullable()->after('nom');
            $table->string('email')->nullable()->after('telephone');
            $table->text('instructions')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn([
                'type_service',
                'depart',
                'arrivee',
                'date',
                'heure',
                'type_vehicule',
                'passagers',
                'nom',
                'telephone',
                'email',
                'instructions'
            ]);
        });
    }
};
