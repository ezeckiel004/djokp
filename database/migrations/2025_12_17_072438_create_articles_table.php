<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('category'); // location, vtc-transport, conciergerie, formation
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable(); // Pour le gradient
            $table->integer('reading_time')->default(3); // en minutes
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(false);
            $table->dateTime('published_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
