<?php

namespace App\Dealcloser\Core\Product;

use App\Dealcloser\Logic\ProductCalculation;
use App\Dealcloser\Traits\Calculatable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasSlug, Calculatable;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'purchase',
        'license',
        'days'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Return product calculation instance.
     *
     * @return ProductCalculation
     */
    public function calculate()
    {
        return new ProductCalculation();
    }
}
