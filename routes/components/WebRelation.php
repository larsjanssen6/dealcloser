<?php

/*
| Relatie
*/

Route::get('relaties', 'Relation\RelationController@index')
    ->name('relations');

Route::get('relaties/registreer', 'Relation\RelationController@create')
    ->name('relations.create');

Route::post('relaties/registreer', 'Relation\RelationController@store')
    ->name('relations.store');
//
//Route::patch('producten/{product}', 'Product\ProductController@update');
//
Route::delete('relaties/{relation}', 'Relation\RelationController@destroy');
