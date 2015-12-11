<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 10:59 PM
 */
// ============================
//OpenSourceIdeaController  ROUTES Start
Route::group(['prefix' => 'idea-show', 'as' => 'idea-show::'], function(){

    Route::get('/', [
        'uses' => 'OpenSourceIdeaController@index',
        'as' => 'index'

    ]);
    Route::get('/{slug}', [
        'uses' => 'OpenSourceIdeaController@show',
        'as' => 'show'

    ]);
    Route::get('create', [
        'uses' => 'OpenSourceIdeaController@create',
        'as' => 'create'

    ]);
    Route::get('user-ideas', [
        'uses' => 'OpenSourceIdeaController@userPosts',
        'as' => 'user-posts'
    ]);
    Route::get('edit/{id}', [
        'uses' => 'OpenSourceIdeaController@edit',
        'as' => 'edit',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'OpenSourceIdeaController@update',
        'as' => 'update'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'OpenSourceIdeaController@destroy',
        'as' => 'delete',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::post('store', [
        'uses' => 'OpenSourceIdeaController@store',
        'as' => 'store'
    ]);

});
//idea-show Routes end
// ===========================