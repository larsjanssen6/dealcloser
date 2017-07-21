<?php

namespace App\Dealcloser\Core\User;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Dealcloser\Core\Department\Department;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,
        HasRoles,
        HasSlug;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'preposition',
        'last_name',
        'email',
        'password',
        'function',
        'department_id',
        'role',
        'active',
        'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'confirmation_code',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['fullName'];

    /**
     * Return full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name.($this->preposition == null ? '' : ' '.$this->preposition).' '.$this->last_name;
    }

    /**
     * Check if user is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active == 1;
    }

    /**
     * A user has one department.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department() : belongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
