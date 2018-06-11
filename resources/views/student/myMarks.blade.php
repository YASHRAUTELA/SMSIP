@extends('layouts.admin')

@section('style')

<style type="text/css">
	table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    
}

th, td {
    text-align: left;
    padding: 8px;
    text-align: center;
}

tr:nth-child(even){background-color: #f2f2f2
}
</style>
@endsection

@section('content')
<div >
	<div class="col_1" >
		<div id="page-wrapper" style="background-color:white;">
					
		 	<div class="col-md-8 col-md-offset-2 panel panel-primary">
		    	<div class="panel-heading" style="text-align: center;"><h3>Find Marks</h3></div>
		    	<div class="panel-body">
			    	<form class="form-group" method="POST" action="{{route('getResult')}}">
			    	{{csrf_field()}}
			    		<div class="row">
							<div class="col-md-4">
								<div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
									<select id="exam" name="exam" class="form-control">
										<option>Select Exam</option>
									</select>
									@if ($errors->has('exam'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('exam') }}</strong>
	                                    </span>
	                            	@endif
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
									<select id="semester" name="semester" class="form-control" readonly="true">
										<option>Select Semester</option>
									</select>
									@if ($errors->has('semester'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('semester') }}</strong>
	                                    </span>
	                            	@endif
	                            </div>
							</div>
							<div class="col-md-4">
								<button class="btn btn-primary">Get Result&nbsp;<i class="fa fa-hand-o-up"></i></button>
							</div>	
						</div> 
			    	</form>
		    	</div>
			</div>
			@yield('others')
		</div>	
	</div>
	<div class="clearfix"></div>
</div>
<br><br><br><br><br>

@endsection

@push('script')

<script type="text/javascript">
function myFunction(){
			$.ajax({
                type:'GET',
                url:'/getExamData',
                success:function(data){
                    console.log(data);
                    $("#exam").empty();
                    $("#exam").append("<option value=''>Select Exam</option>");
                    $.each(data,function(key,value){
                        $("#exam").append("<option value='"+value.id+"'>"+value.exam+"</option>");
                    });
                    
                }
            });
        }

 $(document).ready(function(){
      $('#exam').change(function(){
        $.ajax({
          type:'POST',
          url:'/getSemesterData',
          data:{
            '_token':$('input[name="_token"]').val(),
            'exam_id':$("#exam").val()
          },
          success:function(data){
            console.log(data);
            $("#semester").empty();
            $("#semester").append("<option value=''>Select Semester</option>");
            $.each(data,function(key,value){
	            $("#semester").append("<option value='"+value.id+"'>"+value.semester+"</option>");
	            $("#semester").removeAttr("readonly");
        	});
          }
        });
      });
    });       
</script>

@endpush