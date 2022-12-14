@extends('student.layouts.layout-common')

@section('space-work')
<section class="registration" id="registration">
      <div class="container">
        <div class="row">
          <div class="span12">
            <h2>Student Registration Form</h2>
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="{{url('/create-student')}}" method="POST" class="contactForm">

            @csrf

              <div class="row">

                <div class="span8 form-group ">
                  <input type="text" name="name" id="name" placeholder="Your Name"  />
                  <span>Provide Your Email</span>
                  <div class="validation"></div>
                </div>

                <div class="span8 form-group ">
                  <input type="email" name="email" id="email" placeholder="Your Email"   />
                  <span>Provide Your Email</span>
                  <div class="validation"></div>
                </div>

                <div class="span8 form-group ">
                  <input type="text" name="password" id="password" placeholder="Your Password"   />
                  <span>Provide Your Password</span>
                  <div class="validation"></div>
                </div>

                <div class="span8 form-group ">
                  <input type="text" name="password_confirmation" id="password_confirmation" placeholder="Re-type Password"   />
                  <span>Provide Same Password</span>
                  <div class="validation"></div>
                </div>

                <div class="span8 form-group ">
                    <a href="/login" style="color:#E96B56;decoration:none;margin-left:40%">I already have an acount</a>
                </div>

                <div class="span8 form-group">
                  <div class="text-center">
                    <button class="btn btn-theme btn-medium margintop10" type="submit" id="save">Registration </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</section>
@endsection

