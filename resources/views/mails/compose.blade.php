@extends('layouts.admin')

@section('content')
<div id="page-wrapper">
	

<div class="col_1" >
	<div class="col-md-8 compose-right widget-shadow" >
					<div class="panel-default">
						<div class="panel-heading">
							Compose New Message 
						</div>
						<div class="panel-body">
							<div style="height: 50px;">
								@if(Session::has('success'))
								<div class="alert alert-success" id="flash">
									<h4>{{Session::get('success')}}</h4>
									{{Session::forget('success')}}
								</div>
								@endif

								@if(Session::has('failure'))
								<div class="alert alert-danger" id="flash">
									<h4>{{Session::get('failure')}}<br>Supported formats are:jpeg,jpg,png,pdf,ppt</h4>
									{{Session::forget('failure')}}
								</div>
								@endif
							</div>
							<form class="com-mail" action="{{route('sendMail')}}" method="POST" enctype="multipart/form-data">
								{{csrf_field()}}

								<input type="hidden" name="user_id" value="{{Session::get('user_id')}}">

								<div class="form-group{{ $errors->has('to_email') ? ' has-error' : '' }}">
									<input type="text" class="form-control1 control3" name="to_email" placeholder="To :" value="{{old('to_email')}}" autofocus >
									@if ($errors->has('to_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to_email') }}</strong>
                                    </span>
                           		 	@endif
								</div>

								<div class="form-group{{ $errors->has('from_email') ? ' has-error' : '' }}">
									<input type="hidden" name="from_email" value="{{Session::get('user_email')}}" value="{{old('from_email')}}">
									@if ($errors->has('from_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('from_email') }}</strong>
                                    </span>
                           		 	@endif
								</div>

								<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
									<input type="text" class="form-control1 control3" name="subject" placeholder="Subject :" value="{{old('subject')}}">
									@if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                           		 	@endif
								</div>

								<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
									<textarea rows="6" class="form-control1 control2" name="message" placeholder="Message :" value=value="{{old('message')}}" ></textarea>
									@if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                           		 	@endif
								</div>

								<div class="form-group">
								<div class="form-group{{ $errors->has('attachment') ? ' has-error' : '' }}">
									<div class="btn btn-default btn-file">
										<i class="fa fa-paperclip"></i> Attachment
										
											<input type="file" name="attachment">
											
										</div>
									</div>
									@if ($errors->has('attachment'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('attachment') }}</strong>
		                                    </span>
		                           		 	@endif
									<p class="help-block">Max. 2MB</p>
								</div>
								
								<input type="submit" value="Send Message"> 

							</form>


						</div>


					</div>
	</div>
</div>
	<div class="clearfix"> </div>	
</div>
@endsection

@push('script')
<script type="text/javascript">
	$(function(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    });
</script>
@endpush