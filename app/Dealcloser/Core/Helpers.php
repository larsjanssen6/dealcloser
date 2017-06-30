<?php

use App\Dealcloser\Core\Settings\Settings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

if (!function_exists('setActive')) {
    /**
     * @param $path
     * @param string $active
     *
     * @return string
     */
    function setActive($path, $active = 'is-active')
    {
        return Request::path() == $path ? $active : '';
    }
}

if (!function_exists('settings')) {
    /**
     * @return mixed
     */
    function settings()
    {
        return Cache::rememberForever('settings', function () {
            return Settings::first();
        });
    }
}

if (!function_exists('appIsActive')) {
    function appIsActive($date, $user)
    {
        if (is_null($date) || $date > Carbon::now() || $user->hasPermissionTo('application-is-always-active')) {
            return true;
        }

        return false;
    }
}
