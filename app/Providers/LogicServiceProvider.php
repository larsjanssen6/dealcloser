<?php

namespace App\Providers;

use App\Dealcloser\Interfaces\Logic\IProductCalculation;
use App\Dealcloser\Logic\ProductCalculation;
use Illuminate\Support\ServiceProvider;

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
