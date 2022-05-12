@extends('frontend.layouts.app')

@section('content')

@yield('sidenavleft')

<div class="">
    <div class="container is-full-wide">
        <div class="col lg-3 md-12 no-margin-bottom padding-top-bottom-double">
            <h1 class="fs-70 margin-bottom">Hi<br>
                {{(Auth::user()->name)}}</h1>
            <div class="MyAccount-navigation">
                <ul>
                    <li class="{{ areActiveRoutesHome(['dashboard'])}}"><a href="{{route('dashboard')}}"><i class="fa is-24px mr-10"></i>Dashboard</a> </li>
                    <li class="{{ areActiveRoutesHome(['orders.index', 'order.view'])}}"><a href="{{route('orders.index')}}"><i class="fa is-24px mr-10"></i>Orders</a></li>
                    <li class="{{ areActiveRoutesHome(['addresses.index', 'addresses.create', 'addresses.edit'])}}"><a href="{{route('addresses.index')}}"><i class="fa is-24px mr-10"></i>Addresses</a> </li>
                    <li class="{{ areActiveRoutesHome(['profile'])}}"><a href="{{route('profile')}}"><i class="fa is-24px mr-10"></i>Account details</a> </li>
                    <li class="{{ areActiveRoutesHome(['wishlists.index'])}}"><a href="{{route('wishlists.index')}}"><i class="fa is-24px mr-10"></i>Wishlist</a> </li>
                    <li><a href="{{route('logout')}}"><i class="fa is-24px mr-10"></i>Logout</a> </li>
                </ul>
            </div>
        </div>
        @yield('sidenavright')
    </div>
</div>


@endsection