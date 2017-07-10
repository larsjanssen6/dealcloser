<?php

namespace App\Dealcloser\Core\Relation;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Dealcloser\Traits\Categorizable;

class Relation extends Model
{
    use HasSlug, Categorizable;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'relation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'account_manager',
        'organisation',
        'country_code',
        'state_code',
        'street',
        'house_number',
        'sales_area',
        'zip',
        'town',
        'phone',
        'email',
        'linkedin',
        'website',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('organisation')
            ->saveSlugsTo('slug');
    }
}
