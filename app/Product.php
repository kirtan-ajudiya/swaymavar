<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'name','added_by', 'user_id', 'category_id', 'subcategory_id', 'subsubcategory_id', 'brand_id', 'video_provider', 'video_link', 'unit_price',
    //     'purchase_price', 'unit', 'slug', 'colors', 'choice_options', 'variations', 'current_stock'
    //   ];
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class);
    }

    public function subsubcategory(){
    	return $this->belongsTo(SubSubCategory::class);
    }

    public function brand(){
    	return $this->belongsTo(Brand::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function orderDetails(){
    return $this->hasMany(OrderDetail::class);
    }

    public function reviews(){
    return $this->hasMany(Review::class)->where('status', 1);
    }

    public function wishlists(){
    return $this->hasMany(Wishlist::class);
    }

    public function stocks(){
      return $this->hasMany(ProductStock::class);
    }

    public function occasion(){
    	return $this->belongsTo(Occasion::class);
    }

    public function fabric(){
    	return $this->belongsTo(Fabric::class);
    }

    public function jewellery_types()
    {
        return $this->hasOne('App\JewelleryType', 'id', 'jewellery_type');
    }

    public function colorss()
    {
        return $this->hasOne('App\MetalColor', 'id', 'metal_color');
    }

    public function purity(){
      return $this->hasOne('App\MetalPrice', 'id', 'carat_type');
    }

    public function mtype(){
      return $this->hasOne('App\MetalType', 'id', 'metal_type');
    }
}
