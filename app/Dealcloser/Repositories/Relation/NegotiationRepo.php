<?php

namespace App\Dealcloser\Repositories\Relation;

use App\Dealcloser\Core\Relation\Negotiation;
use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Interfaces\Repositories\INegotiationRepo;

class NegotiationRepo extends EloquentRepo implements INegotiationRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Negotiation::class;
    }
}
