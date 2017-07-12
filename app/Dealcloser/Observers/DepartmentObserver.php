<?php

namespace App\Dealcloser\Observers;

use App\Dealcloser\Core\Department\Department;
use Illuminate\Cache\Repository as CacheRepository;

class DepartmentObserver
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
     * Listen to the Department created event.
     *
     * @param Department $department
     * @return void
     */
    public function created(Department $department)
    {
        $this->cache->tags(Department::class)->flush();
    }

    /**
     * Listen to the Department updated event.
     *
     * @param Department $department
     * @return void
     */
    public function updated(Department $department)
    {
        $this->cache->tags(Department::class)->flush();
    }

    /**
     * Listen to the Department deleting event.
     *
     * @param Department $department
     * @return void
     */
    public function deleting(Department $department)
    {
        $this->cache->tags(Department::class)->flush();
    }
}