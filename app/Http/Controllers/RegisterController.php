<?php

/**
 * @file
 * FIFACLUB RegisterController
 *
 * @package Http
 * @subpackage Controllers
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Http\Controllers;

use App\Contracts\Repositories\ActiveRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserRegistration;
use App\Traits\TraitResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use TraitResponse;

    /**
     * UserRepository instance.
     *
     * @var object
     */
    private $userRepository;

    /**
     * ActiveRepository instance.
     *
     * @var object
     */
    private $activeRepository;

    /**
     * Create a new RegisterController instance.
     *
     * @param object $userRepository
     *   userRespository.
     * @param object $activeRepository
     *   activeRepository.
     */
    public function __construct(UserRepositoryInterface $userRepository, ActiveRepositoryInterface $activeRepository)
    {
        $this->userRepository = $userRepository;
        $this->activeRepository = $activeRepository;
    }

    /**
     * Register new user.
     *
     * @param object $request
     *   Request.
     * @return string
     */
    public function register(UserRegistration $request)
    {
        $user = $this->userRepository->create($request->all());
        $notActive = $this->activeRepository->create(['user_id' => $user->id, 'token' => str_random(64)]);
        $email = $user->send($user->email, 'RegistrationUser', array_merge($user->toArray(), $notActive->toArray()));

        return $this->jsonResponse('registration.success');
    }

    /**
     * Confirm new user account
     *
     * @param object $request
     *   Request.
     * @return string
     */
    public function confirm(Request $request)
    {
        $token = $request->get('token');
        if (empty($token)) {
            return $this->jsonResponse('registration.accountConfirmationTokenEmpty');
        }

        $notActive = $this->activeRepository->findByToken($token);

        if (!empty($notActive)) {
            $edit = $this->userRepository->edit($notActive->user_id, ['active' => 1]);
            $delete = $this->activeRepository->delete($notActive->id);
        }

        return (!empty($edit) && !empty($delete)) ? $this->jsonResponse('registration.accountConfirmationSuccess')
        : $this->jsonResponse('registration.accountConfirmationTokenFailed');
    }
}
