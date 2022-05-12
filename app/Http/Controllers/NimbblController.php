<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Redirect;
use App\Order;
use App\OrderDetail;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Input;
use Auth;
use Nimbbl\Api\NimbblApi;
use Nimbbl\Api\NimbblError;

class NimbblController extends Controller
{
    public function payWithNimbbl($request)
    {
        $details = $request->session()->get('order_id');
        $order = Order::findOrFail($details);
        $data = json_decode($order->shipping_address);
        $fianlarray = array();
        foreach ($order->orderDetails  as $key => $orderdetails) {
            $fianlarray[] = array(
                "title" => $orderdetails->product->name ?? "",
                "quantity" => $orderdetails->quantity,
                'uom' => '',
                'image_url' => route('product', $orderdetails->product->slug),
                'description' => $orderdetails->product->short_description,
                'sku_id' =>  $orderdetails->product->sku_code,
                'amount_before_tax' => $orderdetails->price,
                'tax' => $orderdetails->tax,
                "total_amount" => $orderdetails->product->unit_price,
                );
        }
      
        try {
            $api = new NimbblApi('access_key_GZ3pw4kmYkEbVvbM', 'access_secret_GZ3pw4kmYkEbVvbM');

            $invoice = rand(1000, 5);
            $order_data = array(
                'referrer_platform' => 'referrer_platform',
                'merchant_shopfront_domain' => 'https://codealphainfotech.com/swaymvar-test/',
                'invoice_id' => $invoice,
                'order_date' => date('Y-m-d H:i:s'),
                'currency' => 'INR',
                'amount_before_tax' => $order->orderDetails->sum('price'),
                'tax' =>  $order->orderDetails->sum('tax'),
                'total_amount' => $order->grand_total,
                "user" => [
                    "mobile_number" => $data->phone ,
                    "email" =>  $data->email,
                    "first_name" => $data->name,
                    "last_name" => $data->name,
                ],
                'shipping_address' => [
                    'area' => $data->address ,
                    'city' =>  $data->city,
                    'state' =>  $data->state,
                    'pincode' =>  $data->postal_code,
                    'address_type' => 'home'
                ],

                "order_line_items" =>  $fianlarray,
                'description' => 'This is a test order...',
            );
            $newOrder = $api->order->create($order_data);
            if(Session::has('payment_type')){
                if(Session::get('payment_type') == 'cart_payment'){
                    $order = Order::findOrFail(Session::get('order_id'));
                    return view('frontend.payWithNimmbl', compact('order', 'newOrder', 'invoice'));
                }
            }

        } catch (\Throwable $th) {
            dd($th);
        }
       
    }

    public function payment(Request $request)
    {
        $api = new NimbblApi('access_key_GZ3pw4kmYkEbVvbM', 'access_secret_GZ3pw4kmYkEbVvbM');
        $order = $api->transaction->retrieveTransactionByOrderId($request->order_id);

      $success = $order->items[0]->status;

      if($success == 'succeeded'){
          $payment_detalis = json_encode(array('order_id'=>$request->order_id,'method' => $order->items[0]->payment_mode, 'amount' => $order->items[0]->grand_total_amount ));
        $checkoutController = new CheckoutController;
        return $checkoutController->checkout_done(Session::get('order_id'), $payment_detalis);
      }

    }
}
