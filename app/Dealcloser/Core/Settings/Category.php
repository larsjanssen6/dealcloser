<?php

namespace App\Dealcloser\Core\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Permission;

class Category extends Model
{
    protected $table = 'category_permissions';

    protected $with = ['permissions'];

    protected $fillable = ['name'];

    /**
     * A category belongs to many permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'category_permissions_id');
    }
}
