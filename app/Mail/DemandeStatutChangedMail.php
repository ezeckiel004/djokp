<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DemandeStatutChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $ancienStatut;
    public $nouveauStatut;

    /**
     * Create a new message instance.
     */
    public function __construct($demande, $ancienStatut)
    {
        $this->demande = $demande;
        $this->ancienStatut = $ancienStatut;
        $this->nouveauStatut = $demande->statut;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $labels = [
            'nouveau' => 'Nouveau',
            'en_cours' => 'En cours de traitement',
            'traite' => 'Traité',
            'annule' => 'Annulé'
        ];

        $ancienStatutLabel = $labels[$this->ancienStatut] ?? $this->ancienStatut;
        $nouveauStatutLabel = $labels[$this->nouveauStatut] ?? $this->nouveauStatut;

        $sujet = "Mise à jour de votre demande de formation";

        return $this->subject($sujet)
            ->view('emails.demande-statut-changed')
            ->with([
                'demande' => $this->demande,
                'ancienStatut' => $ancienStatutLabel,
                'nouveauStatut' => $nouveauStatutLabel,
            ]);
    }
}
