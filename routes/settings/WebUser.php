<?php

/*
| User
*/

Route::get('gebruikers', 'User\UserController@index')
    ->name('users');

Route::patch('gebruikers/{user}', 'User\UserController@update');


Route::get('gebruikers/registreer', 'Auth\RegisterController@show')
    ->name('register.show');

Route::post('gebruikers/registreer', 'Auth\RegisterController@store')
    ->name('register.store');