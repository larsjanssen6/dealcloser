<?php

namespace App\Providers;

use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Dealcloser\Interfaces\Repositories\IRepo;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Repositories\Department\DepartmentRepo;
use App\Dealcloser\Repositories\EloquentCacheRepo;
use App\Dealcloser\Repositories\EloquentRepo;
use App\Dealcloser\Repositories\Role\RoleRepo;
use App\Dealcloser\Repositories\User\UserRepo;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepo::class, UserRepo::class);
        $this->app->bind(IRoleRepo::class, RoleRepo::class);
        $this->app->bind(IDepartmentRepo::class, DepartmentRepo::class);
    }
}
