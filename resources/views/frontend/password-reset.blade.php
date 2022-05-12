@extends('frontend.layouts.app')

@section('content')
@php
$banner = \App\Banner::where('published', 1)->where('position', 6)->first();
@endphp
<div class="section first-section" style="background: url('{{asset($banner->photo)}}') no-repeat;background-size: cover;background-position: center;">
    <div class="row">
        <div class="col lg-12 page-title">
          <h1 class="text-white margin-bottom text-uppercase text-center">Lost your password?</h1>
        <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span class="low-text-contrast text-white">Lost Password</span></div>
        </div>
    </div>
</div>
<div class="section login-register">
    <div class="container d-flex-wrap-justify-center">
        <div class="col lg-8 md-12 text-align-center">
            <div class="login">
                <h2 class="text-uppercase margin-bottom">Lost your password?</h2>
                <p>Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
                <form>
                    <fieldset>
                        <label class="text-align-left" for="email"> Email</label>
                        <input type="text" id="email" name="email" placeholder="Email">
                    </fieldset>
                    <fieldset id="otp">
                        <label class="text-align-left" for="otpval"> OTP</label>
                        <input type="number" id="otpval" name="otpval" placeholder="Enter otp">
                    </fieldset>
                    <fieldset id="password">
                        <label class="text-align-left" for="newpassword"> New Password</label>
                        <input type="password" id="newpassword" name="newpassword" placeholder="Enter password">
                    </fieldset>
                    <a href="javascript:void(0)" onclick="PasswordOtp();" class="loging-btn" id="loging-btn">Reset password</a>
                    <a href="javascript:void(0)" onclick="PasswordVarify();" class="loging-btn" id="sendOtp">Reset password</a>
                </form>
                <div class="bb-login-form-divider"><span>Or</span></div>
                <a href="{{ route('user.registration') }}" class="create-account-btn-border">Create an Account</a>
            </div>
        </div>
    </div>
</div>
<div class="section no-padding-top-bottom overflow-hidden">
  <div class="container is-full-wide">
    <div class="col lg-12 no-margin-bottom position-relative no-padding-lr overflow-hidden">
      <div class="container container-nested c-overlay-content cta-parallax" style="background-image: url('images/subscribe-newsletter.jpg') !important;">
        <div class="col lg-8 block-centered md-12">
          <div class="text-align-center size-h2 on-dark margin-bottom-double">Subscribe to our Newsletter and get 40% off on all products</div>
          <div class="max-width-500px block-centered no-margin-bottom w-form">
            <form id="email-form" name="email-form" data-name="Email Form" class="flexh-align-center xs-is-wrapping">
              <input type="email" class="form-input-text no-margin-bottom lg-md-sm-margin-right-small xs-margin-bottom w-input" maxlength="256" name="email-2" data-name="Email 2" placeholder="Enter your email address" id="email-2" required="">
                <a href="" class="inline-button-on-dark">Subscribe</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="section">
  <div class="container is-wide">
    <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
      <div class="upper-footer flex-column-center">
        <div class="fa margin-right icon"></div>
        <div class="size-h4 text-with-icon margin-bottom-small text-align-center">FREE SHIPPING</div>
      </div>
    </div>
    <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
      <div class="upper-footer flex-column-center">
        <div class="fa margin-right icon"></div>
        <div class="size-h4 text-with-icon margin-bottom-small text-align-center">SPECIAL OFFERS</div>
      </div>
    </div>
    <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
      <div class="upper-footer flex-column-center">
        <div class="fa margin-right icon"></div>
        <div class="size-h4 text-with-icon margin-bottom-small text-align-center">ORDER PROTECTION</div>
      </div>
    </div>
    <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
      <div class="upper-footer flex-column-center">
        <div class="fa margin-right icon"></div>
        <div class="size-h4 text-with-icon margin-bottom-small text-align-center">PROFESSIONAL SUPPORT</div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')


<script>

    $( document ).ready(function() {
      $("#otp").hide();
      $("#sendOtp").hide();
      $("#password").hide();
    });
    
    
    function PasswordOtp(){
      var email = $("#email").val();
      if(email != ""){
        $.post('{{ route('user.password.varify') }}',
            {_token:'{{ csrf_token() }}',
            email:email,
            }, function(data){
            if(data.status == true){
              showFrontendAlert('success', 'Email Send SuccessFully !!');
              $("#otp").show();
              $("#loging-btn").hide();
              $("#sendOtp").show();
              $("#password").show();
            }
            else if(data.status == false){
              showFrontendAlert('error', 'Please Enter valid Email');
            }
        });
      }else{
        $("#email_error").html("Please Enter Email");
      }
    }

    function PasswordVarify() {
        var email = $("#email").val();
        var otpval = $("#otpval").val();
        var password = $("#newpassword").val();
        if(email != ""){
            $.post('{{ route('password.submit') }}',
            {_token:'{{ csrf_token() }}',
            email:email,
            otp : otpval,
            password : password
            }, function(data){
                if(data.status == true){
                    showFrontendAlert('success', 'Password Change Successfully..');
                    setTimeout(function(){
                        window.location = '{{ route('user.login') }}';
                        }, 2000);
                }else if(data.status == false && data.type == 2){
                    $("#otpval").val("");  $("#newpassword").val("");
                    showFrontendAlert('error', 'Please Enter valid Details');
                }
            });
        }else{
            $("#email_error").html("Please Enter Email");
        }
    }
    
    
    </script>

@endsection
