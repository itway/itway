<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 10:56 PM
 */
//BLOG ROUTES START
Route::group(['prefix' => 'blog', 'as' => 'posts::'], function(){

    Route::get('/', [
        'uses' => 'PostsController@index',
        'as' => 'index'

    ]);
    Route::get('post/{slug}', [
        'uses' => 'PostsController@show',
        'as' => 'show'

    ]);
    Route::get('create', [
        'uses' => 'PostsController@create',
        'as' => 'create'

    ]);

    Route::get('user-posts', [
        'uses' => 'PostsController@userPosts',
        'as' => 'user-posts'

    ]);
    Route::get('edit/{id}', [
        'uses' => 'PostsController@edit',
        'as' => 'edit',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::patch('update/{id}', [
        'uses' => 'PostsController@update',
        'as' => 'update',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::delete('delete/{id}', [
        'uses' => 'PostsController@destroy',
        'as' => 'delete',
        'middleware' => 'IsUsersOrAdminPost'
    ]);
    Route::post('store', [
        'uses' => 'PostsController@store',
        'as' => 'store'
    ]);
    Route::get('getPageBody/{id}',[
        'uses' => 'PostsController@getPageBody',
        'as' => 'getPageBody'
    ]);
    Route::get('/tags/{slug}', 'PostsController@tags');

});
//BLOG ROUTES END