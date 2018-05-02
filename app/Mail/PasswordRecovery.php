<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordRecovery extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Holds user information.
     *
     * @var array
     */
    private $userInformation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $userInformation)
    {
        $this->userInformation = $userInformation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->from(env('MAIL_FROM'))
                    ->subject('Odzyskiwanie hasła - ' . env('APP_NAME'))
                    ->view('emails.users.passwordRecovery')
                    ->with($this->userInformation);
    }
}
