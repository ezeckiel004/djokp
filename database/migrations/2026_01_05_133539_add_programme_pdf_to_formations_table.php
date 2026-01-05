<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgrammePdfToFormationsTable extends Migration
{
    public function up()
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->string('programme_pdf')->nullable()->after('description');
            $table->timestamp('programme_pdf_generated_at')->nullable()->after('programme_pdf');
        });
    }

    public function down()
    {
        Schema::table('formations', function (Blueprint $table) {
            $table->dropColumn(['programme_pdf', 'programme_pdf_generated_at']);
        });
    }
}
