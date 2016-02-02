<?php

namespace itway\Http\Middleware;

use Closure;
use Auth;
use App;
use Itway\Models\User;

class UserShouldHaveOneTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentTeam = User::find(Auth::user()->id)->currentTeam;
        if(!Auth::guest() && !empty($currentTeam->id))
        {
            return redirect()->to(App::getLocale().'/team/exists');
        }

        return $next($request);
    }
}
