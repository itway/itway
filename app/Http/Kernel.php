<?php

namespace itway\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \itway\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \itway\Http\Middleware\VerifyCsrfToken::class,
        \SourceQuartet\VisitorLog\Middleware\VisitorMiddleware::class,

    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \itway\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \itway\Http\Middleware\RedirectIfAuthenticated::class,
        'Csrf' => \itway\Http\Middleware\VerifyCsrfToken::class,
        'locale' => \itway\Http\Middleware\LocalUser::class,
        'admin' => \itway\Http\Middleware\RedirectIfNotAdmin::class,
        'checkBannedUser' => \itway\Http\Middleware\CheckBannedUser::class,
        'IsUsersOrAdminPost' => \itway\Http\Middleware\IsUsersOrAdminPost::class,
        'IsUsersOrAdminEvent' => \itway\Http\Middleware\IsUsersOrAdminEvent::class,
        'IsUsersOrAdminJobHunt' => \itway\Http\Middleware\IsUsersOrAdminJobHunt::class,
        'IsUsersOrAdminOpenSource' => \itway\Http\Middleware\IsUsersOrAdminOpenSource::class,
        'IsUsersOrAdminTeamOwner' => \itway\Http\Middleware\IsUsersOrAdminTeamOwner::class,
        'IsUsers' => \itway\Http\Middleware\IsUsers::class,
        'UserShouldHaveOneTeam' =>  \itway\Http\Middleware\UserShouldHaveOneTeam::class,
    ];
}
