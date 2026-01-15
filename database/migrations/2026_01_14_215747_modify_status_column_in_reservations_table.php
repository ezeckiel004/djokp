<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusColumnInReservationsTable extends Migration
{
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('status', 20)->change(); // Augmente à 20 caractères
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('status', 10)->change(); // Reviens à 10 caractères
        });
    }
}
