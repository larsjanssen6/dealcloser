<?php

namespace App\Dealcloser\Repositories\Organisation;

use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Core\Organisation\Organisation;
use App\Dealcloser\Interfaces\Repositories\IOrganisationRepo;

class OrganisationRepo extends EloquentRepo implements IOrganisationRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Organisation::class;
    }
}
