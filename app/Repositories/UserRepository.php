<?php

/**
 * @file
 * FifaCLub User Repository.
 *
 * @package Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Repositories;

use App\Abstracts\Repositories\AbstractRepository;
use App\Contracts\Repositories\UserRepositoryInterface;
use Carbon\Carbon;
use DB;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    /**
     * Model name for User Repository.
     *
     * @return string
     */
    public function getModelName()
    {
        return 'App\Models\User';
    }

    /**
     * Returns user by email.
     *
     * @param string $email
     * @return object
     *   User.
     */
    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Add token and user email to password_resets table.
     * @param string $email
     * @param string $token
     *
     * @return object
     */
    public function passwordRecovery(string $email, string $token)
    {
        return DB::table('password_resets')->insert([
            ['email' => $email, 'token' => $token, 'created_at' => Carbon::now()],
        ]);
    }

    /**
     * Search user email in password_resets table.
     *
     * @param string $token
     * @return object
     */
    public function findEmailByPasswordRecoveryToken(string $token)
    {
        return DB::table('password_resets')->select('email')->where('token', $token)->first();
    }

    /**
     * Delete user information from password_resets table.
     *
     * @param string $email
     * @return object
     */
    public function deletePasswordRecovery(string $email)
    {
        return DB::table('password_resets')->where('email', $email)->delete();
    }
}
