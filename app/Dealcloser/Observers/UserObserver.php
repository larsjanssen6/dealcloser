<?php

namespace App\Dealcloser\Observers;

use App\Dealcloser\Core\User\User;
use Illuminate\Cache\Repository as CacheRepository;

class UserObserver
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
     * Listen to the User created event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $this->cache->tags(User::class)->flush();
    }

    /**
     * Listen to the User updated event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->cache->tags(User::class)->flush();
    }

    /**
     * Listen to the User deleting event.
     *
     * @param User $user
     * @return void
     */
    public function deleting(User $user)
    {
        $this->cache->tags(User::class)->flush();
    }
}