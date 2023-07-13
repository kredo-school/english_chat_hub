<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-us')
        ->subject('Thank you for contacting us')
        ->with([
            'name'          => $this->contact['name'],
            'email'         => $this->contact['email'],
            'title'         => $this->contact['title'],
            'content'       => $this->contact['content'],
            'subtitle'      => $this->contact->subtitle->name,
            'rating'        => $this->contact->rating,
        ]);
    }
}
