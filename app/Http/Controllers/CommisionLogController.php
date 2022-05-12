<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\User;
use App\CommisionLog;
use App\Product;
class CommisionLogController extends Controller
{
    public function save_log($from_user_id,$to_user_id,$amount,$orderid,$productid){
        $user = User::where('id',$from_user_id)->first();
        $CommisionLog = new CommisionLog;
        $CommisionLog->message ="Purchase Product Commision by ".$user->name;
        $CommisionLog->from_user_id =$from_user_id;
        $CommisionLog->to_user_id =$to_user_id;
        $CommisionLog->order_id =$orderid;
        $CommisionLog->product_id =$productid;
        $CommisionLog->amount =$amount;
        $CommisionLog->user_name =$user->name;
        $CommisionLog->save();
        return 1;
    }
    public function get_commision_logs(request $request){
        $id=$request->userId;
        $products_list=array();
        $products=Product::get();
        if(!empty($products)){
        foreach ($products as $key => $value) {
           $products_list[$value->id]= $value->slug;
        }
      }
      
     $comm_name = "Not Mantion";
     $comm_email = "Not Mantion";
     
     $get_user=User::where('id',$id)->get();
     $counlist=count($get_user);
     if(isset($counlist) && $counlist > 0){
         $comm_name=$get_user[0]->name;
         $comm_email=$get_user[0]->email;        
     }
        $commision_list=CommisionLog::where('to_user_id',$id)->orderBy('created_at', 'desc')->get();
         return view('affiliate.commision_history', compact('commision_list','products_list','comm_name','comm_email'));
    }
}
