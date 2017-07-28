<?php

/*
| Relatie
*/

Route::get('relaties', 'Web\Relation\RelationController@index')
    ->name('relations');

Route::get('relatie/{relatie}', 'Web\Relation\RelationController@show');

Route::get('relaties/registreer', 'Web\Relation\RelationController@create')
    ->name('relations.create');

Route::post('relaties/registreer', 'Web\Relation\RelationController@store')
    ->name('relations.store');

Route::patch('relaties/{relation}', 'Web\Relation\RelationController@update');

Route::delete('relaties/{relation}', 'Web\Relation\RelationController@destroy');

Route::get('onderhandeling', 'Web\Relation\NegotiationController@index');
