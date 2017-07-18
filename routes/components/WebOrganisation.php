<?php

/*
| Organisation
*/

Route::get('organisaties', 'Organisation\OrganisationController@index')
    ->name('organisations');

Route::get('organisaties/registreer', 'Organisation\OrganisationController@create')
    ->name('organisations.create');

Route::post('organisaties/registreer', 'Organisation\OrganisationController@store')
    ->name('organisations.create');

Route::patch('organisaties/{organisation}', 'Organisation\OrganisationController@update');

Route::delete('organisaties/{organisation}', 'Organisation\OrganisationController@destroy');

Route::get('/states/{country}', 'State\StateController@index');
