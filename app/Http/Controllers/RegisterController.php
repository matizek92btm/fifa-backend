<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ActiveRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Mail\RegistrationUser;
use App\Http\Requests\UserRegistration;
use Illuminate\Http\Response;

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
    public function register(UserRegistration $request)
    {
        $user = $this->userRepository->create($request->all());
        $notActive = $this->activeRepository->create(['user_id' => $user->id, 'token' => str_random(64)]);
        $email = $user->send($user->email, new RegistrationUser, $notActive->toArray());
        
        return response()->json($user,200);
    }
}
