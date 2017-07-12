<?php

/*
| Product
*/


Route::get('producten', 'Product\ProductController@index')
    ->name('products');