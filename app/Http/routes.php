<?php


// ===============================================
// localed routes SECTION =================================
// ===============================================
$locale = Request::segment(1);

\Lang::setLocale($locale);

Route::group([ 'prefix' => $locale, 'middleware' => 'locale'], function() {


    Route::post('/language', array(
        'as' => 'language-chooser',
        'uses' => 'LanguageController@chooser'));

    Route::get('/',  [
        'uses' => 'HomeController@index',
        'as' => 'main'
    ]);

    Route::group(['prefix' => '/', 'as' => 'itway::'], function(){

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

        //EVENTS ROUTES START
        Route::group(array('prefix' => 'events', 'as' => 'events::'), function () {

            Route::get('/',
                [
                    'uses' => 'EventsController@index',
                    'as' => 'index'
                ]);

            Route::get('show/{id}', [
                'as' => 'show',
                'uses' => 'EventsController@show'
            ]);

            Route::get('personal_events', [
                'as' => 'personal_events',
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
                'middleware' => ['auth']
            ]);

            Route::patch('update/{id}', [
                'uses' => 'EventsController@update',
            //'middleware' => 'shouldBeUnique',
                'as' => 'update', 'middleware' => ['IsUsers', 'auth']
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'EventsController@destroy',
                'as' => 'delete', 'middleware' => ['auth','IsUsers']
            ]);
            Route::post('store', [
                'uses' => 'EventsController@store',
                'as' => 'store',
                'middleware' => 'auth'
            ]);


        });
        //EVENTS ROUTES END

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

            Route::get('personal_quizzes', [
                'as' => 'personal_tasks',
                'uses' => 'TaskBoardController@personalTasks'
            ]);

            Route::get('create', [
                'uses' => 'QuizController@TaskBoardController',
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

        //QUIZ ROUTES START
        Route::group(array('prefix' => 'quiz', 'as' => 'quiz::'), function () {

            Route::get('/',
                [
                    'uses' => 'QuizController@index',
                    'as' => 'index'
                ]);

            Route::get('show/{id}', [ 'as' => 'show', 'uses' => 'QuizController@show']);

            Route::get('personal_quizzes', [ 'as' => 'personal_quizzes', 'uses' => 'QuizController@personalQuizzes']);

            Route::get('create', ['uses' => 'QuizController@create', 'as' => 'create', 'middleware' => 'auth'
            ]);

            Route::get('edit/{id}', [
                'uses' => 'QuizController@edit',
                'as' => 'edit',
                'middleware' => ['auth']
            ]);

            Route::patch('update/{id}', [
                'uses' => 'QuizController@update',
//                'middleware' => 'shouldBeUnique',
                'as' => 'update', 'middleware' => ['IsUsers', 'auth']
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'QuizController@destroy',
                'as' => 'delete', 'middleware' => ['auth','IsUsers']
            ]);
            Route::post('store', [
                'uses' => 'QuizController@store',
                'as' => 'store',
                'middleware' => 'auth'
            ]);


        });
        //QUIZ ROUTES END


        Route::get('sales', [
            'uses' => 'AdminController@sales'
        ]);
        // CHAT Localed ROUTES START
        Route::group(['prefix' => 'chat'], function () {
            Route::get('/', ['as' => 'chat', 'uses' => 'ChatController@index']);
            Route::get('{id}', ['as' => 'chat.show', 'uses' => 'ChatController@show']);
        });
        // CHAT ROUTES END

        //================================
        //USER Routes START
        Route::group(['prefix' => 'user','middleware' => 'auth', 'as' => 'user::'], function() {

            Route::get('/', [
                'uses' => 'UserController@index',
                'as' => 'index'

            ]);
            Route::get('/{id}', [ 'as' => 'show', 'uses' => 'UserController@show',]);
            Route::get('/settings/{id}', [ 'as' => 'settings', 'uses'=>'UserController@settings', 'middleware' => 'IsUsers']);

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
//                'middleware' => 'shouldBeUnique',
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
            Route::post('photo', ['uses' => 'UserController@userPhoto','middleware' => 'IsUsers', 'as' => 'photo']);
            Route::get('/tags/{slug}', ['uses' => 'UserController@tags']);
        });
        //end of USER routes
        //===============================


        // ============================
        //OpenSourceIdeaController  ROUTES Start
        Route::group(['prefix' => 'idea-show', 'as' => 'idea-show::'], function(){

            Route::get('/', [
                'uses' => 'OpenSourceIdeaController@index',
                'as' => 'index'

            ]);
            Route::get('idea/{slug}', [
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

        // ===============================================
        //start of teams SECTION =================================
        Route::group(['prefix' => 'teams', 'as' => 'teams::'], function(){

            Route::get('/', [
                'uses' => 'TeamsController@index',
                'as' => 'index'

            ]);
            Route::get('team/{slug}', [
                'uses' => 'TeamsController@show',
                'as' => 'show'

            ]);
            Route::get('create', [
                'uses' => 'TeamsController@create',
                'as' => 'create'

            ]);

            Route::get('user-team', [
                'uses' => 'TeamsController@userPosts',
                'as' => 'user-posts'

            ]);
            Route::get('edit/{id}', [
                'uses' => 'TeamsController@edit',
                'as' => 'edit',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'TeamsController@update',
                'as' => 'update',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'TeamsController@destroy',
                'as' => 'delete',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::post('store', [
                'uses' => 'TeamsController@store',
                'as' => 'store'
            ]);

        });
        //end of teams SECTION =================================
        // ===============================================


        // =================================================
        // job-hunting ROUTES start
        Route::group(['prefix' => 'job-hunting', 'as' => 'job::'], function(){

            Route::get('/', [
                'uses' => 'JobHuntingController@index',
                'as' => 'index'

            ]);
            Route::get('job/{slug}', [
                'uses' => 'JobHuntingController@show',
                'as' => 'show'

            ]);
            Route::get('create', [
                'uses' => 'TeamsController@create',
                'as' => 'create'

            ]);

            Route::get('user-jobs', [
                'uses' => 'JobHuntingController@userPosts',
                'as' => 'user-posts'

            ]);
            Route::get('edit/{id}', [
                'uses' => 'TeamsController@edit',
                'as' => 'edit',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'JobHuntingController@update',
                'as' => 'update',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'JobHuntingController@destroy',
                'as' => 'delete',
                'middleware' => 'IsUsersOrAdminPost'
            ]);
            Route::post('store', [
                'uses' => 'JobHuntingController@store',
                'as' => 'store'
            ]);

        });
          });
        // ================================================
        // job-hunting ROUTES end

    // ADMIN ROUTES START
    Route::group(array('prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'as' => 'admin::'), function () {


        Route::get('/', ['uses' => 'AdminController@index', 'as' => 'index']);

        Route::get('/posts', ['uses' => 'AdminPostsController@index', 'as' => 'post']);

        Route::group(['prefix' => 'users', 'as' => 'users::'], function() {

            Route::get('/', [
                'uses' => 'AdminUsersController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'AdminUsersController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{slug}', [
                'uses' => 'AdminUsersController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'AdminUsersController@update',
                'as' => 'update'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'AdminUsersController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'AdminUsersController@store',
                'as' => 'store'
            ]);
            Route::get('banORunBan/{id}', [
                'uses' => 'AdminUsersController@banORunBan',
                'as' => 'ban'
            ]);

        });
        Route::group(['prefix' => 'posts', 'as' => 'posts::'], function(){

            Route::get('/', [
                'uses' => 'AdminPostsController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'AdminPostsController@create',
                'as' => 'create'

            ]);

            Route::get('edit/{id}', [
                'uses' => 'AdminPostsController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{id}', [
                'uses' => 'AdminPostsController@update',
                'as' => 'update'
            ]);
            Route::delete('delete/{id}', [
                'uses' => 'AdminPostsController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'AdminPostsController@store',
                'as' => 'store'
            ]);
            Route::get('banORunBan/{id}', [
                'uses' => 'AdminPostsController@banORunBan',
                'as' => 'ban'
            ]);

        });


        Route::group(['prefix' => 'roles', 'as' => 'roles::'], function(){

            Route::get('/', [
                'uses' => 'RolesController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'RolesController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{slug}', [
                'uses' => 'RolesController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{slug}', [
                'uses' => 'RolesController@update',
                'as' => 'update'
            ]);
            Route::delete('{id}', [
                'uses' => 'RolesController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'RolesController@store',
                'as' => 'store'
            ]);

        });


        Route::group(['prefix' => 'permissions', 'as' => 'permissions::'], function(){

            Route::get('/', [
                'uses' => 'PermissionsController@index',
                'as' => 'index'

            ]);
            Route::get('create', [
                'uses' => 'PermissionsController@create',
                'as' => 'create'

            ]);
            Route::get('edit/{slug}', [
                'uses' => 'PermissionsController@edit',
                'as' => 'edit'
            ]);
            Route::patch('update/{slug}', [
                'uses' => 'PermissionsController@update',
                'as' => 'update'
            ]);
            Route::delete('{id}', [
                'uses' => 'PermissionsController@destroy',
                'as' => 'delete'
            ]);
            Route::post('store', [
                'uses' => 'PermissionsController@store',
                'as' => 'store'
            ]);

        });

    });
    //END OF ADMIN ROUTEs

    //like or dislike route
    Route::get('likeORdis/{class_name}/{object_id}', array('uses' => 'LikeController@likeORdis', 'as' => 'likeORdis'))
        ->where('object_id', '[0-9]+');
    //END OF LIKE DISLIKE

    // about page (app/views/pages/about.blade.php)
    Route::get('about', 'PagesController@about');


    // categories page (app/views/pages/categories.blade.php)
    Route::get('categories', function () {
        return view('pages.categories');
    });

    // contact page (app/views/pages/contact.blade.php)
    Route::get('contact', function () {
        return view('pages.contact');
    });
});



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