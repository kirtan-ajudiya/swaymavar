<a href="#" class="c-navbar-icon on-dark"> 
    @if(Session::has('cart'))
        <span id="cart_items_sidenav">{{ count(Session::get('cart'))}}</span>
    @else
        <span id="cart_items_sidenav">0</span>
    @endif
</a>
<div class="c-cart__dropdown" >
    @if(Session::has('cart'))
        @if(count($cart = Session::get('cart')) > 0)
            @php
                $total = 0;
            @endphp
            @foreach($cart as $key => $cartItem)
                @php
                    $product = \App\Product::find($cartItem['id']);
                    $total = $total + $cartItem['price']*$cartItem['quantity'];
                @endphp
                <div class="c-cart__item" > <a href="#" class="c-cart__remove-btn w-inline-block">
                        <div class="iconfont"><em onclick="removeFromCart({{ $key }})" class="iconfont__no-italize"></em></div>
                    </a> <img src="{{ asset($product->thumbnail_img) }}" width="64" alt="" class="c-cart__thumbnail">
                    <div class="text-align-left text-small flexv-space-between">
                        <div class="is-heading-color margin-bottom-xsmall md-text-xsmall">{{ __($product->name) }}</div>
                        <div class="weight-is-medium low-text-contrast">{{ $cartItem['quantity'] }} × {{ single_price($cartItem['price']*$cartItem['quantity']) }}</div>
                    </div>
                </div>
            @endforeach
            
                <div class="c-cart__section">
                    <div>Subtotal : </div>
                    <div>{{ single_price($total) }}</div>
                </div>

                <div class="c-cart__buttons"> <a href="{{ route('cart') }}"
                                        class="button-primary is-small min-width-100px is-ghost md-margin-bottom-small w-inline-block">
                                        <div class="button-primary-text flexv-justify-center" style="color: #45a48c;">view Cart</div>
                                    </a>
                    </a> <a href="{{ route('checkout.shipping_info') }}" class="button-primary is-small min-width-100px w-inline-block">
                        <div class="button-primary-text flexv-justify-center">Checkout</div>
                    </a>
                </div>
        @else
            <div class="text-center p-3">
                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                <h3 class="h6 fw-700">Your Cart is empty</h3>
            </div>
        @endif
    @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">Your Cart is empty</h3>
        </div>
    @endif
</div>