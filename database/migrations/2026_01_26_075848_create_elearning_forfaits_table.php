<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('elearning_forfaits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('duration_days');
            $table->integer('max_concurrent_connections')->default(1);
            $table->boolean('includes_qcm')->default(true);
            $table->boolean('includes_examens_blancs')->default(true);
            $table->boolean('includes_certification')->default(false);
            $table->integer('access_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->json('features')->nullable();
            $table->string('stripe_product_id')->nullable();
            $table->string('stripe_price_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('elearning_forfaits');
    }
};
