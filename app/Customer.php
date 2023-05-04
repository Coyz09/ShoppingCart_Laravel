<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Customer extends Model implements Searchable
{
    public $table = 'customer';
    public $primaryKey = 'customer_id';
    public $timestamps = false;
    
    protected $fillable = ['title','fname','lname',
        'addressline','town','zipcode',
        'phone','user_id'
    ];

     public function orders(){
        return $this->hasMany('App\Order', 'customer_id');
    }

    public $searchableType = 'Customer';
    public function getSearchResult(): SearchResult
     {
        $url = route('customer.show', $this->customer_id);
     
         return new \Spatie\Searchable\SearchResult(
            $this,
            // concat($this->lname + $this->fname),
            $this->lname,
            $url
            );
     }
}