<?php

namespace App\Mail;

use App\Models\LocationReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LocationReservationCancellation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $recipientType;
    public $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(LocationReservation $reservation, $recipientType = 'client', $reason = null)
    {
        $this->reservation = $reservation;
        $this->recipientType = $recipientType;
        $this->reason = $reason;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->recipientType === 'admin'
            ? 'ANNULATION DE RÉSERVATION - Réf: ' . $this->reservation->reference
            : 'Confirmation d\'annulation de votre réservation - Réf: ' . $this->reservation->reference;

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->recipientType === 'admin'
            ? 'emails.location-reservation.cancellation-admin'
            : 'emails.location-reservation.cancellation-client';

        return new Content(
            view: $view,
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
