<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User;

class Order extends Model
{
     protected $table = 'orderinfo';
     protected $primaryKey = 'orderinfo_id';
     public $timestamps = false ;
     protected $fillable = ['customer_id','date_placed','date_shipped','shipping','shipvia','status'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }


    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

    
      public function items(){
    return $this->belongsToMany('App\Product','orderline','orderinfo_id','item_id')->withPivot('quantity');
   //return $this->belongsToMany('App\Item','orderline','orderinfo_id','item_id');
    }
}
