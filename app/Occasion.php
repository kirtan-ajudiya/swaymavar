<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occasion extends Model
{
    protected $table = 'occasions';
    public function products(){
    	return $this->hasMany(Product::class);
    }
}
