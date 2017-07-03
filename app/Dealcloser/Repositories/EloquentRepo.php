<?php

namespace App\Dealcloser\Repositories;

use App\Dealcloser\Interfaces\Repositories\RepoInterface;
use stdClass;

abstract class EloquentRepo implements RepoInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Get model.
     * @return string
     */
    abstract protected function getModel();

    /**
     * Set model.
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * Find
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->findBy('id', $id);
    }

    /**
     * Find by column and value
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findBy($column, $value)
    {
        return $this->_model->where($column, $value)->first();
    }

    /**
     * Check if value exists
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function exists($column, $value)
    {
        return $this->_model->where($column, $value)->exists();
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);

        if($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);

        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function make(array $with = [])
    {
        return $this->_model->with($with);
    }

    /**
     * Return all results that have a required relationship.
     *
     * @param string $relation
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function has($relation, array $with = [])
    {
        $entity = $this->make($with);

        return $entity->has($relation)->get();
    }

    /**
     * Get Results by Page.
     *
     * @param int $page
     * @param int $limit
     * @param array $with
     * @return StdClass Object with $items and $totalItems for pagination
     */
    public function paginate($page = 1, $limit = 10, $with = [])
    {
        $result = new StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = [];

        $query = $this->make($with);

        $model = $query
            ->skip($limit * ($page - 1))
            ->take($limit)
            ->get();

        $result->totalItems = $this->_model->count();
        $result->items = $model->all();

        return $result;
    }
}