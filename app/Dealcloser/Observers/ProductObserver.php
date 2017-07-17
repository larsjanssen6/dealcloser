<?php

namespace App\Dealcloser\Observers;

use App\Dealcloser\Core\Product\Product;
use Illuminate\Cache\Repository as CacheRepository;

class ProductObserver
{
    /**
     * Cache repo.
     *
     * @var
     */
    protected $cache;

    /**
     * Create a new repo instance.
     *
     * @param CacheRepository $cache
     */
    public function __construct(CacheRepository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Listen to the Product created event.
     *
     * @param Product $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->cache->tags(Product::class)->flush();
    }

    /**
     * Listen to the Product updated event.
     *
     * @param Product $product
     * @return void
     */
    public function updated(Product $product)
    {
        $this->cache->tags(Product::class)->flush();
    }

    /**
     * Listen to the Product deleting event.
     *
     * @param Product $product
     * @return void
     */
    public function deleting(Product $product)
    {
        $this->cache->tags(Product::class)->flush();
    }
}
