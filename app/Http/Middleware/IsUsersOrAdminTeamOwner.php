<?php

namespace itway\Http\Middleware;

use Closure;
use Itway\Models\Team;
use Auth;

class IsUsersOrAdminTeamOwner
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
        if( (Team::find($request->id)->owner_id !== Auth::user()->id) && !$request->user()->hasRole('Admin'))
        {
            return redirect()->back();
        }
        return $next($request);    }
}
