@extends('frontend.layouts.app')
    @section('content')


    @php
        $admin_products = array();
        $carts = Session::get('cart');
        foreach ($carts as $key => $cartItem){
            if(\App\Product::find($cartItem['id'])){
                array_push($admin_products, $cartItem['id']);
            }
        }
    @endphp
<main>
  <section>
    <div class="container" style="width:100%; margin-left:0px; margin-right:0px; max-width: 2000px !important;">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item"><a href="">Checkout</a></li>
              <li class="breadcrumb-item active" aria-current="page">Delivery Info</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container" style="width:100%; margin-left:0px; margin-right:0px; max-width: 2000px !important;">
      <div class="row">
        <div class="col-xl-8 mx-auto">
          <div class="row aiz-steps arrow-divider">
            <div class="col done">
              <div class="text-center success-step"> <i class="la-3x mb-2 fa fa-shopping-cart"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">1. My Cart</h3>
              </div>
            </div>
            <div class="col done">
              <div class="text-center success-step"> <i class="la-3x mb-2 fa fa-map"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">2. Shipping info</h3>
              </div>
            </div>
            <div class="col active">
              <div class="text-center active-step"> <i class="la-3x mb-2 fa fa-truck"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">3. Delivery info</h3>
              </div>
            </div>
            <div class="col">
              <div class="text-center"> <i class="la-3x mb-2 opacity-50 fa fa-credit-card"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">4. Payment</h3>
              </div>
            </div>
            <div class="col">
              <div class="text-center"> <i class="la-3x mb-2 opacity-50 fa fa-check-circle"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50">5. Confirmation</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mb-4">
  <form class="form-default" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">
                    @csrf
    <div class="container" style="width:100%; margin-left:0px; margin-right:0px; max-width: 2000px !important;">
      <div class="row">
        <div class="col-xxl-8 col-xl-10 mx-auto">
          <div class="shadow-sm bg-white rounded text-left">
            <div class="card mb-3">
              <div class="card-header p-3">
                <h5 class="fs-16 fw-600 mb-0 pb-0"> Products</h5>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($admin_products as $admin_product)
                    @php
                        $product = \App\Product::find($admin_product);
                    @endphp
                        <li class="list-group-item">
                            <div class="d-flex" style="align-items: center !important;">
                                <span class="mr-2">
                                    <img src="{{ asset($product->thumbnail_img) }}" class="img-fit size-60px rounded" alt="Product 1">
                                </span>
                                <span class="fs-14 fw-600">{{$product->name }}</span>
                            </div>
                        </li>
                  @endforeach
                </ul>
                <div class="row border-top pt-3">
                  <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                    <h6 class="fs-15 fw-600">Choose Delivery Type</h6>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="row gutters-5">
                      <div class="col-6 col-sm-12">
                        <input class="form-check-input customize-radio-checkbox-input" id="home_delivery" name="delivery_type" type="radio" checked value="home_delivery">
                        <label class="form-check-label customize-radio-checkbox-label naitik-css" for="home_delivery">Home Delivery</label>
                      </div>
                      <!-- <div class="col-6">
                        <input class="form-check-input customize-radio-checkbox-input" id="local_pickup" name="delivery_type" type="radio" value="Local Pickup">
                        <label class="form-check-label customize-radio-checkbox-label" for="local_pickup">Local Pickup</label>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="card-footer justify-content-end">
                <div class="col-md-6 text-center text-md-left order-1 order-md-0"> <a href="{{ route('checkout.shipping_info') }}" class="inline-link"> <i class="fa fa-arrow-left"></i> &nbsp; Back </a> </div>
                <div class="col-md-6 text-center text-md-right"> <button type="submit" name="owner_id" value="{{ App\User::where('user_type', 'admin')->first()->id }}" class="black-flat-button">Continue to Payment</button> </div>
              </div> -->
              <div class="row card-footer align-items-center">
                <div class="col-md-6 text-center text-md-left order-1 order-md-0"> <a href="{{ route('checkout.shipping_info') }}" class="inline-link"> <i class="fa fa-arrow-left"></i>&nbsp; Back </a> </div>
                <div class="col-md-6 text-center text-md-right"> <button type="submit" name="owner_id" value="{{ App\User::where('user_type', 'admin')->first()->id }}" class="black-flat-button">Continue to Payment</button> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </section>
</main>

    @endsection
