<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationCancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $userType;
    public $cancellationReason;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, string $userType, ?string $cancellationReason = null)
    {
        $this->reservation = $reservation;
        $this->userType = $userType;
        $this->cancellationReason = $cancellationReason;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = '';
        $view = '';

        switch ($this->userType) {
            case 'client':
                $subject = 'Confirmation d\'annulation - Réservation ' . $this->reservation->reference;
                $view = 'emails.reservations.cancelled-client';
                break;

            case 'admin':
                $subject = 'ANNULATION - Réservation #' . $this->reservation->reference;
                $view = 'emails.reservations.cancelled-admin';
                break;
        }

        return $this->markdown($view)
            ->subject($subject)
            ->with([
                'reservation' => $this->reservation,
                'cancellationReason' => $this->cancellationReason,
            ]);
    }
}
