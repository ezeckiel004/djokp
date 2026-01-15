<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\Paiement;

class AdminReservationPaidNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $paiement;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, Paiement $paiement)
    {
        $this->reservation = $reservation;
        $this->paiement = $paiement;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emails.reservations.paid-admin')
            ->subject('🚗 Nouvelle réservation payée : ' . $this->reservation->reference)
            ->with([
                'reservation' => $this->reservation,
                'paiement' => $this->paiement,
            ]);
    }
}
