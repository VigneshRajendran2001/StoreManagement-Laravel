@extends('layouts/blankLayout')

@section('title', 'Login Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Login -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">@include('_partials.macros',["height"=>20,"withbg"=>'fill: #fff;'])</span>
            <span class="app-brand-text demo text-heading fw-semibold">{{config('variables.templateName')}}</span>
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2">
          <h4 class="mb-2">Welcome to {{config('variables.templateName')}}! 👋</h4>

          @if(Session::has('status'))
            <div class ="alert alert-success">
              {{Session::get('status')}}
          </div>
          @endif

          <!-- @if (session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif -->

          <!-- <p class="mb-4">Please sign-in to your account and start the adventure</p> -->
            <!-- @if($errors->any())
            <div>
              <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            </div>
            @endif -->




            <form id="formAuthentication" class="mb-3" action="{{route('login')}}" method="POST">
           
            @csrf
            @method('POST')
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus>
              <!-- @if($errors->has('email'))
                    <span class="error" style="color:red;">{{$errors->first('email')}}</span>
                     <div class="alert alert-danger">{{$errors->first('email')}}</div>
                    @endif -->
              <label for="email">Email or Username</label>
            </div>
            <div class="mb-3">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  
                  
               
          
          <!-- @if($errors->has('password'))
                    <span class="error" style="color:red;">{{$errors->first('password')}}</span>
                    <div class="alert alert-danger">{{$errors->first('password')}}</div>
                    @endif -->
                    <label for="password">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
            </div>
            
            @if($errors->any())
                <div>
                  <!-- <ul> -->
                    @foreach($errors->all() as $error)
                    <!-- <li style="color:red;">{{$error}}</li> -->
                    <div style="color:red;">{{$error}}</div>
                    @endforeach
                  <!-- </ul> -->
                </div>             
          @endif
          <br>


            <div class="mb-3 d-flex justify-content-between">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  Remember Me
                </label>
              </div>
              <a href="{{url('auth/forgot-password-basic')}}" class="float-end mb-1">
                <span>Forgot Password?</span>
              </a>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="{{url('auth/register-basic')}}">
              <span>Create an account</span>
            </a>
          </p>
        </div>
      </div>
      <!-- /Login -->
      <img src="{{asset('assets/img/illustrations/tree-3.png')}}" alt="auth-tree" class="authentication-image-object-left d-none d-lg-block">
      <img src="{{asset('assets/img/illustrations/auth-basic-mask-light.png')}}" class="authentication-image d-none d-lg-block" alt="triangle-bg">
      <img src="{{asset('assets/img/illustrations/tree.png')}}" alt="auth-tree" class="authentication-image-object-right d-none d-lg-block">
    </div>
  </div>
</div>
@endsection
