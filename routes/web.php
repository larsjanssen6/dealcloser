<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
| Login / Logout
*/

Route::get('/', 'Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('/', 'Auth\LoginController@login');

Route::get('logout', 'Auth\LoginController@logout')
    ->name('logout');

/*
| Password reset
*/

Route::post('password/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');

Route::post('wachtwoord/reset/{token}', 'Auth\ResetPasswordController@reset')
    ->name('password.reset');

Route::get('wachtwoord/reset/{token}', 'Auth\ResetPasswordController@showResetForm');

/*
| User activation
*/

Route::get('registreer/{token}', 'Auth\ActivationController@show')
    ->name('register.activate');

Route::post('registreer/{token}', 'Auth\ActivationController@activate')
    ->name('register.activate');

/*
| Info controller
*/

Route::get('info', 'Info\InfoController@info')
    ->name('info.info');

Route::group(['middleware' => ['auth', 'throttle:100', 'CheckIfApplicationIsActive']], function () {
    Route::get('dashboard', function () {
        return view('dashboard/dashboard');
    })->name('dashboard');

    /*
    | User
    */

        /*
        | Users
        */

        Route::get('gebruikers', 'User\UserController@index')
            ->name('users');

        /*
        | Register
        */

        Route::get('gebruikers/registreer', 'Auth\RegisterController@show')
            ->name('register.show');

        Route::post('gebruikers/registreer', 'Auth\RegisterController@store')
            ->name('register.store');

    /*
    | Settings
    */

        /*
        | CompanyInfo
        */

        Route::get('instellingen/bedrijf/administratie', 'Settings\Company\SettingsAdministrationController@index')
            ->name('settings.company.administration');

        Route::patch('instellingen/bedrijf/administratie', 'Settings\Company\SettingsAdministrationController@update');

        Route::get('instellingen/bedrijf/locatie', 'Settings\Company\SettingsLocationController@index')
            ->name('settings.company.location');

        Route::patch('instellingen/bedrijf/locatie', 'Settings\Company\SettingsLocationController@update');

        Route::get('instellingen/bedrijf/profiel', 'Settings\Company\SettingsProfileController@index')
            ->name('settings.company.profile');

        Route::patch('instellingen/bedrijf/profiel', 'Settings\Company\SettingsProfileController@update');

        /*
        |  Usage
        */

        Route::get('instellingen/bedrijf/gebruik', 'Settings\Usage\SettingsUsageController@index')
            ->name('settings.company.usage');

        Route::patch('instellingen/bedrijf/gebruik', 'Settings\Usage\SettingsUsageController@update');


        /*
        |  User profile
        */

        Route::get('instellingen/profiel', 'Settings\User\SettingsProfileController@index')
            ->name('settings.profile');

        Route::patch('instellingen/profiel', 'Settings\User\SettingsProfileController@update')
            ->name('settings.profile');

        /*
        |  Permissions
        */

        Route::get('instellingen/bedrijf/permissie', 'Settings\Rights\SettingsPermissionController@index')
            ->name('settings.rights.permission');

        Route::get('instellingen/bedrijf/permissie/update', 'Settings\Rights\SettingsPermissionController@update');

        /*
        | Roles
        */

        Route::get('instellingen/bedrijf/role', 'Settings\Rights\SettingsRoleController@index')
            ->name('settings.rights.role');

        Route::post('instellingen/bedrijf/role', 'Settings\Rights\SettingsRoleController@store')
            ->name('settings.rights.role');

        Route::patch('instellingen/bedrijf/role/{role}', 'Settings\Rights\SettingsRoleController@update');

        Route::delete('instellingen/bedrijf/role/{role}', 'Settings\Rights\SettingsRoleController@destroy');
});
