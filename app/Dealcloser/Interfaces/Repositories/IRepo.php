<?php

namespace App\Dealcloser\Interfaces\Repositories;

interface IRepo
{
    /**
     * Get all.
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get one.
     *
     * @param $id
     *
     * @return mixed
     */
    public function find($id);

    /**
     * @param $column
     * @param $value
     *
     * @return mixed
     */
    public function findBy($column, $value);

    /**
     * @param $column
     * @param $value
     * @param $with
     *
     * @return mixed
     */
    public function findAll($column, $value, $with);

    /**
     * Create.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update.
     *
     * @param $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete.
     *
     * @param $id
     *
     * @return mixed
     */
    public function delete($id);
}
