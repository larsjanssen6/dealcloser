<?php

namespace App\Dealcloser\Observers;

use App\Dealcloser\Core\Relation\Relation;
use Illuminate\Cache\Repository as CacheRepository;

class RelationObserver
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
     * Listen to the Relation created event.
     *
     * @param Relation $relation
     * @return void
     */
    public function created(Relation $relation)
    {
        $this->cache->tags(Relation::class)->flush();
    }

    /**
     * Listen to the Relation updated event.
     *
     * @param Relation $relation
     * @return void
     */
    public function updated(Relation $relation)
    {
        $this->cache->tags(Relation::class)->flush();
    }

    /**
     * Listen to the Relation deleting event.
     *
     * @param Relation $relation
     * @return void
     */
    public function deleting(Relation $relation)
    {
        $this->cache->tags(Relation::class)->flush();
    }
}
