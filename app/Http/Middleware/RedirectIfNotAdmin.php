<?php namespace itway\Http\Middleware;

use Closure;
use Toastr;
class RedirectIfNotAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
    {
        if (\Auth::user()) {

            if ($request->user()->hasRole('Admin') || $request->user()->hasRole('Manager')) {

                return $next($request);

            }
            return redirect("/");

        }
        else {
            Toastr::info("Don't have permission!", "You need to be logged in and be admin" );
            return redirect("/");
        }
	}

}
