<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Wishlist;
use App\Category;
use App\WishlistNew;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlists = WishlistNew::where('user_id', Auth::user()->id)->get();
        return view('frontend.dashboard.view_wishlist', compact('wishlists'));
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
        if(Auth::check()){
            $wishlist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $request->id)->where('wishlist_id', $request->whishlist_id)->first();
            if($wishlist == null){
                $wishlist = new Wishlist;
                $wishlist->user_id = Auth::user()->id;
                $wishlist->product_id = $request->id;
                $wishlist->wishlist_id = $request->whishlist_id;
                $wishlist->save();
                return response()->json(['status'=>true]);
            }
            return response()->json(['type'=>1]);
        }
        return response()->json(['status'=>false]);
    }

    public function remove(Request $request)
    {
        $wishlist = WishList::where('user_id' , Auth::user()->id)->where('wishlist_id', $request->id)->get();
        foreach($wishlist as $del){
            $del->delete();
        }
        $wishlistnew = WishlistNew::find($request->id);
        if( $wishlistnew->delete()){      
            return response()->json(['status'=>true]);
        }
        return response()->json(['status'=>false]);
    }

    public function destroy(Request $request)
    {
        $wishlishs = WishList::where('user_id' , Auth::user()->id)->where('id', $request->id)->first();
        if($wishlishs->delete()){
            flash(__('Wishlist Item has been deleted successfully!'))->success();
            return back();
        }
    }

    public function NewWishlist(Request $request)
    {
        $wishlist = new WishlistNew;
        $wishlist->user_id = Auth::user()->id;
        $wishlist->name = $request->wishlist_name;
        $wishlist->slug =  preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->wishlist_name)).'-'.Auth::user()->name;
        if($wishlist->save()){
            flash(__('Wishlist has been Created successfully!'))->success();
            return back();
        }

    }

    public function Wishlist_rename(Request $request)
    {
        $wishlist = WishlistNew::where('id', $request->id)->first();
        $name = $wishlist->name;
        $id = $wishlist->id;
        $slug = $wishlist->slug;
        if($request->num == 1){
            return response()->json(['name'=>$name, 'id'=>$id, 'status'=>true, 'type'=>1, 'slug'=>$slug]);
        }else{
            return response()->json(['name'=>$name, 'id'=>$id, 'status'=>true, 'type'=>2, 'slug'=>$slug]);
        }
    }

    public function RenameStore(Request $request){

        $wishlist = WishlistNew::where('user_id', Auth::user()->id)->where('id', $request->wishlist_id)->update(['name' => $request->wishlist_name]);
        flash(__('Wishlist Name has been Updated successfully!'))->success();
        return back();
    }

    public function wishlistData(Request $request)
    {
        $wishlishs = WishList::where('user_id' , Auth::user()->id)->where('wishlist_id', $request->id)->get();
        $count = count($wishlishs);
        $returnHTML = view('frontend.wishlist.list',compact('wishlishs'))->render();
        return response()->json(['html'=>$returnHTML, 'status'=>true, 'count'=>$count]);
    }

    public function wishlist_share(Request $request)
    {
        $details = [
            'title' => 'Link is Hear',
            'link' => $request->wishlist_slug,
            'body' => $request->message
        ];
       
        \Mail::to($request->email)->send(new \App\Mail\Whishlist($details));
       
        flash(__('Mail has been send successfully!'))->success();
        return back();
    }

    public function WhishlistDetail($slug)
    {
        try {
            $wishlistss = WishlistNew::where('slug' , $slug)->first();
            $wishlists = WishList::where('wishlist_id' , $wishlistss->id)->get();
            if(isset($wishlists) && count($wishlists)>0){
                return view('frontend.wishlist.share-wishlist', compact('wishlists'));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
