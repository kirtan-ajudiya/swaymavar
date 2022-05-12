@extends('frontend.layouts.app')

@section('content')

<main>
    <section>
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">My Account</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Summary</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    @yield("navbar")
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="sidebox p-2">
                        <h2>My Account</h2>
                        <ul>
                            <li class="{{ areActiveRoutesHome(['dashboard', 'customer.profile.update', 'user.profile.edit'])}}">
                                <a href="{{route('dashboard')}}">Personal Information</a>
                            </li>
                            <li class="{{ areActiveRoutesHome(['addresses.index', 'addresses.create', 'addresses.edit'])}}">
                                <a href="{{route('addresses.index')}}">Address Book</a>
                            </li>
                            <!-- <li class="{{ areActiveRoutesHome(['wishlists.index'])}}">
                                <a href="{{route('wishlists.index')}}">Wishlist</a>
                            </li> -->
                            <li class="{{ areActiveRoutesHome(['order.history', 'order.view'])}}">
                                <a href="{{route('order.history')}}">Order History</a>
                            </li>
                            <!-- <li class="{{ areActiveRoutesHome(['gift.balance'])}}">
                                <a href="{{route('gift.balance')}}">Gift Card Balance</a>
                            </li> -->
                            <li class="{{ areActiveRoutesHome(['logout'])}}">
                                <a href="{{route('logout')}}">Logout</a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        @yield('dashboard.content')
                </div>
            </div>
        </div>
    </section>
</main>

@endsection