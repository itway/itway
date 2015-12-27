<?php

namespace itway\Http\Middleware;

use Closure;
use Auth;
use App;
use nilsenj\Toastr\Facades\Toastr;

class CheckBannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        if (!Auth::guest() && (Auth::user()->banned == true)) {
            $username = Auth::user()->name;
            Auth::logout();
            Toastr::error('you are banned', $title = $username, $options = []);
            return redirect()->to('/');
        }
        return $response;


    }
}
