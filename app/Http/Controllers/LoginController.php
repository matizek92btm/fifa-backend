<?php

/**
 * @file
 * FIFACLUB LoginController
 *
 * @package Http
 * @subpackage Controllers
 * @author Mateusz Kaleta <kaleta@gdziezjemfit.pl>
 */

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Traits\TraitResponse;
use App\Traits\TraitToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use TraitResponse;
    use TraitToken;

    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    public function login(Request $request)
    {
        $auth = $this->getUserTokens($request->email, $request->password);
        if (!isset($auth->error)) {
            $user = $this->userRepository->findByEmail($request->email);
            if (!$user->active) {
                return $this->jsonResponse();
            }

            return $this->jsonResponse('registration.accountConfirmationSuccess', 'SUCCESS_OK', array_merge($user->toArray(), (array) $auth));
        }

        return $this->jsonResponse('login.account');
    }
}
