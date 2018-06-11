@extends('layouts.admin')

@section('content')
        <div id="page-wrapper">
            <div class="main-page login-page ">
                <h2 class="title1">Reset Password</h2>
                <div class="widget-shadow">
                    <div class="login-body">
                        <form action="{{ route('password.request') }}" method="post">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <input id="email" type="email" class="user" name="email" placeholder="Enter Your Email" value="{{ $email or old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif

                        </div>  

                         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>  
                            <input id="password" type="password" name="password" class="lock" placeholder="Password" required="">
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>  
                            <input id="password-confirm" type="password" name="password_confirmation" class="lock" placeholder="Confirm-Password" required="">
                            @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif

                        </div> 
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
         
@endsection

