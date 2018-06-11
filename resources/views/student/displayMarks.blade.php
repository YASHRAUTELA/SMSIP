@extends('student.myMarks')

@section('others')

<div class="col-md-8 col-md-offset-2 panel panel-info">
	<div class="panel-heading" style="text-align: center;"><h3>My Marks</h3></div>
	<div class="panel-body">
		<div class="row">
			<div style="overflow-x:auto;">
  <table>
    <tr>
      <th style="text-align: center;">Subject</th>
      <th style="text-align: center;">Obtained Marks</th>
      <th style="text-align: center;">Total Marks</th>
    </tr>
    @foreach($marks as $data)
    <tr>
    	<td>{{$data->subject}}</td>
      	<td>{{$data->obtained_marks}}</td>
      	<td>{{$data->total_marks}}</td>
    </tr>
    @endforeach
  </table>
</div>
		</div> 
	</div>
</div>

@endsection