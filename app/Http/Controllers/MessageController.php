<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Auth;
use App\GeneralSetting;
use App\User;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $message = new Message;
        $message->conversation_id = $request->conversation_id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();
        $conversation = $message->conversation;
        if ($conversation->sender_id == Auth::user()->id) {
            $conversation->receiver_viewed ="1";
        }
        elseif($conversation->receiver_id == Auth::user()->id) {
            $conversation->sender_viewed ="1";
        }
        $conversation->save();
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
    
    public function create_notification(){
        return view('notification.index');
    }
    
    public function send_notification(Request $request){
         $generalsetting = GeneralSetting::first();
         $icon=""; 
         if(isset($generalsetting->logo) && $generalsetting->logo!=""){
             $icon = url('/public/'.$generalsetting->logo);
          }
         $user = User::where('device_id','!=','');
        
         if($request->set_user == 2){
          $user->where('user_type','seller');   
         }elseif($request->set_user == 3){
          $user->where('user_type','customer');   
         }
         $userdata=$user->get();
         
         $device_id=array();
         if(isset($userdata) && !empty($userdata)){
             foreach ($userdata as $value) {
                 $device_id[]=$value->device_id;
             }
         }else{
            	flash(__('Somthing Want Wrong.'))->error();
         	return redirect()->route('create_notification'); 
         }    
         
         if(!isset($device_id) && empty($device_id)){
                flash(__('Somthing Want Wrong.'))->error();
         	return redirect()->route('create_notification');             
         }
         
        $content=$request->content;
        $title=$request->title;        
        $content = array(
            "en" => $content
            );
        $headings = array(
            "en" => $title
            );
        
        $fields = array(
            'app_id' => "11940a13-d876-4270-ad41-f68e60135027",
            'include_player_ids' => $device_id,
            'headings'=> $headings,
//            'url'=>$icon,
            'content_available' => true,
            'contents' => $content,
            'large_icon'=>$icon

        );
        
        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic NWY3YTI1ODUtZmVlNy00OWEwLTk4YjctM2FlZGQ4MzY3ZjVl'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_exec($ch);
        curl_close($ch);
       	flash(__('Notification has been sent.'))->success();
    	return redirect()->route('create_notification'); 
    }
    
}
