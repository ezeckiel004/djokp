<?php

namespace App\Mail;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConciergerieConfirmationMail extends Mailable
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
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📄 Votre devis conciergerie - ' . $this->demande->reference . ' - DJOK PRESTIGE',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.conciergerie.confirmation',
            with: [
                'demande' => $this->demande,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    /**
     * Build the message (méthode alternative pour compatibilité)
     */
    public function build()
    {
        return $this->view('emails.conciergerie.confirmation')
            ->with([
                'demande' => $this->demande,
            ])
            ->subject('📄 Votre devis conciergerie - ' . $this->demande->reference . ' - DJOK PRESTIGE');
    }
}
