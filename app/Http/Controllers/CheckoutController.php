<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NimbblController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\PaytmController;
use App\Order;
use App\BusinessSetting;
use App\Coupon;
use App\CouponUsage;
use App\User;
use App\Address;
use Session;
use App\JewelryProduct;
use Cookie;
class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {
        if($request->teams_conditions == 1){
            if ($request->payment_option != null) {

                $orderController = new OrderController;
                $orderController->store($request);
    
                $request->session()->put('payment_type', 'cart_payment');
                if($request->session()->get('order_id') != null){
                    if($request->payment_option == 'paypal'){
                        $paypal = new PaypalController;
                        return $paypal->getCheckout();
                    }
                    elseif ($request->payment_option == 'stripe') {
                        $stripe = new StripePaymentController;
                        return $stripe->stripe();
                    }
                    elseif ($request->payment_option == 'sslcommerz') {
                        $sslcommerz = new PublicSslCommerzPaymentController;
                        return $sslcommerz->index($request);
                    }
                    elseif ($request->payment_option == 'instamojo') {
                        $instamojo = new InstamojoController;
                        return $instamojo->pay($request);
                    }
                    elseif ($request->payment_option == 'razorpay') {
                        $razorpay = new RazorpayController;
                        return $razorpay->payWithRazorpay($request);
                    }
                    elseif ($request->payment_option == 'nimbbl') {
                        $razorpay = new NimbblController;
                        return $razorpay->payWithNimbbl($request);
                    }
                    elseif ($request->payment_option == 'paystack') {
                        $paystack = new PaystackController;
                        return $paystack->redirectToGateway($request);
                    }
                    elseif ($request->payment_option == 'voguepay') {
                        $voguePay = new VoguePayController;
                        return $voguePay->customer_showForm();
                    }
                    elseif ($request->payment_option == 'paytm') {
                        $paytm = new PaytmController;
                        return $paytm->index();
                    }
                    elseif ($request->payment_option == 'cash_on_delivery') {
                        dd("bhnb");
                        $request->session()->put('cart', collect([]));
                        // $request->session()->forget('order_id');
                        $request->session()->forget('delivery_info');
                        $request->session()->forget('coupon_id');
                        $request->session()->forget('coupon_discount');
    
                        flash("Your order has been placed successfully")->success();
                        return redirect()->route('order_confirmed');
                    }
                    // elseif ($request->payment_option == 'wallet') {
                    //     $user = Auth::user();
                    //     $user->balance -= Order::findOrFail($request->session()->get('order_id'))->grand_total;
                    //     $user->save();
                    //     return $this->checkout_done($request->session()->get('order_id'), null);
                    // }
                    else{
                        dd("GTg");
                        $order = Order::findOrFail($request->session()->get('order_id'));
                        $order->manual_payment = 1;
                        $order->save();
    
                            $request->session()->put('cart', collect([]));
                        // $request->session()->forget('order_id');
                            $request->session()->forget('delivery_info');
                            $request->session()->forget('coupon_id');
                            $request->session()->forget('coupon_discount');
    
                        flash(__('Your order has been placed successfully. Please submit payment information from purchase history'))->success();
                        return redirect()->route('order_confirmed');
                        
                    }
            }
            }else {
                flash(__('Select Payment Option.'))->success();
                return back();
            }

        }else{
            flash(__('Please Agree with Term & Condition'))->error();
                return back();
        }
        
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($order_id, $payment)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'paid';
        $order->payment_details = $payment;
        $order->save();

        if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            $affiliateController = new AffiliateController;
            $affiliateController->processAffiliatePoints($order);
        }

        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            $clubpointController = new ClubPointController;
            $clubpointController->processClubPoints($order);
        }

        if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
        if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
            $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();
                if($orderDetail->product->user->user_type == 'seller'){
                    $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100 + $orderDetail->tax + $orderDetail->shipping_cost;
                    $seller->save();
                }
            }
        }
        else{
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();
                if($orderDetail->product->user->user_type == 'seller'){
                    $commission_percentage = $orderDetail->product->category->commision_rate;
                    $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100  + $orderDetail->tax + $orderDetail->shipping_cost;
                    $seller->save();
                }
            }
        }
        }
        else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();
                if($orderDetail->product->user->user_type == 'seller'){
                    $seller = $orderDetail->product->user->seller;
                    $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                    $seller->save();
                }
            }
        }

        $order->commission_calculated = 1;
        $order->save();

        Session::put('cart', collect([]));
        // Session::forget('order_id');
        Session::forget('payment_type');
        Session::forget('delivery_info');
        Session::forget('coupon_id');
        Session::forget('coupon_discount');

        flash(__('Payment completed'))->success();
        return redirect()->route('order_confirmed');
    }

    public function get_shipping_info(Request $request)
    {
        if(Session::has('cart') && count(Session::get('cart')) > 0){
            $categories = Category::all();
            return view('frontend.shipping_info', compact('categories'));
        }
        flash(__('Your cart is empty'))->success();
        return back();
    }

    public function store_shipping_info(Request $request)
    {
        if (!Auth::check()) {
            flash("Login First")->error();
            return back();
        }
            if($request->address_id == null){
                flash("Please add shipping address")->warning();
                return back();
            }
            if($request->billing_id == null){
                flash("Please add billing address")->warning();
                return back();
            }
            //dd($request->address_id);
            $address = Address::findOrFail($request->address_id);
            $data['user_type'] = $address->user_type;
            $data['name'] = $address->first_name." ".$address->last_name;
            $data['email'] = Auth::user()->email;
            $data['address'] = $address->address;
            $data['country'] = $address->country;
            $data['state'] = $address->state;
            $data['city'] = $address->city;
            $data['postal_code'] = $address->postal_code;
            $data['phone'] = $address->phone;
            $data['checkout_type'] = $request->checkout_type;

            $billingaddress = Address::findOrFail($request->billing_id);
            $billingdata['user_type'] = $billingaddress->user_type;
            $billingdata['name'] = $billingaddress->first_name." ".$billingaddress->last_name;
            $billingdata['email'] = Auth::user()->email;
            $billingdata['address'] = $billingaddress->address;
            $billingdata['country'] = $billingaddress->country;
            $billingdata['state'] = $billingaddress->state;
            $billingdata['city'] = $billingaddress->city;
            $billingdata['postal_code'] = $billingaddress->postal_code;
            $billingdata['phone'] = $billingaddress->phone;
            $billingdata['checkout_type'] = $request->checkout_type;
        $shipping_info = $data;
        $billing_info = $billingdata;
        $request->session()->put('shipping_info', $shipping_info);
        $request->session()->put('billing_info', $billing_info);

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        foreach (Session::get('cart') as $key => $cartItem){
            $subtotal += $cartItem['price']*$cartItem['quantity'];
            $tax += $cartItem['tax']*$cartItem['quantity'];
            $shipping += $cartItem['shipping']*$cartItem['quantity'];
        }

        $total = $subtotal + $tax + $shipping;

        // if(Session::has('coupon_discount')){
        //         $total -= Session::get('coupon_discount');
        // }

        return view('frontend.delivery_info');
        // return view('frontend.payment_select', compact('total'));
    }

    public function store_delivery_info(Request $request)
    {
        if(Session::has('cart') && count(Session::get('cart')) > 0){
            $cart = $request->session()->get('cart', collect([]));
            $cart = $cart->map(function ($object, $key) use ($request) {
                if(\App\Product::find($object['id'])){
                    if($request['delivery_type'] == 'home_delivery'){
                        $object['shipping_type'] = 'home_delivery';
                        $object['shipping'] = 0;
                    }
                    else{
                        $object['delivery_type'] = 'pickup_point';
                        $object['pickup_point'] = $request->pickup_point_id_admin;
                        $object['shipping'] = 0;
                    }
                }
                // else{
                //     if($request['shipping_type_'.\App\Product::find($object['id'])->user_id] == 'home_delivery'){
                //         $object['shipping_type'] = 'home_delivery';
                //         $object['shipping'] = \App\Product::find($object['id'])->shipping_cost;
                //     }
                //     else{
                //         $object['shipping_type'] = 'pickup_point';
                //         $object['pickup_point'] = $request['pickup_point_id_'.\App\Product::find($object['id'])->user_id];
                //         $object['shipping'] = 0;
                //     }
                // }
                return $object;
            });

            $request->session()->put('cart', $cart);

            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            foreach (Session::get('cart') as $key => $cartItem){
                $subtotal += $cartItem['price']*$cartItem['quantity'];
                $tax += $cartItem['tax']*$cartItem['quantity'];
                $shipping += $cartItem['shipping']*$cartItem['quantity'];
            }

            $total = $subtotal + $tax + $shipping;

            // if(Session::has('coupon_discount')){
            //         $total -= Session::get('coupon_discount');
            // }


            return view('frontend.payment_select', compact('total'));
        }
        else {
            flash('Your Cart was empty')->warning();
            return redirect()->route('home');
        }
    }

    public function get_payment_info(Request $request)
    {
        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        foreach (Session::get('cart') as $key => $cartItem){
            $subtotal += $cartItem['price']*$cartItem['quantity'];
            $tax += $cartItem['tax']*$cartItem['quantity'];
            $shipping += $cartItem['shipping']*$cartItem['quantity'];
        }

        $total = $subtotal + $tax + $shipping;

        if(Session::has('coupon_discount')){
                $total -= Session::get('coupon_discount');
        }

        return view('frontend.payment_select', compact('total'));
    }

    public function apply_coupon_code(Request $request){
        //dd($request->all());
        $coupon = Coupon::where('code', $request->code)->first();

        if($coupon != null){
            if(strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date){
                if(CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null){
                    $coupon_details = json_decode($coupon->details);

                    if ($coupon->type == 'cart_base')
                    {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        foreach (Session::get('cart') as $key => $cartItem)
                        {
                            $subtotal += $cartItem['price']*$cartItem['quantity'];
                            $tax += $cartItem['tax']*$cartItem['quantity'];
                            $shipping += $cartItem['shipping']*$cartItem['quantity'];
                        }
                        $sum = $subtotal+$tax+$shipping;

                        if ($sum > $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount =  ($sum * $coupon->discount)/100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            }
                            elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                            $request->session()->put('coupon_id', $coupon->id);
                            $request->session()->put('coupon_discount', $coupon_discount);
                            flash('Coupon has been applied')->success();
                        }
                    }
                    elseif ($coupon->type == 'product_base')
                    {
                        $coupon_discount = 0;
                        foreach (Session::get('cart') as $key => $cartItem){
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if($coupon_detail->product_id == $cartItem['id']){
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += $cartItem['price']*$coupon->discount/100;
                                    }
                                    elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount;
                                    }
                                }
                            }
                        }
                        $request->session()->put('coupon_id', $coupon->id);
                        $request->session()->put('coupon_discount', $coupon_discount);
                        flash('Coupon has been applied')->success();
                    }
                }
                else{
                    flash('You already used this coupon!')->warning();
                }
            }
            else{
                flash('Coupon expired!')->warning();
            }
        }
        else {
            flash('Invalid coupon!')->warning();
        }
        return back();
    }

    public function remove_coupon_code(Request $request){
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back();
    }

    public function order_confirmed(){
        $order = Order::findOrFail(Session::get('order_id'));
        return view('frontend.order_confirmed', compact('order'));
    }
}
