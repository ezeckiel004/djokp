<?php

namespace App\Mail\Conciergerie;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $ancienStatut;

    /**
     * Create a new message instance.
     */
    public function __construct(ConciergerieDemande $demande, $ancienStatut)
    {
        $this->demande = $demande;
        $this->ancienStatut = $ancienStatut;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "🎉 Votre demande #{$this->demande->reference} est confirmée !",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.conciergerie.confirme',
            with: [
                'demande' => $this->demande,
                'ancienStatut' => $this->ancienStatut,
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
}
