<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmailAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $token1;

    public function __construct($token1)
    {
        $this->token1 = $token1;
    }

    public function build()
    {
        return $this->subject('Email Verification')->view('email.verify1')->with([
            'token' => $this->token1,
        ]);
    }
}
