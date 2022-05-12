<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
