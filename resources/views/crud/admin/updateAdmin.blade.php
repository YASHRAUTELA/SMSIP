@extends('crud.admin.adminDefault')

@section('others')
<a href="{{route('smsAdmin')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
			<h4 class="title" style="text-align: center;">Update Admin</h4>
					@if (session('update_failure'))
					<div class="row">
						<div class="col-md-8 col-md-offset-2  alert alert-danger">
							{{ session('update_failure') }}
						</div>	
					</div>
					@endif

			
				<form method="POST" action="{{route('updateAdmin')}}">
				{{csrf_field()}}
					<div class="row">
						<div class="col-sm-2">
							<img src="{{asset('images/'.$data->image_title)}}" style="height: 100px; width: 80px;">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>ID</label>
						</div>
						<div class="col-sm-4">
							
								<input type="" class="form-control" id="id" name="id" readonly="true" value="{{$data->id}}" required>
								
						</div>
						<div class="col-sm-2">
							<label>Name</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="name" name="name" value="{{$data->name}}" required>
								@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Email</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<input class="form-control" type="email" id="email" name="email" value="{{$data->email}}" required>
								@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>DOB</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
								<input class="form-control" type="date" id="dob" name="dob" value="{{$data->dob}}" required>
								@if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<button type="submit" class="btn btn-warning">Update</button>
						</div>
					</div>
				</form>
@endsection

