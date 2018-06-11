@extends('layouts.admin')

@section('content')
<div style="background-color:#f2f2f2;">
	<div class="col_1">
		<div id="page-wrapper">
			@if(Session::has('error'))
    			<p>{{Session::get('error')}}</p>
    			{{Session::forget('error')}}
    		@endif
		 	<div class="col-md-8 col-md-offset-2 panel panel-primary">
		    	<div class="panel-heading">User Information</div>
		    		<div class="panel-body">
			    		<div class="row well well-sm back">
					    	<div class="col-md-4">
					    		<label>Role</label>
					    	</div>
					    	<div class="col-md-8">
					    		<p>{{Session::get('role')}}</p>
					    	</div>
					    </div>
					    <div class="well well-sm row back">
					    	<div class="col-md-4">
					    		<label>Name</label>
					    	</div>
					    	<div class="col-md-8">
					    		<p>{{$user_data->name}}</p>
					    	</div>
					    </div>

					    <div class="well well-sm row back">
					    	<div class="col-md-4">
					    		<label>Email</label>
					    	</div>
					    	<div class="col-md-8">
					    		<p>{{$user_data->email}}</p>
					    	</div>
					    </div>

					    <div class="well well-sm row back">
					    	<div class="col-md-4">
					    		<label>Image</label>
					    	</div>
					    	<div class="col-md-8">
					    		<img src="{{asset('images/'.$user_data->image_title)}}" height="100" width="100">
					    	</div>
					    </div>

					    <div class="well well-sm row back">
					    	<div class="col-md-4">
					    		<label>Change Image</label>
					    	</div>
					    	<form method="post" action="{{route('changeImage')}}" enctype="multipart/form-data">
					    	{{csrf_field()}}
					    		<div class="col-md-6">
					    		
					    		<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
						    		<input type="file" name="image">
						    	
						    	@if ($errors->has('image'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('image') }}</strong>
					                </span>
					            @endif

						    		<input type="hidden" name="id" value="{{$user_data->id}}">
						    	</div>
						    	<div class="col-md-2">
						    		<button type="submit" class="btn btn-success">Upload</button>
						    	</div>
					    	</form>
					    </div>
					    @if (session('error'))
							<div class="col-md-8 col-md-offset-2 alert alert-danger">
								{{ session('error') }}
							</div>
						@endif
						@if (session('success'))
							<div class="col-md-8 col-md-offset-2  alert alert-success">
								{{ session('success') }}
							</div>
						@endif
					</div>
					<!-- rendering additional information about the user if he/she is not an admin -->
				    	@if(Session::get('role')!='Admin')

						    <h4>Other information:-</h4>
						    @if(Auth::user()->role_id==3)
						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Course</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->course_name}}</p>
						    	</div>
						    </div>
						    @else
						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Department</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->department_name}}</p>
						    	</div>
						    </div>
						    @endif


						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Father Name</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->father_name}}</p>
						    	</div>
						    </div>

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Mother Name</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->mother_name}}</p>
						    	</div>
						    </div>

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Address</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->address}}</p>
						    	</div>
						    </div>

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Contact</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->contact}}</p>
						    	</div>
						    </div>
						    @if(Auth::user()->role_id==3)
						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Registration Date</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->registration_date}}</p>
						    	</div>
						    </div>

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Session</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->session}}</p>
						    	</div>
						    </div>
						    @else
						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Date Of Joining</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->doj}}</p>
						    	</div>
						    </div>
						    @endif
						    

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>Pin</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->pin}}</p>
						    	</div>
						    </div>

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>City</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->city}}</p>
						    	</div>
						    </div>

						    <div class="well well-sm row back">
						    	<div class="col-md-4">
						    		<label>State</label>
						    	</div>
						    	<div class="col-md-8">
						    		<p>{{$user_data->state}}</p>
						    	</div>
						    </div>
				    	@endif
					</div>
		</div>	
	</div>
	<div class="clearfix"></div>
</div>
<br><br><br><br><br><br>

@endsection