<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InscriptionStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->getSubject();

        return $this->subject($subject)
            ->view('emails.inscription-status-changed')
            ->with('data', $this->data);
    }

    private function getSubject()
    {
        $statusLabels = [
            'pending' => 'en attente',
            'confirmed' => 'confirmée',
            'in_progress' => 'en cours',
            'completed' => 'terminée',
            'cancelled' => 'annulée',
            'created' => 'créée',
            'deleted' => 'supprimée',
        ];

        $status = $this->data['status'] ?? $this->data['action'];
        $statusText = $statusLabels[$status] ?? $status;

        if (isset($this->data['is_resend']) && $this->data['is_resend']) {
            return 'Rappel : Mise à jour de votre inscription - ' . $this->data['formation_title'];
        } elseif ($this->data['action'] === 'created') {
            return 'Confirmation de votre inscription - ' . $this->data['formation_title'];
        } elseif ($this->data['action'] === 'deleted') {
            return 'Annulation de votre inscription - ' . $this->data['formation_title'];
        } else {
            return 'Mise à jour de votre inscription - Statut: ' . $this->data['new_status'];
        }
    }
}
