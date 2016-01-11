<?php
//================================
//USER Routes START
Route::group(['prefix' => 'user', 'middleware' => 'auth', 'as' => 'user::'], function() {
    Route::get('/', [
        'uses' => 'UserController@index',
        'as' => 'index'
    ]);
    Route::get('/{id}', [
        'as' => 'show',
        'uses' => 'UserController@show'
    ]);
    Route::get('/settings/{id}',
        [ 'as' => 'settings',
            'uses'=>'UserController@settings',
            'middleware' => 'IsUsers']);
    Route::get('create', [
        'uses' => 'UserController@create',
        'as' => 'create'
    ]);
    Route::get('edit/{id}', [
        'uses' => 'UserController@edit',
        'as' => 'edit', 'middleware' => 'IsUsers'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'UserController@update',
        'as' => 'update', 'middleware' => 'IsUsers'
    ]);
    Route::delete('/{id}', [
        'uses' => 'UserController@destroy',
        'as' => 'delete', 'middleware' => 'IsUsers'
    ]);
    Route::post('store', [
        'uses' => 'UserController@store',
        'as' => 'store', 'middleware' => 'IsUsers'
    ]);
    Route::post('photo', [
        'uses' => 'UserController@userPhoto',
        'middleware' => 'IsUsers',
        'as' => 'photo']);
    Route::get('/tags/{slug}', [
        'uses' => 'UserController@tags']);
});
//end of USER routes
//===============================