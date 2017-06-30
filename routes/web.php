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

$login = 'Auth\LoginController@';

Route::get('/', $login . 'showLoginForm')
    ->name('login');

Route::post('/', $login . 'login');

Route::get('logout', $login . 'logout')
    ->name('logout');

/*
| Password reset
*/

$forgotPasswordWeb = 'Auth\ForgotPasswordController@';
$passwordReset = 'Auth\ResetPasswordController@';

Route::post('password/reset', $forgotPasswordWeb . 'sendResetLinkEmail')->name('password.email');
Route::post('wachtwoord/reset/{token}', $passwordReset . 'reset')->name('password.reset');
Route::get('wachtwoord/reset/{token}', $passwordReset . 'showResetForm');


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

    Route::get('gebruikers', 'User\UserController@index')
        ->name('users');

    Route::get('gebruikers/registreer', 'Auth\RegisterController@show')
        ->name('register.show');

    Route::post('gebruikers/registreer', 'Auth\RegisterController@store')
        ->name('register.store');

    /*
    | Settings
    */


    /*
    | Settings || CompanyInfo
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
    | Settings || Usage
    */

    Route::get('instellingen/bedrijf/gebruik', 'Settings\Usage\SettingsUsageController@index')
        ->name('settings.company.usage');

    Route::patch('instellingen/bedrijf/gebruik', 'Settings\Usage\SettingsUsageController@update');


    /*
    | Settings || User profile
    */

    Route::get('instellingen/profiel', 'Settings\User\SettingsUserController@index')
        ->name('settings.profile');

    Route::patch('instellingen/profiel', 'Settings\User\SettingsUserController@update');

    /*
    | Settings || Permissions
    */

    Route::get('instellingen/bedrijf/permissie', 'Settings\Rights\SettingsPermissionController@index')
        ->name('settings.rights.permission');

    Route::get('instellingen/bedrijf/permissie/update', 'Settings\Rights\SettingsPermissionController@update');

    /*
    | Settings || Rollen
    */

    Route::get('instellingen/bedrijf/role', 'Settings\Rights\SettingsRoleController@index')
        ->name('settings.rights.role');

    Route::post('instellingen/bedrijf/role', 'Settings\Rights\SettingsRoleController@store')
        ->name('settings.rights.role');

    Route::patch('instellingen/bedrijf/role/{role}', 'Settings\Rights\SettingsRoleController@update');

    Route::delete('instellingen/bedrijf/role/{role}', 'Settings\Rights\SettingsRoleController@destroy');
});
