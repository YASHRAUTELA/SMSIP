@extends('layouts.admin')

@section('style')
  <style>
  
  .font{
    font-size: 16px;
  }
  .bg-1 { 
      background-color: #1abc9c; /* Green */
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  .bg-3 { 
      background-color: #ffffff; /* White */
      color: #555555;
  }
  .bg-4 { 
      background-color: #2f2f2f; /* Black Gray */
      color: #fff;
  }
  .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
  }
  </style>

@endsection
@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
<!-- Third Container (Grid) -->
  <div class="main-page">
      <div class="col_3">
          <div class="col-md-4 widget widget1">
            <a href="#" style="text-decoration: none;">
              <div class="r3_counter_box" style="background-color: grey;">
                <i class="pull-left fa fa-user user1 icon-rounded"></i>
                <div class="stats">
                  <h5  style="color: white;"><strong>AboutUs</strong></h5>
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
              <div class="r3_counter_box">
                <i class="pull-left fa fa-picture-o dollar2 icon-rounded"></i>
                <div class="stats">
                    <h5><strong>Photo Gallary</strong></h5>
                </div>
              </div>
            </a>
          </div>
        <div class="clearfix"></div>
      </div>

      <div class="container-fluid bg-3 text-center">    
        <h3 class="">ABOUT US</h3><br>
        <div class="row">
          <div class="col-sm-4">
            <p class="font">Best Education Institute</p>
            <img src="{{asset('images/college/1.jpg')}}" class="img-responsive" style="width:300px; height: 300px;" alt="Image">
          </div>
          <div class="col-sm-4"> 
            <p class="font">Provides Best Qualification</p>
            <img src="{{asset('images/college/4.jpg')}}" class="img-responsive" style="width:300px; height: 300px;" alt="Image">
          </div>
          <div class="col-sm-4"> 
            <p class="font">Large Libraries</p>
            <img src="{{asset('images/college/7.jpg')}}" class="img-responsive" style="width:300px; height: 300px;" alt="Image">
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4"> 
            <p class="font">Best Ever Faculties </p>
            <img src="{{asset('images/college/8.jpg')}}" class="img-responsive" style="width:300px; height: 300px;" alt="Image">
          </div>

          <div class="col-sm-4"> 
            <p class="font">Best Quality Education</p>
            <img src="{{asset('images/college/5.jpg')}}" class="img-responsive" style="width:300px; height: 300px;" alt="Image">
          </div>

          <div class="col-sm-4"> 
            <p class="font">Best Ever Infrastructure</p>
            <img src="{{asset('images/college/6.jpg')}}" class="img-responsive" style="width:300px; height: 300px;" alt="Image">
          </div>
        </div>

      </div>
    </div>
</div>
@endsection
