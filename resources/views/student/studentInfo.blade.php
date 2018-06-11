@extends('layouts.admin')

@section('style')
  
  <style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input,textarea,select {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid,textarea.invalid,select.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
@endsection


@section('content')
  <div class="col_1" id="page-wrapper" style="background-color: white;">
    @if (session('error'))
            <div class="col-md-8 col-md-offset-2 alert alert-danger">
              {{ session('error') }}
              {{ Session::forget('error')}}
            </div>
            @endif
          @if (session('success'))
            <div class="col-md-8 col-md-offset-2  alert alert-success">
              {{ session('success') }}
              {{ Session::forget('success')}}
            </div>
          @endif
    <div class="form-group row add">
      <div class="col-md-10 col-md-offset-1">
        <form id="regForm" method="post" action="{{route('addStudentInfo')}}">
        {{csrf_field()}}
          <h1>Student Information:</h1><br>
          <!-- One "tab" for each step in the form: -->
          <div class="tab">
            
            <select id="user_id" name="user_id">
              <option>Select Student</option>
            </select>
            
            <select id="course_id" name="course_id">
              <option>Select Course</option>
            </select>
            
          </div>

          <div class="tab">
            <div class="row">
                <input placeholder="Father Name" name="father" id="father" maxlength="50">
            </div>

            <div class="row">
                <input placeholder="Mother Name" name="mother" id="mother" maxlength="50">
            </div>
          </div>

          <div class="tab">Address:
            <div class="row">
                <textarea name="address" id="address" rows="2" cols="50" maxlength="100" placeholder="Enter Student Address" ></textarea>
            </div>

            <div class="row">
                <select id="state" name="state">
                  <option>Enter state</option>
                </select>
            </div>

            <div class="row">
                <select id="city" name="city" disabled="true">
                  <option>Select City</option>
                </select> 
            </div>
            <div class="row">
                <input placeholder="Enter pin" id="pin" name="pin" maxlength="6">
            </div>
          </div>

          <div class="tab">Other Information:
            <div class="row">
              <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                <input placeholder="Contact" id="contact" name="contact" maxlength="10">
                @if ($errors->has('contact'))
                  <span class="help-block">
                    <strong>{{ $errors->first('contact') }}</strong>
                  </span>
                @endif
              </div>
            </div>

              <div class="row">
                <div class="form-group{{ $errors->has('registration_date') ? ' has-error' : '' }}">
                  <input type="date" id="registration_date" name="registration_date" min="2018-01-01">
                </div>
                @if ($errors->has('registration_date'))
                  <span class="help-block">
                    <strong>{{ $errors->first('registration_date') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div style="overflow:auto;">
              <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
              </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
            </div>
            </form>
            @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          </div>

      </div>
    </div>

@endsection

@push('script')

  <script>
function myFunction(){
        
            $.ajax({
                type:'GET',
                url:'/getState',
                success:function(data){
                    console.log(data);
                    $("#state").empty();
                    $("#state").append("<option>Select State</option>");
                    $.each(data,function(key,value){
                      console.log(value.state);
                        $("#state").append("<option value='"+value.id+"'>"+value.state+"</option>");
                    });
                    
                }
            });

            $.ajax({
                type:'GET',
                url:'/getUserDetails',
                success:function(data){
                    console.log(data);
                    $("#user_id").empty();
                    $("#user_id").append("<option value=''>Select Student</option>");
                    $.each(data,function(key,value){

                        $("#user_id").append("<option value='"+value.id+"'>"+value.name+"</option>");
                    });
                    
                }
            });

            $.ajax({
                type:'GET',
                url:'/getCourse',
                success:function(data){
                    console.log(data);
                    $("#course_id").empty();
                    $("#course_id").append("<option value=''>Select Course</option>");
                    $.each(data,function(key,value){

                        $("#course_id").append("<option value='"+value.id+"'>"+value.course_name+"</option>");
                    });
                    
                }
            });
        
    }
    $(document).ready(function(){
      $('#state').change(function(){
        $.ajax({
          type:'POST',
          url:'/getCity',
          data:{
            '_token':$('input[name="_token"]').val(),
            'state':$("#state").val()
          },
          success:function(data){
            console.log(data);
            $("#city").empty();
            $("#city").append("<option>Select City</option>");
            $.each(data,function(key,value){
              $("#city").append("<option value='"+value.id+"'>"+value.city+"</option>");
              $("#city").removeAttr("disabled");
            });
          }
        });
      });
    });



var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
@endpush