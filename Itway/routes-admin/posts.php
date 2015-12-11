<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 11:19 PM
 */
Route::group(['prefix' => 'posts', 'as' => 'posts::'], function(){

    Route::get('/', [
        'uses' => 'Admin\AdminPostsController@index',
        'as' => 'index'

    ]);
    Route::get('create', [
        'uses' => 'Admin\AdminPostsController@create',
        'as' => 'create'

    ]);

    Route::get('edit/{id}', [
        'uses' => 'Admin\AdminPostsController@edit',
        'as' => 'edit'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'Admin\AdminPostsController@update',
        'as' => 'update'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'Admin\AdminPostsController@destroy',
        'as' => 'delete'
    ]);
    Route::post('store', [
        'uses' => 'Admin\AdminPostsController@store',
        'as' => 'store'
    ]);
    Route::get('banORunBan/{id}', [
        'uses' => 'Admin\AdminPostsController@banORunBan',
        'as' => 'ban'
    ]);
});
