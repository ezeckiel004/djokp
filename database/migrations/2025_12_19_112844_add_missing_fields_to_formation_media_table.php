<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajouter les champs manquants à la table formation_media
     */
    public function up(): void
    {
        Schema::table('formation_media', function (Blueprint $table) {
            if (!Schema::hasColumn('formation_media', 'thumbnail_path')) {
                $table->string('thumbnail_path')->nullable()->after('file_path');
            }

            if (!Schema::hasColumn('formation_media', 'download_count')) {
                $table->integer('download_count')->default(0)->after('order');
            }

            if (!Schema::hasColumn('formation_media', 'view_count')) {
                $table->integer('view_count')->default(0)->after('download_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formation_media', function (Blueprint $table) {
            $columns = ['thumbnail_path', 'download_count', 'view_count'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('formation_media', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
