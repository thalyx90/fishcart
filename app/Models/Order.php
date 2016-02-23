<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function products(){
    	return $this->belongsToMany('App\Models\Product')->withPivot('quantity');
    }
}
