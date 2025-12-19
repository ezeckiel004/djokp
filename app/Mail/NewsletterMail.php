<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Facades\Log;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;
    public $subscription;
    public $unsubscribeUrl;

    public function __construct(NewsletterCampaign $campaign, NewsletterSubscription $subscription)
    {
        $this->campaign = $campaign;
        $this->subscription = $subscription;
        $this->unsubscribeUrl = route('newsletter.unsubscribe', ['token' => $subscription->token]);
    }

    public function build()
    {
        // Remplacer les variables dans le contenu
        $content = $this->campaign->content;

        $replacements = [
            '{unsubscribe_url}' => $this->unsubscribeUrl,
            '{email}' => $this->subscription->email,
            '{name}' => $this->subscription->name ?? 'Abonné',
        ];

        $content = str_replace(
            array_keys($replacements),
            array_values($replacements),
            $content
        );

        // Vérifier le template
        $template = $this->campaign->template;
        $viewPath = 'emails.newsletter.' . $template;

        // Si le template n'existe pas, utiliser default
        if (!view()->exists($viewPath)) {
            Log::warning("Template $viewPath non trouvé, utilisation du template par défaut");
            $template = 'default';
            $viewPath = 'emails.newsletter.default';
        }

        // Construire l'email avec TOUTES les variables nécessaires
        return $this->subject($this->campaign->subject)
            ->view($viewPath)
            ->with([
                'content' => $content,
                'campaign' => $this->campaign,
                'subscription' => $this->subscription,
                'unsubscribeUrl' => $this->unsubscribeUrl,
            ]);
    }
}
