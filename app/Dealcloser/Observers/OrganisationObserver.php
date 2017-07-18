<?php

namespace App\Dealcloser\Observers;

use App\Dealcloser\Core\Organisation\Organisation;
use Illuminate\Cache\Repository as CacheRepository;

class OrganisationObserver
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
     * Listen to the Organisation created event.
     *
     * @param Organisation $organisation
     * @return void
     */
    public function created(Organisation $organisation)
    {
        $this->cache->tags(Organisation::class)->flush();
    }

    /**
     * Listen to the Organisation updated event.
     *
     * @param Organisation $organisation
     * @return void
     */
    public function updated(Organisation $organisation)
    {
        $this->cache->tags(Organisation::class)->flush();
    }

    /**
     * Listen to the Organisation deleting event.
     *
     * @param Organisation $organisation
     * @return void
     */
    public function deleting(Organisation $organisation)
    {
        $this->cache->tags(Organisation::class)->flush();
    }
}
