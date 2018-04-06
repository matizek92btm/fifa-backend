<?php

/**
 * @file
 * FifaClub Email trait.
 *
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */

namespace App\Traits;

use Illuminate\Support\Facades\Mail;

trait TraitEmail
{
    /**
     * All type of emails.
     *
     * @var array
     */
    private $mailable = [
        'RegistrationUser' => 'App\Mail\RegistrationUser',
    ];

    /**
     * Function to send email.
     */
    public function send(string $to, string $mailableName, array $variables)
    {
        if (!isset($this->mailable[$mailableName])) {
            throw new \Exception("Mailable $mailableName not exists");
        } 
        $qualifiedName = $this->mailable[$mailableName];
        Mail::to($to)->send(new $qualifiedName($variables));

        if (count(Mail::failures()) > 0) {
            return false;
        }

        return true;
    }
}
