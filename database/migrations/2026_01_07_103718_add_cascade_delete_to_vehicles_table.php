<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddCascadeDeleteToVehiclesTable extends Migration
{
    public function up()
    {
        // Supprimer la contrainte existante
        Schema::table('vehicles', function (Blueprint $table) {
            // Récupérer le nom de la contrainte
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableForeignKeys('vehicles');

            foreach ($indexes as $index) {
                if ($index->getColumns()[0] === 'vehicle_category_id') {
                    $table->dropForeign([$index->getColumns()[0]]);
                }
            }
        });

        // Recréer la contrainte avec cascade
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('vehicle_category_id')
                ->references('id')
                ->on('vehicle_categories')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableForeignKeys('vehicles');

            foreach ($indexes as $index) {
                if ($index->getColumns()[0] === 'vehicle_category_id') {
                    $table->dropForeign([$index->getColumns()[0]]);
                }
            }
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('vehicle_category_id')
                ->references('id')
                ->on('vehicle_categories');
            // Sans onDelete('cascade') - revient au comportement par défaut
        });
    }
}
