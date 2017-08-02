<?php

/*
| User
*/

Route::get('gebruikers', 'Web\User\UserController@index')
    ->name('users');

Route::get('gebruikers/registreer', 'Web\Auth\RegisterController@create')
    ->name('register.create');

Route::post('gebruikers/registreer', 'Web\Auth\RegisterController@store')
    ->name('register.store');

Route::get('gebruikers/{user}', 'Web\User\UserController@show');

Route::patch('gebruikers/{user}', 'Web\User\UserController@update');

Route::delete('gebruikers/{user}', 'Web\User\UserController@destroy');
