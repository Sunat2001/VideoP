<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected string $sendMail,
        protected string $otp,
    ){}


    /**
     * @throws \ReflectionException
     */
    public function handle(): void
    {
        $email = new WelcomeMail($this->otp);

        mail($this->sendMail, $email->subject, $email->render(), [
            'From: vid@185.4.75.69',
        ]);

//        Mail::to($this->sendMail)->send($email);
    }
}
