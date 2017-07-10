<?php

namespace App\Dealcloser\Repositories\Category;

use App\Dealcloser\Core\Settings\Category;
use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;

class CategoryRepo extends EloquentRepo implements ICategoryRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Category::class;
    }
}
