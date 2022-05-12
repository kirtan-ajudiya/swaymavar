
            <table class="table transparent-bg">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Product</th>
                        <th scope="col">Total</th>
                        <th scope="col">hello</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        $discount_boutique_price=0;
                        $discount_boutique=0;
                        if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'flat_rate') {
                            $shipping = \App\BusinessSetting::where('type', 'flat_rate_shipping_cost')->first()->value;
                        }
                        $admin_products = array();
                        $seller_products = array();
                    @endphp
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                        $product = \App\Product::find($cartItem['id']);
                        if($product->added_by == 'admin'){
                            array_push($admin_products, $cartItem['id']);
                        }
                        else{
                            $product_ids = array();
                            if(array_key_exists($product->user_id, $seller_products)){
                                $product_ids = $seller_products[$product->user_id];
                            }
                            array_push($product_ids, $cartItem['id']);
                            $seller_products[$product->user_id] = $product_ids;
                        }
                        $subtotal += $cartItem['price']*$cartItem['quantity'];
                        $tax += $cartItem['tax']*$cartItem['quantity'];
                        if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'product_wise_shipping') {
                            $shipping += $cartItem['shipping'];
                        }
                        $product_name_with_choice = $product->name;
                        if ($cartItem['variant'] != null) {
                            $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                        }


                        if(isset($product->booty_discount) && isset(Auth::user()->is_boutique) && Auth::user()->is_boutique == 1){


                            foreach(json_decode($product->booty_discount) as $val){
                            if($val->max_qty <=  $cartItem['quantity']){
                                $discount_boutique=$val->discount_max;
                            }
                        }

                        if($discount_boutique != 0 && $discount_boutique != ""){
                            $discount_boutique_price = ($subtotal*$discount_boutique)/100;
                        }
                        }
                    @endphp
                        <tr>
                            <th scope="row"> <a href="{{ route('product', $product->slug) }}" class="inline-link"><img
                                        src="{{ asset($product->thumbnail_img) }}" alt=""
                                        class="margin-right sm-hidden"></a></th>
                            <td><a href="{{ route('product', $product->slug) }}" class="inline-link">{{ $product_name_with_choice }}</a><span class="quantity-number"> x {{ $cartItem['quantity'] }}</span>
                            </td>
                            <td class="text-align-right">{{ single_price($cartItem['price']) }}</td>
                        </tr>
                   @endforeach
                </tbody>
                @php
                    if (\App\BusinessSetting::where('type', 'shipping_type')->first()->value == 'seller_wise_shipping') {
                        if(!empty($admin_products)){
                            $shipping = \App\BusinessSetting::where('type', 'shipping_cost_admin')->first()->value;
                        }
                        if(!empty($seller_products)){
                            foreach ($seller_products as $key => $seller_product) {
                                $shipping += \App\Shop::where('user_id', $key)->first()->shipping_cost;
                            }
                        }
                    }
                @endphp
                @php
                $generalsetting = \App\GeneralSetting::first();
                   if(($subtotal+$tax) > $generalsetting->Max_price_free_shipping){
                       $shipping=0;
                       $Shipping_flag=1;
                   }else{
                       $shipping=$generalsetting->shipping_cost_final;
                       $Shipping_text=$shipping;
                       $Shipping_flag=0;
                   }
                   if(Auth::check() && Auth::user()->pro_member == 1){
                       $shipping=0;
                       $Shipping_flag=1;
                   }
                    $total = $subtotal+$tax+$shipping;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                @endphp
                <tfoot class="cart-table">
                    <tr>
                        <th scope="row" colspan="2">Subtotal:</th>
                        <td class="text-align-right">{{ single_price($subtotal) }}</td>
                    </tr>
                    @if($Shipping_flag == 0)
                    <tr>
                        <th scope="row" colspan="2">Shipping:</th>
                        <td class="text-align-right">{{ single_price($shipping) }}</td>
                    </tr>
                    @else
                    <tr>
                        <th scope="row" colspan="2">Shipping:</th>
                        <td class="text-align-right">Free Shipping</td>
                    </tr>
                    @endif
                    <tr>
                        <th scope="row" colspan="2">Discount:</th>
                        <td class="text-align-right">{{ single_price(Session::get('coupon_discount')) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">Tax (all taxes are included):</th>
                        <td class="text-align-right">{{ single_price($tax) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" colspan="2">Total:</th>
                        <td class="fw-700 text-align-right">{{ single_price($total) }}</td>
                    </tr>
                </tfoot>
            </table>
