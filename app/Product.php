<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public $primaryKey = 'item_id';
   public $table = 'item';
   public $timestamps = false;
   protected $fillable = ['description','sell_price','cost_price','img_path'
    ];

     public function stock(){
      return $this->hasOne('App\Stock','item_id');
    }
}