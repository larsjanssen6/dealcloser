<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dealcloser\Repositories\Role\RoleRepo;
use App\Dealcloser\Repositories\User\UserRepo;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Repositories\Category\CategoryRepo;
use App\Dealcloser\Repositories\Relation\RelationRepo;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;
use App\Dealcloser\Repositories\Department\DepartmentRepo;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;

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
        $this->app->singleton(ICategoryRepo::class, CategoryRepo::class);
        $this->app->singleton(IRelationRepo::class, RelationRepo::class);
        $this->app->singleton(IUserRepo::class, UserRepo::class);
        $this->app->singleton(IRoleRepo::class, RoleRepo::class);
        $this->app->singleton(IDepartmentRepo::class, DepartmentRepo::class);
    }
}
