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
<div class="col_1" id="page-wrapper" style="background: white;">
	<div class="form-group row add col_1" style="padding: 0px 100px 40px 100px;">
        <div  style="height: 80px; " >
            <div id="flash" class="alert alert-danger print-error-msg" style="display:none; margin-top: -20px; float: right;">
                <ul></ul>
            </div>
        </div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="department" name="department"
					placeholder="Enter Department" required>
				<p class="error text-center alert alert-danger hidden"></p>
			</div>
			<div class="col-md-4">
				<button class="btn btn-primary" type="submit" id="add">
					<span class="glyphicon glyphicon-plus"></span> ADD
				</button>
			</div>
		</div>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="table-responsive text-center">
			<table class="table table-borderless" id="table">
				<thead >
					<tr>
						<th style="text-align: center;">ID</th>
						<th style="text-align: center;">Department Name</th>
						<th style="text-align: center;">Actions</th>
					</tr>
				</thead>
				@foreach($data as $department)	
					<tr class="item{{$department->id}}">
						<td>{{$department->id}}</td>
						<td>{{$department->department_name}}</td>
						<td><button class="edit-modal btn btn-info" data-id="{{$department->id}}" data-department="{{$department->department_name}}">
							<span class="glyphicon glyphicon-edit"></span> Edit
							</button>
							<button class="delete-modal btn btn-danger" data-id="{{$department->id}}" data-department="{{$department->department_name}}">
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
							<label class="control-label col-sm-2" for="department">Department:</label>
							<div class="col-sm-10">
								<input type="department" class="form-control" id="n">
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
        $('#n').val($(this).data('department'));
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
        $('.dname').html($(this).data('department'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {

        $.ajax({
            type: 'POST',
            url: '/editDepartment',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'department': $('#n').val()
            },
            success: function(data) {
                if(data==404){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("department name is required");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }else if(data==401){
                    (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("department name already exist,cannot be updated");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                }
                else{
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.department_name +"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-department='" + data.department_name+ "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-department='" + data.department_name + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("department name updated Successfully");
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
            url: '/addDepartment',
            data: {
                '_token': $('input[name=_token]').val(),
                'department': $('input[name=department]').val()
            },
            success: function(data) {
                if($.isEmptyObject(data.error)){
                    if(data==404){
                        /*displaying department name already exist message*/
                            (function () {
                            var x = document.getElementById("snackbar");
                            $("#snackbar").text("department name already exist");
                            x.className = "show";
                            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);     // I will invoke myself
                            })();
                    }else{
                        $('.error').addClass('hidden');
                        $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.department_name +"</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-department='" + data.department_name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-department='" + data.department_name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");    
                        (function(){
                                var x = document.getElementById("snackbar");
                                $("#snackbar").text("department added successfully");
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
        $('#department').val('');
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
            url: '/deleteDepartment',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                if(data==401){//course already exists in marks table
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("department already exists in faculty table");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                    })();
                }else if(data==200){
                    $('.item' + $('.did').text()).remove();
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("department deleted successfully");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 2000);
                    })();
                }
                else{
                    (function () {
                    var x = document.getElementById("snackbar");
                    $("#snackbar").text("unknown error occurred");
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
