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
              <li class="breadcrumb-item active" aria-current="page">Log In</li>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h5 class="signup-title text-center"style="padding: 0;margin: 10px 0;"><hr><span>Log In with Swayamvar</span></h5>
            </div>
            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><p class="text-center" style="font-size: 14px !important;">LOG IN USING SOCIAL ACCOUNT</p></div>
            @endif
            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
              <a href="{{ route('social.login', ['provider' => 'facebook']) }}">
                  <button class="social-signup-button facebook-icon">Facebook</button>
              </a>
            </div>
          @endif
          @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <a href="{{ route('social.login', ['provider' => 'google']) }}">
                  <button class="social-signup-button google-icon">Google</button>
                </a>
              </div>
          @endif
          @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h6 class="signup-title text-center"style="padding: 0;margin: 10px 0;"><hr><span>OR</span></h6>
            </div>
            @endif
            <form  role="form" action="{{ route('login') }}" method="POST" style="width:100%;" class="login-form">
              @csrf

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

              <label for="EmailID">Email ID</label>
              <div class="form-group" id="EmailID">
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email ID...">
                <span class="input-group-addon">
                    <i class="text-md la la-envelope"></i>
                </span>
                @if ($errors->has('email'))
                        <span role="alert">
                            <strong style="color:red">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                <strong><span class="text-danger" id="phones_error"></span></strong>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label for="Password">Password</label>
              <div class="form-group" id="Password">
                <input type="password" id="password" name="password" class="form-control" placeholder="Your Password...">
                <span class="input-group-addon">
                    <i class="text-md la la-lock"></i>
                </span>
                @if ($errors->has('password'))
                    <span role="alert">
                        <strong style="color:red">{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <!-- <div class="form-group" style="display:flex;justify-content: center;">
              <div class="captcha">
                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITE') }}" data-callback="removeFakeCaptcha"></div>
                <input type="checkbox" class="captcha-fake-field" tabindex="-1" required>
              </div>
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin: 20px 0;">
            <button type="submit" id="password_login" class="black-flat-button">{{  __('Log In to Continue') }}</button>
            </div>
          </form>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <p style="font-size: 14px !important;"><a  style="color:#C69426" href="{{route('user.forgot.password') }}">Forgot Password?</a></p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <p style="font-size: 14px !important;">New User? <a style="color:#C69426"  href="{{route('user.registration')}}">Create an Account</a></p>
            </div>
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
  window.removeFakeCaptcha = function() {
   document.querySelector('.captcha-fake-field').remove();
}
</script>
    
@endsection

<style>
  .captcha {
  position: relative;
}
.captcha-fake-field {
  background: transparent;
  bottom: 0;
  border: none;
  display: block;
  height: 1px;
  left: 12px;
  width: 1px;
  position: absolute;
  z-index: -1;
}
  </style>