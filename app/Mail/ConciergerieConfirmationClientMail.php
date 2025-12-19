<?php

namespace App\Mail;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConciergerieConfirmationClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;

    /**
     * Create a new message instance.
     */
    public function __construct(ConciergerieDemande $demande)
    {
        $this->demande = $demande;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('conciergerie@djokprestige.com', 'DJOK PRESTIGE')
            ->subject('Confirmation de votre demande de conciergerie - ' . $this->demande->reference)
            ->view('emails.conciergerie.client-confirmation')
            ->with(['demande' => $this->demande]);
    }
}
