<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddElearningForfaitIdToPaiementsTable extends Migration
{
    public function up()
    {
        Schema::table('paiements', function (Blueprint $table) {
            // Ajouter elearning_forfait_id après formation_internationale_id
            $table->foreignId('elearning_forfait_id')
                ->nullable()
                ->after('formation_internationale_id')
                ->constrained('elearning_forfaits')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeign(['elearning_forfait_id']);
            $table->dropColumn('elearning_forfait_id');
        });
    }
}
