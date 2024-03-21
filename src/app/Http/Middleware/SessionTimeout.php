<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(time() - Session::get('login_time') > 5) {
                // dd("12345");
                // Auth::logout();
                // $request->session()->invalidate();    
                // $request->session()->regenerateToken(); 
                // return redirect()->route('login')->with('session_timeout', 'Your session has timed out. Please log in again.');
                // Auth::logout();
                // return route('logout');

                // return redirect() ->route('logout');
            }
        }

        // if (Auth::check()) {
        //     $lastActivity = session('last_activity');
        //     $timeoutInMinutes = config('auth.timeout_lifetime');

        //     if ($lastActivity && now()->diffInMinutes($lastActivity) > $timeoutInMinutes) {
        //         // Auth::logout();
        //         Auth::guard('web')->logout();
        //         return redirect()->route('login')->with('timeout_message', 'You have been logged out due to inactivity.');
        //     }

        //     // Update the last activity time to the current time
        //     session(['last_activity' => now()]);
        // }

        return $next($request);
    }
}
