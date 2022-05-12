@extends('frontend.layouts.app')

@section('content')

@yield('sidenavleft')

<div class="">
    <div class="container is-full-wide">
        <div class="col lg-3 md-12 no-margin-bottom padding-top-bottom-double">
            <div class="MyAccount-navigation">
                <ul>
                    <li class="{{ areActiveRoutesHome(['terms'])}}"><a href="{{route('terms')}}"><i class="fa is-24px mr-10"></i>Terms and Conditions</a> </li>
                    <li class="{{ areActiveRoutesHome(['returnpolicy'])}}"><a href="{{route('returnpolicy')}}"><i class="fa is-24px mr-10"></i>Cancellation & Return</a></li>
                    <li class="{{ areActiveRoutesHome(['privacypolicy'])}}"><a href="{{route('privacypolicy')}}"><i class="fa is-24px mr-10"></i>Privacy Policy</a> </li>
                    <li class="{{ areActiveRoutesHome(['shippingpolicy'])}}"><a href="{{route('shippingpolicy')}}"><i class="fa is-24px mr-10"></i>Shipping Policy</a> </li>
                    <li class="{{ areActiveRoutesHome(['faq'])}}"><a href="{{route('faq')}}"><i class="fa is-24px mr-10"></i>Help & FAQ's</a> </li>
                </ul>
            </div>
        </div>
        @yield('sidenavright')
    </div>
</div>


@endsection
