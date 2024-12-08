<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSignUp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $verify_code)
    {
        $this->email = $email;
        $this->verify_code  = $verify_code;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Registration Successful')
               
                ->markdown('mails.signup', [
                    'url' => url('/')."/verify/$this->email/$this->verify_code",
                ]);

    }
}
