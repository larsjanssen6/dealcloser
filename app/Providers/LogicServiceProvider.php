<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Dealcloser\Logic\ProductCalculation;
use App\Dealcloser\Interfaces\Logic\IProductCalculation;

class LogicServiceProvider extends ServiceProvider
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
        $this->app->singleton(IProductCalculation::class, ProductCalculation::class);
    }
}
