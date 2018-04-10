<?php

/**
 * @file
 * FIFACLUB RegistrationUser Mailable.
 *
 * @package Mail
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationUser extends Mailable
{
    use Queueable, SerializesModels;

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
                    ->subject('Witamy na portalu ' . env('APP_NAME'))
                    ->view('emails.registration.user')
                    ->with($this->userInformation);
    }
}
