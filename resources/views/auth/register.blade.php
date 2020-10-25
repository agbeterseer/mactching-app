@extends('layouts.base_layout')

@section('content')

<div class="page-lock">
            <div class="page-logo">
                <a class="brand" href="">
                    <img src="{{asset('./img/x-logo.png')}}" alt="logo" /> </a>
            </div>
            <div class="page-body">
                <div class="lock-head"> Register </div>
                <div class="lock-body">
                    <div class="lock-cont">
                     
                        <div class="lock-item">
                        <form method="POST" action="{{ route('register') }}" class="lock-form">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right ">
                                <span style="color:white;">{{ __('Name') }}</span>
                            </label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right ">
                                <span style="color:white;">{{ __('E-Mail Address') }}</span>
                            </label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                            <span style="color:white;">{{ __('Password') }}</span> </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"  name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                            <span style="color:white;">{{ __('Confirm Password') }}</span> </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password"  name="password_confirmation" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                        <div class="form-actions">
                            <button type="submit" class="btn red uppercase">
                                    {{ __('Register') }}
                                </button>

                            
                            </div>
                        </div>
                    </form>
                            <!-- <form class="lock-form pull-left" action="index.html" method="post">
                                <h4>Amanda Smith</h4>
                                <div class="form-group">
                                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn red uppercase">Login</button>
                                </div>
                            </form> -->
                        </div>
                    </div>
                </div>
                <div class="lock-bottom">
                <!-- @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif -->
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="color:#ffffff;">Register</a>
                        @endif
                </div>
            </div>
            <div class="page-footer-custom"> 2020 &copy; MaxifyGlobal. </div>
        </div>
 
@endsection
