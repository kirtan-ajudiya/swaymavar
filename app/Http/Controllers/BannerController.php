<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\MobileBanner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($position)
    {
        return view('banners.create', compact('position'));
    }
    
    public function mobilecreate($position)
    {
        return view('mobilebanners.create',compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('photo')){
            $banner = new Banner;
            $banner->photo = $request->photo->store('uploads/banners');
            $banner->url = $request->url;
            $banner->position = $request->position;
            $banner->url1 = $request->url1;
            if($request->hasFile('photo1')){
                $banner->photo1 = $request->photo1->store('uploads/banners');
            }
            $banner->title = $request->title;
            $banner->description = $request->description;
            $banner->url2 = $request->url2;
            if($banner->save()){
                flash(__('Banner has been inserted successfully'))->success();
            }
        }
        return redirect()->route('home_settings.index');
    }
    
    public function mobilestore(Request $request)
    {
        if($request->hasFile('photo')){
            $banner = new MobileBanner;
            $banner->photo = $request->photo->store('uploads/mobile_banners');
            $banner->position = $request->position;
            $banner->save();
            flash(__('Mobile Banner has been inserted successfully'))->success();
        }
        return redirect()->route('home_settings.index');
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
        $banner = Banner::findOrFail($id);
        return view('banners.edit', compact('banner'));
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
        $banner = Banner::find($id);
        $banner->photo = $request->previous_photo;
        if($request->hasFile('photo')){
            $banner->photo = $request->photo->store('uploads/banners');
        }
        $banner->photo1 = $request->previous_photo1;
        if($request->hasFile('photo1')){
            $banner->photo1 = $request->photo1->store('uploads/banners');
        }
        $banner->url = $request->url;
        $banner->url1 = $request->url1;
        $banner->title = $request->title;
        $banner->description = $request->description;
        $banner->url2 = $request->url2;
        $banner->save();
        flash(__('Banner has been updated successfully'))->success();
        return redirect()->route('home_settings.index');
    }


    public function update_status(Request $request)
    {
        $banner = Banner::find($request->id);
        $banner->published = $request->status;
        if($request->status == 1){
            if(count(Banner::where('published', 1)->where('position',1)->get()) < 3)
            {
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
            }
            if(count(Banner::where('published', 1)->where('position',3)->get()) < 3)
            {
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
            }
            if(count(Banner::where('published', 1)->where('position',6)->get()) < 1 )
            {
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
            }            
            if(count(Banner::where('published', 1)->where('position',7)->get()) < 1 )
            {
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
            }
            if(count(Banner::where('published', 1)->where('position',5)->get()) < 1 )
            {
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
            }
        }
        else{
            if($banner->save()){
                return '1';
            }
            else {
                return '0';
            }
        }
        return '0';
    }
    
    public function update_mobile_status(Request $request)
    {
        $banner = MobileBanner::find($request->id);
        $banner->published = $request->status;
        if($request->status == 1){
            
                if($banner->save()){
                    return '1';
                }
                else {
                    return '0';
                }
        }
        else{
            if($banner->save()){
                return '1';
            }
            else {
                return '0';
            }
        }

        return '0';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if(Banner::destroy($id)){
            //unlink($banner->photo);
            flash(__('Banner has been deleted successfully'))->success();
        }
        else{
            flash(__('Something went wrong'))->error();
        }
        return redirect()->route('home_settings.index');
    }
    
    public function mobile_destroy($id)
    {
        $banner = MobileBanner::findOrFail($id);
        if(MobileBanner::destroy($id)){
            //unlink($banner->photo);
            flash(__('Mobile banner has been deleted successfully'))->success();
        }
        else{
            flash(__('Something went wrong'))->error();
        }
        return redirect()->route('home_settings.index');
    }
}
