<?php

/*
| Login / Logout
*/

Route::get('/', 'Web\Auth\LoginController@showLoginForm')
    ->name('login');

Route::post('/', 'Web\Auth\LoginController@login');

Route::get('logout', 'Web\Auth\LoginController@logout')
    ->name('logout');

/*
| Password reset
*/

Route::post('password/reset', 'Web\Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');

Route::post('wachtwoord/reset/{token}', 'Web\Auth\ResetPasswordController@reset')
    ->name('password.reset');

Route::get('wachtwoord/reset/{token}', 'Web\Auth\ResetPasswordController@showResetForm');

/*
| User activation
*/

Route::get('registreer/{token}', 'Web\Auth\ActivationController@show')
    ->name('register.activate');

Route::post('registreer/{token}', 'Web\Auth\ActivationController@activate')
    ->name('register.activate');
