<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private string $otp,
    ){}

    public function build()
    {
        return $this->markdown('mail.welcome_new_user')
            ->with([
                'otp' => $this->otp,
            ]);
    }
}
