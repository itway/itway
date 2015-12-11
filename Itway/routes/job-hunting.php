<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 11:00 PM
 */

// job-hunting ROUTES start
Route::group(['prefix' => 'job-hunting', 'as' => 'job::'], function(){

    Route::get('/', [
        'uses' => 'JobHuntingController@index',
        'as' => 'index'

    ]);
    Route::get('job/{slug}', [
        'uses' => 'JobHuntingController@show',
        'as' => 'show'

    ]);
    Route::get('create', [
        'uses' => 'TeamsController@create',
        'as' => 'create'

    ]);

    Route::get('user-jobs', [
        'uses' => 'JobHuntingController@userPosts',
        'as' => 'user-posts'

    ]);
    Route::get('edit/{id}', [
        'uses' => 'TeamsController@edit',
        'as' => 'edit',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'JobHuntingController@update',
        'as' => 'update',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'JobHuntingController@destroy',
        'as' => 'delete',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::post('store', [
        'uses' => 'JobHuntingController@store',
        'as' => 'store'
    ]);

});
// job-hunting ROUTES end
