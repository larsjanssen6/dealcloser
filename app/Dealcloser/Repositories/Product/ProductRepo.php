<?php

namespace App\Dealcloser\Repositories\Product;

use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Interfaces\Repositories\IProductRepo;

class ProductRepo extends EloquentRepo implements IProductRepo
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel()
    {
        return Product::class;
    }
}
