<?php

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
