<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletter_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['pending', 'confirmed', 'unsubscribed'])->default('confirmed');
            $table->string('source')->nullable()->comment('Page où l\'inscription a été faite');
            $table->string('token')->nullable()->unique();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('unsubscribed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->string('template')->default('default');
            $table->enum('status', ['draft', 'scheduled', 'sending', 'sent', 'cancelled'])->default('draft');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->integer('total_recipients')->default(0);
            $table->integer('opened_count')->default(0);
            $table->integer('clicked_count')->default(0);
            $table->json('stats')->nullable();
            $table->timestamps();
        });

        Schema::create('newsletter_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable()->constrained('newsletter_campaigns')->onDelete('cascade');
            $table->foreignId('subscription_id')->nullable()->constrained('newsletter_subscriptions')->onDelete('cascade');
            $table->string('email');
            $table->string('action'); // sent, opened, clicked, bounced, unsubscribed
            $table->json('data')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_logs');
        Schema::dropIfExists('newsletter_campaigns');
        Schema::dropIfExists('newsletter_subscriptions');
    }
};
