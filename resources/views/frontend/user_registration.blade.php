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
                <li class="breadcrumb-item active" aria-current="page">Registration</li>
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
                <h5 class="signup-title text-center"style="padding: 0;margin: 10px 0;"><hr><span>Sign Up with Swaymavar</span></h5>
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
              <form action="{{ route('register') }}" method="POST" class="login-form" >
                @csrf
                <div class="row" style="margin: 0;">
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <label for="title">Title</label>
                <div class="form-group">
                  <select class="form-control" id="title" name="title">
                    <option>Mr.</option>
                    <option>Mrs.</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <label for="FullName">Full Name</label>
                <div class="form-group" id="FullName">
                  <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" name="name" placeholder="Your Full Name...">
                  <span class="input-group-addon">
                    <i class="text-md fa fa-user"></i>
                </span>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong style="color:red">{{ $errors->first('name') }}</strong>
                    </span>
                @endif
                </div>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="MobileNumber">Mobile Number</label>
                <div class="form-group" id="MobileNumber">
                  <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" maxlength="10" id="phone" name="phone" placeholder="Your Mobile Number...">
                  <span class="input-group-addon">
                    <i class="text-md fa fa-phone"></i>
                </span>
                  @if ($errors->has('phone'))
                 <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $errors->first('phone') }}</strong>
                </span>
                  @endif
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="EmailID">Email ID</label>
                <div class="form-group" id="EmailID">
                  <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" name="email" placeholder="Your Email ID...">
                  <span class="input-group-addon">
                    <i class="text-md fa fa-envelope"></i>
                </span>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong style="color:red">{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label for="Password">Password</label>
                <div class="form-group" id="Password">
                  <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="Your Password...">
                  <span class="input-group-addon">
                    <i class="text-md fa fa-lock"></i>
                </span>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong style="color:red">{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="custom-field">
                  <input type="checkbox" checked id="receive_newsletters" name="receive_newsletters" value="1"><label for="receive_newsletters">Receive our newsletters and special offers.</label>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="custom-field">
                  <input type="checkbox" id="get_updates" name="get_updates" value="1"><label for="get_updates">Get updates on <img src="{{asset('frontend/images/WhatsApp_Logo.png')}}" class="whatsAppIcon" alt=""> <span style="color:#25d366 !important;">whatsapp</span></label>
                </div>
              </div>
             <div class="form-group" style="display:flex;justify-content: center;">
                  {{-- <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_CAPTCHA_SITE') }}">
                      @if ($errors->has('g-recaptcha-response'))
                          <span class="invalid-feedback" style="display:block">
                              <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                          </span>
                      @endif
                  </div> --}}
                
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="custom-field">
                  <input type="checkbox" id="termsconditions" name="termsconditions" value="1"><label for="termsconditions">I agree to the <a style="color:#C69426" href="{{route('terms')}}" target="_blank">Terms & Conditions*</a> and <a style="color:#C69426"  href="{{route('privacypolicy')}}" target="_blank">Privacy Policy</a>.</label>
                </div>
              </div>
               @if ($errors->has('termsconditions'))
                <span class="invalid-feedback d-block" role="alert" >
                    <strong style="color:red">{{ $errors->first('termsconditions') }}</strong>
                </span>
              @endif
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center" style="margin: 20px 0;">
                <button type="submit" class="black-flat-button">Register to Continue</button>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <p>Already have an account? <a style="color:#C69426"  href="{{route('user.login')}}">Sign In!</a></p>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection


@section('script')

<script>
  $('#terms_conditions').prop('required',true);
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
