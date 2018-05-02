<?php

/**
 * @file
 * FIFACLUB UserRegistration Requests.
 *
 * @package Http
 * @subpackage Requests
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistration extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'team_id' => 'required',
            'nick' => 'required|unique:users',
            'nick_game' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password',
        ];
    }
}
