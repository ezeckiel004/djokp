<?php

namespace App\Mail;

use App\Models\ElearningAcces;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ElearningAccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $acces;
    public $forfait;

    public function __construct(ElearningAcces $acces)
    {
        $this->acces = $acces;
        $this->forfait = $acces->forfait;
    }

    public function build()
    {
        return $this->subject('Vos codes d\'accès à la formation e-learning DJOK PRESTIGE')
            ->view('emails.elearning.access')
            ->with([
                'acces' => $this->acces,
                'forfait' => $this->forfait,
            ]);
    }
}
