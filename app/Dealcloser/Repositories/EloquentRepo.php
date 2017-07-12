<?php

namespace App\Dealcloser\Repositories;

use App\Dealcloser\Interfaces\Repositories\IRepo;
use Illuminate\Cache\Repository as CacheRepository;

abstract class EloquentRepo implements IRepo
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * Cache repo.
     *
     * @var
     */
    protected $cache;

    /**
     * Create a new repo instance.
     *
     * @param CacheRepository $cache
     */
    public function __construct(CacheRepository $cache)
    {
        $this->setModel();
        $this->cache = $cache;
    }

    /**
     * Get model.
     *
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
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($with = [])
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|get-all|', 60, function () use ($with) {
            return $this->_model->with($with)->get();
        });
    }

    /**
     * Find.
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|find|'.$id, 60, function () use ($id) {
            return $this->findBy('id', $id);
        });
    }

    /**
     * Find first by column and value.
     *

     * @param $column
     * @param $value
     *
     * @return mixed
     */
    public function findBy($column, $value)
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|find_by|'.$column.'|'.$value, 60, function () use ($column, $value) {
            return $this->_model->where($column, $value)->first();
        });
    }

    /**
     * Find all by column and value.
     *
     * @param $column
     * @param $value
     * @param array $with
     *
     * @return mixed
     */
    public function findAll($column, $value, $with = [])
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|find_all|'.$column.'|'.$value, 60, function () use ($column, $value, $with) {
            return $this->_model->where($column, $value)->with($with)->get();
        });
    }

    /**
     * Check if value exists.
     *
     * @param $column
     * @param $value
     *
     * @return mixed
     */
    public function exists($column, $value)
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|exists|'.$column.'|'.$value, 60, function () use ($column, $value) {
            return $this->_model->where($column, $value)->exists();
        });
    }

    /**
     * Create.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update.
     *
     * @param $id
     * @param array $attributes
     *
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);

        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    /**
     * Delete.
     *
     * @param $id
     *
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);

        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * Count total records.
     *
     * @return mixed
     */
    public function count()
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|count|', 60, function () use ($count) {
            return $this->_model->count();
        });
    }

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make(array $with = [])
    {
        return $this->_model->with($with);
    }

    /**
     * Return all results that have a required relationship.
     *
     * @param string $relation
     * @param array  $with
     *
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
     * @param array $with
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($page, $with = [])
    {
        return $this->cache->tags($this->getModel())->remember($this->getModel().'|paginate|'.$page, 60, function () use ($page, $with) {
            return $this->_model
                ->with($with)
                ->latest()
                ->paginate(10);
        });
    }
}
