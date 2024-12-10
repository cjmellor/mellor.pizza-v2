<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ContactMessageMail extends Mailable
{
    public function __construct(protected $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->data['contact_email'])],
            subject: config('mail.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact-message-mail',
            with: [
                'name' => $this->data['contact_name'],
                'message' => $this->data['contact_message'],
            ],
        );
    }
}
