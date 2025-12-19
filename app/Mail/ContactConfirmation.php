<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactMessage $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmation de réception - DJOK PRESTIGE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.reply_to.address', 'contact@djokprestige.com'))
            ->view('emails.contact-confirmation');
    }
}
