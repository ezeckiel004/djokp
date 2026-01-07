<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationStatusUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $statusLabels;
    public $serviceTypes;

    /**
     * Create a new message instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;

        // Labels des statuts
        $this->statusLabels = [
            'pending' => 'En attente',
            'confirmed' => 'Confirmé',
            'in_progress' => 'En cours',
            'completed' => 'Terminé',
            'cancelled' => 'Annulé'
        ];

        // Labels des types de service
        $this->serviceTypes = [
            'transfert' => 'Transfert aéroport/gare',
            'professionnel' => 'Déplacement professionnel',
            'evenement' => 'Événement/mariage',
            'mise_disposition' => 'Mise à disposition'
        ];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = $this->getSubject();

        return $this->subject($subject)
            ->view('emails.reservation-status-updated')
            ->with([
                'reservation' => $this->reservation,
                'statusLabel' => $this->statusLabels[$this->reservation->status] ?? $this->reservation->status,
                'serviceLabel' => $this->serviceTypes[$this->reservation->type_service] ?? $this->reservation->type_service,
                'statusLabels' => $this->statusLabels,
                'serviceTypes' => $this->serviceTypes,
            ]);
    }

    /**
     * Get the email subject based on status.
     */
    private function getSubject()
    {
        $status = $this->reservation->status;
        $reference = $this->reservation->reference;

        $subjects = [
            'pending' => "Votre réservation #{$reference} est en attente de confirmation",
            'confirmed' => "Confirmation de votre réservation #{$reference} - DJOK PRESTIGE VTC",
            'in_progress' => "Votre service VTC #{$reference} est en cours",
            'completed' => "Votre service VTC #{$reference} est terminé - DJOK PRESTIGE",
            'cancelled' => "Annulation de votre réservation #{$reference} - DJOK PRESTIGE VTC"
        ];

        return $subjects[$status] ?? "Mise à jour de votre réservation #{$reference} - DJOK PRESTIGE VTC";
    }
}
