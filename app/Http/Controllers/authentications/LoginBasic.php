<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginBasic extends Controller
{
  public function index()
  {
    // $user_id = Auth::user()->id;
    // if ($user_id != '') {
    //   return redirect('dashboard-analytics');
    // } else {
    return view('content.authentications.auth-login-basic');
    // }
  }

  public function auth(Request $request)
  {
    $credentials = $request->only(['email', 'password']);
    $rules = [
      'email' => ['string', 'email', 'required'],
      'password' => ['string', 'required', 'min:6'],
    ];

    $validator = Validator::make($credentials, $rules);
    if ($validator->fails()) {
      if ($request->expectsJson()) {
        return response()->Json(['errors' => $validator->messages(), 'error' => message()->first()], 400);
      }
      return back()
        ->withInput()
        ->withErrors($validator->messages());
    }

    if (Auth::attempt($credentials)) {
      return redirect('/dashboard-analytics')->with(['status' => 'Logged In Successfully...!']);

      // $userData = Auth::user();
      // // $user_id = Auth::user()->id;
      // // $user_id = $userData['id'];
      // // $user_email = Auth::user()->email;
      // // $user_password = Auth::user()->password;
      // Session::put('id', $userData['id']);
      // Session::put('email', $userData['email']);
      // Session::put('password', $userData['password']);

      // dd($user_id);
      // exit();
    }
    return redirect('/')->withErrors([
      'status' => 'Failed to Login.Given Ceredentials does not match...!',
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    // Session::flush();
    return redirect('login');
  }
}
