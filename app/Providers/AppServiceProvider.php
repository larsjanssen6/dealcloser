<?php

namespace App\Providers;

use Carbon\Carbon;
use Jenssegers\Date\Date;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::setLocale('nl');
        Carbon::setLocale('nl');

        //Enable foreign keys support for sqlite when testing
        if (config('database.default') == 'sqlite') {
            $db = app()->make('db');
            $db->connection()->getPdo()->exec('pragma foreign_keys=1');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
