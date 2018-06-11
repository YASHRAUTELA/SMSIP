@extends('layouts.admin')

@section('content')
        <div id="page-wrapper">
        			@if (session('error'))
                        <div class="col-md-8 col-md-offset-2 alert alert-danger">
                            {{ session('error') }}
                            {{ Session::forget('error')}}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="col-md-8 col-md-offset-2  alert alert-success">
                            {{ session('success') }}
                            {{ Session::forget('success')}}
                        </div>
                    @endif
            <div class="main-page login-page ">
                <h2 class="title1">Reset Password</h2>
                <div class="widget-shadow">
                	

                    <div class="login-body">
                        <form action="{{ route('changePassword') }}" method="post">
                        {{ csrf_field() }}

                        

                         <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-6 control-label">Current Password</label>
                            <input id="current_password" type="password" class="lock" name="current_password" placeholder="Enter Current Password"  required autofocus>

                            @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                            @endif

                        </div>  

                         <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-6 control-label">New Password</label>  
                            <input id="new_password" type="password" name="new_password" class="lock" placeholder="Password" required="">
                            @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <label for="confirm_password" class="col-md-6 control-label">Confirm Password</label>  
                            <input id="confirm_password" type="password" name="new_password_confirmation" class="lock" placeholder="Confirm-Password" required="">
                            @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                            @endif

                        </div> 
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
         
@endsection