<?php

namespace App\Dealcloser\Observers;

use Spatie\Permission\Models\Role;
use Illuminate\Cache\Repository as CacheRepository;

class RoleObserver
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
     * Listen to the Role created event.
     *
     * @param Role $role
     * @return void
     */
    public function created(Role $role)
    {
        $this->cache->tags(Role::class)->flush();
    }

    /**
     * Listen to the Role updated event.
     *
     * @param Role $role
     * @return void
     */
    public function updated(Role $role)
    {
        $this->cache->tags(Role::class)->flush();
    }

    /**
     * Listen to the Role deleting event.
     *
     * @param Role $role
     * @return void
     */
    public function deleting(Role $role)
    {
        $this->cache->tags(Role::class)->flush();
    }
}
