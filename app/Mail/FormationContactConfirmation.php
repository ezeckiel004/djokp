<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormationContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ContactMessage $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('Demande d\'information formation reçue - DJOK PRESTIGE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo('formation@djokprestige.com')
            ->view('emails.formation-contact-confirmation');
    }
}
