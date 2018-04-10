<?php

/**
 * @file
 * FIFACLUB Interface for activeRepository
 *
 * @package Contracts
 * @subpackage Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Contracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;

interface ActiveRepositoryInterface extends RepositoryInterface
{
    /**
     * Find activation by token.
     *
     * @param string $token
     * @return object
     *   Active.
     */
    public function findByToken(string $token);
}
