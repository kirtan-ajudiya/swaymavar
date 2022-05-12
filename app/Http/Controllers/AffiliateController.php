<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AffiliateOption;
use App\Addon;
use App\Order;
use App\BusinessSetting;
use App\AffiliateConfig;
use App\AffiliateUser;
use App\AffiliatePayment;
use App\User;
use App\Customer;
use App\Category;
use App\Product;
use App\CommisionLog;
use Session;
use Cookie;
use Auth;
use Hash;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommisionLogController;
class AffiliateController extends Controller
{
    //
    public function index(){
        return view('affiliate.index');
    }

    public function affiliate_option_store(Request $request){
        //dd($request->all());
        $affiliate_option = AffiliateOption::where('type', $request->type)->first();
        if($affiliate_option == null){
            $affiliate_option = new AffiliateOption;
        }
        $affiliate_option->type = $request->type;

        $commision_details = array();
        if ($request->type == 'user_registration_first_purchase') {
            $affiliate_option->percentage = $request->percentage;
        }
        elseif ($request->type == 'product_sharing') {
            $commision_details['commission'] = $request->amount;
            $commision_details['commission_type'] = $request->amount_type;
        }
        elseif ($request->type == 'category_wise_affiliate') {
            foreach(Category::all() as $category) {
                $data['category_id'] = $request['categories_id_'.$category->id];
                $data['commission'] = $request['commison_amounts_'.$category->id];
                $data['commission_type'] = $request['commison_types_'.$category->id];
                array_push($commision_details, $data);
            }
        }
        $affiliate_option->details = json_encode($commision_details);
        if ($request->has('status')) {
            $affiliate_option->status = 1;
        }
        else {
            $affiliate_option->status = 0;
        }
        $affiliate_option->save();
        flash("This has been updated successfully")->success();
        return back();
    }

    public function configs(){
            return view('affiliate.configs');
    }

    public function config_store(Request $request){
        $form = array();
        $select_types = ['select', 'multi_select', 'radio'];
        $j = 0;
        for ($i=0; $i < count($request->type); $i++) {
            $item['type'] = $request->type[$i];
            $item['label'] = $request->label[$i];
            if(in_array($request->type[$i], $select_types)){
                $item['options'] = json_encode($request['options_'.$request->option[$j]]);
                $j++;
            }
            array_push($form, $item);
        }
        $affiliate_config = AffiliateConfig::where('type', 'verification_form')->first();
        $affiliate_config->value = json_encode($form);
        if($affiliate_config->save()){
            flash("Verification form updated successfully")->success();
            return back();
        }
    }

    public function apply_for_affiliate(Request $request){
        return view('affiliate.frontend.apply_for_affiliate');
    }

    public function store_affiliate_user(Request $request){
        if(!Auth::check()){
            if(User::where('email', $request->email)->first() != null){
                flash(__('Email already exists!'))->error();
                return back();
            }
            if($request->password == $request->password_confirmation){
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->user_type = "customer";
                $user->password = Hash::make($request->password);
                $user->save();

                $customer = new Customer;
                $customer->user_id = $user->id;
                $customer->save();

                auth()->login($user, false);
            }
            else{
                flash(__('Sorry! Password did not match.'))->error();
                return back();
            }
        }

        $affiliate_user = Auth::user()->affiliate_user;
        if ($affiliate_user == null) {
            $affiliate_user = new AffiliateUser;
            $affiliate_user->user_id = Auth::user()->id;
        }
        $data = array();
        $i = 0;
        foreach (json_decode(AffiliateConfig::where('type', 'verification_form')->first()->value) as $key => $element) {
            $item = array();
            if ($element->type == 'text') {
                $item['type'] = 'text';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i];
            }
            elseif ($element->type == 'select' || $element->type == 'radio') {
                $item['type'] = 'select';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i];
            }
            elseif ($element->type == 'multi_select') {
                $item['type'] = 'multi_select';
                $item['label'] = $element->label;
                $item['value'] = json_encode($request['element_'.$i]);
            }
            elseif ($element->type == 'file') {
                $item['type'] = 'file';
                $item['label'] = $element->label;
                $item['value'] = $request['element_'.$i]->store('uploads/affiliate_verification_form');
            }
            array_push($data, $item);
            $i++;
        }
        $affiliate_user->informations = json_encode($data);
        if($affiliate_user->save()){
            flash(__('Your verification request has been submitted successfully!'))->success();
            return redirect()->route('home');
        }

        flash(__('Sorry! Something went wrong.'))->error();
        return back();
    }

    public function users(){
        $commision_list=CommisionLog::get();
        $affiliate_users = AffiliateUser::paginate(12);
        return view('affiliate.users', compact('affiliate_users','commision_list'));
    }

    public function show_verification_request($id){
        $affiliate_user = AffiliateUser::findOrFail($id);
        return view('affiliate.show_verification_request', compact('affiliate_user'));
    }

    public function approve_user($id)
    {
        $affiliate_user = AffiliateUser::findOrFail($id);
        $affiliate_user->status = 1;
        if($affiliate_user->save()){
            flash(__('Affiliate user has been approved successfully'))->success();
            return redirect()->route('affiliate.users');
        }
        flash(__('Something went wrong'))->error();
        return back();
    }

    public function reject_user($id)
    {
        $affiliate_user = AffiliateUser::findOrFail($id);
        $affiliate_user->status = 0;
        $affiliate_user->informations = null;
        if($affiliate_user->save()){
            flash(__('Affiliate user request has been rejected successfully'))->success();
            return redirect()->route('affiliate.users');
        }
        flash(__('Something went wrong'))->error();
        return back();
    }

    public function updateApproved(Request $request)
    {
        $affiliate_user = AffiliateUser::findOrFail($request->id);
        $affiliate_user->status = $request->status;
        if($affiliate_user->save()){
            return 1;
        }
        return 0;
    }

    public function payment_modal(Request $request)
    {

        $affiliate_user = AffiliateUser::findOrFail($request->id);
        
        $pendingAmt=0;
        $userid=$affiliate_user->user_id;
        if(isset($userid)){
        $commision_list=CommisionLog::where('to_user_id',$userid)->get();
        foreach ($commision_list as $key => $value) {
          $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($value->created_at))) . PHP_EOL;
                         
            if($orederdate > date('m/d/Y'))
            {
               $pendingAmt+=$value->amount;
            }
          }
        }
        return view('affiliate.payment_modal', compact('affiliate_user','pendingAmt'));
    }

    public function payment_store(Request $request){
        $affiliate_payment = new AffiliatePayment;
        $affiliate_payment->affiliate_user_id = $request->affiliate_user_id;
        $affiliate_payment->amount = $request->amount;
        $affiliate_payment->payment_method = $request->payment_method;
        $affiliate_payment->save();

        $affiliate_user = AffiliateUser::findOrFail($request->affiliate_user_id);
        $affiliate_user->balance -= $request->amount;
        $affiliate_user->save();

        flash(__('Payment completed'))->success();
        return back();
    }

    public function payment_history($id){
        $affiliate_user = AffiliateUser::findOrFail(decrypt($id));
        $affiliate_payments = $affiliate_user->affiliate_payments();
        return view('affiliate.payment_history', compact('affiliate_payments', 'affiliate_user'));
    }

    public function user_index(){

        $affiliate_user = Auth::user()->affiliate_user;
        $id=Auth::user()->id;
        $pendingAmt=0;
        $commision_list=CommisionLog::where('to_user_id',$id)->get();
          if(count($commision_list) > 0){
          foreach ($commision_list as $key => $value) {
            $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($value->created_at))) . PHP_EOL;
                           
              if($orederdate > date('m/d/Y'))
              {
                 $pendingAmt+=$value->amount;
              }
            }
          }
        $affiliate_payments = $affiliate_user->affiliate_payments();
        return view('affiliate.frontend.index', compact('affiliate_payments','pendingAmt'));
    }

    public function payment_settings(){
        $affiliate_user = Auth::user()->affiliate_user;
        return view('affiliate.frontend.payment_settings', compact('affiliate_user'));
    }

    public function payment_settings_store(Request $request){
        $affiliate_user = Auth::user()->affiliate_user;
        $affiliate_user->paypal_email = $request->paypal_email;
        $affiliate_user->bank_information = $request->bank_information;
        $affiliate_user->save();
        flash(__('Affiliate payment settings has been updated successfully'))->success();
        return redirect()->route('affiliate.user.index');
    }
 
    //Add : K 12-06-2020
    public function devide_amount_affiliate_users($userid,$amount,$orderid,$affiliate_user,$productId){
            $commision_log=new CommisionLogController;
            $counter = count($affiliate_user);
           if($counter > 0 && isset($amount)){
              
               if($counter == 2){
                  $id=$affiliate_user[0]['user_id'];
                  $log_amount=$amount * 0.60;
                  $commission_amount=$affiliate_user[0]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]); 
               }elseif($counter == 3){
                  $id=$affiliate_user[0]['user_id'];
                  $log_amount=$amount * 0.35;
                  $commission_amount=$affiliate_user[0]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);

                  $id=$affiliate_user[1]['user_id'];
                  $log_amount=$amount * 0.25;
                  $commission_amount=$affiliate_user[1]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
               }elseif ($counter == 4) {
                  $id=$affiliate_user[0]['user_id'];
                  $log_amount=$amount * 0.20;
                  $commission_amount=$affiliate_user[0]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
                  
                  $id=$affiliate_user[1]['user_id'];
                  $log_amount=$amount * 0.15;
                  $commission_amount=$affiliate_user[1]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
                  
                  $id=$affiliate_user[2]['user_id'];
                  $log_amount=$amount * 0.25;
                  $commission_amount=$affiliate_user[2]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
               }elseif ($counter > 4) {
                  $id=$affiliate_user[0]['user_id'];
                  $log_amount=$amount * 0.10;
                  $commission_amount=$affiliate_user[0]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
                  
                  $id=$affiliate_user[$counter - 4]['user_id'];
                  $log_amount=$amount * 0.10;
                  $commission_amount=$affiliate_user[$counter - 4]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);

                  $id=$affiliate_user[$counter - 3]['user_id'];
                  $log_amount=$amount * 0.15;
                  $commission_amount=$affiliate_user[$counter - 3]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
                  
                  $id=$affiliate_user[$counter - 2]['user_id'];
                  $log_amount=$amount * 0.25;
                  $commission_amount=$affiliate_user[$counter - 2]['balance'] + $log_amount;
                  $commision_log->save_log($userid,$id,$log_amount,$orderid,$productId);
                  AffiliateUser::where('user_id', $id)->update(['balance' => $commission_amount]);
               }      
           }        
        }
 
    public function processAffiliatePoints(Order $order){
        if(Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated){
            $user_id=$order->user_id;
            if(AffiliateOption::where('type', 'product_sharing')->first()->status){
              
                if(Cookie::has('product_referral_code') && Cookie::has('referred_product_id')){
                    $referral_code = Cookie::get('product_referral_code');
                    $product_id = Cookie::get('referred_product_id');
                    $referred_by_user = User::where('referral_code', $referral_code)->first();
                    $affiliate_new_user=new RegisterController;
                    $affiliate_new_user->affiliate_user($user_id,$referred_by_user->id); 
                }
            }
          
            $affiliate_old_user = AffiliateUser::where('user_id',  $user_id)->first();
            $affiliate_user=array();
           if(count((array)$affiliate_old_user) > 0){  
            $all_affiliate_user= AffiliateUser::where('def_id', $affiliate_old_user->def_id)->get();
              foreach ($all_affiliate_user as $key => $value) {
                       $affiliate_user[]=array('user_id'=>$value->user_id,'balance'=>$value->balance,'ref_id'=>$value->ref_id,'isdefault'=>$value->isdefault);
                       if($value->user_id ==  $user_id){
                            break;
                          }
               } 
             
              $final_affiliate_user = array();
              $affiliate_check_user=$affiliate_user;
              $flag=0;
             foreach (array_reverse($affiliate_user) as $skey => $svalue) {
                      $counter=count($final_affiliate_user);
                      if($counter < 1){
                         $final_affiliate_user[]=$svalue; 
                      }else{
                        foreach ($affiliate_check_user as $key => $value) {
                         if($final_affiliate_user[$counter-1]['ref_id'] == $value['user_id']){
                          $final_affiliate_user[]=$value;
                         } 
                        }
                      }

                        // foreach (array_reverse($affiliate_check_user) as $setkey => $setvalue) {
                        //           if($svalue['ref_id'] == $setvalue['user_id']){
                        //             if(count($final_affiliate_user) > 0){
                        //              if($final_affiliate_user[count($final_affiliate_user) - 1]['user_id']==$svalue['user_id']){ 
                        //               $final_affiliate_user[]=$svalue;
                        //             $affiliate_check_user[$setkey]['user_id'] = '-1';
                        //             if($setvalue['isdefault'] == 1){
                        //               $final_affiliate_user[]=$setvalue;
                        //               $flag=1;
                        //               break;
                        //             }  
                        //           }
                        //             }else{
                        //             $final_affiliate_user[]=$svalue;
                        //             $affiliate_check_user[$setkey]['user_id'] = '-1';
                        //             if($setvalue['isdefault'] == 1){
                        //               $final_affiliate_user[]=$setvalue;
                        //               $flag=1;
                        //               break;
                        //             }
                        //           }
                        //         }
                        //       }
                        //      if($flag == 1){
                        //               break;
                        //             }   

               }

            $set_user_affiliate=array_reverse($final_affiliate_user);
            foreach ($order->orderDetails as $key => $orderDetail) {

                if(isset($orderDetail->product->category->commision_rate)){
                     $productId=$orderDetail->product->id;
                     $commission_percentage = $orderDetail->product->category->commision_rate;
                     $amount=$orderDetail->price*($commission_percentage/100);
                     $this->devide_amount_affiliate_users($user_id,$amount,$order->id,$set_user_affiliate,$productId);
                }
            
            }
          }
        }
    }
    
    //add : K 11-6-2020
    public function get_user_for_affiliate(Request $request){
        $sort_search = null;
        $customers = Customer::orderBy('created_at', 'desc');
        if ($request->has('search') && isset($request->search)){
            $sort_search = $request->search;
            $user_ids = User::where('user_type', 'customer')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            })->pluck('id')->toArray();
            $customers = $customers->where(function($customer) use ($user_ids){
                $customer->whereIn('user_id', $user_ids);
            });
          $customers = $customers->paginate(15);
        }
        $Affiliateusers = AffiliateUser::get();
        $affiliate_users = AffiliateUser::where('isdefault',1)->paginate(12);
        return view('affiliate.add_affiliate_user', compact('customers', 'sort_search','affiliate_users','Affiliateusers'));
    }

     //add : K 11-6-2020
    public function store_Admin_affiliate_user(Request $request){

        $get_user=User::where('id',$request->userId)->first();
        if(!empty($get_user)){
         $get_affiliate=AffiliateUser::where('user_id',$get_user->id)->first();
          if(empty($get_affiliate)){   
                $affiliate_user = new AffiliateUser;
                $affiliate_user->user_id = $get_user->id;
                $affiliate_user->isdefault = 1;
                $affiliate_user->status = 1;
                $affiliate_user->def_id = $get_user->id;

         if($affiliate_user->save()){
            flash(__('Add Default Affiliate User successfully!'))->success();
            return redirect()->route('affiliate.get_user_for_affiliate');
         }else{
                flash(__('Something went wrong'))->error();
             return redirect()->route('affiliate.get_user_for_affiliate');    
         }
       }else{
            flash(__('Sorry $get_user->name Is Already Affiliate User!'))->error();
        return redirect()->route('affiliate.get_user_for_affiliate');
       }
     }
     else{
        flash(__('Something went wrong'))->error();
        return redirect()->route('affiliate.get_user_for_affiliate');
     }
    }

      //add : K 11-6-2020
     public function sub_users(Request $request){
        $affiliate_default_user="Data Not Available";
        $affiliate_users=array();
        $get_user=User::where('id',$request->userId)->get();
        $commision_list=CommisionLog::get();
        $counlist=count($get_user);
        if(isset($counlist) && $counlist > 0){
          $affiliate_default_user =$get_user[0]->name;  
          $affiliate_users = AffiliateUser::where('ref_id',$request->userId)->paginate(12);
        }
        return view('affiliate.sub_users', compact('affiliate_users','affiliate_default_user','commision_list'));
    }
   
    //add: K 15-06-2020
    public function treeview(request $request){
     $User_id=$request->id; 
     $user_name="";
     $root_name = "Not Mantion";
     $root_email = "Not Mantion";
     
     $get_user=User::where('id',$User_id)->get();
     $counlist=count($get_user);
     if(isset($counlist) && $counlist > 0){
         $root_name=$get_user[0]->name;
         $root_email=$get_user[0]->email;        
     }
     $affiliate_users_find = AffiliateUser::where('user_id',$User_id)->first();
     if($affiliate_users_find->ref_id == 0 && $affiliate_users_find->isdefault == 1){
           $affiliate_users = AffiliateUser::where('def_id',$User_id)->get();
     }
     else{
          $affiliate_users = AffiliateUser::where('ref_id',$User_id)->get();
          $user_name=$affiliate_users_find->user->name;
     }  
      return view('affiliate.tree_view',compact('affiliate_users','User_id','user_name','root_name','root_email'));   
    }

    //Add : K 17-06-2020
    public function commision_list(){
      $id=Auth::user()->id;
        $products_list=array();
        $products=Product::get();
        $pendingAmt=0;
        if(!empty($products)){
        foreach ($products as $key => $value) {
           $products_list[$value->id]= $value->slug;
        }
      }
    
    $commision_list=CommisionLog::where('to_user_id',$id)->orderBy('created_at', 'desc')->paginate(12);
    $commision_list_log=CommisionLog::where('to_user_id',$id)->get();
    foreach ($commision_list_log as $key => $value) {
      $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($value->created_at))) . PHP_EOL;
                     
        if($orederdate > date('m/d/Y'))
        {
           $pendingAmt+=$value->amount;
        }
      }
        return view('affiliate.frontend.commision_list', compact('products_list','commision_list','pendingAmt'));
    }
}
