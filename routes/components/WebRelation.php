<?php

/*
| Relation
*/

Route::get('relaties', 'Relation\RelationController@index')
    ->name('relations');

Route::get('relaties/registreer', 'Relation\RelationController@create')
    ->name('relations.create');

Route::post('relaties/registreer', 'Relation\RelationController@store')
    ->name('relations.create');

Route::patch('relaties/{relation}', 'Relation\RelationController@update');

Route::get('/states/{country}', 'State\StateController@index');
