@extends('layouts.admin')

@section('content')

<div id="page-wrapper" style="background-color: white;">
<div class="main-page" >
	<div class="col_4">
		
			<div class="row">
				<h1 style="text-align: center;">Semester</h1>
	    	</div>		
	    <div style="padding: 0px 200px;">
	    	<div class="row">
	    		<form method="post" action="{{route('addSemester')}}">
	    		{{csrf_field()}}
	    			<div class="col-md-6">
		    			<select class="form-control" name="course" id="add_course">
		    				<option>Select Course</option>
		    			</select>
		    		</div>
		    		<div class="col-md-4">
		    			<button type="submit" class="btn btn-primary">Add Semester</button>
		    		</div>
	    		</form>	
	    	</div>

	    	<div class="row">
	    		<form method="post" action="{{route('deleteSemester')}}">
	    		{{csrf_field()}}
	    			<div class="col-md-6">
		    			<select class="form-control" name="course" id="del_course">
		    				<option>Select Course</option>
		    			</select>
		    		</div>
		    		<div class="col-md-4">
		    			<button type="submit" class="btn btn-danger">Delete Semester</button>
		    		</div>
	    		</form>	
	    	</div>
		</div>
		<div class="clearfix"></div>

		<div style="padding: 50px 200px 50px 100px;">
			<div class="row">
				<div class="col-md-2 col-sm-2">ID</div>
				<div class="col-md-5 col-sm-5">SEMESTER</div>
				<div class="col-md-5 col-sm-5">COURSE</div>

			</div>
			@foreach($data as $semester)
				<div class="row alert alert-info">
					<div class="col-md-2 col-sm-2">{{$semester->id}}</div>
					<div class="col-md-5 col-sm-5">{{$semester->semester}}</div>
					<div class="col-md-5 col-sm-5">{{$semester->course_name}}</div>
				</div>
				<div class="clearfix"></div>
			@endforeach
			{{ $data->links() }}
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
                url:'/getCourseForSemester',
                success:function(data){
                    console.log(data);
                    $("#add_course").empty();
                    $("#add_course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	$("#add_course").append("<option value='"+value.id+"'>"+value.course_name+"</option>");
                    	
                    });
                    
                }
            });

		$.ajax({
                type:'GET',
                url:'/getDeleteCourseForSemester',
                success:function(data){
                    console.log(data);
                    $("#del_course").empty();
                    $("#del_course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	$("#del_course").append("<option value='"+value.id+"'>"+value.course_name+"</option>");
                    	
                    });
                    
                }
            });
	}
</script>

@endpush
