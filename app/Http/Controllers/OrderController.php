<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Order;
use App\Product;
use App\Address;
use App\Color;
use App\OrderDetail;
use App\CouponUsage;
use App\OtpConfiguration;
use App\User;
use App\BusinessSetting;
use Auth;
use Session;
use DB;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;
use CoreComponentRepository;
use App\CommisionLog;
use App\AffiliateUser;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.customer.orders', compact('orders'));
    }

    public function order_history()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.order-history', compact('orders'));
    }

    public function OrderView($id)
    {
        $orders = Order::where('id', decrypt($id))->where('user_id', Auth::user()->id)->first();
        return view('frontend.dashboard.order-view', compact('orders'));
    }
    
    public function seller_canceled_order()
    {
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', Auth::user()->id)
                    ->where('order_details.delivery_status', 'canceled')
                    ->select('orders.id')
                    ->distinct()
                    ->paginate(15);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.seller.canceled_orders', compact('orders'));
    }

    /**
     * Display a listing of the resource to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_orders(Request $request)
    {
        

        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', $admin_user_id)
                    ->where('order_details.delivery_status','!=', 'canceled')
                    ->select('orders.id')
                    ->distinct();
                    Order::where('viewed', '=', 0)->update(['viewed' => 1]);
        if ($request->payment_type != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('orders.index', compact('orders','payment_status','delivery_status', 'sort_search', 'admin_user_id'));
    }
    
    public function admin_canceled_orders(Request $request)
    {
       

        $payment_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', $admin_user_id)
                    ->where('order_details.delivery_status', 'canceled')
                    ->select('orders.id')
                    ->distinct();
        if ($request->payment_type != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('orders.canceled_orders', compact('orders','payment_status', 'sort_search', 'admin_user_id'));
    }

    /**
     * Display a listing of the sales to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        
        $arrayorder=array(); 
        $sort_search = null;
        $orders = Order::orderBy('code', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $user=User::where('name', 'like', '%'.$sort_search.'%')->pluck('id')->toArray();
            $orders = $orders->whereIn('user_id',$user);
        }
        $orders = $orders->paginate(15);
        foreach ($orders as $key => $value) {
           $sller=array(); 
              $detaildata=OrderDetail::where('order_id',$value->id)->get();  
              $status = 'Pending';
           foreach ($detaildata as $key => $orderDetail) {
             if($orderDetail->delivery_status == 'delivered'){
                         $status = 'Delivered';
              }
            if($orderDetail->delivery_status == 'canceled'){
                         $status = 'Canceled';
              }
              $userseller=User::where('id',$orderDetail->seller_id)->first();
              $sller[]=$userseller->name;
             }
        $value['seller']=implode(",",$sller);     
        $value['quntity']=count($detaildata);    
        $value['status']=$status;
        }
        return view('sales.index', compact('orders', 'sort_search'));
    }


    public function order_index(Request $request)
    {
        if (Auth::user()->user_type == 'staff') {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.shipping_type', 'pickup_point') //new line add 
//                        ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                        ->select('orders.id')
                        ->distinct()
                        ->paginate(15);

            return view('pickup_point.orders.index', compact('orders'));
        }
        else{
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.shipping_type', 'pickup_point')
                        ->select('orders.id')
                        ->distinct()
                        ->paginate(15);

            return view('pickup_point.orders.index', compact('orders'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));
            return view('pickup_point.orders.show', compact('order'));
        }
        else{
            $order = Order::findOrFail(decrypt($id));
            return view('pickup_point.orders.show', compact('order'));
        }
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        return view('sales.show', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
        }
        else{
            $order->guest_id = mt_rand(100000, 999999);
        }

        if(isset($request->Shiping_different_address) && $request->Shiping_different_address == 1){
            $order->shipping_address = json_encode($request->session()->get('shipping_info'));
            $order->billing_address = json_encode($request->session()->get('billing_info'));
        }else{
            $order->shipping_address = json_encode($request->session()->get('billing_info'));
            $order->billing_address = json_encode($request->session()->get('billing_info'));
        }

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His').rand(10,99);
        $order->date = strtotime('now');
        if($order->save()){
            $request->session()->put('order_id', $order->id);
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            foreach (Session::get('cart') as $key => $cartItem){
                $product = Product::find($cartItem['id']);

                $subtotal += $cartItem['price']*$cartItem['quantity'];
                $tax += $cartItem['tax']*$cartItem['quantity'];

                // if ($cartItem['shipping_type'] == 'home_delivery') {
                //     $shipping += \App\Product::find($cartItem['id'])->shipping_cost*$cartItem['quantity'];
                // }

                $product_variation = $cartItem['variant'];

                if($product_variation != null){
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                }
                else {
                    $product->current_stock -= $cartItem['quantity'];
                    $product->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  =$order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price =  $product->sub_total;
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $cartItem['shipping_type'];
               

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
            }
            $order->grand_total = $subtotal;

            if(Session::has('coupon_discount')){
                $order->grand_total -= Session::get('coupon_discount');
                $order->coupon_discount = Session::get('coupon_discount');

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = Auth::user()->id;
                $coupon_usage->coupon_id = Session::get('coupon_id');
                $coupon_usage->save();
            }

            $order->save();

            //stores the pdf for invoice
            // $pdf = PDF::setOptions([
            //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            //                 'logOutputFile' => storage_path('logs/log.htm'),
            //                 'tempDir' => storage_path('logs/')
            //             ])->loadView('invoices.customer_invoice', compact('order'));

            // $output = $pdf->output();
    		// file_put_contents('public/invoices/'.'Order#'.$order->code.'.pdf', $output);

            // $array['view'] = 'emails.invoice';
            // $array['subject'] = 'Order Placed - '.$order->code;
            // $array['from'] = env('MAIL_USERNAME');
            // $array['content'] = 'Hi. A new order has been placed. Please check the attached invoice.';
            // $array['file'] = 'public/invoices/Order#'.$order->code.'.pdf';
            // $array['file_name'] = 'Order#'.$order->code.'.pdf';

            // $admin_products = array();
            // $seller_products = array();
            // foreach ($order->orderDetails as $key => $orderDetail){
            //     if($orderDetail->product->added_by == 'admin'){
            //         array_push($admin_products, $orderDetail->product->id);
            //     }
            //     else{
            //         $product_ids = array();
            //         if(array_key_exists($orderDetail->product->user_id, $seller_products)){
            //             $product_ids = $seller_products[$orderDetail->product->user_id];
            //         }
            //         array_push($product_ids, $orderDetail->product->id);
            //         $seller_products[$orderDetail->product->user_id] = $product_ids;
            //     }
            // }

            // foreach($seller_products as $key => $seller_product){
            //     try {
            //      Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
            //      if(\App\User::find($key)->phone != null){
            //      $otpController = new OTPVerificationController;
            //      $otpController->send_order_seller(\App\User::find($key)->phone,$order);
            //     }
            //     } catch (\Exception $e) {

            //     }
            // }

            // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value){
            //     if(Auth::check() && Auth::user()->phone != null){
            //         $otpController = new OTPVerificationController;
            //         $otpController->send_order_code($order);
            //     }
            // }

            // //sends email to customer with the invoice pdf attached
            // if(env('MAIL_USERNAME') != null){
            //     try {
            //         Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
            //         Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
            //     } catch (\Exception $e) {

            //     }
            // }
            // unlink($array['file']);

          
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order != null){
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delete();
            }
            $order->delete();
            flash('Order has been deleted successfully')->success();
        }
        else{
            flash('Something went wrong')->error();
        }
        return back();
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        //$order->viewed = 1;
        $order->save();
        return view('frontend.partials.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        if($request->status == "delivered"){
             $order->delivered_date = date('Y-m-d H:i:s');
        }elseif($request->status == "canceled"){
             $order->canceled_date = date('Y-m-d H:i:s');
             $order->delivery_viewed = '1';
             $order->payment_status_viewed = '1';
        }
        $order->save();
          $set=0;
        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                if($orderDetail->save()){
                    $set=1;
                }
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                if($orderDetail->save()){
                    $set=1;
                }
            }
        }
        
       
        return 1;
    }
    
    
    public function canceled_order($order_id){
        if(isset($order_id) && $order_id!=""){
        $order = Order::findOrFail($order_id);
        $set=0;
        
         foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delivery_status = 'canceled';
                $order->canceled_date = date('Y-m-d H:i:s');
                $order->delivery_viewed = '1';
                $order->payment_status_viewed = '1';
                $order->save();
                if($orderDetail->save()){
                    $set=1;
                }
           }
       
         flash("Canceled Order successfully")->success();
        
        }else{
         flash("Something want wrong!")->error();
        
        }
         return redirect()->route('orders.index');
    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();

        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status != 'paid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();

        if($order->payment_status == 'paid' && $order->commission_calculated == 0){
            if ($order->payment_type == 'cash_on_delivery') {
                if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                    $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
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
                            $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                            $seller->save();
                        }
                    }
                }
            }
            elseif($order->manual_payment) {
                if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                    $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                    foreach ($order->orderDetails as $key => $orderDetail) {
                        $orderDetail->payment_status = 'paid';
                        $orderDetail->save();
                        if($orderDetail->product->user->user_type == 'seller'){
                            $seller = $orderDetail->product->user->seller;
                            $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
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
                            $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
                            $seller->save();
                        }
                    }
                }
            }

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            $order->commission_calculated = 1;
            $order->save();
        }
        return 1;
    }
    
    public function shiprocket_order_send($id){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/settings/company/pickup",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjczOTUwNywiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTgyNTY1NzgsImV4cCI6MTU5OTEyMDU3OCwibmJmIjoxNTk4MjU2NTc4LCJqdGkiOiI2UFJORDZSSW15OGpkTkJaIn0.k9U-vX41PxhwqkDOKp6RUPJLDkF29-eAUYIVAvZ6ako"
          ),
        ));

        $response = curl_exec($curl);
        $pick_poin=array();
        curl_close($curl);
      
        $data=json_decode($response);
        if(isset($data) && !empty($data)){
        if(isset($data->data->shipping_address) && !empty($data->data->shipping_address)){    
        foreach ($data->data->shipping_address as $value) {
        $pick_poin[]=$value->pickup_location;    
        }}}
        $order=decrypt($id);
        return view('orders.shiprocket', compact('order','pick_poin'));
    }
    
    public function send_shiprocket(request $request){
             $pay_methos="COD";
             $shiping_charge=0;
             $discount=0;
          $order = Order::findOrFail($request->orderid);
          $orderdetails = OrderDetail::where('order_id',$order->id)->get();
          $address= json_decode($order->shipping_address);
          if($order->payment_status == "unpaid"){
           $pay_methos="COD";                  
          }elseif($order->payment_status == "paid"){
              $pay_methos="Prepaid";
          } 
    
          $itemdata=array();    
          foreach ($orderdetails as $value) {
              $shiping_charge+=$value->shipping_cost;
              $itemdata[]=array(
                    "name"=> $value->product->name,
                    "sku"=> $value->product->slug,
                    "units"=> $value->quantity,
                    "selling_price"=> $value->price,
                    "discount"=> 0,
                    "tax"=> $value->tax,
                    "hsn"=> rand()
            );   
          }
          $ship_order_id=rand( 10000 , 99999 )."-".rand( 10000 , 99999 );
          $ship_order_date=date("Y-m-d h:i:sa", $order->date);
          $ship_pickup_location=$request->pick_loc;
          $ship_channel_id="";
          $ship_billing_customer_name=$order->user->name;
          $ship_billing_address=$address->address;
          $ship_billing_city=$address->city;
          $ship_billing_pincode=$address->postal_code;
          $ship_billing_state=$address->state;
          $ship_billing_country=$address->country;
          $ship_billing_email=$order->user->email;
          $ship_billing_phone=substr($order->user->phone, 3);
          $ship_shipping_is_billing=true;
          $ship_payment_method=$pay_methos;
          $ship_shipping_charges=$shiping_charge;
          $ship_total_discount=$order->coupon_discount;
          $ship_sub_total=$order->grand_total;
          $ship_length=$request->Length;
          $ship_breadth=$request->Width;
          $ship_height=$request->Height;
          $ship_weight=$request->Weight;
    $data=array(    
          
    "order_id"=> $ship_order_id,
    "order_date"=> $ship_order_date,
    "pickup_location"=> $ship_pickup_location,
    "channel_id"=> "",
    "comment"=> "",
    "reseller_name"=> "",
    "company_name"=> "Table1",
    "billing_customer_name"=> $ship_billing_customer_name,
    "billing_last_name"=> "",
    "billing_address"=> $ship_billing_address,
    "billing_address_2"=> "",
    "billing_isd_code"=> "",
    "billing_city"=> $ship_billing_city,
    "billing_pincode"=> $ship_billing_pincode,
    "billing_state"=> $ship_billing_state,
    "billing_country"=> $ship_billing_country,
    "billing_email"=> $ship_billing_email,
    "billing_phone"=> $ship_billing_phone,
    "billing_alternate_phone"=>"",
    "shipping_is_billing"=> $ship_shipping_is_billing,
    "shipping_customer_name"=> "",
    "shipping_last_name"=> "",
    "shipping_address"=> "",
    "shipping_address_2"=> "",
    "shipping_city"=> "",
    "shipping_pincode"=> "",
    "shipping_country"=> "",
    "shipping_state"=> "",
    "shipping_email"=> "",
    "shipping_phone"=> "",
    "order_items" =>$itemdata,
    "payment_method"=> $ship_payment_method,
    "shipping_charges"=> $ship_shipping_charges,
    "giftwrap_charges"=> "",
    "transaction_charges"=> "",
    "total_discount"=> $ship_total_discount,
    "sub_total"=> $ship_sub_total,
    "length"=> $ship_length,
    "breadth"=> $ship_breadth,
    "height"=> $ship_height,
    "weight"=> $ship_weight,
    "ewaybill_no"=> "",
    "customer_gstin"=> ""     
    );
          
        $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>json_encode($data),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjczOTUwNywiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTgyNTY1NzgsImV4cCI6MTU5OTEyMDU3OCwibmJmIjoxNTk4MjU2NTc4LCJqdGkiOiI2UFJORDZSSW15OGpkTkJaIn0.k9U-vX41PxhwqkDOKp6RUPJLDkF29-eAUYIVAvZ6ako"
          ),
        ));
          
        $response = curl_exec($curl);
        curl_close($curl);
        $respo=json_decode($response);
        if(isset($respo->order_id) && $respo->order_id!=""){
              $order = Order::findOrFail($request->orderid);
              $order->isshiprocket = 1;
              $order->shiprocket_order_id = $respo->order_id;
              $order->self_order_id = $ship_order_id;
              $order->save();
            flash('Order has been Send To Shiprocket successfully')->success();
            return redirect()->route('orders.index.admin');
        }
            flash('something want wrong')->error();
            return redirect()->route('orders.index.admin');
    }

    public function ViewOrder($id)
    {
        $order = Order::find(decrypt($id));
            if (!$order) {
                abort(404);
            }
        return view('frontend.customer.order-details', compact('order'));
        }
}
