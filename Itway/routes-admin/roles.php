<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 11:20 PM
 */
Route::group(['prefix' => 'roles', 'as' => 'roles::'], function(){

    Route::get('/', [
        'uses' => 'Admin\RolesController@index',
        'as' => 'index'

    ]);
    Route::get('create', [
        'uses' => 'Admin\RolesController@create',
        'as' => 'create'

    ]);
    Route::get('edit/{slug}', [
        'uses' => 'Admin\RolesController@edit',
        'as' => 'edit'
    ]);
    Route::patch('update/{slug}', [
        'uses' => 'Admin\RolesController@update',
        'as' => 'update'
    ]);
    Route::delete('{id}', [
        'uses' => 'Admin\RolesController@destroy',
        'as' => 'delete'
    ]);
    Route::post('store', [
        'uses' => 'Admin\RolesController@store',
        'as' => 'store'
    ]);

});
