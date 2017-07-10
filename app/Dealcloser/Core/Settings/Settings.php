<?php

namespace App\Dealcloser\Core\Settings;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'description',
        'address',
        'zip',
        'city',
        'kvk',
        'btw',
        'users',
        'domain',
        'active',
        'license',
    ];

    public function scopeSet($query, $data)
    {
        $query->first();
        $query->update($data);
        Cache::flush('settings');
    }
}
