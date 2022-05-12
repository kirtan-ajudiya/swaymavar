@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')

    <div class="section first-section"
        style="background: url('images/banner-product-listing.jpg') no-repeat;background-size: cover;background-position: center;">
        <div class="row">
            <div class="col lg-12 page-title">
                <h1 class="text-white margin-bottom text-uppercase text-center">Addresses</h1>
                <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span
                        class="low-text-contrast text-white">Addresses</span></div>
            </div>
        </div>
    </div>
        
    @endsection

    @section('sidenavright')
        
    <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double">
        <h2>Addresses</h2>
        <p class="fs-19px fw-300">The following addresses will be used on the checkout page by default.</p>
        <div class="container is-full-wide margin-top">
          <div class="col lg-6 md-6 sm-12 no-margin-bottom no-padding-lr">
            <h2>Billing Address</h2>
            <p class="fs-19px fw-500" style="font-style: italic;text-transform: capitalize;">John Smith<br>123, test location, near test location,<br>opp. test location<br>365 004 - Surat, Gujarat, India<br><br>+91 012 345 6789<br>username@gmail.com</p>
            <a href="edit-addresses.html" class="inline-link">Edit <i class="fa is-24px"></i></a>
          </div>
          <div class="col lg-6 md-6 sm-12 no-margin-bottom no-padding-lr">
            <h2>Shipping Address</h2>
            <p class="fs-19px fw-500" style="font-style: italic;text-transform: capitalize;">John Smith<br>123, test location, near test location,<br>opp. test location<br>365 004 - Surat, Gujarat, India<br><br>+91 012 345 6789<br>username@gmail.com</p>
            <a href="edit-addresses.html" class="inline-link">Edit <i class="fa is-24px"></i></a>
          </div>
        </div>
      </div>

    @endsection
