<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly string $payerEmail,
    )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order From Larapay',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: 'mails.new-order',
            with: [
                "email" => $this->payerEmail,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
