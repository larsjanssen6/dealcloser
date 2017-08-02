<?php

/*
| Organisation
*/

Route::get('organisaties', 'Web\Organisation\OrganisationController@index')
    ->name('organisations');

Route::get('organisaties/registreer', 'Web\Organisation\OrganisationController@create')
    ->name('organisations.create');

Route::post('organisaties/registreer', 'Web\Organisation\OrganisationController@store')
    ->name('organisations.create');

Route::get('organisatie/{organisation}', 'Web\Organisation\OrganisationController@show');

Route::patch('organisaties/{organisation}', 'Web\Organisation\OrganisationController@update');

Route::delete('organisaties/{organisation}', 'Web\Organisation\OrganisationController@destroy');
