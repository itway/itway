<?php

namespace itway\Http\Middleware;

use Closure;
use Auth;

class IsUsersOrAdminEvent
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
        if( (\Itway\Models\Event::find($request->id)->user_id !== Auth::user()->id) && !$request->user()->hasRole('Admin'))
        {
            return redirect()->back();
        }
        return $next($request);
    }
}
