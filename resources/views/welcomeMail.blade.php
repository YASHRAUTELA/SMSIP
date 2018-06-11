<!DOCTYPE html>
<html>
<head>
	<title>Welcome Email</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="panel panel-info">
      <div class="panel-heading" style="text-align: center;">Welcome to Student Management System</div>
      <div class="panel-body">
      <h3 style="text-align: center">Welcome {{$user->name}}</h3><br>
      <p style="text-align: center; padding: 0px 100px;">
      Your email ID-<b> <em>{{$user->email}}</em></b> is successfully registered with us.
      <br><br>
      Now you can continue your services on SMS.
      <br><br>
      And click on the below button to continue redirect to our login page.	
      <br><br>
      <a href="{{route('login')}}"><button class="btn btn-primary"><i class="fa fa-home"  aria-hidden="true">&nbsp;</i>Login to SMS</button></a>
      </p>
      </div>
</div>
</body>
</html>
