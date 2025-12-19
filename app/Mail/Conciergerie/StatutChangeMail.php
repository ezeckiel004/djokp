<?php

namespace App\Mail\Conciergerie;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatutChangeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $ancienStatut;
    public $nouveauStatut;

    /**
     * Create a new message instance.
     */
    public function __construct(ConciergerieDemande $demande, $ancienStatut, $nouveauStatut)
    {
        $this->demande = $demande;
        $this->ancienStatut = $ancienStatut;
        $this->nouveauStatut = $nouveauStatut;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Mise à jour de votre demande #{$this->demande->reference}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.conciergerie.generique',
            with: [
                'demande' => $this->demande,
                'ancienStatut' => $this->ancienStatut,
                'nouveauStatut' => $this->nouveauStatut,
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
