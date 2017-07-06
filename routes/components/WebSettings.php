<?php

/*
| CompanyInfo
*/

Route::get('instellingen/bedrijf/administratie', 'Settings\Company\SettingsAdministrationController@index')
    ->name('settings.company.administration');

Route::patch('instellingen/bedrijf/administratie', 'Settings\Company\SettingsAdministrationController@update');

Route::get('instellingen/bedrijf/locatie', 'Settings\Company\SettingsLocationController@index')
    ->name('settings.company.location');

Route::patch('instellingen/bedrijf/locatie', 'Settings\Company\SettingsLocationController@update');

Route::get('instellingen/bedrijf/profiel', 'Settings\Company\SettingsProfileController@index')
    ->name('settings.company.profile');

Route::patch('instellingen/bedrijf/profiel', 'Settings\Company\SettingsProfileController@update');

Route::get('instellingen/bedrijf/afdeling', 'Settings\Company\SettingsDepartmentController@index')
    ->name('settings.company.department');

Route::post('instellingen/bedrijf/afdeling', 'Settings\Company\SettingsDepartmentController@store')
    ->name('settings.company.department');

Route::patch('instellingen/bedrijf/afdeling/{department}', 'Settings\Company\SettingsDepartmentController@update');

Route::delete('instellingen/bedrijf/afdeling/{department}', 'Settings\Company\SettingsDepartmentController@destroy');

/*
|  Usage
*/

Route::get('instellingen/bedrijf/gebruik', 'Settings\Usage\SettingsUsageController@index')
    ->name('settings.company.usage');

Route::patch('instellingen/bedrijf/gebruik', 'Settings\Usage\SettingsUsageController@update');


/*
|  User profile
*/

Route::get('instellingen/profiel', 'Settings\User\SettingsProfileController@index')
    ->name('settings.profile');

Route::patch('instellingen/profiel', 'Settings\User\SettingsProfileController@update')
    ->name('settings.profile');

/*
|  Permissions
*/

Route::get('instellingen/bedrijf/permissie', 'Settings\Rights\SettingsPermissionController@index')
    ->name('settings.rights.permission');

Route::get('instellingen/bedrijf/permissie/update', 'Settings\Rights\SettingsPermissionController@update');

/*
| Roles
*/

Route::get('instellingen/bedrijf/role', 'Settings\Rights\SettingsRoleController@index')
    ->name('settings.rights.role');

Route::post('instellingen/bedrijf/role', 'Settings\Rights\SettingsRoleController@store')
    ->name('settings.rights.role');

Route::patch('instellingen/bedrijf/role/{role}', 'Settings\Rights\SettingsRoleController@update');

Route::delete('instellingen/bedrijf/role/{role}', 'Settings\Rights\SettingsRoleController@destroy');

