@extends('layouts.admin')

@section('style')

    <style>

#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}
</style>
    <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">

@endsection

@section('content')

<div id="page-wrapper" style="background-color: white;">
<div class="main-page" >
    <div class="col_4">
                @if (session('success'))
                    <div class="row" id="flash">
                        <div class="col-md-8 col-md-offset-2  alert alert-success">
                            {{ session('success') }}
                        </div>  
                    </div>
                @endif
                @if (session('error'))
                    <div class="row" id="flash">
                        <div class="col-md-8 col-md-offset-2  alert alert-danger">
                            {{ session('error') }}
                        </div>  
                    </div>
                @endif
            <div class="row">
                <h1 style="text-align: center;">Student Marks</h1>
            </div>      
        <div>
            <div class="row">
                <form method="post" action="{{route('addMarks')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                            <select class="form-control" name="student" id="student" autofocus="true">
                                <option>Select Student</option>
                            </select>
                            @if ($errors->has('student'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('course') ? ' has-error' : '' }}">
                            <select class="form-control" name="course" id="course" readonly>
                                <option>Select Course</option>
                            </select>
                            @if ($errors->has('course'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('course') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('semester') ? ' has-error' : '' }}">
                        <select class="form-control" name="semester" id="semester" readonly>
                            <option>Select Semester</option>
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
                    

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                        <select class="form-control" name="subject" id="subject" readonly>
                            <option>Select Subject</option>
                        </select>
                        @if ($errors->has('subject'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
                        <select class="form-control" name="exam" id="exam">
                            <option>Select Exam</option>
                        </select>
                        @if ($errors->has('exam'))
                            <span class="help-block">
                                <strong>{{ $errors->first('exam') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="col-md-4"></div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('marks_obtained') ? ' has-error' : '' }}">
                        <input type="number" min="0" class="form-control" name="marks_obtained" id="marks_obtained" value="0" placeholder="Enter Obtained Marks">
                        @if ($errors->has('marks_obtained'))
                            <span class="help-block">
                                <strong>{{ $errors->first('marks_obtained') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group{{ $errors->has('total_marks') ? ' has-error' : '' }}">
                        <input type="number" min="0" class="form-control" name="total_marks" id="total_marks" placeholder="Enter Total Marks" value="100">
                        @if ($errors->has('total_marks'))
                            <span class="help-block">
                                <strong>{{ $errors->first('total_marks') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i> Add Marks</button>
                    </div>
                </div>

                    
                </form> 
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="table-responsive text-center">
        <table class="table table-borderless" id="table">
            <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">STUDENT</th>
                    <th style="text-align: center;">COURSE</th>
                    <th style="text-align: center;">SEMESTER</th>
                    <th style="text-align: center;">SUBJECT</th>
                    <th style="text-align: center;">EXAM</th>
                    <th style="text-align: center;">OBTAINED MARKS</th>
                    <th style="text-align: center;">TOTAL MARKS</th>
                    <th style="text-align: center;">ACTION</th>

                </tr>
            </thead>
            <tbody>
                @foreach($marks as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->course_name}}</td>
                    <td>{{$data->semester}}</td>
                    <td>{{$data->subject}}</td>
                    <td>{{$data->exam}}</td>
                    <td>{{$data->obtained_marks}}</td>
                    <td>{{$data->total_marks}}</td>
                    <td><a href="{{url('/editMarks',$data->id)}}" class="btn btn-warning"><i class="fa fa-edit">Edit
                    </i></a>
                    <a href="#" onclick="deleteInfo({{$data->id}})" data-toggle="modal" class="btn btn-danger" ><i class="fa fa-trash">Delete</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="myDeleteModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Admin</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Do you really want to delete this Subject <span id="user_name" style="font-weight: bold; font-size: 14px;"></span>?</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="confirm_delete">
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>


<div class="modal fade" id="myDeleteModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete Admin</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="alert alert-danger">
                    <strong>Do you really want to delete this Subject <span id="user_name" style="font-weight: bold; font-size: 14px;"></span>?</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" id="confirm_delete">
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<div id="snackbar">Data Deleted Successfully..</div>
@endsection

@push('script')

<script type="text/javascript">
    function deleteInfo(id){
        console.log(id);
        $("#confirm_delete").html("<a class='btn btn-danger' onclick='deleteSubject("+id+")'>Confirm Delete</a>");
        $('#myDeleteModal').modal('show');
    }

    function deleteSubject(id){
        $.ajax({
            type: 'POST',
            url: '/deleteMarks',
            data: {
                '_token': $('input[name=_token]').val(),
                'id':id
            },
            success: function(data) {
                console.log(data);
                
                if(data==200){
                    (function () {
                        var x = document.getElementById("snackbar");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }else{
                    (function () {
                        var x = document.getElementById("snackbar2");
                        $("#snackbar").text("data cannot be deleted due to some foreign key constraint");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                setInterval(myTimer, 2000);
                function myTimer(){
                    window.location="{{route('marks')}}";
                }

            }
        });
    }


    function myFunction(){
        $.ajax({
                type:'GET',
                url:'/getStudent',
                success:function(data){
                    console.log(data);
                    $("#student").empty();
                    $("#student").append("<option value=''>Select Student</option>");
                    $.each(data,function(key,value){
                        $("#student").append("<option value='"+value.id+"'>"+value.name+"("+value.id+")"+"</option>");
                    });
                    
                }
            });

        $.ajax({
                type:'GET',
                url:'/getExam',
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
      $('#student').change(function(){
        $.ajax({
          type:'POST',
          url:'/getStudentCourse',
          data:{
            '_token':$('input[name="_token"]').val(),
            'student_id':$("#student").val()
          },
          success:function(data){
            console.log(data);
            $("#course").empty();
            $("#course").append("<option value=''>Select Course</option>");
            $("#course").append("<option value='"+data.id+"' selected='selected'>"+data.course_name+"</option>");
            $("#course").removeAttr("readonly");
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
                        $("#semester").append("<option value='"+value.id+"'>"+value.semester+"</option>");
                        $("#semester").removeAttr("readonly");
                    });
                  }
                });
          }
        });
      });
    });

    $(document).ready(function(){
      $('#semester').change(function(){
        $.ajax({
          type:'POST',
          url:'/getCourseSemesterSubject',
          data:{
            '_token':$('input[name="_token"]').val(),
            'semester_id':$("#semester").val()
          },
          success:function(data){
            console.log(data);
            $("#subject").empty();
            $("#subject").append("<option value=''>Select Subject</option>");
            $.each(data,function(key,value){
                $("#subject").append("<option value='"+value.id+"'>"+value.subject+"</option>");
                $("#subject").removeAttr("readonly");
            });
          }
        });
      });
    });



    $(function(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    });

    $(document).ready(function() {
            $('#table').DataTable();
        });


    </script>

<!--     <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
        <script type="text/javascript" src={{asset('js/jquery.dataTables.min.js')}}></script>

@endpush
