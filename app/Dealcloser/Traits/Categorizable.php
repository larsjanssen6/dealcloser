<?php

namespace App\Dealcloser\Traits;

use App\Dealcloser\Core\Category\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Categorizable
{
    /**
     * Make model categorizable.
     *
     * @return mixed
     */
    public function category() : belongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
