<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('elearning_qcms', function (Blueprint $table) {
            $table->boolean('allow_multiple_correct')->default(false)->after('is_examen_blanc');
        });
    }

    public function down(): void
    {
        Schema::table('elearning_qcms', function (Blueprint $table) {
            $table->dropColumn('allow_multiple_correct');
        });
    }
};
