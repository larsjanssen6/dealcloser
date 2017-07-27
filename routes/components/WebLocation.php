<?php

/*
| Location
*/

Route::get('/states/{country}', 'Web\Location\StateController@index');
Route::get('/countries', 'Web\Location\CountryController@index');
