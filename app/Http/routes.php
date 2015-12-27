<?php


// ===============================================
// localed routes SECTION =================================
// ===============================================
$locale = Request::segment(1);

\Lang::setLocale($locale);

Route::group(['prefix' => $locale, 'middleware' => ['locale', 'checkBannedUser']], function () {

    Route::post('/language', array(
        'as' => 'language-chooser',
        'uses' => 'LanguageController@chooser'));

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'main'
    ]);

    Route::group(['prefix' => '/', 'as' => 'itway::'], function () {
        foreach (File::allFiles(base_path() . '/Itway/routes') as $partial) {
            require $partial->getPathname();
        }
    });

    // ADMIN ROUTES START
    Route::group(array('prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'as' => 'admin::'), function () {
        Route::get('/', ['uses' => 'Admin\AdminController@index', 'as' => 'index']);
        foreach (File::allFiles(base_path() . '/Itway/routes-admin') as $partial) {
            require $partial->getPathname();
        }
    });
    //END OF ADMIN ROUTEs

    //like or dislike route
    Route::get('likeORdis/{class_name}/{object_id}', array('uses' => 'LikeController@likeORdis', 'as' => 'likeORdis'))
        ->where('object_id', '[0-9]+');
    //END OF LIKE DISLIKE

    // about page (app/views/pages/about.blade.php)
    Route::get('about', 'PagesController@about');
    // contact page (app/views/pages/contact.blade.php)
    Route::get('contact', function () {
        return view('pages.contact');
    });
});

Route::get('banned/{id}', ['uses' => 'UserController@banned']);


//Socialite Integration
Route::get('auth/login/{provider}', ['as' => 'auth.provider', 'uses' => 'Auth\AuthController@loginThirdParty']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);
Route::post('/search', ['as' => 'search', 'uses' => 'SearchController@executeSearch']);

Route::post('/getAllExistingTags', ['as' => 'getAllExistingTags', 'uses' => 'SearchController@getAllExistingTags']);
//end socialite

// ROUTES FOR AJAX CALLS
Route::get('queryCountries/{query}', ['uses' => 'CountriesController@queryCountry', 'as' => 'query-country']);
Route::get('chat/{user_id}/rooms', ['uses' => 'ChatController@getUsersConversations', 'as' => 'users-room-get']);
Route::get('chat/conversations', ['uses' => 'ChatController@getConversations', 'as' => 'room-get']);
Route::get('chat/create', ['as' => 'room.create', 'uses' => 'ChatController@createForm']);
Route::post('chat/store', ['as' => 'room.store', 'uses' => 'ChatController@createRoom']);
Route::put('room/{id}', ['as' => 'chat.update', 'uses' => 'ChatController@update']);
//Route::post('rooms/{user_id}', ['uses' => 'ChatController@createConversation', 'as' => 'room-create']);
Route::get('room/{current_thread}/{user_id}', ['uses' => 'ChatController@getMessages', 'as' => 'room-messages-get']);
Route::get('room/getMessage', ['uses' => 'ChatController@getMessage', 'as' => 'room-message-get']);
Route::post('room/create-message', ['uses' => 'ChatController@sendMessage', 'as' => 'room-messages-create']);

// END OF ROUTES FOR AJAX CALLS