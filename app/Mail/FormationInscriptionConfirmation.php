<?php

namespace App\Mail;

use App\Models\Participant;
use App\Models\Formation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FormationInscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $formation;

    public function __construct(Participant $participant, Formation $formation)
    {
        $this->participant = $participant;
        $this->formation = $formation;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre inscription - ' . $this->formation->title . ' | DJOK PRESTIGE',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.formation-inscription-confirmation',
            with: [
                'participant' => $this->participant,
                'formation' => $this->formation,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
