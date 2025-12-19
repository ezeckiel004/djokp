<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $userType;
    public $changes;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation, string $userType, array $changes = [])
    {
        $this->reservation = $reservation;
        $this->userType = $userType;
        $this->changes = $changes;
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
                $subject = 'Confirmation de modification - Réservation ' . $this->reservation->reference;
                $view = 'emails.reservations.updated-client';
                break;

            case 'admin':
                $subject = 'Mise à jour de réservation #' . $this->reservation->reference;
                $view = 'emails.reservations.updated-admin';
                break;
        }

        return $this->markdown($view)
            ->subject($subject)
            ->with([
                'reservation' => $this->reservation,
                'changes' => $this->changes,
            ]);
    }
}
