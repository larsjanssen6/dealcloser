<?php

namespace App\Dealcloser\Core\Department;

use App\Dealcloser\Core\User\User;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * A department belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
