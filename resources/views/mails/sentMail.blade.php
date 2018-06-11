@extends('layouts.admin')

@section('content')
<div id="page-wrapper">
	<div class="col_1">
			<div class="col-md-8 col-md-offset-2 widget-shadow">
				<div class="activity_box">
					<h2>Sent Mails</h2>
					<div class="scrollbar" id="style-1">
					@foreach($mail as $data)
						<div class="activity-row">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="mail_id" id="mail_id" value="{{$data->id}}">
							<div class="col-xs-3 activity-img"><img style="height: 50px; width: 50px;" src="{{asset('images/'.$data->image_title)}}" class="img-responsive" alt=""/></div>
							<div class="col-xs-7 activity-desc">
								<h5><a href="#" id="mydata" onclick="sentMail({{$data->id}})" data-toggle="modal" >{{$data->name}}</a></h5>
								<p><b>To:  </b>{{$data->to_email}}</p>
								<p><b>Subject:  </b>{{$data->subject}}</p>
							</div>
							<div class="col-xs-2 activity-desc1"><b>Date:</b><h6>{{$data->created_at}}</h6></div>
							<div class="clearfix"> </div>
						</div>
					@endforeach
					</div>
					
				</div>
			</div>
		<div class="clearfix"> </div>
	</div>

	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      	<div class="modal-content">
	        	<div class="modal-header">
	         	 	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	        	<div class="container">
	        	<div class="row">
	        		<div class="col-md-3" style="word-wrap: break-word; width: 200px; ">
	        			<div class="row">
	        					<label>To: </label>&nbsp;&nbsp;<span id="sender_name"></span><br>	
	        					<a class="modal-title" id="email"></a>
	        			</div>
	        			
	        			<div class="row">
	        				<div class="col-md-12" id="image">
	        					
	        				</div>
	        			</div>
	        		</div>

	        		<div class="col-md-9" style="word-wrap: break-word; width: 350px; ">
	        			<div class="row">
	        				<div class="col-md-12">
	        					<b>Subject:</b><h4 id="subject"></h4>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-md-12">
	        					<b>Message:</b><p id="message"></p>
	        				</div>
	        			</div>
	        			<div class="row">
	        				<div class="col-md-12">
	        					<p id="date"></p>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<div class="row">
	        		<div class="col-md-1">
	        			<label>Attachment</label>	
	        		</div>
	        		<div class="col-md-2">
	        			<div class="thumbnail" id="attachment">
				      </div>
	        		</div>
	        		<div class="col-md-offset-9">
	        		</div>
	        	</div>
	        		<!-- <div class="clearfix"> </div> -->
	        	</div>
	        	
	        </div>
	        <div class="modal-footer">
	         	 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
	 </div>
</div>
	 <script>
	 function sentMail(mail_id){
	 	console.log(mail_id);

	 	$.ajax({
            type: 'POST',
            url: '/sentMailData',
            data: {
            	'_token': $('input[name=_token]').val(),
                'id':mail_id
            },
            success: function(data) {
            	if(data[0].attachment==''){

            		$("#attachment").html("<img style='height:100px; width:100px;' src={{asset('file-uploads/none.png')}}>");
            	}
            	else{
            		$("#attachment").html("<img style='height:100px; width:100px;' src={{asset('file-uploads')}}"+'/'+data[0].attachment+"> <div class='caption'><p style='text-align:center;'><a href='file-uploads/"+data[0].attachment+"' download><span class='glyphicon glyphicon-download-alt'></span></a></p> </div>");
            	}

            	
            	console.log(data[0]);
            	$("#email").text(data[0].to_email);
            	$("#subject").text(data[0].subject);
            	$("#message").text(data[0].message);
            	/*$("#attachment").html("<a href='file-uploads/"+data[0].attachment+"' download><object height='100' width='100' data='file-uploads/"+data[0].attachment+"'></object></a>");*/
            	/*$("#attachment").text(data[0].attachment);*/
		   		$('#myModal').modal('show');
            }
        });
	 }
	 
	 </script>

@endsection