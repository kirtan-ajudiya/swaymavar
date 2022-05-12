@extends('frontend.layouts.app')
    @section('content')

    @php
        $cart_count = 0;
            if(Session::has('cart')){
                $cart_count = count(Session::get('cart'));
            }
        @endphp

    <main>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item"><a href="">Checkout</a></li>
              <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
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
            <div class="col done">
              <div class="text-center success-step"> <i class="la-3x mb-2 fa fa-truck"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">3. Delivery info</h3>
              </div>
            </div>
            <div class="col active">
              <div class="text-center active-step"> <i class="la-3x mb-2 fa fa-credit-card"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">4. Payment</h3>
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
    <div class="container">
    <form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST">
      @csrf
      <div class="row">
        <div class="col-xxl-8 col-xl-8 mx-auto">
          <div class="bg-white rounded text-left">
            <div class="card mb-3">
              <div class="card-header p-3">
                <h5 class="fs-16 fw-600 mb-0 pb-0">Select a payment option</h5>
              </div>
                <div class="card-body">
                  <div class="row d-flex justify-content-center">
                    @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                        <div class="col-md-3">
                            <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                                id="cash_on_delivery" type="radio" checked value="cash_on_delivery"> -->
                            <!-- <label class="bordered-form-check-label bordered-label" for="cash_on_delivery">
                                <img src="{{asset('frontend/images/cod.png')}}" class="img-fluid mb-2">
                                <span class="d-block text-center">
                                    <span class="d-block fw-600 fs-15">Cash on Delivery</span>
                                </span>
                            </label> -->
                            <div class="form-check d-flex align-items-center">
                              <input class="form-check-input" name="payment_option"
                                  id="cash_on_delivery" type="radio" value="cash_on_delivery">
                              <label class="form-check-label" for="cash_on_delivery">
                                <span class="d-block fw-600 fs-15">Cash on Delivery</span>
                              </label>
                            </div>
                        </div>
                      @endif

                      @if(\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                        <div class="col-md-3">
                          <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                              id="paypal" type="radio" checked value="paypal">
                          <label class="bordered-form-check-label bordered-label" for="paypal">
                              <img src="{{asset('frontend/images/paypal.png')}}" class="img-fluid mb-2">
                              <span class="d-block text-center">
                                  <span class="d-block fw-600 fs-15">Paypal</span>
                              </span>
                          </label> -->
                          <div class="form-check d-flex align-items-center">
                                <input class="form-check-input"  name="payment_option"
                                    id="paypal" type="radio" value="paypal">
                            <label class="form-check-label" for="paypal">
                              <span class="d-block fw-600 fs-15">Paypal</span>
                            </label>
                          </div>
                        </div>
                      @endif

                      @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                        <div class="col-md-3">
                          <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                              id="stripe" type="radio" checked value="stripe">
                          <label class="bordered-form-check-label bordered-label" for="stripe">
                              <img src="{{asset('frontend/images/stripe.png')}}" class="img-fluid mb-2">
                              <span class="d-block text-center">
                                  <span class="d-block fw-600 fs-15">Stripe</span>
                              </span>
                          </label> -->
                          <div class="form-check d-flex align-items-center">
                              <input class="form-check-input" name="payment_option"
                                        id="stripe" type="radio" value="stripe">
                            <label class="form-check-label" for="stripe">
                              <span class="d-block fw-600 fs-15">Stripe</span>
                            </label>
                          </div>
                        </div>
                      @endif

                    @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="sslcommerz" type="radio" checked value="sslcommerz">
                        <label class="bordered-form-check-label bordered-label" for="sslcommerz">
                            <img src="{{asset('frontend/images/sslcommerz.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">sslcommerz</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="sslcommerz" type="radio" value="sslcommerz">
                          <label class="form-check-label" for="sslcommerz">
                            <span class="d-block fw-600 fs-15">sslcommerz</span>
                          </label>
                        </div>
                      </div>
                    @endif

                    @if(\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="instamojo" type="radio" checked value="instamojo">
                        <label class="bordered-form-check-label bordered-label" for="instamojo">
                            <img src="{{asset('frontend/images/instamojo.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">Instamojo</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="instamojo" type="radio" value="instamojo">
                          <label class="form-check-label" for="instamojo">
                            <span class="d-block fw-600 fs-15">Instamojo</span>
                          </label>
                        </div>
                      </div>
                    @endif

                    @if(\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="razorpay" type="radio" checked value="razorpay">
                            <label class="bordered-form-check-label bordered-label" for="razorpay">
                            <img src="{{asset('frontend/images/rozarpay.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">Razorpay</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="razorpay" type="radio" value="razorpay">
                          <label class="form-check-label" for="razorpay">
                            <span class="d-block fw-600 fs-15">Razorpay</span>
                          </label>
                        </div>
                      </div>
                    @endif

                    @if(\App\BusinessSetting::where('type', 'nimbbl')->first()->value == 1)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="razorpay" type="radio" checked value="razorpay">
                            <label class="bordered-form-check-label bordered-label" for="razorpay">
                            <img src="{{asset('frontend/images/rozarpay.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">Razorpay</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="nimbbl" type="radio" value="nimbbl">
                          <label class="form-check-label" for="nimbbl">
                            <span class="d-block fw-600 fs-15">Nimbbl</span>
                          </label>
                        </div>
                      </div>
                    @endif

                    @if(\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="paystack" type="radio" checked value="paystack">
                        <label class="bordered-form-check-label bordered-label" for="paystack">
                            <img src="{{asset('frontend/images/paystack.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">Paystack</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="paystack" type="radio" value="paystack">
                          <label class="form-check-label" for="paystack">
                            <span class="d-block fw-600 fs-15">Paystack</span>
                          </label>
                        </div>
                      </div>
                    @endif

                    @if(\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="voguepay" type="radio" checked value="voguepay">
                        <label class="bordered-form-check-label bordered-label" for="voguepay">
                            <img src="{{asset('frontend/images/voguepay.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">Voguepay</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="voguepay" type="radio" value="voguepay">
                          <label class="form-check-label" for="voguepay">
                            <span class="d-block fw-600 fs-15">Voguepay</span>
                          </label>
                        </div>
                      </div>
                    @endif

                    @if(\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                      <div class="col-md-3">
                        <!-- <input class="bordered-form-check-input bordered-input" name="payment_option"
                            id="paytm" type="radio" checked value="paytm">
                          <label class="bordered-form-check-label bordered-label" for="paytm">
                            <img src="{{asset('frontend/images/paytm.png')}}" class="img-fluid mb-2">
                            <span class="d-block text-center">
                                <span class="d-block fw-600 fs-15">Paytm</span>
                            </span>
                        </label> -->
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input" name="payment_option"
                                          id="paytm" type="radio" value="paytm">
                          <label class="form-check-label" for="paytm">
                            <span class="d-block fw-600 fs-15">Paytm</span>
                          </label>
                        </div>
                      </div>
                    @endif
                </div>
              </div>
            </div>
          </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-2">
              <div class="custom-field">
                <input type="checkbox" id="teams_conditions" name="teams_conditions" value="1"><label for="teams_conditions">I agree to the <a href="{{route('terms')}}" target="_blank">Terms &amp; Conditions*</a>, <a href="{{route('returnpolicy')}}" target="_blank">Return Policy</a> and <a href="{{route('privacypolicy')}}" target="_blank">Privacy Policy</a>.</label>
              </div>
            </div>
          <div class="col-md-6 text-center text-md-left order-1 order-md-0">
        </div>
                <div class="col-md-6 text-center text-md-right"> <button type="submit" class="black-flat-button">Complete Order</button> </div></div>
        </div>
          </form>
        <div class="col-xxl-4 col-xl-4 mx-auto naitik-css">
          <div class="bg-white rounded text-left">
            <div class="card mb-3">
              <div class="card-header p-3">
                <h5 class="fs-16 fw-600 mb-0 pb-0">Summary</h5>
                <div class="text-right">
                    <span class="badge1">{{$cart_count}} Items</span>
                </div>
              </div>
              <div class="card-body">
                  <table class="table">
                      <thead>
                          <tr>
                              <th class="product-name">PRODUCT</th>
                              <th class="product-total text-right">TOTAL</th>
                          </tr>
                      </thead>
                      @if(Session::has('cart') && $cart_count > 0)
                      <tbody>
                        @php    $total = 0; $tax = 0; @endphp
                      @foreach(Session::get('cart') as $key=>$admin_product)
                        @php
                            $product = \App\Product::find($admin_product['id']);
                            $total += FrontTotalPrice($product->id) * $admin_product['quantity'];

                        @endphp
                          <tr class="cart_item">
                              <td  class="product-name">{{$product->name}}<strong class="product-quantity"> x {{$admin_product['quantity']}}</strong>
                              </td>
                              <td width="150px;" class="product-total text-right">
                                  <span class="pl-4 pr-0">{{format_price(FrontTotalPrice($product->id) * $admin_product['quantity'])}}</span>
                              </td>
                          </tr>
                        @endforeach
                      </tbody>
                      @endif
                      <tfoot>
                          <tr class="cart-subtotal">
                              <th>ORDER TOTAL</th>
                              <td class="text-right">
                                  <span class="fw-600">{{format_price($total)}}</span>
                              </td>
                          </tr>
                          <!-- <tr class="cart-shipping">
                              <th>Tax<br><span style="font-size: 10px;font-weight: 500;">(Already Added In Subtotal)</span></th>
                              <td class="text-right">
                                  <span class="font-italic">{{$tax}}</span>
                              </td>
                          </tr> -->
                          <tr class="cart-shipping">
                              <th>SHIPPING</th>
                              <td class="text-right">
                                  <span class="">₹ 0</span>
                              </td>
                          </tr>
                          <tr class="cart-total">
                              <th>
                                  <span class="strong-600">YOU PAY (Inclusive of all taxes*)</span>
                              </th>
                              <td class="text-right">
                                  <strong><span>{{format_price($total)}}</span></strong>
                              </td>
                          </tr>
                      </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>


    @endsection
