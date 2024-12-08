<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $username, $verify_code)
    {
        $this->email = $email;
        $this->verify_code  = $verify_code;  
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Password')
                ->markdown('mails.reset_password', [
                    'url' => url('/')."/forgot/$this->email/$this->verify_code",
                ])
                ->with('username', $this->username);
    }
}
