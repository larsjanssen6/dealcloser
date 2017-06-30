<?php

namespace App\Dealcloser\Core\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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
