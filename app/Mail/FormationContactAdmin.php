<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormationContactAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ContactMessage $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('📚 Nouvelle demande formation - ' . $this->contact->nom . ' #' . $this->contact->id)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('emails.formation-contact-admin');
    }
}
