@extends('frontend.layouts.app')
    @section('content')
    @php
        $status = $order->orderDetails->first()->delivery_status;
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
              <li class="breadcrumb-item active" aria-current="page">Confirmation</li>
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
            <div class="col done">
              <div class="text-center success-step"> <i class="la-3x mb-2 fa fa-credit-card"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">4. Payment</h3>
              </div>
            </div>
            <div class="col active">
              <div class="text-center active-step"> <i class="la-3x mb-2 fa fa-check-circle"></i>
                <h3 class="fs-14 fw-600 d-none d-lg-block">5. Confirmation</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="mb-4">
    <div class="container">
      <div class="row">
        <div class="col-xxl-8 col-xl-10 mx-auto">
          <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
            <div class="row mb-5">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <i class="la-3x mb-2 las la-check-circle"></i>
                <h2>Thank You for Your Order!</h2>
                <p><strong>Order Code: {{ $order->code }}</strong></p>
                @if ($order->user_id != null)
                <p><em>A copy or your summary has been sent to  {{ $order->user->email }}</em></p>
                @endif
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div style="border-top: 1px solid #dee2e6;">
                    <h4 class="m-0 pb-2 pt-2">Order Summary</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Order Code:</td>
                            <td>{{ $order->code }}</td>
                            <td>Order date:</td>
                            <td>{{ date('d-m-Y H:m A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td>{{ json_decode($order->shipping_address)->user_type ?? "Mr" }}. {{ json_decode($order->shipping_address)->name }}</td>
                            <td>Order status:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{ $order->user->email }}</td>
                            <td>Total order amount:</td>
                            <td>{{format_price($order->grand_total)}}</td>
                        </tr>
                        <tr>
                            <td>Shipping address:</td>
                            <td>{{ json_decode($order->shipping_address)->user_type ?? "Mr" }}. {{ json_decode($order->shipping_address)->name }}<br>{{ json_decode($order->shipping_address)->phone }}<br>{{ json_decode($order->shipping_address)->address }}<br>{{ json_decode($order->shipping_address)->city }} - {{ json_decode($order->shipping_address)->postal_code }}<br>{{ json_decode($order->shipping_address)->state }}, {{ json_decode($order->shipping_address)->country }}</td>
                            <td>Shipping charge method:</td>
                            <td>Flat shipping rate</td>
                        </tr>
                        <tr>
                          <td>Billing address:</td>
                          <td>{{ json_decode($order->billing_address)->user_type ?? "Mr" }}. {{ json_decode($order->billing_address)->name }}<br>{{ json_decode($order->billing_address)->phone }}<br>{{ json_decode($order->billing_address)->address}}<br>{{ json_decode($order->billing_address)->city }} - {{ json_decode($order->billing_address)->postal_code }}<br>{{ json_decode($order->billing_address)->state }}, {{ json_decode($order->billing_address)->country }}</td>
                          <td></td>
                          <td></td>
                      </tr>
                        <tr>
                            <td>Payment method:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                <div style="border-top: 1px solid #dee2e6;">
                    <h4 class="m-0 pb-2 pt-2">Order Details</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>#</td>
                            <td>Product</td>
                            <td>Variaion</td>
                            <td>Quantity</td>
                            <td>Delivery Type</td>
                            <td>Base Price </td>
                            <td> Tax </td>
                            <td>Total Price</td>
                        </tr>
                        @foreach ($order->orderDetails as $key => $orderDetail)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ $orderDetail->product->slug }}" class="inline-link">{{ $orderDetail->product->name }}</a></td>
                            <td></td>
                            <td>{{ $orderDetail->quantity }}</td>
                            <td>
                            @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                {{ __('Home Delivery') }}
                            @elseif ($orderDetail->shipping_type == 'pickup_point')
                                @if ($orderDetail->pickup_point != null)
                                    {{ $orderDetail->pickup_point->name }} ({{ __('Pickip Point') }})
                                @endif
                            @endif
                            </td>
                            <td> {{ format_price($orderDetail->price) }}</td>
                            <td> {{ format_price($orderDetail->tax) }}</td>
                            <td>{{ format_price($orderDetail->price + $orderDetail->tax) }}</td>
                        </tr>
                       @endforeach
                    </table>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <a href="{{ route('customer.invoice.download', $order->id) }}" class="black-flat-button">Download Invoice</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

    @endsection
