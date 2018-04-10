<?php

/**
 * @file
 * FIFACLUB Token trait.
 *
 * @package Traits
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */
namespace App\Traits;

trait TraitToken
{
    /**
     * Function to get user token.
     *
     * @param string $email
     *   User email.
     * @param string password
     *  User password - no HASH.
     *
     * @return object 
     *   Return user token and refresh token if user login informations are correct. 
     *   Return error when user login information are incorrect.
     */
    public function getUserTokens(string $email, string $password)
    {
        $http = new \GuzzleHttp\Client;
        
        try {
            $response = $http->post(env('API_URL') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => env('GRANT_CLIENT_ID'),
                    'client_secret' => env('GRANT_CLIENT_SECRET'),
                    'username' => $email,
                    'password' => $password,
                    'scope' => '*',
                ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }

        return json_decode((string) $response->getBody(), false);
    }
}
