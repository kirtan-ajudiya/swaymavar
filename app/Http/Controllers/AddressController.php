<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Address::where('user_id', Auth::user()->id)->get();

        return view('frontend.dashboard.address', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('frontend.dashboard.address-create');
        } catch (\Throwable $th) {
            //throw $th;
        }
     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
        ]);
       
        try {
            $set_default = isset($request['set_default']) && $request['set_default']=='1'?true:false;
            $address = new Address;
            $address->user_id = Auth::user()->id;
            $address->user_type = $request->user_type;
            $address->first_name = $request->first_name;
            $address->last_name = $request->last_name;
            $address->nick_name = $request->nick_name;
            $address->alt_phone = $request->alt_phone;
            $address->address = $request->address;
            $address->country = $request->country;
            $address->state = $request->state;
            $address->billing_address = $request->billing_address;
            $address->city = $request->city;
            $address->code = $request->code;
            $address->set_default = $set_default;
            $address->postal_code = $request->postal_code;
            $address->phone = $request->code.$request->phone;
            $address->save();
            if(isset($address->set_default) && $address->set_default == 1){
                $this->set_default($address->id);
            }
            flash(__('Address has been Created successfully!'))->success();
            return back();
        } catch (\Throwable $th) {
            dd($th);
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
        try {
            $user = Address::where('id', decrypt($id))->first();
            return view('frontend.dashboard.address-edit', compact('user'));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'state' => 'required',
            'city' => 'required'
        ]);
        $set_default = isset($request['set_default']) && $request['set_default']=='1'?true:false;

        $address = Address::find(decrypt($id));  
        $address->user_type = $request->user_type;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->nick_name = $request->nick_name;
        $address->alt_phone = $request->alt_phone;
        $address->address = $request->address;
        $address->country = $request->country;
        $address->billing_address = $request->billing_address;
        $address->state = $request->state;
        $address->city = $request->city;
        $address->set_default = $set_default;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->code = $request->code;
        if(isset($address->set_default) && $address->set_default == 1){
            $this->set_default($address->id);
        } 
        $address->save(); 
        flash('Address has been updated successfully!')->success();
        if($request->updateaddrress == 1){
            return redirect()->route('addresses.index');
        }else{
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail(decrypt($id));
            $address->delete();
            flash(__('Address deleted successfully.'))->success();
            return back();
    }

    public function set_default($id){
        foreach (Address::where('user_id', Auth::user()->id)->get() as $key => $address) {
            $address->set_default = 0;
            $address->save();
        }
        $address = Address::findOrFail($id);
        $address->set_default = 1;
        $address->save();

        return back();
    }

    public function shipping_address_edit($id)
    {
        $data['user'] = Address::findOrFail($id);
        return view('frontend.partials.edit_address_modal', $data);
    }

    public function billing_address_edit($id)
    {
        $data['user'] = Address::findOrFail($id);
        return view('frontend.partials.edit_billing_modal', $data);
    }
}
