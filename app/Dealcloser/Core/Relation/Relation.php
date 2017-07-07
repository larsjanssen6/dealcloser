<?php

namespace App\Dealcloser\Core\Relation;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Relation extends Model
{
    use HasSlug;
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
        'country',
        'state',
        'street',
        'house_number',
        'sales_area',
        'zip',
        'town',
        'phone',
        'email',
        'facebook',
        'whatsapp',
        'website'
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

