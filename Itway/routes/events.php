<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 10:57 PM
 */
//EVENTS ROUTES START
Route::group(array('prefix' => 'events', 'as' => 'events::'), function () {

    Route::get('/',
        [
            'uses' => 'EventsController@index',
            'as' => 'index'
        ]);

    Route::get('event/{id}', [
        'as' => 'show',
        'uses' => 'EventsController@show'
    ]);

    Route::get('user-events', [
        'as' => 'user-events',
        'uses' => 'EventsController@personalEvents'
    ]);

    Route::get('create', [
        'uses' => 'EventsController@create',
        'as' => 'create',
        'middleware' => 'auth'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'EventsController@edit',
        'as' => 'edit',
        'middleware' => ['auth', 'IsUsersOrAdminEvent']
    ]);

    Route::patch('update/{id}', [
        'uses' => 'EventsController@update',
        //'middleware' => 'shouldBeUnique',
        'as' => 'update', 'middleware' => ['IsUsersOrAdminEvent', 'auth']
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'EventsController@destroy',
        'as' => 'delete',
        'middleware' => ['auth', 'IsUsersOrAdminEvent']
    ]);
    Route::post('store', [
        'uses' => 'EventsController@store',
        'as' => 'store',
        'middleware' => 'auth'
    ]);
    Route::get('getPageBody/{id}',[
        'uses' => 'EventsController@getPageBody',
        'as' => 'getPageBody'
    ]);
    Route::get('/tags/{slug}', ['uses' => 'EventsController@tags', 'as' => 'team-tags']);

});
//EVENTS ROUTES END