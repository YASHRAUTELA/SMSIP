<!DOCTYPE HTML>
<html>
<head>
<title>Student Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="{{asset('newadmin/css/bootstrap.css')}}" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="{{asset('newadmin/css/style.css')}}" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="{{asset('newadmin/css/font-awesome.css')}}" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='{{asset("newadmin/css/SidebarNav.min.css")}}' media='all' rel='stylesheet' type='text/css'/>
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
<body class="cbp-spmenu-push">
    <div class="main-content">
      <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
        <aside class="sidebar-left">
          <nav class="navbar navbar-inverse">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
              <h1><a class="navbar-brand" href="#"><span class="fa fa-area-chart"></span> SMSIP<span class="dashboard_text"></span></a></h1>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>

                <li class="treeview">
                  <a href="{{route('default')}}">
                  <i class="fa fa-home"></i> <span>Home</span>
                  </a>
                </li>

                <li class="treeview">
                    <a href="#">
                    <i class="fa fa-pencil-square-o"></i> <span>Login/Signup </span>
                    <ul class="treeview-menu">
                      <li><a href="{{route('login')}}"><i class="fa fa-sign-in"></i> Login </a></li>
                      <li><a href="{{route('register')}}"><i class="fa fa-pencil-square-o"></i>Sign Up </a></li>
                    </ul>
                </li>
              </ul>
            </div>
          </nav>
        </aside>
      </div>
    </div>

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
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <div class="profile_img">   
                                    <span class="fa fa-user" style="font-size: 3em;"></span> <p>Guest</p>
                                    
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    
                                </div>  
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
                                    <span class="prfil-img"><img src="newadmin/images/2.jpg" alt=""> </span> 
                                    <div class="user-name">
                                        <p>{{ Auth::user()->name }}</p>
                                        <span>Administrator</span>
                                    </div>
                                    <i class="fa fa-angle-down lnr"></i>
                                    <i class="fa fa-angle-up lnr"></i>
                                    <div class="clearfix"></div>    
                                </div>  
                            </a>
                            <ul class="dropdown-menu drp-mnu">
                                <li> <a href="#"><i class="fa fa-user"></i> My Account</a> </li>
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

        <div id="page-wrapper" style="background-color: white;">
          <div class="main-page">
            <div class="col_3">
              <div class="col-md-4 widget widget1">
                <a href="{{route('aboutUs')}}" style="text-decoration: none;">
                  <div class="r3_counter_box">
                      <i class="pull-left fa fa-user user1 icon-rounded"></i>
                      <div class="stats">
                        <h5><strong>AboutUs</strong></h5>
                      </div>
                  </div>
                </a>
              </div>

              <div class="col-md-4 widget widget1">
                <a href="{{route('contactUs')}}" style="text-decoration: none;">
                  <div class="r3_counter_box">  
                    <i class="pull-left fa fa-phone user2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Contact Us</strong></h5>
                    </div>  
                  </div>
                </a>
              </div>
                    
              <div class="col-md-4 widget">
                <a href="{{route('photo')}}" style="text-decoration: none; ">
                  <div class="r3_counter_box">
                    <i class="pull-left fa fa-picture-o dollar2 icon-rounded"></i>
                    <div class="stats">
                        <h5><strong>Photo Gallary</strong></h5>
                    </div>
                  </div>
                </a>
              </div>

              <div class="clearfix"> </div>

            </div>

            <div class="row-one widgettable">
              <div class="clearfix"> </div>
            </div>

            <!-- spandan carousel -->
            <div class="charts">        
              <div class="mid-content-top charts-grids">
                <div class="middle-content">
                  <h4 class="title">Spandan</h4>
                  <div id="owl-demo" class="owl-carousel text-center">
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="images/spandan/1.jpg" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="images/spandan/2.jpg" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="images/spandan/3.jpg" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="images/spandan/4.jpg" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="images/spandan/5.jpg" alt="name">
                    </div>
                    <div class="item">
                        <img class="lazyOwl img-responsive" data-src="images/spandan/6.jpg" alt="name">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- spandan carousel -->
            <div class="row-one widgettable">
              <div class="clearfix"> </div>
            </div>

            <!-- impulse Carousel -->
            <div class="charts">        
              <div class="mid-content-top charts-grids">
                <div class="middle-content">
                  <h4 class="title">IMPULSE</h4>

                  <div class="container" style="max-width: 600px;">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">

                        <div class="item active">
                          <img src="{{asset('images/impulse/1.jpg')}}" alt="Los Angeles" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="{{asset('images/impulse/2.jpg')}}" alt="Chicago" style="width:100%;">
                        </div>
                      
                        <div class="item">
                          <img src="{{asset('images/impulse/3.jpg')}}" alt="New York" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="{{asset('images/impulse/4.jpg')}}" alt="New York" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="{{asset('images/impulse/5.jpg')}}" alt="New York" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="{{asset('images/impulse/6.jpg')}}" alt="New York" style="width:100%;">
                        </div>
                    
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- impulse Carousel -->

            <!-- carnival Carousel -->
            <div class="charts">        
              <div class="mid-content-top charts-grids">
                <div class="middle-content">
                  <h4 class="title">Carnival</h4>

                  <div class="container" style="max-width: 600px;">
                    <div id="myCarouse2" class="carousel slide" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                      </ol>

                      <!-- Wrapper for slides -->
                      <div class="carousel-inner">

                        <div class="item active">
                          <img src="{{asset('images/carnival/1.jpg')}}" alt="Los Angeles" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="{{asset('images/carnival/2.jpg')}}" alt="Chicago" style="width:100%;">
                        </div>
                      
                        <div class="item">
                          <img src="{{asset('images/carnival/3.jpg')}}" alt="New York" style="width:100%;">
                        </div>

                        <div class="item">
                          <img src="{{asset('images/carnival/4.jpg')}}" alt="New York" style="width:100%;">
                        </div>
                    
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarouse2" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarouse2" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- carnival Carousel -->

          </div>

          <script  src="{{asset('newadmin/js/index1.js')}}"></script>
        
          <div class="clearfix"> </div>
        
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
</body>
</html>