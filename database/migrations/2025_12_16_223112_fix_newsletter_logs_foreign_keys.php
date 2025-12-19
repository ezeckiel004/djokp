<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Vérifiez si la colonne newsletter_subscription_id existe
        if (Schema::hasColumn('newsletter_logs', 'newsletter_subscription_id')) {
            Schema::table('newsletter_logs', function (Blueprint $table) {
                // Supprimez la clé étrangère si elle existe
                $table->dropForeign(['newsletter_subscription_id']);
                // Supprimez la colonne
                $table->dropColumn('newsletter_subscription_id');
            });
        }

        // Assurez-vous que subscription_id existe
        if (!Schema::hasColumn('newsletter_logs', 'subscription_id')) {
            Schema::table('newsletter_logs', function (Blueprint $table) {
                $table->foreignId('subscription_id')->nullable()->constrained('newsletter_subscriptions')->onDelete('cascade')->after('campaign_id');
            });
        }
    }

    public function down(): void
    {
        // Ne rien faire pour éviter de perdre des données
    }
};
