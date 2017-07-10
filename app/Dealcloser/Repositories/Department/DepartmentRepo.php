<?php

namespace App\Dealcloser\Repositories\Department;

use App\Dealcloser\Core\Department\Department;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Dealcloser\Repositories\EloquentRepo;

class DepartmentRepo extends EloquentRepo implements IDepartmentRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Department::class;
    }

    /**
     * A department has users.
     *
     * @return bool
     */
    public function hasUsers($id)
    {
        return $this->_model->find($id)->users()->count() > 0;
    }
}
