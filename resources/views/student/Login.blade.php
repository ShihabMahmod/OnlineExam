@extends('student.layouts.layout-common')

@section('space-work')
<section class="login" id="login">
      <div class="container">
        <div class="row">
          <div class="span12">
            <h2>Student Login Form</h2>

            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="{{url('/login')}}" method="POST" class="contactForm">
              @csrf
              <div class="row">
                <div class="span8 form-group ">
                  <input type="text" name="email" id="name" placeholder="Your Name"  />
                  <span>Provide Your Email</span>
                  <div class="validation"></div>
                </div>

                <div class="span8 form-group">
                  <input type="text" name="password" id="email" placeholder="Your Password"  />
                  <span>Provide Your Password</span>
                  <div class="validation"></div>
                </div>
                <div class="span8 form-group ">
                    <a href="/registration" style="color:#E96B56;decoration:none;margin-left:44%">I have no acount</a>
                </div>
                <div class="span8 form-group">
                  <div class="text-center">
                 
                    <button class="btn btn-theme btn-medium margintop10" type="submit">Log in</button>
                    
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</section>
@endsection
