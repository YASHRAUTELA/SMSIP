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
    right: 0;
    top: 100px;
    font-size: 17px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {top: 0; opacity: 0;} 
    to {top: 100px; opacity: 1;}
}

@keyframes fadein {
    from {top: 0; opacity: 0;}
    to {top: 100px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {top: 100px; opacity: 1;} 
    to {top: 0; opacity: 0;}
}

@keyframes fadeout {
    from {top: 100px; opacity: 1;}
    to {top: 0; opacity: 0;}
}
</style>
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
@endsection
@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
    <div class="form-group row add col_1">
        <div  style="height: 80px;">
            <div id="flash" class="alert alert-danger print-error-msg" style="display:none; float:right;">
                <ul></ul>
            </div>
        </div>

        <!-- marks entry form -->
            <div class="col-md-4"> 
                <select class="form-control" name="student" id="student" autofocus="true">
                    <option>Select Student</option>
                </select>
                <p class="error text-center alert alert-danger hidden"></p>
            </div>

            <div class="col-md-4">
                <select class="form-control" name="course" id="course" readonly>
                    <option>Select Course</option>
                </select>
            </div>

            <div class="col-md-4">
                <select class="form-control" name="semester" id="semester" readonly>
                    <option>Select Semester</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <select class="form-control" name="subject" id="subject" readonly>
                    <option>Select Subject</option>
                </select>    
            </div>

            <div class="col-md-4">
                <select class="form-control" name="exam" id="exam">
                    <option>Select Exam</option>
                </select>
            </div>

            <div class="col-md-4">
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <input type="number" min="0" class="form-control" name="obtained_marks" id="obtained_marks" value="0" placeholder="Enter Obtained Marks">
            </div>

            <div class="col-md-4">
                <input type="number" min="0" class="form-control" name="total_marks" id="total_marks" placeholder="Enter Total Marks" value="100">
            </div>

            <div class="col-md-4">
                
            </div>
        </div>

        <div class="row">
            <button class="btn btn-primary" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span> ADD MARKS
                </button>
        </div>

        <!-- marks entry form -->

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                <tr class="item{{$data->id}}">
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->course_name}}</td>
                    <td>{{$data->semester}}</td>
                    <td>{{$data->subject}}</td>
                    <td>{{$data->exam}}</td>
                    <td>{{$data->obtained_marks}}</td>
                    <td>{{$data->total_marks}}</td>
                    <td>
                        <button class="edit-modal btn btn-info" data-id="{{$data->id}}" data-name="{{$data->name}}" data-student_id="{{$data->student_id}}" data-course_id="{{$data->course_id}}" data-course_name="{{$data->course_name}}" data-semester="{{$data->semester}}" data-semester_id="{{$data->semester_id}}" data-subject="{{$data->subject}}" data-subject_id="{{$data->subject_id}}" data-exam="{{$data->exam}}" data-exam_id="{{$data->exam_id}}" data-obtained_marks="{{$data->obtained_marks}}" data-total_marks="{{$data->total_marks}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal btn btn-danger" data-id="{{$data->id}}" data-name="{{$data->name}}" data-student_id="{{$data->student_id}}" data-course_id="{{$data->course_id}}" data-course_name="{{$data->course_name}}" data-semester="{{$data->semester}}" data-semester_id="{{$data->semester_id}}" data-subject="{{$data->subject}}" data-subject_id="{{$data->subject_id}}" data-exam="{{$data->exam}}" data-exam_id="{{$data->exam_id}}" data-obtained_marks="{{$data->obtained_marks}}" data-total_marks="{{$data->total_marks}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>

        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fid" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="student">STUDENT:</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="student_id" id="nn">
                                <input type="text" class="form-control" id="n" readonly="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="course">COURSE:</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="course_id" id="oo">
                                <input type="text" class="form-control" id="o" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="semester">SEMESTER:</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="semester_id" id="pp">
                                <input type="text" class="form-control" id="p" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="subject">SUBJECT:</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="subject_id" id="qq">
                                <input type="text" class="form-control" id="q" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="exam">EXAM:</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="exam_id" id="rr">
                                <input type="text" class="form-control" id="r" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="obtained_marks">OBTAINED MARKS:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="s">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="total_marks">TOTAL MARKS:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="t">
                            </div>
                        </div>
                    </form>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="dname"></span> ? <span
                            class="hidden did"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn actionBtn" data-dismiss="modal">
                            <span id="footer_action_button" class='glyphicon'> </span>
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
<div id="snackbar"></div>
    
@endsection

@push('script')
    
    <script>

    $(document).ready(function() {
            $('#table').DataTable();
        });
        
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



    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.actionBtn').removeClass('delete');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#n').val($(this).data('name'));
        $('#nn').val($(this).data('student_id'));
        $('#o').val($(this).data('course_name'));
        $('#oo').val($(this).data('course_id'));
        $('#p').val($(this).data('semester'));
        $('#pp').val($(this).data('semester_id'));
        $('#q').val($(this).data('subject'));
        $('#qq').val($(this).data('subject_id'));
        $('#r').val($(this).data('exam'));
        $('#rr').val($(this).data('exam_id'));
        $('#s').val($(this).data('obtained_marks'));
        $('#t').val($(this).data('total_marks'));
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.actionBtn').removeClass('edit');
        $('.modal-title').text('Delete');
        $('.did').text($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.dname').html($(this).data('city'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'POST',
            url: '/editMarks',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'student_id':$("#nn").val(),
                'course_id': $('#oo').val(),
                'semester_id':$('#pp').val(),
                'subject_id':$('#qq').val(),
                'exam_id':$('#rr').val(),
                'obtained_marks':$('#s').val(),
                'total_marks':$('#t').val()
            },
            success: function(data) {
                console.log(data);
                if(data==402){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("obtained and total_marks are already exist");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }else if(data==401){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("unknown error occurred, please try again");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }
                else if(data==404){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("obtained and total marks are required");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }
                else{

                    /*check*/
                    /*@foreach($marks as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->course_name}}</td>
                    <td>{{$data->semester}}</td>
                    <td>{{$data->subject}}</td>
                    <td>{{$data->exam}}</td>
                    <td>{{$data->obtained_marks}}</td>
                    <td>{{$data->total_marks}}</td>
                    <td>
                        <button class="edit-modal btn btn-info" data-id="{{$data->id}}" data-name="{{$data->name}}" data-student_id="{{$data->student_id}}" data-course_id="{{$data->course_id}}" data-course_name="{{$data->course_name}}" data-semester="{{$data->semester}}" data-semester_id="{{$data->semester_id}}" data-subject="{{$data->subject}}" data-subject_id="{{$data->subject_id}}" data-exam="{{$data->exam}}" data-exam_id="{{$data->exam_id}}" data-obtained_marks="{{$data->obtained_marks}}" data-total_marks="{{$data->total_marks}}">
                        <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="delete-modal btn btn-danger" data-id="{{$data->id}}" data-name="{{$data->name}}" data-student_id="{{$data->student_id}}" data-course_id="{{$data->course_id}}" data-course_name="{{$data->course_name}}" data-semester="{{$data->semester}}" data-semester_id="{{$data->semester_id}}" data-subject="{{$data->subject}}" data-subject_id="{{$data->subject_id}}" data-exam="{{$data->exam}}" data-exam_id="{{$data->exam_id}}" data-obtained_marks="{{$data->obtained_marks}}" data-total_marks="{{$data->total_marks}}">
                        <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </td>
                </tr>
                @endforeach*/
                    /*check*/



                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name +"</td><td>"+data.course_name+"</td><td>"+data.semester+"</td><td>"+data.subject+"</td><td>"+data.exam+"</td><td>"+data.obtained_marks+"</td><td>"+data.total_marks+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-student_id='" + data.student_id+ "' data-name='"+data.name+"'data-course_id='"+data.course_id+"'data-course_name='"+data.course_name+"'data-semester='"+data.semester+"'data-semester_id='"+data.semester_id+"'data-subject_id='"+data.subject_id+"'data-subject='"+data.subject+"'data-exam='"+data.exam+"'data-exam_id='"+data.exam_id+"'data-obtained_marks='"+data.obtained_marks+"'data-total_marks='"+data.total_marks+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-student_id='" + data.student_id + "'data-name='"+data.name+"'data-course_id='"+data.course_id+"'data-course_name='"+data.course_name+"'data-semester='"+data.semester+"'data-semester_id='"+data.semester_id+"'data-subject_id='"+data.subject_id+"'data-subject='"+data.subject+"'data-exam='"+data.exam+"'data-exam_id='"+data.exam_id+"'data-obtained_marks='"+data.obtained_marks+"'data-total_marks='"+data.total_marks+"'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("marks updated Successfully");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
            }
        });
    });
    $("#add").click(function() {
        $.ajax({
            type: 'post',
            url: '/addMarks',
            data: {
                '_token': $('input[name=_token]').val(),
                'student_id': $('select[name=student]').val(),
                'course_id': $('select[name=course]').val(),
                'semester_id': $('select[name=semester]').val(),
                'subject_id': $('select[name=subject]').val(),
                'exam_id': $('select[name=exam]').val(),
                'obtained_marks': $('input[name=obtained_marks]').val(),
                'total_marks': $('input[name=total_marks]').val()
            },
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){
                    if(data==401){
                        /*displaying exam already exist message*/
                            (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("marks with same details already exist");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                    }
                    else if(data==402){
                        (function(){
                                var x = document.getElementById("snackbar");
                                $("#snackbar").text("unknown error occurred, please try again");
                                x.className = "show";
                                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                    }
                    else{
                        $('.error').addClass('hidden');
                        /*fix it*/
                        $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name +"</td><td>"+data.course_name+"</td><td>"+data.semester+"</td><td>"+data.subject+"</td><td>"+data.exam+"</td><td>"+data.obtained_marks+"</td><td>"+data.total_marks+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'data-student_id='"+data.student_id+"'data-course_name='"+data.course_name+"'data-course_id='"+data.course_id+"'data-semester='"+data.semester+"'data-semester_id='"+data.semester_id+"'data-subject='"+data.subject+"'data-subject_id='"+data.subject_id+"'data-exam='"+data.exam+"'data-exam_id='"+data.exam_id+"'data-obtained_marks='"+data.obtained_marks+"'data-total_marks='"+data.total_marks+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'data-student_id='"+data.student_id+"'data-course_name='"+data.course_name+"'data-course_id='"+data.course_id+"'data-semester='"+data.semester+"'data-semester_id='"+data.semester_id+"'data-subject='"+data.subject+"'data-subject_id='"+data.subject_id+"'data-exam='"+data.exam+"'data-exam_id='"+data.exam_id+"'data-obtained_marks='"+data.obtained_marks+"'data-total_marks='"+data.total_marks+"'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");    
                            (function(){
                                var x = document.getElementById("snackbar");
                                $("#snackbar").text("marks details saved successfully");
                                x.className = "show";
                                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                        /*fix it*/
                    }
                }
                else{
                    printErrorMsg(data.error);
                }
            },
        });
        
        $('#obtained_marks').val(0);
        $('#total_marks').val(100);
    });


    function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
            displayFlash();
    }


    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteMarks',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                if(data==200){//marks deleted successfully
                    $('.item' + $('.did').text()).remove();    
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("data deleted successfully");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                    })();
                }else{//an error occurred
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("an error occurred, please try again");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                    })();    
                }
            }
        });
    });

    function displayFlash(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    }
</script>
<script type="text/javascript" src={{asset('js/jquery.dataTables.min.js')}}></script>
@endpush
