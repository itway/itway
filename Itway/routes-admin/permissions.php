<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 11:21 PM
 */
Route::group(['prefix' => 'permissions', 'as' => 'permissions::'], function(){
    Route::get('/', [
        'uses' => 'Admin\PermissionsController@index',
        'as' => 'index'
    ]);
    Route::get('create', [
        'uses' => 'Admin\PermissionsController@create',
        'as' => 'create'
    ]);
    Route::get('edit/{slug}', [
        'uses' => 'Admin\PermissionsController@edit',
        'as' => 'edit'
    ]);
    Route::patch('update/{slug}', [
        'uses' => 'Admin\PermissionsController@update',
        'as' => 'update'
    ]);
    Route::delete('{id}', [
        'uses' => 'Admin\PermissionsController@destroy',
        'as' => 'delete'
    ]);
    Route::post('store', [
        'uses' => 'Admin\PermissionsController@store',
        'as' => 'store'
    ]);
});
