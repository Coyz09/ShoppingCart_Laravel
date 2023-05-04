<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Item extends Model implements Searchable
{
   public $timestamps =false;
   public $primaryKey = 'item_id';
   public $table = 'item';
   protected $fillable = ['description','sell_price','cost_price','img_path'
    ];

   public function orders(){
   //return $this->belongToMany('App\Order','orderline','item_id','orderinfo_id');
    //return $this->belongToMany('App\Order','orderline','item_id','orderinfo_id')->withPivot('quantity');
    return $this->belongToMany('App\Order','orderline','orderinfo_id','item_id')->withPivot('quantity');
    }
     public function stock(){
      return $this->hasOne('App\Stock','item_id');
    }

    
    public $searchableType = 'List of Items';
    public function getSearchResult(): SearchResult
     {
        $url = route('item.edit', $this->item_id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            $this->description,
            $url
               );
     }
}
