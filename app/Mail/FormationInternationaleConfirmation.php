<?php

namespace App\Mail;

use App\Models\DemandeFormationInternationale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormationInternationaleConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $formationTitre;

    public function __construct(DemandeFormationInternationale $demande)
    {
        $this->demande = $demande;

        if ($demande->formation_id && $demande->formation) {
            $this->formationTitre = $demande->formation->title;
        } else {
            $this->formationTitre = $demande->formation_personnalisee ?? 'Formation personnalisée';
        }
    }

    public function build()
    {
        $services = $this->demande->services ?? [];

        return $this->subject('Confirmation de votre demande de formation internationale - DJOK PRESTIGE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo('international@djokprestige.com', 'Service International DJOK PRESTIGE')
            ->view('emails.formation-internationale-confirmation-client')
            ->with([
                'demande' => $this->demande,
                'formationTitre' => $this->formationTitre,
                'services' => $services,
                'dateDemande' => $this->demande->created_at->format('d/m/Y à H:i'),
                'telephoneContact' => '+33 1 76 38 00 17',
                'whatsappContact' => '+33 1 76 38 00 17',
                'emailContact' => 'international@djokprestige.com',
            ]);
    }
}
