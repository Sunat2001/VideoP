<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $otp,
    ){}


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to our platform',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.welcome_new_user',
            with: [
                'otp' => $this->otp,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
