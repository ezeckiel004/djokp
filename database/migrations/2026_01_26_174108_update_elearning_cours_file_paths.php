<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('elearning_cours', function (Blueprint $table) {
            // 1. D'abord ajouter les nouvelles colonnes
            $table->string('video_name')->nullable()->after('video_url');
            $table->string('pdf_name')->nullable()->after('pdf_url');

            // 2. Ensuite, créer temporairement les nouvelles colonnes path
            $table->string('video_path')->nullable()->after('video_url');
            $table->string('pdf_path')->nullable()->after('pdf_url');
        });

        // 3. Copier les données de video_url vers video_path
        DB::table('elearning_cours')->whereNotNull('video_url')->update([
            'video_path' => DB::raw('video_url')
        ]);

        // 4. Copier les données de pdf_url vers pdf_path
        DB::table('elearning_cours')->whereNotNull('pdf_url')->update([
            'pdf_path' => DB::raw('pdf_url')
        ]);

        Schema::table('elearning_cours', function (Blueprint $table) {
            // 5. Supprimer les anciennes colonnes
            $table->dropColumn(['video_url', 'pdf_url']);
        });
    }

    public function down(): void
    {
        Schema::table('elearning_cours', function (Blueprint $table) {
            // 1. Recréer les anciennes colonnes
            $table->string('video_url')->nullable()->after('video_path');
            $table->string('pdf_url')->nullable()->after('pdf_path');
        });

        // 2. Copier les données de video_path vers video_url
        DB::table('elearning_cours')->whereNotNull('video_path')->update([
            'video_url' => DB::raw('video_path')
        ]);

        // 3. Copier les données de pdf_path vers pdf_url
        DB::table('elearning_cours')->whereNotNull('pdf_path')->update([
            'pdf_url' => DB::raw('pdf_path')
        ]);

        Schema::table('elearning_cours', function (Blueprint $table) {
            // 4. Supprimer les nouvelles colonnes
            $table->dropColumn(['video_path', 'pdf_path', 'video_name', 'pdf_name']);
        });
    }
};
