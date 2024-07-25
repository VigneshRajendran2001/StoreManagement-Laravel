<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
// use App\Http\Controllers\authentications\Hash;
use Illuminate\Support\Facades\Hash;

class RegisterBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-register-basic');
  }

  public function store(Request $request, $id = null)
  {
    return $this->update($request, $id);
  }

  public function update(Request $request, $id)
  {
    $input = $request->all();
    // dd($input);
    // exit();
    $rules = [
      'name' => ['string', 'required'],
      'email' => ['string', 'required', 'email', 'unique:users,email'],
      'password' => ['string', 'required', 'min:6'],
    ];

    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
      if ($request->expectsJson()) {
        return response()->Json(['errors' => $validator->messages(), 'error' => $validator->messages()->first()], 400);
      }
      return back()
        ->withInput()
        ->withErrors($validator->messages());
    }

    $input['password'] = Hash::make($input['password']);
    // dd($input);
    // exit();
    User::create($input);
    return redirect()
      ->route('auth-login-basic')
      ->with(['status' => 'Success', 'message' => 'User Created Successfully']);
  }
}
