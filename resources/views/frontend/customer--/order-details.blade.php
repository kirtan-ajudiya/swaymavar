@extends('frontend.customer.inc.sidenav')
    @section('sidenavleft')
    @php
        $banner = \App\Banner::where('published', 1)->where('position', 6)->first();
    @endphp
    <div class="section first-section"
        style="background: url({{asset($banner->photo)}}) no-repeat;background-size: cover;background-position: center;">
        <div class="row">
            <div class="col lg-12 page-title">
                <h1 class="text-white margin-bottom text-uppercase text-center">Order Detail</h1>
                <div class="text-small text-align-center"><a href="{{route('home')}}" class="on-dark">Home</a> / <span
                        class="low-text-contrast text-white">Order Detail</span></div>
            </div>
        </div>
    </div>

    @section('sidenavright')
    <div class="col lg-9 md-12 no-margin-bottom padding-top-bottom-double">
        <div class="text-align-left">
            @php
            $status = $order->orderDetails->first()->delivery_status;
            @endphp
            <p style="font-size: 1.625rem;line-height: 1.6;" class="fw-300">Order <span class="mask">#{{ $order->code }}</span> was
                placed on <span class="mask">{{ date("F j, Y", $order->date) }}</span> payment method <span class="mask">{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</span>
                and is currently <span class="mask">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>.</p>
        </div>
        <div class="container container-nested is-wrapping">
          <div class="col lg-6 md-12 no-margin-bottom"><h2>Order Details</h2></div>
        <div class="col lg-6 md-12 no-margin-bottom" style="text-align: right;line-height: 55px;">
        @if($status == "pending")
            <a href="#" onclick="test()" id="cancel-order" class="inline-button small auto-width">Cancel This Order</a>
         @else
            <button class="inline-button small auto-width" disabled="">Canceled This Order</button>
            @endif
          </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Product</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderDetails as $key => $orderDetail)
                <tr>
                    <th scope="row"><a href="{{ route('product', $orderDetail->product->slug) }}" class="inline-link sm-hidden"><img
                                src="{{ asset($orderDetail->product->thumbnail_img) }}" alt="" class="margin-right "></a></th>
                    <td><a href="{{ route('product', $orderDetail->product->slug) }}" class="inline-link">{{ $orderDetail->product->name }}</a> x {{ $orderDetail->quantity }} </td>
                    <td class="text-align-right">{{ single_price($orderDetail->price) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="cart-table">
                <tr>
                    <th scope="row" colspan="2">Subtotal:</th>
                    <td class="text-align-right">{{ single_price($order->orderDetails->sum('price')) }}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">Tax:</th>
                    <td class="text-align-right">{{ single_price($order->orderDetails->sum('tax')) }}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">Shipping:</th>
                    <td class="text-align-right">{{ single_price($order->orderDetails->sum('shipping_cost')) }}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">Discount:</th>
                    <td class="text-align-right">{{ single_price($order->coupon_discount) }}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">Payment method:</th>
                    <td class="text-align-right">{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">Total:</th>
                    <td class="fw-700 text-align-right">{{ single_price($order->grand_total) }}</td>
                  </tr>
            </tfoot>
        </table>
        <div class="order_details_notes">
            <h3>Note:</h3>
            <p class="no-margin-bottom">It is a long established fact that a reader will be distracted by the readable
                content of a page when looking at its layout.</p>
        </div>
        <div class="container is-full-wide margin-top">
            <div class="col lg-6 md-6 sm-12 no-margin-bottom no-padding-lr">
                <h2>Billing Address</h2>
                <p class="fs-19px fw-500" style="font-style: italic;text-transform: capitalize;">{{ json_decode($order->billing_address)->firstname }} {{ json_decode($order->billing_address)->lastname }}<br>{{ json_decode($order->billing_address)->address}}<br>{{ json_decode($order->billing_address)->postal_code }} - {{ json_decode($order->billing_address)->city }}, {{ json_decode($order->billing_address)->state }}, {{ json_decode($order->billing_address)->country }}<br><br>{{ json_decode($order->billing_address)->phone }}<br>{{ json_decode($order->billing_address)->email }}</p>
            </div>
            <div class="col lg-6 md-6 sm-12 no-margin-bottom no-padding-lr">
                <h2>Shipping Address</h2>
                <p class="fs-19px fw-500" style="font-style: italic;text-transform: capitalize;">{{ json_decode($order->shipping_address)->firstname }} {{ json_decode($order->shipping_address)->lastname }}<br>{{ json_decode($order->shipping_address)->address}}<br>{{ json_decode($order->shipping_address)->postal_code }} - {{ json_decode($order->shipping_address)->city }}, {{ json_decode($order->shipping_address)->state }}, {{ json_decode($order->shipping_address)->country }}<br><br>{{ json_decode($order->shipping_address)->phone }}<br>{{ json_decode($order->shipping_address)->email }}</p>
            </div>
        </div>
    </div>
    @endsection

@endsection
@section('script')

<script> 


function test(){

    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    $('#cancel-order').attr('href','{{ route('order.canceled', $order->id) }}')
  }
})
}
</script>

@endsection