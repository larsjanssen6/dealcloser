<?php

namespace App\Dealcloser\Repositories\Relation;

use App\Dealcloser\Core\Relation\Relation;
use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;

class RelationRepo extends EloquentRepo implements IRelationRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Relation::class;
    }
}
