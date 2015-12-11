<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 12/11/2015
 * Time: 10:58 PM
 */
// CHAT Localed ROUTES START
Route::group(['prefix' => 'chat'], function () {
    Route::get('/', ['as' => 'chat', 'uses' => 'ChatController@index']);
    Route::get('{id}', ['as' => 'chat.show', 'uses' => 'ChatController@show']);
});
// CHAT ROUTES END