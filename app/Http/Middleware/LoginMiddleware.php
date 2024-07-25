<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (Auth::check()) {
      $user_id = Auth::user()->id;
      // $user_email = Auth::user()->email;
      // // $user_id = Auth::user()->id;
      // dd($user_email);
      if ($user_id == '') {
        return redirect('/');
      } else {
        return redirect('/dashboard-analytics');
      }
    }

    return $next($request);
  }
}
