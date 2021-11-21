<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Lights
    Route::apiResource('lights', 'UsersApiController');


});

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::get('light/status/{id}', 'Admin\LightSystemController@directLightStatus');
    Route::get('light/switch/{id}/{value}', 'Admin\LightSystemController@directLightSwitch');
});


