<?php

Route::group(['prefix' => 'teams', 'as' => 'teams::'], function () {

    Route::get('/', [
        'uses' => 'TeamsController@index',
        'as' => 'index'
    ]);

    Route::get('/{slug}', [
        'uses' => 'TeamsController@show',
        'as' => 'show'
    ]);
    Route::get('team/create', [
        'uses' => 'TeamsController@create',
        'as' => 'create'
    ]);
    Route::get('team/{id}', [
        'uses' => 'TeamsController@team',
        'as' => 'team'
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
    Route::get('/tags/{slug}', ['uses' => 'TeamsController@tags', 'as' => 'team-tags']);
});