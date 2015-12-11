<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 11:20 PM
 */
Route::group(['prefix' => 'users', 'as' => 'users::'], function() {
    Route::get('/', [
        'uses' => 'Admin\AdminUsersController@index',
        'as' => 'index'
    ]);
    Route::get('create', [
        'uses' => 'Admin\AdminUsersController@create',
        'as' => 'create'
    ]);
    Route::get('edit/{slug}', [
        'uses' => 'Admin\AdminUsersController@edit',
        'as' => 'edit'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'Admin\AdminUsersController@update',
        'as' => 'update'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'Admin\AdminUsersController@destroy',
        'as' => 'delete'
    ]);
    Route::post('store', [
        'uses' => 'Admin\AdminUsersController@store',
        'as' => 'store'
    ]);
    Route::get('banORunBan/{id}', [
        'uses' => 'Admin\AdminUsersController@banORunBan',
        'as' => 'ban'
    ]);
});
