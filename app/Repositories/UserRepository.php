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
}