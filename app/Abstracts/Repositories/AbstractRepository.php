<?php

/**
 * @file
 * Abstract Repository.
 *
 * @package Abstracts
 * @subpackage Repositories
 * @author Mateusz Kaleta <mateusz.kaleta92@gmail.com>
 */

namespace App\Abstracts\Repositories;

use App\Contracts\Repositories\RepositoryInterface;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * Model instance.
     *
     * @var object Model instance.
     */
    protected $model;

    /**
     * Container instrance.
     *
     * @var object Container instance.
     */
    private $app;

    /**
     * Initialize Repository class.
     *
     * @param object Container $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->model = $this->makeModel();
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    abstract public function getModelName();

    /**
     * Create model object.
     *
     * @return object
     *   Model instance.
     * @throws Exception
     */
    public function makeModel()
    {
        $model = $this->app->make($this->getModelName());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Create new values in database for Model instance.
     *
     * @param array $columnsValues
     *   Array where keys represent columns in database and values represent new value for column.
     * @return object
     *   New created model instance.
     * @throws Exception
     */
    public function create(array $columnsValues)
    {
        $model = new $this->model;

        foreach ($columnsValues as $column => $value) {
            $model->$column = $value;
        }

        $result = $model->save();

        if (!$result) {
            throw new \Exception("There was some problem with database. Please contact with administrator.");
        }

        return $model;
    }

    /**
     * Returns all values in database for Model instance.
     *
     * @return object
     *   Collections.
     */
    public function getAll()
    {
        return $this->model->get();
    }

    /**
     * Returns values from database based on id for Model instance
     *
     * @param integer $id
     *   Id.
     * @return object
     *   Collections
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }
}
