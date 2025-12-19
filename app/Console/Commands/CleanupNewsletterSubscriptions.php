<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewsletterSubscription;
use Carbon\Carbon;

class CleanupNewsletterSubscriptions extends Command
{
    protected $signature = 'newsletter:cleanup {--days=180 : Supprimer les abonnés désabonnés depuis X jours}';
    protected $description = 'Nettoyer les abonnés newsletter inactifs';

    public function handle()
    {
        $days = $this->option('days');
        $cutoffDate = Carbon::now()->subDays($days);

        $count = NewsletterSubscription::where('status', 'unsubscribed')
            ->where('unsubscribed_at', '<', $cutoffDate)
            ->delete();

        $this->info("$count abonnés désabonnés supprimés (désabonnés depuis plus de $days jours).");

        return 0;
    }
}
