<?php

/**
 * @file
 * FIFACLUB Response trait.
 *
 * @package Traits
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */

namespace App\Traits;

use Illuminate\Http\Response;

trait TraitResponse
{
    /**
     * Function to return jsonResponse.
     *
     * @param array $data
     *   Reponse data.
     * @param string $type
     *   Reponse type.
     *
     * @return JSON
     */
    public function jsonResponse(string $responseText, string $status = 'SUCCESS_OK', array $stringBody = [])
    {
        return response()->json(['responseText' => __($responseText), 'responseBody' => $stringBody], config('constants.' . $status));
    }
}
