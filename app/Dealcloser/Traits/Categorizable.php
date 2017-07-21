<?php

namespace App\Dealcloser\Traits;

use App\Dealcloser\Core\Category\Category;

trait Categorizable
{
    /**
     * Make model categorizable.
     *
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
