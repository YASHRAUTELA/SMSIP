@extends('crud.admin.adminDefault')

@section('others')
<a href="{{route('smsStudent')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
			<h4 class="title" style="text-align: center;">Update Student</h4>
					@if (session('update_failure'))
					<div class="row">
						<div class="col-md-8 col-md-offset-2  alert alert-danger">
							{{ session('update_failure') }}
						</div>	
					</div>
					@endif

			
				<form method="POST" action="{{route('updateStudent')}}">
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
								<input class="form-control" type="text" id="name" name="name" maxlength="50" value="{{$data->name}}" required>
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
								<input class="form-control" type="email" id="email" name="email" maxlength="50" value="{{$data->email}}" required>
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
							<label>Father Name</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="father_name" name="father_name" maxlength="50" value="{{$data->father_name}}" required>
								@if ($errors->has('father_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('father_name') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>Mother Name</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
								<input class="form-control" type="text" id="mother_name" name="mother_name" maxlength="50" value="{{$data->mother_name}}" required>
								@if ($errors->has('mother_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mother_name') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Address</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
								<textarea class="form-control" id="address" name="address" rows="4" cols="50" maxlength="100">{{$data->address}}
								</textarea>
								@if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>State</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
								<select id="state" name="state" class="form-control">
				                  	<option>Enter state</option>
				                </select>
				                @if ($errors->has('state'))
		                            <span class="help-block">
		                            	<strong>{{ $errors->first('state') }}</strong>
		                            </span>
		                        @endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>City</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
								<select id="city" name="city" class="form-control" readonly="true">
										<option value=<?php echo(isset($data->city_id)?$data->city_id:''); ?> selected="selected" >

											<?php echo(isset($data->city_id)?$data->city:''); ?>
											
										</option>
										@if ($errors->has('city'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('city') }}</strong>
		                                    </span>
		                            	@endif
				                </select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Contact</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
								<input class="form-control" type="number" min="0" id="contact" name="contact" value="{{$data->contact}}" required>
								@if ($errors->has('contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
						<div class="col-sm-2">
							<label>Course</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
								<select id="course" name="course" class="form-control" >
				                 	<option>Select Course</option>
				                </select>
				                @if ($errors->has('course'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('course') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2">
							<label>Registration Date</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">
								<input class="form-control" type="date" id="registration_date" name="registration_date" value="{{$data->registration_date}}" required>
								@if ($errors->has('registration_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('registration_date') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>

						<div class="col-sm-2">
							<label>Pin</label>
						</div>
						<div class="col-sm-4">
							<div class="form-group{{ $errors->has('pin') ? ' has-error' : '' }}">
								<input class="form-control" type="number" id="pin" name="pin" value="{{$data->pin}}" required>
								@if ($errors->has('pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pin') }}</strong>
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

@push('script')

<script type="text/javascript">
	function myFunction(){
        
            $.ajax({
                type:'GET',
                url:'/getState',
                success:function(data){
                    console.log(data);
                    $("#state").empty();
                    $("#state").append("<option value=''>Select State</option>");
                    $.each(data,function(key,value){
                    	var state_id='<?php echo($data->state_id); ?>';
                    	console.log(state_id);
                    	if(value.id==state_id){
                    		$("#state").append("<option selected='selected' value='"+value.id+"'>"+value.state+"</option>");
                    	}else{
                    		$("#state").append("<option value='"+value.id+"'>"+value.state+"</option>");
                    	}
                        
                    });
                    
                }
            });

            
            $.ajax({
                type:'GET',
                url:'/getCourse',
                success:function(data){
                    console.log(data);
                    $("#course").empty();
                    $("#course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	var course_id='<?php echo($data->course_id); ?>';
                    	if(value.id==course_id){
                    		$("#course").append("<option selected='selected' value='"+value.id+"'>"+value.course_name+"</option>");
                    	}else{
                    		$("#course").append("<option value='"+value.id+"'>"+value.course_name+"</option>");
                    	}
                    	
                        
                    });
                    
                }
            });
        
    }

    $(document).ready(function(){
      $('#state').change(function(){
        $.ajax({
          type:'POST',
          url:'/getCity',
          data:{
            '_token':$('input[name="_token"]').val(),
            'state_id':$("#state").val()
          },
          success:function(data){
            console.log(data);
            $("#city").empty();
            $("#city").append("<option value=''>Select City</option>");
            $.each(data,function(key,value){
            	var city_id='<?php echo($data->city_id); ?>';
                if(value.id==city_id){
                	$("#city").append("<option selected='selected' value='"+value.id+"'>"+value.city+"</option>");
                }else{
                	$("#city").append("<option value='"+value.id+"'>"+value.city+"</option>");
                }
              $("#city").removeAttr("readonly");
            });
          }
        });
      });
    });

</script>

@endpush
