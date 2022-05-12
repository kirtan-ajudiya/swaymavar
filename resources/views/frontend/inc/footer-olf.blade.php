@php
$setting = App\GeneralSetting::first();
@endphp
<!-- <footer class="section is-dark no-padding-top no-padding-bottom">
    <div class="container margin-bottom is-wide footer-padding-tb">
        <div class="col lg-2 md-4 sm-12 no-margin-bottom-lg display-flex-justify-center"><img
                src="{{asset('frontend/images/logo/logo-white.png')}}" alt="" class="margin-bottom footer-logo"> </div>
        <div class="col lg-4 md-8 sm-12 no-margin-bottom-lg">
            <h4 class="color-light-gray">Contact Info</h4>
            <div>
                <ul class="no-margin-trbl no-padding-trbl color-light-gray">
                    <li class="d-flex mb-10"> <span><i class="fa margin-right icon"
                                style="font-size: 25px;"></i></span> <span><a href="https://g.page/Rhey_Hub?share"
                                target="_blank" class="color-light-gray">{{$setting->address}}</a></span></li>
                    <li class="d-flex mb-10"> <span><i class="fa margin-right icon"
                                style="font-size: 25px;"></i></span> <span><a href="tel:{{$setting->phone}}"
                                class="low-text-contrast color-light-gray">{{$setting->phone}}</a>, <a href="tel:{{$setting->phone_one}}" class="low-text-contrast color-light-gray">{{$setting->phone_one}}</a></span></li>
                    <li class="d-flex mb-10"> <span><i class="fab fa-whatsapp margin-right"
                                style="font-size: 25px;"></i></span> <span><a href="https://wa.me/{{$setting->whatsapp_number}}"
                                target="_blank" class="low-text-contrast color-light-gray">{{$setting->whatsapp_number}}</a>, <a href="https://wa.me/{{$setting->whatsapp_number_one}}" target="_blank" class="low-text-contrast color-light-gray">{{$setting->whatsapp_number_one}}</a></span></li>
                    <li class="d-flex mb-10"> <span><i class="fa margin-right icon"
                                style="font-size: 25px;"></i></span> <span><a href="mailto:{{$setting->email}}"
                                class="color-light-gray">{{$setting->email}}</a></span></li>
                </ul>
            </div>
            <div class="social-icon">
                <ul>
                    <li><a href="{{$setting->facebook}}" target="_blank" class="color-light-gray"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{$setting->instagram}}" target="_blank" class="color-light-gray"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="{{$setting->youtube}}" target="_blank" class="color-light-gray"><i class="fab fa-youtube"></i></a></li>
                    <li><a href="{{$setting->linkdin}}" target="_blank" class="color-light-gray"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="col lg-3 md-6 no-margin-bottom-lg display-only-lg">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.3662926045317!2d72.84411251493512!3d21.17760318591801!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e35e43f01a3%3A0x950b7e416c5fb174!2sRHEY!5e0!3m2!1sen!2sin!4v1632893369093!5m2!1sen!2sin"
                allowfullscreen="" loading="lazy" class="footer-iframe-map"></iframe>
        </div>
        <div class="col lg-3 md-6 sm-12 no-margin-bottom-lg">
            <div class="container container-nested">
                <div class="col lg-6 md-6 sm-6 no-margin-bottom-lg">
                    <h4 class="color-light-gray">Categories</h4>
                    <ul class="no-margin-trbl no-padding-trbl">
                        <li class="no-bullet-marker"><a href="{{route('products')}}"
                                class="footer-nav-link color-light-gray">All Product</a></li>
                            @foreach (App\Category::all() as $item)
                            <li class="no-bullet-marker"><a href="{{ route('products.category', $item->slug) }}"
                                class="footer-nav-link color-light-gray">{{$item->name}}</a></li>
                            @endforeach


                    </ul>
                </div>
                <div class="col lg-6 md-6 sm-6 no-margin-bottom-lg">
                    <h4 class="color-light-gray">Usefull Links</h4>
                    <ul class="no-margin-trbl no-padding-trbl">
                        <li class="no-bullet-marker"><a href="{{route('terms')}}"
                                class="footer-nav-link color-light-gray">Terms and Conditions</a></li>
                        <li class="no-bullet-marker"><a href="{{route('returnpolicy')}}"
                                class="footer-nav-link color-light-gray">Cancellation & Return</a></li>
                        <li class="no-bullet-marker"><a href="{{route('privacypolicy')}}"
                                class="footer-nav-link color-light-gray">Privacy Policy</a></li>
                        <li class="no-bullet-marker"><a href="{{route('shippingpolicy')}}"
                                class="footer-nav-link color-light-gray">Shipping Policy</a></li>
                        <li class="no-bullet-marker"><a href="{{route('faq')}}" class="footer-nav-link color-light-gray">Help &
                                FAQ's</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-section">
        <div class="container is-wide">
            <div class="col lg-12 no-margin-bottom md-12 md-order-last">
                <div class="low-text-contrast text-small text-align-center">
                    <div class="md-order-last color-white">Copyright &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> Rhey Cart All Rights Reserved. Powered by <a href="https://kyoro.in/?utm_source=rheycart&utm_medium=footer&utm_campaign=footer" target="_blank"
                            class="color-white">Kyoro</a></div>
                </div>
            </div>
        </div>
    </div>
</footer> -->


<footer class="section is-dark no-padding-top no-padding-bottom">
  <div class="container is-wide footer-padding-tb">
    <div class="col lg-4 md-6 sm-12 no-margin-bottom-lg" style="margin-bottom: 0 !important;">
      <h4 class="color-light-gray border-bottom">Contact us</h4>
      <hr>
      <div>
        <ul class="no-margin-trbl no-padding-trbl color-white">
          <li class="d-flex mb-10"> <span><i class="fa margin-right icon" style="font-size: 25px;color: #01a58d;"></i></span>
            <span><a href="mailto:{{$setting->email}}" class="color-white"> {{$setting->email}} </a></span>
          </li>
          <li class="d-flex mb-10"> <span><i class="fa margin-right icon" style="font-size: 25px;color: #01a58d;"></i></span>
            <span><a href="tel:{{$setting->phone}}" class="low-text-contrast color-white">{{$setting->phone}}</a>,
              <a href="tel:{{$setting->phone_one}}" class="low-text-contrast color-white">{{$setting->phone_one}}</a>
            </span>
          </li>
        </ul>
      </div>
      <!-- <div class="button_btn_Locate Us">
        <a href="{{route('contacts')}}"> Locate Us </a>
      </div> -->
    </div>
    <div class="col lg-2 md-6 sm-12 no-margin-bottom-lg" style="margin-bottom: 0 !important;">
      <h4 class="color-light-gray border-bottom">Categories</h4>
      <hr>
      <div class="footer_link">
        <ul class="no-margin-trbl no-padding-trbl color-white">
          <li><a class="color-white" href="{{route('products')}}">All Products</a></li>
          @foreach (\App\Category::all()->take(11) as $key => $category)
          <li><a class="color-white" href="{{ route('products.category', $category->slug) }}">{{ $category->name }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom-lg" style="margin-bottom: 0 !important;">
      <div class="container margin-bottom is-wide" style="margin-bottom: 0 !important;">
        <div class="col lg-6 md-12 sm-12 no-margin-bottom-lg padding-0" style="margin-bottom: 0 !important;">
          <h4 class="color-light-gray border-bottom">Quick links</h4>
          <hr>
          <div class="footer_link">
            <ul class="no-margin-trbl no-padding-trbl color-white">
              <li><a class="color-white" href="{{route('terms')}}">Terms and Conditions</a></li>
              <li><a class="color-white" href="{{route('returnpolicy')}}">Cancellation & Return</a></li>
              <li><a class="color-white" href="{{route('privacypolicy')}}">Privacy Policy</a></li>
              <li><a class="color-white" href="{{route('shippingpolicy')}}">Shipping Policy</a></li>
              <li><a class="color-white" href="{{route('faq')}}">Help & FAQ's</a></li>
            </ul>
          </div>
        </div>
        <div class="col lg-6 md-12 sm-12 no-margin-bottom-lg padding-0" style="margin-bottom: 0 !important;">
          <h4 class="color-light-gray border-bottom">About Us</h4>
          <hr>
          <div class="footer_link">
            <ul class="no-margin-trbl no-padding-trbl color-white">
              <p>{{ $setting->footer_text ?? '-'}}</p>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container is-wide">
    <div class="col lg-6 md-6 sm-12 no-margin-bottom-lg" style="margin-bottom: 20px !important;">
      <div class="social-icon">
        <ul>
          <li><a href="https://wa.me/{{$setting->whatsapp_number}}" target="_blank" class="color-white"><i class="fab fa-whatsapp"></i></a></li>
          <li><a href="{{$setting->instagram}}" target="_blank" class="color-white"><i class="fab fa-instagram"></i></a></li>
          <!-- <li><a href="" target="_blank" class="color-white"><i class="fab fa-linkedin"></i></a></li> -->
          <li><a href="{{$setting->linkdin}}" target="_blank" class="color-white"><i class="fab fa-linkedin-in"></i></a></li>
          <li><a href="{{$setting->facebook}}" target="_blank" class="color-light-gray"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="{{$setting->twitter}}" target="_blank" class="color-white"><i class="fab fa-twitter"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="col lg-6 md-6 sm-12 no-margin-bottom-lg" style="margin-bottom: 20px !important;">
      <div class="text-right cards-icon-list">
        <img src="{{asset('frontend/images/footer-img.png')}}" height="40px" alt="">
      </div>
    </div>
  </div>
  <div class="container is-wide">
    <div class="footer-copyright text-center">
      <div class="col lg-12 md-12 sm-12 no-margin-bottom-lg display-flex-justify-center" style="margin-bottom: 0px !important;">
        <img src="{{asset('frontend/images/logo/logo-white.png')}}" alt="" width="150px" >
      </div>
      <p class="copyright-text mt-30 text-center">
        <span class="text-center">Copyright © 2022 Rhey Cart All Rights Reserved. Powered by Kyoro.</span>
      </p>
      <!-- <a href="#" class="back-to-top"><i class="far fa-angle-up"></i></a> -->
    </div>
  </div>
</footer>


<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<div class="floating_btn">
    <a target="_blank" href="https://wa.me/{{$setting->whatsapp_number}}">
        <div class="contact_icon">
            <i class="fab fa-whatsapp my-float"></i>
        </div>
    </a>
</div>
