<?php

namespace App\Mail;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConciergerieAnnulationClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $annulationDate;
    public $userEmail;

    /**
     * Create a new message instance.
     */
    public function __construct(ConciergerieDemande $demande, $userEmail)
    {
        $this->demande = $demande;
        $this->userEmail = $userEmail;
        $this->annulationDate = now()->format('d/m/Y H:i');
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('[ANNULATION] Votre demande Conciergerie ' . $this->demande->reference)
            ->to($this->userEmail)
            ->view('emails.conciergerie-annulation-client')
            ->with([
                'demande' => $this->demande,
                'annulationDate' => $this->annulationDate,
            ]);
    }
}
