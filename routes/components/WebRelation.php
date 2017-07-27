<?php

/*
| Relatie
*/

Route::get('relaties', 'Web\Relation\RelationController@index')
    ->name('relations');

Route::get('relaties/registreer', 'Web\Relation\RelationController@create')
    ->name('relations.create');

Route::post('relaties/registreer', 'Web\Relation\RelationController@store')
    ->name('relations.store');

Route::patch('relaties/{product}', 'Web\Relation\RelationController@update');

Route::delete('relaties/{relation}', 'Web\Relation\RelationController@destroy');
