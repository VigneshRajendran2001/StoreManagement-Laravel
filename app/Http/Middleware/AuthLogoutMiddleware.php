<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthLogoutMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check()) {
      // Get the last activity time
      $lastActivity = Session::get('lastActivityTime');

      // If there is no last activity time, set it to now
      if (!$lastActivity) {
        Session::put('lastActivityTime', now());
      }

      // Calculate the difference in minutes between now and the last activity time
      $inactiveTime = now()->diffInMinutes(Session::get('lastActivityTime'));
      dd($inactiveTime  );
      // If the inactive time exceeds 1 minute, log the user out
      if ($inactiveTime >= 1) {
        Auth::logout();
        Session::flush();
        return redirect('/')->withErrors([
          'status' => 'Your session has expired due to inactivity.',
        ]);
      }

      // Update the last activity time
      Session::put('lastActivityTime', now());
    }

    return $next($request);
  }
  // return $next($request);
}
