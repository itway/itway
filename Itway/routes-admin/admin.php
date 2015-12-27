<?php

Route::group(['prefix' => 'teams', 'as' => 'teams::'], function(){
    Route::get('/', [
        'uses' => 'Admin\AdminTeamsController@index',
        'as' => 'index'
    ]);
    Route::get('create', [
        'uses' => 'Admin\AdminTeamsController@create',
        'as' => 'create'
    ]);
    Route::get('edit/{id}', [
        'uses' => 'Admin\AdminTeamsController@edit',
        'as' => 'edit'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'Admin\AdminTeamsController@update',
        'as' => 'update'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'Admin\AdminTeamsController@destroy',
        'as' => 'delete'
    ]);
    Route::post('store', [
        'uses' => 'Admin\AdminTeamsController@store',
        'as' => 'store'
    ]);
    Route::get('banORunBan/{id}', [
        'uses' => 'Admin\AdminTeamsController@banORunBan',
        'as' => 'ban'
    ]);
});