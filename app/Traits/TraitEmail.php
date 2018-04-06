<?php

/**
 * @file
 * FifaClub Email trait.
 *
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */

namespace App\Traits;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

trait TraitEmail
{
    /**
     * Function to send email.
     */
    public function send(string $to, Mailable $mailable, array $variables)
    {
        Mail::to($to)->send($mailable);
        if (count(Mail::failures()) > 0) {
            return false;
        }

        return true;
    }
}
