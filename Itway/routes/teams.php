<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 11:00 PM
 */
// ===============================================
//start of teams SECTION =================================
Route::group(['prefix' => 'teams', 'as' => 'teams::'], function(){

    Route::get('/', [
        'uses' => 'TeamsController@index',
        'as' => 'index'

    ]);
    Route::get('/{slug}', [
        'uses' => 'TeamsController@show',
        'as' => 'show'

    ]);
    Route::get('create', [
        'uses' => 'TeamsController@create',
        'as' => 'create'

    ]);

    Route::get('user-team', [
        'uses' => 'TeamsController@userPosts',
        'as' => 'user-posts'

    ]);
    Route::get('edit/{id}', [
        'uses' => 'TeamsController@edit',
        'as' => 'edit',
        'middleware' => 'IsUsersOrAdminTeam'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'TeamsController@update',
        'as' => 'update',
        'middleware' => 'IsUsersOrAdminTeam'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'TeamsController@destroy',
        'as' => 'delete',
        'middleware' => 'IsUsersOrAdminTeam'
    ]);
    Route::post('store', [
        'uses' => 'TeamsController@store',
        'as' => 'store'
    ]);

});
//end of teams SECTION =================================
// ===============================================
