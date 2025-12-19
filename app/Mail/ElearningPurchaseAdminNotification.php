<?php

namespace App\Mail;

use App\Models\Formation;
use App\Models\Paiement;
use App\Models\User;
use App\Models\UserFormation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ElearningPurchaseAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $formation;
    public $paiement;
    public $user;
    public $userFormation;
    public $emailSent;

    /**
     * Create a new message instance.
     */
    public function __construct(Formation $formation, Paiement $paiement, ?User $user = null, ?UserFormation $userFormation = null, bool $emailSent = false)
    {
        $this->formation = $formation;
        $this->paiement = $paiement;
        $this->user = $user;
        $this->userFormation = $userFormation;
        $this->emailSent = $emailSent;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('NOUVEL ACHAT E-LEARNING - ' . $this->formation->title . ' | ' . $this->paiement->reference)
            ->view('emails.elearning-purchase-admin-notification')
            ->with([
                'formation' => $this->formation,
                'paiement' => $this->paiement,
                'user' => $this->user,
                'userFormation' => $this->userFormation,
                'emailSent' => $this->emailSent,
            ]);
    }
}
