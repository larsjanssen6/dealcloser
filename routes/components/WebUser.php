<?php

/*
| User
*/

Route::get('gebruikers', 'User\UserController@index')
    ->name('users');

Route::patch('gebruikers/{user}', 'User\UserController@update');

Route::get('gebruikers/registreer', 'Auth\RegisterController@create')
    ->name('register.create');

Route::post('gebruikers/registreer', 'Auth\RegisterController@store')
    ->name('register.store');
