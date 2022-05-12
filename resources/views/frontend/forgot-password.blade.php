@extends('frontend.layouts.app')

@section('content')
<main>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Forgot Password</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <div class="row login-signup">
            <form  role="form"  style="width:100%;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="EmailID">Email ID</label>
              <div class="form-group">
                <input type="email" class="form-control" id="emailid" name="email" placeholder="Your Email ID...">
                <strong><span class="text-danger" id="email_error"></span></strong>
              </div>
              <div class="form-group" id="OTPId">
                <input type="number" class="form-control" id="otp" name="otp" placeholder="Enter your 4 Digit OTP...">
                <strong><span class="text-danger" id="otp_error"></span></strong>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin: 20px 0;">
              <a href="javascript:void(0)" onclick="PasswordVarify();" id="send" class="black-flat-button otp_system">{{  __('Send Otp') }}</a>
              <a href="javascript:void(0)" onclick="PasswordOtp();" id="sendOtp" class="black-flat-button">{{  __('Submit') }}</a>
            </div>
          </form>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <p style="font-size: 14px !important;">New User? <a  style="color:#C69426" href="{{route('user.registration')}}">Create an Account</a></p>
            </div>
           <input type="hidden" name="otpnumber" id="otpnumber" />
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


@section('script')

<script>

$( document ).ready(function() {
  $("#OTPId").hide();
  $("#sendOtp").hide();

});


function PasswordVarify(){
  var email = $("#emailid").val();
  if(email != ""){
    $.post('{{ route('user.password.varify') }}',
        {_token:'{{ csrf_token() }}',
        email:email,
        }, function(data){
        if(data.status == true){
          showFrontendAlert('success', 'Email Send SuccessFully !!');
          $("#OTPId").show();
          $("#otpnumber").val(data.otp);
          $("#send").hide();
          $("#sendOtp").show();

        }else{
          showFrontendAlert('error', 'Please Enter valid Email');
        }
    });
  }else{
    $("#email_error").html("Please Enter Email");
  }
}

function PasswordOtp() {
        var email = $("#emailid").val();
        var otp = $("#otpnumber").val()
        var otpval = $("#otp").val();
        if(email != ""){
            if(otpval == otp){
                $.post('{{ route('user.otp.submit') }}',
                {_token:'{{ csrf_token() }}',
                email:email,
                otp : otpval,
                }, function(data){
                    if(data.status == true){
                        window.location = '{{ route('user.new.password') }}';
                        $("#useremail").val(data.email);
                    }else{
                        showFrontendAlert('error', 'Please Enter valid Details');
                    }
                });
            }else{
                showFrontendAlert('error', 'Wrong Otp...');
            }
        }else{
            $("#email_error").html("Please Enter Email");
        }
    }


</script>
@endsection
