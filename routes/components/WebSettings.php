<?php

/*
| CompanyInfo
*/

Route::get('instellingen/bedrijf/administratie', 'Web\Settings\Company\SettingsAdministrationController@index')
    ->name('settings.company.administration');

Route::patch('instellingen/bedrijf/administratie', 'Web\Settings\Company\SettingsAdministrationController@update');

Route::get('instellingen/bedrijf/locatie', 'Web\Settings\Company\SettingsLocationController@index')
    ->name('settings.company.location');

Route::patch('instellingen/bedrijf/locatie', 'Web\Settings\Company\SettingsLocationController@update');

Route::get('instellingen/bedrijf/profiel', 'Web\Settings\Company\SettingsProfileController@index')
    ->name('settings.company.profile');

Route::patch('instellingen/bedrijf/profiel', 'Web\Settings\Company\SettingsProfileController@update');

Route::get('instellingen/bedrijf/afdeling', 'Web\Settings\Company\SettingsDepartmentController@index')
    ->name('settings.company.department');

Route::post('instellingen/bedrijf/afdeling', 'Web\Settings\Company\SettingsDepartmentController@store')
    ->name('settings.company.department');

Route::patch('instellingen/bedrijf/afdeling/{department}', 'Web\Settings\Company\SettingsDepartmentController@update');

Route::delete('instellingen/bedrijf/afdeling/{department}', 'Web\Settings\Company\SettingsDepartmentController@destroy');

/*
|  Usage
*/

Route::get('instellingen/bedrijf/gebruik', 'Web\Settings\Usage\SettingsUsageController@index')
    ->name('settings.company.usage');

Route::patch('instellingen/bedrijf/gebruik', 'Web\Settings\Usage\SettingsUsageController@update');

/*
|  User profile
*/

Route::get('instellingen/profiel', 'Web\Settings\User\SettingsProfileController@index')
    ->name('settings.profile');

Route::patch('instellingen/profiel', 'Web\Settings\User\SettingsProfileController@update')
    ->name('settings.profile');

/*
|  Permissions
*/

Route::get('instellingen/bedrijf/permissie', 'Web\Settings\Rights\SettingsPermissionController@index')
    ->name('settings.rights.permission');

Route::get('instellingen/bedrijf/permissie/update', 'Web\Settings\Rights\SettingsPermissionController@update');

/*
| Roles
*/

Route::get('instellingen/bedrijf/role', 'Web\Settings\Rights\SettingsRoleController@index')
    ->name('settings.rights.role');

Route::post('instellingen/bedrijf/role', 'Web\Settings\Rights\SettingsRoleController@store')
    ->name('settings.rights.role');

Route::patch('instellingen/bedrijf/role/{role}', 'Web\Settings\Rights\SettingsRoleController@update');

Route::delete('instellingen/bedrijf/role/{role}', 'Web\Settings\Rights\SettingsRoleController@destroy');
