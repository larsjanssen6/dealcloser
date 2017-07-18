<?php

namespace App\Providers;

use App\Dealcloser\Core\User\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\ServiceProvider;
use App\Dealcloser\Core\Product\Product;
use App\Dealcloser\Observers\RoleObserver;
use App\Dealcloser\Observers\UserObserver;
use App\Dealcloser\Observers\ProductObserver;
use App\Dealcloser\Core\Department\Department;
use App\Dealcloser\Observers\DepartmentObserver;
use App\Dealcloser\Core\Organisation\Organisation;
use App\Dealcloser\Observers\OrganisationObserver;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Organisation::observe(OrganisationObserver::class);
        Department::observe(DepartmentObserver::class);
        Role::observe(RoleObserver::class);
        User::observe(UserObserver::class);
        Product::observe(ProductObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
