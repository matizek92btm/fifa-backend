<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ActiveRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Notifications\UserRegistration;
use Illuminate\Http\Request;
use App\Mail\RegistrationUser;

class RegisterController extends Controller
{
    private $userRepository;
    private $activeRepository;

    public function __construct(UserRepositoryInterface $userRepository, ActiveRepositoryInterface $activeRepository)
    {
        $this->userRepository = $userRepository;
        $this->activeRepository = $activeRepository;
    }

    /**
     * Register new user.
     *
     * @param object $request
     * @return JSON
     */
    public function register(Request $request)
    {   
        $user = $this->userRepository->create($request->all());
        $user->assignRole('User');
        $prepareActivation = $this->activeRepository->create(['user_id' => $user->id, 'token' => str_random(64)]);
        $email = $user->send($user->email, new RegistrationUser, $prepareActivation->toArray());
    }
}
