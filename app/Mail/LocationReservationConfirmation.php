<?php

namespace App\Mail;

use App\Models\LocationReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LocationReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $type; // 'client' ou 'admin'

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(LocationReservation $reservation, $type = 'client')
    {
        $this->reservation = $reservation;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->type === 'client'
            ? 'Confirmation de votre demande de réservation - DJOK PRESTIGE'
            : 'Nouvelle demande de réservation de véhicule - DJOK PRESTIGE';

        return $this->subject($subject)
            ->view('emails.location-reservation')
            ->with([
                'reservation' => $this->reservation,
                'type' => $this->type
            ]);
    }
}
