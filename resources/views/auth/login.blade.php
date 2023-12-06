@extends('layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-3">
                <img alt="image" src="{{asset('images/wgroup.png')}}" style='width:250px;'>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
              <h3 class="mb-4 text-center">{{ config('app.name', 'Laravel') }}</h3>
              <form method="POST" action="{{ route('login') }}"  aria-label="{{ __('Login') }}" onsubmit='show()' >
                @csrf
                  <div class="form-group">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus  placeholder="Email">
                  </div>
            <div class="form-group">
              <input id="password-field" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required >
              <span toggle="#password-field" id='no-password' onclick='show_password();' class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            @if($errors->any())
                <div class="form-group alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>{{$errors->first()}}</strong>
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
            </div>
            <div class="form-group d-md-flex">
                <div class="w-50"></div>
                <div class="w-50 text-md-right">
                    {{-- <a href="{{ route('password.request') }}" onclick='show()' style="color: #fff">Forgot Password</a> --}}
                </div>
            </div>
          </form>
        
          </div>
            </div>
        </div>
    </div>
</section>

{{-- 
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('images/logo-login.png')}}" alt="wgroup image">
            </div>
            <form method="POST" action="{{ route('login') }}"  aria-label="{{ __('Login') }}" onsubmit='show()' class="login100-form validate-form">
            @csrf
                <span class="login100-form-title">
                    Member Login
                </span>
                @if($errors->any())
                <div class="alert alert-danger alert-white rounded">
                    <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                    <div class="icon">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <strong>{{$errors->first()}}</strong>
                </div> 
                @endif
                <div class="wrap-input100 validate-input">
                    <input id="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }} input100" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input id="password-field" class="{{ $errors->has('password') ? ' is-invalid' : '' }} input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                    <span toggle="#password-field" id='no-password' onclick='show_password();' class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn submit">
                        Sign In
                    </button>
                </div>

                <div class="text-center p-t-12">
                    <span class="txt1">Forgot</span>
                    <a class="txt2" href="{{ route('password.request') }}" onclick='show()'>Password?</a>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<script>
    function show_password()
    {
        $("#no-password").toggleClass("fa-eye fa-eye-slash");
        var input = $($("#no-password").attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    }
</script>
@endsection
