<?php

//Route::get('/light/status', 'HomeController@directStatus')->name('direct light status');
Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Lights
    Route::delete('light/destroy', 'LightSystemController@massDestroy')->name('lights.massDestroy');
    Route::resource('lights', 'LightSystemController');
    Route::get('light/on-all-lights', 'LightSystemController@onAllLights')->name('lights.onAllLights');
    Route::get('light/off-all-lights', 'LightSystemController@offAllLights')->name('lights.offAllLights');
    Route::get('light/toggle', 'LightSystemController@toggleONOFF')->name('lights.toggleONOFF');
    Route::post('light/toggle', 'LightSystemController@toggleONOFF')->name('lights.toggleONOFF');

});


