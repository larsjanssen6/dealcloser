<?php

namespace App\Dealcloser\Repositories\Role;

use Spatie\Permission\Models\Role;
use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;

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
