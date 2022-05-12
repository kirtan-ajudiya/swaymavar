<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{
    protected $table = 'fabrics';
    public function products(){
    	return $this->hasMany(Product::class);
    }
}
