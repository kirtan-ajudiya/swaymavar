<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetalPrice extends Model
{
    protected $table = 'metal_prices';

    public function metaltype(){
        return $this->hasOne('App\MetalType', 'id', 'metal_id');
    }
}
