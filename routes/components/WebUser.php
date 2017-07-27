<?php

/*
| User
*/

Route::get('gebruikers', 'Web\User\UserController@index')
    ->name('users');

Route::patch('gebruikers/{user}', 'Web\User\UserController@update');

Route::get('gebruikers/registreer', 'Web\Auth\RegisterController@create')
    ->name('register.create');

Route::post('gebruikers/registreer', 'Web\Auth\RegisterController@store')
    ->name('register.store');

Route::delete('gebruikers/{user}', 'Web\User\UserController@destroy');
