<!DOCTYPE HTML>
<html>
<head>
<title>Student Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

@yield('style')
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
</script>
<!-- Bootstrap Core CSS -->
<link href="{{asset('newadmin/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{asset('newadmin/css/style.css')}}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('font-awesome/css/font-awesome.css')}}">
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href="{{asset('newadmin/css/SidebarNav.min.css')}}" media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->
 
 <!-- js-->
<script src="{{asset('newadmin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('newadmin/js/modernizr.custom.js')}}"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- chart -->
<script src="{{asset('newadmin/js/Chart.js')}}"></script>
<!-- //chart -->

<!-- Metis Menu -->
<script src="{{asset('newadmin/js/metisMenu.min.js')}}"></script>
<script src="{{asset('newadmin/js/custom.js')}}"></script>
<link href="{{asset('newadmin/css/custom.css')}}" rel="stylesheet">
<!--//Metis Menu -->
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
</style>
<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
<script src="{{asset('newadmin/js/pie-chart.js')}}" type="text/javascript"></script>
 <script type="text/javascript">

        $(document).ready(function () {
            $('#demo-pie-1').pieChart({
                barColor: '#2dde98',
                trackColor: '#eee',
                lineCap: 'round',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-2').pieChart({
                barColor: '#8e43e7',
                trackColor: '#eee',
                lineCap: 'butt',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

            $('#demo-pie-3').pieChart({
                barColor: '#ffc168',
                trackColor: '#eee',
                lineCap: 'square',
                lineWidth: 8,
                onStep: function (from, to, percent) {
                    $(this.element).find('.pie-value').text(Math.round(percent) + '%');
                }
            });

           
        });

    </script>
<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->

	<!-- requried-jsfiles-for owl -->
					<link href="{{asset('newadmin/css/owl.carousel.css')}}" rel="stylesheet">
					<script src="{{asset('newadmin/js/owl.carousel.js')}}"></script>
						<script>
							$(document).ready(function() {
								$("#owl-demo").owlCarousel({
									items : 3,
									lazyLoad : true,
									autoPlay : true,
									pagination : true,
									nav:true,
								});
							});
						</script>
					<!-- //requried-jsfiles-for owl -->
</head> 
<body class="cbp-spmenu-push" onload="myFunction()">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left" style="overflow-y: auto;">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="#"><span class="fa fa-users"></span> SMS<span class="dashboard_text">&IPBSF</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">MAIN NAVIGATION</li>
              <li class="treeview">
                <a href="{{route('default')}}">
                <i class="fa fa-home"></i> <span>Home</span>
                </a>
              </li>
			  
              @guest
              	<li class="treeview">
	                <a href="#">
	                <i class="fa fa-pencil-square-o"></i> <span>Login/Signup </span>
	                <ul class="treeview-menu">
	                  <li><a href="{{route('login')}}"><i class="fa fa-sign-in"></i> Login </a></li>
	                  <li><a href="{{route('register')}}"><i class="fa fa-pencil-square-o"></i>Sign Up </a></li>
					 </ul>
	            </li>  
              @else
	            <li class="treeview">
	                <a href="#">
	                <i class="fa fa-envelope"></i> <span>Mailbox </span>
	                <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
	                  <li><a href="{{route('inbox')}}"><i class="fa fa-angle-right"></i> Mail Inbox </a></li>
	                  <li><a href="{{route('composeMail')}}"><i class="fa fa-angle-right"></i> Compose Mail </a></li>
	                  <li><a href="{{route('sentMail')}}"><i class="fa fa-angle-right"></i> Sent Mail </a></li>
					 </ul>
	            </li>
	            @if(Auth::user()->role_id==3)
	            <li class="treeview">
	                <a href="{{route('myMarks')}}">
	                <i class="fa fa-table"></i> <span>My Marks</span>
	                </a>
            	</li>
            	@endif

	        @if(Auth::user()->role_id==1)    
	            <li class="treeview">
	                <a href="{{route('course')}}">
	                <i class="fa fa-graduation-cap"></i> <span>Course</span>
	                </a>
            	</li>


                <li class="treeview">
	                <a href="{{route('department')}}">
	                <i class="fa fa-building"></i> <span>Department</span>
	                </a>
              	</li>

              	<li class="treeview">
	                <a href="{{route('city')}}">
	                <i class="fa fa-map-signs"></i> <span>City</span>
	                </a>
              	</li>

              	<li class="treeview">
	                <a href="{{route('state')}}">
	                <i class="fa fa-globe"></i> <span>State</span>
	                </a>
              	</li>

              	<li class="treeview">
	                <a href="{{route('semester')}}">
	                <i class="fa fa-asterisk "></i> <span>Semester</span>
	                </a>
              	</li>

              	<li class="treeview">
	                <a href="{{route('subject')}}">
	                <i class="fa fa-book "></i> <span>Subject</span>
	                </a>
              	</li>

              	<li class="treeview">
	                <a href="{{route('exams')}}">
	                <i class="fa fa-database "></i> <span>Exam</span>
	                </a>
              	</li>

	            <li class="treeview">
	                <a href="{{route('marks')}}">
	                <i class="fa fa-table"></i> <span>Marks</span>
	                </a>
              	</li>

              	<li class="treeview">
	                <a href="#">
	                <i class="fa fa-user"></i> <span>User</span>
	                <i class="fa fa-angle-left pull-right"></i>
	                </a>
	                <ul class="treeview-menu">
	                  <li><a href="{{route('smsAdmin')}}"><i class="fa fa-angle-right"></i>Admin</a></li>
	                  <li><a href="{{route('smsStudent')}}"><i class="fa fa-angle-right"></i>Student</a></li>
	                  <li><a href="{{route('smsFaculty')}}"><i class="fa fa-angle-right"></i>Faculty</a></li>
	                </ul>
	            </li> 

              	<li class="treeview">
	                <a href="{{route('student')}}">
	                <i class="fa fa-user-plus"></i> <span>Student Registration</span>
	                </a>
              	</li>
              <br>
		<br>
		<br>
		<br>
	        @endif
              @endguest
			

            
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush" data-toggle="tooltip" data-placement="right" title="Menu Bar"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
					<div class="clearfix"> </div>
				
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				<div class="profile_details">		
					<ul>
						@guest
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-user" style="font-size: 3em;"></span> <p>Guest</p>
								
									
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									
								
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>Login</a></li>
                            	<li><a href="{{ route('register') }}"><i class="fa fa-pencil-square-o"></i>Register</a></li>
							</ul>
			 			</li>
						@else
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img height="50" width="50" src="{{asset('images/'.Auth::user()->image_title)}}" alt=""> </span> 
									<div class="user-name">
										<p>{{ Auth::user()->name }}</p>
										<span>{{Session::get('role')}}</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="{{route('myProfile')}}"><i class="fa fa-user"></i> My Profile</a> </li> 
								<li> <a href="{{route('displayChangePassword')}}"><i class="fa fa-cogs"></i> Change Password</a> </li> 



								<li> <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> Logout    
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                               
                               	</li>
							</ul>
						@endguest
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		
		<!-- //header-ends -->
		@yield('content')		
	<!-- for amcharts js -->
			<script src="{{asset('newadmin/js/amcharts.js')}}"></script>
			<script src="{{asset('newadmin/js/serial.js')}}"></script>
			<script src="{{asset('newadmin/js/export.min.js')}}"></script>
			<link rel="stylesheet" href="{{asset('newadmin/css/export.css')}}" type="text/css" media="all" />
			<script src="{{asset('newadmin/js/light.js')}}"></script>
	<!-- for amcharts js -->

    <script  src="{{asset('newadmin/js/index1.js')}}"></script>
		
			<div class="clearfix"> </div>
			
		</div>
	<!--footer-->
		<div class="footer" style="position: fixed; bottom: 0; left: 0; right: 0;">
           <p>&copy; 2018 All Rights Reserved | Designed by Yashwant Rautela.</p>       
        </div>
    <!--//footer-->
	</div>
		
	<!-- new added graphs chart js-->
	
    <script src="{{asset('newadmin/js/Chart.bundle.js')}}"></script>
    <script src="{{asset('newadmin/js/utils.js')}}"></script>
	
	<script>
    </script>
	<!-- new added graphs chart js-->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="{{asset('newadmin/js/classie.js')}}"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="{{asset('newadmin/js/jquery.nicescroll.js')}}"></script>
	<script src="{{asset('newadmin/js/scripts.js')}}"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='{{asset("newadmin/js/SidebarNav.min.js")}}' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- for index page weekly sales java script -->
	<script src="{{asset('newadmin/js/SimpleChart.js')}}"></script>
    
	<!-- //for index page weekly sales java script -->
	
	
	<!-- Bootstrap Core JavaScript -->
   <script src="{{asset('newadmin/js/bootstrap.js')}}"> </script>
	<!-- //Bootstrap Core JavaScript -->
	<script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"').tooltip();
        });
    </script>
    
    @stack('script')
</body>
</html>