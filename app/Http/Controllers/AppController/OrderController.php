<?php
namespace App\Http\Controllers\AppController;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\BusinessSetting;
use App\CouponUsage;
use App\Address;
use App\User;
use App\RefundRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\OTPVerificationController;
use Session;
use Carbon\Carbon;
use App\CommisionLog;
use App\AffiliateUser;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
class OrderController extends Controller
{
   public function purchasehistory(request $request){
   	        $id=$request->user_id;
                $setdata=array();
           if (isset($id)) {
                 $orders = Order::where('user_id',$id)->latest()->get();
              foreach ($orders as $orderd) {
              $orderd['Order_status']=OrderDetail::where('order_id',$orderd->id)->get()[0]->delivery_status;
              $setdata[]=$orderd;     
            }
                $responseData = array('success' => '1','data'=>$setdata);
            } else {
                $responseData = array('success' => '0','data'=>array());
            }
        $orderResponse = json_encode($responseData);
        return $orderResponse;
   }
   
    public function purchase_history_details(Request $request)
    {
          $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
          $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
          $today_date = Carbon::now();
          $datafororder=array();
          $setdata=array();
          $refundpro="Non-refundable";
         if (isset($request->order_id)) {
            $order = Order::findOrFail($request->order_id);
            $order->delivery_viewed = 1;
            $order->payment_status_viewed = 1;
            $order->save();
//            $datafororder['order']=$order; 
           
            foreach ($order->orderDetails as $orderDetail) {
               $datafororder['productDid']=$orderDetail->id; 
               $datafororder['delivery_status']=$orderDetail->delivery_status; 
               $datafororder['productname']=$orderDetail->product->name; 
               $datafororder['variation']=$orderDetail->variation;
               $datafororder['quantity']=$orderDetail->quantity;
               $datafororder['price']=single_price($orderDetail->price);
               if($refund_request_addon != null && $refund_request_addon->activated == 1){
                   $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                   
                  if($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered') 
                  {
                      $refundpro="send";
                  } elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0){
                      $refundpro="Pending";
                  } elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1) {
                    $refundpro="Approved";  
                  } elseif ($orderDetail->product->refundable != 0){
                      $refundpro="N/A";  
                  }else{
                       $refundpro="Non-refundable";  
                  }
               }
               $datafororder['Refund']=$refundpro;
              $setdata[]=$datafororder;     
            }
          
            $responseData = array('success' => '1','data'=>$setdata);
            } else {
                $responseData = array('success' => '0','data'=>array());
            }
        $orderResponse = json_encode($responseData);
        return $orderResponse;
    }
   public function addtoorder(request $request){
        
        $cart=json_decode($request->cart);
        if(!empty($cart)){
        $order = new Order; 
         if($request->address_id == null){
                 $responseData = array('success'=>1,'message'=>'please select address');
                 return $orderResponse;
            }
         if($request->payment_option == "razorpay"){
            $request->payment_status="paid"; 
         }else{
            $request->payment_status="unpaid"; 
         }   
        // shipping address
        $address = Address::findOrFail($request->address_id);
        $userdata = User::findOrFail($request->user_id);
        $data['name'] = $userdata->name;
        $data['email'] = $userdata->email;
        $data['address'] = $address->address;
        $data['country'] = $address->country;
        $data['state'] = $address->state;
        $data['city'] = $address->city;
        $data['postal_code'] = $address->postal_code;
        $data['phone'] = $address->phone;
        $data['checkout_type'] = 'logged';
        $shipping_info = json_encode($data);
        

        $order->user_id = $request->user_id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_option;//cash_on_delivery or razorpay
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His').rand(10,99);
        $order->date = strtotime('now');
        $order->payment_status=$request->payment_status; // paid or unpaid
        

        //delevevery info
          
          // if(\App\Product::find($object['id'])->added_by == 'admin'){
          //           if($request['shipping_type_admin'] == 'home_delivery'){
          //               $object['shipping_type'] = 'home_delivery';
          //               $object['shipping'] = \App\Product::find($object['id'])->shipping_cost;
          //           }
          //           else{
          //               $object['shipping_type'] = 'pickup_point';
          //               $object['pickup_point'] = $request->pickup_point_id_admin;
          //               $object['shipping'] = 0;
          //           }
          //       }
          //       else{
          //           if($request['shipping_type_'.\App\Product::find($object['id'])->user_id] == 'home_delivery'){
          //               $object['shipping_type'] = 'home_delivery';
          //               $object['shipping'] = \App\Product::find($object['id'])->shipping_cost;
          //           }
          //           else{
          //               $object['shipping_type'] = 'pickup_point';
          //               $object['pickup_point'] = $request['pickup_point_id_'.\App\Product::find($object['id'])->user_id];
          //               $object['shipping'] = 0;
          //           }
          //       }

           if($order->save()){
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $product_variation=null;
            foreach ($cart as $key => $cartItem){
                $product = Product::find($cartItem->id);

                $subtotal += $cartItem->price*$cartItem->quantity;
                $tax += $cartItem->tax*$cartItem->quantity;

                if ($cartItem->shipping_type == 'home_delivery') {
                    $shipping += \App\Product::find($cartItem->id)->shipping_cost*$cartItem->quantity;
                }
                if(isset($cartItem->variant) && $cartItem->variant!=""){
                    $product_variation = $cartItem->variant;
                } 
                if($product_variation != null){
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();
                    $product_stock->qty -= $cartItem->quantity;
                    $product_stock->save();
                }
                else {
                    $product->current_stock -= $cartItem->quantity;
                    $product->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  =$order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem->price * $cartItem->quantity;
                $order_detail->tax = $cartItem->tax * $cartItem->quantity;
                $order_detail->shipping_type = $cartItem->shipping_type;

                if ($cartItem->shipping_type == 'home_delivery') {
                    $order_detail->shipping_cost = Product::find($cartItem->id)->shipping_cost*$cartItem->quantity;
                }
                else{
                    $order_detail->shipping_cost = 0;
                    $order_detail->pickup_point_id = $cartItem->pickup_point;
                }

                $order_detail->quantity = $cartItem->quantity;
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if(isset($request->coupon_discount) && $request->coupon_discount != ""){
                $order->grand_total -= $request->coupon_discount;
                $order->coupon_discount = $request->coupon_discount;

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = $request->user_id;
                $coupon_usage->coupon_id = Session::get('coupon_id');
                $coupon_usage->save();
            }

            $order->save();
          }


         //paymen
          if($request->payment_status == 'paid'){
            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    $affiliateController = new AffiliateController;
                    $affiliateController->processAffiliatePoints($order);
                }

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
                            $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100 + $orderDetail->tax + $orderDetail->shipping_cost;
                            $seller->save();
                        }
                    }
                }

                $order->commission_calculated = 1;
                $order->save();    
          }  
          $responseData=array('success'=>1,'message'=>'order successfully');
        }else{
            $responseData = array('success'=>1,'message'=>'order successfully');
        }
       $orderResponse = json_encode($responseData);
        return $orderResponse;
   }

    public function getpaymentmethod(){ 
            $data=array();
            if(BusinessSetting::where('type', 'cash_payment')->first()->value == 1){
            $data[]=array('status'=>1,'paymentmethod'=>'cash_payment','KEY'=>'','SECRET'=>'');    
            }
            
            if(BusinessSetting::where('type', 'razorpay')->first()->value == 1){
            $data[]=array('status'=>1,'paymentmethod'=>'cash_payment','KEY'=>'rzp_test_jxMl7rnpDGXCIh','SECRET'=>'6EklzfMoH0HdkCCKl6xcDdGI');    
            }
             $responseData = array('success' => '1','data'=>$data);
             $orderResponse = json_encode($responseData);
            return $orderResponse;
        }
        
        
   public function refund_request(Request $request)
    {
        $orderd_id=$request->ord_id;
        $user=$request->user_id;
        if(isset($orderd_id) && $orderd_id != "" && isset($user) && $user!=""){
        $order_detail = OrderDetail::where('id', $orderd_id)->first();
        $refund = new RefundRequest;
        $refund->user_id = $request->user_id;
        $refund->order_id = $order_detail->order_id;
        $refund->order_detail_id = $order_detail->id;
        $refund->seller_id = $order_detail->seller_id;
        $refund->seller_approval = 0;
        $refund->reason = $request->reason;
        $refund->admin_approval = 0;
        $refund->admin_seen = 0;
        $refund->refund_amount = $order_detail->price + $order_detail->tax;
        $refund->refund_status = 0;
        if(isset($request->photos) && $request->photos!=""){
            $str_arr = explode (",", $request->photos); 
            $refund->photos = json_encode($str_arr);
        }
        if ($refund->save()) {
             $responseData=array('success'=>1,'message'=>'send refund request successfully');
        }else{
            $responseData = array('success'=>0,'message'=>'refund request unsuccessfully');
        }
        }else{
            $responseData = array('success'=>0,'message'=>'something want wrong');
        }
       $orderResponse = json_encode($responseData);
        return $orderResponse;
    }
    
    public function upload_refund_image(Request $request){
         if(isset($request->images) && $request->images!=""){
                     $image = $request->images;
                     $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                     $replace = substr($image, 0, strpos($image, ',')+1); 
                     $image = str_replace($replace, '', $image); 
                     $image = str_replace(' ', '+', $image); 
                     $imageName = rand().'refund_image'.'.'.$extension;
                     $img = \File::put(public_path('uploads/refund_photos/').$imageName, base64_decode($image));
                     $imageName="uploads/refund_photos/".$imageName;
                     $imageName=array('img'=>$imageName);
                     $orderResponse = json_encode($imageName);
                     return $orderResponse;
         }
    }
   
    public function refund_list(Request $request)
    {
       if(isset($request->user_id) && $request->user_id !=""){ 
       $refunds = RefundRequest::where('user_id', $request->user_id)->latest()->get();
       $responseData = array('success' => '1','data'=>$refunds);
       }else{
       $responseData = array('success' => '0','data'=>array());
       }
       $orderResponse = json_encode($responseData);
       return $orderResponse;
    }
    
    public function tracking(Request $request){
        $order_id=$request->order_id;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track?order_id=".$order_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
           CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjczOTUwNywiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTgyNTY1NzgsImV4cCI6MTU5OTEyMDU3OCwibmJmIjoxNTk4MjU2NTc4LCJqdGkiOiI2UFJORDZSSW15OGpkTkJaIn0.k9U-vX41PxhwqkDOKp6RUPJLDkF29-eAUYIVAvZ6ako"
          )
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       $orderResponse = json_encode($response);
       return $orderResponse;
    }
    
    public function canceled_order(Request $request){
        $order_id=$request->order_id;
        if(isset($order_id) && $order_id!=""){
        $order = Order::findOrFail($order_id);
        $set=0;
        
         foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delivery_status = 'canceled';
                if($orderDetail->save()){
                    $set=1;
                }
           }
       
        if($set==1){
            
            $commisionlog =CommisionLog::where('order_id',$order_id)->get();
            if(isset($commisionlog)){
            foreach ($commisionlog as $logdata) {
             $affiliate_user = AffiliateUser::where('user_id',$logdata->to_user_id)->first();
             $affiliate_user->balance -= $logdata->amount;
             $affiliate_user->save();
            } 
            CommisionLog::where('order_id',$order_id)->delete();
            }
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
            if($order->user != null && $order->user->phone != null){
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            }
        }
        
         $responseData=array('success'=>1,'message'=>'Canceled Order successfully');
        
        }else{
        $responseData=array('success'=>0,'message'=>'Something want wrong!'); 
        }
         $orderResponse = json_encode($responseData);
         return $orderResponse;
    }
      
}

