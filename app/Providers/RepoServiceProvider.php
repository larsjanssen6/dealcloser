<?php

namespace App\Providers;

use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Dealcloser\Interfaces\Repositories\IRelationRepo;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Repositories\Category\CategoryRepo;
use App\Dealcloser\Repositories\Department\DepartmentRepo;
use App\Dealcloser\Repositories\Relation\RelationRepo;
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
        $this->app->bind(ICategoryRepo::class, CategoryRepo::class);
        $this->app->bind(IRelationRepo::class, RelationRepo::class);
        $this->app->bind(IUserRepo::class, UserRepo::class);
        $this->app->bind(IRoleRepo::class, RoleRepo::class);
        $this->app->bind(IDepartmentRepo::class, DepartmentRepo::class);
    }
}
