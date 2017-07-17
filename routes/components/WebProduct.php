<?php

/*
| Product
*/

Route::get('producten', 'Product\ProductController@index')
    ->name('products');

Route::get('producten/registreer', 'Product\ProductController@create')
    ->name('products.create');

Route::post('producten/registreer', 'Product\ProductController@store')
    ->name('products.create');

Route::patch('producten/{product}', 'Product\ProductController@update');

Route::delete('producten/{product}', 'Product\ProductController@destroy');
