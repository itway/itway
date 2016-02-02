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
        'as' => 'create',
        'middleware' => ['UserShouldHaveOneTeam']
    ]);
    Route::get('team/{id}', [
        'uses' => 'TeamsController@team',
        'as' => 'team'
    ]);
    Route::get('edit/{id}', [
        'uses' => 'TeamsController@edit',
        'as' => 'edit',
        'middleware' => ['auth', 'IsUsersOrAdminTeamOwner']
    ]);
    Route::patch('update/{id}', [
        'uses' => 'TeamsController@update',
        'as' => 'update',
        'middleware' => ['auth', 'IsUsersOrAdminTeamOwner']
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'TeamsController@destroy',
        'as' => 'delete',
        'middleware' => ['auth', 'IsUsersOrAdminTeamOwner']
    ]);
    Route::post('store', [
        'uses' => 'TeamsController@store',
        'as' => 'store',
        'middleware' => ['UserShouldHaveOneTeam']
    ]);
    Route::get('/tags/{slug}', ['uses' => 'TeamsController@tags', 'as' => 'team-tags']);
    Route::get('/trends/{slug}', ['uses' => 'TeamsController@trends', 'as' => 'team-trends']);
    Route::get('/country/{slug}', ['uses' => 'TeamsController@country', 'as' => 'team-country']);
});
Route::get('team/exists', ['uses' => 'TeamsController@teamAlreadyExists', 'as' => 'teams::team-exists']);