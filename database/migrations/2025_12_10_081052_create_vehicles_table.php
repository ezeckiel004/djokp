<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration')->unique();
            $table->string('brand');
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->enum('category', ['eco', 'business', 'prestige', 'van']);
            $table->enum('fuel_type', ['essence', 'diesel', 'hybrid', 'electric']);
            $table->integer('seats');
            $table->json('features')->nullable();
            $table->boolean('is_available')->default(true);
            $table->decimal('daily_rate', 10, 2);
            $table->decimal('weekly_rate', 10, 2);
            $table->decimal('monthly_rate', 10, 2);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
