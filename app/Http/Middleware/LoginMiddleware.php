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
      $user_type = Auth::user()->user_type;
      // $user_email = Auth::user()->email;
      // // $user_id = Auth::user()->id;
      // dd($user_email);
      //   if ($user_id == '') {
      //     return redirect('/');
      //   } else {
      //     return redirect('/dashboard-analytics');
      //   }
      // }
      if ($user_id == '') {
        return redirect('/')->with(['status' => 'Please Login']);
      }
      return redirect('/dashboard-analytics');
      // elseif ($user_type == '1') {
      //   return redirect('/ui/alerts')->with(['status' => 'SuperAdmin Logged In Successfully']);
      // } elseif ($user_type == '2') {
      //   return redirect('auth-register-basic')->with(['status' => 'Admin Logged In Successfully']);
      // } elseif ($user_type == '3') {
      //   return redirect('/ui/toasts')->with(['status' => 'User Logged In Successfully']);
      // } else {
      //   return redirect('/')->withErrors(['status' => 'Authorized users only allowed to this page!!!']);
      // }



      if (Auth::check()) {
        $user_id = Auth::user()->id;
        dd($user_type);
        $auth_user_type = Auth::user()->user_type;
  
        $user_type = User::where('user_type', $auth_user_type)->first();
        dd($user_type);
        if (is_empty($user_type)) {
          return redirect('/');
        } else {
          if ($user_type == '1') {
            return redirect('/ui/alerts')->with(['status' => 'SuperAdmin Logged In Successfully']);
          } elseif ($user_type == '2') {
            return redirect('auth-register-basic')->with(['status' => 'Admin Logged In Successfully']);
          } elseif ($user_type == '3') {
            return redirect('/ui/toasts')->with(['status' => 'User Logged In Successfully']);
          } else {
            return redirect('/')->withErrors(['status' => 'Authorized users only allowed to this page!!!']);
          }
        }
    }

    return $next($request);
  }
}
