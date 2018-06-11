@extends('layouts.admin')

@section('content')

<div id="page-wrapper" style="background-color: white;">
	<div class="main-page" >
		<div class="col_4">
					@if (session('update_failure'))
					<div class="row">
						<div class="col-md-8 col-md-offset-2  alert alert-danger">
							{{ session('update_failure') }}
						</div>	
					</div>
					@endif
			<a href="{{route('subject')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
			<h4 class="title" style="text-align: center;">Update Subject</h4>

			<div class="container" style="max-width: 800px; max-height: 500px; margin-top: 50px; border: 1px solid #ccc; box-shadow: 10px 10px 10px #ccc;padding: 50px;">
				<form method="POST" action="{{route('updateSubjectData')}}">
				{{csrf_field()}}
					<div class="row">
						<div class="col-md-3">
							<label>ID</label>
						</div>
						<div class="col-md-9 ">
							<input type="text" name="id" class="form-control" value="{{$data->id}}" readonly="true">
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>SUBJECT</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
								<input type="text" name="subject" value="{{$data->subject}}" class="form-control">
								@if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                            	@endif
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>COURSE</label>
						</div>
						<div class="col-md-9 ">
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
						<div class="col-md-3">
							<label>SEMESTER</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
								<select id="semester" name="semester" class="form-control" >
				                 	<option value=<?php echo(isset($data->semester_id)?$data->semester_id:''); ?> selected="selected"  >
				                 		<?php echo(isset($data->semester_id)?$data->semester:''); ?>
				                 	</option>
				                </select>
				                @if ($errors->has('semester'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('semester') }}</strong>
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
			</div>
				
		</div>
	</div>
</div>
@endsection

@push('script')

<script type="text/javascript">
	function myFunction(){
        
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
      $('#course').change(function(){
        $.ajax({
          type:'POST',
          url:'/getSemester',
          data:{
            '_token':$('input[name="_token"]').val(),
            'course_id':$("#course").val()
          },
          success:function(data){
            console.log(data);
            $("#semester").empty();
            $("#semester").append("<option value=''>Select Semester</option>");
            $.each(data,function(key,value){
            	var semester_id='<?php echo($data->semester_id); ?>';
                if(value.id==semester_id){
                	$("#semester").append("<option selected='selected' value='"+value.id+"'>"+value.semester+"</option>");
                }else{
                	$("#semester").append("<option value='"+value.id+"'>"+value.semester+"</option>");
                }
              $("#semester").removeAttr("readonly");
            });
          }
        });
      });
    });

</script>

@endpush
