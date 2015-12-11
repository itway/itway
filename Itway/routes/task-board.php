<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 10:57 PM
 */
//TASKBOARD ROUTES START
Route::group(array('prefix' => 'task-board', 'as' => 'task-board::'), function () {

    Route::get('/',
        [
            'uses' => 'TaskBoardController@index',
            'as' => 'index'
        ]);

    Route::get('show/{id}', [
        'as' => 'show',
        'uses' => 'TaskBoardController@show'
    ]);

    Route::get('personal_tasks', [
        'as' => 'personal_tasks',
        'uses' => 'TaskBoardController@personalTasks'
    ]);

    Route::get('create', [
        'uses' => 'TaskBoardController@create',
        'as' => 'create',
        'middleware' => 'auth'
    ]);

    Route::get('edit/{id}', [
        'uses' => 'TaskBoardController@edit',
        'as' => 'edit',
        'middleware' => ['auth']
    ]);

    Route::patch('update/{id}', [
        'uses' => 'TaskBoardController@update',
//                'middleware' => 'shouldBeUnique',
        'as' => 'update', 'middleware' => ['IsUsers', 'auth']
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'TaskBoardController@destroy',
        'as' => 'delete', 'middleware' => ['auth','IsUsers']
    ]);
    Route::post('store', [
        'uses' => 'TaskBoardController@store',
        'as' => 'store',
        'middleware' => 'auth'
    ]);


});
//TASKBOARD ROUTES END