<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ActiveRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    private $userRepository;
    private $activeRepository;
    private $mailable;

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
        $email = $user->send($user->email, 'RegistrationUser', array_merge($user->toArray(), $notActive->toArray()));

        return response()->json($user, 200);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function confirm(Request $request)
    {
        $token = $request->get('token');
        if (!empty($token)) {
            $notActive = $this->activeRepository->findByToken($token);
            if (!empty($notActive)) {
                $edit = $this->userRepository->edit($notActive->user_id, ['active' => 1]);
                $delete = $this->activeRepository->delete($notActive->id);
            }
        }
    }
}
