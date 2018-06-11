@extends('layouts.admin')

@section('content')
        <div class="col_1" id="page-wrapper">
            <div class="main-page login-page ">
                <h2 class="title1">Reset Password</h2>
                <div class="widget-shadow">
                    <div class="login-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form action="{{ route('password.email') }}" method="post">
                        {{ csrf_field() }}
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <input id="email" type="email" class="user" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>  
                            
                            <input type="submit" style="min-width: 200px;" name="Sign In" value="Send Password Reset Link">
                            
                        </form>
                        @if(Session::has('error'))
                            <div class="alert alert-warning" style="margin-bottom: 0px;">
                                
                                    <h4>{{Session::get('error')}}</h4>
                                    {{Session::forget('error')}}
                             </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
         
@endsection
