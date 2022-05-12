@extends('frontend.layouts.app')
@section('content')

@php 
$setting = App\GeneralSetting::first();
@endphp


<div class="contact-us mt-4">

    <div data-anim-wrap="" class="container animated">
        <div class="row">
            <div class="col-xl-9 offset-xl-1 col-lg-11">
                <div data-anim-child="slide-up delay-1" class="sectionHeading -lg is-in-view">
                    <p class="sectionHeading__subtitle">
                        Hire Us
                    </p>
                    <h1 class="sectionHeading__title leading-sm">
                        Got a project to discuss? Get in touch.
                    </h1>
                </div>
            </div>
        </div>

        <div data-anim-child="slide-up delay-2" class="row justify-content-center layout-pt-md is-in-view">
            <div class="col-xl-10">
                <div class="row x-gap-48 y-gap-48">
                    <div class="col-lg-3 col-md-6 col-sm-8">
                        <h4 class="text-xl fw-600">
                            Address
                        </h4>
                        <div class="text-dark mt-12">
                            <p><a href="https://goo.gl/maps/XQejMvx15KmZW7D98" target="_blank">{{$setting->address}}</a></p>
                        </div>
                    </div>

                    <div class="col-lg-auto offset-lg-1 col-md-6">
                        <h4 class="text-xl fw-600">
                            Contact Us
                        </h4>
                        <div class="text-dark mt-12">
                            <div>
                                <a class="button -underline" href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                            </div>
                            <div class="mt-4">
                                <a class="button -underline" href="tel:{{$setting->phone}}">{{$setting->phone}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-auto offset-lg-1">
                        <h4 class="text-xl fw-600">
                            Follow Us
                        </h4>
                        <div class="social -bordered mt-16 md:mt-12">

                            <a class="social__item text-black border-dark" href="{{$setting->facebook}}" target="_blank">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a class="social__item text-black border-dark" href="{{$setting->twitter}}" target="_blank">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="social__item text-black border-dark" href="{{$setting->instagram}}" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a class="social__item text-black border-dark" href="{{$setting->youtube}}" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a class="social__item text-black border-dark" href="{{$setting->pintrest}}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="layout-pt-md layout-pb-lg">
      <div class="container">
          <div data-anim="slide-up delay-3" class="row justify-content-center is-in-view">
              <div class="col-xl-10">
                  <div class="sectionHeading -sm">
                      <h2 class="sectionHeading__title">
                          Drop us a line
                      </h2>
                      <p class="text-black leading-md mt-12">
                          Use the form below or
                          <a href="#" style="color:#C6942C" class="fw-700">send us an email</a>.
                      </p>
                  </div>
              </div>

              <div class="w-1/1"></div>

              <div class="col-xl-10 mt-48 sm:mt-32 contact-form-shadow">
                  <div class="contact-form -type-1">
                      <form class="row x-gap-40 y-gap-32" method="POST" action="{{route('contacts.stores')}}">
                        @csrf
                           <div class="col-lg-6">
                              <label class="js-input-group">
                                  Name
                                  <input type="text" name="name" data-required="" placeholder="Fill in your name" required="">
                                  @error('name')
                                      <div style="color:red">{{ $message }}</div>
                                  @enderror
                              </label>
                          </div>

                          <div class="col-lg-6">
                              <label class="js-input-group">
                                  Your phone number (optional)
                                  <input type="text" name="number" placeholder="Phone number">
                                  @error('number')
                                      <div style="color:red">{{ $message }}</div>
                                  @enderror

                              </label>
                          </div>

                          <div class="col-lg-6">
                              <label class="js-input-group">
                                  Email
                                  <input type="text" name="email" data-required="" placeholder="Fill in your email" required="">
                                  @error('email')
                                      <div style="color:red">{{ $message }}</div>
                                  @enderror
                                  </label>
                          </div>

                          <div class="col-lg-6">
                              <label class="js-input-group">
                                  Subject
                                  <input type="text" name="subject" placeholder="What are you looking for?" required="">
                                  <span class="form__error"></span>
                              </label>
                          </div>

                          <div class="col-12">
                              <label class="js-input-group">
                                  Message
                                  <textarea name="message" rows="2" placeholder="Fill in your message"></textarea>
                                  @error('message')
                                      <div style="color:red">{{ $message }}</div>
                                  @enderror
                              </label>
                          </div>

                          <!-- <div class="captcha">
                              <div class="g-recaptcha" data-sitekey="6LdqjtodAAAAAMEJWDYuMRDQ-NG_bXYKSigBpMWW" data-callback="removeFakeCaptcha">
                                  <div style="width: 304px; height: 78px;"><div>
                                  <iframe title="reCAPTCHA" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LdqjtodAAAAAMEJWDYuMRDQ-NG_bXYKSigBpMWW&amp;co=aHR0cHM6Ly9yYWdodXZpcmRldmVsb3BlcnMuY29tOjQ0Mw..&amp;hl=en&amp;v=gZWLhEUEJFxEhoT5hpjn2xHK&amp;size=normal&amp;cb=poqjpdxtvpdb" width="304" height="78" role="presentation" name="a-c13v9cmayjnw" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>
                                  </div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div></div>
                              <input type="checkbox" class="captcha-fake-field" tabindex="-1" required="">
                          </div> -->

                          <div class="col-12">
                              <button type="submit" class="black-flat-button add_to_cart"> Send Message </button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
          <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3720.430102177272!2d72.80148071540384!3d21.175066538142243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sLG-1%20Abhinandan%20A.C.%20Market%2C%20Beside%20Agrawal%20Samaj%2C%20Ghod%20Dod%20Road%2C%20Surat%20-395007!5e0!3m2!1sen!2sin!4v1649161637068!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
      </div>
    </section>
</div>


@endsection
