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
  .vl {
    border-left: 2px solid green;
    height: 400px;
}
  </style>

@endsection
@section('content')
<div class="col_1" id="page-wrapper" style="background-color: white;">
<!-- Third Container (Grid) -->
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
            <div class="r3_counter_box" style="background-color: grey;">
                  <i class="pull-left fa fa-phone user2 icon-rounded"></i>
                  <div class="stats">
                      <h5 style="color: white;"><strong>Contact Us</strong></h5>
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
			  <h3 class="">CONTACT US</h3><br><br>
			  <div class="row">
			    <div class="col-sm-6">

			      <div class="row">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3481.8853975155407!2d79.41793071448086!3d29.22692526368201!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39a09d06d829fc01%3A0xfb18770875225c2c!2sAmrapali+Group+Of+Institutes!5e0!3m2!1sen!2sin!4v1526404099675" width="400" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
			    </div>
			    <div class="col-sm-6 vl" style="padding: 100px;"> 
			      <div class="row" >
              <div class="col-md-2">
                <i class="fa fa-phone" style="font-size: 1.2em;">&nbsp;&nbsp;<b>Contacts:</b></i>
              </div>

              <div class="col-md-6 col-md-offset-4" >
                +91 8877667788
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                
              </div>
              <div class="col-md-6 col-md-offset-4" >
                +91 8899776655
              </div>
            </div>

            <div class="row">
              
              <div class="col-md-2">
                <i class="fa fa-envelope">&nbsp;&nbsp;<b>Email:</b></i>
              </div>

              <div class="col-md-6 col-md-offset-4" >
                query@amrapali.ac.in
              </div>

            </div>
            <br>
            <div class="row">

              <div class="col-md-2">
                <a href="https://www.facebook.com/Amrapali-Group-of-Institutes-162261080471302/" target="_blank">
                  <i class="fa fa-facebook-official" style="font-size: 1.2em;"></i>
                </a>
              </div>

              <div class="col-md-2">
                <a href="https://twitter.com/agihld?lang=en" target="_blank">
                  <i class="fa fa-twitter" style="font-size: 1.2em;"></i>  
                </a>
              </div>

            </div>
			    </div>
			    </div>
			  </div>
			</div>
		</div>
</div>
@endsection
