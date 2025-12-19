<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscription;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaign;
    public $tries = 1;
    public $timeout = 120;

    public function __construct(NewsletterCampaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function handle()
    {
        Log::info('=== DÉBUT ENVOI NEWSLETTER ===');
        Log::info('Campagne ID: ' . $this->campaign->id);
        Log::info('Template: ' . $this->campaign->template);

        // Mettre à jour le statut
        $this->campaign->update(['status' => 'sending']);

        try {
            // Récupérer tous les abonnés actifs
            $subscriptions = NewsletterSubscription::active()->get();
            $total = $subscriptions->count();

            Log::info("Abonnés actifs trouvés: " . $total);

            if ($total === 0) {
                Log::warning('Aucun abonné actif trouvé');
                $this->campaign->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                    'sent_count' => 0,
                ]);
                return;
            }

            $sentCount = 0;
            $failedCount = 0;

            foreach ($subscriptions as $index => $subscription) {
                try {
                    Log::info("Traitement [" . ($index + 1) . "/{$total}]: " . $subscription->email);

                    // Créer et envoyer l'email
                    $mail = new NewsletterMail($this->campaign, $subscription);
                    Mail::to($subscription->email)->send($mail);

                    Log::info("✓ Email envoyé avec succès à: " . $subscription->email);
                    $sentCount++;

                    // Petite pause pour éviter de surcharger
                    usleep(50000); // 0.05 seconde

                } catch (\Exception $e) {
                    Log::error("✗ Erreur pour " . $subscription->email . ": " . $e->getMessage());
                    $failedCount++;
                }
            }

            // Mise à jour finale de la campagne
            $this->campaign->update([
                'status' => 'sent',
                'sent_at' => now(),
                'sent_count' => $sentCount,
                'failed_count' => $failedCount,
            ]);

            Log::info('=== FIN ENVOI NEWSLETTER ===');
            Log::info("Résumé: {$sentCount} envoyés, {$failedCount} échoués");
        } catch (\Exception $e) {
            Log::error('=== ERREUR GLOBALE DANS LE JOB ===');
            Log::error('Message: ' . $e->getMessage());
            Log::error('Trace: ' . $e->getTraceAsString());

            $this->campaign->update([
                'status' => 'failed',
            ]);
        }
    }
}
