<?php

/**
 * @file
 * FIFACLUB UserController
 *
 * @package Http
 * @subpackage Controllers
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Http\Controllers;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Traits\TraitResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use TraitResponse;

    /**
     * UserRepository instance.
     *
     * @var object
     */
    private $userRepository;

    /**
     * New instance of UserController.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->userRepository = $user;
    }

    /**
     * Password recovery.
     *
     * @param Request $request
     * @return string
     */
    public function passwordRecovery(Request $request)
    {
        $user = $this->userRepository->findByEmail($request->email);

        if ($user) {
            $token = str_random(64);
            $user->token = $token;

            //Only new token is correct.
            $deleteOldPasswordRecovery = $this->userRepository->deletePasswordRecovery($user->email);
            $passwordRecovery = $this->userRepository->passwordRecovery($user->email, $token);
            $email = $user->send($user->email, 'PasswordRecovery', $user->toArray());
            
            return $this->jsonResponse('user.passswordRecoveryDone');
        }

        return $this->jsonResponse('user.passwordRecoveryBadEmail');
    }

    /**
     * Change user password.
     *
     * @param Request $request
     * @return void
     */
    public function passwordChange(Request $request)
    {
        $token = $request->token;
        $password = $request->password;

        $passwordRecovery = $this->userRepository->findEmailByPasswordRecoveryToken($token);

        if ($passwordRecovery) {
            $userId = $this->userRepository->findByEmail($passwordRecovery->email)->id;
            $editPassword = $this->userRepository->edit($userId, ['password' => $password]);
            $deletePasswordRecovery = $this->userRepository->deletePasswordRecovery($passwordRecovery->email);

            return $this->jsonResponse('user.passwordChangeDone');
        }

        return $this->jsonResponse('user.passwordChangeFailToken');
    }
}
