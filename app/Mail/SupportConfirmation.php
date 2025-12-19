<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Create a new message instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Confirmation de votre demande de support - DJOK PRESTIGE')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.reply_to.address', 'support@djokprestige.com'))
            ->view('emails.support-confirmation');
    }
}
