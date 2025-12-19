<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ParticipantStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $oldStatus;
    public $newStatus;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct(Participant $participant, $oldStatus, $newStatus, $subject)
    {
        $this->participant = $participant;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.participant-status',
            with: [
                'participant' => $this->participant,
                'oldStatus' => $this->oldStatus,
                'newStatus' => $this->newStatus,
                'subject' => $this->subject,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
