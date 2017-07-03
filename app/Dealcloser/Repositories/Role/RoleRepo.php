<?php

namespace App\Dealcloser\Repositories\Role;

use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Dealcloser\Repositories\EloquentRepo;
use Spatie\Permission\Models\Role;

class RoleRepo extends EloquentRepo implements IRoleRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Role::class;
    }
}

