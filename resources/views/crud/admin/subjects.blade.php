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

<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"> -->
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
@endsection

@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
    <div class="form-group row add col_1">
        <div  style="height: 100px;">
            <div id="flash" class="alert alert-danger print-error-msg" style="display:none; float:right;">
                <ul></ul>
            </div>
        </div>
            <div class="col-md-3"> 
                <select class="form-control" name="course" id="course">
                    <option>Select Course</option>
                </select>
                <p class="error text-center alert alert-danger hidden"></p>
            </div>

            <div class="col-md-3">
                <select class="form-control" name="semester" id="semester" readonly>
                    <option>Select Semester</option>
                </select>
            </div>

            <div class="col-md-4">
                <input class="form-control" type="text" id="subject" name="subject" placeholder="Enter Subject Name">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary" type="submit" id="add">
                    <span class="glyphicon glyphicon-plus"></span> ADD SUBJECT
                </button>
            </div>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="table-responsive text-center">
            <table class="table table-borderless" id="table">
                <thead >
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">SUBJECT</th>
                        <th style="text-align: center;">COURSE</th>
                        <th style="text-align: center;">SEMESTER</th>
                        <th style="text-align: center;">ACTION</th>
                    </tr>
                </thead>
                @foreach($subject as $data)
                    <tr class="item{{$data->id}}">
                        <td>{{$data->id}}</td>
                        <td>{{$data->subject}}</td>
                        <td>{{$data->course_name}}</td>
                        <td>{{$data->semester}}</td>
                        <td><button class="edit-modal btn btn-info" data-id="{{$data->id}}" data-subject="{{$data->subject}}" data-course="{{$data->course_name}}" data-course_id="{{$data->course_id}}" data-semester="{{$data->semester}}" data-semester_id="{{$data->semester_id}}">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                            </button>
                            <button class="delete-modal btn btn-danger" data-id="{{$data->id}}" data-subject="{{$data->subject}}" data-course_id="{{$data->course_id}}" data-course="{{$data->course_name}}" data-semester="{{$data->semester}}" data-semester_id="{{$data->semester_id}}">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </button>
                        </td>
                </tr>
                @endforeach 
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
                            <label class="control-label col-sm-2" for="city">COURSE:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="n">
                                <input type="hidden" name="course_id" id="nn">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="state2">SEMESTER:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="o">
                                <input type="hidden" name="semester_id" id="oo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="city">SUBJECT:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="p">
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

<script type="text/javascript">
	
	$(document).ready(function() {
            $('#table').DataTable();
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
        $('#n').val($(this).data('course'));
        $('#nn').val($(this).data('course_id'));
        $('#n').attr('readonly','true');
        $('#o').val($(this).data('semester'));
        $('#oo').val($(this).data('semester_id'));
        $('#o').attr('readonly','true');
        $('#p').val($(this).data('subject'));
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
        $('.dname').html($(this).data('subject'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'POST',
            url: '/editSubject',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'course': $('#nn').val(),
                'semester':$('#oo').val(),
                'subject':$('#p').val()
            },
            success: function(data) {
                console.log(data);
                if(data==404){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("subject name, course and semester are required");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }else if(data==401){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("subject with same course and semester already exist");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }
                else if(data==402){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("unknown error occurred, please try again.");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();   
                }
                else{
                    $('.item' + data[0].id).replaceWith("<tr class='item" + data[0].id + "'><td>" + data[0].id + "</td><td>" + data[0].subject +"</td><td>"+data[0].course_name+"</td><td>"+data[0].semester+"</td><td><button class='edit-modal btn btn-info' data-id='" + data[0].id + "' data-subject='" + data[0].subject+ "' data-course='"+data[0].course_name+"'data-course_id='"+data[0].course_id+"'data-semester='"+data[0].semester+"'data-semester_id='"+data[0].semester_id+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data[0].id + "' data-subject='" + data[0].subject + "'data-course='"+data[0].course_name+"'data-course_id='"+data[0].course_id+"'data-semester='"+data[0].semester+"'data-semester_id='"+data[0].semester_id+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");    
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("subject updated successfully");
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
            url: '/addSubject',
            data: {
                '_token': $('input[name=_token]').val(),
                'course': $('select[name=course]').val(),
                'semester':$('select[name=semester]').val(),
                'subject': $('input[name=subject]').val()
            },
            success: function(data) {
                console.log(data);
                if($.isEmptyObject(data.error)){
                    if(data==404){
                        /*displaying exam already exist message*/
                            (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("subject with same name, semester and course already exist");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                    }
                    else{
                        $('.error').addClass('hidden');
                        $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.subject +"</td><td>"+data.course_name+"</td><td>"+data.semester+"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-course='" + data.course + "'data-semester='"+data.semester_id+"'data-subject='"+data.subject+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-course='" + data.course + "'data-semester='"+data.semester_id+"'data-subject='"+data.subject+"'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");    
                            (function(){
                                var x = document.getElementById("snackbar");
                                $("#snackbar").text("subject added successfully");
                                x.className = "show";
                                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                    }
                }
                else{
                    printErrorMsg(data.error);
                }
            },
        });
        $('#city').val('');
        $('#state').val('');
    });

    function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
            displayFlash();
    }

    function displayFlash(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    }

	function myFunction(){
		$.ajax({
                type:'GET',
                url:'/getCourse',
                success:function(data){
                    console.log(data);
                    $("#course").empty();
                    $("#course").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){
                    	$("#course").append("<option value='"+value.id+"'>"+value.course_name+"</option>");
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
            	$("#semester").append("<option value='"+value.id+"'>"+value.semester+"</option>");
                $("#semester").removeAttr("readonly");
            });
          }
        });
      });
    });


    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteSubject',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                if(data==200){
                    $('.item' + $('.did').text()).remove();    
                    (function () {
                        var x = document.getElementById("snackbar");
                        $("#snackbar").text("Subject Deleted Successfully");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                else if(data==404){
                    (function () {
                        var x = document.getElementById("snackbar");
                        $("#snackbar").text("subject already exist in marks table");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                else{
                    (function () {
                        var x = document.getElementById("snackbar2");
                        $("#snackbar").text("unknown error occurred,please try again");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                
            }
        });
    });





    

    /*function deleteInfo(id){
		console.log(id);
		$("#confirm_delete").html("<a class='btn btn-danger' onclick='deleteSubject("+id+")'>Confirm Delete</a>");
		$('#myDeleteModal').modal('show');
	}*/

	/*function deleteSubject(id){
		$.ajax({
            type: 'POST',
            url: '/deleteSubject',
            data: {
            	'_token': $('input[name=_token]').val(),
                'id':id
            },
            success: function(data) {
            	console.log(data);
            	if(data==200){
                    $('.item' + $('.did').text()).remove();    
            		(function () {
					    var x = document.getElementById("snackbar");
                        $("#snackbar").text("Subject Deleted Successfully");
					    x.className = "show";
					    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
					})();
            	}
                else if(data==404){
                    (function () {
                        var x = document.getElementById("snackbar");
                        $("#snackbar").text("subject already exist in marks table");
                        x.className = "show";
                        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                    })();
                }
                else{
            		(function () {
					    var x = document.getElementById("snackbar2");
					    $("#snackbar").text("unknown error occurred,please try again");
					    x.className = "show";
					    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
					})();
            	}
            }
        });
	}
*/

    </script>
	<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript" src={{asset('js/jquery.dataTables.min.js')}}></script>

@endpush
