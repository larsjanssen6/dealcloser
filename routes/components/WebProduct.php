<?php

/*
| Product
*/

Route::get('producten', 'Web\Product\ProductController@index')
    ->name('products');

Route::get('producten/registreer', 'Web\Product\ProductController@create')
    ->name('products.create');

Route::post('producten/registreer', 'Web\Product\ProductController@store')
    ->name('products.create');

Route::patch('producten/{product}', 'Web\Product\ProductController@update');

Route::delete('producten/{product}', 'Web\Product\ProductController@destroy');
