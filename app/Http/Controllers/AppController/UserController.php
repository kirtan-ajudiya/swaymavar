<?php
namespace App\Http\Controllers\AppController;

use App\Http\Controllers\Controller;
use App\User;
use App\Wallet;
use App\Seller;
use Auth;
use App\AffiliateUser;
use App\AffiliatePayment;
use App\CommisionLog;
use App\Address;
use App\Customer;
use App\Ticket;
use App\TicketReply;
use Hash;
use DB;
use File;
use Mail;
use App\Mail\EmailManager;
use Illuminate\Http\Request;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
class UserController extends Controller
{

    public function userlogin(Request $request){
        $phone=$request->mobile_no;
        $password=$request->password;
        $device_id=$request->device_id;
        $customerInfo = array("phone" => "+91".$phone, "password" => $password);
        if (Auth::attempt($customerInfo)) {
        $existuser=User::where('phone',"+91".$phone)->first();
        $existuser->device_id=$device_id;
        $existuser->save();
        $responseData = array('success' => '1', 'data' => $existuser, 'message' => 'Data has been returned successfully!'); 
        }
        else
        {
        $responseData = array('success' => '0', 'data' => array(), 'message' => "Invalid phone or password.");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }

    public function mobile_verification(Request $request){
            $mobile=$request->mobile_no;
            $email=$request->email;
            //check email existance
            
            if(isset($mobile) && $mobile!="" && isset($email) && $email!=""){
                $mobile="+91".$mobile;
                $existUser = DB::table('users')->where('phone', $mobile)->get();
                $existUseremail = DB::table('users')->where('email', $email)->get();
           if(count($existUseremail) >=1){
                //response if email already exit
                $postData = 0;
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email is already exist");
           }else{ 
           if (count($existUser) >= 1) {
                //response if mobile already exit
                $postData = 0;
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Mobile number is already exist");
            } else {
                $postData=rand(100000, 999999);
                
               sendSMS($mobile, env("APP_NAME"), $postData.' is your verification code for '.env('APP_NAME'));  
                 $array['view'] = 'emails.verification';
                 $array['subject'] = 'Table1 Verification Email';
                 $array['from'] = env('MAIL_USERNAME');
                 $array['content'] = 'Verification Code:'.$postData;
                 Mail::to($email)->queue(new EmailManager($array));
                $responseData = array('success' => '1', 'data' => $postData, 'message' => "Otp send your in mobile and mail");
           }}
            }else{
                $postData=0;
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "somthing want wrong");
            }
            $userResponse = json_encode($responseData);
            return $userResponse;
    }
    
     public function forget_otp_verification(Request $request){
            $mobile=$request->mobile_no;
            
            //check email existance
            
            if(isset($mobile) && $mobile!=""){
                $mobile="+91".$mobile;
                $existUser = DB::table('users')->where('phone', $mobile)->get();
             
            if (count($existUser) > 0) {
                //response if email already exit
                $postData=rand(100000, 999999);
                
               sendSMS($mobile, env("APP_NAME"), $postData.' is your verification code for '.env('APP_NAME')); 
                 $array['view'] = 'emails.verification';
                 $array['subject'] = 'Table1 Verification Email';
                 $array['from'] = env('MAIL_USERNAME');
                 $array['content'] = 'Verification Code:'.$postData;
                 Mail::to($existUser[0]->email)->queue(new EmailManager($array));
                $responseData = array('success' => '1', 'data' => $postData, 'message' => "Otp send your in mobile");
            } else {
                $postData = 0;
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Mobile number not register");
            }}else{
                $postData=0;
                $responseData = array('success' => '0', 'data' => $userData, 'message' => "somthing want wrong");
            }
            
            $userResponse = json_encode($responseData);
            return $userResponse;
    }
    
    public function forget_password(Request $request){
            $mobile=$request->mobile_no;
            $password=$request->password;
            
            //check email existance
            
            if(isset($mobile) && $mobile!="" && isset($password) && $password!=""){
                $mobile="+91".$mobile;
                $existUser = DB::table('users')->where('phone', $mobile)->get();
            if (count($existUser) > 0) {
                  $user = User::where('phone',$mobile)->first();
                  $user->password = Hash::make($password);
                  $set=$user->save();
                  if($set){
                     $responseData = array('success' => '1', 'message' => "Reset password successfully");
                  }else{
                    $responseData = array('success' => '0', 'message' => "Reset password unsuccessfully");
                  }
            } else {
                $responseData = array('success' => '0','message' => "Mobile number not register");
            }}else{
                $responseData = array('success' => '0', 'message' => "somthing want wrong");
            }
            
            $userResponse = json_encode($responseData);
            return $userResponse;
    }

    public function userregistration(Request $request){
            $email=$request->email;
            $name=$request->name;
            $password=$request->password;
            $mobile=$request->mobile_no;
            $otp=$request->otp;
            if(isset($mobile) && $mobile!=""){
                $mobile="+91".$request->mobile_no;
            }
            $referral=$request->referral;
            
            //check email existance
            $existUser = DB::table('users')->where('email', $email)->get();

            if (count($existUser) > 0) {
                //response if email already exit
                $postData = array();
                $responseData = array('success' => '0', 'data' => $postData, 'message' => "Email address is already exist");
            } else {

                //insert data into customer
                $customers_id = DB::table('users')->insertGetId([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'phone' => $mobile,
                    'email_verified_at' => date('Y-m-d H:m:s'),
                    'verification_code' => $otp
                ]);
                    $customer = new Customer;
                    $customer->user_id = $customers_id;
                    $customer->save();
              if(!empty($referral) && $referral!=""){
                    $this->affiliateregister($referral,$customers_id);
                }
                $userData = DB::table('users')
                    ->where('users.id', '=', $customers_id)->get();
                $responseData = array('success' => '1', 'data' => $userData, 'message' => "Sign Up successfully!");
            }
            $userResponse = json_encode($responseData);
            return $userResponse;
    }
    
    public function affiliateregister($refcode,$urerid){
                $referred_by_user = User::where('referral_code', $refcode)->first();
                if(!empty($referred_by_user) && $referred_by_user->id != ""){
                $def_user_data=AffiliateUser::where('user_id',$referred_by_user->id)->first();
                $existsuser=AffiliateUser::where('user_id',$urerid)->first(); 
                if(!empty($def_user_data) &&  count($existsuser) < 1 && count($def_user_data) > 0){
                $affiliate_user = new AffiliateUser;
                $affiliate_user->user_id = $urerid;
                $affiliate_user->status = 1;
                $affiliate_user->ref_id = $def_user_data->user_id;
                $affiliate_user->def_id = $def_user_data->def_id;
                $affiliate_user->save();
                }}
    }

    public function affiliateUserData(Request $request)
    {
        $id=$request->id;
        $pendingAmt=0;
        $affiliateUser = AffiliateUser::Where('user_id', $id)->first();
        
     
        if($affiliateUser){
             $commision_list_log=CommisionLog::where('to_user_id',$id)->get();
                $i=0;
                foreach ($commision_list_log as $key => $value) {

                  $orederdate = date('m/d/Y',strtotime('+30 days',strtotime($value->created_at))) . PHP_EOL;
                    $pending=0;             
                    if($orederdate > date('m/d/Y'))
                    {
                       $pendingAmt+=$value->amount;
                     $pending=1;  
                    }
                    $commision_list_log[$i]['IsPending']=$pending;
                    $i++;
                  }
                  $affiliateUser['pendingAmt']=$pendingAmt;
                  $affiliateUser['finalBal']=$affiliateUser->balance-$pendingAmt;
                  $affiliateUser['commisionLog']=$commision_list_log;
             $responseData = array('success' => '1', 'data' => $affiliateUser, 'message' => "success");
        }else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "failed.");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
    
    public function affiliatepaymenthistory(Request $request)
    {
        
         $id=$request->id;
        $affiliate_payments = AffiliatePayment::where('affiliate_user_id',$id)->get();
        if($affiliate_payments){
               
             $responseData = array('success' => '1', 'data' => $affiliate_payments, 'message' => "success");
        }else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "failed.");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }

    public function userinfoupdate(request $request){
        $id=$request->id;
        $name=$request->name;
        $photo=$request->photo;
        $address=$request->address;
        $country=$request->country;
        $city=$request->city;
        $postcode=$request->postcode;
        $phone=$request->phone;
        $cehckexist = DB::table('users')->where('id', $id)->first();
        if(count($cehckexist) > 0){

          if(isset($photo)){
                     $image = $photo;
                     $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                     $replace = substr($image, 0, strpos($image, ',')+1); 
                     $image = str_replace($replace, '', $image); 
                     $image = str_replace(' ', '+', $image); 
                     $imageName = $userId.'user_img'.'.'.$extension;
                     $img = \File::put(public_path('uploads/user/').$imageName, base64_decode($image));
                     $imageName="uploads/user/".$imageName;    

            if(!empty($cehckexist->avatar)){
               if(file_exists(public_path('uploads/users/'.$cehckexist->avatar)))
                unlink(public_path('uploads/users/'.$cehckexist->avatar));
            }
        }else{
               $imageName=$cehckexist->avatar;             
        }
                $user_data = array(
                    'name' =>  $name,
                    'address' =>  $address,
                    'country' =>  $country,
                    'city'  =>  $city,
                    'postal_code'  =>  $postcode,
                    'phone' =>   $phone,
                    'avatar' =>  $imageName,
                );
                 DB::table('users')->where('id', $id)->update($user_data);
                 $userData = DB::table('users')->where('id', $id)->first();
                 $responseData = array('success'=>'1', 'data'=>$userData, 'message'=>"Customer information has been Updated successfully");
            }else{
                $responseData = array('success'=>'3', 'data'=>array(),  'message'=>"Record not found.");
            }
            $userResponse = json_encode($responseData);
            return $userResponse;
    }

    public function updatepassword(request $request){
                $id=$request->id;
                $oldpassword    = $request->oldpassword;
                $newPassword    = $request->newpassword;
            $cehckexist = DB::table('users')->where('id', $id)->first();
            if($cehckexist){
                $userInfo = array("email" => $cehckexist->email, "password" => $oldpassword);

                if (Auth::attempt($userInfo)) {

                    DB::table('users')->where('id', $id)->update([
                    'password'           =>  Hash::make($newPassword)
                    ]);

                    //get user data
                    $userData = DB::table('users')->where('id', $id)->get();
                    $responseData = array('success'=>'1', 'data'=>$userData, 'message'=>"Password has been Updated successfully");
                }else{
                    $responseData = array('success'=>'2', 'data'=>array(),  'message'=>"current password does not match.");
                }
        }else{
            $responseData = array('success'=>'3', 'data'=>array(),  'message'=>"Record not found.");
        }
        $userResponse = json_encode($responseData);
        return $userResponse; 
    }

    public function processsendotp(request $requset){
          $mobile=$requset->mobile_no;
         //check mobile exist            
         $existUser = DB::table('users')->where('phone', $mobile)->where('user_type','customer')->get();
           
        if (count($existUser) > 0 && isset($mobile) ) {
                $randOtp=rand(0000,9999);
                // $otp_sms="Your%20OTP%20is%20".$randOtp;
                // $url = "http://msga.videeinfotech.com/sendSMS?username=z16&message=".$otp_sms."&sendername=ZSIXTN&smstype=TRANS&numbers=".$mobile."&apikey=14cc6eb6-f7e0-48e1-939f-b6333e34360a";
                // //$url = "http://sms.mobileadz.in/api/push.json?apikey=5eddf37ece721&route=trans_dnd&sender=VIDEEE&mobileno=".$mobile."&text=".$otp_sms;
                // $ch = curl_init(); 
                // curl_setopt($ch,CURLOPT_URL,$url);
                // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                // curl_exec($ch);
                // curl_close($ch);
                $responseData = array('success' => '1', 'otp' => $randOtp ,'message' => "customer is exist!");
            } else {
                $responseData = array('success' => '0', 'otp' => "0",'message' => "customer doesn't exist!");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }


    public function processforgotpassword(request $request){
           
            $mobile=$request->mobile_no;
            $password=$request->password;  
           //check user exist
            $existUser = DB::table('users')->where('phone', $mobile)->where('user_type','customer')->get();
            if (count($existUser) > 0 && isset($mobile) && isset($password)) {
                DB::table('users')->where('phone', $mobile)->update([
                    'password' => Hash::make($password),
                ]);
                 $responseData = array('success' => '1');
            } else {
                $responseData = array('success' => '0');
            }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }


    public function wallethistory(request $request){
       
       $userid=$request->id;
       try {
        $wallets = Wallet::where('user_id', $userid)->get();
        $responseData=array('success'=>1,'data'=>$wallets);     
       } catch (Exception $e) {
         $responseData=array('success'=>0,'data'=>array());  
       }
        $userResponse = json_encode($responseData);
        return $userResponse;  
    }

    public function getallseller(request $request){
       try {
        $getseller = Seller::leftjoin('users','users.id','=','sellers.user_id')->where('sellers.verification_status',1)->select('sellers.*','users.name as seller_name')->get();
        $responseData=array('success'=>1,'data'=>$getseller);     
       } catch (Exception $e) {
         $responseData=array('success'=>0,'data'=>array());  
       }
        $userResponse = json_encode($responseData);
        return $userResponse;  
    }

    public function affiliatepaymentconfig(request $request){
      $id=$request->id;
      $email=$request->paypalemail;
      $bankinfo=$request->bankinfo; 
       try {
        $affiliateuser =AffiliateUser::where('user_id',$id)->first();
        if($affiliateuser){
            $affiliateuser->paypal_email=$email;
            $affiliateuser->bank_information =$bankinfo;
            $affiliateuser->save();             
        
          $responseData=array('success'=>1,'message'=>'update successfully');  
        }else{
        $responseData=array('success'=>1,'message'=>'user not affiliate');    
        }      
        
       } catch (Exception $e) {
        $responseData=array('success'=>0,'message'=>'something want wrong');
       }
        $userResponse = json_encode($responseData);
        return $userResponse;  
    }
    
    public function addshippingaddress(request $request){
        try {
            $address = new Address;
            $address->user_id = $request->user_id;
            $address->address = $request->address;
            $address->country = $request->country;
            $address->state = $request->state;
            $address->city = $request->city;
            $address->postal_code = $request->postal_code;
            $address->phone = $request->phone;   
           if($address->save()){
               $responseData=array('success'=>1,'message'=>'Address add successfully');
           }else{
               $responseData=array('success'=>0,'message'=>'some thing wrong');
           }    
        } catch (Exception $ex) {
            $responseData=array('success'=>0,'message'=>'some thing wrong');
        }
        
        $userResponse = json_encode($responseData);
        return $userResponse;  
    }
    
    public function getalladdress(request $request){
          $userid=$request->user_id;
            try {
             $wallets = Address::where('user_id', $userid)->get();
             $responseData=array('success'=>1,'data'=>$wallets);     
            } catch (Exception $e) {
              $responseData=array('success'=>0,'data'=>array());  
            }
             $userResponse = json_encode($responseData);
             return $userResponse;  
    }
    
    public function removeaddress(request $request){
        try {
            $addressid=$request->address_id;
            $address = Address::find($addressid);
            if($address->delete()){
                $responseData=array('success'=>1,'message'=>'address remove successfully');
            }else{
                $responseData=array('success'=>0,'message'=>'some thing wrong');
            }
        } catch (Exception $ex) {
           $responseData=array('success'=>0,'message'=>'some thing wrong'); 
        }
          $userResponse = json_encode($responseData);
             return $userResponse;  
    }
    
    public function updatedefaultaddress(request $request){
        try {
            $user_id=$request->user_id;
            $address_id=$request->address_id;
            
            $address = Address::where('user_id',$user_id)->get();
            foreach ($address as $key => $address) {   
            $address->set_default = 0;
            $address->save();
            }
            $address = Address::findOrFail($address_id);
            $address->set_default = 1;
            if($address->save()){
                $responseData=array('success'=>1,'message'=>'address default successfully');
            }else{
                $responseData=array('success'=>0,'message'=>'some thing wrong');
            }
        } catch (Exception $ex) {
           $responseData=array('success'=>0,'message'=>'some thing wrong'); 
        }
          $userResponse = json_encode($responseData);
             return $userResponse;  
    }
    
    public function checkaffiliate(request $request){
           
            $user_id=$request->user_id;
             $affiliateUser = AffiliateUser::Where('user_id', $user_id)->first();
            if ($affiliateUser) {
                 $responseData = array('success' => '1','isaffiliate'=>1,'data'=>$affiliateUser);
            } else {
                $responseData = array('success' => '1','isaffiliate'=>0,'data'=>$affiliateUser);
            }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
    
    public function social_login(request $request){
        if(isset($request->email) && $request->email!=""){
        $existingUser = User::Where('email', $request->email)->first();
        if($existingUser){
        $responseData = array('success' => '1', 'data' => $existuser, 'message' => 'Data has been returned successfully!');
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $request->name;
            $newUser->email           = $request->email;
            $newUser->email_verified_at = date('Y-m-d H:m:s');
            $newUser->save();
            $customer = new Customer;
            $customer->user_id = $newUser->id;
            $customer->save();
        $responseData = array('success' => '1', 'data' => $newUser, 'message' => 'Data has been returned successfully!');
    }}else{
        $responseData = array('success' => '0', 'data' => array(), 'message' => "Email Not Available in social0");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
    
    public function add_support_ticket(request $request){
        $ticket = new Ticket;
        $ticket->code = max(100000, (Ticket::latest()->first() != null ? Ticket::latest()->first()->code + 1 : 0)).date('s');
        $ticket->user_id = $request->user_id;
        $ticket->subject = $request->subject;
        $ticket->details = $request->details;

        $files = array();

//        if($request->hasFile('attachments')){
//            foreach ($request->attachments as $key => $attachment) {
//                $item['name'] = $attachment->getClientOriginalName();
//                $item['path'] = $attachment->store('uploads/support_tickets/');
//                array_push($files, $item);
//            }
//            $ticket->files = json_encode($files);
//        }
         if(isset($request->attachments) && $request->attachments !=""){
                     $image = $request->attachments;
                     $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                     $replace = substr($image, 0, strpos($image, ',')+1); 
                     $image = str_replace($replace, '', $image); 
                     $image = str_replace(' ', '+', $image); 
                     $imageName = rand().'attach'.'.'.$extension;
                     $img = \File::put(public_path('uploads/support_tickets/').$imageName, base64_decode($image));
                     $imageName2="uploads/support_tickets/".$imageName;  
                     $item['name'] = $imageName;
                     $item['path'] = $imageName2; 
                     array_push($files, $item); 
                    $ticket->files = json_encode($files);
        }
        
        
        if($ticket->save()){
            $responseData = array('success' => '1', 'data' => array(), 'message' => 'Add Support Ticket successfully!');
        }
        else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Some thing want wrong");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
    
    public function get_all_ticket(request $request){
        if(isset($request->user_id) && $request->user_id!=""){
            $tickets = Ticket::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->get();
            $responseData = array('success' => '1', 'data' => $tickets, 'message' => 'Get data Support Ticket successfully!');
        }
        else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Some thing want wrong");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
    
    public function reply_ticket(request $request){
        $ticket_reply = new TicketReply;
        $ticket_reply->ticket_id = $request->ticket_id;
        $ticket_reply->user_id = $request->user_id;
        $ticket_reply->reply = $request->reply;

        $files = array();
           if(isset($request->attachments) && $request->attachments !=""){
                     $image = $request->attachments;
                     $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                     $replace = substr($image, 0, strpos($image, ',')+1); 
                     $image = str_replace($replace, '', $image); 
                     $image = str_replace(' ', '+', $image); 
                     $imageName = rand().'attach'.'.'.$extension;
                     $img = \File::put(public_path('uploads/support_tickets/').$imageName, base64_decode($image));
                     $imageName2="uploads/support_tickets/".$imageName;  
                     $item['name'] = $imageName;
                     $item['path'] = $imageName2; 
                     array_push($files, $item); 
                     $ticket_reply->files = json_encode($files);
        }
    
        $ticket_reply->ticket->viewed = 0;
        $ticket_reply->ticket->status = 'pending';
        $ticket_reply->ticket->save();
        if($ticket_reply->save()){
            $responseData = array('success' => '1', 'data' => array(), 'message' => 'Reply Support Ticket successfully!');
        }
        else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Some thing want wrong");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
    
    public function get_reply_support_ticket(request $request){
       if(isset($request->ticket_id) && $request->ticket_id!=""){
            $tickets = TicketReply::where('ticket_id', $request->ticket_id)->orderBy('created_at', 'desc')->get();
            $responseData = array('success' => '1', 'data' => $tickets, 'message' => 'Get reply Support Ticket successfully!');
        }
        else{
             $responseData = array('success' => '0', 'data' => array(), 'message' => "Some thing want wrong");
        }
        $userResponse = json_encode($responseData);
        return $userResponse;
    }
   
}
