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

require 'components/WebAuthentication.php';
require 'components/WebInfo.php';

Route::group(['middleware' => ['auth', 'throttle:100', 'CheckIfApplicationIsActive']], function () {
    Route::get('dashboard', 'Web\Dashboard\DashboardController@index');

    require 'components/WebUser.php';
    require 'components/WebProduct.php';
    require 'components/WebSettings.php';
    require 'components/WebRelation.php';
    require 'components/WebLocation.php';
    require 'components/WebOrganisation.php';
});
