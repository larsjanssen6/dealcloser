<?php

namespace App\Providers;

use App\Dealcloser\Interfaces\Repositories\IUserRepo;
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
    }
}
