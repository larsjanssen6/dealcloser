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

require('settings/WebAuthentication.php');

require('settings/WebInfo.php');

Route::group(['middleware' => ['auth', 'throttle:100', 'CheckIfApplicationIsActive']], function () {
    Route::get('dashboard', function () {
        return view('dashboard/dashboard');
    })->name('dashboard');

        require('settings/WebUser.php');

        require('settings/WebSettings.php');
});
