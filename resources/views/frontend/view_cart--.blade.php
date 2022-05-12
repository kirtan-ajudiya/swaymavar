@extends('frontend.layouts.app')
    @section('content')
    @php
$banner = \App\Banner::where('published', 1)->where('position', 6)->first();
@endphp
<div class="section first-section" style="background: url('{{asset($banner->photo)}}') no-repeat;background-size: cover;background-position: center;">
    <div class="row">
        <div class="col lg-12 page-title">
            <h1 class="text-white margin-bottom text-uppercase text-center">My Cart</h1>
            <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span
                    class="low-text-contrast text-white">Cart</span></div>
        </div>
    </div>
</div>
<div class="" id="cart-summary">
    <div class="container is-full-wide">
        @php
        $cart_count = 0;
            if(Session::has('cart')){
                $cart_count = count(Session::get('cart'));
                $carts = Session::get('cart');
            }
        @endphp
        @if( $cart_count >= 1 )
            <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach (Session::get('cart') as $key => $cartItem)
                        @php
                            $product = \App\Product::find($cartItem['id']);
                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                            $product_name_with_choice = $product->name;
                            if ($cartItem['variant'] != null) {
                                $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                            }
                            // if(isset($cartItem['color'])){
                            //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                            // }
                            // foreach (json_decode($product->choice_options) as $choice){
                            //     $str = $choice->name; // example $str =  choice_0
                            //     $product_name_with_choice .= ' - '.$cartItem[$str];
                            // }
                            @endphp
                        <tr>
                            <th scope="row"> <a href="{{ route('product', $product->slug) }}" class="inline-link sm-hidden"><img
                                        src="{{ asset($product->thumbnail_img) }}" alt=""></a></th>
                            <td scope="row"> <a href="{{ route('product', $product->slug) }}" class="inline-link">{{ $product_name_with_choice }}</a></td>
                            <td>
                                <div class="num-block skin-3">
                                    <div class="num-in"> <span class="minus dis"></span>
                                        <input type="text" id="NetQty" class="in-num" value="{{ $cartItem['quantity'] }}" readonly="" onchange="updateQuantity({{ $key }}, this)">
                                        <span class="plus"></span> </div>
                                </div>
                            </td>
                            <td class="text-align-right">{{ single_price($cartItem['price']) }}</td>
                            <td class="text-align-center"><a href="javascript:void(0)" onclick="removeFromCartView(event, {{ $key }})" class="inline-link fw-800"><i
                                        class="fa is-24px"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="border-top:6px solid #000;margin-bottom: 10px; padding-bottom: 10px;"></div>
                <div>
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if(Session::get('coupon_discount'))

                                <div class="coupon focus">
                                    <input type="text" name="code" class="input-text" id="coupon_code"
                                            placeholder="Coupon code" value="{{Session::get('coupon_code')}}">
                                    <button type="submit" class="button" value="Apply coupon">Apply coupon</button>

                                </div>
                            <a href="{{route('checkout.remove_coupon_code')}}" class="border-button"> Remove coupon </a>

                        @else
                            <div class="coupon focus">
                                <input type="text" name="code" class="input-text" id="coupon_code"
                                        placeholder="Coupon code">
                                <button type="submit" class="button" value="Apply coupon">Apply coupon</button>
                            </div>
                        @endif

                    </form>
                    {{-- <button type="submit" disabled class="margin-left border-button" name="update cart"
                        value="update cart">Update Cart</button> --}}
                </div>
            </div>
            <div class="col lg-3 md-12 no-margin-bottom padding-top-bottom-double">
                @include('frontend.partials.cart_summary')
                @if(Auth::check())
                    <div> <a href="{{ route('checkout.shipping_info') }}" class="inline-button">Proceed to checkout</a> </div>
                @else
                    <div> <a href="#"  data-modal-id="popup1" class="inline-button">Proceed to checkout</a> </div><!-- onclick="showCheckoutModal()" -->
                @endif
            </div>
        @else
        <div class="col lg-12 md-12 no-margin-bottom padding-top-bottom-double text-center">
            <h2> Your Cart is Empty </h2>
          </div>
        @endif
    </div>
</div>
<div class="section">
    <div class="container is-wide">
        <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">FREE SHIPPING</div>
            </div>
        </div>
        <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">SPECIAL OFFERS</div>
            </div>
        </div>
        <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">ORDER PROTECTION</div>
            </div>
        </div>
        <div class="col lg-3 md-6 sm-12 flex-align-middele no-margin-bottom-lg text-align-center">
            <div class="upper-footer flex-column-center">
                <div class="fa margin-right icon"></div>
                <div class="size-h4 text-with-icon margin-bottom-small text-align-center">PROFESSIONAL SUPPORT</div>
            </div>
        </div>
    </div>
</div>


  <!-- Modal -->
  <!-- <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{__('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="tel" name="phone" class="form-control" placeholder="{{__('Phone')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-user"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group--style-1">
                                    <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                    <span class="input-group-addon">
                                        <i class="text-md la la-lock"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    {{-- <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{__('Forgot password?')}}</a> --}}
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{__('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="text-center pt-3">
                        <p class="text-md">
                            {{__('Need an account?')}} <a href="#" onclick="showsingupModal()" class="strong-600">{{__('Register Now')}}</a>
                        </p>
                    </div>
                    {{-- @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 my-3 text-center">
                            <span>or</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif --}}
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>or</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{__('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> -->

    <div id="popup1" class="modal-box modal">
      <div class="modal-body">
        <div class="close-icon js-modal-close"><i class="fa icon" style="font-size: 22px;"></i></div>
        <h2 class="text-uppercase">{{__('Login')}}</h2>
        <div class="p-3 login-register">
          <div class="login" style="padding:0 !important;">
          <form role="form" action="{{ route('cart.login.submit') }}" method="POST">
            @csrf
              <fieldset>
                  <label class="text-align-left" for="Username">Email <span class="required">*</span></label>
                  <input type="tel" name="email" placeholder="{{__('Email')}}">
              </fieldset>
              <fieldset>
                  <label class="text-align-left" for="password">Password <span class="required">*</span></label>
                  <input type="password" name="password" placeholder="{{__('Password')}}">
              </fieldset>
              <button type="submit" class="inline-button">{{__('Sign in')}}</button>
              {{-- <a href="{{ route('password.request') }}" class="">{{__('Forgot password?')}}</a> --}}
          </form>
          <p class="text-center" style="margin: 10px 0 0 0 !important;">
              {{__('Need an account?')}} <a href="#" class="animation-underline-link" onclick="showsingupModal()" class="strong-600">{{__('Register Now')}}</a>
          </p>
          {{-- @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
              <div class="or or--1 my-3 text-center">
                  <span>or</span>
              </div>
              <div class="p-3 pb-0">
                  @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                      <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                          <i class="icon fa fa-facebook"></i> {{__('Login with Facebook')}}
                      </a>
                  @endif
                  @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                      <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                          <i class="icon fa fa-google"></i> {{__('Login with Google')}}
                      </a>
                  @endif
                  @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                  <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                      <i class="icon fa fa-twitter"></i> {{__('Login with Twitter')}}
                  </a>
                  @endif
              </div>
          @endif --}}
          @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
              <div class="bb-login-form-divider"><span>Or</span></div>
              <div class="text-center">
                  <a href="{{ route('checkout.shipping_info') }}" class="create-account-btn-border">{{__('Guest Checkout')}}</a>
              </div>
          @endif
          </div>
        </div>
        <div class="w-clearfix">&nbsp;</div>
      </div>
    </div>
    @endsection
@section('script')

    <script>
    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }
    function updateQuantity(key, element){
        $.post('{{ route('cart.updateQuantity') }}', {
            _token   :  '{{ csrf_token() }}',
            id       :  key,
            quantity :  element.value
        }, function(data){
            // updateNavCart();
            $('#cart-summary').html(data);
        });
    }

    </script>

@endsection
