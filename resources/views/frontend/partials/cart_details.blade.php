<div class="container">
      <div class="row">
          @php
        $cart_count = 0;
            if(Session::has('cart')){
                $cart_count = count(Session::get('cart'));
                $carts = Session::get('cart');
            }
        @endphp
        @if( $cart_count < 0 )
        <div class="col-xxl-8 col-xl-10 mb-5 mx-auto">
            <div class="shadow-sm bg-white p-4 rounded">
                <div class="text-center p-3">
                    <i class="las la-frown la-3x opacity-60 mb-3"></i>
                    <h3 class="h4"><strong>Your Cart is empty</strong></h3>
                </div>
            </div>
        </div>
        @else

        <div class="col-xxl-8 col-xl-10 mx-auto">
          <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
            <div class="mb-4">
              <div class="row gutters-5 d-none d-lg-flex border-bottom mb-3 pb-3">
                <div class="col-md-4 fw-600">Product</div>
                <div class="col fw-600">Price</div>
                <!-- <div class="col fw-600">Tax</div> -->
                <div class="col fw-600">Discount</div>
                <div class="col fw-600">Quantity</div>
                <div class="col fw-600">TOTAL</div>
                <div class="col-auto fw-600">Remove</div>
              </div>
              <ul class="list-group list-group-flush">
                  @php $total =0; @endphp
                  @foreach($carts as $key=>$cartItem)
                  @php
                    $product = App\Product::find($cartItem['id']);
                    $total += FrontTotalPrice($product->id) * $cartItem['quantity'];
                  @endphp
                <li class="list-group-item px-0 px-lg-3">
                  <div class="row gutters-5">
                    <div class="col-lg-4 d-flex" style="align-items: center !important;">
                        <span class="mr-2 ml-0">
                            <img src="{{ asset($product->thumbnail_img) }}" class="img-fit size-60px rounded" alt="Product Image">
                        </span>
                        <span class="fs-14 opacity-60">{{$product->product_name}}</span>
                      </div>
                    <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0 d-flex" style="flex-direction: column !important;justify-content: space-around !important;">
                        <span class="opacity-60 fs-12 d-block d-lg-none">Price</span>
                        <span class="fw-600 fs-16">{{format_price(FrontTotalPrice($product->id))}}</span>
                    </div>
                    <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0 d-flex" style="flex-direction: column !important;justify-content: space-around !important;">
                        <span class="opacity-60 fs-12 d-block d-lg-none">Discount</span>
                        <span class="fw-600 fs-16">{{format_price(FrontTotalPrice($product->id))}}</span>
                    </div>
                    <div class="col-lg col-5 order-4 order-lg-0 my-3 my-lg-0 d-flex" style="flex-direction: column !important;justify-content: space-around !important;">
                        <div class="num-block skin-3">
                          <div class="num-in">
                            <span class="minus dis" onchange="updateQuantity({{ $cartItem['id'] }}, this)"></span>
                            <input type="text" id="NetQty" class="in-num" value="{{$cartItem['quantity']}}" readonly="" onchange="updateQuantity({{ $key }}, this)">
                            <span class="plus" onchange="updateQuantity({{ $cartItem['id'] }}, this)"></span>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0 d-flex" style="flex-direction: column !important;justify-content: space-around !important;">
                        <span class="opacity-60 fs-12 d-block d-lg-none">Total</span>
                        <span class="fw-600 fs-16 active-step">{{format_price(FrontTotalPrice($product->id) * $cartItem['quantity'])}}</span>
                    </div>
                    <div class="col-lg-auto col-3 order-5 order-lg-0 my-3 my-lg-0 text-right d-flex" style="flex-direction: column !important;justify-content: space-around !important;">
                        <a href="javascript:void(0)"  onclick="removeFromCartView(event, {{ $key }})" class="trash-btn">
                            <i  style="color:#C69426" class="fa fa-trash"></i>
                        </a>
                    </div>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>
            <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                <span class="opacity-60 fs-15">Subtotal</span>
                <span class="fw-600 fs-17">{{format_price($total)}}</span>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                  <a href="{{route('products')}}" style="color:#C69426" class="inline-link">
                      <i class="las la-arrow-left"></i> Return to shop
                  </a>
                </div>
              <div class="col-md-6 text-center text-md-right">

                  <a href="#" data-toggle="modal" data-target="#loginModal" class="black-flat-button">Continue to Shipping</a>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>

    <script>
    $(document).ready(function() {
      $('.num-in span').click(function () {
          var $input = $(this).parents('.num-block').find('input.in-num');
        if($(this).hasClass('minus')) {
          var count = parseFloat($input.val()) - 1;
          count = count < 1 ? 1 : count;
          if (count < 2) {
            $(this).addClass('dis');
          }
          else {
            $(this).removeClass('dis');
          }
          $input.val(count);
        }
        else {
          var count = parseFloat($input.val()) + 1
          $input.val(count);
          if (count > 1) {
            $(this).parents('.num-block').find(('.minus')).removeClass('dis');
          }
        }
        $input.change();
        return false;
      });
    });
  </script>

@section('script')
<script type="text/javascript">
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

    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
</script>
@endsection
