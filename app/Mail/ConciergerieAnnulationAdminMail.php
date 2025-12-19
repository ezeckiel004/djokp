<?php

namespace App\Mail;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConciergerieAnnulationAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $userEmail;
    public $annulationDate;

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
        return $this->subject('[ANNULATION] Demande Conciergerie ' . $this->demande->reference)
            ->to('conciergerie@djokprestige.com')
            ->replyTo($this->userEmail)
            ->view('emails.conciergerie-annulation-admin')
            ->with([
                'demande' => $this->demande,
                'userEmail' => $this->userEmail,
                'annulationDate' => $this->annulationDate,
            ]);
    }
}
