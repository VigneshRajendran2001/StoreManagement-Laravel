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
      $lastActivity = Session::get('lastActivityTime');

      if (!$lastActivity) {
        Session::put('lastActivityTime', now());
      }

      $inactiveTime = now()->diffInMinutes(Session::get('lastActivityTime'));

      if ($inactiveTime >= 1) {
        Auth::logout();
        Session::flush();
        return redirect('/')->withErrors([
          'status' => 'Your session has expired.Try to Login again',
        ]);
      }

      Session::put('lastActivityTime', now());
    }

    return $next($request);
  }
  // return $next($request);
}
