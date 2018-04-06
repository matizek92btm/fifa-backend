<?php

/**
 * @file
 * FifaCLub Role Repository.
 * 
 * @package Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Repositories;

use App\Abstracts\Repositories\AbstractRepository;
use App\Contracts\Repositories\RoleRepositoryInterface;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{   
    /**
     * Model name for Role Repository.
     *
     * @return string
     */
    public function getModelName()
    {
        return 'App\Models\Role';
    }
}