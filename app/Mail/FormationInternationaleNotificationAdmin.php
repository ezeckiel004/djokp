<?php

namespace App\Mail;

use App\Models\DemandeFormationInternationale;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormationInternationaleNotificationAdmin extends Mailable
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

        return $this->subject('🔔 NOUVELLE DEMANDE Formation Internationale - ' . $this->demande->nom_complet)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('emails.formation-internationale-notification-admin')
            ->with([
                'demande' => $this->demande,
                'formationTitre' => $this->formationTitre,
                'services' => $services,
                'dateDemande' => $this->demande->created_at->format('d/m/Y à H:i'),
                'adminUrl' => url('/admin/demandes-formation-internationale/' . $this->demande->id),
            ]);
    }
}
