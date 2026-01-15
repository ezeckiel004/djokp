<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\Paiement;

class ReservationPaidMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $paiement;
    public $subject;
    public $isAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, Paiement $paiement, $isAdmin = false)
    {
        $this->reservation = $reservation;
        $this->paiement = $paiement;
        $this->isAdmin = $isAdmin;

        if ($isAdmin) {
            $this->subject = 'Nouvelle réservation payée - ' . $reservation->reference;
        } else {
            $this->subject = 'Confirmation de votre réservation ' . $reservation->reference . ' - DJOK PRESTIGE';
        }
    }

    /**
     * Build the message.
     */
    public function build()
    {
        if ($this->isAdmin) {
            return $this->markdown('emails.reservations.paid-admin')
                ->subject($this->subject)
                ->with([
                    'reservation' => $this->reservation,
                    'paiement' => $this->paiement,
                ]);
        }

        return $this->markdown('emails.reservations.paid-client')
            ->subject($this->subject)
            ->with([
                'reservation' => $this->reservation,
                'paiement' => $this->paiement,
            ]);
    }
}
