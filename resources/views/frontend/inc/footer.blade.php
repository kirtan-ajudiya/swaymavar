@php
$setting = App\GeneralSetting::first();
@endphp

<footer>
    <div class="top_footer">
        <div class="container">
            <div class="row pt-20">
                <div class="col-lg-6 col-md-6 col-sm-12 mobile-center">
                    <a class="footer_logo" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/img/footer-logo.png') }}" alt="">
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mobile-center" style="display: flex;justify-content: end;align-items: center;">
                    <div class="social-links text-right">
                        <ul>
                            <li><a href="">@swayamvar_jewellers</a></li>
                            <li><a href="{{ $setting->facebook }}"><i class="fab fa-facebook-square"></i></a></li>
                            <li><a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row border_top pt-20">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget fast">
                        <h4 class="widget-title">Get in Touch</h4>
                        <ul>
                            <li><a href="https://goo.gl/maps/CKf9Lu1vPoqqtP6H7"> <i class="fas fa-location-arrow"></i>{{ $setting->address }}</a></li>
                            <li><a href="tel:{{ $setting->phone }}"> <i class="fas fa-phone-alt"></i>{{ $setting->phone }}</a></li>
                            <li><a href="mailto:{{ $setting->email }}"> <i class="fas fa-envelope"></i>{{ $setting->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <h4 class="widget-title">Our Policy</h4>
                        <ul>
                            <li><a href="{{ route('privacypolicy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('terms') }}">Terms & Conditions </a></li>
                            <li><a href="{{ route('returnpolicy') }}">Return Policy</a></li>
                            <li><a href="{{ route('shippingpolicy') }}">Shipping Policy</a></li>
                            <!--<li><a href="{{ route('byubackpolicy') }}">Buyback Policy</a></li>-->
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <h4 class="widget-title">Quick Link</h4>
                        <ul>
                            <li><a href="{{ route('products') }}">Collection</a></li>
                            <li><a href="{{ route('abouts') }}">About Us</a></li>
                            <li><a href="{{ route('contactus') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="widget">
                        <h4 class="widget-title">Sign Up For Newsletter</h4>
                        <p>Subscribe to our newsletters now and stay up-to-date with new collections</p>
                        <div class="subscribe-form">
                            <form action="{{ route('subscribers.store') }}"  method="POST">
                                @csrf
                                <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
                                <button type="submit"><i class="fas fa-envelope"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer">
        <div class="container">
            <div class="row pt-20">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="">
                        <p>Copyright © 2022 Swayamvar Jewellers All Rights Reserved. Powered by <a href="https://kyoro.in/"> Kyoro. </a> </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="icon">
                        <img src="{{ asset('frontend/img/bottom_footer.svg') }}" height="45px" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
