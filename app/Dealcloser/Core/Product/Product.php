<?php

namespace App\Dealcloser\Core\Product;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use App\Dealcloser\Traits\Calculatable;
use Illuminate\Database\Eloquent\Model;
use App\Dealcloser\Logic\ProductCalculation;

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
        'amount',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['revenue', 'totalPurchase', 'grossMargin'];

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
    public function calculate() : ProductCalculation
    {
        return new ProductCalculation();
    }
}