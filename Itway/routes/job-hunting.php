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
        'uses' => 'JobHuntingController@create',
        'as' => 'create'
    ]);
    Route::get('user-jobs', [
        'uses' => 'JobHuntingController@userPosts',
        'as' => 'user-posts'
    ]);
    Route::get('edit/{id}', [
        'uses' => 'JobHuntingController@edit',
        'as' => 'edit',
        'middleware' => ['auth','IsUsersOrAdminJobHunt']
    ]);
    Route::patch('update/{id}', [
        'uses' => 'JobHuntingController@update',
        'as' => 'update',
        'middleware' => ['auth','IsUsersOrAdminJobHunt']
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'JobHuntingController@destroy',
        'as' => 'delete',
        'middleware' => ['auth','IsUsersOrAdminJobHunt']
    ]);
    Route::post('store', [
        'uses' => 'JobHuntingController@store',
        'as' => 'store'
    ]);
});
// job-hunting ROUTES end
