@extends('layouts.admin')

@section('content')

<div id="page-wrapper" style="background-color: white;">
	<div class="main-page" >
		<div class="col_4">
					<div style="height: 100px;">
						@if (session('update_failure'))
						<div class="row" id="flash">
							<div class="col-md-8 col-md-offset-2  alert alert-danger">
								{{ session('update_failure') }}
							</div>	
						</div>
						@endif
					</div>
			<a href="{{route('exams')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></a>
			

			<div class="container" style="max-width: 800px; max-height: 520px; border: 1px solid #ccc; box-shadow: 10px 10px 10px #ccc;padding: 50px;">
			<h4 class="title" style="text-align: center;">Update Subject</h4>
				<form method="POST" action="{{route('updateExam')}}">
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
							<label>EXAM</label>
						</div>
						<div class="col-md-9 ">
							<div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
								<input type="text" name="exam" id="exam" class="form-control" value="{{$data->exam}}" >
								@if ($errors->has('exam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exam') }}</strong>
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
	$(function(){
        $('#flash').delay(500).fadeIn('normal',function(){
            $(this).delay(2000).fadeOut();
        });
    });
</script>
@endpush
