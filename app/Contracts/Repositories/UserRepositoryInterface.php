<?php

/**
 * @file
 * FIFACLUB Interface for userRepository
 *
 * @package Contracts
 * @subpackage Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{   
    /**
     * Returns user by email. 
     *
     * @param string $email
     * @return object
     *   User.
     */
    public function findByEmail(string $email);
}
