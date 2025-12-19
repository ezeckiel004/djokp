<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminReservationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationData;
    public $userInfo;

    public function __construct($reservationData, $userInfo)
    {
        $this->reservationData = $reservationData;
        $this->userInfo = $userInfo;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🚗 Nouvelle réservation VTC #' . ($this->reservationData['reference'] ?? 'NEW'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-reservation-notification',
            with: [
                'reservation' => $this->reservationData,
                'user' => $this->userInfo,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
