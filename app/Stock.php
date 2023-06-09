<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
	protected $primaryKey = 'item_id';
	protected $table = 'stock';

	public $timestamps = false;
	protected $fillable = ['quantity', 'item_id'];
	
	public function item(){

		return $this->belongsTo('App\Item', 'item_id');
	}
}