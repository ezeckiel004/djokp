<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservationData;
    public $recipientType; // 'client' ou 'admin'

    /**
     * Create a new message instance.
     */
    public function __construct(array $reservationData, string $recipientType = 'client')
    {
        $this->reservationData = $reservationData;
        $this->recipientType = $recipientType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->recipientType === 'client') {
            $subject = 'Confirmation de votre réservation DJOK PRESTIGE';
        } else {
            $subject = 'Nouvelle réservation - ' .
                ($this->reservationData['type_service_label'] ??
                    $this->getServiceType($this->reservationData['type_service'] ?? ''));
        }

        return new Envelope(
            subject: $subject,
            from: new \Illuminate\Mail\Mailables\Address('vtc@djokprestige.com', 'DJOK PRESTIGE'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->recipientType === 'client') {
            $view = 'emails.reservation-client';
        } else {
            $view = 'emails.reservation-admin';
        }

        return new Content(
            view: $view,
            with: [
                'data' => $this->reservationData,
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
     * Helper pour formater le type de service
     */
    private function getServiceType($type): string
    {
        $types = [
            'transfert' => 'Transfert aéroport/gare',
            'professionnel' => 'Déplacement professionnel',
            'evenement' => 'Événement/mariage',
            'mise_disposition' => 'Mise à disposition'
        ];

        return $types[$type] ?? $type;
    }
}
