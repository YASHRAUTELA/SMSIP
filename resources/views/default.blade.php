@extends('layouts.admin')
<!-- main content start-->
@section('content')

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
            	<a href="{{route('photo')}}" style="text-decoration: none;">
	                <div class="r3_counter_box" style="background-color: grey;">
                        <i class="pull-left fa fa-picture-o dollar2 icon-rounded"></i>
                        <div class="stats">
                            <h5 style="color: white;"><strong>Photo Gallary</strong></h5>
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
</div>
		
@endsection