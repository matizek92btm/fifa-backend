<?php

/**
 * @file
 * FifaCLub Active Repository.
 *
 * @package Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Repositories;

use App\Abstracts\Repositories\AbstractRepository;
use App\Contracts\Repositories\ActiveRepositoryInterface;

class ActiveRepository extends AbstractRepository implements ActiveRepositoryInterface
{
    /**
     * Model name for Role Repository.
     *
     * @return string
     */
    public function getModelName()
    {
        return 'App\Models\Active';
    }

    /**
     * Find activation by token.
     *
     * @param string $token
     * @return object
     *   Collection.
     */
    public function findByToken(string $token)
    {
        return $this->model->where('token', $token)->first();
    }
}
