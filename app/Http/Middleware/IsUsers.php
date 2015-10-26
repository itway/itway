<?php

namespace itway\Http\Middleware;

use Closure;

class IsUsers
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
        if($request->user()->id !== \Auth::user()->id) {
            return redirect()->back();
        }

        return $next($request);
    }
}
