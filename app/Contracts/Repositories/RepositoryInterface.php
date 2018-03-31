<?php

/**
 * @file
 * Basic interface for all repositories.
 *
 * @package Contracts
 * @subpackage Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Contracts\Repositories;

interface RepositoryInterface
{
    /**
     * Create new values in database for Model instance.
     *
     * @param array $columnsValues
     *   Array with key as columns in database, values as new value for column.
     * @return Model
     *   Model.
     */
    public function create(array $columnsValues);

    /**
     * Returns all values from database for Model instance.
     *
     * @return Collections
     */
    public function getAll();
}
