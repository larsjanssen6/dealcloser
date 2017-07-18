<?php

namespace App\Dealcloser\Core\Organisation;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Traits\Categorizable;
use App\Dealcloser\Custom\BelongsToManyWithSyncEvent;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organisation extends Model
{
    use HasSlug, Categorizable, BelongsToManyWithSyncEvent;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'organisation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'account_manager',
        'name',
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
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * A organisation belongs to many products.
     *
     * @return BelongsToMany
     */
    public function products() : belongsToMany
    {
        return $this->belongsToMany(Product::class, 'organisation_has_products');
    }

    /**
     * Sync products with organisation.
     *
     * @param $products
     *
     * @return $this
     */
    public function syncProducts($products)
    {
        $this->products()->sync(collect($products)->pluck('id'));

        return $this;
    }
}
