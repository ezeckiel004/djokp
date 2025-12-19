<?php

namespace App\Mail;

use App\Models\Formation;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ElearningPurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $formation;
    public $paiement;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Formation $formation, Paiement $paiement, ?User $user = null)
    {
        $this->formation = $formation;
        $this->paiement = $paiement;
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmation d\'achat - Formation ' . $this->formation->title . ' | DJOK PRESTIGE')
            ->view('emails.elearning-purchase-confirmation')
            ->with([
                'formation' => $this->formation,
                'paiement' => $this->paiement,
                'user' => $this->user,
            ]);
    }
}
