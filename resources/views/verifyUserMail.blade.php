
<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>
 
<body>
<h2>Welcome to SMS {{$user['name']}}</h2>
<br/>
<h3> 
@if($user['role_id']==1)
	Registered as: Admin
@elseif($user['role_id']==2)
	Registered as: Faculty
@else
	Registered as: Student
@endif
</h3>
The registered email-id is {{$user['email']}} , Please click on the below link to verify your email account
<br/>
<a href="{{url('user/verify', $user->verifyUser->token)}}" class="btn btn-primary">Verify Email</a>
</body>
 
</html>
