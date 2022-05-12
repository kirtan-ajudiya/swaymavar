@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')
    @php
      $banner = \App\Banner::where('published', 1)->where('position', 6)->first();
    @endphp
    <div class="section first-section"
        style="background: url({{asset($banner->photo)}}) no-repeat;background-size: cover;background-position: center;">
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
      <div class="container is-full-wide">
        <div class="col lg-8 md-8 sm-12 no-padding-lr no-margin-bottom">
          <h2>Addresses</h2>
          <p class="fs-19px fw-300">The following addresses will be used on the checkout page by default.</p>
        </div>
        <div class="col lg-4 md-4 sm-12 no-padding-lr no-margin-bottom">
          <a href="{{route('addresses.create')}}" class="inline-button"> Add Address </a>
        </div>
      </div>
      <div class="container is-full-wide display-block addresses">
        <div class="col lg-12 md-12 sm-12 no-padding-lr">
            <h2>Billing Address</h2>
            <div class="container is-full-wide margin-top wrap">
              @if(isset($billings) && $billings != "[]" )
                @foreach($billings as $key=>$billing)
                <div class="col lg-4 md-4 sm-12 margin-bottom no-padding-lr">
                  <div class="address-list-item">
                    <p class="fs-19px fw-500" style="font-style: italic;text-transform: capitalize;">
                      {{$billing->first_name}} {{$billing->last_name}}<br>
                      {{$billing->billing_address}}<br>
                      {{$billing->postal_code}} - {{$billing->city}}, {{$billing->state}}, {{$billing->country}}<br><br>
                      {{$billing->phone}}<br>
                      <span style="text-transform: lowercase;">{{$billing->email}}</span>
                    </p>
                    <div class="action">
                      <a href="{{route('addresses.edit', encrypt($billing->id))}}" class="inline-link"> Edit <i class="fa is-24px"></i></a>
                      <a href="{{route('addresses.destroy', encrypt($billing  ->id))}}" class="inline-link"> Remove <i class="fa is-24px"></i></a>
                    </div>
                  </div>
                </div>
                @endforeach
              @else
              <div class="col lg-12 md-12 sm-12 margin-bottom no-padding-lr">
                <p> No address found </p>
              </div>
              @endif
          </div>
          </div>
          <div class="col lg-12 md-12 sm-12 no-padding-lr">
              <h2>Shipping Address</h2>
              <div class="container is-full-wide margin-top wrap">
                @if(isset($shippings) && $shippings != "[]")
                  @foreach($shippings as $key=>$shipping)
                  <div class="col lg-4 md-4 sm-12 margin-bottom no-padding-lr">
                    <div class="address-list-item">
                        <p class="fs-19px fw-500" style="font-style: italic;text-transform: capitalize;">
                          {{$shipping->first_name}} {{$shipping->last_name}}<br>
                          {{$shipping->shipping_address}}<br>
                          {{$shipping->postal_code}} - {{$shipping->city}}, {{$shipping->state}}, {{$shipping->country}}<br><br>
                          {{$shipping->phone}}<br>
                          <span style="text-transform: lowercase;">{{$shipping->email}}</span>
                        </p>
                        <div class="action">
                          <a href="{{route('addresses.edit', encrypt($shipping->id))}}" class="inline-link">Edit <i class="fa is-24px"></i></a>
                          <a href="{{route('addresses.destroy', encrypt($shipping->id))}}" class="inline-link"> Remove <i class="fa is-24px"></i></a>
                        </div>
                      </div>
                    </div>
                  @endforeach
                  @else
                  <div class="col lg-12 md-12 sm-12 margin-bottom no-padding-lr">
                    <p> No address found </p>
                  </div>
                @endif
            </div>
        </div>
      </div>
</div>
    @endsection
