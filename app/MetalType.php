<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetalType extends Model
{
    protected $table = 'metal_types';

    public function metalprice(){
    	return $this->hasMany(MetalPrice::class);
    }
}
