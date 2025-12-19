<?php

namespace App\Mail\Conciergerie;

use App\Models\ConciergerieDemande;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DevisEnvoyeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $demande;
    public $details;
    public $notes;
    public $ancienStatut;

    /**
     * Create a new message instance.
     */
    public function __construct(ConciergerieDemande $demande, $details, $notes = '', $ancienStatut = null)
    {
        $this->demande = $demande;
        $this->details = $details;
        $this->notes = $notes;
        $this->ancienStatut = $ancienStatut;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Votre devis est prêt - Demande #{$this->demande->reference}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.conciergerie.devis_envoye',
            with: [
                'demande' => $this->demande,
                'details' => $this->details,
                'notes' => $this->notes,
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
