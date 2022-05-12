<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use App\BusinessSetting;
use App\OtpConfiguration;
use App\AffiliateUser;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPVerificationController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Cookie;
use Nexmo;
use Twilio\Rest\Client;
use Mail;
use App\Mail\EmailManager;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'min:4|required',
            'phone' => 'required',
            'termsconditions' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    //update : K 11-6-2020
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now()
        ]);
      
        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->save();

        return $user;
    }
    //add : K 11-6-2020
    public function affiliate_user($urerid,$refid){
             $def_user_data=AffiliateUser::where('user_id',$refid)->first(); 
             $existsuser=AffiliateUser::where('user_id',$urerid)->first(); 
                if(empty($existsuser) && isset($def_user_data)){
                $affiliate_user = new AffiliateUser;
                $affiliate_user->user_id = $urerid;
                $affiliate_user->status = 1;
                $affiliate_user->ref_id = $refid;
                $affiliate_user->def_id = $def_user_data->def_id;
                $affiliate_user->save();
                return 1;
            }
    }

    public function register(Request $request)
    {
//        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if(User::where('email', $request->email)->first() != null){
                flash('Email already exists.');
                return back();
            }
//        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        $datuser="";

        if(isset($user) && $user!=""){
            $datuser=User::where('email',$user->email)->first();
        }
        if (!isset($datuser->email_verified_at) && $datuser->email_verified_at == null) {
            return redirect()->route('verification');
        }
        else {
            return redirect()->route('home');
        }
    }
}
