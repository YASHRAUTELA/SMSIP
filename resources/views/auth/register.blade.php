@extends('layouts.admin')

@section('content')
<!-- main content start-->
<div id="page-wrapper">
            <div class="main-page signup-page">
                <h2 class="title1">SignUp Here</h2>
                <div class="sign-up-row widget-shadow">
                    <h5>Personal Information :</h5>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <!-- <input type="hidden" name="status" value="0"> -->
                    <div class="sign-u">
                        <div class="sign-up1">
                            <h4>Select Role* :</h4>
                        </div>
                        <div class="sign-up2">
                            <label>
                                <input type="radio" value="1" name="role" required>
                                Admin
                            </label>

                            <label>
                                <input type="radio" value="2" name="role" required>
                                Faculty
                            </label>

                            <label>
                                <input type="radio" value="3" name="role" required>
                                Student
                            </label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>



                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="sign-u">
                                <input type="text" id="name" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>        
                        <div class="clearfix"> </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="sign-u">
                                    <input type="email" id="email" placeholder="Email Address" value="{{ old('email') }}" name="email" required>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <div class="clearfix"> </div>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <div class="sign-u">
                            <div class="input-group">
                                <span class="input-group-addon">DOB</span>
                                <input type="date" name="dob" value="{{old('dob')}}" required>
                            </div>
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            <div class="clearfix"> </div>
                        </div>
                        <br>
                    </div>


                    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon">SELECT IMAGE</span>
                            <input type="file" name="image" value="{{old('image')}}">
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                                <div class="clearfix"> </div>
                        </div>
                        <p class="help-block">Max. 100KB</p>
                    </div>

                    <h6>Login Information :</h6>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="sign-u">
                                    <input type="password" placeholder="Password" id="password" name="password" required="">
                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            <div class="clearfix"> </div>
                        </div>
                    </div>

                    <div class="sign-u">
                        <input type="password" placeholder="Confirm Password" id="password-confirm" name="password_confirmation" required>
                    </div>

                    
                        <div class="clearfix"> </div>
                    <div class="sub_home">
                            <input type="submit" value="Submit">
                        <div class="clearfix"> </div>
                    </div>
                    <div class="registration">
                        Already Registered.
                        <a class="" href="{{route('login')}}">
                            Login
                        </a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


@endsection


