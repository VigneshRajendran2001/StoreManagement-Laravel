<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;

class StoreManagement
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
      // dd($user_id);
      if ($user_id != '') {
        return $next($request);
      } else {
        return redirect('/');
      }
    } else {
      return redirect('/');
    }
  }
}
