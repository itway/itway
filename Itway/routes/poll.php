<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 10:58 PM
 */
//QUIZ ROUTES START
Route::group(array('prefix' => 'poll', 'as' => 'poll::'), function () {

    Route::get('/',
        [
            'uses' => 'PollController@index',
            'as' => 'index'
        ]);

    Route::get('show/{id}', [ 'as' => 'show', 'uses' => 'PollController@show']);

    Route::get('personal_quizzes', [ 'as' => 'personal_quizzes', 'uses' => 'PollController@personalPollzes']);

    Route::get('create', ['uses' => 'PollController@create', 'as' => 'create', 'middleware' => 'auth'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'PollController@edit',
        'as' => 'edit',
        'middleware' => ['auth']
    ]);

    Route::patch('update/{id}', [
        'uses' => 'PollController@update',
//                'middleware' => 'shouldBeUnique',
        'as' => 'update', 'middleware' => ['IsUsers', 'auth']
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'PollController@destroy',
        'as' => 'delete', 'middleware' => ['auth','IsUsers']
    ]);
    Route::post('store', [
        'uses' => 'PollController@store',
        'as' => 'store',
        'middleware' => 'auth'
    ]);


});
//QUIZ ROUTES END