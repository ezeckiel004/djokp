<?php

namespace App\Mail;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConciergerieDevisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $detailsDevis;
    public $notesClient;

    public function __construct(ConciergerieDemande $demande, $detailsDevis, $notesClient = null)
    {
        $this->demande = $demande;
        $this->detailsDevis = $detailsDevis;
        $this->notesClient = $notesClient;
    }

    public function build()
    {
        return $this->subject('Votre devis conciergerie - ' . $this->demande->reference)
            ->markdown('emails.conciergerie.devis')
            ->with([
                'demande' => $this->demande,
                'detailsDevis' => $this->detailsDevis,
                'notesClient' => $this->notesClient,
            ]);
    }
}
