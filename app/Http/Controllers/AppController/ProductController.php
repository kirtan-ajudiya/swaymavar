<?php

namespace App\Http\Controllers\AppController;

use App\Http\Controllers\Controller;
use App\Banner;
use App\Product;
use App\Brand;
use App\Wishlist;
use App\FlashDealProduct;
use App\FlashDeal;
use App\Color;
use App\Attribute;
use Illuminate\Http\Request;
use App\Category;
use DB;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
class ProductController extends Controller
{
  
   public function getbanners(request $request){
        try {
        	$getbannersdata=Banner::where('published',1)->get();
        	 $banner=array('success'=>1,'data'=>$getbannersdata);	
        } catch (Exception $e) {
           	$banner=array('success'=>0,'data'=>array());
        }
        $bannerdata=json_encode($banner);
        return $bannerdata;  
   }
   
   public function getmobilebanners(request $request){
        try {
        	$getbannersdata=DB::table('mobile_banner')->where('position',1)->where('published',1)->get();
        	 $banner=array('success'=>1,'data'=>$getbannersdata);	
        } catch (Exception $e) {
           	$banner=array('success'=>0,'data'=>array());
        }
        $bannerdata=json_encode($banner);
        return $bannerdata;  
   }
   
   public function getmobilebanners_two(request $request){
        try {
        	$getbannersdata=DB::table('mobile_banner')->where('position',2)->where('published',1)->get();
        	 $banner=array('success'=>1,'data'=>$getbannersdata);	
        } catch (Exception $e) {
           	$banner=array('success'=>0,'data'=>array());
        }
        $bannerdata=json_encode($banner);
        return $bannerdata;  
   }
   
   public function getmobilebanners_three(request $request){
        try {
        	$getbannersdata=DB::table('mobile_banner')->where('position',3)->where('published',1)->get();
        	 $banner=array('success'=>1,'data'=>$getbannersdata);	
        } catch (Exception $e) {
           	$banner=array('success'=>0,'data'=>array());
        }
        $bannerdata=json_encode($banner);
        return $bannerdata;  
   }
   
    
  public function getallproducts(request $request){
  	     $categorie=$request->categorieid;
  	     $searchname=$request->sname;
  	     $sort_by=$request->sort_by;
  	     $min_price=$request->min_price;
  	     $max_price=$request->max_price;
             $user_id=$request->user_id;
             $setkey=$request->key;
             $page=$request->page;
             $color=$request->color;
             $attribute=$request->attribute;
             $offset=10 * $page;
             $setpage = 0;

        try {
        $AllProducts=array();    
        $Products  = DB::table('products')
        ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
        ->leftJoin('sub_categories', 'sub_categories.id', '=', 'products.subcategory_id')	
        ->leftJoin('sub_sub_categories', 'sub_sub_categories.id', '=', 'products.subsubcategory_id');
        if($setkey == "wishlist"){
        $Products->select('products.*','categories.name as categories_name','sub_categories.name as sub_categories_name','sub_sub_categories.name as sub_sub_categories_name');    
        }else{
        $Products->select('products.*','categories.name as categories_name','sub_categories.name as sub_categories_name','sub_sub_categories.name as sub_sub_categories_name')->skip($offset)->take(10);    
        }
        
        //filter
        if(isset($categorie)){
        	$Products->where('products.category_id',$categorie);
        }
        
        if($setkey == "todaysdeal"){
        	$Products->where('products.todays_deal',1);
        }
        
        if($setkey == "featured"){
        	$Products->where('products.featured',1);
        }
        
        if($setkey == "newest"){
        	$Products->orderBy('products.created_at', 'desc');
        }
        
        if(isset($searchname)){
        	$Products->where('products.name', 'like', '%'.$searchname.'%')->orWhere('products.tags', 'like', '%'.$searchname.'%');
        }
        
        if(isset($color)){
                $Products->where('products.colors', 'like', '%'.$color.'%');
        }
       
        if(isset($attribute) && !empty($attribute)){
          
            foreach (json_decode($attribute) as $value) {
                 $str = '"'.$value.'"';
                $Products->orwhere('products.choice_options', 'like', '%'.$str.'%');   
            }
        }
        

        if(isset($sort_by)){
            switch ($sort_by) {
                case '1':
                    $Products->orderBy('products.name', 'desc');
                    break;
                case '2':
                    $Products->orderBy('products.name', 'asc');
                    break;
                case '3':
                    $Products->orderBy('products.unit_price', 'asc');
                    break;
                case '4':
                    $Products->orderBy('products.unit_price', 'desc');
                    break;
                default:
                    // code...
                    break;
            }
        }

        if($min_price != null && $max_price != null){
             $Products->where('products.unit_price', '>=', $min_price)->where('products.unit_price', '<=', $max_price);
        }	
        $Products->where('products.published',1);
        $Products=filter_products($Products)->get();
         foreach ($Products as $key => $value) {
          $value->islike=0;
          if((!empty($user_id) && $user_id) != "" && (Wishlist::where('user_id', $user_id)->where('product_id',$value->id)->get()->count() > 0)){
              $value->islike=1;
           if($setkey == "wishlist"){
                $AllProducts[]=$value;    
            }
          }
          if($setkey != "wishlist"){
          $AllProducts[]=$value;    
          }           
        }
        if(count($AllProducts) < 10){
           $setpage =0;  
        }else{
           $setpage =$page + 1;
        }
        $allproducts=array('success'=>1,'data'=>$AllProducts,'page'=>$setpage);	
        } catch (Exception $e) {
        	$allproducts=array('success'=>0,'data'=>array(),'page'=>-1);	 
        }     
        $allproductsdata=json_encode($allproducts);
        return $allproductsdata;
  }  

  public function addwishlist(request $request){
         $productid=$request->product_id;
         $userid=$request->id;
         try {
			$wishlist = Wishlist::where('user_id', $userid)->where('product_id', $productid)->first();
            if($wishlist == null && isset($productid) && isset($userid)){
                $wishlist = new Wishlist;
                $wishlist->user_id = $userid;
                $wishlist->product_id = $productid;
                $wishlist->save();
            }
            $addwishpro=array('success'=>1,'data'=>$wishlist);	
        } catch (Exception $e) {
           	$addwishpro=array('success'=>0,'data'=>array());
        }
        $wishlistdata=json_encode($addwishpro);
        return $wishlistdata;  
  }

   public function getwishlist(request $request){
         $userid=$request->id;
         try {
			$wishlist = Wishlist::where('user_id', $userid)->get();   
            $wishlistpro=array('success'=>1,'data'=>$wishlist);	
        } catch (Exception $e) {
           	$wishlistpro=array('success'=>0,'data'=>array());
        }
        $wishlistdata=json_encode($wishlistpro);
        return $wishlistdata; 	
  }

  public function removewishlist(Request $request)
    {
 			$id=$request->user_id;
                        $proid=$request->product_id;
        try {
	        $wishlist = Wishlist::where('user_id',$id)->where('product_id',$proid)->get();
	        if(count($wishlist) > 0){
	            Wishlist::destroy($wishlist[0]->id);
   	           $wishlistremove=array('success'=>1,'message'=>'remove successfully');
	         }
	         else{
	          $wishlistremove=array('success'=>0,'message'=>'not in list');  	
	         }
        } catch (Exception $e) {
           	$wishlistremove=array('success'=>0,'message'=>'somthing want wrong');
        }
        $wishlistdata=json_encode($wishlistremove);
        return $wishlistdata; 	
    }

   public function getallbrands(request $request){
         try {
			$brands = Brand::all();   
            $responseData=array('success'=>1,'data'=>$brands);	
        } catch (Exception $e) {
           	$responseData=array('success'=>0,'data'=>array());
        }
        $BrandResponse=json_encode($responseData);
        return $BrandResponse; 	
  }
  
     public function checkvartiation(request $request){
        $product = Product::find($request->id);
        if(isset($product) && isset($product->variant_product)){
        $str = '';
        $tax = 0;
        $data=array();        
        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        if($request->choice != null) {
            $str .= "-".$request->choice;
        }
        
        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            if(!empty($product_stock)){
            $price = $product_stock->price;
            $stockQuantity = $product_stock->qty;
            }else{
                $price = 0;
                $stockQuantity = 0;
            }
        }
        else{
            $price = $product->unit_price;
            $stockQuantity = $product->current_stock;
        }

        //discount calculation
        $flash_deals = FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $key => $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1 && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if ($product->tax_type == 'percent') {
            $price += ($price*$product->tax) / 100;
        }
        elseif ($product->tax_type == 'amount') {
            $price += $product->tax;
        }

        $data=array('product_id' => $product->id,
            'variant' => $str,
            'price' => (double) $price,
            'in_stock' => $stockQuantity < 1 ? false : true);        
        }else{
            $data=array('product_id' => 0,
            'variant' => 0,
            'price' => 0,
            'in_stock' => false);
        }       
        $Response=json_encode($data);
         
        return $Response; 
        }
        
    public function getattributes(){
        $attributes = array();
        $non_paginate_products=Product::where('products.published',1)->get();
        if(!empty($non_paginate_products)){
        foreach ($non_paginate_products as $key => $product) {
            if($product->attributes != null && is_array(json_decode($product->attributes))){
                foreach (json_decode($product->attributes) as $key => $value) {
                    $flag = false;
                    $pos = 0;
                    foreach ($attributes as $key => $attribute) {
                        if($attribute['id'] == $value){
                            $flag = true;
                            $pos = $key;
                            break;
                        }
                    }
                    if(!$flag){
                        $item['id'] = $value;
                        $item['name'] = Attribute::find($value)->name;
                        $item['values'] = array();
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                $item['values'] = $choice_option->values;
                                break;
                            }
                        }
                        array_push($attributes, $item);
                    }
                    else {
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                foreach ($choice_option->values as $key => $value) {
                                    if(!in_array($value, $attributes[$pos]['values'])){
                                        array_push($attributes[$pos]['values'], $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $responseData=array('success'=>1,'data'=>$attributes);
        }else{
            $responseData=array('success'=>0,'data'=>array());
        }
         $Response=json_encode($responseData);
         
        return $Response;
    }

   public function getcolor(){
        $all_colors = array();
        $non_paginate_products=Product::where('products.published',1)->get();
        if(!empty($non_paginate_products)){
            foreach ($non_paginate_products as $key => $product) {
                 if ($product->colors != null) {
                     foreach (json_decode($product->colors) as $key => $color) {
                         if(!in_array($color, $all_colors)){
                             array_push($all_colors, $color);
                         }
                     }
                 }
             }
        $responseData=array('success'=>1,'data'=>$all_colors);
        }else{
            $responseData=array('success'=>0,'data'=>array());
        }
         $Response=json_encode($responseData);
         
        return $Response;
   } 
   
   public function get_all_category(){
        $category=Category::get();
     
        if(!empty($category)){
            foreach ($category as $value) {
              $value['sub_category'] = DB::table('sub_categories')->where('category_id',$value->id)->get();
              foreach ($value['sub_category'] as $subsubcat) {
                 $subsubcat->sub_sub_category = DB::table('sub_sub_categories')->where('sub_category_id',$subsubcat->id)->get();   
              }

            }
        $responseData=array('success'=>1,'data'=>$category);
        }else{
        $responseData=array('success'=>1,'data'=>array());
        }
         $Response=json_encode($responseData);
         
        return $Response;
   } 
   
    public function getallpages(){
        try {
                 $allpagedata=array();
        	 $getpages=DB::table('policies')->get();
                 $allpagedata=array(
                   "privecypolicy"=>$getpages[4],
                   "refundpolicy"=>$getpages[1],
                   "termsandconditions"=>$getpages[3],
                 );
                 $pages=array('success'=>1,'data'=>$allpagedata);	
        } catch (Exception $e) {
           	 $pages=array('success'=>0,'data'=>array());
        }
        $pagesdata=json_encode($pages);
        return $pagesdata;  
   }
        
}
