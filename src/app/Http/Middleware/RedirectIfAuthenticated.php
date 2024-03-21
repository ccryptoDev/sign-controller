<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }
        
        return $next($request);
    }

    // public function handle($request, Closure $next, $guard = null)
    // {
    //     if (Auth::guard($guard)->check()) {

    //         $sessionTimeout = config('session.timeout_lifetime');

    //         if (time() - Session::get('login_time') > $sessionTimeout ) {
    //             Auth::guard('web')->logout();
    //             return redirect()->route('login')->with('session_expired', 'Your session has expired. Please login again.');
    //             // return redirect() ->route('logout');
    //         }
    //     }

    //     return $next($request);
    // }   
}
